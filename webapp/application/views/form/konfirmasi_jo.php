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
            <div class="mt-5 p-1 text-light" style='background-color:#182039';>
            <h4 class=" p-2 mt-5 font-weight-bold text-light  ">Konfirmasi Job Order</h4>
                <div class="row mt-5">
                    <div class="col-md-6">
                        <table class="table table-bordered text-light">
                            <tbody>
                                <tr>
                                    <td class="font-weight-bold" style="width: 30%;">ID Job Order</td>
                                    <td name="Jo_id"><span><?= $data_jo["Jo_id"]?></span></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold" style="width: 30%;">Tanggal</td>
                                    <td name="tanggal_surat"><span><?= change_tanggal($data_jo["tanggal_surat"])?></span></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold" style="width: 30%;">Supir</td>
                                    <td name="supir_name"><span><?= $data_jo["supir_name"]?></span></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold" style="width: 30%;">No Polisi</td>
                                    <td name="mobil_no"><span><?= $data_jo["mobil_no"]?></span></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold" style="width: 30%;">Jenis Mobil</td>
                                    <td name="mobil_jenis"><span><?= $data_jo["mobil_jenis"]?></span></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold" style="width: 30%;">Customer</td>
                                    <td name="customer_name"><span><?= $data_jo["customer_name"]?></span></td>
                                </tr>                                <tr>
                                    <td class="font-weight-bold" style="width: 30%;">Muatan</td>
                                    <td name="muatan"><span><?= $data_jo["muatan"]?></span></td>
                                </tr>                                <tr>
                                    <td class="font-weight-bold" style="width: 30%;">Dari</td>
                                    <td name="asal"><span><?= $data_jo["asal"]?></span></td>
                                </tr>                                <tr>
                                    <td class="font-weight-bold" style="width: 30%;">Ke</td>
                                    <td name="tujuan"><span><?= $data_jo["tujuan"]?></span></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold" style="width: 30%;">Total UJ</td>
                                    <td name="uang"><span>Rp.<?= number_format($data_jo["uang_jalan"],0,',','.')?></span></td>
                                </tr>                                <tr>
                                    <td class="font-weight-bold" style="width: 30%;">Jenis Muatan</td>
                                    <td name="tipe_muatan"><span><?= $data_jo["tipe_tonase"]?></span></td>
                                </tr>
                            </tbody>
                        </table>                
                    </div>
                    <div class="col-md-6 table-borderless ">
                        <form id="form_update_jo" action="<?php echo base_url("index.php/form/update_jo_status/".$data_jo["supir_id"]."/".$data_jo["mobil_no"])?>" method="POST">
                            <input type="text" name="jo_id" id="jo_id" hidden value="<?= $data_jo["Jo_id"]?>">
                            <div class="konfirmasi">
                                <div class="form-group">
                                    <label for="status" class="form-label">Status</label>
                                    <input autocomplete="off" class="form-control" type="text" name="status" id="status" value="Sampai Tujuan" readonly>    
                                </div>
                                <div class="form-group">
                                    <label for="tgl_muat" class="form-label">Tanggal Muat</label>
                                    <input autocomplete="off" class="form-control" type="text" name="tgl_muat" id="tgl_muat" onclick="tanggal_berlaku(this)" onchange="cek_tanggal(this)" required>
                                </div>
                                <div class="form-group">
                                    <label for="tgl_bongkar" class="form-label">Tanggal Bongkar</label>
                                    <input autocomplete="off" class="form-control" type="text" name="tgl_bongkar" id="tgl_bongkar" onclick="tanggal_berlaku(this)" onchange="cek_tanggal(this)" required>
                                </div>
                                <div class="form-group">
                                    <label for="tonase" class="form-label">Berat Muatan</label>
                                    <input autocomplete="off" class="form-control" type="text" name="tonase" id="tonase" onkeyup="uang()" required>    
                                </div>
                                <div class="form-group">
                                    <label for="biaya_lain" class="form-label">Biaya Lain</label>
                                    <input autocomplete="off" class="form-control" type="text" name="biaya_lain" id="biaya_lain" onkeyup="uang()">    
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="Keterangan" class="form-label">Keterangan/Catatan Tambahan</label>
                                    <textarea class="form-control" name="Keterangan" rows="3"></textarea>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success  mb-3">Simpan</button>
                </div>
                </form>
            </div>
</body>
<script>
    function uang(){
        $( '#tonase' ).mask('000.000.000', {reverse: true});
        // $( '#harga' ).mask('000.000.000', {reverse: true});
        $( '#biaya_lain' ).mask('000.000.000', {reverse: true});
        $( '#bonus' ).mask('000.000.000', {reverse: true});
    }
    function cek_tanggal(a){
        var tanggal_muat = Date.parse(change_tanggal($("#tgl_muat").val()));
        var tanggal_bongkar = Date.parse(change_tanggal($("#tgl_bongkar").val()));
        if(tanggal_muat > tanggal_bongkar){
            alert("Tanggal Bongkar Harus Lebih Dari Tanggal Muat");
            $("#tgl_muat").val("");
            $("#tgl_bongkar").val("");
        }
    }
        function change_tanggal(data){
            if(data=="" || data==null){
                return "";
            }else if(data=="0000-00-00"){
                return "";
            }else{
                var data_tanggal = data.split("-");
                var tanggal = data_tanggal[2]+"-"+data_tanggal[1]+"-"+data_tanggal[0];
                return tanggal;
            }
        }
</script>