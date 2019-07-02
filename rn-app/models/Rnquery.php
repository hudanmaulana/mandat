<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rnquery extends CI_Model {

	function __construct()
    {
        parent::__construct();

        $this->user_id = $this->session->userdata('ses_admin_id');
    }

/* CREATE
    */
    function insert($table, $data)
    {
    	$insert = $this->db->insert($table, $data);
        if($insert == TRUE):
            $_id = $this->db->insert_id();
            /*$data = array(
                'user_id'   => $this->user_id,
                'table'     => $table,
                'table_id'  => $_id,
                'status'    => 'c',
                );
            $this->db->insert(log, $data);*/

            return $_id;
        else:
            return FALSE;
        endif;
    }

    function insert_batch($table, $array_data)
    {
        $insert = $this->db->insert_batch($table, $array_data);

        return TRUE;
    }

/* READ
    */
    function getOne($table, $where = null, $select = null)
    {
        if($select)
            $this->db->select($select);
        if($where)
            $this->db->where($where);
        $get = $this->db->get($table)->row();

        return $get;
    }

    function getAll($table, $group_by=null, $order_by=null, $limit=null, $offset=0)
    {
        if($group_by != null)
            $this->db->group_by($group_by);
        if(($order_by) != null)
            $this->db->order_by($order_by);
        if($limit != null)
            $this->db->limit($limit, $offset);
        $get = $this->db->get($table);

        return $get;
    }

    function getWhere($table, $where, $group_by=null, $order_by=null, $limit=null, $offset=null)
    {
        $this->db->where($where);
        if($group_by != null)
            $this->db->group_by($group_by);
        if($order_by != null)
            $this->db->order_by($order_by);
        if($limit != null)
            $this->db->limit($limit,$offset);
        $get = $this->db->get($table);

        return $get;
    }

    function getJoin($table, $join, $where=null, $group_by=null, $order_by=null, $limit=null, $offset=0)
    {
        if(count($join) > 0):
            foreach ($join as $value) {
                $this->db->join($value['table'], $value['on'], isset($value['type']) ? $value['type'] : '');
            }
        endif;
        if($where != null)
            $this->db->where($where);
        if($group_by != null)
            $this->db->group_by($group_by);
        if($order_by != null)
            $this->db->order_by($order_by);
        if($limit != null)
            $this->db->limit($limit, $offset);
        $get = $this->db->get($table);
        
        return $get;
    }
    function getLike($table, $match, $join=null, $where=null, $group_by=null, $order_by=null, $limit=null, $offset=0)
    {
        $i=0;
        foreach ($match as $key => $value) {
            if(!empty($value)):
                if($i == 0)
                    $this->db->like($key, $value, 'both');
                else
                    $this->db->or_like($key, $value, 'both');
            endif;
            $i++;
        }
        if(count($join) > 0):
            foreach ($join as $value) {
                $this->db->join($value['table'], $value['on'], isset($value['type']) ? $value['type'] : '');
            }
        endif;
            
        if($where != null)
            $this->db->where($where);
        if($group_by != null)
            $this->db->group_by($group_by);
        if($order_by != null)
            $this->db->order_by($order_by);
        if($limit != null)
            $this->db->limit($limit, $offset);
        $get = $this->db->get($table);
        
        return $get;
    }

/* UPDATE
    */
    function update($table, $data, $where)
    {
        $this->db->where($where);
        $update = $this->db->update($table, $data);

        if($update == TRUE):
            return TRUE;
        else:
            return FALSE;
        endif;
    }

    function update_batch($table, $array_data, $title)
    {
        $insert = $this->db->update_batch($table, $array_data, $title);

        return TRUE;
    }

/* DELETE
    */
    function delete($table, $where)
    {
        $this->db->where($where);
        $delete = $this->db->delete($table);

        if($delete == TRUE)
            return TRUE;
        else
            return FALSE;
    }
}
