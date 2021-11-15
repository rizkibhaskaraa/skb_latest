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
<!-- tampilan detail penggajian supir -->
<body style='background-color:#182039';> 
<div class="mt-5 p-1 text-light" style='background-color:#182039';>
    <div class="card shadow mb-4 mt-3" style='background-color:#182039';>
        <div class="card-header py-3 mb-3"style='background-color:#182039';>
            <h6 class="m-0 font-weight-bold text-light">Buat Slip Gaji</h6>
        </div>
        <div class="container m-auto" id="rincian">
            <form action="<?= base_url("index.php/detail/update_slip/").$slip[0]["pembayaran_upah_id"]?>" method="POST" id="form-pilih-jo">
                <input type="text" name="jo" id="jo" required value="<?= $isi_jo?>" hidden>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="tanggal_gaji" class="col-form-label col-sm-7 font-weight-bold">Tanggal</label>
                            <input autocomplete="off" type="text" class="form-control col-md-5" id="tanggal_gaji" name="tanggal_gaji" value="<?= change_tanggal($slip[0]["pembayaran_upah_tanggal"])?>" onclick="tanggal_berlaku(this)" required>
                        </div>
                        <div class="form-group row">
                            <label for="no_gaji" class="col-form-label col-sm-7 font-weight-bold">No Gaji</label>
                            <input autocomplete="off" type="text" class="form-control col-md-5" id="no_gaji" name="no_gaji" value="<?= $no_slip_gaji?>" required readonly>
                        </div>
                        <div class="form-group row">
                            <label for="nama_supir" class="col-form-label col-sm-7 font-weight-bold">Supir</label>
                            <input autocomplete="off" type="text" class="form-control col-md-5" id="nama_supir" name="nama_supir" value="<?= $supir["supir_name"]?>" readonly>
                        </div>
                        <div class="form-group row">
                            <label for="nopol" class="col-form-label col-sm-7 font-weight-bold">No Polisi</label>
                            <input autocomplete="off" type="text" class="form-control col-md-5" id="nopol" name="nopol" value="<?= $slip[0]["nopol"]?>" readonly>
                        </div>
                        <div class="form-group row">
                            <label for="bulan_kerja" class="col-form-label col-sm-7 font-weight-bold">Bulan Kerja</label>
                            <input autocomplete="off" type="text" class="form-control col-md-5" id="bulan_kerja" name="bulan_kerja" value="<?= $slip[0]["bulan_kerja"]?>" readonly>
                        </div>
                        <div class="form-group row">
                            <label for="bon_supir" class="col-form-label col-sm-7 font-weight-bold">Bon Terhutang</label>
                            <input autocomplete="off" type="text" class="form-control col-md-5" id="bon_supir" name="bon_supir" value="Rp.<?= number_format($supir["supir_kasbon"],2,",",".")?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="gaji_total" class="col-form-label col-sm-7 font-weight-bold">Total</label>
                            <div class="col-sm-5">
                                <input autocomplete="off" type="text" class="form-control" id="gaji_total" name="gaji_total" required value="<?= number_format($slip[0]["pembayaran_upah_nominal"],0,",",".")?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kasbon" class="col-form-label col-sm-7 font-weight-bold">Bayar Kasbon</label>
                            <div class="col-sm-5">
                                <input autocomplete="off" type="text" class="form-control" id="kasbon" name="kasbon" onkeyup="batas_kasbon(this)" value="<?= number_format($slip[0]["pembayaran_upah_bon"],0,",",".")?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bonus" class="col-form-label col-sm-7 font-weight-bold">Bonus</label>
                            <div class="col-sm-5">
                                <input autocomplete="off" type="text" class="form-control" id="bonus" name="bonus" onkeyup="bonus_nilai(this)" value="<?= number_format($slip[0]["pembayaran_upah_bonus"],0,",",".")?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gaji_grand_total" class="col-form-label col-sm-7 font-weight-bold">Grand Total</label>
                            <div class="col-sm-5">
                                <input autocomplete="off" type="text" class="form-control" id="gaji_grand_total" name="gaji_grand_total" required readonly value="<?= number_format($slip[0]["pembayaran_upah_total"],0,",",".")?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="keterangan" class="col-form-label col-sm-7 font-weight-bold">Keterangan</label>
                            <textarea name="Keterangan" id="Keterangan" class="form-control col-md-5" rows="3"><?= $slip[0]["keterangan"]?></textarea>
                        </div>
                    </div>
                </div>
                <div class="row float-right text-center mb-5 mt-4">
                <button type="reset" class="btn btn-danger mr-2" onclick="reset_form()">Reset</button>
                    <button type="submit" class="btn btn-success" onclick="cek_jo()">Simpan</button>
                 
                </div>
            </form>
        </div>
        <div class="container">
            <strong>Data JO Dalam Slip Gaji Saat Ini</strong>
        </div> 
        <div class="table-responsive p-1">
                <table class="table table-bordered table-striped text-light" id="Table-Penggajian-Now" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center" width="10%" scope="col">JO ID</th>
                            <th class="text-center" width="10%" scope="col">Tgl Muat</th>
                            <th class="text-center" width="13%" scope="col">Tgl Bongkar</th>
                            <th class="text-center" width="13%" scope="col">Customer</th>
                            <th class="text-center" width="10%" scope="col">Muatan</th>
                            <th class="text-center" width="10%" scope="col">Dari</th>
                            <th class="text-center" width="10%" scope="col">Ke</th>
                            <th class="text-center" width="10%" scope="col">Tonase</th>
                            <th class="text-center" width="10%" scope="col">Upah</th>
                            <th class="text-center" width="10%" scope="col">Detail</th>
                            <th class="text-center" width="10%" scope="col">Pilih</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($slip as $value){?>
                        <tr>
                            <td><?= $value["Jo_id"]?></td>
                            <td><?= $value["tanggal_muat"]?></td>
                            <td><?= $value["tanggal_bongkar"]?></td>
                            <td><?= $value["customer_name"]?></td>
                            <td><?= $value["muatan"]?></td>
                            <td><?= $value["asal"]?></td>
                            <td><?= $value["tujuan"]?></td>
                            <td><?= $value["tonase"]?></td>
                            <td>Rp.<?= number_format($value["upah"],2,',','.')?></td>
                            <td><a class='btn btn-light' target="_blank" href='<?= base_url('index.php/detail/detail_jo/'.$value["Jo_id"].'/JO')?>'><i class='fas fa-eye'></i></a></td>
                            <td class="text-center"><input class='' id="<?= $value["Jo_id"]?>" type='checkbox' checked onchange="pilih_gaji(this)"></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
        </div>
        <hr class="mt-3 ">
        <div class="table-responsive">
                <table class="table table-bordered table-striped text-light" id="Table-Penggajian" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center" width="10%" scope="col">JO ID</th>
                            <th class="text-center" width="10%" scope="col">Tgl Muat</th>
                            <th class="text-center" width="13%" scope="col">Tgl Bongkar</th>
                            <th class="text-center" width="13%" scope="col">Customer</th>
                            <th class="text-center" width="10%" scope="col">Muatan</th>
                            <th class="text-center" width="10%" scope="col">Dari</th>
                            <th class="text-center" width="10%" scope="col">Ke</th>
                            <th class="text-center" width="10%" scope="col">Tonase</th>
                            <th class="text-center" width="10%" scope="col">Upah</th>
                            <th class="text-center" width="10%" scope="col">Detail</th>
                            <th class="text-center" width="10%" scope="col">Pilih</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($jo as $value){?>
                        <tr>
                            <td><?= $value["Jo_id"]?></td>
                            <td><?= $value["tanggal_muat"]?></td>
                            <td><?= $value["tanggal_bongkar"]?></td>
                            <td><?= $value["customer_name"]?></td>
                            <td><?= $value["muatan"]?></td>
                            <td><?= $value["asal"]?></td>
                            <td><?= $value["tujuan"]?></td>
                            <td><?= $value["tonase"]?></td>
                            <td>Rp.<?= number_format($value["upah"],2,',','.')?></td>
                            <td><a class='btn btn-light' target="_blank" href='<?= base_url('index.php/detail/detail_jo/'.$value["Jo_id"].'/JO')?>'><i class='fas fa-eye'></i></a></td>
                            <td><input class='' id="<?= $value["Jo_id"]?>" type='checkbox' onchange="pilih_gaji(this)"></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
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
    <script>
        var data_slip_now = [];
        var data_slip_new = [];
        data_slip_now = new Object();
        data_slip_now.tanggal="<?= change_tanggal($slip[0]["pembayaran_upah_tanggal"])?>";
        data_slip_now.total="<?= number_format($slip[0]["pembayaran_upah_nominal"],0,",",".")?>";
        data_slip_now.bon="<?= number_format($slip[0]["pembayaran_upah_bon"],0,",",".")?>";
        data_slip_now.bonus="<?= number_format($slip[0]["pembayaran_upah_bonus"],0,",",".")?>";
        data_slip_now.grand="<?= number_format($slip[0]["pembayaran_upah_total"],0,",",".")?>";
        data_slip_now.keterangan="<?= $slip[0]["keterangan"]?>";
        $( "#form-pilih-jo" ).submit(function( event ) {
            data_slip_new = new Object();
            data_slip_new.tanggal=$("#tanggal_gaji").val();
            data_slip_new.total=$("#gaji_total").val();
            data_slip_new.bon=$("#kasbon").val();
            data_slip_new.bonus=$("#bonus").val();
            data_slip_new.grand=$("#gaji_grand_total").val();
            data_slip_new.keterangan=$("#Keterangan").val();
            if(JSON.stringify(data_slip_now) == JSON.stringify(data_slip_new)){
                alert( "Anda Belum Mengubah Data" );
                return false;
            }else{
                return true;
            }
        });
    </script>
    <script>
        isi_jo = $("#jo").val().split(",");
        var data_jo = [];     
        for(i=0;i<isi_jo.length;i++){
            data_jo.push(isi_jo[i]);
        }
        function pilih_gaji(a){
            var jo_id = a.id;
            if(data_jo.includes(jo_id)!=true){
                data_jo.push(jo_id);
            }else{
                data_jo.splice(data_jo.indexOf(jo_id), 1 );
            }
            $("#jo").val(data_jo);
            $.ajax({
                type: "GET",
                url: "<?php echo base_url('index.php/detail/getjo') ?>",
                dataType: "JSON",
                data: {
                    id: jo_id
                },
                success: function(data) { //jika ambil data sukses
                    var gaji = data["upah"];
                    var kasbon = $("#kasbon").val().replaceAll(".","");
                    var bonus = $("#bonus").val().replaceAll(".","");
                    var gaji_total = $("#gaji_total").val().replaceAll(".","");
                    var gaji_grand_total = $("#gaji_grand_total").val().replaceAll(".","");

                    if(data_jo.includes(jo_id)==true){
                        var gaji_total = parseInt(gaji_total) + parseInt(gaji);
                        if(gaji_grand_total==0){
                            if(gaji_total==0){
                                var gaji_grand_total = parseInt(bonus) + parseInt(gaji) - parseInt(kasbon);
                            }else{
                                var gaji_grand_total = parseInt(gaji_total) + parseInt(bonus) - parseInt(kasbon);
                            }
                        }else{
                            var gaji_grand_total = parseInt(gaji_grand_total) + parseInt(gaji);
                        }
                        $("#gaji_total").val(rupiah(gaji_total));
                        if(gaji_grand_total<0){
                            $("#gaji_grand_total").val(0);
                        }else{
                            $("#gaji_grand_total").val(rupiah(gaji_grand_total));
                        }
                    }else{
                        var gaji_total = parseInt(gaji_total) - parseInt(gaji);
                        if(gaji_grand_total==0){
                            if(gaji_total==0){
                                var gaji_grand_total =  parseInt(bonus) - parseInt(gaji) - parseInt(kasbon);
                            }else{
                                var gaji_grand_total = parseInt(gaji_total) +  parseInt(bonus) - parseInt(kasbon);
                            }
                        }else{
                            var gaji_grand_total = parseInt(gaji_grand_total) - parseInt(gaji);
                        }
                        $("#gaji_total").val(rupiah(gaji_total));
                        if(gaji_grand_total<0){
                            $("#gaji_grand_total").val(0);
                        }else{
                            $("#gaji_grand_total").val(rupiah(gaji_grand_total));
                        }
                    }
                }
            });
        }
        function batas_kasbon(a){
            if($("#"+a.id).val().length>1){
                if($("#"+a.id).val()[0]=="0"){
                    var string_now = $("#"+a.id).val().replace("0","");
                    $("#"+a.id).val(string_now);
                }
            }
            kasbon_slip = '<?= $slip[0]["pembayaran_upah_bon"]?>';
            var bonus = 0;
            if($("#bonus").val().replaceAll(".","") == ""){
                bonus = 0;
            }else{
                bonus = $("#bonus").val().replaceAll(".","");
            }
            var total = parseInt($("#gaji_total").val().replaceAll(".",""))+parseInt(bonus);
            $( '#'+a.id ).mask('000.000.000', {reverse: true});
            var kasbon = '<?= $supir["supir_kasbon"]?>';
            var kasbon_bayar = $("#kasbon").val().replaceAll(".","");
            if(kasbon_bayar == ""){
                kasbon_bayar = 0;
            }
            if(parseInt(kasbon)!=0 ){
                if(parseInt(kasbon)>parseInt(kasbon_slip)){
                    if(parseInt(kasbon)<parseInt(kasbon_bayar)){
                        alert('Jumlah Potong Kasbon Harus Lebih Kecil Dari Rp.'+ rupiah(kasbon));
                        $( '#kasbon' ).val(rupiah(kasbon_slip));
                        $("#gaji_grand_total").val(rupiah(total));
                    }else{
                        var gaji_grand_total = parseInt(total)-parseInt(kasbon_bayar);
                        if(gaji_grand_total<0){
                            $("#gaji_grand_total").val(0);
                        }else{
                            $("#gaji_grand_total").val(rupiah(gaji_grand_total));
                        }
                    }
                }
            }else{
                if(parseInt(kasbon_slip)<parseInt(kasbon_bayar)){
                    alert('Jumlah Potong Kasbon Harus Lebih Kecil Dari Rp.'+ rupiah(kasbon_slip));
                    $( '#kasbon' ).val(rupiah(kasbon_slip));
                    $("#gaji_grand_total").val(rupiah(total));
                }else{
                    var gaji_grand_total = parseInt(total)-parseInt(kasbon_bayar);
                    if(gaji_grand_total<0){
                        $("#gaji_grand_total").val(0);
                    }else{
                        $("#gaji_grand_total").val(rupiah(gaji_grand_total));
                    }
                }
            }
        }
        function bonus_nilai(a){
            if($("#"+a.id).val().length>1){
                if($("#"+a.id).val()[0]=="0"){
                    var string_now = $("#"+a.id).val().replace("0","");
                    $("#"+a.id).val(string_now);
                }
            }
            var kasbon = 0;
            if($("#kasbon").val().replaceAll(".","") == ""){
                kasbon = 0;
            }else{
                kasbon = $("#kasbon").val().replaceAll(".","");
            }
            var total = parseInt($("#gaji_total").val().replaceAll(".",""))-parseInt(kasbon);
            $( '#'+a.id ).mask('000.000.000', {reverse: true});
            var bonus = $("#bonus").val().replaceAll(".","");
            if(bonus == ""){
                bonus = 0;
            }
            var gaji_grand_total = parseInt(total)+parseInt(bonus);
            if(gaji_grand_total<0){
                $("#gaji_grand_total").val(0);
            }else{
                $("#gaji_grand_total").val(rupiah(gaji_grand_total));
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
            return rupiah;
        }
        function cek_jo(){
            if($("#jo").val()==""){
                alert("silakan pilih perjalanan supir");
            }
        }
        function set_pilih_jo(a){
            // alert($("#tahun_kerja").val());
            // alert($("#bulan_kerja").val());
            // document.getElementById("form-pilih-jo").reset();
            tahun = $("#tahun_kerja").val();
            bulan = $("#bulan_kerja").val();
            location.replace('<?= base_url("index.php/detail/pilih_gaji/").$supir["supir_id"]."/form/"?>'+tahun+"/"+bulan);
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
                timer: 500
            });
            $("#"+a.id).datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true,
                todayHighlight: true,
            });
        }
    </script>