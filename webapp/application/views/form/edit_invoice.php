<?php
    function change_tanggal($tanggal){
        if($tanggal==""){
            return "";
        }else{
            $tanggal_array = explode("-",$tanggal);
            return $tanggal_array[2]."-".$tanggal_array[1]."-".$tanggal_array[0];   
        }
    }
    $jo = "";
    for($i=0;$i<count($invoice);$i++){
        $jo .= $invoice[$i]["Jo_id"].",";
    }
?>
<body class=" p-5 mt-5" style='background-color:#182039';> 
<div class="container-fluid"style='background-color:#182039'; >
    <!-- form invoice -->
    <div class="card shadow " style='background-color:#212B4E';>
        <div class="card-header " style='background-color:#212B4E';>
            <h6 class="m-0 font-weight-bold text-light">Buat Invoice</h6>
        </div>
        <div class="card-body text-light">
        <form action="<?=base_url("index.php/form/update_invoice")?>" method="POST" id="form-edit-invoice">
            <div class="row">
                <div class="col-md-6 ">
                    <div class="form-group">
                        <label for="invoice_tgl_edit" class="form-label font-weight-bold">Tgl.Invoice</label>
                        <input autocomplete="off" type="text" class="form-control col-md-10" id="invoice_tgl_edit" name="invoice_tgl_edit" required value="<?= change_tanggal($invoice[0]["tanggal_invoice"])?>" onclick="tanggal_berlaku(this)">
                    </div>          
                    <div class="form-group">
                        <label for="invoice_id" class="form-label font-weight-bold">Invoice Kode</label>
                        <input autocomplete="off" type="text" class="form-control col-md-10" id="invoice_id" name="invoice_id" required value="<?= $invoice[0]["invoice_kode"]?>" readonly>
                    </div>
                    <div class="form-group">
                        <label class="form-label font-weight-bold mr-3" for="customer_id">Customer</label>
                        <input autocomplete="off" type="text" class="form-control col-md-10" id="customer_id" name="customer_id" required value="<?= $customer["customer_id"]?>" hidden>
                        <input autocomplete="off" type="text" class="form-control col-md-10" id="customer_name" name="customer_name"  value="<?= $customer["customer_name"]?>" readonly>
                    </div>
                    <div class="form-group">
                        <label class="form-label font-weight-bold" for="invoice_ppn">PPN</label>
                        <select name="invoice_ppn" id="invoice_ppn" class="form-control col-md-10" required>
                            <?php if($invoice[0]["ppn"]==0){?>
                                <option class="font-w700" value="Ya">Ya</option>
                                <option class="font-w700" selected value="Tidak">Tidak</option>
                            <?php }else{?>
                                <option class="font-w700" selected value="Ya">Ya</option>
                                <option class="font-w700" value="Tidak">Tidak</option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label font-weight-bold " for="invoice_payment">Payment (hari)</label>
                        <input autocomplete="off" type="text" class="form-control col-md-10" id="invoice_payment" name="invoice_payment" required onkeyup="hanyaangka(this)" value="<?= $invoice[0]["batas_pembayaran"]?>">
                    </div>          
                </div>
                <div class="col-md-6 ">
                    <div class="form-group row mt-3">
                        <label for="invoice_tonase" class="col-form-label col-sm-5 font-weight-bold">Total Tonase</label>
                        <div class="col-sm-7">
                            <input autocomplete="off" type="text" class="form-control" id="invoice_tonase" name="invoice_tonase" required readonly value="<?= $invoice[0]["total_tonase"]?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="invoice_total" class="col-form-label col-sm-5 font-weight-bold">Total</label>
                        <div class="col-sm-7">
                            <input autocomplete="off" type="text" class="form-control" id="invoice_total" name="invoice_total" required readonly value="<?= number_format($invoice[0]["total"],2,',','.')?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="invoice_ppn" class="col-form-label col-sm-5 font-weight-bold">PPN</label>
                        <div class="col-sm-7">
                            <input autocomplete="off" type="text" class="form-control" id="invoice_ppn_nilai" name="invoice_ppn_nilai" required readonly value="<?= number_format($invoice[0]["ppn"],2,',','.')?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="invoice_grand_total" class="col-form-label col-sm-5 font-weight-bold">Grand Total</label>
                        <div class="col-sm-7">
                            <input autocomplete="off" type="text" class="form-control" id="invoice_grand_total" name="invoice_grand_total" required readonly value="<?= number_format($invoice[0]["grand_total"],2,',','.')?>">
                        </div>
                    </div>
                    <input type="text" id="data_jo" name="data_jo" required value="<?= $jo?>" hidden>
                    <div class="form-group mt-3">
                        <label for="invoice_keterangan" class="form-label font-weight-bold">Keterangan</label>
                        <textarea class="form-control" name="invoice_keterangan" id="invoice_keterangan" rows="3"><?= $invoice[0]["invoice_keterangan"]?></textarea>
                    </div>
                </div>
            </div>
            <div class="row float-right mb-5">
                
                <button type="reset" class="btn btn-danger mr-3" onclick="reset_form()">Reset</button>
                <button type="submit" class="btn btn-success mr-3">Simpan</button>
            </div>
        </form>
        <!-- table invoice -->
        <div class="container-fluid card shadow mt-3 mb-3 small" style='background-color:#212B4E';>
            <div class="card-body">
                <div class="row float-left ml-1" >
                    <h6 class="font-weight-bolder">Data JO Dalam Invoice Saat Ini</h6>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered  text-light" id="pilih-jo-saat-ini" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center" width="" scope="col">ID JO</th>
                                <th class="text-center" width="" scope="col">Tgl.Muat</th>
                                <th class="text-center" width="" scope="col">Tgl.Plng</th>
                                <th class="text-center" width="" scope="col">Nopol</th>
                                <th class="text-center" width="" scope="col">Muatan</th>
                                <th class="text-center" width="" scope="col">Dari</th>
                                <th class="text-center" width="" scope="col">Ke</th>
                                <th class="text-center" width="" scope="col">Tonase</th>
                                <th class="text-center" width="" scope="col">Harga</th>
                                <th class="text-center" width="" scope="col">Total</th>
                                <th class="text-center" width="" scope="col">Pilih</th>
                                <th class="text-center" width="" scope="col">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($invoice as $value){?>
                                <tr>
                                    <td class="text-center"><?= $value["Jo_id"]?></td>
                                    <td class="text-center"><?= change_tanggal($value["tanggal_muat"])?></td>
                                    <td class="text-center"><?= change_tanggal($value["tanggal_bongkar"])?></td>
                                    <td class="text-center"><?= $value["mobil_no"]?></td>
                                    <td><?= $value["muatan"]?></td>
                                    <td><?= $value["asal"]?></td>
                                    <td><?= $value["tujuan"]?></td>
                                    <td><?= number_format($value["tonase"],0,',','.')?></td>
                                    <td><?= number_format($value["tagihan"],2,',','.')?></td>
                                    <td><?= number_format($value["total_tagihan"],2,",",".")?></td>
                                    <td class="text-center"><input class='btn-check-invoice' data-pk='<?= $value["Jo_id"]?>' type='checkbox' checked></td>
                                    <td class="text-center"><a class='btn btn-sm btn-light' target='_blank'  href='<?= base_url('index.php/detail/detail_jo/'.$value['Jo_id'].'/JO')?>'><i class='fas fa-eye'></i></a></td>
                                </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- end table invoice -->
    </div>
    <!-- end form invoice -->
</div>

<!-- table invoice -->
<div class="card shadow small mt-4" style='background-color:#212B4E';>
    <div class="card-body">
        <div class="table-responsive ">
            <table class="table table-bordered text-light"  id="pilih-jo" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center" width="" scope="col">ID JO</th>
                        <th class="text-center" width="" scope="col">Tgl.Muat</th>
                        <th class="text-center" width="" scope="col">Tgl.Plng</th>
                        <th class="text-center" width="" scope="col">Nopol</th>
                        <th class="text-center" width="" scope="col">Muatan</th>
                        <th class="text-center" width="" scope="col">Dari</th>
                        <th class="text-center" width="" scope="col">Ke</th>
                        <th class="text-center" width="" scope="col">Tonase</th>
                        <th class="text-center" width="" scope="col">Harga</th>
                        <th class="text-center" width="" scope="col">Total</th>
                        <th class="text-center" width="" scope="col">Pilih</th>
                        <th class="text-center" width="" scope="col">Detail</th>
                        <th class="text-center" width="" scope="col">Ritase</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
                            </body>
<!-- end table invoice -->
<script src="<?=base_url("assets/vendor/jquery/jquery.min.js")?>"></script>

<script>
        var data_invoice_now = [];
        var data_invoice_new = [];
        data_invoice_now = new Object();
        data_invoice_now.tanggal="<?= change_tanggal($invoice[0]["tanggal_invoice"])?>";
        data_invoice_now.top="<?= $invoice[0]["batas_pembayaran"]?>";
        data_invoice_now.grand="<?= number_format($invoice[0]["grand_total"],2,',','.')?>";
        data_invoice_now.keterangan="<?= $invoice[0]["invoice_keterangan"]?>";
        $( "#form-edit-invoice" ).submit(function( event ) {
            data_invoice_new = new Object();
            data_invoice_new.tanggal=$("#invoice_tgl_edit").val();
            data_invoice_new.top=$("#invoice_payment").val();
            data_invoice_new.grand=$("#invoice_grand_total").val();
            data_invoice_new.keterangan=$("#invoice_keterangan").val();
            if(JSON.stringify(data_invoice_now) == JSON.stringify(data_invoice_new)){
                alert( "Anda Belum Mengubah Data" );
                return false;
            }else{
                return true;
            }
        });
</script>
<script>
    function customer(){
        var nama_customer = $("#customer_id option:selected").text();
        $.ajax({
            type: "GET",
            url: "<?php echo base_url('index.php/home/no_invoice') ?>",
            dataType: "text",
            data: {
                customer_name: nama_customer
            },
            success: function(data) {
                var date = new Date();
                if(date.getMonth()<10){
                    $("#invoice_id").val(data+"-"+"SKB"+"-0"+(date.getMonth()+1)+"-"+date.getFullYear());
                }else{
                    $("#invoice_id").val(data+"-"+"SKB"+"-"+(date.getMonth()+1)+"-"+date.getFullYear());
                }
            }
        })
    }
    function reset_form(){
        location.reload();
    }
    function hanyaangka(a){
		var charCode = (a.which) ? a.which : event.keyCode;
	   if (charCode > 31 && (charCode < 48 || charCode > 57)){
           alert("Masukkan Hanya Angka Saja dan Tanpa Tanda Baca");
           $("#"+a.id).val("");
       }
    }
</script>
<script> //script input tanggal
        function tanggal_berlaku(a){
            // alert(a.id);
            Swal.fire({
                title: "Loading",
                icon: "success",
                text: "Mohon Tunggu Sebentar",
                type: "success",
                timer: 500
            });
            $("#"+a.id).datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true,
                todayHighlight: true,
            });
        }
    </script>