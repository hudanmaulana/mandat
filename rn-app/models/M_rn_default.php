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
class M_rn_default extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}
	public function getSingleSetting($type,$name){
		$where = array(
			'setting_type'    => $type,
			'setting_name'    => $name,
		);
		$query = $this->rnquery->getOne(setting, $where);
		if($query){
			$data=$query->setting_value;
		}else{
			$data='';
		}
		return $data;
	}
	public function cekaAuth(){
		if (!$this->ion_auth->logged_in()){
			redirect('auth', 'refresh');
		}
	}
	public function insertnotif($data=array()){
		$user_notification = array("notification_type" => $data['type'],"notification_user" =>$data['user'],"notification_parent" => $data['parent'],"notification_desc" => $data['desc'].' '.$data['title'].'',"notification_status" => 'active',"notification_icon" => $data['icon'],"notification_date" => date('Y-m-d H:i:s'));
		$this->rnquery->insert(notification, $user_notification);
	}
	public function CountData($param){
		if(array_key_exists('where', $param)){
			for($i=0;$i<count($param['where']);$i++){
				$this->db->where($param['where'][$i]['wherefield'],$param['where'][$i]['where_value']);
			}
		}
		return $this->db->count_all_results($param['table']);
	}
}
