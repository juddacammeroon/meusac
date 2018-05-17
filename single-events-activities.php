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
								<div class="cs-video">

									<?php $video = get_field('video', get_the_ID()); ?>
									<?php
									if($video):?>
									  <h4><i class="fa fa-file-video-o" aria-hidden="true"></i>News Feature</h4>
								       <?php echo $video;
									endif; ?>
								</div>
								<div class="cs-gallery">
									<?php
									$counter = 0;
									if( have_rows('galleries') ):
									    while ( have_rows('galleries') ) : the_row(); $counter++;
									    	$heading = get_sub_field('heading');
									        $gallery = get_sub_field('gallery'); ?>
									        <h4><i class="fa fa-picture-o" aria-hidden="true"></i> <?php echo $heading; ?></h4>
									        <ul class="medium-block-grid-2 gallery">
									        <?php foreach ($gallery as $image) : ?>
									        	<li class="nopadding"><a href="<?php echo $image['sizes']['large']; ?>" data-lightbox="<?php echo $heading; ?>" ><img src="<?php echo $image['sizes']['thumbnail']; ?>"></a></li>
									        <?php endforeach; ?>
											</ul>
										<?php endwhile;  
									endif; ?>
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
											<!-- <ul class="press-releases"> -->
										    <?php while ( have_rows('event_media') ) : the_row();
										    	$media_page = get_sub_field('media_page'); ?>
										    	<?php 
										    		$post_date = get_the_date('d.m.y',$media_page->ID);
										    		echo do_shortcode('[custom-link link="'.get_the_permalink($media_page->ID).'" title="'.$post_date.'-'.get_the_title($media_page->ID).'"]');
										    	?>
										        <!-- <li><a href="<?php //echo get_the_permalink($media_page->ID); ?>"><?php //echo get_the_title($media_page->ID); ?></a></li> -->
											<?php endwhile; ?>
											<!-- </ul> -->
										<?php endif; ?>
									</div>
								<?php endif; ?>
								<?php if (get_field('press_reviews')): ?>
									<div class="cs-press-reviews">
											<h4>Press Reviews</h4>
											<?php
											if( have_rows('press_reviews') ): ?>
												<!-- <ul class="press-reviews"> -->
											    <?php while ( have_rows('press_reviews') ) : the_row();
											    	$review = get_sub_field('reviews'); 
											    	$review_link = get_sub_field('review_link');
											    	$post_date = get_the_date('d.m.y');
											    	echo do_shortcode('[custom-link link="'.$review_link.'" title="'.$review.'"]');
											    	?>
												<?php endwhile; ?>
												<!-- </ul> -->
											<?php endif; ?>
									</div>
								<?php endif; ?>
							</div>
						</div>

						<a href="javascript:window.history.back();" id="global-prev-button">&laquo; Back</a>
		
						<?php //endif; ?>
					</div>
					<?php //get_sidebar(); ?>
				</div>
				<?php 
					//$category = get_the_terms(get_the_ID(),'event-type')[0];
					$date_now = strtotime(date('Y-m-d'));
					$post_date  = strtotime(get_the_date('Y-m-d'));
					$date_query = ($post_date > $date_now) ? "after" : "before";
					echo do_shortcode('[post-footer post_type="events-activities" icon="event-related-icon" date_query="'.$date_query.'" title="events"]');?>
			</article>
		<?php endwhile; ?>

		</div>
	</div>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lightbox2/2.10.0/js/lightbox.min.js"></script>
<?php get_footer('alt'); ?>