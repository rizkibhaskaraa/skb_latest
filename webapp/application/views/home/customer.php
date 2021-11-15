<body class="mt-5" style='background-color:#182039';> 

<div class="container-fluid mt-5" style='background-color:#182039';>
    <div class="card shadow mb-4" style='background-color:#212B4E';>
    <div class="card-header" style='background-color:#212B4E';>
        <h6 class="m-0 font-weight-bold text-light float-left">Seluruh Data Customer</h6>
        <a class="btn btn-primary btn-icon-split float-right btn-sm" data-toggle='modal' data-target='#popup-customer'>
            <span class="icon text-white-100">
                <i class="fas fa-plus"></i> 
            </span>
            <span class="text">
                 Tambah Customer
            </span>
        </a>
    </div>
    <!-- tabel data cutomer -->
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-light small" id="Table-Customer" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center" scope="col">ID</th>
                        <th class="text-center" scope="col">Nama Customer</th>
                        <th class="text-center" scope="col">Alamat</th>
                        <th class="text-center" scope="col">Contact Person</th>
                        <th class="text-center" scope="col">Telp./HP</th>
                        <th class="text-center" width="9%" scope="col">Status Validasi</th>
                        <th class="text-center" width="16%" scope="col">Aksi</th>
                        <th class="text-center" width="11%" scope="col">Validasi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <!-- end tabel data cutomer -->
</div>


<!-- pop up add customer -->
<div class="modal fade mt-4" id="popup-customer" tabindex="-1" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content text-light border-light" style='background-color:#212B4E';>
            <div class="modal-header bg-primary-dark">
                <h5 class="font-weight-bold">Menambah Customer Baru</h5>
                <button class="close text-light" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="container mt-3">
                <div class="row">
                    <div class="col table-bordered rounded text-light">
                        <form action="<?= base_url("index.php/form/insert_customerMenu")?>" method="POST">
                            <input type="text" name="customer_id" id="customer_id" hidden>
                            <div class="form-group mt-1">
                                <label for="Customer" class="form-label font-weight-bold">Nama Customer</label>
                                <input autocomplete="off" type="text" class="form-control" id="Customer" name="Customer" required>
                            </div>
                            <div class="form-group">
                                <label for="customer_alamat" class="form-label font-weight-bold">Alamat</label>
                                <input autocomplete="off" type="text" class="form-control" id="customer_alamat" name="customer_alamat">
                            </div>
                            <div class="form-group">
                                <label for="customer_kontak_person" class="form-label font-weight-bold">Contact Person</label>
                                <input autocomplete="off" type="text" class="form-control" id="customer_kontak_person" name="customer_kontak_person">
                            </div>
                            <div class="form-group">
                                <label for="customer_telp" class="form-label font-weight-bold">Telp./HP</label>
                                <input autocomplete="off" type="text" class="form-control" id="customer_telp" name="customer_telp">
                            </div>
                            <div class="form-group">
                                <label for="customer_keterangan" class="form-label font-weight-bold">Keterangan</label>
                                <input autocomplete="off" type="text" class="form-control" id="customer_keterangan" name="customer_keterangan">
                            </div>
                        </div>
                        <!-- <div class="col table-bordered ml-2 rounded">
                            <div class="w-100"></div>
                            <h6 class="font-weight-bold text-center mt-2">Transfer</h6>
                            <div class="form-group">
                                <label for="customer_bank" class="form-label font-weight-bold">Bank</label>
                                <input autocomplete="off" type="text" class="form-control" id="customer_bank" name="customer_bank" required>
                            </div>
                            <div class="form-group">
                                <label for="customer_rekening" class="form-label font-weight-bold">No Rekening</label>
                                <input autocomplete="off" type="text" class="form-control" id="customer_rekening" name="customer_rekening" required>
                            </div>
                            <div class="form-group">
                                <label for="customer_AN" class="form-label font-weight-bold">Atas Nama</label>
                                <input autocomplete="off" type="text" class="form-control" id="customer_AN" name="customer_AN" required>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="form-group mt-3 mr-2 px-1">
                    <button type="submit" class="btn btn-success float-right">Simpan</button>
                </div>
                
                </form>
            </div>
        </div>
    </div>

<!-- end pop up add customer -->



