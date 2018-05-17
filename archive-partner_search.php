<?php get_header(); ?>

<!-- Row for main content area -->
	<div class="small-12 large-12 columns" id="content" role="main">
	
	<?php /* Start loop */ ?>
		<article>
			<header>
				<h1 class="entry-title">Partner Search</h1>
			</header>
			<div class="entry-content">
				<div class="partner-search-listing">
					<ul>

						<?php while (have_posts()) : the_post(); ?>

						<li>
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</li>

						<?php endwhile; ?>

					</ul>
				</div>
			</div>
		</article>

	</div>
		
<?php get_footer(); ?>