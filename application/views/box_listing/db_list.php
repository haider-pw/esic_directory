<?php ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/boxlisting.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>
<!-- Latest compiled and minified CSS -->
<!--

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
        <script type="text/javascript" src="//ctsdemo.com/demos/esic/assets/js/jquery.ba-bbq.min.js"></script>
    <script type="text/javascript">
        (function($){
            var url = 'https://ctsdemo.com/demos/esic/Esic2/index';
            $.ajax({
                crossOrigin: true,
                url: url,
                success: function(data) {
                    $("#wsite-content").append(data);
                }
            });
        })(window._W && _W.jQuery);
    </script>
    -->

    
<div class="content-shell">
    <div class="content-wrap" id="wrap">
        <div class="content">
                <div class="module">
                    <div class="module-section">
                        <!--h3>Search by Location</h3-->
                        <div class="filter form">
                            <div class="filter3" id="filter">
                                <div class="searchbox">
                                    <input type="text" value="" name="location_value" id="location_search"
                                       class="locationSuggest ac_input" placeholder="Name, website"
                                       autocomplete="off">
                                </div>
                                <div class="advance-filter-toggle">
                                    <a href="#" id="show-filter">Advance Filters</a>
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
                            <div class="filter-inner" id="sort-filters">
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
                        <div id="filter_submit">
                            <button  id="filter_search" class="hero-link green-bg" value="Search Now" data-val = "0">Search Now</button>
                            <button  id="filter_reset" class="hero-link green-bg" value="Reset" data-val = "0">Reset</button>  
                        </div>
                    </div>
                    <div class="clear"></div>
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


<div id="loading-submit">
    <img src="<?=base_url();?>assets/images/loading.gif" alt="loading">
