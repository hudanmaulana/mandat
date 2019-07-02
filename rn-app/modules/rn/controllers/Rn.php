<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property    M_rn_default M_rn_default
 * @property    rn_default rn_default
 *
 */
class Rn extends CI_Controller {

	function __construct()
	{
		parent::__construct();
        $this->M_rn_default->cekaAuth();

		$this->load->library('mahana_hierarchy');
	}
	protected function get_name_group_children(){
		$user = $this->ion_auth->user()->row();
		$userid=$user->id;
		$groups  = $this->ion_auth->get_users_groups($userid)->row();
		$grouped_result =$this->mahana_hierarchy->get_descendents($groups->id);
		return count($grouped_result);
	}
	//redirect if needed, otherwise display the user list
	public function index()
	{
	    $avatar = $this->ion_auth->user()->row()->avatar;

	    $data = array(
	        'avatar'    => @$avatar ?: 'avatar.png'
        );
		$dtterms = $this->get_name_group_children();
		if($dtterms==0 && !$this->ion_auth->is_admin()) {
			redirect(BASE_URL.'rn/profil');
		}
		$wherereject = array(
			'status'=>'reject'
		);
		$whereterupload = array(
			'status'=>'terupload'
		);
		$whereterkirim = array(
			'status'=>'terkirim'
		);
		$whereproses_fidusia = array(
			'status'=>'proses_fidusia'
		);
		$whereterdaftar = array(
			'status'=>'proses_terdaftar'
		);
		$wherediterima = array(
			'status'=>'diterima'
		);


		$returnreject = $this->rnquery->getwhere(dataFidusia,$wherereject)->result_array();
		$returterupload = $this->rnquery->getwhere(dataFidusia,$whereterupload)->result_array();
		$returnterkirim = $this->rnquery->getwhere(dataFidusia,$whereterkirim)->result_array();
		$returproses_fidusia  = $this->rnquery->getwhere(dataFidusia,$whereproses_fidusia )->result_array();
		$returnrdaftar  = $this->rnquery->getwhere(dataFidusia,$whereterdaftar)->result_array();
		$returnditerima = $this->rnquery->getwhere(dataFidusia,$wherediterima)->result_array();


		$data ['reject'] =  count($returnreject);
		$data ['upload'] = count($returterupload);
		$data ['kirim'] = count($returnterkirim);
		$data ['proses'] = count($returproses_fidusia);
		$data ['daftar'] = count($returnrdaftar);
		$data ['terima'] = count($returnditerima);

	    $data['setting'] = $this->rn_default->rn_setting();
        $data['title'] = 'Dashboard | Manajemen Data';
	    $data['url'] = BASE_URL;
	    $data['upload_dir'] = UPLOAD_DIR;
		$data['asset'] = $this->rn_default->asset_admin();
		$data['viewspage'] = 'index';
		$this->rn_default->_render_page($data);
	}

}
