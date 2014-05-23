<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="images/favicon.png" type="image/png">

  <title>Password Reset | The Course Graph</title>

    <link href="<?php echo base_url('assets/css/style.default.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/prettyPhoto.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/style.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/style-responsive.css') ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/custom.css') ?>" rel="stylesheet">


</head>

<body class="signin">

<section>
  
    <div class="signinpanel">
        
        <div class="row">
            
            <div class="col-md-2"></div><!-- col-sm-5 -->
                
                
            
            <div class="col-md-8 nopadding white-bg">
                <form method="post" action="<?php echo base_url('account/sendlink') ?>">
                   
                    <h2 class="nomargin textgreenish">Reset Password</h2>
                    <hr />
                 <?php if($this->session->flashdata('success')) { ?> 
                    <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
              <?php echo $this->session->flashdata('success'); ?>
                </div>
              <?php }else{ ?>
                  <div class="alert alert-warning">
              		Please enter your email address and we will send you a link to reset it.
                </div>
			<?php } ?>	
                    <!-- <p class="mt5 mb20 textash">Login to access your account.</p> -->               
                    <input type="text" name="email_address" class="form-control uname" placeholder="Email Address" required/>
                    <div class="mb20"></div>
                    
                    <button class="btn btn-primary btn-sm btn-block">Send Reset Link</button>
                    <div class="mb20"></div>

                </form>
                
                    
              </div>  
            <div class="col-md-2"></div>
            
        </div><!-- row -->
        
        <div class="signup-footer">
            <div class="pull-left textash">
                &copy; 2014. A Samuel Ojumah Production.
            </div>
        </div>
        
    </div><!-- signin -->
  
</section>
