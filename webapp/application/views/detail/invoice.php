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
    function generate_terbilang($uang){
        $uang = abs($uang);
        $huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "sebelas");
        $temp = "";

        if ($uang < 12) {
            $temp = " ". $huruf[$uang];
        } else if ($uang <20) {
            $temp = generate_terbilang($uang - 10). " Belas";
        } else if ($uang < 100) {
            $temp = generate_terbilang($uang/10)." Puluh". generate_terbilang($uang % 10);
        } else if ($uang < 200) {
            $temp = " Seratus" . generate_terbilang($uang - 100);
        } else if ($uang < 1000) {
            $temp = generate_terbilang($uang/100) . " Ratus" . generate_terbilang($uang % 100);
        } else if ($uang < 2000) {
            $temp = " Seribu" . generate_terbilang($uang - 1000);
        } else if ($uang < 1000000) {
            $temp = generate_terbilang($uang/1000) . " Ribu" . generate_terbilang($uang % 1000);
        } else if ($uang < 1000000000) {
            $temp = generate_terbilang($uang/1000000) . " Juta" . generate_terbilang($uang % 1000000);
        }     
        return $temp;
    }
?>
<!-- Basic Card Example -->
<body class="mt-5 p-3" style='background-color:#182039';> 
<a href="<?= base_url("index.php/home/invoice_customer")?>" class="btn btn-danger btn-circle m-2">
            <i class="fas fa-times"></i>
        </a>
