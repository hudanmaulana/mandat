<?php echo "<?php if (!defined('BASEPATH')) exit('No direct script access allowed');"; ?>

/**
 * @property  M_rn_default M_rn_default
 * @property  rn_default rn_default
 * @property  Ion_auth|Ion_auth_model ion_auth
 * @property  CI_Lang lang
 * @property  CI_URI uri
 * @property  CI_DB_query_builder $db
 * @property  CI_Config config
 * @property  CI_Input input
 * @property  CI_User_agent $agent
 * @property  Slug slug
 * @property  CI_Security security
 * @property  Setting setting
 * @property  CI_Parser parser
 * @property  CI_Upload upload
 * @property  CI_Loader load
 */
class Rn_{{$module}} extends MX_Controller
{
    protected $table = '{{$table}}';
    protected $subject = 'Data {{$module}}';
    protected $module;
    protected $primary_key = '{{$pk}}';

    public function __construct()
    {
        parent::__construct();
        $this->module = str_replace('rn_', '', strtolower( get_class($this) ) );
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
        $data = $this->setting->get_all();
        $data['nastable'] = true;
        $data['subject'] = $this->subject;
        $data['module'] = $this->module;
        $data['pk'] = $this->primary_key;
		blade_back( "rn_$this->module/views/v_list", $data);
    }

    public function add()
    {
        $this->role();
        $data = $this->setting->get_all();
        $_POST = json_decode(file_get_contents('php://input'), true);
        if( $_POST ){
            $this->db->insert( $this->table, $_POST );
            json_response( 'Sukses' );
        }
        $data['nastable'] = true;
        $data['subject'] = $this->subject;
        $data['module'] = $this->module;
        $data['pk'] = $this->primary_key;
        view_back( "rn_$this->module/views/v_add", $data);
    }

    public function edit()
    {
        $this->role();
        $id = $this->uri->segment(4);
        $data = $this->setting->get_all();
        $_POST = json_decode(file_get_contents('php://input'), true);
        if( $_POST ){
            $id = $_POST[$this->primary_key];
            $this->db->where($this->primary_key, $id );
            $this->db->update( $this->table, $_POST );
            json_response( 'Sukses' );
        }

        $this->db->where( $this->primary_key, $id );
        $results = $this->db->get( $this->table, 1 )->row_array();
        $data['nastable'] = true;
        $data['subject'] = $this->subject;
        $data['module'] = $this->module;
        $data['row'] = $results;
        $data['pk'] = $this->primary_key;
        view_back( "rn_$this->module/views/v_edit", $data);
    }

    public function get()
    {
        $this->role();
        $limit = $this->input->get('limit');
        $page = $this->input->get('page');
        $search = $this->input->get('q');
        $column = $this->input->get('col');
        if( !$limit ) $limit=20;

        if( !$page ){
            $page = 0;
        }else{
            $page = ($page-1)*$limit;
        }
        if( isset($search) && $column ){
            $this->db->like($column, $search);
        }
        $data = $this->db->get( $this->table, $limit, $page)->result_array();
        json_response(  $data );
    }

    public function rows()
    {
        $this->role();
        $search = $this->input->get('q');
        $column = $this->input->get('col');
        if( isset($search) && $column ){
            $this->db->like($column, $search);
        }
        $rows = $this->db->count_all_results($this->table);
        json_response( $rows );
    }

    public function delete()
    {
        $this->role();
        $id = $this->uri->segment(4);
        if( $id ){
            $ids = explode('-', $id);
            $this->db->where_in( $this->primary_key, $ids);
            $this->db->delete($this->table);
            json_response( 'Sukses menghapus data' );
        }else{
            json_response( 'Gagal menghapus data, Silahkan ulangi lagi!', 400 );
        }
    }

    public function upload()
    {
        $this->role();
        if( !empty($_FILES) ){
            $config['upload_path']          = 'rn-public/uploads/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 1024;
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('file'))
            {
                json_response( ['status' => 0, 'message' => strip_tags($this->upload->display_errors()) ] );
            } else {
                json_response( $this->upload->data() );
            }
        }else{
            $file_name = $this->uri->segment(4);
            if( $file_name ){
                $souce = FCPATH.'rn-public/uploads/'.$file_name;
                if( file_exists($souce) ) unlink($souce);
            }
            json_response( 'Sukses' );
        }
    }
}
