<?php
    function change_tanggal($data){
        $data_tanggal = explode('-', $data);
        $tanggal = $data_tanggal[2].'-'.$data_tanggal[1].'-'.$data_tanggal[0];
        return $tanggal;
    }
?>
<!-- tampilan detail penggajian supir -->
<body style='background-color:#182039';> 
<div class="mt-5 p-1 small text-light" style='background-color:#182039';>
    <div class="card shadow mb-4 mt-3" style='background-color:#182039';>
        <div class="card-header d-flex align-items-center" style='background-color:#182039';>
            <h6 class="m-0 col-md-7 font-weight-bold text-light">Detail Slip Gaji</h6>
            <div class="d-flex justify-content-end col-md-5 align-items-center">
                <span><?= $pembayaran_upah[0]["user_upah"]?></span>
            </div>
        </div>
        <div class="card-body ">
        
        <div class="d-flex justify-content-end">
            <form method="POST" action="<?= base_url("index.php/print_berkas/detail_gaji_excel/")?>" id="convert_form" class="d-flex justify-content-end">
                        <input type="hidden" name="file_content" id="file_content">
                        <button type="submit" name="convert" id="convert" class="btn btn-success btn-sm btn-icon-split mr-2">
                            <span class="icon text-white-100">  
                                <i class="fas fa-print"></i>
                            </span>
                            <span class="text">Excel</span>
                        </button>
                        <a onclick="print_rincian()" class="btn btn-primary btn-sm btn-icon-split">
                        <span class="icon text-white-100">  
                            <i class="fas fa-print"></i>
                        </span>
                        <span class="text">Print/PDF</span>
                    </a>
            </form>
        </div>



            <table class="" >
                <tr id="status">
                    <td width="25%">Status</td>
                    <td width="5%">:</td>
                    <?php if($pembayaran_upah[0]["pembayaran_upah_status"]=="Belum Lunas"){?>
                        <td class="text-danger"><?= $pembayaran_upah[0]["pembayaran_upah_status"]?></td>
                    <?php }else{ ?>
                        <td class="text-success"><?= $pembayaran_upah[0]["pembayaran_upah_status"]?></td>
                    <?php } ?>
                </tr>
            </table>
        </div>
        <div class="card-body" id="identitas">
            <table class="" id="Table-Identitas">
                <tbody>
                    <tr>
                        <td width="50%">Tanggal Slip Gaji</td>
                        <td width="5%">:</td>
                        <td><?= change_tanggal($pembayaran_upah[0]["pembayaran_upah_tanggal"])?></td>
                    </tr>
                    <tr>
                        <td width="25%">No Slip Gaji</td>
                        <td width="5%">:</td>
                        <td><?= $pembayaran_upah[0]["pembayaran_upah_id"]?></td>
                    </tr>
                    <tr>
                        <td width="25%">Nama Supir</td>
                        <td width="5%">:</td>
                        <td><?= $supir["supir_name"]?></td>
                    </tr>
                    <tr>
                        <td width="25%">No   Polisi</td>
                        <td width="5%">:</td>
                        <td><?= $pembayaran_upah[0]["nopol"]?></td>
                    </tr>
                    <tr>
                        <td width="25%">Bulan Kerja</td>
                        <td width="5%">:</td>
                        <td><?= $pembayaran_upah[0]["bulan_kerja"]?></td>
                    </tr>
                    <!-- <tr>
                        <td width="25%">Operator</td>
                        <td width="5%">:</td>
                        <td><?= $pembayaran_upah[0]["user_upah"]?></td>
                    </tr> -->
                </tbody>
            </table>
        </div>
        <div class="card-body" id="rincian">
            <div class="table-responsive">
                <table class="table table-bordered table-striped text-light" id="Table-Penggajian" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center" width="10%" scope="col">JO ID</th>
                            <th class="text-center" width="10%" scope="col">Tgl Keluar</th>
                            <th class="text-center" width="13%" scope="col">Tgl Muat</th>
                            <th class="text-center" width="10%" scope="col">Customer</th>
                            <th class="text-center" width="10%" scope="col">Muatan</th>
                            <th class="text-center" width="10%" scope="col">Dari</th>
                            <th class="text-center" width="10%" scope="col">Ke</th>
                            <th class="text-center" width="10%" scope="col">Uang Jalan</th>
                            <th class="text-center" width="8%" scope="col">Tonase Bongkar</th>
                            <th class="text-center" width="8%" scope="col">Biaya Lain</th>
                            <th class="text-center" width="10%" scope="col">Gaji</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $uang_jalan = 0;
                    foreach($pembayaran_upah as $value){ 
                            $uang_jalan += $value["uang_jalan"];
                        ?>
                        <tr>
                            <td><?= $value["Jo_id"]?></td>
                            <td><?= change_tanggal($value["tanggal_surat"])?></td>
                            <td><?= change_tanggal($value["tanggal_muat"])?></td>
                            <td><?= $value["customer_name"]?></td>
                            <?php if($value["muatan"]==""){?>
                                <td colspan=3 class="text-center">Paketan</td>
                            <?php }else{?>
                                <td><?= $value["muatan"]?></td>
                                <td><?= $value["asal"]?></td>
                                <td><?= $value["tujuan"]?></td>
                            <?php }?>
                            <?php
                                    echo "<td>Rp.".number_format($value["uang_jalan"],0,',','.')."</td>";
                            ?>
                            <td><?= $value["tonase"]?></td>
                            <td>Rp.<?= number_format($value["biaya_lain"],0,',','.')?></td>
                            <td>Rp.<?= number_format($value["upah"],0,',','.')?></td>
                        </tr>
                    <?php } ?>
                        <tr>
                            <td colspan=7 class="text-right">Total</td>
                            <td>Rp.<?= number_format($uang_jalan,0,',','.')?></td>
                            <td></td>
                            <td></td>
                            <td>Rp.<?= number_format($pembayaran_upah[0]["pembayaran_upah_nominal"],0,",",".")?></td>
                        </tr>
                        <tr>
                            <td colspan=10 class="text-right">Potong Kasbon</td>
                            <td>Rp.<?= number_format($pembayaran_upah[0]["pembayaran_upah_bon"],0,",",".")?></td>
                        </tr>
                        <tr>
                            <td colspan=10 class="text-right">Bonus</td>
                            <td>Rp.<?= number_format($pembayaran_upah[0]["pembayaran_upah_bonus"],0,",",".")?></td>
                        </tr>
                        <tr>
                            <td colspan=10 class="text-right">Grand Total Gaji</td>
                            <td id="grand_total">Rp.<?= number_format($pembayaran_upah[0]["pembayaran_upah_total"],0,",",".")?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- end tampilan detail penggajian supir -->

