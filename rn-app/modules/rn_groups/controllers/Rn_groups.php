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
class Rn_groups extends CI_Controller {

	protected $tables = 'rn_groups';
	protected $subject = 'Group';
	protected $module;
	protected $primary_key = 'id';

    private $rules = array(
        array('field'=> 'name', 'label' => 'Name', 'rules' => 'required')
    );

    public function __construct()
	{
		parent::__construct();
		$this->module = str_replace('rn_', '', strtolower( get_class($this) ) );
		$this->load->model('userModel');
		$this->load->model('groups');
		$this->load->library('mahana_hierarchy');
		$this->columns = array(
			'rn_groups.name','rn_groups.description'
		);
		define('uriClass','rn/groups');
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
            'id'            => '',
            'name'          => '',
            'description'   => '',
        );

       $data['groupsx'] =  $this->_set_add_groups_parent_callback();
        /* START POST*/
        $_POST = json_decode(file_get_contents('php://input'), true);
        if( $_POST ) {
            $this->form_validation->set_rules($this->rules);
            if ($this->form_validation->run() == TRUE) {
				$roles = $_POST['roles'];
				$_POST['groups_slug'] =  $this->_set_callback_before_insert($_POST['name']);
				unset($_POST['roles']);
				$act_insert_groups = $this->mahana_hierarchy->insert($_POST);
				$this->mahana_hierarchy->resync();
                $id = $this->db->insert_id();
                if (@$roles) :
                    $act_insert_roles = $this->userModel->roleUpdate($id, $roles);
                endif;
                if ($act_insert_groups) :
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
		if($id == 1){ };

        /* START DATA EDIT */
        $dtGroups_single = $this->groups->getDataById($id);
        /* END DATA EDIT */

        $data = array(
            'id'            => $id,
            'name'          => $dtGroups_single['name'],
            'description'   => $dtGroups_single['description'],
        );
		$data['groupsx'] = $this->_set_field_groups_parent_callback($dtGroups_single['groups_parent'],$id);
        /* START POST */
        $_POST = json_decode(file_get_contents('php://input'), true);
        if( $_POST ) {
            $this->form_validation->set_rules($this->rules);
            if ($this->form_validation->run() == TRUE) {
                $id     = $_POST['id'];
                $roles  = $_POST['roles'];
                unset(
                    $_POST['id'],
                    $_POST['roles']
                );
                $act_update_groups = $this->mahana_hierarchy->update($id,$_POST);
				$this->mahana_hierarchy->resync();
                $act_update_roles   = $this->userModel->roleUpdate($id, $roles);
                if ($act_update_groups) :
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
		$data['roles']  = $this->rn_setting->roles();
		$data['selected_roles'] = $this->userModel->roleByGroupId($id);

		blade_back( "rn_$this->module/views/v_form",$data);
	}
	/* DELETE */
	public function delete()
	{
		$this->role();
		$alias = $this->uri->segment(4);
		if( $alias ) {
            $where_groups = array(
                'id' => $alias
            );
            $this->_set_callback_before_delete($alias);
            $act_del_groups = $this->rnquery->delete(rn_groups, $where_groups);
			json_response( array('status' => $act_del_groups, 'message' => 'Sukses menghapus data') );

//            redirect(BASE_URL . uriClass);
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
}
