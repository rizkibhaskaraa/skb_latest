<body style='background-color:#182039';> 


<div class="info-supir mt-5"  style='background-color:#182039';>
    <div class=" p-5 " style='background-color:#182039';> 
    <div class="card shadow mb-4 bg-black " style='background-color:#212B4E';>
            <div class="card-header py-3 text-center" style='background-color:#212B4E';>
            <h6 class="m-0 font-weight-bold btn-info disabled h4 p-3" style="border-radius:10px";>Job Order Belum Ada Invoice</h6>
            </div>  
            <div class="card-body row justify-content-md-center ">
                <div class="table-responsive rounded small">
                    <!-- <div class="text-center" style='background-color:#212B4E';>
                        <h5 class=" font-weight-bold text-light">Supir Tidak Jalan</h5>
                    </div> -->
                    <table class="table table-bordered text-light" id="Table-JO-Belum-Invoice"  cellspacing="0" >
                        <thead>
                        <tr>
                                <th width ="5%" class="text-center" scope="col">No</th>
                                <th width ="7%" class="text-center" scope="col">ID JO</th>
                                <th width ="9%"  class="text-center" scope="col">Tgl. JO</th>
                                <th width ="14%" class="text-center" scope="col">Driver</th>
                                <th width ="9%" class="text-center" scope="col">No Polisi</th>
                                <th width ="9%" class="text-center" scope="col">Jenis Mobil</th>
                                <th width ="17%" class="text-center" scope="col">Customer</th>
                                <th width ="12%" class="text-center" scope="col">Muatan</th>
                                <th width ="9%" class="text-center" scope="col">Dari</th>
                                <th width ="15%" class="text-center" scope="col">Ke</th>
                                <th width ="22%" class="text-center" scope="col">Tgl. Closing</th>
                                <th width ="5%" scope="col">Detail</th>
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
                <h6 class="m-0 font-weight-bold btn-warning disabled h4 p-3 text-dark" style="border-radius:10px";>Invoice Jatuh Tempo</h6>
            </div>  
            <div class="card-body row justify-content-md-center ">
                <div class="table-responsive p-1 mb-3">
                    <!-- <div class=" py-3 text-center" style='background-color:#212B4E';>
                        <h5 class="m-0 font-weight-bold text-light">Kendaraan Tidak Jalan</h5>
                    </div> -->
                    <table class="table table-bordered text-light" id="Table-Invoice-Jatuh-Tempo" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                            <th class="text-center" scope="col">No.</th>
                                <th class="text-center" scope="col">No. Invoice</th>
                                <th class="text-center" scope="col">Tgl Invoice</th>
                                <th class="text-center" scope="col">Customer</th>
                                <th class="text-center" scope="col">Nominal Invoice</th>
                                <th class="text-center" scope="col">Due Date</th>
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

