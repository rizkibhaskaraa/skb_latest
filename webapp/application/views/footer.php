        <!-- Footer -->
        <!-- <footer class="sticky-footer bg-dark">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span class="text-light">Copyright &copy; 2021 PT.Sumber Karya Berkah</span>
                </div>
            </div>
        </footer> -->
        <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog mt-5 py-5" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Keluar <i class="fa fa-lock"></i></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times</span>
                    </button>
                </div>

                <div class="modal-body"><i class="fa fa-question-circle"></i> Anda yakin ingin keluar?</div>
                <div class="modal-footer">
                    <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-danger" href="<?= base_url("index.php/login/logout")?>">Keluar</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="popup-ubah-password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog mt-5 py-5" role="document">
            <div class="modal-content ">
                <div class="modal-header mb-3">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Password</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times</span>
                    </button>
                </div>
                <div class="container mb-3">
                    <form action="<?= base_url('index.php/login/ubah_password')?>" method="POST" onsubmit="return cek_password();">
                        <div class="form-group row">
                            <label for="password_old" class="form-label col">Password Lama</label>
                            <input type="password" id="password_old" name="password_old" required class="form-control col">
                        </div>
                        <div class="form-group row">
                            <label for="password_new" class="form-label col">Password Baru</label>
                            <input type="password" id="password_new" name="password_new" required class="form-control col">
                        </div>
                        <div class="form-group row">
                            <label for="password_fix" class="form-label col">Konfirmasi Password Baru</label>
                            <input type="password" id="password_fix" name="password_fix" required class="form-control col">
                        </div>
                        <div class="form-group mt-1 mr-4 ">
                            <button type="submit" class="btn btn-success float-right" >Simpan</button>
                            <button type="reset" class="btn btn-outline-danger mr-3 float-md-right">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap core JavaScript-->
    <script src="<?=base_url("assets/vendor/jquery/jquery.min.js")?>"></script>
    <script src="<?=base_url("assets/vendor/jquery/jquery.mask.min.js")?>"></script>
    <script src="<?=base_url("assets/vendor/bootstrap/js/bootstrap.bundle.min.js")?>"></script>    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    
    
    <!-- Core plugin JavaScript-->
    <script src="<?=base_url("assets/vendor/jquery-easing/jquery.easing.min.js")?>"></script>
    <!-- data toggle bawah -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap4-toggle/3.6.1/bootstrap4-toggle.min.js" integrity="sha512-bAjB1exAvX02w2izu+Oy4J96kEr1WOkG6nRRlCtOSQ0XujDtmAstq5ytbeIxZKuT9G+KzBmNq5d23D6bkGo8Kg==" crossorigin="anonymous"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?=base_url("assets/js/sb-admin-2.min.js")?>"></script>

    
    

    <!-- Page level plugins -->
    <script src="<?=base_url("assets/vendor/chart.js/Chart.min.js")?>"></script>
    <script src="<?=base_url("assets/vendor/datatables/jquery.dataTables.min.js")?>"></script>
    <script src="<?=base_url("assets/vendor/datatables/dataTables.bootstrap4.min.js")?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>
    <script src="<?php echo base_url('assets/datepicker/js/bootstrap-datepicker.js')?>"></script>
    
    <!-- cek password -->
    <script>
        function cek_password(){
            password_old = $("#password_old").val();
            password_new = $("#password_new").val();
            password_fix = $("#password_fix").val();
            validasi = "false";
            $.ajax({
                type: "GET",
                url: "<?php echo base_url('index.php/login/cek_password/') ?>"+password_old+"/"+password_new+"/"+password_fix,
                dataType: "text",
                async:false,
                success: function(data) { 
                    validasi = data;
                }
            });
            if(validasi!="true"){
                if(validasi=="false lama"){
                    alert("password lama tidak sesuai");
                }else{
                    alert("password baru tidak cocok");
                }
                return false;
            }else{
                return true;
            }
        }
    </script>
    <!-- end cek password -->

    <!-- kendaraan -->
    <script> //script datatables kendaraan
        var data_truck_now = [];
        var data_truck_new = [];
        $(document).ready(function() {
            var table = null;
            table = $('#Table-Truck').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "lengthChange": false,
                "paging":false,
                "info":false,
                "order": [
                    [5, 'desc']
                ],
                "ajax": {
                    "url": "<?php echo base_url('index.php/home/view_truck/') ?>",
                    "type": "POST",
                },
                "deferRender": true,
                "columns": [
                    {
                        "data": "mobil_no",
                        className: 'text-center',
                        render: function(data, type, row) {
                            let html = row["no"];
                            return html;
                        }
                    },
                    {
                        "data": "mobil_no",
                    },
                    {
                        "data": "mobil_merk"
                    },
                    
                    {
                        "data": "mobil_type"
                    },
                    {
                        "data": "mobil_jenis"
                    },
                    {
                        "data": "mobil_dump",
                        render: function(data, type, row) {
                            if(data=="Ya"){
                                return "Dump";
                            }else{
                                return "No Dump"
                            }
                        }
                    },
                    {
                        "data": "mobil_tahun"
                    },
                    {
                        "data": "validasi",
                        className: 'text-center',
                        render: function(data, type, row) {
                            if(data=="ACC" && row['validasi_edit']=="ACC" && row['validasi_delete']=="ACC"){
                                return "<span class='small'><a class='btn btn-success rounded-pill btn-sm'><i class='fas fa-check'></i></a></span>";
                            }else{
                                return "<span class='small'><a class='btn btn-danger rounded-pill btn-sm'><i class='fas fa-exclamation'></i></a></span>";
                            }
                        }
                    },
                    {
                        "data": "mobil_no",
                        className: 'text-center font-weight-bold',
                        "orderable": false,
                        render: function(data, type, row) {
                            let html = "";
                            html += "<div class='d-flex justify-content-center'><a class='btn btn-light btn-detail-truck mr-2' href='javascript:void(0)' data-toggle='modal' data-target='#popup-kendaraan' data-pk='"+data+"'><i class='fas fa-eye'></i></a>"
                            if(row["validasi"]!="Pending" && row["validasi_edit"]!="Pending" && row["validasi_delete"]!="Pending"){
                                html += "<a class='btn btn-light btn-update-truck mr-2' href='javascript:void(0)' data-toggle='modal' data-target='#popup-update-truck' data-pk='"+data+"'><i class='fas fa-pen-square'></i></a>"+
                                "<a class='btn btn-light btn-delete-truck' href='javascript:void(0)' data-pk='"+data+"'><i class='fas fa-trash-alt'></i></a></div>";
                                return html;
                            }
                            return html;
                        }
                    },
                    {
                        "data": "mobil_no",
                        className: 'text-center font-weight-bold',
                        "orderable": false,
                        render: function(data, type, row) {
                            var role_user = "<?=$_SESSION['role']?>";
                            let html = "";
                            if(role_user=="Supervisor" || role_user=="Super User"){
                                if(row["validasi"]=="Pending"){
                                    html +="<a class='btn btn-success btn-sm btn-acc-truck mr-1' href='javascript:void(0)' data-pk='"+data+"'><i class='fas fa-check-circle'></i></a>";
                                    html +="<a class='btn btn-danger btn-sm btn-tolak-truck' href='javascript:void(0)' data-pk='"+data+"'><i class='fas fa-times'></i></a><br>";
                                }
                                if(row["validasi_edit"]=="Pending"){
                                    html += "<a class='btn btn-primary btn-sm btn-acc-edit-truck mr-2' href='javascript:void(0)' data-pk='"+data+"' data-toggle='modal' data-target='#popup-acc-edit-truck'>ACC Edit<i class='fas fa-check-circle'></i></a><br>";
                                }
                                if(row["validasi_delete"]=="Pending"){
                                    html += "<a class='btn btn-danger btn-sm btn-acc-delete-truck' href='javascript:void(0)' data-pk='"+data+"'>ACC Delete<i class='fas fa-check-circle'></i></a><br>";    
                                }
                                return html;
                            }else{
                                return "";
                            }
                        }
                    }
                ],
                drawCallback: function() {
                    $('.btn-delete-truck').click(function() {
                        let pk = $(this).data('pk');
                        Swal.fire({
                            title: 'Hapus Kendaraan',
                            text:'Yakin anda akan menghapus data kendaraan ini?',
                            showDenyButton: true,
                            denyButtonText: `Batal`,
                            denyButtonColor: '#808080',
                            confirmButtonText: 'Hapus',
                            confirmButtonColor: '#FF0000',
                            icon: "warning"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/deletetruck') ?>",
                                    dataType: "text",
                                    data: {
                                        id: pk
                                    },
                                    success: function(data) {
                                        location.reload();
                                    }
                                });
                            }
                        })
                    });
                    $('.btn-detail-truck').click(function() {
                        let pk = $(this).data('pk');
                        // alert(pk);
                        $.ajax({ //ajax ambil data bon
                            type: "GET",
                            url: "<?php echo base_url('index.php/detail/gettruck') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) { //jika ambil data sukses
                            // alert(data);
                                $('td[name="mobil_no"]').text(data["mobil_no"]); //set value
                                $('td[name="mobil_no_rangka"]').text(data["mobil_no_rangka"]); //set value
                                $('td[name="mobil_no_mesin"]').text(data["mobil_no_mesin"]); //set value
                                $('td[name="mobil_bpkb"]').text(data["mobil_bpkb"]); //set value
                                $('td[name="mobil_usaha"]').text(data["mobil_usaha"]); //set value
                                $('td[name="mobil_berlaku_usaha"]').text(change_tanggal(data["mobil_berlaku_usaha"])); //set value
                                $('td[name="mobil_jenis"]').text(data["mobil_jenis"]); //set value
                                $('td[name="status_jalan"]').text(data["status_jalan"]); //set value
                                $('td[name="mobil_max_load"]').text(data["mobil_max_load"]); //set value
                                $('td[name="mobil_keterangan"]').text(data["mobil_keterangan"]); //set value
                                $('td[name="mobil_merk"]').text(data["mobil_merk"]); //set value
                                $('td[name="mobil_type"]').text(data["mobil_type"]); //set value
                                $('td[name="mobil_dump"]').text(data["mobil_dump"]); //set value
                                $('td[name="mobil_tahun"]').text(data["mobil_tahun"]); //set value
                                $('td[name="mobil_berlaku"]').text(change_tanggal(data["mobil_berlaku"])); //set value
                                $('td[name="mobil_pajak"]').text(change_tanggal(data["mobil_pajak"])); //set value
                                $('#file_foto_detail').attr('src','<?= base_url("assets/berkas/kendaraan/")?>'+data["file_foto"]);
                                $('#file_stnk_detail').attr('src','<?= base_url("assets/berkas/kendaraan/")?>'+data["file_stnk"]);
                                $('td[name="mobil_stnk"]').text(data["mobil_stnk"]); //set value
                                $('td[name="mobil_berlaku_kir"]').text(change_tanggal(data["mobil_berlaku_kir"])); //set value
                                $('td[name="mobil_kir"]').text(data["mobil_kir"]); //set value
                                $('td[name="mobil_berlaku_ijin_bongkar"]').text(change_tanggal(data["mobil_berlaku_ijin_bongkar"])); //set value
                                $('td[name="mobil_ijin_bongkar"]').text(data["mobil_ijin_bongkar"]); //set value

                            }
                        });
                    });                    
                    $('.btn-update-truck').click(function() {
                        let pk = $(this).data('pk');
                        // alert(pk);
                        $.ajax({ //ajax ambil data bon
                            type: "GET",
                            url: "<?php echo base_url('index.php/detail/gettruck') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) { //jika ambil data sukses
                                $('#mobil_no_old').val(data["mobil_no"]);
                                $('#mobil_no_update').val(data["mobil_no"]); //set value
                                $('#mobil_no_rangka_update').val(data["mobil_no_rangka"]); //set value
                                $('#mobil_no_mesin_update').val(data["mobil_no_mesin"]); //set value
                                $('#mobil_merk_update').val(data["mobil_merk"]); //set value
                                $('#mobil_type_update').val(data["mobil_type"]); //set value
                                $('#mobil_jenis_update').val(data["mobil_jenis"]); //set value
                                $('#mobil_dump_update').val(data["mobil_dump"]); //set value
                                $('#mobil_tahun_update').val(data["mobil_tahun"]); //set value
                                $('#mobil_bpkb_update').val(data["mobil_bpkb"]); //set value
                                $('#mobil_usaha_update').val(data["mobil_usaha"]); //set value
                                $('#mobil_berlaku_usaha_update').val(change_tanggal(data["mobil_berlaku_usaha"])); //set value
                                $('#mobil_stnk_update').val(data["mobil_stnk"]); //set value
                                $('#mobil_berlaku_update').val(change_tanggal(data["mobil_berlaku"])); //set value
                                $('#mobil_pajak_update').val(change_tanggal(data["mobil_pajak"])); //set value
                                $('#mobil_kir_update').val(data["mobil_kir"]); //set value
                                $('#mobil_ijin_bongkar_update').val(data["mobil_ijin_bongkar"]); //set value
                                $('#mobil_berlaku_kir_update').val(change_tanggal(data["mobil_berlaku_kir"])); //set value
                                $('#mobil_berlaku_ijin_bongkar_update').val(change_tanggal(data["mobil_berlaku_ijin_bongkar"])); //set value
                                $('#mobil_keterangan_update').val(data["mobil_keterangan"]); //set value

                                data_truck_now = new Object();
                                data_truck_now.no=data["mobil_no"];
                                data_truck_now.rangka=data["mobil_no_rangka"];
                                data_truck_now.mesin=data["mobil_no_mesin"];
                                data_truck_now.merk=data["mobil_merk"];
                                data_truck_now.tipe=data["mobil_type"];
                                data_truck_now.jenis=data["mobil_jenis"];
                                data_truck_now.dump=data["mobil_dump"];
                                data_truck_now.tahun=data["mobil_tahun"];
                                data_truck_now.bpkb=data["mobil_bpkb"];
                                data_truck_now.usaha=data["mobil_usaha"];
                                data_truck_now.usaha1=change_tanggal(data["mobil_berlaku_usaha"]);
                                data_truck_now.stnk=data["mobil_stnk"];
                                data_truck_now.stnk1=change_tanggal(data["mobil_berlaku"]);
                                data_truck_now.pajak=change_tanggal(data["mobil_pajak"]);
                                data_truck_now.kir=data["mobil_kir"];
                                data_truck_now.ijin=data["mobil_ijin_bongkar"];
                                data_truck_now.kir1=change_tanggal(data["mobil_berlaku_kir"]);
                                data_truck_now.ijin1=change_tanggal(data["mobil_berlaku_ijin_bongkar"]);
                                data_truck_now.keterangan=data["mobil_keterangan"];
                            }
                        });
                    });
                    $('.btn-acc-truck').click(function() {
                        let pk = $(this).data('pk');
                        Swal.fire({
                            title: 'ACC Tambah Kendaraan',
                            icon: "question",
                            text: 'Yakin anda ingin ACC Data Kendaraan ini?',
                            showCancelButton:true,
                            confirmButtonText: 'ACC',
                            confirmButtonColor: '#4BB543',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/acctruck/ACC') ?>",
                                    dataType: "text",
                                    data: {
                                        id: pk
                                    },
                                    success: function(data) {
                                        location.reload();
                                    }
                                });
                            }
                        })
                    });
                    $('.btn-tolak-truck').click(function() {
                        let pk = $(this).data('pk');
                        Swal.fire({
                            title: 'Tolak Tambah Kendaraan',
                            icon: "question",
                            text: 'Yakin anda ingin Tolak Data Kendaraan ini?',
                            showCancelButton:true,
                            confirmButtonText: 'Tolak',
                            confirmButtonColor: 'red',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/acctruck/Ditolak') ?>",
                                    dataType: "text",
                                    data: {
                                        id: pk
                                    },
                                    success: function(data) {
                                        location.reload();
                                    }
                                });
                            }
                        })
                    });
                    $('.btn-acc-edit-truck').click(function() {
                        let pk = $(this).data('pk');
                        $.ajax({ //ajax ambil data bon
                            type: "GET",
                            url: "<?php echo base_url('index.php/detail/gettruck') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) { //jika ambil data sukses
                                data_temp = JSON.parse(data["temp_mobil"])
                                $('td[name="mobil_no_edit"]').text(data_temp["mobil_no"]); //set value
                                $('td[name="mobil_no_rangka_edit"]').text(data_temp["mobil_no_rangka"]); //set value
                                $('td[name="mobil_no_mesin_edit"]').text(data_temp["mobil_no_mesin"]); //set value
                                $('td[name="mobil_bpkb_edit"]').text(data_temp["mobil_bpkb"]); //set value
                                $('td[name="mobil_usaha_edit"]').text(data_temp["mobil_usaha"]); //set value
                                $('td[name="mobil_berlaku_usaha_edit"]').text(change_tanggal(data_temp["mobil_berlaku_usaha"])); //set value
                                $('td[name="mobil_jenis_edit"]').text(data_temp["mobil_jenis"]); //set value
                                $('td[name="status_jalan_edit"]').text(data["status_jalan"]); //set value
                                $('td[name="mobil_max_load_edit"]').text(data["mobil_max_load"]); //set value
                                $('td[name="mobil_keterangan_edit"]').text(data_temp["mobil_keterangan"]); //set value
                                $('td[name="mobil_merk_edit"]').text(data_temp["mobil_merk"]); //set value
                                $('td[name="mobil_type_edit"]').text(data_temp["mobil_type"]); //set value
                                $('td[name="mobil_dump_edit"]').text(data_temp["mobil_dump"]); //set value
                                $('td[name="mobil_tahun_edit"]').text(data_temp["mobil_tahun"]); //set value
                                $('td[name="mobil_berlaku_edit"]').text(change_tanggal(data_temp["mobil_berlaku"])); //set value
                                $('td[name="mobil_pajak_edit"]').text(change_tanggal(data_temp["mobil_pajak"])); //set value
                                $('#file_foto_edit').attr('src','<?= base_url("assets/berkas/kendaraan/")?>'+data_temp["file_foto"]);
                                $('#file_stnk_edit').attr('src','<?= base_url("assets/berkas/kendaraan/")?>'+data_temp["file_stnk"]);
                                $('td[name="mobil_stnk_edit"]').text(data_temp["mobil_stnk"]); //set value
                                $('td[name="mobil_berlaku_kir_edit"]').text(change_tanggal(data_temp["mobil_berlaku_kir"])); //set value
                                $('td[name="mobil_kir_edit"]').text(data_temp["mobil_kir"]); //set value
                                $('td[name="mobil_berlaku_ijin_bongkar_edit"]').text(change_tanggal(data_temp["mobil_berlaku_ijin_bongkar"])); //set value
                                $('td[name="mobil_ijin_bongkar_edit"]').text(data_temp["mobil_ijin_bongkar"]); //set value
                                mobil_no = data["mobil_no"];
                                $('.ACC').attr('id',mobil_no);
                                $('.Tolak').attr('id',mobil_no);
                            }
                        });
                    });
                    $('.btn-acc-delete-truck').click(function() {
                        let pk = $(this).data('pk');
                        Swal.fire({
                            title: 'ACC Hapus Data Kendaraan',
                            icon: "question",
                            text: 'Yakin anda ingin ACC Hapus Data Kendaraan ini?',
                            showDenyButton: true,
                            showCancelButton:true,
                            denyButtonText: `Tolak`,
                            confirmButtonText: 'ACC',
                            denyButtonColor: '#808080',
                            confirmButtonColor: '#4BB543',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/accdeletetruck/ACC') ?>",
                                    dataType: "text",
                                    data: {
                                        id: pk
                                    },
                                    success: function(data) {
                                        location.reload();
                                    }
                                });
                            }else if(result.isDenied){
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/accdeletetruck/Ditolak') ?>",
                                    dataType: "text",
                                    data: {
                                        id: pk
                                    },
                                    success: function(data) {
                                        location.reload();
                                    }
                                });
                            }
                        })
                    });
                },
            });
        });
        $( "#form-edit-truck" ).submit(function( event ) {
            data_truck_new = new Object();
            data_truck_new.no=$('#mobil_no_update').val();
            data_truck_new.rangka=$('#mobil_no_rangka_update').val();
            data_truck_new.mesin=$('#mobil_no_mesin_update').val();
            data_truck_new.merk=$('#mobil_merk_update').val();
            data_truck_new.tipe=$('#mobil_type_update').val();
            data_truck_new.jenis=$('#mobil_jenis_update').val();
            data_truck_new.dump=$('#mobil_dump_update').val();
            data_truck_new.tahun=$('#mobil_tahun_update').val();
            data_truck_new.bpkb=$('#mobil_bpkb_update').val();
            data_truck_new.usaha=$('#mobil_usaha_update').val();
            data_truck_new.usaha1=$('#mobil_berlaku_usaha_update').val();
            data_truck_new.stnk=$('#mobil_stnk_update').val();
            data_truck_new.stnk1=$('#mobil_berlaku_update').val();
            data_truck_new.pajak=$('#mobil_pajak_update').val();
            data_truck_new.kir=$('#mobil_kir_update').val();
            data_truck_new.ijin=$('#mobil_ijin_bongkar_update').val();
            data_truck_new.kir1=$('#mobil_berlaku_kir_update').val();
            data_truck_new.ijin1=$('#mobil_berlaku_ijin_bongkar_update').val();
            data_truck_new.keterangan=$('#mobil_keterangan_update').text();
            // alert(JSON.stringify(data_truck_now)+"=="+JSON.stringify(data_truck_new));
            if(JSON.stringify(data_truck_now) == JSON.stringify(data_truck_new)){
                if($("#file_foto_update").val()=="" && $("#file_STNK_update").val()==""){
                    alert( "Anda Belum Mengubah Data" );
                    return false;
                }else{
                    return true;
                }
            }else{
                return true;
            }
        });
        function acc_edit_truck(id){
            $.ajax({
                type: "GET",
                url: "<?php echo base_url('index.php/form/accedittruck/ACC') ?>",
                dataType: "text",
                data: {
                    id: id.id
                },
                success: function(data) {
                    location.reload();
                }
            });
        }
        function tolak_edit_truck(id){
            $.ajax({
                type: "GET",
                url: "<?php echo base_url('index.php/form/accedittruck/Ditolak') ?>",
                dataType: "text",
                data: {
                    id: id.id
                },
                success: function(data) {
                    location.reload();
                }
            });
        }
    </script>
    <!-- end kendaraan -->

    <!-- merk -->
    <script> //script datatables merk
        var data_merk_now = [];
        var data_merk_new = [];
        $(document).ready(function() {
            var table = null;
            table = $('#Table-Merk').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "lengthChange": false,
                "paging":false,
                "info":false,
                "order": [
                    [0, 'desc']
                ],
                "ajax": {
                    "url": "<?php echo base_url('index.php/home/view_merk/viewmerk') ?>",
                    "type": "POST",
                },
                "deferRender": true,
                "columns": [
                    {
                        "data": "merk_id",
                        className: 'text-center',
                        render: function(data, type, row) {
                            let html = row["no"];
                            return html;
                        }
                    },
                    {
                        "data": "merk_nama"
                    },
                    
                    {
                        "data": "merk_type"
                    },
                    {
                        "data": "merk_jenis"
                    },
                    
                    {
                        "data": "merk_dump",
                        className: 'text-center'
                    },
                    {
                        "data": "validasi",
                        className: 'text-center',
                        render: function(data, type, row) {
                            if(data=="ACC" && row['validasi_edit']=="ACC" && row['validasi_delete']=="ACC"){
                                return "<span class='small'><a class='btn btn-success rounded-pill btn-sm'><i class='fas fa-check'></i></a></span>";
                            }else{
                                return "<span class='small'><a class='btn btn-danger rounded-pill btn-sm'><i class='fas fa-exclamation'></i></a></span>";
                            }
                        }
                    },
                    {   
                        "data": "merk_id",
                        className: 'text-center font-weight-bold',
                        "orderable": false,
                        render: function(data, type, row) {
                            let html = "";
                            if(row["validasi"]!="Pending" && row["validasi_edit"]!="Pending" && row["validasi_delete"]!="Pending"){
                                html +="<div class='d-flex justify-content-center'><a class='btn btn-light btn-update-merk mr-2' href='javascript:void(0)' data-toggle='modal' data-target='#popup-update-merk' data-pk='"+data+"'><i class='fas fa-pen-square'></i></a>"+
                                "<a class='btn btn-light btn-delete-merk' href='javascript:void(0)' data-pk='"+data+"'><i class='fas fa-trash-alt'></i></a></div>";
                            }
                            return html;
                        }
                    },
                    {
                        "data": "merk_id",
                        className: 'text-center font-weight-bold',
                        "orderable": false,
                        render: function(data, type, row) {
                            var role_user = "<?=$_SESSION['role']?>";
                            let html = "";
                            if(role_user=="Supervisor" || role_user=="Super User"){
                                if(row["validasi"]=="Pending"){
                                    html +="<a class='btn btn-success btn-sm btn-acc-merk mr-2' href='javascript:void(0)' data-pk='"+data+"'><i class='fas fa-check-circle'></i></a>";
                                    html +="<a class='btn btn-danger btn-sm btn-tolak-merk' href='javascript:void(0)' data-pk='"+data+"'><i class='fas fa-times'></i></a><br>";
                                }
                                if(row["validasi_edit"]=="Pending"){
                                    html += "<a class='btn btn-primary btn-sm btn-acc-edit-merk' href='javascript:void(0)' data-pk='"+data+"' data-toggle='modal' data-target='#popup-acc-edit-merk'>ACC Edit <i class='fas fa-check-circle'></i></a><br>";
                                }
                                if(row["validasi_delete"]=="Pending"){
                                    html += "<a class='btn btn-danger btn-sm btn-acc-delete-merk' href='javascript:void(0)' data-pk='"+data+"'>ACC Delete <i class='fas fa-check-circle'></i></a><br>";    
                                }
                                return html;
                            }else{
                                return "";
                            }
                        }
                    }
                ],
                drawCallback: function() {
                    $('.btn-delete-merk').click(function() {
                        let pk = $(this).data('pk');
                        Swal.fire({
                            title: 'Hapus Merk',
                            text:'Yakin anda akan menghapus data Merk ini?',
                            showDenyButton: true,
                            denyButtonText: `Batal`,
                            denyButtonColor: '#808080',
                            confirmButtonText: 'Hapus',
                            confirmButtonColor: '#FF0000',
                            icon: "warning"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/deletemerk') ?>",
                                    dataType: "text",
                                    data: {
                                        id: pk
                                    },
                                    success: function(data) {
                                        location.reload();
                                    }
                                });
                            }
                        })
                    });              
                    $('.btn-update-merk').click(function() {
                        let pk = $(this).data('pk');
                        $.ajax({ //ajax ambil data bon
                            type: "GET",
                            async:false,
                            url: "<?php echo base_url('index.php/detail/getmerk') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) { //jika ambil data sukses
                                $('#merk_id_update').val(data["merk_id"]); //set value
                                $('#merk_nama_update').val(data["merk_nama"]); //set value
                                $('#merk_type_update').val(data["merk_type"]); //set value
                                $('#merk_jenis_update').val(data["merk_jenis"]); //set value
                                $('#merk_dump_update').val(data["merk_dump"]); //set value
                                data_merk_now = new Object();
                                data_merk_now.nama=data["merk_nama"];
                                data_merk_now.type=data["merk_type"];
                                data_merk_now.jenis=data["merk_jenis"];
                                data_merk_now.dump=data["merk_dump"];
                            }
                        });
                    });
                    $('.btn-acc-merk').click(function() {
                        let pk = $(this).data('pk');
                        Swal.fire({
                            title: 'ACC Tambah Merk',
                            icon: "question",
                            text: 'Yakin anda ingin ACC Data Merk ini?',
                            showCancelButton:true,
                            confirmButtonText: 'ACC',
                            confirmButtonColor: '#4BB543',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/accmerk/ACC') ?>",
                                    dataType: "text",
                                    data: {
                                        id: pk
                                    },
                                    success: function(data) {
                                        location.reload();
                                    }
                                });
                            }
                        })
                    });
                    $('.btn-tolak-merk').click(function() {
                        let pk = $(this).data('pk');
                        Swal.fire({
                            title: 'Tolak Tambah Merk',
                            icon: "question",
                            text: 'Yakin anda ingin Tolak Data Merk ini?',
                            showCancelButton:true,
                            confirmButtonText: 'Tolak',
                            confirmButtonColor: 'red',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/accmerk/Ditolak') ?>",
                                    dataType: "text",
                                    data: {
                                        id: pk
                                    },
                                    success: function(data) {
                                        location.reload();
                                    }
                                });
                            }
                        })
                    });
                    $('.btn-acc-edit-merk').click(function() {
                        let pk = $(this).data('pk');
                        $.ajax({ //ajax ambil data bon
                            type: "GET",
                            url: "<?php echo base_url('index.php/detail/getmerk') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) { //jika ambil data sukses
                                data_temp = JSON.parse(data["temp_merk"]);
                                $('#merk_nama_edit').val(data_temp["merk_nama"]); //set value
                                $('#merk_type_edit').val(data_temp["merk_type"]); //set value
                                $('#merk_jenis_edit').val(data_temp["merk_jenis"]); //set value
                                $('#merk_dump_edit').val(data_temp["merk_dump"]); //set value
                                $('#ACC').attr('onclick','acc_edit_merk('+data["merk_id"]+')');
                                $('#Tolak').attr('onclick','tolak_edit_merk('+data["merk_id"]+')');
                            }
                        });
                    });
                    $('.btn-acc-delete-merk').click(function() {
                        let pk = $(this).data('pk');
                        Swal.fire({
                            title: 'ACC Hapus Data Merk',
                            icon: "question",
                            text: 'Yakin anda ingin ACC Hapus Data Merk ini?',
                            showDenyButton: true,
                            showCancelButton:true,
                            denyButtonText: `Tolak`,
                            confirmButtonText: 'ACC',
                            denyButtonColor: '#808080',
                            confirmButtonColor: '#4BB543',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/accdeletemerk/ACC') ?>",
                                    dataType: "text",
                                    data: {
                                        id: pk
                                    },
                                    success: function(data) {
                                        location.reload();
                                    }
                                });
                            }else if(result.isDenied){
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/accdeletemerk/Ditolak') ?>",
                                    dataType: "text",
                                    data: {
                                        id: pk
                                    },
                                    success: function(data) {
                                        location.reload();
                                    }
                                });
                            }
                        })
                    });
                },
                
            });
        });
        $( "#form-edit-merk" ).submit(function( event ) {
            data_merk_new = new Object();
            data_merk_new.nama=$("#merk_nama_update").val();
            data_merk_new.type=$("#merk_type_update").val();
            data_merk_new.jenis=$("#merk_jenis_update").val();
            data_merk_new.dump=$("#merk_dump_update").val();
            if(JSON.stringify(data_merk_now) == JSON.stringify(data_merk_new)){
                alert( "Anda Belum Mengubah Data" );
                return false;
            }else{
                return true;
            }
        });
        function acc_edit_merk(id){
            $.ajax({
                type: "GET",
                url: "<?php echo base_url('index.php/form/acceditmerk/ACC') ?>",
                dataType: "text",
                data: {
                    id: id
                },
                success: function(data) {
                    location.reload();
                }
            });
        }
        function tolak_edit_merk(id){
            $.ajax({
                type: "GET",
                url: "<?php echo base_url('index.php/form/acceditmerk/Ditolak') ?>",
                dataType: "text",
                data: {
                    id: id
                },
                success: function(data) {
                    location.reload();
                }
            });
        }
     </script>
    <!-- end merk -->

    <!-- pilih merk -->
    <script> //script datatables merk
        $(document).ready(function() {
            var table = null;
            table = $('#Table-Pilih-Merk').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [0, 'asc']
                ],
                "ajax": {
                    "url": "<?php echo base_url('index.php/home/view_merk/addtruck') ?>",
                    "type": "POST",
                },
                "deferRender": true,
                "aLengthMenu": [
                    [10, 30, 50, 100],
                    [10, 30, 50, 100]
                ],
                "columns": [
                    {
                        "data": "merk_id",
                        render: function(data, type, row) {
                            let html = row["no"];
                            return html;
                        }
                    },
                    {
                        "data": "merk_nama"
                    },
                    
                    {
                        "data": "merk_type"
                    },
                    {
                        "data": "merk_jenis"
                    },
                    
                    {
                        "data": "merk_dump"
                    },
                    {
                        "data": "merk_id",
                        className: 'text-center font-weight-bold',
                        "orderable": false,
                        render: function(data, type, row) {
                            let html ="<a class='btn btn-light btn-pilih-merk' href='javascript:void(0)' data-pk='"+data+"'>Pilih <i class='fas fa-check-circle'></i></a>";
                            return html;
                        }
                    }
                ],
                drawCallback: function() {
                    $('.btn-pilih-merk').click(function() {
                        let pk = $(this).data('pk');
                        $.ajax({ //ajax ambil data bon
                            type: "GET",
                            url: "<?php echo base_url('index.php/detail/getmerk') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) { //jika ambil data sukses
                                $('#merk_id').val(data["merk_id"]); //set value
                                $('#mobil_type').val(data["merk_type"]); //set value
                                $('#mobil_merk').val(data["merk_nama"]); //set value
                                $('#mobil_jenis').val(data["merk_jenis"]); //set value
                                $('#mobil_dump').val(data["merk_dump"]); //set value
                            }
                        });
                    });
                },
                
            });
        });
    </script>
    <!-- end pilih merk -->

    <!-- pilih merk -->
    <script> //script datatables merk
        $(document).ready(function() {
            var table = null;
            table = $('#Table-Pilih-Merk-Edit').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [0, 'asc']
                ],
                "ajax": {
                    "url": "<?php echo base_url('index.php/home/view_merk/addtruck') ?>",
                    "type": "POST",
                },
                "deferRender": true,
                "aLengthMenu": [
                    [10, 30, 50, 100],
                    [10, 30, 50, 100]
                ],
                "columns": [
                    {
                        "data": "merk_id",
                        render: function(data, type, row) {
                            let html = row["no"];
                            return html;
                        }
                    },
                    {
                        "data": "merk_nama"
                    },
                    
                    {
                        "data": "merk_type"
                    },
                    {
                        "data": "merk_jenis"
                    },
                    
                    {
                        "data": "merk_dump"
                    },
                    {
                        "data": "merk_id",
                        className: 'text-center font-weight-bold',
                        "orderable": false,
                        render: function(data, type, row) {
                            let html ="<a class='btn btn-light btn-pilih-merk-edit' href='javascript:void(0)' data-pk='"+data+"'>Pilih <i class='fas fa-check-circle'></i></a>";
                            return html;
                        }
                    }
                ],
                drawCallback: function() {
                    $('.btn-pilih-merk-edit').click(function() {
                        let pk = $(this).data('pk');
                        $.ajax({ //ajax ambil data bon
                            type: "GET",
                            url: "<?php echo base_url('index.php/detail/getmerk') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) { //jika ambil data sukses
                                $('#merk_id_update').val(data["merk_id"]); //set value
                                $('#mobil_type_update').val(data["merk_type"]); //set value
                                $('#mobil_merk_update').val(data["merk_nama"]); //set value
                                $('#mobil_jenis_update').val(data["merk_jenis"]); //set value
                                $('#mobil_dump_update').val(data["merk_dump"]); //set value
                            }
                        });
                    });
                },
                
            });
        });
    </script>
    <!-- end pilih merk -->

    <!-- JO -->
    <script> //script datatables job order
        $(document).ready(function() {
            var table = null;
            table = $('#Table-Job-Order').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "searching": false,
                "order": [
                    [0, 'desc']
                ],
                "ajax": {
                    "url": "<?php echo base_url('index.php/home/view_JO/') ?>",
                    "type": "POST",
                    'data': function(data) {
                        data.Status = $('#Status').val();
                        data.Supir = $('#Supir').val();
                        data.Kendaraan = $('#Kendaraan').val();
                        data.Jenis = $('#Jenis').val();
                        data.Customer = $('#Customer').val();
                        data.Jo_id = $('#Jo_id').val();
                        data.Tanggal1 = $('#Tanggal1').val();
                        data.Tanggal2 = $('#Tanggal2').val();
                    }
                },
                "deferRender": true,
                "aLengthMenu": [
                    [50, 100],
                    [50, 100]
                ],
                "columns": [
                    {
                        "data": "Jo_id",
                        className: 'text-center'
                    },
                    {
                        "data": "tanggal_surat",
                        render: function(data, type, row) {
                            return change_tanggal(data);
                        }
                    },
                    {
                        "data": "status",
                        className: 'text-center',
                        "orderable": false,
                        render: function(data, type, row) {
                            let html = "";
                                    if(<?= $_SESSION["update_jo"]?>==0){
                                        if(data=="Dalam Perjalanan"){
                                            html += "<a class='btn btn-warning btn-sm btn-alert-update-jo'>ONGOING</a>";
                                        }else{
                                            html += "<a class='btn btn-success btn-sm'>DONE</a>";
                                        }
                                    }else{
                                        if(data=="Dalam Perjalanan"){
                                            if(row["sisa"]==0){
                                                html += "<a class='btn btn-warning btn-sm' href='<?= base_url('index.php/form/konfirmasi_jo/"+row["Jo_id"]+"')?>'>ONGOING</a>";
                                            }else{
                                                html += "<a class='btn btn-warning btn-sm btn-alert-update-jo-1'>ONGOING</a>";
                                            }
                                        }else{
                                            html += "<a class='btn btn-success btn-sm'>DONE</a>";
                                        }
                                    }
                            return html;
                        }
                    },
                    {
                        "data": "supir_name",
                        className: 'text-center'
                    },
                    {
                        "data": "mobil_no",
                        className: 'text-center'
                    },
                    {
                        "data": "mobil_jenis",
                        className: 'text-center'
                    },
                    {
                        "data": "customer_name",
                        className: 'text-center'
                    },
                    {
                        "data": "muatan",
                    },
                    {
                        "data": "asal",
                    },
                    {
                        "data": "tujuan",
                    },
                    {
                        "data": "uang_total",
                        render: function(data, type, row) {
                            return "Rp."+rupiah(data);
                        }
                    },
                    {
                        "data": "sisa",
                        render: function(data, type, row) {
                            return "Rp."+rupiah(data);
                        }
                    },
                    {
                        "data": "biaya_lain",
                        render: function(data, type, row) {
                            if(data!=null){
                                return "Rp."+rupiah(data);
                            }else{
                                return "Rp.0";
                            }
                        }
                    },
                    {
                        "data": "Jo_id",
                        className: 'text-center',
                        "orderable": false,
                        render: function(data, type, row) {
                            let html = "";
                                    if(<?= $_SESSION["payment_jo"]?>==0){
                                        html += "<a class='btn btn-light btn-sm btn-alert-payment-jo'><i class='fas fa-file-invoice-dollar'></i></a>";
                                    }else{
                                        html += "<a class='btn btn-light btn-sm' href='<?= base_url('index.php/payment/payment_jo/"+data+"')?>'><i class='fas fa-file-invoice-dollar'></i></a>";
                                    }
                            return html;
                        }
                    },
                    {
                        "data": "Jo_id",
                        className: 'text-center',
                        "orderable": false,
                        render: function(data, type, row) {
                            var role_user = "<?=$_SESSION['role']?>";
                            let html = "";
                            html += "<a class='btn btn-light btn-sm' target='_blank' href='<?= base_url('index.php/detail/detail_jo/"+data+"/JO')?>'><i class='fas fa-eye'></i></a>";
                            if(role_user=="Supervisor"){
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/detail/getnumpaymentjo') ?>",
                                    dataType: "text",
                                    async:false,
                                    data: {
                                        id : data,
                                    },
                                    success: function(data_hasil) { //jika ambil data_hasil sukses
                                        // if(data_hasil>0){
                                            // html += "<a class='btn btn-light btn-alert-edit-jo' href='javascript:void(0)' data-pk="+data+"><i class='fas fa-pen-square'></i></a>";
                                        // }else{
                                                // html += "<a class='btn btn-light btn-update-jo' data-toggle='modal' data-target='#popup-update-jo' href='javascript:void(0)' data-pk="+data+"><i class='fas fa-pen-square'></i></a>";
                                            html += "<a class='btn btn-light btn-sm ml-1 mr-1' href='<?= base_url('index.php/form/edit_jo/')?>"+data+"'><i class='fas fa-pen-square'></i></a>";
                                        // }
                                    }
                                })
                                
                                html += "<a class='btn btn-light btn-delete-jo btn-sm' href='javascript:void(0)' data-pk="+data+"><i class='fas fa-trash-alt'></i></a>";
                            }
                            return html;
                        }
                    }
                ],   
                drawCallback: function() {
                    $('.btn-delete-jo').click(function() {
                        let pk = $(this).data('pk');
                        $.ajax({
                            type: "GET",
                            url: "<?php echo base_url('index.php/detail/getnumpaymentjo') ?>",
                            dataType: "text",
                            data: {
                                id : pk,
                            },
                            success: function(data) { //jika ambil data sukses
                                if(data>0){
                                    Swal.fire({
                                        title: 'Hapus Data Job Order',
                                        text:'Maaf Job Order Ini Sudah Melakukan Pembayaran',
                                        icon: "warning",
                                        time: 2000
                                    })
                                }else{
                                    Swal.fire({
                                        title: 'Hapus Data Job Order',
                                        text:'Yakin Anda Ingin Menghapus Data Job Order Ini?',
                                        showDenyButton: true,
                                        denyButtonText: `Batal`,
                                        confirmButtonText: 'Hapus',
                                        denyButtonColor: '#808080',
                                        confirmButtonColor: '#FF0000',
                                        icon: "warning",
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.replace("<?= base_url('index.php/form/deletejo/')?>"+pk);
                                        }
                                    })
                                }
                            }
                        })
                    });
                    $('.btn-update-jo').click(function() {
                        let pk = $(this).data('pk');
                        $.ajax({ //ajax ambil data bon
                            type: "GET",
                            url: "<?php echo base_url('index.php/detail/getjokonfirmasi') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) { //jika ambil data sukses
                                    $("#Jo_id_update").val(data["Jo_id"]);
 
                                    $("#Kendaraan_update").val(data["mobil_no"]);
                                    $("#Supir_update").val(data["supir_name"]);

                                    $("#Jenis_update").val(data["mobil_jenis"]);
                                    $("#tanggal_jo_update").val(change_tanggal(data["tanggal_surat"]));
                                    var keterangan = data["keterangan"].split("===");
                                    $("#Keterangan_update").text(keterangan[0].replaceAll("<br>",""));
                                    $("#Keterangan_status_update").text(keterangan[1].replaceAll("<br>",""));
                                    $("#jenis_tambahan_update").val(data["jenis_tambahan"]);
                                    $("#nominal_tambahan_update").val(data["nominal_tambahan"]);
                                    $("#uang_jalan_total_update").val(rupiah(data["uang_total"]));
                                    $("#status_update").val(data["status"]);
                                    if(data["status"]!="Dalam Perjalanan"){
                                        $(".konfirmasi").show();
                                    }else{
                                        $(".konfirmasi").hide();
                                    }
                                    $("#tgl_muat_update").val(change_tanggal(data["tanggal_muat"]));
                                    $("#tgl_bongkar_update").val(change_tanggal(data["tanggal_bongkar"]));
                                    $("#tonase_update").val(data["tonase"]);
                                    $("#Muatan").val(data["muatan"]);
                                    $("#Asal").val(data["asal"]);
                                    $("#Tujuan").val(data["tujuan"]);
                                    $("#Uang_update").val(rupiah(data["uang_jalan"]));
                                    $("#Customer_update").val(data["customer_name"]);
                                    $("#biaya_lain_update").val(rupiah(data["biaya_lain"]));
                            }
                        });
                    });
                    $('.btn-alert-payment-jo').click(function() {
                        Swal.fire({
                            title: 'Pembayaran Job Order',
                            text:'Maaf Anda Tidak Memiliki Akses Untuk Melakukan Pembayaran',
                            icon: "warning",
                            time: 2000
                        })
                    });
                    $('.btn-alert-update-jo').click(function() {
                        Swal.fire({
                            title: 'Ubah Status Job Order',
                            text:'Maaf Anda Tidak Memiliki Akses Untuk Melakukan Ubah Status',
                            icon: "warning",
                            time: 2000
                        })
                    });
                    $('.btn-alert-update-jo-1').click(function() {
                        Swal.fire({
                            title: 'Ubah Status Job Order',
                            text:'Maaf Uang Jalan Job Order Masih Belum Lunas',
                            icon: "warning",
                            time: 2000
                        })
                    });
                    $('.btn-alert-edit-jo').click(function() {
                        Swal.fire({
                            title: 'Edit Data Job Order',
                            text:'Maaf Job Order Ini Sudah Melakukan Pembayaran',
                            icon: "warning",
                            time: 2000
                        })
                    });
                },
            });
            $("#btn-cari").click(function() {
                table.ajax.reload();
            });
        });
    </script>
    <!-- end JO -->

    <!-- konfirmasi JO -->
    <script> //script datatables konfirmasi job order
        $(document).ready(function() {
            var table = null;
            table = $('#Table-Konfirmasi-Job-Order').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [0, 'desc']
                ],
                "ajax": {
                    "url": "<?php echo base_url('index.php/home/view_konfirmasi_JO/') ?>",
                    "type": "POST"
                },
                "deferRender": true,
                "aLengthMenu": [
                    [50, 100],
                    [50, 100]
                ],
                "columns": [
                    {
                        "data": "Jo_id",
                        className: 'text-center'
                    },
                    {
                        "data": "customer_name",
                        className: 'text-center'
                    },
                    {
                        "data": "muatan",
                    },
                    {
                        "data": "asal",
                    },
                    {
                        "data": "tujuan",
                    },
                    {
                        "data": "tanggal_surat",
                        render: function(data, type, row) {
                            return change_tanggal(data);
                        }
                    },
                    {
                        "data": "status",
                        className: 'text-center',
                        "orderable": false,
                            render: function(data, type, row) {
                                    let html = "<a class='btn btn-block btn-sm btn-outline-warning btn-update-jo' data-pk='"+row['Jo_id']+"' data-toggle='modal' data-target='#update_jo' ><i class='fa fa-fw fa-exclamation-circle mr-2'></i>" + data + "</a>";
                                    return html;
                            }
                    },
                ],
                drawCallback: function() {
                    $('.btn-update-jo').click(function() {
                        let pk = $(this).data('pk');
                        $('#jo_id').val(pk); //set value
                        $.ajax({ //ajax ambil data bon
                            type: "GET",
                            url: "<?php echo base_url('index.php/detail/getjokonfirmasi') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) { //jika ambil data sukses
                                $('td[name="customer_name"]').text(data["customer_name"]); //set value
                                $('td[name="Jo_id"]').text(data["Jo_id"]); //set value
                                $('td[name="supir_name"]').text(data["supir_name"]); //set value
                                $('td[name="mobil_no"]').text(data["mobil_no"]); //set value
                                $('td[name="mobil_jenis"]').text(data["mobil_jenis"]); //set value
                                $('td[name="tanggal_surat"]').text(change_tanggal(data["tanggal_surat"])); //set value
                                $('td[name="muatan"]').text(data["muatan"]); //set value
                                $('td[name="asal"]').text(data["asal"]); //set value
                                $('td[name="tujuan"]').text(data["tujuan"]); //set value
                                $('td[name="uang"]').text("Rp."+rupiah(data["uang_total"])); //set value
                                $("#tgl_muat").val(change_tanggal(data["tanggal_muat"]));
                                $("#tgl_bongkar").val(change_tanggal(data["tanggal_bongkar"]));
                                $("#tonase").val(data["tonase"]);
                                $("#biaya_lain").val(rupiah(data["biaya_lain"]));
                                $("#form_update_jo").attr('action','<?php echo base_url("index.php/form/update_jo_status/")?>'+data['supir_id']+'/'+data['mobil_no'])
                            }
                        });
                    });
                },
            });
        });
    </script>
    <!-- end konfirmasi JO -->

    <!-- bon -->
    <script> //script datatables bon
        var data_bon_now = [];
        var data_bon_new = [];
        $(document).ready(function() {
            var table = null;
            table = $('#Table-Bon').DataTable({
                language: {
                    searchPlaceholder: "Nomor Bon/Nama Supir"
                },
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "dom":"lpftrip",
                "searching":false,
                "order": [
                    [0, 'desc']
                ],
                "ajax": {
                    "url": "<?php echo base_url('index.php/home/view_bon/') ?>",
                    "type": "POST",
                    "data":function(data){
                        data.Status = $('#Status').val();
                        data.Supir = $('#Supir').val();
                        data.Tanggal1 = $('#Tanggal1').val();
                        data.Tanggal2 = $('#Tanggal2').val();
                        data.No_Bon1 = $('#No_Bon1').val();
                        data.No_Bon2 = $('#No_Bon2').val();
                        data.No_Bon3 = $('#No_Bon3').val();
                        data.No_Bon4 = $('#No_Bon4').val();
                    }
                },
                "deferRender": true,
                "aLengthMenu": [
                    [50, 100],
                    [50, 100]
                ],
                "columns": [
                    {
                        "data": "bon_tanggal",
                        className: 'text-center',
                        render: function(data, type, row) {
                            var data_tanggal = data.split("-");
                            var tanggal = data_tanggal[2]+"-"+data_tanggal[1]+"-"+data_tanggal[0];
                            return tanggal;
                        }
                    },
                    {
                        "data": "bon_id",
                        className: 'text-center'
                    },
                    {
                        "data": "supir_name"
                    },
                    {
                        "data": "bon_jenis",
                        "orderable": true,
                            render: function(data, type, row) {
                                if (data == "Pembayaran" || data == "Potong Gaji") {
                                    let html = "<span class='btn-sm btn-block btn btn-success active'><i class='fa fa-fw fa-check mr-2'></i>" + data + "</span>";
                                    return html;
                                } else if (data == "Pengajuan"){
                                    let html = "<span class='btn-sm btn-block btn btn-warning active'><i class='fa fa-fw fa-exclamation-circle mr-2'></i>" + data + "</span>";
                                    return html;
                                }else {
                                    let html = "<span class='btn-sm btn-block btn btn-danger active'><i class='fa fa-fw fa-exclamation-circle mr-2'></i>" + data + "</span>";
                                    return html;
                                }
                            }
                    },
                    {
                        "data": "bon_nominal",
                        render: function(data, type, row) {
                            let html = 'Rp.'+rupiah(data);
                            return html;
                        }
                    },
                    {
                        "data": "bon_id",
                        "orderable": false,
                        className: 'text-center',
                        render: function(data, type, row) {
                        let html = "<a class='btn btn-light btn-detail-bon' href='javascript:void(0)' data-toggle='modal' data-target='#popup-bon' data-pk='"+data+"'><i class='fas fa-eye'></i></a>";
                            return html;
                        }
                    },
                    {
                        "data": "bon_id",
                        className: 'text-center',
                        "orderable": false,
                        render: function(data, type, row) {
                            var role_user = "<?=$_SESSION['role']?>";
                            let html = "";
                            if(role_user=="Supervisor"){
                                html += "<a class='btn btn-light btn-update-bon mr-2' data-toggle='modal' data-target='#popup-update-bon' href='javascript:void(0)' data-pk="+data+"><i class='fas fa-pen-square'></i></a>"+
                                "<a class='btn btn-light btn-delete-bon' href='javascript:void(0)' data-pk="+data+"><i class='fas fa-trash-alt'></i></a>";
                            }
                            return html;
                        }
                    },
                ],
                drawCallback: function() {
                    $('.btn-detail-bon').click(function() {
                        let pk = $(this).data('pk');
                        // alert(pk);
                        $.ajax({ //ajax ambil data bon
                            type: "GET",
                            url: "<?php echo base_url('index.php/detail/getbon') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) { //jika ambil data sukses
                                $('td[name="id"]').text(data["bon_id"]); //set value
                                $('td[name="supir"]').text(data["supir_name"]); //set value
                                $('td[name="jenis"]').text(data["bon_jenis"]); //set value
                                $('td[name="nominal"]').text("Rp."+rupiah(data["bon_nominal"])); //set value
                                nominal = rupiah(data["bon_nominal"]);
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/generate_terbilang_fix/') ?>"+nominal,
                                    dataType: "text",
                                    success: function(data) {
                                        $('td[name="terbilang"]').text(data);
                                    }
                                });
                                var data_tanggal = data["bon_tanggal"].split("-");
                                var tanggal = data_tanggal[2]+"-"+data_tanggal[1]+"-"+data_tanggal[0];
                                $('td[name="tanggal"]').text(tanggal); //set value
                                $('td[name="keterangan"]').text(data["bon_keterangan"]); //set value
                                $('td[name="pembayaran_upah_id"]').text(data["pembayaran_upah_id"]); //set value
                                $('td[name="operator"]').text(data["user"]); //set value
                                $('#link_print_bon').attr('href','<?= base_url("index.php/print_berkas/print_bon/")?>'+data["bon_id"]);
                            }
                        });
                    });
                    $('.btn-delete-bon').click(function() {
                        let pk = $(this).data('pk');
                        Swal.fire({
                            title: 'Hapus Data Bon',
                            text:'Yakin Anda Ingin Menghapus Data Bon Ini?',
                            showDenyButton: true,
                            denyButtonText: `Batal`,
                            confirmButtonText: 'Hapus',
                            denyButtonColor: '#808080',
                            confirmButtonColor: '#FF0000',
                            icon: "warning",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/deletebon') ?>",
                                    dataType: "text",
                                    data: {
                                        id: pk
                                    },
                                    success: function(data) {
                                        // alert(data);
                                        location.reload();
                                    }
                                });
                            }
                        })
                    });
                    $('.btn-update-bon').click(function() {
                        let pk = $(this).data('pk');
                        // alert(pk);
                        $.ajax({ //ajax ambil data bon
                            type: "GET",
                            url: "<?php echo base_url('index.php/detail/getbon') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) { //jika ambil data sukses
                                $("#bon_edit").val(data["bon_id"]);//
                                $("#Supir_edit").val(data["supir_name"]);//
                                $("#Tanggal_edit").val(change_tanggal(data["bon_tanggal"]));
                                $("#Jenis_edit").val(data["bon_jenis"]);
                                $("#Nominal_edit").val(rupiah(data["bon_nominal"]));
                                $("#Keterangan_edit").val(data["bon_keterangan"]);
                                data_bon_now = new Object();
                                data_bon_now.tanggal=change_tanggal(data["bon_tanggal"]);
                                data_bon_now.jenis=data["bon_jenis"];
                                data_bon_now.nominal=rupiah(data["bon_nominal"]);
                                data_bon_now.keterangan=data["bon_keterangan"];
                            }
                        });
                    });
                }
            });
            $( "#form-edit-bon" ).submit(function( event ) {
                data_bon_new = new Object();
                data_bon_new.tanggal=$("#Tanggal_edit").val();
                data_bon_new.jenis=$("#Jenis_edit").val();
                data_bon_new.nominal=$("#Nominal_edit").val();
                data_bon_new.keterangan=$("#Keterangan_edit").val();
                if(JSON.stringify(data_bon_now) == JSON.stringify(data_bon_new)){
                    alert( "Anda Belum Mengubah Data" );
                    return false;
                }else{
                    return true;
                }
            });
            $("#btn-cari-bon").click(function() {
                if($('#Tanggal1').val()==""){
                    if($('#Tanggal2').val()!=""){
                        alert("Silakan Isi Kedua Tgl. Nota Kasbon / Tidak Diisi Keduanya");
                        $('#Tanggal1').val("");
                        $('#Tanggal2').val("");
                    }else{
                        table.ajax.reload();
                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url('index.php/home/getditemukanbon') ?>",
                            dataType: "text",
                            data: {
                                Status : $('#Status').val(),
                                Supir : $('#Supir').val(),
                                Tanggal1 : $('#Tanggal1').val(),
                                Tanggal2 : $('#Tanggal2').val(),
                                No_Bon1 : $('#No_Bon1').val(),
                                No_Bon2 : $('#No_Bon2').val(),
                                No_Bon3 : $('#No_Bon3').val(),
                                No_Bon4 : $('#No_Bon4').val(),
                            },
                            success: function(data) { //jika ambil data sukses
                                $("#ditemukan").text(data);
                            }
                        });
                    }
                }else if($('#Tanggal2').val()==""){
                    if($('#Tanggal1').val()!=""){
                        alert("Silakan Isi Kedua Tgl. Nota Kasbon / Tidak Diisi Keduanya");
                        $('#Tanggal1').val("");
                        $('#Tanggal2').val("");
                    }else{
                        table.ajax.reload();
                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url('index.php/home/getditemukanbon') ?>",
                            dataType: "text",
                            data: {
                                Status : $('#Status').val(),
                                Supir : $('#Supir').val(),
                                Tanggal1 : $('#Tanggal1').val(),
                                Tanggal2 : $('#Tanggal2').val(),
                                No_Bon1 : $('#No_Bon1').val(),
                                No_Bon2 : $('#No_Bon2').val(),
                                No_Bon3 : $('#No_Bon3').val(),
                                No_Bon4 : $('#No_Bon4').val(),
                            },
                            success: function(data) { //jika ambil data sukses
                                $("#ditemukan").text(data);
                            }
                        });
                    }
                }
            });
        });
    </script>
    <!-- end bon -->

    <!-- Customer -->
    <script> //script datatables customer
        var data_customer_now = [];
        var data_customer_new = [];
        $(document).ready(function() {
            var table = null;
            table = $('#Table-Customer').DataTable({
                language: {
                    searchPlaceholder: "Nama Customer"
                },
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "lengthChange": false,
                "paging":false,
                "info":false,
                "order": [
                    [0, 'desc']
                ],
                "ajax": {
                    "url": "<?php echo base_url('index.php/home/view_Customer/viewcustomer') ?>",
                    "type": "POST",
                    
                },
                "deferRender": true,
                "columns": [
                    {
                        "data": "customer_id",
                        className: 'text-center',
                        render: function(data, type, row) {
                            let html = row["nomor"];
                            return html;
                        }
                    },
                    {
                        "data": "customer_name"
                    },
                    {
                        "data": "customer_alamat"
                    },
                    {
                        "data": "customer_kontak_person"    
                    },
                    {
                        "data": "customer_telp"
                    },
                    {
                        "data": "validasi",
                        className: 'text-center',
                        render: function(data, type, row) {
                            if(data=="ACC" && row['validasi_edit']=="ACC" && row['validasi_delete']=="ACC"){
                                return "<span class='small'><a class='btn btn-success rounded-pill btn-sm'><i class='fas fa-check'></i></a></span>";
                            }else{
                                return "<span class='small'><a class='btn btn-danger rounded-pill btn-sm'><i class='fas fa-exclamation'></i></a></span>";
                            }
                        }
                    },
                    {
                        "data": "customer_id",
                        className: 'text-center',
                        "orderable": false,
                        render: function(data, type, row) {
                            var role_user = "<?=$_SESSION['role']?>";
                            let html = "";
                            html += "<div class='d-flex justify-content-center'><a class='btn btn-light btn-detail-customer mr-1' href='javascript:void(0)' data-toggle='modal' data-target='#popup-detail-customer' data-pk='"+data+"'><i class='fas fa-eye'></i></a>";
                            if(row["validasi"]!="Pending" && row["validasi_edit"]!="Pending" && row["validasi_delete"]!="Pending"){
                                html += "<a class='btn btn-light btn-update-customer mr-1' data-toggle='modal' data-target='#popup-update-customer' href='javascript:void(0)' data-pk="+data+"><i class='fas fa-pen-square'></i></a>"+
                                "<a class='btn btn-light btn-delete-customer' href='javascript:void(0)' data-pk="+data+"><i class='fas fa-trash-alt'></i></a></div>";
                                return html;
                            }
                            return html;
                        }
                    },
                    {
                        "data": "customer_id",
                        className: 'text-center',
                        "orderable": false,
                        render: function(data, type, row) {
                            var role_user = "<?=$_SESSION['role']?>";
                            let html = "";
                            if(role_user=="Supervisor" || role_user=="Super User"){
                                if(row["validasi"]=="Pending"){
                                    html +="<a class='btn btn-success btn-sm btn-acc-customer mr-1' href='javascript:void(0)' data-pk='"+data+"'><i class='fas fa-check-circle'></i></a>";
                                    html +="<a class='btn btn-danger btn-sm btn-tolak-customer' href='javascript:void(0)' data-pk='"+data+"'><i class='fas fa-times'></i></a><br>";
                                }
                                if(row["validasi_edit"]=="Pending"){
                                    html += "<a class='btn btn-primary btn-sm btn-acc-edit-customer' href='javascript:void(0)' data-pk='"+data+"' data-toggle='modal' data-target='#popup-acc-edit-customer'>ACC Edit<i class='fas fa-check-circle'></i></a><br>";
                                }
                                if(row["validasi_delete"]=="Pending"){
                                    html += "<a class='btn btn-danger btn-sm btn-acc-delete-customer' href='javascript:void(0)' data-pk='"+data+"'>ACC Delete<i class='fas fa-check-circle'></i></a><br>";    
                                }
                                return html;
                            }else{
                                return "";
                            }
                        }
                    }
                ],
                drawCallback: function() {
                    $('.btn-update-customer').click(function() {
                        let pk = $(this).data('pk');
                        // alert(pk);
                        $.ajax({
                            type: "GET",
                            url: "<?php echo base_url('index.php/detail/getcustomer') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) {
                                // alert(data);
                                $("#customer_id_update").val(data["customer_id"]);
                                $("#customer_name_update").val(data["customer_name"]);
                                $("#customer_telp_update").val(data["customer_telp"]);
                                $("#customer_alamat_update").val(data["customer_alamat"]);
                                $("#customer_kontak_person_update").val(data["customer_kontak_person"]);
                                $("#customer_keterangan_update").val(data["customer_keterangan"]);
                                data_customer_now = new Object();
                                data_customer_now.nama=data["customer_name"];
                                data_customer_now.telp=data["customer_telp"];
                                data_customer_now.alamat=data["customer_alamat"];
                                data_customer_now.kontak=data["customer_kontak_person"];
                                data_customer_now.keterangan=data["customer_keterangan"];
                            }
                        });
                    });
                    $('.btn-detail-customer').click(function() {
                        let pk = $(this).data('pk');
                        $.ajax({ //ajax ambil data customer
                            type: "GET",
                            url: "<?php echo base_url('index.php/detail/getcustomer') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) { //jika ambil data sukses
                                $('td[name="customer_name"]').text(data["customer_name"]); //set value
                                $('td[name="customer_alamat"]').text(data["customer_alamat"]); //set value
                                $('td[name="customer_kontak_person"]').text(data["customer_kontak_person"]); //set value
                                $('td[name="customer_telp"]').text(data["customer_telp"]); //set value
                                $('td[name="customer_keterangan"]').text(data["customer_keterangan"]); //set value
                            }
                        });
                    }); 
                    $('.btn-delete-customer').click(function() {
                        let pk = $(this).data('pk');
                        // alert(pk);
                        Swal.fire({
                            title: 'Hapus Customer',
                            text:'Yakin anda ingin menghapus customer ini?',
                            showDenyButton: true,
                            denyButtonText: `Batal`,
                            confirmButtonText: 'Hapus',
                            denyButtonColor: '#808080',
                            confirmButtonColor: '#FF0000',
                            icon: "warning",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/deletecustomer') ?>",
                                    dataType: "text",
                                    data: {
                                        id: pk
                                    },
                                    success: function(data) {
                                        location.reload();
                                    }
                                });
                            }
                        })
                    });
                    $('.btn-acc-customer').click(function() {
                        let pk = $(this).data('pk');
                        Swal.fire({
                            title: 'ACC Tambah Customer',
                            icon: "question",
                            text: 'Yakin anda ingin ACC Data Customer ini?',
                            showCancelButton:true,
                            confirmButtonText: 'ACC',
                            confirmButtonColor: '#4BB543',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/acccustomer/ACC') ?>",
                                    dataType: "text",
                                    data: {
                                        id: pk
                                    },
                                    success: function(data) {
                                        location.reload();
                                    }
                                });
                            }
                        })
                    });
                    $('.btn-tolak-customer').click(function() {
                        let pk = $(this).data('pk');
                        Swal.fire({
                            title: 'Tolak Tambah Customer',
                            icon: "question",
                            text: 'Yakin anda ingin Tolak Data Customer ini?',
                            showCancelButton:true,
                            confirmButtonText: 'Tolak',
                            confirmButtonColor: 'red',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/acccustomer/Ditolak') ?>",
                                    dataType: "text",
                                    data: {
                                        id: pk
                                    },
                                    success: function(data) {
                                        location.reload();
                                    }
                                });
                            }
                        })
                    });
                    $('.btn-acc-edit-customer').click(function() {
                        let pk = $(this).data('pk');
                        $.ajax({ //ajax ambil data customer
                            type: "GET",
                            url: "<?php echo base_url('index.php/detail/getcustomer') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) { //jika ambil data sukses
                                data_temp = JSON.parse(data["temp_customer"]);
                                $('td[name="customer_name_edit"]').text(data_temp["customer_name"]); //set value
                                $('td[name="customer_alamat_edit"]').text(data_temp["customer_alamat"]); //set value
                                $('td[name="customer_kontak_person_edit"]').text(data_temp["customer_kontak_person"]); //set value
                                $('td[name="customer_telp_edit"]').text(data_temp["customer_telp"]); //set value
                                $('td[name="customer_keterangan_edit"]').text(data_temp["customer_keterangan"]); //set value
                                $('#ACC').attr('onclick','acc_edit_customer('+data["customer_id"]+')');
                                $('#Tolak').attr('onclick','tolak_edit_customer('+data["customer_id"]+')');
                            }
                        });
                    });
                    $('.btn-acc-delete-customer').click(function() {
                        let pk = $(this).data('pk');
                        Swal.fire({
                            title: 'ACC Hapus Data Customer',
                            icon: "question",
                            text: 'Yakin anda ingin ACC Hapus Data Customer ini?',
                            showDenyButton: true,
                            showCancelButton:true,
                            denyButtonText: `Tolak`,
                            confirmButtonText: 'ACC',
                            denyButtonColor: '#808080',
                            confirmButtonColor: '#4BB543',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/accdeletecustomer/ACC') ?>",
                                    dataType: "text",
                                    data: {
                                        id: pk
                                    },
                                    success: function(data) {
                                        location.reload();
                                    }
                                });
                            }else if(result.isDenied){
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/accdeletecustomer/Ditolak') ?>",
                                    dataType: "text",
                                    data: {
                                        id: pk
                                    },
                                    success: function(data) {
                                        location.reload();
                                    }
                                });
                            }
                        })
                    });
                }
            });
        });
        $( "#form-edit-customer" ).submit(function( event ) {
            data_customer_new = new Object();
            data_customer_new.nama=$("#customer_name_update").val();
            data_customer_new.telp=$("#customer_telp_update").val();
            data_customer_new.alamat=$("#customer_alamat_update").val();
            data_customer_new.kontak=$("#customer_kontak_person_update").val();
            data_customer_new.keterangan=$("#customer_keterangan_update").val();
            if(JSON.stringify(data_customer_now) == JSON.stringify(data_customer_new)){
                alert( "Anda Belum Mengubah Data" );
                return false;
            }else{
                return true;
            }
        });
        function acc_edit_customer(id){
            $.ajax({
                type: "GET",
                url: "<?php echo base_url('index.php/form/acceditcustomer/ACC') ?>",
                dataType: "text",
                data: {
                    id: id
                },
                success: function(data) {
                    location.reload();
                }
            });
        }
        function tolak_edit_customer(id){
            $.ajax({
                type: "GET",
                url: "<?php echo base_url('index.php/form/acceditcustomer/Ditolak') ?>",
                dataType: "text",
                data: {
                    id: id
                },
                success: function(data) {
                    location.reload();
                }
            });
        }
    </script>
    <!-- end Customer -->     

    <!-- Supir -->
    <script> //script datatables Supir
        var data_supir_now = [];
        var data_supir_new = [];
        $(document).ready(function() {
            var table = null;
            table = $('#Table-Supir').DataTable({
                language: {
                    searchPlaceholder: "Nama Supir"
                },
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "lengthChange": false,
                "paging":false,
                "info":false,
                "order": [
                    [0, 'desc']
                ],
                "ajax": {
                    "url": "<?php echo base_url('index.php/home/view_Supir/viewsupir') ?>",
                    "type": "POST",
                    
                },
                "deferRender": true,
                "columns": [
                    {
                        "data": "supir_id",
                        className: 'text-center',
                        render: function(data, type, row) {
                            let html = row["no"];
                            return html;
                        }
                    },
                    {
                        "data": "supir_name",
                        
                    },
                    {
                        "data": "supir_panggilan",
                    },
                    {
                        "data": "supir_telp"
                    },
                    {
                        "data": "status_aktif",
                        className: 'text-center',
                        "orderable": false,
                            render: function(data, type, row) {
                                if (data == "Aktif") {
                                    let html = "<a class='btn btn-block btn-sm btn-outline-success  btn-update-status-aktif-supir' data-pk='"+row['supir_id']+"' data-toggle='modal' data-target='#update_status_aktif_supir' ><i class='fa fa-fw fa-check mr-2'></i>" + data + "</a>";
                                    return html;
                                } else {
                                    let html = "<a class='btn btn-block btn-sm btn-outline-danger btn-update-status-aktif-supir' data-pk='"+row['supir_id']+"' data-toggle='modal' data-target='#update_status_aktif_supir' ><i class='fa fa-fw fa-exclamation-circle mr-2'></i>" + data + "</a>";
                                    return html;
                                }
                            }
                    },
                    {
                        "data": "validasi",
                        className: 'text-center',
                        render: function(data, type, row) {
                            if(data=="ACC" && row['validasi_edit']=="ACC" && row['validasi_delete']=="ACC"){
                                return "<span class='small'><a class='btn btn-success rounded-pill btn-sm'><i class='fas fa-check'></i></a></span>";
                            }else{
                                return "<span class='small'><a class='btn btn-danger rounded-pill btn-sm'><i class='fas fa-exclamation'></i></a></span>";
                            }
                        }
                    },
                    {
                        "data": "supir_id",
                        className: 'text-center font-weight-bold',
                        "orderable": false,
                        render: function(data, type, row) {
                            let html = "";
                            html += "<div class='d-flex justify-content-center'> <a class='btn btn-light btn-detail-supir mr-1' href='javascript:void(0)' data-toggle='modal' data-target='#popup-detail-supir' data-pk='"+data+"'><i class='fas fa-eye'></i></a>";
                            if(row["validasi"]!="Pending" && row["validasi_edit"]!="Pending" && row["validasi_delete"]!="Pending"){
                                html += "<a class='btn btn-light btn-update-supir mr-1' data-toggle='modal' data-target='#popup-update-supir' href='javascript:void(0)' data-pk="+data+"><i class='fas fa-pen-square'></i></a>"+
                                "<a class='btn btn-light btn-delete-supir' href='javascript:void(0)' data-pk="+data+"><i class='fas fa-trash-alt'></i></a></div>";
                                return html;
                            }
                            return html;
                        }
                    },
                    {
                        "data": "supir_id",
                        className: 'text-center font-weight-bold',
                        "orderable": false,
                        render: function(data, type, row) {
                            var role_user = "<?=$_SESSION['role']?>";
                            let html = "";
                            if(role_user=="Supervisor" || role_user=="Super User"){
                                if(row["validasi"]=="Pending"){
                                    html +="<a class='btn btn-success btn-sm btn-acc-supir mr-1' href='javascript:void(0)' data-pk='"+data+"'><i class='fas fa-check-circle'></i></a>";
                                    html +="<a class='btn btn-danger btn-sm btn-tolak-supir' href='javascript:void(0)' data-pk='"+data+"'><i class='fas fa-times'></i></a><br>";
                                }
                                if(row["validasi_edit"]=="Pending"){
                                    html += "<a class='btn btn-primary btn-sm btn-acc-edit-supir' href='javascript:void(0)' data-pk='"+data+"' data-toggle='modal' data-target='#popup-acc-edit-supir'>ACC Edit <i class='fas fa-check-circle'></i></a><br>";
                                }
                                if(row["validasi_delete"]=="Pending"){
                                    html += "<a class='btn btn-danger btn-sm btn-acc-delete-supir' href='javascript:void(0)' data-pk='"+data+"'>ACC Delete <i class='fas fa-check-circle'></i></a><br>";    
                                }
                                return html;
                            }else{
                                return "";
                            }
                        }
                    }
                ],
                drawCallback: function() {
                    $('.btn-update-supir').click(function() {
                        let pk = $(this).data('pk');
                        $("#supir_id").val(pk);
                        $.ajax({
                            type: "GET",
                            url: "<?php echo base_url('index.php/form/getsupirname') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) {
                                $("#supir_name").val(data["supir_name"]);
                                $("#supir_panggilan_update").val(data["supir_panggilan"]);
                                $("#supir_tempat_lahir_update").val(data["supir_tempat_lahir"]);
                                $("#supir_tgl_lahir_update").val(change_tanggal(data["supir_tgl_lahir"]));
                                $("#supir_alamat_update").val(data["supir_alamat"]);
                                $("#supir_telp_update").val(data["supir_telp"]);
                                $("#supir_ktp_update").val(data["supir_ktp"]);
                                $("#supir_sim_update").val(data["supir_sim"]);
                                $("#supir_tgl_sim_update").val(change_tanggal(data["supir_tgl_sim"]));
                                $("#supir_tgl_aktif_update").val(change_tanggal(data["supir_tgl_aktif"]));
                                $("#darurat_nama_update").val(data["darurat_nama"]);
                                $("#darurat_telp_update").val(data["darurat_telp"]);
                                $("#darurat_referensi_update").val(data["darurat_referensi"]);
                                $("#supir_keterangan_update").val(data["supir_keterangan"]);
                                data_supir_now = new Object();
                                data_supir_now.nama=data["supir_name"];
                                data_supir_now.panggilan=data["supir_panggilan"];
                                data_supir_now.ttl=data["supir_tempat_lahir"];
                                data_supir_now.tgl=change_tanggal(data["supir_tgl_lahir"]);
                                data_supir_now.alamat=data["supir_alamat"];
                                data_supir_now.telp=data["supir_telp"];
                                data_supir_now.ktp=data["supir_ktp"];
                                data_supir_now.sim=data["supir_sim"];
                                data_supir_now.tgl_sim=change_tanggal(data["supir_tgl_sim"]);
                                data_supir_now.tgl_aktif=change_tanggal(data["supir_tgl_aktif"]);
                                data_supir_now.drnama=data["darurat_nama"];
                                data_supir_now.drtelp=data["darurat_telp"];
                                data_supir_now.drref=data["darurat_referensi"];
                                data_supir_now.keterangan=data["supir_keterangan"];
                            }
                        });
                    });
                    $('.btn-update-status-aktif-supir').click(function() {
                        let pk = $(this).data('pk');
                        $.ajax({
                            type: "GET",
                            url: "<?php echo base_url('index.php/form/getsupirname') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) {
                                $("#update_status_supir_id").val(data["supir_id"]);
                                $("#update_status_supir_name").val(data["supir_name"]);
                                $("#update_status_status_aktif").val(data["status_aktif"]);
                            }
                        });
                    });
                    $('.btn-detail-supir').click(function() {
                        let pk = $(this).data('pk');
                        // alert(pk);
                        $.ajax({ //ajax ambil data supir
                            type: "GET",
                            url: "<?php echo base_url('index.php/detail/getsupir') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) { //jika ambil data sukses
                                $('td[name="supir_name"]').text(data["supir_name"]+" ("+data["supir_panggilan"]+")"); //set value
                                $('td[name="supir_alamat"]').text(data["supir_alamat"]); //set value
                                $('td[name="supir_ttl"]').text(data["supir_tempat_lahir"]+","+change_tanggal(data["supir_tgl_lahir"])); //set value
                                $('td[name="supir_telp"]').text(data["supir_telp"]); //set value
                                $('td[name="supir_ktp"]').text(data["supir_ktp"]); //set value
                                $('td[name="supir_sim"]').text(data["supir_sim"]+" (s/d "+change_tanggal(data["supir_tgl_sim"])+")"); //set value
                                $('td[name="supir_kasbon"]').text("Rp."+rupiah(data["supir_kasbon"])); //set value
                                $('td[name="supir_keterangan"]').text(data["supir_keterangan"]); //set value
                                $('#aktif').text(data["status_aktif"]); //set value
                                if(data["status_aktif"]=="Aktif"){
                                    $('#tgl-aktif').text(change_tanggal(data["supir_tgl_aktif"])+" - Sekarang"); //set value
                                }else{
                                    $('#tgl-aktif').text(change_tanggal(data["supir_tgl_aktif"])+" - "+change_tanggal(data["supir_tgl_nonaktif"])); //set value
                                }
                                $('td[name="darurat_nama"]').text(data["darurat_nama"]); //set value
                                $('td[name="darurat_referensi"]').text(data["darurat_referensi"]); //set value
                                $('td[name="darurat_telp"]').text(data["darurat_telp"]); //set value
                                $('#foto').attr('src','<?= base_url("assets/berkas/driver/")?>'+data["file_foto"]);
                                $('#sim').attr('src','<?= base_url("assets/berkas/driver/")?>'+data["file_sim"]);
                                $('#ktp').attr('src','<?= base_url("assets/berkas/driver/")?>'+data["file_ktp"]);
                            }
                        });
                    }); 
                    $('.btn-delete-supir').click(function() {
                        let pk = $(this).data('pk');
                        Swal.fire({
                            title: 'Hapus Driver',
                            icon: "warning",
                            text: 'Yakin anda ingin menghapus Driver ini?',
                            showDenyButton: true,
                            denyButtonText: `Batal`,
                            confirmButtonText: 'Hapus',
                            denyButtonColor: '#808080',
                            confirmButtonColor: '#FF0000',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/deletesupir') ?>",
                                    dataType: "text",
                                    data: {
                                        id: pk
                                    },
                                    success: function(data) {
                                        location.reload();
                                    }
                                });
                            }
                        })
                    });
                    $('.btn-acc-supir').click(function() {
                        let pk = $(this).data('pk');
                        Swal.fire({
                            title: 'ACC Tambah Driver',
                            icon: "question",
                            text: 'Yakin anda ingin ACC Data Driver ini?',
                            showCancelButton:true,
                            confirmButtonText: 'ACC',
                            confirmButtonColor: '#4BB543',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/accsupir/ACC') ?>",
                                    dataType: "text",
                                    data: {
                                        id: pk
                                    },
                                    success: function(data) {
                                        location.reload();
                                    }
                                });
                            }
                        })
                    });
                    $('.btn-tolak-supir').click(function() {
                        let pk = $(this).data('pk');
                        Swal.fire({
                            title: 'Tolak Tambah Supir',
                            icon: "question",
                            text: 'Yakin anda ingin Tolak Data Supir ini?',
                            showCancelButton:true,
                            confirmButtonText: 'Tolak',
                            confirmButtonColor: 'red',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/accsupir/Ditolak') ?>",
                                    dataType: "text",
                                    data: {
                                        id: pk
                                    },
                                    success: function(data) {
                                        location.reload();
                                    }
                                });
                            }
                        })
                    });
                    $('.btn-acc-edit-supir').click(function() {
                        let pk = $(this).data('pk');
                        $.ajax({ //ajax ambil data supir
                            type: "GET",
                            url: "<?php echo base_url('index.php/detail/getsupir') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) { //jika ambil data sukses
                                data_temp = JSON.parse(data["temp_supir"]);
                                $('td[name="supir_name_edit"]').text(data_temp["supir_name"]+" ("+data_temp["supir_panggilan"]+")"); //set value
                                $('td[name="supir_alamat_edit"]').text(data_temp["supir_alamat"]); //set value
                                $('td[name="supir_ttl_edit"]').text(data_temp["supir_tempat_lahir"]+","+change_tanggal(data_temp["supir_tgl_lahir"])); //set value
                                $('td[name="supir_telp_edit"]').text(data_temp["supir_telp"]); //set value
                                $('td[name="supir_ktp_edit"]').text(data_temp["supir_ktp"]); //set value
                                $('td[name="supir_sim_edit"]').text(data_temp["supir_sim"]+" (s/d "+change_tanggal(data_temp["supir_tgl_sim"])+")"); //set value
                                $('td[name="supir_keterangan_edit"]').text(data_temp["supir_keterangan"]); //set value
                                $('td[name="darurat_nama_edit"]').text(data_temp["darurat_nama"]); //set value
                                $('td[name="darurat_referensi_edit"]').text(data_temp["darurat_referensi"]); //set value
                                $('td[name="darurat_telp_edit"]').text(data_temp["darurat_telp"]); //set value
                                $('#foto_edit').attr('src','<?= base_url("assets/berkas/driver/")?>'+data_temp["file_foto"]);
                                $('#sim_edit').attr('src','<?= base_url("assets/berkas/driver/")?>'+data_temp["file_sim"]);
                                $('#ktp_edit').attr('src','<?= base_url("assets/berkas/driver/")?>'+data_temp["file_ktp"]);
                                $('#ACC').attr('onclick','acc_edit_supir('+data["supir_id"]+')');
                                $('#Tolak').attr('onclick','tolak_edit_supir('+data["supir_id"]+')');
                            }
                        });
                    });
                    $('.btn-acc-delete-supir').click(function() {
                        let pk = $(this).data('pk');
                        Swal.fire({
                            title: 'ACC Hapus Data Driver',
                            icon: "question",
                            text: 'Yakin anda ingin ACC Hapus Data Driver ini?',
                            showDenyButton: true,
                            showCancelButton:true,
                            denyButtonText: `Tolak`,
                            confirmButtonText: 'ACC',
                            denyButtonColor: '#808080',
                            confirmButtonColor: '#4BB543',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/accdeletesupir/ACC') ?>",
                                    dataType: "text",
                                    data: {
                                        id: pk
                                    },
                                    success: function(data) {
                                        location.reload();
                                    }
                                });
                            }else if(result.isDenied){
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/accdeletesupir/Ditolak') ?>",
                                    dataType: "text",
                                    data: {
                                        id: pk
                                    },
                                    success: function(data) {
                                        location.reload();
                                    }
                                });
                            }
                        })
                    });
                }
            });
        });
        $( "#form-edit-supir" ).submit(function( event ) {
            data_supir_new = new Object();
            data_supir_new.nama=$("#supir_name").val();;
            data_supir_new.panggilan=$("#supir_panggilan_update").val();
            data_supir_new.ttl=$("#supir_tempat_lahir_update").val();
            data_supir_new.tgl=$("#supir_tgl_lahir_update").val();
            data_supir_new.alamat=$("#supir_alamat_update").val();
            data_supir_new.telp=$("#supir_telp_update").val();
            data_supir_new.ktp=$("#supir_ktp_update").val();
            data_supir_new.sim=$("#supir_sim_update").val();
            data_supir_new.tgl_sim=$("#supir_tgl_sim_update").val();
            data_supir_new.tgl_aktif=$("#supir_tgl_aktif_update").val();
            data_supir_new.drnama=$("#darurat_nama_update").val();
            data_supir_new.drtelp=$("#darurat_telp_update").val();
            data_supir_new.drref=$("#darurat_referensi_update").val();
            data_supir_new.keterangan=$("#supir_keterangan_update").val();
            if(JSON.stringify(data_supir_now) == JSON.stringify(data_supir_new)){
                if($("#file_foto_update").val()=="" && $("#file_sim_update").val()=="" && $("#file_ktp_update").val()==""){
                    alert( "Anda Belum Mengubah Data" );
                    return false;
                }else{
                    return true;
                }
            }else{
                return true;
            }
        });
        function acc_edit_supir(id){
            $.ajax({
                type: "GET",
                url: "<?php echo base_url('index.php/form/acceditsupir/ACC') ?>",
                dataType: "text",
                data: {
                    id: id
                },
                success: function(data) {
                    location.reload();
                }
            });
        }
        function tolak_edit_supir(id){
            $.ajax({
                type: "GET",
                url: "<?php echo base_url('index.php/form/acceditsupir/Ditolak') ?>",
                dataType: "text",
                data: {
                    id: id
                },
                success: function(data) {
                    location.reload();
                }
            });
        }
    </script>
    <!-- End Supir -->

    <!-- Report Bon Supir -->
    <script> //script datatables report bon Supir
        $(document).ready(function() {
            var table = null;
            table = $('#Table-Report-Bon-Supir').DataTable({
                language: {
                    searchPlaceholder: "Nama Supir"
                },
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [0, 'desc']
                ],
                "ajax": {
                    "url": "<?php echo base_url('index.php/home/view_Mutasi/bonsupir') ?>",
                    "type": "POST",
                    
                },
                "deferRender": true,
                "aLengthMenu": [
                    [10, 30, 50, 100],
                    [10, 30, 50, 100]
                ],
                "columns": [
                    {
                        "data": "supir_id",
                        className: 'text-center'
                    },
                    {
                        "data": "supir_name",
                        
                    },
                    {
                        "data": "supir_kasbon",
                        render: function(data, type, row) {
                            let html = 'Rp.'+rupiah(data);
                            return html;
                        }
                    },
                    {
                        "data": "supir_id",
                        className: 'text-center font-weight-bold',
                        "orderable": false,
                        render: function(data, type, row) {
                            let html = "<a class='btn btn-light' href='<?= base_url('index.php/detail/detail_report_bon/"+data+"/detail')?>'><i class='fas fa-eye'></i></a>";
                            return html;
                        }
                    }
                ]
            });
        });
    </script>
    <!-- End Report Bon Supir -->

    <!-- Gaji Supir -->
    <script> //script datatables Gaji Supir
        $(document).ready(function() {
            var table = null;
            table = $('#Table-Supir-Gaji').DataTable({
                language: {
                    searchPlaceholder: "Nama Supir"
                },
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [0, 'asc']
                ],
                "ajax": {
                    "url": "<?php echo base_url('index.php/home/view_Supir/gajisupir') ?>",
                    "type": "POST",
                    
                },
                "deferRender": true,
                "aLengthMenu": [
                    [10, 30, 50, 100],
                    [10, 30, 50, 100]
                ],
                "columns": [
                    {
                        "data": "supir_id",
                        className: 'text-center'
                    },
                    {
                        "data": "supir_name",
                        
                    },
                    {
                        "data": "supir_kasbon",
                        render: function(data, type, row) {
                            let html = 'Rp.'+rupiah(data);
                            return html;
                        }
                    },
                    {
                        "data": "supir_id",
                        className: 'text-center font-weight-bold',
                        "orderable": false,
                        render: function(data, type, row) {
                            let html = "<a class='btn btn-light' href='<?= base_url('index.php/detail/pilih_gaji/"+data+"/home/').date('m')."/".date('Y')?>'><i class='fas fa-dollar-sign'></i></a>";
                            return html;
                        }
                    }
                ]
            });
        });
    </script>
    <!-- End Gaji Supir -->
    
    <!-- Seluruh invoice-->
    <script>
        $(document).ready(function() {
            var table = null;
            table = $('#Table-Seluruh-Invoice').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "searching": false,
                "order": [
                    [2, 'desc']
                ],
                "ajax": {
                    "url": "<?php echo base_url('index.php/home/view_seluruh_invoice') ?>",
                    "type": "POST",
                    'data': function(data) {
                        data.Status = $('#Status').val();
                        data.Customer = $('#Customer').val();
                        data.Ppn = $('#Ppn').val();
                        data.Tanggal_Top = $('#Tanggal_Top').val();
                        data.Tanggal1 = $('#Tanggal1').val();
                        data.Tanggal2 = $('#Tanggal2').val();
                        data.No_Invoice1 = $('#No_Invoice1').val();
                        data.No_Invoice2 = $('#No_Invoice2').val();
                        data.No_Invoice3 = $('#No_Invoice3').val();
                        data.No_Invoice4 = $('#No_Invoice4').val();
                    }
                },
                "deferRender": true,
                "aLengthMenu": [
                    [50, 100],
                    [50, 100]
                ],
                "columns": [
                    {
                        "data": "invoice_kode",
                        className: 'text-center'
                    },
                    {
                        "data": "tanggal_invoice",
                        className: 'text-center',
                        render: function(data, type, row) {
                            return change_tanggal(data);
                        }
                    },
                    {
                        "data": "customer_name"
                    },
                    {
                        "data": "grand_total",
                        render: function(data, type, row) {
                            let html = 'Rp.'+rupiah(data);
                            return html;
                        }
                    },
                    {
                        "data": "sisa",
                        render: function(data, type, row) {
                            let html = 'Rp.'+rupiah(data);
                            return html;
                        }
                    },
                    {
                        "data": "batas_pembayaran",
                        className: 'text-center',
                        render: function(data, type, row) {
                            return data+" hari ("+change_tanggal(row["tanggal_batas_pembayaran"])+")";
                        }
                    },
                    {
                        "data": "status_bayar",
                        className: 'text-center',
                        render: function(data, type, row) {
                            if (data == "Lunas") {
                                    let html = "<span class='text-success'><i class='fa fa-fw fa-check mr-2'></i>" + data + "</span>";
                                    return html;
                                } else {
                                    let html = "<span class='text-warning'><i class='fa fa fa-fw fa-exclamation-circle mr-2'></i>" + data + "</span>";
                                    return html;
                                }
                        }
                    },
                    {
                        "data": "invoice_kode",
                        className: 'text-center',
                        "orderable": false,
                        render: function(data, type, row) {
                            let html = "";
                                    if(<?= $_SESSION["payment_invoice"]?>==0){
                                        html += "<a class='btn btn-light btn-alert-payment-invoice'><i class='fas fa-file-invoice-dollar'></i></a>";
                                    }else{
                                        html += "<a class='btn btn-light' href='<?= base_url('index.php/payment/payment_invoice/"+data+"')?>'><i class='fas fa-file-invoice-dollar'></i></a>";
                                    }
                            return html;
                        }
                    },
                    {
                        "data": "invoice_kode",
                        className: 'text-center',
                        "orderable": false,
                        render: function(data, type, row) {
                            var role_user = "<?=$_SESSION['role']?>";
                            let html = "";
                            html += "<a class='btn btn-light' target='_blank' href='<?= base_url('index.php/detail/detail_invoice/"+data+"')?>'><i class='fas fa-eye'></i></a>";
                            if(role_user=="Supervisor"){
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/detail/getnumpaymentinvoice') ?>",
                                    dataType: "text",
                                    async:false,
                                    data: {
                                        id : data,
                                    },
                                    success: function(hasil) { //jika ambil hasil sukses
                                        if(hasil>0){
                                            html += "<a class='btn btn-light btn-alert-edit-invoice mr-1 ml-1'><i class='fas fa-pen-square'></i></a>";
                                        }else{
                                            html += "<a class='btn btn-light btn-update-invoice mr-1 ml-1' href='<?= base_url("index.php/form/edit_invoice/")?>"+data+"'><i class='fas fa-pen-square'></i></a>";
                                        }
                                    }
                                });
                                html += "<a class='btn btn-light btn-delete-invoice' href='javascript:void(0)' data-pk="+data+"><i class='fas fa-trash-alt'></i></a>";
                            }
                            return html;
                        }
                    }
                ],
                drawCallback: function() {
                    $('.btn-delete-invoice').click(function() {
                        let pk = $(this).data('pk');
                        $.ajax({
                            type: "GET",
                            url: "<?php echo base_url('index.php/detail/getnumpaymentinvoice') ?>",
                            dataType: "text",
                            data: {
                                id : pk,
                            },
                            success: function(data) { //jika ambil data sukses
                                if(data>0){
                                    Swal.fire({
                                        title: 'Hapus Data Invoice',
                                        text:'Maaf Invoice Ini Sudah Melakukan Pembayaran',
                                        icon: "warning",
                                        time: 2000
                                    })
                                }else{
                                    Swal.fire({
                                        title: 'Hapus Data Invoice',
                                        text:'Yakin Anda Ingin Menghapus Data Invoice Ini?',
                                        showDenyButton: true,
                                        denyButtonText: `Batal`,
                                        confirmButtonText: 'Hapus',
                                        denyButtonColor: '#808080',
                                        confirmButtonColor: '#FF0000',
                                        icon: "warning",
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.replace("<?= base_url('index.php/form/deleteinvoice/')?>"+pk);
                                        }
                                    })
                                }
                            }
                        });
                    });
                    $('.btn-alert-edit-invoice').click(function() {
                        Swal.fire({
                            title: 'Edit Data Invoice',
                            text:'Maaf Invoice Ini Sudah Melakukan Pembayaran',
                            icon: "warning",
                            time: 2000
                        })
                    });
                    $('.btn-alert-payment-invoice').click(function() {
                        Swal.fire({
                            title: 'Pembayaran Invoice',
                            text:'Maaf Anda Tidak Memiliki Akses Untuk Melakukan Pembayaran',
                            icon: "warning",
                            time: 2000
                        })
                    });
                },
            });
            $("#btn-cari").click(function() {
                if($('#Tanggal1').val()==""){
                    if($('#Tanggal2').val()!=""){
                        alert("Silakan Isi Kedua Tgl. Invoice / Tidak Diisi Keduanya");
                        $('#Tanggal1').val("");
                        $('#Tanggal2').val("");
                    }else{
                        table.ajax.reload();
                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url('index.php/home/getditemukaninvoice') ?>",
                            dataType: "text",
                            data: {
                                Status : $('#Status').val(),
                                Customer : $('#Customer').val(),
                                Ppn : $('#Ppn').val(),
                                Tanggal_Top : $('#Tanggal_Top').val(),
                                Tanggal1 : $('#Tanggal1').val(),
                                Tanggal2 : $('#Tanggal2').val(),
                                No_Invoice1 : $('#No_Invoice1').val(),
                                No_Invoice2 : $('#No_Invoice2').val(),
                                No_Invoice3 : $('#No_Invoice3').val(),
                                No_Invoice4 : $('#No_Invoice4').val(),
                            },
                            success: function(data) { //jika ambil data sukses
                                hasil = data.split("=");
                                $("#ditemukan").text(hasil[0]);
                                $("#tagihan").text(hasil[1]);
                            }
                        });
                    }
                }else if($('#Tanggal2').val()==""){
                    if($('#Tanggal1').val()!=""){
                        alert("Silakan Isi Kedua Tgl. Invoice / Tidak Diisi Keduanya");
                        $('#Tanggal1').val("");
                        $('#Tanggal2').val("");
                    }else{
                        table.ajax.reload();
                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url('index.php/home/getditemukaninvoice') ?>",
                            dataType: "text",
                            data: {
                                Status : $('#Status').val(),
                                Customer : $('#Customer').val(),
                                Ppn : $('#Ppn').val(),
                                Tanggal_Top : $('#Tanggal_Top').val(),
                                Tanggal1 : $('#Tanggal1').val(),
                                Tanggal2 : $('#Tanggal2').val(),
                                No_Invoice1 : $('#No_Invoice1').val(),
                                No_Invoice2 : $('#No_Invoice2').val(),
                                No_Invoice3 : $('#No_Invoice3').val(),
                                No_Invoice4 : $('#No_Invoice4').val(),
                            },
                            success: function(data) { //jika ambil data sukses
                                hasil = data.split("=");
                                $("#ditemukan").text(hasil[0]);
                                $("#tagihan").text(hasil[1]);
                            }
                        });
                    }
                }
            });
        });
    </script>
    <!-- End Seluruh Invoice-->

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

    <!-- Akun -->
     <script> //script datatables customer
        var data_akun_now = [];
        var data_akun_new = [];       
        $(document).ready(function() {
            var table = null;
            table = $('#Table-Akun').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [0, 'asc']
                ],
                "ajax": {
                    "url": "<?php echo base_url('index.php/home/view_akun/') ?>",
                    "type": "POST",
                    
                },
                "deferRender": true,
                "aLengthMenu": [
                    [10, 30, 50, 100],
                    [10, 30, 50, 100]
                ],
                "columns": [
                    {
                        "data": "akun_id",
                        className: 'text-center'
                    },
                    {
                        "data": "akun_name"
                    },
                    {
                        "data": "akun_role",
                        className: 'text-center',
                        "orderable": false,
                        render: function(data, type, row) {
                            if (data == "Super User") {
                                    let html = "<span class='btn-sm btn-block active btn-info'></i>" + data + "</span>";
                                    return html;
                                } else if (data == "Operator"){
                                    let html = "<span class='btn-sm btn-block active btn-light'>" + data + "</span>";
                                    return html;
                                }else {
                                    let html = "<span class='btn-sm btn-block active btn-success'>" + data + "</span>";
                                    return html;
                                }
                        }
                    },
                    {   "data": "akun_id",
                        className: 'text-center',
                        "orderable": false,
                        render: function(data, type, row) {
                            var html = "";
                            <?php if($_SESSION["role"] != "Operator"){?>
                                html += "<a class='btn btn-light btn-update-akun' data-toggle='modal' data-target='#popup-update-akun' href='javascript:void(0)' data-pk="+data+"><i class='fas fa-pen-square'></i></a> || "+
                                "<a class='btn btn-light btn-update-akun' href='<?= base_url('index.php/form/konfigurasi/"+data+"')?>' data-pk="+data+"><i class='fas fa-user-cog'></i></a> || "+
                                "<a class='btn btn-light btn-delete-akun' href='javascript:void(0)' data-pk="+data+"><i class='fas fa-trash-alt'></i></a>";
                            <?php }?>
                            return html;
                        }
                    }
                ],
                drawCallback: function() {
                    $('.btn-update-akun').click(function() {
                        let pk = $(this).data('pk');
                        $("#akun_id").val(pk);
                        $.ajax({
                            type: "GET",
                            url: "<?php echo base_url('index.php/form/getakunbyid') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) {
                                $("#akun_name").val(data["akun_name"]);
                                $("#username_update").val(data["username"]);
                                $("#password_update").val(data["password"]);
                                $("#role_update").val(data["akun_role"]);
                                data_akun_now = new Object();
                                data_akun_now.nama=data["akun_name"];
                                data_akun_now.username=data["username"];
                                data_akun_now.password=data["password"];
                                data_akun_now.role=data["akun_role"];
                            }
                        });
                    });
                    $('.btn-delete-akun').click(function() {
                        let pk = $(this).data('pk');
                        Swal.fire({
                            title: 'Hapus Akun',
                            text:'Yakin anda akan menghapus akun ini?',
                            showDenyButton: true,
                            denyButtonText: `Batal`,
                            confirmButtonText: 'Hapus',
                            denyButtonColor: '#808080',
                            confirmButtonColor: '#FF0000',
                            icon: "warning",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/deleteakun') ?>",
                                    dataType: "text",
                                    data: {
                                        id: pk
                                    },
                                    success: function(data) {
                                        location.reload();
                                    }
                                });
                            }
                        })
                    });
                }
            });
        });
        $( "#form-edit-akun" ).submit(function( event ) {
            data_akun_new = new Object();
            data_akun_new.nama=$("#akun_name").val();
            data_akun_new.username=$("#username_update").val();
            data_akun_new.password=$("#password_update").val();
            data_akun_new.role=$("#role_update").val();
            if(JSON.stringify(data_akun_now) == JSON.stringify(data_akun_new)){
                alert( "Anda Belum Mengubah Data" );
                return false;
            }else{
                return true;
            }
        });
     </script>
    <!-- end Akun --> 

    <!-- rute -->
    <script> //script datatables rute
        var data_rute_now = [];
        var data_rute_new = [];
        $(document).ready(function() {
            var table = null;
            table = $('#Table-rute').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "lengthChange": false,
                "paging":false,
                "info":false,
                "order": [
                    [0, 'desc']
                ],
                "ajax": {
                    "url": "<?php echo base_url('index.php/home/view_rute/viewrute')?>",
                    "type": "POST",
                    'data': function(data) {
                        data.customer = "x";
                    }
                },
                "deferRender": true,
                "columns": [
                    {
                        "data": "rute_id",
                        className: 'text-center',
                        render: function(data, type, row) {
                            let html = row["no"];
                            return html;
                        }
                    },
                    {
                        "data": "customer_name"
                    },
                    {
                        "data": "rute_dari"
                    },
                    {
                        "data": "rute_ke"
                    },
                    {
                        "data": "rute_muatan"
                    },
                    {
                        "data": "jenis_mobil"
                    },
                    {
                        "data": "rute_uj_engkel",
                        className: 'text-center',
                        render: function(data, type, row) {
                            let html = 'Rp.'+rupiah(data);
                            return html;
                        }
                    },
                    {
                        "data": "validasi_rute",
                        className: 'text-center',
                        render: function(data, type, row) {
                            if(data=="ACC" && row['validasi_rute_edit']=="ACC" && row['validasi_rute_delete']=="ACC"){
                                return "<span class='small'><a class='btn btn-success rounded-pill btn-sm'><i class='fas fa-check'></i></a></span>";
                            }else{
                                return "<span class='small'><a class='btn btn-danger rounded-pill btn-sm'><i class='fas fa-exclamation'></i></a></span>";
                            }
                        }
                    },
                    {
                        "data": "rute_id",
                        className: 'text-center',
                        "orderable": false,
                        render: function(data, type, row) {
                            let html = "";
                            html += "<div class='d-flex justify-content-center'><a class='btn btn-light btn-detail-rute mr-1' href='javascript:void(0)' data-toggle='modal' data-target='#popup-detail-rute' data-pk='"+data+"'><i class='fas fa-eye'></i></a>";
                            if(row["validasi_rute"]!="Pending" && row["validasi_rute_edit"]!="Pending" && row["validasi_rute_delete"]!="Pending"){
                                html += "<a class='btn btn-light btn-update-rute mr-1' data-toggle='modal' data-target='#popup-update-rute' href='javascript:void(0)' data-pk="+data+"><i class='fas fa-pen-square'></i></a>"+
                                "<a class='btn btn-light btn-delete-rute' href='javascript:void(0)' data-pk="+data+"><i class='fas fa-trash-alt'></i></a></div>";
                                return html;
                            }
                            return html;
                        }
                    },
                    {
                        "data": "rute_id",
                        className: 'text-center',
                        "orderable": false,
                        render: function(data, type, row) {
                            var role_user = "<?=$_SESSION['role']?>";
                            let html = "";
                            if(role_user=="Supervisor" || role_user=="Super User"){
                                if(row["validasi_rute"]=="Pending"){
                                    html +="<a class='btn btn-success btn-sm btn-acc-rute mr-1' href='javascript:void(0)' data-pk='"+data+"'><i class='fas fa-check-circle'></i></a>";
                                    html +="<a class='btn btn-danger btn-sm btn-tolak-rute' href='javascript:void(0)' data-pk='"+data+"'><i class='fas fa-times'></i></a><br>";
                                }
                                if(row["validasi_rute_edit"]=="Pending"){
                                    html += "<a class='btn btn-primary btn-sm btn-acc-edit-rute' href='javascript:void(0)' data-pk='"+data+"' data-toggle='modal' data-target='#popup-acc-edit-rute'>ACC Edit<i class='fas fa-check-circle'></i></a><br>";
                                }
                                if(row["validasi_rute_delete"]=="Pending"){
                                    html += "<a class='btn btn-danger btn-sm btn-acc-delete-rute' href='javascript:void(0)' data-pk='"+data+"'>ACC Delete<i class='fas fa-check-circle'></i></a><br>";    
                                }
                                return html;
                            }else{
                                return "";
                            }
                        }
                    }
                ],
                drawCallback: function() {
                    $('.btn-update-rute').click(function() {
                        let pk = $(this).data('pk');
                        // alert(pk);
                        $.ajax({
                            type: "GET",
                            url: "<?php echo base_url('index.php/form/getrutebyid') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) {
                                $("#rute_id_update").val(data["rute_id"]);//
                                $("#customer_id_update").val(data["customer_id"]);//
                                $("#customer_name_update").val(data["customer_name"]);//
                                $("#jenis_mobil_update").val(data["jenis_mobil"]);//
                                $("#Ritase_update").val(data["ritase"]);//

                                $("#rute_dari_update").val(data["rute_dari"]);
                                $("#rute_ke_update").val(data["rute_ke"]);
                                $("#rute_muatan_update").val(data["rute_muatan"]);
                                $("#rute_uj_engkel_update").val(rupiah(data["rute_uj_engkel"]));
                                $("#rute_tagihan_update").val(rupiah(data["rute_tagihan"]));
                                $("#rute_gaji_engkel_update").val(rupiah(data["rute_gaji_engkel"]));
                                $("#rute_keterangan_update").val(data["rute_keterangan"]);
                                data_rute_now = new Object();
                                data_rute_now.dari=data["rute_dari"];
                                data_rute_now.ke=data["rute_ke"];
                                data_rute_now.muatan=data["rute_muatan"];
                                data_rute_now.uj=data["rute_uj_engkel"];
                                data_rute_now.tagihan=data["rute_tagihan"];
                                data_rute_now.gaji=data["rute_gaji_engkel"];
                                data_rute_now.keterangan=data["rute_keterangan"];
                            }
                        });
                    });
                    $('.btn-delete-rute').click(function() {
                        let pk = $(this).data('pk');
                        // alert(pk);
                        Swal.fire({
                            title: 'Hapus Rute dan Muatan',
                            text:'Yakin anda ingin menghapus Rute dan Muatan ini?',
                            showDenyButton: true,
                            denyButtonText: `Batal`,
                            confirmButtonText: 'Hapus',
                            denyButtonColor: '#808080',
                            confirmButtonColor: '#FF0000',
                            icon: "warning",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/deleterute') ?>",
                                    dataType: "text",
                                    data: {
                                        id: pk
                                    },
                                    success: function(data) {
                                        location.reload();
                                    }
                                });
                            }
                        })
                    });
                    $('.btn-detail-rute').click(function() {
                        let pk = $(this).data('pk');
                        $.ajax({ //ajax ambil data customer
                            type: "GET",
                            url: "<?php echo base_url('index.php/form/getrutebyid') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) { //jika ambil data sukses
                                $("#rute_id_detail").val(data["rute_id"]);
                                $("#customer_id_detail").val(data["customer_id"]);
                                $("#customer_name_detail").val(data["customer_name"]);
                                $("#rute_dari_detail").val(data["rute_dari"]);
                                $("#rute_ke_detail").val(data["rute_ke"]);
                                $("#rute_muatan_detail").val(data["rute_muatan"]);
                                $("#jenis_mobil_detail").val(data["jenis_mobil"]);
                                $("#rute_uj_engkel_detail").val(rupiah(data["rute_uj_engkel"]));
                                // $("#rute_uj_tronton_detail").val(rupiah(data["rute_uj_tronton"]));
                                $("#Ritase_detail").val(data["ritase"]);
                                $("#rute_tagihan_detail").val(rupiah(data["rute_tagihan"]));
                                $("#rute_gaji_engkel_detail").val(rupiah(data["rute_gaji_engkel"]));
                                // $("#rute_gaji_tronton_detail").val(rupiah(data["rute_gaji_tronton"]));
                                // $("#rute_gaji_engkel_rumusan_detail").val(rupiah(data["rute_gaji_engkel_rumusan"]));
                                // $("#rute_gaji_tronton_rumusan_detail").val(rupiah(data["rute_gaji_tronton_rumusan"]));
                                // $("#rute_tonase_detail").val(rupiah(data["rute_tonase"]));
                                $("#rute_keterangan_detail").val(data["rute_keterangan"]);
                                // $("#Ritase_detail").val(data["ritase"]);

                            }
                        });
                    });
                    $('.btn-acc-rute').click(function() {
                        let pk = $(this).data('pk');
                        Swal.fire({
                            title: 'ACC Tambah Rute dan Muatan',
                            icon: "question",
                            text: 'Yakin anda ingin ACC Data Rute dan Muatan ini?',
                            showCancelButton:true,
                            confirmButtonText: 'ACC',
                            confirmButtonColor: '#4BB543',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/accrute/ACC') ?>",
                                    dataType: "text",
                                    data: {
                                        id: pk
                                    },
                                    success: function(data) {
                                        location.reload();
                                    }
                                });
                            }
                        })
                    });
                    $('.btn-tolak-rute').click(function() {
                        let pk = $(this).data('pk');
                        Swal.fire({
                            title: 'Tolak Tambah Rute dan Muatan',
                            icon: "question",
                            text: 'Yakin anda ingin Tolak Data Rute dan Muatan ini?',
                            showCancelButton:true,
                            confirmButtonText: 'Tolak',
                            confirmButtonColor: '#4BB543',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/accrute/Ditolak') ?>",
                                    dataType: "text",
                                    data: {
                                        id: pk
                                    },
                                    success: function(data) {
                                        location.reload();
                                    }
                                });
                            }
                        })
                    });
                    $('.btn-acc-edit-rute').click(function() {
                        let pk = $(this).data('pk');
                        $.ajax({ //ajax ambil data customer
                            type: "GET",
                            url: "<?php echo base_url('index.php/form/getrutebyid') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) { //jika ambil data sukses
                                data_temp = JSON.parse(data["temp_rute"])
                                $("#rute_id_edit").val(data["rute_id"]);
                                $("#customer_id_edit").val(data["customer_id"]);
                                $("#customer_name_edit").val(data["customer_name"]);
                                $("#rute_dari_edit").val(data_temp["rute_dari"]);
                                $("#rute_ke_edit").val(data_temp["rute_ke"]);
                                $("#rute_muatan_edit").val(data_temp["rute_muatan"]);
                                $("#ritase_edit").val(data["ritase"]);
                                $("#jenis_mobil_edit").val(data["jenis_mobil"]);
                                $("#rute_uj_engkel_edit").val(rupiah(data_temp["rute_uj_engkel"]));
                                $("#rute_tagihan_edit").val(rupiah(data_temp["rute_tagihan"]));
                                $("#rute_gaji_engkel_edit").val(rupiah(data_temp["rute_gaji_engkel"]));
                                $("#rute_keterangan_edit").val(data_temp["rute_keterangan"]);
                                $('#ACC').attr('onclick','acc_edit_rute('+data["rute_id"]+')');
                                $('#Tolak').attr('onclick','tolak_edit_rute('+data["rute_id"]+')');
                            }
                        });
                    });
                    $('.btn-acc-delete-rute').click(function() {
                        let pk = $(this).data('pk');
                        Swal.fire({
                            title: 'ACC Hapus Rute dan Muatan',
                            icon: "question",
                            text: 'Yakin anda ingin ACC Hapus Data Rute dan Muatan ini?',
                            showDenyButton: true,
                            showCancelButton:true,
                            denyButtonText: `Tolak`,
                            confirmButtonText: 'ACC',
                            denyButtonColor: '#808080',
                            confirmButtonColor: '#4BB543',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/accdeleterute/ACC') ?>",
                                    dataType: "text",
                                    data: {
                                        id: pk
                                    },
                                    success: function(data) {
                                        location.reload();
                                    }
                                });
                            }else if(result.isDenied){
                                $.ajax({
                                    type: "GET",
                                    url: "<?php echo base_url('index.php/form/accdeleterute/Ditolak') ?>",
                                    dataType: "text",
                                    data: {
                                        id: pk
                                    },
                                    success: function(data) {
                                        location.reload();
                                    }
                                });
                            }
                        })
                    });
                }
            });
        });
        $( "#form-edit-rute" ).submit(function( event ) {
            data_rute_new = new Object();
            data_rute_new.dari=$("#rute_dari_update").val();
            data_rute_new.ke=$("#rute_ke_update").val();
            data_rute_new.muatan=$("#rute_muatan_update").val();
            data_rute_new.uj=$("#rute_uj_engkel_update").val().replaceAll(".","");
            data_rute_new.tagihan=$("#rute_tagihan_update").val().replaceAll(".","");
            data_rute_new.gaji=$("#rute_gaji_engkel_update").val().replaceAll(".","");
            data_rute_new.keterangan=$("#rute_keterangan_update").val();
            if(JSON.stringify(data_rute_now) == JSON.stringify(data_rute_new)){
                alert( "Anda Belum Mengubah Data" );
                return false;
            }else{
                return true;
            }
        });
        function acc_edit_rute(id){
            $.ajax({
                type: "GET",
                url: "<?php echo base_url('index.php/form/acceditrute/ACC') ?>",
                dataType: "text",
                data: {
                    id: id
                },
                success: function(data) {
                    location.reload();
                }
            });
        }
        function tolak_edit_rute(id){
            $.ajax({
                type: "GET",
                url: "<?php echo base_url('index.php/form/acceditrute/Ditolak') ?>",
                dataType: "text",
                data: {
                    id: id
                },
                success: function(data) {
                    location.reload();
                }
            });
        }
    </script>
    <!-- End rute -->

    <!-- script alert-alert -->
    <script>
        $(document).ready(function() {
            var login = '<?= $this->session->flashdata('status-login'); ?>';
            var akun = '<?= $this->session->flashdata('status-add-akun'); ?>';
            var update_akun = '<?= $this->session->flashdata('status-update-akun'); ?>';
            var delete_akun = '<?= $this->session->flashdata('status-delete-akun'); ?>';
            var supir = '<?= $this->session->flashdata('status-add-supir'); ?>';
            var update_supir = '<?= $this->session->flashdata('status-update-supir'); ?>';
            var delete_supir = '<?= $this->session->flashdata('status-delete-supir'); ?>';
            var kendaraan = '<?= $this->session->flashdata('status-add-kendaraan'); ?>';
            var update_truck = '<?= $this->session->flashdata('status-update-truck'); ?>';
            var delete_kendaraan = '<?= $this->session->flashdata('status-delete-kendaraan'); ?>';
            var customer = '<?= $this->session->flashdata('status-add-customer'); ?>';
            var delete_customer = '<?= $this->session->flashdata('status-delete-customer'); ?>';
            var update_customer = '<?= $this->session->flashdata('status-update-customer'); ?>';
            var satuan = '<?= $this->session->flashdata('status-add-satuan'); ?>';
            var update_rute = '<?= $this->session->flashdata('status-update-satuan'); ?>';
            var delete_satuan = '<?= $this->session->flashdata('status-delete-satuan'); ?>';
            var merk = '<?= $this->session->flashdata('status-add-merk'); ?>';
            var invoice = '<?= $this->session->flashdata('status-insert-invoice'); ?>';
            var gaji = '<?= $this->session->flashdata('status-insert-slip-gaji'); ?>';
            var update_merk = '<?= $this->session->flashdata('status-update-merk'); ?>';
            var delete_merk = '<?= $this->session->flashdata('status-delete-merk'); ?>';
            var delete_bon = '<?= $this->session->flashdata('status-delete-bon'); ?>';
            var update_bon = '<?= $this->session->flashdata('status-update-bon'); ?>';
            var delete_invoice = '<?= $this->session->flashdata('status-delete-invoice'); ?>';
            var delete_jo = '<?= $this->session->flashdata('status-delete-jo'); ?>';
            var edit_jo = '<?= $this->session->flashdata('status-edit-jo'); ?>';
            var update_invoice = '<?= $this->session->flashdata('status-update-invoice'); ?>';
            var edit_invoice = '<?= $this->session->flashdata('status-edit-invoice'); ?>';
            var insert_payment_invoice = '<?= $this->session->flashdata('status-insert-payment-invoice'); ?>';
            var insert_payment_jo = '<?= $this->session->flashdata('status-insert-payment-jo'); ?>';
            var supir_jo = '<?= $this->session->flashdata('supir_jo'); ?>';
            var mobil_jo = '<?= $this->session->flashdata('mobil_jo'); ?>';
            var addjo = '<?= $this->session->flashdata('addjo'); ?>';
            var deletejo = '<?= $this->session->flashdata('deletejo'); ?>';
            if(login == "Berhasil"){
                Swal.fire({
                        title: "Berhasil Login",
                        icon: "success",
                        text: "Selamat Datang",
                        type: "success",
                        timer: 1500
                    });
            }
            if(akun == "Berhasil"){
                Swal.fire({
                        title: "Berhasil",
                        icon: "success",
                        text: "Menambahkan akun baru",
                        type: "success",
                        timer: 2000
                    });
            }
            if(addjo == "berhasil"){
                Swal.fire({
                        title: "Berhasil",
                        icon: "success",
                        text: "Menambahkan Job Order Baru",
                        type: "success",
                        timer: 2000
                    });
            }
            if(insert_payment_invoice == "Berhasil"){
                Swal.fire({
                        title: "Berhasil",
                        icon: "success",
                        text: "Menambahkan Data Payment Invoice",
                        type: "success",
                        timer: 2000
                    });
            }
            if(insert_payment_jo == "Berhasil"){
                Swal.fire({
                        title: "Berhasil",
                        icon: "success",
                        text: "Menambahkan Data Payment Job Order",
                        type: "success",
                        timer: 2000
                    });
            }
            if(invoice == "Berhasil"){
                Swal.fire({
                        title: "Berhasil",
                        icon: "success",
                        text: "Menambahkan Invoice baru",
                        type: "success",
                        timer: 2000
                    });
            }
            if(gaji == "Berhasil"){
                Swal.fire({
                        title: "Berhasil",
                        icon: "success",
                        text: "Menambahkan Slip Gaji Baru",
                        type: "success",
                        timer: 2000
                    });
            }
            if(supir_jo == "Berhasil"){
                Swal.fire({
                        title: "Berhasil",
                        icon: "success",
                        text: "Mengubah Supir",
                        type: "success",
                        timer: 2000
                    });
            }
            if(mobil_jo == "Berhasil"){
                Swal.fire({
                        title: "Berhasil",
                        icon: "success",
                        text: "Mengubah Mobil",
                        type: "success",
                        timer: 2000
                    });
            }
            if(customer == "Berhasil"){
                Swal.fire({
                        title: "Berhasil",
                        icon: "success",
                        text: "Menambahkan customer baru",
                        type: "success",
                        timer: 2000
                    });
            }
            if(update_akun == "Berhasil"){
                Swal.fire({
                        title: "Berhasil",
                        icon: "success",
                        text: "Mengubah data akun",
                        type: "success",
                        timer: 2000
                    });
            }
            if(edit_invoice == "Berhasil"){
                Swal.fire({
                        title: "Berhasil",
                        icon: "success",
                        text: "Mengubah Data Invoice",
                        type: "success",
                        timer: 2000
                    });
            }
            if(edit_jo == "Berhasil"){
                Swal.fire({
                        title: "Berhasil",
                        icon: "success",
                        text: "Mengubah Data Job Order",
                        type: "success",
                        timer: 2000
                    });
            }
            if(update_bon == "Berhasil"){
                Swal.fire({
                        title: "Berhasil",
                        icon: "success",
                        text: "Mengubah Data Nota Kasbon",
                        type: "success",
                        timer: 2000
                    });
            }
            if(update_truck == "Berhasil"){
                Swal.fire({
                        title: "Berhasil",
                        icon: "success",
                        text: "Mengubah data kendaraan",
                        type: "success",
                        timer: 2000
                    });
            }
            if(update_customer == "Berhasil"){
                Swal.fire({
                        title: "Berhasil",
                        icon: "success",
                        text: "Mengubah data customer",
                        type: "success",
                        timer: 2000
                    });
            }
            if(delete_akun == "Berhasil"){
                Swal.fire({
                        title: "Berhasil",
                        icon: "success",
                        text: "Menghapus akun",
                        type: "error",
                        timer: 2000
                    });
            }
            if(deletejo == "berhasil"){
                Swal.fire({
                        title: "Berhasil",
                        icon: "success",
                        text: "Menghapus Job Order",
                        type: "error",
                        timer: 2000
                    });
            }
            if(delete_bon == "Berhasil"){
                Swal.fire({
                        title: "Berhasil",
                        icon: "success",
                        text: "Menghapus Bon",
                        type: "error",
                        timer: 2000
                    });
            }
            if(supir == "Berhasil"){
                Swal.fire({
                        title: "Berhasil",
                        icon: "success",
                        text: "Menambahkan data driver",
                        type: "success",
                        timer: 2000
                    });
            }
            if(update_supir == "Berhasil"){
                Swal.fire({
                        title: "Berhasil",
                        icon: "success",
                        text: "Update data driver",
                        type: "success",
                        timer: 2000
                    });
            }
            if(delete_supir == "Berhasil"){
                Swal.fire({
                        title: "Berhasil Request Hapus",
                        icon: "success",
                        text: "Silakan Menunggu Validasi Supervisor",
                        type: "error",
                        timer: 2000
                    });
            }
            if(delete_invoice == "Berhasil"){
                Swal.fire({
                        title: "Hapus Data Invoice",
                        icon: "success",
                        text: "Berhasil Hapus Data Invoice",
                        type: "error",
                        timer: 2000
                    });
            }
            if(kendaraan == "Berhasil"){
                Swal.fire({
                        title: "Berhasil",
                        icon: "success",
                        text: "Menambah data kendaraan",
                        type: "success",
                        timer: 2000
                    });
            }
            if(delete_kendaraan == "Berhasil"){
                Swal.fire({
                        title: "Berhasil Request Hapus",
                        icon: "success",
                        text: "Silakan Menunggu Validasi Supervisor",
                        type: "error",
                        timer: 2000
                    });
            }
            if(satuan == "Berhasil"){
                Swal.fire({
                        title: "Berhasil",
                        icon: "success",
                        text: "Menambahkan data rute dan muatan",
                        type: "success",
                        timer: 2000
                    });
            }
            if(update_rute == "Berhasil"){
                Swal.fire({
                        title: "Berhasil",
                        icon: "success",
                        text: "Mengubah data rute dan satuan",
                        type: "success",
                        timer: 2000
                    });
            }
            if(delete_satuan == "Berhasil"){
                Swal.fire({
                        title: "Berhasil Request Hapus",
                        icon: "success",
                        text: "Silakan Menunggu Validasi Supervisor",
                        type: "error",
                        timer: 2000
                    });
            }
            if(delete_customer == "Berhasil"){
                Swal.fire({
                        title: "Berhasil Request Hapus",
                        icon: "success",
                        text: "Silakan Menunggu Validasi Supervisor",
                        type: "error",
                        timer: 2000
                    });
            }
            if(merk == "Berhasil"){
                Swal.fire({
                        title: "Berhasil",
                        icon: "success",
                        text: "Menambahkan data merk",
                        type: "success",
                        timer: 2000
                    });
            }
            if(update_merk == "Berhasil"){
                Swal.fire({
                        title: "Berhasil",
                        icon: "success",
                        text: "Update data merk",
                        type: "success",
                        timer: 2000
                    });
            }
            if(delete_merk == "Berhasil"){
                Swal.fire({
                        title: "Berhasil Request Hapus",
                        icon: "success",
                        text: "Silakan Menunggu Validasi Supervisor",
                        type: "error",
                        timer: 2000
                    });
            }
        });
    </script>
    <!-- end script alert -->

    <script> //script set tanggal saat ini
        $(function(){
            //proses tanggal
            var date = new Date();
            if((date.getMonth()+1)<10){
                $("#update_status_tanggal_nonaktif").val(date.getDate()+"-0"+(date.getMonth()+1)+"-"+date.getFullYear());
                $("#tanggal_jo").val(date.getDate()+"-0"+(date.getMonth()+1)+"-"+date.getFullYear());
                $("#tanggal_gaji").val(date.getDate()+"-0"+(date.getMonth()+1)+"-"+date.getFullYear());
            }else{
                $("#update_status_tanggal_nonaktif").val(date.getDate()+"-"+(date.getMonth()+1)+"-"+date.getFullYear());
                $("#tanggal_jo").val(date.getDate()+"-"+(date.getMonth()+1)+"-"+date.getFullYear());
                $("#tanggal_gaji").val(date.getDate()+"-"+(date.getMonth()+1)+"-"+date.getFullYear());
            }
        });
    </script>

    <script> //script input tanggal
        function tanggal_berlaku(a){
            // alert(a.id);
            Swal.fire({
                title: "Loading",
                icon: "success",
                text: "Mohon Tunggu Sebentar",
                type: "success",
                timer: 1
            });
            $("#"+a.id).datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true,
                todayHighlight: true,
            });
        }
    </script>

    <script> //script pilih JO untuk invoice
        $(document).ready(function() {
            var table = null;
            table = $('#pilih-jo').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [0, 'asc']
                ],
                "ajax": {
                    "url": "<?php echo base_url('index.php/form/view_pilih_jo') ?>",
                    "type": "POST",
                    'data': function(data) {
                        data.customer = $('#customer_id').val();
                    }
                },
                "paging":false,
                "deferRender": true,
                "columns": [
                    {
                        "data": "Jo_id",
                        className: 'text-center'
                    },
                    {
                        "data": "tanggal_muat",
                        className: 'text-center',
                        render: function(data, type, row) {
                            return change_tanggal(data);
                        }
                    },
                    {
                        "data": "tanggal_bongkar",
                        className: 'text-center',
                        render: function(data, type, row) {
                            return change_tanggal(data);
                        }
                    },
                    {
                        "data": "mobil_no",
                        className: 'text-center'
                    },
                    {
                        "data": "muatan"
                    },
                    {
                        "data": "asal"
                    },
                    {
                        "data": "tujuan"
                    },
                    {
                        "data": "tonase",
                        render: function(data, type, row) {
                            let html = rupiah(data);
                            return html;
                        }
                    },
                    {
                        "data": "tagihan",
                        render: function(data, type, row) {
                            let html = "Rp."+rupiah(data);
                            return html;
                        }
                    },
                    {
                        "data": "total_tagihan",
                        render: function(data, type, row) {
                            let html = "Rp."+rupiah(data);
                            return html;
                        }
                    },
                    {
                        "data": "Jo_id",
                        className: 'text-center font-weight-bold',
                        "orderable": false,
                        render: function(data, type, row) {
                            let html = "<input class='btn-check-invoice' data-pk='"+data+"' data-toggle='toggle' type='checkbox' data-size='medium' data-onstyle='success' data-offstyle='danger'>";
                            return html;
                        }
                    },
                    {
                        "data": "Jo_id",
                        className: 'text-center',
                        "orderable": false,
                        render: function(data, type, row) {
                            let html = "<a class='btn btn-light btn-sm' target='_blank'  href='<?= base_url('index.php/detail/detail_jo/"+data+"/JO')?>'><i class='fas fa-eye'></i></a>";
                            return html;
                        }
                    },
                    {
                        "data":"tipe_tonase"
                    }
                ],   
                drawCallback: function() {
                    data_jo_saat_ini = $("#data_jo").val().split(",");
                    var data_jo = [];
                    for(i=0;i<data_jo_saat_ini.length;i++){
                        data_jo.push(data_jo_saat_ini[i]);
                    }
                    $(".btn-check-invoice").click(function() {
                        let pk = $(this).data('pk');
                        if(data_jo.includes(pk)!=true){
                            data_jo.push(pk);
                        }else{
                            data_jo.splice(data_jo.indexOf(pk), 1 );
                        }
                        // alert(data_jo);
                        $("#data_jo").val(data_jo);
                        $.ajax({
                            type: "GET",
                            url: "<?php echo base_url('index.php/detail/getjo') ?>",
                            dataType: "JSON",
                            data: {
                                id: pk
                            },
                            success: function(data) { //jika ambil data sukses
                                if(data_jo.includes(pk)==true){
                                    if($("#invoice_tonase").val()=="" || $("#invoice_tonase").val()=="0"){
                                        var tonase = parseInt(data["tonase"]);
                                        var total = parseInt(data["total_tagihan"]);
                                    }else{
                                        var tonase = parseInt($("#invoice_tonase").val().replaceAll(".",""))+parseInt(data["tonase"]);
                                        var total = parseInt($("#invoice_total").val().replaceAll(".",""))+parseInt(data["total_tagihan"]);
                                    }
                                    if($("#invoice_ppn").val()=="Ya"){
                                        var ppn = total*0.1;
                                    }else{
                                        var ppn = 0;
                                    }
                                    var grand_total=total+ppn;
                                    $("#invoice_tonase").val(rupiah(tonase));
                                    $("#invoice_total").val(rupiah(total));
                                    $("#invoice_ppn_nilai").val(rupiah(ppn));
                                    $("#invoice_grand_total").val(rupiah(grand_total));
                                }else{
                                    var tonase = parseInt($("#invoice_tonase").val().replaceAll(".",""))-parseInt(data["tonase"]);
                                    var total = parseInt($("#invoice_total").val().replaceAll(".",""))-parseInt(data["total_tagihan"]);
                                    $("#invoice_tonase").val(rupiah(tonase));
                                    $("#invoice_total").val(rupiah(total));
                                    if($("#invoice_ppn").val()=="Ya"){
                                        var ppn = total*0.1;
                                    }else{
                                        var ppn = 0;
                                    }
                                    var grand_total=total+ppn;
                                    $("#invoice_ppn_nilai").val(rupiah(ppn));
                                    $("#invoice_grand_total").val(rupiah(grand_total));
                                }
                            }
                        });
                    });
                }
            });
            $("#customer_id").change(function() {
                table.ajax.reload();
            });
            $("#invoice_ppn").change(function() {
                var total = $("#invoice_total").val().replaceAll(".","");
                total = total.replaceAll(",00","");
                if(total!=""){
                    if($("#invoice_ppn").val()=="Ya"){
                        var ppn=total*0.1;
                    }else{
                        var ppn=0;
                    }
                    var grand_total=parseInt(total)+parseInt(ppn);
                    $("#invoice_ppn_nilai").val(rupiah(ppn));
                    $("#invoice_grand_total").val(rupiah(grand_total));
                }
            });
        });
    </script>

    <script>
        function upload_foto(a){
            var filePath = a.value;
            var fileSize = a.files[0].size;
            var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
            if (!allowedExtensions.exec(filePath)) {
                Swal.fire({
                    title: "Upload Gagal",
                    icon: "error",
                    text: "File Harus Berupa Gambar JPG,JPEG,PNG",
                    type: "error",
                    timer: 2000
                });
                a.value = '';
            }
            if (fileSize>2000000) {
                Swal.fire({
                    title: "Upload Gagal",
                    icon: "error",
                    text: "Ukuran File Harus Kurang Dari 2 MB",
                    type: "error",
                    timer: 2000
                });
                a.value = '';
            }
        }
    </script>

    <script>
        function change_tanggal(data){
            if(data=="" || data==null){
                return "";
            }else if(data=="0000-00-00"){
                return "";
            }else{
                var data_tanggal = data.split("-");
                var tanggal = data_tanggal[2]+"-"+data_tanggal[1]+"-"+data_tanggal[0];
                return tanggal;
            }
        }
    </script>
    
    <!-- cek aktifitas pengguna -->
    <script>
        $(document).ready(function() {
            const idleDurationSecs = 900;
            const redirectUrl = '<?= base_url("index.php/login/logout")?>';
            let idleTimeout;

            const resetIdleTimeout = function() {
                if(idleTimeout){
                    clearTimeout(idleTimeout);
                }
                $.ajax({
                    type: "GET",
                    url: "<?php echo base_url('index.php/detail/getuseraktif') ?>",
                    dataType: "text",
                    success: function(data) { //jika ambil data sukses
                        if(data=="Tidak Aktif" || data=="x"){
                            location.href = redirectUrl;
                        }
                    }
                });
                idleTimeout = setTimeout(() => location.href = redirectUrl, idleDurationSecs * 1000);
            };
            
            // Key events for reset time
            resetIdleTimeout();
            window.onkeypress = resetIdleTimeout;
            window.click = resetIdleTimeout;
            window.onclick = resetIdleTimeout;
            window.onmousemove = resetIdleTimeout;
            window.onscroll = resetIdleTimeout;

        });
    </script>
    <script>
        function countDown() {
            $.ajax({
                type: "GET",
                url: "<?php echo base_url('index.php/login/set_login') ?>",
                dataType: "text",
                success: function(data) { //jika ambil data sukses
                }
            });
            setTimeout("countDown()", 1000);
        }
        countDown();
    </script>
</body>

</html>