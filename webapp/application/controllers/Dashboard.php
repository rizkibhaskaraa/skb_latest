<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    //construck
        public function __construct()
        {
            parent::__construct();
            $this->load->model('model_home');//load model
            $this->load->model('model_form');//load model
            $this->load->model('model_dashboard');//load model
        }
    //end construck

    public function index()
    {
        if(!isset($_SESSION["user"])){
    		$this->session->set_flashdata('status-login', 'False');
            redirect(base_url());
        }
        $data["page"] = "DB_Izin_page";
        $data["collapse_group"] = "Dashboard";
        $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
        $this->load->view('header',$data);
        $this->load->view('sidebar');
        $this->load->view('dashboard/dashboard');
    }    
    public function dashboard_operasional()
    {
        if(!isset($_SESSION["user"])){
    		$this->session->set_flashdata('status-login', 'False');
            redirect(base_url());
        }
        $data["page"] = "DB_Operasional_page";
        $data["collapse_group"] = "Dashboard";
        $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
        $this->load->view('header',$data);
        $this->load->view('sidebar');
        $this->load->view('dashboard/dashboard_operasional');
    }    
    public function dashboard_invoice()
    {
        if(!isset($_SESSION["user"])){
    		$this->session->set_flashdata('status-login', 'False');
            redirect(base_url());
        }
        $data["page"] = "DB_Invoice_page";
        $data["collapse_group"] = "Dashboard";
        $data["akun_akses"] = $this->model_form->getakunbyid($_SESSION["user_id"]);
        $this->load->view('header',$data);
        $this->load->view('sidebar');
        $this->load->view('dashboard/dashboard_invoice');
    }    
    public function view_truck($fungsi){
        $postData = $this->input->post();
        $data = $this->model_dashboard->getTruck($postData,$fungsi);
        echo json_encode($data);
    }
    public function view_supir($fungsi){
        $postData = $this->input->post();
        $data = $this->model_dashboard->getSupir($postData,$fungsi);
        echo json_encode($data);
    }
    public function view_invoice_jatuh_tempo(){
        $postData = $this->input->post();
        $data = $this->model_dashboard->getInvoiceTempo($postData);
        echo json_encode($data);
    }
    public function view_JO_no_invoice(){
        $postData = $this->input->post();
        $data = $this->model_dashboard->getJoNoInvoice($postData);
        echo json_encode($data);
    }
}