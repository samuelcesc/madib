<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="images/favicon.png" type="image/png">

  <title><?php echo $title ?></title>

    <link href="<?php echo base_url('assets/css/style.default.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/prettyPhoto.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/style.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/style-responsive.css') ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/custom.css') ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/bootstrap-fileupload.min.css') ?>" rel="stylesheet" />

</head>
<body>	

<section>
  
  <div class="leftpanel">
    
    <div class="logopanel">
        <h1>CourseGraph</h1>
    </div> <!-- logopanel --> 
    
  </div> <!-- leftpanel -->
  
  <div>
    
    <div class="headerbar">
      
    
      <div class="header-right ">
     
     <ul class="headermenu">
        
        <li><a class="btn btn-white dropdown-toggle" href="<?php echo base_url('home') ?>"> <i class="fa fa-home"></i> Home</a></li>  
              
        <li><a class="btn btn-white dropdown-toggle" href="<?php echo base_url('messages') ?>"> <i class="fa fa-envelope"></i> Messages
		<?php if($count_unread){ ?>
		<span class="badge badge-info"><?php echo $count_unread ?></span>
		<?php } ?>
		</a></li>
        
		<li><a class="btn btn-white dropdown-toggle" href="<?php echo base_url('explore') ?>"> <i class="fa fa-rocket"></i> Explore</a></li>  
		
        <li>
     	 	<form class="searchform searchindent" action="<?php echo base_url('search') ?>/" method="get">
        <input type="text" class="form-control" name="s" placeholder="Search for people you know" />
     	 </form>
     	 </li> 
        
          <li>
            <div class="btn-group pull-right" >
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <img height="22" src="<?php echo base_url('user_images').$sess_profile_picture ?>" alt="" />
                <?php echo $sess_firstname . " " . $sess_lastname ?>
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                <li><a href="<?php echo base_url('profile/edit') ?>"><i class="glyphicon glyphicon-cog"></i> Update My Profile</a></li>
                <li><a href="<?php echo base_url('signout') ?>"><i class="glyphicon glyphicon-log-out"></i> Log Out</a></li>
              </ul>
            </div>
          </li>
          
         
        </ul>
      </div><!-- header-right -->
     
    </div><!-- headerbar -->
        
   