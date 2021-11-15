<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
		$this->load->model('model_form');//load model
        $this->load->model('model_home');//load model
        $this->load->model('model_detail');//load model
    }

    public function change_tanggal($tanggal){
        if($tanggal==""){
            return "";
        }else{
            $tanggal_array = explode("-",$tanggal);
            return $tanggal_array[2]."-".$tanggal_array[1]."-".$tanggal_array[0];   
        }
    }
    
    // fungsi view form
        public function edit_jo($jo_id){
            //end generate jo id
            if(!isset($_SESSION["user"])){
                $this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
            $data["customer"] = $this->model_home->getcustomer();
            $data["mobil"] = $this->model_home->gettruck();
            $data["supir"] = $this->model_home->getsupir();
            $data["jo"] = $this->model_home->getjobyid($jo_id);
            $data["page"] = "JO_page";
            $data["collapse_group"] = "Job_Order";
            $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
            if(json_decode($data["akun_akses"]["akses"])[14]==0){
                redirect(base_url());
            }
            $this->load->view('header',$data);
            $this->load->view('sidebar');
            $this->load->view('form/edit_jo');
            // $this->load->view('footer');
        }
        public function joborder(){
            $jo_id = $this->model_form->getjoid();
            $isi_jo_id = [];
            for($i=0;$i<count($jo_id);$i++){
                $isi_jo_id[] = $jo_id[$i]["Jo_id"];
            }
            if(count($isi_jo_id)==0){
                $isi_jo_id[]=0;
            }
            //generate jo id
            $new_jo_id = "";
            for($i=0;$i<6-strlen(max($isi_jo_id)+1);$i++){
                $new_jo_id .= "0";
            }
            $data["new_jo_id"] = $new_jo_id.(max($isi_jo_id)+1);
            //end generate jo id
            if(!isset($_SESSION["user"])){
    			$this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
            $data["customer"] = $this->model_home->getcustomer();
            $data["mobil"] = $this->model_home->gettruck();
            $data["supir"] = $this->model_home->getsupir();
            $data["page"] = "Buat_JO_page";
            $data["collapse_group"] = "Job_Order";
            $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
            if(json_decode($data["akun_akses"]["akses"])[14]==0){
                redirect(base_url());
            }
            $this->load->view('header',$data);
            $this->load->view('sidebar');
            $this->load->view('form/joborder');
            $this->load->view('footer');
        }

        public function bon(){
            $bon_id = $this->model_form->getbonid();
            $isi_bon_id = [];
            for($i=0;$i<count($bon_id);$i++){
                $explode_bon = explode("-",$bon_id[$i]["bon_id"]);
                if(count($explode_bon)>1){
                    if($explode_bon[2]==date("m") && $explode_bon[3]==date('Y')){
                        $isi_bon_id[] = $explode_bon[0];
                    }
                }
            }
            if(count($isi_bon_id)==0){
                $isi_bon_id[]=0;
            }
            if(!isset($_SESSION["user"])){
    			$this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
            $data["bon_id_new"] = (max($isi_bon_id)+1)."-BON-".date("m")."-".date("Y");
            $data["supir"] = $this->model_home->getsupir();
            $data["page"] = "Buat_Bon_page";
            $data["collapse_group"] = "Kasbon";
            $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
            if(json_decode($data["akun_akses"]["akses"])[13]==0){
                redirect(base_url());
            }
            $this->load->view('header',$data);
            $this->load->view('sidebar');
            $this->load->view('form/form_bon',$data);
            $this->load->view('footer');
        }

        public function view_pilih_jo(){
            $customer_id = $this->input->post("customer");
            $search = $_POST['search']['value'];
            $order_index = $_POST['order'][0]['column'];
            $order_field = $_POST['columns'][$order_index]['data'];
            $order_ascdesc = $_POST['order'][0]['dir'];
            $sql_total = $this->model_form->count_all_jo($customer_id);
            $sql_data = $this->model_form->filter_jo($order_field, $order_ascdesc,$customer_id,$search);
            $sql_filter = $this->model_form->count_filter_jo($customer_id,$search);
            $callback = array(
                'draw' => $_POST['draw'],
                'recordsTotal' => $sql_total,
                'recordsFiltered' => $sql_filter,
                'data' => $sql_data
            );

            header('Content-Type: application/json');
            echo json_encode($callback);
        }
        public function edit_invoice($invoice_id)
        {
            if(!isset($_SESSION["user"])){
    			$this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
            $data["invoice"] = $this->model_detail->getinvoicebyid($invoice_id);
            $data["customer"] =  $this->model_home->getcustomerbyid($data["invoice"][0]["customer_id"]);
            $data["page"] = "Invoice_Customer_page";
            $data["collapse_group"] = "Invoice";
            $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
            if(json_decode($data["akun_akses"]["akses"])[3]==0){
                redirect(base_url());
            }
            $this->load->view('header',$data);
            $this->load->view('sidebar');
            $this->load->view('form/edit_invoice');
            $this->load->view('footer');
        }
        public function edit_slip($slip_id)
        {
            $data["no_slip_gaji"]=$slip_id;
            $data["slip"] = $this->model_detail->getpembayaranupahbyid($slip_id);
            $data["isi_jo"] = "";
            for($i=0;$i<count($data["slip"]);$i++){
                $data["isi_jo"] .= $data["slip"][$i]["Jo_id"].",";
            }
            $data["jo"] = $this->model_detail->getjobbysupirbulan($data["slip"][0]["supir_id"],"x","x","x");
            $data["supir"] = $this->model_home->getsupirbyid($data["slip"][0]["supir_id"]);
            if(!isset($_SESSION["user"])){
    			$this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
            $data["page"] = "Laporan_Gaji_page";
            $data["collapse_group"] = "Penggajian";
            $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
            if(json_decode($data["akun_akses"]["akses"])[3]==0){
                redirect(base_url());
            }
            $this->load->view('header',$data);
            $this->load->view('sidebar');
            $this->load->view('form/edit_slip');
            // $this->load->view('footer');
        }
    // end fungsi view form

    // fungsi insert
        public function insert_invoice(){
            $data=array(
                "customer_id"=>$this->input->post("customer_id"),
                "invoice_kode"=>$this->input->post("invoice_id"),
                "tanggal_invoice"=>$this->change_tanggal($this->input->post("invoice_tgl")),
                "total_tonase"=>str_replace(".","",$this->input->post("invoice_tonase")),
                "total"=>str_replace(".","",$this->input->post("invoice_total")),
                "ppn"=>str_replace(".","",$this->input->post("invoice_ppn_nilai")),
                "grand_total"=>str_replace(".","",$this->input->post("invoice_grand_total")),
                "batas_pembayaran"=>$this->input->post("invoice_payment"),
                "tanggal_batas_pembayaran"=>date('Y-m-d', strtotime('+'.$this->input->post("invoice_payment").' days', strtotime($this->change_tanggal($this->input->post("invoice_tgl"))))),
                "invoice_keterangan"=>$this->input->post("invoice_keterangan"),
                "status_bayar"=>"Belum Lunas",
                "user_invoice"=>$_SESSION["user"]."(".date("d-m-Y H:i:s").")",
                "sisa"=>str_replace(".","",$this->input->post("invoice_grand_total"))
            );
            $this->session->set_flashdata('status-insert-invoice', 'Berhasil');
            $data_jo = explode(",",$this->input->post("data_jo"));
            $this->model_form->insert_invoice($data,$data_jo);
            redirect(base_url("index.php/home/invoice"));
        }
        public function insert_payment_invoice(){
            $data=array(
                "invoice_id"=>$this->input->post("invoice_kode"),
                "payment_invoice_tgl"=>$this->change_tanggal($this->input->post("payment_invoice_tgl")),
                "payment_invoice_nominal"=>str_replace(".","",$this->input->post("payment_invoice_nominal")),
                "payment_invoice_jenis"=>$this->input->post("payment_invoice_jenis"),
                "payment_invoice_keterangan"=>$this->input->post("payment_invoice_keterangan"),
            );
            $this->session->set_flashdata('status-insert-payment-invoice', 'Berhasil');
            $this->model_form->insert_payment_invoice($data);
            redirect(base_url("index.php/home/invoice_customer"));
        }

        public function insert_payment_gaji(){
            $data=array(
                "pembayaran_upah_id"=>$this->input->post("pembayaran_upah_id"),
                "payment_upah_tgl"=>$this->change_tanggal($this->input->post("payment_upah_tgl")),
                "payment_upah_nominal"=>str_replace(".","",$this->input->post("payment_upah_nominal")),
                "payment_upah_jenis"=>$this->input->post("payment_upah_jenis"),
                "payment_upah_keterangan"=>$this->input->post("payment_upah_keterangan"),
            );
            $this->session->set_flashdata('status-insert-payment-upah', 'Berhasil');
            $this->model_form->insert_payment_upah($data);
            redirect(base_url("index.php/home/report_gaji"));
        }

        public function insert_payment_jo(){
            $data=array(
                "jo_id"=>$this->input->post("jo_id"),
                "payment_jo_tgl"=>$this->change_tanggal($this->input->post("payment_jo_tgl")),
                "payment_jo_nominal"=>str_replace(".","",$this->input->post("payment_jo_nominal")),
                "payment_jo_jenis"=>$this->input->post("payment_jo_jenis"),
                "payment_jo_keterangan"=>$this->input->post("payment_jo_keterangan"),
            );
            $this->session->set_flashdata('status-insert-payment-jo', 'Berhasil');
            $this->model_form->insert_payment_jo($data);
            redirect(base_url("index.php/home"));
        }

        public function insert_JO(){
            if($this->input->post("nominal_tambahan")==""){
                $nominal_tambahan = 0;
            }else{
                $nominal_tambahan = str_replace(".","",$this->input->post("nominal_tambahan"));
            }
            $data["customer"] = $this->model_home->getcustomerbyid($this->input->post("Customer"));
            $data["data"]=array(
                "Jo_id"=>$this->input->post("Jo_id"),
                "mobil_no"=>$this->input->post("Kendaraan"),
                "supir_id"=>$this->input->post("Supir"),
                "muatan"=>$this->input->post("Muatan"),
                "asal"=>$this->input->post("Asal"),
                "tujuan"=>$this->input->post("Tujuan"),
                "uang_jalan"=>str_replace(".","",$this->input->post("Uang")),
                "tanggal_surat"=>$this->change_tanggal($this->input->post("tanggal_jo")),
                "keterangan"=>$this->input->post("Keterangan"),
                "customer_id"=>$this->input->post("Customer"),
                "status"=>"Dalam Perjalanan",
                "status_upah"=>"Belum Dibayar",
                "upah"=>str_replace(".","",$this->input->post("Upah")),
                "tagihan"=>str_replace(".","",$this->input->post("Tagihan")),
                "user"=>$_SESSION["user"]."(".date("d-m-Y H:i:s").")",
                "jenis_tambahan"=>$this->input->post("jenis_tambahan"),
                "nominal_tambahan"=>$nominal_tambahan,
                "uang_total"=>str_replace(".","",$this->input->post("uang_jalan_total")),
                "sisa"=>str_replace(".","",$this->input->post("uang_jalan_total")),
                "tipe_tonase"=>$this->input->post("Tipe_Tonase")
            );
            $this->session->set_flashdata("addjo","berhasil");
            $this->model_form->insert_JO($data["data"]);
            $data["jo_id"] = $data["data"]["Jo_id"];
            $data["asal"] = "insert";
            $data["tipe_jo"] = "reguler";
            $data["supir"] = $this->model_home->getsupirbyid($data["data"]["supir_id"]);
            $data["mobil"] = $this->model_home->getmobilbyid($data["data"]["mobil_no"]);
            redirect(base_url('index.php/home'));
        }
        public function insert_bon(){
            date_default_timezone_set('Asia/Jakarta');
            $data["data"]=array(
                "bon_id"=>$this->input->post("bon_id"),
                "supir_id"=>$this->input->post("Supir_bon"),
                "bon_jenis"=>$this->input->post("Jenis"),
                "bon_nominal"=>str_replace(".","",$this->input->post("Nominal")),
                "bon_keterangan"=>$this->input->post("Keterangan"),
                "bon_tanggal"=>$this->change_tanggal($this->input->post("Tanggal")),
                "pembayaran_upah_id"=>"-",
                "user"=>$_SESSION["user"]."(".date("d-m-Y H:i:s").")",
                "status_hapus"=>"NO"
            );
            $this->model_form->insert_bon($data["data"]);
            $data["supir"] = $this->model_home->getsupirbyid($data["data"]["supir_id"]);
            $data["asal"] = "insert";
            $data["data_jo"] = array("Jo_id"=>"0");
            $this->load->view("print/bon_print",$data);
        }
        public function insert_akun(){
            $data_akun=array(
                "akun_name"=>$this->input->post("nama"),
                "akun_role"=>$this->input->post("role"),
                "akses"=>'["0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0"]'
            );
            $this->model_form->insert_akun($data_akun);
            $akun = $this->model_form->getakunbyname($data_akun["akun_name"]);
            $data_user=array(
                "akun_id" => $akun["akun_id"],
                "username"=>$this->input->post("username"),
                "password"=>sha1($this->input->post("password")),
                "status_aktif"=>"Tidak Aktif"
            );
            $this->model_form->insert_user($data_user);
			$this->session->set_flashdata('status-add-akun', 'Berhasil');
            redirect(base_url("index.php/home/akun"));
        }
        public function insert_customerMenu(){
            $data=array(
                "customer_name"=>$this->input->post("Customer"),
                "customer_alamat"=>$this->input->post("customer_alamat"),
                "customer_kontak_person"=>$this->input->post("customer_kontak_person"),
                "customer_telp"=>$this->input->post("customer_telp"),
                "customer_keterangan"=>$this->input->post("customer_keterangan"),
                "status_hapus"=>"No",
                "validasi"=>"Pending",
                "validasi_edit"=>"ACC",
                "validasi_delete"=>"ACC",
            );
            // echo var_dump($data);
            $this->model_form->insert_customer($data);
			$this->session->set_flashdata('status-add-customer', 'Berhasil');
            redirect(base_url("index.php/home/customer"));
        }
        public function insert_supir(){
            $config['upload_path'] = './assets/berkas/driver'; //letak folder file yang akan diupload
            $config['allowed_types'] = 'jpg|png|img|jpeg'; //jenis file yang dapat diterima
            $config['max_size'] = '2000'; // kb
            $this->load->library('upload', $config); //deklarasi library upload (config)
            if ($this->upload->do_upload('file_foto')) {
                $this->upload->data();
                $file_foto =  $this->upload->data('file_name');
            }else{
                $file_foto="";
            }
            if ($this->upload->do_upload('file_sim')) {
                $this->upload->data();
                $file_sim =  $this->upload->data('file_name');
            }else{
                $file_sim="";
            }
            if ($this->upload->do_upload('file_ktp')) {
                $this->upload->data();
                $file_ktp =  $this->upload->data('file_name');
            }else{
                $file_ktp="";
            }
            $data=array(
                "supir_name"=>$this->input->post("Supir"),
                "supir_kasbon"=>0,
                "status_jalan"=>"Tidak Jalan",
                "status_hapus"=>"NO",
                "supir_alamat"=>$this->input->post("supir_alamat"),
                "supir_telp"=>$this->input->post("supir_telp"),
                "supir_keterangan"=>$this->input->post("supir_keterangan"),
                "supir_ktp"=>$this->input->post("supir_ktp"),
                "supir_sim"=>$this->input->post("supir_sim"),
                "supir_panggilan"=>$this->input->post("supir_panggilan"),
                "status_aktif"=>"Aktif",
                "supir_tgl_aktif"=>$this->change_tanggal($this->input->post("supir_tgl_aktif")),
                "supir_tgl_lahir"=>$this->change_tanggal($this->input->post("supir_tgl_lahir")),
                "supir_tempat_lahir"=>$this->input->post("supir_tempat_lahir"),
                "file_foto"=>$file_foto,
                "file_sim"=>$file_sim,
                "file_ktp"=>$file_ktp,
                "darurat_nama"=>$this->input->post("darurat_nama"),
                "darurat_telp"=>$this->input->post("darurat_telp"),
                "darurat_referensi"=>$this->input->post("darurat_referensi"),
                "supir_tgl_sim"=>$this->change_tanggal($this->input->post("supir_tgl_sim")),
                "validasi"=>"Pending",
                "validasi_edit"=>"ACC",
                "validasi_delete"=>"ACC",
            );
            // echo var_dump($data)."<br><br>";
            $this->model_form->insert_supir($data);
			$this->session->set_flashdata('status-add-supir', 'Berhasil');
            redirect(base_url("index.php/home/penggajian"));
        }
        public function insert_truck(){
            $config['upload_path'] = './assets/berkas/kendaraan'; //letak folder file yang akan diupload
            $config['allowed_types'] = 'jpg|png|img|jpeg'; //jenis file yang dapat diterima
            $config['max_size'] = '2000'; // kb
            $file_stnk="";
            $file_foto="";
            $this->load->library('upload', $config); //deklarasi library upload (config)
            if ($this->upload->do_upload('file_foto')) {
                $this->upload->data();
                $file_foto =  $this->upload->data('file_name');
            }
            if ($this->upload->do_upload('file_STNK')) {
                $this->upload->data();
                $file_stnk =  $this->upload->data('file_name');
            }

            $data=array(
                "mobil_no"=>$this->input->post("mobil_no"),
                "mobil_jenis"=>$this->input->post("mobil_jenis"),
                "mobil_no_rangka"=>$this->input->post("mobil_no_rangka"),
                "mobil_no_mesin"=>$this->input->post("mobil_no_mesin"),
                "mobil_usaha"=>$this->input->post("mobil_usaha"),
                "mobil_berlaku_usaha"=>$this->change_tanggal($this->input->post("mobil_berlaku_usaha")),
                "mobil_bpkb"=>$this->input->post("mobil_bpkb"),
                "status_jalan"=>"Tidak Jalan",
                "status_hapus"=>"NO",
                "mobil_keterangan"=>$this->input->post("mobil_keterangan"),
                "merk_id"=>$this->input->post("merk_id"),
                "mobil_merk"=>$this->input->post("mobil_merk"),
                "mobil_type"=>$this->input->post("mobil_type"),
                "mobil_dump"=>$this->input->post("mobil_dump"),
                "mobil_tahun"=>$this->input->post("mobil_tahun"),
                "mobil_berlaku"=>$this->change_tanggal($this->input->post("mobil_berlaku")),
                "mobil_pajak"=>$this->change_tanggal($this->input->post("mobil_pajak")),
                "mobil_stnk"=>$this->input->post("mobil_stnk"),
                "mobil_kir"=>$this->input->post("mobil_kir"),
                "mobil_ijin_bongkar"=>$this->input->post("mobil_ijin_bongkar"),
                "mobil_berlaku_kir"=>$this->change_tanggal($this->input->post("mobil_berlaku_kir")),
                "mobil_berlaku_ijin_bongkar"=>$this->change_tanggal($this->input->post("mobil_berlaku_ijin_bongkar")),
                "validasi"=>"Pending",
                "validasi_edit"=>"ACC",
                "validasi_delete"=>"ACC",
                "file_foto"=>$file_foto,
                "file_stnk"=>$file_stnk
            );
            // echo var_dump($data);
            $this->model_form->insert_truck($data);
			$this->session->set_flashdata('status-add-kendaraan', 'Berhasil');
            redirect(base_url("index.php/home/truck"));
        }
        public function insert_merk(){
            $data=array(
                "merk_nama"=>$this->input->post("merk_nama"),
                "merk_type"=>$this->input->post("merk_type"),
                "merk_jenis"=>$this->input->post("merk_jenis"),
                "merk_dump"=>$this->input->post("merk_dump"),
                "status_hapus"=>"NO",
                "validasi"=>"Pending",
                "validasi_edit"=>"ACC",
                "validasi_delete"=>"ACC",
            );
            $this->model_form->insert_merk($data);
			$this->session->set_flashdata('status-add-merk', 'Berhasil');
            redirect(base_url("index.php/home/merk"));
        }
        public function insert_rute(){
            $rute_gaji_engkel = str_replace(".","",$this->input->post("rute_gaji_engkel"));
            $data=array(
                "customer_id"=>$this->input->post("customer_id"),
                "rute_dari"=>$this->input->post("rute_dari"),
                "rute_ke"=>$this->input->post("rute_ke"),
                "rute_muatan"=>$this->input->post("rute_muatan"),
                "jenis_mobil"=>$this->input->post("jenis_mobil"),
                "rute_uj_engkel"=>str_replace(".","",$this->input->post("rute_uj_engkel")),
                "rute_tagihan"=>str_replace(".","",$this->input->post("rute_tagihan")),
                "rute_gaji_engkel"=>$rute_gaji_engkel,
                "rute_status_hapus"=>"NO",
                "validasi_rute"=>"Pending",
                "validasi_rute_edit"=>"ACC",
                "validasi_rute_delete"=>"ACC",
                "rute_keterangan"=>$this->input->post("rute_keterangan"),
                "ritase"=>$this->input->post("Ritase")
            );
            $this->model_form->insert_rute($data);
			$this->session->set_flashdata('status-add-satuan', 'Berhasil');
            redirect(base_url("index.php/home/satuan"));
        }
    // end fungsi insert
    
    // fungsi update
        public function update_rute(){
            $data=array(
                "customer_id"=>$this->input->post("customer_id_update"),
                "rute_dari"=>$this->input->post("rute_dari_update"),
                "rute_ke"=>$this->input->post("rute_ke_update"),
                "rute_muatan"=>$this->input->post("rute_muatan_update"),
                "rute_uj_engkel"=>str_replace(".","",$this->input->post("rute_uj_engkel_update")),
                // "rute_uj_tronton"=>str_replace(".","",$this->input->post("rute_uj_tronton_update")),
                "rute_tagihan"=>str_replace(".","",$this->input->post("rute_tagihan_update")),
                "rute_gaji_engkel"=>str_replace(".","",$this->input->post("rute_gaji_engkel_update")),
                // "rute_gaji_tronton"=>str_replace(".","",$this->input->post("rute_gaji_tronton_update")),
                // "rute_gaji_engkel_rumusan"=>str_replace(".","",$this->input->post("rute_gaji_engkel_rumusan_update")),
                // "rute_gaji_tronton_rumusan"=>str_replace(".","",$this->input->post("rute_gaji_tronton_rumusan_update")),
                // "rute_tonase"=>str_replace(".","",$this->input->post("rute_tonase_update")),
                "rute_keterangan"=>str_replace(".","",$this->input->post("rute_keterangan_update")),
                // "ritase"=>str_replace(".","",$this->input->post("Ritase_update")),
            );
            $this->model_form->update_rute($data,$this->input->post("rute_id_update"));
            $this->session->set_flashdata('status-update-satuan', 'Berhasil');
            redirect(base_url("index.php/home/satuan"));
        }
        public function update_supir(){
            $file_ktp = null;
            $file_sim = null;
            $file_foto = null;
            $supir_id = $this->input->post("supir_id");
            $data_supir = $this->model_form->getsupirname( $supir_id);
            $config['upload_path'] = './assets/berkas/driver'; //letak folder file yang akan diupload
            $config['allowed_types'] = 'jpg|png|img|jpeg'; //jenis file yang dapat diterima
            $config['max_size'] = '2000'; // kb
            $this->load->library('upload', $config); //deklarasi library upload (config)
            if ($this->upload->do_upload('file_foto_update')) {
                $this->upload->data();
                $file_foto =  $this->upload->data('file_name');
            }
            if ($this->upload->do_upload('file_sim_update')) {
                $this->upload->data();
                $file_sim =  $this->upload->data('file_name');
            }
            if ($this->upload->do_upload('file_ktp_update')) {
                $this->upload->data();
                $file_ktp =  $this->upload->data('file_name');
            }
            if($file_foto == null){
                $file_foto = $data_supir["file_foto"];
            }
            if($file_sim == null){
                $file_sim = $data_supir["file_sim"];
            }
            if($file_ktp == null){
                $file_ktp = $data_supir["file_ktp"];
            }
            $data = array(
                "supir_name" => $this->input->post("supir_name"),
                "supir_panggilan" => $this->input->post("supir_panggilan_update"),
                "supir_tempat_lahir" => $this->input->post("supir_tempat_lahir_update"),
                "supir_tgl_lahir" => $this->change_tanggal($this->input->post("supir_tgl_lahir_update")),
                "supir_alamat" => $this->input->post("supir_alamat_update"),
                "supir_telp" => $this->input->post("supir_telp_update"),
                "supir_ktp" => $this->input->post("supir_ktp_update"),
                "supir_sim" => $this->input->post("supir_sim_update"),
                "supir_tgl_sim" => $this->change_tanggal($this->input->post("supir_tgl_sim_update")),
                "supir_tgl_aktif" => $this->change_tanggal($this->input->post("supir_tgl_aktif_update")),
                "darurat_nama" => $this->input->post("darurat_nama_update"),
                "darurat_telp" => $this->input->post("darurat_telp_update"),
                "darurat_referensi" => $this->input->post("darurat_referensi_update"),
                "supir_keterangan" => $this->input->post("supir_keterangan_update"),
                "file_foto"=>$file_foto,
                "file_sim"=>$file_sim,
                "file_ktp"=>$file_ktp
            );
            $this->model_form->update_supir($data,$supir_id);
            $this->session->set_flashdata('status-update-supir', 'Berhasil');
            redirect(base_url("index.php/home/penggajian"));
        }
        public function update_truck(){
            $file_foto = null;
            $file_stnk = null;
            $data_mobil = $this->model_detail->gettruckbyid( $this->input->post("mobil_no_old"));
            $config['upload_path'] = './assets/berkas/kendaraan'; //letak folder file yang akan diupload
            $config['allowed_types'] = 'jpg|png|img|jpeg'; //jenis file yang dapat diterima
            $config['max_size'] = '2000'; // kb
            $this->load->library('upload', $config); //deklarasi library upload (config)
            if ($this->upload->do_upload('file_foto_update')) {
                $this->upload->data();
                $file_foto =  $this->upload->data('file_name');   
            }
            if ($this->upload->do_upload('file_STNK_update')) {
                $this->upload->data();
                $file_stnk =  $this->upload->data('file_name');
            }
            if($file_foto == null){
                $file_foto = $data_mobil["file_foto"];
            }
            if($file_stnk == null){
                $file_stnk = $data_mobil["file_stnk"];
            }
            $data = array(
                "mobil_no" => $this->input->post("mobil_no_update"),
                "mobil_stnk" => $this->input->post("mobil_stnk_update"),
                "mobil_berlaku" => $this->change_tanggal($this->input->post("mobil_berlaku_update")),
                "mobil_pajak" => $this->change_tanggal($this->input->post("mobil_pajak_update")),
                "mobil_kir" => $this->input->post("mobil_kir_update"),
                "mobil_berlaku_kir" => $this->change_tanggal($this->input->post("mobil_berlaku_kir_update")),
                "mobil_ijin_bongkar" => $this->input->post("mobil_ijin_bongkar_update"),
                "mobil_berlaku_ijin_bongkar" => $this->change_tanggal($this->input->post("mobil_berlaku_ijin_bongkar_update")),
                "mobil_keterangan" => $this->input->post("mobil_keterangan_update"),
                "mobil_jenis"=>$this->input->post("mobil_jenis_update"),
                "mobil_no_rangka"=>$this->input->post("mobil_no_rangka_update"),
                "mobil_no_mesin"=>$this->input->post("mobil_no_mesin_update"),
                "mobil_usaha"=>$this->input->post("mobil_usaha_update"),
                "mobil_berlaku_usaha"=>$this->change_tanggal($this->input->post("mobil_berlaku_usaha_update")),
                "mobil_bpkb"=>$this->input->post("mobil_bpkb_update"),
                "merk_id"=>$this->input->post("merk_id_update"),
                "mobil_merk"=>$this->input->post("mobil_merk_update"),
                "mobil_type"=>$this->input->post("mobil_type_update"),
                "mobil_dump"=>$this->input->post("mobil_dump_update"),
                "mobil_tahun"=>$this->input->post("mobil_tahun_update"),
                "file_foto"=>$file_foto,
                "file_stnk"=>$file_stnk
            );
            $this->model_form->update_truck($data,$this->input->post("mobil_no_old"));
            $this->session->set_flashdata('status-update-truck', 'Berhasil');
            redirect(base_url("index.php/home/truck"));
        }
        public function update_merk(){
            $data = array(
                "merk_nama" => $this->input->post("merk_nama_update"),
                "merk_type" => $this->input->post("merk_type_update"),
                "merk_jenis" => $this->input->post("merk_jenis_update"),
                "merk_dump" => $this->input->post("merk_dump_update")
            );
            $merk_id = $this->input->post("merk_id_update");
            $this->model_form->update_merk($data,$merk_id);
            $this->session->set_flashdata('status-update-merk', 'Berhasil');
            redirect(base_url("index.php/home/merk"));
        }
        public function update_customer(){
            $data = array(
                "customer_id" => $this->input->post("customer_id_update"),
                "customer_name" => $this->input->post("customer_name_update"),
                "customer_alamat" => $this->input->post("customer_alamat_update"),
                "customer_kontak_person" => $this->input->post("customer_kontak_person_update"),
                "customer_telp" => $this->input->post("customer_telp_update"),
                "customer_keterangan" => $this->input->post("customer_keterangan_update"),
            );
            // echo var_dump($data);
            $this->model_form->update_customer($data);
            $this->session->set_flashdata('status-update-customer', 'Berhasil');
            redirect(base_url("index.php/home/customer"));
        }
        public function update_akun(){
            $akun = $this->model_form->getakunbyid($this->input->post("akun_id"));
            $password = $this->input->post("password_update");
            if($akun["password"]!=$this->input->post("password_update")){
                $password = sha1($password);
            }
            $data = array(
                "akun_id" => $this->input->post("akun_id"),
                "akun_name" => $this->input->post("akun_name"),
                "akun_role" => $this->input->post("role_update"),
                "username" => $this->input->post("username_update"),
                "password" => $password,
            );
            $this->model_form->update_akun($data);
            $this->session->set_flashdata('status-update-akun', 'Berhasil');
            redirect(base_url("index.php/home/akun"));
        }
        public function update_jo_status($supir,$mobil){
            if($this->input->post("status")!="Dibatalkan"){
                $data_jo = $this->model_home->getjobyid($this->input->post("jo_id"));
                $keterangan = $data_jo["keterangan"]."===<br>".$this->input->post("Keterangan");
                if($data_jo["tipe_tonase"]=="Ritase"){
                    $total_tagihan=$data_jo["tagihan"];
                }else{
                    $total_tagihan=$data_jo["tagihan"]*str_replace(".","",$this->input->post("tonase"));
                }
                $data = array(
                    "jo_id" => $this->input->post("jo_id"),
                    "status" => $this->input->post("status"),
                    "tanggal_bongkar"=>$this->change_tanggal($this->input->post("tgl_bongkar")),
                    "tanggal_muat"=>$this->change_tanggal($this->input->post("tgl_muat")),
                    "biaya_lain"=>str_replace(".","",$this->input->post("biaya_lain")),
                    "user_closing"=>$_SESSION["user"],
                    "tonase"=>str_replace(".","",$this->input->post("tonase")),
                    "total_tagihan"=>$total_tagihan,
                    "keterangan"=>$keterangan,
                    // "tanggal_bongkar"=>date('Y-m-d'),
                );
                $this->model_form->update_jo_status($data,$supir,$mobil);
                redirect(base_url("index.php/home"));
            }else{
                $this->updatejobatal($this->input->post("jo_id"));
            }
        }
        public function updatejobatal($Jo_id){
            $data_jo = $this->model_home->getjobyid($Jo_id);
            $data["data_jo"]=$data_jo;
            // $bon_id = $this->model_form->getbonid();
            // $isi_bon_id = [];
            // for($i=0;$i<count($bon_id);$i++){
            //     $explode_bon = explode("-",$bon_id[$i]["bon_id"]);
            //     if(count($explode_bon)>1){
            //         if($explode_bon[2]==date("m") && $explode_bon[3]==date('Y')){
            //             $isi_bon_id[] = $explode_bon[0];
            //         }
            //     }
            // }
            // if(count($isi_bon_id)==0){
            //     $isi_bon_id[]=0;
            // }
            // date_default_timezone_set('Asia/Jakarta');
            // $data["data"]=array(
            //     "bon_id"=>(max($isi_bon_id)+1)."-BON-".date("m")."-".date("Y"),
            //     "supir_id"=>$data_jo["supir_id"],
            //     "bon_jenis"=>"Pembatalan JO",
            //     "bon_nominal"=>$data_jo["uang_jalan_bayar"],
            //     "bon_keterangan"=>"Pembatalan JO",
            //     "bon_tanggal"=>date("Y-m-d"),
            //     "pembayaran_upah_id"=>"-",
            //     "user"=>$_SESSION["user"]."(".date("d-m-Y H:i:s").")",
            //     "status_hapus"=>"NO"
            // );
            // $data["bon_id"] = (max($isi_bon_id)+1)."-BON-".date("m")."-".date("Y");
            // $this->model_form->insert_bon($data["data"]);
            $this->model_detail->update_jo_dibatalkan($data_jo["Jo_id"],$data_jo["supir_id"],$data_jo["mobil_no"],$data_jo["uang_jalan"]);
            $data["supir"] = $this->model_home->getsupirbyid($data["data"]["supir_id"]);
            $data["asal"] = "batal JO";
            $this->load->view("print/bon_print",$data);
        }
        public function update_status_aktif_supir(){
            $data = array(
                "supir_id"=>$this->input->post("update_status_supir_id"),
                "supir_tgl_nonaktif"=>$this->change_tanggal($this->input->post("update_status_tanggal_nonaktif")),
                "status_aktif"=>$this->input->post("update_status_status_aktif")
            );
            $this->model_form->update_status_aktif_supir($data);
            redirect(base_url("index.php/home/penggajian"));
        }
        public function update_konfigurasi($akun_id){
            $konfigurasi = [$this->input->post("cekpage1"),$this->input->post("cekpage2"),$this->input->post("cekpage3"),
            $this->input->post("cekpage4"),$this->input->post("cekpage5"),$this->input->post("cekpage6"),
            $this->input->post("cekpage7"),"1","1",
            $this->input->post("cekpage10"),$this->input->post("cekpage11"),$this->input->post("cekpage12"),
            $this->input->post("cekpage13"),$this->input->post("cekpage14"),$this->input->post("cekpage15"),
            $this->input->post("cekpage16"),$this->input->post("cekpage17"),$this->input->post("cekpage18"),
            $this->input->post("cekpage19"),$this->input->post("cekpage20"),$this->input->post("cekpage21")];
            // for($i=0;$i<count($konfigurasi);$i++){
            //     echo $konfigurasi[$i]."<br>";
            // }
            $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
            $_SESSION["payment_jo"] = json_decode($data["akun_akses"]["akses"])[20];
            $_SESSION["payment_invoice"] = json_decode($data["akun_akses"]["akses"])[18];
            $_SESSION["payment_slip"] = json_decode($data["akun_akses"]["akses"])[19];
            
            $this->model_form->update_konfigurasi($akun_id,$konfigurasi);
            redirect(base_url("index.php/home/akun"));
        }
        public function update_bon(){
            $bon_id=$this->input->post("bon_edit");
            $data=array(
                "bon_jenis"=>$this->input->post("Jenis_edit"),
                "bon_nominal"=>str_replace(".","",$this->input->post("Nominal_edit")),
                "bon_keterangan"=>$this->input->post("Keterangan_edit"),
                "bon_tanggal"=>$this->change_tanggal($this->input->post("Tanggal_edit"))
            );
            $this->model_form->update_bon($data,$bon_id);
            $this->session->set_flashdata('status-update-bon', 'Berhasil');
            redirect(base_url("index.php/home/bon"));
        }
        public function update_invoice(){
            $data=array(
                "customer_id"=>$this->input->post("customer_id"),
                "invoice_kode"=>$this->input->post("invoice_id"),
                "tanggal_invoice"=>$this->change_tanggal($this->input->post("invoice_tgl_edit")),
                "total_tonase"=>str_replace(".","",$this->input->post("invoice_tonase")),
                "total"=>str_replace(".","",$this->input->post("invoice_total")),
                "ppn"=>str_replace(".","",$this->input->post("invoice_ppn_nilai")),
                "grand_total"=>str_replace(".","",$this->input->post("invoice_grand_total")),
                "batas_pembayaran"=>$this->input->post("invoice_payment"),
                "tanggal_batas_pembayaran"=>date('Y-m-d', strtotime('+'.$this->input->post("invoice_payment").' days', strtotime($this->change_tanggal($this->input->post("invoice_tgl_edit"))))),
                "invoice_keterangan"=>$this->input->post("invoice_keterangan"),
                "sisa"=>str_replace(".","",$this->input->post("invoice_grand_total")),
            );
            $this->session->set_flashdata('status-edit-invoice', 'Berhasil');
            $data_jo = explode(",",$this->input->post("data_jo"));
            $this->model_form->update_invoice($data,$data_jo);
            redirect(base_url("index.php/home/invoice_customer"));
        }
        public function update_JO(){
            if($this->input->post("nominal_tambahan_update")==""){
                $nominal_tambahan = 0;
            }else{
                $nominal_tambahan = str_replace(".","",$this->input->post("nominal_tambahan_update"));
            }
            $Jo_id=$this->input->post("Jo_id_update");
            $data_jo = $this->model_home->getjobyid($Jo_id);
            if($this->input->post("Kendaraan_update")==""){
                $mobil_no = $data_jo["mobil_no"];
            }else{
                $mobil_no = $this->input->post("Kendaraan_update");
            }
            if($this->input->post("Supir_update")==""){
                $supir_id=$data_jo["supir_id"];
            }else{
                $supir_id=$this->input->post("Supir_update");
            }
            if($this->input->post("status_update")=="Dalam Perjalanan"){
                $data=array(
                    "mobil_no"=>$mobil_no,
                    "supir_id"=>$supir_id,
                    "tanggal_surat"=>$this->change_tanggal($this->input->post("tanggal_jo_update")),
                    "keterangan"=>$this->input->post("Keterangan_update"),
                    "jenis_tambahan"=>$this->input->post("jenis_tambahan_update"),
                    "nominal_tambahan"=>$nominal_tambahan,
                    "uang_total"=>str_replace(".","",$this->input->post("uang_jalan_total_update")),
                    "status"=>$this->input->post("status_update"),
                    "tanggal_muat"=>null,
                    "tanggal_bongkar"=>null,
                    "tonase"=>null,
                    "biaya_lain"=>null,
                    "muatan"=>$this->input->post("Muatan"),
                    "asal"=>$this->input->post("Asal"),
                    "tujuan"=>$this->input->post("Tujuan"),
                    "customer_id"=>$this->input->post("Customer_update"),
                    "uang_jalan"=>str_replace(".","",$this->input->post("Uang_update")),
                    "upah"=>str_replace(".","",$this->input->post("Upah_update")),
                    "tagihan"=>str_replace(".","",$this->input->post("Tagihan_update")),
                    "tipe_tonase"=>$this->input->post("Tipe_Tonase_update"),
                    "sisa"=>str_replace(".","",$this->input->post("uang_jalan_total"))
                );
            }else{
                $data=array(
                    "mobil_no"=>$mobil_no,
                    "supir_id"=>$supir_id,
                    "tanggal_surat"=>$this->change_tanggal($this->input->post("tanggal_jo_update")),
                    "keterangan"=>$this->input->post("Keterangan_update")."===".$this->input->post("Keterangan_status_update"),
                    "jenis_tambahan"=>$this->input->post("jenis_tambahan_update"),
                    "nominal_tambahan"=>$nominal_tambahan,
                    "uang_total"=>str_replace(".","",$this->input->post("uang_jalan_total_update")),
                    "status"=>$this->input->post("status_update"),
                    "tanggal_muat"=>$this->change_tanggal($this->input->post("tgl_muat_update")),
                    "tanggal_bongkar"=>$this->change_tanggal($this->input->post("tgl_bongkar_update")),
                    "tonase"=>str_replace(".","",$this->input->post("tonase_update")),
                    "biaya_lain"=>str_replace(".","",$this->input->post("biaya_lain_update")),
                    "muatan"=>$this->input->post("Muatan"),
                    "asal"=>$this->input->post("Asal"),
                    "tujuan"=>$this->input->post("Tujuan"),
                    "customer_id"=>$this->input->post("Customer_update"),
                    "uang_jalan"=>str_replace(".","",$this->input->post("Uang_update")),
                    "upah"=>str_replace(".","",$this->input->post("Upah_update")),
                    "tagihan"=>str_replace(".","",$this->input->post("Tagihan_update")),
                    "tipe_tonase"=>$this->input->post("Tipe_Tonase_update"),
                    "sisa"=>str_replace(".","",$this->input->post("uang_jalan_total"))
                );
            }
            $this->session->set_flashdata('status-edit-jo', 'Berhasil');
            $this->model_form->update_JO($data,$Jo_id);
            redirect(base_url("index.php/home"));
        }
        public function update_payment_invoice(){
            $payment_id=$this->input->post("payment_invoice_id_update");
            $data=array(
                "invoice_id"=>$this->input->post("invoice_kode_update"),
                "payment_invoice_tgl"=>$this->change_tanggal($this->input->post("payment_invoice_tgl_update")),
                "payment_invoice_nominal"=>str_replace(".","",$this->input->post("payment_invoice_nominal_update")),
                "payment_invoice_jenis"=>$this->input->post("payment_invoice_jenis_update"),
                "payment_invoice_keterangan"=>$this->input->post("payment_invoice_keterangan_update"),
            );
            $this->session->set_flashdata('status-edit-payment-invoice', 'Berhasil');
            $invoice_id = $this->model_form->update_payment_invoice($data,$payment_id);
            redirect(base_url("index.php/payment/payment_invoice/").$invoice_id);
        }

        public function update_payment_upah(){
            $payment_id=$this->input->post("payment_upah_id_update");
            $data=array(
                "pembayaran_upah_id"=>$this->input->post("pembayaran_upah_id_update"),
                "payment_upah_tgl"=>$this->change_tanggal($this->input->post("payment_upah_tgl_update")),
                "payment_upah_nominal"=>str_replace(".","",$this->input->post("payment_upah_nominal_update")),
                "payment_upah_jenis"=>$this->input->post("payment_upah_jenis_update"),
                "payment_upah_keterangan"=>$this->input->post("payment_upah_keterangan_update"),
            );
            $this->session->set_flashdata('status-edit-payment-upah', 'Berhasil');
            $upah_id = $this->model_form->update_payment_upah($data,$payment_id);
            redirect(base_url("index.php/payment/payment_gaji/").$upah_id);
        }

        public function update_payment_jo(){
            $payment_id=$this->input->post("payment_jo_id_update");
            $data=array(
                "jo_id"=>$this->input->post("jo_id_update"),
                "payment_jo_tgl"=>$this->change_tanggal($this->input->post("payment_jo_tgl_update")),
                "payment_jo_nominal"=>str_replace(".","",$this->input->post("payment_jo_nominal_update")),
                "payment_jo_jenis"=>$this->input->post("payment_jo_jenis_update"),
                "payment_jo_keterangan"=>$this->input->post("payment_jo_keterangan_update"),
            );
            $this->session->set_flashdata('status-edit-payment-jo', 'Berhasil');
            $jo_id = $this->model_form->update_payment_jo($data,$payment_id);
            redirect(base_url("index.php/payment/payment_jo/").$jo_id);
        }
    //end fungsi update

    //fungsi delete
        public function deletesupir(){
            $supir_id = $this->input->get("id");
            $this->model_form->deletesupir($supir_id);
            $this->session->set_flashdata('status-delete-supir', 'Berhasil');
            echo $supir_id;
        }
        public function deletemerk(){
            $merk_id = $this->input->get("id");
            $this->model_form->deletemerk($merk_id);
            $this->session->set_flashdata('status-delete-merk', 'Berhasil');
            echo $merk_id;
        }
        public function deletecustomer(){
            $customer_id = $this->input->get("id");
            $this->model_form->deletecustomer($customer_id);
            $this->session->set_flashdata('status-delete-customer', 'Berhasil');
            echo $customer_id;
        }
        public function deletebon(){
            $bon_id = $this->input->get("id");
            $this->model_form->deletebon($bon_id);
            $this->session->set_flashdata('status-delete-bon', 'Berhasil');
            echo $bon_id;
        }
        public function deleterute(){
            $rute_id = $this->input->get("id");
            $this->model_form->deleterute($rute_id);
            $this->session->set_flashdata('status-delete-satuan', 'Berhasil');
            echo $rute_id;
        }
        public function deleteakun(){
            $akun_id = $this->input->get("id");
            $this->model_form->deleteakun($akun_id);
            $this->session->set_flashdata('status-delete-akun', 'Berhasil');
            echo $akun_id;
        }
        public function deletetruck(){
            $mobil_no = $this->input->get("id");
            $this->model_form->deletetruck($mobil_no);
            $this->session->set_flashdata('status-delete-kendaraan', 'Berhasil');
            echo $mobil_no;
        }
        public function deletejo($jo_id){
            $data_jo = $this->model_home->getjobyid($jo_id);
            $data["data_jo"]=$data_jo;
            // $bon_id = $this->model_form->getbonid();
            // $isi_bon_id = [];
            // for($i=0;$i<count($bon_id);$i++){
            //     $explode_bon = explode("-",$bon_id[$i]["bon_id"]);
            //     if(count($explode_bon)>1){
            //         if($explode_bon[2]==date("m") && $explode_bon[3]==date('Y')){
            //             $isi_bon_id[] = $explode_bon[0];
            //         }
            //     }
            // }
            // if(count($isi_bon_id)==0){
            //     $isi_bon_id[]=0;
            // }
            // date_default_timezone_set('Asia/Jakarta');
            // $data["data"]=array(
            //     "bon_id"=>(max($isi_bon_id)+1)."-BON-".date("m")."-".date("Y"),
            //     "supir_id"=>$data_jo["supir_id"],
            //     "bon_jenis"=>"Pembatalan JO",
            //     "bon_nominal"=>$data_jo["uang_jalan_bayar"],
            //     "bon_keterangan"=>"Pembatalan JO",
            //     "bon_tanggal"=>date("Y-m-d"),
            //     "user"=>$_SESSION["user"]."(".date("d-m-Y H:i:s").")",
            //     "pembayaran_upah_id"=>"-",
            //     "status_hapus"=>"NO"
            // );
            // $data["bon_id"] = (max($isi_bon_id)+1)."-BON-".date("m")."-".date("Y");
            // $this->model_form->insert_bon($data["data"]);
            $data["supir"] = $this->model_home->getsupirbyid($data["data"]["supir_id"]);
            $data["asal"] = "Hapus JO";
            $this->model_form->deletejo($jo_id);
            $this->session->set_flashdata("deletejo","berhasil");
            redirect(base_url('index.php/home'));
        }
        public function deleteinvoice($invoice_id){
            $this->model_form->deleteinvoice($invoice_id);
            $this->session->set_flashdata('status-delete-invoice', 'Berhasil');
            redirect(base_url('index.php/home/invoice_customer'));
        }
        public function deletepaymentinvoice($payment_id){
            $invoice_id = $this->model_form->deletepaymentinvoice($payment_id);
            $this->session->set_flashdata('status-delete-payment-invoice', 'Berhasil');
            redirect(base_url('index.php/payment/payment_invoice/').$invoice_id);
        }
        public function deletepaymentupah($payment_id){
            $pembayaran_upah_id = $this->model_form->deletepaymentupah($payment_id);
            $this->session->set_flashdata('status-delete-payment-upah', 'Berhasil');
            redirect(base_url('index.php/payment/payment_gaji/').$pembayaran_upah_id);
        }
        public function deletepaymentjo($payment_id){
            $jo_id = $this->model_form->deletepaymentjo($payment_id);
            $this->session->set_flashdata('status-delete-payment-jo', 'Berhasil');
            redirect(base_url('index.php/payment/payment_jo/').$jo_id);
        }
        public function deleteslip($slip_id){
            $this->model_form->deleteslip($slip_id);
            $this->session->set_flashdata('status-delete-slip', 'Berhasil');
            redirect(base_url('index.php/home/report_gaji'));
        }
    //end fungsi delete

    //fungsi acc
        public function accsupir($validasi){
            $supir_id = $this->input->get("id");
            $this->model_form->accsupir($supir_id,$validasi);
            echo $supir_id;
        }
        public function accdeletesupir($validasi){
            $supir = $this->input->get("id");
            $this->model_form->accdeletesupir($supir,$validasi);
            echo $supir;
        }
        public function acceditsupir($validasi){
            $supir_id = $this->input->get("id");
            $this->model_form->acceditsupir($supir_id,$validasi);
            echo $supir_id;
        }

        public function acccustomer($validasi){
            $customer_id = $this->input->get("id");
            $this->model_form->acccustomer($customer_id,$validasi);
            echo $customer_id;
        }
        public function accdeletecustomer($validasi){
            $customer_id = $this->input->get("id");
            $this->model_form->accdeletecustomer($customer_id,$validasi);
            echo $customer_id;
        }
        public function acceditcustomer($validasi){
            $customer_id = $this->input->get("id");
            $this->model_form->acceditcustomer($customer_id,$validasi);
            echo $customer_id;
        }

        public function acctruck($validasi){
            $truck_id = $this->input->get("id");
            $this->model_form->acctruck($truck_id,$validasi);
            echo $truck_id;
        }
        public function accdeletetruck($validasi){
            $mobil_no = $this->input->get("id");
            $this->model_form->accdeletetruck($mobil_no,$validasi);
            echo $mobil_no;
        }
        public function accedittruck($validasi){
            $mobil_no = $this->input->get("id");
            $this->model_form->accedittruck($mobil_no,$validasi);
            echo $mobil_no;
        }

        public function accrute($validasi){
            $rute_id = $this->input->get("id");
            $this->model_form->accrute($rute_id,$validasi);
            echo $rute_id;
        }
        public function accdeleterute($validasi){
            $rute_id = $this->input->get("id");
            $this->model_form->accdeleterute($rute_id,$validasi);
            echo $rute_id;
        }
        public function acceditrute($validasi){
            $rute_id = $this->input->get("id");
            $this->model_form->acceditrute($rute_id,$validasi);
            echo $rute_id;
        }

        public function accmerk($validasi){
            $merk_id = $this->input->get("id");
            $this->model_form->accmerk($merk_id,$validasi);
            echo $merk_id;
        }
        public function accdeletemerk($validasi){
            $merk_id = $this->input->get("id");
            $this->model_form->accdeletemerk($merk_id,$validasi);
            echo $merk_id;
        }
        public function acceditmerk($validasi){
            $merk_id = $this->input->get("id");
            $this->model_form->acceditmerk($merk_id,$validasi);
            echo $merk_id;
        }
    //end fungsi acc

    //fungsi get
        public function getsupirname(){
            $supir_id = $this->input->get("id");
            $supir = $this->model_form->getsupirname($supir_id);
            echo json_encode($supir);
        }
        public function getrutebyid(){
            $rute_id = $this->input->get("id");
            $rute = $this->model_form->getrutebyid($rute_id);
            echo json_encode($rute);
        }
        public function getallmobil(){
            $mobil = $this->model_form->getallmobil();
            echo json_encode($mobil);
        }
        public function getbonsupir(){
            $supir_id = $this->input->get('id');
            $data = $this->model_form->getbonbysupir($supir_id);
            echo $data["supir_kasbon"];
        }
        public function getakunbyid(){
            $akun_id = $this->input->get('id');
            $data = $this->model_form->getakunbyid($akun_id);
            echo json_encode($data);
        }
    //end fungsi get

    //fungsi lain
        public function generate_terbilang($uang){
            $uang = abs($uang);
            $huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "sebelas");
            $temp = "";

            if ($uang < 12) {
                $temp = " ". $huruf[$uang];
            } else if ($uang <20) {
                $temp = $this->generate_terbilang($uang - 10). " Belas";
            } else if ($uang < 100) {
                $temp = $this->generate_terbilang($uang/10)." Puluh". $this->generate_terbilang($uang % 10);
            } else if ($uang < 200) {
                $temp = " Seratus" . $this->generate_terbilang($uang - 100);
            } else if ($uang < 1000) {
                $temp = $this->generate_terbilang($uang/100) . " Ratus" . $this->generate_terbilang($uang % 100);
            } else if ($uang < 2000) {
                $temp = " Seribu" . $this->generate_terbilang($uang - 1000);
            } else if ($uang < 1000000) {
                $temp = $this->generate_terbilang($uang/1000) . " Ribu" . $this->generate_terbilang($uang % 1000);
            } else if ($uang < 1000000000) {
                $temp = $this->generate_terbilang($uang/1000000) . " Juta" . $this->generate_terbilang($uang % 1000000);
            }     
            return $temp;
        }
        public function generate_terbilang_fix($uang){
            if($uang != "x"){
                echo $this->generate_terbilang(str_replace(".","",$uang))." Rupiah";
            }else{
                echo "";
            }
        }
    //end fungsi lain

    // fungsi form joborder
        public function getrutebycustomer(){
            $customer_id = $this->input->post("customer_id");
            $mobil_no = $this->input->post("mobil_no");
            $rute = $this->model_form->getrutebycustomer($customer_id,$mobil_no);
            echo json_encode($rute);      
        }
        public function getrutebymuatan(){
            $customer_id = $this->input->post("customer_id");
            $muatan = $this->input->post("rute_muatan");
            $mobil = $this->input->post("mobil_no");
            $rute = $this->model_form->getrutebymuatan($customer_id,$muatan,$mobil);
            echo json_encode($rute);        
        }
        public function getrutebyasal(){
            $customer_id = $this->input->post("customer_id");
            $muatan = $this->input->post("rute_muatan");
            $rute_dari = $this->input->post("rute_asal");
            $mobil = $this->input->post("mobil_no");
            $rute = $this->model_form->getrutebydari($customer_id,$muatan,$rute_dari,$mobil);
            echo json_encode($rute);        
        }
        public function getrutefix(){
            $data = array(
                "customer_id" => $this->input->post("customer_id"),
                "muatan" => $this->input->post("rute_muatan"),
                "rute_dari" => $this->input->post("rute_asal"),
                "rute_ke" => $this->input->post("rute_ke"),
                "mobil" => $this->input->post("mobil_no")
            );   
            $rute = $this->model_form->getrutefix($data);
            echo json_encode($rute);        
        }
        public function getmobilbyjenis(){
            $mobil_jenis = $this->input->post("mobil_jenis");
            $mobil = $this->model_form->getmobilbyjenis($mobil_jenis);
            echo json_encode($mobil);        
        }
        public function getmobilbyno(){
            $mobil_no = $this->input->post("mobil_no");
            $mobil = $this->model_form->getmobilbyno($mobil_no);
            echo json_encode($mobil);        
        }
        public function getrutetonase(){
            $data = array(
                "customer_id" => $this->input->post("customer_id"),
                "muatan" => $this->input->post("rute_muatan"),
                "rute_dari" => $this->input->post("rute_asal"),
                "rute_ke" => $this->input->post("rute_ke")
            );   
            $rute = $this->model_form->getrutetonase($data);
            echo json_encode($rute);        
        }
    // end fungsi form joborder
    public function generate_selisih_tanggal($tanggal_sim){
        $tanggal_now = date("Y-m-d");
        $tgl1 = new DateTime($tanggal_now);
        $tgl2 = new DateTime($tanggal_sim);
        $d = $tgl2->diff($tgl1)->days + 1;
        echo $d;
    }

    public function konfigurasi($akun_id){
        if(!isset($_SESSION["user"])){
            $this->session->set_flashdata('status-login', 'False');
            redirect(base_url());
        }
        $data["akun"]=$this->model_form->getakunbyid($akun_id);
        $data["page"] = "Akun_page";
        $data["collapse_group"] = "Konfigurasi";
        $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
        if(json_decode($data["akun_akses"]["akses"])[11]==0){
            redirect(base_url());
        }
        $this->load->view('header',$data);
        $this->load->view('sidebar');
        $this->load->view('form/konfigurasi',$data);
        $this->load->view('footer');
    }
    
    public function konfirmasi_jo($jo_id){
        if(!isset($_SESSION["user"])){
            $this->session->set_flashdata('status-login', 'False');
            redirect(base_url());
        }
        $data["page"] = "JO_page";
        $data["collapse_group"] = "Job_Order";
        $data["data_jo"]=$this->model_home->getjobyid($jo_id);
        $this->load->view('header',$data);
        $this->load->view('sidebar');
        $this->load->view('form/konfirmasi_jo',$data);
        $this->load->view('footer');
    }
}
