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
class Rn_dataacc extends CI_Controller {

	protected $tables = 'dataFidusia';
	protected $subject = 'Acc Fidusia';
	protected $module;
	protected $primary_key = 'id';

    private $rules = array(
        array('field'=> 'no_kontrak', 'label' => 'No. Kontrak', 'rules' => 'required'),

    );

    public function __construct()
	{
		parent::__construct();
		$this->module = str_replace('rn_', '', strtolower( get_class($this) ) );
		$this->load->model('userModel');
		$this->load->model('dataacc');
		$this->load->library('mahana_hierarchy');
		$this->columns = array(
			dataFidusia.'.no_kontrak',
		);
		define('uriClass','rn/dataacc');
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

		blade_back( "rn_$this->module/views/v_list",$data);
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

        $data = $this->dataacc->getDataAll();

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
			'no_kontrak' => '',
			'ketegori_fidusia' => '',
			'jenis_fidusia' => '',
			'jk_pemberiFidusia' =>'' ,
			'jenis_penggunaa' => '',
			'nama_pemberi' => '',
			'nik_pemberi' => '',
			'telp_pemberi' => '',
			'pos_pemberi' => '',
			'prov_pemberi' =>'',
			'kab_pemberi' => '',
			'kec_pemberi' => '',
			'kel_pemberi' => '',
			'rt_pemberi' => '',
			'rw_pemberi' => '',
			'nama_debitur' => '',
			'kategori_penerimaFidusia' => '',
			'subKategori_penerima' => '',
			'nama_penerima' => '',
			'npwp_penerima' => '',
			'telp_penerima' => '',
			'pos_penerima' => '',
			'prov_penerima' => '',
			'kab_penerima' => '',
			'kec_penerima' => '',
			'kel_penerima' => '',
			'rt_penerima' => '',
			'rw_penerima' => '',
			'nomor_akta' => '',
			'tgl_akta' => '',
			'nama_notaris' => '',
			'kedudukan_notaris' => '',
			'nilai_penjaminFidusia' => '',
			'waktu_perjanjianAwal' => '',
			'waktu_perjanjianAhir' => '',
			'kategori_objek' => '',
			'merk_objek' => '',
			'tipe_objek' => '',
			'no_rangka' => '',
			'no_mesin' => '',
			'nilai_objek' => '',
			'nilai_penjamin' => '',
			'alamat_pemberi' => '',
			'alamat_penerima' => '',
			'isi_perjanjian' => '',
			'berdasarkan' => '',
			'jumlah_roda' => '',
			'bukti_objek' => '',
        );

