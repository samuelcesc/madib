       
        <div class="col-sm-6">
          
          
          <div class="col-sm-12 col-lg-12"> <!-- messages start -->
                
                <div class="panel panel-default">
                    <div class="panel-body">
                        
                        <h4 class="pull-left"><i class="fa fa-users text-danger"></i> Conversation</h4>
						<a href="<?php echo base_url('messages') ?>"><button class="btn btn-white btn-sm pull-right mr5" ><i class="fa fa-arrow-left"></i>  Back to Messages</button></a>
                                               <div class="table-responsive">
                            <table class="table table-email">
                            <tbody>
                              	<?php foreach ($messages as $value) { ?>
                                <tr class="unread">
                                  <td>
                                    <div class="media">
                                        <a href="#" class="pull-left">
                                          <img alt="" height="48" src="<?php echo base_url('user_images').$value['profile_picture'] ?>" class="media-object">
                                        </a>
                                        <div class="media-body">
										<?php $datetime = new DateTime($value['time']); ?>
                                            <small class="media-meta pull-right timeago" title="<?php echo $datetime->format(DateTime::ISO8601) ?>"></small>
											<h4 class="text-primary"><?php echo $value['firstname']." ".$value['lastname'] ?></h4>
                                            <small class="text-muted"></small>
                                            <p class="email-summary"><?php echo $value['reply'] ?> </p>
                                        </div>
                                    </div>
                                  </td>
                                </tr>
                                <?php } ?>
                                
                              </tbody>
                            </table>
                        </div><!-- table-responsive -->
                        <br /><br />
                        <hr>
                         <div class="row"> <!-- Send Box -->
                            <div class="col-md-1"></div>
                                
                                <div class="col-md-12">
                                
                                <form method="post" action="<?php echo base_url('messages/reply') ?>">
								<input name="conversation" type="hidden" value="<?php echo $messages[0]['c_id'] ?>" />	
							    <div class="form-group">
									<textarea name="message" id="autoResizeTA" class="form-control" rows="5" autofocus="true" placeholder="Write a Message" style="height: 60px;"></textarea>
                                </div>
                                
                                <div class="form-group">
                                    <button class="btn btn-success pull-right"><span class="glyphicon glyphicon-send"></span>  Reply</button>
                                </div>
                                
                                </form>
                                
                                </div>
                            <div class="col-md-1"></div>
                        </div> <!-- Send Box Ends -->


                    </div><!-- panel-body -->
                </div><!-- panel -->
                
            </div>
       
        
        
        </div><!-- col-sm-9 -->
      </div><!-- row -->
      
    </div><!-- contentpanel -->
  </div><!-- mainpanel -->
  
 
</section>
