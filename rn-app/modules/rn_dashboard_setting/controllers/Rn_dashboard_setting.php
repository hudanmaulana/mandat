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
class Rn_dashboard_setting extends CI_Controller {

	protected $tables = 'rn_setting';
	protected $subject = 'Dashboard Setting';
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

        $this->load->model('dashboard_setting');

		define('heading', 'Dashboard Setting');
		define('uriClass', 'rn/dashboard_setting');
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

    /* INDEX */
    public function index()
    {
        $this->role();
        $data = $this->rn_setting->get_all();

        $dtSetting = $this->dashboard_setting->getDataSetting();
        $dtLogo = $this->dashboard_setting->getDataLogo();

        $data = array(
            'site_title'        => '',
            'site_keyword'      => '',
            'site_description'  => '',
            'tagline'           => '',
            'company_name'      => '',
            'company_address'   => '',
            'site_logo'         => '',
        );

        foreach ($dtSetting as $key => $val ) :
            if ($val['setting_name'] == 'site_title')
                $data['site_title'] = @$val['setting_value'];

            if ($val['setting_name'] == 'site_keyword')
                $data['site_keyword'] = @$val['setting_value'];

            if ($val['setting_name'] == 'site_description')
                $data['site_description'] = @$val['setting_value'];

            if ($val['setting_name'] == 'tagline')
                $data['tagline'] = @$val['setting_value'];

            if ($val['setting_name'] == 'company_name')
                $data['company_name'] = @$val['setting_value'];

            if ($val['setting_name'] == 'company_address')
                $data['company_address'] = @$val['setting_value'];
        endforeach;

        $data['site_logo'] = $dtLogo[0]['setting_value'];
        $data['url'] = BASE_URL.uriClass;
        $data['asset'] = $this->rn_default->asset_admin();
        $data['subject'] = $this->subject;
        $data['module'] = $this->module;
		$data['ismodul'] = true;
        $data['pk'] = $this->get_primary_key()->name;
        blade_back( "rn_$this->module/views/v_index",$data);
    }

    /* ACT UPDATE WEB SETTING */
    public function edit_ws() {
        $_POST = json_decode(file_get_contents('php://input'), true);

        $data = array(
            array(
                'setting_type'  => 'dashboard_setting',
                'setting_name'  => 'site_title',
                'setting_value' => $_POST['site_title']
            ),
            array(
                'setting_type'  => 'dashboard_setting',
                'setting_name'  => 'site_keyword',
                'setting_value' => $_POST['site_keyword']
            ),
            array(
                'setting_type'  => 'dashboard_setting',
                'setting_name'  => 'site_description',
                'setting_value' => $_POST['site_description']
            ),
            array(
                'setting_type'  => 'dashboard_setting',
                'setting_name'  => 'tagline',
                'setting_value' => $_POST['tagline']
            ),
            array(
                'setting_type'  => 'dashboard_setting',
                'setting_name'  => 'company_name',
                'setting_value' => $_POST['company_name']
            ),
            array(
                'setting_type'  => 'dashboard_setting',
                'setting_name'  => 'company_address',
                'setting_value' => $_POST['company_address']
            )
        );

        $where_delete = array(
            'setting_type'  => 'dashboard_setting'
        );

        $delete_dashboard_setting = $this->db->delete(rn_setting, $where_delete);
        $insert_website_setting = $this->rnquery->insert_batch(rn_setting, $data);

        if ($insert_website_setting) :
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

    /* AVATAR */
    public function upload()
    {
        $this->role();
        if( !empty($_FILES) ){
            $config['upload_path']          = UPLOAD_PATH.'uploads';
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
                    'setting_value'  => $file_name
                );

                $where = array(
                    'setting_name'  => 'site_logo',
                    'setting_type'  => 'dashboard_logo'
                );

                $update = $this->rnquery->update(rn_setting, $data, $where);

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
                $source = FCPATH.'rn-public/uploads/'.$file_name;
                if( file_exists($source) ) unlink($source);
            }

            $data = array(
                'setting_value'  => ''
            );

            $where = array(
                'setting_name'  => 'site_logo',
                'setting_type'  => 'dashboard_logo'
            );

            $update = $this->rnquery->update(rn_setting, $data, $where);

            json_response(
                array(
                    'status' => 'info',
                    'message' => 'Hapus Data '.heading.' Berhasil',
                )
            );
        }
    }

    public function columns()
	{
		$this->role();
		json_response( $this->get_fields() );
	}
}
