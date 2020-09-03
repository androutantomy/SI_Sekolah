<?php

class M_siswa_kelas extends CI_Model {

    var $table = 'master_siswa'; //nama tabel dari database
    var $column_order = array(null, 'nisn','nama','tempat_lahir', 'tanggal_lahir', 'jk', 'agama', 'hp', 'email', 'alamat'); //field yang ada di table user
    var $column_search = array('nama','tempat_lahir','hp', 'alamat', 'nisn'); //field yang diizin untuk pencarian 
    var $order = array('nama' => 'asc'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {
        $ambil = $this->db->get('relasi_siswa_kelas');
        $siswa = array();
        foreach ($ambil->result_array() as $key => $v) {
            array_push($siswa, $v['id_siswa']);
        }

        $this->db->from($this->table);
        if($ambil->num_rows() >= 1 ) {
            $this->db->where_not_in('id', $siswa);
        }

        $i = 0;

        foreach ($this->column_search as $item) // looping awal
        {
            if($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {

                if($i===0) // looping awal
                {
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_search) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }

        if(isset($_POST['order'])) 
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function jumlah_kelas($hari)
    {
        return $this->db->get_where('master_jadwal_mapel', array('hari' => "$hari" ))->num_rows();
    }

    function data_siswa_kelas($table, $number, $offset)
    {
        return $query = $this->db->select('master_jadwal_mapel.*, master_jadwal_mapel.id id_relasi_kelas_jadwal, master_strata.*, master_guru.nama nama_guru, master_mata_pelajaran.nama nama_mapel')
                            ->join('master_strata', 'master_strata.id = master_jadwal_mapel.id_kelas')
                            ->join('master_guru', 'master_guru.id = master_jadwal_mapel.id_guru')
                            ->join('master_mata_pelajaran',  'master_mata_pelajaran.id = master_jadwal_mapel.id_mapel')
                            ->where('hari', date('N'))
                            ->order_by('master_jadwal_mapel.jam_mulai', 'asc')
                            ->get($table, $number, $offset)->result();     
    }

    function data_kelas_guru($table, $number, $offset)
    {
        $this->db->select('master_jadwal_mapel.*, master_jadwal_mapel.id id_relasi_kelas_jadwal, master_strata.nama nama_kelas, master_mata_pelajaran.nama nama_mapel, master_mata_pelajaran.id id_mapel');
        $this->db->join('master_strata', 'master_strata.id = master_jadwal_mapel.id_kelas');
        $this->db->join('master_mata_pelajaran',  'master_mata_pelajaran.id = master_jadwal_mapel.id_mapel');
        if($this->session->userdata('id_guru') != null) {
            $this->db->where('master_jadwal_mapel.id_guru', $this->session->userdata('id_guru'));
        }
        $this->db->group_by('master_strata.id', 'asc');
        return $query = $this->db->get($table, $number, $offset)->result();     
    }

    function dataSiswaKelasAll($table, $number, $offset)
    {
        $this->db->select('master_jadwal_mapel.*, master_jadwal_mapel.id id_relasi_kelas_jadwal, master_strata.nama nama_kelas, master_mata_pelajaran.nama nama_mapel, master_mata_pelajaran.id id_mapel');
        $this->db->join('master_strata', 'master_strata.id = master_jadwal_mapel.id_kelas');
        $this->db->join('master_mata_pelajaran',  'master_mata_pelajaran.id = master_jadwal_mapel.id_mapel');
        $this->db->group_by('master_strata.id', 'asc');
        return $query = $this->db->get($table, $number, $offset)->result();     
    }
}
