<?php
error_reporting(0);
require_once('lib/clean.php');
require_once('lib/enqueue-style.php');
require_once('lib/foundation.php');
require_once('lib/nav.php');
require_once('lib/shortcodes.php');
require_once('lib/custom-post-types.php');
if( ! function_exists( 'reverie_theme_support' ) ) {
    function reverie_theme_support() {
        load_theme_textdomain('reverie', get_template_directory() . '/lang');
        add_theme_support('post-thumbnails');
        add_theme_support('automatic-feed-links');
        add_theme_support( 'custom-logo' );
        add_theme_support('menus');
        register_nav_menus(array(
            'primary' => __('Primary Navigation', 'reverie'),
        ));
    }
}
add_action('after_setup_theme', 'reverie_theme_support');
function reverie_widgets_init() {
  register_sidebar(array('name'=> 'Sidebar',
    'id' => 'sidebar',
      'before_widget' => '<div id="%1$s" class="panel widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h4 class="widget-title">',
      'after_title' => '</h4>'
  ));
  register_sidebar(array('name'=> 'Footer 1',
    'id' => 'footer-1',
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h4 class="widget-title">',
      'after_title' => '</h4>'
  ));
  register_sidebar(array('name'=> 'Footer 2',
    'id' => 'footer-2',
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h4 class="widget-title">',
      'after_title' => '</h4>'
  ));
  register_sidebar(array('name'=> 'Footer 3',
    'id' => 'footer-3',
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h4 class="widget-title">',
      'after_title' => '</h4>'
  ));
}
add_action( 'widgets_init', 'reverie_widgets_init' );
if ( ! function_exists( 'reverie_entry_meta' ) ) {
    function reverie_entry_meta() {
        echo '<span class="byline author">'. __('Written by', 'reverie') .' <a href="'. get_author_posts_url(get_the_author_meta('ID')) .'" rel="author" class="fn">'. get_the_author() .', </a></span>';
        echo '<time class="updated" datetime="'. get_the_time('c') .'" pubdate>'. get_the_time('F jS, Y') .'</time>';
    }
};
add_shortcode('social_media_links', 'social_media_links_function');
function social_media_links_function() {
  ob_start(); ?>
    <ul id="social-media-links">
      <li><a href="#" target="_blank"><i class="fa fa-facebook"></i></a></li>
      <li><a href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
      <li><a href="#" target="_blank"><i class="fa fa-youtube"></i></a></li>
      <li class="force-hide"><a href="#" target="_blank"><i class="fa fa-linkedin"></i></a></li>
    </ul>
  <?php
  return ob_get_clean();
}
add_shortcode('posts_section', 'posts_section_function');
function posts_section_function() {
  ob_start();
  ?>
  <div id="posts_section">
    <ul class="tabs" data-tab role="tablist">
      <li class="tab-title active" role="presentation"><a href="#panel1-1" role="tab" tabindex="0" aria-selected="true" aria-controls="panel1-1">Latest<strong>News</strong></a></li>
      <li class="tab-title" role="presentation"><a href="#panel1-2" role="tab" tabindex="0" aria-selected="false" aria-controls="panel1-2">Upcoming<strong>Events</strong></a></li>
      <li class="tab-title" role="presentation"><a href="#panel1-3" role="tab" tabindex="0" aria-selected="false" aria-controls="panel1-3">Notice<strong>Board</strong></a></li>
    </ul>
    <div class="tabs-content">
      <section role="tabpanel" aria-hidden="false" class="content active" id="panel1-1">
        <div class="row">
          <?php
            $args = array(
              'posts_per_page'   => 3,
              'post_type'        => 'post',
              'orderby'          => 'date',
              'order'            => 'DESC',
              'post_status'      => 'publish',
              'category_name'         => 'news',
              'suppress_filters' => true 
            );
            $query = new WP_Query($args);
            if ( $query->have_posts() ) {
              while ( $query->have_posts() ) {
                $query->the_post();
          ?>
          <div class="large-4 medium-4 columns">
            <div class="post-item">
              <div class="featured-image horizontal" style="background-image: url(<?php the_post_thumbnail_url(); ?>);">
                <?php if(!has_post_thumbnail()){ ?>
                  <div class="vertical">
                    <img src="<?php echo home_url(); ?>/wp-content/uploads/2018/01/logo.jpg">
                  </div>
                <?php }?>
              </div>
              <h1><?php echo wp_trim_words( get_the_title(), 5 ); ?></h1>
              <span class="post-date"><?php echo get_the_date('d F Y'); ?></span>
              <div class="ellipsis"><p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p></div>
              <a class="read-more" href="<?php echo get_the_permalink();?>">Read More</a>
            </div>
          </div>
          <?php
              }
              wp_reset_postdata();
            }
          ?>
        </div>
        <div class="row">
          <div class="vc_btn3-container opts button-text vc_btn3-center">
        <a style="background-color:#1d8e97; color:#ffffff;" class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-round vc_btn3-style-custom" href="/news" title="">View All</a>
      </div>
        </div>
      </section>
      <section role="tabpanel" aria-hidden="true" class="content" id="panel1-2">
        <div class="row">
          <?php
            // $args = array(
            //   'posts_per_page'   => 3,
            //   'event-type'       => 'Upcoming Events',
            //   'orderby'          => 'date',
            //   'order'            => 'ASC',  
            //   'post_type'        => 'events-activities',
            //   'post_status'      => array('publish','future'),
            //   'suppress_filters' => true 
            // );

            $today = getdate();
            $args = array(
               'posts_per_page'   => 3,
               'post_type' => array('events-activities', 'consultation_session'),
               'post_status'      => array('publish', 'future'),
               'paged'            => $paged,
               'date_query' => array(
                    array(
                      'after'    => array(
                        'year'  => $today['year'],
                        'month' => $today['mon'],
                        'day'   => $today['mday'],
                      ),
                      'inclusive' => false,
                    ),
                ),
                'meta_key'   => 'cs_event',
                'meta_value' => 1,
                'orderby' => 'date',
                'order' => 'ASC'
            );
            $query = new WP_Query($args);
            if ( $query->have_posts() ) {
              while ( $query->have_posts() ) {
                $query->the_post();
          ?>
          <pre style="display: none;">
            <?php print_r($query); ?>
          </pre>
          <div class="large-4 medium-4 columns">
            <div class="post-item">
               <div class="featured-image horizontal" style="background-image: url(<?php the_post_thumbnail_url(); ?>);">
                <?php if(!has_post_thumbnail()){ ?>
                  <div class="vertical">
                    <img src="<?php echo home_url(); ?>/wp-content/uploads/2018/01/logo.jpg">
                  </div>
                <?php }?>
              </div>
              <h1><?php echo wp_trim_words( get_the_title(), 5 ); ?></h1>
              <span class="post-date"><?php echo get_the_date('d F Y'); ?></span>
              <div class="ellipsis"><p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p></div>
              <a class="read-more" href="<?php echo get_the_permalink();?>">Read More</a>
            </div>
          </div>
          <?php
              }
              wp_reset_postdata();
            }
          ?>
        </div>
        <div class="row">
          <div class="vc_btn3-container opts button-text vc_btn3-center">
        <a style="background-color:#1d8e97; color:#ffffff;" class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-round vc_btn3-style-custom" href="/events-and-activities" title="">View All</a>
      </div>
        </div>
      </section>
      <section role="tabpanel" aria-hidden="true" class="content" id="panel1-3">
        <div class="row">
          <?php
            $args = array(
              'posts_per_page'   => 3,
              'category_name'    => 'Notice Boards',
              'orderby'          => 'date',
              'order'            => 'DESC',
              'post_type'        => 'post',
              'post_status'      => 'publish',
              'suppress_filters' => true 
            );
            $query = new WP_Query($args);
            if ( $query->have_posts() ) {
              while ( $query->have_posts() ) {
                $query->the_post();
          ?>
          <div class="large-4 medium-4 columns">
            <div class="post-item">
               <div class="featured-image horizontal" style="background-image: url(<?php the_post_thumbnail_url(); ?>);">
                <?php if(!has_post_thumbnail()){ ?>
                  <div class="vertical">
                    <img src="<?php echo home_url(); ?>/wp-content/uploads/2018/01/logo.jpg">
                  </div>
                <?php }?>
              </div>
              <h1><?php echo wp_trim_words( get_the_title(), 5 ); ?></h1>
              <span class="post-date"><?php echo get_the_date('d F Y'); ?></span>
              <div class="ellipsis"><p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p></div>
              <a class="read-more" href="<?php echo get_the_permalink();?>">Read More</a>
            </div>
          </div>
          <?php
              }
              wp_reset_postdata();
            }
          ?>
        </div>
        <div class="row">
          <div class="vc_btn3-container opts button-text vc_btn3-center">
        <a style="background-color:#1d8e97; color:#ffffff;" class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-round vc_btn3-style-custom" href="/noticeboard" title="">View All</a>
      </div>
        </div>
      </section>
    </div>
  </div>
  <?php
  return ob_get_clean();
}


