
<footer class="main-footer">
    <div class="pull-right hidden-xs">
    </div>
    <strong>Copyright &copy; 2000-2016 <a href="http://creativetech-solutions.com/">Creativetech-Solutions/</a>.</strong> All rights
    reserved.
</footer>

<!--Edit Ward Modal-->
<div class="modal approval-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Update Approval Status</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <input type="hidden" id="hiddenUserID">
                    <div class="col-md-12">
                        <p>Update the Pre-Assessment Approval Status?</p>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger mright" id="noPending">Pending</button>
                <button type="button" class="btn btn-success" id="yesApprove">Approve</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /.End Edit Ward Modal --><!-- /.modal -->

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
<script>

var baseUrl = "<?= base_url() ?>";
    
</script>

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
                var url_DT = baseUrl+"Admin/assessments_list/listing";
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

                //Some Action To Perform When Modal Is Shown.
                $(".approval-modal").on("shown.bs.modal", function (e) {
                    var button = $(e.relatedTarget); // Button that triggered the modal
                    var ID = button.parents("tr").attr("data-id");
                    var modal = $(this);
                    modal.find("input#hiddenUserID").val(ID);
                });

                $("#yesApprove").on("click",function () {
                    var hiddenModalUserID = $(this).parents(".modal-content").find("#hiddenUserID").val();
                    var postData = {id:hiddenModalUserID,value:"approve"};
                    $.ajax({
                        url:baseUrl+"Admin/assessment_list",
                        data:{
                            id:hiddenModalUserID,
                            value:"approve"
                        },
                        type:"POST",
                        success:function (output) {
                            var data = output.split("::");
                            if(data[0]=='OK'){
                                oTable.fnDraw();
                                $('.approval-modal').modal('hide');
                            }
                        }
                    });
                });

                $("#noPending").on("click",function () {
                    var hiddenModalUserID = $(this).parents(".modal-content").find("#hiddenUserID").val();
                    var postData = {id:hiddenModalUserID,value:"pending"};
                    $.ajax({
                        url:baseUrl+"Admin/assessment_list",
                        data:{
                            id:hiddenModalUserID,
                            value:"pending"
                        },
                        type:"POST",
                        success:function (output) {
                            var data = output.split("::");
                            if(data[0]=='OK'){
                                oTable.fnDraw();
                                $('.approval-modal').modal('hide');
                            }
                        }
                    });
                });
            });
        </script>
