<?php
    function change_tanggal($data){
        $data_tanggal = explode('-', $data);
        $tanggal = $data_tanggal[2].'-'.$data_tanggal[1].'-'.$data_tanggal[0];
        return $tanggal;
    }
?>
<body class="mt-5" style='background-color:#182039';> 
<div class="mt-5 p-2" style='background-color:#182039';>
    <div class="card shadow " style='background-color:#182039';>
        <div class="card-header " style='background-color:#182039';>
            <h6 class="container float-left font-weight-bold text-light">Mutasi Kasbon Supir</h6>
            <div class="row float-right mr-3">
                <a href="" class="btn btn-sm btn-primary btn-icon-split mr-3" onclick="print_bon()">
                        <span class="icon text-white-100">
                            <i class="fas fa-print"></i> 
                        </span>
                        <span class="text">
                            Print/PDF
                        </span>
                </a>
            </div>
            <div class="row float-right mr-3">
                <form method="POST" action="<?= base_url("index.php/print_berkas/mutasi_excel/")?>" id="convert_form">
                    <input type="hidden" name="file_content" id="file_content">
                    <button type="submit" name="convert" id="convert" class="btn btn-success btn-sm btn-icon-split mr-3">
                        <span class="icon text-white-100">  
                            <i class="fas fa-print"></i>
                        </span>
                        <span class="text">Excel</span>
                    </button>
                </form>
            </div>
        </div>
        <div class="card-body p-4">
            <!-- tampilan detail transaksi bon -->
            <div class="container-fluid">          
                    <div class="d-flex justify-content-start text-light">
                            <h5>Filter Waktu</h5>
                        </div>
                    <div class="d-flex justify-content-start mb-5">
                        <form action="<?= base_url("index.php/detail/detail_report_bon/").$supir_id."/periode"?>" method="POST">
                            <div class="d-flex justify-content-start">
                            <input autocomplete="off" type="text" class="form-control col-md-3" id="tanggal1" name="tanggal1" value="<?= $tanggal1?>" required onclick="tanggal_berlaku(this)">
                            <span class="m-2 accordiontext-center text-light ">sd</span>
                            <input autocomplete="off" type="text" class="form-control col-md-3" id="tanggal2" name="tanggal2" value="<?= $tanggal2?>" required onclick="tanggal_berlaku(this)">
                            <button type="submit" class="col-md-2 btn btn-primary ml-3">Terapkan</button>
                            </div>
                        </form>
                    </div>
            </div>


            <div class="container-fluid mb-5" id="detail-bon-supir">
                <div class="text-center mb-4 p-3" id="supirnya">
                    <h3 class="font-weight-bolder text-light">Nama Supir: <?=$supir?></h3>
                </div>
                <div class="ml-2 mb-3" id="tanggalnya">
                        <div class="row">
                            <input autocomplete="off" type="text" class="d-flex form-control bg-dark text-light" style="width:155px;" id="tanggal1" name="tanggal1" value="<?= $tanggal1?>" readonly>
                            <span class="m-2 text-center text-light">sd</span>
                            <input autocomplete="off" type="text" class="d-flex form-control bg-dark text-light" style="width:155px;" id="tanggal2" name="tanggal2" value="<?= $tanggal2?>" readonly>
                        </div>
                </div>
                                <div class="table-responsive text-light">
                                        <table class="table table-bordered text-light" id="Table-Mutasi">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Tanggal Transaksi</th>
                                                    <th class="text-center">No.Bon</th>
                                                    <th class="text-center">No.Slip Gaji</th>
                                                    <th class="text-center">Keterangan</th>
                                                    <th class="text-center">Debit</th>
                                                    <th class="text-center">Kredit</th>
                                                    <th class="text-center">Saldo Kasbon</th>
                                                </tr>    
                                            </thead>
                                            <tbody>  
                                                <?php  
                                                        $saldo=0;
                                                        if(count($transaksi_bon)==0){
                                                            $saldo_awal = 0;
                                                        }else{
                                                            $saldo_awal = $transaksi_bon[0]["bon_nominal"];                                
                                                        }
                                                        $debit = 0;
                                                        $kredit = 0;
                                                foreach($transaksi_bon as $value){?>
                                                    <tr>
                                                        <td class="text-center" width="12%"><?= change_tanggal($value["bon_tanggal"])?></td>
                                                        <td class="text-center"><?= $value["bon_id"]?></td>
                                                        <td class="text-center"><?= $value["pembayaran_upah_id"]?></td>
                                                        <td class="" width="27%"><?= $value["bon_keterangan"]?></td>
                                                        <?php if($value["bon_jenis"]=="Pembayaran" || $value["bon_jenis"]=="Potong Gaji"){
                                                            $saldo-=$value["bon_nominal"];
                                                            $debit+=$value["bon_nominal"];?>
                                                            <td class="">Rp.<?= number_format($value["bon_nominal"],2,',','.')?></td>
                                                            <td class="">Rp.0</td>
                                                        <?php }else{
                                                            $saldo+=$value["bon_nominal"];
                                                            $kredit+=$value["bon_nominal"];?>
                                                            <td class="">Rp.0</td>
                                                            <td class="">Rp.<?= number_format($value["bon_nominal"],2,',','.')?></td>
                                                        <?php }
                                                        if($saldo==0){?>
                                                            <td class="">Lunas</td>
                                                        <?php }else{?>
                                                            <td class="">Rp.<?= number_format($saldo,2,',','.')?></td>
                                                        <?php }?>
                                                    </tr>
                                                <?php }?>
                                            </tbody>
                                        </table>
                                </div>
                
            </div>
            <div class="container-fluid ">
                    <table class="table table-bordered text-light" id="Table-Detail-Mutasi">
                        <tr>
                            <td>Saldo Bon Awal</td>
                            <td>Rp.<?= number_format($saldo_awal,2,',','.')?></td>
                        </tr>
                        <tr>
                            <td>Total Debit</td>
                            <td>Rp.<?= number_format($debit,2,',','.')?></td>
                        </tr>
                        <tr>
                            <td>Total Kredit</td>
                            <td>Rp.<?= number_format($kredit,2,',','.')?></td>
                        </tr>
                        <tr>
                            <td>Saldo Bon Akhir</td>
                            <?php if($saldo<0){?>
                                <td>Rp.<?= number_format($saldo,2,',','.')?> (Lunas)</td>
                            <?php }else{ ?>
                                <td>Rp.<?= number_format($saldo,2,',','.')?></td>
                            <?php }?>
                        </tr>
                    </table>                            
                </div>
            <!-- end tampilan detail transaksi bon -->
        </div>
    </div>
</div>

                            </body>
<script src="<?=base_url("assets/vendor/jquery/jquery.min.js")?>"></script>

<script type="text/javascript">
    $(document).ready(function() {
            $('#convert').click(function() {
            var table_content = $('#supirnya').html()+$('#tanggalnya').html()+'<table>';
            table_content += $("head").html()+$('#Table-Mutasi').html()+$('#Table-Detail-Mutasi').html();
            table_content += '</table>';
            $('#file_content').val(table_content);
            $('#convert_form').html();
        });
    });
</script>

<script>
function print_bon(){
    var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById("detail-bon-supir").innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
}
</script>