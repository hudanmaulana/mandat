<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @property  M_base_config $M_base_config
 * @property  base_config $base_config
 * @property  Ion_auth|Ion_auth_model $ion_auth
 * @property  CI_Lang $lang
 * @property  CI_URI $uri
 * @property  CI_DB_query_builder $db
 * @property  CI_Config $config
 * @property  CI_Input $input
 * @property  CI_User_agent $agent
 * @property  Mahana_hierarchy $mahana_hierarchy
 * @property  Slug $slug
 * @property  CI_Security $security
 */
class Rn_generate extends MX_Controller
{
    protected $table;
    protected $subject;
    protected $module;
    protected $mymodule = 'generate';

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->lang->load('auth');
        $this->module = str_replace('rn_', '', strtolower( get_class($this) ) );
    }

    protected function role()
    {
        if(!$this->ion_auth->is_admin()) redirect('rn');
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
        return [];
    }

    protected function where()
    {
        $where = null;
        //$where[] = ['product_name','saya'];
        //$where[] = ['product_desc','saya'];
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
        $show = []; //show field
        $fields = null;
        foreach ($this->db->field_data($this->table) as $k => $item) {
            if( count($show) > 0 ){
                if( in_array($item->name,$show) || $item->primary_key==1 ){
                    $fields[$k] = $item;
                    $fields[$k]->alias = format_title($item->name);
                    if( $item->type == 'enum' ){
                        $fields[$k]->data = $this->get_enum($this->table, $item->name);
                    }
                }
            }else{
                $fields[$k] = $item;
                $fields[$k]->alias = format_title($item->name);
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
        $_POST = json_decode(file_get_contents('php://input'), true);
        if( $_POST ){
            $subject = $this->input->post('subject');
            $table = $this->input->post('table');
            $module = $this->input->post('module');
            $options = $this->input->post('options');
            $alias = $this->input->post('alias');
            $this->table = $table;
            $this->module = $module;
            $this->subject = $subject;
            $fields = $this->get_fields();
            if( $options ){
                foreach ($fields as $k => $field) {
                    $column_type = @$options[$k];
                    if( $column_type ) $fields[$k]->type = $column_type;
                }
            }
            if( $alias ){
                foreach ($fields as $k => $field) {
                    $column_alias = @$alias[$k];
                    if( $column_alias ) $fields[$k]->alias = $column_alias;
                }
            }
            $data['fields'] = $fields;
            $data['subject'] = $subject;
            $data['table'] = $table;
            $data['module'] = $module;
            $data['pk'] = $this->get_primary_key()->name;
            $data['upload_exist'] = false;
            foreach ($fields as $field) {
                if( $field->type == 'upload' ) {
                    $data['upload_exist'] = true;
                }
            }
            $path = FCPATH.'rn-app/modules/rn_'.$module;
            $file_controller = $path.'/controllers/rn_'.$module.'.php';
            $file_view_list = $path.'/views/v_list.blade.php';
            $file_view_add = $path.'/views/v_add.blade.php';
            $file_view_edit = $path.'/views/v_edit.blade.php';

            if( !file_exists($path) ){
                mkdir( $path.'/controllers', 0777, true );
                mkdir( $path.'/views', 0777, true );
                file_put_contents( $file_controller, blade_back( "rn_$this->mymodule/views/v_ctrl", $data, true) );
                file_put_contents( $file_view_add, blade_back( "rn_$this->mymodule/views/v_add", $data, true) );
                file_put_contents( $file_view_list, blade_back( "rn_$this->mymodule/views/v_list", $data, true) );
                file_put_contents( $file_view_edit, blade_back( "rn_$this->mymodule/views/v_edit", $data, true) );
                json_response( array('status'=>1, 'message'=>'success') );
            }else{
                json_response( array('status'=>0, 'message'=>'folder exist') );
            }
        }
        $data['nastable'] = true;
        $data['asset'] = $this->rn_default->asset_admin();
        $data['setting'] =$this->rn_default->rn_setting();
        $data['nav'] = 'yes';
        $data['subject'] = 'Generate CRUD';
        $data['module'] = $this->mymodule;

		$data['ismodul'] = true;
        $data['tables'] = $this->db->list_tables();
        blade_back( "rn_$this->module/views/v_app", $data);
    }

    public function show_table(){
        $table = $this->uri->segment(4);
        if(!$table) show_404();
        $this->table = $table;
        $fields = $this->get_fields();
        json_response( $fields );
    }

}
