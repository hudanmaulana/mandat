<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Rn_crud extends CI_Controller {

    private $rules = array(
        array('field'=> 'first_name', 'label' => 'First Name', 'rules' => 'required'),
        array('field'=> 'last_name', 'label' => 'Last Name', 'rules' => 'required'),
        array('field'=> 'gender', 'label' => 'Gender', 'rules' => 'required'),
        array('field'=> 'email', 'label' => 'Email', 'rules' => 'required'),
        array('field'=> 'description', 'label' => 'Description', 'rules' => 'required')
        );

    protected $tables = 'rn_setting';
    protected $subject = 'Role Module';
    protected $module;

    function __construct()
	{
		parent::__construct();

		define('heading', 'CRUD');
		define('uriClass', 'rn/crud');

        $this->module = str_replace('rn_', '', strtolower( get_class($this) ) );
        $this->load->model('crud');
        $this->columns = array(
            1 => 'kode', 'uraian'
        );
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


    /*
    |	READ
    */
	function index()
	{
//		foreach ($this->columns as $value) {
//			$columns[] = array(
//				'title'	=> ucwords(str_replace("_", " ", $value))
//            );
//		}
//
//		$this->data = array(
//			'columns' 			=> $columns
//        );
//
//		$this->data['page_heading'] = heading;
//		$this->data['url'] 			= BASE_URL.uriClass;

//        $this->data['asset'] = $this->rn_default->asset_admin();
//        $this->data['viewspage'] = 'index';
//        $this->rn_default->_render_page($this->data);

        $this->role();
        $data = $this->rn_setting->get_all();
        $data['action'] 		= BASE_URL.'rn_'.$this->module.'/add';
        $data['asset'] = $this->rn_default->asset_admin();
//        array_print($data['asset']);
        $data['subject'] = $this->subject;
        $data['module'] = $this->module;

        $data['pk'] = $this->get_primary_key()->name;

        blade_back( "rn_$this->module/views/v_index",$data);
    }

	function api()
	{
		$columns = $this->columns;

        $order = isset($_POST['order']) ? $columns[$_POST['order'][0]['column']].' '.$_POST['order'][0]['dir'] : null;
		$limit = $_POST['length'];
		$offset = $_POST['start'];
		$search = $_POST['search']['value'];

		$recordsTotal = $recordsFiltered = $this->crud->get_data()->num_rows();
		if(@$search){
			$query = $this->crud->get_data($order, $limit, $offset, $columns, $search);
			$recordsFiltered = $query->num_rows();
			$dtresult = $query->result();
		}
		else{
			$query = $this->crud->get_data($order, $limit, $offset);
			$dtresult = $query->result();
		}

		$data = array();
		foreach ($dtresult as $key => $value) {
			$result = array();
            $result[] = $key + 1;
			foreach ($columns as $column) {
                if($column == 'paguforum' OR $column == 'pagumusrenbang')
                    $result[] = number_format($value->{$column});
                else
                    $result[] = $value->{$column};
			}
            $btn = array(
                array(
                    'url'   => BASE_URL.uriClass.'/edit?id='.$value->kode,
                    'text'  => 'Edit'
                ),
                array(
                    'url'   => BASE_URL.uriClass.'/delete?id='.$value->kode,
                    'text'  => 'Delete',
                    'msg'   => 'Apakah anda yakin!'
                )
            );
			$result[] = btndrop($btn);

			$data[] = $result;
		}

		$json_data = array(
			"draw"            => intval($_POST['draw']),
			"recordsTotal"    => intval($recordsTotal),
			"recordsFiltered" => intval($recordsFiltered),
			"data"            => $data
			);
		echo json_encode($json_data);
	}

	/*
	|	CREATE
	*/
	function add()
	{
        $this->data = array(
            'first_name'            => '',
            'last_name'             => '',
            'gender'                => '',
            'email'                 => '',
            'description'           => '',
        );

		$this->data['page_heading'] = heading;
		$this->data['url'] 			= BASE_URL.uriClass;
		$this->data['action'] 		= BASE_URL.uriClass.'/add_save';

        $this->data['asset'] = $this->rn_default->asset_admin();
        $this->data['viewspage'] = 'form';
        $this->rn_default->_render_page($this->data);
	}

	function add_save()
	{
		$this->form_validation->set_rules($this->rules);

		if($this->form_validation->run() == TRUE){
            $first_name = $this->input->post('first_name', TRUE);
            $last_name = $this->input->post('last_name', TRUE);
            $gender = $this->input->post('gender', TRUE);
            $email = $this->input->post('email', TRUE);
            $description = $this->input->post('description', TRUE);

            $data = array(
                'first_name'    => $first_name,
                'last_name'     => $last_name,
                'gender'        => $gender,
                'email'         => $email,
                'description'   => $description
                );

            $act_insert = $this->rnquery->insert(crud, $data);
			
			echo json_encode(
				array(
					'status'	=> 'sukses',
					'message'	=> 'Data '.heading.' berhasil di simpan'
				)
			);
		}
		else{
			$errors = array(
				'message' => $this->form_validation->error_array()
			);
			echo json_encode($errors);
		}
	}

	/*
	|	UPDATE
	*/
	function edit()
	{
		$id = $this->input->get('id');

        $dtkegiatan = $this->crud->edit_data($id);
        $curprogram = $this->crud->get_program($dtkegiatan->parent);
        $curpd = $this->crud->pd($curprogram->parent)->row();

        $dtpd = $this->crud->pd()->result();
        foreach ($dtpd as $key => $value) {
            $pd[] = [
                'key'       => $value->kode,
                'value'     => $value->kode.' - '.$value->nama_skpd,
                'selected'  => ($value->kode == $curpd->kode) ? "selected" : ""
            ];
        }

        $dtprogram = $this->crud->program()->result();
        //array_print($dtprogram);
        $program = array();
        foreach ($dtprogram as $key => $value) {
            $program[] = [
                'key'       => $value->kode,
                'value'     => $value->kode.' - '.$value->uraian,
                'selected'  => ($value->kode == $curprogram->kode) ? "selected" : ""
            ];
        }

        $this->data = [
            'tahun'             => $dtkegiatan->tahun,
            'pd'                => $pd,
            'parent'            => $program,
            'kode'              => $dtkegiatan->kode,
            'uraian'            => $dtkegiatan->uraian,
            'style_hidden'      => 'display: none'
        ];

		$this->data['page_heading'] = heading;
		$this->data['url'] 			= BASE_URL.uriClass;
		$this->data['action'] 		= BASE_URL.uriClass.'/edit_save';
		
		$this->template->view('form', $this->data);
	}

	function edit_save()
	{
		$this->form_validation->set_rules($this->edit_rules);

		if($this->form_validation->run() == TRUE){
            $oldkode = $this->input->post('oldkode', TRUE);
            $tahun = $this->input->post('tahun', TRUE);
            $parent = $this->input->post('parent', TRUE);
            $kode = $this->input->post('kode', TRUE);
            $uraian = $this->input->post('uraian', TRUE);

            $data = array(
                'kode'              => $kode,
                'parent'            => $parent,
                'tahun'             => $tahun,
                'uraian'            => $uraian
                );
            $this->rnquery->update(account, $data, array('kode' => $oldkode));

			echo json_encode(
				array(
					'status'	=> 'sukses',
					'message'	=> 'Data '.heading.' berhasil di perbaruhi'
				)
			);
		}
		else{
			$errors = array(
				'message' => $this->form_validation->error_array()
			);
			echo json_encode($errors);
		}
	}

	/*
	|	DELETE
	*/
    function delete()
    {
        $id = $this->input->get('id', TRUE);
        $this->crud->remove_program($id);

        redirect(BASE_URL.uriClass);
    }

    /*
 * IMPORT
 * */

    function import_save()
    {
//        $periode = $this->input->post('periode', TRUE);

        $config['upload_path']   = './'.UPLOAD_PATH.'temp/';
        $config['allowed_types'] = 'xls|xlsx';
        $config['file_name']     = 'data-crud-'.md5(date('YmdHis'));

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        $files = @$_FILES['notification']['type'];

        if (!$this->upload->do_upload('notification')):
            $errors = array(
                'message' => array(
                    'error' => '<p class="white-text">'.$this->upload->display_errors().'</p>'
                )
            );
            echo json_encode($errors);
        /*elseif (strpos($files, 'xls') === FALSE):
            $errors = array(
                'message' => array(
                    'error' => '<p class="white-text">The filetype you are attempting to upload is not allowed.</p>'
                )
            );
            echo json_encode($errors);*/
        else:
            $upload_data = $this->upload->data();
            $file =  $upload_data['full_path'];;

            // excel reader
            $this->load->library('excel_reader/excel_reader');
            $this->excel_reader->setOutputEncoding('CP1251');
            $this->excel_reader->read($file);
            error_reporting(E_ALL ^ E_NOTICE);

            $data   = $this->excel_reader->sheets[0];
            $baris  = $data['numRows'];
            $kolom  = $data['numCols'];
            $upload = 0;

            for($b = 1; $b <= $baris; $b++){
                $upload++;
                $kode           = explode('.',$data['cells'][$b][1]); // A
                $urusan1        = $data['cells'][$b][2]; // B
                $urusan2        = $data['cells'][$b][3]; // C
                $pd             = $data['cells'][$b][4]; // D
                $program        = $data['cells'][$b][5]; // E
                $kegiatan       = $data['cells'][$b][6]; // F

                if (count($kode) == 6) :
                    $parent = $kode;
                endif;

                if (count($kode) == 7) :
                    $data_excel[] = [
                        'kode'          => $this->crud->remove_space($kode[0].'.'.$kode[1].'.'.$kode[2].'.'.$kode[3].'.'.$kode[4].'.'.$kode[5].'.'.$kode[6]),
                        'uraian'        => $kegiatan,
                        'parent'        => $this->crud->remove_space($parent[0].'.'.$parent[1].'.'.$parent[2].'.'.$parent[3].'.'.$parent[4].'.'.$parent[5]),
                        'tipe'          => '3',
                    ];
                endif;
            }

//            array_print($data_excel);

            $dir = './'.UPLOAD_PATH.'temp/';
            foreach(glob($dir.'data-crud*.xls') as $v){
                unlink($v);
            }

            if($data_excel)
                $this->rnquery->insert_batch(account, $data_excel);

            echo json_encode(
                array(
                    'status'    => 'sukses',
                    'message'   => 'Data '.heading.' berhasil di simpan'
                )
            );
        endif;
    }
}