<?php
    }
    if($this->router->fetch_method() === 'manage_sectors'){
?>
        <script>
            $(function () {
                oTable ="";
                var regTableSelector = $("#sectorsList");
                var url_DT = baseUrl+"Admin/manage_sectors/listing";
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
                    var postData = {id:hiddenModalSectorID,value:"approve"};
                    $.ajax({
                        url:baseUrl+"Admin/manage_sectors/delete",
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
                        url:baseUrl+"Admin/manage_sectors/update",
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
       if($this->router->fetch_method() === 'manage_accelerators'){
?>
         <script>
            $(function () {
                oTable ="";
                var regTableSelector = $("#acceleratorsList");
                var url_DT = baseUrl+"Admin/manage_accelerators/listing";
                var aoColumns_DT = [
                    /* ID */ {
                        "mData": "ID",
                        "bVisible": true,
                        "bSortable": true,
                        "bSearchable": true
                    },
                    /* name */ {
                        "mData" : "Name"
                    },
                    /* website */ {
                        "mData" : "Website"
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
                    var name = button.parents("tr").find('td').eq(1).text();
                    var modal = $(this);
                    modal.find("input#hiddenUserID").val(ID);
                    modal.find(".modal-body").find('p > strong').text(' "'+name+'"');
                });

                $("#editAccelerationModal").on("shown.bs.modal", function (e) {
                    var button = $(e.relatedTarget); // Button that triggered the modal
                    var ID = button.parents("tr").attr("data-id");
                    var name = button.parents("tr").find('td').eq(1).text();
                    var web = button.parents("tr").find('td').eq(2).text();
                    var modal = $(this);
                    modal.find("input#hiddenAccelerationID").val(ID);
                    modal.find("input#editAccelerationTextBox").val(name);
                    modal.find("input#editAccelerationTextBoxWeb").val(web);
                });


                $("#yesDelete").on("click",function () {
                    var hiddenModalID = $(this).parents(".modal-content").find("#hiddenUserID").val();
                    var postData = {id:hiddenModalID,value:"approve"};
                    $.ajax({
                        url:baseUrl+"Admin/manage_accelerators/delete",
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
                    var id = $(this).parents(".modal-content").find("#hiddenID").val();
                    var name = $(this).parents(".modal-content").find("#editAccelerationTextBox").val();
                    var web = $(this).parents(".modal-content").find("#editAccelerationTextBoxWeb").val();
                    var postData = {
                        id: id,
                        web:web,
                        name: name
                    };
                    $.ajax({
                        url:baseUrl+"Admin/manage_accelerators/update",
                        data:postData,
                        type:"POST",
                        success:function(output){
                            var data = output.split("::");
                            if(data[0] === "OK"){
                                $("#editAccelerationModal").modal('hide');
                                oTable.fnDraw();
                            }
                        }
                    });
                });
            });
        </script>

<?php
    }
       if($this->router->fetch_method() === 'manage_universities'){
?>

        <script>
            $(function () {
                oTable ="";
                var regTableSelector = $("#universitiesList");
                var url_DT = baseUrl+"Admin/manage_universities/listing";
                var aoColumns_DT = [
                    /* ID */ {
                        "mData": "ID",
                        "bVisible": true,
                        "bSortable": true,
                        "bSearchable": true
                    },
                    /* University */ {
                        "mData" : "University"
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
                    var University = button.parents("tr").find('td').eq(1).text();
                    var modal = $(this);
                    modal.find("input#hiddenUserID").val(ID);
                    modal.find(".modal-body").find('p > strong').text(' "'+University+'"');
                });

                $("#editUniversitiesModal").on("shown.bs.modal", function (e) {
                    var button = $(e.relatedTarget); // Button that triggered the modal
                    var ID = button.parents("tr").attr("data-id");
                    var University = button.parents("tr").find('td').eq(1).text();
                    var modal = $(this);
                    modal.find("input#hiddenID").val(ID);
                    modal.find("input#editUniversitiesTextBox").val(University);
                });

                $("#yesApprove").on("click",function () {
                    var hiddenModalID = $(this).parents(".modal-content").find("#hiddenUserID").val();
                    var postData = {id:hiddenModalID,value:"approve"};
                    $.ajax({
                        url:baseUrl+"Admin/manage_universities/delete",
                        data: postData,
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

                $("#updateUniversitiesBtn").on("click",function(){
                    var id = $(this).parents(".modal-content").find("#hiddenID").val();
                    var University = $(this).parents(".modal-content").find("#editUniversitiesTextBox").val();
                    var postData = {
                        id: id,
                        University: University
                    };
                    $.ajax({
                        url:baseUrl+"Admin/manage_universities/update",
                        data:postData,
                        type:"POST",
                        success:function(output){
                            var data = output.split("::");
                            if(data[0] === "OK"){
                                $("#editUniversitiesModal").modal('hide');
                                oTable.fnDraw();
                            }
                        }
                    });
                });
            });


        </script>

<?php
    }
        if($this->router->fetch_method() === 'manage_acc_commercials'){
?>
        <script>
            $(function () {
                oTable ="";
                var regTableSelector = $("#acceleratorsList");
                var url_DT = baseUrl+"Admin/manage_acc_commercials/listing";
                var aoColumns_DT = [
                    /* ID */ {
                        "mData": "ID",
                        "bVisible": true,
                        "bSortable": true,
                        "bSearchable": true
                    },
                    /* Member */ {
                        "mData" : "Member"
                    },
                    /* Web_Address */ {
                        "mData" : "Web_Address"
                    },
                    /* State_Territory */ {
                        "mData" : "State_Territory"
                    },
                    /* Project_Location */ {
                        "mData" : "Project_Location"
                    },
                    /* Project_Title */ {
                        "mData" : "Project_Title"
                    },
                    /* Project_Summary */ {
                        "mData" : "Project_Summary"
                    },
                     /* Project_Success */ {
                        "mData" : "Project_Success"
                    },
                     /* Market */ {
                        "mData" : "Market"
                    },

                     /* Technology */ {
                        "mData" : "Technology"
                    },
                     /* Type */ {
                        "mData" : "Type"
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
                    var Member = button.parents("tr").find('td').eq(1).text();
                    var modal = $(this);
                    modal.find("input#hiddenUserID").val(ID);
                    modal.find(".modal-body").find('p > strong').text(' "'+Member+'"');
                });

                $("#editAccelerationModal").on("shown.bs.modal", function (e) {
                    var button = $(e.relatedTarget); // Button that triggered the modal
                    var ID = button.parents("tr").attr("data-id");
                    var Member = button.parents("tr").find('td').eq(1).text();
                    var modal = $(this);
                    modal.find("input#hiddenSectorID").val(ID);
                    modal.find("input#editSectorTextBox").val(Member);
                });


                $("#yesDelete").on("click",function () {
                    var hiddenModalID = $(this).parents(".modal-content").find("#hiddenUserID").val();
                    var postData = {id:hiddenModalID,value:"approve"};
                    $.ajax({
                        url:baseUrl+"Admin/manage_acc_commercials/delete",
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
                    var id = $(this).parents(".modal-content").find("#hiddenID").val();
                    var sector = $(this).parents(".modal-content").find("#editAccelerationTextBox").val();
                    var postData = {
                        id: id,
                        sector: sector
                    };
                    $.ajax({
                        url:baseUrl+"Admin/manage_acc_commercials/update",
                        data:postData,
                        type:"POST",
                        success:function(output){
                            var data = output.split("::");
                            if(data[0] === "OK"){
                                $("#editAccelerationModal").modal('hide');
                                oTable.fnDraw();
                            }
                        }
                    });
                });
            });
        </script>
<?php } 
        if($this->router->fetch_method() === 'details'){ 
?>
        <script>
            $(function () {
                $("body").on("click",".save-answer",function(e){

                    e.preventDefault();
                    var id = $(this).attr('data-id');
                    var Answervalue = $('.'+id+' select').val();
                    var ansDiv = $('.'+id+' .edit-question');
                    var dataQuestionId = $(this).attr('data-question-id');
                    var userID = $('#profile-box-container').attr('data-user-id');
                    var answerDiv = $('.'+id+' .answer-solution');
                    var scoreDiv = $('.'+id+' .question-points');
                    var barDiv = $('.progress .question-bar span');
                    var oldScore = scoreDiv.attr('data-score');

                    var postData = {
                        id: id,
                        userID:userID,
                        dataQuestionId: dataQuestionId,
                        Answervalue,Answervalue,
                        oldScore:oldScore
                    };
                    $.ajax({
                        url:baseUrl+"Admin/saveanswer",
                        data:postData,
                        type:"POST",
                        success:function(output){
                         var data = output.split("::");
                         if(data[0] === "OK"){
                            ansDiv.hide();
                            answerDiv.text(Answervalue);
                            scoreDiv.text(data[1]);
                            barDiv.text(data[2]);
                            barDiv.parent().css('width', data[2]+'%');
                         }
                        }
                    });
                });
                
                $(".question-edit").on("click",function(event){
                    event.preventDefault();
                    var id = $(this).attr('data-id');
                    var select = $('.'+id+' select');
                    var ansDiv = $('.'+id+' .edit-question');
                    var dataQuestionId = $(this).attr('data-question-id');
                    var saveBtn = $('.'+id+' .save-answer');


                    var postData = {
                        id: id,
                        dataQuestionId: dataQuestionId
                    };
                    saveBtn.parent().remove();
                    $.ajax({
                        url:baseUrl+"Admin/getanswers",
                        data:postData,
                        type:"POST",
                        success:function(output){
                          var data = $.parseJSON(output);
                           select.html('');
                            $.each(data, function (index, value) {
                                select.append('<option value="'+value.solution+'">'+value.solution+'</option>');
                            });
                            select.parent().append('<div class="question-action-buttons"><button class="save-answer" data-question-id="'+dataQuestionId+'" data-id="'+id+'">Save</button></div>');
                            ansDiv.show();
                        }
                    });
                });
            });


        </script>
<?php } ?>
</body>
</html>