<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @property    M_rn_default M_rn_default
 * @property    rn_default rn_default
 * @property    Ion_auth|Ion_auth_model ion_auth
 * @property    CI_Lang lang
 * @property    CI_URI uri
 * @property    CI_DB_query_builder $db
 * @property    CI_Config config
 * @property    CI_Input input
 * @property    CI_User_agent $agent
 * @property    Slug slug
 * @property    CI_Security security
 * @property    Rn_setting rn_setting
 * @property    CI_Parser parser
 * @property    UserModel userModel
 */
class Rn_users extends MX_Controller
{
	protected $table = 'rn_users';

	protected $subject = 'All User';

	protected $module;

	public function __construct()
	{

		parent::__construct();
		$this->module = str_replace('rn_', '', strtolower( get_class($this) ) );
		$this->load->model('userModel');
		$this->columns = array(
			'display_name','email'
		);
	}

	protected function role()
	{

		$this->M_rn_default->cekaAuth();
		if( $this->rn_default->groups_access_single('menu', $this->module) ) show_404();
	}

	protected function get_primary_key()
	{
		$fields = $this->get_fields();
		$filter = array_filter($fields,function ($element){
			if(isset( $element->primary_key ) && $element->primary_key == 1) return true;
			return false;
		});
		return reset($filter);
	}

	protected function get_enum ($table_name, $field_name)
	{
		$sql = "desc {$table_name} {$field_name}";
		$st = $this->db->query($sql);

		if ($st->result())
		{
			$row = $st->row();
			if ($row === FALSE)
				return FALSE;

			$type_dec = $row->Type;
			if (substr($type_dec, 0, 5) !== 'enum(')
				return FALSE;

			$values = array();
			foreach(explode(',', substr($type_dec, 5, (strlen($type_dec) - 6))) AS $v)
			{
				array_push($values, trim($v, "'"));
			}

			return $values;
		}
		return FALSE;
	}

	protected function get_fields()
	{
		$show = array(); //show field
		$fields = null;
		foreach ($this->db->field_data($this->table) as $k => $item) {
			if( count($show) > 0 ){
				if( in_array($item->name,$show) || $item->primary_key==1 ){
					$fields[$k] = $item;
					if( $item->type == 'enum' ){
						$fields[$k]->data = $this->get_enum($this->table, $item->name);
					}
				}
			}else{
				$fields[$k] = $item;
				if( $item->type == 'enum' ){
					$fields[$k]->data = $this->get_enum($this->table, $item->name);
				}
			}
		}
		return $fields;
	}
	public function index()
	{

		$this->role();
		$data = $this->rn_setting->get_all();
		$data['asset'] = $this->rn_default->asset_admin();
		$data['images'] = UPLOAD_DIR.'/uploads/avatar.png';
		$data['imagesfill'] = UPLOAD_DIR.'/uploads/avatar';
		$data['subject'] = $this->subject;
		$data['module'] = $this->module;
		$data['ismodul'] = true;
		$data['pk'] = $this->get_primary_key()->name;
		$fields = $this->get_fields();
		$data['fields'] = $fields;
		blade_back( "rn_$this->module/views/v_user",$data);
	}

