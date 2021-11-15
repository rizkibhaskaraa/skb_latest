<body class="mt-5"  style='background-color:#182039';> 

<div class="container mt-5 " style='background-color:#182039'; >
        <!-- Card Formulir JO -->
        <div class="card-header text-light" style='background-color:#212B4E';>
                <h5 class="font-weight-bold m-4 ">Form Buat Job Order</h5>
            </div>
        <div class="container card shadow mt-3 mb-4" style='background-color:#212B4E';>
            
            <div class="card-body text-light">
                <!-- form Job Order Baru -->
                <!-- <small>Pilih Rute Yang Tersedia Pada Tabel Rute Dibawah</small> -->
                <form action="<?=base_url("index.php/form/insert_JO")?>" method="POST" class="row">
                    <div class="col-md-12 mb-4 row">
                        <label for="Jo_id" class="form-label font-weight-bold col-md-5">ID Job Order(JO)</label>
                        <input autocomplete="off" type="text" class="form-control col-md-7" id="Jo_id" name="Jo_id" required value="<?= $new_jo_id?>" readonly>
                    </div>
                    <div class="col-md-12 mb-4 row">
                        <label for="tanggal_jo" class="form-label font-weight-bold col-md-5">Tanggal</label>
                        <input autocomplete="off" type="text" class="form-control col-md-7" id="tanggal_jo" name="tanggal_jo" required readonly value="<?= date('d-m-Y')?>">
                    </div>
                    <div class="col-md-12 mb-4 row">
                        <label class="form-label font-weight-bold col-md-5" for="Supir">Driver</label>
                        <select name="Supir" id="Supir" class="form-control col-md-7 selectpicker" data-live-search="true" required>
                            <option class="font-w700" disabled="disabled" selected value="">Supir Pengiriman</option>
                            <?php foreach($supir as $value){?>
                                    <option value="<?=$value["supir_id"]?>"><?=$value["supir_name"]." (".$value["supir_panggilan"].")"?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="col-md-12 mb-4 row">
                        <label class="form-label font-weight-bold col-md-5 " for="Kendaraan">No. Polisi</label>
                        <select name="Kendaraan" id="Kendaraan" class="form-control col-md-7" required onchange="set_jenis_mobil(this)">
                            <option class="font-w700 font-weight-bold" disabled="disabled" selected value="">Kendaraan Pengiriman</option>
                            <?php foreach($mobil as $value){
                                if($value["mobil_dump"]=="Ya"){?>
                                    <option value="<?=$value["mobil_no"]?>"><?=$value["mobil_no"]." (".$value["mobil_jenis"].") (Dump)"?></option>
                                <?php }else{?>
                                    <option value="<?=$value["mobil_no"]?>"><?=$value["mobil_no"]." (".$value["mobil_jenis"].") (No Dump)"?></option>
                            <?php }
                            }?>
                        </select>
                    </div>
                    <div class="col-md-12 mb-4 row">
                        <label class="form-label font-weight-bold col-md-5" for="Jenis">Jenis Mobil</label>
                        <input autocomplete="off" type="text" class="form-control col-md-7" name="Jenis" id="Jenis" required readonly>
                    </div>
                    <div class="col-md-12 mb-4 row">
                        <label class="form-label font-weight-bold col-md-5 " for="Customer">Customer</label>
                        <select name="Customer" value="DESC" id="Customer" class="form-control col-md-7" required onchange="set_muatan(this)">
                            <option class="font-w700" disabled="disabled" selected value="">Customer</option>
                        </select>
                    </div>
                    <div class="col-md-12 mb-4 row">
                        <label for="Muatan" class="form-label font-weight-bold col-md-5 ">Muatan</label> 
                        <select name="Muatan" id="Muatan" class="form-control col-md-7" onchange="set_asal(this)"  required>
                            <option class="font-w700" disabled="disabled" selected value="">Muatan</option>
                        </select>
                    </div>
                    <div class="col-md-12 mb-4 row mb-4">
                        <label class="form-label font-weight-bold col-md-5" for="Asal ">Dari</label>
                        <select name="Asal" id="Asal" class="form-control col-md-7" onchange="set_tujuan(this)" required>
                            <option class="font-w700" disabled="disabled" selected value="">Asal</option>
                        </select>
                    </div>
                    <div class="col-md-12 mb-4 row mb-4">
                        <label class="form-label font-weight-bold col-md-5" for="Tujuan">Ke</label>
                        <select name="Tujuan" id="Tujuan" class="form-control col-md-7" onchange="set_uj(this)" required>
                            <option class="font-w700" disabled="disabled" selected value="">Tujuan</option>
                        </select>
                    </div>
                    <!-- <div class="col-md-4 col-md-offset-4 mb-4">
                        <label class="form-label font-weight-bold col-md-5" for="Type_Tonase">Tipe Tonase</label>
                        <input autocomplete="off" type="text" class="form-control col-md-7" name="Type_Tonase" id="Type_Tonase" required readonly>
                    </div>
                    <div class="col-md-4 col-md-offset-4 mb-4 Tonase">
                        <label class="form-label font-weight-bold col-md-5" for="Tonase">Tonase</label>
                        <input autocomplete="off" type="text" class="form-control col-md-7" name="Tonase" id="Tonase" required readonly>
                    </div> -->
                        <input autocomplete="off" type="text" class="form-control col-md-7" id="Tipe_Tonase" name="Tipe_Tonase" value=0 required readonly hidden>
                    <div class="col-md-12 mb-4 row">
                        <label for="Uang" class="form-label font-weight-bold col-md-5">Uang Jalan</label>
                        <input autocomplete="off" type="text" class="form-control col-md-7" id="Uang" name="Uang" value=0 required readonly>
                    </div>
                    <div class="col-md-12 mb-4 row">
                        <label class="form-label font-weight-bold col-md-5" for="jenis_tambahan">Tambahan/Potongan UJ</label>
                        <select name="jenis_tambahan" id="jenis_tambahan" class="form-control col-md-7" onchange="tambahan(this)">
                            <option class="font-w700" disabled="disabled" selected value="">Tambahan/Potongan UJ</option>
                            <option class="font-w700" value="Tidak Ada">Tidak Ada</option>
                            <option class="font-w700" value="Tambahan">Tambahan</option>
                            <option class="font-w700" value="Potongan">Potongan</option>
                        </select>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div style="display:none" id="nominal_tambahan_id" class="row">
                            <label for="nominal_tambahan" class="form-label font-weight-bold col-md-5">Nominal Tambahan/Potongan UJ</label>
                            <input autocomplete="off" type="text" class="form-control col-md-7" id="nominal_tambahan" name="nominal_tambahan" onkeyup="set_uj_tambahan(this),uang_format(this)">
                        </div>
                    </div>
                    <div class="col-md-12 mb-4 row">
                        <label for="uang_jalan_total" class="form-label font-weight-bold col-md-5">Total Uang Jalan</label>
                        <input autocomplete="off" type="text" class="form-control col-md-7" id="uang_jalan_total" name="uang_jalan_total" value=0 readonly>
                    </div>
                    <div class="col-md-12 mb-4 row">
                        <label for="Keterangan" class="form-label font-weight-bold col-md-5">Keterangan/Catatan</label>
                        <textarea class="form-control col-md-7" name="Keterangan" id="Keterangan" rows="3"></textarea>
                    </div>
                    <input autocomplete="off" type="text" class="form-control col-md-7" id="Upah" name="Upah" required hidden>
                    <input autocomplete="off" type="text" class="form-control col-md-7" id="Tagihan" name="Tagihan" required hidden>
                    <div class="col-md-12 ">
                        <button type="submit" class="btn btn-success float-right  mr-3">Simpan</button>
                        <button type="reset" class="btn btn-outline-danger float-right mr-2" onclick="reset_form()">Reset</button>
                    </div>
                </form>
                <!-- end form Job Order Baru -->
            </div>
        </div>
    </div>
                        </body>



    <script>
    function reset_form(){
        location.reload();
    }
    function uang_format(a){
        $( '#'+a.id ).mask('000.000.000', {reverse: true});
    }
    function set_uj_tambahan(){
        var uj = $("#Uang").val().replaceAll(".","");
        var uj_tambahan = $("#nominal_tambahan").val().replaceAll(".","");
        if(uj_tambahan==""){
            uj_tambahan = 0;
        }
        if($("#jenis_tambahan").val()=="Potongan"){
            if(parseInt(uj)<parseInt(uj_tambahan)){
                Swal.fire({
                    title: "Peringatan",
                    icon: "error",
                    text: "Potongan Tidak boleh Lebih Dari Rp."+rupiah(uj),
                    type: "error"
                });
                $("#nominal_tambahan").val("");
                $( '#uang_jalan_total' ).val(rupiah(uj));
            }else{
                $( '#uang_jalan_total' ).val(rupiah(parseInt(uj)-parseInt(uj_tambahan)));
            }
        }else if($("#jenis_tambahan").val()=="Tambahan"){
            $( '#uang_jalan_total' ).val(rupiah(parseInt(uj)+parseInt(uj_tambahan)));
        }else{
            $("#nominal_tambahan").val(0);
            $( '#uang_jalan_total' ).val(rupiah(parseInt(uj)));
        }
    }
    function tambahan(a){
        var uj = $("#Uang").val().replaceAll(".","");
        var uj_tambahan = $("#nominal_tambahan").val().replaceAll(".","");
        if(uj_tambahan==""){
            uj_tambahan = 0;
        }
        if($("#"+a.id).val()!="Tidak Ada"){
            $("#nominal_tambahan_id").show();  
        }else{
            $("#nominal_tambahan_id").hide();
        }

        if($("#"+a.id).val()=="Potongan"){
            if(parseInt(uj)<parseInt(uj_tambahan)){
                Swal.fire({
                    title: "Peringatan",
                    icon: "error",
                    text: "Potongan Tidak boleh Lebih Dari Rp."+rupiah(uj),
                    type: "error"
                });
                $("#nominal_tambahan").val("");
                $( '#uang_jalan_total' ).val(rupiah(uj));
            }else{
                $( '#uang_jalan_total' ).val(rupiah(parseInt(uj)-parseInt(uj_tambahan)));
            }
        }else{
            $( '#uang_jalan_total' ).val(rupiah(parseInt(uj)+parseInt(uj_tambahan)));
        }
    }
    function set_jenis_mobil(a){
        $('#Muatan').find('option').remove().end();
        $('#Asal').find('option').remove().end();
        $('#Tujuan').find('option').remove().end();
        $('#Customer').find('option').remove().end();
        $("#Uang").val("");
        $("#Upah").val("");
        $("#Tagihan").val("");
        $("#Tipe_Tonase").val("");
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('index.php/form/getmobilbyno') ?>",
            dataType: "JSON",
            data: {
                mobil_no: $("#"+a.id).val(),
            },
            success: function(data) {
                $("#Jenis").val(data["mobil_jenis"]);
            }
        });
        $('#Customer').append('<option class="font-w700" disabled="disabled" selected value="">Customer</option>'); 
        <?php for($i=0;$i<count($customer);$i++){?>
            $('#Customer').append('<option value="'+'<?= $customer[$i]["customer_id"]?>'+'">'+'<?= $customer[$i]["customer_name"]?>'+'</option>'); 
        <?php }?>
    }
    function set_muatan(a){
        customer_id = $("#"+a.id).val();
        mobil_no = $("#Jenis").val();
        $('#Muatan').find('option').remove().end();
        $('#Asal').find('option').remove().end();
        $('#Tujuan').find('option').remove().end();
        $("#Uang").val("");
        $("#Upah").val("");
        $("#Tagihan").val("");
        $("#Tipe_Tonase").val("");
        isi_muatan = [];
        $.ajax({ //ajax set option kendaraan
            type: "POST",
            url: "<?php echo base_url('index.php/form/getrutebycustomer/') ?>",
            dataType: "JSON",
            data: {
                customer_id: customer_id,
                mobil_no: mobil_no,
            },
            success: function(data) {
                if(data.length==0){
                    $('#Muatan').append('<option class="font-w700" disabled="disabled" selected value="">Kosong</option>'); 
                }else{
                    $('#Muatan').append('<option class="font-w700" disabled="disabled" selected value="">Muatan</option>'); 
                    for(i=0;i<data.length;i++){
                        if(!isi_muatan.includes(data[i]["rute_muatan"])){
                            $('#Muatan').append('<option value="'+data[i]["rute_muatan"]+'">'+data[i]["rute_muatan"]+'</option>'); 
                            isi_muatan.push(data[i]["rute_muatan"]);
                        }
                    }
                }
            }
        });
    }
    function set_asal(a){
        customer_id = $("#Customer").val();
        mobil_no = $("#Jenis").val();
        muatan = $("#"+a.id).val();
        $('#Asal').find('option').remove().end();
        $('#Tujuan').find('option').remove().end();
        $("#Uang").val("");
        $("#Upah").val("");
        $("#Tagihan").val("");
        $("#Tipe_Tonase").val("");
        isi_asal = [];
        $.ajax({ //ajax set option kendaraan
            type: "POST",
            url: "<?php echo base_url('index.php/form/getrutebymuatan') ?>",
            dataType: "JSON",
            data: {
                customer_id: customer_id,
                mobil_no: mobil_no,
                rute_muatan: muatan,
            },
            success: function(data) {
                if(data.length==0){
                    $('#Asal').append('<option class="font-w700" disabled="disabled" selected value="">Kosong</option>'); 
                }else{
                    $('#Asal').append('<option class="font-w700" disabled="disabled" selected value="">Asal</option>'); 
                    for(i=0;i<data.length;i++){
                        if(!isi_asal.includes(data[i]["rute_dari"])){
                            $('#Asal').append('<option value="'+data[i]["rute_dari"]+'">'+data[i]["rute_dari"]+'</option>'); 
                            isi_asal.push(data[i]["rute_dari"]);
                        }
                    }
                }
            }
        });
    }
    function set_tujuan(a){
        customer_id = $("#Customer").val();
        muatan = $("#Muatan").val();
        asal = $("#"+a.id).val();
        mobil_no = $("#Jenis").val();
        $('#Tujuan').find('option').remove().end();
        $("#Uang").val("");
        $("#Upah").val("");
        $("#Tagihan").val("");
        $("#Tipe_Tonase").val("");
        isi_tujuan = [];
        $.ajax({ //ajax set option kendaraan
            type: "POST",
            url: "<?php echo base_url('index.php/form/getrutebyasal') ?>",
            dataType: "JSON",
            data: {
                customer_id: customer_id,
                rute_muatan: muatan,
                rute_asal: asal,
                mobil_no: mobil_no,
            },
            success: function(data) {
                if(data.length==0){
                    $('#Tujuan').append('<option class="font-w700" disabled="disabled" selected value="">Kosong</option>'); 
                }else{
                    $('#Tujuan').append('<option class="font-w700" disabled="disabled" selected value="">Tujuan</option>'); 
                    for(i=0;i<data.length;i++){
                        if(!isi_tujuan.includes(data[i]["rute_dari"])){
                            $('#Tujuan').append('<option value="'+data[i]["rute_ke"]+'">'+data[i]["rute_ke"]+'</option>'); 
                            isi_tujuan.push(data[i]["rute_ke"]);
                        }
                    }
                }
            }
        });
    }
    function set_uj(a){
        customer_id = $("#Customer").val();
        muatan = $("#Muatan").val();
        asal = $("#Asal").val();
        ke = $("#"+a.id).val();
        mobil_no = $("#Jenis").val();
        $.ajax({ //ajax set option kendaraan
            type: "POST",
            url: "<?php echo base_url('index.php/form/getrutefix') ?>",
            dataType: "JSON",
            data: {
                customer_id: customer_id,
                rute_muatan: muatan,
                rute_asal: asal,
                rute_ke: ke,
                mobil_no: mobil_no,
            },
            success: function(data) {
                if($("#jenis_tambahan").val()=="Potongan"){
                    total = rupiah( parseInt(data["rute_uj_engkel"])-parseInt($("#uang_jalan_total").val().replaceAll(".","")) ) ;
                }else if($("#jenis_tambahan").val()=="Tambahan"){
                    total = rupiah( parseInt(data["rute_uj_engkel"])+parseInt($("#uang_jalan_total").val().replaceAll(".","")) ) ;
                }else{
                    total = rupiah( parseInt(data["rute_uj_engkel"])) ;
                }
                $( '#uang_jalan_total' ).val(total);
                $("#Tipe_Tonase").val(data["ritase"]);
                $("#Uang").val(rupiah(data["rute_uj_engkel"]));
                $("#Upah").val(rupiah(data["rute_gaji_engkel"]));
                $("#Tagihan").val(rupiah(data["rute_tagihan"]));
            }
        });
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