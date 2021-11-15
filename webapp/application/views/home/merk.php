<body class="mt-5" style='background-color:#182039';> 

<div class="container-fluid mt-5 " style='background-color:#182039';>
    <div class="card shadow mb-4" >
    <div class="card-header py-3" style='background-color:#212B4E';>
        <h6 class="m-2 font-weight-bold text-light float-left" >Seluruh Data Merk</h6>
        <a class="btn btn-primary btn-icon-split float-right btn-sm" data-toggle='modal' data-target='#popup-merk'>
            <span class="icon text-white-100">
                <i class="fas fa-plus"></i> 
            </span>
            <span class="text">
                 Tambah Merk
            </span>
        </a>
    </div>
    <div class="card-body" style='background-color:#212B4E';>
        <div class="table-responsive">
            <table class="table table-bordered text-light" id="Table-Merk" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center" width="3%" scope="col">No</th>
                        <th class="text-center" width="17%" scope="col">Merk</th>
                        <th class="text-center" width="17%" scope="col">Type</th>
                        <th class="text-center" width="17%" scope="col">Jenis</th>
                        <th class="text-center" width="6%" scope="col">Dump</th>
                        <th class="text-center" width="12%" scope="col">Status Validasi</th>
                        <th class="text-center" width="8%" scope="col">Aksi</th>
                        <th class="text-center" width="10%" scope="col">Validasi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>


<!-- pop up add merk -->
<div class="modal fade mt-3 py-3 " id="popup-merk" tabindex="0" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content text-light border-light" style='background-color:#212B4E';>
            <div class="modal-header bg-primary-dark">
                <h5 class="font-weight-bold">Menambah Merk</h5>
                <button class="close text-light" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="container mb-3">
                    <form action="<?= base_url("index.php/form/insert_merk")?>" method="POST">
                        <div class="form-group ">
                            <label for="merk_nama" class="form-label font-weight-bold">Merk</label>
                            <input autocomplete="off" type="text" class="form-control" id="merk_nama" name="merk_nama" required>
                        </div>
                        <div class="form-group">
                            <label for="merk_type" class="form-label font-weight-bold">Type</label>
                            <input autocomplete="off" type="text" class="form-control" id="merk_type" name="merk_type" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label font-weight-bold" for="merk_jenis">Jenis Mobil</label>
                            <input autocomplete="off" type="text" class="form-control" name="merk_jenis" id="merk_jenis" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label font-weight-bold" for="merk_dump">Dump</label>
                            <select name="merk_dump" id="merk_dump" class="form-control custom-select" required onchange="nominal()">
                                <option class="font-w700" disabled="disabled" selected value="">Dump</option>
                                <option value="Ya">Ya</option>
                                <option value="Tidak">Tidak</option>
                            </select>
                        </div>
                        <div class="form-group mt-1 ">
                            <button type="submit" class="btn btn-success float-right">Simpan</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<!-- end pop up add merk -->

<!-- pop up update merk -->
<div class="modal fade mt-5 px-5 py-2" id="popup-update-merk" tabindex="0" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
    <div class="modal-content text-light border-light" style='background-color:#212B4E';>
            <div class="modal-header bg-primary-dark">
                <h5 class="font-weight-bold">Update Merk</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="font-size-sm ml-3 mr-3 mb-3 text-justify">
                    <form action="<?= base_url("index.php/form/update_merk")?>" method="POST" id="form-edit-merk">
                        <input autocomplete="off" type="text" class="form-control" id="merk_id_update" name="merk_id_update" required hidden>
                        <div class="form-group mt-2">
                            <label for="merk_nama_update" class="form-label font-weight-bold">Merk</label>
                            <input autocomplete="off" type="text" class="form-control" id="merk_nama_update" name="merk_nama_update" required>
                        </div>
                        <div class="form-group">
                            <label for="merk_type_update" class="form-label font-weight-bold">Type</label>
                            <input autocomplete="off" type="text" class="form-control" id="merk_type_update" name="merk_type_update" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label font-weight-bold" for="merk_jenis_update">Jenis Mobil</label>
                            <input autocomplete="off" type="text" class="form-control" name="merk_jenis_update" id="merk_jenis_update" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label font-weight-bold" for="merk_dump_update">Dump</label>
                            <select name="merk_dump_update" id="merk_dump_update" class="form-control custom-select" required onchange="nominal()">
                                <option class="font-w700" disabled="disabled" selected value="">Dump</option>
                                <option value="Ya">Ya</option>
                                <option value="Tidak">Tidak</option>
                            </select>
                        </div>
                        <div class="form-group mt-1  ">
                            <button type="submit" class="btn btn-success float-right">Simpan</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>
<!-- end pop up update merk -->

<div class="modal fade mt-3 py-3 " id="popup-acc-edit-merk" tabindex="0" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
    <div class="modal-content text-light border-light" style='background-color:#212B4E';>
            <div class="modal-header bg-primary-dark">
                <h5 class="font-weight-bold">Data Edit Merk</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="container mb-3">
                        <div class="form-group ">
                            <label for="merk_nama_edit" class="form-label font-weight-bold">Merk</label>
                            <input autocomplete="off" type="text" class="form-control" id="merk_nama_edit" name="merk_nama_edit" readonly>
                        </div>
                        <div class="form-group">
                            <label for="merk_type_edit" class="form-label font-weight-bold">Type</label>
                            <input autocomplete="off" type="text" class="form-control" id="merk_type_edit" name="merk_type_edit" readonly>
                        </div>
                        <div class="form-group">
                            <label class="form-label font-weight-bold" for="merk_jenis_edit">Jenis Mobil</label>
                            <input autocomplete="off" type="text" class="form-control" name="merk_jenis_edit" id="merk_jenis_edit" readonly>
                        </div>
                        <div class="form-group">
                            <label class="form-label font-weight-bold" for="merk_dump_edit">Dump</label>
                            <input autocomplete="off" type="text" class="form-control" name="merk_dump_edit" id="merk_dump_edit" readonly>
                        </div>
                        <a class="btn btn-success" id="ACC">ACC</a>
                        <a class="btn btn-danger" id="Tolak">Tolak</a>
            </div>
        </div>
    </div>
</div>