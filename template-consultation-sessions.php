<?php

get_header();

?>

<div class="large-12 columns">
	<div class="news-archive-wrapper">
		<center>
			<h1>Consultation Sessions</h1>
		</center>
		<?php

		$args = array(
			'posts_per_page' => 10,
			'post_type' => 'events-activities',
			'tax_query' => array(
				array(
					'taxonomy' => 'event-type',
					'field' => 'slug',
					'terms' => 'consultation-sessions'
				)
			)
		);

		$terms_holder = get_posts($args);
		$term_ids = array();

		foreach ($terms_holder as $th)
		{
			$terms_id_holder = get_the_terms($th->ID,'event-type');

			foreach($terms_id_holder as $tih)
			{
				if ($tih->parent > 0)
				{
					$term_ids[] = $tih->slug;
				}
			}
		}

		query_posts($args);

		$tab_holder = '';

		$tab_holder .= '<div class="the-tabs">';
			$tab_holder .= '<ul>';
				$tab_ctr = 0;
				foreach (array_unique($term_ids) as $tid)
				{
					$active = $tab_ctr == 0 ? 'active' : '';
					$tab_holder .= '<li class="'.$active.'" id="the-tab-'.$tab_ctr.'" sub-class="'.$tid.'">';
						$tab_holder .= '<a href="javascript:changeTab(\''.$tid.'\','.$tab_ctr.')">'.$tid.'</a>';
					$tab_holder .= '</li>';
					$tab_ctr++;
				}
			$tab_holder .= '</ul>';
		$tab_holder .= '</div>';

		?>
		<?php if (have_posts()) : $ctr = 0;?>
			<?php while(have_posts()) : the_post(); ?>
				<?php if ($ctr > 0) : ?>
					<?php

					$this_terms = get_the_terms(get_the_ID(),'event-type');
					$this_term_ids = array();

					foreach($this_terms as $tt)
					{
						if ($tt->parent > 0)
						{
							$this_term_ids[] = $tt->slug;
						}
					}

					?>
					<div class="other-news <?php echo implode(',',$this_term_ids); ?>" sub-category="<?php echo implode(',',$this_term_ids); ?>">
						<div class="row">
							<div class="large-3 columns">
								<?php if (has_post_thumbnail()) : ?>

								<?php echo get_the_post_thumbnail(get_the_ID(), 'thumbnail'); ?>

								<?php else : ?>

								<img src="<?php echo get_template_directory_uri(); ?>/assets/images/post-placeholder.jpg">

								<?php endif; ?>
							</div>
							<div class="large-9 columns">
								<h4>
									<?php the_title(); ?>
								</h4>
								<p>
									<a href="<?php the_permalink(); ?>" class="read-more-button">Discover More &raquo;</a>
								</p>
							</div>
						</div>
					</div>
				<?php else : ?>
					<div class="main-story">
						<div class="row">
							<div class="large-5 columns">
								<h2>
									<?php the_title(); ?>
								</h2>
								<p>
									<?php the_excerpt(); ?>
								</p>
								<p>
									<a href="<?php the_permalink(); ?>" class="read-more-button">Discover More &raquo;</a>
								</p>
							</div>
							<div class="large-7 columns">
								<?php if (has_post_thumbnail()) : ?>
									<?php echo get_the_post_thumbnail(get_the_ID(), 'full'); ?>
								<?php else : ?>
									<img src="<?php echo get_template_directory_uri(); ?>/assets/images/post-placeholder.jpg">
								<?php endif; ?>
							</div>
						</div>
					</div>
					<?php echo $tab_holder; ?>
				<?php endif; ?>
			<?php $ctr++; endwhile; wp_reset_query(); ?>
		<?php endif; ?>
	</div>
</div>

<script type="text/javascript">
	
function changeTab(categoryID, tab)
{
	jQuery('.other-news').slideUp();
	jQuery('.'+categoryID).slideDown();

	jQuery('.the-tabs').find('ul').find('li').each(function(){
		if (jQuery(this).attr('sub-class') == categoryID)
		{
			jQuery(this).addClass('active');
		}
		else
		{
			jQuery(this).removeClass('active');
		}
	});
}

jQuery(document).ready(function(){
	var defaultDisplay = jQuery('.the-tabs').find('ul').find('li').first().attr('sub-class');
	changeTab(defaultDisplay);
});

</script>

<?php get_footer(); ?>