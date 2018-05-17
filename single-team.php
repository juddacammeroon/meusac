<?php get_header(); ?>

<!-- Row for main content area -->
	<div class="small-12 large-12 columns" id="content" role="main">
	
	<?php /* Start loop */ ?>
	<?php while (have_posts()) : the_post(); ?>
		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<header>

				
			</header>
			<div class="entry-content">
				<?php if(has_post_thumbnail()) : ?>
					<img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())); ?>" class="director-avatar alignleft" />
				<?php endif; ?>
				<h3 class="entry-title"><?php the_title(); ?></h3>
				<?php echo apply_filters('the_content',get_field('director_biography',get_the_ID(),TRUE)); ?>
			</div>
		</article>
		<?php //comments_template(); ?>
	<?php endwhile; // End the loop ?>

	</div>
	<?php //get_sidebar(); ?>
		
<?php get_footer(); ?>