
<!-- jQuery 2.2.3 -->
<script src="<?= base_url()?>assets/vendors/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?= base_url()?>assets/vendors/bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?= base_url()?>assets/vendors/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url()?>assets/vendors/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?= base_url()?>assets/vendors/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?= base_url()?>assets/vendors/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url()?>assets/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url()?>assets/js/demo.js"></script>
<script src="<?= base_url()?>assets/js/customScripting.js"></script>

<?php
    if($this->router->fetch_method() === 'assessments_list'){
        ?>

        <!-- page script -->
        <script>
            $(function () {
                //// Need To Work ON New Way Of DataTables..
                oTable ="";
                //Initialize Select2 Elements
                var regTableSelector = $("#regList");
                var url_DT = "<?=base_url();?>Admin/assessments_list/listing";
                var aoColumns_DT = [
                    /* User ID */ {
                        "mData": "UserID",
                        "bVisible": true,
                        "bSortable": true,
                        "bSearchable": true
                    },
                    /* Full Name */ {
                        "mData" : "FullName"
                    },
                    /* Email */ {
                        "mData" : "Email"
                    },
                    /* Company */ {
                        "mData" : "Company"
                    },
                    /*  Buisness */ {
                        "mData" : "Business"
                    },
                    /* Last User Login */ {
                        "mData": "Status"
                    },
                    /* Action Buttons */ {
                        "mData" : "ViewEditActionButtons"
                    }
                ];
                var HiddenColumnID_DT = "UserID";
                var sDom_DT = '<"H"r>t<"F"<"row"<"col-lg-6 col-xs-12" i> <"col-lg-6 col-xs-12" p>>>';
                commonDataTables(regTableSelector,url_DT,aoColumns_DT,sDom_DT,HiddenColumnID_DT);

                //Code for search box
                $("#search-input").on("keyup",function (e) {
                    oTable.fnFilter( $(this).val());
                });
            });
        </script>
        <script type="text/javascript">
            $(function(){
                //Some Action To Perform When Modal Is Shown.
                $(".approval-modal").on("shown.bs.modal", function (e) {
                    var button = $(e.relatedTarget); // Button that triggered the modal
                    var ID = button.parents("tr").attr("data-id");
                    var modal = $(this);
                    modal.find("input#hiddenUserID").val(ID);
                });

                $("#yesApprove").on("click",function () {
                    var hiddenModalUserID = $(this).parents(".modal-content").find("#hiddenUserID").val();
                    //console.log(hiddenModalUserID);
                    var postData = {id:hiddenModalUserID,value:"approve"};
                    $.ajax({
                        url:"<?=base_url();?>Admin/assessment_list",
                        data:{
                            id:hiddenModalUserID,
                            value:"approve"
                        },
                        type:"POST",
                        success:function (output) {
                            var data = output.split("::");
                            if(data[0]=='OK'){
                                oTable ="";
                                //Initialize Select2 Elements
                                var regTableSelector = $("#regList");
                                var url_DT = "<?=base_url();?>Admin/assessments_list/listing";
                                var aoColumns_DT = [
                                    /* User ID */ {
                                        "mData": "UserID",
                                        "bVisible": true,
                                        "bSortable": true,
                                        "bSearchable": true
                                    },
                                    /* Full Name */ {
                                        "mData" : "FullName"
                                    },
                                    /* Email */ {
                                        "mData" : "Email"
                                    },
                                    /* Company */ {
                                        "mData" : "Company"
                                    },
                                    /*  Buisness */ {
                                        "mData" : "Business"
                                    },
                                    /* Last User Login */ {
                                        "mData": "Status"
                                    },
                                    /* Action Buttons */ {
                                        "mData" : "ViewEditActionButtons"
                                    }
                                ];
                                var HiddenColumnID_DT = "UserID";
                                var sDom_DT = '<"H"r>t<"F"<"row"<"col-lg-6 col-xs-12" i> <"col-lg-6 col-xs-12" p>>>';
                                commonDataTables(regTableSelector,url_DT,aoColumns_DT,sDom_DT,HiddenColumnID_DT);
                                $('.approval-modal').modal().hide();
                                $('body').removeClass('modal-open');
                                $('.modal-backdrop').remove();
                            }
                        }
                    });
                });

                $("#noPending").on("click",function () {
                    var hiddenModalUserID = $(this).parents(".modal-content").find("#hiddenUserID").val();
                    //console.log(hiddenModalUserID);
                    var postData = {id:hiddenModalUserID,value:"pending"};
                    $.ajax({
                        url:"<?=base_url();?>Admin/assessment_list",
                        data:{
                            id:hiddenModalUserID,
                            value:"pending"
                        },
                        type:"POST",
                        success:function (output) {
                            var data = output.split("::");
                            if(data[0]=='OK'){
                                oTable ="";
                                //Initialize Select2 Elements
                                var regTableSelector = $("#regList");
                                var url_DT = "<?=base_url();?>Admin/assessments_list/listing";
                                var aoColumns_DT = [
                                    /* User ID */ {
                                        "mData": "UserID",
                                        "bVisible": true,
                                        "bSortable": true,
                                        "bSearchable": true
                                    },
                                    /* Full Name */ {
                                        "mData" : "FullName"
                                    },
                                    /* Email */ {
                                        "mData" : "Email"
                                    },
                                    /* Company */ {
                                        "mData" : "Company"
                                    },
                                    /*  Buisness */ {
                                        "mData" : "Business"
                                    },
                                    /* Last User Login */ {
                                        "mData": "Status"
                                    },
                                    /* Action Buttons */ {
                                        "mData" : "ViewEditActionButtons"
                                    }
                                ];
                                var HiddenColumnID_DT = "UserID";
                                var sDom_DT = '<"H"r>t<"F"<"row"<"col-lg-6 col-xs-12" i> <"col-lg-6 col-xs-12" p>>>';
                                commonDataTables(regTableSelector,url_DT,aoColumns_DT,sDom_DT,HiddenColumnID_DT);
                                $('.approval-modal').modal().hide();
                                $('body').removeClass('modal-open');
                                $('.modal-backdrop').remove();
                            }
                        }
                    });
                });
            });
        </script>
<?php
    }
