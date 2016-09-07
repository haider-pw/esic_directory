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
                    business as business,
                    expiry_date as expiry_date,
                    corporate_date as corporate_date,
                    added_date as added_date,
                    ESEC.sector as sector,
                    EQA.id as EQAID,
                    EQA.questionID as questionID,
                    EQA.Solution as solution,
                    EQ.Question as Question,
                    EQS.SolVal as solval,
                    EQS.Points as points,
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
                    'table' => 'esic_sectors ESEC',
                    'condition' => 'ESEC.id = user.sectorID',
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
                ),
                array(
                    'table' => 'esic_questions_score EQS',
                    'condition' => 'EQA.questionID = EQS.questionID',
                    'type' => 'LEFT'
                )
            );
            $data = array();
            $returnedData = $this->Common_model->select_fields_where_like_join('user',$selectData,$joins,$where,FALSE,'','');


            if(!empty($returnedData) and is_array($returnedData)){

                $TotalPoints = $this->db->query('SELECT SUM(MaxPoints) AS TotalPoints FROM (SELECT id, questionID, MAX(Points) AS MaxPoints FROM esic_questions_score GROUP BY questionID) Points')->row()->TotalPoints;
                $ScorePercentage = $returnedData[0]->Score/$TotalPoints*100;


                $data['userProfile'] = array(
                    'FullName' => $returnedData[0]->FullName,
                    'Email' => $returnedData[0]->Email,
                    'Company' => $returnedData[0]->Company,
                    'business' => $returnedData[0]->business,
                    'BusinessShortDesc' => $returnedData[0]->BusinessShortDesc,
                    'Score' => $returnedData[0]->Score,
                    'Logo' => $returnedData[0]->Logo,
                    'Web' => $returnedData[0]->Web,
                    'expiry_date' => $returnedData[0]->expiry_date,
                    'corporate_date' => $returnedData[0]->corporate_date,
                    'added_date' => $returnedData[0]->added_date,
                    'Status' => $returnedData[0]->Status,
                    'Score' => $returnedData[0]->Score,
                    'ScorePercentage' => $ScorePercentage,
                    'sector' => $returnedData[0]->sector
                );

                $data['usersQuestionsAnswers'] = array();
                foreach($returnedData as $key=>$obj){
                    $arrayToInsert = array(
                        'Question' => $obj->Question,
                        'solution' => $obj->solution,
                        'points' => $obj->points,
                        'questionID' => $obj->questionID,
                        'EQAID' => $obj->EQAID
                    );
                    array_push($data['usersQuestionsAnswers'],$arrayToInsert);
                }
            }
            //echo $this->db->last_query();
            //print_r($data);
           // exit;
        $this->show_admin("admin/reg_details",$data);
    }

    public function manage_universities($param = NULL){
        if($param === 'listing'){
            $selectData = array('
            id AS ID,
            sector AS Sector
            ',false);

            $addColumns = array(
                'ViewEditActionButtons' => array('<a href="'.base_url("Admin/details/$1").'"><span aria-hidden="true" class="glyphicon glyphicon-play text-green"></span></a> &nbsp; <a href="#" data-target=".approval-modal" data-toggle="modal"><i class="fa fa-check"></i></a>','UserID')
            );
            $returnedData = $this->Common_model->select_fields_joined_DT($selectData,'esic_sectors','','','','','',$addColumns);
            print_r($returnedData);
            return NULL;
        }
        if($param === 'delete'){
            if(!$this->input->post()){
                echo "FAIL::No Value Posted";
                return false;
            }

            $id = $this->input->post('id');
            $value = $this->input->post('value');
            return NULL;
        }
        $this->show_admin('admin/configuration/universities');
    }
    public function manage_sectors($param = NULL){
        if($param === 'listing'){
            $selectData = array('
            id AS ID,
            sector AS Sector,
            CASE WHEN trashed = 1 THEN CONCAT(\'<span class="label label-danger">YES</span>\') WHEN trashed = 0 THEN CONCAT(\'<span class="label label-success">NO</span>\') ELSE "" END AS Trashed
            ',false);

            $addColumns = array(
                'ViewEditActionButtons' => array('<a href="#" data-target="#editSectorModal" data-toggle="modal"><span data-toggle="tooltip" title="Edit" data-placement="left" aria-hidden="true" class="fa fa-pencil text-blue"></span></a> &nbsp; <a href="#" data-target=".approval-modal" data-toggle="modal"><i data-toggle="tooltip" title="Trash" data-placement="right"  class="fa fa-trash-o text-red"></i></a>','UserID')
            );
            $returnedData = $this->Common_model->select_fields_joined_DT($selectData,'esic_sectors','','','','','',$addColumns);
            print_r($returnedData);
            return NULL;
        }
        if($param === 'delete'){
            if(!$this->input->post()){
                echo "FAIL::No Value Posted";
                return false;
            }

            $id = $this->input->post('id');
            $value = $this->input->post('value');

            if(empty($id) or !is_numeric($id)){
                echo "FAIL::Posted values are not VALID";
                return NULL;
            }

            if(empty($value) or $value !== 'approve'){
                echo "FAIL::Posted values are not VALID";
                return NULL;
            }

            $updateData = array(
                'trashed' => 1
            );

            $whereUpdate = array(
                'id' => $id
            );

            $returnedData = $this->Common_model->update('esic_sectors',$whereUpdate,$updateData);
            if($returnedData === true){
                echo "OK::Record Successfully Trashed";
            }else{
                echo "FAIL::".$returnedData['message'];
            }
            return NULL;
        }
        if($param === 'update'){
            if(!$this->input->post()){
                echo "FAIL::No Value Posted";
                return false;
            }

            $id = $this->input->post('id');
            $value = $this->input->post('sector');

            if(empty($id) or !is_numeric($id)){
                echo "FAIL::Posted values are not VALID";
                return NULL;
            }

            if(empty($value)){
                echo "FAIL::Value Must Be Entered";
                return NULL;
            }

            $updateData = array(
                'sector' => $value
            );

            $whereUpdate = array(
                'id' => $id
            );

            $updateResult = $this->Common_model->update('esic_sectors',$whereUpdate,$updateData);
            if($updateResult === true){
                echo "OK::Record Successfully Updated";
            }else{
                if($updateResult['code'] == 0){
                    echo "OK::Record Already Exist";
                }else{
                    echo $updateResult['message'];
                }
            }
            return NULL;
        }
        $this->show_admin('admin/configuration/sectors');
        return NULL;
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