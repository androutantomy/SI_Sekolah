<?php
$data['judul'] = $judul;
$this->load->view('website/layout/header');
$this->load->view('website/layout/sidebar');
$this->load->view($subview);
$this->load->view('website/layout/footer');
