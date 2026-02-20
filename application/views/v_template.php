<!doctype html>
<html lang="en">

<head>
    <title><?= $judul ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    
    <link rel="stylesheet" href="<?=base_url()?>assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/vendor/linearicons/style.css">
    
    <link rel="stylesheet" href="<?=base_url()?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

    <link rel="stylesheet" href="<?=base_url()?>assets/css/main.css">
    <link rel="apple-touch-icon" sizes="76x76" href="<?=base_url()?>assets/img/pln1.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?=base_url()?>assets/img/pln1.png">

    <script src="<?=base_url()?>assets/vendor/jquery/jquery.min.js"></script>

    <style>
        /* Global Background */
        body, #wrapper, .main { background-color: #fafafa !important; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; }

        /* --- NAVBAR ALIGNMENT --- */
        .navbar-default { background-color: rgba(255, 255, 255, 0.85) !important; backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border-bottom: 1px solid #eaeaea !important; box-shadow: none !important; height: 70px; display: flex; width: 100%; }
        .navbar-default .brand { width: 260px; height: 100%; padding: 0; display: flex; align-items: center; justify-content: center; border-right: 1px solid #eaeaea !important; background: transparent !important; }
        .navbar-default .brand img { max-height: 40px; width: auto; margin: 0 !important; }
        .navbar-default .container-fluid { flex: 1; display: flex; align-items: center; justify-content: space-between; padding: 0 30px; }
        .navbar-default .container-fluid::before, .navbar-default .container-fluid::after { display: none !important; }

        /* --- SEARCH BAR & TOGGLE --- */
        .nav-left-group { display: flex; align-items: center; gap: 15px; }
        .btn-toggle-fullwidth { color: #64748b !important; font-size: 24px !important; margin: 0 !important; padding: 0 !important; transition: color 0.2s ease; display: flex; align-items: center; background: transparent; border: none; }
        .btn-toggle-fullwidth:hover { color: #0070f3 !important; }
        .navbar-form { margin: 0 !important; padding: 0 !important; border: none !important; box-shadow: none !important; }
        .navbar-form .input-group { background: #f3f4f6; border-radius: 20px; padding: 2px 4px; display: flex; align-items: center; }
        .navbar-form .form-control { border-radius: 20px !important; border: none !important; background: transparent !important; box-shadow: none !important; padding-left: 15px; height: 36px; }
        .navbar-form .btn { border-radius: 20px !important; background: #0070f3 !important; color: white !important; border: none !important; height: 36px; width: 40px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 10px rgba(0, 112, 243, 0.2) !important; transition: all 0.2s ease; }
        .navbar-form .btn:hover { transform: scale(1.05); }

        /* --- PROFILE MENU --- */
        #navbar-menu { margin: 0; padding: 0; margin-right: 10px; }
        .navbar-nav { margin: 0 !important; display: flex; align-items: center; height: 70px; }
        .navbar-default .navbar-nav > li > a { font-weight: 600; color: #333 !important; display: flex !important; align-items: center; gap: 10px; padding: 0 15px !important; height: 70px; }
        .navbar-default .navbar-nav > li > a img { width: 36px; height: 36px; border-radius: 50%; object-fit: cover; border: 2px solid #eaeaea; margin: 0 !important; background-color: #f3f4f6; }
        .navbar-default .navbar-nav > li > a .icon-submenu { margin-left: 2px; font-size: 12px; color: #94a3b8; }
        .dropdown-menu { border-radius: 16px !important; border: 1px solid #eaeaea !important; box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important; padding: 10px !important; margin-top: -5px !important; min-width: 200px; }
        .dropdown-menu > li > a { border-radius: 8px; padding: 8px 15px !important; transition: all 0.2s ease; }
        .dropdown-menu > li > a:hover { background-color: #fee2e2 !important; color: #ef4444 !important; }

        /* --- LAYOUT FIX --- */
        body #wrapper .sidebar { background-color: #ffffff !important; border-right: 1px solid #eaeaea !important; box-shadow: none !important; top: 70px !important; width: 260px !important; position: fixed; height: calc(100vh - 70px); z-index: 10; left: 0; padding-top: 0 !important; margin-top: 0 !important; }
        body #wrapper .main { padding-top: 70px !important; background-color: #fafafa !important; margin-left: 260px !important; min-height: 100vh; display: flex; flex-direction: column; }
        body #wrapper .sidebar .sidebar-scroll { padding: 0 !important; margin: 0 !important; }
        body #wrapper .sidebar .nav { padding: 0 !important; margin: 0 !important; padding-top: 20px !important; }
        body #wrapper .main-content { padding: 0 !important; margin: 0 !important; flex: 1; }
        body #wrapper .main-content .container-fluid { padding: 0 !important; margin: 0 !important; padding-top: 20px !important; padding-left: 30px !important; padding-right: 30px !important; }
        body #wrapper .main-content .container-fluid > div:first-child, body #wrapper .main-content .container-fluid > .row:first-child, body #wrapper .main-content .container-fluid > .panel:first-child { margin-top: 0 !important; padding-top: 0 !important; }

        /* --- SIDEBAR MENU --- */
        .sidebar .nav > li > a { border-radius: 12px !important; margin: 0 16px 8px 16px !important; padding: 14px 20px !important; color: #64748b !important; font-weight: 500 !important; border: none !important; transition: all 0.2s ease !important; display: flex; align-items: center; }
        .sidebar .nav > li > a i { margin-right: 12px; font-size: 18px; color: #94a3b8 !important; transition: all 0.2s ease !important; }
        .sidebar .nav > li > a:hover { background-color: #f8fafc !important; color: #111 !important; transform: translateX(4px); }
        .sidebar .nav > li > a:hover i { color: #111 !important; }
        .sidebar .nav > li > a.active { background-color: #eff6ff !important; color: #0070f3 !important; font-weight: 600 !important; box-shadow: inset 3px 0 0 #0070f3; }
        .sidebar .nav > li > a.active i { color: #0070f3 !important; }

        /* --- RESPONSIVE MOBILE --- */
        @media (max-width: 768px) {
            body #wrapper .main { margin-left: 0 !important; }
            .navbar-default .brand { width: auto; border-right: none !important; }
            .nav-left-group { display: flex !important; }
            .navbar-form { display: none !important; }
            body #wrapper .sidebar { left: -260px !important; transition: all 0.3s ease-in-out !important; }
            body.offcanvas-active #wrapper .sidebar { left: 0 !important; box-shadow: 10px 0 30px rgba(0,0,0,0.15) !important; z-index: 9999 !important; }
            body #wrapper .main-content .container-fluid { padding-left: 15px !important; padding-right: 15px !important; }
        }
    </style>
</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="brand">
                <a href="<?=base_url()?>dashboard">
                    <img src="<?=base_url()?>assets/img/logo-dark.png" alt="Logo PLN" class="logo">
                </a>
            </div>
            <div class="container-fluid">
                <div class="nav-left-group">
                    <button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-menu"></i></button>
                    
                    <form class="navbar-form" action="<?= base_url('pencarian') ?>" method="GET">
                        <div class="input-group">
                            <input type="text" name="keyword" class="form-control" placeholder="Cari data pelanggan/tagihan..." required>
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>

                </div>
                <div id="navbar-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                
                                <?php 
                                    if($this->session->userdata('id_level') != null) {
                                        // ==========================================
                                        // 1. JIKA ADMIN (Gunakan Inisial Nama)
                                        // ==========================================
                                        $nama_user = $this->session->userdata('nama_admin');
                                        $nama_encoded = urlencode($nama_user);
                                        $foto_profil = "https://ui-avatars.com/api/?name=".$nama_encoded."&background=0070f3&color=fff&rounded=true&bold=true";
                                        
                                    } else {
                                        // ==========================================
                                        // 2. JIKA PELANGGAN (Gunakan Foto Profil Asli)
                                        // ==========================================
                                        $nama_user = $this->session->userdata('nama_pelanggan');
                                        
                                        // Sesuaikan 'foto' dengan nama session foto yang Anda simpan saat login
                                        $foto_session = $this->session->userdata('foto_profil'); 

                                        if(!empty($foto_session)) {
                                            // Jika user sudah upload foto, ambil dari folder assets
                                            // Sesuaikan path 'assets/img/profil/' dengan folder upload Anda
                                            $foto_profil = base_url('assets/img/profil/' . $foto_session); 
                                        } else {
                                            // Jika user belum upload foto, tampilkan inisial nama sebagai default
                                            $nama_encoded = urlencode($nama_user);
                                            $foto_profil = "https://ui-avatars.com/api/?name=".$nama_encoded."&background=0070f3&color=fff&rounded=true&bold=true";
                                        }
                                    }
                                ?>
                                
                                <img src="<?= $foto_profil ?>" class="img-circle" alt="Avatar" style="object-fit: cover; width: 36px; height: 36px;">
                                
                                <span><?= htmlspecialchars($nama_user) ?></span>
                                <i class="icon-submenu lnr lnr-chevron-down"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <?php if($this->session->userdata('id_level')!=NULL): ?>
                                    <li><a href="<?=base_url()?>admin/logout"><i class="lnr lnr-exit" style="margin-right: 10px;"></i> <span>Keluar Sistem</span></a></li>
                                <?php else: ?>
                                    <li><a href="<?=base_url()?>profil"><i class="lnr lnr-user" style="margin-right: 10px;"></i> <span>Profil Saya</span></a></li>
                                    <li><a href="<?=base_url()?>user/logout"><i class="lnr lnr-exit" style="margin-right: 10px;"></i> <span>Keluar Sistem</span></a></li>
                                <?php endif ?>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <div id="sidebar-nav" class="sidebar">
            <div class="sidebar-scroll">
                <nav>
                    <ul class="nav">
                        <?php if($this->session->userdata('id_level')!= NULL && $this->session->userdata('id_level')== 1): ?>
                            <li><a href="<?=base_url()?>dashboard" class="active"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
                            <li><a href="<?=base_url()?>data_admin"><i class="fa fa-address-book"></i><span>Data Admin</span></a></li>
                            <li><a href="<?=base_url()?>level"><i class="fa fa-address-card"></i> <span>Data Level</span></a></li>
                            <li><a href="<?=base_url()?>data_pelanggan"><i class="fa fa-users"></i> <span>Data Pelanggan</span></a></li>
                            <li><a href="<?=base_url()?>tarif"><i class="fa fa-bolt"></i> <span>Tarif Listrik</span></a></li>
                            <li><a href="<?=base_url()?>penggunaan"><i class="fa fa-line-chart"></i> <span>Penggunaan Listrik</span></a></li>
                            <li><a href="<?=base_url()?>riwayat"><i class="fa fa-history"></i> <span>Riwayat Transaksi</span></a></li>
                            <li><a href="<?=base_url()?>laporan_pembayaran"><i class="fa fa-file-pdf-o"></i> <span>Generate Laporan</span></a></li>

                        <?php elseif($this->session->userdata('id_level')!= NULL && $this->session->userdata('id_level')== 2): ?>
                            <li><a href="<?=base_url()?>dashboard" class="active"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
                            <li><a href="<?=base_url()?>laporan_pembayaran"><i class="fa fa-file-pdf-o"></i> <span>Generate Laporan</span></a></li>

                        <?php else: ?>
                            <li><a href="<?=base_url()?>dashboard" class="active"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
                            <li><a href="<?=base_url()?>profil"><i class="fa fa-user-circle"></i> <span>Profil Saya</span></a></li>
                            <li><a href="<?=base_url()?>tagihan"><i class="fa fa-file-text-o"></i> <span>Tagihan Listrik</span></a></li>
                            <li><a href="<?=base_url()?>laporan_tagihan"><i class="fa fa-print"></i> <span>Cetak Riwayat</span></a></li>
                        <?php endif ?>
                    </ul>
                </nav>
            </div>
        </div>
        
        <div class="main">
            <div class="main-content">
                <div class="container-fluid">
                    <?php $this->load->view($konten); ?>
                </div>
            </div>
            
            <footer style="padding: 24px 30px; margin-top: auto; border-top: 1px solid #eaeaea; background-color: transparent; text-align: left;">
                <p style="margin: 0; color: #64748b; font-size: 13px; font-weight: 500;">
                    &copy; <?= date('Y') ?> Muh Bintang Mahardani. All rights reserved.
                </p>
            </footer>

        </div>
        <div class="clearfix"></div>
    </div>
    
    <script src="<?=base_url()?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?=base_url()?>assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>

    <script src="<?=base_url()?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?=base_url()?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

    <script src="<?=base_url()?>assets/scripts/klorofil-common.js"></script>

    <script>
    $(document).ready(function () {
        if ($('#tabelbiasa').length) {
            $('#tabelbiasa').DataTable();
        }

        var currentUrl = window.location.href;
        $('#sidebar-nav .nav li a').each(function() {
            if (currentUrl.includes($(this).attr('href'))) {
                $('#sidebar-nav .nav li a').removeClass('active');
                $(this).addClass('active');
            }
        });
    });
    </script>
</body>
</html>