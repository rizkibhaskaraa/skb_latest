<?php
function change_tanggal($tanggal){
    if($tanggal==""){
        return "";
    }else{
        $tanggal_array = explode("-",$tanggal);
        return $tanggal_array[2]."-".$tanggal_array[1]."-".$tanggal_array[0];   
    }
}
$keterangan = explode("===",$jo["keterangan"]);
?>
<!-- tampilan detail penggajian supir -->
<body style='background-color:#182039';> 
<div class="mt-5 p-3 small" style='background-color:#182039';>
    <div class="card shadow mb-4 mt-3"style='background-color:#182039';>
        <div class="card-header py-3 mb-3" style='background-color:#182039';>
            <h6 class="m-0 font-weight-bold text-light">Edit Job Order</h6>
        </div>
        <div class="m-3 text-light" id="rincian">
            <form action="<?=base_url("index.php/form/update_JO")?>" method="POST" id="form-edit-jo">
                <div class="row mr-2 ml-2">
                    <div class="col-md-4">
                        <div class="mb-4 row">
                            <label for="Jo_id_update" class="form-label col-md-4 font-weight-bold">ID Job Order(JO)</label>
                            <input autocomplete="off" type="text" class="form-control col-md-8" id="Jo_id_update" name="Jo_id_update" required value="<?= $jo["Jo_id"]?>" readonly>
                        </div>
                        <div class="mb-4 row">
                            <label for="tanggal_jo_update" class="form-label col-md-4 font-weight-bold">Tanggal</label>
                            <input autocomplete="off" type="text" class="form-control col-md-8" id="tanggal_jo_update" name="tanggal_jo_update" value="<?= change_tanggal($jo["tanggal_surat"])?>" required onclick="tanggal_berlaku(this)">
                        </div>
                            <div class="mb-4 row">
                                <label class="form-label font-weight-bold col-md-4 " for="Customer_update">Customer</label>
                                <select name="Customer_update" value="DESC" id="Customer_update" class="form-control col-md-8" required onchange="set_muatan(this)">
                                    <option class="font-w700" selected value="<?= $jo["customer_id"]?>"><?= $jo["customer_name"]?></option>
                                </select>
                            </div>
                            <div class="mb-4 row">
                                <label for="Muatan" class="form-label font-weight-bold col-md-4 ">Muatan</label> 
                                <select name="Muatan" id="Muatan" class="form-control col-md-8" onchange="set_asal(this)"  required>
                                    <option class="font-w700" selected value="<?= $jo["muatan"]?>"><?= $jo["muatan"]?></option>
                                </select>
                            </div>
                            <div class="mb-4 row">
                                <label class="form-label font-weight-bold col-md-4" for="Asal ">Dari</label>
                                <select name="Asal" id="Asal" class="form-control col-md-8" onchange="set_tujuan(this)" required>
                                    <option class="font-w700" selected value="<?= $jo["asal"]?>"><?= $jo["asal"]?></option>
                                </select>
                            </div>
                            <div class="mb-4 row">
                                <label class="form-label font-weight-bold col-md-4" for="Tujuan">Ke</label>
                                <select name="Tujuan" id="Tujuan" class="form-control col-md-8" onchange="set_uj(this)" required>
                                    <option class="font-w700" selected value="<?= $jo["tujuan"]?>"><?= $jo["tujuan"]?></option>
                                </select>
                            </div>
                        <div class="mb-4 row">
                            <label for="Keterangan_update" class="form-label col-md-4 font-weight-bold">Keterangan/Catatan</label>
                            <textarea class="form-control col-md-8" name="Keterangan_update" id="Keterangan_update" rows="3"><?= $keterangan[0]?></textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-4 row">
                            <label class="form-label col-md-4 font-weight-bold" for="Supir_update">Driver </label>
                            <select name="Supir_update" id="Supir_update" class="form-control col-md-8">
                                <option class="font-w700 font-weight-bold" selected value="<?= $jo["supir_id"]?>"><?= $jo["supir_name"]?></option>
                                <?php foreach($supir as $value){?>
                                    <option value="<?=$value["supir_id"]?>"><?=$value["supir_name"]?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="mb-4 row">
                            <label class="form-label col-md-4 font-weight-bold " for="Kendaraan_update">No. Polisi</label>
                            <select name="Kendaraan_update" id="Kendaraan_update" class="form-control col-md-8 " onchange="set_jenis_mobil(this)">
                                <option class="font-w700 font-weight-bold" selected value="<?= $jo["mobil_no"]?>"><?= $jo["mobil_no"]?></option>
                                <?php foreach($mobil as $value){?>
                                    <option value="<?=$value["mobil_no"]?>"><?=$value["mobil_no"]?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="mb-4 row">
                            <label class="form-label col-md-4 font-weight-bold" for="Jenis_update">Jenis Mobil</label>
                            <input autocomplete="off" type="text" class="form-control col-md-8" name="Jenis_update" id="Jenis_update" required readonly value="<?= $jo["mobil_jenis"]?>">
                        </div>
                        <div class="mb-4 row">
                            <label for="Uang_update" class="form-label col-md-4 font-weight-bold">Uang Jalan</label>
                            <input autocomplete="off" type="text" class="form-control col-md-8" id="Uang_update" name="Uang_update" required readonly value="<?= number_format($jo["uang_jalan"],0,",",".")?>">
                        </div>
                        <div class="mb-4 row">
                            <label class="form-label col-md-4 font-weight-bold" for="jenis_tambahan_update">Tambahan/Potongan UJ</label>
                            <select name="jenis_tambahan_update" id="jenis_tambahan_update" class="form-control col-md-8" onchange="tambahan(this)">
                                <?php if($jo["jenis_tambahan"]==""){?>
                                    <option class="font-w700" selected value="Tidak Ada">Tidak Ada</option>
                                <?php }else{?>
                                    <option class="font-w700" selected value="<?= $jo["jenis_tambahan"]?>"><?= $jo["jenis_tambahan"]?></option>
                                <?php }?>
                                <option class="font-w700" value="Tidak Ada">Tidak Ada</option>
                                <option class="font-w700" value="Tambahan">Tambahan</option>
                                <option class="font-w700" value="Potongan">Potongan</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <div id="nominal_tambahan_id" class="row">
                                <label for="nominal_tambahan_update" class="form-label col-md-4 font-weight-bold">Nominal Tambahan/Potongan UJ</label>
                                <input autocomplete="off" type="text" class="form-control col-md-8" id="nominal_tambahan_update" name="nominal_tambahan_update" onkeyup="set_uj_tambahan(this),uang_format(this)" value="<?= number_format($jo["nominal_tambahan"],0,",",".")?>">
                            </div>
                        </div>
                        <div class="mb-4 row">
                            <label for="uang_jalan_total_update" class="form-label col-md-4 font-weight-bold">Total Uang Jalan</label>
                            <input autocomplete="off" type="text" class="form-control col-md-8" id="uang_jalan_total_update" name="uang_jalan_total_update" readonly value="<?= number_format($jo["uang_total"],0,",",".")?>">
                        </div>
                        <input autocomplete="off" type="text" class="form-control" id="Upah_update" name="Upah_update" readonly value="<?= $jo["uang_jalan"]?>" hidden>
                        <input autocomplete="off" type="text" class="form-control" id="Tagihan_update" name="Tagihan_update" readonly value="<?= $jo["tagihan"]?>" hidden>
                        <input autocomplete="off" type="text" class="form-control col-md-7" id="Tipe_Tonase_update" name="Tipe_Tonase_update" required readonly value="<?= $jo["tipe_tonase"]?>" hidden>
                    </div>
                    <div class="col-md-4">
                       <div class="form-group mb-4 row">
                           <label for="status_update" class="form-label font-weight-bold col-md-4">Status Saat Ini</label>
                            <select name="status_update" id="status_update" class="form-control col-md-8 custom-select " required>
                                <?php if($jo["status"]=="Dalam Perjalanan"){?>
                                    <option class="font-w700" selected value="<?= $jo["status"]?>">Ongoing</option>
                                <?php }else{?>
                                    <option class="font-w700" selected value="<?= $jo["status"]?>">Done</option>
                                <?php }?>
                                <option value="Sampai Tujuan">Done</option>
                                <option value="Dalam Perjalanan">Ongoing</option>
                            </select>
                        </div>
                        <div class="form-group mb-4 row">
                            <label for="tgl_muat_update" class="form-label font-weight-bold col-md-4">Tanggal Muat</label>
                            <input autocomplete="off" class="form-control col-md-8" type="text" name="tgl_muat_update" id="tgl_muat_update" onclick="tanggal_berlaku(this)" value="<?= change_tanggal($jo["tanggal_muat"])?>" onchange="cek_tanggal(this)">    
                        </div>
                        <div class="form-group mb-4 row">
                            <label for="tgl_bongkar_update" class="form-label font-weight-bold col-md-4">Tanggal Bongkar</label>
                            <input autocomplete="off" class="form-control col-md-8" type="text" name="tgl_bongkar_update" id="tgl_bongkar_update" onclick="tanggal_berlaku(this)" value="<?= change_tanggal($jo["tanggal_bongkar"])?>" onchange="cek_tanggal(this)">    
                        </div>
                        <div class="form-group mb-4 row">
                            <label for="tonase_update" class="form-label font-weight-bold col-md-4">Muatan akhir (Tonase)</label>
                            <input autocomplete="off" class="form-control col-md-8" type="text" name="tonase_update" id="tonase_update" onkeyup="uang()" value="<?= $jo["tonase"]?>">    
                        </div>
                        <div class="form-group mb-4 row">
                            <label for="biaya_lain_update" class="form-label font-weight-bold col-md-4">Biaya Lain</label>
                            <input autocomplete="off" class="form-control col-md-8" type="text" name="biaya_lain_update" id="biaya_lain_update" onkeyup="uang()" value="<?= number_format($jo["biaya_lain"],0,",",".")?>">    
                        </div>
                        <div class="mb-4 row">
                            <label for="Keterangan_status_update" class="form-label col-md-4 font-weight-bold">Keterangan Ubah Status</label>
                            <textarea class="form-control col-md-8" name="Keterangan_status_update" id="Keterangan_status_update" rows="3"><?php if(count($keterangan)>1){echo $keterangan[1];}?></textarea>
                        </div>
                        <div class="row d-flex justify-content-end ">
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </div>
                </div>
                </form>
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
    <!-- Bootstrap core JavaScript-->

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
    <script>
        customer_id = $("#Customer_update").val();
        muatan = $("#Muatan").val();
        asal = $("#Asal").val();
        mobil_no = $("#Jenis_update").val();
        <?php for($i=0;$i<count($customer);$i++){?>
            $('#Customer_update').append('<option value="'+'<?= $customer[$i]["customer_id"]?>'+'">'+'<?= $customer[$i]["customer_name"]?>'+'</option>'); 
        <?php }?>
        isi_muatan = [];
        $.ajax({ //ajax set option kendaraan
            type: "POST",
            url: "<?php echo base_url('index.php/form/getrutebycustomer/') ?>",
            dataType: "JSON",
            data: {
                customer_id: customer_id,
                mobil_no: mobil_no,
            },
            success: function(data) {
                    for(i=0;i<data.length;i++){
                        if(!isi_muatan.includes(data[i]["rute_muatan"])){
                            $('#Muatan').append('<option value="'+data[i]["rute_muatan"]+'">'+data[i]["rute_muatan"]+'</option>'); 
                            isi_muatan.push(data[i]["rute_muatan"]);
                        }
                    }
            }
        });
        isi_asal = [];
        $.ajax({ //ajax set option kendaraan
            type: "POST",
            url: "<?php echo base_url('index.php/form/getrutebymuatan') ?>",
            dataType: "JSON",
            data: {
                customer_id: customer_id,
                mobil_no: mobil_no,
                rute_muatan: muatan,
            },
            success: function(data) {
                    for(i=0;i<data.length;i++){
                        if(!isi_asal.includes(data[i]["rute_dari"])){
                            $('#Asal').append('<option value="'+data[i]["rute_dari"]+'">'+data[i]["rute_dari"]+'</option>'); 
                            isi_asal.push(data[i]["rute_dari"]);
                        }
                    }
            }
        });
        isi_tujuan = [];
        $.ajax({ //ajax set option kendaraan
            type: "POST",
            url: "<?php echo base_url('index.php/form/getrutebyasal') ?>",
            dataType: "JSON",
            data: {
                customer_id: customer_id,
                rute_muatan: muatan,
                rute_asal: asal,
                mobil_no: mobil_no,
            },
            success: function(data) {
                    for(i=0;i<data.length;i++){
                        if(!isi_tujuan.includes(data[i]["rute_dari"])){
                            $('#Tujuan').append('<option value="'+data[i]["rute_ke"]+'">'+data[i]["rute_ke"]+'</option>'); 
                            isi_tujuan.push(data[i]["rute_ke"]);
                        }
                    }
            }
        });
    </script>
    <script>
        var data_jo_now = [];
        var data_jo_new = [];
        data_jo_now = new Object();
        data_jo_now.tanggal="<?= change_tanggal($jo["tanggal_surat"])?>";
        data_jo_now.cust="<?= $jo["customer_id"]?>";
        data_jo_now.muatan="<?= $jo["muatan"]?>";
        data_jo_now.dari="<?= $jo["asal"]?>";
        data_jo_now.ke="<?= $jo["tujuan"]?>";
        data_jo_now.ket="<?= $jo["keterangan"]?>";
        data_jo_now.supir="<?= $jo["supir_id"]?>";
        data_jo_now.mobil="<?= $jo["mobil_no"]?>";
        data_jo_now.jenis="<?= $jo["jenis_tambahan"]?>";
        data_jo_now.nominal="<?= number_format($jo["nominal_tambahan"],0,",",".")?>";
        data_jo_now.status="<?= $jo["status"]?>";
        data_jo_now.muat="<?= change_tanggal($jo["tanggal_muat"])?>";
        data_jo_now.bngkr="<?= change_tanggal($jo["tanggal_bongkar"])?>";
        data_jo_now.ton="<?= $jo["tonase"]?>";
        data_jo_now.lain="<?= number_format($jo["biaya_lain"],0,",",".")?>";
        $( "#form-edit-jo" ).submit(function( event ) {
            event.preventDefault();
            var form = $(this);
            data_jo_new = new Object();
            data_jo_new.tanggal=$("#tanggal_jo_update").val();
            data_jo_new.cust=$("#Customer_update").val();
            data_jo_new.muatan=$("#Muatan").val();
            data_jo_new.dari=$("#Asal").val();
            data_jo_new.ke=$("#Tujuan").val();
            if($("#Keterangan_status_update").val()!=""){
                data_jo_new.ket=$("#Keterangan_update").val()+"==="+$("#Keterangan_status_update").val();
            }else{
                data_jo_new.ket=$("#Keterangan_update").val();
            }
            data_jo_new.supir=$("#Supir_update").val();
            data_jo_new.mobil=$("#Kendaraan_update").val();
            data_jo_new.jenis=$("#jenis_tambahan_update").val();
            data_jo_new.nominal=$("#nominal_tambahan_update").val();
            data_jo_new.status=$("#status_update").val();
            data_jo_new.muat=$("#tgl_muat_update").val();
            data_jo_new.bngkr=$("#tgl_bongkar_update").val();
            data_jo_new.ton=$("#tonase_update").val();
            data_jo_new.lain=$("#biaya_lain_update").val();  
            if(JSON.stringify(data_jo_now) == JSON.stringify(data_jo_new)){
                alert("anda Belum Mengubah Data");
            }else{
                if($("#status_update").val()=="Dalam Perjalanan"){
                    if($("#status_update").val()!="<?= $jo["status"]?>"){
                        Swal.fire({
                            title: 'Edit Job Order',
                            text:'Yakin Anda Ingin Mengubah Data Dari Done ke Ongoing?',
                            showDenyButton: true,
                            denyButtonText: `No`,
                            confirmButtonText: 'Yes',
                            denyButtonColor: '#808080',
                            confirmButtonColor: '#FF0000',
                            icon: "warning",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        })
                    }else{
                        form.submit();
                    }
                }else{
                    if($("#tgl_muat_update").val()=="" || $("#tgl_bongkar_update").val()=="" || $("#tonase_update").val()==""){
                        alert("tgl muat,tgl bongkat,muatan akhir tidak boleh kosong");
                    }else{
                        form.submit();
                    }
                }
            }
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
            return rupiah;
        }
        function tanggal_berlaku(a){
            // alert(a.id);
            Swal.fire({
                title: "Loading",
                icon: "success",
                text: "Mohon Tunggu Sebentar",
                type: "success",
                timer: 500
            });
            $("#"+a.id).datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true,
                todayHighlight: true,
            });
        }
        function cek_tanggal(a){
            var tanggal_muat = Date.parse(change_tanggal($("#tgl_muat_update").val()));
            var tanggal_bongkar = Date.parse(change_tanggal($("#tgl_bongkar_update").val()));
            if(tanggal_muat > tanggal_bongkar){
                alert("Tanggal Bongkar Harus Lebih Dari Tanggal Muat");
                $("#tgl_muat_update").val("");
                $("#tgl_bongkar_update").val("");
            }
        }
    </script>
    <script>    
        function uang_format(a){
            $( '#'+a.id ).mask('000.000.000', {reverse: true});
        }
        function set_uj_tambahan(){
            var uj = $("#Uang_update").val().replaceAll(".","");
            var uj_tambahan = $("#nominal_tambahan_update").val().replaceAll(".","");
            if(uj_tambahan==""){
                uj_tambahan = 0;
            }
            if($("#jenis_tambahan_update").val()=="Potongan"){
                if(parseInt(uj)<parseInt(uj_tambahan)){
                    alert("Potongan Tidak boleh Lebih Dari Rp."+rupiah(uj));
                    $("#nominal_tambahan_update").val("");
                    $( '#uang_jalan_total_update' ).val(rupiah(uj));
                }else{
                    $( '#uang_jalan_total_update' ).val(rupiah(parseInt(uj)-parseInt(uj_tambahan)));
                }
            }else if($("#jenis_tambahan_update").val()=="Tambahan"){
                $( '#uang_jalan_total_update' ).val(rupiah(parseInt(uj)+parseInt(uj_tambahan)));
            }else{
                $("#nominal_tambahan_update").val(0);
                $( '#uang_jalan_total_update' ).val(rupiah(parseInt(uj)));
            }
        }
        function tambahan(a){
            var uj = $("#Uang_update").val().replaceAll(".","");
            var uj_tambahan = $("#nominal_tambahan_update").val().replaceAll(".","");
            if(uj_tambahan==""){
                uj_tambahan = 0;
            }
            if($("#"+a.id).val()=="Potongan"){
                if(parseInt(uj)<parseInt(uj_tambahan)){
                    alert("Potongan Tidak boleh Lebih Dari Rp."+rupiah(uj));
                    $("#nominal_tambahan_update").val("");
                    $( '#uang_jalan_total_update' ).val(rupiah(uj));
                }else{
                    $( '#uang_jalan_total_update' ).val(rupiah(parseInt(uj)-parseInt(uj_tambahan)));
                }
            }else{
                $( '#uang_jalan_total_update' ).val(rupiah(parseInt(uj)+parseInt(uj_tambahan)));
            }
        }
    </script>
    <script>
        function set_jenis_mobil(a){
            $('#Muatan').find('option').remove().end();
            $('#Asal').find('option').remove().end();
            $('#Tujuan').find('option').remove().end();
            $('#Customer_update').find('option').remove().end();
            $("#Uang_update").val("");
            $("#Upah_update").val("");
            $("#Tagihan_update").val("");
            $("#Tipe_Tonase_update").val("");
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('index.php/form/getmobilbyno') ?>",
                dataType: "JSON",
                data: {
                    mobil_no: $("#"+a.id).val(),
                },
                success: function(data) {   
                    $("#Jenis_update").val(data["mobil_jenis"]);
                }
            });
            $('#Customer_update').append('<option class="font-w700" disabled="disabled" selected value="">Customer</option>'); 
            <?php for($i=0;$i<count($customer);$i++){?>
                $('#Customer_update').append('<option value="'+'<?= $customer[$i]["customer_id"]?>'+'">'+'<?= $customer[$i]["customer_name"]?>'+'</option>'); 
            <?php }?>
        }
        function set_muatan(a){
            customer_id = $("#"+a.id).val();
            mobil_no = $("#Jenis_update").val();
            $('#Muatan').find('option').remove().end();
            $('#Asal').find('option').remove().end();
            $('#Tujuan').find('option').remove().end();
            $("#Uang_update").val("");
            $("#Upah_update").val("");
            $("#Tagihan_update").val("");
            $("#Tipe_Tonase_update").val("");
            isi_muatan = [];
            $.ajax({ //ajax set option kendaraan
                type: "POST",
                url: "<?php echo base_url('index.php/form/getrutebycustomer/') ?>",
                dataType: "JSON",
                data: {
                    customer_id: customer_id,
                    mobil_no: mobil_no,
                },
                success: function(data) {
                    if(data.length==0){
                        $('#Muatan').append('<option class="font-w700" disabled="disabled" selected value="">Kosong</option>'); 
                    }else{
                        $('#Muatan').append('<option class="font-w700" disabled="disabled" selected value="">Muatan</option>'); 
                        for(i=0;i<data.length;i++){
                            if(!isi_muatan.includes(data[i]["rute_muatan"])){
                                $('#Muatan').append('<option value="'+data[i]["rute_muatan"]+'">'+data[i]["rute_muatan"]+'</option>'); 
                                isi_muatan.push(data[i]["rute_muatan"]);
                            }
                        }
                    }
                }
            });
        }
        function set_asal(a){
            customer_id = $("#Customer_update").val();
            mobil_no = $("#Jenis_update").val();
            muatan = $("#"+a.id).val();
            $('#Asal').find('option').remove().end();
            $('#Tujuan').find('option').remove().end();
            $("#Uang_update").val("");
            $("#Upah_update").val("");
            $("#Tagihan_update").val("");
            $("#Tipe_Tonase_update").val("");
            isi_asal = [];
            $.ajax({ //ajax set option kendaraan
                type: "POST",
                url: "<?php echo base_url('index.php/form/getrutebymuatan') ?>",
                dataType: "JSON",
                data: {
                    customer_id: customer_id,
                    mobil_no: mobil_no,
                    rute_muatan: muatan,
                },
                success: function(data) {
                    if(data.length==0){
                        $('#Asal').append('<option class="font-w700" disabled="disabled" selected value="">Kosong</option>'); 
                    }else{
                        $('#Asal').append('<option class="font-w700" disabled="disabled" selected value="">Asal</option>'); 
                        for(i=0;i<data.length;i++){
                            if(!isi_asal.includes(data[i]["rute_dari"])){
                                $('#Asal').append('<option value="'+data[i]["rute_dari"]+'">'+data[i]["rute_dari"]+'</option>'); 
                                isi_asal.push(data[i]["rute_dari"]);
                            }
                        }
                    }
                }
            });
        }    
        function set_tujuan(a){
            customer_id = $("#Customer_update").val();
            muatan = $("#Muatan").val();
            asal = $("#"+a.id).val();
            mobil_no = $("#Jenis_update").val();
            $('#Tujuan').find('option').remove().end();
            $("#Uang_update").val("");
            $("#Upah_update").val("");
            $("#Tagihan_update").val("");
            $("#Tipe_Tonase_update").val("");
            isi_tujuan = [];
            $.ajax({ //ajax set option kendaraan
                type: "POST",
                url: "<?php echo base_url('index.php/form/getrutebyasal') ?>",
                dataType: "JSON",
                data: {
                    customer_id: customer_id,
                    rute_muatan: muatan,
                    rute_asal: asal,
                    mobil_no: mobil_no,
                },
                success: function(data) {
                    if(data.length==0){
                        $('#Tujuan').append('<option class="font-w700" disabled="disabled" selected value="">Kosong</option>'); 
                    }else{
                        $('#Tujuan').append('<option class="font-w700" disabled="disabled" selected value="">Tujuan</option>'); 
                        for(i=0;i<data.length;i++){
                            if(!isi_tujuan.includes(data[i]["rute_dari"])){
                                $('#Tujuan').append('<option value="'+data[i]["rute_ke"]+'">'+data[i]["rute_ke"]+'</option>'); 
                                isi_tujuan.push(data[i]["rute_ke"]);
                            }
                        }
                    }
                }
            });
        }
        function set_uj(a){
            customer_id = $("#Customer_update").val();
            muatan = $("#Muatan").val();
            asal = $("#Asal").val();
            ke = $("#"+a.id).val();
            mobil_no = $("#Jenis_update").val();
            $.ajax({ //ajax set option kendaraan
                type: "POST",
                url: "<?php echo base_url('index.php/form/getrutefix') ?>",
                dataType: "JSON",
                data: {
                    customer_id: customer_id,
                    rute_muatan: muatan,
                    rute_asal: asal,
                    rute_ke: ke,
                    mobil_no: mobil_no,
                },
                success: function(data) {
                    if($("#jenis_tambahan_update").val()=="Potongan"){
                        total = rupiah( parseInt(data["rute_uj_engkel"])-parseInt($("#uang_jalan_total_update").val().replaceAll(".","")) ) ;
                    }else if($("#jenis_tambahan_update").val()=="Tambahan"){
                        total = rupiah( parseInt(data["rute_uj_engkel"])+parseInt($("#uang_jalan_total_update").val().replaceAll(".","")) ) ;
                    }else{
                        total = rupiah( parseInt(data["rute_uj_engkel"])) ;
                    }
                    $( '#uang_jalan_total_update' ).val(total);
                    $("#Tipe_Tonase_update").val(data["ritase"]);
                    $("#Uang_update").val(rupiah(data["rute_uj_engkel"]));
                    $("#Upah_update").val(rupiah(data["rute_gaji_engkel"]));
                    $("#Tagihan_update").val(rupiah(data["rute_tagihan"]));
                }
            });
        }
    </script>