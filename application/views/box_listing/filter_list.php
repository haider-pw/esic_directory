<!--script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
    <script type="text/javascript">
        (function($){
            var url = 'https://ctsdemo.com/demos/esic/Esicfilter/index';
            $.ajax({
                crossOrigin: true,
                url: url,
                success: function(data) {
                    $("#filter-area").append(data);
                }
            });
        })(window._W && _W.jQuery);
    </script>

<div id="filter-area" class="filter-area">
</div-->



<?php ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">
<!--link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/filter.css">
<!--script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script-->

<!--script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script-->
<!-- Latest compiled and minified CSS -->

<style type="text/css" >
    #location_search:focus{
        border: red solid thin;
    }
/* added by hamid raza  */
    .search { position: relative; }
    .search input { text-indent: 30px;}
    .search .fa-search {
        position: absolute;
        top: 12px;
        right: 20px;
        font-size: 15px;
        cursor: pointer;
    }
    span.icon {
        color: gray;
    }

    img.slider_image {
        width: 70px;
        height: 70px;
    }

    /* slider code */

    .glyphicon-chevron-right{
        color: gray;
        font-size: 15px !important;
    }
    .glyphicon-chevron-left{
        color: gray;
        font-size: 15px !important;
    }
    .carousel-control {
       background-image: none !important;
        width: 1% !important;
        display: none;

    }
    #theCarousel:hover .carousel-control {
        display: block;

    }
   img.img-responsive{
       width: 60px;
       height: 50px;
       margin-top: 10px;
       margin-left: 6px;


   }
    .row{
        margin: none !important;
    }

</style>

<div class="content-shell">
    <div class="content-wrap" id="wrap">
        <div class="content">
             <div class="module">
                 <div class="search-para module-para">
                     <div id="wsite-content" class="wsite-elements wsite-not-footer">
                            <h2 class="wsite-content-title" style="text-align:center;">Search for Early Stage Innovation Companies</h2>
                            <div class="paragraph" style="text-align:center;color: #666666;">
                                To help early stage companies progress through the qualification process we track and update them via our directory, allowing their investors authoritative status updates, with easy and an appropriate level of assurance. ESIC status is designed to be temporary, end date and assessed date search allow quick reference to the facts, and provide another gauge of the currency and accuracy of those ESIC's, that said, our ranking is not a substitute for date-specfic professional sign-off (unless that is indicated). Happy Searching!
                            </div>
                        </div>
                    </div>

                    <div class="module-section">
                        <!--h3>Search by Location</h3-->

  <div class="filter form">
      <div class="filter3" id="filter">
                                <div class="searchbox search">
                                    <span class="icon" id="filter_search" > <i class="fa fa-search"></i></span>
                                    <input type="text" value="" name="location_value" id="location_search"
                                       class="locationSuggest ac_input" placeholder="Search Now"
                                       autocomplete="off">

                                </div>

          <div class="row">
                <div class="col-md-12">
                     <div class="carousel slide multi-item-carousel" id="theCarousel">
                           <div class="carousel-inner">

                               <?php


                                    $i  = 1;
                                      if(isset($company) and !empty($company)){
                                        foreach ($company as $companyi) {

                                          $item_class = ($i == 1) ? 'item active' : 'item';
                                            ?>
                                              <div class="<?php echo $item_class; ?>">
                                               <div class="col-xs-4">
                                                 <a href="#">
                                                   <img src="<?php echo  base_url($companyi->logo) ?>" class="img-responsive" />
                                                 </a>
                                               </div>
                                               </div>
                                             <?php
                                        $i++;
                                                }}
                                                ?>



                          </div>
                                            <a class="left carousel-control" href="#theCarousel" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
                                            <a class="right carousel-control" href="#theCarousel" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
                                        </div>
             </div>
           </div>
 </div>





                                <?php /*    <div class="advance-filter-toggle">
                                    <a href="#" id="show-filter">Advance Filters</a>
                                </div>
                                <div id="selectDiv" class="">
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
                                     <!--div class="selectFilters company">
                                        <select id="companySelect" placeholder="Select Company">
                                            <option value="" disabled selected>Select Company</option>
                                            <?php

                                            ?>
                                        </select>
                                    </div-->
                                    <div class="selectFilters company">
                                        <select id="companySelect" placeholder="Select Company">
                                            <option value="" disabled selected>Select Status</option>
                                            <?php
                                            if(isset($Statuss) and !empty($Statuss)){
                                                foreach($Statuss as $Status){     
                                                    echo '<option value="'.$Status->id.'">'.$Status->status.'</option>';    
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="sortFilters">
                                        <select id="dateAddedOrderSelect" placeholder="Order By date added">
                                            <option value="" disabled selected>Order by date added</option>
                                            <option value="desc">Newest</option>
                                            <option value="asc">Oldest</option>
                                        </select>
                                    </div>
                                    <div class="sortFilters">
                                        <select id="assessmentOrderSelect" placeholder="Order By Incoporate date">
                                            <option value="" disabled selected>Order by Incoporate date</option>
                                            <option value="asc">Newest</option>
                                            <option value="desc">Oldest</option>
                                        </select>
                                    </div>
                                    <div class="sortFilters">
                                        <select id="expiryOrderSelect" placeholder="Order By expiry date">
                                            <option value="" disabled selected>Order by expiry date</option>
                                            <option value="asc">Newest</option>
                                            <option value="desc">Oldest</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="filter_submit">
                            <button  id="filter_search" class="hero-link green-bg" value="Search Now" data-val = "0">Search Now</button>
                            <button  id="filter_reset" class="hero-link green-bg" value="Reset" data-val = "0">Reset</button>  
                        </div>
                   */ ?>
                    </div>
                    <div class="clear"></div>
                </div>
        </div>
    </div>
