<?php
/*echo "<pre>";
var_dump($links);
echo "</pre>";
*/?>
<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/boxlisting.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<div class="content-shell">
    <div class="content-wrap" id="wrap">
        <div class="content">
                <div class="module">
                    <div class="module-section">
                        <!--h3>Search by Location</h3-->
                        <div class=" filter form">
                            <div class="filter3" id="filter">
                                <div class="searchbox">
                                    <input type="text" value="" name="location_value" id="location_search"
                                       class="locationSuggest ac_input" placeholder="Name, website"
                                       autocomplete="off">
                                </div>
                                <div class="selectFilters sectors">
                                     <select id="sectorsSelect" placeholder="Select Sector">
                                        <option value="" disabled selected>Select Sector</option>
                                        <?php
                                        if(isset($sectors) and !empty($sectors)){
                                            foreach($sectors as $sector){
                                                if(!empty($sector->sector))
                                                echo '<option value="'.$sector->id.'">'.$sector->sector.'</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                 <div class="selectFilters company">
                                    <select id="companySelect" placeholder="Select Company">
                                        <option value="" disabled selected>Select Company</option>
                                        <?php
                                        if(isset($company) and !empty($company)){
                                            foreach($company as $company){
                                                if(!empty($company->company))
                                                echo '<option value="'.$company->id.'">'.$company->company.'</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div id="filter_submit">
                                <button  id="filter_search" class="hero-link green-bg" value="Search Now" data-val = "0">Search Now</button> 
                            </div>
                        </div>
                    </div>
                </div>
            <div class="new-results" >
                <?php

                if(!empty($usersResult) && is_array($usersResult)){
                echo '<ul id="regList" class="product-list" >';
                echo '</ul>';
                }

                ?>

                <div class="clear"></div>
                 <div class="btn-more container" style="text-align: center">
                    <button class="btn" id="load_more" data-val = "0">Load more..
                        <img style="display: none" id="loader" src="<?php echo str_replace('index.php','',base_url()) ?>assets/loader.GIF"> 
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>



 
<script>
    jQuery(document).ready(function($){
        getlist(0);
        var sectorsSelect,companySelect;
        $("#load_more").click(function(e){
            e.preventDefault();
            var page = $(this).data('val');
            $("#load_more").addClass('loading');
            $("#loader").show();
            setTimeout(function(){
                 getlist(page);
              }, 2000);
        });
        $("#filter_search").click(function(e){
            e.preventDefault();
            var page = $("#filter_search").data('val');
            if(sectorsSelect != $('#sectorsSelect option:selected').text()){
                page = 0;
            }
            if(companySelect != $('#companySelect option:selected').text()){
                page = 0;
            }
            companySelect = $('#companySelect option:selected').text();
            sectorsSelect = $('#sectorsSelect option:selected').text();
            companySelectValue = $('#companySelect option:selected').val();
            sectorsSelectValue = $('#sectorsSelect option:selected').val();
            if(companySelectValue=='' && sectorsSelectValue=='' ){
                $("#regList").html('');
                getlist(0);
                return false;
            }
            if(companySelectValue==''){
                companySelect='';
            }
            if(sectorsSelectValue==''){
                sectorsSelect='';
            }
            $("#load_more").addClass('loading');
            $("#loader").show();
            setTimeout(function(){
                 getfilterlist(page,sectorsSelectValue,companySelect);
              }, 2000);
        });

    function getfilterlist(page,secSelect,comSelect){
        
        $.ajax({
            url:"<?php echo base_url() ?>Esic2/getfilterlist",
            type:'GET',
            data: {page:page,secSelect:secSelect,comSelect:comSelect}
        }).done(function(response){
            if(page==0){
                $("#regList").html('');
            }
            if(response=='NORESULT'){
                $("#loader").hide();
                $("#load_more").removeClass('loading');
                $('#load_more').hide();
                $('.btn-more').append('Sorry No More Result Found');
            }else{
                $("#regList").append(response);
                $("#loader").hide();
                $("#load_more").removeClass('loading');
                $('#load_more').data('val', ($('#filter_search').data('val')+1));
                scroll();
            }
            
        });
    }
    function getlist(page){
        
        $.ajax({
            url:"<?php echo base_url() ?>Esic2/getlist",
            type:'GET',
            data: {page:page}
        }).done(function(response){
            if(response=='NORESULT'){
                $("#loader").hide();
                $("#load_more").removeClass('loading');
                $('#load_more').hide();
                $('.btn-more').append('Sorry No More Result Found');
            }else{
                $("#regList").append(response);
                $("#loader").hide();
                $("#load_more").removeClass('loading');
                $('#load_more').data('val', ($('#load_more').data('val')+1));
                if(page!=0){
                    scroll();
                }
            }
            
        });
    }
 
    function scroll(){
        $('html, body').animate({
            scrollTop: $('#load_more').offset().top
        }, 1000);
    }
     });
 
 
</script>
