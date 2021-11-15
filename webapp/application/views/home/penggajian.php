<body class="mt-5" style='background-color:#182039';> 

<div class="container-fluid mt-5" style='background-color:#182039';>
    <div class="card shadow mb-4" style='background-color:#212B4E';>
    <div class="card-header py-3" style='background-color:#212B4E';>
        <h6 class="m-0 font-weight-bold text-light float-left">Seluruh Data Driver</h6>
        <a class="btn btn-primary btn-icon-split float-right btn-sm" data-toggle='modal' data-target='#popup-supir'>
            <span class="icon text-white-100">
                <i class="fas fa-plus"></i> 
            </span>
            <span class="text">
                 Tambah Driver
            </span>
        </a>
    </div>
    <!-- tabel supir -->
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-light small" id="Table-Supir" width="100%" cellspacing="0">
                <thead>
                    <tr>        
                        <th class="text-center"  scope="col">ID Driver</th>
                        <th class="text-center"  scope="col">Nama Lengkap</th>
                        <th class="text-center"  scope="col">Nama Panggilan</th>
                        <th class="text-center" scope="col">No. HP</th>
                        <!-- <th width="12%" scope="col">Berlaku SIM</th> -->
                        <!-- <th width="13%" scope="col">Status Jalan</th> -->
                        <th width="12%" scope="col">Status</th>
                        <th class="text-center" width="12%" scope="col">Status Validasi</th>
                        <th width="14%" scope="col">Aksi</th>
                        <th width="11%" scope="col">Validasi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <!-- end tabel supir -->
</div>

<!-- pop up add supir -->
<div class="modal fade" id="popup-supir" tabindex="0" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content text-light border-light" style='background-color:#212B4E';>
            <div class="modal-header bg-primary-dark">
                <h5 class="font-weight-bold">Menambah Driver</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
           
            <div class="container mt-3">
                <div class="row">
                    <div class="col">
                    <!-- <form action="<?= base_url("index.php/form/insert_supir")?>" method="POST"> -->
                    <?php echo form_open_multipart('form/insert_supir'); ?>
                        <div class="form-group row">
                            <div class="col row">
                                <label for="Supir" class="form-label font-weight-bold col-md-12">Nama Driver</label>
                                <input autocomplete="off" type="text" class="form-control col-md-12" id="Supir" name="Supir" required placeholder="Nama Driver">
                            </div>
                            <div class="col row ml-1">
                                <label for="Supir" class="form-label font-weight-bold col-md-12">Nama Panggilan Driver</label>
                                <input autocomplete="off" type="text" class="form-control col-md-12" id="supir_panggilan" name="supir_panggilan" placeholder="Panggilan">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="supir_ttl" class="form-label font-weight-bold col-md-12">Tempat & Tanggal Lahir</label>
                            <input autocomplete="off" type="text" class="form-control col mr-2" id="supir_tempat_lahir" name="supir_tempat_lahir" placeholder="Tempat Lahir">
                            <input autocomplete="off" type="text" class="form-control col" id="supir_tgl_lahir" name="supir_tgl_lahir" placeholder="Tanggal Lahir" onclick="tanggal_berlaku(this)">
                        </div>
                        <div class="form-group">
                            <label for="supir_alamat" class="form-label font-weight-bold">Alamat</label>
                            <input autocomplete="off" type="text" class="form-control" id="supir_alamat" name="supir_alamat" placeholder="Alamat">
                        </div>
                        <div class="form-group">
                            <label for="supir_telp" class="form-label font-weight-bold">Telp./HP</label>
                            <input autocomplete="off" type="text" class="form-control" id="supir_telp" name="supir_telp" placeholder="Telp Driver">
                        </div>
                        <div class="form-group">
                            <label for="supir_ktp" class="form-label font-weight-bold">No.KTP</label>
                            <input autocomplete="off" type="text" class="form-control" id="supir_ktp" name="supir_ktp" placeholder="No KTP">
                        </div>
                        <div class="form-group">
                            <label for="supir_sim" class="form-label font-weight-bold">No.SIM</label>
                            <input autocomplete="off" type="text" class="form-control" id="supir_sim" name="supir_sim" placeholder="No SIM">
                        </div>
                        <div class="form-group">
                            <label for="supir_tgl_sim" class="form-label font-weight-bold">Tanggal Berlaku SIM</label>
                            <input autocomplete="off" type="text" class="form-control" id="supir_tgl_sim" name="supir_tgl_sim" placeholder="Berlaku SIM" onclick="tanggal_berlaku(this)">
                        </div>
                        <div class="form-group">
                            <label for="supir_tgl_aktif" class="form-label font-weight-bold">Tanggal Aktif Supir</label>
                            <input autocomplete="off" type="text" class="form-control" id="supir_tgl_aktif" name="supir_tgl_aktif" placeholder="Tanggal Aktif Supir" onclick="tanggal_berlaku(this)">
                        </div>
                        <div class="form-group">
                            <label for="supir_keterangan" class="form-label font-weight-bold">Keterangan</label>
                            <textarea class="form-control" name="supir_keterangan" id="supir_keterangan" rows="3"></textarea>
                        </div>

                    </div>
                    <div class="col">
                        <span>Data Keluarga yang Dapat Dihubungi</span>
                        <div class="form-group">
                            <label for="darurat_nama_update" class="form-label font-weight-bold">Nama</label>
                            <input autocomplete="off" type="text" class="form-control" id="darurat_nama" name="darurat_nama" placeholder="Nama Keluarga">
                        </div>
                        <div class="form-group">
                            <label for="darurat_telp_update" class="form-label font-weight-bold">Telp</label>
                            <input autocomplete="off" type="text" class="form-control" id="darurat_telp" name="darurat_telp" placeholder="Telp Keluarga">
                        </div>
                        <div class="form-group">
                            <label for="darurat_referensi_update" class="form-label font-weight-bold">Referensi</label>
                            <input autocomplete="off" type="text" class="form-control" id="darurat_referensi" name="darurat_referensi" placeholder="Referensi">
                        </div>
                        <div class="form-group">
                            <label for="file_foto" class="form-label font-weight-bold">Foto Driver</label>
                            <input type="file" class="form-control" id="file_foto" name="file_foto" onchange="upload_foto(this)">
                        </div>
                        <div class="form-group">
                            <label for="file_sim" class="form-label font-weight-bold">Foto SIM</label>
                            <input type="file" class="form-control" id="file_sim" name="file_sim" onchange="upload_foto(this)">
                        </div>
                        <div class="form-group">
                            <label for="file_ktp" class="form-label font-weight-bold">Foto KTP</label>
                            <input type="file" class="form-control" id="file_ktp" name="file_ktp" onchange="upload_foto(this)">
                        </div>
                        <div class="form-group">
                        <button type="submit" class="btn btn-success mb-3 float-right">Simpan</button>
                        </div>
                        <!-- </form> -->
                        <?php echo form_close();?>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>
