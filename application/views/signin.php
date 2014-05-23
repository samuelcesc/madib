<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="images/favicon.png" type="image/png">

  <title>Sign In | The Course Graph</title>

    <link href="<?php echo base_url('assets/css/style.default.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/prettyPhoto.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/style.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/style-responsive.css') ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/custom.css') ?>" rel="stylesheet">


</head>

<body class="bgimage">

<section>
  
    <div class="signinpanel">
        
        <div class="row">
            
            <div class="col-md-2"></div><!-- col-sm-5 -->
                
                
            
            <div class="col-md-8 nopadding white-bg">
                <form method="post" action="signin/auth">
                   
                    <h2 class="nomargin textgreenish">Sign In</h2>
                    <hr />
                  <?php if($this->session->flashdata('error')) { ?> 
                    <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <?php echo $this->session->flashdata('error'); ?>
                </div>
              <?php } ?>
              
                      <?php if($this->session->flashdata('warning')) { ?> 
                    <div class="alert alert-warning">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <?php echo $this->session->flashdata('warning'); ?>
                </div>
              <?php } ?>    
                    
                 <?php if($this->session->flashdata('success')) { ?> 
                    <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <?php echo $this->session->flashdata('success'); ?>
                </div>
              <?php } ?> 
                    <!-- <p class="mt5 mb20 textash">Login to access your account.</p> -->               
                    <input type="text" name="email_address" class="form-control uname" placeholder="Email Address" />
                    <input type="password" name="password" class="form-control pword" placeholder="Password" />
                    <a href="<?php echo base_url('account/reset_password') ?>"><small>Forgot Your Password?</small></a>
                    
                    <div class="mb20"></div>
                    <button class="btn btn-success btn-sm btn-block">Sign In</button>
                    <div class="mb20"></div>
                    <div align="center"><strong >Not a member? <a href="<?php echo  base_url('signup') ?>">Sign Up</a></strong>
                </div>
                </form>
                
                    
              </div>  
            <div class="col-md-2"></div>
            
        </div><!-- row -->
        
        <div class="signup-footer">
            <div class="pull-left textash">
                &copy; 2014. All Rights Reserved.
            </div>
        </div>
        
    </div><!-- signin -->
  
</section>
