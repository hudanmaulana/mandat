<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud extends CI_Model {

	function __construct()
    {
        parent::__construct();
    }

    function get_data($order = null, $limit = null, $offset = 0, $columns = null, $search = null)
    {
        if($columns != null){
            foreach ($columns as $key => $value) {
                $this->db->or_like($value, $search);
            }
        }
        $this->db->where('tipe', '3');
        $return = $this->rnquery->getAll(account, null, $order, $limit, $offset);

        return $return;
    }

    function pd($id = null)
    {
        if($id)
            $this->db->where('kode', $id);
        $return = $this->rnquery->getAll(skpd);

        return $return;
    }

    function program($id = null)
    {
        $where = array(
            'tipe'  => '2'
        );
        if($id)
            $this->db->where('parent', $id);
        $return = $this->rnquery->getWhere(account, $where);

        return $return;
    }

    function get_program($id)
    {
        $where = array(
            'kode'    => $id
        );
        $return = $this->rnquery->getOne(account, $where);
        
        return $return;
    }

    function edit_data($id)
    {
        $where = array(
            'kode'    => $id
        );
        $return = $this->rnquery->getOne(account, $where);

        return $return;
    }

    function remove_program($id)
    {
        $this->rnquery->delete(account, array('kode' => $id));
    }

    function remove_space($str)
    {
        $str = str_replace('  .', '.', $str);
        $str = str_replace(' .', '.', $str);
        $str = str_replace('. ', '.', $str);
        $str = str_replace('.  ', '.', $str);
        $str = str_replace(' . ', '.', $str);
        $str = str_replace('  .  ', '.', $str);

        return $str;
    }
}