<!-- end pop up add supir -->

<!-- pop up update status supir -->
<div class="modal fade mt-5" id="update_status_aktif_supir" tabindex="0" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content text-light border-light" style='background-color:#212B4E';>
            <div class="modal-header bg-primary-dark">
                <h5 class="font-weight-bold">Update Status Aktif Driver</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="container mt-3">
                    <form action="<?= base_url("index.php/form/update_status_aktif_supir")?>" method="POST">
                        <input autocomplete="off" type="text" class="form-control" id="update_status_supir_id" name="update_status_supir_id" required hidden>
                        <div class="form-group">
                            <label for="update_status_supir_name" class="form-label font-weight-bold">Nama Driver</label>
                            <input autocomplete="off" type="text" class="form-control" id="update_status_supir_name" name="update_status_supir_name" required readonly>
                        </div>
                        <div class="form-group">
                            <label for="update_status_tanggal_nonaktif" class="form-label font-weight-bold">Tanggal Aktif / Non-Aktif</label>
                            <input autocomplete="off" type="text" class="form-control" id="update_status_tanggal_nonaktif" name="update_status_tanggal_nonaktif" required onclick="tanggal_berlaku(this)">
                        </div>
                        <div class="form-group">
                            <label for="update_status_status_aktif" class="form-label font-weight-bold">Status Aktif</label>
                            <select id="update_status_status_aktif" name="update_status_status_aktif" class="form-control custom-select" required>
                                <option class="font-w700" disabled="disabled" selected value="">Status Aktif</option>
                                <option value="Aktif">Aktif</option>
                                <option value="Non-Aktif">Non-Aktif</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success mb-3 float-right">Simpan</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>
<!-- end pop up update status supir -->

