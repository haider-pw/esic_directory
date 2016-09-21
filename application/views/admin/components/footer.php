
<footer class="main-footer">
    <div class="pull-right hidden-xs">
    </div>
    <strong>Powered By <a href="http://creativetech-solutions.com/" target="_blank">Creativetech-Solutions</a>.</strong>
</footer>

<?php
    if($this->router->fetch_method() === 'assessments_list' || $this->router->fetch_method() === 'details'){
?>

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

<!--Edit Ward Modal-->
<div class="modal delete-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Deleted Status</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <input type="hidden" id="hiddenUserID">
                    <div class="col-md-12">
                        <p>Are You Sure To Delete This Entry?</p>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger mright" data-dismiss="modal" aria-label="Close" id="nodelete">No</button>
                <button type="button" class="btn btn-success" id="yesDelete">Yes</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /.End Edit Ward Modal --><!-- /.modal -->


<?php
    }else{
?>

<!--Edit Ward Modal-->
<div class="modal approval-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Trashed Model</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <input type="hidden" id="hiddenUserID">
                    <div class="col-md-12">
                        <p>Do You Want To Trash This Status?</p>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal" aria-label="Close" id="permanentDelete">Delete Permanent</button>
                <button type="button" class="btn btn-success" id="yesApprove">Yes</button>
                <button type="button" class="btn btn-danger mright" data-dismiss="modal" aria-label="Close" id="nodelete">No</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /.End Edit Ward Modal --><!-- /.modal -->


<?php
    }
?>



    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/bootstrap.jasny/3.13/css/jasny-bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />



<!-- jQuery 2.2.3 -->
<script src="<?= base_url()?>assets/vendors/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?= base_url()?>assets/vendors/bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?= base_url()?>assets/vendors/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url()?>assets/vendors/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?= base_url()?>assets/vendors/datatables/dataTables.responsive.js"></script>
<!-- SlimScroll -->
<script src="<?= base_url()?>assets/vendors/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?= base_url()?>assets/vendors/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url()?>assets/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url()?>assets/js/demo.js"></script>
<script src="<?= base_url()?>assets/js/customScripting.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/bootstrap.jasny/3.13/js/jasny-bootstrap.min.js"></script>
<!--script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.fileupload/9.9.0/js/jquery.fileupload.js"></script-->

<script>

var baseUrl = "<?= base_url() ?>";
    
</script>

