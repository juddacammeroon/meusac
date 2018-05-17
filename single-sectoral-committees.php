<?php get_header('alt'); ?>

<!-- Row for main content area -->
	<div id="content" role="main">
	
	<?php /* Start loop */ ?>
	<?php while (have_posts()) : the_post(); ?>
		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<div class="row">
				<div class="large-12 column">
					<header class="text-center">
						<div class="section-header-block">
							<div class="section-wrapper">
								<p><strong>Sectoral Committees</strong></p>
								<h1 class="entry-title theme-color-1"><?php the_title(); ?></h1>
								<h3><?php the_field('sc_subtitle'); ?></h3>
							</div>
						</div>
						<p><?php the_field('sc_subtext'); ?></p>
					</header>
				</div>
			</div>
			<div class="entry-content">
				<div class="row">
					<?php the_content(); ?>
				</div>
			</div>
			<div class="sectoral-links">
				<h2 class="text-center">sectoral committees</h2>
				<div class="sectoral-links-wrapper">
					<div class="row">
						<?php
							$args = array(
							    'posts_per_page'   	=> -1,
							    'post_type'        	=> 'sectoral-committees',
								'post_status'      	=> 'publish',
								'post__not_in'		=> array(get_the_ID())
							);

							$query = new WP_Query($args);

							if ($query->have_posts()) {
								$middle = round($query->found_posts / 2);
								$i = 0;
								$posts = '<div class="large-6 column">';
							    while ($query->have_posts()) {
							    	$query->the_post();
							    	$i++;
							    	$posts .= '<div class="link-block">';
							    	$posts .= '<span class="helper"></span>';
							    	$posts .='<a href="'.get_the_permalink().'">';
							    	$posts .= '<div class="title-wrapper">';
							    	$posts .= '<h5>'.get_the_title().'</h5>';
							    	$posts .= '</div>';
							    	$posts .='</a>';
							    	$posts .= '</div>';
							    	if ($i == $middle) {
							    		$posts .= '</div>';
							    		$posts .= '<div class="large-6 column">';
							    	}
							    }
							    $posts .= '</div>';
							    echo $posts;
							 	wp_reset_postdata();
							}
						?>
					</div>
					<ul></ul>
				</div>
			</div>
		</article>
	<?php endwhile; ?>

	</div>
		
<?php get_footer('alt'); ?>