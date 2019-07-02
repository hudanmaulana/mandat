<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property    M_rn_default M_rn_default
 * @property    rn_default rn_default
 *
 */
class Rn_welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		tes_data(list_modules());
		$data['asset'] = $this->rn_default->asset_admin();
		$data['viewspage'] = 'index';
		$this->rn_default->_render_page($data);
		$this->load->model('models');

	}
}
