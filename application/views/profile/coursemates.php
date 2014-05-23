       
        <div class="col-sm-9">
          
          <div class="col-sm-12 col-lg-12"> 
		                
                <div class="panel panel-default">
                    
                    <div class="panel-heading">
                    
                    <h4 class="panel-title"><i class="text-success glyphicon glyphicon-ok-circle"></i> Your Coursemates</h4>
					<a href="#"><button title="" data-placement="bottom" data-toggle="tooltip" class="btn btn-danger pull-right tooltips" type="button" data-original-title="Share and Interact with Your Coursemates"><i class="fa fa-users"></i> View Course Page</button></a>
                        
                </div><!-- panel-heading -->
                    
                    <div class="panel-body">
                    <?php if(empty($users_data)) { ?>
                    <div class="alert alert-warning alert-dismissable">
                    	Your Coursemates are not here yet. Invite them to join your network.
                    </div>
                    <?php } ?>
                    
                <div class="people-list">
        <div class="row">
          <?php foreach ($users_data as $c) { ?>
          <div class="col-md-6">
            <div class="people-item">
              <div class="media">
                <a href="#" class="pull-left">
                  <img alt="" src="<?php echo base_url('user_images').$c['profile_picture'] ?>" class="thumbnail media-object">
                </a>
                <div class="media-body">
                  <a href="<?php echo base_url('user')."/". $c['firstname'] .".".$c['lastname'] ?>"><h4 class="person-name"><?php echo $c['firstname'] ." ".$c['lastname'] ?></h4></a>
                	  <div class="profile-position text-success"><i class="glyphicon glyphicon-ok-circle"></i> Coursemates</div>
                  	<div class="mb20"></div>
                  	<a href="<?php echo base_url('user')."/".$c['firstname'] .".".$c['lastname'] ?>"><button class="btn btn-white mr5"><i class="fa fa-user"></i> View Profile</button></a>
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
