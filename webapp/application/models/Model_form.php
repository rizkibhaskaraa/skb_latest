<?php
// error_reporting(0);
class Model_Form extends CI_model
{
    //fungsi get
        public function getcustomerbyname($customer_name){
            return $this->db->get_where("skb_customer",array("customer_name"=>str_replace("%20"," ",$customer_name)))->row_array();
        }
        public function getbonbysupir($supir_id){
            return $this->db->get_where("skb_supir",array("supir_id"=>$supir_id))->row_array();
        }
        public function getakunbyid($akun_id){
            $this->db->join("user", "user.akun_id = skb_akun.akun_id", 'left');
            return $this->db->get_where("skb_akun",array("skb_akun.akun_id"=>$akun_id))->row_array();
        }
        public function getrutebyid($rute_id){
            $this->db->join("skb_customer", "skb_customer.customer_id = skb_rute.customer_id", 'left');
            return $this->db->get_where("skb_rute",array("skb_rute.rute_id"=>$rute_id))->row_array();
        }
        public function getpaketanbyid($paketan_id){
            $this->db->join("skb_customer", "skb_customer.customer_id = skb_paketan.customer_id", 'left');
            return $this->db->get_where("skb_paketan",array("skb_paketan.paketan_id"=>$paketan_id))->row_array();
        }
        public function getrutepaketanbyid($paketan_id){
            return $this->db->get_where("skb_paketan",array("paketan_id"=>$paketan_id))->row_array();
        }
        public function getjoid(){
            $this->db->select("Jo_id");
            return $this->db->get("skb_job_order")->result_array();
        }
        public function getsupirname($supir_id){
            return $this->db->get_where("skb_supir",array("supir_id"=>$supir_id))->row_array();
        }
        public function getallsupir(){
            return $this->db->get("skb_supir")->result_array();
        }
        public function getakunbyname($akun_name){
            return $this->db->get_where("skb_akun",array("akun_name"=>$akun_name))->row_array();
        }
        public function getbonid(){
            $this->db->select("bon_id");
            return $this->db->get("skb_bon")->result_array();
        }
        public function getpembayaranupahid(){
            $this->db->select("pembayaran_upah_id");
            return $this->db->get("skb_pembayaran_upah")->result_array();
        }
        public function getpembayaranupahidnow($bulan,$tahun){
            $this->db->select("pembayaran_upah_id");
            $this->db->like("pembayaran_upah_tanggal",$tahun."-".$bulan."-");
            return $this->db->get("skb_pembayaran_upah")->result_array();
        }
        public function getinvoiceid(){
            $this->db->select("invoice_kode");
            return $this->db->get("skb_invoice")->result_array();
        }
    //end fungsi get
    //fungsi insert
        public function insert_JO($data){
            $this->db->set("status_jalan","Jalan");
            $this->db->where("supir_id",$data["supir_id"]);
            $this->db->update("skb_supir");

            $this->db->set("status_jalan","Jalan");
            $this->db->where("mobil_no",$data["mobil_no"]);
            $this->db->update("skb_mobil");

            return $this->db->insert("skb_job_order", $data);
        }
        public function insert_invoice($data,$data_jo){
            for($i=0;$i<count($data_jo);$i++){
                $this->db->set("invoice_id",$data["invoice_kode"]);
                $this->db->where("Jo_id",$data_jo[$i]);
                $this->db->update("skb_job_order");
            }

            return $this->db->insert("skb_invoice", $data);
        }
        public function insert_merk($data){
            return $this->db->insert("skb_merk_kendaraan", $data);
        }
        public function insert_bon($data){
            $supir=$this->db->get_where("skb_supir",array("supir_id"=>$data["supir_id"]))->row_array();
            if($data["bon_jenis"]=="Pengajuan" || $data["bon_jenis"]=="Pembatalan JO"){
                $bon_now = $supir["supir_kasbon"]+$data["bon_nominal"];
            }else if($data["bon_jenis"]=="Pembayaran" || $data["bon_jenis"]=="Potong Gaji"){
                $bon_now = $supir["supir_kasbon"]-$data["bon_nominal"];
            }else{
                $bon_now = $supir["supir_kasbon"]+$data["bon_nominal"];
            }
            $this->db->set("supir_kasbon",$bon_now);
            $this->db->where("supir_id",$data["supir_id"]);
            $this->db->update("skb_supir");

            return $this->db->insert("skb_bon", $data);
        }
        public function insert_akun($data){
            return $this->db->insert("skb_akun", $data);
        }
        public function insert_user($data){
            return $this->db->insert("user", $data);
        }
        public function insert_customer($data){
            return $this->db->insert("skb_customer", $data);
        }
        public function insert_supir($data){
            return $this->db->insert("skb_supir", $data);
        }
        public function insert_rute($data){
            return $this->db->insert("skb_rute", $data);
        }
        public function insert_truck($data){
            return $this->db->insert("skb_mobil", $data);
        }
        public function insert_payment_invoice($data){
            $invoice = $this->db->get_where("skb_invoice",array("invoice_kode"=>$data["invoice_id"]))->row_array();
            $sisa = $invoice["sisa"] - $data["payment_invoice_nominal"];
            
            if($sisa==0){
                $this->db->set("status_bayar","Lunas");
            }
            $this->db->set("sisa",$sisa);
            $this->db->where("invoice_kode",$data["invoice_id"]);
            $this->db->update("skb_invoice");

            return $this->db->insert("payment_invoice", $data);
        }
        public function insert_payment_upah($data){
            $slip = $this->db->get_where("skb_pembayaran_upah",array("pembayaran_upah_id"=>$data["pembayaran_upah_id"]))->row_array();
            $sisa = $slip["sisa"] - $data["payment_upah_nominal"];
            
            if($sisa==0){
                $this->db->set("pembayaran_upah_status","Lunas");
            }
            $this->db->set("sisa",$sisa);
            $this->db->where("pembayaran_upah_id",$data["pembayaran_upah_id"]);
            $this->db->update("skb_pembayaran_upah");

            return $this->db->insert("payment_upah", $data);
        }
        public function insert_payment_jo($data){
            $jo = $this->db->get_where("skb_job_order",array("Jo_id"=>$data["jo_id"]))->row_array();
            $sisa = $jo["sisa"] - $data["payment_jo_nominal"];
            
            $this->db->set("sisa",$sisa);
            $this->db->where("Jo_id",$data["jo_id"]);
            $this->db->update("skb_job_order");

            return $this->db->insert("payment_jo", $data);
        }
    //end fungsi insert
    //fungsi acc
        public function accsupir($supir_id,$validasi){
            if($validasi=="Ditolak"){
                $this->db->where("supir_id",$supir_id);
                $this->db->delete("skb_supir");
            }else{
                $this->db->set("validasi",$validasi);
                $this->db->where("supir_id",$supir_id);
                $this->db->update("skb_supir");
            }
        }
        public function accdeletesupir($supir_id,$validasi){
            if($validasi=="Ditolak"){
                $this->db->set("status_hapus","NO");
            }else{
                $this->db->set("status_hapus","YES");
            }
            $this->db->set("validasi_delete","ACC");
            $this->db->where("supir_id",$supir_id);
            $this->db->update("skb_supir");
        }
        public function acceditsupir($supir_id,$validasi){
            $data_supir = $this->db->get_where("skb_supir",array("supir_id"=>$supir_id))->row_array();
            $temp_supir = json_decode($data_supir["temp_supir"],true);
            if($validasi!="Ditolak"){
                if($data_supir["file_foto"] != $temp_supir["file_foto"]){
                    $path_foto = './assets/berkas/driver/'.$data_supir["file_foto"];
                    chmod($path_foto, 0777);
                    unlink($path_foto);
                }
                if($data_supir["file_sim"] != $temp_supir["file_sim"]){
                    $path_sim = './assets/berkas/driver/'.$data_supir["file_sim"];
                    chmod($path_sim, 0777);
                    unlink($path_sim);
                }
                if($data_supir["file_ktp"] != $temp_supir["file_ktp"]){
                    $path_ktp = './assets/berkas/driver/'.$data_supir["file_ktp"];
                    chmod($path_ktp, 0777);
                    unlink($path_ktp);
                }
            }else{
                if($data_supir["file_foto"] != $temp_supir["file_foto"]){
                    $path_foto = './assets/berkas/driver/'.$temp_supir["file_foto"];
                    chmod($path_foto, 0777);
                    unlink($path_foto);
                }
                if($data_supir["file_sim"] != $temp_supir["file_sim"]){
                    $path_sim = './assets/berkas/driver/'.$temp_supir["file_sim"];
                    chmod($path_sim, 0777);
                    unlink($path_sim);
                }
                if($data_supir["file_ktp"] != $temp_supir["file_ktp"]){
                    $path_ktp = './assets/berkas/driver/'.$temp_supir["file_ktp"];
                    chmod($path_ktp, 0777);
                    unlink($path_ktp);
                }
            }
            $this->db->set("temp_supir","");
            $this->db->set("validasi_edit","ACC");
            $this->db->where("supir_id",$supir_id);
            if($validasi=="Ditolak"){
                $this->db->update("skb_supir");
            }else{
                $this->db->update("skb_supir",$temp_supir);
            }
        }

