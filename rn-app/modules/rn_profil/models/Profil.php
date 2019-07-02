<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property    Rnquery rnquery
 */
class Profil extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	public  function  get_task($param,$column,$search,$page,$limit,$status,$date,$user,$priority){

		$join = array(
			array(
				'table' =>group_todo,
				'on' => group_todo.'.id='.task_todo.'.id_group_todo'
			),
			array(
				'table' =>member_todo,
				'on' => member_todo.'.id_task_todo='.task_todo.'.id'
			),
			array(
				'table'=>rn_user,
				'on'=>rn_user.'.id='.group_todo.'.id_user'
			)
		);
		$where = array (
			member_todo.'.id_user' => $param
		);
//		$this->db->select('rn_task_todo.*');
		if( $search && $column ){
			foreach ($column as $key => $value) {
				$this->db->or_like($value, $search);
			}
		}
		if( !$limit ) $limit=20;

		if( !$page ){
			$page = 0;
		}else{
			$page = ($page-1)*$limit;
		}
		if( $status ){
			if( $status == 'completed' ){
				$this->db->having('rn_member_todo.status', 'completed');
			}else if ( $status == 'uncompleted' ) {
				$this->db->having('rn_member_todo.status', 'uncompleted');
			}else if ( $status == 'waiting' ) {
				$this->db->having('rn_member_todo.status', 'waiting');
			}
		}
		if($priority){
			if($priority=='high'){
				$this->db->having('rn_task_todo.priority', 'high');
			} else if ($priority=='normal'){
				$this->db->having('rn_task_todo.priority', 'normal');
			}else if ($priority=='urgent'){
				$this->db->having('rn_task_todo.priority', 'urgent');
			}
		}
		if($user){
				$this->db->where('rn_group_todo.id_user', $user);
		}
		if($date){
			foreach ($date as $value) {
				$this->db->or_where('rn_task_todo.duedate',$value);
			}
		}

		$this->db->select('rn_member_todo.id,rn_task_todo.title,rn_task_todo.description,rn_task_todo.priority,rn_task_todo.duedate, rn_member_todo.status,rn_users.display_name ');
		return $this->rnquery->getJoin(task_todo,$join,$where,'','',$limit,$page)->result_array();
	}
	public function  get_filter_user($param){
	$join = array(
		array(
			'table' =>group_todo,
			'on' => group_todo.'.id='.task_todo.'.id_group_todo'
		),
		array(
			'table' =>member_todo,
			'on' => member_todo.'.id_task_todo='.task_todo.'.id'
		),
		array(
			'table'=>rn_user,
			'on'=>rn_user.'.id='.group_todo.'.id_user'
		)
	);
	$where = array (
		member_todo.'.id_user' => $param
	);
	$this->db->select('rn_users.id,rn_users.display_name ');
	return $this->rnquery->getJoin(task_todo,$join,$where)->result_array();

}
	public  function  get_rowtask($param,$status,$date,$user,$priority){

		$join = array(
			array(
				'table' =>group_todo,
				'on' => group_todo.'.id='.task_todo.'.id_group_todo'
			),
			array(
				'table' =>member_todo,
				'on' => member_todo.'.id_task_todo='.task_todo.'.id'
			),
			array(
				'table'=>rn_user,
				'on'=>rn_user.'.id='.group_todo.'.id_user'
			)
		);
		$where = array (
			member_todo.'.id_user' => $param
		);
		if( $status ){
			if( $status == 'completed' ){
				$this->db->having('rn_member_todo.status', 'completed');
			}else if ( $status == 'uncompleted' ) {
				$this->db->having('rn_member_todo.status', 'uncompleted');
			}else if ( $status == 'waiting' ) {
				$this->db->having('rn_member_todo.status', 'waiting');
			}
		}
		if($priority){
			if($priority=='high'){
				$this->db->having('rn_task_todo.priority', 'high');
			} else if ($priority=='normal'){
				$this->db->having('rn_task_todo.priority', 'normal');
			}else if ($priority=='urgent'){
				$this->db->having('rn_task_todo.priority', 'urgent');
			}
		}
		if($user){
			$this->db->where('rn_group_todo.id_user', $user);
		}
		if($date){
			foreach ($date as $value) {
				$this->db->or_where('rn_task_todo.duedate',$value);
			}
		}

		$this->db->select('rn_task_todo.title,rn_task_todo.description,rn_task_todo.priority,rn_task_todo.duedate, rn_member_todo.status,rn_users.display_name ');
		return $this->rnquery->getJoin(task_todo,$join,$where)->result_array();
	}
	public function  get_counttask($param,$status){

		$join = array(
			array(
				'table' =>group_todo,
				'on' => group_todo.'.id='.task_todo.'.id_group_todo'
			),
			array(
				'table' =>member_todo,
				'on' => member_todo.'.id_task_todo='.task_todo.'.id'
			),
			array(
				'table'=>rn_user,
				'on'=>rn_user.'.id='.group_todo.'.id_user'
			)
		);
		$where = array (
			member_todo.'.id_user' => $param
		);
		if( $status ){
			if( $status == 'completed' ){
				$this->db->having('rn_member_todo.status', 'completed');
			}else if ( $status == 'uncompleted' ) {
				$this->db->having('rn_member_todo.status', 'uncompleted');
			}else if ( $status == 'waiting' ) {
				$this->db->having('rn_member_todo.status', 'waiting');
			}
		}
		$this->db->select('rn_member_todo.status');
		return $this->rnquery->getJoin(task_todo,$join,$where)->result_array();
	}
	public  function  get_data_edit($param){
		$where = array(
			'id' =>$param
		);
		return $this->rnquery->getWhere(member_todo,$where)->row();
	}
	public  function get_data_join_todo($param,$table){
		$join = array(
			array(
				'table'=> rn_user,
				'on' => rn_user.'.id = '.$table.'.id_user'
			)
		);
		$where = array(
			'id_task_todo'  => $param
		);
		if($table==member_todo){
			$this->db->select('rn_member_todo.id_user,rn_member_todo.id_task_todo,rn_users.avatar,rn_users.display_name');
		}
		$return = $this->rnquery->getJoin($table,$join,$where)->result_array();
		return $return;
	}
}
