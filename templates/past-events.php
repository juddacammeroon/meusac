<?php 
// Template Name: Past Events

get_header(); ?>

<!-- Row for main content area -->
<div class="large-12 columns" id="content" role="main">
	<div id="latest_section" class="upcoming-events">
	 	<div class="row">
	      	<?php
	      	$today = getdate();
	      	$exclude = array();
	        $args = array(
	           'posts_per_page'   => 1,
	           'post_type' => array('events-activities', 'consultation_session'),
	           'post_status'      => 'publish',
	           'date_query' => array(
					array(
						'before'    => array(
							'year'  => $today['year'],
							'month' => $today['mon'],
							'day'   => $today['mday'],
						),
						'inclusive' => true,
					),
				),
	          	'meta_key'   => 'cs_event',
				'meta_value' => 1,
		      	'orderby' => 'date',
		      	'order' => 'DESC'
	        );
	        remove_all_filters('posts_orderby');
	        query_posts($args);
	        if (have_posts()) : while (have_posts()) : the_post(); $exclude[] = $post->ID; ?>
	          <div class="section-header-block large-5 medium-5 columns">
	            <div class="section-header-block normal-case">
	              <div class="row">
	                <div class="large-8 medium-8 columns">
	                  <h3 class="theme-color-1"><strong><?php echo get_the_title(); ?></strong></h3>
	                </div>
	              </div><br/>
	              <p><?php echo get_the_excerpt();?></p>
	              <div class="vc_btn3-container  theme-link text-bold theme-color-1 vc_btn3-inline">
	              <a href="<?php echo get_the_permalink();?>"><button class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-rounded vc_btn3-style-modern vc_btn3-color-grey">DISCOVER MORE</button></a>
	              </div>
	            </div>
	          </div>
	          <div class="large-7 medium-7 columns">
	            <?php if (!has_post_thumbnail()) { ?>
	              <div class="horizontal">
	                <div class="vertical">
	                  <img src="<?php echo home_url(); ?>/wp-content/uploads/2018/01/logo.jpg">
	                </div>
	              </div>
	            <?php } else {?>
	              <img src="<?php the_post_thumbnail_url(); ?>">
	            <?php } ?>
	          </div>
	      	<?php endwhile; endif; wp_reset_query(); ?>
	    </div>
	</div>

	<div class="sub-pages">
		<ul>
			<li><a href="<?php echo home_url('/events-and-activities'); ?>">Upcoming<span>Events</span></a></li>
			<li class="active"><a href="<?php echo home_url('/past-events'); ?>">Past<span>Events</span></a></li>
		</ul>
	</div>

	<?php 
	if ( get_query_var( 'paged' ) ) { $paged = get_query_var( 'paged' ); }
	elseif ( get_query_var( 'page' ) ) { $paged = get_query_var( 'page' ); }
	else { $paged = 1; }

	$args = array(
       'posts_per_page'   => 6,
       'post_type' 	      => array('events-activities', 'consultation_session'),
       'post_status'      => 'publish',
       'paged'            => $paged,
       'date_query' 	  => array(
			array(
				'before'    => array(
					'year'  => $today['year'],
					'month' => $today['mon'],
					'day'   => $today['mday'],
				),
				'inclusive' => true,
			),
		),
       	'post__not_in' => $exclude,
       	'meta_key'   => 'cs_event',
		'meta_value' => 1,
      	'orderby' => 'date',
      	'order' => 'DESC'
    );
    remove_all_filters('posts_orderby');
    query_posts($args); ?>

	<div class="row news-grid">
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
</div>
		
<?php get_footer(); ?>
