<body class="mt-5" style='background-color:#182039';> 

<div class="container-fluid mt-5" style='background-color:#182039';>
    <div class="card shadow mb-4" style='background-color:#212B4E';>
    <div class="card-header py-3" style='background-color:#212B4E';> 
        <h6 class="m-2 font-weight-bold text-light float-left">Seluruh Data Kendaraan</h6>
        <a class="btn btn-primary btn-icon-split float-right btn-sm" data-toggle='modal' data-target='#popup-truck'>
            <span class="icon text-white-100">
                <i class="fas fa-plus"></i> 
            </span>
            <span class="text">
                 Tambah Kendaraan
            </span>
        </a>
    </div>
    <div class="card-body small">
        <div class="table-responsive">
            <table class="table table-bordered text-light" id="Table-Truck" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center" width="5%" scope="col">No</th>
                        <th class="text-center" width="10%" scope="col">No Polisi</th>
                        <th class="text-center" width="12%" scope="col">Merk</th>
                        <th class="text-center" width="12%" scope="col">Tipe</th>
                        <th class="text-center" width="10%" scope="col">Jenis</th>
                        <th class="text-center" width="10%" scope="col">Dump</th>
                        <th class="text-center" width="10%" scope="col">Tahun</th>
                        <th class="text-center" width="3%" scope="col">Status Validasi</th>
                        <th class="text-center" width="13%" scope="col">Aksi</th>
                        <th class="text-center" width="10%" scope="col">Validasi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- pop up add truck -->
