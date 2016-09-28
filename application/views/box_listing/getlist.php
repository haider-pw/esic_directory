<?php
if(!empty($list) && is_array($list)){
			    foreach($list as $key=>$user){
			    	$status='';
			    	$web='';
			    	$desc='';
			    	$img ='';
			    	if(!empty($user['Status'])){
			    		$status = $user['Status'];
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
?>
<li class="list-item hcard-search member_level_5" data-page="<= $page ?>">
	<a href="<?= '#'.$user['userID']; ?>" class="permalink" data-link= "<?= $user['userID'];?>">
		<div class="img-container wraptocenter">
			<span>
				<img src="<?= $img; ?>" alt="" class="left"/>
			</span>
		</div>
	</a>	
		<div class="product-container">
			<div class="status-container">
				<?= $status;?>	
			</div>
			<div class="name-container person-name">
			        <a href="<?= '#'.$user['userID']; ?>" class="permalink" data-link= "<?= $user['userID'];?>"><h3><?= $user['FullName']; ?></h3></a>
			</div>
			<div class="clear"></div>
			<div class="product-details company-name">
			<a href="<?= '#'.$user['userID']; ?>" class="permalink" data-link= "<?= $user['userID'];?>">
			      <p class="info-type">
			      		<?= $user['Company']; ?>	
			      </p>
			</a>
			</div>
			<div class="product-details">
			     <div class="description overlay-desc">
                    <p><?= $desc; ?> </p>
                 </div>
                 <div class="dates-box">
                 	<button type="button" class="show-dates">
	                		<i class="fa fa-calendar" aria-hidden="true"></i>
                    </button>
                 	<?php if(!empty($user['added_date'])){ ?>
				     <div class="product-details date-container add">
				     	<label>Added Date:</label>
	                  	<p class="info-type"><?= $user['added_date'];?></p>
	                 </div>
	                 <?php } ?>
	                 <?php if(!empty($user['corporate_date'])){ ?>
	                 <div class="product-details date-container cop">
		                 <label>Incoporate Date:</label>
		                 <p class="info-type"><?= $user['corporate_date']; ?></p>
	                 </div>
	                 <?php } ?>
	                 <?php if(!empty($user['expiry_date'])){ ?>
	                <div class="product-details date-container exp">
	                	<label>Expiry Date:</label>
	                	<p class="info-type"><?= $user['expiry_date'];?></p>
	                </div>
	                <?php } ?>
                </div>
			</div>
		 </div>
</li>
<?php 
			       
			    }
			}
?>