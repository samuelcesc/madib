 <div class="contentpanel">
      
      <div class="row">
        <div class="col-sm-3">
        
              <div class="leftpanelinner">
        <div class="row">
        <div class="col-sm-12">
        
           <img width="590" height="656" src="<?php echo base_url('user_images')."/".$profile_picture ?>" class="thumbnail img-responsive" alt="" />
			
			<div class="row">
				
			<div class="col-md-4">
              <a href="<?php echo base_url('me/posts') ?>"><h3><?php echo $post_count ?></h3>
                 Posts
            </div></a> 
            
             <div class="col-md-4">
              <a href="<?php echo base_url('me/following') ?>"><h3><?php echo $following_count ?></h3>
               Following
              </div></a>     
                                      
              <div class="col-md-4">
               <a href="<?php echo base_url('me/followers') ?>"> <h3><?php echo $followers_count ?></h3>
                   Followers
               </div></a>

         	  </div>
        
        
        </div>
        
        
        </div>
      
        
    </div><!-- leftpanelinner -->
          
        </div><!-- col-sm-3 -->
        
        <div class="col-sm-9 ">
          
          <section class="panel">
        
			        <div class="contentpanel">
      
      <div class="row">
      	<div class="col-md-8">
      		
      		Courses
        <hr /> 
        
        <!------POST START----->			<?php if(!empty($news_feed)){ foreach ($news_feed as $v) { ?>
			
       											<div class="media nomarginbottom nomargintop">
												<a href="<?php echo base_url('user') . "/". $v['firstname'] . ".".$v['lastname'] ?>" class="pull-left"> <img width="85" height="85" alt="" src="<?php echo base_url('user_images')."/".$v['location'] ?>" class="avatar media-object"> </a>
												<div class="media-body nomarginbottom">
													<span class="media-meta pull-right">about 2 hours ago</span>
													<h5 class="text-primary nomargintop"><?php echo $v['firstname'] . " ".$v['lastname'] ?></h5>

													<p class="email-summary nomargintop">
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
														
      	<div class="col-md-4">
      		
      		<div class="panel panel-default">
            <div class="panel-heading">
             <!--  <div class="panel-btns">
                <a href="#" class="panel-close">×</a>
                <a href="#" class="minimize">−</a>
              </div> panel-btns -->
              <h3 class="panel-title">Suggestions</h3>
            </div>
            <div class="panel-body">
              
			<!------SUGGESTION START----->
													<div class="media">

														<div class="row">
															<div class="col-md-4">
																<a href="#" class="pull-left"> <img alt="" src="images/photos/user3.png" class=" avatar media-object"> </a>
															</div>

															<div class="col-md-8 ">

																<a href="#"><h6 class="nomargintop nomarginbottom">Zaham Sindilmaca</h6></a>
																<p class="nomarginbottom nomargintop">
																	<i class="fa fa-user"></i> Professor
																</p>
																<button class="nomargintop btn btn-success btn-xs">
																	<i class="fa fa-user"></i> Follow
																</button>

															</div>

														</div>
													</div><hr />
													<!-----SUGGESTION END----->
													
													<!------SUGGESTION START----->
													<div class="media">

														<div class="row">
															<div class="col-md-4">
																<a href="#" class="pull-left"> <img alt="" src="images/photos/user3.png" class=" avatar media-object"> </a>
															</div>

															<div class="col-md-8 ">

																<a href="#"><h6 class="nomargintop nomarginbottom">Zaham Sindilmaca</h6></a>
																<p class="nomarginbottom nomargintop">
																	<i class="fa fa-user"></i> Professor
																</p>
																<button class="nomargintop btn btn-success btn-xs">
																	<i class="fa fa-user"></i> Follow
																</button>

															</div>

														</div>
													</div><hr />
													<!-----SUGGESTION END----->
													
													<!------SUGGESTION START----->
													<div class="media">

														<div class="row">
															<div class="col-md-4">
																<a href="#" class="pull-left"> <img alt="" src="images/photos/user3.png" class=" avatar media-object"> </a>
															</div>

															<div class="col-md-8 ">

																<a href="#"><h6 class="nomargintop nomarginbottom">Zaham Sindilmaca</h6></a>
																<p class="nomarginbottom nomargintop">
																	<i class="fa fa-user"></i> Professor
																</p>
																<button class="nomargintop btn btn-success btn-xs">
																	<i class="fa fa-user"></i> Follow
																</button>

															</div>

														</div>
													</div><hr />
													<!-----SUGGESTION END----->
													
													<!------SUGGESTION START----->
													<div class="media">

														<div class="row">
															<div class="col-md-4">
																<a href="#" class="pull-left"> <img alt="" src="images/photos/user3.png" class=" avatar media-object"> </a>
															</div>

															<div class="col-md-8 ">

																<a href="#"><h6 class="nomargintop nomarginbottom">Zaham Sindilmaca</h6></a>
																<p class="nomarginbottom nomargintop">
																	<i class="fa fa-user"></i> Professor
																</p>
																<button class="nomargintop btn btn-success btn-xs">
																	<i class="fa fa-user"></i> Follow
																</button>

															</div>

														</div>
													</div><hr />
													<!-----SUGGESTION END----->
													
													</div>
													
													</div>
													

            </div>
          </div>
      		
      		
      		
      		
      		
      	</div>
      	
      	
      	
      </div>
      
    </div>
        
        
        </section>
      </div><!-- row -->
      
    </div><!-- contentpanel -->
  </div><!-- mainpanel -->