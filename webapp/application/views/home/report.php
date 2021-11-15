<div class="container">
<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Seluruh Data Job Order(JO)</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3 mb-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Job Order(JO)</h6>
        </div>
        <!-- select tanggal,bulan,tahun -->
        
        <div class="row text-center col-md-12 ml-0">
            <!-- select tanggal -->
            <div class="col-md-2">
                <select name="Tanggal" id="Tanggal" class="form-control">
                    <option class="font-w700" selected value="x">Semua Tanggal</option>
                    <?php for($i=1;$i<32;$i++){
                        if($i<10){?>
                        <option class="font-w700" value="0<?=$i?>">0<?=$i?></option>
                        <?php }else{?>
                        <option class="font-w700" value="<?=$i?>"><?=$i?></option>
                    <?php }
                    }?>
                </select>
            </div>
            <!-- end select tanggal -->
            <!-- select bulan -->
            <div class="col-md-2">
                <select name="Bulan" id="Bulan" class="form-control">
                    <option class="font-w700" selected value="x">Semua Bulan</option>
                    <option class="font-w700" value="01">Januari</option>
                    <option class="font-w700" value="02">Februari</option>
                    <option class="font-w700" value="03">Maret</option>
                    <option class="font-w700" value="04">April</option>
                    <option class="font-w700" value="05">Mei</option>
                    <option class="font-w700" value="06">Juni</option>
                    <option class="font-w700" value="07">Juli</option>
                    <option class="font-w700" value="08">Agustus</option>
                    <option class="font-w700" value="09">September</option>
                    <option class="font-w700" value="10">Oktober</option>
                    <option class="font-w700" value="11">November</option>
                    <option class="font-w700" value="12">Desember</option>
                </select>
            </div>
            <!-- end select bulan -->
            <!-- select tahun -->
            <div class="col-md-2">
                <select name="Tahun" id="Tahun" class="form-control">
                    <option class="font-w700" selected value="x">Semua Tahun</option>
                    <?php for($i=15;$i<30;$i++){?>
                        <option class="font-w700" value="<?="20".$i?>"><?="20".$i?></option>
                    <?php }?>
                </select>
            </div>
            <!-- end select tahun -->
            <div class="col-md-2">
                <select name="status-JO" id="status-JO" class="form-control">
                    <option value="x">Semua Status</option>
                    <option value="Dalam Perjalanan">Dalam Perjalanan</option>
                    <option value="Sampai Tujuan">Sampai Tujuan</option>
                </select>
            </div>
            <div class="col-md-2">
                <a href="<?=base_url("index.php/print_berkas/cetaklaporanpdf/x/x/x/x/report")?>" class="btn btn-primary btn-icon-split" id="link_cetaklaporanpdf">
                    <span class="icon text-white-100">  
                        <i class="fas fa-print"></i>
                    </span>
                    <span class="text">Cetak PDF</span>
                </a>
            </div>
            <div class="col-md-2">
                <a href="<?=base_url("index.php/print_berkas/cetaklaporanexcel/x/x/x/x/report")?>" class="btn btn-primary btn-icon-split" id="link_cetaklaporanexcel">
                    <span class="icon text-white-100">  
                        <i class="fas fa-print"></i>
                    </span>
                    <span class="text">Cetak Excel</span>
                </a>
            </div>
        </div>

        <!-- end select tanggal,bulan,tahun -->
        <!-- tabel JO -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered " id="Table-Job-Order-report" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center" scope="col">No JO</th>
                            <th class="text-center" scope="col">Customer</th>
                            <th class="text-center" scope="col">Rute</th>
                            <th class="text-center" scope="col">Tanggal</th>
                            <th width="17%" class="text-center" scope="col">Status</th>
                            <th class="text-center" scope="col">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        </div>
        <!-- end tabel JO -->
    </div>
</div>
<!-- pop up add detail rute paketan -->
<div class="modal fade" id="popup-detail-rute-paketan" tabindex="0" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-md"  role="document"  >
        <div class="modal-content">
            <div class="modal-header bg-primary-dark">
                <h5 class="font-weight-bold">Detail Rute</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="font-size-sm m-3 text-justify">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="table-data-rute-paketan" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="text-center" scope="col">No Rute</th>
                                            <th class="text-center" scope="col">Dari</th>
                                            <th class="text-center" scope="col">Ke</th>
                                            <th class="text-center" scope="col">Muatan</th>
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
<!-- end pop up add detail rute paketan -->