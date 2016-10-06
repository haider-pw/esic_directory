<?php
/**
 * @property Common_model $Common_model It resides all the methods which can be used in most of the controllers.
 * @property CI_Pagination $pagination It resides all the methods which can be used in most of the controllers.
 * @property Esic_model $Esic_model It resides all the methods which can be used in most of the controllers.
 * @property CI_URI $uri It resides all the methods which can be used in most of the controllers.
 * @property Ajax_pagination $ajax_pagination It resides all the methods which can be used in most of the controllers.
 */
class Esicfilter extends CI_Controller{
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


    }

    public function index($uriSegment = NULL){

        $data['sectors'] = $this->Common_model->select('esic_sectors');
        $data['company'] = $this->Common_model->select('user');
       // $page = 0;
        //$data['usersResult'] = $this->Esic_model->getlist($page);
        $this->load->view("box_listing/filter_list",$data);
    }
}