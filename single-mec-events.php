<html <?php language_attributes(); ?> class="no-js">

<?php require get_template_directory() . '/partials/head.php'; ?>

<body <?php body_class(); ?>>


<?php get_header(); ?>

<?php if (get_field('hero_image') && isset(get_field('hero_image')['url'])) { ?>
<div class="container blog-slider-section inner-banner" style="background-image: url(<?php echo get_field('hero_image')['url']; ?>);">
    <div class="container">
        <div class="blog-slider-content">
            <div class="row -align-items-center">
                <div class=" col-12 title-section" style="text-align:left !important;">
                    <!-- <h1 ><?php echo get_the_title(); ?></h1> -->
                     <!-- <span><?php the_field('description'); ?></span> -->
                </div>
            </div>
        </div>
    </div>
</div>

<?php } ?>
    <div class="breadcrumb-detail mt-lg-5 mt-3 mb-3">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <?php
                     $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
    $delimiter = '&raquo;'; // delimiter between crumbs
    $home = 'Home'; // text for the 'Home' link
    $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
    $before = '<span class="current">'; // tag before the current crumb
    $after = '</span>'; // tag after the current crumb

    global $post;
    $homeLink = get_bloginfo('url');
    if (is_home() || is_front_page()) {
        if ($showOnHome == 1) {
            echo '<li class="breadcrumb-item"><a href="' . $homeLink . '">' . $home . '</a></li>';
        }
    } else {
        echo '<li class="breadcrumb-item"><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
        if (is_category()) {
            $thisCat = get_category(get_query_var('cat'), false);
            if ($thisCat->parent != 0) {
                echo get_category_parents($thisCat->parent, true, ' ' . $delimiter . ' ');
            }
            echo $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;
        } elseif (is_search()) {
            echo $before . 'Search results for "' . get_search_query() . '"' . $after;
        } elseif (is_day()) {
            echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
            echo '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
            echo $before . get_the_time('d') . $after;
        } elseif (is_month()) {
            echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
            echo $before . get_the_time('F') . $after;
        } elseif (is_year()) {
            echo $before . get_the_time('Y') . $after;
        } elseif (is_single() && !is_attachment()) {
            if (get_post_type() != 'post') {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                if ($post_type->labels->singular_name == 'Event') {
                    $name = 'Events & Experiences';
                    echo '<a href="/events-experiences">' . $name . '</a>';
                } else {
                    $name = $post_type->labels->menu_name;
                    echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $name . '</a>';
                }

                if ($showCurrent == 1) {
                    echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
                }
            } else {
                // echo 'aaa';
                $cat = get_the_category();
                $cat = $cat[0];
                $cats = get_category_parents($cat, true, ' ' . $delimiter . ' ');
                if ($showCurrent == 0) {
                    $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
                }
                echo $cats;
                if ($showCurrent == 1) {
                    echo $before . get_the_title() . $after;
                }
            }
        } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
            $post_type = get_post_type_object(get_post_type());
            echo $before . $post_type->labels->singular_name . $after;
        } elseif (is_attachment()) {
            $parent = get_post($post->post_parent);
            $cat = get_the_category($parent->ID);
            $cat = $cat[0];
            echo get_category_parents($cat, true, ' ' . $delimiter . ' ');
            echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
            if ($showCurrent == 1) {
                echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
            }
        } elseif (is_page() && !$post->post_parent) {
            if ($showCurrent == 1) {
                echo $before . get_the_title() . $after;
            }
        } elseif (is_page() && $post->post_parent) {
            $parent_id  = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
                $parent_id  = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            for ($i = 0; $i < count($breadcrumbs); $i++) {
                echo $breadcrumbs[$i];
                if ($i != count($breadcrumbs)-1) {
                    echo ' ' . $delimiter . ' ';
                }
            }
            if ($showCurrent == 1) {
                echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
            }
        } elseif (is_tag()) {
            echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
        } elseif (is_author()) {
            global $author;
            $userdata = get_userdata($author);
            echo $before . 'Articles posted by ' . $userdata->display_name . $after;
        } elseif (is_404()) {
            echo $before . 'Error 404' . $after;
        }
        if (get_query_var('paged')) {
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) {
                echo ' (';
            }
            echo __('Page') . ' ' . get_query_var('paged');
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) {
                echo ')';
            }
        }
        echo '</li>';
    }
                    ?>

                </ol>
            </nav>
        </div>
    </div>