<div class="modal fade " id="popup-truck" tabindex="0" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content text-light border-light" style='background-color:#212B4E';>
            <div class="modal-header bg-primary-dark">
                <h5 class="font-weight-bold">Menambah Kendaraan</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="container">
            <?php echo form_open_multipart('form/insert_truck'); ?>
            <div class="table-responsive py-2 mb-3">
                <table class="table table-bordered text-light" id="Table-Pilih-Merk" width="100%" cellspacing="0">
                    <thead>
                        <tr>    
                            <th class="text-center" width="5%" scope="col">No</th>
                            <th class="text-center" width="12%" scope="col">Merk</th>
                            <th class="text-center" width="12%" scope="col">Tipe</th>
                            <th class="text-center" width="15%" scope="col">Jenis Kendaraan</th>
                            <th class="text-center" width="10%" scope="col">Dump</th>
                            <th class="text-center" width="30%" scope="col">Aksi</th>
                        </tr>
                    </thead>
                    
                </table>
            </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group ">
                            <label for="mobil_no" class="form-label font-weight-bold">Plat No Mobil</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_no" name="mobil_no" required>
                        </div>
                        <div class="form-group ">
                            <label for="mobil_no_rangka" class="form-label font-weight-bold">No Rangka</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_no_rangka" name="mobil_no_rangka">
                        </div>                        
                        <div class="form-group ">
                            <label for="mobil_no_mesin" class="form-label font-weight-bold">No Mesin</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_no_mesin" name="mobil_no_mesin">
                        </div>
                        <div class="form-group">
                            <input autocomplete="off" type="text" class="form-control" id="merk_id" name="merk_id" hidden>
                            <label for="mobil_merk" class="form-label font-weight-bold" onclick="merk()"">Merk</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_merk" name="mobil_merk" readonly>
                        </div>
                        <div class="form-group">
                            <label for="mobil_type" class="form-label font-weight-bold">Type</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_type" name="mobil_type" readonly>
                        </div>
                        <div class="form-group">
                            <label class="form-label font-weight-bold" for="mobil_jenis">Jenis Mobil</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_jenis" name="mobil_jenis" readonly>
                        </div>
                        <div class="form-group">
                            <label class="form-label font-weight-bold" for="mobil_dump">Dump</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_dump" name="mobil_dump" readonly>
                        </div>
                        <div class="form-group">
                            <label for="mobil_keterangan" class="form-label font-weight-bold">Keterangan</label>
                            <textarea class="form-control" name="mobil_keterangan" rows="3"></textarea>
                        </div>
                    </div>    
                    <div class="col">
                        <div class="form-group">
                            <label for="mobil_tahun" class="form-label font-weight-bold">Tahun</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_tahun" name="mobil_tahun">
                        </div>
                        <div class="form-group">
                            <label for="mobil_bpkb" class="form-label font-weight-bold">No BPKB</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_bpkb" name="mobil_bpkb">
                        </div>
                        <div class="form-group">
                            <label for="mobil_berlaku" class="form-label font-weight-bold">Masa Beralaku STNK (1 Th)</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_berlaku" name="mobil_berlaku" onclick="tanggal_berlaku(this)">
                        </div>
                        <div class="form-group">
                            <label for="mobil_pajak" class="form-label font-weight-bold">Masa Beralaku STNK (5 Th)</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_pajak" name="mobil_pajak" onclick="tanggal_berlaku(this)">
                        </div>
                        <div class="form-group">
                            <label for="mobil_stnk" class="form-label font-weight-bold">No STNK</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_stnk" name="mobil_stnk">
                        </div>
                        <div class="form-group">
                            <label for="mobil_usaha" class="form-label font-weight-bold">No Izin Usaha</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_usaha" name="mobil_usaha">
                        </div>
                        <div class="form-group">
                            <label for="mobil_berlaku_usaha" class="form-label font-weight-bold">Masa Berlaku Izin Usaha</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_berlaku_usaha" name="mobil_berlaku_usaha" onclick="tanggal_berlaku(this)">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="mobil_kir" class="form-label font-weight-bold">No KIR</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_kir" name="mobil_kir">
                        </div>
                        <div class="form-group">
                            <label for="mobil_berlaku_kir" class="form-label font-weight-bold">Masa Berlaku KIR</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_berlaku_kir" name="mobil_berlaku_kir" onclick="tanggal_berlaku(this)">
                        </div>
                        <div class="form-group">
                            <label for="mobil_ijin_bongkar" class="form-label font-weight-bold">No Izin Bongkar Muat</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_ijin_bongkar" name="mobil_ijin_bongkar" >
                        </div>
                        <div class="form-group">
                            <label for="mobil_berlaku_ijin_bongkar" class="form-label font-weight-bold">Masa Berlaku Izin Bongkar Muat</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_berlaku_ijin_bongkar" name="mobil_berlaku_ijin_bongkar" onclick="tanggal_berlaku(this)">
                        </div>
                        <div class="form-group">
                            <label for="file_foto" class="form-label font-weight-bold">Foto Mobil</label>
                            <input type="file" class="form-control" id="file_foto" name="file_foto" onchange="upload_foto(this)">
                        </div>
                        <div class="form-group">
                            <label for="file_STNK" class="form-label font-weight-bold">Foto STNK</label>
                            <input type="file" class="form-control" id="file_STNK" name="file_STNK" onchange="upload_foto(this)"> 
                        </div>
                    </div>
                </div>  
            </div>
            <div class="form-group mt-1 mr-4 ">
                <button type="submit" class="btn btn-success float-right">Simpan</button>
            </div>
            <?php echo form_close();?>
            
        </div>
    </div>
</div>
<!-- end pop up add truck -->

