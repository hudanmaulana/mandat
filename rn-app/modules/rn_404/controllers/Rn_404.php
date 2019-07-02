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
 */
class Rn_404 extends CI_Controller
{
	public function index(){
		$data['asset'] = $this->rn_default->asset_admin();
		$this->parser->parse('index',$data);

}
}
