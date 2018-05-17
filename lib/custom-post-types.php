<?php

function add_cpt() {
	$sectoralCommittees = array(
		'labels' => array(
			'name' => __('Sectoral Committees', 'jointswp'),
			'singular_name' => __('Sectoral Committee', 'jointswp'),
			'all_items' => __('All Sectoral Committees', 'jointswp'),
			'add_new' => __('Add New', 'jointswp'),
			'add_new_item' => __('Add New Sectoral Committee', 'jointswp'),
			'edit' => __( 'Edit', 'jointswp' ),
			'edit_item' => __('Edit Sectoral Committees', 'jointswp'),
			'new_item' => __('New Sectoral Committee', 'jointswp'),
			'view_item' => __('View Sectoral Committee', 'jointswp'),
			'search_items' => __('Search Sectoral Committee', 'jointswp'),
			'not_found' =>  __('Nothing found in the Database.', 'jointswp'),
			'not_found_in_trash' => __('Nothing found in Trash', 'jointswp'),
			'parent_item_colon' => ''
		),
		'description' => __( 'This is the example Sectoral Committee type', 'jointswp' ),
		'public' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'show_ui' => true,
		'query_var' => true,
		'menu_position' => 8,
		'menu_icon' => 'dashicons-book',
		'rewrite'	=> array( 'slug' => 'sectoral-committees'),
		'has_archive' => 'sectoral-committees',
		'capability_type' => 'post',
		'hierarchical' => false,
		'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions')
	);

	$fundingOpportunities = array(
		'labels' => array(
			'name' => __('Programmes', 'jointswp'),
			'singular_name' => __('Programme', 'jointswp'),
			'all_items' => __('All Programmes', 'jointswp'),
			'add_new' => __('Add New', 'jointswp'),
			'add_new_item' => __('Add New Programme', 'jointswp'),
			'edit' => __( 'Edit', 'jointswp' ),
			'edit_item' => __('Edit Programmes', 'jointswp'),
			'new_item' => __('New Funding Opportunitie', 'jointswp'),
			'view_item' => __('View Funding Opportunitie', 'jointswp'),
			'search_items' => __('Search Programme', 'jointswp'),
			'not_found' =>  __('Nothing found in the Database.', 'jointswp'),
			'not_found_in_trash' => __('Nothing found in Trash', 'jointswp'),
			'parent_item_colon' => ''
		),
		'description' => __( 'This is the example Programme', 'jointswp' ),
		'public' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'show_ui' => true,
		'query_var' => true,
		'menu_position' => 8,
		'menu_icon' => 'dashicons-book',
		'rewrite'	=> array( 'slug' => 'funding-opportunity'),
		'has_archive' => 'funding-opportunity',
		'capability_type' => 'post',
		'hierarchical' => false,
		'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions')
	);

	$eventsAndActivities = array(
		'labels' => array(
			'name' => __('Events & Activities', 'jointswp'),
			'singular_name' => __('Event & Activity', 'jointswp'),
			'all_items' => __('All Events & Activities', 'jointswp'),
			'add_new' => __('Add New', 'jointswp'),
			'add_new_item' => __('Add New Event & Activity', 'jointswp'),
			'edit' => __( 'Edit', 'jointswp' ),
			'edit_item' => __('Edit Event & Activity', 'jointswp'),
			'new_item' => __('New Event & Activity', 'jointswp'),
			'view_item' => __('View Event & Activity', 'jointswp'),
			'search_items' => __('Search Event & Activity', 'jointswp'),
			'not_found' =>  __('Nothing found in the Database.', 'jointswp'),
			'not_found_in_trash' => __('Nothing found in Trash', 'jointswp'),
			'parent_item_colon' => ''
		),
		'description' => __( 'This is the example Event & Activity', 'jointswp' ),
		'public' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'show_ui' => true,
		'query_var' => true,
		'menu_position' => 7,
		'menu_icon' => 'dashicons-book',
		'rewrite'	=> array( 'slug' => 'events-and-activities'),
		'has_archive' => 'event-activity',
		'capability_type' => 'post',
		'hierarchical' => false,
		'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions'),
		'taxonomies' => array('post_tag')
	);

	$newsAndMedia = array(
		'labels' => array(
			'name' => __('MEUSAC Media', 'jointswp'),
			'singular_name' => __('MEUSAC Media', 'jointswp'),
			'all_items' => __('All MEUSAC Media', 'jointswp'),
			'add_new' => __('Add New', 'jointswp'),
			'add_new_item' => __('Add MEUSAC Media', 'jointswp'),
			'edit' => __( 'Edit', 'jointswp' ),
			'edit_item' => __('Edit MEUSAC Media', 'jointswp'),
			'new_item' => __('New MEUSAC Media', 'jointswp'),
			'view_item' => __('View MEUSAC Media', 'jointswp'),
			'search_items' => __('Search MEUSAC Media', 'jointswp'),
			'not_found' =>  __('Nothing found in the Database.', 'jointswp'),
			'not_found_in_trash' => __('Nothing found in Trash', 'jointswp'),
			'parent_item_colon' => ''
		),
		'description' => __( 'This is the example MEUSAC Media', 'jointswp' ),
		'public' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'show_ui' => true,
		'query_var' => true,
		'menu_position' => 7,
		'menu_icon' => 'dashicons-book',
		'rewrite'	=> array( 'slug' => 'news-media'),
		'has_archive' => 'event-media',
		'capability_type' => 'post',
		'hierarchical' => false,
		'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions'),
		'taxonomies' => array('post_tag')
	);

	$fundingProgramme = array(
		'labels' => array(
			'name' => __('EU Funding Calls', 'jointswp'),
			'singular_name' => __('EU Funding Call', 'jointswp'),
			'all_items' => __('All EU Funding Calls', 'jointswp'),
			'add_new' => __('Add New EU Funding Call', 'jointswp'),
		),
		'description' => __( 'This is the example EU Funding Call', 'jointswp' ),
		'public' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'show_ui' => true,
		'query_var' => true,
		'menu_position' => 6,
		'menu_icon' => 'dashicons-book',
		'rewrite'	=> array( 'slug' => 'funding-programme'),
		'has_archive' => 'funding-programme',
		'capability_type' => 'post',
		'hierarchical' => false,
		'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions')
	);

	

	register_post_type( 'sectoral-committees', $sectoralCommittees);
	register_post_type( 'funding-opportunity', $fundingOpportunities);
	register_post_type( 'events-activities', $eventsAndActivities);
	register_post_type( 'news-media', $newsAndMedia);
	register_post_type( 'funding-programmes', $fundingProgramme);
}

add_action( 'init', 'add_cpt');