<?php
    $site = get_field('site');
    $address = get_event_address(get_the_ID(), false);
    $location_terms = get_the_terms(get_the_ID(), 'mec_location');
    $location_url = null;

    // if ($site) {
        
    // } 
    if (isset($location_terms[0])) {
        $locationName = $location_terms[0]->name;
        $mec_thumbs = get_term_meta($location_terms[0]->term_id, 'thumbnail');
        if (isset($mec_thumbs[0])) {
            $hero = $mec_thumbs[0];
        }
        $mec_url = get_term_meta($location_terms[0]->term_id, 'url');
        if (isset($mec_url[0])) {
            $location_url = $mec_url[0];
        }
    }
    elseif($site){
        $siteAddress = get_field('address', $site->ID);
        $locationName = $site->post_title;
        $hero = get_field('hero_image', $site->ID)['url'];
    }
    // print_r($siteAddress);
    // print_r($address);

?>
<div class="buy-ticket-section">

    <div class="container -c-container">
        <div class="row wrap_ehead">
            <div class="col-12">
                <div class="title-text">
                       <?php the_title(); ?>
                    </div>
                    <div class="mec-event-date-single-event">
                        <?php 
                        if (get_field('custom_date')) {
                            echo get_field('custom_date');
                        } else {
                            $start_date = get_post_meta(get_the_ID(), 'mec_start_date',true);
                            $end_date = get_post_meta(get_the_ID(), 'mec_end_date',true);

                            $mec_start_date = new DateTime($start_date);
                            $mec_end_date = new DateTime($end_date);

                            ?>
                            <?php
                            $ex = wp_get_post_terms( get_the_ID(), 'mec_category', array( 'fields' => 'all' ));
                           // if( $ex != null && $ex[0]->slug == 'exhibit'){
                           //      echo 'Daily';
                           //  }
                           //  else{
                                //     echo date('M. d Y',$mec_start_date->format('U'));
                                //     if (date('M d Y',$mec_start_date->format('U')) != date('M d Y',$mec_end_date->format('U'))){
                                //         echo ' - ' . date('M. d Y',$mec_end_date->format('U')); }
                                // }
                                $single = new MEC_skin_single();
                                $single_event_main = $single->get_event_mec(get_the_ID());
                                $single_event_obj = $single_event_main[0];
                                $type = get_post_meta(get_the_ID())['mec_repeat_type'][0];
                                $i = 0;
                                if($type)
                                echo 'Recurring event occurs '.$type.'</br>';
                                echo 'Upcoming dates: ';
                                foreach ($single_event_obj->dates as $date) {
                                if ($date >= strtotime(current_time('Y-m-d'))) {
                                    if($i != 0)
                                    echo ', ';
                                        echo  date('M. d ', strtotime($date['start']['date']));
                                        if($i == 5)
                                            break;

                                    }
                                    $i ++;
                                }
                            }
                        //}
                          ?>
                    </div>
                    <?php if(get_field('description')){ ?><h2><?php echo get_field('description'); ?></h2><?php } ?>
            </div>
        </div>
            <div class="row wrap_ehead">

            <div class="col-lg-8">
                <?php if ($address) { ?>
                <div class="mapouter"><div class="gmap_canvas"><iframe width="100%" height="250" id="gmap_canvas" src="https://maps.google.com/maps?q=<?php echo $address; ?>&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                        </div></div>
               <?php } else {?>
                    <img src="<?php echo $hero; ?>" alt="<?php echo get_the_title(); ?>">
                <?php } ?>
           </div>
            <div class="col-lg-4 b-left d-flex flex-column justify-content-center">
        <div class="accordian-part">
      <div class="-container">
        <div class="accodian-box right-acc">
