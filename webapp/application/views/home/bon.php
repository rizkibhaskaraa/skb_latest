<body style='background-color:#182039';> 

<div class="mt-5 p-1" style='background-color:#182039';>
    <div class="text-center mb-4 mt-3" style='background-color:#182039';>
        <!-- <h1 class="h3 mb-0 text-gray-800 mt-3 mb-3">Data Nota Kasbon</h1> -->
            <!-- <a href="<?=base_url("index.php/form/bon")?>" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-100">
                <i class="fas fa-plus"></i> 
            </span>
                <span class="text">
                Buat Transaksi BON
                </span>
            </a> -->
    </div> 
    <!-- tabel transaksi bon -->
    <div class="card shadow mb-4 text-light mt-5" style='background-color:#182039';>
        <div class="card-header" style='background-color:#182039';>
            <h6 class="m-0 font-weight-bold text-light">Seluruh Data Nota Kasbon</h6>
        </div>
            <div class="conatainer w-50 m-auto p-3">
                <div class="mb-2 form-group row mt-3">
                    <label for="Tanggal" class="form-label font-weight-bold col-md-3">Tanggal Bon</label>
                    <input autocomplete="off" type="text" class="form-control col-md-4 " id="Tanggal1" name="Tanggal1" onclick="tanggal_berlaku(this)">
                    <h5 class="mr-2 mt-1 ml-2">s/d</h5>
                    <input autocomplete="off" type="text" class="form-control col-md-4" id="Tanggal2" name="Tanggal2" onclick="tanggal_berlaku(this)">
                </div>
                <div class="mb-2 form-group row">
                    <label class="form-label font-weight-bold col-md-3" for="Supir">Supir</label>
                    <select name="Supir" id="Supir" class="form-control selectpicker col-md-9" data-live-search="true">
                        <option class="font-w700" selected value="">Semua Supir</option>
                        <?php foreach($supir as $value){?>
                            <option value="<?=$value["supir_id"]?>"><?=$value["supir_name"]?></option>
                        <?php }?>
                    </select>
                </div>
                <div class="mb-2 mt-3 form-group row">
                    <label for="Status" class="form-label font-weight-bold col-md-3">Jenis Transaksi</label>
                    <select name="Status" id="Status" class="form-control selectpicker col-md-9" data-live-search="true">
                        <option value="">Semua</option>
                        <option value="Pembayaran">Pembayaran</option>
                        <option value="Pengajuan">Pengajuan</option>
                        <option value="Potong Gaji">Potong Gaji</option>
                    </select>
                </div>
                <div class="mb-2 form-group row">
                    <label for="No_Bon" class="form-label font-weight-bold col-md-3">No. Nota Kasbon</label>
                    <input autocomplete="off" type="text" class="form-control col-md-2 mb-1 mr-md-1 mb-md-0" id="No_Bon1" name="No_Bon1" value="x">
                    <input autocomplete="off" type="text" class="form-control col-md-2 mb-1 mr-md-1 mb-md-0" id="No_Bon2" name="No_Bon2" value="BON" readonly>
                    <select class="form-control col-md-2 mb-1 mr-md-1 mb-md-0" id="No_Bon3" name="No_Bon3">
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
                    <select class="form-control col-md-2" id="No_Bon4" name="No_Bon4">
                        <option value="x">Tahun</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                    </select>
                </div>
                <div class="row float-right mt-3 form-group text-center">
                    
                    <button class="btn btn-danger mr-2" onclick="reset_form()">Reset</button>
                    <button class="btn btn-primary" id="btn-cari-bon">Cari</button>
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-center bg-secondary rounded-pill">
                <span>Total Data Nota Kasbon Yang Ditemukan : </span><span id="ditemukan"><?= count($bon)?></span><br>
            </div>
            <hr>
            <div class="d-flex justify-content-end">
                <form method="POST" action="<?= base_url("index.php/print_berkas/bon_excel/")?>" id="convert_form" class="">
                    <input type="hidden" name="file_content" id="file_content">
                    <button type="submit" name="convert" id="convert" class="btn btn-success btn-icon-split btn-sm">
                        <span class="icon text-white-100">  
                            <i class="fas fa-print"></i>
                        </span>
                        <span class="text">Excel</span>
                    </button>
                </form>
                <a href="" class="mr-4 ml-2 btn btn-sm btn-primary btn-icon-split " onclick="print_pdf()">
                    <span class="icon text-white-100">
                        <i class="fas fa-print"></i> 
                    </span>
                    <span class="text">
                        Print/PDF
                    </span>
                </a>

            </div>
        <div class="card-body" id="Table-Bon-Print">
            <div class="table-responsive">
                <table border="1" class="table table-bordered text-light" id="Table-Bon" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="15%" class="text-center" scope="col">Tgl. Transaksi</th>
                            <th width="20%" class="text-center" scope="col">No. Nota Kasbon</th>
                            <th width="15%" class="text-center" scope="col">Driver</th>
                            <th width="15%" class="text-center"  scope="col">Jenis Transaksi</th>
                            <th width="15%" class="text-center" scope="col">Nominal</th>
                            <th width="5%" class="text-center" scope="col">Detail</th>
                            <th width="15%" class="text-center" scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- end tabel transaksi bon -->
