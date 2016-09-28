<?php
/**
 * Created by PhpStorm.
 * User: HI
 * Date: 8/24/2016
 * Time: 10:15 AM
 *
 * @property CI_DB_driver $db It resides all the methods which can be used in most of the controllers.
 */

class Esic_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('Datatables');
    }

    public function record_count(){
        return $this->db->count_all("user");
    }
    public function getlist($page){
        $offset = 9*$page;
        $pagelimit = 9;
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: PUT, GET, POST");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        
        $total_results = $this->db->count_all("user");
        if($offset < $total_results){
	        $limit = array();
	         array_push($limit, $pagelimit);
	                array_push($limit,$offset);
	       
	        //Lets make a simple query for Listing.
	        $selectData = array(
	            '
	                user.id as userID,
	                concat(firstName, " ", lastName) as FullName,
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
	                 CASE WHEN user.status = 1 THEN CONCAT("<span class=\"featured-red\">",ES.status,"</span>") WHEN user.status = 2 THEN CONCAT("<span class=\"featured-yellow\">",ES.status,"</span>") WHEN user.status = 3 THEN CONCAT("<span class=\"featured-green\">",ES.status,"</span>") ELSE "" END as Status
	            ',
	            false
	        );
			$orderBy = array('user.id','DESC');
	        $joins = array(
	            array(
	                'table' => 'esic_status ES',
	                'condition' => 'ES.id = user.status',
	                'type' => 'LEFT'
	            )
	        );
	        $usersResult = $this->Common_model->select_fields_where_like_join('user',$selectData,$joins,'',FALSE,'','','',$orderBy,$limit,true);
	     return $usersResult;
		}else{
			 return "NORESULT";
		}
		return "NORESULT";

    }
    public function getfilterlist($page,$search,$secSelect,$comSelect,$OrderSelect,$OrderSelectValue){
        $offset = 9*$page;
        $pagelimit = 9;
        
        $total_results = $this->db->count_all("user");
        if($offset < $total_results){
	        $limit = array();
	         array_push($limit, $pagelimit);
	                array_push($limit,$offset);
	       
	        //Lets make a simple query for Listing.
	        $selectData = array(
	            '
	                user.id as userID,
	                concat(firstName, " ", lastName) as FullName,
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
	                CASE WHEN user.status = 1 THEN CONCAT("<span class=\"featured-red\">",ES.status,"</span>") WHEN user.status = 2 THEN CONCAT("<span class=\"featured-yellow\">",ES.status,"</span>") WHEN user.status = 3 THEN CONCAT("<span class=\"featured-green\">",ES.status,"</span>") ELSE "" END as Status
	                ',
	            false
	        );

            $where = '';
            if(!empty($secSelect)){
                $where .= "user.sectorID =".$secSelect;
            }
            if(!empty($comSelect)){
                if(!empty($where)){
                    $where .=" AND ";
                }
                $where .= "user.company =".$comSelect;
            }
            if(!empty($search)){
				if(!empty($where)){
			        $where .=" AND ";
			     }
			     $where .= "user.firstname LIKE '%".$search."%'
				        OR user.lastname LIKE '%".$search."%'
				        OR user.email LIKE '%".$search."%'
				        OR user.company LIKE '%".$search."%'
				        OR user.business LIKE '%".$search."%'
				        OR user.businessShortDescription LIKE '%".$search."%'
				        OR user.website LIKE '%".$search."%'";
			}
			
			$orderBy='';
			if(!empty($OrderSelect)){
				$orderBy = array(
		             $OrderSelect,$OrderSelectValue
		        );
			}
	        $joins = array(
	            array(
	                'table' => 'esic_status ES',
	                'condition' => 'ES.id = user.status',
	                'type' => 'LEFT'
	            )
	        );
	        $usersResult = $this->Common_model->select_fields_where_like_join('user',$selectData,$joins,$where,FALSE,'','','',$orderBy,$limit,true);
	        return $usersResult;
		}else{
			 return "NORESULT";
		}
		return "NORESULT";
    }
    public function getdetails($id){
  
 
            $selectData = array(
                '
                    user.id as userID,
                    concat(firstName, " ", lastName) as FullName,
                    user.email as Email,
                    user.company as Company,
                    user.address as address,
                    user.state as state,
                    user.town as town,
                    user.business as Business,
                    user.businessShortDescription as BusinessShortDesc,
                    user.score as Score,
                    user.logo as Logo,
                    user.corporate_date as corporate_date,
                    user.added_date as added_date,
                    user.expiry_date as expiry_date,
                    user.acn_number as acn_number,                    
                    user.bannerImage as bannerImage,
                    user.productImage as productImage,
                    user.website as Web,
                    ERnD.rndname as rndname,
                    ERnD.IDNumber as IDNumber,
                    ERnD.AddressContact as AddressContact,
                    ERnD.ANZSRC as ANZSRC,
                    ERnD.rndLogo as rndLogo,
                    ERnD.AppStatus as RndAppStatus,
                    EAccCo.Member as Member,
                    EAccCo.AppStatus as EAccCoAppStatus,
                    EAccCo.AccLogo as AccCoLogo,
                    EAcc.name as Accname,
                    EAcc.logo as AccLogo,
                    EAcc.website as AccWeb,
                    EAcc.AppStatus as EAccAppStatus,
                    EIn.institution as institution,
                    EIn.institutionLogo as institutionLogo,
                    EIn.AppStatus as EInAppStatus,
                    ESec.sector as sectorName,
                    ESec.secLogo as secLogo,
                    ESec.AppStatus as ESecAppStatus,
                    CASE WHEN user.status = 1 THEN CONCAT("<span class=\"featured-red\">",ES.status,"</span>") WHEN user.status = 2 THEN CONCAT("<span class=\"featured-yellow\">",ES.status,"</span>") WHEN user.status = 3 THEN CONCAT("<span class=\"featured-green\">",ES.status,"</span>") ELSE "" END as Status
                    ',
                false
            );


            $where = "user.id =".$id;
            $joins = array(
                array(
                    'table' => 'esic_status ES',
                    'condition' => 'ES.id = user.status',
                    'type' => 'LEFT'
                ),
                array(
                    'table' => ' esic_RnD ERnD',
                    'condition' => 'ERnD.id = user.RnDID',
                    'type' => 'LEFT'
                ),
                array(
                    'table' => 'esic_acceleration EAccCo',
                    'condition' => 'EAccCo.id = user.AccID',
                    'type' => 'LEFT'
                ),
                array(
                    'table' => 'esic_acceleration_logo EAcc',
                    'condition' => 'EAcc.id = user.AccID',
                    'type' => 'LEFT'
                ),
                array(
                    'table' => 'esic_institution EIn',
                    'condition' => 'EIn.id = user.inID',
                    'type' => 'LEFT'
                ),
                array(
                    'table' => ' esic_sectors ESec',
                    'condition' => 'ESec.id = user.sectorID',
                    'type' => 'LEFT'
                )
            );
            $usersResult = $this->Common_model->select_fields_where_like_join('user',$selectData,$joins,$where,false,'','','','','',true);
			return $usersResult;
    }
}