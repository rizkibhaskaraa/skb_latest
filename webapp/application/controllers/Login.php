<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
		$this->load->model('model_login');//load model
		$this->load->model('model_form');//load model
    }

    public function index(){
        $user = $this->model_login->update_tidak_aktif_all();
        $this->load->view("login");
    }

    public function logout(){
        if(isset($_SESSION["user_aktif"])){
            $this->model_login->update_tidak_aktif($_SESSION["user_aktif"]);
        }
        session_destroy();
        redirect(base_url());
    }
    
    public function login(){
        $username = $this->input->post("username");
        $password = sha1($this->input->post("password"));
        $user = $this->model_login->getuserbyusername($username);
        if($user==null){
            $akun = $this->model_login->getakunbyid("");   
        }else{
            $akun = $this->model_login->getakunbyid($user["akun_id"]);
            $akun_akses = json_decode($akun["akun_akses"]);
        }
        if($user){
            $save_password = $user["password"];
            if($password == $save_password){
                if($user["status_aktif"]=="Tidak Aktif"){
                    $this->session->set_flashdata('status-login', 'Berhasil');
                    $this->model_login->update_aktif($user["user_id"]);
                    $_SESSION["password"] = $save_password;
                    $_SESSION["user_id"] = $user["akun_id"];
                    $_SESSION["user_aktif"] = $user["user_id"];
                    $_SESSION["user"] = $user["akun_name"];
                    $_SESSION["role"] = $user["akun_role"];
                    $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
                    $_SESSION["payment_jo"] = json_decode($data["akun_akses"]["akses"])[20];
                    $_SESSION["payment_invoice"] = json_decode($data["akun_akses"]["akses"])[18];
                    $_SESSION["payment_slip"] = json_decode($data["akun_akses"]["akses"])[19];
                    $_SESSION["update_jo"] = json_decode($data["akun_akses"]["akses"])[2];
                    redirect(base_url("index.php/dashboard/"));
                }else{
                    $this->session->set_flashdata('status-login', 'Aktif');
                    redirect(base_url());                                    
                }
            }else{
                $this->session->set_flashdata('status-login', 'Password');
                redirect(base_url());                
            }
        }else{
			$this->session->set_flashdata('status-login', 'Username');
            redirect(base_url());
        }
    }
    public function cek_password($password_old,$password_new,$password_fix){
        if(sha1($password_old) == $_SESSION["password"]){
            if($password_fix==$password_new){
                echo "true";
            }else{
                echo "false";
            }
        }else{
            echo "false lama";
        }
    }
    public function ubah_password(){
        $password_new = sha1($this->input->post("password_new"));
        $password_fix = sha1($this->input->post("password_fix"));
        $this->model_login->ubah_password($password_new);
        session_destroy();
        redirect(base_url());
    }
    public function set_login(){
        $this->model_login->set_login();
    }
}