add_shortcode('stories_section', 'stories_section_function');
function stories_section_function() {
    ob_start();
  ?>
  <div id="stories_section">
    <ul class="tabs" data-tab role="tablist">
      <li class="tab-title active" role="presentation"><a href="#panel2-3" role="tab" tabindex="0" aria-selected="true" aria-controls="panel2-3">Articles</a></li>
      <li class="tab-title" role="presentation"><a href="#panel2-2" role="tab" tabindex="0" aria-selected="true" aria-controls="panel2-2">Interviews/Features</a></li>
      <li class="tab-title" role="presentation"><a href="#panel2-4" role="tab" tabindex="0" aria-selected="true" aria-controls="panel2-4">Success<strong>Stories</strong></a></li>
      <!-- <li class="tab-title force-hide" role="presentation"><a href="#panel2-5" role="tab" tabindex="0" aria-selected="false" aria-controls="panel2-5">Newsletter</a></li> -->
    </ul>
    <div class="tabs-content">
      <section role="tabpanel" aria-hidden="true" class="content" id="panel2-2">
        <div class="row">
          <?php
            $args = array(
              'posts_per_page'   => 10,
              //'category_name'    => 'Interviews',
              'orderby'          => 'date',
              'order'            => 'DESC',
              'post_type'        => 'post',
              'post_status'      => 'publish',
              'suppress_filters' => true,
              'tax_query' => array(
              array(
                  'taxonomy' => 'category',
                  'field' => 'slug',
                  'terms' => array( 'interviews', 'features' )
              )
          )
            );
            $query = new WP_Query($args);
            if ( $query->have_posts() ) { ?>
            <div class="interviews-slider-wrapper">
              <div class="success-stories-slider">
              <?php
                while ( $query->have_posts() ) {
                  $query->the_post();
            ?>
              <div class="success-story-slide">
                <a href="<?php echo get_the_permalink();?>">
                  <div class="slider-bg-holder" style="background-image: url(<?php the_post_thumbnail_url(); ?>);">
                    <div class="story-title">
                      <p><?php echo get_the_title(); ?></p>
                    </div>
                  </div>
                </a>
              </div>
            <?php
                }
                wp_reset_postdata();
              }
            ?>
            </div>
          </div>
        </div>
      </section>
      <section role="tabpanel" aria-hidden="false" class="content active" id="panel2-3">
        <div class="row">
          <?php
            $args = array(
              'posts_per_page'   => 10,
              'orderby'          => 'date',
              'order'            => 'DESC',
              'post_type'        => 'post',
              'post_status'      => 'publish',
              'suppress_filters' => true,
              'tax_query' => array(
                array(
                  'taxonomy' => 'category',
                  'field' => 'slug',
                  'terms' => 'meusac-media'
                )
              ) 
            );
            $query = new WP_Query($args);
            if ( $query->have_posts() ) { ?>
            <div class="articles-slider-wrapper">
              <div class="success-stories-slider">
              <?php
                while ( $query->have_posts() ) {
                  $query->the_post();
            ?>
              <div class="success-story-slide">
                <?php if(get_field('view_attachment',get_the_ID(),TRUE)) : ?>
                  <?php $attachment_file = get_field('attachment',get_the_ID(), TRUE); ?>
                  <a href="<?php echo $attachment_file['url']; ?>" target="_blank">
                <?php else : ?>
                  <a href="<?php the_permalink(); ?>">
                <?php endif; ?>
                <!--<a href="<?php echo get_field('attachment')['url'];?>" target="_blank">-->
                  <?php if(!has_post_thumbnail()){ ?>
                  <div class="slider-bg-holder theme-border" style="background-image: url('<?php echo home_url(); ?>/wp-content/uploads/2018/01/logo.jpg');background-position: center;background-size: auto;background-color: white">
                  <?php }else{?>
                  <div class="slider-bg-holder" style="background-image: url(<?php the_post_thumbnail_url(); ?>);">
                  <?php }?>
                    <div class="story-title">
                      <!--<p style="white-space: nowrap;"><?php echo get_the_title(); ?></p>-->
                      <p><?php echo get_the_title(); ?></p>
                    </div>
                  </div>
                </a>
              </div>
            <?php
                }
                wp_reset_postdata();
              }
            ?>
            </div>
          </div>
        </div>
      </section>
      <section role="tabpanel" aria-hidden="true" class="content" id="panel2-4">
        <div class="row">
          <?php
            $args = array(
              'posts_per_page'   => 10,
              'category_name'    => 'Success Stories',
              'orderby'          => 'date',
              'order'            => 'DESC',
              'post_type'        => 'post',
              'post_status'      => 'publish',
              'suppress_filters' => true 
            );
            $query = new WP_Query($args);
            if ( $query->have_posts() ) { ?>
            <div class="success-stories-slider-wrapper">
              <div class="success-stories-slider">
              <?php
                while ( $query->have_posts() ) {
                  $query->the_post();
            ?>
              <div class="success-story-slide">
                <a href="<?php echo get_the_permalink();?>">
                  <div class="slider-bg-holder" style="background-image: url(<?php the_post_thumbnail_url(); ?>);">
                    <div class="story-title">
                      <p><?php echo get_the_title(); ?></p>
                    </div>
                  </div>
                </a>
              </div>
            <?php
                }
                wp_reset_postdata();
              }
            ?>
            </div>
          </div>
        </div>
      </section>
      <!-- <section role="tabpanel" aria-hidden="true" class="content" id="panel2-5">
        <div class="row"> -->
          <?php
            // $args = array(
            //   'posts_per_page'   => 10,
            //   'category_name'    => 'Newsletter',
            //   'orderby'          => 'date',
            //   'order'            => 'DESC',
            //   'post_type'        => 'post',
            //   'post_status'      => 'publish',
            //   'suppress_filters' => true 
            // );
            //$query = new WP_Query($args);
            //if ( $query->have_posts() ) { ?>
            <!-- <div class="newsletter-slider-wrapper">
              <div class="success-stories-slider"> -->
              <?php
                //while ( $query->have_posts() ) {
                  //$query->the_post();
            ?>
              <!-- <div class="success-story-slide">
                <a href="<?php //echo get_the_permalink();?>">
                  <div class="slider-bg-holder" style="background-image: url(<?php //the_post_thumbnail_url(); ?>);">
                    <div class="story-title">
                      <p><?php //echo get_the_title(); ?></p>
                    </div>
                  </div>
                </a>
              </div> -->
            <?php
                //}
                //wp_reset_postdata();
              //}
            ?>
            <!-- </div>
          </div>
        </div>

      </section> -->
    </div>
  </div>
  <?php
  return ob_get_clean();
}
function create_post_type() {
  register_post_type( 'team',
    array(
      'labels' => array(
        'name' => __( 'Teams' ),
        'singular_name' => __( 'Team' )
      ),
      'public' => true,
      'has_archive' => true,
      'supports' => array('title','thumbnail'),
    )
  );
}
add_action( 'init', 'create_post_type' );
function wpdocs_register_private_taxonomy() {
    $args = array(
        'label'        => __( 'Department', 'meusac' ),
        'rewrite'      => false,
        'hierarchical' => true
    );
     
    register_taxonomy( 'department', 'team', $args );
}
add_action( 'init', 'wpdocs_register_private_taxonomy', 0 );
add_shortcode('team_section', 'team_section_function');
function team_section_function() {
    ob_start();
  ?>
  <div>
   
  </div>
  <div id="team_section">
    <div class="menu-employee-position-main-container">
        <div class="grid-x grid-margin-x">
          <div class="cell large-10 large-offset-1">
            <nav class="responsive">
              <label for="drop" class="toggle">EU POLICY & LEGISLATION <i class="fa fa-caret-down"></i></label>
              <input type="checkbox" id="drop" />
              <ul class="menu tabs first-ul" data-tab role="tablist">
                  <?php
                      $departments = get_terms( array( 
                        'taxonomy' => 'department',
                        'hide_empty' => false,
                        'exclude' => array(18)
                      ));
                      $no_items = 0;
                      foreach ($departments as $key => $department) {
                          if($no_items == 4){
                            $no_items = 0;
                            echo '</ul><div class="clear"></div><ul class="tabs" data-tab role="tablist">';
                          }
                          $href = '#'.$department->slug;
                          $active = ($department->slug == 'eu-policy-legislation') ? 'active' : '';
                          ?>
                          <li class="tab-title <?php echo $active;?>" role="presentation">
                          <a class="unbold-first" href="<?php echo $href;?>" role="tab" tabindex="0" aria-selected="true" aria-controls="panel2-1"><?php echo $department->name;?></a></li>
                          <?php
                          if($key == count($departments) - 1){
                            echo "</ul>";
                          }
                          $no_items++;
                      }
                    ?>
                  </div>
              </ul>
            </nav>
          </div> <!-- End Cell -->
        </div>
    </div>
    <div class="clear"></div>
    <div class="team-spacer"></div>
    <div class="grid-x grid-margin-x">
      <div class="cell large-10 large-offset-1"> 
      <div class="tabs-content">
        <?php
          foreach ($departments as $key => $department) {
            $active = ($department->slug == 'eu-policy-legislation') ? 'active' : '';
            ?>
              <section role="tabpanel" aria-hidden="true" class="content <?php echo $active;?>" id="<?php echo $department->slug;?>">
                  <?php
                      $args = array(
                        'posts_per_page'   => -1,
                        'post_type'        => 'team',
                        'post_status'      => 'publish',
                        'suppress_filters' => true 
                      );
                      $query = new WP_Query($args);
                      ?>
                      <div class="about-employee-list grid-x grid-margin-x">
                        <?php 
                        if ( $query->have_posts() ) { 
                            while ( $query->have_posts() ) {
                              $query->the_post();
                              $term_list = wp_get_post_terms( get_the_ID(), 'department', array( 'fields' => 'slugs' ));
                              if (in_array($department->slug, $term_list)){
                                $position = get_post_meta( get_the_ID(), 'position', true ); 
                                ?> <!-- End Php to Display html -->
                                  <div class="cell medium-3 large-3 small-12 <?php echo implode(' ', $term_list);?>">
                                    <div class="about-team-img-container">
                                      <img src="<?php the_post_thumbnail_url();?>"/>
                                    </div>
                                    <div class="employee-details">
                                  <?php if(get_field('is_director',get_the_ID(),TRUE)) : ?>
                    <p class="theme-color-1"><a href="<?php the_permalink(); ?>"><strong><?php the_title();?></strong></a></p>
                                  <?php else : ?>
                                    <p class="theme-color-1"><strong><?php the_title();?></strong></p>
                                  <?php endif; ?>
                                      <p><?php echo $position;?></p>
                                    </div>
                                  </div>
                                <?php
                              }
                            }
                            wp_reset_postdata();
                        }
                  ?>
                      </div> <!-- End of about_employee_list -->
              </section>
            <?php
          }
        ?>
      </div>
    </div>
  </div>
  <?php
  return ob_get_clean();
}
// NEW SHORTCODES
add_shortcode('post-listings', 'set_post_listings');
function set_post_listings($atts = null) {
  extract(shortcode_atts(array('type' => 'sectoral-committees', 'subtitle' => false), $atts));
  $posts = '';

  global $wpdb;
        
  $results = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}posts WHERE post_type='funding-opportunity' AND post_status='publish' AND id NOT IN (SELECT pm.meta_value FROM {$wpdb->prefix}posts p, {$wpdb->prefix}postmeta pm WHERE p.post_type='funding-programmes' AND p.post_status='publish' AND p.id = pm.post_id AND pm.meta_key='sc_programme') ORDER BY id DESC");

  $other_programmes = array();

  foreach($results as $result)
  {
    $other_programmes[] = $result->ID;
  }

  $args = array(
    'posts_per_page'   => -1,
    'post_type'        => $type,
    'post_status'      => 'publish',
    'post__not_in'     => $other_programmes,
    'orderby'          => 'title',
    'order'            => 'asc'
  );

  $query = new WP_Query($args);
  if ($query->have_posts()) { 
    while ($query->have_posts()) {
      $query->the_post();
      $posts .='<li>';
      $posts .='<a href="'.get_the_permalink().'">';
      $posts .= '<h5>'.get_the_title().'</h5>';
      $posts .= $subtitle ? '<p>'.get_field('sc_subtitle',get_the_ID(),TRUE).'</p>' : '';
      $posts .='</a>';
      $posts .='</li>';
    }
    wp_reset_postdata();
  }
  ob_start();
  ?>
    <div class="post-listing">
      <ul>
        <?php echo $posts; ?>
      </ul>
    </div>
    <?php if($type == 'funding-opportunity'):?>
      <div class="other-programmes-link theme-color-1">
        <h3 style="text-align: center;">Other <strong>Programmes</strong> - No Open Calls</h3>
        <div class="post-listing">
          <ul>
            <li>
              <a href="<?php //echo home_url(); ?>/other-programmes/">
                <h5>Other Programmes - No Open Calls</h5>
                <figure></figure>
              </a>
            </li>
          </ul>
        </div>
      </div>
    <?php endif;?>
  <?php
  return ob_get_clean();
}
add_shortcode('custom-link', 'set_custom_link');
function set_custom_link($atts = null) {
  extract(shortcode_atts(array('link' => '#', 'title' => '', 'target'=> ''), $atts));
  ob_start();
  ?>
  <div class="custom-link">
    <a href="<?php echo $link; ?>" title="<?php echo $title; ?>" target="<?php echo $target;?>">
      <?php printf('<p>%s</p>', $title); ?>
    </a>
  </div>
  <?php
  return ob_get_clean();
}
function create_post_office_location() {
  register_post_type( 'office',
    array(
      'labels' => array(
        'name' => __( 'Offices' ),
        'singular_name' => __( 'Office' )
      ),
      'public' => true,
      'has_archive' => true,
      'supports' => array('title','thumbnail'),
    )
  );
}
add_action( 'init', 'create_post_office_location' );
add_shortcode('office-locations', 'office_locations');
function office_locations() {
  ob_start();
  ?>
  <?php
      $args = array(
        'posts_per_page'   => -1,
        'post_type'        => 'office',
        'post_status'      => 'publish',
        'suppress_filters' => true 
      );
      $query = new WP_Query($args);
      ?>
        <div class="office-list grid-x grid-margin-x">
          <?php 
            if ( $query->have_posts() ) { 
                while ( $query->have_posts() ) {
                  $query->the_post();
                    ?>
                     <div class="cell medium-6 large-6 small-12">
                        <p class="force-hide"><strong><?php the_title();?></strong></p>
                        <h3>
                          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/location_icon.png" align="left"/>
                          <?php echo get_post_meta( get_the_ID(), 'address', true );?>
                          <br/><?php echo get_post_meta( get_the_ID(), 'address_line_2', true );?>
                        </h3><br/>
                        <h3>
                          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/phone_icon.png" align="left"/>
                          <?php echo get_post_meta( get_the_ID(), 'telephone', true );?>
                        </h3><br/>
                        <div class="office-schedule">
                          <p><strong>OPENING HOURS</strong></p>
                        <?php
                            $schedules = get_field('office_schedule');
                            foreach ($schedules as $key => $schedule) {?>
                              <p>
                                <span class="theme-color-1">
                                  <strong><?php echo $schedule['working_days'];?></strong>
                                </span>&nbsp;
                                <span class="large-text">
                                  <?php echo $schedule['office_hours'];?>
                                </span>
                              </p>
                            <?php }
                        ?>
                        </div>
                        <br/><br/>
                          <?php if(get_post_meta(get_the_ID(), 'email', true ) ) {?>
                            <h3>
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/mail_icon.png" align="left"/>
                            <?php echo get_post_meta( get_the_ID(), 'email', true );?>
                            </h3>
                          <?php }?>
                        
                      
                          <?php if(get_post_meta(get_the_ID(), 'web_site', true ) ) {?>
                              <h3 class="force-hide">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/link_icon.png" align="left"/>
                            <?php echo get_post_meta( get_the_ID(), 'web_site', true );?>
                            </h3>
                          <?php }?>
                          <br/><br/>
                      </div>
                    <?php
                }
                wp_reset_postdata();
            }
          ?>
        </div> <!-- End of office list -->
  <?php
  return ob_get_clean();
} // End of office location shortcode
add_shortcode('media-section', 'media_section');
function media_section($atts = null) {
    extract(shortcode_atts(array('category' => 'Press Release','group_by_year' => 'true','group_by_month' => 'false','order' => 'DESC', 'section' => 'media-press-releases'), $atts));
    ob_start();
    // get the current page
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
  <div class="media_press_release_section">
    <?php if($group_by_year == 'true') { ?>
      <ul class="tabs" data-tab role="tablist">
        <?php for ($year = date("Y"); $year >= 2018 ; $year--){?>
          <li class="tab-title <?php echo ($year == date("Y")) ? 'active' :'';?>" 
              role="presentation">
              <a href="#press-release-<?php echo $year;?>" role="tab" tabindex="0" aria-selected="true" aria-controls="press-release-<?php echo $year;?>"><?php echo $year;?></a>
          </li>
        <?php } ?>
      </ul>
      <div class="tabs-content">
        <?php for ($year = date("Y"); $year >= '2018' ; $year--){?>
          <section role="tabpanel" aria-hidden="false" 
              class="content <?php echo ($year == date("Y")) ? 'active' :'';?>" 
              id="press-release-<?php echo $year;?>">
            <?php
              $args = array(
                'posts_per_page'   => 5,
                'post_type'        => 'news-media',
                'news-category'    => $category,
                'orderby'          => 'date',
                'order'            => $order,
                'post_status'      => 'publish',
                'suppress_filters' => true,
                'date_query'       => array(
                  array(
                    'year'  => $year
                  ),
                 ),
                'paged' => $current_page
              );
              $query = new WP_Query($args);
              if($query->have_posts() ) { 
                while ( $query->have_posts() ) {
                  $query->the_post();
                  // echo do_shortcode('[custom-link link="'.get_the_permalink().'" title="'.get_the_title().'"]');
                  echo do_shortcode('[custom-link link="'.get_field('attachment')['url'].'" title="'.get_the_title().'" target="_b"]');
                }
              }
              ?>
          </section>
        <?php } ?>
      </div>
      <?php
          wp_reset_postdata();
      ?>
    <?php }else{ ?>
      <section role="tabpanel" aria-hidden="false" class="content <?php echo ($year == date("Y")) ? 'active' :'';?>" id="press-release-<?php echo $year;?>">
            <?php
              $args = array(
                'posts_per_page'   => 5,
                'post_type'        => 'news-media',
                'news-category'    => $category,
                'orderby'          => 'date',
                'order'            => $order,
                'post_status'      => 'publish',
                'suppress_filters' => true,
                'paged' => $current_page
              );
              $query = new WP_Query($args);
              if($query->have_posts() ) { 
                while ( $query->have_posts() ) {
                  $query->the_post();
                  // echo do_shortcode('[custom-link link="'.get_the_permalink().'" title="'.get_the_title().'"]');
                  echo do_shortcode('[custom-link link="'.get_field('attachment')['url'].'" title="'.get_the_title().'" target="_b"]');
                }
              }
              ?>
      </section>
      <?php
          wp_reset_postdata();
      ?>
    <?php }?>
    <?php 
      global $wp_query;
      $total = $query->max_num_pages;
      // only bother with the rest if we have more than 1 page!
      if ( $total > 1 )  {     
          $big = 999999999;
          $paginate_links = paginate_links( array(
              'base' => str_replace( $big, '%#%', get_pagenum_link( $big, false ) ),
              'current' => $current_page,
              'total' => $query->max_num_pages,
              'type' => 'list', // How you want the return value to be formatted
              'add_fragment' => '#'.$section, // Your anchor
              'add_args' => array('section' => $section)
          ));

          echo '<div class="pull-right" style="margin-top:10px">'.$paginate_links.'</div>';



           // $format = '?paged=%#%';
           // //$parse_url = parse_url(get_pagenum_link(1));
           // echo '<div class="pull-right" style="margin-top:10px">'.paginate_links(array(
           //      'base'     => get_pagenum_link(1) . '%_%',
           //      'format'   => $format,
           //      'current'  => $current_page,
           //      'total'    => $total,
           //      'mid_size' => 4,
           //      'type'     => 'list'
           // )).'</div>';
      }

    ?>
  </div>
  <?php
  return ob_get_clean();
}
function wpdocs_register_event_taxonomy() {
    $args = array(
        'label'        => __( 'Event Type', 'meusac' ),
        'rewrite'      => false,
        'hierarchical' => true
    );
     
    register_taxonomy( 'event-type', 'events-activities', $args );
}
add_action( 'init', 'wpdocs_register_event_taxonomy', 0 );
function wpdocs_register_funding_programme_taxonomy() {
    $args = array(
        'label'        => __( 'Legend', 'meusac' ),
        'rewrite'      => false,
        'hierarchical' => true,
    );
     
    register_taxonomy( 'legend', 'funding-programmes', $args );
}
add_action( 'init', 'wpdocs_register_funding_programme_taxonomy', 0 );
function wpdocs_register_news_media_taxonomy() {
    $args = array(
        'label'        => __( 'News Category', 'meusac' ),
        'rewrite'      => false,
        'hierarchical' => true,
        'rewrite' => array( 'slug' => 'tag' ),
    );
     
    register_taxonomy( 'news-category', 'news-media', $args );
}
add_action( 'init', 'wpdocs_register_news_media_taxonomy', 0 );
add_shortcode('events-media', 'events_media_section');
function events_media_section($atts = null) {
    extract(shortcode_atts(array('category' => 'Press Releases'), $atts));
    ob_start();
  ?>
          <?php
            $rows = get_field('event_media');
            if($rows)
            {
              foreach($rows as $row)
              {
                $post_id = $row['media_page']->ID;
                $post_date = get_the_date('d.m.y',$post_id);
                $term_list = wp_get_post_terms($post_id, 'news-category', array( 'fields' => 'names' ));
                // var_dump($term_list);
                if(in_array($category, $term_list)){
                    echo do_shortcode('[custom-link link="'.get_permalink($post_id).'" 
                      title="'.$post_date.'-'.get_the_title($post_id).'"]');
                }
              }
            }
            ?>
  <?php
      wp_reset_postdata();
      return ob_get_clean();
}


