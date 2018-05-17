<?php

//Template Name: Core Group Events

get_header();

?>

<div class="large-12 columns">
	<div class="news-archive-wrapper">
		<center>
			<h1>Core Group Events</h1>
		</center>
		<?php

		$args = array(
			'posts_per_page' => 10,
			'post_type' => 'events-activities',
			'tax_query' => array(
				array(
					'taxonomy' => 'event-type',
					'field' => 'slug',
					'terms' => 'core-group-events'
				)
			)
		);

		query_posts($args);

		?>
		<?php if (have_posts()) : $ctr = 0;?>
			<?php while(have_posts()) : the_post(); ?>
				<pre class="force-hide">
					<?php print_r($post); ?>
				</pre>
				<?php if ($ctr > 0) : ?>
					<div class="other-news">
						<div class="row">
							<div class="large-3 columns">
								<?php if (has_post_thumbnail()) : ?>

								<?php echo get_the_post_thumbnail(get_the_ID(), 'thumbnail'); ?>

								<?php else : ?>

								<img src="<?php echo get_template_directory_uri(); ?>/assets/images/post-placeholder.jpg">

								<?php endif; ?>
							</div>
							<div class="large-9 columns">
								<h4>
									<?php the_title(); ?>
								</h4>
								<p>
									<a href="<?php the_permalink(); ?>" class="read-more-button">Discover More &raquo;</a>
								</p>
							</div>
						</div>
					</div>
				<?php else : ?>
					<div class="main-story">
						<div class="row">
							<div class="large-5 columns">
								<h2>
									<?php the_title(); ?>
								</h2>
								<p>
									<?php the_excerpt(); ?>
								</p>
								<p>
									<a href="<?php the_permalink(); ?>" class="read-more-button">Discover More &raquo;</a>
								</p>
							</div>
							<div class="large-7 columns">
								<?php if (has_post_thumbnail()) : ?>
									<?php echo get_the_post_thumbnail(get_the_ID(), 'full'); ?>
								<?php else : ?>
									<img src="<?php echo get_template_directory_uri(); ?>/assets/images/post-placeholder.jpg">
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php endif; ?>
			<?php $ctr++; endwhile; wp_reset_query(); ?>
		<?php endif; ?>
	</div>
</div>

<?php get_footer(); ?>