	public function add()
	{
		$this->role();
		$data = $this->rn_setting->get_all();
		$_POST = json_decode(file_get_contents('php://input'), true);
		if( $_POST ){
			$this->form_validation->set_rules('username', 'Username', 'required|is_unique[rn_users.username]');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[rn_users.email]');
			$this->form_validation->set_rules('user_mobile', 'Mobile', 'is_unique[rn_users.mobile]');
			$this->form_validation->set_rules('password', 'Kata Sandi', 'required');
			if ($this->form_validation->run() == FALSE)
			{
				json_response( array('status' => 0, 'message' => validation_errors() ) );
			}
			else
			{
				$groupIDs = $_POST['groups'];
				unset($_POST['groups']);
				if( !@$_POST['avatar'] ) $_POST['avatar'] = 'avatar.png';
				$password = $this->input->post('password');
				$_POST['created_on'] = time();
				$_POST['last_login'] = time();
				$_POST['password'] = $this->_encrypt_password($password);
				$this->db->insert( $this->table, $_POST );
				$insert_id = $this->db->insert_id();
				$this->ion_auth->remove_from_group(null, $insert_id);
				$this->ion_auth->add_to_group($groupIDs, $insert_id);
				json_response( array('status' => 1, 'message' => 'Sukses menambah users baru' ) );
			}

		}
		$fields = $this->get_fields();

		foreach ($fields as $k => $field) {
			if( $field->name == 'image' ){
				$fields[$k]->type = 'upload';
			}
		}
		$data['asset'] = $this->rn_default->asset_admin();

		$data['fields'] = $fields;
		$data['subject'] = $this->subject;
		$data['module'] = $this->module;
		$data['ismodul'] = true;
		$data['pk'] = $this->get_primary_key()->name;
		$allGroup = $this->db->get('rn_groups')->result_array();
		$data['groups'] = $allGroup;
		$data['selected_groups'] = array();
		blade_back( "rn_$this->module/views/v_add",$data);
	}

	public function edit()
	{
		$this->role();
		$id = $this->uri->segment(4);
		$data = $this->rn_setting->get_all();
		$_POST = json_decode(file_get_contents('php://input'), true);



		if( $_POST ){

			$id = $_POST[$this->get_primary_key()->name];
			$password = $this->input->post('password');
			$avatar = $this->input->post('avatar');
			$groupIDs = $_POST['groups'];
			unset($_POST['groups']);
			$this->ion_auth->remove_from_group(null, $id);
			$this->ion_auth->add_to_group($groupIDs, $id);
			if(!empty($password) && !empty($avatar)){
				$dataupdate = array(
					"avatar" =>  $avatar,
					"email" => $_POST['email'],
					"display_name" => $_POST['display_name'],
					"mobile" => $_POST['mobile'],
					"active" => $_POST['active'],
					"gender" => $_POST['gender'],
					"current_location" => $_POST['current_location'],
					"password" =>  $this->_encrypt_password($password)
				);
			}
			if(empty($avatar) && empty($password)){
				$dataupdate = array(
					"email" => $_POST['email'],
					"display_name" => $_POST['display_name'],
					"mobile" => $_POST['mobile'],
					"active" => $_POST['active'],
					"gender" => $_POST['gender'],
					"current_location" => $_POST['current_location']
				);
			}
			if(empty($avatar) && !empty($password)){
				$dataupdate = array(
					"email" => $_POST['email'],
					"display_name" => $_POST['display_name'],
					"mobile" => $_POST['mobile'],
					"active" => $_POST['active'],
					"gender" => $_POST['gender'],
					"current_location" => $_POST['current_location'],
					"password" =>  $this->_encrypt_password($password)
				);
			}
			if(!empty($avatar) && empty($password)){
				$dataupdate = array(
					"avatar" =>  $avatar,
					"display_name" => $_POST['display_name'],
					"mobile" => $_POST['mobile'],
					"active" => $_POST['active'],
					"gender" => $_POST['gender'],
					"current_location" => $_POST['current_location'],
				);
			}
			$this->db->where($this->get_primary_key()->name, $id );
			$query = $this->db->update( $this->table, $dataupdate );
			json_response( array('status' => $query, 'message' => 'Sukses edit data user' ) );
		}
		$this->db->where( $this->get_primary_key()->name, $id );
		$results = $this->db->get( $this->table,1 )->row_array();
		$fields = $this->get_fields();

		foreach ($fields as $k => $field) {
			if( $field->name == 'image' ){
				$fields[$k]->type = 'upload';
			}
		}
		$data['imagesfill'] = UPLOAD_DIR.'/uploads/avatar/';
		$data['asset'] = $this->rn_default->asset_admin();
		$data['subject'] = $this->subject;
		$data['module'] = $this->module;
		$data['ismodul'] = true;
		$data['fields'] = $fields;
		$data['row'] = $results;
		$data['pk'] = $this->get_primary_key()->name;
		$allGroup = $this->db->get('rn_groups')->result_array();
		$data['groups'] = $allGroup;
		$this->db->where('user_id',$id);
		$userGroups = $this->db->get('rn_users_groups')->result_array();
		$data['selected_groups'] = array_column($userGroups, 'group_id');
		blade_back( "rn_$this->module/views/v_edit",$data);
	}

