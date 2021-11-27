<?php
// error_reporting(0);
class Model_Detail extends CI_model
{
    public function change_tanggal($tanggal){
        if($tanggal==""){
            return "";
        }else{
            $tanggal_array = explode("-",$tanggal);
            return $tanggal_array[2]."-".$tanggal_array[1]."-".$tanggal_array[0];   
        }
    }

    //fungsi get
        public function get_slip_id($id){
            return $this->db->get_where("skb_pembayaran_upah",array("pembayaran_upah_id"=>$id))->row_array();
        }
        public function getbonbyid($bon_id){ //bon by ID
            $this->db->join("skb_supir","skb_supir.supir_id=skb_bon.supir_id","left");
            $this->db->where("skb_bon.status_hapus","NO");
            return $this->db->get_where("skb_bon",array("bon_id"=>$bon_id))->row_array();
        }
        
        public function getbonbysupir($supir_id){ //bon by Supir
            $this->db->where("bon_tanggal BETWEEN CAST('".date("Y-m-01")."' AS DATE) AND CAST('".date("Y-m-d")."' AS DATE)");
            $this->db->order_by('bon_tanggal', 'ASC');
            $this->db->join("skb_supir","skb_supir.supir_id=skb_bon.supir_id","left");
            $this->db->where("skb_bon.status_hapus","NO");
            return $this->db->get_where("skb_bon",array("skb_bon.supir_id"=>$supir_id))->result_array();
        }

        public function getbonbysupirperiode($supir_id,$tanggal1,$tanggal2){ //bon by Supir
            $this->db->where("bon_tanggal BETWEEN CAST('".$this->change_tanggal($tanggal1)."' AS DATE) AND CAST('".$this->change_tanggal($tanggal2)."' AS DATE)");
            $this->db->order_by('bon_tanggal', 'ASC');
            $this->db->join("skb_supir","skb_supir.supir_id=skb_bon.supir_id","left");
            $this->db->where("skb_bon.status_hapus","NO");
            return $this->db->get_where("skb_bon",array("skb_bon.supir_id"=>$supir_id))->result_array();
        }

        public function gettruckbyid($truck_id){ //truck by ID
            return $this->db->get_where("skb_mobil",array("mobil_no"=>$truck_id))->row_array();
        }

        public function get_user_by_id($user_id){ //truck by ID
            return $this->db->get_where("user",array("user_id"=>$user_id))->row_array();
        }

        public function getmerkbyid($merk_id){ //merk by ID
            return $this->db->get_where("skb_merk_kendaraan",array("merk_id"=>$merk_id))->row_array();
        }

        public function getpaymentinvoicebyid($payment_id){ //payment by ID
            return $this->db->get_where("payment_invoice",array("payment_invoice_id"=>$payment_id))->row_array();
        }

        public function getpaymentjobyid($payment_id){ //payment by ID
            return $this->db->get_where("payment_jo",array("payment_jo_id"=>$payment_id))->row_array();
        }
        
        public function getpaymentupahbyid($payment_id){ //payment by ID
            return $this->db->get_where("payment_upah",array("payment_upah_id"=>$payment_id))->row_array();
        }
        
        public function getrutebyid($rute_id){ //rute by ID
            $this->db->join("skb_customer","skb_customer.customer_id=skb_rute.customer_id","left");
            return $this->db->get_where("skb_rute",array("rute_id"=>$rute_id))->row_array();
        }
        
        public function getkosonganbyid($kosongan_id,$jo_id){ //kosongan by ID
            $this->db->join("skb_job_order","skb_job_order.kosongan_id=skb_kosongan.kosongan_id","left");
            if($jo_id!=0){
                $this->db->where("skb_job_order.Jo_id",$jo_id);
            }
            return $this->db->get_where("skb_kosongan",array("skb_kosongan.kosongan_id"=>$kosongan_id))->row_array();
        }
        
        public function getallmerk(){ //merk all
            return $this->db->get_where("skb_merk_kendaraan",array("status_hapus"=>"NO","Validasi"=>"ACC"))->result_array();
        }
        
        public function getinvoicebyid($invoice_id){ //invoice by ID
            $this->db->join("skb_invoice","skb_invoice.invoice_kode=skb_job_order.invoice_id","left");
            return $this->db->get_where("skb_job_order",array("invoice_id"=>$invoice_id))->result_array();
        }

