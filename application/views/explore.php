
        <div class="col-sm-9">

		<div class="alert alert-info">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
		<b>Explore Communities and Find People who have similar interests.</b>
		</div>	
		
		<?php foreach($interests as $v){ ?>
		<div class="col-sm-3">
		  <div class="blog-item">
            <a href="<?php echo base_url('explore/interests')."/".$v['interest_name'] ?>" class="blog-img"><img style="height:127px; width:224px;"   src="<?php echo base_url('interest_images')."/".$v['interest_img'] ?>" class="img-responsive" alt=""></a>
            <div class="blog-details">
              <h4 class="blog-title"><a href="<?php echo base_url('explore/interests')."/".$v['interest_name'] ?>"><?php echo $v['interest_name'] ?></a></h4>
              <ul class="blog-meta">
                <li><i class="fa fa-users"></i> <?php echo $v['user_count'] ?> </li>
              </ul>
            </div>
          </div>
		</div>
		<?php } ?>
		
       </div>

	   </section>
		
		
      </div>
	  
	  
        </div>
		
      </div><!-- row -->
	
