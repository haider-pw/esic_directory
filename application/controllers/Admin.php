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
        $this->load->model('Users_auth');
        $this->load->helper('cookie');
        $this->Users_auth->is_logged_in();
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
            //$addColumns = array(
             //  'ViewEditActionButtons' => '<a href="#"><span aria-hidden="true" class="glyphicon glyphicon-play text-green"></span></a> &nbsp; <a href="#" data-target=".approval-modal" data-toggle="modal"><i class="fa fa-check"></i></a>'
            //);
            $addColumns = array(
               'ViewEditActionButtons' => array('<a href="'.base_url("Admin/details/$1").'"><span aria-hidden="true" class="glyphicon glyphicon-play text-green"></span></a> &nbsp; <a href="#" data-target=".approval-modal" data-toggle="modal"><i class="fa fa-check"></i></a>','UserID')
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
        echo 'OK::';
    }
        public function details($userID){
//            $userID = $this->input->post('id');
            $status = $this->input->post('value');
            $selectData = array('
                    CONCAT(`firstName`," ",`lastName`) AS FullName,
                    email as Email,
                    company as Company,
                    business as Business,
                    businessShortDescription as BusinessShortDesc,
                    score as Score,
                    logo as Logo,
                    website as Web,
                    expiry_date as expiry_date,
                    corporate_date as corporate_date,
                    added_date as added_date,
                    EQA.Solution as solution,
                    EQ.Question as Question,
                    CASE WHEN user.status = 1 THEN CONCAT("<span class=\'label label-danger\'> ", ES.status," </span>") WHEN user.status = 2 THEN CONCAT ("<span class=\'label label-warning\'> ", ES.status, " </span>") WHEN user.status = 3 THEN CONCAT ("<span class=\'label label-success\'> ", ES.status, " </span>") ELSE "" END as Status
            ',false);
            $where = "user.id =".$userID;
            $joins = array(
                array(
                    'table' => 'esic_status ES',
                    'condition' => 'ES.id = user.status',
                    'type' => 'LEFT'
                ),
                array(
                    'table' => 'esic_questions_answers EQA',
                    'condition' => 'EQA.userID = user.id',
                    'type' => 'LEFT'
                ),
                array(
                    'table' => 'esic_questions EQ',
                    'condition' => 'EQ.id = EQA.questionID',
                    'type' => 'LEFT'
                )
            );
            $data = array();
            $returnedData = $this->Common_model->select_fields_where_like_join('user',$selectData,$joins,$where,FALSE,'','');

            if(!empty($returnedData) and is_array($returnedData)){
                $data['userProfile'] = array(
                    'FullName' => $returnedData[0]->FullName,
                    'Email' => $returnedData[0]->Email,
                    'Company' => $returnedData[0]->Company,
                    'BusinessShortDesc' => $returnedData[0]->BusinessShortDesc,
                    'Score' => $returnedData[0]->Score,
                    'Logo' => $returnedData[0]->Logo,
                    'Web' => $returnedData[0]->Web,
                    'expiry_date' => $returnedData[0]->expiry_date,
                    'corporate_date' => $returnedData[0]->corporate_date,
                    'added_date' => $returnedData[0]->added_date,
                    'Status' => $returnedData[0]->Status
                );

                $data['usersQuestionsAnswers'] = array();
                foreach($returnedData as $key=>$obj){
                    $arrayToInsert = array(
                        'Question' => $obj->Question,
                        'solution' => $obj->solution
                    );
                    array_push($data['usersQuestionsAnswers'],$arrayToInsert);
                }
            }
            //echo $this->db->last_query();
/*            echo $this->db->last_query();
            print_r($data['returnedData']);
            exit;*/
        $this->show_admin("admin/reg_details",$data);
    }

    public function manage_universities(){
        $this->show_admin('admin/configuration/universities');
    }
    public function manage_sectors(){
        $this->show_admin('admin/configuration/sectors');
    }
    //R&D
    public function manage_rd(){
        $this->show_admin('admin/configuration/rd');
    }
    public function manage_accelerators(){
        $this->show_admin('admin/configuration/accelerators');
    }
    public function manage_acc_commercials(){
        $this->show_admin('admin/configuration/acc_commercials');
    }

}