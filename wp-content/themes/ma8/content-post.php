<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if(is_single()) : ?>
		<h1><?php the_title(); ?></h1>
			<?php 
			if ( has_post_format( 'gallery' ) ) {
			} elseif ( has_post_format( 'image' ) ) {
			} else {
				if ( has_post_thumbnail() ) {
					the_post_thumbnail( 'single-page-thumb' );
				} 
			}
			?>
		<?php the_content(); ?>
		<?php wp_link_pages(); ?>
		<?php if( of_get_option('single_post_meta_switch') == 1 ) : ?>
		<div class="meta">
			<ul>
				<?php if(has_category()) { ?><li><?php _e('In','MA8'); ?> <?php the_category(', '); ?></li><?php } ?>
				<li><?php the_time('F j, Y'); ?></li>
				<?php if(has_tag()) { ?><li><?php the_tags( ' Tagged ' , ' , '); ?></li><?php } ?>
			</ul>
		</div>
		<?php endif; ?>
		</article>
		<?php if( of_get_option('author_info_box_switch') == 1 ) : ?>
		<div class="author-box">
			<div class="avatar">
				<?php echo get_avatar( get_the_author_meta('email'), '150' ); ?>
			</div>
			<div class="bio">
				<h5><?php _e('Written by','MA8'); ?> <?php the_author_posts_link(); ?></h5>
				
				<?php if ( get_the_author_meta('description') != '' )  { ?>
				<p><?php the_author_meta('description'); ?></p>
				<?php } ?>
				
				<div class="author-post-count"><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" title="<?php echo esc_attr(count_user_posts(get_the_author_meta('ID'))); ?> <?php _e('Posts','MA8'); ?>"><?php _e('Posts:','MA8'); ?> <?php echo count_user_posts(get_the_author_meta('ID')); ?></a>
				</div>
				
				<?php if ( get_the_author_meta( 'facebook' ) != '' || get_the_author_meta( 'twitter' ) != '' ||  get_the_author_meta( 'googleplus' ) != '' )  { ?>
				<ul>
					<?php if ( get_the_author_meta( 'facebook' ) != '' )  { ?>
					<li><a target="_blank" href="<?php esc_url(the_author_meta('facebook')); ?>"><i class="fui-facebook"></i></a></li>
					<?php } ?>					
					
					<?php if ( get_the_author_meta( 'twitter' ) != '' )  { ?>
					<li><a target="_blank" href="<?php esc_url(the_author_meta('twitter')); ?>"><i class="fui-twitter"></i></a></li>
					<?php } ?>
						
					<?php if ( get_the_author_meta( 'googleplus' ) != '' )  { ?>
					<li><a target="_blank" href="<?php esc_url(the_author_meta('googleplus')); ?>"><i class="fui-googleplus"></i></a></li>
					<?php } ?>
				</ul>
				<?php } ?>
			</div>
		</div>
		<?php endif; ?>
		<?php comments_template(); ?>
	<?php elseif( is_author() ) : ?>
			<div class="author-post-list">
				<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><span class="fui-arrow-right"></span><?php the_title(); ?></a></h2>
			</div>

	<?php else : ?>
		<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
			<?php 
				if ( has_post_thumbnail() ) : ?>
					<a class="post-link" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<?php the_post_thumbnail( 'single-page-thumb' ); ?>
					</a>
					<div style="clear: both;"></div>
				<?php endif; ?>
		
		<?php the_excerpt(); ?>
		<p class="more"><a href="<?php the_permalink(); ?>"><?php _e('Full View','MA8'); ?> &rarr;</a></p>

		<div class="meta meta-space">
			<?php if( of_get_option('archive_meta_switch') == 1 ) : ?>
			<ul>
				<li><?php _e('By','MA8'); ?> <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php the_author(); ?>"><?php the_author(); ?></a></li>
				<li><?php the_time('F j, Y'); ?></li>
				<?php if(has_category()) { ?><li><?php _e('In','MA8'); ?> <?php the_category(', '); ?></li><?php } ?>
				<?php if(has_tag()) { ?><li><?php _e('Tagged','MA8'); the_tags( ' ' , ' , '); ?></li><?php } ?>
			</ul>
			<?php endif; ?>
		</div>
		</article>
	<?php endif; ?>