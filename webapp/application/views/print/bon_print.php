<?php
    function change_tanggal($data){
        $data_tanggal = explode('-', $data);
        $tanggal = $data_tanggal[2].'-'.$data_tanggal[1].'-'.$data_tanggal[0];
        return $tanggal;
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
<body class="text-dark" >
    <div class="container w-50">
        <div class="container mr-0 w-50 mb-5">
            <p><?= $data["user"]?></p>
        </div>
        <div class="body-card text-center">
            <span class="h3">NOTA KAS BON</span>
            <hr>
        </div>
        <div class="card-body">
                <div class="table-responsive">
                    <table class="" id="" width="100%" cellspacing="0">
                        <tbody>
                            <tr>
                                <td width="30%">Tanggal</td>
                                <td width="5%">:</td>
                                <td><?= change_tanggal($data["bon_tanggal"])?></td>
                            </tr>
                            <tr>
                                <td width="30%">Nota Nota</td>
                                <td width="5%">:</td>
                                <td><?= $data["bon_id"]?></td>
                            </tr>
                            <tr>
                                <td width="30%">Driver</td>
                                <td width="5%">:</td>
                                <td><?= $supir["supir_name"]?></td>
                            </tr>
                            <tr>
                                <td width="30%">Jenis Transaksi</td>
                                <td width="5%">:</td>
                                <td><?= $data["bon_jenis"]?> BON</td>
                            </tr>
                            <tr>
                                <td width="30%">Nominal</td>
                                <td width="5%">:</td>
                                <td>Rp.<?= number_format($data["bon_nominal"],2,',','.')?></td>
                            </tr>
                            <tr>
                                <td width="30%">Terbilang</td>
                                <td width="5%">:</td>
                                <td><?= generate_terbilang($data["bon_nominal"])?> Rupiah</td>
                            </tr>
                            <tr>
                                <td width="30%">Keterangan</td>
                                <td width="5%">:</td>
                                <td><?= $data["bon_keterangan"]?></td>
                            </tr>
                            <tr>
                                <td width="30%">No Slip Gaji</td>
                                <td width="5%">:</td>
                                <td><?= $data["pembayaran_upah_id"]?></td>
                            </tr>
                            <tr>
                                <td colspan=3><hr></td>
                            </tr>
                        </tbody>
                    </table>
                    <table width="100%">
                        <tbody>
                            <tr class="text-center">
                                <td width="25">Dibuat Oleh,</td>
                                <td width="25">Disetujui Oleh,</td>
                                <td width="25" >Diserahkan Oleh</td>
                                <td width="25" >Diterima Oleh</td>
                            </tr>
                            <tr class="text-center" style="height:200px">
                                <td width="25" >(.................)</td>
                                <td width="25" >(.................)</td>
                                <td width="25" >(.................)</td>
                                <td width="25" >(.................)</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
</body>
<script>
    window.print();
    var asal = '<?= $asal?>';
    if(asal=="insert"){ 
        window.location.replace("<?= base_url("index.php/home/bon")?>");
    }else if(asal=="batal JO"){
        window.location.replace("<?= base_url("index.php/home/konfirmasi_jo/")?>");
    }else if(asal=="detail"){
        window.location.replace("<?= base_url("index.php/home/bon/")?>");
    }else{
        window.location.replace("<?= base_url("index.php/home")?>");
    }
</script>
</html>