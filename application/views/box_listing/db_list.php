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
                                            $checkArray = array();
                                            foreach($company as $company){
                                                if(!empty($company->company)){
                                                   if (!(in_array($company->company, $checkArray))){
                                                            echo '<option value="'.$company->id.'">'.$company->company.'</option>';
                                                            array_push($checkArray, $company->company);
                                                    }
                                                }
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
        var sectorsSelect,companySelect,searchInput;
        $("#load_more").click(function(e){
            e.preventDefault();
            var clickBtn ='load_more';
            var page = $(this).data('val');
            //console.log('page ='+page);
            $("#load_more").addClass('loading');
            $("#loader").show();
            companySelect = $('#companySelect option:selected').text();
            sectorsSelect = $('#sectorsSelect option:selected').text();
            searchInput = $('#location_search').val();
            //console.log(searchInput);
            companySelectValue = $('#companySelect option:selected').val();
            sectorsSelectValue = $('#sectorsSelect option:selected').val();
            if(searchInput!='' || companySelectValue!='' || sectorsSelectValue!='' ){
                //$("#regList").html('');
                callfilter(clickBtn);
                return false;
            }
            setTimeout(function(){
                 getlist(page);
              }, 500);
        });
        $("#filter_search").click(function(e){
            e.preventDefault();
            var clickBtn ='filter_search';
            callfilter(clickBtn);
        });

    function callfilter(clickBtn){
            var page = $("#filter_search").data('val');
            //console.log('page ='+page);
            if(clickBtn=='filter_search'){
                if(sectorsSelect != $('#sectorsSelect option:selected').text()){
                    page = 0;
                }
                if(companySelect != $('#companySelect option:selected').text()){
                    page = 0;
                }
            }
            companySelect = $('#companySelect option:selected').text();
            sectorsSelect = $('#sectorsSelect option:selected').text();
            searchInput = $('#location_search').val();
            //console.log(searchInput);
            companySelectValue = $('#companySelect option:selected').val();
            sectorsSelectValue = $('#sectorsSelect option:selected').val();
            if(searchInput=='' && companySelectValue=='' && sectorsSelectValue=='' ){
                $("#regList").html('');
                getlist(0);
                return false;
            }
            if(companySelectValue==''){
                companySelect='';
            }else{
               companySelect = '"'+companySelect+'"';
            }
            if(sectorsSelectValue==''){
                sectorsSelect='';
            }
            $("#load_more").addClass('loading');
            $("#loader").show();
            setTimeout(function(){
                 getfilterlist(page,searchInput,sectorsSelectValue,companySelect);
              }, 500);
    }

    function getfilterlist(page,searchInput,secSelect,comSelect){
        
        $.ajax({
            url:"<?php echo base_url() ?>Esic2/getfilterlist",
            type:'GET',
            data: {page:page,searchInput:searchInput,secSelect:secSelect,comSelect:comSelect}
        }).done(function(response){
            if(page==0){
                $("#regList").html('');
            }
            if(response=='NORESULT'){
                $("#loader").hide();
                $("#load_more").removeClass('loading');
                $('#load_more').hide();
                $('#no-result').remove();
                $('.btn-more').append('<div id="no-result">Sorry No More Result Found.</div>');
                //console.log(response);
            }else{
                 //console.log(response);
                $("#regList").append(response);
                $("#loader").hide();
                $("#load_more").removeClass('loading');
                $('#filter_search').data('val', ($('#filter_search').data('val')+1));
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
                $('#no-result').remove();
                $('.btn-more').append('<div id="no-result">Sorry No More Result Found.</div>');
                //console.log(response);
            }else{
                 //console.log(response);
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
