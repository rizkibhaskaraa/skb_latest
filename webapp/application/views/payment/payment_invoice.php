<?php 
    function change_tanggal($tanggal){
        if($tanggal==""){
            return "";
        }else{
            $tanggal_array = explode("-",$tanggal);
            return $tanggal_array[2]."-".$tanggal_array[1]."-".$tanggal_array[0];   
        }
    }
    $tanggal_now = date("d-m-Y");
    $tgl_invoice = strtotime($invoice["tanggal_invoice"]);
?>
<body style='background-color:#182039';> 
<div class="mt-5 p-5" style='background-color:#182039';>
    <div class="card shadow mb-2 mt-3"  style='background-color:#182039';>
        <div class="card-header " style='background-color:#182039';>
            <h6 class="m-0 font-weight-bold text-light">Payment Invoice</h6>
        </div>
        <div class="card-body text-light">
            <form action="<?=base_url("index.php/form/insert_payment_invoice/").$invoice_kode?>" method="POST">
                <div class="row">
                    <div class="col-md-6 ">
                        <div class="form-group row mt-3">
                            <label for="invoice_kode" class="form-label col-sm-5 font-weight-bold">NO Invoice</label>
                            <div class="col-sm-7">
                                <input autocomplete="off" type="text" class="form-control col-md-10" id="invoice_kode" name="invoice_kode" readonly value="<?= $invoice["invoice_kode"]?>">
                            </div>
                        </div>          
                        <div class="form-group row">
                            <label for="invoice_tanggal" class="form-label col-sm-5 font-weight-bold">Tgl.Invoice</label>
                            <div class="col-sm-7">
                                <input autocomplete="off" type="text" class="form-control col-md-10" id="invoice_tanggal" name="invoice_tanggal" readonly value="<?= change_tanggal($invoice["tanggal_invoice"])?>">
                            </div>
                        </div>          
                        <div class="form-group row">
                            <label for="customer_name" class="form-label col-sm-5 font-weight-bold">Customer</label>
                            <div class="col-sm-7">
                                <input autocomplete="off" type="text" class="form-control col-md-10" id="customer_name" name="customer_name" readonly value="<?= $invoice["customer_name"]?>">
                            </div>
                        </div>          
                        <div class="form-group row">
                            <label for="invoice_tagihan" class="form-label col-sm-5 font-weight-bold">Total Tagihan</label>
                            <div class="col-sm-7">
                                <input autocomplete="off" type="text" class="form-control col-md-10" id="invoice_tagihan" name="invoice_tagihan" readonly value="<?= number_format($invoice["grand_total"],0,',','.')?>">
                            </div>
                        </div>          
                        <div class="form-group row">
                            <label for="invoice_sisa_tagihan" class="form-label col-sm-5 font-weight-bold">Sisa Tagihan</label>
                            <div class="col-sm-7">
                                <input autocomplete="off" type="text" class="form-control col-md-10" id="invoice_sisa_tagihan" name="invoice_sisa_tagihan" readonly value="<?= number_format($invoice["sisa"],0,',','.')?>">
                            </div>
                        </div>          
                        <div class="form-group row">
                            <label for="invoice_top" class="form-label col-sm-5 font-weight-bold">TOP</label>
                            <div class="col-sm-7">
                                <input autocomplete="off" type="text" class="form-control col-md-10" id="invoice_top" name="invoice_top" readonly value="<?= $invoice["batas_pembayaran"]?>">
                            </div>
                        </div>          
                        <div class="form-group row">
                            <label for="invoice_status" class="form-label font-weight-bold col-sm-5">Status</label>
                            <div class="col-sm-7">
                                <input autocomplete="off" type="text" class="form-control col-md-10" id="invoice_status" name="invoice_status" readonly value="<?= $invoice["status_bayar"]?>">
                            </div>
                        </div>          
                        
                    </div>
                    <div class="col-md-6 ">
                        <div class="form-group row mt-3">
                            <label for="payment_invoice_tgl" class="form-label font-weight-bold col-sm-5">Tgl.Pembayaran</label>
                            <div class="col-sm-7">
                                <input autocomplete="off" type="text" class="form-control" id="payment_invoice_tgl" name="payment_invoice_tgl" required onclick="tanggal_berlaku(this)" onchange="check_tanggal(this)" value="<?= date('d-m-Y')?>">
                            </div>
                        </div>    
                        <div class="form-group row mt-3">
                            <label for="payment_invoice_nominal" class="col-form-label col-sm-5 font-weight-bold">Nominal Pembayaran</label>
                            <div class="col-sm-7">
                                <input autocomplete="off" type="text" class="form-control" id="payment_invoice_nominal" name="payment_invoice_nominal" required onkeyup="cek_bayar(this)">
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <label class="form-label font-weight-bold col-sm-5" for="payment_invoice_jenis">Jenis Pembayaran</label>
                            <div class="col-sm-7">
                                <select name="payment_invoice_jenis" id="payment_invoice_jenis" class="form-control custom-select" required>
                                    <option class="font-w700" disabled="disabled" selected value="">Jenis Pembayaran</option>
                                    <option value="Tunai">Tunai</option>
                                    <option value="Transfer">Transfer</option>
                                </select>
                            </div>
                        </div> 
                        <div class="form-group row mt-3">
                            <label for="payment_invoice_keterangan" class="form-label font-weight-bold col-sm-5">Keterangan</label>
                            <div class="col-sm-7">
                                <textarea class="form-control" name="payment_invoice_keterangan" id="payment_invoice_keterangan" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if($invoice["status_bayar"]!="Lunas"){?>
                    <div class="row float-right">
                        <button type="reset" class="btn btn-danger mt-3 mr-2" onclick="reset_form()">Batal</button>
                        <button type="submit" class="btn btn-success mt-3 mr-3">Simpan</button>
                   
                    </div>
                <?php }else{?>
                    <div class="row text-center mt-2 mb-2 large">
                        <span class="btn btn-success p-4  w-100 font-weight-bolder active">Invoice Sudah Lunas</span>
                    </div>
                <?php } ?>
            </form>
        </div>
    </div>
