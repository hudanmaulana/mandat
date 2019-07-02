<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perm {
    public function auth($menu = null)
    {
        $CI =& get_instance();
        $ion = $CI->config->item('tables', 'ion_auth');

        $user = $CI->ion_auth->user()->row();
        $groups = $CI->ion_auth->get_users_groups($user->id)->result();
        foreach ($groups as $key => $value) {
            $group[] = $value->id;
        }

        $CI->db->where_in('id', $group);
        $CI->db->where('module', $menu);
        $auth = $CI->db->get($ion['perm'])->row();

        if(!$CI->ion_auth->logged_in()){
            redirect(base_url().'cms');
        }
        elseif($menu != null AND count($auth) == 0){
            redirect(base_url().'cms');
        }
    }
}
