	
        <div class="col-sm-5 ">
		
		<div class="alert alert-success">
		 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
		Welcome to Your New Profile. You can now share with Your Friends and Classmates in school.
		</div>
		<div class="panel panel-dark panel-alt timeline-post">
                <div class="panel-body">
					<form method="post" action="<?php echo base_url('home/newpost') ?>">
                    <textarea name="post_content" placeholder="Share to your Network" class="form-control"></textarea>
                </div><!-- panel-body -->
                <div class="panel-footer">
                    <div class="timeline-btns pull-left">
                        <a href="#" class="tooltips" data-toggle="tooltip" title="" data-original-title="Add Photo"><i class="glyphicon glyphicon-picture"></i></a>
                        <a href="#" class="tooltips" data-toggle="tooltip" title="" data-original-title="Add Video"><i class="glyphicon glyphicon-facetime-video"></i></a>
                        <a href="#" class="tooltips" data-toggle="tooltip" title="" data-original-title="Check In"><i class="glyphicon glyphicon-map-marker"></i></a>
                        <a href="#" class="tooltips" data-toggle="tooltip" title="" data-original-title="Tag User"><i class="glyphicon glyphicon-user"></i></a>
                    </div><!--timeline-btns -->
                    <button class="btn btn-success pull-right"><i class="fa fa-share-square"></i> Share</button>
					</form>
                </div><!-- panel-footer -->
            </div>
		<?php if(!empty($news_feed)){ foreach ($news_feed as $v) { ?>
		
		<div class="panel panel-default panel-timeline">
            <div class="panel-heading">
                
                <div class="media">
                    <a href="<?php echo base_url($v['firstname'] . ".".$v['lastname'])  ?>" class="pull-left">
                        <img width="32" height="32" alt="" src="<?php echo base_url('user_images').$v['profile_picture'] ?>" class="media-object">
                    </a>
                    <div class="media-body">
                        <a href="<?php echo base_url($v['firstname'] . ".".$v['lastname'])  ?>"><h4 class="text-primary"><?php echo $v['firstname'] . " ".$v['lastname'] ?></a>
						<?php $datetime = new DateTime($v['time_posted']); ?>
						<small class="text-muted timeago" title="<?php echo $datetime->format(DateTime::ISO8601) ?>"></small>
						<p><h4><?php echo $v['post_content'] ?></h4></p>
						</h4>												
                    </div>
                </div><!-- media -->       
            </div><!-- panel-heading -->
            <div class="panel-body">
            </div><!-- panel-body -->
          </div>
		  
			<?php } 
											
			} else{ ?>
												
			<div class="alert alert-info">					           
			No Feeds Currently From your Network. Please Follow Your Classmates and Friends
			</div>
			<?php } ?>
	     	</div>

		<div class="col-sm-3">
	   
	<div class="panel panel-default panel-alt widget-messaging">
          <div class="panel-heading">
              <div class="panel-btns">
                <a href="#" class="panel-edit"><i class="fa fa-users"></i></a>
              </div><!-- panel-btns -->
              <h3 class="panel-title">Activity</h3>
            </div>
            <div class="panel-body">
			    <?php if(empty($follow_activity)){ ?>
				 <div class="alert alert-info">
				 You have No Activity on the Graph
				 </div>
				<?php } else{ ?>
				
				<?php foreach ($follow_activity as $va) { ?>
              <ul>
                <li>
				  <?php $datetime = new DateTime($va['time_started']); ?>
				  <small class="pull-right timeago text-muted" title="<?php echo $datetime->format(DateTime::ISO8601) ?>"></small>
                  <h4 class="sender"><a href="<?php echo base_url($va['firstname']. "." .$va['lastname']) ?>"><?php echo $va['firstname'] ?></a> is now following you</h4>
                </li>               
				<?php } 
			  } ?>
              </ul>
            </div><!-- panel-body -->
          </div>			
		  
	
      </div>
	  
	  
        </div>
		
      </div><!-- row -->
	
	 