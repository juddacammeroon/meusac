<?php get_header(); ?>

<!-- Row for main content area -->
	<div class="small-12 large-12 columns" id="content" role="main">
	
	<?php /* Start loop */ ?>
	<?php while (have_posts()) : the_post(); ?>
		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<header>
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header>
			<div class="entry-content">
				<?php the_content(); ?>
				<?php if (!get_field('is_external_link',get_the_ID(),TRUE)) : ?>

					<?php $links = get_field('partner_search',get_the_ID(),TRUE); ?>

					<?php if($links) : ?>
					<div class="partner-search-listing">
						<ul>

						<?php foreach($links as $link) : ?>

							<li>
								<a href="<?php echo $link['ps_link_url']; ?>" target="_blank"><?php echo $link['ps_link_title']; ?></a>
							</li>

						<?php endforeach; ?>

						</ul>
					</div>
						
					<?php endif; ?>

				<?php endif; ?>
			</div>
		</article>
	<?php endwhile; // End the loop ?>

	</div>
		
<?php get_footer(); ?>