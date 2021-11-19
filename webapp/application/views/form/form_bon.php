<body style='background-color:#182039';> 

<!-- Basic Card Example -->
<div class="mt-5 p-4" style='background-color:#182039';></div>
    <div class="card shadow " style='background-color:#212B4E';> 
        <div class="card-header " style='background-color:#212B4E';>
            <h6 class="m-0 font-weight-bold text-light">Buat Transaksi BON</h6>
        </div>
        <div class="card-body p-2 text-light mt-5 ">
            <!-- form transaksi bon -->
            <div class="container">
                <form action="<?=base_url("index.php/form/insert_bon")?>" method="POST" class="row">
                    <div class="col-md-4 col-md-offset-4 mb-4">
                        <label for="Tanggal" class="form-label font-weight-bold">Tanggal</label>
                        <input autocomplete="off" type="text" class="form-control" id="Tanggal" name="Tanggal" required value="<?= date('d-m-Y')?>">
                    </div>
                    <div class="col-md-4 col-md-offset-4 mb-4">
                        <label for="" class="form-label font-weight-bold">No. Nota Kasbon</label>
                        <input autocomplete="off" type="text" class="form-control" id="bon_id" name="bon_id" required readonly value="<?= $bon_id_new?>">
                    </div>
                    <div class="col-md-4 col-md-offset-4 mb-4">
                        <label class="form-label font-weight-bold" for="Supir_bon">Supir</label>
                        <select name="Supir_bon" id="Supir_bon" class="form-control selectpicker" data-live-search="true" required onchange="bon_user()">
                            <option class="font-w700" disabled="disabled" selected value="">Supir Pengiriman</option>
                            <?php foreach($supir as $value){ ?>
                                <option value="<?=$value["supir_id"]?>"><?=$value["supir_name"]." (".$value["supir_panggilan"].")"?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-4 col-md-offset-4 mb-4">
                    <label for="" class="form-label font-weight-bold">Bon Hutang Saat Ini</label>
                        <input autocomplete="off" type="text" class="form-control" id="bon-saat-ini-tampilan" name="" disabled>
                        <input autocomplete="off" type="text" class="form-control" id="bon-saat-ini" name="" required hidden>
                    </div>
                    <div class="col-md-4 col-md-offset-4 mb-4">
                    <label class="form-label font-weight-bold" for="Jenis">Jenis Transaksi</label>
                        <select name="Jenis" id="Jenis" class="form-control custom-select" required onchange="nominal()">
                            <option class="font-w700" disabled="disabled" selected value="">Jenis Transaksi</option>
                            <option value="Pembayaran">Pembayaran</option>
                            <option value="Pengajuan">Pengajuan</option>
                        </select>
                    </div>
                    <div class="col-md-4 col-md-offset-4 mb-4">
                        <label for="Nominal" class="form-label font-weight-bold">Nominal</label>
                        <input autocomplete="off" type="text" class="form-control" id="Nominal" name="Nominal" required onkeyup="nominal()">
                    </div>
                    <div class="col-md-4 mb-4 ">
                        <label for="Keterangan" class="form-label font-weight-bold">Keterangan/Catatan</label>
                        <textarea class="form-control" name="Keterangan" id="Keterangan" rows="3"></textarea>
                    </div>
                    <div class="col-md-12 col-md-offset-4 mt-5 ">
                        <button type="submit" class="btn btn-success mb-3 ml-3 float-right">Simpan</button>    
                        <button type="reset" class="btn btn-outline-danger mb-3 float-right">Reset</button> 
                    </div>
                </form>
            </div>
            <!-- end form transaksi bon -->
        </div>
    </div>
</div>
    
                            </body>




<script>
    function nominal(){
        if($("#Nominal").val()[0]=="0"){
            var string_now = $("#Nominal").val().replace("0","");
            $("#Nominal").val(string_now);
        }
        $( '#Nominal' ).mask('000.000.000', {reverse: true})
        uang = $( '#Nominal' ).val().split('.');
        uang_fix = ""
        for(i=0;i<uang.length;i++){
            uang_fix = uang_fix+uang[i];
        }
        // alert(uang_fix);
        if($("#Jenis").val()=='Pembayaran'){
            if(parseInt(uang_fix)>parseInt($("#bon-saat-ini").val())){
                Swal.fire({
                    title: "Peringatan",
                    icon: "error",
                    text: 'Jumlah Pembayaran Harus Lebih Kecil Dari Rp.'+ rupiah($("#bon-saat-ini").val()),
                    type: "error"
                });
                $( '#Nominal' ).val("");
            }
        }
    }
    function bon_user(){
        $.ajax({
            type: "GET",
            url: "<?php echo base_url('index.php/form/getbonsupir') ?>",
            dataType: "text",
            data:{
                id:$("#Supir_bon").val()
            },
            success: function(data) {
                $("#bon-saat-ini-tampilan").attr('placeholder','Rp.'+rupiah(data));
                $("#bon-saat-ini").val(data);
                nominal();
            }
        });
    }
</script>