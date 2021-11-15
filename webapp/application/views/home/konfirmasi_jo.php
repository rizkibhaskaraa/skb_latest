<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Konfirmasi Job Order</h6>
        </div>
        <!-- tabel konfirmasi JO -->
        <div class="card-body">
            <div class="table-responsive thead-dark small">
                <table class="table table-bordered  " id="Table-Konfirmasi-Job-Order" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width ="10%" class="text-center" scope="col">No JO</th>
                            <th width ="17%" class="text-center" scope="col">Customer</th>
                            <th width ="17%" class="text-center" scope="col">Muatan</th>
                            <th width ="15%" class="text-center" scope="col">Asal</th>
                            <th width ="15%" class="text-center" scope="col">Tujuan</th>
                            <th width ="1%" class="text-center" scope="col">Tanggal</th>
                            <th width ="25%" scope="col">Konfirmasi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- end tabel konfirmasi JO -->
    </div>
</div>
<div class="modal fade mt-4 py-5" id="update_jo" tabindex="0" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary-dark">
                <h5 class="font-weight-bold">Update Status JO</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="container mt-3">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td class="font-weight-bold" style="width: 20%;">ID Job Order</td>
                                    <td name="Jo_id"></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold" style="width: 20%;">Tanggal</td>
                                    <td name="tanggal_surat"></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold" style="width: 20%;">Supir</td>
                                    <td name="supir_name"></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold" style="width: 20%;">No Polisi</td>
                                    <td name="mobil_no"></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold" style="width: 20%;">Jenis Mobil</td>
                                    <td name="mobil_jenis"></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold" style="width: 20%;">Customer</td>
                                    <td name="customer_name"></td>
                                </tr>                                <tr>
                                    <td class="font-weight-bold" style="width: 20%;">Muatan</td>
                                    <td name="muatan"></td>
                                </tr>                                <tr>
                                    <td class="font-weight-bold" style="width: 20%;">Dari</td>
                                    <td name="asal"></td>
                                </tr>                                <tr>
                                    <td class="font-weight-bold" style="width: 20%;">Ke</td>
                                    <td name="tujuan"></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold" style="width: 20%;">Total UJ</td>
                                    <td name="uang"></td>
                                </tr>
                            </tbody>
                        </table>                
                    </div>
                    <div class="col-md-6 table-borderless ">
                        <form id="form_update_jo" method="POST">
                            <input type="text" name="jo_id" id="jo_id" hidden>
                            <div class="form-group">
                                <select name="status" id="status" class="form-control custom-select " required onchange="status_jenis()">
                                    <option class="font-w700" disabled="disabled" selected value="">Status JO</option>
                                    <option value="Sampai Tujuan">Sampai Tujuan</option>
                                    <option value="Dibatalkan">Dibatalkan</option>
                                </select>
                            </div>
                            <div class="konfirmasi" style="display:none">
                                <div class="form-group">
                                    <label for="tgl_muat" class="form-label">Tanggal Muat</label>
                                    <input autocomplete="off" class="form-control" type="text" name="tgl_muat" id="tgl_muat" onclick="tanggal_berlaku(this)">    
                                </div>
                                <div class="form-group">
                                    <label for="tgl_bongkar" class="form-label">Tanggal Bongkar</label>
                                    <input autocomplete="off" class="form-control" type="text" name="tgl_bongkar" id="tgl_bongkar" onclick="tanggal_berlaku(this)">    
                                </div>
                                <div class="form-group">
                                    <label for="tonase" class="form-label">Muatan akhir (Tonase)</label>
                                    <input autocomplete="off" class="form-control" type="text" name="tonase" id="tonase" onkeyup="uang()">    
                                </div>
                                <div class="form-group">
                                    <label for="biaya_lain" class="form-label">Biaya Lain</label>
                                    <input autocomplete="off" class="form-control" type="text" name="biaya_lain" id="biaya_lain" onkeyup="uang()">    
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="Keterangan" class="form-label">Keterangan/Catatan Tambahan</label>
                                    <textarea class="form-control" name="Keterangan" rows="3"></textarea>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success float-right mb-3">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>    
</div>

<script>
    function uang(){
        $( '#tonase' ).mask('000.000.000', {reverse: true});
        // $( '#harga' ).mask('000.000.000', {reverse: true});
        $( '#biaya_lain' ).mask('000.000.000', {reverse: true});
        $( '#bonus' ).mask('000.000.000', {reverse: true});
    }
    function status_jenis(){
        var status = $("#status").val();
        if(status=="Dibatalkan"){
            $(".konfirmasi").hide();
            $("#tonase").removeAttr('required');
            // $("#harga").removeAttr('required');
            $("#bonus").removeAttr('required');
        }else{
            $(".konfirmasi").show();
            $("#tonase").attr('required','true');
            // $("#harga").attr('required','true');
            $("#bonus").attr('required','true');
        }
    }
</script>