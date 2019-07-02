<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dataacc extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function getDataAll() {
    	$where = array(
    		'status' => 'terkirim',
		);
        $return = $this->rnquery->getWhere(dataFidusia,$where);

        return $return->result_array();
    }

    function getDataById($id) {
        $return = $this->db
            ->where( 'no_kontrak', $id)
            ->get(dataFidusia)->row_array();

        return $return;
    }

    function get_all_group() {
        $return = $this->rnquery->getAll(rn_groups);

        return $return->result();
    }

    function get_group_parent($id){
        $where = array(
            'post_id'       => $id,
            'terms_type'    => 'groups'
        );

        $return = $this->rnquery->getWhere(rn_terms, $where)->result();
        return $return;
    }
}
