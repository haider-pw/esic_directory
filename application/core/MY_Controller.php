<?php
/**
 * Created by PhpStorm.
 * User: HI
 * Date: 8/19/2016
 * Time: 12:32 PM
 */

class MY_Controller extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }


    public function show_admin($viewPath, $data = NULL, $bool = false){
        $this->load->view('admin/components/header',$data, $bool);
        $this->load->view($viewPath, $data, $bool);
        $this->load->view('admin/components/footer',$data, $bool);
    }
}