   
        <div class="col-sm-9">
          
          <div class="col-sm-12 col-lg-12"> 
		                
                <div class="panel panel-info">
                    
                    <div class="panel-heading">
                    
                    <h4 class="panel-title">People who have Interest in <?php echo $interest_name ?></h4>
                    <a href="<?php echo base_url('explore') ?>"><button class="btn btn-warning pull-right">Return to Interests</button></a>
                </div><!-- panel-heading -->
                    
                    <div class="panel-body">
                    <?php if(empty($users_data)){ ?>
                    <div class="alert alert-warning alert-dismissable">
                    	You have No Followers. 
                    </div>
                    <?php } else { ?>
                    
                <div class="people-list">
        <div class="row">
          <?php foreach ($users_data as $value) { ?>
          <div class="col-md-6">
            <div class="people-item">
              <div class="media">
                <a href="<?php echo base_url('user')."/". $value['firstname'] .".".$value['lastname'] ?>" class="pull-left">
                  <img alt="" src="<?php echo base_url('user_images'). $value['profile_picture'] ?>" class="thumbnail media-object">
                </a>
                <div class="media-body">
                  <a href="<?php echo base_url('user')."/". $value['firstname'] .".".$value['lastname'] ?>"><h4 class="person-name"><?php echo $value['firstname'] ." ".$value['lastname'] ?></h4></a>
                    <div class="profile-position"><i class="fa fa-book"></i>  <?php echo $value['program_name'] ?></div>
                 	 <div class="mb20"></div>
                  	<a href="<?php echo base_url('user')."/".$value['firstname'] .".".$value['lastname'] ?>"><button class="btn btn-sm btn-white mr5"><i class="fa fa-user"></i> View Profile</button></a>
                </div>
              </div>
            </div>
          </div><!-- col-md-6 -->
          
         <?php }
			}
		 ?>
          
        </div><!-- row -->
      </div>
            
                    </div><!-- panel-body -->
                    <br />
                </div><!-- panel -->
                
            </div>
       
        
        
        </div><!-- col-sm-9 -->
      </div><!-- row -->
      
    </div><!-- contentpanel -->