<?php
if ($this->router->fetch_method() === 'assessments_list' or $this->router->fetch_method() === 'index') {
    ?>

    <!-- page script -->
    <script>
        $(function () {
            //// Need To Work ON New Way Of DataTables..
            oTable = "";
            //Initialize Select2 Elements
            var regTableSelector = $("#regList");
            var url_DT = baseUrl + "Admin/assessments_list/listing";
            var aoColumns_DT = [
                /* User ID */ {
                    "mData": "UserID",
                    "bVisible": true,
                    "bSortable": true,
                    "bSearchable": true
                },
                /* Full Name */ {
                    "mData": "FullName"
                },
                /* Email */ {
                    "mData": "Email"
                },
                /* Company */ {
                    "mData": "Company"
                },
                /*  Buisness */ {
                    "mData": "Business"
                },
                /* Last User Login */ {
                    "mData": "Status"
                },
                /* Action Buttons */ {
                    "mData": "ViewEditActionButtons"
                }
            ];
            var HiddenColumnID_DT = "UserID";
            var sDom_DT = '<"H"r>t<"F"<"row"<"col-lg-6 col-xs-12" i> <"col-lg-6 col-xs-12" p>>>';
            commonDataTables(regTableSelector, url_DT, aoColumns_DT, sDom_DT, HiddenColumnID_DT);

            new $.fn.dataTable.Responsive(oTable, {
                details: true
            });
            removeWidth(oTable);

            //Code for search box
            $("#search-input").on("keyup", function (e) {
                oTable.fnFilter($(this).val());
            });

            //Some Action To Perform When Modal Is Shown.
            $(".approval-modal").on("shown.bs.modal", function (e) {
                var button = $(e.relatedTarget); // Button that triggered the modal
                var ID = button.parents("tr").attr("data-id");
                var modal = $(this);
                modal.find("input#hiddenUserID").val(ID);
            });

            $("#yesApprove").on("click", function () {
                var hiddenModalUserID = $(this).parents(".modal-content").find("#hiddenUserID").val();
                if (hiddenModalUserID == '') {
                    hiddenModalUserID = $(this).attr('data-id');
                }
                var postData = {id: hiddenModalUserID, value: "approve"};
                $.ajax({
                    url: baseUrl + "Admin/assessment_list",
                    data: {
                        id: hiddenModalUserID,
                        value: "approve"
                    },
                    type: "POST",
                    success: function (output) {
                        var data = output.split("::");
                        if (data[0] == 'OK') {
                            oTable.fnDraw();
                            $('.approval-modal').modal('hide');
                        }
                    }
                });
            });
            $("#noPending").on("click", function () {
                var hiddenModalUserID = $(this).parents(".modal-content").find("#hiddenUserID").val();
                if (hiddenModalUserID == '') {
                    hiddenModalUserID = $(this).attr('data-id');
                }
                var postData = {id: hiddenModalUserID, value: "pending"};
                $.ajax({
                    url: baseUrl + "Admin/assessment_list",
                    data: {
                        id: hiddenModalUserID,
                        value: "pending"
                    },
                    type: "POST",
                    success: function (output) {
                        var data = output.split("::");
                        if (data[0] == 'OK') {
                            oTable.fnDraw();
                            $('.approval-modal').modal('hide');
                        }
                    }
                });
            });

            $("#nodelete").on("click", function () {
                var hiddenModalUserID = $(this).parents(".modal-content").find("#hiddenUserID").val();
                if (hiddenModalUserID == '') {
                    hiddenModalUserID = $(this).attr('data-id');
                }
                var postData = {id: hiddenModalUserID, value: "delete"};
                $.ajax({
                    url: baseUrl + "Admin/assessment_list",
                    data: {
                        id: hiddenModalUserID,
                        value: "delete"
                    },
                    type: "POST",
                    success: function (output) {
                        var data = output.split("::");
                        if (data[0] == 'OK') {
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
if( $this->router->fetch_method() === 'details'){
?>
    <script type="text/javascript">
        $(function(){
            //Some Action To Perform When Modal Is Shown.
            $(".approval-modal").on("shown.bs.modal", function (e) {
                var button = $(e.relatedTarget); // Button that triggered the modal
                var ID = button.attr("data-id");
                var modal = $(this);
                modal.find("input#hiddenUserID").val(ID);
            });

            $("#yesApprove").on("click", function () {
                var hiddenModalUserID = $(this).parents(".modal-content").find("#hiddenUserID").val();
                if (hiddenModalUserID == '') {
                    hiddenModalUserID = $(this).attr('data-id');
                }
                var postData = {id: hiddenModalUserID, value: "approve"};
                $.ajax({
                    url: baseUrl + "Admin/assessment_list",
                    data: {
                        id: hiddenModalUserID,
                        value: "approve"
                    },
                    type: "POST",
                    success: function (output) {
                        var data = output.split("::");
                        if (data[0] == 'OK') {
                            window.location.href = "<?=base_url()?>Admin/assessments_list";
                        }
                    }
                });
            });
            $("#noPending").on("click", function () {
                var hiddenModalUserID = $(this).parents(".modal-content").find("#hiddenUserID").val();
                if (hiddenModalUserID == '') {
                    hiddenModalUserID = $(this).attr('data-id');
                }
                var postData = {id: hiddenModalUserID, value: "pending"};
                $.ajax({
                    url: baseUrl + "Admin/assessment_list",
                    data: {
                        id: hiddenModalUserID,
                        value: "pending"
                    },
                    type: "POST",
                    success: function (output) {
                        var data = output.split("::");
                        if (data[0] == 'OK') {
                            window.location.href = "<?=base_url()?>Admin/assessments_list";
                        }
                    }
                });
            });
        });
    </script>
    <?php
}
if ($this->router->fetch_method() === 'manage_sectors') {
    ?>
    <script>
        $(function () {
            oTable = "";
            var regTableSelector = $("#sectorsList");
            var url_DT = baseUrl + "Admin/manage_sectors/listing";
            var aoColumns_DT = [
                /* ID */ {
                    "mData": "ID",
                    "bVisible": true,
                    "bSortable": true,
                    "bSearchable": true
                },
                /* Sector */ {
                    "mData": "Sector"
                },
                /* Trashed */ {
                    "mData": "Trashed"
                },
                /* Action Buttons */ {
                    "mData": "ViewEditActionButtons"
                }
            ];
            var HiddenColumnID_DT = "ID";
            var sDom_DT = '<"H"r>t<"F"<"row"<"col-lg-6 col-xs-12" i> <"col-lg-6 col-xs-12" p>>>';
            commonDataTables(regTableSelector, url_DT, aoColumns_DT, sDom_DT, HiddenColumnID_DT);

            new $.fn.dataTable.Responsive(oTable, {
                details: true
            });
            removeWidth(oTable);

            //Code for search box
            $("#search-input").on("keyup", function (e) {
                oTable.fnFilter($(this).val());
            });

            $(".approval-modal").on("shown.bs.modal", function (e) {
                var button = $(e.relatedTarget); // Button that triggered the modal
                var ID = button.parents("tr").attr("data-id");
                var sector = button.parents("tr").find('td').eq(1).text();
                var modal = $(this);
                modal.find("input#hiddenUserID").val(ID);
                modal.find(".modal-body").find('p > strong').text(' "' + sector + '"');
            });

            $("#editSectorModal").on("shown.bs.modal", function (e) {
                var button = $(e.relatedTarget); // Button that triggered the modal
                var ID = button.parents("tr").attr("data-id");
                var Sector = button.parents("tr").find('td').eq(1).text();
                var modal = $(this);
                modal.find("input#hiddenSectorID").val(ID);
                modal.find("input#editSectorTextBox").val(Sector);
            });


            $("#yesApprove").on("click", function () {
                var hiddenModalSectorID = $(this).parents(".modal-content").find("#hiddenUserID").val();
                var postData = {id: hiddenModalSectorID, value: "trash"};
                $.ajax({
                    url: baseUrl + "Admin/manage_sectors/trash",
                    data: postData,
                    type: "POST",
                    success: function (output) {
                        var data = output.split("::");
                        if (data[0] == 'OK') {
                            $(".approval-modal").modal('hide');
                            oTable.fnDraw();
                        }
                    }
                });
            });
            $("#permanentDelete").on("click", function () {
                var hiddenModalID = $(this).parents(".modal-content").find("#hiddenUserID").val();
                var postData = {id: hiddenModalID, value: "delete"};
                $.ajax({
                    url: baseUrl + "Admin/manage_sectors/delete",
                    data: postData,
                    type: "POST",
                    success: function (output) {
                        var data = output.split("::");
                        if (data[0] == 'OK') {
                            $(".approval-modal").modal('hide');
                            oTable.fnDraw();
                        }
                    }
                });
            });
            $("#nodelete").on("click", function () {
                var hiddenModalUserID = $(this).parents(".modal-content").find("#hiddenUserID").val();
                var postData = {id: hiddenModalUserID, value: "untrash"};
                $.ajax({
                    url: baseUrl + "Admin/manage_sectors/trash",
                    data: {
                        id: hiddenModalUserID,
                        value: "untrash"
                    },
                    type: "POST",
                    success: function (output) {
                        var data = output.split("::");
                        if (data[0] == 'OK') {
                            oTable.fnDraw();
                            $('.approval-modal').modal('hide');
                        }
                    }
                });
            });

            $("#updateSectorBtn").on("click", function () {
                var id = $(this).parents(".modal-content").find("#hiddenSectorID").val();
                var sector = $(this).parents(".modal-content").find("#editSectorTextBox").val();
                var postData = {
                    id: id,
                    sector: sector
                };
                $.ajax({
                    url: baseUrl + "Admin/manage_sectors/update",
                    data: postData,
                    type: "POST",
                    success: function (output) {
                        var data = output.split("::");
                        if (data[0] === "OK") {
                            $("#editSectorModal").modal('hide');
                            oTable.fnDraw();
                        }
                    }
                });
            });

            $("#addSectorBtn").on("click", function () {
                var sector = $(this).parents(".modal-content").find("#addSectorTextBox").val();
                var postData = {
                    sector: sector
                };
                $.ajax({
                    url: baseUrl + "Admin/manage_sectors/new",
                    data: postData,
                    type: "POST",
                    success: function (output) {
                        var data = output.split("::");
                        if (data[0] === "OK") {
                            $(".addNewModal").modal('hide');
                            oTable.fnDraw();
                        }
                    }
                });
            });
        });
    </script>
    <?php
}
if ($this->router->fetch_method() === 'manage_rd') {
    ?>
    <script>
        $(function () {
            oTable = "";
            var regTableSelector = $("#RnDList");
            var url_DT = baseUrl + "Admin/manage_rd/listing";
            var aoColumns_DT = [
                /* ID */ {
                    "mData": "ID",
                    "bVisible": true,
                    "bSortable": true,
                    "bSearchable": true
                },
                /* name */ {
                    "mData": "rndname"
                },
                /* IDNumber */ {
                    "mData": "IDNumber"
                },
                /* AddressContact */ {
                    "mData": "AddressContact"
                },
                /* ANZSRC */ {
                    "mData": "ANZSRC"
                },
                /* Trashed */ {
                    "mData": "Trashed"
                },
                /* Action Buttons */ {
                    "mData": "ViewEditActionButtons"
                }

            ];
            var HiddenColumnID_DT = "ID";
            var sDom_DT = '<"H"r>t<"F"<"row"<"col-lg-6 col-xs-12" i> <"col-lg-6 col-xs-12" p>>>';
            commonDataTables(regTableSelector, url_DT, aoColumns_DT, sDom_DT, HiddenColumnID_DT);


            new $.fn.dataTable.Responsive(oTable, {
                details: true
            });
            removeWidth(oTable);

            //Code for search box
            $("#search-input").on("keyup", function (e) {
                oTable.fnFilter($(this).val());
            });

            $(".approval-modal").on("shown.bs.modal", function (e) {
                var button = $(e.relatedTarget); // Button that triggered the modal
                var ID = button.parents("tr").attr("data-id");
                var name = button.parents("tr").find('td').eq(1).text();
                var modal = $(this);
                modal.find("input#hiddenUserID").val(ID);
                modal.find(".modal-body").find('p > strong').text(' "' + name + '"');
            });

            $("#editRndModal").on("shown.bs.modal", function (e) {
                var button = $(e.relatedTarget); // Button that triggered the modal
                var ID = button.parents("tr").attr("data-id");
                var name = button.parents("tr").find('td').eq(1).text();
                var idNumber = button.parents("tr").find('td').eq(2).text();
                var addressContact = button.parents("tr").find('td').eq(3).text();
                var anzsrc = button.parents("tr").find('td').eq(4).text();
                var modal = $(this);
                modal.find("input#hiddenRndID").val(ID);
                modal.find("input#editrndTextBox").val(name);
                modal.find("input#editrndTextBoxIdNumber").val(idNumber);
                modal.find("input#editrndTextBoxAddressContact").val(addressContact);
                modal.find("input#editrndTextBoxAnzsrc").val(anzsrc);
            });


            $("#yesApprove").on("click", function () {
                var hiddenModalID = $(this).parents(".modal-content").find("#hiddenUserID").val();
                var postData = {id: hiddenModalID, value: "approve"};
                $.ajax({
                    url: baseUrl + "Admin/manage_rd/delete",
                    data: postData,
                    type: "POST",
                    success: function (output) {
                        var data = output.split("::");
                        if (data[0] == 'OK') {
                            $(".approval-modal").modal('hide');
                            oTable.fnDraw();
                        }
                    }
                });
            });

            $("#updateRnDBtn").on("click", function () {
                var id = $(this).parents(".modal-content").find("#hiddenRndID").val();
                var name = $(this).parents(".modal-content").find("#editrndTextBox").val();
                var idNumber = $(this).parents(".modal-content").find("#editrndTextBoxIdNumber").val();
                var addressContact = $(this).parents(".modal-content").find("#editrndTextBoxAddressContact").val();
                var anzsrc = $(this).parents(".modal-content").find("#editrndTextBoxAnzsrc").val();
                var postData = {
                    id: id,
                    rndname: name,
                    IDNumber: idNumber,
                    AddressContact: addressContact,
                    ANZSRC: anzsrc
                };
                $.ajax({
                    url: baseUrl + "Admin/manage_rd/update",
                    data: postData,
                    type: "POST",
                    success: function (output) {
                        var data = output.split("::");
                        if (data[0] === "OK") {
                            $("#editRndModal").modal('hide');
                            oTable.fnDraw();
                        }
                    }
                });
            });
        });
    </script>

    <?php
}
if ($this->router->fetch_method() === 'manage_accelerators') {
    ?>
    <script>
        $(function () {
            oTable = "";
            var regTableSelector = $("#acceleratorsList");
            var url_DT = baseUrl + "Admin/manage_accelerators/listing";
            var aoColumns_DT = [
                /* ID */ {
                    "mData": "ID",
                    "bVisible": true,
                    "bSortable": true,
                    "bSearchable": true
                },
                /* name */ {
                    "mData": "Name"
                },
                /* website */ {
                    "mData": "Website"
                },
                /* Trashed */ {
                    "mData": "Trashed"
                },
                /* Action Buttons */ {
                    "mData": "ViewEditActionButtons"
                }

            ];
            var HiddenColumnID_DT = "ID";
            var sDom_DT = '<"H"r>t<"F"<"row"<"col-lg-6 col-xs-12" i> <"col-lg-6 col-xs-12" p>>>';
            commonDataTables(regTableSelector, url_DT, aoColumns_DT, sDom_DT, HiddenColumnID_DT);


            new $.fn.dataTable.Responsive(oTable, {
                details: true
            });
            removeWidth(oTable);

            //Code for search box
            $("#search-input").on("keyup", function (e) {
                oTable.fnFilter($(this).val());
            });

            $(".approval-modal").on("shown.bs.modal", function (e) {
                var button = $(e.relatedTarget); // Button that triggered the modal
                var ID = button.parents("tr").attr("data-id");
                var name = button.parents("tr").find('td').eq(1).text();
                var modal = $(this);
                modal.find("input#hiddenUserID").val(ID);
                modal.find(".modal-body").find('p > strong').text(' "' + name + '"');
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


            $("#yesApprove").on("click", function () {
                var hiddenModalID = $(this).parents(".modal-content").find("#hiddenUserID").val();
                var postData = {id: hiddenModalID, value: "approve"};
                $.ajax({
                    url: baseUrl + "Admin/manage_accelerators/delete",
                    data: postData,
                    type: "POST",
                    success: function (output) {
                        var data = output.split("::");
                        if (data[0] == 'OK') {
                            $(".approval-modal").modal('hide');
                            oTable.fnDraw();
                        }
                    }
                });
            });

            $("#updateAccelerationBtn").on("click", function () {
                var id = $(this).parents(".modal-content").find("#hiddenAccelerationID").val();
                var name = $(this).parents(".modal-content").find("#editAccelerationTextBox").val();
                var web = $(this).parents(".modal-content").find("#editAccelerationTextBoxWeb").val();
                var postData = {
                    id: id,
                    web: web,
                    name: name
                };
                $.ajax({
                    url: baseUrl + "Admin/manage_accelerators/update",
                    data: postData,
                    type: "POST",
                    success: function (output) {
                        var data = output.split("::");
                        if (data[0] === "OK") {
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
if ($this->router->fetch_method() === 'manage_universities') {
    ?>

    <script>
        $(function () {
            oTable = "";
            var regTableSelector = $("#universitiesList");
            var url_DT = baseUrl + "Admin/manage_universities/listing";
            var aoColumns_DT = [
                /* ID */ {
                    "mData": "ID",
                    "bVisible": true,
                    "bSortable": true,
                    "bSearchable": true
                },
                /* University */ {
                    "mData": "University"
                },
                /* Trashed */ {
                    "mData": "Trashed"
                },
                /* Action Buttons */ {
                    "mData": "ViewEditActionButtons"
                }
            ];
            var HiddenColumnID_DT = "ID";
            var sDom_DT = '<"H"r>t<"F"<"row"<"col-lg-6 col-xs-12" i> <"col-lg-6 col-xs-12" p>>>';
            commonDataTables(regTableSelector, url_DT, aoColumns_DT, sDom_DT, HiddenColumnID_DT);


            new $.fn.dataTable.Responsive(oTable, {
                details: true
            });
            removeWidth(oTable);

            //Code for search box
            $("#search-input").on("keyup", function (e) {
                oTable.fnFilter($(this).val());
            });

            $(".approval-modal").on("shown.bs.modal", function (e) {
                var button = $(e.relatedTarget); // Button that triggered the modal
                var ID = button.parents("tr").attr("data-id");
                var University = button.parents("tr").find('td').eq(1).text();
                var modal = $(this);
                modal.find("input#hiddenUserID").val(ID);
                modal.find(".modal-body").find('p > strong').text(' "' + University + '"');
            });

            $("#editUniversitiesModal").on("shown.bs.modal", function (e) {
                var button = $(e.relatedTarget); // Button that triggered the modal
                var ID = button.parents("tr").attr("data-id");
                var University = button.parents("tr").find('td').eq(1).text();
                var modal = $(this);
                modal.find("input#hiddenID").val(ID);
                modal.find("input#editUniversitiesTextBox").val(University);
            });

            $("#yesApprove").on("click", function () {
                var hiddenModalID = $(this).parents(".modal-content").find("#hiddenUserID").val();
                var postData = {id: hiddenModalID, value: "trash"};
                $.ajax({
                    url: baseUrl + "Admin/manage_universities/trash",
                    data: postData,
                    type: "POST",
                    success: function (output) {
                        var data = output.split("::");
                        if (data[0] == 'OK') {
                            $(".approval-modal").modal('hide');
                            oTable.fnDraw();
                        }
                    }
                });
            });

            $("#permanentDelete").on("click", function () {
                var hiddenModalID = $(this).parents(".modal-content").find("#hiddenUserID").val();
                var postData = {id: hiddenModalID, value: "delete"};
                $.ajax({
                    url: baseUrl + "Admin/manage_universities/delete",
                    data: postData,
                    type: "POST",
                    success: function (output) {
                        var data = output.split("::");
                        if (data[0] == 'OK') {
                            $(".approval-modal").modal('hide');
                            oTable.fnDraw();
                        }
                    }
                });
            });

            $("#nodelete").on("click", function () {
                var hiddenModalUserID = $(this).parents(".modal-content").find("#hiddenUserID").val();
                var postData = {id: hiddenModalUserID, value: "untrash"};
                $.ajax({
                    url: baseUrl + "Admin/manage_universities/trash",
                    data: {
                        id: hiddenModalUserID,
                        value: "untrash"
                    },
                    type: "POST",
                    success: function (output) {
                        var data = output.split("::");
                        if (data[0] == 'OK') {
                            oTable.fnDraw();
                            $('.approval-modal').modal('hide');
                        }
                    }
                });
            });

            $("#updateUniversitiesBtn").on("click", function () {
                var id = $(this).parents(".modal-content").find("#hiddenID").val();
                var University = $(this).parents(".modal-content").find("#editUniversitiesTextBox").val();
                var postData = {
                    id: id,
                    University: University
                };
                $.ajax({
                    url: baseUrl + "Admin/manage_universities/update",
                    data: postData,
                    type: "POST",
                    success: function (output) {
                        var data = output.split("::");
                        if (data[0] === "OK") {
                            $("#editUniversitiesModal").modal('hide');
                            oTable.fnDraw();
                        }
                    }
                });
            });
            $("#addUniversityBtn").on("click", function () {
                var University = $(this).parents(".modal-content").find("#addUniversityTextBox").val();
                var postData = {
                    University: University
                };
                $.ajax({
                    url: baseUrl + "Admin/manage_universities/new",
                    data: postData,
                    type: "POST",
                    success: function (output) {
                        var data = output.split("::");
                        if (data[0] === "OK") {
                            $(".addNewModal").modal('hide');
                            oTable.fnDraw();
                        }
                    }
                });
            });
        });


    </script>

    <?php
}
if ($this->router->fetch_method() === 'manage_acc_commercials') {
    ?>
    <script>
        $(function () {
            oTable = "";
            var regTableSelector = $("#acceleratorsList");
            var url_DT = baseUrl + "Admin/manage_acc_commercials/listing";
            var aoColumns_DT = [
                /* ID */ {
                    "mData": "ID",
                    "bVisible": true,
                    "bSortable": true,
                    "bSearchable": true
                },
                /* Member */ {
                    "mData": "Member"
                },
                /* Web_Address */ {
                    "mData": "Web_Address"
                },
                {
                    "mData": "Project_Title"
                },
                /*
                 {
                 "mData" : "State_Territory"
                 },
                 {
                 "mData" : "Project_Location"
                 },
                 {
                 "mData" : "Project_Title"
                 },
                 {
                 "mData" : "Project_Summary"
                 },
                 {
                 "mData" : "Project_Success"
                 },
                 {
                 "mData" : "Market"
                 },
                 {
                 "mData" : "Technology"
                 },
                 {
                 "mData" : "Type"
                 },
                 */
                {
                    "mData": "Trashed"
                },
                {
                    "mData": "ViewEditActionButtons"
                }
            ];
            var HiddenColumnID_DT = "ID";
            var sDom_DT = '<"H"r>t<"F"<"row"<"col-lg-6 col-xs-12" i> <"col-lg-6 col-xs-12" p>>>';
            commonDataTables(regTableSelector, url_DT, aoColumns_DT, sDom_DT, HiddenColumnID_DT);


            new $.fn.dataTable.Responsive(oTable, {
                details: true
            });
            removeWidth(oTable);

            //Code for search box
            $("#search-input").on("keyup", function (e) {
                oTable.fnFilter($(this).val());
            });

            $(".approval-modal").on("shown.bs.modal", function (e) {
                var button = $(e.relatedTarget); // Button that triggered the modal
                var ID = button.parents("tr").attr("data-id");
                var Member = button.parents("tr").find('td').eq(1).text();
                var modal = $(this);
                modal.find("input#hiddenUserID").val(ID);
                modal.find(".modal-body").find('p > strong').text(' "' + Member + '"');
            });

            $("#editAccelerationModal").on("shown.bs.modal", function (e) {
                var button = $(e.relatedTarget); // Button that triggered the modal
                var ID = button.parents("tr").attr("data-id");
                var Member = button.parents("tr").find('td').eq(1).text();
                var modal = $(this);
                modal.find("input#hiddenSectorID").val(ID);
                modal.find("input#editSectorTextBox").val(Member);
            });


            $("#yesApprove").on("click", function () {
                var hiddenModalID = $(this).parents(".modal-content").find("#hiddenUserID").val();
                var postData = {id: hiddenModalID, value: "approve"};
                $.ajax({
                    url: baseUrl + "Admin/manage_acc_commercials/delete",
                    data: postData,
                    type: "POST",
                    success: function (output) {
                        var data = output.split("::");
                        if (data[0] == 'OK') {
                            $(".approval-modal").modal('hide');
                            oTable.fnDraw();
                        }
                    }
                });
            });

            $("#updateAccelerationBtn").on("click", function () {
                var id = $(this).parents(".modal-content").find("#hiddenSectorID").val();
                var sector = $(this).parents(".modal-content").find("#editAccelerationTextBox").val();
                var postData = {
                    id: id,
                    sector: sector
                };
                $.ajax({
                    url: baseUrl + "Admin/manage_acc_commercials/update",
                    data: postData,
                    type: "POST",
                    success: function (output) {
                        var data = output.split("::");
                        if (data[0] === "OK") {
                            $("#editAccelerationModal").modal('hide');
                            oTable.fnDraw();
                        }
                    }
                });
            });
        });
    </script>
<?php }
if ($this->router->fetch_method() === 'details') {
    ?>
    <script>
        $(function () {
            $("body").on("click", ".save-answer", function (e) {

                e.preventDefault();
                var id = $(this).attr('data-id');
                var Answervalue = $('.' + id + ' select').val();
                var ansDiv = $('.' + id + ' .edit-question');
                var dataQuestionId = $(this).attr('data-question-id');
                var userID = $('#profile-box-container').attr('data-user-id');
                var answerDiv = $('.' + id + ' .answer-solution');
                var scoreDiv = $('.' + id + ' .question-points');
                var barDiv = $('.progress .question-bar span');
                var oldScore = scoreDiv.attr('data-score');

                var postData = {
                    id: id,
                    userID: userID,
                    dataQuestionId: dataQuestionId,
                    Answervalue, Answervalue,
                    oldScore: oldScore
                };
                $.ajax({
                    url: baseUrl + "Admin/saveanswer",
                    data: postData,
                    type: "POST",
                    success: function (output) {
                        var data = output.split("::");
                        if (data[0] === "OK") {
                            ansDiv.hide();
                            answerDiv.text(Answervalue);
                            scoreDiv.text(data[1]);
                            barDiv.text(data[2]);
                            barDiv.parent().css('width', data[2] + '%');
                        }
                    }
                });
            });

            $(".question-edit").on("click", function (event) {
                event.preventDefault();
                var id = $(this).attr('data-id');
                var select = $('.' + id + ' select');
                var ansDiv = $('.' + id + ' .edit-question');
                var dataQuestionId = $(this).attr('data-question-id');
                var saveBtn = $('.' + id + ' .save-answer');


                var postData = {
                    id: id,
                    dataQuestionId: dataQuestionId
                };
                saveBtn.parent().remove();
                $.ajax({
                    url: baseUrl + "Admin/getanswers",
                    data: postData,
                    type: "POST",
                    success: function (output) {
                        var data = $.parseJSON(output);
                        select.html('');
                        $.each(data, function (index, value) {
                            select.append('<option value="' + value.solution + '">' + value.solution + '</option>');
                        });
                        select.parent().append('<div class="question-action-buttons"><button class="save-answer" data-question-id="' + dataQuestionId + '" data-id="' + id + '">Save</button></div>');
                        ansDiv.show();
                    }
                });
            });
            $("#desc-edit").on("click", function (event) {
                event.preventDefault();
                var userId = $(this).attr('data-user-id');
                var textArea = $('#desc-textarea');
                var ansDiv = $('.edit-desc');
                var saveBtn = $('#save-desc');
                var descText = $('#desc-text pre');
                ansDiv.show();
                descText.hide();
                var descDataText = descText.text();
                descText.text('');
                textArea.val($.trim(descDataText));
                ansDiv.children('.form-group').append('<div class="question-action-buttons"><button id="save-desc" data-user-id="'+userId+'" class="save-desc">Save</button></div>');
                $(this).hide();
                
              
            });
            $("body").on("click", ".save-desc", function (e) {
                e.preventDefault();
                var userId = $(this).attr('data-user-id');
                var textArea = $('#desc-textarea');
                var ansDiv = $('.edit-desc');
                var saveBtn = $('#save-desc');
                var descText = $('#desc-text pre');
                var descDataText = $.trim(textArea.val());
                var postData = {
                    userID: userId,
                    descDataText: descDataText
                };
                saveBtn.parent().remove();
                $.ajax({
                    url: baseUrl + "Admin/savedesc",
                    data: postData,
                    type: "POST",
                    success: function(output) {
                       var data = output.split("::");
                       if (data[0] === "OK") {
	                        console.log(output);
	                        descText.text(data[1]);
	                        ansDiv.hide();
	                        $('#desc-edit').show();
	                        descText.show();
	                    }
                    }
                });
              
            });
            $("body").on("click", ".date-edit", function (e) {
                e.preventDefault();
                var userId = $('#profile-box-container').attr('data-user-id');
                var dateType = $(this).attr('data-date-type');
                var dateValue = $(this).attr('data-date-value');
                // DateEditModal
                
              
            });

            $('.DateEditModal').on('shown.bs.modal',function(e){
            	var relatedPencil = e.relatedTarget;
            	var userId = $('#profile-box-container').attr('data-user-id');
                var dateType = $(relatedPencil).attr('data-date-type');
                var dateTitle = $(relatedPencil).attr('data-date-title');
                var dateValue = $(relatedPencil).attr('data-date-value');
            	$(this).find('#myModalLabel').text(dateTitle);
            	$(this).find('#dateType').val(dateType);
            	$(this).find('#edit_date').val(dateValue);
            	//$('#edit_date').datepicker("setDate", new Date(dateValue));

            });
            $("body").on("click", "#saveDate", function (e) {
                e.preventDefault();
                var EditedDate = $(this).parents('.modal-content').find('#edit_date').val();
                var dateType = $(this).parents('.modal-content').find('#dateType').val();
                var userId = $('#profile-box-container').attr('data-user-id');
                var postData = {
                    userID: userId,
                    dateType: dateType,
                    EditedDate: EditedDate
                };
                $.ajax({
                    url: baseUrl + "Admin/savedate",
                    data: postData,
                    type: "POST",
                    success: function(output) {
                       var data = output.split("::");
                       if(data[0] === "OK") {
	                         location.reload();
	                    }
                    }
                });
              
            }); 
            $("body").on("click", "#full-edit", function (e) {
                e.preventDefault();
               $('.profile-username').hide();
               $('.editable.fullname').show();
               $('.editable.fullname input').focus();
              
            });
            $( ".fullname" ).focusout(function() {
			   var userId = $('#profile-box-container').attr('data-user-id');
			   $('.profile-username').show();
               $('.editable.fullname').hide();
               var NewFullName = $('.editable.fullname input').val();
                var postData = {
                    userID: userId,
                    fullName: NewFullName
                };
                $.ajax({
                    url: baseUrl + "Admin/updatename",
                    data: postData,
                    type: "POST",
                    success: function(output) {
                       var data = output.split("::");
                       if(data[0] === "OK") {
	                       $('.profile-username b').text(NewFullName);
	                    }
                    }
                });
			});
			$("body").on("click", "#web-edit", function (e) {
                e.preventDefault();
               $('.website-text').hide();
               $('.editable.website').show()
               $('#web-edit').hide();
               $('.editable.website input').focus();
              
            });
            $( "#web-input" ).focusout(function() {
			   var userId = $('#profile-box-container').attr('data-user-id');
			   $('.website-text').show();
			   $('#web-edit').show();
               $('.editable.website').hide();
               var website = $('.editable.website input').val();
                var postData = {
                    userID: userId,
                    website: website
                };
                $.ajax({
                    url: baseUrl + "Admin/updatewebsite",
                    data: postData,
                    type: "POST",
                    success: function(output) {
                       var data = output.split("::");
                       if(data[0] === "OK") {
	                       $('.website-text').text(website);
	                       $('.website-text').attr('href','http://'+website);
	                    }
                    }
                });
			});          
			$("body").on("click", "#company-edit", function (e) {
                e.preventDefault();
               $('.company-text').hide();
               $('.editable.company').show()
               $('.editable.company input').focus();
              
            });
            $("#company-input").focusout(function() {
			   var userId = $('#profile-box-container').attr('data-user-id');
			   $('.company-text').show();
               $('.editable.company').hide();
               var company = $('.editable.company input').val();
                var postData = {
                    userID: userId,
                    company: company
                };
                $.ajax({
                    url: baseUrl + "Admin/updatecompany",
                    data: postData,
                    type: "POST",
                    success: function(output) {
                       var data = output.split("::");
                       if(data[0] === "OK") {
	                       $('.company-text p').text(company);
	                    }
                    }
                });
			});
			$("body").on("click", "#email-edit", function (e) {
                e.preventDefault();
               $('.email-text').hide();
               $('.editable.email').show()
               $('.editable.email input').focus();
              
            });
			$("#email-input").focusout(function() {
			   var userId = $('#profile-box-container').attr('data-user-id');
			   $('.email-text').show();
               $('.editable.email').hide();
               var email = $('.editable.email input').val();
                var postData = {
                    userID: userId,
                    email: email
                };
                $.ajax({
                    url: baseUrl + "Admin/updateemail",
                    data: postData,
                    type: "POST",
                    success: function(output) {
                       var data = output.split("::");
                       if(data[0] === "OK") {
	                       $('.email-text p').text(email);
	                    }
                    }
                });
			});                
			$("body").on("click", "#bsName-edit", function (e) {
                e.preventDefault();
               $('.bsName-text').hide();
               $('.editable.bsName').show()
               $('.editable.bsName input').focus();
              
            });
			$("#bsName-input").focusout(function() {
			   var userId = $('#profile-box-container').attr('data-user-id');
			   $('.bsName-text').show();
               $('.editable.bsName').hide();
               var bsName = $('.editable.bsName input').val();
                var postData = {
                    userID: userId,
                    bsName: bsName
                };
                $.ajax({
                    url: baseUrl + "Admin/updatebsName",
                    data: postData,
                    type: "POST",
                    success: function(output) {
                       var data = output.split("::");
                       if(data[0] === "OK") {
	                       $('.bsName-text p').text(bsName);
	                    }
                    }
                });
			});

			$("body").on("click", ".save-sector", function (e) {
                e.preventDefault();
                var userId 	= $('#profile-box-container').attr('data-user-id');
                var select  = $('.edit-sector select');
                var ansDiv  = $('.edit-sector');
                var answer  = $('.edit-sector select').val();
                var editText= $('.sector-text p');
                
                var postData = {
                    userID: userId,
                    answer: answer
                };
                $.ajax({
                    url: baseUrl + "Admin/savesector",
                    data: postData,
                    type: "POST",
                    success: function (output) {
                        var data = output.split("::");
                        if (data[0] === "OK") {
                            ansDiv.slideUp('slow');
                            var newanswer  = $(".edit-sector select option:selected").text();
                            editText.text(newanswer);

                        }
                    }
                });
            });

            $("#sector-edit").on("click", function (event) {
                event.preventDefault();
                var saveBtn = $('.save-sector');
                var userId  = $('#profile-box-container').attr('data-user-id');
                var select  = $('.edit-sector select');
                var ansDiv  = $('.edit-sector');
                var postData = {
                    userID: userId
                };
                saveBtn.parent().remove();
                $.ajax({
                    url: baseUrl + "Admin/getsectors",
                    data: postData,
                    type: "POST",
                    success: function (output) {
                        var data = $.parseJSON(output);
                        select.html('');
                        $.each(data, function (index, value) {
                            select.append('<option value="' + value.id + '">' + value.sector + '</option>');
                        });
                        select.parent().append('<div class="sector-action-buttons"><button class="save-sector">Save</button></div>');
                        ansDiv.slideDown('slow');
                    }
                });
            });                                        
        });
		
		$(function() {
			//$('.fileupload').fileupload();
		    $("#edit_date").daterangepicker({
		    	singleDatePicker: true,
		        locale: {
		            format: 'DD-MM-YYYY',
		        }
		    });
		});


    </script>
<?php }


?>
</body>
</html>