<?php get_header('alt'); ?>
	<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/lightbox2/2.10.0/css/lightbox.css">
<!-- Row for main content area -->

	<!-- <div class="post-banner" style="background-image: url(<?php //echo wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())); ?>);">
		<img src="<?php //echo wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())); ?>">
	</div> -->
	
	<div class="page-template-full">
		<div id="content" role="main" class="event-single-post-template" >
		
		<?php /* Start loop */ ?>
		<?php while (have_posts()) : the_post(); ?>
			<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
				<div class="row">
					<div class="small-12 columns">
						<div class="row">
							<div class="large-6 column">
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
							<?php the_content(); ?>
						</div>

						<div class="cs-custom-fields row">
							<div class="medium-12 columns"><div class="separator"></div></div>
							<div class="medium-7 columns">
								<div class="cs-gallery">
									<?php $gallery = get_field('cs_gallery', get_the_ID(), TRUE); ?>
									<?php if($gallery) : ?>
							        	<h4><i class="fa fa-picture-o" aria-hidden="true"></i> Gallery</h4>
								        <ul class="medium-block-grid-2 gallery">
								        <?php foreach ($gallery as $image) : ?>
								        	<li class="nopadding"><a href="<?php echo $image['sizes']['large']; ?>" data-lightbox="gallery1"><img src="<?php echo $image['sizes']['thumbnail']; ?>"></a></li>
								        <?php endforeach; ?>
										</ul>
									<?php endif; ?>
								</div>
							</div>
							<div class="medium-5 columns">
								<div class="cs-attachments">
									<?php $attachments = get_field('cs_attachments', get_the_ID()); ?>

									<?php if($attachments) : ?>
										<?php foreach($attachments as $attachment) : ?>
											<div class="attachment">
											<h4><?php echo $attachment['cs_attachment_label']; ?></h4>
											<?php $files = $attachment['cs_attachment_files']; ?>

											<?php foreach($files as $file) : ?>
												<?php if($file['add_file']) : ?>
													<a href="<?php echo $file['cs_file']['url']; ?>" target="_blank"><i class="icon-pdf"></i> <?php echo $file['cs_file']['title']; ?></a>
												<?php else : ?>
													<a href="<?php echo $file['cs_file']['url']; ?>" target="_blank"><i class="icon-pdf"></i> <?php echo $file['cs_file']['title']; ?></a>
												<?php endif; ?>
											<?php endforeach; ?>
											</div>
										<?php endforeach; ?>
									<?php endif; ?>
								</div>
								<?php if (get_field('event_media')): ?>
									<div class="cs-press-release">
										<h4>Press Release</h4>
										<?php
										if( have_rows('event_media') ): ?>
											<ul class="press-releases">
										    <?php while ( have_rows('event_media') ) : the_row();
										    	$media_page = get_sub_field('media_page'); ?>
										        <li><a href="<?php echo get_the_permalink($media_page->ID); ?>"><?php echo get_the_title($media_page->ID); ?></a></li>
											<?php endwhile; ?>
											</ul>
										<?php endif; ?>
									</div>
								<?php endif; ?>
							</div>
							<?php if (get_field('press_reviews')): ?>
								<div class="medium-12 columns">
									<div class="cs-press-reviews">
										<h4>Press Reviews</h4>
										<?php
										if( have_rows('press_reviews') ): ?>
											<ul class="press-reviews">
										    <?php while ( have_rows('press_reviews') ) : the_row();
										    	$review = get_sub_field('reviews'); 
										    	$review_link = get_sub_field('review_link');
										    	?>
										        <li><a href="<?php echo $review_link; ?>" target="_blank"><?php echo $review; ?></a></li>
											<?php endwhile; ?>
											</ul>
										<?php endif; ?>
									</div>
								</div>
							<?php endif; ?>
						</div>

						<a href="javascript:window.history.back();" id="global-prev-button">&laquo; Back</a>
		
						<?php //endif; ?>
					</div>
					<?php //get_sidebar(); ?>
				</div>
				<?php 
					echo do_shortcode('[post-footer post_type="consultation_session" icon="event-related-icon" title="consultations"]');?>
			</article>
		<?php endwhile; ?>

		</div>
	</div>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lightbox2/2.10.0/js/lightbox.min.js"></script>
<?php get_footer('alt'); ?>