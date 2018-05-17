<?php get_header(); ?>

<!-- Row for main content area -->
	<div class="small-12 columns
	 row-padding-65" id="content" role="main">
	 	<div class="header-container margin-search-wrapper">
			<h2 class="text-center theme-color-1"><?php _e('Search Results for', 'reverie'); ?> "<?php echo get_search_query(); ?>"</h2>
			<form class="custom-search" role="search" method="get" id="searchform" action="<?php echo home_url();?>" _lpchecked="1">
			<div class="row collapse">
				<div class="large-8 small-9 columns">
					<input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="Search">
				</div>
				<div class="large-4 small-3 columns">
					<input type="submit" id="searchsubmit" value="Search" class="button postfix">
				</div>
			</div>
			</form>
		</div>
	<div class="row news-grid row-padding-65">
	<?php if ( have_posts() ) : ?>
	
		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>
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
			<?php //get_template_part( 'content', get_post_format() ); ?>
		<?php endwhile; ?>
		<?php else : ?>
			<h4 class="text-center theme-color-2">Apologies, but no results were found. Perhaps searching will help find a related post.</h4>
	<?php endif; // end have_posts() check ?>
	</div>

	<?php /* Display navigation to next/previous pages when applicable */ ?>
	<?php if ( function_exists('reverie_pagination') ) { reverie_pagination(); } else if ( is_paged() ) { ?>
		<nav id="post-nav">
			<div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'reverie' ) ); ?></div>
			<div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'reverie' ) ); ?></div>
		</nav>
	<?php } ?>

	</div>
	<?php //get_sidebar(); ?>
		
<?php get_footer(); ?>