<!-- pop up update truck -->
<div class="modal fade" id="popup-update-truck" tabindex="0" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content text-light border-light" style='background-color:#212B4E';>
            <div class="modal-header bg-primary-dark">
                <h5 class="font-weight-bold">Update Kendaraan</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="font-size-sm m-3 text-justify">
                <!-- <?php echo form_open_multipart('form/update_truck'); ?> -->
                <form action="<?= base_url('index.php/form/update_truck'); ?>" method="POST" enctype="multipart/form-data" id="form-edit-truck">
                <div class="table-responsive py-2 mb-3">
                    <table class="table table-bordered text-light" id="Table-Pilih-Merk-Edit" width="100%" cellspacing="0">
                        <thead>
                            <tr>    
                                <th class="text-center" width="5%" scope="col">No</th>
                                <th class="text-center" width="12%" scope="col">Merk</th>
                                <th class="text-center" width="12%" scope="col">Tipe</th>
                                <th class="text-center" width="15%" scope="col">Jenis Kendaraan</th>
                                <th class="text-center" width="10%" scope="col">Dump</th>
                                <th class="text-center" width="30%" scope="col">Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group ">
                            <label for="mobil_no_update" class="form-label font-weight-bold">Plat No Mobil</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_no_old" name="mobil_no_old" hidden>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_no_update" name="mobil_no_update" required>
                        </div>
                        <div class="form-group ">
                            <label for="mobil_no_rangka_update" class="form-label font-weight-bold">No Rangka</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_no_rangka_update" name="mobil_no_rangka_update">
                        </div>                        
                        <div class="form-group ">
                            <label for="mobil_no_mesin_update" class="form-label font-weight-bold">No Mesin</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_no_mesin_update" name="mobil_no_mesin_update">
                        </div>
                        <div class="form-group">
                            <!-- <input autocomplete=s"off" type="text" class="form-control" id="merk_id_update" name="merk_id_update"> -->
                            <label for="mobil_merk_update" class="form-label font-weight-bold" onclick="merk()"">Merk</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_merk_update" name="mobil_merk_update" readonly>
                        </div>
                        <div class="form-group">
                            <label for="mobil_type_update" class="form-label font-weight-bold">Tipe</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_type_update" name="mobil_type_update" readonly>
                        </div>
                        <div class="form-group">
                            <label class="form-label font-weight-bold" for="mobil_jenis_update">Jenis Mobil</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_jenis_update" name="mobil_jenis_update" readonly>
                        </div>
                        <div class="form-group">
                            <label class="form-label font-weight-bold" for="mobil_dump_update">Dump</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_dump_update" name="mobil_dump_update" readonly>
                        </div>
                        <div class="form-group">
                            <label for="mobil_keterangan_update" class="form-label font-weight-bold">Keterangan</label>
                            <textarea class="form-control" name="mobil_keterangan_update" rows="3"></textarea>
                        </div>
                    </div>    
                    <div class="col">
                        <div class="form-group">
                            <label for="mobil_tahun_update" class="form-label font-weight-bold">Tahun</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_tahun_update" name="mobil_tahun_update">
                        </div>
                        <div class="form-group">
                            <label for="mobil_bpkb_update" class="form-label font-weight-bold">No BPKB</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_bpkb_update" name="mobil_bpkb_update">
                        </div>
                        <div class="form-group">
                            <label for="mobil_berlaku_update" class="form-label font-weight-bold">Masa Beralaku STNK (1 Th)</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_berlaku_update" name="mobil_berlaku_update" onclick="tanggal_berlaku(this)">
                        </div>
                        <div class="form-group">
                            <label for="mobil_pajak_update" class="form-label font-weight-bold">Masa Beralaku STNK (5 Th)</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_pajak_update" name="mobil_pajak_update" onclick="tanggal_berlaku(this)">
                        </div>
                        <div class="form-group">
                            <label for="mobil_stnk_update" class="form-label font-weight-bold">No STNK</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_stnk_update" name="mobil_stnk_update">
                        </div>
                        <div class="form-group">
                            <label for="mobil_usaha_update" class="form-label font-weight-bold">No Izin Usaha</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_usaha_update" name="mobil_usaha_update">
                        </div>
                        <div class="form-group">
                            <label for="mobil_berlaku_usaha_update" class="form-label font-weight-bold">Masa Berlaku Izin Usaha</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_berlaku_usaha_update" name="mobil_berlaku_usaha_update" onclick="tanggal_berlaku(this)">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="mobil_kir_update" class="form-label font-weight-bold">No KIR</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_kir_update" name="mobil_kir_update">
                        </div>
                        <div class="form-group">
                            <label for="mobil_berlaku_kir_update" class="form-label font-weight-bold">Masa Berlaku KIR</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_berlaku_kir_update" name="mobil_berlaku_kir_update" onclick="tanggal_berlaku(this)">
                        </div>
                        <div class="form-group">
                            <label for="mobil_ijin_bongkar_update" class="form-label font-weight-bold">No Izin Bongkar Muat</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_ijin_bongkar_update" name="mobil_ijin_bongkar_update" >
                        </div>
                        <div class="form-group">
                            <label for="mobil_berlaku_ijin_bongkar_update" class="form-label font-weight-bold">Masa Berlaku Izin Bongkar Muat</label>
                            <input autocomplete="off" type="text" class="form-control" id="mobil_berlaku_ijin_bongkar_update" name="mobil_berlaku_ijin_bongkar_update" onclick="tanggal_berlaku(this)">
                        </div>
                        <div class="form-group">
                            <label for="file_foto_update" class="form-label font-weight-bold">Foto Mobil</label>
                            <input type="file" class="form-control" id="file_foto_update" name="file_foto_update" onchange="upload_foto(this)">
                        </div>
                        <div class="form-group">
                            <label for="file_STNK_update" class="form-label font-weight-bold">Foto STNK</label>
                            <input type="file" class="form-control" id="file_STNK_update" name="file_STNK_update" onchange="upload_foto(this)"> 
                        </div>
                    </div>
                </div>  
            </div>
            <div class="form-group mt-1 mr-4 ">
                <button type="submit" class="btn btn-success float-right">Simpan</button>
            </div>
            </form>
            <!-- <?php echo form_close();?> -->
            </div>
        </div>
    </div>