<div class="card shadow text-light" style='background-color:#182039';> 

    <div class="card-header py-3 " style='background-color:#182039';>
        <h6 class="m-0 font-weight-bold text-light ">Detail Invoice</h6>
        <span class="mr-3"><small><?= $invoice[0]["user_invoice"]?></small></span>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-end">
        <a class="btn btn-primary btn-sm mr-3 btn-icon-split float-right" onclick="cetak_invoice()">
            <span class="icon text-white-100">  
                <i class="fas fa-print"></i>
            </span>
            <span class="text">Print/PDF</span>
        </a>
        <a class="float-right">
        <form method="POST" action="<?= base_url("index.php/print_berkas/detail_invoice_excel/")?>" id="convert_form" class="mr-3">
            <input type="hidden" name="file_content" id="file_content">
            <button type="submit" name="convert" id="convert" class="btn btn-success btn-sm btn-icon-split">
                <span class="icon text-white-100">  
                    <i class="fas fa-print"></i>
                </span>
                <span class="text">Excel</span>
            </button>
        </form>
        </a>
        </div>
            <div class="container small ">
                <div class="py-3">
                    <h6 class="m-0 font-weight-bold text-center">Invoice</h6>
                </div>
                <div class="">
                    <table class="mt-4" id="Table-Detail-Invoice">
                        <tbody>
                            <tr>
                                <td width="">Customer</td>
                                <td width="">:</td>
                                <td><?= $customer["customer_name"]?></td>
                            </tr>
                            <tr>
                                <td width="">Invoice No</td>
                                <td width="">:</td>
                                <td><?= $invoice[0]["invoice_kode"]?></td>
                            </tr>
                            <tr>
                                <td width="">Tanggal</td>
                                <td width="">:</td>
                                <td><?= change_tanggal($invoice[0]["tanggal_invoice"])?></td>
                            </tr>
                            <tr>
                                <td width="">Batas Pembayaran</td>
                                <td width="">:</td>
                                <td><?= $invoice[0]["batas_pembayaran"]?> hari (<?= change_tanggal($invoice[0]["tanggal_batas_pembayaran"])?>)</td>
                            </tr>
                            <!-- <tr>
                                <td width="35%">Operator</td>
                                <td width="5%">:</td>
                                <td><?= $invoice[0]["user_invoice"]?></td>
                            </tr> -->
                        </tbody>
                    </table>
                    <table class="">
                        <tbody>
                            <tr>
                                <td width="">Status Pembayaran</td>
                                <td width="">:</td>
                                <td >
                                    <?php if($invoice[0]["status_bayar"] == "Belum Lunas"){?>
                                        <span class="text-danger"><?= $invoice[0]["status_bayar"]?></span>
                                    <?php }else{?>
                                        <span class="text-success"><?= $invoice[0]["status_bayar"]?></span>
                                    <?php }?>
                                </td>
                            </tr>
                            <tr>
                                <td width="">Keterangan/Catatan</td>
                                <td width="">:</td>
                                <td><?= $invoice[0]["invoice_keterangan"]?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered text-light" width="100%" cellspacing="0" id="Table-Data-Invoice">
                            <thead>
                                <tr>
                                    <th class="text-center" width="25%" scope="col">No</th>
                                    <th class="text-center" width="13%" scope="col">Tgl Muat</th>
                                    <th class="text-center" width="13%" scope="col">Tgl Bongkar</th>
                                    <th class="text-center" width="10%" scope="col">No. Polisi</th>
                                    <th class="text-center" width="25%" scope="col">Muatan</th>
                                    <th class="text-center" width="25%" scope="col">Dari</th>
                                    <th class="text-center" width="25%" scope="col">Ke</th>
                                    <th class="text-center" width="10%" scope="col">Total Muatan</th>
                                    <th class="text-center" width="10%" scope="col">Harga</th>
                                    <th class="text-center" width="10%" scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $n=1;
                            foreach($invoice as $value){?>
                                <tr>
                                    <td><?= $n?></td>
                                    <td><?= change_tanggal($value["tanggal_muat"])?></td>
                                    <td><?= change_tanggal($value["tanggal_bongkar"])?></td>
                                    <td><?= $value["mobil_no"]?></td>
                                    <td><?= $value["muatan"]?></td>
                                    <td><?= $value["asal"]?></td>
                                    <td><?= $value["tujuan"]?></td>
                                    <td><?= number_format($value["tonase"],0,',','.')?></td>
                                    <td>Rp.<?= number_format($value["tagihan"],0,',','.')?></td>
                                    <td>Rp.<?= number_format($value["total_tagihan"],0,',','.')?></td>
                                    </tr>
                                <?php $n++;}?>
                                <tr>
                                    <td colspan=9 class="text-right">Total</td>
                                    <td>Rp.<?= number_format($invoice[0]["total"],0,',','.')?></td>
                                </tr>
                                <?php if($invoice[0]["ppn"]!=0){?>
                                    <tr>
                                        <td colspan=9 class="text-right">PPN 10%</td>
                                        <td>Rp.<?= number_format($invoice[0]["ppn"],0,',','.')?></td>
                                    </tr>
                                    <tr>
                                        <td colspan=9 class="text-right">Grand Total</td>
                                        <td>Rp.<?= number_format($invoice[0]["grand_total"],0,',','.')?></td>
                                    </tr>
                                <?php }?>
                                <?php if($invoice[0]["ppn"]!=0){?>
                                    <tr>
                                        <td colspan=10>Terbilang = #<?= generate_terbilang($invoice[0]["grand_total"])?> Rupiah #</td>
                                    </tr>
                                <?php }else{?>
                                    <tr>
                                        <td colspan=10>Terbilang = #<?= generate_terbilang($invoice[0]["total"])?> Rupiah #</td>
                                    </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                
            </div>
            <!-- end detail invoice -->

                </div>
            </div>


             <!-- pop up update status invoice -->
                <div class="modal fade mt-5 px-5 py-5" id="popup-konfirmasi-status" tabindex="-1" 
                    role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-primary-dark">
                                <h5 class="font-weight-bold mt-2">Konfirmasi Lunas</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="font-size-sm m-3 text-justify">
                                <p>Apakah anda ingin merubah status <b>Kode Invoice  #<span id="view-invoice-kode" ></b> </span> menjadi <b>Lunas</b> ?</p>
                                <form id="form-status-jo"  method="POST" action="<?= base_url("index.php/detail/updateinvoice")?>">
                                    <input type="text" name="invoice-kode" id="invoice-kode" hidden>
                                        <button type="submit" class="btn btn-success mb-3 mt-3 float-right">Ya, Lunas</button>
                                        <button class="btn btn-outline-danger mb-3 mr-3 mt-3 float-right" data-dismiss="modal">Batal</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end pop up update status invoice -->
                                </body>
                <script src="<?=base_url("assets/vendor/jquery/jquery.min.js")?>"></script>



<script type="text/javascript">
    $(document).ready(function() {
            $('#convert').click(function() {
            var table_content = '';
            table_content += '<table>'+$('#Table-Detail-Invoice').html()+'</table>';
            table_content += '<table>'+$('#Table-Data-Invoice').html()+'</table>';
            $('#file_content').val(table_content);
            $('#convert_form').html();
        });
    });
</script>
<script>
    function cetak_invoice(){
        window.location.replace("<?= base_url("index.php/print_berkas/invoice/".$invoice[0]["invoice_kode"]."/invoice")?>");    
    }
    function update_status(a){
        var invoice_kode = a.id;
        $("#view-invoice-kode").text(invoice_kode);
        $("#invoice-kode").val(invoice_kode);
    }
</script>