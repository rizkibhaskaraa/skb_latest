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
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sumber Karya Berkah</title>

    <link href="<?=base_url("assets/css/sb-admin-2.min.css")?>" rel="stylesheet">
</head>
<body class="text-dark small">
<div class="mb-4">
        <div class="py-3">
            <h6 class="m-0 font-weight-bold text-center">Invoice</h6>
        </div>
        <div class="card-body">
            <table class="w-50 small">
                <tbody>
                    <tr>
                        <td width="35%">Customer</td>
                        <td width="5%">:</td>
                        <td><?= $customer["customer_name"]?></td>
                    </tr>
                    <tr>
                        <td width="35%">Invoice Kode</td>
                        <td width="5%">:</td>
                        <td><?= $invoice[0]["invoice_kode"]?></td>
                    </tr>
                    <tr>
                        <td width="35%">Tanggal</td>
                        <td width="5%">:</td>
                        <td><?= change_tanggal($invoice[0]["tanggal_invoice"])?></td>
                    </tr>
                    <tr>
                        <td width="35%">Batas Pembayaran</td>
                        <td width="5%">:</td>
                        <td><?= $invoice[0]["batas_pembayaran"]?> hari (<?= $invoice[0]["tanggal_batas_pembayaran"]?>)</td>
                    </tr>
                    <tr>
                        <td width="35%">Keterangan/Catatan</td>
                        <td width="5%">:</td>
                        <td><?= $invoice[0]["invoice_keterangan"]?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered small" id="Table-Jo" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center" width="25%" scope="col">No</th>
                            <th class="text-center" width="13%" scope="col">Tgl Muat</th>
                            <th class="text-center" width="13%" scope="col">Tgl Bongkar</th>
                            <th class="text-center" width="10%" scope="col">Mobil</th>
                            <th class="text-center" width="25%" scope="col">Muatan</th>
                            <th class="text-center" width="25%" scope="col">Dari</th>
                            <th class="text-center" width="25%" scope="col">Ke</th>
                            <th class="text-center" width="10%" scope="col">Total Muatan</th>
                            <th class="text-center" width="10%" scope="col">Jumlah Tagihan</th>
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
                            <td><?= $value["tonase"]?></td>
                            <td>Rp.<?= number_format($value["tagihan"],2,',','.')?></td>
                        </tr>
                    <?php $n++;}?>
                        <tr>
                            <td colspan=8>Total</td>
                            <td>Rp.<?= number_format($invoice[0]["total"],2,',','.')?></td>
                        </tr>
                        <?php if($invoice[0]["ppn"]!=0){?>
                            <tr>
                                <td colspan=8>PPN 10%</td>
                                <td>Rp.<?= number_format($invoice[0]["ppn"],2,',','.')?></td>
                            </tr>
                            <tr>
                                <td colspan=8>Jumlah</td>
                                <td>Rp.<?= number_format($invoice[0]["grand_total"],2,',','.')?></td>
                            </tr>
                        <?php }?>
                        <?php if($invoice[0]["ppn"]!=0){?>
                            <tr>
                                <td colspan=9>Terbilang = #<?= generate_terbilang($invoice[0]["grand_total"])?> Rupiah #</td>
                            </tr>
                        <?php }else{?>
                            <tr>
                                <td colspan=9>Terbilang = #<?= generate_terbilang($invoice[0]["total"])?> Rupiah #</td>
                            </tr>
                        <?php }?>
                    </tbody>
                </table>
                <table class="small">
                    <tbody>
                        <tr>
                            <td>Harap Pembayaran di Transfer Ke</td>
                        </tr>
                        <tr>
                            <td width="25%">Bank</td>
                            <td width="5%">:</td>
                            <td>OCBC NISP</td>
                        </tr>
                        <tr>
                            <td width="25%">A/N</td>
                            <td width="5%">:</td>
                            <td>PT.Sumber Karya Berkah</td>
                        </tr>
                        <tr>
                            <td width="25%">No.Rek</td>
                            <td width="5%">:</td>
                            <td>3308.0000.5911</td>
                        </tr>
                        <tr class="text-center">
                            <td>Hormat Kami</td>
                        </tr>
                        <tr class="text-center">
                            <td style="height:150px">(..........................................)</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<script>
    var asal = '<?= $asal?>';
    window.print();
    window.location.replace("<?= base_url("index.php/detail/detail_invoice/".$invoice_kode."/Invoice")?>");
</script>
</html>