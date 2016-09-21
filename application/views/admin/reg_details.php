
        <style>
        .dates a{
          padding: 1px 5px;
        }
        .post.question-post{
          margin-left: 20px;
          padding-bottom: 5px;
        }
        .question-post .user-block .question-statement{
          margin-left: 0px;
        }
        .post .user-block {
          margin-bottom: 5px;
        }
        .edit-question{
          display: none;
        }
        .question-action-buttons{
          text-align: right;
        }
        .save-answer,.save-desc{
          margin-top: 10px;
          background: #3c8dbc;
          color: #fff;
          border: none;
          width: 80px;
          height: 25px;
        }
        .action-buttons a{
          display: block;
          color: #fff;
          padding: 10px 0px;
          margin: 8px 0px;
          text-align: center;
        }
        .timeline-item.edit-desc{
          display: none;
          padding-bottom: 20px!important;
        }
        .timeline-item.edit-desc label{
          display: block;
          margin: 10px;
        }
        .timeline-item.edit-desc .form-group{
          padding-right: 10px;
          margin-right: 2%;
        }
        .timeline-item.edit-desc textarea{
          display: block;
          padding: 10px;
          margin: 10px;
          width: 98.5%;
          min-height: 150px;
         }
         #description .timeline-item{
           border-radius: 0px;
       }
       ul.dates li .date-edit{
         display: none;
         position: absolute;
       }
       ul.dates li:hover .date-edit{
          display: inline-block;
       }
       .profile-username .full-edit{
          display: none;
          position: absolute;
          top: -7px;
          right: -3px;
       }
       .profile-username:hover .full-edit{
          display: inline-block;
       }
       .profile-username{
          position:relative;
       }
       .profile-username b{
         font-weight: 500;
       }
       #description pre {
            display: block;
            padding: 9.5px;
            margin: 0 0 10px;
            font-size: 13px;
            line-height: 1.42857143;
            color: #333;
            word-break: break-word;
            word-wrap: normal;
            background-color: #f5f5f5;
            border: 1px solid #ccc;
            border-radius: 4px;
             white-space: pre-wrap;
            white-space: -moz-pre-wrap;
            white-space: -pre-wrap;
            white-space: -o-pre-wrap;
            word-wrap: break-word;
        }
        .editable{
          width: 90%;
          margin: 0 auto;
          text-align: center;
          display: none;
        }
        .editable input{
          width: 99%;
          margin: 10px 0px;
          padding: 5px 7px;
        }
        .web-container{
          position: relative;
        }
        #web-edit{
          position: absolute;
          top: 0px;
          z-index: 100;
          background: rgba(0,0,0,0.6);
          right: 0;
          display: none;
       }
       #web-edit span{
         color:#fff!important;
       }
       .web-container:hover #web-edit{
          display: inline-block;
          color:#fff!important;
       }
       .company-container{
          position: relative;
        }
        #company-edit{
          position: absolute;
          top: -5px;
          z-index: 100;
          right: 0;
          display: none;
       }
       .company-container:hover #company-edit{
          display: inline-block;
       }
       .email-container{
          position: relative;
       }
       #email-edit{
          position: absolute;
          top: -5px;
          z-index: 100;
          right: 0;
          display: none;
       }
       .email-container:hover #email-edit{
          display: inline-block;
       }
      .bsName-container{
          position: relative;
       }
       #bsName-edit{
          position: absolute;
          top: -5px;
          z-index: 100;
          right: 0;
          display: none;
       }
       .bsName-container:hover #bsName-edit{
          display: inline-block;
       }
       .sector-text{
        position: relative;
       }
       .sector-container:hover #sector-edit{
        display: inline-block;
       }
       #sector-edit{
       display:none;
        position: absolute;
        top: 0;
        right: 0;
      }
       .save-sector{
          margin-top: 10px;
          background: #3c8dbc;
          color: #fff;
          border: none;
          width: 80px;
          height: 25px;
        }
        .edit-sector{
          display:none;
        }
        .user-logo-container{
          position: relative;
          text-align: center;
        }
        .user-logo-container .profile-user-img {
            margin: 0 auto;
            min-width: 100px;
            max-width: 250px;
            min-height: 100px;
            width: 100%;
            padding: 3px;
            border: 3px solid #d2d6de;
        }
        .user-logo-container:hover .btn-file{
          display: block;
        } 
        #edit-logo{
          cursor: pointer;
        }
        .user-logo-container .btn-file{
            display:none;
            position: absolute;
            bottom: 0px;
            width: 100%;
            left: 0;
            right: 0;
            background: rgba(0,0,0,0.5);
            color: #fff;
        }


        </style>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
             Pre-assessment 
            <small>DETAILS</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Pre-assessment </a></li>
            <li class="active">Details</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
    	<?php if(isset($userProfile)){ ?>
      <div class="row">
        <div class="col-md-3">
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile" id="profile-box-container" data-user-id="<?= $userProfile['userID']?>">
            <?php 
                    $logoImage= '';
                    if(!empty($userProfile['Logo']) and is_file(FCPATH.'/'.$userProfile['Logo'])){ 
                      $logoImage = base_url().'/'.$userProfile['Logo'];
                    }else{
                       $logoImage = base_url('pictures/defaultLogo.png');
                    }

              ?>
                <div class="user-logo-container">
                  <img id="User-Logo" class="profile-user-img img-responsive" src="<?= $logoImage; ?>" alt="User profile picture">
                  <div class="fileupload fileupload-new" data-provides="fileupload">
                      <span class="btn btn-file"><span class="fileupload-new">Click To</span><span class="fileupload-exists"> Edit</span>
                      <input id="edit-logo" type="file" name="logo" />
                      </span>
                      <!--a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a-->
                  </div>
                </div>
            <?php if(!empty($userProfile['FullName'])){ ?>
              <h3 class="profile-username text-center"><b><?= $userProfile['FullName'];?></b>
              <a class="btn addBtn full-edit" id="full-edit"><span style="font-size: 12px;" class="glyphicon glyphicon-pencil"></span></a></h3>
              <div class="editable fullname">
                <div class="form-group">
                  <input type="text" name="fullname" id="fullname" placeholder="<?= $userProfile['FullName'];?>"/> 
                </div>
              </div>
			       <?php } ?>
            <?php if(!empty($userProfile['Company'])){ ?>
              <div class="company-container">
                  <div class="company-text">
                    <p class="text-muted text-center"><?= $userProfile['Company']?></p>
                    <a class="btn addBtn company-edit" id="company-edit"><span style="font-size: 12px;" class="glyphicon glyphicon-pencil"></span></a>
                  </div>
                  <div class="editable company">
                    <div class="form-group">
                      <input type="text" name="company" id="company-input" placeholder="<?= $userProfile['Company'];?>"/> 
                    </div>
                  </div>
              </div>
            <?php } ?>
              <ul class="list-group list-group-unbordered dates">
              	<?php if(!empty($userProfile['expiry_date'])){ ?>
	                <li class="list-group-item ">
	                  <b>Expiry Date</b> <a class="pull-right bg-red"><?= $userProfile['expiry_date'];?></a>
	                  <a class="btn addBtn date-edit" data-date-title="Edit Expiry Date" data-date-type="expiry_date" data-date-value="<?= $userProfile['expiry_date_value'];?>" data-toggle="modal" data-target=".DateEditModal" id="addDateEditModal"><span style="font-size: 12px;" class="glyphicon glyphicon-pencil"></span></a>
	                </li>
                <?php } if(!empty($userProfile['corporate_date'])){ ?>
                <li class="list-group-item">
                  <b>Corporate Date</b> <a class="pull-right bg-aqua"><?= $userProfile['corporate_date'];?></a>
                  <a class="btn addBtn date-edit" data-date-title="Edit Corporate Date" data-date-type="corporate_date" data-date-value="<?= $userProfile['corporate_date_value'];?>" data-toggle="modal" data-target=".DateEditModal" id="addDateEditModal"><span style="font-size: 12px;" class="glyphicon glyphicon-pencil"></span></a>
                </li>
                <?php } ?>
                <?php if(!empty($userProfile['added_date'])){ ?>
                <li class="list-group-item">
                  <b>Added Date</b> <a class="pull-right bg-green"><?= $userProfile['added_date'];?></a>
                  <a class="btn addBtn date-edit" data-date-title="Edit Added Date" data-date-type="added_date" data-date-value="<?= $userProfile['added_date_value'];?>" data-toggle="modal" data-target=".DateEditModal" id="addDateEditModal"><span style="font-size: 12px;" class="glyphicon glyphicon-pencil"></span></a>
                </li>
                <?php } ?>
              </ul>
              <?php if(!empty($userProfile['Web'])){ ?>
                <div class="web-container">
                    <a href="http://<?= $userProfile['Web'];?>" class="btn btn-primary btn-block website-text" target="_blank"><b><?= $userProfile['Web'];?></b></a>
                    <a class="btn addBtn web-edit" id="web-edit"><span style="font-size: 12px;" class="glyphicon glyphicon-pencil"></span></a>
                    <div class="editable website">
                      <div class="form-group">
                        <input type="text" name="web-input" id="web-input" placeholder="<?= $userProfile['Web'];?>"/> 
                      </div>
                    </div>
                </div>
              <?php } ?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About Company</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <?php if(!empty($userProfile['Email'])){ ?>
               <div class="email-container">
                  <div class="email-text">
                    <strong><i class="fa fa-envelope margin-r-5"></i> Email</strong>
                    <p class="text-muted">
                       <?= $userProfile['Email'];?>
                    </p>
                      <a class="btn addBtn email-edit" id="email-edit"><span style="font-size: 12px;" class="glyphicon glyphicon-pencil"></span></a>
                  </div>
                  <div class="editable email">
                      <div class="form-group">
                        <input type="email" name="email-input" id="email-input" placeholder="<?= $userProfile['Email'];?>"/> 
                      </div>
                  </div>
                </div>
              <hr>
            <?php }  if(!empty($userProfile['sector'])){ ?>
              <div class="sector-container">
                <div class="sector-text">
                  <strong><i class="fa fa-industry margin-r-5"></i> Sector</strong>
                  <p class="text-muted"> <?= $userProfile['sector'];?></p>
                  <a class="btn addBtn sector-edit" id="sector-edit"><span style="font-size: 12px;" class="glyphicon glyphicon-pencil"></span></a>
                </div>
                <div class="edit-sector">
                  <div class="form-group">
                    <label>Please Select Answer</label>
                    <select class="form-control"></select>
                  </div>
                </div>
              </div>
              <hr>
            <?php }  if(!empty($userProfile['business'])){ ?>
               <div class="bsName-container">
                  <div class="bsName-text">
                    <strong><i class="fa fa-briefcase margin-r-5"></i> Business</strong>
                    <p class="text-muted"> <?= $userProfile['business'];?></p>
                    <a class="btn addBtn bsName-edit" id="bsName-edit"><span style="font-size: 12px;" class="glyphicon glyphicon-pencil"></span></a>
                  </div>
                  <div class="editable bsName">
                    <div class="form-group">
                        <input type="text" name="bsName-input" id="bsName-input" placeholder="<?= $userProfile['business'];?>"/> 
                      </div>
                  </div>
                </div>
              <hr>
            <?php }  if(!empty($userProfile['ipAddress'])){ ?>
               <div class="ipAddress-container">
                  <div class="ipAddress-text">
                    <strong><i class="fa fa-globe margin-r-5"></i>IP Address</strong>
                    <p class="text-muted"> <?= $userProfile['ipAddress'];?></p>
                  </div>
               </div>
               <hr>
            <?php }  if(!empty($userProfile['ScorePercentage'])){ ?>
              <strong><i class="fa fa-briefcase margin-r-5"></i> Score</strong>
               <div class="progress md">
                   <div class="question-bar progress-bar progress-bar-aqua" style="width: <?= round($userProfile['ScorePercentage']).'%';?>" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                      <span class=""><?= round($userProfile['ScorePercentage']).'%';?></span>
                    </div>
                </div>
            <?php } ?>
            <div class="action-buttons">
             <a href="#" data-target=".approval-modal" data-toggle="modal" class="btn-primary" data-id="<?= $userProfile['userID'];?>">Approval</a>
             <a href="#" data-target=".delete-modal" data-toggle="modal" class="bg-red" data-id="<?= $userProfile['userID'];?>">Delete</a>
             </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#questions" data-toggle="tab">Questions</a></li>
              <li><a href="#description" data-toggle="tab">Description</a></li>
              <li><a href="#otherDetail" data-toggle="tab">Detail</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="questions">
                  <?php if(isset($usersQuestionsAnswers)){ ?>
               <?php foreach ($usersQuestionsAnswers as $key => $value) { ?>
                  <div class="post question-post <?= 'question-'.$value['questionID'];?>" data-id="<?= 'question-'.$value['questionID'];?>">
                      <div class="user-block">
                          <span class="username question-statement">
                          <a href="#"><?= $value['Question'];?></a>
                          <a href="#" class="pull-right btn-box-tool question-edit" data-id="<?= 'question-'.$value['questionID'];?>"  data-question-id="<?= $value['questionID'];?>"><i class="fa fa-pencil"></i></a>
                          <?php if(!empty($value['points'])){ ?>
		                          <span class="question-points" data-score="<?= $value['points'];?>" >(<?= $value['points'];?>)</span>
		                      <?php }else{ ?>
                            <span class="question-points"></span>
                          <?php } ?>
                          </span>
                      </div>
                    <p class="answer-solution"><?= $value['solution'];?></p>
                    <div class="edit-question">
                      <div class="form-group">
                        <label>Please Select Answer</label>
                        <select class="form-control">
                        </select>
                      </div>
                    </div>
                  </div>
                <?php } 
                  }
              ?>
                </div>
              <div class="tab-pane" id="otherDetail">
                <ul class="timeline timeline-inverse">
                  <li>
                    <div class="timeline-item">
                      <h3 class="timeline-header">Brief Description  <a href="#" id="desc-edit" data-user-id="<?= $userProfile['userID'];?>" class="pull-right btn-box-tool desc-edit"><i class="fa fa-plus"></i></a></h3>
                      <div id="desc-text" class="timeline-body">
                      <pre>
                      </pre>
                      </div>
                    </div>
                    <div class="timeline-item edit-desc">
                      <div class="form-group">
                        <label>Please Edit The Description Here</label>
                        <textarea id="desc-textarea" name="desc"></textarea>
                      </div>
                    </div> 
                  </li>      
                </ul>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="description">
                <!-- The timeline -->
              <?php if(!empty($userProfile['BusinessShortDesc'])){ ?>
                <ul class="timeline timeline-inverse">
                  <li>
                    <div class="timeline-item">
                      <h3 class="timeline-header">Brief Description  <a href="#" id="desc-edit" data-user-id="<?= $userProfile['userID'];?>" class="pull-right btn-box-tool desc-edit"><i class="fa fa-pencil"></i></a></h3>
                      <div id="desc-text" class="timeline-body">
                      <pre><?= trim($userProfile['BusinessShortDesc']);?></pre>
                      </div>
                    </div>
                    <div class="timeline-item edit-desc">
                      <div class="form-group">
                        <label>Please Edit The Description Here</label>
                        <textarea id="desc-textarea" name="desc"></textarea>
                      </div>
                    </div>
                  </div>
                  </li>      
                </ul>
              <?php }else{ ?>

				        <ul class="timeline timeline-inverse">
                  <li>
                    <div class="timeline-item">
                      <h3 class="timeline-header">Brief Description  <a href="#" id="desc-edit" data-user-id="<?= $userProfile['userID'];?>" class="pull-right btn-box-tool desc-edit"><i class="fa fa-plus"></i></a></h3>
                      <div id="desc-text" class="timeline-body">
                      <pre>
                      </pre>
                      </div>
                    </div>
                    <div class="timeline-item edit-desc">
                      <div class="form-group">
                        <label>Please Edit The Description Here</label>
                        <textarea id="desc-textarea" name="desc"></textarea>
                      </div>
                    </div> 
                  </li>      
                </ul>

              <?php } ?>
              </div>
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
<?php } ?>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<div class="modal DateEditModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Edit The Date</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="inputDiv" id="dateInsertDiv">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                   <label for="cop_date">Type Date</label>
                                   <input id="dateType" name="dateType" type="hidden" />
                                    <div class="input-group date">
                                       <input id="edit_date" name="edit_date" type="text" class="form-control" placeholder="DD-MM-YYYY" />
                                       <div class="input-group-addon">
                                           <span class="glyphicon glyphicon-th"></span>
                                       </div>
                                     </div>    
                                 </div>
                            </div>
                        </div>
                   </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button id="saveDate" type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>