        public function acccustomer($customer_id,$validasi){
            if($validasi == "Ditolak"){
                $this->db->where("customer_id",$customer_id);
                $this->db->delete("skb_customer");
            }else{  
                $this->db->set("validasi",$validasi);
                $this->db->where("customer_id",$customer_id);
                $this->db->update("skb_customer");
            }
        }
        public function accdeletecustomer($customer_id,$validasi){
            if($validasi=="Ditolak"){
                $this->db->set("status_hapus","NO");
            }else{
                $this->db->set("status_hapus","YES");
            }
            $this->db->set("validasi_delete","ACC");
            $this->db->where("customer_id",$customer_id);
            $this->db->update("skb_customer");
        }
        public function acceditcustomer($customer_id,$validasi){
            $data_customer = $this->db->get_where("skb_customer",array("customer_id"=>$customer_id))->row_array();
            $temp_customer = json_decode($data_customer["temp_customer"],true);
            $this->db->set("temp_customer","");
            $this->db->set("validasi_edit","ACC");
            $this->db->where("customer_id",$customer_id);
            if($validasi=="Ditolak"){
                $this->db->update("skb_customer");
            }else{
                $this->db->update("skb_customer",$temp_customer);
            }
        }

        public function acctruck($truck_id,$validasi){
            if($validasi == "Ditolak"){
                $this->db->where("mobil_no",$truck_id);
                $this->db->delete("skb_mobil");
            }else{
                $this->db->set("validasi",$validasi);
                $this->db->where("mobil_no",$truck_id);
                $this->db->update("skb_mobil");
            }
        }
        public function accdeletetruck($mobil_no,$validasi){
            $this->db->select("mobil_no");
            $data_mobil = $this->db->get("skb_mobil")->result_array();
            $isi_mobil_no = [];
            for($i=0;$i<count($data_mobil);$i++){
                $explode_bon = explode("/",$data_mobil[$i]["mobil_no"]);
                if(count($explode_bon)>=1){
                    if(count($explode_bon)==2){
                        $isi_mobil_no[] = $explode_bon[0];
                    }
                }
            }
            if(count($isi_mobil_no)==0){
                $isi_mobil_no[]=0;
            }
            $new_mobil_no=(max($isi_mobil_no)+1)."/".$mobil_no;
            if($validasi=="Ditolak"){
                $this->db->set("status_hapus","NO");
            }else{
                $this->db->set("mobil_no",$new_mobil_no);
                $this->db->set("status_hapus","YES");
            }
            $this->db->set("validasi_delete","ACC");
            $this->db->where("mobil_no",$mobil_no);
            $this->db->update("skb_mobil");
        }
        public function accedittruck($mobil_no,$validasi){
            $data_mobil = $this->db->get_where("skb_mobil",array("mobil_no"=>$mobil_no))->row_array();
            $temp_mobil = json_decode($data_mobil["temp_mobil"],true);
            if($validasi!="Ditolak"){
                if($data_mobil["file_foto"] != $temp_mobil["file_foto"]){
                    $path_foto = './assets/berkas/kendaraan/'.$data_mobil["file_foto"];
                    chmod($path_foto, 0777);
                    unlink($path_foto);
                }
                if($data_mobil["file_stnk"] != $temp_mobil["file_stnk"]){
                    $path_stnk = './assets/berkas/kendaraan/'.$data_mobil["file_stnk"];
                    chmod($path_stnk, 0777);
                    unlink($path_stnk);
                }
            }else{
                if($data_mobil["file_foto"] != $temp_mobil["file_foto"]){
                    $path_foto = './assets/berkas/kendaraan/'.$temp_mobil["file_foto"];
                    chmod($path_foto, 0777);
                    unlink($path_foto);
                }
                if($data_mobil["file_stnk"] != $temp_mobil["file_stnk"]){
                    $path_stnk = './assets/berkas/kendaraan/'.$temp_mobil["file_stnk"];
                    chmod($path_stnk, 0777);
                    unlink($path_stnk);
                }
            }
            $this->db->set("temp_mobil","");
            $this->db->set("validasi_edit","ACC");
            $this->db->where("mobil_no",$mobil_no);
            if($validasi=="Ditolak"){
                $this->db->update("skb_mobil");
            }else{
                $this->db->update("skb_mobil",$temp_mobil);
            }
        }

