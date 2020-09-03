<?php
class M_user extends CI_Model
{
    function simpan_user($data)
    {
    	return $this->db->insert('user', $data);
    }

    function jumlah_user()
    {
    	return $this->db->get_where('user', array('level not like' => "%5%" ))->num_rows();
    }

    function data_user($table, $number, $offset)
    {
		return $query = $this->db->get($table, $number, $offset)->result();		
	}

	function edit_user($data, $id) 
	{
		return $this->db->where('id', $id)->update('user', $data);
	}
}
