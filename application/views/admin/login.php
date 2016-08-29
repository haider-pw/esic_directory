<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Get the Flash Data
$alertMsg = $this->session->flashdata('alertMsg');
//Code Page Alert Messages If Any.
if(isset($alertMsg) && !empty($alertMsg)){
    $Message = explode("::",$alertMsg);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendors/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendors/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="#"><?=(isset($CompanyDetails['Name']) && !empty($CompanyDetails['Name']))?$CompanyDetails['Name']:'<b>Esic</b> Directory';?></a>
    </div><!-- /.login-logo -->
    <!--    Alert Box-->
    <div class="box-body">
        <div class="alert alert-danger alert-dismissible" <?=!isset($Message)?"style=\"display:none;\"":""?>>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-ban"></i> Error!</h4>
            <?=isset($Message)?$Message[0]:''?>
        </div>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg"><?=$this->lang->line('pSignintostartyoursession')?> </p>
        <?php echo form_open(base_url('Login/login')); ?>
        <div class="form-group has-feedback">
            <?php
            $inputAttributes = array(
                'name' => 'Username',
                'type' => 'text',
                'class' => 'form-control',
                'placeholder' => $this->lang->line('plcUsernameorEmail')
            );
            echo form_input($inputAttributes); ?>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <?php
            $inputAttributes = array(
                'name' => 'Password',
                'type' => 'Password',
                'class' => 'form-control',
                'placeholder' => $this->lang->line('plcPassword')
            );
            echo form_input($inputAttributes); ?>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
            <div class="col-xs-8">
                <div class="checkbox icheck">
                    <label>
                        <?php echo form_checkbox() ?> <?=$this->lang->line('lblRememberMe')?>
                    </label>
                </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
                <?php  $buttonAttributes = array(
                    'name' => 'Submit',
                    'type' => 'Submit',
                    'class' => 'btn btn-primary btn-block btn-flat'
                ); echo form_button($buttonAttributes,$this->lang->line('btnSignIn')); ?>
            </div><!-- /.col -->
        </div>
        <?php echo form_close(); ?>
        <a href="#"><?=$this->lang->line('aIforgotmypassword')?></a><br>
    </div><!-- /.login-box-body -->
</div><!-- /.login-box -->

<!-- jQuery 2.1.4 -->
<script src="<?php echo base_url(); ?>assets/vendors/jQuery/jQuery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="<?php echo base_url(); ?>assets/vendors/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url(); ?>assets/vendors/iCheck/icheck.min.js"></script>
<!--Jquery Shake-->
<script src="<?php echo base_url(); ?>assets/js/jquery.shake.js"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });

        <?=(isset($Message) && $Message[1] === "error")?'$(".login-box-body").shake();':'';?>
    });
</script>
</body>
</html>
