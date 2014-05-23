
        <div class="col-sm-9 ">
          
          <div class="profile-header">
            <h2 class="profile-name"><?php echo $firstname . " " .$lastname ?></h2>
           <div class="profile-position"><i class="fa fa-book"></i><strong>Studies <?php echo $program_name ?> at <a href="http://www.covenantuniversity.edu.ng">Covenant University</strong></a></div>
           <div class="profile-location"><i class="fa fa-user"></i><strong><?php echo $level ?>  LEVEL</div></strong>
		   <div class="profile-location"><i class="fa fa-users"></i><strong>Class Of <?php echo $grad_year ?></div></strong>
            <div class="mb20"></div>
            <?php if($follow_status == 0){ ?>
            <button type="submit" class="btn followw btn-follow btn-success mr5" rel="<?php echo $user_auth ?>" ><i class="fa fa-user"></i> Follow</button> 
             <!--</form> -->
             <?php } else if($follow_status == 1){ ?>
             <button type="submit" class="btn followw btn-follow mr5 btn-success follow unfolloww" rel="<?php echo $user_auth ?>" ><i class="fa fa-check"></i> Following</button> 
             <button type="submit" class="btn btn-white mr5" data-toggle="modal" data-target="#newmessage"  ><i class="fa fa-envelope"></i> Message</button> 
              <?php } else {} ?>
             </div><!-- profile-header -->
          
          <!-- Nav tabs -->
        <ul class="nav nav-tabs nav-justified nav-profile">
          <li class="active"><a href="#activities" data-toggle="tab"><strong><i class="glyphicon glyphicon-user"></i>  Feeds</strong></a></li>      	
		  <li><a href="#followers" data-toggle="tab"><strong><i class="glyphicon glyphicon-user"></i><i class="glyphicon glyphicon-user"></i><i class="glyphicon glyphicon-user"></i>  People <?php echo $firstname ?> Follows</strong></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <div class="tab-pane active" id="activities">
            <div class="activity-list">
            	
				<?php if(!empty($feeds)){ foreach ($feeds as $v) { ?>
       											<div class="media nomarginbottom nomargintop">
												<a href="<?php echo base_url('user') . "/". $v['firstname'] . ".".$v['lastname'] ?>" class="pull-left"> <img width="48" height="48" alt="" src="<?php echo base_url('user_images').$v['profile_picture'] ?>" class="avatar media-object"> </a>
												<div class="media-body nomarginbottom">
													<?php $datetime = new DateTime($v['time_posted']); ?>
												<small class="media-meta pull-right timeago" title="<?php echo $datetime->format(DateTime::ISO8601) ?>"></small>
												<a href="<?php echo base_url('user') . "/". $v['firstname'] . ".".$v['lastname'] ?>"><h5 class="text-primary nomargintop"><?php echo $v['firstname'] . " ".$v['lastname'] ?></h5></a>

													<p class="nomargintop">
														<?php echo $v['post_content'] ?>
													</p>
													
												</div>

												<hr class="nomargintop"  />
													</div>

												<?php } 
												
												} else{ ?>
													
													<div class="alert alert-warning">					           
														<strong>No Feeds are available From <?php echo $firstname ?> </strong></div>
											
									<?php } ?>	
              
                    </div>
              
        
         
          </div>
		
		<div class="tab-pane" id="followers">
			<div class="people-list">
        <div class="row">
		<?php if(empty($following)){ ?>
			<div class="alert alert-warning">
			 <?php echo $firstname?> is Not Following anyone. 
			</div>
		<?php }else{ ?>
        	<?php foreach($following as $value) { ?>
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
                  	<a href="<?php echo base_url('user')."/".$value['firstname'] .".".$value['lastname'] ?>"><button class="btn btn-white btn-sm mr5"><i class="fa fa-user"></i> View Profile</button></a>
                </div>
              </div>
            </div>
          </div><!-- col-md-6 -->
          
          <?php } 
			}
		  ?>
          
                   
        </div><!-- row -->
      </div>
		</div>
        <div class="tab-pane" id="following"></div>
          
          
          </div>
        </div>
	  
	  
        </div>
		
      </div><!-- row -->
	
	  
	  <!-- Modal -->
<div class="modal fade" id="newmessage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">New Message</h4>
      </div>
      <div class="modal-body">
        
        <form method="post" action="<?php echo base_url('messages/send') ?>" class="form-horizontal" role="form" >
                
                    <div class="row">
                    <div class="col-md-2"></div>
                        <div class="col-md-8">
                                <div class="form-group">
                                   <label class="col-lg-2 control-label">To</label>
                                   <style type="text/css">
                                   	#custom-templates .empty-message {
										  padding: 5px 10px;
										 text-align: center;
										}
                                   </style>
                                    <div id="the-basics" class="col-lg-10">
                                        <input name="recipient_name" type="text" value="<?php echo $firstname . " " .$lastname ?>" id="readonlyinput" class="form-control" readonly="readonly">
                                       </div>
                                     </div>                                 
                                     <input type="hidden" name="auth_token" value="<?php echo $user_auth ?>" />       
                           <div class="form-group">
                                   <label class="col-lg-2 control-label">Message</label>
                                        <div class="col-lg-10">
                                             <textarea name="message" id="" class="form-control" cols="20" rows="5"></textarea>
                                            </div>
                                              </div>
                    </div>
                    <div class="col-md-2"></div>
                    </div>
                                              
                                          
        
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-send">Send</button>
        </form>
      </div>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->

