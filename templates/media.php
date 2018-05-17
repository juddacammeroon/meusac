<?php
/*
Template Name: Media
*/
get_header(); 

function call_media_section($term = 'press-releases', $yearly = true) {
	ob_start();
	?>

	<?php

	$section = $term;

	 if ( !$current_page = get_query_var('paged') ){
          $current_page = 1;
     }else{
          if($section !== $_GET['section']){
            $current_page = 1; 
          }else{
            $current_page = get_query_var('paged');
          }
     }

	?>
	<?php

	if ($term == 'articles') {
		$pr_args = array(
			'posts_per_page' => 5,
			'post_type' => 'post',
			'tax_query' => array(
				array(
					'taxonomy' => 'category',
					'field' => 'slug',
					'terms' => 'meusac-media'
				)
			),
			'paged' => $current_page
		);
	} else {
		$pr_args = array(
			'posts_per_page' => 5,
			'post_type' => 'news-media',
			'tax_query' => array(
				array(
					'taxonomy' => 'news-category',
					'field' => 'slug',
					'terms' => $term
				)
			),
			'paged' => $current_page
		);
	}

	if ($yearly) {
		$pr_args['date_query'] = array(array('year' => 2018));
	}

	query_posts($pr_args);
	$pr = get_posts($pr_args);

	?>
	<?php if (have_posts()) : ?>
	<ul class="the-articles">
		<?php while(have_posts()) : the_post(); ?>

		<li>
			<?php if(get_field('view_attachment',get_the_ID(),TRUE)) : ?>
				<?php $attachment_file = get_field('attachment',get_the_ID(), TRUE); ?>
				<a href="<?php echo $attachment_file['url']; ?>" target="_blank"><?php the_title(); ?></a>
			<?php else : ?>
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			<?php endif; ?>
		</li>

		<?php endwhile; ?>
	</ul>
	<?php endif; ?>
    <?php 
      global $wp_query;
      $total = $wp_query->max_num_pages;

      if ( $total > 1 )  {     
          $big = 999999999;
          $paginate_links = paginate_links( array(
              'base' => str_replace( $big, '%#%', get_pagenum_link( $big, false ) ),
              'current' => $current_page,
              'total' => $wp_query->max_num_pages,
              'type' => 'list',
              'add_fragment' => '#'.$section,
              'add_args' => array('section' => $section)
          ));

          echo '<div class="boxed"><div class="pull-right" style="margin-top:10px">'.$paginate_links.'</div></div>';
      }
      wp_reset_query();
    ?>

	<?php
	return ob_get_clean();
}

?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div id="content" role="main">
		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<div class="entry-content">
				<div class="wrapper">
					<div class="medium-12 columns">
						<?php the_content(); ?>
					</div>
				</div>
				<div class="wrapper">
					<div class="medium-12 columns">
						<div id="meusac-accordion">
							<ul class="the-tabs">
								<li id="press-release">
									<a href="#press-releases" onclick="openTab('press-release')">Press Releases<i class="vc_tta-controls-icon vc_tta-controls-icon-plus __web-inspector-hide-shortcut__"></i></a>
									<div class="the-content">
										<?php echo call_media_section('press-releases') ?>
									</div>
								</li>
								<li id="articles">
									<a href="#articles" onclick="openTab('articles')">Articles</a>
									<div class="the-content">
										<?php echo call_media_section('articles') ?>
									</div>
								</li>
								<li id="newsletters">
									<a href="#newsletters" onclick="openTab('newsletters')">Newsletters</a>
									<div class="the-content">
										<?php echo call_media_section('newsletters') ?>
									</div>
								</li>
								<li id="annual-reports">
									<a href="#annual-reports" onclick="openTab('annual-reports');">Annual Reports</a>
									<div class="the-content">
										<?php echo call_media_section('annual-reports', false) ?>
									</div>
								</li>
							</ul>
						</div>
				    </div>
				</div>
				<script type="text/javascript">
					
				function openTab(id) {
					if (jQuery('#'+id).hasClass('active')) {
						jQuery('#'+id).removeClass('active');
						jQuery('#meusac-accordion').find('.the-content').slideUp(100);
					} else {
						jQuery('#meusac-accordion').find('li').removeClass('active');
						jQuery('#'+id).addClass('active');
						jQuery('#meusac-accordion').find('.the-content').slideUp(100);
						jQuery('#'+id).find('.the-content').slideDown(100);
					}
					
				}

				jQuery(document).ready(function(){
					var hash = window.location.hash.substr(1);

					openTab(hash);
				});

				</script>
			</div>
		</article>
	</div>
<?php endwhile; endif; ?>
<?php get_footer(); ?>