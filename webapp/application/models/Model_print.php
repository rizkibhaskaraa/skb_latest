<?php
// error_reporting(0);
class Model_Print extends CI_model
{
    public function getjobyperiode($tanggal,$bulan,$tahun,$status)
    {
        $like=$tahun."-".$bulan."-".$tanggal;
        if($like != "--"){
            if ($tanggal != "x" && $bulan=="x" && $tahun=="x") {
                $this->db->like("tanggal_surat", "-".$tanggal);
            }
            if ($tanggal == "x" && $bulan!="x" && $tahun=="x") {
                $this->db->like("tanggal_surat", "-".$bulan."-");
            }
            if ($tanggal == "x" && $bulan=="x" && $tahun!="x") {
                $this->db->like("tanggal_surat", $tahun."-");
            }
            if ($tanggal != "x" && $bulan=="x" && $tahun!="x") {
                $this->db->like("tanggal_surat", $tahun."-__-".$tanggal);
            }
            if ($tanggal == "x" && $bulan!="x" && $tahun!="x") {
                $this->db->like("tanggal_surat", $tahun."-".$bulan."-");
            }
            if ($tanggal != "x" && $bulan!="x" && $tahun=="x") {
                $this->db->like("tanggal_surat", "-".$bulan."-".$tanggal);
            }
            if ($tanggal != "x" && $bulan!="x" && $tahun!="x") {
                $this->db->like("tanggal_surat", $tahun."-".$bulan."-".$tanggal);
            }
        }
        if($status!="x"){
            $this->db->where("skb_job_order.status",(str_replace("%20"," ",$status)));
        }
        $this->db->where("status!=","Dibatalkan");
        $this->db->join("skb_customer", "skb_customer.customer_id = skb_job_order.customer_id", 'left');
        $this->db->join("skb_supir", "skb_supir.supir_id = skb_job_order.supir_id", 'left');
        $this->db->join("skb_mobil", "skb_mobil.mobil_no = skb_job_order.mobil_no", 'left');
        $hasil = $this->db->get('skb_job_order')->result_array();
            $hasil_fix = [];
            for($i=0;$i<count($hasil);$i++){
                if($hasil[$i]["parent_Jo_id"]=="x" || $hasil[$i]["parent_Jo_id"]=="y"){
                    $hasil_fix[] = $hasil[$i];
                }
            }
            return $hasil_fix;
        }

        public function getkosongan() //all kosongan
        {
            return $this->db->get("skb_kosongan")->result_array();
        }

        public function getpaketan() //all paketan
        {
            return $this->db->get("skb_paketan")->result_array();
        }
        public function getkosonganbyid($kosongan_id){ //kosongan by ID
            return $this->db->get_where("skb_kosongan",array("skb_kosongan.kosongan_id"=>$kosongan_id))->row_array();
        }
}