<?php get_header('alt'); ?>

<!-- Row for main content area -->
	<div id="content" role="main">
	
	<?php /* Start loop */ ?>
	<?php while (have_posts()) : the_post(); ?>
		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<div class="row">
				<div class="large-12 column">
					<header class="text-center">
						<div class="section-header-block">
							<div class="section-wrapper">
								<p><strong>EU Funding Programme</strong></p>
								<h1 class="entry-title theme-color-1"><?php the_title(); ?></h1>
								<h3><?php the_field('sc_subtitle'); ?></h3>
							</div>
						</div>
						<p><?php the_field('sc_subtext'); ?></p>

					</header>
				</div>
			</div>
			<div class="entry-content">
				<div class="row">
					<div class="large-12 column">
						<?php the_content(); ?>
					</div>
				</div>
			</div>
			<div class="text-center margin-bottom-30">
				<a href="<?php echo get_field('eu_discover_more',get_the_ID(),TRUE); ?>" class="button-text" target="_blank">Discover More</a>	
				<div class="row">
					<div class="large-12 columns opts">
							<?php $args = array(
								'posts_per_page'   => -1,
								'post_type'        => 'funding-programmes',
								'order'            => 'asc'
							);
							$posts_array = get_posts( $args ); ?>
							
						<div class="medium-9 small-8 columns fund-option">
							<select onchange="javascript:handleSelect(this)">
							    	<option selected>Choose A Programme</option>
							<?php
							foreach ( $posts_array as $post ) : setup_postdata( $post ); ?>
									 <option value="<?php the_permalink();?>"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></option>
							<?php endforeach; 
							wp_reset_postdata();?>
							</select>
						</div>
						<div class="medium-3 small-4 columns fund-option2">
							<select id="calls-filter">
								<option value="status-open-calls">Open Calls</option>
								<option value="status-no-open-calls">No Open Calls</option>
								<!-- <option value="Open Calls">Open Calls</option>
								<option value="Open Calls">Open Calls</option> -->
							</select>
						</div>
					</div>
				</div>
				<div class="legend-sections">
					<div class="row">
						<div class="medium-12 columns legends">
							<ul>
								<li class="leg">legend</li>

								<?php

								$programs = get_field('opportunities_programmes',get_the_ID(),TRUE);

								if ($programs)
								{
									$legends = array();
									$legends_temp;

									foreach($programs as $p)
									{
										$legends_temp = get_the_terms($p['programme']->ID,'legend');

										if ($legends_temp)
										{
											foreach($legends_temp as $lt)
											{
												$legends[] = $lt->term_id;
											}
										}
									}		

									$legends = array_unique($legends);
								}

								?>

								<?php if($legends) : ?>
								<?php foreach($legends as $legend) : ?>
									<?php $legendary = get_term($legend,'legend') ?>

								<li class="" style="background-color: <?php echo get_field('color','legend_'.$legend,TRUE); ?>"><?php echo $legendary->name; ?></li>	

								<?php endforeach; ?>
							<?php endif; ?>
							</ul>
						</div>
					</div>
				</div>
				<div class="programme-content">
					<div class="row">
						<div class="grid-x grid-margin-x large-12 columns">
							<?php
					            $rows = get_field('calls_eu_funding_list');
					            if($rows)
					            {
					              foreach($rows as $row)
					              {
					                $post_id = $row['calls_eu_funding'];
					                $terms = get_the_terms($post_id->ID , 'legend' );

					                if (strtotime(get_the_date($post_id)) > strtotime('now'))
					                {
					                	$callstatus = 'status-open-calls';
					                }
					                else
					                {
					                	$callstatus = 'status-no-open-calls';
					                }
					               
					                
					                ?>			

					                <div class="cell medium-6 small-12 eu-fcell <?php the_field('call_status', $post_id); ?> <?php echo $callstatus; ?>" call-status="<?php echo $callstatus; ?>">
					                		<ul class="tax">
					                			<?php $width = 100/count($terms);  if($terms) { foreach ( $terms as $term ){ ?>

					                				<li style="width: <?php echo $width; ?>%; background-color: <?php echo get_field('color', $term->taxonomy . '_' . $term->term_id) ?>"></li>
					                			
					                			
					                			<?php } } ?>


					                		</ul>

											<h3 class="press-release-related-icon"><?php echo get_the_title($post_id); ?></h3>
						                	<p class="deadline"><img src="http://meusac.webee.com.mt/wp-content/uploads/2018/02/stopwat.png"><span class="deaddate">Deadline </span>
						                		<?php echo date('F j, Y', strtotime(get_the_date($post_id))); ?></p> 
						          			<a class="deadlink" href="<?php echo get_permalink($post_id);?>"> Discover More</a>
					              	</div>
					                <?
					              }
					            }
					        ?>
						</div>
					</div>
				</div>
			</div>
			<div class="partner-search">
				<div class="row">
					<div class="large-12 colummn">
						<div class="section-header-block text-center">
							<div class="section-wrapper">
								<p><strong>EU Funding Programmes</strong></p>
								<h3 class="theme-color-1">Partner <strong>Search</strong></h3>
							</div>
						</div>
						<p class="text-center margin-bottom-30">If you do not see the funding programme your project falls under and which you are seeking partners for, we might still be able to assist. Please contact us on funding.meusac@gov.mt for further information.</p>
					</div>
				</div>
				<div class="row">
					<div class="large-12 columns">
						<?php $partner_search = get_field('eu_funding_partner_search',get_the_ID(),TRUE); ?>
						<div class="partner-search-listing row">
							<ul>
							<?php if($partner_search) : ?>

								<?php foreach($partner_search as $ps) : ?>

									<?php

									$ps_obj = get_post($ps['eu_funding_choose_partner']);

									if (get_field('is_external_link',$ps_obj->ID,TRUE))
									{
										$target = '_blank';
										$src = get_field('ps_external_link',$ps_obj->ID,TRUE);
									}
									else
									{
										$target = '';
										$src = get_permalink($ps_obj->ID);
									}

									?>

									<li class="large-6 columns">
										<a href="<?php echo $src; ?>" target="<?php echo $target; ?>">
											<?php echo $ps_obj->post_title; ?>
										</a>
									</li>

								<?php endforeach; ?>

							<?php endif; ?>
							</ul>
						</div>
					</div>
					<div class="large-6 column force-hide">
						<div class="post-listing">
							<ul>
								<li>
									<a href="#">
										<h5>Creative Europe</h5>
									</a>
								</li>
								<li>
									<a href="#">
										<h5>Erasmus +</h5>
									</a>
								</li>
								<li>
									<a href="#">
										<h5>Europe for Citizens</h5>
									</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="large-6 column force-hide">
						<div class="post-listing">
							<ul>
								<li>
									<a href="#">
										<h5>Horizon 2020</h5>
									</a>
								</li>
								<li>
									<a href="#">
										<h5>Interreg Europe</h5>
									</a>
								</li>
								<li>
									<a href="#">
										<h5>ENI CBS Med Programme</h5>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</article>
	<?php endwhile; ?>

	</div>
		
<?php get_footer('alt'); ?>

<script type="text/javascript">

function showCallStatus(callStatus)
{
	jQuery('.eu-fcell').each(function(){
		if (jQuery(this).hasClass(callStatus))
		{
			jQuery(this).show(300);
		}
		else
		{
			jQuery(this).hide(300);
		}
	});
}

function handleSelect(elm)
{
window.location = elm.value;
}
</script>

<script type="text/javascript">
jQuery(document).ready(function($) {
	$('#calls-filter').on('change', function()  {
		const value = $(this).val();
		/*
		$('.eu-fcell').hide();

		$('.eu-fcell.'+value).show();*/
		showCallStatus(value);
	});
	showCallStatus('status-open-calls');
});
</script>