        public function getinvoicepayment($invoice_id){ //invoice by ID
            $this->db->join("skb_customer","skb_customer.customer_id=skb_invoice.customer_id","left");
            return $this->db->get_where("skb_invoice",array("invoice_kode"=>$invoice_id))->row_array();
        }

        public function getpaymentinvoice($invoice_id){ //invoice by ID
            return $this->db->get_where("payment_invoice",array("invoice_id"=>$invoice_id))->result_array();
        }

        public function getupahpayment($upah_id){ //invoice by ID
            $this->db->join("skb_supir","skb_supir.supir_id=skb_pembayaran_upah.supir_id","left");
            return $this->db->get_where("skb_pembayaran_upah",array("pembayaran_upah_id"=>$upah_id))->row_array();
        }

        public function getpaymentupah($upah_id){ //invoice by ID
            return $this->db->get_where("payment_upah",array("pembayaran_upah_id"=>$upah_id))->result_array();
        }

        
        public function getjopayment($jo_id){ //invoice by ID
            $this->db->join("skb_supir","skb_supir.supir_id=skb_job_order.supir_id","left");
            $this->db->join("skb_customer","skb_customer.customer_id=skb_job_order.customer_id","left");
            return $this->db->get_where("skb_job_order",array("Jo_id"=>$jo_id))->row_array();
        }

        public function getpaymentjo($jo_id){ //invoice by ID
            return $this->db->get_where("payment_jo",array("jo_id"=>$jo_id))->result_array();
        }
        
        public function getjobbysupir($supir_id){ //JO by supir
            $this->db->where("status_upah","Belum Dibayar");
            $this->db->where("upah!=","0");
            $this->db->join("skb_supir","skb_supir.supir_id=skb_job_order.supir_id","left");
            return $this->db->get_where("skb_job_order",array("skb_job_order.supir_id"=>$supir_id,"skb_job_order.status"=>"Sampai Tujuan"))->result_array();
        }
        
        public function getjobbysupirbulan($supir_id,$nopol,$tahun,$bulan){ //JO by supir
            if($bulan=="x" && $tahun=="x"){
                $bulan_kerja = "";
            }else if($bulan=="x"){
                $bulan_kerja = "'".$tahun."%'";
                $this->db->where("tanggal_muat like ".$bulan_kerja);
            }else if($tahun=="x"){
                $bulan_kerja = "'%-".$bulan."-%'";
                $this->db->where("tanggal_muat like ".$bulan_kerja);
            }else{
                $bulan_kerja = "'".$tahun."-".$bulan."-%'";
                $this->db->where("tanggal_muat like ".$bulan_kerja);
            }
            $this->db->where("pembayaran_upah_id","");
            $this->db->where("upah!=","0");
            $this->db->join("skb_customer","skb_customer.customer_id=skb_job_order.customer_id","left");
            $this->db->join("skb_supir","skb_supir.supir_id=skb_job_order.supir_id","left");
            if($nopol!="No Polisi"){
                return $this->db->get_where("skb_job_order",array("skb_job_order.supir_id"=>$supir_id,"skb_job_order.mobil_no"=>$nopol,"skb_job_order.status"=>"Sampai Tujuan"))->result_array();
            }else{
                return $this->db->get_where("skb_job_order",array("skb_job_order.supir_id"=>$supir_id,"skb_job_order.status"=>"Sampai Tujuan"))->result_array();
            }
        }
        
        public function getpembayaranupah(){
            $this->db->join("skb_supir","skb_supir.supir_id=skb_pembayaran_upah.supir_id","left");
            return $this->db->get("skb_pembayaran_upah")->result_array();
        }

        public function getjobypembayaranupah($upah_id){
            $this->db->select("Jo_id");
            return $this->db->get_where("skb_job_order",array("pembayaran_upah_id"=>$upah_id))->result_array();
        }

        public function getpembayaranupahbyid($pembayaran_id){
            $this->db->join("skb_job_order","skb_job_order.pembayaran_upah_id=skb_pembayaran_upah.pembayaran_upah_id","left");
            $this->db->join("skb_customer","skb_customer.customer_id=skb_job_order.customer_id","left");
            return $this->db->get_where("skb_pembayaran_upah",array("skb_pembayaran_upah.pembayaran_upah_id"=>$pembayaran_id))->result_array();
        }

