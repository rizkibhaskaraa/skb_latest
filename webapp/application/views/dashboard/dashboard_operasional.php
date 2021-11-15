<body style='background-color:#182039';> 

<div class="info-supir mt-5"  style='background-color:#182039';>
    <div class="container p-5 " style='background-color:#182039';> 
    <div class="card shadow mb-4 bg-black " style='background-color:#212B4E';>
            <div class="card-header py-3 text-center" style='background-color:#212B4E';>
            <h6 class="m-0 font-weight-bold btn-light disabled h4 p-3" style="border-radius:10px";>Supir Tidak Jalan</h6>
            </div>  
            <div class="card-body row justify-content-md-center ">
                <div class="table-responsive rounded">
                    <!-- <div class="text-center" style='background-color:#212B4E';>
                        <h5 class=" font-weight-bold text-light">Supir Tidak Jalan</h5>
                    </div> -->
                    <table class="table table-bordered text-light" id="Table-Supir-Tidak-Jalan" width="100%" cellspacing="0" >
                        <thead>
                            <tr>
                                <th class="text-center" width="5%" scope="col">No.</th>
                                <th class="text-center" width="25%" scope="col">Nama</th>
                                <th class="text-center" width="20%" scope="col">Nomor Telepon</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="info-kendaraan" > 
        <div class="card shadow" style='background-color:#212B4E';>
            <div class="card-header py-3 text-center" style='background-color:#212B4E';>  
                <h6 class="m-0 font-weight-bold btn-dark disabled h4 p-3 text-light" style="border-radius:10px";>Kendaraan Tidak Jalan</h6>
            </div>  
            <div class="card-body row justify-content-md-center ">
                <div class="table-responsive p-1 mb-3">
                    <!-- <div class=" py-3 text-center" style='background-color:#212B4E';>
                        <h5 class="m-0 font-weight-bold text-light">Kendaraan Tidak Jalan</h5>
                    </div> -->
                    <table class="table table-bordered text-light" id="Table-Truck-Tidak-Jalan" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                            <th class="text-center" width="10%" scope="col">No.</th>
                                <th class="text-center" width="20%" scope="col">No Polisi</th>
                                <th class="text-center" width="20%" scope="col">Merk</th>
                                <th class="text-center" width="20%" scope="col">Jenis</th>
                                <th class="text-center" width="20%" scope="col">Dump</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
             
               
                
                
            </div>
        </div>
    </div>
    </div>
    </div> 


        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog mt-5 py-5" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Keluar <i class="fa fa-lock"></i></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times</span>
                    </button>
                </div>

                <div class="modal-body"><i class="fa fa-question-circle"></i> Anda yakin ingin keluar?</div>
                <div class="modal-footer">
                    <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-danger" href="<?= base_url("index.php/login/logout")?>">Keluar</a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="popup-ubah-password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog mt-5 py-5" role="document">
            <div class="modal-content ">
                <div class="modal-header mb-3">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Password</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times</span>
                    </button>
                </div>
                <div class="container mb-3">
                    <form action="<?= base_url('index.php/login/ubah_password')?>" method="POST" onsubmit="return cek_password();">
                        <div class="form-group row">
                            <label for="password_old" class="form-label col">Password Lama</label>
                            <input type="password" id="password_old" name="password_old" required class="form-control col">
                        </div>
                        <div class="form-group row">
                            <label for="password_new" class="form-label col">Password Baru</label>
                            <input type="password" id="password_new" name="password_new" required class="form-control col">
                        </div>
                        <div class="form-group row">
                            <label for="password_fix" class="form-label col">Konfirmasi Password Baru</label>
                            <input type="password" id="password_fix" name="password_fix" required class="form-control col">
                        </div>
                        <div class="form-group mt-1 mr-4 ">
                            <button type="submit" class="btn btn-success float-right" >Simpan</button>
                            <button type="reset" class="btn btn-outline-danger mr-3 float-md-right">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- pop up add detail rute paketan -->
    <div class="modal fade" id="popup-detail-rute-paketan" tabindex="0" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
        <div class="modal-dialog modal-md"  role="document"  >
            <div class="modal-content">
                <div class="modal-header bg-primary-dark">
                    <h5 class="font-weight-bold">Detail Rute</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="font-size-sm m-3 text-justify">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="table-data-rute-paketan" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th class="text-center" scope="col">Keterangan</th>
                                                <th class="text-center" scope="col">Dari</th>
                                                <th class="text-center" scope="col">Ke</th>
                                                <th class="text-center" scope="col">Muatan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end pop up add detail rute paketan -->

