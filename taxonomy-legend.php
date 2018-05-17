<?php get_header(); ?>

	<div class="news-grid">
		<pre class="force-hide">
			<?php print_r(get_queried_object()); ?>
			<?php $query = get_queried_object(); ?>
		</pre>
		<div class="large-12">
			<div class="legend-description">
				<center>
					<h1 class="custom-heading"><?php echo $query->name; ?></h1>
					<?php echo apply_filters('the_content',get_field('legend_description',$query->taxonomy.'_'.$query->term_id)); ?>
				</center>
			</div>
		</div>
	<?php while (have_posts()): the_post(); ?>
		<div class="medium-4 columns end">
			<div class="news-item">
				<div class="image-wrapper">
					<a href="<?php the_permalink() ?>"><?php echo get_the_post_thumbnail($post->ID, 'thumbnail') ?></a>
				</div>
				<div class="news-details">
					<p class="teaser"><?php the_field('location', $post->ID); ?></p>
					<h3 class="title"><?php the_title(); ?></h3>
					<div class="news-date"><?php echo get_the_date(get_option('date_format'), $post->ID); ?></div>
					<a href="<?php the_permalink() ?>" class="readmore">Read more</a>
				</div>
			</div>
		</div>
	<?php endwhile; ?>
	</div>

	<?php if ( function_exists('reverie_pagination') ) { reverie_pagination(); } ?>
		
<?php get_footer(); ?>