        /* START POST*/
        $_POST = json_decode(file_get_contents('php://input'), true);
        if( $_POST ) {
            $this->form_validation->set_rules($this->rules);
            if ($this->form_validation->run() == TRUE) {

                $actInsert = $this->db->insert(dataFidusia, $_POST);

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
        $dtGroups_single = $this->dataacc->getDataById($id);
        /* END DATA EDIT */

        $data = array(
			'no_kontrak' => $dtGroups_single['no_kontrak'],
			'ketegori_fidusia' => $dtGroups_single['ketegori_fidusia'],
			'jenis_fidusia' => $dtGroups_single['jenis_fidusia'],
			'jk_pemberiFidusia' => $dtGroups_single['jk_pemberiFidusia'],
			'jenis_penggunaa' => $dtGroups_single['jenis_penggunaa'],
			'nama_pemberi' => $dtGroups_single['nama_pemberi'],
			'nik_pemberi' => $dtGroups_single['nik_pemberi'],
			'telp_pemberi' => $dtGroups_single['telp_pemberi'],
			'pos_pemberi' => $dtGroups_single['pos_pemberi'],
			'prov_pemberi' => $dtGroups_single['prov_pemberi'],
			'kab_pemberi' => $dtGroups_single['kab_pemberi'],
			'kec_pemberi' => $dtGroups_single['kec_pemberi'],
			'kel_pemberi' => $dtGroups_single['kel_pemberi'],
			'rt_pemberi' => $dtGroups_single['rt_pemberi'],
			'rw_pemberi' => $dtGroups_single['rw_pemberi'],
			'nama_debitur' => $dtGroups_single['nama_debitur'],
			'kategori_penerimaFidusia' => $dtGroups_single['kategori_penerimaFidusia'],
			'subKategori_penerima' => $dtGroups_single['subKategori_penerima'],
			'nama_penerima' => $dtGroups_single['nama_penerima'],
			'npwp_penerima' => $dtGroups_single['npwp_penerima'],
			'telp_penerima' => $dtGroups_single['telp_penerima'],
			'pos_penerima' => $dtGroups_single['pos_penerima'],
			'prov_penerima' => $dtGroups_single['prov_penerima'],
			'kab_penerima' => $dtGroups_single['kab_penerima'],
			'kec_penerima' => $dtGroups_single['kec_penerima'],
			'kel_penerima' => $dtGroups_single['kel_penerima'],
			'rt_penerima' => $dtGroups_single['rt_penerima'],
			'rw_penerima' => $dtGroups_single['rw_penerima'],
			'nomor_akta' => $dtGroups_single['nomor_akta'],
			'tgl_akta' => $dtGroups_single['tgl_akta'],
			'nama_notaris' => $dtGroups_single['nama_notaris'],
			'kedudukan_notaris' => $dtGroups_single['kedudukan_notaris'],
			'nilai_penjaminFidusia' => $dtGroups_single['nilai_penjaminFidusia'],
			'waktu_perjanjianAwal' => $dtGroups_single['waktu_perjanjianAwal'],
			'waktu_perjanjianAhir' => $dtGroups_single['waktu_perjanjianAhir'],
			'kategori_objek' => $dtGroups_single['kategori_objek'],
			'merk_objek' => $dtGroups_single['merk_objek'],
			'tipe_objek' => $dtGroups_single['tipe_objek'],
			'no_rangka' => $dtGroups_single['no_rangka'],
			'no_mesin' => $dtGroups_single['no_mesin'],
			'nilai_objek' => $dtGroups_single['nilai_objek'],
			'nilai_penjamin' => $dtGroups_single['nilai_penjamin'],
			'alamat_pemberi' => $dtGroups_single['alamat_pemberi'],
			'alamat_penerima' => $dtGroups_single['alamat_penerima'],
			'isi_perjanjian' => $dtGroups_single['isi_perjanjian'],
			'berdasarkan' => $dtGroups_single['berdasarkan'],
			'jumlah_roda' => $dtGroups_single['jumlah_roda'],
			'bukti_objek' => $dtGroups_single['bukti_objek'],
        );

        /* START POST */
        $_POST = json_decode(file_get_contents('php://input'), true);
        if( $_POST ) {
            $this->form_validation->set_rules($this->rules);
            if ($this->form_validation->run() == TRUE) {
                $id     = $_POST['no_dataFidusia'];
                unset(
                    $_POST['no_dataFidusia']
                );

                $act_update = $this->db
                    ->set($_POST)
                    ->where('no_dataFidusia', $id)
                    ->update(dataFidusia);

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
		$data['roles']  = $this->rn_setting->roles();
		$data['selected_roles'] = $this->userModel->roleByGroupId($id);

		blade_back( "rn_$this->module/views/v_form",$data);
	}

	public  function priview(){
		$this->role();
		$id = $this->uri->segment(4);

		/* START DATA EDIT */
		$dtGroups_single = $this->dataacc->getDataById($id);
		/* END DATA EDIT */

		$data = array(
			'no_kontrak' => $dtGroups_single['no_kontrak'],
			'ketegori_fidusia' => $dtGroups_single['ketegori_fidusia'],
			'jenis_fidusia' => $dtGroups_single['jenis_fidusia'],
			'jk_pemberiFidusia' => $dtGroups_single['jk_pemberiFidusia'],
			'jenis_penggunaa' => $dtGroups_single['jenis_penggunaa'],
			'nama_pemberi' => $dtGroups_single['nama_pemberi'],
			'nik_pemberi' => $dtGroups_single['nik_pemberi'],
			'telp_pemberi' => $dtGroups_single['telp_pemberi'],
			'pos_pemberi' => $dtGroups_single['pos_pemberi'],
			'prov_pemberi' => $dtGroups_single['prov_pemberi'],
			'kab_pemberi' => $dtGroups_single['kab_pemberi'],
			'kec_pemberi' => $dtGroups_single['kec_pemberi'],
			'kel_pemberi' => $dtGroups_single['kel_pemberi'],
			'rt_pemberi' => $dtGroups_single['rt_pemberi'],
			'rw_pemberi' => $dtGroups_single['rw_pemberi'],
			'nama_debitur' => $dtGroups_single['nama_debitur'],
			'kategori_penerimaFidusia' => $dtGroups_single['kategori_penerimaFidusia'],
			'subKategori_penerima' => $dtGroups_single['subKategori_penerima'],
			'nama_penerima' => $dtGroups_single['nama_penerima'],
			'npwp_penerima' => $dtGroups_single['npwp_penerima'],
			'telp_penerima' => $dtGroups_single['telp_penerima'],
			'pos_penerima' => $dtGroups_single['pos_penerima'],
			'prov_penerima' => $dtGroups_single['prov_penerima'],
			'kab_penerima' => $dtGroups_single['kab_penerima'],
			'kec_penerima' => $dtGroups_single['kec_penerima'],
			'kel_penerima' => $dtGroups_single['kel_penerima'],
			'rt_penerima' => $dtGroups_single['rt_penerima'],
			'rw_penerima' => $dtGroups_single['rw_penerima'],
			'nomor_akta' => $dtGroups_single['nomor_akta'],
			'tgl_akta' => $dtGroups_single['tgl_akta'],
			'nama_notaris' => $dtGroups_single['nama_notaris'],
			'kedudukan_notaris' => $dtGroups_single['kedudukan_notaris'],
			'nilai_penjaminFidusia' => $dtGroups_single['nilai_penjaminFidusia'],
			'waktu_perjanjianAwal' => $dtGroups_single['waktu_perjanjianAwal'],
			'waktu_perjanjianAhir' => $dtGroups_single['waktu_perjanjianAhir'],
			'kategori_objek' => $dtGroups_single['kategori_objek'],
			'merk_objek' => $dtGroups_single['merk_objek'],
			'tipe_objek' => $dtGroups_single['tipe_objek'],
			'no_rangka' => $dtGroups_single['no_rangka'],
			'no_mesin' => $dtGroups_single['no_mesin'],
			'nilai_objek' => $dtGroups_single['nilai_objek'],
			'nilai_penjamin' => $dtGroups_single['nilai_penjamin'],
			'alamat_pemberi' => $dtGroups_single['alamat_pemberi'],
			'alamat_penerima' => $dtGroups_single['alamat_penerima'],
			'isi_perjanjian' => $dtGroups_single['isi_perjanjian'],
			'berdasarkan' => $dtGroups_single['berdasarkan'],
			'jumlah_roda' => $dtGroups_single['jumlah_roda'],
			'bukti_objek' => $dtGroups_single['bukti_objek'],
		);

		/* START POST */
		$_POST = json_decode(file_get_contents('php://input'), true);
		if( $_POST ) {
			$this->form_validation->set_rules($this->rules);
			if ($this->form_validation->run() == TRUE) {
				$id     = $_POST['no_dataFidusia'];
				unset(
					$_POST['no_dataFidusia']
				);

				$act_update = $this->db
					->set($_POST)
					->where('no_dataFidusia', $id)
					->update(dataFidusia);

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

		$data['title']      = 'Priview';
		$data['action'] = 'priview';
		$data['asset'] = $this->rn_default->asset_admin();
		$data['subject'] = $this->subject;
		$data['module'] = $this->module;
		$data['ismodul'] = true;
		$data['pk'] = $this->primary_key;


		blade_back( "rn_$this->module/views/v_priview",$data);
	}
	/* DELETE */
	public function delete()
	{
		$this->role();
		$alias = $this->uri->segment(4);

		if( $alias ) {
            $where = array(
                'no_dataFidusia' => $alias
            );

            $actDelete = $this->db->delete(dataFidusia, $where);

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
}
