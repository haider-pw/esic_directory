<?php
/**
 * Created by PhpStorm.
 * User: HI
 * Date: 8/23/2016
 * Time: 11:57 AM
 */
/**
 * @property Common_model $Common_model It resides all the methods which can be used in most of the controllers.
 * @property CI_Pagination $pagination It resides all the methods which can be used in most of the controllers.
 * @property Esic_model $Esic_model It resides all the methods which can be used in most of the controllers.
 * @property CI_URI $uri It resides all the methods which can be used in most of the controllers.
 * @property Ajax_pagination $ajax_pagination It resides all the methods which can be used in most of the controllers.
 */
class Esic2 extends CI_Controller{
    protected $perPage;
    public function __construct()
    {
        parent::__construct();
		header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: PUT, GET, POST");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

        $this->load->model("Common_model");
        $this->load->model("Esic_model");

        ///Loading Pagination
//        $this->load->library("pagination");

         $this->load->library('session');

        //Pagination Config
        $this->perPage = 5;

        //

    }

    public function index($uriSegment = NULL){

        $data['sectors'] = $this->Common_model->select('esic_sectors');
        $data['company'] = $this->Common_model->select('user');
        $page = 0;
        $data['usersResult'] = $this->Esic_model->getlist($page);
        $this->load->view("box_listing/db_list",$data);
    }

    public function getlist(){
        $page =  $_GET['page'];
        $this->load->model('Esic_model');
        $data['list'] = $this->Esic_model->getlist($page);
        $this->load->view("box_listing/getlist",$data);
    }
    public function getfilterlist(){
        $page        =  $_GET['page'];
        $secSelect   =  $_GET['secSelect'];
        $comSelect   =  $_GET['comSelect'];
        $searchInput =  $_GET['searchInput'];
        $orderSelect =  $_GET['orderSelect'];
        $orderSelectValue = $_GET['orderSelectValue'];  
        $this->load->model('Esic_model');
        $data['list'] = $this->Esic_model->getfilterlist($page,$searchInput,$secSelect,$comSelect,$orderSelect,$orderSelectValue);
        $this->load->view("box_listing/getlist",$data);
    }
    public function updatethumbs(){
        $userID = $this->input->post('userID');
        $thumbs = $this->input->post('thumbs');
        $newThumbs = $this->input->post('newThumbs');
        $this->load->model('Esic_model');
        $data = $this->Esic_model->updatethumbs($userID,$thumbs,$newThumbs);
        echo $data;
    }

    public function info($userID){
        echo "User Profile WIll Show up Here.";
    }
}