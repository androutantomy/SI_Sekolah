<?php
class M_master extends CI_Model

{

    function __construct()
    {
        parent::__construct();
    }

    function level_user()
    {
        return $this->db->get('user_level')->result_array();
    }
}
