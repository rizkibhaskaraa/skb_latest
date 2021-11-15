<!-- Basic Card Example -->
<div class="card shadow mb-4 ml-5 mr-5 py-2 px-2">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Cek Saldo Kasbon Driver</h6>
        </div>
        <div class="card-body">
            <div class="container w-50">
                <select name="Supir" id="Supir" class="form-control selectpicker" data-live-search="true" required onchange="hasil_saldo(this)">
                    <option class="font-w700" disabled="disabled" selected value="">Pilih Supir</option>
                    <?php foreach($supir as $value){ ?>
                        <option value="<?=$value["supir_id"]?>"><?=$value["supir_name"]?></option>
                    <?php } ?>
                </select>
            </div>
            <hr>
            <div class="container w-50 ml-0">
                <div class="row">
                    <div class="col-md-4"><strong>Nama Supir</strong></div>
                    <div class="col-md-1">:</div>
                    <div class="col-md-7 border border-dark rounded"><span id="nama"></span></div>
                </div>
                <div class="row">
                    <div class="col-md-4"><strong>Time</strong></div>
                    <div class="col-md-1">:</div>
                    <div class="col-md-7 border border-dark rounded"><span id="time"></span></div>
                </div>
                <div class="row">
                    <div class="col-md-4"><strong>Saldo</strong></div>
                    <div class="col-md-1">:</div>
                    <div class="col-md-7 border border-dark rounded"><span id="saldo"></span></div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function hasil_saldo(a){
            id=$("#"+a.id).val();
            $.ajax({
                type: "GET",
                url: "<?php echo base_url('index.php/detail/getbonsupir') ?>",
                dataType: "JSON",
                data: {
                    id: id
                },
                success: function(data) {
                    saldo=0;
                    if(data.length==0){
                        alert("Tidak Ada Data Kasbon");
                        $("#nama").text("");
                        $("#time").text("");
                        $("#saldo").text("");
                    }else{
                        $("#nama").text(data[0]["supir_name"]);
                        $("#time").text(change_tanggal(data[0]["bon_tanggal"]));
                        for(i=0;i<data.length;i++){
                            if(data[i]["status_hapus"]=="NO"){
                                if(data[i]["bon_jenis"]=="Pembayaran" || data[i]["bon_jenis"]=="Potong Gaji"){
                                    saldo-=parseInt(data[i]["bon_nominal"]);
                                }else{
                                    saldo+=parseInt(data[i]["bon_nominal"]);
                                }
                            }
                        }
                        $("#saldo").text("Rp."+rupiah(saldo));
                    }

                }
            });
        }
    </script>
    <script>
        function change_tanggal(data){
            if(data==""){
                return "";
            }else{
                var data_tanggal = data.split("-");
                var tanggal = data_tanggal[2]+"-"+data_tanggal[1]+"-"+data_tanggal[0];
                return tanggal;
            }
        }
    </script>
    <!-- scrip angka rupiah -->
    <script>
            function rupiah(uang){
            var bilangan = uang;
            var	number_string = bilangan.toString(),
                sisa 	= number_string.length % 3,
                rupiah 	= number_string.substr(0, sisa),
                ribuan 	= number_string.substr(sisa).match(/\d{3}/g);
                    
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            // alert(rupiah);
            return rupiah;
        }
    </script>
    <!-- end script angka rupiah -->
    