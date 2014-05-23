 <div class="contentpanel">
      
      <div class="row">
        <div class="col-sm-3">
        
              <div class="leftpanelinner">
        <div class="row">
        <div class="col-sm-12">

		<?php //if(!isset($follow_status)){ ?>
  		<div class="panel panel-default widget-profile">
            <div class="panel-heading">
              <div class="cover"><img src="http://localhost/madib/assets/images/realcl.jpg" alt="Cover Photo"></div>
            </div>
            <div class="panel-body">
              <img width="80" height="80" src="<?php echo base_url('user_images').$profile_picture ?>" class="widget-profile-img thumbnail" alt="80x80">
              <div class="widget-profile-title">
                <h4><?php echo $firstname . " " . $lastname ?></h4>
                <small><i class="fa fa-map-marker"></i> Covenant University, Ota</small>
              </div>
              <blockquote class="serif italic text-center">
                <?php echo $latest_post ?>
              </blockquote>
              <div class="row">       
				<div class="col-xs-6">
                  <span><a style="color:white" href="<?php echo base_url('me/coursemates') ?>"><?php echo $coursemates_count ?> Coursemates</a></span>
                </div>
				<div class="col-xs-6">
                  <span><a style="color:white" href="<?php echo base_url('me/followers') ?>"><?php echo $followers_count ?> Followers</a></span>
                </div>
				
              </div>
            </div>
          </div>
			<?php //} ?> 
			
			
		<?php if(isset($suggestions)){ ?>	
		<div class="panel panel-default panel-alt widget-messaging">
				  <div class="panel-heading">
					  <div class="panel-btns">
						<a href="<?php echo base_url('explore') ?>" class="panel-edit"><i class="fa fa-user"></i></a>
					  </div><!-- panel-btns -->
					  <h3 class="panel-title">People you may know</h3>
					</div>
				<?php foreach($suggestions as $s){ ?>
				<div class="media act-media" style="padding-bottom:0px;" >
                <a class="pull-left" href="#">
                  <img width="80" height="80" class="media-object thumbnail" src="<?php echo base_url('user_images')."/".$s['profile_picture'] ?>" alt="" />
                </a>
                <div  class="media-body act-media-body">
                   <a href="<?php echo base_url($s['firstname'].".".$s['lastname']) ?>"><strong><?php echo $s['firstname']." ".$s['lastname'] ?></strong></a><br />
                  <div class="profile-position"><i class="fa fa-book"></i><?php echo $s['program_name'] ?></div>
				<a href="<?php echo base_url($s['firstname'].".".$s['lastname']) ?>"><button class="btn btn-sm btn-success">View Profile</button></a>
				</div>
              </div><!-- media -->
			  <?php } ?>
			  <hr>
          
		  </div>
		<?php } ?>	
			
			<?php if(!empty($bio_info)){ ?>
			<div class="panel panel-info">
            <div class="panel-heading">
              <div class="panel-btns">

              </div><!-- panel-btns -->
              <h4 class="panel-title"><i class="fa fa-user"></i> About Me</h4>
            </div>
            <div class="panel-body">
              <?php echo $bio_info ?>
            </div>
          </div><!-- panel -->
		  <?php } ?>
        	
        		<div class="mb30"></div>
        		 <?php if(!empty($facebook_name) && !empty($linkedin_name)){ ?>
        		<h5 class="subtitle">SOCIAL PROFILES</h5>
        		 <?php } ?>
        			<ul class="profile-social-list">
        				<?php if(!empty($facebook_name)){ ?>
		            <li><i class="fa fa-facebook"></i> <a href="#">facebook.com/<?php echo $facebook_name ?></a></li>
		            <?php } ?>
		            <?php if(!empty($linkedin_name)){ ?>
		            <li><i class="fa fa-linkedin"></i> <a href="#">linkedin.com/<?php echo $linkedin_name ?></a></li>
		            <?php } ?>
		          </ul>
				  
        		
        
        </div>
        
        
        </div>
      
        
    </div><!-- leftpanelinner -->
          
        </div><!-- col-sm-3 -->
		