        public function accrute($rute_id,$validasi){
            if($validasi=="Ditolak"){
                $this->db->where("rute_id",$rute_id);
                $this->db->delete("skb_rute");
            }else{
                $this->db->set("validasi_rute",$validasi);
                $this->db->where("rute_id",$rute_id);
                $this->db->update("skb_rute");
            }
        }
        public function accdeleterute($rute_id,$validasi){
            if($validasi=="Ditolak"){
                $this->db->set("rute_status_hapus","NO");
            }else{
                $this->db->set("rute_status_hapus","YES");
            }
            $this->db->set("validasi_rute_delete","ACC");
            $this->db->where("rute_id",$rute_id);
            $this->db->update("skb_rute");
        }
        public function acceditrute($rute_id,$validasi){
            $data_rute = $this->db->get_where("skb_rute",array("rute_id"=>$rute_id))->row_array();
            $temp_rute = json_decode($data_rute["temp_rute"],true);
            $this->db->set("temp_rute","");
            $this->db->set("validasi_rute_edit","ACC");
            $this->db->where("rute_id",$rute_id);
            if($validasi=="Ditolak"){
                $this->db->update("skb_rute");
            }else{
                $this->db->update("skb_rute",$temp_rute);
            }
        }

        public function accmerk($merk_id,$validasi){
            if($validasi=="Ditolak"){
                $this->db->where("merk_id",$merk_id);
                $this->db->delete("skb_merk_kendaraan");
            }else{
                $this->db->set("validasi",$validasi);
                $this->db->where("merk_id",$merk_id);
                $this->db->update("skb_merk_kendaraan");
            }
        }
        public function accdeletemerk($merk_id,$validasi){
            if($validasi=="Ditolak"){
                $this->db->set("status_hapus","NO");
            }else{
                $this->db->set("status_hapus","YES");
            }
            $this->db->set("validasi_delete","ACC");
            $this->db->where("merk_id",$merk_id);
            $this->db->update("skb_merk_kendaraan");
        }
        public function acceditmerk($merk_id,$validasi){
            $data_merk = $this->db->get_where("skb_merk_kendaraan",array("merk_id"=>$merk_id))->row_array();
            $temp_merk = json_decode($data_merk["temp_merk"],true);
            $this->db->set("temp_merk","");
            $this->db->set("validasi_edit","ACC");
            $this->db->where("merk_id",$merk_id);
            if($validasi=="Ditolak"){
                $this->db->update("skb_merk_kendaraan");
            }else{
                $this->db->update("skb_merk_kendaraan",$temp_merk);
                
                $data_truck = array(
                    "mobil_merk" => $temp_merk["merk_nama"],
                    "mobil_type" => $temp_merk["merk_type"],
                    "mobil_jenis" => $temp_merk["merk_jenis"],
                    "mobil_dump" => $temp_merk["merk_dump"]
                );
                $this->db->where("merk_id",$merk_id);
                $this->db->update("skb_mobil",$data_truck);
            }
        }
    //end fungsi acc
    //fungsi update
        public function update_jo_status($data,$supir,$mobil){
            $this->db->set("tanggal_muat",$data["tanggal_muat"]);
            $this->db->set("biaya_lain",$data["biaya_lain"]);
            $this->db->set("tonase",$data["tonase"]);
            $this->db->set("keterangan",$data["keterangan"]);
            $this->db->set("status",$data["status"]);
            $this->db->set("user_closing",$data["user_closing"]."(".date("d-m-Y H:i:s").")"); 
            $this->db->set("tanggal_bongkar",$data["tanggal_bongkar"]);
            $this->db->set("total_tagihan",$data["total_tagihan"]);
            $this->db->where("Jo_id",$data["jo_id"]);
            $this->db->update("skb_job_order");

            $this->db->set("status_jalan","Tidak Jalan");
            $this->db->where("supir_id",$supir);
            $this->db->update("skb_supir");

            $this->db->set("status_jalan","Tidak Jalan");
            $this->db->where("mobil_no",str_replace("%20"," ",$mobil));
            $this->db->update("skb_mobil");
        }
        public function update_payment_invoice($data,$payment_id){
            $payment_invoice = $this->db->get_where("payment_invoice",array("payment_invoice_id"=>$payment_id))->row_array();
            $invoice = $this->db->get_where("skb_invoice",array("invoice_kode"=>$payment_invoice["invoice_id"]))->row_array();

            $selisih = $payment_invoice["payment_invoice_nominal"]-$data["payment_invoice_nominal"];
            $sisa=$invoice["sisa"]+$selisih;

            $this->db->set("sisa",$sisa);
            if($sisa==0){
                $this->db->set("status_bayar","Lunas");
            }else{
                $this->db->set("status_bayar","Belum Lunas");
            }
            $this->db->where("invoice_kode",$payment_invoice["invoice_id"]);
            $this->db->update("skb_invoice");
    
            $this->db->where("payment_invoice_id",$payment_id);
            $this->db->update("payment_invoice",$data);
    
            return $invoice["invoice_kode"];
        }
        public function update_payment_upah($data,$payment_id){
            $payment_upah = $this->db->get_where("payment_upah",array("payment_upah_id"=>$payment_id))->row_array();
            $upah = $this->db->get_where("skb_pembayaran_upah",array("pembayaran_upah_id"=>$payment_upah["pembayaran_upah_id"]))->row_array();

            $selisih = $payment_upah["payment_upah_nominal"]-$data["payment_upah_nominal"];
            $sisa=$upah["sisa"]+$selisih;

            $this->db->set("sisa",$sisa);
            if($sisa==0){
                $this->db->set("pembayaran_upah_status","Lunas");
            }else{
                $this->db->set("pembayaran_upah_status","Belum Lunas");
            }
            $this->db->where("pembayaran_upah_id",$upah["pembayaran_upah_id"]);
            $this->db->update("skb_pembayaran_upah");
    
            $this->db->where("payment_upah_id",$payment_id);
            $this->db->update("payment_upah",$data);
    
            return $upah["pembayaran_upah_id"];
        }
        public function update_payment_jo($data,$payment_id){
            $payment_jo = $this->db->get_where("payment_jo",array("payment_jo_id"=>$payment_id))->row_array();
            $jo = $this->db->get_where("skb_job_order",array("Jo_id"=>$payment_jo["jo_id"]))->row_array();

            $selisih = $payment_jo["payment_jo_nominal"]-$data["payment_jo_nominal"];
            $sisa=$jo["sisa"]+$selisih;

            $this->db->set("sisa",$sisa);
            $this->db->where("Jo_id",$jo["Jo_id"]);
            $this->db->update("skb_job_order");
    
            $this->db->where("payment_jo_id",$payment_id);
            $this->db->update("payment_jo",$data);
    
            return $jo["Jo_id"];
        }
        public function update_status_aktif_supir($data){
            $this->db->set("status_aktif",$data["status_aktif"]);
            if($data["status_aktif"]=="Aktif"){
                $this->db->set("supir_tgl_aktif",$data["supir_tgl_nonaktif"]);
                $this->db->set("supir_tgl_nonaktif",null);
            }else{
                $this->db->set("supir_tgl_nonaktif",$data["supir_tgl_nonaktif"]);
            }
            $this->db->where("supir_id",$data["supir_id"]);
            $this->db->update("skb_supir");
        }
        public function update_supir($data,$supir_id){
            $this->db->set("temp_supir",json_encode($data));
            $this->db->set("validasi_edit","Pending");
            $this->db->where("supir_id",$supir_id);
            $this->db->update("skb_supir");
        }
        public function update_merk($data,$merk_id){
            $this->db->set("temp_merk",json_encode($data));
            $this->db->set("validasi_edit","Pending");
            $this->db->where("merk_id",$merk_id);
            $this->db->update("skb_merk_kendaraan");
        }
        public function update_rute($data,$rute_id){
            $this->db->set("temp_rute",json_encode($data));
            $this->db->set("validasi_rute_edit","Pending");
            $this->db->where("rute_id",$rute_id);
            $this->db->update("skb_rute");
        }
        public function update_customer($data){
            $data_temp = array(
                "customer_name"=>$data["customer_name"],
                "customer_alamat"=>$data["customer_alamat"],
                "customer_kontak_person"=>$data["customer_kontak_person"],
                "customer_telp"=>$data["customer_telp"],
                "customer_keterangan"=>$data["customer_keterangan"]
            );
            $this->db->set("temp_customer",json_encode($data_temp));
            $this->db->set("validasi_edit","Pending");
            $this->db->where("customer_id",$data["customer_id"]);
            $this->db->update("skb_customer");
        }
        public function update_truck($data,$mobil_no_old){
            $this->db->set("temp_mobil",json_encode($data));
            $this->db->set("validasi_edit","Pending");
            $this->db->where("mobil_no",$mobil_no_old);
            $this->db->update("skb_mobil");
        }
        public function update_akun($data){
            $user = $this->db->get_where("user",array("akun_id"=>$data["akun_id"]))->row_array();
            if($user){
                $this->db->set("username",$data["username"]);
                $this->db->set("password",$data["password"]);
                $this->db->set("status_aktif","Tidak Aktif");
                $this->db->where("akun_id",$data["akun_id"]);
                $this->db->update("user");
            }else{
                $data_user = array(
                    "akun_id"=>$data["akun_id"],
                    "username"=>$data["username"],
                    "password"=>$data["password"],
                    "status_aktif"=>"Tidak Aktif"
                );
                $this->db->insert("user",$data_user);
            }
    
            $this->db->set("akun_name",$data["akun_name"]);
            $this->db->set("akun_role",$data["akun_role"]);
            $this->db->where("akun_id",$data["akun_id"]);
            $this->db->update("skb_akun");
        }
        public function update_konfigurasi($akun_id,$konfigurasi){
            // $data_konfigurasi=json_encode($data_konfigurasi);
            $konfigurasi=json_encode($konfigurasi);
            $this->db->set("akses",$konfigurasi);
            // $this->db->set("akun_akses",$data_konfigurasi);
            $this->db->where("akun_id",$akun_id);
            $this->db->update("skb_akun");
        }
        public function update_bon($data,$bon_id){
            $data_bon = $this->db->get_where("skb_bon",array("bon_id"=>$bon_id))->row_array();
            $supir=$this->db->get_where("skb_supir",array("supir_id"=>$data_bon["supir_id"]))->row_array();
            $selisih_bon = $data_bon["bon_nominal"]-$data["bon_nominal"];

            if($data["bon_jenis"]=="Pengajuan" || $data["bon_jenis"]=="Pembatalan JO"){
                $bon_now = $supir["supir_kasbon"]-$selisih_bon;
            }else if($data["bon_jenis"]=="Pembayaran" || $data["bon_jenis"]=="Potong Gaji"){
                $bon_now = $supir["supir_kasbon"]+$selisih_bon;
            }
            if($bon_now<0){
                $bon_now=0;
            }
            $this->db->set("supir_kasbon",$bon_now);
            $this->db->where("supir_id",$data_bon["supir_id"]);
            $this->db->update("skb_supir");

            $this->db->where("bon_id",$bon_id);
            return $this->db->update("skb_bon",$data);
        }
        public function update_invoice($data,$data_jo){
            $this->db->join("skb_invoice","skb_invoice.invoice_kode=skb_job_order.invoice_id","left");
            $data_invoice = $this->db->get_where("skb_job_order",array("invoice_id"=>$data["invoice_kode"]))->result_array();
            $jo_id = [];
            for($i=0;$i<count($data_invoice);$i++){
                $jo_id[] = $data_invoice[$i]["Jo_id"];
            }

            for($i=0;$i<count($data_jo);$i++){
                if(!in_array($data_jo[$i],$jo_id)){
                    $this->db->set("invoice_id",$data["invoice_kode"]);
                    $this->db->where("Jo_id",$data_jo[$i]);
                    $this->db->update("skb_job_order");
                }
            }

            for($i=0;$i<count($jo_id);$i++){
                if(!in_array($jo_id[$i],$data_jo)){
                    $this->db->set("invoice_id","");
                    $this->db->where("Jo_id",$jo_id[$i]);
                    $this->db->update("skb_job_order");
                }
            }

            $this->db->where("invoice_kode",$data["invoice_kode"]);
            return $this->db->update("skb_invoice",$data);
        }
        public function update_JO($data,$jo_id){
            $data_jo = $this->db->get_where("skb_job_order",array("Jo_id"=>$jo_id))->row_array();
            if($data["status"]=="Dalam Perjalanan"){
                if($data_jo["supir_id"]!=$data["supir_id"]){
                    $this->db->set("status_jalan","Tidak Jalan");
                    $this->db->where("supir_id",$data_jo["supir_id"]);
                    $this->db->update("skb_supir");
                }
                $this->db->set("status_jalan","Jalan");
                $this->db->where("supir_id",$data["supir_id"]);
                $this->db->update("skb_supir");
                if($data_jo["mobil_no"]!=$data["mobil_no"]){
                    $this->db->set("status_jalan","Tidak Jalan");
                    $this->db->where("mobil_no",$data_jo["mobil_no"]);
                    $this->db->update("skb_mobil");
                }
                $this->db->set("status_jalan","Jalan");
                $this->db->where("mobil_no",$data["mobil_no"]);
                $this->db->update("skb_mobil");
            }

            $this->db->where("Jo_id",$jo_id);
            return $this->db->update("skb_job_order", $data);
        }
    //end fungsi update
    //fungsi delete
        public function deletesupir($supir_id){
            $this->db->set("validasi_delete","Pending");
            $this->db->where("supir_id",$supir_id);
            return $this->db->update("skb_supir");
        }
        public function deletetruck($mobil_no){
            $this->db->set("validasi_delete","Pending");
            $this->db->where("mobil_no",$mobil_no);
            return $this->db->update("skb_mobil");
        }
        public function deletemerk($merk_id){
            $this->db->set("validasi_delete","Pending");
            $this->db->where("merk_id",$merk_id);
            return $this->db->update("skb_merk_kendaraan");
        }
        public function deletecustomer($customer_id){
            $this->db->set("validasi_delete","Pending");
            $this->db->where("customer_id",$customer_id);
            return $this->db->update("skb_customer");
        }
        public function deletebon($bon_id){
            $data_bon = $this->db->get_where("skb_bon",array("bon_id"=>$bon_id))->row_array();
            $data_supir = $this->db->get_where("skb_supir",array("supir_id"=>$data_bon["supir_id"]))->row_array();
            if($data_bon["bon_jenis"]=="Pengajuan" || $data_bon["bon_jenis"]=="Pembatalan JO"){
                $this->db->set("supir_kasbon",$data_supir["supir_kasbon"]-$data_bon["bon_nominal"]);
            }else if($data_bon["bon_jenis"]=="Potong Gaji" || $data_bon["bon_jenis"]=="Pembayaran"){
                $this->db->set("supir_kasbon",$data_supir["supir_kasbon"]+$data_bon["bon_nominal"]);
            }
            $this->db->where("supir_id",$data_bon["supir_id"]);
            $this->db->update("skb_supir");

            $this->db->set("status_hapus","YES");
            $this->db->where("bon_id",$bon_id);
            return $this->db->update("skb_bon");
        }
        public function deleterute($rute_id){
            $this->db->set("validasi_rute_delete","Pending");
            $this->db->where("rute_id",$rute_id);
            return $this->db->update("skb_rute");
        }
        public function deleteakun($akun_id){
            $this->db->where("akun_id",$akun_id);
            return $this->db->delete("skb_akun");
        }
        public function deletejo($jo_id){
            $data_jo = $this->db->get_where("skb_job_order",array("Jo_id"=>$jo_id))->row_array();
            $this->db->where("Jo_id",$data_jo["Jo_id"]);
            $this->db->delete("skb_job_order");
    
            //reset supir
            $this->db->set("status_jalan","Tidak Jalan");
            $this->db->where("supir_id",$data_jo["supir_id"]);
            $this->db->update("skb_supir");
    
            //reset truck
            $this->db->set("status_jalan","Tidak Jalan");
            $this->db->where("mobil_no",$data_jo["mobil_no"]);
            $this->db->update("skb_mobil");
        }
        public function deleteinvoice($invoice_id){
            $data_jo = $this->db->get_where("skb_job_order",array("invoice_id"=>$invoice_id))->result_array();
            for($i=0;$i<count($data_jo);$i++){
                $this->db->set("invoice_id","");
                $this->db->where("Jo_id",$data_jo[$i]["Jo_id"]);
                $this->db->update("skb_job_order");
            }
    
            $this->db->where("invoice_kode",$invoice_id);
            $this->db->delete("skb_invoice");
    
            return $invoice_id;
        }
        public function deletepaymentinvoice($payment_id){
            $payment_invoice = $this->db->get_where("payment_invoice",array("payment_invoice_id"=>$payment_id))->row_array();
            $invoice = $this->db->get_where("skb_invoice",array("invoice_kode"=>$payment_invoice["invoice_id"]))->row_array();
            $sisa = $invoice["sisa"]+$payment_invoice["payment_invoice_nominal"];
            $this->db->set("sisa",$sisa);
            $this->db->set("status_bayar","Belum Lunas");
            $this->db->where("invoice_kode",$payment_invoice["invoice_id"]);
            $this->db->update("skb_invoice");
    
            $this->db->where("payment_invoice_id",$payment_id);
            $this->db->delete("payment_invoice");
    
            return $invoice["invoice_kode"];
        }

