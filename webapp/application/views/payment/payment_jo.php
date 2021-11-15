<?php 
    function change_tanggal($tanggal){
        if($tanggal==""){
            return "";
        }else{
            $tanggal_array = explode("-",$tanggal);
            return $tanggal_array[2]."-".$tanggal_array[1]."-".$tanggal_array[0];   
        }
    }
?>
<body style='background-color:#182039';> 
<div class="mt-5 p-3" style='background-color:#182039';>
    <div class="card shadow mb-2 mt-3" style='background-color:#182039';>
        <div class="card-header " style='background-color:#182039';>
            <h6 class="m-0 font-weight-bold text-light">Payment Job Order</h6>
        </div>
        <div class="card-body text-light">
        <form action="<?=base_url("index.php/form/insert_payment_jo/").$jo_id?>" method="POST">
            <div class="row">
                <div class="col-md-6 ">
                    <div class="form-group row mt-3">
                        <label for="jo_id" class="form-label col-sm-5 font-weight-bold">ID Job Order(JO)</label>
                        <div class="col-sm-7">  
                            <input autocomplete="off" type="text" class="form-control col-md-10" id="jo_id" name="jo_id" readonly value="<?= $jo["Jo_id"]?>">
                        </div>
                    </div>          
                    <div class="form-group row">
                        <label for="jo_tanggal" class="form-label col-sm-5 font-weight-bold">Tgl.Job Order</label>
                        <div class="col-sm-7">
                            <input autocomplete="off" type="text" class="form-control col-md-10" id="jo_tanggal" name="jo_tanggal" readonly value="<?= change_tanggal($jo["tanggal_surat"])?>">
                        </div>
                    </div>          
                    <div class="form-group row">
                        <label for="supir_name" class="form-label col-sm-5 font-weight-bold">Driver</label>
                        <div class="col-sm-7">
                            <input autocomplete="off" type="text" class="form-control col-md-10" id="supir_name" name="supir_name" readonly value="<?= $jo["supir_name"]?>">
                        </div>
                    </div>          
                    <div class="form-group row">
                        <label for="mobil_no" class="form-label col-sm-5 font-weight-bold">No Polisi</label>
                        <div class="col-sm-7">
                            <input autocomplete="off" type="text" class="form-control col-md-10" id="mobil_no" name="mobil_no" readonly value="<?= $jo["mobil_no"]?>">
                        </div>
                    </div>          
                    <div class="form-group row">
                        <label for="customer_name" class="form-label col-sm-5 font-weight-bold">Customer</label>
                        <div class="col-sm-7">
                            <input autocomplete="off" type="text" class="form-control col-md-10" id="customer_name" name="customer_name" readonly value="<?= $jo["customer_name"]?>">
                        </div>
                    </div>          
                    <div class="form-group row">
                        <label for="muatan" class="form-label col-sm-5 font-weight-bold">Muatan</label>
                        <div class="col-sm-7">
                            <input autocomplete="off" type="text" class="form-control col-md-10" id="muatan" name="muatan" readonly value="<?= $jo["muatan"]?>">
                        </div>
                    </div>          
                    <div class="form-group row">
                        <label for="asal" class="form-label col-sm-5 font-weight-bold">Dari</label>
                        <div class="col-sm-7">
                            <input autocomplete="off" type="text" class="form-control col-md-10" id="asal" name="asal" readonly value="<?= $jo["asal"]?>">
                        </div>
                    </div>          
                    <div class="form-group row">
                        <label for="tujuan" class="form-label col-sm-5 font-weight-bold">Ke</label>
                        <div class="col-sm-7">
                            <input autocomplete="off" type="text" class="form-control col-md-10" id="tujuan" name="tujuan" readonly value="<?= $jo["tujuan"]?>">
                        </div>
                    </div>          
                    <div class="form-group row">
                        <label for="uang_total" class="form-label col-sm-5 font-weight-bold">Total Uang Jalan</label>
                        <div class="col-sm-7">
                            <input autocomplete="off" type="text" class="form-control col-md-10" id="uang_total" name="uang_total" readonly value="<?= number_format($jo["uang_total"],0,',','.')?>">
                        </div>
                    </div>          
                    <div class="form-group row">
                        <label for="uang_sisa" class="form-label col-sm-5 font-weight-bold">Sisa Uang Jalan</label>
                        <div class="col-sm-7">
                            <input autocomplete="off" type="text" class="form-control col-md-10" id="uang_sisa" name="uang_sisa" readonly value="<?= number_format($jo["sisa"],0,',','.')?>">
                        </div>
                    </div>   
                </div>                
                <div class="col-md-6 ">
                    <div class="form-group row mt-3">
                        <label for="payment_jo_tgl" class="form-label font-weight-bold col-sm-5">Tgl.Pembayaran</label>
                        <div class="col-sm-7">
                            <input autocomplete="off" type="text" class="form-control" id="payment_jo_tgl" name="payment_jo_tgl" required readonly value="<?= date('d-m-Y')?>">
                        </div>
                    </div>    
                    <div class="form-group row mt-3">
                        <label for="payment_jo_nominal" class="col-form-label col-sm-5 font-weight-bold">Nominal Pembayaran</label>
                        <div class="col-sm-7">
                            <input autocomplete="off" type="text" class="form-control" id="payment_jo_nominal" name="payment_jo_nominal" required onkeyup="cek_bayar(this)">
                        </div>
                    </div>
                    <div class="form-group row mt-3">
                        <label class="form-label font-weight-bold col-sm-5" for="payment_jo_jenis">Jenis Pembayaran</label>
                        <div class="col-sm-7">
                            <select name="payment_jo_jenis" id="payment_jo_jenis" class="form-control custom-select" required>
                                <option class="font-w700" disabled="disabled" selected value="">Jenis Pembayaran</option>
                                <option value="Tunai">Tunai</option>
                                <option value="Transfer">Transfer</option>
                            </select>
                        </div>
                    </div> 
                    <div class="form-group row mt-3">
                        <label for="payment_jo_keterangan" class="form-label font-weight-bold col-sm-5">Keterangan</label>
                        <div class="col-sm-7">
                            <textarea class="form-control" name="payment_jo_keterangan" id="payment_jo_keterangan" rows="3"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <?php if($jo["sisa"]!=0){?>
                <div class="row float-right mr-3">
                   
                    <button type="reset" class="btn btn-danger mr-2" onclick="reset_form()">Batal</button>
                    <button type="submit" class="btn btn-success ">Simpan</button>
                </div>
            <?php }else{?>
                <div class="row text-center mt-2 mb-2 large">
                    <span class="btn btn-success p-4  w-100 font-weight-bolder active">Uang Jalan Sudah Lunas</span>
                </div>
            <?php } ?>
        </form>
        </div>
    </div>
