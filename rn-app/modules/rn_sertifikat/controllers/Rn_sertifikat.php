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
 * @property   Rn_setting rn_setting
 * @property  CI_Email email
 * @property    UserModel userModel
 * @property  CI_Security $security
 * @property  Mahana_hierarchy $mahana_hierarchy
 */
class Rn_sertifikat extends CI_Controller {

	protected $tables = 'rn_groups';
	protected $subject = 'Sertifikat';
	protected $module;
	protected $primary_key = 'id';

    private $rules = array(
        array('field'=> 'no_sertifikat', 'label' => 'No. Sertifikat', 'rules' => 'required'),
        array('field'=> 'billid', 'label' => 'Bill ID', 'rules' => 'required'),
        array('field'=> 'jasa', 'label' => 'Jasa', 'rules' => 'required'),
        array('field'=> 'pnbp', 'label' => 'PNBP', 'rules' => 'required'),
        array('field'=> 'tot_biaya', 'label' => 'Total Biaya', 'rules' => 'required'),
    );

    public function __construct()
	{
		parent::__construct();
		$this->module = str_replace('rn_', '', strtolower( get_class($this) ) );
		$this->load->model('userModel');
		$this->load->model('sertifikat');
		$this->load->library('mahana_hierarchy');
		$this->columns = array(
			sertifikat.'.no_sertifikat',
			sertifikat.'.billid',
			sertifikat.'.jasa',
			sertifikat.'.pnbp',
			sertifikat.'.tot_biaya',
		);
		define('uriClass','rn/sertifikat');
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

	public function index()
	{
		$this->role();
		$data = $this->rn_setting->get_all();
		$data['asset'] = $this->rn_default->asset_admin();
		$data['subject'] = $this->subject;
		$data['module'] = $this->module;
		$data['ismodul'] = true;
		$data['pk'] = $this->primary_key;

		blade_back( "rn_$this->module/views/v_groups",$data);
	}

	public function get()
	{

		$this->role();
		$search = $this->input->get('q');
		$column = $this->columns;
		if( isset($search) && $column != null ){
			foreach ($column as $key => $value) {
				$this->db->or_like($value, $search);
			}
		}
//		$this->db->select('rn_groups.*,tmp_groups.name as sa19bcfde, rn_groups.name AS names');
//		$this->db->join('rn_groups as tmp_groups', 'tmp_groups.id = rn_groups.groups_parent', 'left');
//		$this->db->where_not_in('rn_groups.name', 'members' );
//		$this->db->where_not_in('rn_groups.name', 'admin' );
//  		$this->db->order_by('groups_lineage','ASC');
//		$data = $this->db->get( $this->tables)->result_array();
        $data = $this->sertifikat->getDataAll();
//		$this->mahana_hierarchy->resync();
		$dt_name = array();
//		foreach ($data as $val){
//			$dt_name[] = array(
//				'id' => $val['id'],
//				'splashcat' => $this->_callback_groups_cat($val['name'],$val['groups_deep']),
//				'name' => $val['name'],
//				'description' =>$val['description']
//			);
//		}

		json_response( array('status' => 1, 'message' => $data) );

	}

	public function rows()
	{
		$this->role();
		$search = $this->input->get('q');
		$column = $this->columns;
		if( isset($search) && $column != null ){
			foreach ($column as $key => $value) {
				$this->db->or_like($value, $search);
			}
		}
		$this->db->select('rn_groups.*,tmp_groups.name as sa19bcfde, rn_groups.name AS names');
		$this->db->join('rn_groups as tmp_groups', 'tmp_groups.id = rn_groups.groups_parent', 'left');
		$this->db->where_not_in('rn_groups.name', 'members' );
		$this->db->where_not_in('rn_groups.name', 'admin' );
		$this->db->order_by('groups_lineage','ASC');
		$data = $this->db->get( $this->tables)->result_array();
		$this->mahana_hierarchy->resync();

		$dt_name = array();
		foreach ($data as $val){
			$dt_name[] = array(
				'id' =>$val['id'],
				'splashcat' => $this->_callback_groups_cat($val['name'],$val['groups_deep']),
				'name' => $val['name'],
				'description' =>$val['description']
			);
		}
		json_response( array('status' => 1, 'message' => $dt_name) );

	}

	public function assign(){
		$this->role();
		$id    = $this->uri->segment(4);
		$data  = $this->rn_setting->get_all();
		$_POST = json_decode(file_get_contents('php://input'), true);
		if( $_POST ){
			$groupId = $this->input->post('id');
			$userId  = $this->input->post('user');
			$this->userModel->assignGroupToUser($userId, $groupId);

			json_response( array('status' => 1, 'message' => 'Sukses') );
		}


		$data['asset'] = $this->rn_default->asset_admin();
		$data['subject'] = $this->subject;
		$data['module'] = $this->module;
		$data['ismodul'] = true;
		$data['pk']     = $this->primary_key;
		$this->db->where( $this->primary_key, $id );
		$results = $this->db->get( $this->tables, 1 )->row_array();
		if( !$results ) show_404();
		$data['row'] = $results;
		blade_back( "rn_$this->module/views/v_assign", $data);

	}

	public function users()
	{
		$this->role();
		$search = $this->input->get('q');
		$column = 'username';
		$limit  = 50;
		if( isset($search) && $column ){
			$this->db->group_start();
			$this->db->like($column, $search);
			$this->db->group_end();
		}
		$this->db->select('id, username as text');
		$this->db->where('active','1');
		$this->db->order_by('username','asc');
		$this->db->order_by('id','desc');
		$data = $this->db->get( 'rn_users', $limit)->result_array();
		json_response(  $data );
	}
    /* ADD */
	public function add()
	{
		$this->role();
        $data = array(
            'no_sertifikat'     => '',
            'billid'            => '',
            'jasa'              => '',
            'pnbp'              => '',
            'tot_biaya'         => '',
        );

        /* START POST*/
        $_POST = json_decode(file_get_contents('php://input'), true);
        if( $_POST ) {
            $this->form_validation->set_rules($this->rules);
            if ($this->form_validation->run() == TRUE) {

                $actInsert = $this->db->insert(sertifikat, $_POST);

                if ($actInsert) :
                    json_response(
                        array(
                            'status' => 'info',
                            'message' => 'Tambah Data '.$this->subject.' Berhasil',
                            'callback_url' => BASE_URL.uriClass
                        )
                    );
                else:
                    json_response(
                        array(
                            'status' => 'error',
                            'message' => 'Tambah Data '.$this->subject.' Gagal',
                        )
                    );
                endif;
            }
            else{
                $errors = array(
                    'message' => $this->form_validation->error_array()
                );
                json_response($errors);
            }
        }
        /* END POST*/
        $data['title']      = 'Add';
        $data['action']     = 'add';
        $data['asset']      = $this->rn_default->asset_admin();
        $data['selected_roles'] = array();
		$data['nastable']   = true;
		$data['subject']    = $this->subject;
		$data['module']     = $this->module;
		$data['ismodul'] = true;
		$data['pk']         = $this->primary_key;
		$data['roles']      = $this->rn_setting->roles();
		blade_back( "rn_$this->module/views/v_form",$data);
	}

	/* EDIT */
	public function edit()
	{
		$this->role();
		$id = $this->uri->segment(4);

        /* START DATA EDIT */
        $dtGroups_single = $this->sertifikat->getDataById($id);
        /* END DATA EDIT */

        $data = array(
            'no_sertifikat'     => $id,
            'billid'            => $dtGroups_single['billid'],
            'jasa'              => $dtGroups_single['jasa'],
            'pnbp'              => $dtGroups_single['pnbp'],
            'tot_biaya'         => $dtGroups_single['tot_biaya'],
        );

        /* START POST */
        $_POST = json_decode(file_get_contents('php://input'), true);
        if( $_POST ) {
            $this->form_validation->set_rules($this->rules);
            if ($this->form_validation->run() == TRUE) {
                $id     = $_POST['no_sertifikat'];
                unset(
                    $_POST['no_sertifikat']
                );

                $act_update = $this->db
                    ->set($_POST)
                    ->where('no_sertifikat', $id)
                    ->update(sertifikat);

                if ($act_update) :
                    json_response(
                        array(
                            'status' => 'info',
                            'message' => 'Edit Data '.$this->subject.' Berhasil',
                            'callback_url' => BASE_URL.uriClass
                        )
                    );
                else:
                    json_response(
                        array(
                            'status' => 'error',
                            'message' => 'Edit Data '.$this->subject.' Gagal',
                        )
                    );
                endif;
            }
            else{
                $errors = array(
                    'message' => $this->form_validation->error_array()
                );
                json_response($errors);
            }
        }
        /* END POST */

        $data['title']      = 'Edit';
        $data['action'] = 'edit';
        $data['asset'] = $this->rn_default->asset_admin();
        $data['subject'] = $this->subject;
		$data['module'] = $this->module;
		$data['ismodul'] = true;
		$data['pk'] = $this->primary_key;



		blade_back( "rn_$this->module/views/v_form",$data);
	}

	/* DELETE */
	public function delete()
	{
		$this->role();
		$alias = $this->uri->segment(4);

		if( $alias ) {
            $where = array(
                'no_sertifikat' => $alias
            );

            $actDelete = $this->db->delete(sertifikat, $where);

            if ($actDelete) {
                json_response( array('status' => 'info', 'message' => 'Sukses menghapus data') );
            } else {
                json_response( array('status' => 'error', 'message' => 'Gagal menghapus data') );
            }
        }
    }

    private  function _callback_groups_cat($value,$deep)
	{
		$this->M_rn_default->cekaAuth();
		$value = $this->security->xss_clean($value);
		$splashhori = "";
		$splashmargin = "";
		$splashitem = "";
		$count = $deep;
		for ($x = 0; $x < $count; $x++) {
			$splashmargin .= "<span class='splashmargin'>&nbsp;</span>";
			if ($x == 0) {
				$splashhori .= "<span class='splashcatopen'>&nbsp;</span>";
			}
			$splashitem .= "<span class='splashcat'>&nbsp;</span>";
		}
		$splash = $splashmargin . $splashhori . $splashitem;
		$type_con = $this->uri->segment(2);
		$new_name = $splash;
		return $new_name;
	}

	private  function _set_callback_before_insert($post_array)
	{
		$config = array(
			'field' => 'groups_slug',
			'title' => 'name',
			'table' => 'rn_groups',
			'id' => 'id',
		);
		$this->load->library('slug', $config);
		if (empty($post_array))
			$post_array = $this->slug->create_uri($post_array);
		return $post_array;
	}

	private function _set_add_groups_parent_callback()
	{
		$listgroups = $this->mahana_hierarchy->get();
		$data = '<select class="form-control"  data-plugin="select2" id="field-parent"><option></option>';
		for ($x = 0; $x < count($listgroups); $x++) {
			$count = $listgroups[$x]['groups_deep'];
			$splash = "";
			for ($y = 0; $y < $count; $y++) {
				$splash .= "&nbsp;-&nbsp;";
			}
			$data .= '<option value="' . $listgroups[$x]['id'] . '">' . $splash . $listgroups[$x]['name'] . '</option>';
		}
		$data .= '</select>';
		return $data;
	}

	private function _set_field_groups_parent_callback($value, $primary_key)
	{
		$listgroups = $this->mahana_hierarchy->get();
		$data = '<select class="form-control"  data-plugin="select2" id="field-parent">';
		for ($x = 0; $x < count($listgroups); $x++) {
			$count = $listgroups[$x]['groups_deep'];
			$splash = "";
			for ($y = 0; $y < $count; $y++) {
				$splash .= "&nbsp;-&nbsp;";
			}
			if ($value == $listgroups[$x]['id']) {
				$data .= '<option selected value="' . $listgroups[$x]['id'] . '">' . $splash . $listgroups[$x]['name'] . '</option>';
			} else if ($primary_key == $listgroups[$x]['id']) {

			} else {
				$data .= '<option value="' . $listgroups[$x]['id'] . '">' . $splash . $listgroups[$x]['name'] . '</option>';
			}
		}
		$data .= '</select>';
		return $data;
	}

	private function _set_callback_before_delete($primary_key)
	{
		$getparent = $this->mahana_hierarchy->get_parent($primary_key);
		$getchild = $this->mahana_hierarchy->get_children($primary_key);
		if (!empty($getchild) && !empty($getparent)) {
			for ($x = 0; $x < count($getchild); $x++) {
				$data = array('groups_parent' => $getparent->id);
				$this->db->where('id', $getchild[$x]['id']);
				$this->db->update('rn_groups', $data);
			}
		} else if (!empty($getchild) && empty($getparent)) {
			for ($x = 0; $x < count($getchild); $x++) {
				$data = array('groups_parent' => 0);
				$this->db->where('id', $getchild[$x]['id']);
				$this->db->update('rn_groups', $data);
			}
		} else {
		}
		$this->mahana_hierarchy->resync();
		return true;
	}


	public function upload()
	{
		$this->role();
		if( !empty($_FILES) ){
			$config['upload_path']          = 'rn-public/uploads/';
			$config['allowed_types']        = 'pdf';
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

	public function upload2()
	{
		$this->role();
		if( !empty($_FILES) ){
			$config['upload_path']          = 'rn-public/uploads/';
			$config['allowed_types']        = 'pdf';
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
}
