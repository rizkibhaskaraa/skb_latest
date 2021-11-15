<body class="mt-5" style='background-color:#182039';> 

<div class="container-fluid mt-5" style='background-color:#182039';>
    <div class="card shadow " style='background-color:#212B4E';>
    <div class="card-header " style='background-color:#212B4E';>
        <h6 class="m-0 font-weight-bold text-light float-left" >Seluruh Data Akun</h6>
        <?php if($_SESSION["role"] == "Super User"){?>
            <a class="btn btn-primary btn-icon-split float-right" data-toggle="modal" data-target="#popup-tambah-akun">
                <span class="icon text-white-100">
                    <i class="fas fa-plus"></i> 
                </span>
                <span class="text">
                        Buat Akun
                </span>
            </a>
        <?php }?>
    </div>
    <!-- tabel data cutomer -->
    <div class="card-body" style='background-color:#212B4E';>
        <div class="table-responsive text-light">
            <table class="table table-bordered text-light" id="Table-Akun" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center" width="3%" scope="col">ID</th>
                        <th class="text-center" width="20%" scope="col">Nama</th>
                        <th class="text-center" width="5%" scope="col">Role</th>
                        <th class="text-center" width="10%" scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <!-- end tabel data cutomer -->
</div>
<!-- pop up tambah akun -->
<div class="modal fade mt-5" id="popup-tambah-akun" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="block-title font-weight-bold">Tambah Akun</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times</span>
                </button>
            </div>
            <div class="font-size-sm m-3 text-justify">
                <p class="font-weight-bold">Isi Data Dengan Lengkap</p>
                <form  action="<?= base_url("index.php/form/insert_akun")?>" method="POST">
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-5 col-form-label">Nama Akun</label>
                        <div class="col-sm-6">
                            <input autocomplete="off" class="form-control" type="text" name="nama" id="nama" required>    
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="username" class="col-sm-5 col-form-label">Username</label>
                        <div class="col-sm-6">
                            <input autocomplete="off" class="form-control" type="text" name="username" id="username" required>    
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="password" class="col-sm-5 col-form-label">Password</label>
                        <div class="col-sm-6">
                            <input autocomplete="off" class="form-control" type="text" name="password" id="password" required>    
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-5 col-form-label" for="role">Role Akun</label>
                        <select name="role" id="role" class="form-control custom-select col-sm-5 ml-4" required>
                            <option class="font-w700" disabled="disabled" selected value="">Jenis Role</option>
                            <option value="Super User">Super User</option>
                            <option value="Supervisor">Supervisor</option>
                            <option value="Operator">Operator</option>
                        </select>
                    </div>
                    <div class="mr-4 px-3 float-right">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end pop up tambah akun -->
<!-- pop up update akun -->
<div class="modal fade mt-3" id="popup-update-akun" tabindex="-1" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content" style='background-color:#212B4E';>
            <div class="modal-header bg-primary-dark">
                <h5 class="font-weight-bold text-light">Update Data Akun</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="font-size-sm m-3 text-justify text-light">
                <form action="<?= base_url("index.php/form/update_akun")?>" method="POST" id="form-edit-akun">
                    <input type="text" name=akun_id id=akun_id hidden>
                    <div class="form-group">
                        <label for="akun_name" class="form-label">Nama Akun</label>
                        <input autocomplete="off" type="text" class="form-control" id="akun_name" name="akun_name" required>
                    </div>
                    <div class="form-group">
                        <label class="" for="role_update">Role Akun</label>
                        <select name="role_update" id="role_update" class="form-control custom-select " required>
                            <option class="font-w700" disabled="disabled" selected value="">Jenis Role</option>
                            <option value="Super User">Super User</option>
                            <option value="Supervisor">Supervisor</option>
                            <option value="Operator">Operator</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="username_update" class="form-label">Username</label>
                        <input autocomplete="off" type="text" class="form-control" id="username_update" name="username_update" required>
                    </div>
                    <div class="form-group">
                        <label for="password_update" class="form-label">Password</label>
                        <input autocomplete="off" type="text" class="form-control" id="password_update" name="password_update" required>
                    </div>
                    <div class="form-group">
                    <button type="submit" class="btn btn-success mb-3 float-right">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end pop up update akun -->
</div>
</div>

        </body>