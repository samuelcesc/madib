       
        <div class="col-sm-6">
        	
          <section class="panel panel-default">
        	         
        	         <div class="panel-heading">
                    <h4 class="panel-title">Your Feeds</h4>
                </div><!-- panel-heading -->
                    
                    <div class="panel-body">
                    <?php if(empty($news_feed)) { ?>
                    <div class="alert alert-warning alert-dismissable">
                    	You have no shared content.
                    </div>
                    <?php } ?>
			        <div class="contentpanel">
      
      <div class="row">
      	<div class="col-md-12">
      		
      		<!-- POST BOX -->
        <!-- POST BOX ENDS -->
        <hr /> 
        <!------POST START----->			<?php if(!empty($news_feed)){ foreach ($news_feed as $v) { ?>
       											<div class="media nomarginbottom nomargintop">
												<a href="<?php echo base_url('user') . "/". $v['firstname'] . ".".$v['lastname'] ?>" class="pull-left"> <img width="48" height="48" alt="" src="<?php echo base_url('user_images').$v['location'] ?>" class="avatar media-object"> </a>
												<div class="media-body nomarginbottom">
													<span class="media-meta pull-right"><small>2 hours ago</small> </span>
													<a href="<?php echo base_url('user') . "/". $v['firstname'] . ".".$v['lastname'] ?>"><h5 class="text-primary nomargintop"><?php echo $v['firstname'] . " ".$v['lastname'] ?></h5></a>

													<p class="nomargintop">
														<?php echo $v['post_content'] ?>
													</p>
													
												</div>

												<hr class="nomargintop"  />
													</div>

												<?php } 
												
												} else {?>
													
													<div class="alert alert-info">
													           
														No Feeds Currently From your Network. Please Follow Your Classmates and Friends</div>
												<?php } ?>	 	
													<!------POST END----->

											</div>
          </div>
      		
      		
      		
      		
      		
      	</div>
      	
      	
      	
      </div>
      
    </div>
        
        
        </section>
      </div><!-- row -->
      
    </div><!-- contentpanel -->
  </div><!-- mainpanel -->