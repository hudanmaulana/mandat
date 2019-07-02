<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_setting extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function getDataSetting() {
        $where = array(
            'setting_type'      => 'dashboard_setting'
        );

        $dtSetting = $this->rnquery->getWhere(rn_setting, $where)->result_array();

        return $dtSetting;
    }

    function getDataLogo() {
        $where = array(
            'setting_type'      => 'dashboard_logo'
        );

        $dtSetting = $this->rnquery->getWhere(rn_setting, $where)->result_array();

        return $dtSetting;
    }

}