</div>
<!-- pop up detail bon -->
<div class="modal fade " id="popup-bon" tabindex="-1" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style='background-color:#212B4E';>
            <div class="modal-header bg-primary-dark">
                <h5 class="block-title text-light">Detail Transaksi Kasbon</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times</span>
                </button>
            </div>
            <div class="font-size-sm m-3 text-justify">
            <a class='btn btn-primary btn-sm ' id="link_print_bon">
                <span>Cetak Nota Kasbon</span>
            </a>
            <table class="table table-bordered text-light mt-2">
                <tbody>
                    <tr>
                        <td class="font-weight-bold" style="width: 20%;">Tanggal Transaksi</td>
                        <td name="tanggal"></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold" style="width: 20%;">No. Nota Kasbon</td>
                        <td name="id"></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold" style="width: 20%;">Nama Supir</td>
                        <td name="supir"></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold" style="width: 20%;">Jenis Transaksi</td>
                        <td name="jenis"></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold" style="width: 20%;">Nonimal Transaksi</td>
                        <td name="nominal"></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold" style="width: 20%;">Terbilang</td>
                        <td name="terbilang"></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold" style="width: 20%;">Keterangan</td>
                        <td name="keterangan"></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold" style="width: 20%;">No Slip Gaji</td>
                        <td name="pembayaran_upah_id"></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold" style="width: 20%;">Operator</td>
                        <td name="operator"></td>
                    </tr>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
<!-- end pop up detail bon -->

<!-- pop up edit bon -->
<div class="modal fade mt-5 px-5 py-5 " id="popup-update-bon" tabindex="-1" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style='background-color:#212B4E';>
            <div class="modal-header bg-primary-dark">
                <h5 class="block-title text-light">Edit Data Nota Kasbon</h5>
                <button class="close text-light" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times</span>
                </button>
            </div>
            <div class="font-size-sm m-3 text-justify text-light">
                <form action="<?=base_url("index.php/form/update_bon")?>" method="POST" class="row" id="form-edit-bon">
                    <div class="col-md-4 col-md-offset-4 mb-4">
                        <label for="bon_id_edit" class="form-label font-weight-bold">No Bon</label>
                        <input autocomplete="off" type="text" class="form-control" id="bon_edit" name="bon_edit" required readonly>
                    </div>
                    <div class="col-md-4 col-md-offset-4 mb-4">
                        <label class="form-label font-weight-bold" for="Supir_bon">Supir</label>
                        <input autocomplete="off" type="text" class="form-control" id="Supir_edit" name="Supir_edit" required readonly>
                    </div>
                    <div class="col-md-4 col-md-offset-4 mb-4">
                        <label for="Tanggal_edit" class="form-label font-weight-bold">Tanggal</label>
                        <input autocomplete="off" type="text" class="form-control" id="Tanggal_edit" name="Tanggal_edit" required onclick="tanggal_berlaku(this)">
                    </div>
                    <div class="col-md-4 col-md-offset-4 mb-4">
                        <label class="form-label font-weight-bold" for="Jenis_edit">Jenis Transaksi</label>
                        <select name="Jenis_edit" id="Jenis_edit" class="form-control custom-select" required onchange="nominal()">
                            <option class="font-w700" disabled="disabled" selected value="">Jenis Transaksi</option>
                            <option value="Pengajuan">Pengajuan</option>
                            <option value="Pembayaran">Pembayaran</option>
                            <option value="Potong Gaji">Potong Gaji</option>
                        </select>
                    </div>
                    <div class="col-md-4 col-md-offset-4 mb-4">
                        <label for="Nominal_edit" class="form-label font-weight-bold">Nominal</label>
                        <input autocomplete="off" type="text" class="form-control" id="Nominal_edit" name="Nominal_edit" required onkeyup="nominal(this)">
                    </div>
                    <div class="col-md-4 mb-4 ">
                        <label for="Keterangan_edit" class="form-label font-weight-bold">Keterangan/Catatan</label>
                        <textarea class="form-control" name="Keterangan_edit" id="Keterangan_edit" rows="3"></textarea>
                    </div>
                    <div class="col-md-12 col-md-offset-4 mt-5 ">
                        <button type="submit" class="btn btn-success mb-3 ml-3 float-right">Simpan</button> 
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end pop up edit bon -->
                        </body>
<script src="<?=base_url("assets/vendor/jquery/jquery.min.js")?>"></script>

<script type="text/javascript">
 $(document).ready(function() {
  $('#convert').click(function() {
   var table_content = '<table>';
   table_content += $("head").html()+$('#Table-Bon').html();
   table_content += '</table>';
   $('#file_content').val(table_content);
   $('#convert_form').html();
  });
 });
 function print_pdf(){
    var tabel = document.getElementById("Table-Bon").rows;
        var bacabaris = tabel.length;
        for(var i=0;i<bacabaris;i++){
            tabel[i].deleteCell(-1);
            tabel[i].deleteCell(-1);
        }
    var restorepage = document.body.innerHTML;
    var printcontent = document.getElementById('Table-Bon-Print').innerHTML;
    document.body.innerHTML = printcontent;
    window.print();
    document.body.innerHTML = restorepage;
  }
    function reset_form(){
        location.reload();
    }
    function nominal(a){
        $( '#'+a.id ).mask('000.000.000', {reverse: true});
    }
</script>