?>


<?php

    if($this->router->fetch_method() === 'manage_sectors'){
        ?>

        <script>
            $(function () {
                oTable ="";
                //Initialize Select2 Elements
                var regTableSelector = $("#sectorsList");
                var url_DT = "<?=base_url();?>Admin/manage_sectors/listing";
                var aoColumns_DT = [
                    /* ID */ {
                        "mData": "ID",
                        "bVisible": true,
                        "bSortable": true,
                        "bSearchable": true
                    },
                    /* Sector */ {
                        "mData" : "Sector"
                    },
                    /* Trashed */ {
                        "mData" : "Trashed"
                    },
                    /* Action Buttons */ {
                        "mData" : "ViewEditActionButtons"
                    }
                ];
                var HiddenColumnID_DT = "ID";
                var sDom_DT = '<"H"r>t<"F"<"row"<"col-lg-6 col-xs-12" i> <"col-lg-6 col-xs-12" p>>>';
                commonDataTables(regTableSelector,url_DT,aoColumns_DT,sDom_DT,HiddenColumnID_DT);

                //Code for search box
                $("#search-input").on("keyup",function (e) {
                    oTable.fnFilter( $(this).val());
                });

                $(".approval-modal").on("shown.bs.modal", function (e) {
                    var button = $(e.relatedTarget); // Button that triggered the modal
                    var ID = button.parents("tr").attr("data-id");
                    var sector = button.parents("tr").find('td').eq(1).text();
                    var modal = $(this);
                    modal.find("input#hiddenUserID").val(ID);
                    modal.find(".modal-body").find('p > strong').text(' "'+sector+'"');
                });

                $("#editSectorModal").on("shown.bs.modal", function (e) {
                    var button = $(e.relatedTarget); // Button that triggered the modal
                    var ID = button.parents("tr").attr("data-id");
                    var Sector = button.parents("tr").find('td').eq(1).text();
                    var modal = $(this);
                    modal.find("input#hiddenSectorID").val(ID);
                    modal.find("input#editSectorTextBox").val(Sector);
                });


                $("#yesDelete").on("click",function () {
                    var hiddenModalSectorID = $(this).parents(".modal-content").find("#hiddenUserID").val();
                    //console.log(hiddenModalUserID);
                    var postData = {id:hiddenModalSectorID,value:"approve"};
                    $.ajax({
                        url:"<?=base_url();?>Admin/manage_sectors/delete",
                        data:postData,
                        type:"POST",
                        success:function (output) {
                            var data = output.split("::");
                            if(data[0]=='OK'){
                                $(".approval-modal").modal('hide');
                                oTable.fnDraw();
                            }
                        }
                    });
                });

                $("#updateSectorBtn").on("click",function(){
                    var id = $(this).parents(".modal-content").find("#hiddenSectorID").val();
                    var sector = $(this).parents(".modal-content").find("#editSectorTextBox").val();

                    var postData = {
                        id: id,
                        sector: sector
                    };

                    $.ajax({
                        url:"<?=base_url()?>Admin/manage_sectors/update",
                        data:postData,
                        type:"POST",
                        success:function(output){
                            var data = output.split("::");

                            if(data[0] === "OK"){
                                $("#editSectorModal").modal('hide');
                                oTable.fnDraw();
                            }
                        }
                    });
                });
            });


        </script>

<?php
    }

?>



</body>
</html>