</body>

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
    <!-- end cek password -->
    <script>
        $(document).ready(function() {
            var table = null;
            table = $('#Table-Invoice-Jatuh-Tempo').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [0, 'asc']
                ],
                "ajax": {
                    "url": "<?php echo base_url('index.php/dashboard/view_invoice_jatuh_tempo') ?>",
                    "type": "POST",
                },
                "deferRender": true,
                "aLengthMenu": [
                    [10, 30, 50, 100],
                    [10, 30, 50, 100]
                ],
                "columns": [
                    {
                        "data": "invoice_kode",
                        className: 'text-center',
                        render: function(data, type, row) {
                            let html = row["no"];
                            return html;
                        }
                    },
                    {
                        "data": "invoice_kode",
                        className: 'text-center'
                    },
                    {
                        "data": "tanggal_invoice",
                        className: 'text-center',
                        render: function(data, type, row) {
                            return change_tanggal(data);
                        }
                    },
                    {
                        "data": "customer_name"
                    },
                    {
                        "data": "grand_total",
                        render: function(data, type, row) {
                            let html = 'Rp.'+rupiah(data);
                            return html;
                        }
                    },
                    {
                        "data": "batas_pembayaran",
                        className: 'text-center',
                        render: function(data, type, row) {
                            return change_tanggal(row["tgl_batas_pembayaran"]);
                        }
                    },
                ]
            });
        });
    </script>
    <script> //script datatables job order
        $(document).ready(function() {
            var table = null;
            table = $('#Table-JO-Belum-Invoice').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [0, 'desc']
                ],
                "ajax": {
                    "url": "<?php echo base_url('index.php/dashboard/view_JO_no_invoice/') ?>",
                    "type": "POST"
                },
                "deferRender": true,
                "aLengthMenu": [
                    [10, 30, 50, 100],
                    [10, 30, 50, 100]
                ],
                "columns": [
                    {
                        "data": "Jo_id",
                        className: 'text-center',
                        render: function(data, type, row) {
                            let html = row["no"];
                            return html;
                        },
                    },
                    {
                        "data": "Jo_id",
                        className: 'text-center'
                    },
                    {
                        "data": "tanggal_surat",
                        className: 'text-center',
                        render: function(data, type, row) {
                            return change_tanggal(data);
                        }
                    },
                    {
                        "data": "supir_name"
                    },
                    {
                        "data": "mobil_no",
                        className: 'text-center',
                        "orderable": false,
                    },
                    {
                        "data": "mobil_jenis"
                    },
                    {
                        "data": "customer_name"
                    },
                    {
                        "data": "muatan"
                    },
                    {
                        "data": "asal"
                    },
                    {
                        "data": "tujuan"
                    },
                    {
                        "data": "tanggal_bongkar",
                        className: 'text-center',
                        render: function(data, type, row) {
                            return change_tanggal(data);
                        }
                    },
                    {
                        "data": "Jo_id",
                        "orderable": false,
                        render: function(data, type, row) {
                            let html = "<a class='btn btn-light' target='_blank' href='<?= base_url('index.php/detail/detail_jo/"+data+"/JO')?>'><i class='fas fa-eye'></i></a>";
                            return html;
                        }
                    }
                ],   
                drawCallback: function() {
                    $('.btn-detail-rute-paketan').click(function() {
                        let pk = $(this).data('pk');
                        $("#table-data-rute-paketan tbody").html("");
                        $.ajax({
                            type: "GET",
                            url: "<?php echo base_url('index.php/form/getrutepaketanbyid') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) { //jika ambil data sukses
                                let html = "";
                                for(i=0;i<data.length;i++){
                                    html += "<tr>"+
                                    "<td>"+data[i]["cudtomer"]+"</td>"+
                                    "<td>"+data[i]["dari"]+"</td>"+
                                    "<td>"+data[i]["ke"]+"</td>"+
                                    "<td>"+data[i]["muatan"]+"</td>"+
                                    "</tr>"
                                }
                                $("#table-data-rute-paketan tbody").html(html);
                            }
                        });
                    });
                    $('.btn-detail-rute-paketan-kosong').click(function() {
                        let pk = $(this).data('pk');
                        $("#table-data-rute-paketan tbody").html("");
                        $.ajax({
                            type: "GET",
                            url: "<?php echo base_url('index.php/detail/getkosongan') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) { //jika ambil data sukses
                                    let html = "";
                                    html += "<tr>"+
                                    "<td>Rute ke-1</td>"+
                                    "<td>"+data["kosongan_dari"]+"</td>"+
                                    "<td>"+data["kosongan_ke"]+"</td>"+
                                    "<td>Kosongan</td>"+
                                    "</tr>";
                                    html += "<tr>"+
                                    "<td>Rute ke-2</td>"+
                                    "<td>"+data["asal"]+"</td>"+
                                    "<td>"+data["tujuan"]+"</td>"+
                                    "<td>"+data["muatan"]+"</td>"+
                                    "</tr>";
                                $("#table-data-rute-paketan tbody").html(html);
                            }
                        });
                    });
                    $('.btn-detail-rute-paketan-reguler').click(function() {
                        let pk = $(this).data('pk');
                        $("#table-data-rute-paketan tbody").html("");
                        $.ajax({
                            type: "GET",
                            url: "<?php echo base_url('index.php/detail/getjo') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) { //jika ambil data sukses
                                    let html = "";
                                    html += "<tr>"+
                                    "<td>Rute ke-1</td>"+
                                    "<td>"+data["asal"]+"</td>"+
                                    "<td>"+data["tujuan"]+"</td>"+
                                    "<td>"+data["muatan"]+"</td>"+
                                    "</tr>";
                                $("#table-data-rute-paketan tbody").html(html);
                            }
                        });
                    });
                }
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