add_shortcode('post-footer', 'post_footer_section');
function post_footer_section($atts = null) {
    extract(
      shortcode_atts(
        array(
          'post_type' => 'post',
          'icon' => 'press-release-related-icon',
          'title' => 'news',
          'date_query' => 'before',
        ),
        $atts
      )
    );
    ob_start();
  ?>
<div class="sectoral-links event-single-post-template">
        <h2 class="text-center">other <?php echo $title;?></h2>
        <div class="event-links-wrapper" style="padding-left: 35px;padding-right: 35px;">
          <div class="row">
            <?php
                $postID = get_the_ID();
                  // Note:
                  // Date query isn't working with args ex. category
                  $first_tag = $tags[0]->term_id;
                  $args = array(
                    // 'tag__in'          => array($first_tag),
                    'post__not_in'     => array($postID),
                    'posts_per_page'   => -1,
                    'caller_get_posts' => 1,
                    'orderby'          => 'date',
                    'order'            => 'DESC',
                    'post_type'        => $post_type,
                    'date_query' => array(
                        $date_query    => get_the_date('c'),
                    ),
                  );
                  if(isset($category_name)){
                    $category_filter = array($category_name => $category);
                    array_push($args,$category_filter);
                  }
                  
                $my_query = new WP_Query($args);
                $no_items = 0;
                if( $my_query->have_posts() ) {
                  while ($my_query->have_posts()) : $my_query->the_post(); ?>
                  <?php 
                    $term_list = wp_get_post_terms( get_the_ID(), $category_name, array( 'fields' => 'slugs' ));
                  if (has_category($category) || in_array($category, $term_list) || !isset($category_name)){?>
                  <div class="cell medium-4 small-12">
                    <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
                      <h3 class="<?php echo $icon;?>"><?php the_title(); ?></h3>
                      <p><?php echo get_the_date('d F Y'); ?></p>
                    </a>
                  </div>
                  <?php $no_items++;
                    if($no_items == 3){
                      break;
                    }
                  ?>
                  <?php }?>
                <?php
                  endwhile;
                }
                  wp_reset_query();
                //}
              ?>
          </div>
        </div>
      </div>
  <?php
  return ob_get_clean();
}

