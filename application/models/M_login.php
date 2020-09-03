<?php
class M_login extends CI_Model

{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function is_active($id)
    {
        return $this->db->set('is_active', 1)->where('id', $id)->update('user');
    }

    function isnt_active($id)
    {
        return $this->db->set('is_active', 0)->where('id', $id)->update('user');
    }

    function cekUser($user, $pass)
    {
        $cek = $this->db->get_where('user', array('password' => $pass, 'username' => $user));
        return $cek;
    }
}