</div>
<div class="col-12" style='background-color:#182039';>
    <div class="card shadow text-light" style='background-color:#182039';>
        <div class="card-header py-3" style='background-color:#182039';>
            <h6 class="m-0 font-weight-bold text-light float-left">Data Pembayaran Invoice <?= $invoice["invoice_kode"]?></h6>
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
                            <th class="text-center" width="10%" scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($payment_invoice as $value){?>
                            <tr>
                                <td class="text-center"><?= change_tanggal($value["payment_invoice_tgl"])?></td>
                                <td>Rp.<?= number_format($value["payment_invoice_nominal"],0,',','.')?></td>
                                <td class="text-center"><?= $value["payment_invoice_jenis"]?></td>
                                <td><?= $value["payment_invoice_keterangan"]?></td>
                                <td class="text-center">
                                <?php if($_SESSION['role']=="Supervisor"){?>
                                    <a class='btn btn-light' id="<?= $value["payment_invoice_id"]?>" onclick="edit_payment_invoice(this)" data-toggle="modal" data-target="#popup-edit-payment-invoice"><i class='fas fa-pen-square'></i></a>
                                    <a class='btn btn-light' id="<?= $value["payment_invoice_id"]?>" onclick="delete_payment_invoice(this)"><i class='fas fa-trash-alt'></i></a>
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
<div class="modal fade mt-3" id="popup-edit-payment-invoice" tabindex="0" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content text-light" style='background-color:#212B4E';>
            <div class="modal-header bg-primary-dark">
                <h5 class="font-weight-bold">Edit Data Payment Invoice</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="font-size-sm m-3 text-justify">
                <form action="<?= base_url("index.php/form/update_payment_invoice")?>" method="POST">
                    <input type="text" name=payment_now id=payment_now hidden>
                    <input type="text" name=payment_invoice_id_update id=payment_invoice_id_update hidden>
                    <div class="form-group row mt-3">
                        <label for="invoice_kode_update" class="form-label col-sm-5 font-weight-bold">NO Invoice</label>
                        <div class="col-sm-7">
                            <input autocomplete="off" type="text" class="form-control col-md-10" id="invoice_kode_update" name="invoice_kode_update" readonly value="<?= $invoice["invoice_kode"]?>">
                        </div>
                    </div>   
                    <div class="form-group row mt-3">
                        <label for="payment_invoice_nominal_update" class="col-form-label col-sm-5 font-weight-bold">Nominal Pembayaran</label>
                        <div class="col-sm-7">
                            <input autocomplete="off" type="text" class="form-control" id="payment_invoice_nominal_update" name="payment_invoice_nominal_update" required onkeyup="cek_bayar_edit(this)">
                        </div>
                    </div>
                    <div class="form-group row mt-3">
                        <label for="payment_invoice_tgl_update" class="form-label font-weight-bold col-sm-5">Tgl.Pembayaran</label>
                        <div class="col-sm-7">
                            <input autocomplete="off" type="text" class="form-control" id="payment_invoice_tgl_update" name="payment_invoice_tgl_update" required onclick="tanggal_berlaku(this)">
                        </div>
                    </div>    
                    <div class="form-group row mt-3">
                        <label class="form-label font-weight-bold col-sm-5" for="payment_invoice_jenis_update">Jenis Pembayaran</label>
                        <div class="col-sm-7">
                            <select name="payment_invoice_jenis_update" id="payment_invoice_jenis_update" class="form-control custom-select" required>
                                <option class="font-w700" disabled="disabled" selected value="">Jenis Pembayaran</option>
                                <option value="Tunai">Tunai</option>
                                <option value="Transfer">Transfer</option>
                            </select>
                        </div>
                    </div> 
                    <div class="form-group row mt-3">
                        <label for="payment_invoice_keterangan_update" class="form-label font-weight-bold col-sm-5">Keterangan</label>
                        <div class="col-sm-7">
                            <textarea class="form-control" name="payment_invoice_keterangan_update" id="payment_invoice_keterangan_update" rows="3"></textarea>
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
    <!-- Bootstrap core JavaScript-->


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
                format: 'dd-mm-yyyy'
            });
        }
    </script>
    <!-- end script angka rupiah -->
    <script>
        function change_tanggal(data){
            var data_tanggal = data.split("-");
            var tanggal = data_tanggal[2]+"-"+data_tanggal[1]+"-"+data_tanggal[0];
            return tanggal;
        }
        function reset_form(){
            location.replace("<?= base_url("index.php/home/invoice_customer")?>");
        }
    </script>
    <script>
        function cek_bayar(a){
            if($("#"+a.id).val()[0]=="0"){
                var string_now = $("#"+a.id).val().replace("0","");
                $("#"+a.id).val(string_now);
            }
            var sisa = 0;
            if($("#invoice_sisa_tagihan").val().replaceAll(".","") == ""){
                sisa = 0;
            }else{
                sisa = $("#invoice_sisa_tagihan").val().replaceAll(".","");
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
            if($("#"+a.id).val()[0]=="0"){
                var string_now = $("#"+a.id).val().replace("0","");
                $("#"+a.id).val(string_now);
            }
            $( '#'+a.id ).mask('000.000.000', {reverse: true});
            bayar_saat_ini = parseInt($("#payment_now").val().replaceAll(".",""))+parseInt($("#invoice_sisa_tagihan").val().replaceAll(".",""));
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
    </script>
    <script>
        function delete_payment_invoice(a){
                        let pk = a.id;
                        Swal.fire({
                            title: 'Hapus Data Payment Invoice',
                            text:'Yakin Anda Ingin Menghapus Data Payment Invoice Ini?',
                            showDenyButton: true,
                            denyButtonText: `Batal`,
                            confirmButtonText: 'Hapus',
                            denyButtonColor: '#808080',
                            confirmButtonColor: '#FF0000',
                            icon: "warning",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.replace("<?= base_url('index.php/form/deletepaymentinvoice/')?>"+pk);
                            }
                        })
        };
        
        function edit_payment_invoice(a) {
                        let pk = a.id;
                        $.ajax({ //ajax ambil data bon
                            type: "GET",
                            url: "<?php echo base_url('index.php/detail/getpaymentinvoice') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) { //jika ambil data sukses
                                $('#payment_now').val(data["payment_invoice_nominal"]); //set value
                                $('#invoice_kode_update').val(data["invoice_id"]); //set value
                                $('#payment_invoice_id_update').val(data["payment_invoice_id"]); //set value
                                $('#payment_invoice_tgl_update').val(change_tanggal(data["payment_invoice_tgl"])); //set value
                                $('#payment_invoice_nominal_update').val(rupiah(data["payment_invoice_nominal"])); //set value
                                $('#payment_invoice_keterangan_update').val(data["payment_invoice_keterangan"]); //set value
                                $('#payment_invoice_jenis_update').val(data["payment_invoice_jenis"]); //set value
                            }
                        });
                    };
    </script>
    <script>
    var delete_payment = '<?= $this->session->flashdata('status-delete-payment-invoice'); ?>';
    var update_payment = '<?= $this->session->flashdata('status-edit-payment-invoice'); ?>';
        if(delete_payment == "Berhasil"){
            Swal.fire({
                     title: "Hapus Data Payment Invoice",
                     icon: "success",
                     text: "Berhasil Hapus Data Payment Invoice",
                     type: "error",
                     timer: 2000
                 });
        }
        if(update_payment == "Berhasil"){
            Swal.fire({
                     title: "Update Data Payment Invoice",
                     icon: "success",
                     text: "Berhasil Update Data Payment Invoice",
                     type: "success",
                     timer: 2000
                 });
        }
    function check_tanggal(a){
        var data_tanggal = $("#"+a.id).val().split("-");
        var tanggal = data_tanggal[2]+"-"+data_tanggal[1]+"-"+data_tanggal[0];

        if(Date.parse(tanggal)<Date.parse("<?= $invoice["tanggal_invoice"]?>")){
            Swal.fire({
                title: "Peringatan",
                icon: "error",
                text: "Maaf Silakan Isi Tanggal Setelah Tanggal "+change_tanggal("<?= $invoice["tanggal_invoice"]?>"),
                type: "error"
            });
            $("#"+a.id).val("<?= $tanggal_now?>");
        }
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