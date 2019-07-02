<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property    M_rn_default M_rn_default
 * @property    rn_default rn_default
 * @property  Ion_auth|Ion_auth_model $ion_auth
 * @property  CI_Lang $lang
 * @property  CI_URI $uri
 * @property  CI_DB_query_builder $db
 * @property  CI_Config $config
 * @property  CI_Input $input
 * @property  CI_User_agent $agent
 * @property  CI_Email email
 * @property Profil profil
 */
class Rn_profil extends CI_Controller {

	protected $tables = 'rn_setting';
	protected $subject = 'Profil';
	protected $module;

    private $rules_personal_info = array(
        array('field'=> 'display_name', 'label' => 'Display Name', 'rules' => 'required'),
        array('field'=> 'email', 'label' => 'Email', 'rules' => 'required')
    );

    private $rules_change_password = array(
        array('field'=> 'new_password', 'label' => 'New Password', 'rules' => 'required'),
        array('field'=> 'new_password_2', 'label' => 'Re-Type New Password', 'rules' => 'required|matches[new_password]')
    );

    public function __construct()
	{
		parent::__construct();
		$this->module = str_replace('rn_', '', strtolower( get_class($this) ) );
		date_default_timezone_set('Asia/Jakarta');
		define('heading', 'Profil');
		define('uriClass', 'rn/profil');
		$this->load->model('profil');
		$this->columns = array(
			'rn_task_todo.title'
		);
	}
	protected function role($type=null)
	{
		$this->M_rn_default->cekaAuth();
		if( $type ){
			if( $this->rn_default->groups_access_single($this->module, $type) ) show_404();
		}else{
			if( $this->rn_default->groups_access_single('menu', $this->module) ) show_404();
		}
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

	protected function required()
	{
		return array('alias');
	}

	protected function where()
	{
		$where = null;
		$where[] = array('setting_type','role_type');
		return $where;
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
		foreach ($this->db->field_data($this->tables) as $k => $item) {
			if( count($show) > 0 ){
				if( in_array($item->name,$show) || $item->primary_key==1 ){
					$fields[$k] = $item;
					if( $item->type == 'enum' ){
						$fields[$k]->data = $this->get_enum($this->tables, $item->name);
					}
				}
			}else{
				$fields[$k] = $item;
				if( $item->type == 'enum' ){
					$fields[$k]->data = $this->get_enum($this->tables, $item->name);
				}
			}
		}
		return $fields;
	}
	public  function getdetails(){
		$id = $this->input->get('id');
		$allDetails= $this->profil->get_data_edit($id);
		$get_member_todo =  @$this->profil->get_data_join_todo($id,member_todo);
		$data_user = array();
		foreach ($get_member_todo as $key2=>$val2){
			$data_user[] = array(
				'id' => $val2['id_user'],
				'id_task_todo' => $val2['id_task_todo'],
				'name'=> $val2['display_name'],
				'img' =>$val2['avatar']
			);
		}

		$data_chat[] = array(
			'chat_id' =>'1',
			'id_user' =>'14',
			'img' =>'avatar.png',
			'id_task' =>'35',
			'message'=>'loveu all'

		);
		$data_chat[] = array(
			'chat_id' =>'2',
			'id_user' =>'15',
			'img' =>'avatar.png',
			'id_task' =>'35',
			'message'=>'loveu all huhuhu'
		);

		$get_chat = array(
			'users' => $data_user,
			'chat' => $data_chat
		);


		json_response($get_chat);

	}

    public function get()
	{
		$this->role();
		$limit = $this->input->get('limit');
		$page = $this->input->get('page');
		$search = $this->input->get('q');
		$status                 = $this->input->get('status');
		$date                   = $this->input->get('date');
		@$users                   = $this->input->get('user');
		$priority				=$this->input->get('priority');
		$column = $this->columns;
		$user = $this->ion_auth->user()->row();
		$userid=$user->id;
		$newdate='';
		if($date){
			$newdate = explode(",", $date);
		}
		$dt_task = $this->profil->get_task($userid,$column,$search,$page,$limit,$status,$newdate,$users,$priority);

		json_response( array('status' => 1, 'message' => $dt_task) );
	}

    public function rows()
	{
		$this->role();
		$status                 = $this->input->get('status');
		$date                   = $this->input->get('date');
		@$users                   = $this->input->get('user');
		$priority				=$this->input->get('priority');
		$column = $this->columns;
		$user = $this->ion_auth->user()->row();
		$userid=$user->id;
		$newdate='';
		if($date){
			$newdate = explode(",", $date);
		}
		$dt_task = $this->profil->get_rowtask($userid,$status,$newdate,$users,$priority);
		$count = count($dt_task);
		json_response( array('status' => 1, 'message' => $count) );
	}

    /* INDEX */
    public function index()
    {
        $this->role();
        $data = $this->rn_setting->get_all();

        $dtUser = $this->ion_auth->user()->row();
        $data = array(
            'user_id'       => $dtUser->user_id,
            'avatar'        => @$dtUser->avatar ? UPLOAD_DIR.'uploads/avatars/'.$dtUser->avatar : '',
            'avatar_default'=> UPLOAD_DIR.'uploads/avatars/avatar.png',
            'username'      => $dtUser->username,
            'display_name'  => $dtUser->display_name,
            'email'         => $dtUser->email,
            'facebook'      => 'https://www.facebook.com/'.$dtUser->facebook,
            'twitter'       => 'https://twitter.com/'.$dtUser->twitter,
            'bio'           => $dtUser->bio,
            'address'       => $dtUser->current_location,
        );
        $data['completed'] = count($this->profil->get_counttask($dtUser->user_id,'completed'));
        $data['uncompleted'] = count($this->profil->get_counttask($dtUser->user_id,'uncompleted'));
        $data['waiting'] = count($this->profil->get_counttask($dtUser->user_id,'waiting'));
		$data['user_filter'] = $this->profil->get_filter_user($dtUser->user_id);
        $data['url'] = BASE_URL.uriClass;
        $data['asset'] = $this->rn_default->asset_admin();
        $data['subject'] = $this->subject;
        $data['module'] = $this->module;
		$data['ismodul'] = true;
		$data['images'] = UPLOAD_DIR.'/uploads/avatar.png';
		$data['imagesfill'] = UPLOAD_DIR.'/uploads/';
        $data['pk'] = $this->get_primary_key()->name;
        blade_back( "rn_$this->module/views/v_index",$data);
    }

	/* EDIT PAGE */
    public function edit() {
        $this->role();
        $data = $this->rn_setting->get_all();

        $dtUser = $this->ion_auth->user()->row();

        $data = array(
            'user_id'           => $dtUser->user_id,
            'avatar_pic'        => @$dtUser->avatar,
            'avatar'            => @$dtUser->avatar ? UPLOAD_DIR.'uploads/avatars/'.$dtUser->avatar : '',
            'avatar_default'    => UPLOAD_DIR.'uploads/avatars/avatar.png',
            'username'          => $dtUser->username,
            'display_name'      => $dtUser->display_name,
            'email'             => $dtUser->email,
            'facebook'          => $dtUser->facebook,
            'twitter'           => $dtUser->twitter,
            'bio'               => $dtUser->bio,
            'current_location'  => $dtUser->current_location,
        );
		$data['completed'] = count($this->profil->get_counttask($dtUser->user_id,'completed'));
		$data['uncompleted'] = count($this->profil->get_counttask($dtUser->user_id,'uncompleted'));
		$data['waiting'] = count($this->profil->get_counttask($dtUser->user_id,'waiting'));
        $data['url'] = BASE_URL.uriClass;
        $data['asset'] = $this->rn_default->asset_admin();
        $data['subject'] = $this->subject;
        $data['module'] = $this->module;
		$data['ismodul'] = true;
        $data['pk'] = $this->get_primary_key()->name;
        blade_back( "rn_$this->module/views/v_edit",$data);
    }

    /* ACT UPDATE PERSONAL INFO */
    public function edit_personal_info_save() {
		$this->role();
        $_POST = json_decode(file_get_contents('php://input'), true);

        $this->form_validation->set_rules($this->rules_personal_info);
        if($this->form_validation->run() == TRUE) {

            $id = $_POST['user_id'];
            unset($_POST['user_id']);

            $where = array(
                'id' => $id
            );

            $update_personal_info = $this->rnquery->update(rn_user, $_POST, $where);

            if ($update_personal_info) :
                json_response(
                    array(
                        'status' => 'info',
                        'message' => 'Edit Data '.heading.' Berhasil',
                    )
                );
            else:
                json_response(
                    array(
                        'status' => 'error',
                        'message' => 'Edit Data '.heading.' Gagal',
                    )
                );
            endif;
        }
        else {
            json_response(
                array(
                    'message'       => $this->form_validation->error_array(),
                )
            );
        }
    }

    /* ACT UPDATE CHANGE PASSWORD */
    public function edit_change_password_save() {
		$this->role();
        $_POST = json_decode(file_get_contents('php://input'), true);
        $this->form_validation->set_rules($this->rules_change_password);
        if($this->form_validation->run() == TRUE) {

            $id = $_POST['user_id'];
            unset($_POST['user_id']);

            $data = array(
                'password'  => $_POST['new_password_2']
            );

            $update = $this->ion_auth->update($id, $data);

            if ($update) :
                json_response(
                    array(
                        'status' => 'info',
                        'message' => 'Edit Data '.heading.' Berhasil',
                    )
                );
            else:
                json_response(
                    array(
                        'status' => 'error',
                        'message' => 'Edit Data '.heading.' Gagal',
                    )
                );
            endif;
        }
        else {
            json_response(
                array(
                    'message'       => $this->form_validation->error_array(),
                )
            );
        }
    }

    /* AVATAR */
    public function upload()
    {
        $this->role();
        if( !empty($_FILES) ){
            $config['upload_path']          = UPLOAD_PATH.'uploads/avatars';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 1024*2;
            $this->load->library('upload', $config);

            $file_name = $_FILES['file']['name'];
            $id = $this->ion_auth->user()->row()->id;

            if ( ! $this->upload->do_upload('file'))
            {
                json_response(
                    array(
                        'status' => 'error',
                        'message' => strip_tags($this->upload->display_errors()),
                    )
                );
            } else {
                $data = array(
                    'avatar'  => $file_name
                );

                $update = $this->ion_auth->update($id, $data);

                json_response(
                    array(
                        'status' => 'info',
                        'message' => 'Upload Data '.heading.' Berhasil',
                        'file_name' => $file_name
                    )
                );
            }
        }else{
            $file_name = $this->uri->segment(4);
            if( $file_name ){
                $source = FCPATH.'rn-public/uploads/avatars/'.$file_name;
                if( file_exists($source) ) unlink($source);
            }

            $id = $this->ion_auth->user()->row()->id;

            $data = array(
                'avatar'  => ''
            );

            $update = $this->ion_auth->update($id, $data);

            json_response(
                array(
                    'status' => 'info',
                    'message' => 'Hapus Data '.heading.' Berhasil',
                )
            );
        }
    }

    public function delete()
	{
		$this->role();
		$alias = $this->uri->segment(4);
		if( $alias ){
			$this->db->where('setting_type','role_type');
			$this->db->where('setting_desc', $alias);
			$this->db->delete($this->tables);

			$this->db->where('setting_type','role_type');
			$this->db->where('setting_value',$alias);
			$this->db->where('setting_desc', 'menu');
			$this->db->delete($this->tables);
			json_response( array('status' => 1, 'message' => 'Sukses menghapus data') );
		}else{
			json_response( array('status' => 0, 'message' => 'Gagal menghapus data, Silahkan ulangi lagi!') );
		}
	}
	public  function updatereport(){
		$_POST = json_decode(file_get_contents('php://input'), true);
		$textarea	=  $id = $_POST['description'];
		$id_member		= $id = $_POST['id'];
		$data = array(
			'description'          	=> $textarea,
			'status'				=> 'waiting',
		);
		$this->rnquery->update(member_todo, $data, array('id' => $id_member));
		json_response( array('status' => 1, 'message' => 'Sukses') );
	}
    public function columns()
	{
		$this->role();
		json_response( $this->get_fields() );
	}

	function chat(){
		blade_back( "rn_$this->module/views/chat");
	}
}
