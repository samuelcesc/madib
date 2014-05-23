     
        <div class="col-sm-9">
          
          <div class="col-sm-12 col-lg-12"> 
		                
                <div class="panel panel-default">
                    
                    <div class="panel-heading">
                    
                    <h4 class="panel-title">People You Follow</h4>
                	</div><!-- panel-heading -->
                    
                    <div class="panel-body">
                    <?php if(empty($follow_data)) { ?>
                    <div class="alert alert-warning alert-dismissable">
                    	You are not following anyone. You can search for your classmates to follow or Invite Friends to Join. 
                    </div>
                    <?php } ?>
                    
                <div class="people-list">
        <div class="row">
          <?php foreach ($follow_data as $value) { ?>
          <div class="col-md-6">
            <div class="people-item">
              <div class="media">
                <a href="<?php echo base_url('user')."/". $value['firstname'] .".".$value['lastname'] ?>" class="pull-left">
                  <img alt="" src="<?php echo base_url('user_images').$value['profile_picture'] ?>" class="thumbnail media-object">
                </a>
                <div class="media-body">
                  <a href="<?php echo base_url('user')."/". $value['firstname'] .".".$value['lastname'] ?>"><h4 class="person-name"><?php echo $value['firstname'] ." ".$value['lastname'] ?></h4></a>
                	  <div class="profile-position"><i class="fa fa-book"></i>  <?php echo $value['program_name'] ?></div>
                  	<div class="mb20"></div>
                  	<a href="<?php echo base_url('user')."/".$value['firstname'] .".".$value['lastname'] ?>"><button class="btn btn-white mr5"><i class="fa fa-user"></i> View Profile</button></a>
                </div>
              </div>
            </div>
          </div><!-- col-md-6 -->
          
         <?php } ?>
          
        </div><!-- row -->
      </div>
            
                    </div><!-- panel-body -->
                    <br />
                </div><!-- panel -->
                
            </div>
       
        
        
        </div><!-- col-sm-9 -->
      </div><!-- row -->
      
    </div><!-- contentpanel -->
