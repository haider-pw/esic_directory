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
			    		if(strlen($user['BusinessShortDesc']) > 170){
			    			$desc =  substr($user['BusinessShortDesc'],0,160).'...';
			    		}else{
			    			$desc =   $user['BusinessShortDesc'];
			    		}
			    	}
			    	if(isset($user['Logo']) and !empty($user['Logo']) and is_file(FCPATH.'/'.$user['Logo'])){
			    		$img = base_url($user['Logo']);
			    	}else{
			    		$img = base_url('pictures/defaultLogo.png');
			    	}
			       
			    $result .= '<li class="list-item hcard-search member_level_5" '.$page.'>';
			     $result .= '<a href="#'.$user['userID'].'" class="permalink" data-link= "'.$user['userID'].'"">';
			     $result .= '<div class="img-container wraptocenter"><span>';
			         $result .= '<img src="'.$img.'" alt="" class="left">';
			       $result .= '</span>';
			     $result .= '</div><div class="product-container">';
			     $result .= '<div class="status-container">'.$status.'</div>';
			     $result .= '<div class="name-container">';
			         $result .= '<h3>'.$user['FullName'].'</h3>';
			     $result .= '</div><div class="clear"></div>';
			      $result .= '<div class="product-details">';
			      	$result .= '<p class="info-type">'.$user['Company'].'</p>';
			      $result .= '</div>';
			      $result .= '<div class="product-details">';
			        $result .= '<span class="price-funded"></span>';
			        $result .= '<span class="price-assuarance">';
			        $result .= $web;
			        $result .= '</span>';
			        $result .= '<div class="description">';
                    $result .= '<p>';
                    $result .= $desc;
                    $result .= '</p>';
                    $result .= '</div>';
			        $result .= '<div class="product-details date-container add"><label>Added Date:</label>';
                    $result .= '<p class="info-type">'.$user['added_date'].'</p>';
                    $result .= '</div>';
                    $result .= '<div class="product-details date-container cop"><label>Incoporate Date:</label>';
                    $result .= '<p class="info-type">'.$user['corporate_date'].'</p>';
                    $result .= '</div>';
                    $result .= '<div class="product-details date-container exp"><label>Expiry Date:</label>';
                    $result .= '<p class="info-type">'.$user['expiry_date'].'</p>';
                    $result .= '</div>';
			        $result .= '</div></div></a></li>';
			       
			    }
			}
		}else{
			$result="NORESULT";
		}
		return $result;

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
	        $result="";
	        
	       if(!empty($usersResult) && is_array($usersResult)){
	       		$count=0;
			    foreach($usersResult as $key=>$user){
			    	$count++;
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
			    		if(strlen($user['BusinessShortDesc']) > 170){
			    			$desc =  substr($user['BusinessShortDesc'],0,160).'...';
			    		}else{
			    			$desc =   $user['BusinessShortDesc'];
			    		}
			    	}
			    	if(isset($user['Logo']) and !empty($user['Logo']) and is_file(FCPATH.'/'.$user['Logo'])){
			    		$img = base_url($user['Logo']);
			    	}else{
			    		$img = base_url('pictures/defaultLogo.png');
			    	}
			       
			    $result .= '<li class="list-item hcard-search member_level_5">';
			    $result .= '<a href="#" class="permalink" data-link= "'.$user['userID'].'"">';
			     $result .= '<div class="img-container wraptocenter"><span>';
			         $result .= '<img src="'.$img.'" alt="" class="left">';
			       $result .= '</span>';
			     $result .= '</div><div class="product-container">';
			     $result .= '<div class="status-container">'.$status.'</div>';
			     $result .= '<div class="name-container">';
			         $result .= '<h3>'.$user['FullName'].'</h3>';
			     $result .= '</div><div class="clear"></div>';
			      $result .= '<div class="product-details">';
			      	$result .= '<p class="info-type">'.$user['Company'].'</p>';
			      $result .= '</div>';
			      $result .= '<div class="product-details">';
			        $result .= '<span class="price-funded"></span>';
			        $result .= '<span class="price-assuarance">';
			        $result .= $web;
			        $result .= '</span>';
                    $result .= '<div class="description">';
                    $result .= '<p>';
                    $result .= $desc;
                    $result .= '</p>';
                    $result .= '</div>';
			        $result .= '<div class="product-details date-container add"><label>Added Date:</label>';
                    $result .= '<p class="info-type">'.$user['added_date'].'</p>';
                    $result .= '</div>';
                    $result .= '<div class="product-details date-container cop"><label>Coporate Date:</label>';
                    $result .= '<p class="info-type">'.$user['corporate_date'].'</p>';
                    $result .= '</div>';
                    $result .= '<div class="product-details date-container exp"><label>Expiry Date:</label>';
                    $result .= '<p class="info-type">'.$user['expiry_date'].'</p>';
                    $result .= '</div>';
			        $result .= '</div></div></a></li>';
			       
			    }

			}else{
				$result="NORESULT";
			}
		}else{
			$result="NORESULT";
		}
		return $result;//.$this->db->last_query();
    }
    public function getdetails($id){
  
 
            $selectData = array(
                '
                    user.id as userID,
                    concat(firstName, " ", lastName) as FullName,
                    user.email as Email,
                    user.company as Company,
                    user.address as address,
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
            $result="";
           if(!empty($usersResult)){
                $count=0;
                foreach($usersResult as $key=>$user){
                    $count++;
                    $status='';
                    $web='';
                    $desc='';
                    $img ='';
                    $bgimg ='';
                    $productImg = '';
                    $AccImg = '';
                    $AccCoImg ='';
                    $rndLogo = '';
                    $institutionLogo ='';
                    $secLogo = '';
                    if(!empty($user['Status'])){
                        $status = $user['Status'];
                    }
                    if(!empty($user['Web'])){
                        $web = '<a target="_blank" href="http://'.$user['Web'].'" class="website">'.$user['Web'].'</a>';
                    }
                    
                    $desc =   $user['BusinessShortDesc'];

                    if(isset($user['Logo']) and !empty($user['Logo']) and is_file(FCPATH.'/'.$user['Logo'])){
                        $img = base_url($user['Logo']);
                    }else{
                        $img = base_url('pictures/defaultLogo.png');
                    }
                    if(isset($user['bannerImage']) and !empty($user['bannerImage']) and is_file(FCPATH.'/'.$user['bannerImage'])){
                        $bgimg = base_url($user['bannerImage']);
                    }else{
                        $bgimg = base_url('pictures/defaultBanner.jpg');
                    }
                    if(isset($user['productImage']) and !empty($user['productImage']) and is_file(FCPATH.'/'.$user['productImage'])){
                        $productImg = base_url($user['productImage']);
                    }else{
                        $productImg = base_url('pictures/defaultLogo.jpg');
                    }
                    if(isset($user['AccLogo']) and !empty($user['AccLogo']) and is_file(FCPATH.'/'.$user['AccLogo'])){
                        $AccImg = base_url($user['AccLogo']);
                    }else{
                        $AccImg = base_url('pictures/defaultLogo.jpg');
                    }
                    if(isset($user['AccCoLogo']) and !empty($user['AccCoLogo']) and is_file(FCPATH.'/'.$user['AccCoLogo'])){
                        $AccCoImg = base_url($user['AccCoLogo']);
                    }
                    if(isset($user['secLogo']) and !empty($user['secLogo']) and is_file(FCPATH.'/'.$user['secLogo'])){
                        $secLogo = base_url($user['secLogo']);
                    }
                    if(isset($user['institutionLogo']) and !empty($user['institutionLogo']) and is_file(FCPATH.'/'.$user['institutionLogo'])){
                        $institutionLogo = base_url($user['institutionLogo']);
                    }
                    if(isset($user['rndLogo']) and !empty($user['rndLogo']) and is_file(FCPATH.'/'.$user['rndLogo'])){
                        $rndLogo = base_url($user['rndLogo']);
                    }

                   
                    $result .= '<div id="single-container" class="single-item list-item hcard-search member_level_5">';
                    $result .= '<div class="container">';
                    $result .= '<div class="background-img-container"><img src="'.$bgimg.'" alt="" class="left"></div>';
                    $result .= '<div class="container-box">';
                    $result .= '<div class="img-container logo-container">';
                    $result .= '<a href="#" class="permalink">';
                    $result .= '<img src="'.$img.'" alt="" class="left">';
                    $result .= '</a>';
                    $result .= '</div>';
                    $result .= '<div class="detail-container">';
                    if($user['FullName']!=''){
	                    $result .= '<div class="product-details"><label>Name:</label>';
	                    $result .= '<a href="#" class="permalink" >';
	                    $result .= '<h3>'.$user['FullName'].'</h3>';
	                    $result .= '</a>';
	                    $result .= '</div>';
	                }
	                if($user['Company']!=''){
	                    $result .= '<div class="product-details"><label>Company:</label>';
	                    $result .= '<p class="info-type">'.$user['Company'].'</p>';
	                    $result .= '</div>';
	                }
	                if($user['address']!=''){
	                    $result .= '<div class="product-details"><label>Address:</label>';
	                    $result .= '<p class="info-type">'.$user['address'].'</p>';
	                    $result .= '</div>';
	                }
	                if($web!=''){
	                    $result .= '<div class="product-details website-address"><label>Website:</label><p>';
	                    $result .= $web;
	                    $result .= '</p></div>';
	                }
                    $result .= '<div class="product-di-container">';
                    $result .= '<div class="small-details-container">';
                    $result .= '<div class="product-details status-container small-details"><label>Status:</label>'.$status.'</div>';
                    if($user['corporate_date']!=''){
	                    $result .= '<div class="product-details small-details"><label>Incorporate Date:</label>';
	                    $result .= '<p class="info-type">'.$user['corporate_date'].'</p>';
	                    $result .= '</div>';
	                }
	                if($user['added_date']!=''){
	                    $result .= '<div class="product-details small-details"><label>Added Date:</label>';
	                    $result .= '<p class="info-type">'.$user['added_date'].'</p>';
	                    $result .= '</div>';
	                }
                	if($user['expiry_date']!=''){
	                    $result .= '<div class="product-details small-details"><label>Expiry Date:</label>';
	                    $result .= '<p class="info-type">'.$user['expiry_date'].'</p>';
	                    $result .= '</div>';
	                }
	                if($user['acn_number']!=''){
	                    $result .= '<div class="product-details small-details"><label>ACN Number:</label>';
	                    $result .= '<p class="info-type">'.$user['acn_number'].'</p>';
	                    $result .= '</div>';
	                } 
                    $result .= '</div><div class="img-container product-img-container">';
                    $result .= '<img src="'.$productImg.'" alt="" class="left">';
                    $result .= '</div></div>';
                    if($user['institution']!=''){
	                    $result .= '<div class="product-details other-details"><label>Institution:</label>';
	                    $result .= '<p class="info-type">'.$user['institution'].'</p>';
	                    if($user['EInAppStatus'] !=''){
	                    	$result .= '<label>ABR Institution:</label><p class="info-type">'.$user['EInAppStatus'].'</p>';
	                    }
	                    if($institutionLogo !=''){
		                    $result .= '<div class="logos-img-container img-container"><img src="'.$institutionLogo.'" alt="" class="left"></div>';
		                }
	                    $result .= '</div>';
	                }
	                if($user['sectorName']!=''){
	                    $result .= '<div class="product-details other-details"><label>Sector:</label>';
	                    $result .= '<p class="info-type">'.$user['sectorName'].'</p>';
	                    if($user['ESecAppStatus'] !=''){
		                    $result .= '<label>ABR Sector:</label><p class="info-type">'.$user['ESecAppStatus'].'</p>';
		                }
	                    if($secLogo !=''){
		                    $result .= '<div class="logos-img-container img-container"><img src="'.$secLogo.'" alt="" class="left"></div>';
		                }
	                    $result .= '</div>';
	                }
	                if($user['rndname']!=''){
	                    $result .= '<div class="product-details other-details"><label>R&D Name:</label>';
	                    $result .= '<p class="info-type">'.$user['rndname'].'</p>';
	                    if($user['RndAppStatus'] !=''){
	                    	$result .= '<label>ABR R&D:</label><p class="info-type">'.$user['RndAppStatus'].'</p>';
	                    }
	                    if($rndLogo !=''){
		                    $result .= '<div class="logos-img-container img-container"><img src="'.$rndLogo.'" alt="" class="left"></div>';
		                }
	                    $result .= '</div>';
	                }
	                if($user['Member']!=''){
	                    $result .= '<div class="product-details other-details"><label>Commercialisation Australia:</label>';
	                    $result .= '<p class="info-type">'.$user['Member'].'</p>';
	                    if($user['EAccCoAppStatus'] !=''){
		                    $result .= '<label>ABR Commercialisation Australia:</label><p class="info-type">'.$user['EAccCoAppStatus'].'</p>';
		                }
	                    if($AccCoImg !=''){
		                    $result .= '<div class="logos-img-container img-container"><img src="'.$AccCoImg.'" alt="" class="left"></div>';
		                }
	                    $result .= '</div>';
	                }
                	if($user['Accname']!=''){
	                    $result .= '<div class="product-details other-details"><label>Accelerator:</label>';
	                    $result .= '<p class="info-type">'.$user['Accname'].'</p>';
	                    if($user['EAccAppStatus'] !=''){
		                    $result .= '<label>ABR Accelerator:</label><p class="info-type">'.$user['EAccAppStatus'].'</p>';
		                }
	                    if($AccImg !=''){
		                    $result .= '<div class="logos-img-container img-container"><img src="'.$AccImg.'" alt="" class="left"></div>';
		                }
	                    $result .= '</div>';
	                }
	                if($desc !=''){
	                    $result .= '<div class="description">';
	                    $result .= '<label>Summary:</label><p>';
	                    $result .= $desc ;
	                    $result .= '</p>';
	                    $result .= '</div>';
	                }
                    $result .= "<br />";
                    $result .= '</div></div></div>';
                    $result .= '</div></div>';
                }
                   
            }
                
        return $result;//.$this->db->last_query();

    }
}