<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: HI
 * Date: 8/19/2016
 * Time: 12:00 PM
 */

/**
 * @property Common_model $Common_model It resides all the methods which can be used in most of the controllers.
 * @property Users_Auth $Users_Auth It resides all the methods which can be used in most of the controllers.
 * @property CI_Session $session
 * @property CI_Input $input
 */
class Admin extends MY_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model("Common_model");
        $this->load->model('Users_Auth');
        $this->load->helper('cookie');
        $this->Users_Auth->is_logged_in();
    }


    public function index(){
        $this->assessments_list();
    }

    public function assessments_list($list=NULL){

        if($list === 'listing'){
            $selectData = array('
            user.id as UserID,
            CONCAT(`firstName`," ",`lastName`) AS FullName,
            email AS Email, company AS Company,
            business AS Business,
            score AS Score,
            CASE WHEN user.status = 1 THEN CONCAT("<span class=\'label label-danger\'> ", ES.status," </span>") WHEN user.status = 2 THEN CONCAT ("<span class=\'label label-warning\'> ", ES.status, " </span>") WHEN user.status = 3 THEN CONCAT ("<span class=\'label label-success\'> ", ES.status, " </span>") ELSE "" END AS Status
            ',false);
            $joins = array(
                array(
                    'table' => 'esic_status ES',
                    'condition' => 'ES.id = user.status',
                    'type' => 'LEFT'
                )
            );
            $addColumns = array(
               'ViewEditActionButtons' => '<a href="#"><span aria-hidden="true" class="glyphicon glyphicon-play text-green"></span></a> &nbsp; <a href="#" data-target=".approval-modal" data-toggle="modal"><i class="fa fa-check"></i></a>'
            );
            $returnedData = $this->Common_model->select_fields_joined_DT($selectData,'user',$joins,'','','','',$addColumns);
            print_r($returnedData);
            return NULL;
        }

        $data['title'] = 'Pre-assessment List';
        $this->show_admin("admin/reg_list",$data);
    }

    public function assessment_list(){
        $userID = $this->input->post('id');
        $status = $this->input->post('value');
        if(!isset($userID) || empty($userID)){
            echo "FAIL::Something went wrong with the post, Please Contact System Administrator for Further Assistance";
            return;
        }

        //UpdateData
        $updateArray = array();
        if($status === 'approve'){
            $updateArray['status'] = 3;
        }
        if($status === 'pending'){
            $updateArray['status'] = 1;
        }

        $whereUpdate = array(
            'id' => $userID
        );

        $this->Common_model->update('user',$whereUpdate,$updateArray);
    }
}