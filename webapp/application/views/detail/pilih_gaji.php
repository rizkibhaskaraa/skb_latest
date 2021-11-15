<body style='background-color:#182039';> 
<!-- tampilan detail penggajian supir -->
<div class="mt-5 p-1 text-light" style='background-color:#182039';>
    <div class="card shadow mb-4 mt-3" style='background-color:#182039';>
        <div class="card-header py-3 mb-3" style='background-color:#182039';>
            <h6 class="m-0 font-weight-bold text-light  ">Buat Slip Gaji</h6>
        </div>
        <div class="container m-auto" id="rincian">
            <form action="<?= base_url("index.php/detail/insert_upah/").$supir["supir_id"]?>" method="POST" id="form-pilih-jo">
                <input type="text" name="jo" id="jo" required hidden>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="tanggal_gaji" class="col-form-label col-sm-7 font-weight-bold">Tanggal</label>
                            <input autocomplete="off" type="text" class="form-control col-md-5" id="tanggal_gaji" name="tanggal_gaji" value="<?= date("d-m-Y")?>" required readonly>
                        </div>
                        <div class="form-group row">
                            <label for="no_gaji" class="col-form-label col-sm-7 font-weight-bold">No. Slip Gaji</label>

                            <input autocomplete="off" type="text" class="form-control col-md-5" id="no_gaji" name="no_gaji" value="<?= $no_slip_gaji?>" required readonly>
                        </div>
                        <div class="form-group row">
                            <label for="nama_supir" class="col-form-label col-sm-7 font-weight-bold">Driver</label>
                            <select name="nama_supir" id="nama_supir" class="form-control col-sm-5 selectpicker" data-live-search="true" required onchange="redirect_url(this)">
                                <?php if($supir["supir_id"]=="x"){?>
                                    <option class="font-w700" disabled="disabled" selected value="<?= $supir["supir_id"]?>"><?= $supir["supir_name"]?></option>
                                <?php }else{?>
                                    <option value="<?= $supir["supir_id"]?>"><?= $supir["supir_name"]?></option>
                                <?php }?>

                                <?php foreach($all_supir as $value){?>
                                        <option value="<?=$value["supir_id"]?>"><?=$value["supir_name"]?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="form-group row">
                            <label for="nopol" class="col-form-label col-sm-7 font-weight-bold">Bo Polisi</label>
                            <select name="nopol" id="nopol" class="form-control col-sm-5 selectpicker" data-live-search="true" required onchange="redirect_url(this)">
                                <?php if($mobil["mobil_no"]=="No Polisi"){?>
                                    <option class="font-w700" disabled="disabled" selected value="x"><?= $mobil["mobil_no"]?></option>
                                <?php }else{?>
                                    <option value="<?= $mobil["mobil_no"]?>"><?= $mobil["mobil_no"]?></option>
                                <?php }?>
                                <option class="font-w700" value="x">No Polisi</option>
                                <?php foreach($all_mobil as $value){?>
                                        <option value="<?=$value["mobil_no"]?>"><?=$value["mobil_no"]?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="form-group row">
                            <label for="bulan_kerja" class="col-form-label col-sm-6 font-weight-bold">Bulan Kerja</label>
                            <div class="col-sm-3">
                                <select name="bulan_kerja" value="DESC" id="bulan_kerja" class="form-control selectpicker mb-4" data-live-search="true" required onchange="set_pilih_jo(this)">
                                    <?php $bulan = ["Sadasd","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
                                    if($bulan_index!=10){
                                        $bulan_index=str_replace("0","",$bulan_index);
                                    }?>
                                    <option class="font-w700" selected value="<?= $bulan_index?>"><?= $bulan[$bulan_index]?></option>
                                    <option value="01"><?=$bulan[1]?></option>
                                    <option value="02"><?=$bulan[2]?></option>
                                    <option value="03"><?=$bulan[3]?></option>
                                    <option value="04"><?=$bulan[4]?></option>
                                    <option value="05"><?=$bulan[5]?></option>
                                    <option value="06"><?=$bulan[6]?></option>
                                    <option value="07"><?=$bulan[7]?></option>
                                    <option value="08"><?=$bulan[8]?></option>
                                    <option value="09"><?=$bulan[9]?></option>
                                    <option value="10"><?=$bulan[10]?></option>
                                    <option value="11"><?=$bulan[11]?></option>
                                    <option value="12"><?=$bulan[12]?></option>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <select name="tahun_kerja" value="DESC" id="tahun_kerja" class="form-control selectpicker mb-4" data-live-search="true" required onchange="set_pilih_jo(this)">
                                    <option class="font-w700" selected value="x">Semua Tahun</option>
                                    <?php if($tahun=='x'){?>
                                        <option class="font-w700" selected value="x">Tahun</option>
                                    <?php }else{ ?>
                                        <option class="font-w700" selected value="<?= $tahun?>"><?= $tahun?></option>
                                    <?php } ?>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bon_supir" class="col-form-label col-sm-7 font-weight-bold">Bon Terhutang</label>
                            <input autocomplete="off" type="text" class="form-control col-md-5" id="bon_supir" name="bon_supir" value="Rp.<?= number_format($supir["supir_kasbon"],2,",",".")?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-5 ml-5">
                        <div class="form-group row">
                            <label for="gaji_total" class="col-form-label col-sm-7 font-weight-bold">Total</label>
                            <div class="col-sm-5">
                                <input autocomplete="off" type="text" class="form-control" id="gaji_total" name="gaji_total" required readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kasbon" class="col-form-label col-sm-7 font-weight-bold">Bayar Kasbon</label>
                            <div class="col-sm-5">
                                <input autocomplete="off" type="text" class="form-control" id="kasbon" name="kasbon" onkeyup="batas_kasbon(this)">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bonus" class="col-form-label col-sm-7 font-weight-bold">Bonus</label>
                            <div class="col-sm-5">
                                <input autocomplete="off" type="text" class="form-control" id="bonus" name="bonus" onkeyup="bonus_nilai(this)">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gaji_grand_total" class="col-form-label col-sm-7 font-weight-bold">Grand Total</label>
                            <div class="col-sm-5">
                                <input autocomplete="off" type="text" class="form-control" id="gaji_grand_total" name="gaji_grand_total" required readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="keterangan" class="col-form-label col-sm-7 font-weight-bold">Keterangan</label>
                            <textarea name="Keterangan" id="Keterangan" class="form-control col-md-5" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row text-center float-right mb-3 mr-4 p-2 mt-3">
                   
                    <button type="reset" class="btn btn-danger mr-2" onclick="reset_form()">Reset</button>
                    <button type="submit" class="btn btn-success" onclick="cek_jo()">Simpan</button>
                </div>
            </form>
        </div>
        <div class="table-responsive mt-2">
                <table class="table table-bordered table-striped text-light" id="Table-Penggajian" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center" width="10%" scope="col">JO ID</th>
                            <th class="text-center" width="10%" scope="col">No Polisi</th>
                            <th class="text-center" width="10%" scope="col">Tgl Muat</th>
                            <th class="text-center" width="13%" scope="col">Tgl Bongkar</th>
                            <th class="text-center" width="13%" scope="col">Customer</th>
                            <th class="text-center" width="10%" scope="col">Muatan</th>
                            <th class="text-center" width="10%" scope="col">Dari</th>
                            <th class="text-center" width="10%" scope="col">Ke</th>
                            <th class="text-center" width="10%" scope="col">Tonase</th>
                            <th class="text-center" width="10%" scope="col">Gaji</th>
                            <th class="text-center" width="5%" scope="col">Detail</th>
                            <th class="text-center" width="10%" scope="col">Pilih</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($jo as $value){?>
                        <tr>
                            <td class="text-center"><?= $value["Jo_id"]?></td>
                            <td class="text-center"><?= $value["mobil_no"]?></td>
                            <td class="text-center"><?= $value["tanggal_muat"]?></td>
                            <td class="text-center"><?= $value["tanggal_bongkar"]?></td>
                            <td><?= $value["customer_name"]?></td>
                            <td><?= $value["muatan"]?></td>
                            <td><?= $value["asal"]?></td>
                            <td><?= $value["tujuan"]?></td>
                            <td><?= $value["tonase"]?></td>
                            <td>Rp.<?= number_format($value["upah"],2,',','.')?></td>
                            <td class="text-center"><a class='btn btn-sm btn-light' target="_blank" href='<?= base_url('index.php/detail/detail_jo/'.$value["Jo_id"].'/JO')?>'><i class='fas fa-eye'></i></a></td>
                            <td class="text-center"><input class='' id="<?= $value["Jo_id"]?>" type='checkbox' onchange="pilih_gaji(this)"></td>
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
        var data_jo = [];
        $("#gaji_total").val(0);
        $("#gaji_grand_total").val(0);
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
                        var gaji_grand_total = parseInt(gaji_grand_total) + parseInt(gaji);
                        $("#gaji_total").val(rupiah(gaji_total));
                        $("#gaji_grand_total").val(rupiah(gaji_grand_total));
                    }else{
                        var gaji_total = parseInt(gaji_total) - parseInt(gaji);
                        var gaji_grand_total = parseInt(gaji_grand_total) - parseInt(gaji);
                        $("#gaji_total").val(rupiah(gaji_total));
                        $("#gaji_grand_total").val(rupiah(gaji_grand_total));
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
            if(parseInt(kasbon)<parseInt(kasbon_bayar)){
                Swal.fire({
                    title: "Peringatan",
                    icon: "error",
                    text: 'Jumlah Potong Kasbon Harus Lebih Kecil Dari Rp.'+ rupiah(kasbon),
                    type: "error"
                });
                $( '#kasbon' ).val("");
                $("#gaji_grand_total").val(rupiah(total));
            }else{
                var gaji_grand_total = parseInt(total)-parseInt(kasbon_bayar);
                $("#gaji_grand_total").val(rupiah(gaji_grand_total));
            }
            
            if(parseInt(total)<parseInt(kasbon_bayar)){
                Swal.fire({
                    title: "Peringatan",
                    icon: "error",
                    text: 'Jumlah Potong Kasbon Harus Lebih Kecil Dari Rp.'+ rupiah(kasbon),
                    type: "error"
                });
                $( '#kasbon' ).val("");
                $("#gaji_grand_total").val(rupiah(total));
            }else{
                var gaji_grand_total = parseInt(total)-parseInt(kasbon_bayar);
                $("#gaji_grand_total").val(rupiah(gaji_grand_total));
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
            $("#gaji_grand_total").val(rupiah(gaji_grand_total));
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
                Swal.fire({
                    title: "Peringatan",
                    icon: "error",
                    text: "silakan pilih perjalanan supir",
                    type: "error"
                });
            }
        }
    </script>
    <script>
        function set_pilih_jo(a){
            // alert($("#tahun_kerja").val());
            // alert($("#bulan_kerja").val());
            // document.getElementById("form-pilih-jo").reset();
            tahun = $("#tahun_kerja").val();
            bulan = $("#bulan_kerja").val();
            if(bulan<10){
                if(bulan[0]!="0"){
                    bulan = "0"+bulan;
                }
            }
            location.replace('<?= base_url("index.php/detail/pilih_gaji/").$supir["supir_id"]."/".$mobil["mobil_no"]."/form/"?>'+bulan+"/"+tahun);
        }
    </script>
    <script>
        function reset_form(){
            location.replace('<?= base_url("index.php/detail/pilih_gaji/")."x/x/form/".date('m').'/'.date('Y')?>');
        }
    </script>
    <script> //script set tanggal saat ini
        $(function(){
            var date = new Date();
            if((date.getMonth()+1)<10){
                $("#tanggal_gaji").val(date.getDate()+"-0"+(date.getMonth()+1)+"-"+date.getFullYear());
            }else{
                $("#tanggal_gaji").val(date.getDate()+"-"+(date.getMonth()+1)+"-"+date.getFullYear());
            }
        });
    </script>
    <script> //script input tanggal
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
    <script>
        function redirect_url(a){
            var id_supir = $("#nama_supir").val();
            var nopol = $("#nopol").val();
            <?php if($bulan_index<10){
                $bulan_index = "0".$bulan_index;
            }?>
            location.replace("<?= base_url('index.php/detail/pilih_gaji/"+id_supir+"/"+nopol+"/home/').$bulan_index.'/'.$tahun?>");
        }
    </script>