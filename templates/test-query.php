<?php

//Template Name: Test Query

get_header();

?>

<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>

	<div class="">
		<?php
		
		$args1 = array(
			'posts_per_page' => -1,
			'post_type' => 'consultation_session',
			'meta_key' => 'cs_events',
			'meta_value' => TRUE
		);

		$args2 = array(
			'posts_per_page'   => -1,
			'post_type' => 'events-activities',
			'post_status'      => 'publish',
			'date_query' => array(
				array(
					'before'    => array(
						'year'  => $today['year'],
						'month' => $today['mon'],
						'day'   => $today['mday'],
					),
				),
			),
			'orderby' => 'date',
			'order' => 'DESC'
		);

		$posts_args1 = get_posts($args2);
		
		?>

		<pre>
			<?php print_r($posts_args1); ?>
		</pre>
		
		<?php foreach($posts_args1 as $pa) : ?>
			<h2> -> <?php echo $pa->post_title; ?></h2>
		<?php endforeach; ?>
	</div>

	<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>