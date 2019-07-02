<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @property    Rnquery rnquery
 */

class Rn_default {
	public function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->model('M_rn_default');
		$this->CI->load->model('Rnquery');
		$this->CI->lang->load('auth');
	}

	public function _render_page($data=null,$output=null)
	{
		if(is_ajax())
		{
			$this->CI->parser->parse($data['viewspage'],$data);
		}
		else
		{
			$this->CI->parser->parse($this->theme_admin().'header',$data);
			$this->CI->parser->parse($this->theme_admin().'nav',$data);
			$this->CI->parser->parse($data['viewspage'],$data);
			$this->CI->parser->parse($this->theme_admin().'footer',$data);
		}
	}

	public function theme_admin()
	{
		$set_theme=$this->CI->M_rn_default->getSingleSetting('cpanel','default');
		$theme=$set_theme.'/';
		return  $theme;
	}
	public  function asset_admin()
	{
		$set_theme=$this->CI->M_rn_default->getSingleSetting('cpanel','default');
		$theme=THEMES.$set_theme;
		return  $theme;
	}
	public function cekaAuth(){
		if (!$this->ion_auth->logged_in()){
			redirect('auth', 'refresh');
		}
	}
	public function ifLogin(){
		if ($this->ion_auth->logged_in()){
			redirect('rn', 'refresh');
		}
	}

	public function _login_page($data=null,$output=null)
	{
		$this->CI->parser->parse('login',$data);
	}



	public function groups_access_noncrud($role_desc) {
		$data=array();
		if(!$this->CI->ion_auth->is_admin()){
			if(!empty($role_desc)){
				$this->CI->db->where('setting_type','role_type');
				$this->CI->db->where('setting_desc',$role_desc);

				$query = $this->CI->db->get('rn_setting')->result();
				foreach($query as $role){
					$gettermsrole = $this->cekarrayroleuser($role->setting_id);
					if($role->setting_value == 'add'){
						if ($this->CI->ion_auth->in_group($gettermsrole)){
							$data['add_access'] = true;
						}
					}
					if($role->setting_value == 'edit'){
						if ($this->CI->ion_auth->in_group($gettermsrole)){
							$data['edit_access'] = true;
						}
					}
					if($role->setting_value == 'delete'){
						if ($this->CI->ion_auth->in_group($gettermsrole)){
							$data['delete_access'] = true;
						}
					}
					if($role->setting_value == 'print'){
						if ($this->CI->ion_auth->in_group($gettermsrole)){
							$data['print_access'] = true;
						}
					}
					if($role->setting_value == 'export'){
						if ($this->CI->ion_auth->in_group($gettermsrole)){
							$data['export_access'] = true;
						}
					}

				}
			}
		}else {
			$data['edit_access'] = false;
			$data['add_access'] = false;
		}

		return $data;
	}
	public function groups_access_single($role_desc,$settingvalue) {
		$hidden = false;
		if(!$this->CI->ion_auth->is_admin()){
			if(!empty($role_desc)){
				$this->CI->db->where('setting_type','role_type');
				$this->CI->db->where('setting_desc',$role_desc);
				$query = $this->CI->db->get('rn_setting')->result();
				foreach($query as $role){
					$gettermsrole = $this->cekarrayroleuser($role->setting_id);
					if($role->setting_value == $settingvalue){
						if (!$this->CI->ion_auth->in_group($gettermsrole)){
							$hidden = true;
						}
					}
				}
			}
		}else {
			$hidden = false;
		}
		return $hidden;
	}
	public function cekarrayroleuser($idroletype){
		$this->CI->db->select('post_id');
		$this->CI->db->where('terms_type','role');
		$this->CI->db->where('category_id',$idroletype);
		$getrole= $this->CI->db->get('rn_terms')->result();
		$data = array();
		foreach($getrole as $role){
			if(!empty($role->post_id)){
				$data[] = (int)$role->post_id;
			}
		}
		if(!empty($data)){
			return $data;
		}
	}
	public  function  updatestatuslogin($param){
		$data = array(
			'is_login'   => 1,
		);

		$update = $this->CI->ion_auth->update($param, $data);

		return $update;
	}
	public  function  updatestatuslogout($param){
		$data = array(
			'is_login'   => 0,
		);

		$update = $this->CI->ion_auth->update($param, $data);

		return $update;
	}

	public function rn_setting() {
		$where = array(
			'setting_type'  => 'dashboard_setting'
		);

		$dtsetting = $this->CI->db
			->where($where)
			->get(rn_setting)->result_array();

		$where_logo = array(
			'setting_type'  => 'dashboard_logo'
		);

		$dtlogo = $this->CI->db
			->where($where_logo)
			->get(rn_setting)->result_array();

		foreach ($dtsetting as $key => $val) :
			$return[$val['setting_name']] = $val['setting_value'];
		endforeach;

		foreach ($dtlogo as $key => $val) :
			$return[$val['setting_name']] = $val['setting_value'];
		endforeach;

		return $return;
	}

	public function new_notification($post_array,$primary_key,$type)
	{
		$user = $this->CI->ion_auth->user()->row();
		if (!$this->CI->ion_auth->is_admin()) {
			$val = array('type' => $type, 'user' =>  $user->id, 'parent' => $primary_key, 'desc' =>$post_array['description'], 'icon' => $post_array['icon'], 'title' => $post_array['title']);
			$this->CI->M_rn_default->insertnotif($val);
			$admin =$this->CI->ion_auth->users(1)->result();
			foreach ($admin as $valadmin) {
				$val2 = array('type' => $type, 'user' => $valadmin->id, 'parent' => $primary_key, 'desc' => '<i>' . $user->display_name . '</i>'.$post_array['display_name'].'', 'icon' => $post_array['icon'], 'title' => $post_array['title']);
				$this->CI->M_rn_default->insertnotif($val2);
			}

			$user_target=$this->CI->ion_auth->users($primary_key)->result();
			foreach ($user_target as $valtarget) {
				$val3  = array('type' => $type, 'user' => $valtarget->id, 'parent' => $primary_key, 'desc' => '<i>' . $user->display_name . '</i>'.$post_array['display_name'].'', 'icon' => $post_array['icon'], 'title' => $post_array['title']);
				$this->CI->M_rn_default->insertnotif($val3);
			}
		} else {
			$val = array('type' => $type, 'user' => $user->id, 'parent' => $primary_key, 'desc' => $post_array['description'], 'icon' => $post_array['icon'], 'title' => $post_array['title']);
			$this->CI->M_rn_default->insertnotif($val);
		}
		return true;
	}

	public function notificationlist(){
		$user  = $this->CI->ion_auth->user()->row();
		$where = array(
			'notification_user' => $user->id
		);
		$return = $this->CI->Rnquery->getWhere(notification,$where,'','notification_date desc',5)->result();
		return $return;
	}
	public  function  countnotif(){
		$contactnotif=array('table'=>'rn_notification','where'=>array(array('wherefield'=>'notification_status','where_value'=>'active'),array('wherefield'=>'notification_type','where_value'=>'newtask'),array('wherefield'=>'notification_user','where_value'=>$this->CI->ion_auth->user()->row()->id)));


		$thisdata = $this->CI->M_rn_default->countData($contactnotif);

		return $thisdata;
	}

}

