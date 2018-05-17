<?php
// Template Name: Programmes w/o call


global $wpdb;
$results = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}posts WHERE post_type='funding-opportunity' AND post_status='publish' AND id NOT IN (SELECT pm.meta_value FROM {$wpdb->prefix}posts p, {$wpdb->prefix}postmeta pm WHERE p.post_type='funding-programmes' AND p.post_status='publish' AND p.id = pm.post_id AND pm.meta_key='sc_programme') ORDER BY id DESC");

foreach ($results as $result) {
	echo '<p>' . $result->post_title . '</p>';
}