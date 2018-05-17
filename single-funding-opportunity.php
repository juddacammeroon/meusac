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
			</div>
			<?php

			global $wpdb;
				
			$results = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}posts WHERE post_type='funding-opportunity' AND post_status='publish' AND id NOT IN (SELECT pm.meta_value FROM {$wpdb->prefix}posts p, {$wpdb->prefix}postmeta pm WHERE p.post_type='funding-programmes' AND p.post_status='publish' AND p.id = pm.post_id AND pm.meta_key='sc_programme' AND pm.post_id NOT IN (SELECT pm.post_id FROM {$wpdb->prefix}posts p, {$wpdb->prefix}postmeta pm WHERE p.post_type='funding-programmes' AND p.post_status='publish' AND p.id = pm.post_id AND pm.meta_key='deadline' AND meta_value < DATE_FORMAT(NOW(), '%Y%m%d'))) ORDER BY post_title ASC");

			$other_programmes = array();

			foreach($results as $result)
			{
				//$other_programmes[] = $result->ID;
			}

			?>

			

			<div class="text-center margin-bottom-30">
				<div class="row">
					<div class="large-12 columns opts">
							<?php $args = array(
								'posts_per_page'   => -1,
								'post_type'        => 'funding-opportunity',
								'orderby' => 'title',
								'order' => 'ASC'
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
						<?php //if(!(in_array(get_the_ID(),$other_programmes))) : ?>
						<div class="medium-3 small-4 columns fund-option2">
							<select id="calls-filter">
								<option value="status-open-calls">Open Calls</option>
								<option value="status-no-open-calls">No Open Calls</option>
							</select>
						</div>
					<?php //endif; ?>
					</div>
				</div>
				<?php //if(!(in_array(get_the_ID(),$other_programmes))) : ?>
				<div class="legend-sections">
					<div class="row">
						<div class="medium-12 columns legends">
							<ul>
								<li class="leg"><a href="<?php echo home_url(); ?>/legend/">legend</a></li>

								<?php

								$programs = get_posts(
									array(
										'posts_per_page' => -1,
										'post_type' => 'funding-programmes',
										'meta_key'	=> 'sc_programme',
										'meta_value' => get_the_ID(),
										'orderby' => 'date'
									)
								);

								$all_legends_obj = get_terms(
									array(
										'taxonomy' => 'legend',
										'hide_empty' => false
									)
								);

								$all_legends = array();

								foreach($all_legends_obj as $alo) {
									$all_legends[] = $alo->term_id;
								}

								//$programs = get_field('opportunities_programmes',get_the_ID(),TRUE);

								if ($programs)
								{
									$legends = array();
									$legends_temp;

									foreach($programs as $p)
									{
										$legends_temp = get_the_terms($p->ID,'legend');

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
								else
								{
									$legends = false;
								}

								?>
								<?php if($legends) : ?>
									<?php foreach($all_legends as $legend) : ?>
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

							$load_call = get_posts(
								array(
									'posts_per_page' => -1,
									'post_type' => 'funding-programmes',
									'meta_key'	=> 'deadline',
									'meta_query' => array(
										array(
											'key' => 'sc_programme',
											'value' => get_the_ID(),
											'compare' => '='
										)
									),
									'orderby' => 'meta_value',
									'order' => 'ASC'
								)
							);

							$no_open_calls = array();
							$open_calls = array();

							$all_calls = array();

							foreach($load_call as $lc) {
								if (!(strtotime(str_replace('/','-',get_field('deadline',$lc->ID))) > strtotime('now'))) {
									$no_open_calls[] = $lc;
								} else {
									$open_calls[] = $lc;
								}
							}

							foreach(array_reverse($no_open_calls) as $noc) {
								$all_calls[] = $noc;
								//echo date('F j, Y', strtotime(str_replace('/', '-', get_field('deadline',$noc->ID,TRUE)))).'<br />';
							}

							foreach($open_calls as $oc) {
								$all_calls[] = $oc;
							}

							?>
							<pre style="display: none;">
								<?php print_r($all_calls); ?>
							</pre>
							<?php

							?>
								<?php
					              foreach($all_calls as $row)
					              {

					                $post_id = $row;
					                $terms = get_the_terms($post_id->ID , 'legend' );

					                
			                		$deadlines = array();
			                		$add_deadlines = array();

			                		if (get_field('deadline', $post_id->ID,TRUE)) {
			                			$deadlines[] = strtotime(str_replace('/','-',get_field('deadline', $post_id->ID,TRUE)));
			                		}

			                		if (get_field('additional_deadline',$post_id->ID,TRUE)) {
			                			if(get_field('additional_deadline_list',$post_id->ID,TRUE)) {
			                				foreach(get_field('additional_deadline_list',$post_id->ID,TRUE) as $ad) {
			                					$deadlines[] = strtotime(str_replace('/','-',$ad['date']));
			                					$add_deadlines[] = strtotime(str_replace('/','-',$ad['date']));
			                				}
			                			}
			                		}
			                		asort($deadlines);
			                		asort($add_deadlines);

			                		$beyond_dates = array();

			                		foreach($deadlines as $key => $deadline) {
			                			if ($deadline > strtotime('now')) {
			                				$beyond_dates[] = $deadline;
			                				unset($deadlines[$key]);
			                			}
			                		}

			                		if (count($beyond_dates) > 0) {
			                			$callstatus = 'status-open-calls';
			                		} else {
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
						                	 
						                	<?php if (count($add_deadlines) > 0) : ?>
						                		<div>
						                	<p class="deadline"><img src="http://meusac.webee.com.mt/wp-content/uploads/2018/02/stopwat.png">
						                		<span class="deaddate">Cut-off dates </span>
						                			
						                			<span><?php echo get_field('deadline', $post_id->ID,TRUE); ?></span><br />
							                		<?php foreach($add_deadlines as $deadline) : ?>

							                			<span><?php echo date('F j, Y',$deadline); ?></span><br />

							                		<?php endforeach; ?>
						                		
						                	</p></div>
						                	<?php else : ?>
						                	<p class="deadline"><img src="http://meusac.webee.com.mt/wp-content/uploads/2018/02/stopwat.png">
						                		<span class="deaddate">Deadline </span>
						                		<?php echo get_field('deadline', $post_id->ID,TRUE); ?>
						                		
						                	</p>
						                	<?php endif; ?>
						                		<?php $the_link = get_field('external_link_url',$post_id->ID,TRUE); ?>
						          			<a class="deadlink" href="<?php echo $the_link ? $the_link : get_permalink($post_id->ID);?>" target="_blank"> Discover More</a>
					              	</div>
					                <?php
					              }
					        ?>
						</div>
					</div>
				</div>
				<?php //endif; ?>
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
						<?php $partner_search = get_field('partner_search',get_the_ID(),TRUE); ?>
						<div class="partner-search-listing row">
							<ul>

								<?php if (get_field('is_external_link', get_the_ID(), TRUE)) : ?>
									<li class="large-12 columns">
										<a href="<?php echo get_field('ps_external_link', get_the_ID(), TRUE); ?>" target="_blank">
											<?php echo get_the_title(); ?> Partner Search
										</a>
									</li>
								<?php else : ?>

									<?php if($partner_search) : ?>

										<?php foreach($partner_search as $ps) : ?>

											<li class="large-12 columns">
												<a href="<?php echo $ps['ps_link_url']; ?>" target="_blank">
													<?php echo $ps['ps_link_title']; ?>
												</a>
											</li>

										<?php endforeach; ?>

									<?php endif; ?>

								<?php endif; ?>
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