        public function getinvoicebyjo($jo_id){ //invoice by JO
            $this->db->join("skb_job_order","skb_job_order.Jo_id=skb_invoice.jo_id","left");
            return $this->db->get_where("skb_invoice",array("skb_invoice.jo_id"=>$jo_id))->row_array();
        }
    //end fungsi get
    
    //fungsi update insert

        public function updateUJ($jo_id,$keterangan,$uj){ //update status jo saat sampai tujuan
            $this->db->set("uang_jalan_bayar",$uj);
            $this->db->set("keterangan",$keterangan);
            $this->db->where("Jo_id",$jo_id);
            $this->db->update("skb_job_order");
        }

        public function insert_upah($data){ //update upah saat bayar gaji/upah
            $supir_id = $data["supir_id"];
            $supir = $this->db->get_where("skb_supir",array("supir_id"=>$supir_id))->row_array();
            $Jo_id = $data["Jo_id"];
            $gaji_grand_total = $data["gaji_grand_total"];
            $gaji_total = $data["gaji_total"];
            $kasbon = $data["kasbon"];
            $bonus = $data["bonus"];
            $pembayaran_upah_id = $data["pembayaran_upah_id"];
            $tanggal = $data["tanggal"];

            //set kasbon supir
            $this->db->set("supir_kasbon",$supir["supir_kasbon"]-$kasbon);
            $this->db->where("supir_id",$supir_id);
            $this->db->update("skb_supir");
            //end set kasbon supir

            //insert kasbon 
            if($kasbon>0){
                $this->db->select("bon_id");
                $bon_id = $this->db->get("skb_bon")->result_array();
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
                date_default_timezone_set('Asia/Jakarta');
                $data_bon=array(
                    "bon_id"=>(max($isi_bon_id)+1)."-BON-".date("m")."-".date("Y"),
                    "supir_id"=>$supir_id,
                    "bon_jenis"=>"Potong Gaji",
                    "bon_nominal"=>$kasbon,
                    "bon_keterangan"=>"Potongan Kasbon Dari Pembayaran Gaji",
                    "pembayaran_upah_id"=>$data["pembayaran_upah_id"],
                    "bon_tanggal"=>date("Y-m-d"),
                    "user"=>$_SESSION["user"]."(".date("d-m-Y H:i:s").")",
                    "status_hapus"=>"NO",
                );
                $this->db->insert("skb_bon",$data_bon);
            }
            //end insert kasbon
            //insert pembayaran upah 
            date_default_timezone_set('Asia/Jakarta');
            $data=array(
                "supir_id"=>$supir_id,
                "pembayaran_upah_id"=>$pembayaran_upah_id, 
                "pembayaran_upah_nominal"=>$gaji_total,
                "pembayaran_upah_bonus"=>$bonus,
                "pembayaran_upah_bon"=>$kasbon,
                "pembayaran_upah_total"=>$gaji_grand_total,
                "pembayaran_upah_tanggal"=>$tanggal,
                "pembayaran_upah_status"=>"Belum Lunas",
                "bulan_kerja"=>$data["bulan_kerja"],
                "user_upah"=>$_SESSION["user"]."(".date("d-m-Y H:i:s").")",
                "keterangan"=>$data["keterangan"],
                "sisa"=>$data["sisa"],
                "nopol"=>$data["nopol"]
            );
            $this->db->insert("skb_pembayaran_upah",$data);
            //end insert pembayaran upah 
            //update status upah pada jo id
                if($Jo_id != null){
                    for($i=0;$i<count($Jo_id);$i++){
                        $this->db->set("pembayaran_upah_id",$pembayaran_upah_id);
                        $this->db->where("Jo_id",$Jo_id[$i]);
                        $this->db->update("skb_job_order");
                    }
                }
            //end update status upah pada jo id
        }

