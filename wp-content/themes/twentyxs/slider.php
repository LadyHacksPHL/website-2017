<script type="text/javascript">
/* <![CDATA[ */
jQuery('#featured_slider ul').cycle({ 
fx: 'scrollHorz',
prev: '.feat_prev',
next: '.feat_next',
speed:  1050, 
timeout: 4000, 
});
/* ]]> */
</script>
<div id="featured_slider">
	<ul id="slider">
<?php
/*custom query to make sure the slider does not reset with the pagination.*/
  $ttv_args=array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'post__in'=>get_option('sticky_posts'),
    'ignore_sticky_posts'=> 1
    );
  $ttv_query = null;
  $ttv_query = new WP_Query($ttv_args);
  if( $ttv_query->have_posts() ) {
    while ($ttv_query->have_posts()) : $ttv_query->the_post(); 
	?>
		<li>
		<div class="ttv_slider">
			<h2 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>

<!-- 			<?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it. ?>
				<?php the_post_thumbnail();?>
			<?php } ?>
-->
<div class="entry-summary"><?php the_excerpt();?></div>
			</div>
		</li>
		<?php
	endwhile;
  }
	 ?>
	</ul>
	<div class="feat_next"></div>
	<div class="feat_prev"></div>
</div>
<?php wp_reset_postdata(); //reset	?>