	public function get()
	{
		$this->role();
		$this->db->select('g.name as group_name,ug.user_id,ug.group_id');
		$this->db->join('rn_groups g','g.id=ug.group_id');
		$allGroup = $this->db->get('rn_users_groups ug')->result();

		$userIDs = $this->userModel->getByGroupExcept('members');
		$limit = $this->input->get('limit');
		$page = $this->input->get('page');
		$search = $this->input->get('q');
		$column = $this->columns;

		if( !$limit ) $limit=20;
		if( !$page ){
			$page = 0;
		}else{
			$page = ($page-1)*$limit;
		}
		if( isset($search) && $column != null ){
			foreach ($column as $key => $value) {
				$this->db->or_like($value, $search);
			}
		}
		$this->db->where_in('id', $userIDs);
		$this->db->order_by('username','asc');
		$data = $this->db->get( $this->table, $limit, $page)->result_array();
		foreach ($data as $k => $v) {
			$currentGroups = array_values(array_filter($allGroup, function ($el)use($v){
				return $el->user_id == $v['id'];
			}));
			$data[$k]['groups'] = $currentGroups;
			$data[$k]['created_on'] = date('Y-m-d H:i:s', $v['created_on']);
			$data[$k]['last_login'] = date('Y-m-d H:i:s', $v['last_login']);
		}
		json_response( array('status' => 1, 'message' => $data) );
	}

	public function rows()
	{
		$this->role();
		$userIDs = $this->userModel->getByGroupExcept('members');
		$search = $this->input->get('q');
		$column = $this->columns;
		if( isset($search) && $column != null ){
			foreach ($column as $key => $value) {
				$this->db->or_like($value, $search);
			}
		}
		$this->db->where_in('id', $userIDs);
		$rows = $this->db->count_all_results($this->table);
		json_response( array('status' => 1, 'message' => $rows) );
	}

	public function delete()
	{
		$this->role();
		$id = $this->uri->segment(4);
		if( $id ){
			$ids = explode('-', $id);
			$this->db->where_in( $this->get_primary_key()->name, $ids);
			$where = array(
				'id'=>$id
			);
			$return = $this->rnquery->getOne(rn_user,$where);
			$get_name = $return->avatar;
			if( $get_name ){
				$source = FCPATH.'rn-public/uploads/'.$get_name;
				if( file_exists($source) ) unlink($source);
			}
			$q = $this->db->delete($this->table);
			json_response( array('status' => $q, 'message' => 'Sukses menghapus data') );
		}else{
			json_response( array('status' => 0, 'message' => 'Gagal menghapus data, Silahkan ulangi lagi!') );
		}
	}

	public function upload()
	{
		$this->role();
		if( !empty($_FILES) ){
			$config['upload_path']          = 'rn-public/uploads/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 1024*2;
			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('file'))
			{
				json_response( array('status' => 0, 'message' => strip_tags($this->upload->display_errors()) ) );
			} else {
				$query = 1;
				json_response( array('status' => $query, 'message' => $this->upload->data()) );
			}

		}else{
			$file_name = $this->uri->segment(4);
			if( $file_name ){
				$source = FCPATH.'rn-public/uploads/'.$file_name;
				if( file_exists($source) ) unlink($source);
			}
			json_response(array('status' => 1, 'message' => 'Sukses') );
		}
	}

	protected function _encrypt_password($password)
	{
		$this->load->model('Ion_auth_model');
		return $this->Ion_auth_model->hash_password($password);
	}



}