        public function update_upah($data){ //update upah saat bayar gaji/upah
            $supir_id = $data["supir_id"];
            $supir = $this->db->get_where("skb_supir",array("supir_id"=>$supir_id))->row_array();
            $Jo_id = $data["Jo_id"];
            $gaji_grand_total = $data["gaji_grand_total"];
            $gaji_total = $data["gaji_total"];
            $kasbon = $data["kasbon"];
            $bonus = $data["bonus"];

            //set kasbon supir
                $this->db->set("supir_kasbon",$supir["supir_kasbon"]-$kasbon);
                $this->db->where("supir_id",$supir_id);
                $this->db->update("skb_supir");
            //end set kasbon supir

            //insert kasbon 
                if($kasbon>0){
                    $this->db->select("bon_id");
                    $bon_id = $this->db->get("skb_bon")->result_array();
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
                    date_default_timezone_set('Asia/Jakarta');
                    $data_bon=array(
                        "bon_id"=>(max($isi_bon_id)+1)."-BON-".date("m")."-".date("Y"),
                        "supir_id"=>$supir_id,
                        "bon_jenis"=>"Potong Gaji",
                        "bon_nominal"=>$kasbon,
                        "bon_keterangan"=>"Potongan Kasbon Dari Pembayaran Gaji",
                        "pembayaran_upah_id"=>$data["pembayaran_upah_id"],
                        "bon_tanggal"=>date("Y-m-d"),
                        "user"=>$_SESSION["user"]."(".date("d-m-Y H:i:s").")"
                    );
                    $this->db->insert("skb_bon",$data_bon);
                }
            //end insert kasbon 
            $this->db->set("pembayaran_upah_status","Lunas");
            $this->db->where("pembayaran_upah_id",$data["pembayaran_upah_id"]);
            $this->db->update("skb_pembayaran_upah");
            //update status upah pada jo id
                if($Jo_id != null){
                    for($i=0;$i<count($Jo_id);$i++){
                        $this->db->set("status_upah","Sudah Dibayar");
                        $this->db->where("Jo_id",$Jo_id[$i]);
                        $this->db->update("skb_job_order");
                    }
                }
            //end update status upah pada jo id
        }
        
        public function updateinvoice($invoice_kode){ //update status bayar invoice jadi lunas
            $this->db->set("status_bayar","Lunas");
            $this->db->where("invoice_kode",$invoice_kode);
            $this->db->update("skb_invoice");
        }

        public function update_jo_dibatalkan($Jo_id,$supir_id,$mobil_no,$uj){
            $this->db->set("status","Dibatalkan");
            $this->db->set("user_closing",$_SESSION["user"]."(".date("d-m-Y H:i:s").")");
            $this->db->where("Jo_id",$Jo_id);
            $this->db->update("skb_job_order");

            $this->db->set("status_jalan","Tidak Jalan");
            $this->db->where("supir_id",$supir_id);
            $this->db->update("skb_supir");

            $this->db->set("status_jalan","Tidak Jalan");
            $this->db->where("mobil_no",str_replace("%20"," ",$mobil_no));
            $this->db->update("skb_mobil");
        }
        public function update_slip($data,$pembayaran_upah_id,$data_jo){ //update slip gaji
            $jo_lama = $this->db->get_where("skb_job_order",array("pembayaran_upah_id"=>$pembayaran_upah_id))->result_array();

            $this->db->where("pembayaran_upah_id",$pembayaran_upah_id);
            $this->db->update("skb_pembayaran_upah",$data);

            $this->db->where("pembayaran_upah_id",$pembayaran_upah_id);
            $this->db->set("bon_nominal",$data["pembayaran_upah_bon"]);
            $this->db->update("skb_bon");

            //update status upah pada jo id
                if($data_jo != null){
                    for($i=0;$i<count($data_jo);$i++){
                        $this->db->set("pembayaran_upah_id",$pembayaran_upah_id);
                        $this->db->where("Jo_id",$data_jo[$i]);
                        $this->db->update("skb_job_order");
                    }
                }
                for($i=0;$i<count($jo_lama);$i++){
                    if(!in_array($jo_lama[$i]["Jo_id"],$data_jo)){
                        $this->db->set("pembayaran_upah_id","");
                        $this->db->where("Jo_id",$jo_lama[$i]["Jo_id"]);
                        $this->db->update("skb_job_order");
                    }
                }
            //end update status upah pada jo id
        }
    //end fungsi update insert