<div style="display:none" id="footer-surat">
    <div class="table-responsive">
        <table width="100%">
            <tbody>
                <tr class="text-center">
                    <td width="25%">Dibuat Oleh,</td>
                    <td width="25%">Disetujui Oleh,</td>
                    <td width="25%">Diserahkan Oleh,</td>
                    <td width="25%" >Diterima Oleh</td>
                </tr>
                <tr class="text-center" style="height:200px">
                    <td width="25%">(...............)</td>
                    <td width="25%">(...............)</td>
                    <td width="25%">(...............)</td>
                    <td width="25%">(...............)</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

                            </body>

<script>
    function isi_rekening(){
        $("#form-rekening").show();
    }
    function print_rincian(){
        $("#status").hide();
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById('identitas').innerHTML+document.getElementById('rincian').innerHTML+document.getElementById('footer-surat').innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
        $("#status").show();
    }
</script>
<script src="<?=base_url("assets/vendor/jquery/jquery.min.js")?>"></script>

<script type="text/javascript">
    $(document).ready(function() {
            $('#convert').click(function() {
            var table_content = '<table>';
            table_content += $("head").html()+$('#Table-Identitas').html()+$('#Table-Penggajian').html();
            table_content += '</table>';
            $('#file_content').val(table_content);
            $('#convert_form').html();
        });
    });
</script>