</div>


  
    
    <script src="<?=base_url("assets/vendor/jquery/jquery.min.js")?>"></script>
    <script src="<?=base_url("assets/vendor/jquery/jquery.mask.min.js")?>"></script>
    <script src="<?=base_url("assets/vendor/bootstrap/js/bootstrap.bundle.min.js")?>"></script>    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    
    <!-- Core plugin JavaScript-->
    <script src="<?=base_url("assets/vendor/jquery-easing/jquery.easing.min.js")?>"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?=base_url("assets/js/sb-admin-2.min.js")?>"></script>

    <!-- Page level plugins -->
    <script src="<?=base_url("assets/vendor/chart.js/Chart.min.js")?>"></script>
    <script src="<?=base_url("assets/vendor/datatables/jquery.dataTables.min.js")?>"></script>
    <script src="<?=base_url("assets/vendor/datatables/dataTables.bootstrap4.min.js")?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>
    <script src="<?php echo base_url('assets/datepicker/js/bootstrap-datepicker.js')?>"></script>
    <script>
        function countDown() {
            $.ajax({
                type: "GET",
                url: "<?php echo base_url('index.php/login/set_login') ?>",
                dataType: "text",
                success: function(data) { //jika ambil data sukses
                }
            });
            setTimeout("countDown()", 1000);
        }
        countDown();
    </script>
    <!-- cek password -->
    <script>
        function cek_password(){
            password_old = $("#password_old").val();
            password_new = $("#password_new").val();
            password_fix = $("#password_fix").val();
            validasi = "false";
            $.ajax({
                type: "GET",
                url: "<?php echo base_url('index.php/login/cek_password/') ?>"+password_old+"/"+password_new+"/"+password_fix,
                dataType: "text",
                async:false,
                success: function(data) { 
                    validasi = data;
                }
            });
            if(validasi!="true"){
                if(validasi=="false lama"){
                    alert("password lama tidak sesuai");
                }else{
                    alert("password baru tidak cocok");
                }
                return false;
            }else{
                return true;
            }
        }
    </script>
    <script> //script datatables kendaraan
        $(document).ready(function() {
            var table = null;
            table = $('#Table-Truck-Tidak-Jalan').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [0, 'asc']
                ],
                "ajax": {
                    "url": "<?php echo base_url('index.php/dashboard/view_truck/tidak_jalan') ?>",
                    "type": "POST",
                },
                "deferRender": true,
                "aLengthMenu": [
                    [10, 30, 50, 100],
                    [10, 30, 50, 100]
                ],
                "columns": [
                    {
                        "data": "mobil_no",
                        className: 'text-center',
                        render: function(data, type, row) {
                            let html = row["no"];
                            return html;
                        }
                    },
                    {   
                        "data": "mobil_no"
                    },
                    {
                        "data": "mobil_merk"
                    },
                    {
                        "data": "mobil_jenis"
                    },
                    {
                        "data": "mobil_dump",
                        render: function(data, type, row) {
                            if(data=="Ya"){
                                return "Dump";
                            }else{
                                return "No Dump"
                            }
                        }
                    },
                ]
            });
        });
    </script>
    <script> //script datatables kendaraan
        $(document).ready(function() {
            var table = null;
            table = $('#Table-Supir-Tidak-Jalan').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [0, 'asc']
                ],
                "ajax": {
                    "url": "<?php echo base_url('index.php/dashboard/view_supir/tidak_jalan') ?>",
                    "type": "POST",
                },
                "deferRender": true,
                "aLengthMenu": [
                    [10, 30, 50, 100],
                    [10, 30, 50, 100]
                ],
                "columns": [
                    {   
                        "data": "supir_name",
                        className: 'text-center',
                        render: function(data, type, row) {
                            let html = row["no"];
                            return html;
                        }
                    },
                    {   
                        "data": "supir_name"
                    },
                    {
                        "data": "supir_telp"
                    },
                ]
            });
        });
    </script>
    <!-- scrip angka rupiah -->
    <script>
            function rupiah(uang){
            var bilangan = uang;
            var	number_string = bilangan.toString(),
                sisa 	= number_string.length % 3,
                rupiah 	= number_string.substr(0, sisa),
                ribuan 	= number_string.substr(sisa).match(/\d{3}/g);
                    
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            // alert(rupiah);
            return rupiah;
        }
    </script>
    <!-- end script angka rupiah -->
    <script>
        function change_tanggal(data){
            var data_tanggal = data.split("-");
            var tanggal = data_tanggal[2]+"-"+data_tanggal[1]+"-"+data_tanggal[0];
            return tanggal;
        }
    </script>
     <!-- cek aktifitas pengguna -->
     <script>
        $(document).ready(function() {
            const idleDurationSecs = 900;
            const redirectUrl = '<?= base_url("index.php/login/logout")?>';
            let idleTimeout;

            const resetIdleTimeout = function() {
                if(idleTimeout){
                    clearTimeout(idleTimeout);
                }
                $.ajax({
                    type: "GET",
                    url: "<?php echo base_url('index.php/detail/getuseraktif') ?>",
                    dataType: "text",
                    success: function(data) { //jika ambil data sukses
                        if(data=="Tidak Aktif" || data=="x"){
                            location.href = redirectUrl;
                        }
                    }
                });
                idleTimeout = setTimeout(() => location.href = redirectUrl, idleDurationSecs * 1000);
            };
            
            // Key events for reset time
            resetIdleTimeout();
            window.onkeypress = resetIdleTimeout;
            window.click = resetIdleTimeout;
            window.onclick = resetIdleTimeout;
            window.onmousemove = resetIdleTimeout;
            window.onscroll = resetIdleTimeout;

        });
    </script>