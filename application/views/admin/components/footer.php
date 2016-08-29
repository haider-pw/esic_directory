
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
            var hiddenModalUserID = $(this).parents("modal-content").find("#hiddenUserID").val();
            var postData = {id:hiddenModalUserID,value:"approve"};
            $.ajax({
               url:"<?=base_url();?>Admin/assessment_list",
                data:postData,
                type:"POST",
                success:function (output) {
                    var data = output.split("::");
                }
            });
        });

        $("#noPending").on("click",function () {
            var hiddenModalUserID = $(this).parents(".modal-content").find("#hiddenUserID").val();
            var postData = {id:hiddenModalUserID,value:"pending"};
            $.ajax({
               url:"<?=base_url();?>Admin/assessment_list",
                data: postData,
                type:"POST",
                success:function (output) {
                    var data = output.split("::");
                }
            });
        });
    });
</script>
</body>
</html>