    //fungsi untuk update supir dan mobil JO
        public function getsupir(){
            return $this->db->get_where("skb_supir",array("status_hapus"=>"NO"))->result_array();
        }
        public function getallmobilslip($supir_id){
            if($supir_id!="x"){
                return $this->db->get_where("skb_job_order",array("supir_id"=>$supir_id,"pembayaran_upah_id"=>""))->result_array();
            }else{
                return $this->db->get_where("skb_mobil",array("status_hapus"=>"NO"))->result_array();
            }
        }
        public function getmobil($mobil_jenis){
            return $this->db->get_where("skb_mobil",array("status_jalan"=>"Tidak Jalan","status_hapus"=>"NO","validasi"=>"ACC","mobil_jenis"=>$mobil_jenis))->result_array();
        }
        public function getallmobil(){
            return $this->db->get_where("skb_mobil",array("status_hapus"=>"NO"))->result_array();
        }
        public function updatesupirjo($jo_id,$supir_id,$supir_id_old){
            $this->db->where("Jo_id",$jo_id);
            $this->db->set("supir_id",$supir_id);
            $this->db->update("skb_job_order");

            $this->db->where("supir_id",$supir_id);
            $this->db->set("status_jalan","Jalan");
            $this->db->update("skb_supir");

            $this->db->where("supir_id",$supir_id_old);
            $this->db->set("status_jalan","Tidak Jalan");
            $this->db->update("skb_supir");
        }

        public function updatemobiljo($jo_id,$mobil_no,$mobil_no_old){
            $this->db->where("Jo_id",$jo_id);
            $this->db->set("mobil_no",$mobil_no);
            $this->db->update("skb_job_order");

            $this->db->where("mobil_no",$mobil_no);
            $this->db->set("status_jalan","Jalan");
            $this->db->update("skb_mobil");

            $this->db->where("mobil_no",$mobil_no_old);
            $this->db->set("status_jalan","Tidak Jalan");
            $this->db->update("skb_mobil");
        }
    //end fungsi untuk update supir dan mobil JO

    //fungsi untuk data slip gaji
        function getGajiData($postData,$data){
            $response = array();
        
            ## Read value
            $draw = $postData['draw'];
            $start = $postData['start']; // mulai display per page
            $rowperpage = $postData['length']; // Rows display per page
            $columnIndex = $postData['order'][0]['column']; // Column index untuk sorting
            $columnName = $postData['columns'][$columnIndex]['data']; // Column name untuk sorting
            $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        
            ## Search 
            $search_arr = array();
            $searchQuery = "";
            if($data["nopol"]!=""){
                $search_arr[] = " nopol='".$data["nopol"]."' ";
            }
            if($data["Status"]!=""){
                $search_arr[] = " pembayaran_upah_status='".$data["Status"]."' ";
            }
            if($data["Supir"]!=""){
                $search_arr[] = " skb_pembayaran_upah.supir_id = '".$data["Supir"]."'";
            }
            if($data["Bulan"]!="" && $data["Bulan"]!="x"){
                if($data["Tahun"]!="" && $data["Tahun"]!="x"){
                    $search_arr[] = " bulan_kerja like'%".$data["Bulan"]."-".$data["Tahun"]."%' ";
                }else{
                    $search_arr[] = " bulan_kerja like'%".$data["Bulan"]."-%' ";
                }
            }else{
                if($data["Tahun"]!="" && $data["Tahun"]!="x"){
                    $search_arr[] = " bulan_kerja like'%-".$data["Tahun"]."%' ";
                }else{
                    $search_arr[] = " bulan_kerja like'%-%' ";
                }
            }
            if($data["Tanggal1"]!="" && $data["Tanggal2"]==""){
                $search_arr[] = " pembayaran_upah_tanggal BETWEEN '".$this->change_tanggal($data["Tanggal1"])."' AND '2022-10-10'";
            }
            if($data["Tanggal1"]=="" && $data["Tanggal2"]!=""){
                $search_arr[] = " pembayaran_upah_tanggal BETWEEN '2000-10-10' AND '".$this->change_tanggal($data["Tanggal2"])."'";
            }
            if($data["Tanggal1"]!="" && $data["Tanggal2"]!=""){
                $search_arr[] = " pembayaran_upah_tanggal BETWEEN '".$this->change_tanggal($data["Tanggal1"])."' AND '".$this->change_tanggal($data["Tanggal2"])."' ";
            }
            $pembayaran_upah = explode("-",$data["No_Slip"]);
            $pembayaran_upah_fix = "";
            for($i=0;$i<count($pembayaran_upah);$i++){
                if($pembayaran_upah[$i]!="x"){
                    if($i!=3){
                        $pembayaran_upah_fix=$pembayaran_upah_fix.$pembayaran_upah[$i]."-";
                    }else{
                        $pembayaran_upah_fix.=$pembayaran_upah[$i];
                    }
                }
            }
            $search_arr[] = " pembayaran_upah_id like '%".$pembayaran_upah_fix."%'";

            if(count($search_arr) > 0){ //gabung kondisi where
                $searchQuery = implode(" and ",$search_arr);
            }
        
            ## Total record without filtering
            $this->db->select('count(*) as allcount');
            $records = $this->db->get('skb_pembayaran_upah')->result();
            $totalRecords = $records[0]->allcount;
        
            ## Total record with filtering
            $this->db->select('count(*) as allcount');
            if($searchQuery != ''){
                $this->db->where($searchQuery);
            }
            $this->db->join("skb_supir", "skb_supir.supir_id = skb_pembayaran_upah.supir_id", 'left');
            $records = $this->db->get('skb_pembayaran_upah')->result();
            $totalRecordwithFilter = $records[0]->allcount;
        
            ## data hasil record
            $this->db->select('*');
            if($searchQuery != ''){
                $this->db->where($searchQuery);
            }
            $this->db->order_by($columnName, $columnSortOrder);
            $this->db->limit($rowperpage, $start);
            $this->db->join("skb_supir", "skb_supir.supir_id = skb_pembayaran_upah.supir_id", 'left');
            $records = $this->db->get('skb_pembayaran_upah')->result();
        
            $data = $records;
            ## Response
            $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
            );
        
