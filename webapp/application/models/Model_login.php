<?php
// error_reporting(0);
class Model_Login extends CI_model
{
    public function getuserbyusername($username){
        $this->db->join("skb_akun","skb_akun.akun_id=user.akun_id",'left');
        return $this->db->get_where("user",array("username"=>$username))->row_array();
    }

    public function getakunbyid($akun_id){
        return $this->db->get_where("skb_akun",array("akun_id"=>$akun_id))->row_array();
    }
    
    public function ubah_password($password_new){
        $this->db->set("password",$password_new);
        $this->db->where("akun_id",$_SESSION["user_id"]);
        $this->db->update("user");
    }

    public function update_aktif($user_id){
        date_default_timezone_set('Asia/Jakarta');
        $this->db->set("login",date("Y-m-d H:i:s"));
        $this->db->set("status_aktif","Aktif");
        $this->db->where("user_id",$user_id);
        $this->db->update("user");
    }
    public function update_tidak_aktif($user_id){
        $this->db->set("status_aktif","Tidak Aktif");
        $this->db->set("login",null);
        $this->db->where("user_id",$user_id);
        $this->db->update("user");
    }
    public function update_tidak_aktif_all(){
        date_default_timezone_set('Asia/Jakarta');
        $user = $this->db->get("user")->result_array();

        for($i=0;$i<count($user);$i++){
            if($user[$i]["login"] != null){
                $waktu_berhenti = strtotime($user[$i]["login"]);
                $waktu_sekarang = strtotime(date("Y-m-d H:i:s"));
                $beda = $waktu_sekarang - $waktu_berhenti;        
                if($beda > 60){
                    $this->db->set("status_aktif","Tidak Aktif");
                    $this->db->set("login",null);
                    $this->db->where("user_id",$user[$i]["user_id"]);
                    $this->db->update("user");
                }
            }
        }
    }
    public function set_login(){
        date_default_timezone_set('Asia/Jakarta');
        $this->db->set("login",date("Y-m-d H:i:s"));
        $this->db->where("user_id",$_SESSION["user_aktif"]);
        $this->db->update("user");
    }
}