<!-- pop up update customer -->
<div class="modal fade mt-4" id="popup-update-customer" tabindex="-1" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content text-light border-light" style='background-color:#212B4E';>
            <div class="modal-header bg-primary-dark">
                <h5 class="font-weight-bold">Update Customer</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="container mt-3">
                <div class="row">
                    <div class="col table-bordered text-light">
                        <form action="<?= base_url("index.php/form/update_customer")?>" method="POST" id="form-edit-customer">
                            <input type="text" name="customer_id_update" id="customer_id_update" hidden>
                            <div class="form-group mt-1">
                                <label for="customer_name_update" class="form-label font-weight-bold">Nama Customer</label>
                                <input autocomplete="off" type="text" class="form-control" id="customer_name_update" name="customer_name_update" required>
                            </div>
                            <div class="form-group">
                                <label for="customer_alamat_update" class="form-label font-weight-bold">Alamat</label>
                                <input autocomplete="off" type="text" class="form-control" id="customer_alamat_update" name="customer_alamat_update">
                            </div>
                            <div class="form-group">
                                <label for="customer_kontak_person_update" class="form-label font-weight-bold">Contact Person</label>
                                <input autocomplete="off" type="text" class="form-control" id="customer_kontak_person_update" name="customer_kontak_person_update">
                            </div>
                            <div class="form-group">
                                <label for="customer_telp_update" class="form-label font-weight-bold">Telp./HP</label>
                                <input autocomplete="off" type="text" class="form-control" id="customer_telp_update" name="customer_telp_update">
                            </div>
                            <div class="form-group">
                                <label for="customer_keterangan_update" class="form-label font-weight-bold">Keterangan</label>
                                <input autocomplete="off" type="text" class="form-control" id="customer_keterangan_update" name="customer_keterangan_update">
                            </div>
                    </div>
                    <!-- <div class="col table-bordered ml-2">
                        <div class="w-100"></div>
                        <h6 class="font-weight-bold text-center mt-2">Transfer</h6>
                        <div class="form-group">
                            <label for="customer_bank_update" class="form-label font-weight-bold">Bank</label>
                            <input autocomplete="off" type="text" class="form-control" id="customer_bank_update" name="customer_bank_update" required>
                        </div>
                        <div class="form-group">
                            <label for="customer_rekening_update" class="form-label font-weight-bold">No Rekening</label>
                            <input autocomplete="off" type="text" class="form-control" id="customer_rekening_update" name="customer_rekening_update" required>
                        </div>
                        <div class="form-group">
                            <label for="customer_AN_update" class="form-label font-weight-bold">Atas Nama</label>
                            <input autocomplete="off" type="text" class="form-control" id="customer_AN_update" name="customer_AN_update" required>
                        </div>
                    </div> -->
                </div>
                </div>
                <div class="form-group mt-3 mr-2 px-1">
                    <button type="submit" class="btn btn-success float-right">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end pop up update customer -->

<!-- pop up detail customer -->
<div class="modal fade mt-5" id="popup-detail-customer" tabindex="-1" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content text-light border-light" style='background-color:#212B4E';>
            <div class="modal-header bg-primary-dark">
                <h5 class="block-title">Detail Customer</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times</span>
                </button>
            </div>
            <div class="font-size-sm m-3 text-justify">
            <div class="">
                <div class="">
                    <table class="table table-bordered text-light">
                        <tbody>
                            <tr>
                                <td class="font-weight-bold" style="width: 20%;">Nama Customer</td>
                                <td name="customer_name"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" style="width: 20%;">Alamat</td>
                                <td name="customer_alamat"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" style="width: 20%;">Contact Person</td>
                                <td name="customer_kontak_person"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" style="width: 20%;">Telp/HP</td>
                                <td name="customer_telp"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" style="width: 20%;">Keterangan</td>
                                <td name="customer_keterangan"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- <div class="">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class="font-weight-bold text-center" colspan=2 style="width: 20%;">Transfer</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" style="width: 20%;">Bank</td>
                                <td name="customer_bank"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" style="width: 20%;">No Rekening</td>
                                <td name="customer_rekening"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" style="width: 20%;">Atas Nama</td>
                                <td name="customer_AN"></td>
                            </tr>
                        </tbody>
                    </table>
                </div> -->
            </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- end pop up detail customer -->

<div class="modal fade mt-5" id="popup-acc-edit-customer" tabindex="0" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content text-light border-light" style='background-color:#212B4E';>
            <div class="modal-header bg-primary-dark">
                <h5 class="block-title">Data Edit Customer</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times</span>
                </button>
            </div>
            <div class="font-size-sm m-3 text-justify">
            <div class="">
                <div class="">
                    <table class="table table-bordered text-light">
                        <tbody>
                            <tr>
                                <td class="font-weight-bold" style="width: 20%;">Nama Customer</td>
                                <td name="customer_name_edit"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" style="width: 20%;">Alamat</td>
                                <td name="customer_alamat_edit"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" style="width: 20%;">Contact Person</td>
                                <td name="customer_kontak_person_edit"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" style="width: 20%;">Telp/HP</td>
                                <td name="customer_telp_edit"></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold" style="width: 20%;">Keterangan</td>
                                <td name="customer_keterangan_edit"></td>
                            </tr>
                        </tbody>
                    </table>
                    <a class="btn btn-success" id="ACC">ACC</a>
                    <a class="btn btn-danger" id="Tolak">Tolak</a>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>

</body>