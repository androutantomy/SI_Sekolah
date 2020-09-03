<?php
    function tanggal_indo($tanggal, $cetak_hari = false)
    {
        $hari = array(
            1 =>    'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu',
            'Minggu'
        );

        $bulan = array(
            1 =>   'Januari',
            'Febuari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $split       = explode('-', $tanggal);
        $tgl_indo = $split[2] . ' ' . $bulan[(int) $split[1]] . ' ' . $split[0];

        if ($cetak_hari) {
            $num = date('N', strtotime($tanggal));
            return $hari[$num] . ', ' . $tgl_indo;
        }
        return $tgl_indo;
    }

    $levelUser = $this->session->userdata('level');
    ?>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="#" class="brand-link">
            <img src="<?= base_url() ?>assets/dist/img/clock.png" width="30" class="img-circle elevation-2" alt="Clock">
            <?php $tanggal = date('Y-m-d'); ?>
            <?= tanggal_indo($tanggal, true); ?>
        </a>
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
        <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image" style="color:white;">
                <img src="<?= base_url() ?>assets/dist/img/clock.png" width="30" class="img-circle elevation-2" alt="Clock">
            </div>
            <div class="info" style="color:white;">
                <?php $tanggal = date('Y-m-d'); ?>
                <?= tanggal_indo($tanggal, true); ?>
            </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item <?php if ($aktif == 'dashboard') { echo 'menu-open'; } ?>">
                    <a href="<?= site_url('Dashboard') ?>" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <?php $ar1 = ['siswa', 'pelajaran', 'user', 'strata', 'guru'];?>
                <li class="nav-item has-treeview <?php if (in_array($aktif, $ar1)) { echo 'menu-open'; } ?>" <?= !in_array(1, $levelUser) ? 'hidden' : ''; ?>>
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Master Data
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= site_url('Master/User') ?>" class="nav-link <?php if ($aktif == 'user') { echo 'active'; } ?>">
                                <i class="nav-icon fas fa-user"></i>
                                <p> 
                                    Master User
                                </p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= site_url('Master/Guru') ?>" class="nav-link <?php if ($aktif == 'guru') { echo 'active'; } ?>">
                                <i class="nav-icon fas fa-book-reader"></i>
                                <p> 
                                    Master Guru
                                </p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= site_url('Master/Pelajaran') ?>" class="nav-link <?php if ($aktif == 'pelajaran') { echo 'active'; } ?>">
                                <i class="nav-icon far fa-address-book"></i>
                                <p>
                                    Master Mata Pelajaran
                                </p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= site_url('Master/Siswa') ?>" class="nav-link <?php if ($aktif == 'siswa') { echo 'active'; } ?>">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Master Data Siswa
                                </p>
                            </a>    
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= site_url('Master/Strata') ?>" class="nav-link <?php if ($aktif == 'strata') { echo 'active'; } ?>">
                                <i class="nav-icon fas fa-university"></i>
                                <p>
                                    Master Strata
                                </p>
                            </a>    
                        </li>
                    </ul>
                </li>

                <?php $ar2 = ['kelas', 'siswa_mapel', 'soal']?>
                <li class="nav-item has-treeview <?php if (in_array($aktif, $ar2)) { echo 'menu-open'; } ?>" <?= !in_array(1, $levelUser) ? 'hidden' : ''; ?>>
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Kelola Kelas & Siswa
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= site_url('Kelas') ?>" class="nav-link <?php if ($aktif == 'kelas') { echo 'active'; } ?>">
                                <i class="nav-icon far fa-keyboard"></i>
                                <p> 
                                    Kelas
                                </p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= site_url('Kelas/jadwal_mapel') ?>" class="nav-link <?php if ($aktif == 'siswa_mapel') { echo 'active'; } ?>">
                                <i class="nav-icon fas fa-pencil-ruler"></i>
                                <p> 
                                    Jadwal Mapel
                                </p>
                            </a>
                        </li>
                    </ul>  
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= site_url('Kelas/kelola_soal') ?>" class="nav-link <?php if ($aktif == 'soal') { echo 'active'; } ?>">
                                <i class="nav-icon fas fa-book"></i>
                                <p> 
                                    Kelola Soal
                                </p>
                            </a>
                        </li>
                    </ul>               
                </li>

                <?php $ar3 = []; ?>
                
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
