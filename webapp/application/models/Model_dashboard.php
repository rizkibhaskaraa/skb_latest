<?php
// error_reporting(0);
class Model_Dashboard extends CI_model
{
    function getTruck($postData,$fungsi){
        $tanggal_now = date("Y-m-d");
        $response = array();
    
        ## Read value
        $draw = $postData['draw'];
        $start = $postData['start']; // mulai display per page
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index untuk sorting
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name untuk sorting
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value
    
        ## Search 
        $search_arr = array();
        $searchQuery = "";
        if($searchValue != ''){
            $search_arr[] = " (mobil_no like '%".$searchValue."%' or 
                mobil_jenis like '%".$searchValue."%' or 
                mobil_type like '%".$searchValue."%' or
                mobil_tahun like '%".$searchValue."%' or
                mobil_merk like'%".$searchValue."%' ) ";
        }
        $search_arr[] = " status_hapus='NO' ";
        $search_arr[] = " validasi='ACC' ";
        if($fungsi=="nopol"){
            $search_arr[] = "datediff('".$tanggal_now."',mobil_berlaku)>-31 ";
        }else if($fungsi=="kir"){
            $search_arr[] = "datediff('".$tanggal_now."',mobil_berlaku_kir)>-31 ";
        }else if($fungsi=="stnk"){
            $search_arr[] = "datediff('".$tanggal_now."',mobil_pajak)>-31 ";
        }else if($fungsi=="ijin"){
            $search_arr[] = "datediff('".$tanggal_now."',mobil_berlaku_ijin_bongkar)>-31 ";
        }else if($fungsi=="usaha"){
            $search_arr[] = "datediff('".$tanggal_now."',mobil_berlaku_usaha)>-31 ";
        }else{
            $search_arr[] = " status_jalan='Tidak Jalan' ";
        }

        if(count($search_arr) > 0){ //gabung kondisi where
            $searchQuery = implode(" and ",$search_arr);
        }
    
        ## Total record without filtering
        $this->db->select('count(*) as allcount');
        $this->db->where("status_hapus","NO");
        $this->db->where("validasi","ACC");
        $records = $this->db->get('skb_mobil')->result();
        $totalRecords = $records[0]->allcount;
    
        ## Total record with filtering
        $this->db->select('count(*) as allcount');
        if($searchQuery != ''){
            $this->db->where($searchQuery);
        }
        $records = $this->db->get('skb_mobil')->result();
        $totalRecordwithFilter = $records[0]->allcount;
    
        ## data hasil record
        $this->db->select('*');
        if($searchQuery != ''){
            $this->db->where($searchQuery);
        }
        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get('skb_mobil')->result();
    
        $data = array();
        $n = 1;
        foreach($records as $record ){
            $sisa="";
            if($fungsi=="nopol"){
                $tanggal = $record->mobil_berlaku;
            }else if($fungsi=="kir"){
                $tanggal = $record->mobil_berlaku_kir;
            }else if($fungsi=="stnk"){
                $tanggal = $record->mobil_pajak;
            }else if($fungsi=="ijin"){
                $tanggal = $record->mobil_berlaku_ijin_bongkar;
            }else if($fungsi=="usaha"){
                $tanggal = $record->mobil_berlaku_usaha;
            }else{
                $tanggal = "0000-00-00";
            }
            $tanggal_now = date("Y-m-d");
            $tgl1 = new DateTime($tanggal_now);
            $tgl2 = new DateTime($tanggal);
            $d = $tgl2->diff($tgl1)->days + 1;
            if($tanggal_now<$tanggal){
                $sisa = "-".$d." hari";   
            }else{
                $sisa = "+".$d." hari";   
            }

            $data[] = array( 
                "no"=>$n,
                "sisa"=>$sisa,
                "mobil_no"=>$record->mobil_no,
                "mobil_merk"=>$record->mobil_merk,
                "mobil_type"=>$record->mobil_type,
                "mobil_dump"=>$record->mobil_dump,
                "mobil_jenis"=>$record->mobil_jenis,
                "mobil_kir"=>$record->mobil_kir,
                "mobil_ijin_bongkar"=>$record->mobil_ijin_bongkar,
                "mobil_berlaku"=>$record->mobil_berlaku,
                "mobil_pajak"=>$record->mobil_pajak,
                "mobil_berlaku_kir"=>$record->mobil_berlaku_kir,
                "mobil_berlaku_usaha"=>$record->mobil_berlaku_usaha,
                "mobil_usaha"=>$record->mobil_usaha,
                "mobil_berlaku_ijin_bongkar"=>$record->mobil_berlaku_ijin_bongkar,
            ); 
            $n++;
        }
        ## Response
        $response = array(
        "draw" => intval($draw),
        "iTotalRecords" => $totalRecords,
        "iTotalDisplayRecords" => $totalRecordwithFilter,
        "aaData" => $data
        );
    
