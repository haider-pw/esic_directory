<?php
/*echo "<pre>";
var_dump($links);
echo "</pre>";
*/?>
<link rel="stylesheet" type="text/css" href="assets/css/boxlisting.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<div class="content-shell">
    <div class="content-wrap" id="wrap">
        <div class="content">
                <div class="module">
                    <div class="module-section">
                        <h3>Search by Location</h3>
                        <form method="post" accept-charset="UTF-8" action="">
                            <div class="filter3" id="filter">
                                <div class="searchbox">
                                    <input type="text" value="" name="location_value" id="location_search"
                                       class="locationSuggest ac_input" placeholder="Name, website, company"
                                       autocomplete="off">
                                </div>
                                <div class="selectFilters sectors">
                                    <select>
                                        <option>Category</option>
                                        <option>Category</option>
                                        <option>Category</option>
                                        <option>Category</option>
                                    </select>
                                </div>
                                 <div class="selectFilters company">
                                    <select>
                                        <option>Company</option>
                                        <option>Company</option>
                                        <option>Company</option>
                                        <option>Company</option>
                                    </select>
                                </div>
                            </div>
                            <div id="filter_submit">
                                <input type="submit" class="hero-link green-bg" value="Search Now">
                            </div>
                        </form>
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
        getcountry(0);
        $("#load_more").click(function(e){
            e.preventDefault();
            var page = $(this).data('val');
            $("#load_more").addClass('loading');
            $("#loader").show();
            setTimeout(function(){
                 getcountry(page);
              }, 2000);
        });
    function getcountry(page){
        
        $.ajax({
            url:"<?php echo base_url() ?>Esic2/getCountry",
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
                scroll();
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
