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
 */
class Rn_role extends CI_Controller {

	protected $tables = 'rn_setting';
	protected $subject = 'Role Module';
	protected $module;

	public function __construct()
	{
		parent::__construct();
		$this->module = str_replace('rn_', '', strtolower( get_class($this) ) );
		date_default_timezone_set('Asia/Jakarta');
		define('heading', 'Urusan');
		define('uriClass', 'cms/urusan');
	}
	protected function role()
	{
		$this->M_rn_default->cekaAuth();
		if( !$this->ion_auth->is_admin() ) show_404();
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

	public function index()
	{
		$this->role();
		$data = $this->rn_setting->get_all();
		$data['asset'] = $this->rn_default->asset_admin();
		$data['subject'] = $this->subject;
		$data['module'] = $this->module;
		$data['ismodul'] = true;
		$data['pk'] = $this->get_primary_key()->name;
		blade_back( "rn_$this->module/views/v_list",$data);
	}

	public function get()
	{
		$limit = $this->input->get('limit');
		$page = $this->input->get('page');
		$search = $this->input->get('q');
		$column = 'setting_value';
		if( !$limit ) $limit=20;
		if( !$page ){
			$page = 0;
		}else{
			$page = ($page-1)*$limit;
		}
		if( isset($search) && $column ){
			$this->db->like($column, $search);
		}
		if( $this->where() ){
			foreach ($this->where() as $where){
				$this->db->where($where[0],$where[1]);
			}
		}
		$this->db->where('setting_type','role_type');
		$this->db->where('setting_desc','menu');
		$menus = $this->db->get($this->tables,$limit, $page)->result();
		$this->db->where('setting_type','role_type');
		$role_types = $this->db->get($this->tables,$limit, $page)->result();
		$value = array();
		foreach ($menus as $item) {
			$menu = array_values(
				array_filter( $menus ,function ($e)use($item){
					if( $e->setting_desc == 'menu' && $e->setting_value == $item->setting_value ) return true;
					return false;
				}));
			$add = array_values(
				array_filter( $role_types ,function ($e)use($item){
					if( $e->setting_value == 'add' && $e->setting_desc == $item->setting_value ) return true;
					return false;
				}));
			$edit = array_values(
				array_filter( $role_types ,function ($e)use($item){
					if( $e->setting_value == 'edit' && $e->setting_desc == $item->setting_value ) return true;
					return false;
				}));
			$delete = array_values(
				array_filter( $role_types ,function ($e)use($item){
					if( $e->setting_value == 'delete' && $e->setting_desc == $item->setting_value ) return true;
					return false;
				}));
			$value[] = array(
				'alias' => format_title($item->setting_value),
				'value' => $item->setting_value,
				'menu' => (bool)reset($menu),
				'add' => (bool)reset($add),
				'edit' => (bool)reset($edit),
				'delete' => (bool)reset($delete),
			);
		}
		json_response( array('status' => 1, 'message' => $value) );
	}
	public function rows()
	{
		$this->role();
		$search = $this->input->get('q');
		$column = 'setting_value';
		if( isset($search) && $column ){
			$this->db->like($column, $search);
		}
		if( $this->where() ){
			foreach ($this->where() as $where){
				$this->db->where($where[0],$where[1]);
			}
		}
		$this->db->group_by('setting_desc');
		$rows = $this->db->count_all_results($this->tables);
		json_response( array('status' => 1, 'message' => $rows-1) );
	}

	public function add()
	{
		$this->role();
		$data = $this->rn_setting->get_all();
		$_POST = json_decode(file_get_contents('php://input'), true);
		if( $_POST ){
			foreach ($this->required() as $field) {
				if ( !$_POST[$field] )
				{
					json_response( array('status' => 0, 'message' => "Field $field is Required" ));
				}
			}

			$data_insert = array();
			$custom = $this->input->post('custom');
			if( $custom ){
				$_POST['module'] = $custom;
			}
			if( isset($_POST['menu']) && $_POST['menu'] == 'on' ){
				$data_insert[] = array(
					'setting_type'  => 'role_type',
					'setting_name'  => 'Menu '.$_POST['alias'],
					'setting_value' => $_POST['module'],
					'setting_desc'  => 'menu',
				);
			}
			if( isset($_POST['add']) && $_POST['add'] == 'on' ){
				$data_insert[] = array(
					'setting_type'  => 'role_type',
					'setting_name'  => 'Add '.$_POST['alias'],
					'setting_value' => 'add',
					'setting_desc'  => $_POST['module'],
				);
			}
			if( isset($_POST['edit']) && $_POST['edit'] == 'on' ){
				$data_insert[] = array(
					'setting_type'  => 'role_type',
					'setting_name'  => 'Edit '.$_POST['alias'],
					'setting_value' => 'edit',
					'setting_desc'  => $_POST['module'],
				);
			}
			if( isset($_POST['delete']) && $_POST['delete'] == 'on' ){
				$data_insert[] = array(
					'setting_type'  => 'role_type',
					'setting_name'  => 'Delete '.$_POST['alias'],
					'setting_value' => 'delete',
					'setting_desc'  => $_POST['module'],
				);
			}

			if( $data_insert ){
				$query = $this->db->insert_batch( $this->tables, $data_insert );
				json_response( array('status' => $query, 'message' => 'Success menambah data') );
			}else{
				json_response(array('status' => 0, 'message' => 'Data Tidak Boleh Kosong' ) );
			}
		}
		$data['nastable'] = true;
		$data['asset'] = $this->rn_default->asset_admin();
		$data['nav'] = 'yes';
		$data['subject'] = $this->subject;
		$data['module'] = $this->module;
		$data['ismodul'] = true;
		$this->db->where('setting_type','role_type');
		$this->db->group_by('setting_desc');
		$group_roles = $this->db->get($this->tables)->result();

		$roles = array();
		foreach ($group_roles as $group_role) {
			if( $group_role->setting_desc != 'menu' ) {
				$roles[] = $group_role->setting_desc;
			}
		}

		$modules = array();
		foreach (list_modules() as $list_module) {
			if( !in_array($list_module,$roles) ){
				$modules[] = $list_module;
			}
		}

		$data['modules'] = $modules;
		$data['pk'] = $this->get_primary_key()->name;
		blade_back( "rn_$this->module/views/v_add",$data);
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

	public function columns()
	{
		$this->role();
		json_response( $this->get_fields() );
	}
}
