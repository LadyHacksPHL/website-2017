<?php if(of_get_option('slider_switch') == 1) :?>
				<div class="slider-container flexslider">
					<div class="slider-wrapper">
					
						<?php 

						$slider_cat = get_cat_name(of_get_option('slider_category'));
						$slider_quant = of_get_option('slides_quantity');

						$args = array(
							'post_type' => 'post',
							'category_name'	=> $slider_cat,
							'posts_per_page' => $slider_quant,
							'orderby'	=> 'rand',
						);
						
						$the_query = new WP_Query( $args );
						
						?>
						<ul class="slides">
						<?php if ( have_posts() ) : while ($the_query->have_posts() ) : $the_query->the_post(); ?>
							<li>
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<?php 
									
								if ( has_post_thumbnail() ) {
								the_post_thumbnail( 'slider-image' );
								}
															
							 ?>
							 </a>
							 <h2 class="flex-caption"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							</li>
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
						<?php endif; ?>
						
						</ul>
					</div>
				</div>
			<?php endif; ?>

			<?php if(of_get_option('latest_posts_switch') == 1) :?>
			<div class="content-container">
				<div class="content-wrapper">
					
					<p class="head"><?php $title_latest_post = of_get_option('latest_posts_title');
					echo $title_latest_post;
					 ?></p>

					<?php if(of_get_option('slider_switch') == 1) { ?>
						<?php MA8_latest_posts_slider(); ?>
					<?php } ?>

					<?php if(of_get_option('slider_switch') == 0) { ?>
						<?php MA8_latest_posts(); ?>
					<?php } ?>


				</div>
			</div>
			<?php endif; ?>

			<?php if(of_get_option('author_box_switch') == 1) :?>

			<div class="author-container">
				<div class="author-wrapper">
					<p class="head"><?php $title_top_authors = of_get_option('top_authors_title');
					echo $title_top_authors;
					 ?></p>
					<section class="authors">
						<ul>
							<?php
							$taof = of_get_option('top_authors_onfront');
							$args = array(
								'role'		=>	'author',
								'orderby'	=>	'post_count',
								'order'		=>	'DESC',
								'number'	=>	$taof
							);
							
							// The Query
							$user_query = new WP_User_Query( $args );
							
							// User Loop
							if ( ! empty( $user_query->results ) ) {
								foreach ( $user_query->results as $user ) {
									echo '<li><a href="' . get_author_posts_url($user->ID) . '"><figure>' . get_avatar( $user->ID , 350 , '', $user->display_name ) . '</figure></a>';
									
									echo '<h2><a href="' . get_author_posts_url($user->ID) . '">' . $user->display_name . '</a></h2></li>';
								}
							} else {
								echo '<li><h3>No one found.</h3></li>';
							}
							?>
						</ul>
					</section>
					<div class="nav-button">
						<?php 
						$author_page_id = of_get_option('author_list_page'); 
						$author_page_name = get_post($author_page_id)->post_name;
						$author_page_url = get_permalink($author_page_id);
						?>
						<a href="<?php echo $author_page_url; ?>" title="<?php echo $author_page_name; ?>" class="btn btn-huge btn-embossed btn-block btn-danger"><?php $text_top_authors_button = of_get_option('top_authors_button_text');
					echo $text_top_authors_button;
					 ?></a>
					</div>
				</div>
			</div>

			<?php endif; ?>

			<?php if(of_get_option('footer_widgets') == 1) :?>

			<div class="footer-widgets">
				<div class="footer-widgets-wrapper">
					<div class="widgets">
						<ul>
						
						<?php if( dynamic_sidebar( 'footer_left' ) ): ?>
						
						<?php else: ?>
						
							<li>
								<h2><?php _e('Widget Area','MA8'); ?></h2>
								<p><?php _e('Install a nice widget','MA8'); ?></p>
							</li>
						
						<?php endif; ?>
						
						
						<?php if( dynamic_sidebar( 'footer_middle' ) ): ?>
						
						<?php else: ?>
						
							<li>
								<h2><?php _e('Widget Area','MA8'); ?></h2>
								<p><?php _e('Install a nice widget','MA8'); ?></p>
							</li>
						
						<?php endif; ?>
						
						<?php if( dynamic_sidebar( 'footer_right' ) ): ?>
						
						<?php else: ?>
						
							<li>
								<h2><?php _e('Widget Area','MA8'); ?></h2>
								<p><?php _e('Install a nice widget','MA8'); ?></p>
							</li>
						
						<?php endif; ?>
						
						</ul>
					</div>
				</div>
			</div>

		<?php endif; ?>