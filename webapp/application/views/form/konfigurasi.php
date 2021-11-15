<body style='background-color:#182039';> 
<div class=" p-5 mt-5 text-light" style='background-color:#182039';>
    <div class="container mb-4 text-center" >
        <h1 class="h3 mb-0 text-light">Konfigurasi Hak Akses</h1>
    </div> 
    <div class="card shadow mb-4 col-auto " style='background-color:#212B4E';>
        <div class="card-body text-light">
            <div class="table-responsive" >
                <table cellspacing="0">
                    <tbody>
                        <tr>
                            <td class="" width="20%">Nama Akun</td>
                            <td width="5%">:</td>
                            <td ><?=$akun["akun_name"]?></td>
                        </tr>
                        <tr>
                            <td class="" width="20%">Role Akun</td>
                            <td width="5%">:</td>
                            <td><?=$akun["akun_role"]?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card-footer " style='background-color:#212B4E';>
        <div class="" style='background-color:#212B4E';>
            <form action="<?= base_url("index.php/form/update_konfigurasi/".$akun["akun_id"])?>" method="POST">
                <?php
                $urut = [0,14,1,20,2,3,4,18,6,9,19,13,5,10,11,15,16,17,7,8,12];
                $page = ["Master Data","Data Job Order","Ubah Status Job Order","Buat Invoice","Data Invoice",
                "Data Nota Kasbon","Buat Slip Gaji","Laporan Job Order","Laporan Uang Jalan","Data Slip Supir",
                "Mutasi Kasbon","Konfigurasi Akun","Saldo Kasbon","Buat Nota Kasbon","Buat Job Order","DB Izin","DB Operasional","DB Invoice"
                ,"Payment Invoice","Payment Gaji","Payment JO"];?>
                <div class="row" >
                    <div class="col-md-6" >
                        <table cellspacing="0">
                            <tbody>
                                <?php for($j=0;$j<count($urut);$j++){
                                    for($i=0;$i<21;$i++){
                                        if($i==7 || $i==8 || $i==12 ){
                                            continue;
                                        }else{
                                        if($urut[$j]==$i){
                                        ?>
                                        <tr>
                                            <input type="text" class="cekpage<?= $i+1?>" name="cekpage<?= $i+1?>" hidden value="<?= json_decode($akun["akses"])[$i] ?>">
                                            <td width="50%"><?= $page[$i]?></td>
                                            <td width="5%">:</td>
                                            <td ><input class="isicekpage<?= $i+1?>" value="<?= json_decode($akun["akses"])[$i] ?>" 
                                            <?php
                                                if(json_decode($akun["akses"])[$i]==1){
                                                    echo 'checked';
                                                }
                                            ?>
                                            data-toggle="toggle" type="checkbox" data-size="medium" data-onstyle="success" data-offstyle="danger" onchange="togglenih('cekpage<?= $i+1?>','isicekpage<?= $i+1?>')"></td>
                                        </tr>
                                <?php break;}}}}?>
                            </tbody>
                        </table>
                    </div>
                    <!-- <div class="col-md-6">
                        <table cellspacing="0">
                            <tbody>
                                <?php for($j=0;$j<count($urut);$j++){
                                    for($i=12;$i<21;$i++){
                                        if($j==$i){?>
                                    <tr>
                                        <input type="text" class="cekpage<?= $i+1?>" name="cekpage<?= $i+1?>" hidden value="<?= json_decode($akun["akses"])[$i] ?>">
                                        <td width="50%"><?= $page[$i]?></td>
                                        <td width="5%">:</td>
                                        <td ><input class="isicekpage<?= $i+1?>" value="<?= json_decode($akun["akses"])[$i] ?>" 
                                        <?php
                                            if(json_decode($akun["akses"])[$i]==1){
                                                echo 'checked';
                                            }
                                        ?>
                                        data-toggle="toggle" type="checkbox" data-size="medium" data-onstyle="success" data-offstyle="danger" onchange="togglenih('cekpage<?= $i+1?>','isicekpage<?= $i+1?>')"></td>
                                    </tr>
                                <?php }}}?>
                            </tbody>
                        </table>
                    </div> -->
                </div>
                <div class="mt-5" >
                    <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                    <a href="<?= base_url("index.php/home/akun")?>" class="btn btn-danger" >Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

                                        </body>
<script>
            function togglenih(cek,isicek){
            var hak_akses = $("."+isicek).val();
            // alert(hak_akses);
            if(hak_akses==1){
            $("."+cek).val(0);
            $("."+isicek).val(0);
            }else{
            $("."+cek).val(1);
            $("."+isicek).val(1);
            }
            }
            function reset_konfigurasi(){
            location.reload();
}
</script>