<!-- pop up update data supir -->
<div class="modal fade" id="popup-update-supir" tabindex="-1" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content text-light border-light" style='background-color:#212B4E';>
            <div class="modal-header bg-primary-dark">
                <h5 class="font-weight-bold">Update Data Driver</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col">
                    <!-- <?php echo form_open_multipart('form/update_supir'); ?> -->
                    <form action="<?= base_url('index.php/form/update_supir'); ?>" method="POST" enctype="multipart/form-data" id="form-edit-supir">
                        <input type="text" name=supir_id id=supir_id hidden>
                        <div class="form-group row">
                            <div class="col row mt-3">
                                <label for="supir_name" class="form-label font-weight-bold col-md-12">Nama Driver</label>
                                <input autocomplete="off" type="text" class="form-control col-md-12" id="supir_name" name="supir_name" required>
                            </div>
                            <div class="col row mt-3 ml-1">
                                <label for="supir_name" class="form-label font-weight-bold col-md-12">Nama Panggilan Driver</label>
                                <input autocomplete="off" type="text" class="form-control col" id="supir_panggilan_update" name="supir_panggilan_update" placeholder="Panggilan">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="supir_ttl_update" class="form-label font-weight-bold col-md-12">Tempat,Tanggal Lahir</label>
                            <input autocomplete="off" type="text" class="form-control col mr-2" id="supir_tempat_lahir_update" name="supir_tempat_lahir_update" placeholder="Tempat Lahir">
                            <input autocomplete="off" type="text" class="form-control col" id="supir_tgl_lahir_update" name="supir_tgl_lahir_update" placeholder="Tanggal Lahir" onclick="tanggal_berlaku(this)">
                        </div>
                        <div class="form-group">
                            <label for="supir_alamat_update" class="form-label font-weight-bold">Alamat</label>
                            <input autocomplete="off" type="text" class="form-control" id="supir_alamat_update" name="supir_alamat_update">
                        </div>
                        <div class="form-group">
                            <label for="supir_telp_update" class="form-label font-weight-bold">Telp./HP</label>
                            <input autocomplete="off" type="text" class="form-control" id="supir_telp_update" name="supir_telp_update">
                        </div>
                        <div class="form-group">
                            <label for="supir_ktp_update" class="form-label font-weight-bold">No.KTP</label>
                            <input autocomplete="off" type="text" class="form-control" id="supir_ktp_update" name="supir_ktp_update">
                        </div>
                        <div class="form-group">
                            <label for="supir_tgl_sim_update" class="form-label font-weight-bold">Tanggal Berlaku SIM</label>
                            <input autocomplete="off" type="text" class="form-control" id="supir_tgl_sim_update" name="supir_tgl_sim_update" placeholder="Berlaku SIM" onclick="tanggal_berlaku(this)">
                        </div>
                        <div class="form-group">
                            <label for="supir_sim_update" class="form-label font-weight-bold">No.SIM</label>
                            <input autocomplete="off" type="text" class="form-control" id="supir_sim_update" name="supir_sim_update">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group mt-3">
                            <label for="supir_tgl_aktif_update" class="form-label font-weight-bold">Tanggal Aktif Supir</label>
                            <input autocomplete="off" type="text" class="form-control" id="supir_tgl_aktif_update" name="supir_tgl_aktif_update" placeholder="Tanggal Aktif Supir" onclick="tanggal_berlaku(this)">
                        </div>
                        <div class="form-group">
                            <label for="supir_keterangan_update" class="form-label font-weight-bold">Keterangan</label>
                            <textarea class="form-control" name="supir_keterangan_update" id="supir_keterangan_update" rows="3"></textarea>
                        </div>
                        <span>Data Keluarga yang Dapat Dihubungi</span>
                        <div class="form-group">
                            <label for="darurat_nama_update" class="form-label font-weight-bold">Nama</label>
                            <input autocomplete="off" type="text" class="form-control" id="darurat_nama_update" name="darurat_nama_update" placeholder="Nama Keluarga">
                        </div>
                        <div class="form-group">
                            <label for="darurat_telp_update" class="form-label font-weight-bold">Telp</label>
                            <input autocomplete="off" type="text" class="form-control" id="darurat_telp_update" name="darurat_telp_update" placeholder="Telp Keluarga">
                        </div>
                        <div class="form-group">
                            <label for="darurat_referensi_update" class="form-label font-weight-bold">Referensi</label>
                            <input autocomplete="off" type="text" class="form-control" id="darurat_referensi_update" name="darurat_referensi_update" placeholder="Referensi">
                        </div>
                        <div class="form-group">
                            <label for="file_foto_update" class="form-label font-weight-bold">Foto Driver</label>
                            <input type="file" class="form-control" id="file_foto_update" name="file_foto_update" onchange="upload_foto(this)">
                        </div>
                        <div class="form-group">
                            <label for="file_sim_update" class="form-label font-weight-bold">Foto SIM</label>
                            <input type="file" class="form-control" id="file_sim_update" name="file_sim_update" onchange="upload_foto(this)">
                        </div>
                        <div class="form-group">
                            <label for="file_ktp_update" class="form-label font-weight-bold">Foto KTP</label>
                            <input type="file" class="form-control" id="file_ktp_update" name="file_ktp_update" onchange="upload_foto(this)">
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-success mb-3 float-right">Simpan</button>
                    </div>
                    </form>
                    <!-- <?php echo form_close();?> -->
                </div>
            </div>



        </div>
    </div>