        public function deletepaymentupah($payment_id){
            $payment_upah = $this->db->get_where("payment_upah",array("payment_upah_id"=>$payment_id))->row_array();
            $upah = $this->db->get_where("skb_pembayaran_upah",array("pembayaran_upah_id"=>$payment_upah["pembayaran_upah_id"]))->row_array();
            $sisa = $upah["sisa"]+$payment_upah["payment_upah_nominal"];
            $this->db->set("sisa",$sisa);
            $this->db->set("pembayaran_upah_status","Belum Lunas");
            $this->db->where("pembayaran_upah_id",$payment_upah["pembayaran_upah_id"]);
            $this->db->update("skb_pembayaran_upah");
    
            $this->db->where("payment_upah_id",$payment_id);
            $this->db->delete("payment_upah");
    
            return $upah["pembayaran_upah_id"];
        }

        public function deletepaymentjo($payment_id){
            $payment_jo = $this->db->get_where("payment_jo",array("payment_jo_id"=>$payment_id))->row_array();
            $jo = $this->db->get_where("skb_job_order",array("Jo_id"=>$payment_jo["jo_id"]))->row_array();
            $sisa = $jo["sisa"]+$payment_jo["payment_jo_nominal"];
            $this->db->set("sisa",$sisa);
            $this->db->where("Jo_id",$payment_jo["jo_id"]);
            $this->db->update("skb_job_order");
    
            $this->db->where("payment_jo_id",$payment_id);
            $this->db->delete("payment_jo");
    
            return $jo["Jo_id"];
        }