</div>
<div class="p-3 " style='background-color:#182039';>
    <div class="card shadow mb-4" style='background-color:#182039';>
        <div class="card-header py-3" style='background-color:#182039';>
            <h6 class="m-0 font-weight-bold text-light float-left">Data Pembayaran Uang Jalan Untuk Job Order #<?= $jo_id?></h6>
        </div>
        <!-- tabel data cutomer -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-light" id="" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center" width="3%" scope="col">Tanggal</th>
                            <th class="text-center" width="10%" scope="col">Nominal</th>
                            <th class="text-center" width="5%" scope="col">Jenis Pembayaran</th>
                            <th class="text-center" width="10%" scope="col">Keterangan</th>
                            <th class="text-center" width="5%" scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($payment_jo as $value){?>
                            <tr>
                                <td><?= change_tanggal($value["payment_jo_tgl"])?></td>
                                <td>Rp.<?= number_format($value["payment_jo_nominal"],0,',','.')?></td>
                                <td><?= $value["payment_jo_jenis"]?></td>
                                <td><?= $value["payment_jo_keterangan"]?></td>
                                <td>
                                <?php if($_SESSION['role']=="Supervisor"){?>
                                    <a class='btn btn-light' target='_blank' href='<?= base_url('index.php/detail/detail_jo/'.$jo["Jo_id"].'/JO')?>'><i class='fas fa-eye'></i></a>
                                    <a class='btn btn-light ' href='<?= base_url('index.php/print_berkas/uang_jalan/'.$value["payment_jo_id"].'/'.$jo["Jo_id"])?>'><i class='fas fa-print'></i></a>
                                    <a class='btn btn-light' id="<?= $value["payment_jo_id"]?>" 
                                        <?php if($jo["status"]!="Sampai Tujuan"){?>
                                            data-toggle="modal" data-target="#popup-edit-payment-jo"
                                        <?php }?>
                                        onclick="edit_payment_jo(this)"
                                        ><i class='fas fa-pen-square'></i></a>
                                    <a class='btn btn-light' id="<?= $value["payment_jo_id"]?>" onclick="delete_payment_jo(this)"><i class='fas fa-trash-alt'></i></a>
                                <?php }?>
                                </td>
                            </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- end tabel data cutomer -->
    </div>
</div>
<div class="modal fade mt-3" id="popup-edit-payment-jo" tabindex="0" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content text-light" style='background-color:#182039';>
            <div class="modal-header bg-primary-dark">
                <h5 class="font-weight-bold">Edit Data Payment Job Order</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="font-size-sm m-3 text-justify">
                <form action="<?= base_url("index.php/form/update_payment_jo")?>" method="POST">
                    <input type="text" name=payment_now id=payment_now hidden>
                    <input type="text" name=payment_jo_id_update id=payment_jo_id_update hidden>
                    <div class="form-group row mt-3">
                        <label for="jo_id_update" class="form-label col-sm-5 font-weight-bold">NO Job Order</label>
                        <div class="col-sm-7">
                            <input autocomplete="off" type="text" class="form-control" id="jo_id_update" name="jo_id_update" readonly value="<?= $jo_id?>">
                        </div>
                    </div>   
                    <div class="form-group row mt-3">
                        <label for="payment_jo_nominal_update" class="col-form-label col-sm-5 font-weight-bold">Nominal Pembayaran</label>
                        <div class="col-sm-7">
                            <input autocomplete="off" type="text" class="form-control" id="payment_jo_nominal_update" name="payment_jo_nominal_update" required onkeyup="cek_bayar_edit(this)">
                        </div>
                    </div>
                    <div class="form-group row mt-3">
                        <label for="payment_jo_tgl_update" class="form-label font-weight-bold col-sm-5">Tgl.Pembayaran</label>
                        <div class="col-sm-7">
                            <input autocomplete="off" type="text" class="form-control" id="payment_jo_tgl_update" name="payment_jo_tgl_update" required onclick="tanggal_berlaku(this)">
                        </div>
                    </div>    
                    <div class="form-group row mt-3">
                        <label class="form-label font-weight-bold col-sm-5" for="payment_jo_jenis_update">Jenis Pembayaran</label>
                        <div class="col-sm-7">
                            <select name="payment_jo_jenis_update" id="payment_jo_jenis_update" class="form-control custom-select" required>
                                <option class="font-w700" disabled="disabled" selected value="">Jenis Pembayaran</option>
                                <option value="Tunai">Tunai</option>
                                <option value="Transfer">Transfer</option>
                            </select>
                        </div>
                    </div> 
                    <div class="form-group row mt-3">
                        <label for="payment_jo_keterangan_update" class="form-label font-weight-bold col-sm-5">Keterangan</label>
                        <div class="col-sm-7">
                            <textarea class="form-control" name="payment_jo_keterangan_update" id="payment_jo_keterangan_update" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success mb-3 float-right">Simpan</button>
                    </div>
                </form>
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

                                        </body>
    <!-- Bootstrap core JavaScript-->
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
        $(function(){     
            $("#payment_jo_tgl_update").datepicker({
                format: 'dd-mm-yyyy'
            });
        });
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
        function change_tanggal(data){
            var data_tanggal = data.split("-");
            var tanggal = data_tanggal[2]+"-"+data_tanggal[1]+"-"+data_tanggal[0];
            return tanggal;
        }
        function reset_form(){
            location.replace("<?= base_url("index.php/home")?>");
        }
        function cek_bayar(a){
            if($("#"+a.id).val()[0]=="0"){
                var string_now = $("#"+a.id).val().replace("0","");
                $("#"+a.id).val(string_now);
            }
            var sisa = 0;
            if($("#uang_sisa").val().replaceAll(".","") == ""){
                sisa = 0;
            }else{
                sisa = $("#uang_sisa").val().replaceAll(".","");
            }
            $( '#'+a.id ).mask('000.000.000', {reverse: true});
            var bayar = $("#"+a.id).val().replaceAll(".","");   
            if(bayar == ""){
                bayar = 0;
            }
            if(parseInt(sisa)<parseInt(bayar)){
                Swal.fire({
                    title: "Peringatan",
                    icon: "error",
                    text: 'Jumlah Pembayaran Harus Lebih Kecil Dari Rp.'+ rupiah(sisa),
                    type: "error"
                });
                $( '#'+a.id ).val("");
            }
        }
        function cek_bayar_edit(a){
            $( '#'+a.id ).mask('000.000.000', {reverse: true});
            bayar_saat_ini = parseInt($("#payment_now").val().replaceAll(".",""))+parseInt($("#uang_sisa").val().replaceAll(".",""));
            var bayar = $("#"+a.id).val().replaceAll(".","");   
            if(bayar == ""){
                bayar = 0;
            }
            if(parseInt(bayar_saat_ini)<parseInt(bayar)){
                Swal.fire({
                    title: "Peringatan",
                    icon: "error",
                    text: 'Jumlah Pembayaran Harus Lebih Kecil Dari Rp.'+ rupiah(bayar_saat_ini),
                    type: "error"
                });
                $( '#'+a.id ).val("");
            }
        }
        function delete_payment_jo(a){
            let pk = a.id;
            var status_jo='<?= $jo["status"]?>';
            if(status_jo!="Sampai Tujuan"){
                Swal.fire({
                    title: 'Hapus Data Payment Job Order',
                    text:'Yakin Anda Ingin Menghapus Data Payment Job Order Ini?',
                    showDenyButton: true,
                    denyButtonText: `Batal`,
                    confirmButtonText: 'Hapus',
                    denyButtonColor: '#808080',
                    confirmButtonColor: '#FF0000',
                    icon: "warning",
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.replace("<?= base_url('index.php/form/deletepaymentjo/')?>"+pk);
                    }
                })
            }else{
                Swal.fire({
                    title: 'Hapus Data Payment Jo',
                    text:'Maaf Tidak Bisa Hapus Payment,Job Order Ini Sudah Selesai',
                    icon: "warning",
                    time: 2000
                });
            }
        }
        
        function edit_payment_jo(a) {
            var status_jo="<?= $jo["status"]?>";
            let pk = a.id;
            if(status_jo!="Sampai Tujuan"){
                $.ajax({ //ajax ambil data bon
                    type: "GET",
                    url: "<?php echo base_url('index.php/detail/getpaymentjo') ?>",
                    dataType: "JSON",
                    data: {
                        id: pk
                    },
                    success: function(data) { //jika ambil data sukses
                        $('#payment_now').val(data["payment_jo_nominal"]); //set value
                        $('#payment_jo_id_update').val(data["payment_jo_id"]); //set value
                        $('#payment_jo_tgl_update').val(change_tanggal(data["payment_jo_tgl"])); //set value
                        $('#payment_jo_nominal_update').val(rupiah(data["payment_jo_nominal"])); //set value
                        $('#payment_jo_keterangan_update').val(data["payment_jo_keterangan"]); //set value
                        $('#payment_jo_jenis_update').val(data["payment_jo_jenis"]); //set value
                    }
                });
            }else{
                Swal.fire({
                    title: 'Edit Data Payment Jo',
                    text:'Maaf Tidak Bisa Edit Payment,Job Order Ini Sudah Selesai',
                    icon: "warning",
                    time: 2000
                })
            }
        };
    </script>
    <script>
    var delete_payment = '<?= $this->session->flashdata('status-delete-payment-jo'); ?>';
    var update_payment = '<?= $this->session->flashdata('status-edit-payment-jo'); ?>';
        if(delete_payment == "Berhasil"){
            Swal.fire({
                    title: "Hapus Data Payment Job Order",
                    icon: "success",
                     text: "Berhasil Hapus Data Payment Job Order",
                     type: "error",
                     timer: 2000
                 });
        }
        if(update_payment == "Berhasil"){
            Swal.fire({
                     title: "Update Data Payment Job Order",
                     icon: "success",
                     text: "Berhasil Update Data Payment Job Order",
                     type: "success",
                     timer: 2000
                 });
        }
    </script>
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