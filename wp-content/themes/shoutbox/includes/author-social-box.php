<?php 
global $avia_config;
?>
	
	
		<div class='post-entry' id="post-meta-box">
				<div class='social-box'>
				<?php 
					
					   echo "<h3 class='miniheading'>";
					  _e('Enjoyed this Post?','avia_framework');
					  echo "</h3>";
					  echo "<div class='minitext'>";
					  _e('Subscribe to our','avia_framework');
					  echo " <a href='";
					  echo avia_option('feedburner',get_bloginfo('rss2_url'));
					  echo "'>RSS Feed</a>, ";
					  
					  if($twitter = avia_get_option('twitter')) 
					  {
					  		_e('Follow us on ');
					  		echo "<a title ='' href='http://twitter.com/".$twitter."'>Twitter</a> ";
					  }
					  _e('or simply recommend us to friends and colleagues!','avia_framework');
					 echo "</div>";
				?>
					<div class='share_stuff'>
											    			
						<!-- AddToAny BEGIN -->
						<a class="a2a_dd" href="http://www.addtoany.com/share_save"><?php _e('Share this post','avia_framework'); ?></a>
						<script type="text/javascript" src="http://static.addtoany.com/menu/page.js"></script>
						<!-- AddToAny END -->
						
						<!-- Facebook add BEGIN -->
						<a class="fb_share" type="box_count" href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>"><?php _e('Share on facebook','avia_framework'); ?></a>
						<!-- Facebook add END -->				
					
					</div>
				
				</div>
			
			<div class='author-box'>
			
			    <div class="author-box-gravatar">
					<?php 
						$author_email = get_the_author_meta('email');
				        echo get_avatar( $author_email, $size = '48');
					 	
					?>
				</div>
		    	<div class="author-info">
		        <h3 class='miniheading'><?php _e('written by ','avia_framework');?> <?php the_author_posts_link();?></h3>
		        <?php 
		        echo "<div class='minitext'>";
		        $description = get_the_author_meta('description');
		        if($description  != '')
		        {
		        	echo $description;
		        }
		        else
		        {
		        	_e('The author didn‘t add any Information to his profile yet.','avia_framework');
		        }
		        echo "</div>";
		        ?> 
		    	</div> 
		    </div>
		   </div>