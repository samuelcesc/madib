<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="images/favicon.png" type="image/png">

  <title>The Course Graph</title>

    <link href="<?php echo base_url('assets/css/style.default.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/prettyPhoto.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/style.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/style-responsive.css') ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/custom.css') ?>" rel="stylesheet">


</head><body class="bgimage">
<section>
  
    <div class="signinpanel">
        
        <div class="row">
            
            <div class="col-md-7">
                
                <div class="signin-info">
                    <div class="logopanel">
                        <h1><span>The</span> Course<span>Graph</span></h1>
                    </div><!-- logopanel -->
                
                    <div class="mb20"></div>
                
                    <h4 style="color:#fff"><strong>Welcome to The CourseGraph. Connect with your classmates, Friends, Lecturers and Instructors.<br><br> Exclusive to only Covenant University Students</strong></h4>

                    <div class="mb20"></div>
                    <strong>Not a member? <a href="<?php echo base_url('signup') ?>"><button class="btn btn-warning btn-block">Sign Up</button></a></strong>
                </div>
                            
            </div>

            <div class="col-md-5 nopadding white-bg">
                    <form id="signinForm" method="post" action="<?php echo base_url('signin/auth') ?>">
                    <h2 class="nomargin textgreenish">Sign In</h2>
                    <p class="mt5 mb20 textash">Login to access your account.</p>
                    
                	<div class="form-group">
                    <input type="text" name="email_address" class="form-control uname" placeholder="Email Address" required />
                    </div>
                    
                    <div class="form-group">
                    <input type="password" name="password" class="form-control pword" placeholder="Password" required />
                    </div>
                    <a href="<?php echo base_url('account/reset_password') ?>"><small>Forgot Your Password?</small></a>
                    <button class="btn btn-success btn-block">Sign In</button>
                    
                </form>
            </div><!-- col-sm-5 -->
            
        </div><!-- row -->
        
        <div class="signup-footer">
            <div class="pull-left textash">
                &copy; 2014. A Samuel Ojumah Production.
            </div>
        </div>
        
    </div><!-- signin -->
  
</section>

</body>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-50985149-1', 'thecoursegraph.com');
  ga('send', 'pageview');

</script>

</html>
