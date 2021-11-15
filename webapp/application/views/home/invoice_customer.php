<body class="text-light" style='background-color:#182039';> 

        <div class="p-1 mt-5" style='background-color:#182039';>
            <div class="card shadow mt-3 mb-4" style='background-color:#182039';>
                <div class="card-header text-light" style='background-color:#182039';>
                    <h6 class="font-weight-bold text-light">Seluruh Data Invoice</h6>
                    
                </div>


                <div class="container-fluid mt-2 mb-2">
                <form method="POST" action="<?= base_url("index.php/print_berkas/invoice_excel/")?>" id="convert_form" class="mr-3">
                        <input type="hidden" name="file_content" id="file_content">
                        <button type="submit" name="convert" id="convert" class="btn btn-success btn-sm btn-icon-split float-right">
                            <span class="icon text-white-100">  
                                <i class="fas fa-print"></i>
                            </span>
                            <span class="text">Excel</span>
                        </button>
                    </form>
                    <a type="submit" class="btn btn-info btn-sm btn-icon-split float-right mr-3" onclick="print_pdf()">
                        <span class="icon text-white-100">  
                            <i class="fas fa-print"></i>
                        </span>
                        <span class="text">Print/PDF</span>
                    </a>
                </div>
                    <div class="w-50 m-auto">
                        <div class="mb-2 mt-3 form-group row">
                            <label for="Status" class="form-label font-weight-bold col-md-3">Status</label>
                            <select name="Status" id="Status" class="form-control selectpicker col-md-9" data-live-search="true">
                                <option class="font-w700" selected value="">Semua Status</option>
                                <option value="Lunas">Lunas</option>
                                <option value="Belum Lunas">Belum Lunas</option>
                            </select>
                        </div>
                        <div class="mb-2 form-group row">
                            <label for="Tanggal_Top" class="form-label font-weight-bold col-md-3">Due Date</label>
                            <input autocomplete="off" type="text" class="form-control col-md-9" id="Tanggal_Top" name="Tanggal_Top" onclick="tanggal_berlaku(this)">
                        </div>
                        <div class="mb-2 form-group row">
                            <label for="Tanggal" class="form-label font-weight-bold col-md-3">Tanggal Invoice</label>
                            <input autocomplete="off" type="text" class="form-control col-md-3" id="Tanggal1" name="Tanggal1" onclick="tanggal_berlaku(this)">
                            <span class="align-middle mr-3 ml-3">s/d</span>
                            <input autocomplete="off" type="text" class="form-control col-md-3" id="Tanggal2" name="Tanggal2" onclick="tanggal_berlaku(this)">
                        </div>
                        <div class="mb-2 form-group row">
                            <label class="form-label font-weight-bold col-md-3" for="Customer">Customer</label>
                            <select name="Customer" value="DESC" id="Customer" class="form-control selectpicker col-md-9" data-live-search="true">
                                <option class="font-w700" disabled="disabled" selected value="">Customer</option>
                                <?php foreach($customer as $value){?>
                                    <option value="<?=$value["customer_id"]?>"><?=$value["customer_name"]?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-2 form-group row">
                            <label for="No_Invoice" class="form-label font-weight-bold col-md-3">No Invoice</label>
                            <input autocomplete="off" type="text" class="form-control col-md-2" id="No_Invoice1" name="No_Invoice1" value="x">
                            <input autocomplete="off" type="text" class="form-control col-md-2" id="No_Invoice2" name="No_Invoice2" value="SKB" readonly>
                            <select class="form-control col-md-3" id="No_Invoice3" name="No_Invoice3">
                                <option value="x">Bulan</option>
                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
                                <option value="03">Maret</option>
                                <option value="04">April</option>
                                <option value="05">Mei</option>
                                <option value="06">Juni</option>
                                <option value="07">Juli</option>
                                <option value="08">Agustus</option>
                                <option value="09">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                            <select class="form-control col-md-2" id="No_Invoice4" name="No_Invoice4">
                                <option value="x">Tahun</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                            </select>
                        </div>
                        <div class="mb-2 mt-3 form-group row">
                            <label for="Ppn" class="form-label font-weight-bold col-md-3">PPN</label>
                            <select name="Ppn" id="Ppn" class="form-control selectpicker col-md-9" data-live-search="true">
                                <option class="font-w700" disabled="disabled" selected value="">PPN</option>
                                <option value="Ya">Ya</option>
                                <option value="Tidak">Tidak</option>
                            </select>
                        </div>
                        <div class="row float-right mb-2 form-group text-center">
                        <button class="btn btn-danger mr-2" onclick="reset_form()">Reset</button>
                            <button class="btn btn-primary" id="btn-cari">Cari</button>
                         
                        </div>
                    </div>
                    <hr>
                    <div class="w-50 m-auto">
                        <span>Total Data Invoice Yang Ditemukan : </span><span id="ditemukan"><?= count($invoice)?></span><br>
                        <span>Total Invoice Belum Dibayar : </span>Rp.<span id="tagihan"><?= number_format($tagihan,2,",",".")?></span>
                    </div>
                    <hr>
                <div class="w-100 small m-auto text-light" id="Table-Seluruh-Invoice-Print" >
                    <div class="card shadow mb-4 mt-3">
                        <!-- tabel Seluruh invoice-->
                        <div class="card-body " style='background-color:#182039';> 
                            <div class="table-responsive">
                                <table class="table table-bordered text-light" id="Table-Seluruh-Invoice" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="text-center" scope="col">No Invoice</th>
                                            <th class="text-center" scope="col">Tgl Invoice</th>
                                            <th class="text-center" scope="col">Customer</th>
                                            <th class="text-center" scope="col">Total Tagihan</th>
                                            <th class="text-center" scope="col">Sisa Tagihan</th>
                                            <th class="text-center" scope="col">Batas Pembayaran</th>
                                            <th class="text-center" scope="col">Status Pembayaran</th>
                                            <th class="text-center" scope="col">Payment</th>
                                            <th class="text-center" scope="col">Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    
</div>

                                </body>

    <script src="<?=base_url("assets/vendor/jquery/jquery.min.js")?>"></script>

<script type="text/javascript">
 $(document).ready(function() {
  $('#convert').click(function() {
    var tabel = document.getElementById("Table-Seluruh-Invoice").rows;
    var bacabaris = tabel.length;
    for(var i=0;i<bacabaris;i++){
        tabel[i].deleteCell(-1);
        tabel[i].deleteCell(-1);
    }      
   var table_content = '<table>';
   table_content += $("head").html()+$('#Table-Seluruh-Invoice').html();
   table_content += '</table>';
   $('#file_content').val(table_content);
   $('#convert_form').html();
   location.reload();
  });
 });
 function print_pdf(){
    var tabel = document.getElementById("Table-Seluruh-Invoice").rows;
    var bacabaris = tabel.length;
    for(var i=0;i<bacabaris;i++){
        tabel[i].deleteCell(-1);
        tabel[i].deleteCell(-1);
    }
    var restorepage = document.body.innerHTML;
    var printcontent = document.getElementById('Table-Seluruh-Invoice-Print').innerHTML;
    document.body.innerHTML = printcontent;
    window.print();
    document.body.innerHTML = restorepage;
    location.reload();
  }
</script>
<script>
    function reset_form(){
        location.reload();
    }
</script>