        public function deleteslip($slip_id){
            $data_jo = $this->db->get_where("skb_job_order",array("pembayaran_upah_id"=>$slip_id))->result_array();
            for($i=0;$i<count($data_jo);$i++){
                $this->db->set("pembayaran_upah_id","");
                $this->db->where("Jo_id",$data_jo[$i]["Jo_id"]);
                $this->db->update("skb_job_order");
            }
    
            $this->db->where("pembayaran_upah_id",$slip_id);
            $this->db->delete("skb_pembayaran_upah");
    
            return $slip_id;
        }
    //end fungsi delete
    // fungsi untuk form joborder
        public function getrutebycustomer($customer_id,$mobil_no){
            $this->db->select("rute_muatan");
            return $this->db->get_where("skb_rute",array("customer_id"=>$customer_id,"jenis_mobil"=>$mobil_no,"rute_status_hapus"=>"NO","validasi_rute"=>"ACC","validasi_rute_edit"=>"ACC","validasi_rute_delete"=>"ACC"))->result_array();
        }
        public function getrutebymuatan($customer_id,$muatan,$mobil_no){
            $data_where = array(
                "customer_id"=>$customer_id,
                "rute_muatan"=>$muatan,
                "rute_status_hapus"=>"NO",
                "jenis_mobil"=>$mobil_no
            );
            $this->db->select("rute_dari");
            $this->db->where($data_where);
            return $this->db->get("skb_rute")->result_array();
        }
        public function getrutebydari($customer_id,$muatan,$rute_dari,$mobil_no){
            $data_where = array(
                "customer_id"=>$customer_id,
                "rute_muatan"=>$muatan,
                "rute_dari"=>$rute_dari,
                "rute_status_hapus"=>"NO",
                "jenis_mobil"=>$mobil_no
            );
            $this->db->select("rute_ke");
            $this->db->where($data_where);
            return $this->db->get("skb_rute")->result_array();
        }
        public function getrutefix($data){
                $data_where = array(
                    "customer_id"=>$data["customer_id"],
                    "rute_muatan"=>$data["muatan"],
                    "rute_dari"=>$data["rute_dari"],
                    "rute_ke"=>$data["rute_ke"],
                    "rute_status_hapus"=>"NO",
                    "jenis_mobil"=>$data["mobil"]
                );
            $this->db->where($data_where);
            return $this->db->get("skb_rute")->row_array();
        }
        public function getmobilbyjenis($mobil_jenis){
            return $this->db->get_where("skb_mobil",array("mobil_jenis"=>$mobil_jenis,"status_jalan"=>"Tidak Jalan","status_hapus"=>"NO","validasi"=>"ACC"))->result_array();
        }
        public function getmobilbyno($mobil_no){
            return $this->db->get_where("skb_mobil",array("mobil_no"=>$mobil_no))->row_array();
        }
        public function getallmobil(){
            $this->db->order_by("mobil_jenis","ASC");
            return $this->db->get_where("skb_mobil",array("status_hapus"=>"No"))->result_array();
        }
        public function getrutetonase($data){
            $data_where = array(
                "customer_id"=>$data["customer_id"],
                "rute_muatan"=>$data["muatan"],
                "rute_dari"=>$data["rute_dari"],
                "rute_ke"=>$data["rute_ke"],
                "rute_status_hapus"=>"NO",
                "rute_tonase!="=>"0"
            );
            $this->db->where($data_where);
            return $this->db->get("skb_rute")->result_array();
        }
    // end fungsi untuk form joborder
    //fungsi untuk datatables pilih jo untuk invoice
        public function count_all_jo($customer_id)
        {
            $this->db->where("customer_id",$customer_id);
            $this->db->where("status","Sampai Tujuan");
            $this->db->where("invoice_id","");
            return $this->db->count_all_results("skb_job_order");
        }

        public function filter_jo($order_field, $order_ascdesc,$customer_id,$search)
        {
            $this->db->where("(Jo_id like '%".$search."%' or muatan like '%".$search."%' or asal like '%".$search."%' or tujuan like '%".$search."%')");
            $this->db->where("customer_id",$customer_id);
            $this->db->where("status","Sampai Tujuan");
            $this->db->where("invoice_id","");
            $this->db->order_by($order_field, $order_ascdesc);
            return $this->db->get('skb_job_order')->result_array();
        }

        public function count_filter_jo($customer_id,$search)
        {
            $this->db->where("(Jo_id like '%".$search."%' or muatan like '%".$search."%' or asal like '%".$search."%' or tujuan like '%".$search."%')");
            $this->db->where("customer_id",$customer_id);
            $this->db->where("status","Sampai Tujuan");
            $this->db->where("invoice_id","");
            return $this->db->get('skb_job_order')->num_rows();
        }
    // end fungsi untuk datatables pilih jo untuk invoice
}