add_shortcode('latest-section', 'latest_section');
function latest_section($atts = null) {
    extract(
      shortcode_atts(
        array(
          'category_name' => 'category',
          'category' => 'news',
          'post_type' => 'post',
          'order' => 'DESC',
        ),
        $atts
      )
    );
    ob_start();
  ?>
  <div id="latest_section" class="upcoming-events">
     <div class="row">
          <?php
            $args = array(
              'posts_per_page'   => 1,
              'post_type'        => $post_type,
              $category_name     => $category,
              'orderby'          => 'date',
              'order'            => $order,
              'post_status'      => 'publish',
              'suppress_filters' => true 
            );
            $query = new WP_Query($args);
            if ( $query->have_posts() ) {
              while ( $query->have_posts() ) {
                $query->the_post();
          ?>
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
            <?php if(!has_post_thumbnail()){ ?>
              <div class="horizontal">
                <div class="vertical">
                  <img src="<?php echo home_url(); ?>/wp-content/uploads/2018/01/logo.jpg">
                </div>
              </div>
            <?php }else{?>
              <img src="<?php the_post_thumbnail_url(); ?>">
            <?php }?>
          </div>
          <?php
              }
              wp_reset_postdata();
            }
          ?>
        </div>
  </div>
  <?php
  return ob_get_clean();
}

