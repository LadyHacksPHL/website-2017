<?php get_header(); ?>
<div class="content-container">
			<div class="content-wrapper">
				<section class="articles">
					<div class="author-box">
							
							<?php 
							$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
							?>
						
						<div class="bio">
							<h1 class="head"><span class="author-nicename">

								<?php 
								if($curauth->user_firstname && $curauth->user_lastname){
									echo $curauth->user_firstname.' '.$curauth->user_lastname;
								} else {
									echo $curauth->display_name;
								}
								_e("'s Archive","MA8");
								 ?></span></h1>
							
							<?php 
							
							echo get_avatar( $curauth->ID , 200 , '', $curauth->display_name); 
							
							?>
							
							<?php 
							if( $curauth->description==true ) : ?>
								<p>
									<strong><?php _e('Bio:','MA8'); ?> </strong> 
									<?php echo $curauth->description; ?>
								</p>
							<?php endif; ?>
							
							<div class="author-post-count count-archive"><p>
								<?php _e('Total Posts','MA8');?> :
								<?php echo count_user_posts($curauth->ID); ?></p>
							</div>
							
							<?php 
							if($curauth->facebook==true || $curauth->twitter==true || $curauth->googleplus==true) {
														
							echo '<ul><li><a target="_blank" href="' . esc_url($curauth->facebook) . '"><i class="fui-facebook"></i></a></li>';
							echo '<li><a target="_blank" href="' . esc_url($curauth->twitter) . '"><i class="fui-twitter"></i></a></li>';
							echo '<li><a target="_blank" href="' . esc_url($curauth->googleplus) . '"><i class="fui-googleplus"></i></a></li></ul>';
							}
							?>
							
						</div>
					</div>
				
<?php if( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<?php get_template_part('content', 'post'); ?>
<?php endwhile; else: ?>
	<p><?php _e('There are no posts or pages to display.','MA8'); ?></p>
<?php endif; ?>
	<div class="post-nav">
<?php MA8_pagination(); ?>
</div>
</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>