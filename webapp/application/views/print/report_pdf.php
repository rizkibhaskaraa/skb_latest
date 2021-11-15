<?php
    function change_tanggal($data){
        $data_tanggal = explode('-', $data);
        $tanggal = $data_tanggal[2].'-'.$data_tanggal[1].'-'.$data_tanggal[0];
        return $tanggal;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sumber Karya Berkah</title>
    <!-- Custom styles for this template-->
    <style>
        table,th,td{
            border: 1px solid black;
            text-align:center;
        }
        .judul{
            text-align:center;
            font-size:24px;
        }
        .tanggal{
            font-size:18px;
        }
    </style>
</head>
<body>
    <div class="judul">
        <span>Data Laporan Job Order</span>
        <hr>
    </div>
    <div class="tanggal">
        <span>Tanggal : <?=$tanggal?></span>
    </div>
    <div>
                <table  id="" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center" width="12,5%"  scope="col">No JO</th>
                            <th class="text-center" width="12,5%" scope="col">Customer</th>
                            <th class="text-center" width="30%" scope="col">Rute</th>
                            <th class="text-center" width="12,5%" scope="col">Tgl Muat</th>
                            <th class="text-center" width="12,5%" scope="col">Tgl Bongkar</th>
                            <th class="text-center" width="12,5%"  scope="col">Uang Jalan</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($jo as $value){ ?>
                        <tr>
                            <td ><?= $value["Jo_id"]?></td>
                            <?php $n=0; 
                            for($i=0;$i<count($paketan);$i++){
                                    if($paketan[$i]["paketan_id"] == $value["paketan_id"]){
                                        $data_paketan = json_decode($paketan[$i]["paketan_data_rute"],true);
                                        $n++?>
                                        <td>
                                        <?php for($j=0;$j<count($data_paketan);$j++){
                                            if($data_paketan[$j]["customer"]!="-"){
                                             echo $data_paketan[$j]["customer"]." - ";
                                            }
                                        }?>
                                         (Paketan)
                                        </td>
                                        <td>
                                        <?php for($j=0;$j<count($data_paketan);$j++){?>
                                            <?= $data_paketan[$j]["dari"]."-".$data_paketan[$j]["ke"]." (".$data_paketan[$j]["muatan"].")<br>"?>
                                        <?php }?>
                                        </td>    
                                <?php }
                            }?>
                            <?php 
                            for($i=0;$i<count($kosongan);$i++){
                                    if($kosongan[$i]["kosongan_id"] == $value["kosongan_id"]){
                                        $n++?>
                                        <td ><?= $value["customer_name"]?> (Reguler)</td>
                                        <td>
                                            <?= $kosongan[$i]["kosongan_dari"]."-".$kosongan[$i]["kosongan_ke"]." ("?>kosongan)<br>
                                            <?= $value["asal"]."-".$value["tujuan"]." (".$value["muatan"]?>)<br>
                                        </td>    
                                <?php }
                            }?>
                            <?php if($n==0){?>
                                <td ><?= $value["customer_name"]?> (Reguler)</td>
                                <td><?= $value["asal"]."-".$value["tujuan"]." (".$value["muatan"]?>)</td>
                            <?php }?>
                            <td ><?= change_tanggal($value["tanggal_surat"])?></td>
                            <td ><?= change_tanggal($value["tanggal_bongkar"])?></td>
                            <td >Rp.<?= number_format($value["uang_jalan_bayar"],2,",",".")?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
    </div>
</body>
</html>