</div>

<script>
    jQuery(document).ready(function($){
        var sectorsSelect,companySelect,searchInput,OrderSelect,OrderSelectValue,AdOrderSelect,ASOrderSelect,ExOrderSelect,AdOrderSelectValue,ASOrderSelectValue,ExOrderSelectValue;
        var urlToListingPage = 'https://www.esic.directory/esic-database.html';
        
        $("body").on("click touchstart","#show-filter",function(e) {
            e.preventDefault();
             $('#filter #selectDiv').slideToggle( "slow");
        });
        $("body").on("click touchstart","#filter_reset",function(e) {
            e.preventDefault();
            $(".module select").val($("module select option:first").val());
            $(".module input").val('');
        });
        $('#dateAddedOrderSelect').change(function(){
            OrderSelect = 'added_date';
            var selectvalue = $(this).val();
            $(".module .sortFilters select").val($(".module .sortFilters select option:first").val());
            $(this).val(selectvalue);
            var selectstring = JSON.stringify(selectvalue);
            if(selectstring == '"asc"'){
                OrderSelectValue = 'asc';
            }else{
                OrderSelectValue = 'desc';
            }
        });
        $('#assessmentOrderSelect').change(function(){
            OrderSelect = 'corporate_date';
            var selectvalue = $(this).val();
            $(".module .sortFilters select").val($(".module .sortFilters select option:first").val());
            $(this).val(selectvalue);
            var selectstring = JSON.stringify(selectvalue);
            if(selectstring == '"asc"'){
                OrderSelectValue = 'asc';
            }else{
                OrderSelectValue = 'desc';
            }
        });
        $('#expiryOrderSelect').change(function(){
            OrderSelect = 'expiry_date';
            var selectvalue = $(this).val();
            $(".module .sortFilters select").val($(".module .sortFilters select option:first").val());
            $(this).val(selectvalue);
            var selectstring = JSON.stringify(selectvalue);
            if(selectstring == '"asc"'){
                OrderSelectValue = 'asc';
            }else{
                OrderSelectValue = 'desc';
            }
            //console.log('s'+OrderSelectValue+' cc '+selectstring);
        });
        $("body").on("click touchstart","#filter_search",function(e) {
            e.preventDefault();
            //console.log('Cheched');
            var clickBtn ='filter_search';
            callfilter(clickBtn);

        });
        function callfilter(clickBtn){
                var page = $("#filter_search").data('val');
                //console.log('page ='+page);
                /*if(clickBtn=='filter_search'){
                    if(sectorsSelect != $('#sectorsSelect option:selected').text()){
                        page = 0;
                    }
                    if(companySelect != $('#companySelect option:selected').text()){
                        page = 0;
                    }
                }*/
                searchInput = $('#location_search').val();
               // companySelect = $('#companySelect option:selected').text();
              //  sectorsSelect = $('#sectorsSelect option:selected').text();
                //AdOrderSelect = $('#dateAddedOrderSelect option:selected').text();
                //ASOrderSelect = $('#assessmentOrderSelect option:selected').text();
                //ExOrderSelect = $('#expiryOrderSelect option:selected').text();

                //console.log(searchInput);
                //companySelectValue = $('#companySelect option:selected').val();
                //sectorsSelectValue = $('#sectorsSelect option:selected').val();
                //AdOrderSelectValue = $('#dateAddedOrderSelect option:selected').val();
                //ASOrderSelectValue = $('#assessmentOrderSelect option:selected').val();
                //ExOrderSelectValue = $('#expiryOrderSelect option:selected').val();
                //console.log('OrderSelectValue'+OrderSelectValue);
                //console.log('searchInput= '+searchInput);
                //console.log('companySelectValue= '+companySelectValue);
                //console.log('sectorsSelectValue= '+sectorsSelectValue);
                //console.log('OrderSelectValue= '+OrderSelectValue);
                if(searchInput=='' ){
                    //&& companySelectValue=='' && sectorsSelectValue=='' && (OrderSelectValue=='' || OrderSelectValue==undefined)){

                        sessionStorage.setItem("filter-searchInput",'');
                        sessionStorage.setItem("filter-sectorsSelectValue",'');
                        sessionStorage.setItem("filter-companySelect",'');
                        sessionStorage.setItem("filter-OrderSelect",'');
                        sessionStorage.setItem("filter-OrderSelectValue",'');

                      //window.location.href = urlToListingPage;
                      $('#location_search').focus();
                      return false;
                }
               /* if(companySelectValue==''){
                    companySelect='';
                }else{
                   companySelect = '"'+companySelect+'"';
                }
                if(sectorsSelectValue==''){
                    sectorsSelect='';
                }
                if(OrderSelectValue==undefined){
                    OrderSelectValue='';
                    OrderSelect='';
                }
                if(searchInput!='' || companySelectValue!='' || sectorsSelectValue!='' || OrderSelectValue!='' ){*/
                    sessionStorage.setItem("filter-searchInput",searchInput);
                    /*sessionStorage.setItem("filter-sectorsSelectValue",sectorsSelectValue);
                    //sessionStorage.setItem("filter-companySelect",companySelect);
                    sessionStorage.setItem("filter-companySelect",companySelectValue);
                    sessionStorage.setItem("filter-OrderSelect",OrderSelect);
                    sessionStorage.setItem("filter-OrderSelectValue",OrderSelectValue);*/
                    window.location.href = urlToListingPage;
                    return false;
                //}

        }

        // Instantiate the Bootstrap carousel
        $('.multi-item-carousel').carousel({
            interval:2400

        });

// for every slide in carousel, copy the next slide's item in the slide.
// Do the same for the next, next item.
        $('.multi-item-carousel .item').each(function(){
            var next = $(this).next();

            if (!next.length) {
                next = $(this).siblings(':first');
            }
            next.children(':first-child').clone().appendTo($(this));

            if (next.next().length>0) {
                next.next().children(':first-child').clone().appendTo($(this));
            } else {
                $(this).siblings(':first').children(':first-child').clone().appendTo($(this));
            }
        });

        /*function search_func(e)
        {
            e = e || window.event;
            if (e.keyCode == 13)
            {
                document.getElementById('location_search').click();
                return false;
            }
            return true;
        }*/

    });
</script>


