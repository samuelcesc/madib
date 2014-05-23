        <div class="col-sm-6">
          
          <div class="col-sm-12 col-lg-12"> <!-- messages start -->
                
                <div class="panel panel-default">
                    
                    <div class="panel-heading">

                    <h4 class="panel-title">Search results for "<?php echo $_GET['s'] ?>"</h4>
                    
                </div><!-- panel-heading -->
                    
                    <div class="panel-body">
                    
                    <?php if(empty($search_results)){ ?>
                    <div class="alert alert-warning">
                    	No users were found for this search.
                    </div>
                    <?php } ?>
                    
               <div class="results-list">
                   
		<?php foreach ($search_results as $s) {	?>
              
              <div class="media">
                
                <a href="<?php echo base_url('user')."/". $s['firstname'] . ".".$s['lastname']  ?>" class="pull-left">
                  <img height="126" width="126" alt="" src="<?php echo base_url('user_images').$s['profile_picture'] ?>" class="thumbnail media-object">
                </a>
                
                <div class="media-body">
                 <a href="<?php echo base_url('user')."/". $s['firstname'] . ".".$s['lastname']  ?>"> <h4 class="person-name"><?php echo $s['firstname'] . " ".$s['lastname']  ?></h4></a>
                  <div class="profile-position"><i class="fa fa-book"></i><?php echo $s['program_name'] ?></div>
                  <div class="mb20"></div>
                 <a href="<?php echo base_url('user')."/".$s['firstname'] .".".$s['lastname'] ?>"><button class="btn btn-white mr5"><i class="fa fa-user"></i> View Profile</button></a>
                  </div>
              
              </div>
         <?php } ?>     
              
                          
            </div><!-- results-list -->
            
                    </div><!-- panel-body -->
                    <br />
                </div><!-- panel -->
                
            </div>
       
        
        </div><!-- col-sm-6 -->
		
		<div class="col-md-3">
		
		 <section class="panel">
        
			 <div class="contentpanel">
				
			  <div class="row">
				
				<div class="col-md-12">
				<h5>ADVANCED SEARCH</h5>
				<hr>
				
				<form action="http://localhost/madib/signup/next" method="post" accept-charset="utf-8">
				<input class="form-control input-sm" name="keyword" type="text" placeholder="Enter a Keyword" />
				<select class="form-control input-sm" name="user" required="">
                    	<option value="student">-Select Course-</option>
                </select>
				
				<select class="form-control input-sm" name="user" required="">
                    	<option value="student">-Select Interest-</option>
                </select>
				<br>
				<button type="submit" class="pull-right btn btn-info btn-xs">Go</button>
				</form>
				
				</div>
			  
			  </div>
			
			</div>
			
		</section>

		</div>
		
		
      </div><!-- row -->
      
    </div><!-- contentpanel -->
