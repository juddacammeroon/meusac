<?php
/*
Template Name: EU Funding
*/
get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div id="content" role="main">
		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<div class="entry-content">
				<div class="wrapper">
					<div class="medium-12 columns">
						<?php the_content(); ?>
					</div>
				</div>
				<div class="slanting-bg">
					<div class="wrapper">
						<div class="medium-12 columns">
						<?php
						global $wpdb;
						$results = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}posts WHERE post_type='funding-opportunity' AND post_status='publish' AND id IN (SELECT pm.meta_value FROM {$wpdb->prefix}posts p, {$wpdb->prefix}postmeta pm WHERE p.post_type='funding-programmes' AND p.post_status='publish' AND p.id = pm.post_id AND pm.meta_key='sc_programme' AND pm.post_id IN (SELECT pm.post_id FROM {$wpdb->prefix}posts p, {$wpdb->prefix}postmeta pm WHERE p.post_type='funding-programmes' AND p.post_status='publish' AND p.id = pm.post_id AND pm.meta_key='deadline' AND meta_value > DATE_FORMAT(NOW(), '%Y%m%d'))) ORDER BY post_title ASC"); ?>

							<div class="post-listing">
								<h3 class="theme-color-1 row-padding-65 text-center">Current <strong>EU Funding Opportunities</strong></h3>
								<ul>
									<?php foreach ($results as $result): ?>
									  	<li>
										  	<a href="<?php echo get_permalink($result->ID); ?>">
										  		<h5><?php echo get_the_title($result->ID); ?></h5>
										  		<p><?php echo get_field('sc_subtitle', $result->ID, TRUE) ?></p>
										  	</a>
									  	</li>
									<?php endforeach; ?> 
								</ul>
							</div>
						    
					    	<div class="other-programmes-link theme-color-1">
					        	<h3 class="text-center">Other <strong>Programmes</strong> - No Open Calls</h3>
					        	<div class="post-listing">
						          	<ul>
						            	<li>
						              		<a href="<?php echo home_url(); ?>/other-programmes/">
							                	<h5>Other Programmes - No Open Calls</h5>
						              		</a>
						            	</li>
						          	</ul>
					        	</div>
					      	</div>
					    </div>
					</div>
			    </div>
			</div>
		</article>
	</div>
<?php endwhile; endif; ?>
<?php get_footer(); ?>