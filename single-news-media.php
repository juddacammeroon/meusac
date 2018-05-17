<?php get_header('alt'); ?>

<!-- Row for main content area -->
	<div id="content" role="main" class="event-single-post-template">
	
	<?php /* Start loop */ ?>
	<?php while (have_posts()) : the_post(); ?>
		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<div class="row">
				<div class="small-12 large-12 columns">
					<div class="row">
						<div class="large-12 column">
							<header>
								<div class="section-header-block">
									<div class="section-wrapper">
										<h3 class="entry-title theme-color-1" style="margin-bottom: 0px;"><?php the_title(); ?></h3>
										<p class="theme-color-1"><?php the_date('d F Y'); ?></p>
									</div>
								</div>
								<h3><?php the_field('sc_subtitle'); ?></h3>
							</header>
						</div>
					</div>
					<div class="entry-content">
						<div class="row">
							<div class="large-12 columns">
								<?php the_content(); ?>
							</div>
							
						</div>
					</div>
				</div>
				<?php //get_sidebar(); ?>
			</div>
			<?php 
				/*$term_list = wp_get_post_terms( get_the_ID(), 'department', array( 'fields' => 'name' ));
				if(is_array($term_list)){
					$term_list = $term_list[0];
				}*/
			?>
			<?php //echo do_shortcode('[post-footer category_name="news-category" category="'.$term_list.'" post_type="news-media" icon="press-release-review-icon" title="news"]');?>
		</article>
	<?php endwhile; ?>

	</div>
		
<?php get_footer('alt'); ?>