</div>
<!-- end pop up update truck -->

<!-- pop up detail kendaraan -->
<div class="modal fade " id="popup-kendaraan" tabindex="0" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content text-light border-light" style='background-color:#212B4E';>
            <div class="modal-header bg-primary-dark">
                <h5 class="block-title">Detail Kendaraan</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times</span>
                </button>
            </div>
            <div class="font-size-sm m-3 text-justify row">
                <div class="col">
                    <table class="table table-bordered text-light">
                        <tbody>
                            <tr>
                                <td class="font-weight-bold" width= "35%">No Polisi</td>
                                <td name="mobil_no"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" width= "35%">No Rangka</td>
                                <td name="mobil_no_rangka"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" width= "35%">No Mesin</td>
                                <td name="mobil_no_mesin"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Jenis Kendaraan</td>
                                <td name="mobil_jenis"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Status Jalan</td>
                                <td name="status_jalan"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Keterangan</td>
                                <td name="mobil_keterangan"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Merk</td>
                                <td name="mobil_merk"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Type</td>
                                <td name="mobil_type"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Dump</td>
                                <td name="mobil_dump"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Tahun</td>
                                <td name="mobil_tahun"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Tgl.STNK 1 Tahunan</td>
                                <td name="mobil_berlaku"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Tgl.STNK 5 Tahunan</td>
                                <td name="mobil_pajak"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col">
                    <table class="table table-bordered text-light">
                        <tbody>
                            <tr>
                                <td class="font-weight-bold">No BPKB</td>
                                <td name="mobil_bpkb"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" width= "35%">No STNK</td>
                                <td name="mobil_stnk"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" width= "35%">No KIR</td>
                                <td name="mobil_kir"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Berlaku KIR</td>
                                <td name="mobil_berlaku_kir"></td>
                            </tr>                            
                            <tr>
                                <td class="font-weight-bold" width= "35%">No Ijin Bongkar</td>
                                <td name="mobil_ijin_bongkar"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Berlaku Izin Bongkar</td>
                                <td name="mobil_berlaku_ijin_bongkar"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">No Mobil Usaha</td>
                                <td name="mobil_usaha"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Berlaku No Mobil Usaha</td>
                                <td name="mobil_berlaku_usaha"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                                    <div class="container w-10 text-center">
                                        <img src="" alt="foto mobil" id="file_foto_detail" class="img-thumbnail " style="width:630px;height:900;">
                                    </div>
                      
                                    <div class="container w-10 text-center">
                                        <img src="" alt="foto stnk" id="file_stnk_detail" class="img-thumbnail"style="width:630px;height:900;">
                                    </div>
                      
            </div>
        </div>
    </div>
    </div>
    </div>
    
