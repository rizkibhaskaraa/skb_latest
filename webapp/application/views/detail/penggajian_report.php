<?php
    function change_tanggal($data){
        $data_tanggal = explode('-', $data);
        $tanggal = $data_tanggal[2].'-'.$data_tanggal[1].'-'.$data_tanggal[0];
        return $tanggal;
    }
?>
<!-- tampilan detail penggajian supir -->
<body style='background-color:#182039';> 
<div class="mt-5 p-1 text-light" style='background-color:#182039'; >
    <div class="card shadow mb-4 mt-5" style='background-color:#182039';>
        <div class="card-header m-2 " style='background-color:#182039';>
            <h6 class="font-weight-bold text-light ">Seluruh Data Slip Gaji</h6>
        </div>
          <div class="conatiner w-50 m-auto">
                <div class="mb-2 mt-3 form-group row">
                    <label for="Status" class="form-label font-weight-bold col-md-4">Status</label>
                    <select name="Status" id="Status" class="form-control selectpicker col-md-8" data-live-search="true">
                        <option class="font-w700" selected value="">Semua Status</option>
                        <option value="Lunas">Lunas</option>
                        <option value="Belum Lunas">Belum Lunas</option>
                    </select>
                </div>
                <div class="mb-2 form-group row">
                    <label for="Tanggal" class="form-label font-weight-bold col-md-4">Tgl. Slip Gaji</label>
                    <input autocomplete="off" type="text" class="form-control col-md-3" id="Tanggal1" name="Tanggal1" onclick="tanggal_berlaku(this)">
                    <span class="align-middle mr-3 ml-3">s/d</span>
                    <input autocomplete="off" type="text" class="form-control col-md-3" id="Tanggal2" name="Tanggal2" onclick="tanggal_berlaku(this)">
                </div>
                <div class="mb-2 form-group row">
                    <label for="Bulan_kerja" class="form-label font-weight-bold col-md-4">Bulan Kerja</label>
                    <input autocomplete="off" type="text" class="form-control col-md-4" id="Bulan" name="Bulan" value="x">
                    <input autocomplete="off" type="text" class="form-control col-md-4" id="Tahun" name="Tahun" value="x">
                </div>
                <div class="mb-2 form-group row">
                    <label class="form-label font-weight-bold col-md-4" for="Supir">Supir</label>
                    <select name="Supir" id="Supir" class="form-control selectpicker col-md-8" data-live-search="true">
                        <option class="font-w700" selected value="">Semua Supir</option>
                        <?php foreach($supir as $value){?>
                            <option value="<?=$value["supir_id"]?>"><?=$value["supir_name"]?></option>
                        <?php }?>
                    </select>
                </div>
                <div class="mb-2 form-group row">
                    <label class="form-label font-weight-bold col-md-4" for="nopol">No Polisi</label>
                    <select name="nopol" id="nopol" class="form-control selectpicker col-md-8" data-live-search="true">
                        <option class="font-w700" selected value="">Semua No Polisi</option>
                        <?php foreach($mobil as $value){?>
                            <option value="<?=$value["mobil_no"]?>"><?=$value["mobil_no"]?></option>
                        <?php }?>
                    </select>
                </div>
                <div class="mb-2 form-group row">
                    <label for="No_Slip" class="form-label font-weight-bold col-md-4">No. Slip Gaji</label>
                    <input autocomplete="off" type="text" class="form-control col-md-2" id="No_Slip1" name="No_Slip1" value="x">
                    <input autocomplete="off" type="text" class="form-control col-md-2" id="No_Slip2" name="No_Slip2" value="Gaji" readonly>
                    <select class="form-control col-md-2" id="No_Slip3" name="No_Slip3">
                        <option value="x">Bulan</option>
                        <option value="01">Januari</option>
                        <option value="02">Februari</option>
                        <option value="03">Maret</option>
                        <option value="04">April</option>
                        <option value="05">Mei</option>
                        <option value="06">Juni</option>
                        <option value="07">Juli</option>
                        <option value="08">Agustus</option>
                        <option value="09">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                    <select class="form-control col-md-2" id="No_Slip4" name="No_Slip4">
                        <option value="x">Tahun</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                    </select>
                </div>
                <div class="row float-right form-group text-center mt-4">
                <button class="btn btn-danger mr-2" onclick="reset_form()">Reset</button>
                    <button class="btn btn-primary" id="btn-cari">Cari</button>
                    
                </div>
            </div>
            <hr>
            <div class="w-50 m-auto">
                <span>Total Data Slip Gaji Yang Ditemukan : </span><span id="ditemukan"><?= count($pembayaran_upah)?></span><br>
                <span>Total Slip Gaji Belum Dibayar : </span>Rp.<span id="tagihan"><?= number_format($gaji,2,",",".")?></span>
            </div>
            <hr>
        
        <div class="card-body" id="Table-Penggajian-Print">
        <div class=" d-flex justify-content-end mr-3 ">
            <form method="POST" action="<?= base_url("index.php/print_berkas/gaji_excel/")?>" id="convert_form" class="mr-3">
                <input type="hidden" name="file_content" id="file_content">
                <button type="submit" name="convert" id="convert" class="btn btn-success btn-sm btn-icon-split">
                    <span class="icon text-white-100">  
                        <i class="fas fa-print"></i>
                    </span>
                    <span class="text">Excel</span>
                </button>
            </form>
            <button type="submit" class="btn btn-primary btn-sm btn-icon-split" onclick="print_pdf()">
                <span class="icon text-white-100">  
                    <i class="fas fa-print"></i>
                </span>
                <span class="text">Print/PDF</span>
            </button>
        </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped text-light" id="Table-Penggajian" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center" width="10%" scope="col">No. Slip Gaji</th>
                            <th class="text-center" width="10%" scope="col">Tgl Slip Gaji</th>
                            <th class="text-center" width="10%" scope="col">Driver</th>
                            <th class="text-center" width="8%" scope="col">No Polisi</th>
                            <th class="text-center" width="8%" scope="col">Bulan Kerja</th>
                            <th class="text-center" width="10%" scope="col">Total Gaji</th>
                            <th class="text-center" width="10%" scope="col">Sisa Gaji</th>
                            <th class="text-center" width="8%" scope="col">Status</th>
                            <th class="text-center" width="5%" scope="col">Payment</th>
                            <th class="text-center" width="15%" scope="col">Detail</th>
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
<!-- end tampilan detail penggajian supir -->

     

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
                        </body>

    <!-- Bootstrap core JavaScript-->
    <script src="<?=base_url("assets/vendor/jquery/jquery.min.js")?>"></script>
    <script src="<?=base_url("assets/vendor/jquery/jquery.mask.min.js")?>"></script>
    <script src="<?=base_url("assets/vendor/bootstrap/js/bootstrap.bundle.min.js")?>"></script>    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    
    
    <!-- Core plugin JavaScript-->
    <script src="<?=base_url("assets/vendor/jquery-easing/jquery.easing.min.js")?>"></script>
    <!-- data toggle bawah -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap4-toggle/3.6.1/bootstrap4-toggle.min.js" integrity="sha512-bAjB1exAvX02w2izu+Oy4J96kEr1WOkG6nRRlCtOSQ0XujDtmAstq5ytbeIxZKuT9G+KzBmNq5d23D6bkGo8Kg==" crossorigin="anonymous"></script>

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

    <script> //script datatables
        $(document).ready(function() {
            var table = null;
            table = $('#Table-Penggajian').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "searching":false,
                "order": [
                    [1, 'desc']
                ],
                "ajax": {
                    "url": "<?php echo base_url('index.php/detail/view_laporan_penggajian/')?>",
                    "type": "POST",
                    "data":function(data){
                        data.Status = $('#Status').val();
                        data.Supir = $('#Supir').val();
                        data.Tanggal1 = $('#Tanggal1').val();
                        data.Tanggal2 = $('#Tanggal2').val();
                        data.No_Slip1 = $('#No_Slip1').val();
                        data.No_Slip2 = $('#No_Slip2').val();
                        data.No_Slip3 = $('#No_Slip3').val();
                        data.No_Slip4 = $('#No_Slip4').val();
                        data.Bulan = $('#Bulan').val();
                        data.Tahun = $('#Tahun').val();
                        data.nopol = $('#nopol').val();
                    }
                },
                "deferRender": true,
                "aLengthMenu": [
                    [50, 100],
                    [50, 100]
                ],
                "columns": [
                    {
                        "data": "pembayaran_upah_id"
                    },
                    {
                        "data": "pembayaran_upah_tanggal",
                        className: 'text-center',
                        render: function(data, type, row) {
                           return change_tanggal(data);
                        }
                    },
                    {
                        "data":"supir_name"
                    },
                    {
                        "data":"nopol"
                    },
                    {
                        "data":"bulan_kerja"
                    },
                    {
                        "data": "pembayaran_upah_total",
                        className: 'text-center',
                        render: function(data, type, row) {
                           return "Rp."+rupiah(data);
                        }
                    },
                    {
                        "data": "sisa",
                        render: function(data, type, row) {
                            let html = 'Rp.'+rupiah(data);
                            return html;
                        }
                    },
                    {
                        "data": "pembayaran_upah_status",
                        className: 'text-center font-weight-bold',
                        "orderable": false,
                        render: function(data, type, row) {
                            let html = "";
                            if(data=="Lunas"){
                                html+="<span class='text-success'>"+data+"</span>";
                            }else{
                                html+="<span class='text-danger'>"+data+"</span>";
                            }
                            return html;
                        }
                    },
                    {
                        "data": "pembayaran_upah_id",
                        className: 'text-center',
                        "orderable": false,
                        render: function(data, type, row) {
                            let html = "";
                                    if(<?= $_SESSION["payment_slip"]?>==0){
                                        html += "<a class='btn btn-light btn-alert-payment-slip'><i class='fas fa-file-invoice-dollar'></i></a>";
                                    }else{
                                        html += "<a class='btn btn-light' href='<?= base_url('index.php/payment/payment_gaji/"+data+"')?>'><i class='fas fa-file-invoice-dollar'></i></a>";
                                    }
                            return html;
                        }
                    },
                    {
                        "data": "pembayaran_upah_id",
                        className: 'text-center',
                        render: function(data, type, row) {
                            var role_user = "<?=$_SESSION['role']?>";
                            let html = "";
                            html += "<a class='btn btn-light' target='_blank' href='<?= base_url('index.php/detail/detail_penggajian_report_pembayaran/')?>"+row["supir_id"]+"/"+data+"'><i class='fas fa-eye'></i></a>";
                            if(role_user=="Supervisor"){
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/detail/getnumpaymentupah') ?>",
                                    dataType: "text",
                                    async:false,
                                    data: {
                                        id : data,
                                    },
                                    success: function(hasil) { //jika ambil hasil sukses
                                        if(hasil>0){
                                            html += "<a class='btn btn-light mr-1 ml-1 btn-alert-edit-slip'><i class='fas fa-pen-square'></i></a>";
                                        }else{
                                            html += "<a class='btn btn-light mr-1 ml-1 btn-update-slip' href='<?= base_url("index.php/form/edit_slip/")?>"+data+"'><i class='fas fa-pen-square'></i></a>";
                                        }
                                    }
                                });
                                html += "<a class='btn btn-light btn-delete-slip' href='javascript:void(0)' data-pk="+data+"><i class='fas fa-trash-alt'></i></a>";
                            }
                            return html;
                        }
                    },
                ],
                drawCallback: function() {
                    $('.btn-delete-slip').click(function() {
                        let pk = $(this).data('pk');
                        $.ajax({
                            type: "GET",
                            url: "<?php echo base_url('index.php/detail/getnumpaymentupah') ?>",
                            dataType: "text",
                            data: {
                                id : pk,
                            },
                            success: function(data) { //jika ambil data sukses
                                if(data>0){
                                    Swal.fire({
                                        title: 'Hapus Data Slip Gaji',
                                        text:'Maaf Slip Gaji Ini Sudah Melakukan Pembayaran',
                                        icon: "warning",
                                        time: 2000
                                    })
                                }else{
                                    Swal.fire({
                                        title: 'Hapus Data Slip Gaji',
                                        text:'Yakin Anda Ingin Menghapus Data Slip Gaji Ini?',
                                        showDenyButton: true,
                                        denyButtonText: `Batal`,
                                        confirmButtonText: 'Hapus',
                                        denyButtonColor: '#808080',
                                        confirmButtonColor: '#FF0000',
                                        icon: "warning",
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.replace("<?= base_url('index.php/form/deleteslip/')?>"+pk);
                                        }
                                    })
                                }
                            }
                        });
                    });
                    $('.btn-alert-edit-slip').click(function() {
                        Swal.fire({
                            title: 'Edit Data Slip Gaji',
                            text:'Maaf Slip Gaji Ini Sudah Melakukan Pembayaran',
                            icon: "warning",
                            time: 2000
                        })
                    });
                    $('.btn-alert-payment-slip').click(function() {
                        Swal.fire({
                            title: 'Pembayaran Slip Gaji',
                            text:'Maaf Anda Tidak Memiliki Akses Untuk Melakukan Pembayaran',
                            icon: "warning",
                            time: 2000
                        })
                    });
                },
            });
            $("#btn-cari").click(function() {
                if($('#Tanggal1').val()==""){
                    if($('#Tanggal2').val()!=""){
                        alert("Silakan Isi Kedua Tgl. Slip Gaji / Tidak Diisi Keduanya");
                        $('#Tanggal1').val("");
                        $('#Tanggal2').val("");
                    }else{
                        table.ajax.reload();
                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url('index.php/detail/getditemukanslip') ?>",
                            dataType: "text",
                            data: {
                                Status : $('#Status').val(),
                                Supir : $('#Supir').val(),
                                Tanggal1 : $('#Tanggal1').val(),
                                Tanggal2 : $('#Tanggal2').val(),
                                No_Slip1 : $('#No_Slip1').val(),
                                No_Slip2 : $('#No_Slip2').val(),
                                No_Slip3 : $('#No_Slip3').val(),
                                No_Slip4 : $('#No_Slip4').val(),
                                Bulan : $('#Bulan').val(),
                                Tahun : $('#Tahun').val(),
                                nopol : $('#nopol').val(),
                            },
                            success: function(data) { //jika ambil data sukses
                                hasil = data.split("=");
                                $("#ditemukan").text(hasil[0]);
                                $("#tagihan").text(hasil[1]);
                            }
                        });
                    }
                }else if($('#Tanggal2').val()==""){
                    if($('#Tanggal1').val()!=""){
                        alert("Silakan Isi Kedua Tgl. Slip Gaji / Tidak Diisi Keduanya");
                        $('#Tanggal1').val("");
                        $('#Tanggal2').val("");
                    }else{
                        table.ajax.reload();
                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url('index.php/detail/getditemukanslip') ?>",
                            dataType: "text",
                            data: {
                                Status : $('#Status').val(),
                                Supir : $('#Supir').val(),
                                Tanggal1 : $('#Tanggal1').val(),
                                Tanggal2 : $('#Tanggal2').val(),
                                No_Slip1 : $('#No_Slip1').val(),
                                No_Slip2 : $('#No_Slip2').val(),
                                No_Slip3 : $('#No_Slip3').val(),
                                No_Slip4 : $('#No_Slip4').val(),
                                Bulan : $('#Bulan').val(),
                                Tahun : $('#Tahun').val(),
                                nopol : $('#nopol').val(),
                            },
                            success: function(data) { //jika ambil data sukses
                                hasil = data.split("=");
                                $("#ditemukan").text(hasil[0]);
                                $("#tagihan").text(hasil[1]);
                            }
                        });
                    }
                }
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#convert').click(function() {
                var tabel = document.getElementById("Table-Penggajian").rows;
                var bacabaris = tabel.length;
                for(var i=0;i<bacabaris;i++){
                    tabel[i].deleteCell(-1);
                    tabel[i].deleteCell(-1);
                }
                var table_content = '<table>';
                table_content += $("head").html()+$('#Table-Penggajian').html();
                table_content += '</table>';
                $('#file_content').val(table_content);
                $('#convert_form').html();
                location.reload();
            });
        });
        function print_pdf(){
            var tabel = document.getElementById("Table-Penggajian").rows;
            var bacabaris = tabel.length;
            for(var i=0;i<bacabaris;i++){
                tabel[i].deleteCell(-1);
                tabel[i].deleteCell(-1);
            }
            var restorepage = document.body.innerHTML;
            var printcontent = document.getElementById('Table-Penggajian-Print').innerHTML;
            document.body.innerHTML = printcontent;
            window.print();
            document.body.innerHTML = restorepage;
            location.reload();
        }
    </script>
    <script>
        function change_tanggal(data){
            if(data==""){
                return "";
            }else{
                var data_tanggal = data.split("-");
                var tanggal = data_tanggal[2]+"-"+data_tanggal[1]+"-"+data_tanggal[0];
                return tanggal;
            }
        }
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
        function reset_form(){
            location.reload();
        }
        function tanggal_berlaku(a){
            // alert(a.id);
            Swal.fire({
                title: "Loading",
                icon: "success",
                text: "Mohon Tunggu Sebentar",
                type: "success",
                timer: 1
            });
            $("#"+a.id).datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true,
                todayHighlight: true,
            });
        }
    </script>

    <script>
        var edit_slip_gaji = '<?= $this->session->flashdata('status-edit-slip-gaji'); ?>';
        var delete_slip_gaji = '<?= $this->session->flashdata('status-delete-slip'); ?>';
        var insert_payment_upah = '<?= $this->session->flashdata('status-insert-payment-upah'); ?>';
            if(insert_payment_upah == "Berhasil"){
                Swal.fire({
                        title: "Berhasil",
                        icon: "success",
                        text: "Menambahkan Data Payment Slip Gaji",
                        type: "success",
                        timer: 2000
                    });
            }
            if(edit_slip_gaji == "Berhasil"){
                Swal.fire({
                        title: "Berhasil",
                        icon: "success",
                        text: "Mengubah Data Slip Gaji",
                        type: "success",
                        timer: 2000
                    });
            }
            if(delete_slip_gaji == "Berhasil"){
                Swal.fire({
                        title: "Berhasil",
                        icon: "success",
                        text: "Hapus Data Slip Gaji",
                        type: "error",
                        timer: 2000
                    });
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