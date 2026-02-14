<!doctype html>
<html lang="en">
<head>
    <title>Login Pelanggan | PPOB Listrik</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="<?=base_url()?>assets/img/pln1.png">
    
    <link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/vendor/font-awesome/css/font-awesome.min.css">

    <script src="<?=base_url()?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?=base_url()?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>

    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #00416A, #2F80ED);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
            padding: 20px;
        }

        .login-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 20px 40px rgba(0,0,0,.2);
            overflow: hidden;
            width: 100%;
            max-width: 900px;
            display: flex;
        }

        /* BAGIAN KIRI (FORM) */
        .login-left {
            padding: 50px;
            width: 50%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-left h3 {
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        .login-left p.subtitle {
            color: #777;
            margin-bottom: 25px;
            font-size: 14px;
        }

        .form-control {
            height: 45px;
            border-radius: 8px;
            background: #f9f9f9;
            border: 1px solid #ddd;
            margin-bottom: 5px;
        }

        .form-control:focus {
            background: #fff;
            border-color: #2F80ED;
            box-shadow: none;
        }

        .btn-login {
            background: linear-gradient(135deg, #2F80ED, #00416A);
            border: none;
            height: 45px;
            font-weight: bold;
            border-radius: 8px;
            color: #fff;
            margin-top: 15px;
            transition: all 0.3s;
        }

        .btn-login:hover {
            opacity: .95;
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(47, 128, 237, 0.3);
        }

        /* BAGIAN KANAN (INFO) */
        .login-right {
            width: 50%;
            background: linear-gradient(180deg, #00416A, #2F80ED);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 40px;
            position: relative;
        }

        .login-right h2 { font-weight: bold; }
        
        /* UTILITAS */
        .toggle-pass {
            cursor: pointer;
            font-size: 13px;
            color: #555;
            margin-top: 5px;
            display: inline-block;
            margin-bottom: 10px;
        }

        .register-link {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
            color: #666;
        }

        .register-link a {
            color: #2F80ED;
            font-weight: bold;
            text-decoration: none;
        }

        /* MODAL CUSTOM STYLE */
        .modal-content {
            border-radius: 12px;
            border: none;
        }
        .modal-header {
            background: #f8f9fa;
            border-radius: 12px 12px 0 0;
            border-bottom: 1px solid #eee;
        }
        .modal-title { font-weight: bold; color: #333; }

        @media(max-width:768px){
            .login-card { flex-direction: column; }
            .login-left, .login-right { width: 100%; }
            .login-right { display: none; }
        }
    </style>
</head>

<body>

<div class="login-card">

    <div class="login-left">

        <div class="text-center mb-3">
            <img src="<?=base_url()?>assets/img/pln1.png" width="60">
        </div>

        <h3>Login Pelanggan</h3>
        <p class="subtitle">Silahkan masuk untuk membayar tagihan</p>

        <?php if($this->session->flashdata('pesan_sukses')){ ?>
            <div class="alert alert-success fade in" style="border-radius: 8px; font-size: 14px;">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <i class="fa fa-check-circle"></i> <strong>Berhasil!</strong> <?= $this->session->flashdata('pesan_sukses'); ?>
            </div>
        <?php } ?>

        <?php if($this->session->flashdata('pesan_gagal')){ ?>
            <div class="alert alert-danger fade in" style="border-radius: 8px; font-size: 14px;">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <i class="fa fa-times-circle"></i> <strong>Gagal!</strong> <?= $this->session->flashdata('pesan_gagal'); ?>
            </div>
        <?php } ?>

        <form action="<?=base_url('user/proses_login')?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input id="password" type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                <span class="toggle-pass" onclick="toggleMainPass()">
                    <i class="fa fa-eye"></i> Lihat Password
                </span>
            </div>

            <button type="submit" class="btn btn-login btn-block">
                <i class="fa fa-sign-in"></i> MASUK SEKARANG
            </button>
        </form>

        <div class="register-link">
            Belum punya akun? <a href="#" data-toggle="modal" data-target="#registerModal">Daftar Disini</a>
        </div>
    </div>

    <div class="login-right">
        <div>
            <h2><i class="fa fa-home"></i> Area Pelanggan</h2>
            <p>Kelola penggunaan listrik dan pembayaran<br>tagihan Anda dengan mudah dan aman.</p>
            <i class="fa fa-plug fa-4x mt-3" style="opacity: 0.5;"></i>
        </div>
    </div>

</div>

<div class="modal fade" id="registerModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Registrasi Akun Baru</h4>
            </div>
            
            <form action="<?=base_url('user/register')?>" method="post">
                <div class="modal-body">
                    
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" name="nama_pelanggan" class="form-control" required placeholder="Sesuai KTP">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label>Nomor KWH</label>
                                <input type="number" name="nomor_kwh" class="form-control" required placeholder="Nomor Meteran">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Alamat Lengkap</label>
                        <input type="text" name="alamat" class="form-control" required placeholder="Alamat Pemasangan">
                    </div>

                    <div class="form-group">
                        <label>Jenis Tarif</label>
                        <select class="form-control" name="id_tarif" required>
                            <option value="">-- Pilih Daya / Tarif --</option>
                            <?php foreach ($DataTarif as $data) { ?>
                                <option value="<?=$data->id_tarif?>"><?= $data->nama_tarif ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <hr style="border-top: 1px dashed #ddd;">

                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label>Username Login</label>
                                <input type="text" name="username" class="form-control" required placeholder="Buat Username">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label>Password Login</label>
                                <input id="reg_pass" type="password" name="password" class="form-control" required placeholder="Buat Password">
                                <span class="toggle-pass" onclick="toggleRegPass()">
                                    <i class="fa fa-eye"></i> Lihat Password
                                </span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" style="background: #2F80ED; border-color: #2F80ED;">Daftar Akun</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Toggle Password Login Utama
    function toggleMainPass() {
        var x = document.getElementById("password");
        x.type = (x.type === "password") ? "text" : "password";
    }

    // Toggle Password Modal Register
    function toggleRegPass() {
        var x = document.getElementById("reg_pass");
        x.type = (x.type === "password") ? "text" : "password";
    }
</script>

</body>
</html>