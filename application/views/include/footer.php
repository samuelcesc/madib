</div><!-- mainpanel -->
  
</section>

   <script src="<?php echo base_url('assets/js/jquery-1.10.2.min.js') ?>"></script>
   <script src="<?php echo base_url('assets/js/jquery-migrate-1.2.1.min.js') ?>"></script>
   <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
   <script src="<?php echo base_url('assets/js/modernizr.min.js') ?>"></script>
   <script src="<?php echo base_url('assets/js/jquery.sparkline.min.js') ?>"></script>	
   <script src="<?php echo base_url('assets/js/toggles.min.js') ?>"></script>
   <script src="<?php echo base_url('assets/js/retina.min.js') ?>"></script>
   <script src="<?php echo base_url('assets/js/jquery.cookies.js') ?>"></script>
   <script src="<?php echo base_url('assets/js/bootstrap-fileupload.min.js') ?>"></script>
   <script src="<?php echo base_url('assets/js/typeahead.bundle.js') ?>"></script>
   <script src="<?php echo base_url('assets/js/typeahead.bundle.js') ?>"></script>
   <script src="<?php echo base_url('assets/js/jquery.livequery.js') ?>"></script>
   <script src="<?php echo base_url('assets/js/jquery.timeago.js') ?>"></script>		

   
   <script src="<?php echo base_url('assets/js/jquery.prettyPhoto.js') ?>"></script>
   <script src="<?php echo base_url('assets/js/holder.js') ?>"></script>
   
   <script src="<?php echo base_url('assets/js/custom.js') ?>"></script>
   
   <script type="text/javascript">
	$(document).ready(function(){
	$("small.timeago").timeago();
	});
   </script>
   
   <script>
  jQuery(document).ready(function(){
    
    jQuery("a[rel^='prettyPhoto']").prettyPhoto();
    
    //Replaces data-rel attribute to rel.
    //We use data-rel because of w3c validation issue
    jQuery('a[data-rel]').each(function() {
        jQuery(this).attr('rel', jQuery(this).data('rel'));
    });
    
  });
</script>


<script type="text/javascript">
	var btn = $('.btn-follow');
btn.click(h);
btn.hover(hin, hout);

function hin() {
    if (btn.hasClass('follow')) {
        btn.text('Unfollow');
        btn.removeClass('btn-success');
        btn.addClass('btn-danger');
    } else {
        btn.addClass('btn-success');
    }
}

function hout() {
    if (btn.hasClass('follow')) {
        btn.text('Following');
        btn.removeClass('btn-danger');
        btn.addClass('btn-success follow');
    }
    	btn.addClass('btn-success');
    
}

function h() {
    if (btn.hasClass('follow')) {
        btn.removeClass('btn-success follow');
        btn.text('Follow');
        btn.removeClass('btn-danger');
    } else {
        btn.text('Following');
        btn.addClass('btn-success follow');
         
    }
}
</script>

<script type="text/javascript">

$(document).ready(function(){
	
	$(".followw").click(function(){
		//var $this = $('.followw');
		
        var userid = $(this).attr("rel");
        var datastring = 'user_id=' + userid;
        //alert(datastring);
        
        
        //alert(0);
        if ($(this).hasClass('btn-success')) {
        	var url = "<?php echo base_url(); ?>me/follow/"+userid;
	        $.get(url, function(o){
	        	//alert(o);
	        });
	        $(this).addClass("unfolloww");
	        
        }else if ($(this).hasClass('unfolloww')) {
        	var url = "<?php echo base_url(); ?>me/unfollow/"+userid;
        	//alert(url);
	        $.get(url, function(o){
	        	//alert(o);
	        });
	        $(this).removeClass("unfolloww");
        }
	});
});

</script>

<script>
$(document).ready(function(){
$("a.timeago").livequery(function() 
{ 
	$(this).timeago(); 
});	
});
</script>

<script type="text/javascript">
	var substringMatcher = function(strs) {
  return function findMatches(q, cb) {
    var matches, substringRegex;
 
    // an array that will be populated with substring matches
    matches = [];
 
    // regex used to determine if a string contains the substring `q`
    substrRegex = new RegExp(q, 'i');
 
    // iterate through the pool of strings and for any string that
    // contains the substring `q`, add it to the `matches` array
    $.each(strs, function(i, str) {
      if (substrRegex.test(str)) {
        // the typeahead jQuery plugin expects suggestions to a
        // JavaScript object, refer to typeahead docs for more info
        matches.push({ value: str });
      }
    });
 
    cb(matches);
  };
};
 
var states = ['Samuel Ojumah', 'Parido Alaba', 'Raymond Ativie', 'Osagie Eigbe', 'John Okon',
  'Colorado', 'Connecticut', 'Ojeagbase Samson', 'Ohenhen Osamagbe', 'Georgia', 'Hawaii',
  'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana'
];

$('#the-basics .typeahead').typeahead({
  hint: true,
  highlight: true,
  minLength: 1
},
{
  name: 'states',
  displayKey: 'value',
  source: substringMatcher(states)
});
</script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-50985149-1', 'thecoursegraph.com');
  ga('send', 'pageview');

</script>

</body>
</html>
