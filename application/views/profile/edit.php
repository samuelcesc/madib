        
        <div class="col-sm-9">
          
          <div class="col-sm-12 col-lg-12"> <!-- messages start -->
                
                <div class="panel panel-default">
                    <div class="panel-body">
                    
             
                    
                    <h4><i class="fa fa-edit"></i>  Edit Profile</h4><hr />
		              <?php if($this->session->flashdata('error')) { ?> 
		                    <div class="alert alert-danger">
		                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		              <?php echo $this->session->flashdata('error'); ?>
		                </div>
		              <?php } ?>
		              
		              <?php if($this->session->flashdata('success')) { ?> 
		                    <div class="alert alert-success">
		                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		              <?php echo $this->session->flashdata('success'); ?>
		                </div>
		              <?php } ?>  
                        <div class="row"> <!-- Send Box -->
                          <form enctype="multipart/form-data" method="post" action="<?php echo base_url('profile/editpicture') ?>">
                           	<div class="col-md-1"></div>
                                
                                <div class="col-md-7">
                                	<h5><strong class="textgreenish"><span class="glyphicon glyphicon-picture"></span> Profile Picture</strong> (Not more than 2mb)</h5>
                                	
                               		<div class="form-group">
                               							<div class="fileupload fileupload-new" data-provides="fileupload">
																<div class="input-append">
											                    <div class="uneditable-input">
											                      <i class="glyphicon glyphicon-file fileupload-exists"></i>
											                      <span class="fileupload-preview"></span>
											                    </div>
																  <span class="btn btn-default btn-file">
											                      <span class="fileupload-new">Select file</span>
											                      <span class="fileupload-exists">Change</span>
											                      <input name="profile_picture" type="file" accept="image/*" />
											                    </span>
																<a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
															</div>
						
															 <div class="form-group">
                                  							  <button class="btn btn-warning pull-right">Update Picture</button>
                               								   </div>
                               			
														</div>
							</form>
							<form method="post" action="<?php echo base_url('profile/UpdateBio') ?>">
	                                		
	                                	<h5><strong class="">BIO</strong></h5>
	                                	<div class="form-group">
	                                	<textarea name="bio_info" id="autoResizeTA" class="form-control" rows="5" style="height: 90px;" placeholder="Short Description of yourself"><?php echo $bio_info  ?></textarea>
                                		</div>
                                		
	                                	<h5><strong class="">INTERESTS</strong></h5>
	                                	<div class="form-group">
	                                	<textarea name="interests" id="autoResizeTA" class="form-control" rows="5" style="height: 90px;" 
	                                	placeholder="Just Keywords Separated By Commas. Example: Marketing, Fashion, Programming, Football..."><?php if($interests) foreach ($interests as $v) {echo $v['interest_name'] . ","; } ?></textarea>
	                                	
                                		</div>
                                		
                                		<div class="form-group">
                                			<button class="btn btn-success pull-right">Save</button>
                                		</div>	
                                		</form>
								<br />
										
	                                		
	                                	<h5><i class="fa fa-users"></i>  <strong class="">SOCIAL</strong><i class="fa fa-linkedin-square pull-right"></i><i class="fa fa-facebook pull-right"></i></h5>
	                                	<form method="post" action="<?php echo base_url('profile/UpdateSocial') ?>">
	                                	<div class="form-group">
	                                	<input type="text" name="facebook" class="form-control" placeholder="Facebook Name"  value="<?php echo $facebook_name ?>" />
	                                	</div>
                                		
                                		<div class="form-group">
	                                		<input type="text" name="linkedin" class="form-control" placeholder="LinkedIn Name " value="<?php echo $linkedin_name ?>" />
	                                	</div>
                                		
                                		<div class="form-group">
                                			<button class="btn btn-darkblue pull-right">Update</button>
                                		</div>	
                                		</form>
								<br />
									    <h5>  <strong class="">YOUR CONTACT DETAILS</strong></h5>
	                                	<form method="post" action="<?php echo base_url('profile/UpdateContacts') ?>">
	                                	<div class="form-group">
	                                	<textarea name="contacts" id="autoResizeTA" class="form-control" rows="5" style="height: 90px;" 
										placeholder="Where and how can people find or meet you easily? Room No, Office, Phone No." ><?php echo $contacts ?></textarea> 
	                                	</div>
                                		
                                		<div class="form-group">
                                			<button class="btn btn-primary pull-right">Save</button>
                                		</div>	
                                		</form>
								<br />
	                                	<h5><strong class="textgreenish">Change Password</strong></h5>
	                                	
	                                	<form method="post" action="<?php echo base_url('profile/changepasswords') ?>">
	                                	   <div class="form-group">
	                    					<input type="password" name="old_password" class="form-control" placeholder="Old Password" required />
	                    					</div>
	                    					
	                    				   	<div class="form-group">
	                    					<input type="password" name="new_password" class="form-control" placeholder="New Password" required />
	                   						 </div>
	                   						 
	                   						 <div class="form-group">
	                    					<input type="password" name="new_r_password" class="form-control" placeholder="Re-type New Password" required />
	                   						 </div>
	                                	    
	                                	     <div class="form-group">
	                                    <button class="btn btn-info pull-right">Change Password</button>
	                               		 </div>
	                                	</form>
	                                	
	                                	                                
                            <div class="col-md-4"></div>
                        </div> <!-- Send Box Ends -->
                        
                    </div><!-- panel-body -->
                    <br />
                </div><!-- panel -->
                
            </div>
       
        
        
        </div><!-- col-sm-9 -->
      </div><!-- row -->
      
    </div><!-- contentpanel -->