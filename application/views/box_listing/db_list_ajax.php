<?php

if(!empty($usersResult) && is_array($usersResult)){
    foreach($usersResult as $key=>$user){
        ?>
                    <li class="hcard-search member_level_5">
                        <div class="img-container">
                             <a href="/england/newcastle-upon-tyne/e-commerce-markets/janet-stansfield" title="Janet Stansfield SEIS Companies" rel="nofollow">
                                  <img src="<?=(isset($user['Logo']) and !empty($user['Logo']) and is_file(FCPATH.'/'.$user['Logo']))? base_url($user['Logo']):base_url('pictures/defaultLogo.png'); ?>" alt="" class="left">
                            </a>
                        </div>
                        <div class="status-container">
                             <?=!empty($user['Status'])?$user['Status']:'' ?>
                       </div> 
                        <div class="name-container">
                            <a href="/england/newcastle-upon-tyne/e-commerce-markets/janet-stansfield">
                                <h3><?= $user['FullName'] ?></h3>
                           </a>
                        </div>
                       <div class="clear"></div>
                       <div class="product-details">
                           <p class="info-type"> <?=$user['Company']?></p>
                       </div>
                       <div class="product-details">
                           <span class="price-funded">  </span>
                           <span class="price-assuarance"> <?=!empty($user['Web'])?'<a target="_blank" href="http://'.$user['Web'].'" class="website">'.$user['Web'].'</a>':'';?></span>
                          <?php if(!empty($user['BusinessShortDesc'])){
                          echo '<p>';
                            echo (strlen($user['BusinessShortDesc']) > 200) ? substr($user['BusinessShortDesc'],0,200).'...' : $user['BusinessShortDesc'];
                            echo '</p>';
                            echo "<br />";
                            }
                          ?>
                         
                       </div>
                    </li>
        <?php
    }
}

?>