</div>
<!-- end pop up detail kendaraan -->

<div class="modal fade " id="popup-acc-edit-truck" tabindex="0" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content text-light border-light" style='background-color:#212B4E';>
            <div class="modal-header bg-primary-dark">
                <h5 class="block-title">Data Edit Kendaraan</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times</span>
                </button>
            </div>
            <div class="font-size-sm m-3 text-justify row">
                <div class="col">
                    <table class="table table-bordered text-light">
                        <tbody>
                            <tr>
                                <td class="font-weight-bold" width= "35%">No Polisi</td>
                                <td name="mobil_no_edit"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" width= "35%">No Rangka</td>
                                <td name="mobil_no_rangka_edit"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" width= "35%">No Mesin</td>
                                <td name="mobil_no_mesin_edit"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Jenis Kendaraan</td>
                                <td name="mobil_jenis_edit"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Status Jalan</td>
                                <td name="status_jalan_edit"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Keterangan</td>
                                <td name="mobil_keterangan_edit"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Merk</td>
                                <td name="mobil_merk_edit"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Type</td>
                                <td name="mobil_type_edit"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Dump</td>
                                <td name="mobil_dump_edit"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Tahun</td>
                                <td name="mobil_tahun_edit"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Tgl.STNK 1 Tahunan</td>
                                <td name="mobil_berlaku_edit"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Tgl.STNK 5 Tahunan</td>
                                <td name="mobil_pajak_edit"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col">
                    <table class="table table-bordered text-light">
                        <tbody>
                            <tr>
                                <td class="font-weight-bold">No BPKB</td>
                                <td name="mobil_bpkb_edit"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" width= "35%">No STNK</td>
                                <td name="mobil_stnk_edit"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" width= "35%">No KIR</td>
                                <td name="mobil_kir_edit"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Berlaku KIR</td>
                                <td name="mobil_berlaku_kir_edit"></td>
                            </tr>                            
                            <tr>
                                <td class="font-weight-bold" width= "35%">No Ijin Bongkar</td>
                                <td name="mobil_ijin_bongkar_edit"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Berlaku Izin Bongkar</td>
                                <td name="mobil_berlaku_ijin_bongkar_edit"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">No Mobil Usaha</td>
                                <td name="mobil_usaha_edit"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Berlaku No Mobil Usaha</td>
                                <td name="mobil_berlaku_usaha_edit"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="container w-10 text-center">
                    <img src="" alt="foto mobil" id="file_foto_edit" class="img-thumbnail " style="width:630px;height:900;">
                </div>      
                <div class="container w-10 text-center">
                    <img src="" alt="foto stnk" id="file_stnk_edit" class="img-thumbnail"style="width:630px;height:900;">
                </div>
                <a class="btn btn-success ACC mr-2" onclick='acc_edit_truck(this)'>ACC</a>
                <a class="btn btn-danger Tolak" onclick='tolak_edit_truck(this)'>Tolak</a>
            </div>
        </div>
    </div>
    </div>
    </div>
    
</div>


</body>


<script>
    function merk(){
        $.ajax({ //ajax ambil data bon
            type: "GET",
            url: "<?php echo base_url('index.php/detail/getallmerk') ?>",
            dataType: "JSON",
            success: function(data) { //jika ambil data sukses
                alert(data);
            }
        });
    }
</script>