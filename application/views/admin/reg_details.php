
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
            <?php if(!empty($userProfile['Logo']) and is_file(FCPATH.'/'.$userProfile['Logo'])){ ?>
              <img class="profile-user-img img-responsive img-circle" src="<?= base_url().'/'.$userProfile['Logo'];?>" alt="User profile picture">
			<?php } ?>
            <?php if(!empty($userProfile['FullName'])){ ?>
              <h3 class="profile-username text-center"><?= $userProfile['FullName'];?></h3>
			<?php } ?>
            <?php if(!empty($userProfile['Company'])){ ?>
              <p class="text-muted text-center"><?= $userProfile['Company']?></p>
            <?php } ?>
              <ul class="list-group list-group-unbordered dates">
              	<?php if(!empty($userProfile['expiry_date'])){ ?>
	                <li class="list-group-item ">
	                  <b>Expiry Date</b> <a class="pull-right bg-red"><?= $userProfile['expiry_date'];?></a>
	                </li>
                <?php } if(!empty($userProfile['corporate_date'])){ ?>
                <li class="list-group-item">
                  <b>Corporate Date</b> <a class="pull-right bg-aqua"><?= $userProfile['corporate_date'];?></a>
                </li>
                <?php } ?>
                <?php if(!empty($userProfile['added_date'])){ ?>
                <li class="list-group-item">
                  <b>Added Date</b> <a class="pull-right bg-green"><?= $userProfile['added_date'];?></a>
                </li>
                <?php } ?>
              </ul>
              <?php if(!empty($userProfile['Web'])){ ?>
              <a href="http://<?= $userProfile['Web'];?>" class="btn btn-primary btn-block" target="_blank"><b><?= $userProfile['Web'];?></b></a>
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
              <strong><i class="fa fa-envelope margin-r-5"></i> Email</strong>

              <p class="text-muted">
                 <?= $userProfile['Email'];?>
              </p>
              <hr>
            <?php }  if(!empty($userProfile['sector'])){ ?>
              <strong><i class="fa fa-industry margin-r-5"></i> Sector</strong>
              <p class="text-muted"> <?= $userProfile['sector'];?></p>
              <hr>
            <?php }  if(!empty($userProfile['business'])){ ?>
              <strong><i class="fa fa-briefcase margin-r-5"></i> Business</strong>
              <p class="text-muted"> <?= $userProfile['business'];?></p>
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
        .save-answer{
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
            
        </style>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#questions" data-toggle="tab">Questions</a></li>
              <li><a href="#description" data-toggle="tab">Description</a></li>
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
              <!-- /.tab-pane -->
              <div class="tab-pane" id="description">
                <!-- The timeline -->
              <?php if(!empty($userProfile['BusinessShortDesc'])){ ?>
                <ul class="timeline timeline-inverse">
                  <li>
                    <div class="timeline-item">
                      <h3 class="timeline-header">Brief Description</h3>
                      <div class="timeline-body">
                      <?= $userProfile['BusinessShortDesc'];?>
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

