<!doctype html>
<html lang="en">
<head>
    <title>Login Admin | PPOB Listrik</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- ICON TITLE / FAVICON -->
    <link rel="icon" type="image/png" href="<?=base_url()?>assets/img/pln1.png">
    <link rel="apple-touch-icon" href="<?=base_url()?>assets/img/pln1.png">

    <!-- CSS -->
    <link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/vendor/font-awesome/css/font-awesome.min.css">

    <!-- JS -->
    <script src="<?=base_url()?>assets/vendor/jquery/jquery.min.js"></script>

    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #00416A, #2F80ED);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
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

        .login-left {
            padding: 50px;
            width: 50%;
        }

        .login-left h3 {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .login-left p {
            color: #777;
            margin-bottom: 30px;
        }

        .form-control {
            height: 45px;
            border-radius: 8px;
        }

        .btn-login {
            background: linear-gradient(135deg, #2F80ED, #00416A);
            border: none;
            height: 45px;
            font-weight: bold;
            border-radius: 8px;
            color: #fff;
        }

        .btn-login:hover {
            opacity: .95;
            color: #fff;
        }

        .login-right {
            width: 50%;
            background: linear-gradient(180deg, #00416A, #2F80ED);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 40px;
        }

        .login-right h2 {
            font-weight: bold;
        }

        .toggle-pass {
            cursor: pointer;
            font-size: 13px;
            color: #555;
        }

        @media(max-width:768px){
            .login-card {
                flex-direction: column;
            }
            .login-left,
            .login-right {
                width: 100%;
            }
            .login-right {
                display: none;
            }
        }
    </style>
</head>

<body>

<div class="login-card">

    <!-- LEFT -->
    <div class="login-left">

        <div class="text-center mb-4">
            <img src="<?=base_url()?>assets/img/pln1.png" width="70">
        </div>

        <h3>Login Admin</h3>
        <p>Masuk ke sistem PPOB Listrik</p>

        <?php if($this->session->flashdata('pesan_gagal')){ ?>
            <div class="alert alert-danger">
                <?= $this->session->flashdata('pesan_gagal'); ?>
            </div>
        <?php } ?>

        <?php if($this->session->flashdata('pesan_sukses')){ ?>
            <div class="alert alert-success">
                <?= $this->session->flashdata('pesan_sukses'); ?>
            </div>
        <?php } ?>

        <form action="<?=base_url('admin/proses_login')?>" method="post">

            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input id="password" type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                <span class="toggle-pass" onclick="togglePassword()">
                    <i class="fa fa-eye"></i> Lihat Password
                </span>
            </div>

            <button type="submit" class="btn btn-login btn-block">
                <i class="fa fa-sign-in"></i> Login
            </button>
        </form>
    </div>

    <!-- RIGHT -->
    <div class="login-right">
        <div>
            <h2><i class="fa fa-bolt"></i> PPOB Listrik</h2>
            <p>Panel Admin Pengelolaan<br>Tagihan & Penggunaan Listrik</p>
            <i class="fa fa-bolt fa-4x mt-3"></i>
        </div>
    </div>

</div>

<script>
    function togglePassword() {
        var x = document.getElementById("password");
        x.type = (x.type === "password") ? "text" : "password";
    }
</script>

</body>
</html>
