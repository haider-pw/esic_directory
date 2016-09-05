<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property Common_model $Common_model It resides all the methods which can be used in most of the controllers.
 * @property CI_Input $input It resides all the methods which can be used in most of the controllers.
 */
class Reg extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     *
     */


    function __construct()
    {
        parent::__construct();
        $this->load->model('Common_model');
        $this->load->helper('my_site_helper');

        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: PUT, GET, POST");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    }
    public function index()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: PUT, GET, POST");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

        //Need to Get Data for Selectors
        //University
        $data['institutions'] = $this->Common_model->select('esic_institution');
        $data['accelerationCommercials'] = $this->Common_model->select('esic_acceleration');
        $data['acceleratorProgramme'] = $this->Common_model->select('esic_acceleration_logo');
        $data['userID'] = $this->input->get('id');
        $data['sectors'] = $this->Common_model->select('esic_sectors');



        $this->load->view('regForm/reg_form_bootstrap',$data);
    }

    public function submit(){
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: PUT, GET, POST");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        //Getting all the posted Values.
        $firstName = $this->input->post('firstName');
        $lastName = $this->input->post('lastName');
        $email = $this->input->post('email');
        $company = $this->input->post('company');
        $business = $this->input->post('business');
        $date_pickter_format = $this->input->post('cop_date');
        $cop_date = date("Y-m-d",strtotime($date_pickter_format));
        $acn = $this->input->post('acn');
        $added_date =  date('Y-m-d');
        
        $expiry_date =  getExpiryDate($cop_date);

        $mExpense = $this->input->post('1mExpense');
        $assessableIncomeYear = $this->input->post('assessableIncomeYear');
        $listedInSExchange = $this->input->post('listedInSExchange');
        $incorporatedAus = $this->input->post('incorporatedAus');
        $ownedSubsidiaries = $this->input->post('ownedSubsidiaries');
        $improvedInnovation = $this->input->post('improvedInnovation');
        $companyScalable = $this->input->post('companyScalable');
        $globalMarket = $this->input->post('globalMarket');
        $competitiveAdvantage = $this->input->post('competitiveAdvantage');
        $rdExpenses = $this->input->post('rdExpenses');
        $EntrepreneurProgramme = $this->input->post('EntrepreneurProgramme');
        $cohortOfEntrepreneurs = $this->input->post('cohortOfEntrepreneurs');
        $taxIncentives = $this->input->post('taxIncentives');
        $standardPatent = $this->input->post('standardPatent');
        $previous2Categories = $this->input->post('previous2Categories');
        $researchOrganization = $this->input->post('researchOrganization');

        if(empty($firstName) || empty($lastName)){
            echo "FAIL::Please Enter Complete Name";
            exit;
        }

        if(filter_var($email,FILTER_VALIDATE_EMAIL) === false){
            echo "FAIL::Please Enter a valid Email Address";
            exit;
        }

        $userInsertArray = array(
            'firstName'         => $firstName,
            'lastName'          => $lastName,
            'email'             => $email,
            'company'           => $company,
            'business'          => $business,
            'acn_number'        => $acn,
            'added_date'        => $added_date,
            'expiry_date'       => $expiry_date,
            'corporate_date'    => $cop_date,
            'score'             => 0
        );

        $this->db->trans_begin();

        $insertID = $this->Common_model->insert_record('user',$userInsertArray);
        if(empty($insertID) || !is_numeric($insertID)){
            echo $this->db->last_query();
            $this->db->trans_rollback();
            die("FAIL::Something Went wrong, Could Not Insert");
        }

        //Now Need to Work On Questions.
        //Getting All the Question IDs
        $questions = $this->Common_model->select('esic_questions');

        if(empty($questions) || !is_array($questions)){
            echo $this->db->last_query();
            $this->db->trans_rollback();
            die("FAIL::Something Went wrong, Questions Not Found");
        }

        foreach($questions as $key=>$obj){
            $obj->solutionValue = $this->input->post($obj->QuestionPostedName);
        }

        //Now just insert the questions Solutions
        foreach($questions as $question){
            if(!empty($question->solutionValue)){
                $dataArrayToInsert = array(
                    'questionID' => $question->id,
                    'userID' => $insertID,
                    'Solution' => $question->solutionValue,
                    'type' => ''
                );
                $solutionInsertID = $this->Common_model->insert_record('esic_questions_answers',$dataArrayToInsert);
            }
        }

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            echo 'FAIL::Something Went Wrong';
        }
        else
        {
            $this->db->trans_commit();
            echo 'OK::Thank you. Your information has been submitted.::'.$insertID;
        }
}

    public function step2(){
        //step2
            $userID = $this->input->post('userID');
            $sector = $this->input->post('sector');
            $allowedExt = array('jpeg','jpg','png','gif');

            $uploadPath = './uploads/users/'.$userID.'/';
            $uploadDirectory = './uploads/users/'.$userID;
            $uploadDBPath = 'uploads/users/'.$userID.'/';

            $insertDataArray = array(
                'sectorID' => $sector
            );

            //For Logo Upload
            if(isset($_FILES['logo']['name']))
            {
                $FileName = $_FILES['logo']['name'];
                $explodedFileName = explode('.',$FileName);
                $ext = end($explodedFileName);
                if(!in_array(strtolower($ext),$allowedExt))
                {
                    echo "FAIL:: Only Image JPEG, PNG and GIF Images Allowed, No Other Extensions Are Allowed::error";
                    return;
                }else
                {

                    $FileName = "Logo_".$userID."_".time().".".$ext;
                    if(!is_dir($uploadDirectory)){
                        mkdir($uploadDirectory, 0755, true);
                    }

                    move_uploaded_file($_FILES['logo']['tmp_name'],$uploadPath.$FileName);
                    $insertDataArray['logo'] = $uploadDBPath.$FileName;
                }
            }else{
                echo "FAIL::Logo Image Is Required";
                return;
            }
            //For Banner Upload
            if(isset($_FILES['banner']['name']))
            {
                $FileName = $_FILES['banner']['name'];
                $explodedFileName = explode('.',$FileName);
                $ext = end($explodedFileName);
                if(!in_array(strtolower($ext),$allowedExt))
                {
                    echo "FAIL:: Only Image JPEG, PNG and GIF Images Allowed, No Other Extensions Are Allowed::error";
                    return;
                }else
                {
                    $FileName = "Banner_".$userID."_".time().".".$ext;
                    if(!is_dir($uploadDirectory)){
                        mkdir($uploadDirectory, 0755, true);
                    }

                    move_uploaded_file($_FILES['banner']['tmp_name'],$uploadPath.$FileName);
                    $insertDataArray['bannerImage'] = $uploadDBPath.$FileName;
                }
            }
            //For product service Image Upload
            if(isset($_FILES['product']['name']))
            {
                $FileName = $_FILES['product']['name'];
                $explodedFileName = explode('.',$FileName);
                $ext = end($explodedFileName);
                if(!in_array(strtolower($ext),$allowedExt))
                {
                    echo "FAIL:: Only Image JPEG, PNG and GIF Images Allowed, No Other Extensions Are Allowed::error";
                    return;
                }else
                {
                    $FileName = "Product_".$userID."_".time().".".$ext;
                    if(!is_dir($uploadDirectory)){
                        mkdir($uploadDirectory, 0755, true);
                    }

                    move_uploaded_file($_FILES['product']['tmp_name'],$uploadPath.$FileName);
                    $insertDataArray['productImage'] = $uploadDBPath.$FileName;
                }
            }

            if(empty($userID)){
                echo "FAIL::Something went wrong with the Post, Please Contact System Administrator For Further Assistance.";
                exit;
            }

            $whereUpdate = array(
                'id' => $userID
            );
            $resultUpdate = $this->Common_model->update('user',$whereUpdate,$insertDataArray);
            if($resultUpdate === true){
                echo "OK::Record Updated Successfully";
            }else{
                echo "FAIL::Something went wrong during Update, Please Contact System Administrator";
            }
    }
    public function addInstitution(){
        $institution = $this->input->post("institution");
        if(empty($institution) or !is_string($institution)){
            echo "FAIL::Please Add Institution, Field Can Not be Blank During Submission.";
            return;
        }

        $institutionCheckQuery = $this->db->get_where('esic_institution',array('institution'=>$institution));

        if($institutionCheckQuery->num_rows() > 0){
      
            echo "Existed::".$institution;

        }else{
           
            $insertData = array(
                'institution' => $institution
            );

            $insertResult = $this->Common_model->insert_record('esic_institution',$insertData);

            if($insertResult > 0){
                echo "OK::".$insertResult."::".$institution;
            }
       }

    }
    public function addIndustryClassification(){
      //  echo 'OK';

    
        $Industry = $this->input->post("Industry");
        if(empty($Industry) or !is_string($Industry)){
            echo "FAIL::Please Add Institution, Field Can Not be Blank During Submission.";
            return;
        }

        $institutionCheckQuery = $this->db->get_where('esic_sectors',array('sector'=>$Industry));

        if($institutionCheckQuery->num_rows() > 0){
            //print_r($institutionCheckQuery);
            echo "Existed::".$Industry;

        }else{
           
            $insertData = array(
                'sector' => $Industry
            );

            $insertResult = $this->Common_model->insert_record('esic_sectors',$insertData);

            if($insertResult > 0){
                echo "OK::".$insertResult."::".$Industry;
            }
        }

    }

     public function addEntrepreneurProgramme(){
        $Member             = $this->input->post("Member");
        $Market             = $this->input->post("Market");
        $Technology         = $this->input->post("Technology");
        $Web_Address        = $this->input->post("Web_Address");
        $Project_Title      = $this->input->post("Project_Title");
        $State_Territory    = $this->input->post("State_Territory");
        $Project_Summary    = $this->input->post("Project_Summary");
        $Project_Location   = $this->input->post("Project_Location");
        if(empty($Member) or !is_string($Member)){
            echo "FAIL::Please Fill All Required Fields, Those Can Not be Blank During Submission.";
            return;
        }

        $iMemberCheckQuery = $this->db->get_where('esic_acceleration',array('Member'=>$Member));

        if($iMemberCheckQuery->num_rows() > 0){
            //print_r($iMemberCheckQuery);
            echo "Already Exist!";
        }else{
           
            $insertData = array(
                'Member'            => $Member,
                'Market'            => $Market,
                'Technology'        => $Technology,
                'Web_Address'       => $Web_Address,
                'Project_Title'     => $Project_Title,
                'State_Territory'   => $State_Territory,
                'Project_Summary'   => $Project_Summary,
                'Project_Location'  => $Project_Location
            );

            $insertResult = $this->Common_model->insert_record('esic_acceleration',$insertData);

            if($insertResult > 0){
                echo "OK::".$insertResult."::".$Member;
            }
        }

    }

     public function addAcceleratorProgramme(){
        $name                         = $this->input->post("AcceleratorProgrammeName");
        $Programme_Web_Address        = $this->input->post("Programme_Web_Address");
       

        if(empty($name) or !is_string($name)){
            echo "FAIL::Please Fill All Required Fields, Those Can Not be Blank During Submission.";
            return;
        }

        $nameCheckQuery = $this->db->get_where('esic_acceleration_logo',array('name'=>$name));

        if($nameCheckQuery->num_rows() > 0){
            //print_r($nameCheckQuery);
            echo "Already Exist!";
        }else{
           
            $insertData = array(
                'name'    => $name,
                'website'  => $Programme_Web_Address
            );

            $insertResult = $this->Common_model->insert_record('esic_acceleration_logo',$insertData);

            if($insertResult > 0){
                echo "OK::".$insertResult."::".$name;

                    $allowedExt = array('jpeg','jpg','png','gif');
                    $uploadPath = './uploads/logos/'.$insertResult.'/';
                    $uploadDirectory = './uploads/logos/'.$insertResult;
                    $uploadDBPath = 'uploads/logos/'.$insertResult.'/';
                    $insertDataArray = array();
                 //For Logo Upload
                if(isset($_FILES['ProgrammeLogoImage']['name'])){
                        $FileName = $_FILES['ProgrammeLogoImage']['name'];
                        $explodedFileName = explode('.',$FileName);
                        $ext = end($explodedFileName);
                        if(!in_array(strtolower($ext),$allowedExt))
                        {
                            echo "FAIL:: Only Image JPEG, PNG and GIF Images Allowed, No Other Extensions Are Allowed::error";
                            return;
                        }else
                        {

                            $FileName = "ProgrammeLogoImage".$insertResult."_".time().".".$ext;
                            if(!is_dir($uploadDirectory)){
                                mkdir($uploadDirectory, 0755, true);
                            }

                            move_uploaded_file($_FILES['ProgrammeLogoImage']['tmp_name'],$uploadPath.$FileName);
                            $insertDataArray['logo'] = $uploadDBPath.$FileName;
                        }
                }
                    

                $whereUpdate = array(
                        'id' => $insertResult
                );
                $resultUpdate = $this->Common_model->update('esic_acceleration_logo',$whereUpdate,$insertDataArray);
                    if($resultUpdate === true){
                        echo "OK::Record Updated Successfully";
                    }else{
                        echo "FAIL::Something went wrong during Update, Please Contact System Administrator";
                    }
                }
        }

    }
}