

<body class="mt-5" style='background-color:#182039';> 
<?php
    function change_tanggal($data){
        if($data==""){
            return "";
        }else{
            $data_tanggal = explode('-', $data);
            $tanggal = $data_tanggal[2].'-'.$data_tanggal[1].'-'.$data_tanggal[0];
            return $tanggal;
        }
    }
    $array_keterangan = explode("===",$jo["keterangan"]);
?>
<div class="container mt-5" style='background-color:#182039';>
        <!-- Basic Card Example -->
        <div class="card shadow " style='background-color:#212B4E';>
            <div class="card-header " style='background-color:#212B4E';>
                <h6 class="mt-2 font-weight-bold text-light float-left ">Detail Job Order</h6>
                <div class="float-right ml-3">
                    <a class='btn btn-primary btn-sm ' onclick="print_pdf()">
                        <span>Print/PDF</span>
                    </a>
                </div>
                <div class="float-right">
                    <form method="POST" action="<?= base_url("index.php/print_berkas/jo_excel/")?>" id="convert_form">
                        <input type="hidden" name="file_content" id="file_content">
                        <button type="submit" name="convert" id="convert" class="btn btn-success btn-sm">
                            <span class="text">Excel</span>
                        </button>
                    </form>
                </div>
            </div>
     
                <!-- tampilan detail jo -->
                <div class="mt-3" id="detail-jo">
                    <table class="table table-responsive table-bordered text-light" id="Table-JO">
                        <tbody>     
                            <tr>
                                <td class="font-weight-bold">ID JO</td>
                                <td colspan=3><?= $jo["Jo_id"] ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Tanggal JO</td>
                                <td colspan=3><?= change_tanggal($jo["tanggal_surat"]) ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Supir</td>                
                                    <?php if($jo["status"]=="Dalam Perjalanan"){?>
                                        <td colspan=3>
                                            <div class="row ">
                                                <p class="col"><?= $supir["supir_name"] ?></p>
                                                <!-- <a class='btn btn-primary btn-sm col-md-4' data-toggle="modal" data-target="#supir_update">
                                                    <span>Ganti Supir</span>
                                                </a> -->
                                            </div>                                    
                                        </td>
                                    <?php }else{?>
                                        <td colspan=3><?= $supir["supir_name"] ?></td>
                                    <?php }?>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Kendaraan</td>
                                    <?php if($jo["status"]=="Dalam Perjalanan"){?>
                                        <td colspan=3>
                                            <div class="row ">
                                                <p class="col"><?= $mobil["mobil_no"]." == ".$mobil["mobil_jenis"] ?></p>
                                                <!-- <a class='btn btn-primary btn-sm col-md-4' data-toggle="modal" data-target="#mobil_update">
                                                    <span>Ganti mobil</span>
                                                </a> -->
                                            </div>                                    
                                        </td>
                                    <?php }else{?>
                                        <td colspan=3><?= $mobil["mobil_no"]." == ".$mobil["mobil_jenis"] ?></td>
                                    <?php }?>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" >Customer</td>
                                <td colspan=3><?= $customer["customer_name"] ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" >Muatan</td>
                                <td colspan=3><?= $jo["muatan"] ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" >Dari</td>
                                <td colspan=3><?= $jo["asal"] ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" >Ke</td>
                                <td colspan=3><?= $jo["tujuan"] ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold " >Uang Jalan</td>
                                <td colspan=3><p>Rp.<?= number_format($jo["uang_jalan"],0,',','.') ?></p></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold " >Tambahan/Potongan Uang Jalan</td>
                                    <td colspan=3><p>Rp.<?= number_format($jo["nominal_tambahan"],0,',','.') ?> (<?= $jo["jenis_tambahan"]?>)</p></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold " >Total Uang Jalan</td>
                                <td colspan=3><p>Rp.<?= number_format($jo["uang_total"],0,',','.')?></p></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold " >Sisa Uang Jalan</td>
                                <td colspan=3>Rp.<?=number_format($jo["sisa"],0,',','.')?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" >Keterangan</td>
                                <td colspan=3><?= $array_keterangan[0]?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" >Status</td>
                                <td colspan=3><?= $jo["status"] ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" >Tanggal Muat</td>
                                <td colspan=3><?= change_tanggal($jo["tanggal_muat"]) ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" >Tanggal Bongkar</td>
                                <td colspan=3><?= change_tanggal($jo["tanggal_bongkar"]) ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" >Berat Muatan</td>
                                <td colspan=3><?= $jo["tonase"] ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" >Biaya Lain-lain</td>
                                <td colspan=3>Rp.<?= number_format($jo["biaya_lain"],0,',','.')?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" style="width: 20%;">Keterangan Ubah Status</td>
                                <?php if(count($array_keterangan)==1){
                                    echo "<td colspan=3></td>";
                                }else{
                                    echo "<td colspan=3><?= $array_keterangan[1]?></td>";
                                }?>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" >No Slip Gaji</td>
                                <td colspan=3><?= $slip_gaji[0]["pembayaran_upah_id"] ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" >Tanggal Slip Gaji</td>
                                <td colspan=3><?= change_tanggal($slip_gaji[0]["pembayaran_upah_tanggal"]) ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" >Nominal Gaji</td>
                                <td colspan=3>Rp.<?= number_format($jo["upah"],0,',','.')?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" >No Invoice</td>
                                <td colspan=3><?= $invoice[0]["invoice_id"]?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" >Tanggal Invoice</td>
                                <td colspan=3><?= change_tanggal($invoice[0]["tanggal_invoice"])?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" >Nominal Invoice</td>
                                <td colspan=3>Rp.<?= number_format($jo["total_tagihan"],0,',','.')?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" >Pembuat JO</td>
                                <td colspan=3><?= $jo["user"]?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" >Penutup JO</td>
                                <td colspan=3><?= $jo["user_closing"]?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" >Pembuat Slip Gaji</td>
                                <td colspan=3><?= $slip_gaji[0]["user_upah"]?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" >Pembuat Invoice</td>
                                <td colspan=3><?= $invoice[0]["user_invoice"]?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- end tampilan detail jo -->
            
        </div>
</div>

</body>


<script src="<?=base_url("assets/vendor/jquery/jquery.min.js")?>"></script>

<script>
    function uang(a){
        $( '#'+a.id ).mask('000.000.000', {reverse: true});
        var sisa = '<?= $jo['uang_total']-$jo['uang_jalan_bayar']?>';
        var uang_bayar = $("#uang_jalan_bayar").val().split(".");
        var uang_bayar_fix = "";
        for(i=0;i<uang_bayar.length;i++){
            uang_bayar_fix += uang_bayar[i];
        }
        if(parseInt(sisa)<parseInt(uang_bayar_fix)){
            alert('Jumlah Pembayaran UJ Harus Lebih Kecil Dari Rp.'+ rupiah(sisa));
            $( '#uang_jalan_bayar' ).val("");
        }
    }
    function sisa_uj(sisa){
        $("#sisa_uj").text(rupiah(sisa));
    }
</script>
<script type="text/javascript">
 $(document).ready(function() {
  $('#convert').click(function() {
   var table_content = '<table>';
   table_content += $("head").html()+$('#Table-JO').html();
   table_content += '</table>';
   $('#file_content').val(table_content);
   $('#convert_form').html();
  });
 });
 function print_pdf(){
    var restorepage = document.body.innerHTML;
    var printcontent = document.getElementById('detail-jo').innerHTML;
    document.body.innerHTML = printcontent;
    window.print();
    document.body.innerHTML = restorepage;
  }
</script>