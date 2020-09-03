<?php
$data['judul'] = $judul;
$this->load->view('admin/layout/header');
$this->load->view('admin/layout/sidebar');
$this->load->view($subview);
$this->load->view('admin/layout/footer');