        return $response; 
    }

    function getSupir($postData,$fungsi){
        $tanggal_now = date("Y-m-d");
        $response = array();
    
        ## Read value
        $draw = $postData['draw'];
        $start = $postData['start']; // mulai display per page
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index untuk sorting
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name untuk sorting
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value
    
        ## Search 
        $search_arr = array();
        $searchQuery = "";
        if($searchValue != ''){
            $search_arr[] = " (supir_name like '%".$searchValue."%' or 
                supir_telp like '%".$searchValue."%' or 
                supir_panggilan like '%".$searchValue."%' or 
                supir_sim like'%".$searchValue."%' ) ";
        }
        $search_arr[] = " status_hapus='NO' ";
        $search_arr[] = " validasi='ACC' ";

        if($fungsi=="sim"){
            $search_arr[] = "datediff('".$tanggal_now."',supir_tgl_sim)>-31 ";
        }else{
            $search_arr[] = " status_jalan='Tidak Jalan' ";
        }

        if(count($search_arr) > 0){ //gabung kondisi where
            $searchQuery = implode(" and ",$search_arr);
        }
    
        ## Total record without filtering
        $this->db->select('count(*) as allcount');
        $this->db->where("status_hapus","NO");
        $this->db->where("validasi","ACC");
        $records = $this->db->get('skb_supir')->result();
        $totalRecords = $records[0]->allcount;
    
        ## Total record with filtering
        $this->db->select('count(*) as allcount');
        if($searchQuery != ''){
            $this->db->where($searchQuery);
        }
        $records = $this->db->get('skb_supir')->result();
        $totalRecordwithFilter = $records[0]->allcount;
    
        ## data hasil record
        $this->db->select('*');
        if($searchQuery != ''){
            $this->db->where($searchQuery);
        }
        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get('skb_supir')->result();
    
        $data = array();
        $n=0;
        foreach($records as $record ){
            $n++;
            $sisa="";
            if($fungsi=="sim"){
                $tanggal = $record->supir_tgl_sim;
            }else{
                $tanggal = "0000-00-00";
            }
            $tanggal_now = date("Y-m-d");
            $tgl1 = new DateTime($tanggal_now);
            $tgl2 = new DateTime($tanggal);
            $d = $tgl2->diff($tgl1)->days + 1;
            if($tanggal_now<$tanggal){
                $sisa = "-".$d." hari";   
            }else{
                $sisa = "+".$d." hari";   
            }

            $data[] = array(
                "no"=>$n,
                "sisa"=>$sisa,
                "supir_id"=>$record->supir_id,
                "supir_name"=>$record->supir_name,
                "supir_telp"=>$record->supir_telp,
                "supir_tgl_sim"=>$record->supir_tgl_sim,
                "supir_sim"=>$record->supir_sim,
                "status_jalan"=>$record->status_jalan
            ); 
        }
        ## Response
        $response = array(
        "draw" => intval($draw),
        "iTotalRecords" => $totalRecords,
        "iTotalDisplayRecords" => $totalRecordwithFilter,
        "aaData" => $data
        );
    
        return $response; 
    }
    
    function getInvoiceTempo($postData){
        $tanggal_now = date("Y-m-d");
        $response = array();
    
        ## Read value
        $draw = $postData['draw'];
        $start = $postData['start']; // mulai display per page
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index untuk sorting
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name untuk sorting
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value
    
        ## Search 
        $search_arr = array();
        $searchQuery = "";
        if($searchValue != ''){
            $search_arr[] = " (invoice_kode like '%".$searchValue."%') ";
        }
        $search_arr[] = " status_bayar='Belum Lunas' ";
        $search_arr[] = " CURDATE()>tanggal_batas_pembayaran ";
        if(count($search_arr) > 0){ //gabung kondisi where
            $searchQuery = implode(" and ",$search_arr);
        }
    
        ## Total record without filtering
        $this->db->select('count(*) as allcount');
        $records = $this->db->get('skb_invoice')->result();
        $totalRecords = $records[0]->allcount;
    
        ## Total record with filtering
        $this->db->select('count(*) as allcount');
        if($searchQuery != ''){
            $this->db->where($searchQuery);
        }
        $records = $this->db->get('skb_invoice')->result();
        $totalRecordwithFilter = $records[0]->allcount;
    
        ## data hasil record
        $this->db->select('*');
        $this->db->join("skb_customer", "skb_customer.customer_id = skb_invoice.customer_id", 'left');
        if($searchQuery != ''){
            $this->db->where($searchQuery);
        }
        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get('skb_invoice')->result();
    
        $data = array();
        $n = 1;
        foreach($records as $record ){
            $tanggal_batas_bayar = date('Y-m-d', strtotime('+'.$record->batas_pembayaran.' days', strtotime($record->tanggal_invoice)));

            $tgl1 = new DateTime($tanggal_now);
            $tgl2 = new DateTime($tanggal_batas_bayar);
            $batas_bayar = $tgl2->diff($tgl1)->days;

            $data[] = array(
                "no"=>$n,
                "invoice_kode"=>$record->invoice_kode,
                "customer_name"=>$record->customer_name,
                "tanggal_invoice"=>$record->tanggal_invoice,
                "tgl_batas_pembayaran"=>$record->tanggal_batas_pembayaran,
                "batas_pembayaran"=>$batas_bayar,
                "status_bayar"=>$record->status_bayar,
                "grand_total"=>$record->grand_total
            ); 
            $n++;
        }
        ## Response
        $response = array(
        "draw" => intval($draw),
        "iTotalRecords" => $totalRecords,
        "iTotalDisplayRecords" => $totalRecordwithFilter,
        "aaData" => $data
        );
    
        return $response; 
    }
        function getJoNoInvoice($postData){
            $tanggal_now = date("Y-m-d");
            $response = array();
        
            ## Read value
            $draw = $postData['draw'];
            $start = $postData['start']; // mulai display per page
            $rowperpage = $postData['length']; // Rows display per page
            $columnIndex = $postData['order'][0]['column']; // Column index untuk sorting
            $columnName = $postData['columns'][$columnIndex]['data']; // Column name untuk sorting
            $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
            $searchValue = $postData['search']['value']; // Search value
        
            ## Search 
            $search_arr = array();
            $searchQuery = "";
            if($searchValue != ''){
                $search_arr[] = " (Jo_id like '%".$searchValue."%' or 
                    muatan like '%".$searchValue."%' or 
                    asal like '%".$searchValue."%' or 
                    tujuan like'%".$searchValue."%') ";
            }
            $search_arr[] = " status='Sampai Tujuan' ";
            $search_arr[] = " invoice_id='' ";

            if(count($search_arr) > 0){ //gabung kondisi where
                $searchQuery = implode(" and ",$search_arr);
            }
        
            ## Total record without filtering
            $this->db->select('count(*) as allcount');
            $records = $this->db->get('skb_job_order')->result();
            $totalRecords = $records[0]->allcount;
        
            ## Total record with filtering
            $this->db->select('count(*) as allcount');
            if($searchQuery != ''){
                $this->db->where($searchQuery);
            }
            $records = $this->db->get('skb_job_order')->result();
            $totalRecordwithFilter = $records[0]->allcount;
        
            ## data hasil record
            $this->db->select('*');
            $this->db->join("skb_customer", "skb_customer.customer_id = skb_job_order.customer_id", 'left');
            $this->db->join("skb_supir", "skb_supir.supir_id = skb_job_order.supir_id", 'left');
            $this->db->join("skb_mobil", "skb_mobil.mobil_no = skb_job_order.mobil_no", 'left');
            if($searchQuery != ''){
                $this->db->where($searchQuery);
            }
            $this->db->order_by($columnName, $columnSortOrder);
            $this->db->limit($rowperpage, $start);
            $records = $this->db->get('skb_job_order')->result();
        
            $data = array();
            $n = 1;
            foreach($records as $record ){
                $data[] = array(
                    "no"=>$n,
                    "Jo_id"=>$record->Jo_id,
                    "supir_name"=>$record->supir_name,
                    "mobil_no"=>$record->mobil_no,
                    "mobil_jenis"=>$record->mobil_jenis,
                    "customer_name"=>$record->customer_name,
                    "muatan"=>$record->muatan,
                    "asal"=>$record->asal,
                    "tujuan"=>$record->tujuan,
                    "tanggal_surat"=>$record->tanggal_surat,
                    "tanggal_bongkar"=>$record->tanggal_bongkar,
                    "status"=>$record->status
                ); 
                $n++;
            }
            ## Response
            $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
            );
        
            return $response; 
        }
    public function generate_selisih_tanggal($tanggal){
        $tanggal_now = date("Y-m-d");
        $tgl1 = new DateTime($tanggal_now);
        $tgl2 = new DateTime($tanggal);
        $d = $tgl2->diff($tgl1)->days + 1;
        echo $d;
    }
}