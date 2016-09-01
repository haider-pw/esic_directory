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
        $offset = 3*$page;
        $pagelimit = 3;
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
	                CASE WHEN user.status = 1 THEN CONCAT("<span class=\"featured-red\">",ES.status,"</span>") WHEN user.status = 2 THEN CONCAT("<span class=\"featured-yellow\">",ES.status,"</span>") WHEN user.status = 3 THEN CONCAT("<span class=\"featured-green\">",ES.status,"</span>") ELSE "" END as Status
	            ',
	            false
	        );
	        $joins = array(
	            array(
	                'table' => 'esic_status ES',
	                'condition' => 'ES.id = user.status',
	                'type' => 'LEFT'
	            )
	        );
	        $usersResult = $this->Common_model->select_fields_where_like_join('user',$selectData,$joins,'',FALSE,'','','','',$limit,true);
	        $result="";
	        
	       if(!empty($usersResult) && is_array($usersResult)){
			    foreach($usersResult as $key=>$user){
			    	$status='';
			    	$web='';
			    	$desc='';
			    	$img ='';
			    	if(!empty($user['Status'])){
			    		$status = $user['Status'];
			    	}
			    	if(!empty($user['Web'])){
			    		$web = '<a target="_blank" href="http://'.$user['Web'].'" class="website">'.$user['Web'].'</a>';
			    	}
			    	if(!empty($user['BusinessShortDesc'])){
			    		if(strlen($user['BusinessShortDesc']) > 200){
			    			$desc =  substr($user['BusinessShortDesc'],0,200).'...';
			    		}else{
			    			$desc =   $user['BusinessShortDesc'];
			    		}
			    	}
			    	if(isset($user['Logo']) and !empty($user['Logo']) and is_file(FCPATH.'/'.$user['Logo'])){
			    		$img = base_url($user['Logo']);
			    	}else{
			    		$img = base_url('pictures/defaultLogo.png');
			    	}
			       
			    $result .= '<li class="hcard-search member_level_5" '.$page.'>';
			     $result .= '<div class="img-container">';
			       $result .= '<a href="/england/newcastle-upon-tyne/e-commerce-markets/janet-stansfield" title="Janet Stansfield SEIS Companies" rel="nofollow">';
			         $result .= '<img src="'.$img.'" alt="" class="left">';
			       $result .= '</a>';
			     $result .= '</div>';
			     $result .= '<div class="status-container">'.$status.'</div>';
			     $result .= '<div class="name-container">';
			        $result .= '<a href="/england/newcastle-upon-tyne/e-commerce-markets/janet-stansfield">';
			         $result .= '<h3>'.$user['FullName'].'</h3>';
			        $result .= '</a>';
			     $result .= '</div><div class="clear"></div>';
			      $result .= '<div class="product-details">';
			      	$result .= '<p class="info-type">'.$user['Company'].'</p>';
			      $result .= '</div>';
			      $result .= '<div class="product-details">';
			        $result .= '<span class="price-funded"></span>';
			        $result .= '<span class="price-assuarance">';
			        $result .= $web;
			        $result .= '</span>';
			         $result .= '<p>';
			         $result .= $desc ;
			         $result .= '</p>';
			         $result .= "<br />";
			         $result .= '</div></li>';
			       
			    }
			}
		}else{
			$result="NORESULT";
		}
		return $result;

    }
    public function getfilterlist($page,$secSelect,$comSelect){
        $offset = 3*$page;
        $pagelimit = 3;
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
	                CASE WHEN user.status = 1 THEN CONCAT("<span class=\"featured-red\">",ES.status,"</span>") WHEN user.status = 2 THEN CONCAT("<span class=\"featured-yellow\">",ES.status,"</span>") WHEN user.status = 3 THEN CONCAT("<span class=\"featured-green\">",ES.status,"</span>") ELSE "" END as Status
	                ',
	            false
	        );
	        //$where = 'user.company = "'.$comSelect.'" AND user.company = "'.$comSelect.'';
	        $where=array();
	        if($comSelect!=''){
	        	$condition = array('user.company' => $comSelect);
	        	array_push($where, $condition);
		         
		    }
		    if($secSelect!=''){
		        $condition = array('user.sectorID' => $secSelect);
	        	array_push($where, $condition);
		    }

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
	        $joins = array(
	            array(
	                'table' => 'esic_status ES',
	                'condition' => 'ES.id = user.status',
	                'type' => 'LEFT'
	            )
	        );
	        $usersResult = $this->Common_model->select_fields_where_like_join('user',$selectData,$joins,$where,FALSE,'','','','',$limit,true);
	        $result="";
	        
	       if(!empty($usersResult) && is_array($usersResult)){
			    foreach($usersResult as $key=>$user){
			    	$status='';
			    	$web='';
			    	$desc='';
			    	$img ='';
			    	if(!empty($user['Status'])){
			    		$status = $user['Status'];
			    	}
			    	if(!empty($user['Web'])){
			    		$web = '<a target="_blank" href="http://'.$user['Web'].'" class="website">'.$user['Web'].'</a>';
			    	}
			    	if(!empty($user['BusinessShortDesc'])){
			    		if(strlen($user['BusinessShortDesc']) > 200){
			    			$desc =  substr($user['BusinessShortDesc'],0,200).'...';
			    		}else{
			    			$desc =   $user['BusinessShortDesc'];
			    		}
			    	}
			    	if(isset($user['Logo']) and !empty($user['Logo']) and is_file(FCPATH.'/'.$user['Logo'])){
			    		$img = base_url($user['Logo']);
			    	}else{
			    		$img = base_url('pictures/defaultLogo.png');
			    	}
			       
			    $result .= '<li class="hcard-search member_level_5" '.$page.'>';
			     $result .= '<div class="img-container">';
			       $result .= '<a href="/england/newcastle-upon-tyne/e-commerce-markets/janet-stansfield" title="Janet Stansfield SEIS Companies" rel="nofollow">';
			         $result .= '<img src="'.$img.'" alt="" class="left">';
			       $result .= '</a>';
			     $result .= '</div>';
			     $result .= '<div class="status-container">'.$status.'</div>';
			     $result .= '<div class="name-container">';
			        $result .= '<a href="/england/newcastle-upon-tyne/e-commerce-markets/janet-stansfield">';
			         $result .= '<h3>'.$user['FullName'].'</h3>';
			        $result .= '</a>';
			     $result .= '</div><div class="clear"></div>';
			      $result .= '<div class="product-details">';
			      	$result .= '<p class="info-type">'.$user['Company'].'</p>';
			      $result .= '</div>';
			      $result .= '<div class="product-details">';
			        $result .= '<span class="price-funded"></span>';
			        $result .= '<span class="price-assuarance">';
			        $result .= $web;
			        $result .= '</span>';
			         $result .= '<p>';
			         $result .= $desc ;
			         $result .= '</p>';
			         $result .= "<br />";
			         $result .= '</div></li>';
			       
			    }
			}
		}else{
			$result="NORESULT";
		}
		return $result.$this->db->last_query();

    }
}