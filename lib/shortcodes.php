<?php 

function news_grid_func( $atts ){
	if ( get_query_var( 'paged' ) ) { $paged = get_query_var( 'paged' ); }
	elseif ( get_query_var( 'page' ) ) { $paged = get_query_var( 'page' ); }
	else { $paged = 1; }

	// $arr = array(
	// 	'post_type' => $atts['post_type'] ? $atts['post_type'] : 'post',
	// 	'numberposts' => 1
	// );

	// $latest = get_posts($arr);

	$args = array(
		'post_type' => $atts['post_type'] ? $atts['post_type'] : 'post',
		'posts_per_page' => $atts['posts_per_page'] ? $atts['posts_per_page'] : 6,
		'paged' => $paged,
		//'post__not_in' => array($latest[0]->ID)
	);

	if ($atts['taxonomy'] && $atts['term_slug']) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => $atts['taxonomy'],
				'field'    => 'slug',
				'terms'    => $atts['term_slug'],
			)
		);
	}
	
	query_posts($args);
	$html = '<div class="row news-grid">';
	while (have_posts()): the_post();
		$html .= '<div class="medium-4 columns end">';

		$html .= '<div class="news-item">';
		$html .= '<div class="image-wrapper"><a href="'.get_permalink($post->ID).'">' . get_the_post_thumbnail($post->ID, 'thumbnail') .'</a></div>';
		$html .= '<div class="news-details">';
		if ($atts['post_type'] == 'events-activities') {
			$html .= '<p class="teaser">'. get_field('location', $post->ID) .'</p>';
		} else {
			$html .= '<p class="teaser">'. wp_trim_words(get_the_excerpt($post->ID), 10, '...' ) .'</p>';
		}
		$html .= '<h3 class="title">'. get_the_title($post->ID) .'</h3>';
		$html .= '<div class="news-date">'. get_the_date(get_option('date_format'), $post->ID) .'</div>';
		$html .= '<a href="'. get_permalink($post->ID) .'" class="readmore">Read more</a>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';
	endwhile;
	$html .= '</div>';

	$html .= function_exists('reverie_pagination2') ? reverie_pagination2($atts['term_slug']) : '';
	wp_reset_query();

	return $html;
}
add_shortcode('news_grid', 'news_grid_func');