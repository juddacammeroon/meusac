<?php

//Template Name: Other Programmes

get_header();

?>

<?php if(have_posts()) : ?>
	<?php while(have_posts()) : the_post(); ?>

	<div class="row">
		<div class="large-12 columns">
			<div class="other-programmes-link theme-color-1">
				<h3 style="text-align: center;">Other <strong>Programmes</strong></h3>
				<?php

				global $wpdb;
				
				$results = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}posts WHERE post_type='funding-opportunity' AND post_status='publish' AND id NOT IN (SELECT pm.meta_value FROM {$wpdb->prefix}posts p, {$wpdb->prefix}postmeta pm WHERE p.post_type='funding-programmes' AND p.post_status='publish' AND p.id = pm.post_id AND pm.meta_key='sc_programme' AND pm.post_id NOT IN (SELECT pm.post_id FROM {$wpdb->prefix}posts p, {$wpdb->prefix}postmeta pm WHERE p.post_type='funding-programmes' AND p.post_status='publish' AND p.id = pm.post_id AND pm.meta_key='deadline' AND meta_value < DATE_FORMAT(NOW(), '%Y%m%d'))) ORDER BY post_title ASC");

				?>
				<div class="post-listing">
					<ul>
						<?php foreach ($results as $result) : ?>

						<li>
							<a href="<?php echo get_permalink($result->ID); ?>">
								<h5><?php echo $result->post_title; ?></h5>
								<?php $subtitle = get_field('sc_subtitle',$result->ID,TRUE); ?>
								<?php if($subtitle) : ?>
									<p>
										<?php echo $subtitle; ?>
									</p>
								<?php endif; ?>
							</a>
						</li>

						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>