<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detail extends CI_Controller {
    // contruck
        public function __construct()
        {
            parent::__construct();
            $this->load->model('model_home');//load model
            $this->load->model('model_detail');//load model
            $this->load->model('model_form');//load model
            $this->load->model('model_print');//load model
        }
    // end contruck

    public function getuseraktif(){
        $user = $this->model_detail->get_user_by_id($_SESSION["user_aktif"]);
        if($user){
            echo $user["status_aktif"];
        }else{
            echo "x";
        }
    }
    public function change_tanggal($tanggal){
        if($tanggal==""){
            return "";
        }else{
            $tanggal_array = explode("-",$tanggal);
            return $tanggal_array[2]."-".$tanggal_array[1]."-".$tanggal_array[0];   
        }
    }

    //fungsi untuk Detail JO dan invoice
        public function updatesupirjo($jo_id,$supir_id_old){
            $this->model_detail->updatesupirjo($jo_id,$this->input->post("Supir"),$supir_id_old);
    		$this->session->set_flashdata('supir_jo', 'Berhasil');
            redirect(base_url("index.php/detail/detail_jo/".$jo_id."/JO"));
        }
        public function updatemobiljo($jo_id,$mobil_no_old){
            $this->model_detail->updatemobiljo($jo_id,$this->input->post("Mobil"),str_replace("%20"," ",$mobil_no_old));
    		$this->session->set_flashdata('mobil_jo', 'Berhasil');
            redirect(base_url("index.php/detail/detail_jo/".$jo_id."/JO"));
        }
        public function detail_jo($Jo_id,$asal)
        {
            if(!isset($_SESSION["user"])){
    			$this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
            $data["jo"] = $this->model_home->getjobyid($Jo_id);
            $data["slip_gaji"] = $this->model_detail->getpembayaranupahbyid($data["jo"]["pembayaran_upah_id"]);
            if(count($data["slip_gaji"])==0){
                $data["slip_gaji"] = array(
                    array(
                        "user_upah"=>"",
                        "pembayaran_upah_id"=>"",
                        "pembayaran_upah_tanggal"=>"",
                    )
                );
            }
            $data["invoice"] = $this->model_detail->getinvoicebyid($data["jo"]["invoice_id"]); 
            $data["customer"] = $this->model_home->getcustomerbyid($data["jo"]["customer_id"]);
            $data["mobil"] = $this->model_home->getmobilbyid($data["jo"]["mobil_no"]);
            $data["supir"] = $this->model_home->getsupirbyid($data["jo"]["supir_id"]);
            // $data["all_supir"] = $this->model_detail->getsupir();
            // $data["all_mobil"] = $this->model_detail->getmobil($data["mobil"]["mobil_jenis"]);
            if($asal=="JO"){
                $data["page"] = "JO_page";
                $data["collapse_group"] = "Job_Order";
            }else if($asal=="uang_jalan"){
                $data["page"] = "Laporan_Uang_Jalan_page";
                $data["collapse_group"] = "Laporan";
            }else{
                $data["page"] = "Laporan_page";
                $data["collapse_group"] = "Laporan";
            }
            $data["tipe_jo"]="reguler";
            $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
            if(json_decode($data["akun_akses"]["akses"])[1]==0 && json_decode($data["akun_akses"]["akses"])[8]==0 && json_decode($data["akun_akses"]["akses"])[7]==0){
                redirect(base_url());
            }
            $this->load->view('header',$data);
            $this->load->view('sidebar');
            $this->load->view('detail/joborder');
            $this->load->view('footer');
        }
        public function detail_invoice($invoice_id)
        {
            if(!isset($_SESSION["user"])){
    			$this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
            $data["invoice"] = $this->model_detail->getinvoicebyid(str_replace("%20"," ",$invoice_id));
            $data["customer"] = $this->model_home->getcustomerbyid($data["invoice"][0]["customer_id"]);
            $data["page"] = "Invoice_Customer_page";
            $data["collapse_group"] = "Invoice";
            $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
            if(json_decode($data["akun_akses"]["akses"])[4]==0){
                redirect(base_url());
            }
            $this->load->view('header',$data);
            $this->load->view('sidebar');
            $this->load->view('detail/invoice');
            $this->load->view('footer');
        }

        public function updateUJ($jo_id){
            $data_jo = $this->model_home->getjobyid($jo_id);
            $keterangan = $data_jo["keterangan"]."<br>".$this->input->post("Keterangan");
            $uj = $data_jo["uang_jalan_bayar"]+str_replace(".","",$this->input->post("uang_jalan_bayar"));
            $this->model_detail->updateUJ($jo_id,$keterangan,$uj);
            redirect(base_url("index.php/detail/detail_jo/").$jo_id."/JO");
        }

        public function updateinvoice(){
            $invoice_kode = $this->input->post("invoice-kode");
            $this->model_detail->updateinvoice($invoice_kode);
            redirect(base_url("index.php/detail/detail_invoice/").$invoice_kode."/Invoice");
        }

        public function getjo(){
            $jo_id = $this->input->get('id');
            $data = $this->model_home->getjobyid($jo_id);
            echo json_encode($data);       
        }
        public function getjokonfirmasi(){
            $jo_id = $this->input->get('id');
            $data = $this->model_home->getjobyidkonfirmasi($jo_id);
            echo json_encode($data);       
        }
    //end fungsi untuk Detail jo dan invoice

    //fungsi untuk Detail customer
        public function detail_customer($customer_id)
        {
            
            if(!isset($_SESSION["user"])){
    			$this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
            $data["customer"] = $this->model_home->getcustomerbyid($customer_id);
            $data["page"] = "Invoice_Customer_page";
            $data["collapse_group"] = "Invoice";
            $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
            if(json_decode($data["akun_akses"]["akses"])[4]==0){
                redirect(base_url());
            }
            $this->load->view('header',$data);
            $this->load->view('sidebar');
            $this->load->view('detail/customer',$data);
            $this->load->view('footer');
        }
        function getcustomer()
        {
            $customer_id = $this->input->get('id');
            $data = $this->model_home->getcustomerbyid($customer_id);
            echo json_encode($data);
        }
    //end fungsi untuk Detail customer

    //fungsi untuk Detail bon
        function getbon()
        {
            $bon_id = $this->input->get('id');
            $data = $this->model_detail->getbonbyid($bon_id);
            echo json_encode($data);
        }
        function getbonsupir()
        {
            $supir_id = $this->input->get('id');
            $data = $this->model_detail->getbonbysupir($supir_id);
            echo json_encode($data);
        }
    //end fungsi untuk Detail bon
    
    //fungsi untuk Detail report bon
        function detail_report_bon($supir_id,$asal)
        {
            if(!isset($_SESSION["user"])){
    			$this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
            if($asal=="periode"){
                $data["tanggal1"] = $this->input->post("tanggal1");
                $data["tanggal2"] = $this->input->post("tanggal2");
                if($data["tanggal1"]==""){
                    $data["transaksi_bon"] = $this->model_detail->getbonbysupir($supir_id);                
                }else{
                    $data["transaksi_bon"] = $this->model_detail->getbonbysupirperiode($supir_id,$data["tanggal1"],$data["tanggal2"]);
                }
            }else{
                $data["tanggal1"] = "";
                $data["tanggal2"] = "";
                $data["transaksi_bon"] = $this->model_detail->getbonbysupir($supir_id);                
            }
            $data["supir"] = $this->model_home->getsupirbyid($supir_id)["supir_name"];
            $data["supir_id"] = $this->model_home->getsupirbyid($supir_id)["supir_id"];
            $data["page"] = "Laporan_Bon_page";
            $data["collapse_group"] = "Kasbon";
            $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
            if(json_decode($data["akun_akses"]["akses"])[10]==0){
                redirect(base_url());
            }
            $this->load->view('header',$data);
            $this->load->view('sidebar');
            $this->load->view('detail/laporan_bon');
            $this->load->view('footer');
        }
    //end fungsi untuk Detail report bon
    
    //fungsi untuk Detail truck
        function gettruck()
        {
            $truck_id = $this->input->get('id');
            $data = $this->model_detail->gettruckbyid($truck_id);
            echo json_encode($data);
        }
    //end fungsi untuk Detail ttruckk

    //fungsi untuk Detail merk
        function getmerk()
        {
            $merk_id = $this->input->get('id');
            $data = $this->model_detail->getmerkbyid($merk_id);
            echo json_encode($data);
        }
        function getallmerk()
        {
            $data = $this->model_detail->getallmerk();
            echo json_encode($data);
        }
    //end fungsi untuk Detail merk

    //fungsi untuk Detail supir
        function getsupir()
        {
            $supir_id = $this->input->get('id');
            $data = $this->model_home->getsupirbyid($supir_id);
            echo json_encode($data);
        }
    //end fungsi untuk Detail supir

    //fungsi untuk Detail penggajian
        public function detail_penggajian($supir_id)
        {
            if(!isset($_SESSION["user"])){
    			$this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
            if($this->input->post("bonus")==""){
                $bonus=0;
            }else{
                $bonus=$this->input->post("bonus");
            }
            if($this->input->post("kasbon")==""){
                $kasbon=0;
            }else{
                $kasbon = $this->input->post("kasbon");
            }
            $data["bulan"] = $this->input->post("bulan_kerja");
            $data["tahun"] = $this->input->post("tahun_kerja");
            $data["pilih_jo"] = array(
                "jo_id" => $this->input->post("jo"),
                "gaji_total" => $this->input->post("gaji_total"),
                "gaji_grand_total" => $this->input->post("gaji_grand_total"),
                "bonus" => $bonus,
                "kasbon" => $kasbon
            );
            $data_jo = [];
            $data_jo_form = explode(",",$this->input->post("jo"));
            for($i=0;$i<count($data_jo_form);$i++){
                $jo = $this->model_home->getjobyid($data_jo_form[$i]);
                $data_jo[] = $jo;
            }
            $data["jo"]=$data_jo;
            $data["supir"] = $this->model_home->getsupirbyid($supir_id);
            $data["page"] = "Gaji_page";
            $data["collapse_group"] = "Penggajian";
            $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
            if(json_decode($data["akun_akses"]["akses"])[6]==0){
                redirect(base_url());
            }
            $this->load->view('header',$data);
            $this->load->view('sidebar');
            $this->load->view('detail/penggajian',$data);
            $this->load->view('footer');
        }

        public function pilih_gaji($supir_id,$no_pol,$asal,$bulan,$tahun)
        {
            $slip_id = $this->model_form->getpembayaranupahidnow($bulan,$tahun);
            $isi_slip_id = [];
            for($i=0;$i<count($slip_id);$i++){
                $explode_slip = explode("-",$slip_id[$i]["pembayaran_upah_id"]);
                if(count($explode_slip)>1){
                    if($explode_slip[2]==date("m") && $explode_slip[3]==date('Y')){
                        $isi_slip_id[] = $explode_slip[0];
                    }
                }
            }
            if(count($isi_slip_id)==0){
                $isi_slip_id[]=0;
            }
            $max = max($isi_slip_id)+1;
            if($max<10){
                $angka_depan = "00".$max;
            }else if($max<100 && $max>10){
                $angka_depan = "0".$max;
            }else{
                $angka_depan = $max;
            }
            $data["no_slip_gaji"]=$angka_depan."-GAJI-".date("m")."-".date('Y');
            if(!isset($_SESSION["user"])){
    			$this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
            $data["bulan_index"]=$bulan;
            $data["tahun"]=$tahun;
            $data["jo"] = $this->model_detail->getjobbysupirbulan($supir_id,str_replace("%20"," ",$no_pol),$data["tahun"],$data["bulan_index"]);
            $data["supir"] = $this->model_home->getsupirbyid($supir_id);
            $data["mobil"] = $this->model_home->getmobilbyid(str_replace("%20"," ",$no_pol));
            if($data["supir"]==null){
                $data["supir"] = array(
                    "supir_id"=>"x",
                    "supir_name"=>"Driver",
                    "supir_panggilan"=>"Panggilan Driver",
                    "supir_kasbon"=>0
                );
            }
            if($data["mobil"]==null){
                $data["mobil"] = array(
                    "mobil_no"=>"No Polisi",
                );
            }
            $data["all_supir"] = $this->model_detail->getsupir();
            $data["all_mobil"] = $this->model_detail->getallmobilslip($supir_id);
            $data["page"] = "Gaji_page";
            $data["collapse_group"] = "Penggajian";
            $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
            if(json_decode($data["akun_akses"]["akses"])[6]==0){
                redirect(base_url());
            }
            $this->load->view('header',$data);
            $this->load->view('sidebar');
            $this->load->view('detail/pilih_gaji',$data);
        }

        public function detail_penggajian_report($supir_id)
        {
            if(!isset($_SESSION["user"])){
    			$this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
            $data["pembayaran_upah"] = $this->model_detail->getpembayaranupah($supir_id);
            $data["supir"] = $this->model_home->getsupirbyid($supir_id);
            $data["page"] = "Laporan_Gaji_page";
            $data["collapse_group"] = "Penggajian";
            $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
            if(json_decode($data["akun_akses"]["akses"])[9]==0){
                redirect(base_url());
            }
            $this->load->view('header',$data);
            $this->load->view('sidebar');
            $this->load->view('detail/penggajian_report',$data);
        }

        public function view_laporan_penggajian(){
            $No_Slip = $this->input->post('No_Slip1')."-".$this->input->post('No_Slip2')."-".$this->input->post('No_Slip3')."-".$this->input->post('No_Slip4');
            $data = array(
                "Status" => $this->input->post('Status'),
                "Supir" => $this->input->post('Supir'),
                "Tanggal1" => $this->input->post('Tanggal1'),
                "Tanggal2" => $this->input->post('Tanggal2'),
                "Bulan" => $this->input->post('Bulan'),
                "Tahun" => $this->input->post('Tahun'),
                "nopol" => $this->input->post('nopol'),
                "No_Slip" => $No_Slip,
            );
            $postData = $this->input->post();
            $data = $this->model_detail->getGajiData($postData,$data);
            echo json_encode($data);
        }

        public function getditemukanslip(){
            $No_Slip = $this->input->post('No_Slip1')."-".$this->input->post('No_Slip2')."-".$this->input->post('No_Slip3')."-".$this->input->post('No_Slip4');
            $data = array(
                "Status" => $this->input->post('Status'),
                "Supir" => $this->input->post('Supir'),
                "Tanggal1" => $this->input->post('Tanggal1'),
                "Tanggal2" => $this->input->post('Tanggal2'),
                "Bulan" => $this->input->post('Bulan'),
                "Tahun" => $this->input->post('Tahun'),
                "nopol" => $this->input->post('nopol'),
                "No_Slip" => $No_Slip,
            );
            $data_filter = $this->model_detail->getDitemukanSlip($data);
            $gaji = 0;
            for($i=0;$i<count($data_filter);$i++){
                if($data_filter[$i]["pembayaran_upah_status"]=="Belum Lunas"){
                    $gaji = $gaji + $data_filter[$i]["pembayaran_upah_total"];
                }
            }
            echo count($data_filter)."=".number_format($gaji,2,",",".");
        }

        public function detail_penggajian_report_pembayaran($supir_id,$pembayaran_id)
        {
            if(!isset($_SESSION["user"])){
    			$this->session->set_flashdata('status-login', 'False');
                redirect(base_url());
            }
            $data["pembayaran_upah"] = $this->model_detail->getpembayaranupahbyid($pembayaran_id);
            $data["jo_pembayaran_upah"] = $this->model_detail->getjobypembayaranupah($data["pembayaran_upah"][0]["pembayaran_upah_id"]);
            $data["supir"] = $this->model_home->getsupirbyid($supir_id);
            $data["page"] = "Laporan_Gaji_page";
            $data["collapse_group"] = "Penggajian";
            $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
            if(json_decode($data["akun_akses"]["akses"])[9]==0){
                redirect(base_url());
            }
            $this->load->view('header',$data);
            $this->load->view('sidebar');
            $this->load->view('detail/penggajian_report_pembayaran',$data);
            $this->load->view('footer');
        }

        public function update_upah(){
            $data = array(
                "supir_id"=>$this->input->get("supir_id"),
                "kasbon"=>str_replace(".","",$this->input->get("kasbon")),
                "gaji_grand_total"=>str_replace(".","",$this->input->get("gaji_grand_total")),
                "gaji_total"=>str_replace(".","",$this->input->get("gaji_total")),
                "bonus"=>str_replace(".","",$this->input->get("bonus")),
                "Jo_id"=>$this->input->get("jo_id"),
                "pembayaran_upah_id"=>$this->input->get("pembayaran_upah_id")
            );
            $this->model_detail->update_upah($data);
            echo $data["pembayaran_upah_id"];
        }

        public function insert_upah($supir_id){
            $data_bulan = ["x","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];

            if($this->input->post("bonus")==""){
                $bonus=0;
            }else{
                $bonus=str_replace(".","",$this->input->post("bonus"));
            }
            if($this->input->post("kasbon")==""){
                $kasbon=0;
            }else{
                $kasbon = str_replace(".","",$this->input->post("kasbon"));
            }

            $bulan = $this->input->post("bulan_kerja");
            $tahun = $this->input->post("tahun_kerja");
            if($bulan=='x'){
                $bulan=0;
            }
            if($tahun=="x"){
                $tahun=date("Y");
            }

            $data_jo = [];
            $data_jo_form = explode(",",$this->input->post("jo"));
            for($i=0;$i<count($data_jo_form);$i++){
                $data_jo[] = $data_jo_form[$i];
            }
            $data = array(
                "supir_id"=>$supir_id,
                "kasbon"=>$kasbon,
                "tanggal"=>$this->change_tanggal($this->input->post("tanggal_gaji")),
                "gaji_grand_total"=>str_replace(".","",$this->input->post("gaji_grand_total")),
                "gaji_total"=>str_replace(".","",$this->input->post("gaji_total")),
                "bonus"=>$bonus,
                "Jo_id"=>$data_jo,
                "bulan_kerja"=>$data_bulan[$bulan]."-".$tahun,
                "pembayaran_upah_id"=>$this->input->post("no_gaji"),
                "keterangan"=>$this->input->post("Keterangan"),
                "sisa"=>str_replace(".","",$this->input->post("gaji_grand_total")),
                "nopol"=>$this->input->post("nopol"),
            );
            $this->session->set_flashdata('status-insert-slip-gaji', 'Berhasil');
            $this->model_detail->insert_upah($data);
            redirect(base_url('index.php/detail/pilih_gaji/x/x/home/').date('m')."/".date('Y'));
        }

        public function update_slip($pembayaran_upah_id){
            $data_bulan = ["x","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
            $slip_now = $this->model_detail->get_slip_id($pembayaran_upah_id);
            $sisa = str_replace(".","",$this->input->post("gaji_grand_total"));

            if($this->input->post("bonus")==""){
                $bonus=0;
            }else{
                $bonus=str_replace(".","",$this->input->post("bonus"));
            }
            if($this->input->post("kasbon")==""){
                $kasbon=0;
            }else{
                $kasbon = str_replace(".","",$this->input->post("kasbon"));
            }

            // $bulan = $this->input->post("bulan_kerja");
            // $tahun = $this->input->post("tahun_kerja");
            // if($bulan=='x'){
            //     $bulan=0;
            // }
            // if($tahun=="x"){
            //     $tahun=date("Y");
            // }

            $data_jo = [];
            $data_jo_form = explode(",",$this->input->post("jo"));
            for($i=0;$i<count($data_jo_form);$i++){
                $data_jo[] = $data_jo_form[$i];
            }
            $data = array(
                // "supir_id"=>$supir_id,
                "pembayaran_upah_bon"=>$kasbon,
                "pembayaran_upah_tanggal"=>$this->change_tanggal($this->input->post("tanggal_gaji")),
                "pembayaran_upah_total"=>str_replace(".","",$this->input->post("gaji_grand_total")),
                "pembayaran_upah_nominal"=>str_replace(".","",$this->input->post("gaji_total")),
                "pembayaran_upah_bonus"=>$bonus,
                "sisa"=>$sisa,
                // "bulan_kerja"=>$data_bulan[$bulan]."-".$tahun,
                // "pembayaran_upah_id"=>$this->input->post("no_gaji"),
                "keterangan"=>$this->input->post("Keterangan")
            );
            $this->session->set_flashdata('status-edit-slip-gaji', 'Berhasil');
            // echo print_r($data);
            $this->model_detail->update_slip($data,$pembayaran_upah_id,$data_jo);
            redirect (base_url("index.php/home/report_gaji"));
        }
    //end fungsi untuk Detail penggajian

    function getpaymentinvoice()
    {
        $payment_id = $this->input->get('id');
        $data = $this->model_detail->getpaymentinvoicebyid($payment_id);
        echo json_encode($data);
    }

    function getpaymentupah()
    {
        $payment_id = $this->input->get('id');
        $data = $this->model_detail->getpaymentupahbyid($payment_id);
        echo json_encode($data);
    }
    
    function getpaymentjo()
    {
        $payment_id = $this->input->get('id');
        $data = $this->model_detail->getpaymentjobyid($payment_id);
        echo json_encode($data);
    }

    function getnumpaymentinvoice()
    {
        $invoice_id = $this->input->get('id');
        $data = $this->model_detail->getpaymentinvoice($invoice_id);
        echo count($data);
    }

    function getnumpaymentupah()
    {
        $upah_id = $this->input->get('id');
        $data = $this->model_detail->getpaymentupah($upah_id);
        echo count($data);
    }

    function getnumpaymentjo()
    {
        $jo_id = $this->input->get('id');
        $data = $this->model_detail->getpaymentjo($jo_id);
        echo count($data);
    }
}