<div class="ac-box">
            <div class="accordian-title">
                <a href="javascript:void(0)">
                <span>Address</span>
                <img class="arrow" src="<?php echo get_stylesheet_directory_uri() ?>/images/g-right-arrow-magento.svg" alt="image" /></a>
            </div>
            <div class="accordian-content">
                <span><?php echo $locationName; ?></span>
                <span><?php echo $address; ?></span>
                <a href="http://maps.google.com/maps?q=<?php echo $address; ?>" target="_blank">Open in Google Map</a>
            </div>
        </div>
        <?php if ($location_url || get_field('800_number') || get_field('phone_1') || get_field('phone_2') || get_field('email_1') || get_field('email_2')) { ?>
        <div class="ac-box">
            <div class="accordian-title">
                <a href="javascript:void(0)">
                    <span>Contact</span>
                    <img class="arrow" src="<?php echo get_stylesheet_directory_uri() ?>/images/g-right-arrow-magento.svg" alt="image" /></a>
            </div>
            <div class="accordian-content">
                <?php if ($location_url) { ?><a href="<?php echo $location_url; ?>" target="_blank"><span><?php echo $location_url; ?></span></a><?php } ?>
                <?php if (get_field('800_number')) { ?><a href="tel:<?php the_field('800_number'); ?>"><span><?php the_field('800_number'); ?></span></a><?php } ?>

                <?php if (get_field('phone_1')) { ?><a href="tel:<?php the_field('phone_1'); ?>"><span><?php the_field('phone_1'); ?></span></a><?php } ?>
                <?php if (get_field('phone_2')) { ?><a href="tel:<?php the_field('phone_2'); ?>"><span><?php the_field('phone_2'); ?></span></a><?php } ?>
                <?php if (get_field('email_1')) { ?><a href="mailto:<?php the_field('email_1'); ?>"><span><?php the_field('email_1'); ?></span></a><?php } ?>
                <?php if (get_field('email_2')) { ?><a href="mailto:<?php the_field('email_2'); ?>"><span><?php the_field('email_2'); ?></span></a><?php } ?>
            </div>
        </div>
        <?php } ?>
        <?php if (get_field('event_hours')) { ?>
        <div class="ac-box">
            <div class="accordian-title">
                <a href="javascript:void(0)">
                    <span>Hours</span>
                    <img class="arrow" src="<?php echo get_stylesheet_directory_uri() ?>/images/g-right-arrow-magento.svg" alt="image" /></a>
            </div>
            <div class="accordian-content">
                <?php
                    echo '<span>'.get_field('event_hours').'</span>';
                ?>
            </div>
        </div>
        <?php } ?>
                <?php if (have_rows('admission_details')): ?>
          <div class="ac-box">
            <div class="accordian-title">
              <a href="javascript:void(0)">
                <span>Admission</span>
                <img class="arrow" src="<?php echo get_stylesheet_directory_uri() ?>/images/g-right-arrow-magento.svg" alt="image" /></a>
            </div>
            <div class="accordian-content">
                    <?php while (have_rows('admission_details')): the_row(); ?>
                        <span><?php echo get_sub_field('admission_type') . ' - ' . get_sub_field('admission_price'); ?></span>
                    <?php endwhile; ?>
            </div>
        </div>
                <?php endif; ?>

        </div>
        </div>
        </div>
        <?php if (get_field('registration_url')) {?>
            <a href="<?php echo get_field('registration_url'); ?>" target="_blank" class="buy-ticket">Register</a>
        <?php } ?>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="caption-content">
                        <!-- <div style="margin-bottom: 20px;"><?php  echo get_field('content'); ?></div> -->
                        <div style="margin-bottom: 20px;"><?php  the_content();  ?></div>

                    </div>
                </div>

            </div>
           <!--  <div class="row">
                <div class="col-12">
                    <?php //the_content();?>
                </div>
            </div> -->

           <?php $site = get_field('site');
           if (!empty($site)) { ?>
            <div class="row">
                <div class="col-12">
            <?php if (!get_field('exclude_additional_posts')) {?>
                <section class="exhibits-and-events-section">
            <?php
                
                $args = [
                    'post_type' => 'mec-events',
                    'posts_per_page' => 4,
                    'post__not_in' => [get_the_ID()],
                    'meta_key' => 'mec_start_date', 
                    'orderby' => 'meta_value',
                    'order' => 'DESC',
                    'meta_query' => [
                        'relation' => 'AND',
                        [
                            'key' => 'mec_start_date',
                            'value' => date('Y-m-d'),
                            'compare' => '>=',
                            'type' => 'DATE'
                        ]
                    ]

                ];
                if (!empty($site)) {
                    $args['meta_query'][] = [
                        
                        [
                            'key' => 'site',
                            'value' => $site->ID,
                            'compare' => '=',
                        ]
                    ];
                }

            $posts = new WP_Query($args);
            if($posts->have_posts()){


            ?>
                <div class="-container">
                    <div class="center-line pink">
                        <h4 style="color: #aa237a; ">Exhibits & Events</h4>
                    </div>
                    <div class="row">
                    <?php while ($posts->have_posts()) : $posts->the_post(); ?>
                        <div class="col-lg-3 col-md-4 col-12 d-flex">
                            <div class="box-exhibits">
                                <a href="<?php echo get_permalink(); ?>">
                                <?php
                                $url =  get_event_thumbnail(get_the_ID());
                                if ($url) {
                                    ?>
                                <span><img src="<?php echo $url; ?>" alt="image" /></span>
                            <?php
                                } ?>
                                <div class="blog-content-detail">
                                    <h5><?php echo get_the_title(); ?></h5>
                                    <?php if (get_field('description')) {
                                    echo '<p style="margin-bottom: 0 !important;">'.get_field('description').'</p>';
                                } ?>
                                </div>
                            </a>
                            </div>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata(); ?>
                    <div class="col-12">
                        <div class="see-more-btn">
                            <a href="<?php echo site_url(); ?>/events-experiences/" class="button-link">See More</a>
                        </div>
                    </div>
                    </div>
                </div>

            <?php } ?>
                </section>
                <?php } ?>


</div>
            </div>

<?php } ?>

        </div>
                <!--  newsletter part -->
        <?php

     if (!get_field('exclude_enews_signup')) {
         $response = '';
         if (isset($_POST['submit'])) {
             $response = add_user_to_mailchimp();
         } ?>
         <?php
            $bg_img_url = get_attachment_url_by_slug('Ohio-State-Flag-Blue_overlay'); ?>
        <div class="call-to-action newsletter cta-five mt-5 pt-5" style=" background-color: #f1f9ff;background-image: url(<?php echo $bg_img_url; ?>);background-repeat: no-repeat;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div><?php
                    if ($response != '') {
                        echo $response;
                    } ?></div>
                    <div class="section-content">
                        <h4>
                            <?php
                                if(get_field('newsletter_signup_headline')){
                                    the_field('newsletter_signup_headline');
                                } else {
                                    echo 'Sign-Up for our eNewsletter!';
                                }
                            ?>
                        </h4>
                    </div>
                    <div class="newsletter-form">
                        <?php echo do_shortcode('[gravityform id="5" title="false" description="false" ajax="true"]'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
     } ?>
     <!-- newslatter  end -->
    </div>

 <script>
    jQuery('.accordian-title').click(function() {
        jQuery(this).toggleClass('active');

        $accordion_content = jQuery(this).next('.accordian-content');
        jQuery('.accordian-content').not($accordion_content).slideUp();
        jQuery('.accordian-content').not($accordion_content).prev('.accordian-title').removeClass('active');
        $accordion_content.stop(true, true).slideToggle(400)

        // Remove this handle
        //$('.accordion-title i').toggleClass('rotate');
    });
    jQuery("document").ready(function() {
        setTimeout(function() {
            jQuery(".accodian-box .ac-box:first-child .accordian-title").trigger('click');
        },10);
    });
</script>

<?php get_footer(); ?>