</div>
<!-- end pop up update data supir -->

<!-- pop up detail supir -->
<div class="modal fade" id="popup-detail-supir" tabindex="-1" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content text-light border-light" style='background-color:#212B4E';>
            <div class="modal-header bg-primary-dark">
                <h5 class="block-title">Detail Driver</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times</span>
                </button>
            </div>
            <div class="font-size-sm text-justify">
            <div class="container">
                <div class="col">
                <div class="container-fluid btn btn-block btn-facebook active mt-2 mb-2">
                    <strong><span id="aktif">Aktif</span></strong>
                    <span id="tgl-aktif">2021-01-22-sekarang</span>
                </div>
                    <table class="table table-bordered text-light">
                        <tbody>
                            <tr>
                                <td class="font-weight-bold" style="width: 40%;">Nama</td>
                                <td name="supir_name"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" style="width: 40%;">Alamat</td>
                                <td name="supir_alamat"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" style="width: 40%;">Tempat,Tanggal Lahir</td>
                                <td name="supir_ttl"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" style="width: 40%;">Telp/HP</td>
                                <td name="supir_telp"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" style="width: 40%;">Kasbon</td>
                                <td name="supir_kasbon"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" style="width: 40%;">No.KTP</td>
                                <td name="supir_ktp"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" style="width: 40%;">No.SIM</td>
                                <td name="supir_sim"></td>
                            </tr>
                            <tr>
                            <td class="font-weight-bold" style="width: 40%;">Keterangan</td>
                                <td name="supir_keterangan"></td>
                            </tr>
                            <tr >
                                <td class="font-weight-bold text-center" colspan=2>Anggota Keluarga Yang Dapat Dihubungi</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" style="width: 40%;">Nama</td>
                                <td name="darurat_nama"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" style="width: 40%;">Telp/HP</td>
                                <td name="darurat_telp"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" style="width: 40%;">Referensi</td>
                                <td name="darurat_referensi"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>         
                <div class="col">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div class="container w-50">
                                <img id="foto" alt="foto" class="img-thumbnail">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="container w-50">
                                <img id="sim" alt="sim" class="img-thumbnail">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="container w-50">
                                <img id="ktp" alt="ktp" class="img-thumbnail">
                            </div>
                        </div>
                    </div>
                </div>     
                 
            </div>
            </div>
               <!--dsini boy  -->
        </div>
    </div>
    </div>
</div>
<!-- end pop up detail supir -->
</div>

<!-- pop up detail supir -->
<div class="modal fade" id="popup-acc-edit-supir" tabindex="0" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content text-light border-light" style='background-color:#212B4E';>
            <div class="modal-header bg-primary-dark">
                <h5 class="block-title">Data Edit Driver</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times</span>
                </button>
            </div>
            <div class="font-size-sm text-justify">
            <div class="row">
                <div class="col">
                    <table class="table table-bordered text-light">
                        <tbody>
                            <tr>
                                <td class="font-weight-bold" style="width: 40%;">Nama</td>
                                <td name="supir_name_edit"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" style="width: 40%;">Alamat</td>
                                <td name="supir_alamat_edit"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" style="width: 40%;">Tempat,Tanggal Lahir</td>
                                <td name="supir_ttl_edit"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" style="width: 40%;">Telp/HP</td>
                                <td name="supir_telp_edit"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" style="width: 40%;">No.KTP</td>
                                <td name="supir_ktp_edit"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" style="width: 40%;">No.SIM</td>
                                <td name="supir_sim_edit"></td>
                            </tr>
                            <tr>
                            <td class="font-weight-bold" style="width: 40%;">Keterangan</td>
                                <td name="supir_keterangan_edit"></td>
                            </tr>
                            <tr >
                                <td class="font-weight-bold text-center" colspan=2>Anggota Keluarga Yang Dapat Dihubungi</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" style="width: 40%;">Nama</td>
                                <td name="darurat_nama_edit"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" style="width: 40%;">Telp/HP</td>
                                <td name="darurat_telp_edit"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" style="width: 40%;">Referensi</td>
                                <td name="darurat_referensi_edit"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>         
                <div class="col">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div class="container w-50">
                                <img id="foto_edit" alt="foto_edit" class="img-thumbnail">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="container w-50">
                                <img id="sim_edit" alt="sim_edit" class="img-thumbnail">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="container w-50">
                                <img id="ktp_edit" alt="ktp_edit" class="img-thumbnail">
                            </div>
                        </div>
                    </div>
                </div>     
            </div>
            <a class="btn btn-success" id="ACC">ACC</a>
            <a class="btn btn-danger" id="Tolak">Tolak</a>
        </div>
    </div>
    </div>
</div>
<!-- end pop up detail supir -->

</body>