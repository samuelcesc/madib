<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="images/favicon.png" type="image/png">

  <title>Sign Up | The Course Graph</title>

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
            
            <div class="col-md-7">
                
                <div class="signin-info">
                    <div class="logopanel">
                        <h1><span>The</span> Course<span>Graph</span></h1>
                    </div><!-- logopanel -->
                
                    <div class="mb20"></div>
                
                     <h4 style="color:white"><strong>Welcome to The CourseGraph. Connect with your classmates, Friends, Lecturers and Instructors.<br><br> Exclusive to only Covenant University Students</strong></h4>

                    <div class="mb20"></div>
                    <strong style="color:white">Already a member? <a href="<?php echo base_url('signin') ?>"><button class="btn btn-success btn-block">Click to Sign In</button></a></strong>
                </div>
                            
            </div>
            
            
            <div class="col-md-5 nopadding white-bg">
                <?php echo form_open('signup/next') ?>
                    <h2 class="nomargin textgreenish">Sign Up</h2>
                    <p class="mt5 mb20">Join Other Coursemates and Friends Online</p>
                  
                  <div class="alert alert-warning">
                    	You must have a CU E-mail to Sign Up.
                    </div>
                    <input type="text" name="firstname" class="form-control uname" placeholder="Firstname" required/>
                    <input type="text" name="lastname" class="form-control uname" placeholder="Lastname" required/>
					<input type="text" name="email_address" placeholder="Email Address" data-content="Logon to your Portal and locate at the top." data-placement="right" data-toggle="popover" data-container="body" class="form-control popovers" data-original-title="" title="Don't Know Your CU E-mail ?" required/>
	  
                    <input type="password" name="password" class="form-control pword" placeholder="Password" required/>
                    <select class="form-control" name="user" required>
                    	<option value="student">Student</option>
                    </select>
                    <button class="btn btn-orange btn-block">Sign Up</button>
                    
                <?php echo form_close() ?>
            </div><!-- col-sm-5 -->
            
        </div><!-- row -->
        
        <div class="signup-footer">
            <div class="pull-left textash">
                &copy; 2014. A Samuel Ojumah Production.
            </div>
        </div>
        
    </div><!-- signin -->
  
</section>
  