<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="images/favicon.png" type="image/png">

  <title>Lecturer | The Course Graph</title>

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
            
            <div class="col-md-5">
                 <?php echo form_open('signup/complete'); ?>
                    <h4 class="nomargin">Complete Process</h4>
               
                    <select class="form-control" name="title">
                    	<option value="">-Select Title-</option>
                    	<option value="1">Mr.</option>
                    	<option value="2">Miss</option>
                    	<option value="3">Mrs</option>
                    	<option value="4">Dr</option>
                    	<option value="5">Prof.</option>
                    </select>
                    
                    <select class="form-control" name="program">
                    	<option value="">-Select Course-</option>
						<?php foreach ($programs as $p) {?>
        	<option value="<?php echo $p['program_name'] ?>"><?php echo $p['program_name'] ?></option>
						<?php	
						}
						 ?>
                    </select>
                   
                                    
                  <button name="complete_professor" value="true" class="btn btn-primary btn-block">Complete</button>
                    
                </form>
            </div><!-- col-sm-5 -->
            
        </div><!-- row -->
        
        <div class="signup-footer">
            <div class="pull-left">
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
