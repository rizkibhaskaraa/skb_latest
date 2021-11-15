<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="<?=base_url("assets/vendor/fontawesome-free/css/all.min.css")?>" rel="stylesheet" type="text/css">
    <link href=<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/sweetalert2/sweetalert2.min.css') ?>">

    <!-- Custom styles for this template-->
    <link href="<?=base_url("assets/css/sb-admin-2.min.css")?>" rel="stylesheet">

</head>

<body class="bg-black" style='background-color:#182039';>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 mt-5 ">
                <div class="card my-5 bg-black " style='background-color:#212B4E';>
                    <div class="card-body">
                        <div class="p-5">
                            <div class="text-center">
                            <img class="img-fluid mt-3 mb-3" src="<?php echo base_url('assets/img/logo.png')?> " alt="Gink Technology">
                               
                               
                            </div>
                            <h2 class="text-gray-200 mb-4 font-weight-bold mt-3">Login</h2>
                            <form action="<?= base_url("index.php/login/login")?>" method="POST">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="username"
                                        placeholder="Masukkan Username" autocomplete='off' required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password"
                                        placeholder="Masukkan Password" autocomplete='off'required>
                                </div>
                              
                                <button type="submit" class="btn btn-primary btn-block mt-5">Masuk</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
     <!-- Bootstrap core JavaScript-->
     <script src="<?=base_url("assets/vendor/jquery/jquery.min.js")?>"></script>
    <script src="<?=base_url("assets/vendor/bootstrap/js/bootstrap.bundle.min.js")?>"></script>    
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- Core plugin JavaScript-->
    <script src="<?=base_url("assets/vendor/jquery-easing/jquery.easing.min.js")?>"></script>
    

    <!-- Custom scripts for all pages-->
    <script src="<?=base_url("assets/js/sb-admin-2.min.js")?>"></script>
    <script>
        var username = '<?= $this->session->flashdata('status-login'); ?>';
        var password = '<?= $this->session->flashdata('status-login'); ?>';
        var false_login = '<?= $this->session->flashdata('status-login'); ?>';
        if(username == "Username"){
            Swal.fire({
                    title: 'Gagal Login',
                    icon:'error',
                    text: 'Username tidak ditemukan',
                    timer: 2000
                });
        }
        if(password == "Password"){
            Swal.fire({
                    title: "Gagal Login",
                    text: "Password salah",
                    icon: 'error',
                    timer: 2000
                });
        }
        if(false_login == "False"){
            Swal.fire({
                    title: "Gagal Masuk",
                    text: "Silakan login terlebih dahulu",
                    icon: 'error',
                    timer: 2000
                });
        }
        if(false_login == "Aktif"){
            Swal.fire({
                    title: "Gagal Masuk",
                    text: "Anda Sedang Login Di Device Lain, Sialakan Logout Terlebih Dahulu atau Tunggu 1 Menit Lagi",
                    icon: 'error',
                });
        }
    </script>
</body>
</html>