<?php 
// Template Name: Vacancy

get_header(); ?>

<!-- Row for main content area -->
<h1 class="text-center" style="margin-top: 68px">Noticeboard</h1>
<div class="large-12 columns" id="content" role="main">
	<div class="sub-pages">
		<ul>
			<li><a href="<?php echo home_url('/noticeboard/tenders'); ?>">Tenders</a></li>
			<li><a href="<?php echo home_url('/noticeboard'); ?>">RFQ'S</a></li>
			<li class="active"><a href="<?php echo home_url('/noticeboard/vacancy'); ?>">Vacancy</a></li>
		</ul>
	</div>

	<?php 
	if ( get_query_var( 'paged' ) ) { $paged = get_query_var( 'paged' ); }
	elseif ( get_query_var( 'page' ) ) { $paged = get_query_var( 'page' ); }
	else { $paged = 1; }

	$args = array(
		'posts_per_page'   => 6,
		'post_type' 	      => 'post',
		'post_status'      => 'publish',
		'paged'            => $paged,
		'category_name'         => 'Vacancy',
		'orderby' => 'date',
		'order' => 'DESC'
    );
    query_posts($args); ?>

	<div class="row news-grid">
	<?php while (have_posts()): the_post(); ?>
		<div class="medium-4 columns end">
			<div class="news-item">
				<div class="image-wrapper horizontal">
					<a href="<?php the_permalink() ?>"><?php echo get_the_post_thumbnail($post->ID, 'thumbnail') ?></a>
					<?php if(!has_post_thumbnail()){ ?>
			          <div class="vertical">
			          	<a href="<?php the_permalink() ?>">
			            	<img src="http://meusac.webee.com.mt/wp-content/uploads/2018/01/logo.jpg">
			        	</a>
			          </div>
			        <?php }?>
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
