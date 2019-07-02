<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| area
*/
if ( ! function_exists('area'))
{
	function area($table = null)
	{
		$ci = get_instance();
		$user = $ci->ion_auth->user()->row();
		$user_groups = $ci->ion_auth->get_users_groups($user->id)->result();

		$groups = [];
		foreach ($user_groups as $value) {
			$groups[] = $value->id;
		}

		$ci->db->select('area_id');
		$dtarea = $ci->rnquery->getAll(cabang)->result();

		$areas = [];
		foreach($dtarea as $value) {
			$areas[] = $value->area_id;
		}

		if($table)
			$table = $table.'.';

		if(in_array("1", $groups))
			$area = $ci->db->where_in($table.'area_id', $areas);
		else
			$area = $ci->db->where_in($table.'area_id', $user->area_id);

		return $area;
	}

	function user_area()
	{
		$ci = get_instance();
		$user = $ci->ion_auth->user()->row();

		return $user->area_id;
	}

	function user()
	{
		$ci = get_instance();
		$user = $ci->ion_auth->user()->row();

		return $user->id;
	}
}
