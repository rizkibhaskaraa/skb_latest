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

    <!-- Custom fonts for this template-->
    <link href="<?=base_url("assets/vendor/fontawesome-free/css/all.min.css")?>" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.css') ?>">
    <!-- Custom styles for this template-->
    <link href="<?=base_url("assets/css/sb-admin-2.min.css")?>" rel="stylesheet">
</head>
<body class="text-dark">
    <div class="container w-50">
        <div class="container mr-0 w-50 mb-5">
            <p><?= $data["user"]?></p>
        </div>
        <div class="body-card text-center">
            <span class="h3">Bukti Titipan Uang Jalan</span><br>
            <hr>
        </div>
        <div class="card-body"> 
                <div class="table-responsive">
                    <table class="" id="" width="100%" cellspacing="0">
                        <tbody>
                            <tr>
                                <td width="30%"><strong>JO ID</strong></td>
                                <td width="5%">:</td>
                                <td ><strong>#<?= $jo_id?></strong></td>
                            </tr>
                            <tr>
                                <td width="30%">Tgl. JO</td>
                                <td width="5%">:</td>
                                <td ><?= change_tanggal($data["tanggal_surat"])?></td>
                            </tr>
                            <tr>
                                <td width="30%">Tgl. Penyerahan UJ</td>
                                <td width="5%">:</td>
                                <td ><?= change_tanggal($data["payment_jo_tgl"])?></td>
                            </tr>
                            <tr>
                                <td width="30%">Supir</td>
                                <td width="5%">:</td>
                                <td><?= $supir["supir_name"]?></td>
                            </tr>
                            <tr>
                                <td width="30%">No Pol</td>
                                <td width="5%">:</td>
                                <?php if($mobil!=null){?>
                                    <td><?= $mobil["mobil_no"]." || ".$mobil["mobil_jenis"]?></td>
                                <?php }?>
                            </tr>
                            <tr>
                                <td width="30%">Customer</td>
                                <td width="5%">:</td>
                                <td><?= $customer["customer_name"]?></td>
                            </tr>
                            <tr>
                                <td width="30%">Muatan</td>
                                <td width="5%">:</td>
                                <td><?= $data["muatan"]?></td>
                            </tr>
                            <tr>
                                <td width="30%">Dari</td>
                                <td width="5%">:</td>
                                <td><?= $data["asal"]?></td>
                            </tr>
                            <tr>
                                <td width="30%">Ke</td>
                                <td width="5%">:</td>
                                <td><?= $data["tujuan"]?></td>
                            </tr>
                            <!-- <tr>
                                <td width="30%">Uang Jalan</td>
                                <td width="5%">:</td>
                                <td>Rp.<?= number_format($data["uang_jalan"],0,',','.')?></td>
                            </tr> -->
                                <!-- <tr>
                                    <td width="30%">Tambahan/Potongan UJ</td>
                                    <td width="5%">:</td>
                                        <td>Rp.<?= number_format($data["nominal_tambahan"],0,",",".")?> (<?= $data["jenis_tambahan"]?>)</td>
                                </tr> -->
                            <tr>
                                <td width="30%">Total UJ</td>
                                <td width="5%">:</td>
                                <td>Rp.<?= number_format($data["uang_total"],0,',','.')?></td>
                            </tr>
                            <tr>
                                <td width="30%">Sisa UJ</td>
                                <td width="5%">:</td>
                                <td>Rp.<?= number_format($data["sisa"],0,',','.')?></td>
                            </tr>
                            <tr>
                                <td width="30%">UJ Yang Diserahkan</td>
                                <td width="5%">:</td>
                                <td>Rp.<?= number_format($data["payment_jo_nominal"],0,',','.')?></td>
                            </tr>
                            <tr>
                                <td width="30%">Terbilang</td>
                                <td width="5%">:</td>
                                <td><?= generate_terbilang($data["payment_jo_nominal"])?> Rupiah</td>
                            </tr>
                            <tr>
                                <td width="30%">Keterangan</td>
                                <td width="5%">:</td>
                                <td><?= $data["keterangan"]?></td>
                            </tr>
                            <tr>
                                <td colspan=3><hr></td>
                            </tr>
                        </tbody>
                    </table>
                    <table width="100%">
                        <tbody>
                            <tr class="text-center">
                                <td width="30%">Yang Membuat</td>
                                <td width="30%">Yang Menyerahkan,</td>
                                <td width="30%" >Yang Menerima</td>
                            </tr>
                            <tr class="text-center" style="height:200px">
                                <td width="30%">(---------------)</td>
                                <td width="30%">(---------------)</td>
                                <td width="30%" >(---------------)</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
</body>
<script>
    window.print();
    window.location.replace("<?= base_url('index.php/payment/payment_jo/').$jo_id?>");
</script>
</html>