add_shortcode('get_consultation_sessions', 'get_consultation_sessions_func');

function get_consultation_sessions_func( $atts )
{
  $atts = shortcode_atts( array(
    'sectoral_committee' => 'default'
  ), $atts, 'get_consultation_sessions' );

  $ret = '';

  $sc_post = get_page_by_path($atts['sectoral_committee'], OBJECT, 'sectoral-committees');

  $cs_posts = get_posts(
    array(
      'posts_per_page' => -1,
      'post_type' => 'consultation_session',
      'meta_key' => 'cs_sectoral_committee',
      'meta_value' => $atts['sectoral_committee']
    )
  );

  $current_year = 1970;

  $ret .= '<div class="cs-by-year">';
  foreach($cs_posts as $csp)
  {
    
    if (!($current_year == date('Y', strtotime($csp->post_date))))
    {
      $current_year = idate('Y', strtotime($csp->post_date));
      $ret .= '<h4>'.$current_year.'</h4>';
    }

    $ret .= '<a href="'.get_permalink($csp->ID).'">&rsaquo; '.date('d.m.y', strtotime($csp->post_date)).' - '.$csp->post_title.'</a>';
  }
  $ret .= '</div>';

  return $ret;
}

add_shortcode('related_articles', 'related_articles_func_alt');
function related_articles_func() {
  global $post;

  $related_articles = get_field('sc_related_articles',$post->ID,TRUE);

  $ret = '';

  $ra_new;

  $current_year = 1970;

  $ret .= '<div class="cs-by-year">';
  foreach ($related_articles as $k => $ra)
  {
    $ra_new[strtotime($ra['sc_date_published'])] = $ra['sc_article_file'];
  }
  asort($ra_new);

  foreach($ra_new as $k => $rn)
  {
    if (!($current_year == idate('Y',$k)))
    {
      $current_year = idate('Y',$k);
      $ret .= '<h4>'.$current_year.'</h4>';
    }
    $ret .= '<a href="'.$rn['url'].'">&rsaquo; '.$rn['title'].'</a>';
  }
  $ret .= '</div>';

  return $ret;
}