            return $response; 
        }
        function getDitemukanSlip($data){
            ## Search 
            $search_arr = array();
            $searchQuery = "";
            if($data["nopol"]!=""){
                $search_arr[] = " nopol='".$data["nopol"]."' ";
            }
            if($data["Status"]!=""){
                $search_arr[] = " pembayaran_upah_status='".$data["Status"]."' ";
            }
            if($data["Supir"]!=""){
                $search_arr[] = " skb_pembayaran_upah.supir_id = '".$data["Supir"]."'";
            }
            if($data["Bulan"]!="" && $data["Bulan"]!="x"){
                if($data["Tahun"]!="" && $data["Tahun"]!="x"){
                    $search_arr[] = " bulan_kerja like'%".$data["Bulan"]."-".$data["Tahun"]."%' ";
                }else{
                    $search_arr[] = " bulan_kerja like'%".$data["Bulan"]."-%' ";
                }
            }else{
                if($data["Tahun"]!="" && $data["Tahun"]!="x"){
                    $search_arr[] = " bulan_kerja like'%-".$data["Tahun"]."%' ";
                }else{
                    $search_arr[] = " bulan_kerja like'%-%' ";
                }
            }
            if($data["Tanggal1"]!="" && $data["Tanggal2"]==""){
                $search_arr[] = " pembayaran_upah_tanggal BETWEEN '".$this->change_tanggal($data["Tanggal1"])."' AND '2022-10-10'";
            }
            if($data["Tanggal1"]=="" && $data["Tanggal2"]!=""){
                $search_arr[] = " pembayaran_upah_tanggal BETWEEN '2000-10-10' AND '".$this->change_tanggal($data["Tanggal2"])."'";
            }
            if($data["Tanggal1"]!="" && $data["Tanggal2"]!=""){
                $search_arr[] = " pembayaran_upah_tanggal BETWEEN '".$this->change_tanggal($data["Tanggal1"])."' AND '".$this->change_tanggal($data["Tanggal2"])."' ";
            }
            $pembayaran_upah = explode("-",$data["No_Slip"]);
            $pembayaran_upah_fix = "";
            for($i=0;$i<count($pembayaran_upah);$i++){
                if($pembayaran_upah[$i]!="x"){
                    if($i!=3){
                        $pembayaran_upah_fix=$pembayaran_upah_fix.$pembayaran_upah[$i]."-";
                    }else{
                        $pembayaran_upah_fix.=$pembayaran_upah[$i];
                    }
                }
            }
            $search_arr[] = " pembayaran_upah_id like '%".$pembayaran_upah_fix."%'";

            if(count($search_arr) > 0){ //gabung kondisi where
                $searchQuery = implode(" and ",$search_arr);
            }
        
            ## Total record without filtering
            if($searchQuery != ''){
                $this->db->where($searchQuery);
            }
            $records = $this->db->get('skb_pembayaran_upah')->result_array();
            return $records;
        }
    //fungsi untuk data slip gaji
}
