<?php
class Esicdetails extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Common_model");
        $this->load->model("Esic_model");


    }
    public function index($uriSegment = NULL){
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: PUT, GET, POST");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    }
    public function getdetails(){
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: PUT, GET, POST");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        $id  =  $_GET['id'];
        $this->load->model('Esic_model');
        $data['list'] = $this->Esic_model->getdetails($id);
        $this->load->view('product_details',$data);
    }
}