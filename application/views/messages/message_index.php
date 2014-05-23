
        <div class="col-sm-6">
          
          
          <div class="col-sm-12 col-lg-12"> <!-- messages start -->
                
                <div class="panel panel-default">
                    <div class="panel-body">
                      
                       <!--<h5 class="subtitle">PRIVATE MESSAGES</h5>!-->
                        <h4 class=""><i class="fa fa-envelope text-danger"></i> Messages</h4>
                        <br /><?php if(empty($messages)){ ?>
                        <div class="alert alert-info">
                        	You have no messages in your inbox.
                        </div>
                        <?php } ?>
                        
                        <div class="table-responsive">
                            <table class="table table-email">
                              <tbody>
                              	<?php foreach ($messages as $value) { ?>
								
                                <tr class="unread">
                                  <td>
                                    <div class="media">
                                        <a href="<?php echo base_url('messages/conversations')."/". $value['c_id'] ?>" class="pull-left">
                                          <img alt="" height="48" src="<?php echo base_url('user_images').$value['profile_picture'] ?>" class="media-object">
                                        </a>
                                        <div class="media-body">
										<?php if($value['status'] == 0){ ?>
										<span class="badge pull-right badge-success">new</span>
										<?php } ?>
										<?php $datetime = new DateTime($value['time']); ?>
										<small class="media-meta pull-right timeago" title="<?php echo $datetime->format(DateTime::ISO8601) ?>"></small>
                                           
											<h4 class="text-primary"><?php echo $value['firstname']." ".$value['lastname'] ?></h4>
                                            <p class="email-summary"><?php echo $value['reply'] ?> </p>
											<a href="<?php echo base_url('messages/conversations')."/". $value['c_id'] ?>"><span class="pull-right text-warning" >View</span></a>
                                        </div>
                                    </div>
                                  </td>
                                </tr>
                                
                                <?php } ?>
                                
                              </tbody>
                            </table>
                        </div><!-- table-responsive -->
                        
                    </div><!-- panel-body -->
                </div><!-- panel -->
                
            </div>
       
        
        
        </div><!-- col-sm-9 -->
      </div><!-- row -->
      
    </div><!-- contentpanel -->
  </div><!-- mainpanel -->
  
 
</section>


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
                                         <input name="recipient_name" type="text" class="form-control typeahead" id="inputEmail1" placeholder="">
                                       </div>
                                     </div>                                 
                                            
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
