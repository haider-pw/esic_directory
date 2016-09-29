<?php
/**
 * Created by PhpStorm.
 * User: HI
 * Date: 9/27/2016
 * Time: 5:44 PM
 */

$result="";
if(!empty($list)){
    $count=0;
    foreach($list as $key=>$user){
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

    echo $result;

}