</div>
<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.ba-bbq.min.js"></script>
<script>
    jQuery(document).ready(function($){

                var filtersearchInput = sessionStorage.getItem("filter-searchInput");
                var filtersectorsSelectValue = sessionStorage.getItem("filter-sectorsSelectValue");
                var filtercompanySelect = sessionStorage.getItem("filter-companySelect");
                var filterOrderSelect = sessionStorage.getItem("filter-OrderSelect");
                var filterOrderSelectValue = sessionStorage.getItem("filter-OrderSelectValue");
                        sessionStorage.setItem("filter-searchInput",'');
                        sessionStorage.setItem("filter-sectorsSelectValue",'');
                        sessionStorage.setItem("filter-companySelect",'');
                        sessionStorage.setItem("filter-OrderSelect",'');
                        sessionStorage.setItem("filter-OrderSelectValue",'');
        if( filtersearchInput =='' && 
            filtersectorsSelectValue =='' && 
            filtercompanySelect =='' && 
            filterOrderSelect =='' && 
            filterOrderSelectValue ==''){
             getlist(0);
        }else{
            getfilterlist(0,filtersearchInput,filtersectorsSelectValue,filtercompanySelect,filterOrderSelect,filterOrderSelectValue);
        }
       
        var sectorsSelect,companySelect,searchInput,OrderSelect,OrderSelectValue,AdOrderSelect,ASOrderSelect,ExOrderSelect,AdOrderSelectValue,ASOrderSelectValue,ExOrderSelectValue;
/*        $("body").on("click","a.permalink",function(e) {
//            e.preventDefault();
            var linkId = $(this).attr('data-link');
            //console.log('link'+linkId);
            redirectToLink(linkId);
        });*/


        function getSessionId(sessionString) {
            return sessionStorage.getItem(sessionString)==null?"":sessionStorage.getItem(sessionString);
        }
        function setSessionId(userID) {
            sessionStorage.setItem("thumbsUpSessionID"+userID,'thumbsUpID'+userID);
        }





        $("body").on("click touchstart",".show-dates",function(e) {
             e.preventDefault();
            $(this).parent().find('.date-container').toggle();
        });
        $("body").on("click touchstart","#show-filter",function(e) {
            e.preventDefault();
             $('#filter select, #sort-filters select').toggle();
        });
        $("body").on("click touchstart",".thumbs-up",function(e) {
            e.preventDefault();
             var thumbsUpDiv = $(this);
             var userID = thumbsUpDiv.attr('data-link');
             var thumbs = parseInt(thumbsUpDiv.find('span').text(), 10);
             var newThumbs = thumbs + 1;
             if(getSessionId("thumbsUpSessionID"+userID) != 'thumbsUpID'+userID){
                 setSessionId(userID);
                 $.ajax({
                    url:"<?php echo base_url() ?>Esic2/updatethumbs",
                    type:'POST',
                    data: {userID:userID,
                        thumbs:thumbs,
                        newThumbs:newThumbs
                        }
                }).done(function(response){
                    var data = response.split('::');
                    if(data[0]=='OK'){
                        thumbsUpDiv.find('span').text(newThumbs);
                    }
                });  
            }else{
                //console.log('Sorry Already Set');
            }
        });
        $("body").on("click touchstart","#filter_reset",function(e) {
            e.preventDefault();
            $(".module select").val($("module select option:first").val());
            $(".module input").val('');
        });
        $('#dateAddedOrderSelect').change(function(){
            OrderSelect = 'added_date';
            var selectvalue = $(this).val();
            $(".module #sort-filters select").val($(".module #sort-filters select option:first").val());
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
             $(".module #sort-filters select").val($(".module #sort-filters select option:first").val());
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
            $(".module #sort-filters select").val($(".module #sort-filters select option:first").val());
            $(this).val(selectvalue);
            var selectstring = JSON.stringify(selectvalue);
            if(selectstring == '"asc"'){
                OrderSelectValue = 'asc';
            }else{
                OrderSelectValue = 'desc';
            }
            //console.log('s'+OrderSelectValue+' cc '+selectstring);
        });
        $("body").on("click touchstart","#load_more",function(e) {
            e.preventDefault();
            var clickBtn ='load_more';
            var page = $(this).data('val');
            //console.log('page ='+page);
            $("#load_more").addClass('loading');
            $("#loader").show();
            searchInput = $('#location_search').val();
            companySelect = $('#companySelect option:selected').text();
            sectorsSelect = $('#sectorsSelect option:selected').text();
            AdOrderSelect = $('#dateAddedOrderSelect option:selected').text();
            ASOrderSelect = $('#assessmentOrderSelect option:selected').text();
            ExOrderSelect = $('#expiryOrderSelect option:selected').text();

            //console.log(searchInput);
            companySelectValue = $('#companySelect option:selected').val();
            sectorsSelectValue = $('#sectorsSelect option:selected').val();
            AdOrderSelectValue = $('#dateAddedOrderSelect option:selected').val();
            ASOrderSelectValue = $('#assessmentOrderSelect option:selected').val();
            ExOrderSelectValue = $('#expiryOrderSelect option:selected').val();
            if(searchInput!='' || companySelectValue!='' || sectorsSelectValue!='' || AdOrderSelectValue!='' || ASOrderSelectValue!='' || ExOrderSelectValue!='' ){
                //$("#regList").html('');
                callfilter(clickBtn);
                return false;
            }
            setTimeout(function(){
                 getlist(page);
              }, 500);
        });
        $("body").on("click touchstart","#filter_search",function(e) {
            e.preventDefault();
            var clickBtn ='filter_search';
            callfilter(clickBtn);
        });
/*        $("body").on("click","#back",function(e){
            e.preventDefault();
            $('body').removeClass('single-item-layout');
            $('.content-shell #wrap .content').slideDown('slow');
            $('.content-shell #wrap .single-item').slideUp('slow');  
            $('.content-shell #wrap .single-item').remove();
            $(this).parent().remove();
            return false;    
        });*/
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
                searchInput = $('#location_search').val();
                companySelect = $('#companySelect option:selected').text();
                sectorsSelect = $('#sectorsSelect option:selected').text();
                //AdOrderSelect = $('#dateAddedOrderSelect option:selected').text();
                //ASOrderSelect = $('#assessmentOrderSelect option:selected').text();
                //ExOrderSelect = $('#expiryOrderSelect option:selected').text();

                //console.log(searchInput);
                companySelectValue = $('#companySelect option:selected').val();
                sectorsSelectValue = $('#sectorsSelect option:selected').val();
                //AdOrderSelectValue = $('#dateAddedOrderSelect option:selected').val();
                //ASOrderSelectValue = $('#assessmentOrderSelect option:selected').val();
                //ExOrderSelectValue = $('#expiryOrderSelect option:selected').val();
                //console.log('OrderSelectValue'+OrderSelectValue);
        if(searchInput=='' && companySelectValue=='' && sectorsSelectValue=='' && OrderSelectValue=='' ){
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
                     getfilterlist(page,searchInput,sectorsSelectValue,companySelect,OrderSelect,OrderSelectValue);
                  }, 500);
        }

        function getfilterlist(page,searchInput,secSelect,comSelect,orderSelect,orderSelectValue){
            if(orderSelect==undefined){
                orderSelect='';
                orderSelectValue ='';
            }
            
            $.ajax({
                url:"<?php echo base_url() ?>Esic2/getfilterlist",
                type:'GET',
                data: {page:page,
                    searchInput:searchInput,
                    secSelect:secSelect,
                    comSelect:comSelect,
                    orderSelect:orderSelect,
                    orderSelectValue:orderSelectValue
                    }
            }).done(function(response){
                if(page==0){
                    $("#regList").html('');
                }
                if(response=='NORESULT'){
                    $("#loader").hide();
                    $('#no-result').remove();
                    $("#load_more").removeClass('loading');
                    $('#load_more').hide();
                    $('#no-result').remove();
                    $('.btn-more').append('<div id="no-result">Sorry No Result Found.</div>');
                    //console.log(response);
                }else if(response < 2){
                    $("#loader").hide();
                    $('#no-result').remove();
                    $("#load_more").removeClass('loading');
                    $('#load_more').hide();
                    $('#no-result').remove();
                    $('.btn-more').append('<div id="no-result">Sorry No Result Found.</div>');
                }else{
                     //console.log(response);
                     $('#no-result').remove();
                    $("#regList").append(response);
                    $("#loader").hide();
                    $('#load_more').show();
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
                    $('#no-result').remove();
                    $("#loader").hide();
                    $("#load_more").removeClass('loading');
                    $('#load_more').hide();
                    $('#no-result').remove();
                    $('.btn-more').append('<div id="no-result">Sorry No More Result Found.</div>');
                    //console.log(response);
                }else if(response < 2){
                    $('#no-result').remove();
                    $("#loader").hide();
                    $("#load_more").removeClass('loading');
                    $('#load_more').hide();
                    $('#no-result').remove();
                    $('.btn-more').append('<div id="no-result">Sorry No More Result Found.</div>');
                }else{
                     //console.log(response);
                    $('#no-result').remove();
                    $("#regList").append(response);
                    $("#loader").hide();
                     $('#load_more').show();
                    $("#load_more").removeClass('loading');
                    $('#load_more').data('val', ($('#load_more').data('val')+1));
                    if(page!=0){
                        scroll();
                    }
                }
                
            });
        }
     
        function scroll(){
            return 0;
            //$('html, body').animate({
              //  scrollTop: $('#load_more').offset().top
            //}, 1000);
        }
    });


    $(function(){

        // Keep a mapping of url-to-container for caching purposes.
        var cache = {
            // If url is '' (no fragment), display this div's content.
            '': $('.bbq-default')
        };

        // Bind an event to window.onhashchange that, when the history state changes,
        // gets the url from the hash and displays either our cached content or fetches
        // new content to be displayed.
        $(window).bind( 'hashchange', function(e) {

            // Get the hash (fragment) as a string, with any leading # removed. Note that
            // in jQuery 1.4, you should use e.fragment instead of $.param.fragment().
            //window.location.href
            var url = $(location).attr('href');
            url = url.split('#').reverse()[0];
            //var url =  $.param.fragment();
           
            if($.isNumeric(url)){
                url = url;
            }else{
                 url = false;
            }
            if(url){
                redirectToLink(url);
            }else{
                $('body').removeClass('single-item-layout');
                $('.content-shell #wrap .content').slideDown('slow');
                $('.content-shell #wrap .single-item').slideUp('slow');
                $('.content-shell #wrap .single-item').remove();
                $(this).parent().remove();
                return false;
            }

            // Remove .bbq-current class from any previously "current" link(s).
            $( 'a.bbq-current' ).removeClass( 'bbq-current' );

            // Hide any visible ajax content.
            $( '.bbq-content' ).children( ':visible' ).hide();

            // Add .bbq-current class to "current" nav link(s), only if url isn't empty.
            url && $( 'a[href="#' + url + '"]' ).addClass( 'bbq-current' );

            if ( cache[ url ] ) {
                // Since the element is already in the cache, it doesn't need to be
                // created, so instead of creating it again, let's just show it!
                cache[ url ].show();

            } else {
                // Show "loading" content while AJAX content loads.
                $( '.bbq-loading' ).show();

                // Create container for this url's content and store a reference to it in
                // the cache.
                cache[ url ] = $( '<div class="bbq-item"/>' )

                // Append the content container to the parent container.
                    .appendTo( '.bbq-content' )

                    // Load external content via AJAX. Note that in order to keep this
                    // example streamlined, only the content in .infobox is shown. You'll
                    // want to change this based on your needs.
                    .load( url, function(){
                        // Content loaded, hide "loading" content.
                        $( '.bbq-loading' ).hide();
                    });
            }
        });

        // Since the event is only triggered when the hash changes, we need to trigger
        // the event now, to handle the hash the page may have loaded with.
        $(window).trigger( 'hashchange' );

        function redirectToLink(id){
            //console.log('ID'+id);
            $('#loading-submit').show();
            $.ajax({
                url:"<?php echo base_url() ?>Esicdetails/getdetails",
                type:'GET',
                data: {id:id}
            }).done(function(response){
                $("html, body").animate({ scrollTop: 0 }, "slow");
                $('.content-shell #wrap .single-item.list-item').remove();
                $('.content-shell #wrap .btn-back').remove();
                $('body').addClass('single-item-layout');
                $('.content-shell #wrap .content').slideUp('slow');
                $('.content-shell #wrap').css('min-height', '500px');
                $('.content-shell #wrap').append(response);
                $('.content-shell #wrap').append('<div class="btn-back container"><a href="#" id="back"  class="btn">Back</a></div>');
                $('#loading-submit').hide();
            });
        }

    });


</script>