add_shortcode('sc_related_articles', 'related_articles_func_alt');
function related_articles_func_alt() {
  global $post;

  $ra_posts = get_posts(
    array(
      'posts_per_page' => -1,
      'post_type' => 'post',
      'meta_key' => 'sectoral_committee_post_alt',
      'meta_value' => $post->ID,
      'orderby' => 'post_date'
    )
  );

  $ra_new;

  $ret = '';

  $current_year = 1970;
  $ret .= '<div class="cs-by-year">';

  foreach ($ra_posts as $rap)
  {
    if (get_field('add_attachment',$rap->ID,TRUE)) {
      $attachment = get_field('sc_file_attachment',$rap->ID,TRUE);
      $ra_new[strtotime($rap->post_date)] = array('title' => $rap->post_title, 'url' => $attachment['url'], 'is-pdf' => TRUE);
    } else {
      $ra_new[strtotime($rap->post_date)] = array('title' => $rap->post_title ,'url' => get_permalink($rap->ID), 'is-pdf' => FALSE);
    }
  }

  foreach($ra_new as $k => $rn)
  {
    if (!($current_year == idate('Y',$k)))
    {
      $current_year = idate('Y',$k);
      $ret .= '<h4>'.$current_year.'</h4>';
    }

    if ($rn['is-pdf']) {
      $target = 'target="_blank"';
    } else {
      $target = '';
    }

    $ret .= '<a href="'.$rn['url'].'" '.$target.'>&rsaquo; '.$rn['title'].'</a>';
  }
  $ret .= '</div>';

  return $ret;
}

add_shortcode('ecoc', 'ecoc_func');

function ecoc_func()
{
  global $post;
  $ret = '<div class="cs-by-year">';

  $ecoc = get_posts(
    array(
      'posts_per_page' => -1,
      'post_type' => 'eco_consultation',
      'meta_key' => 'ecoc_sectoral_committees',
      'meta_value' => $post->ID
    )
  );

  foreach($ecoc as $e)
  {
    $ret .= '<a href="'.get_permalink($e->ID).'">&rsaquo; '.$e->post_title.'</a>';
  }

  $ret .= '</div>';

  return $ret;
}

function custom_excerpt_length( $length ) {
  global $post;
  if ($post->post_type == 'post') {
    return 20;
  } else {
    return 40;
  }
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function wpdocs_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );