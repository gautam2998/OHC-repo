<?php

function no_function_admin_bar()
{
    return false;
}
//add_filter('show_admin_bar', 'no_function_admin_bar');
add_theme_support('post-thumbnails');
add_theme_support('title-tag');

/* Mix */
require get_template_directory() . '/includes/mix.php';

/* Theme Setup */
require get_template_directory() . '/includes/setup.php';

/* Widget Setup */
require get_template_directory().'/includes/widgets.php';

/* Nav */
require get_template_directory() . '/includes/nav/clean_nav_walker.php';
require get_template_directory() . '/includes/nav/simple_menu.php';

/* Customizer */
require get_template_directory() . '/includes/styles.php';

/* Image Utils */
require get_template_directory() . '/includes/utils/image-utils.php';

/* Content Utils */
require get_template_directory() . '/includes/utils/content-utils.php';

/* List Utils */
require get_template_directory() . '/includes/utils/list-utils.php';

/* Laravel Mix */
// require get_template_directory() . '/includes/utils/mix.php';

/* Gravity Forms + ACF */
require get_template_directory() . '/includes/utils/gravity-utils.php';

/* Custom Post Types */
require get_template_directory().'/includes/wp/custom-post-types.php';


function exclude_images_from_search_results()
{
    global $wp_post_types;
    $wp_post_types['attachment']->exclude_from_search = true;
}
add_action('init', 'exclude_images_from_search_results');

function custom_search_form($form)
{
    $postType = !isset($_GET['post_type']) ? 'page' : $_GET['post_type'];
    $form='<form role="search" action="' . home_url('/') . '" class="position-relative serch-blcok" method="get">
              <input id="s" class="email-serch" name="s" type="text" aria-label="Search..." placeholder="Search" value="' . get_search_query() . '" />
              <input type="hidden" name="post_type" value="' . $postType . '" />
              <button id="site-form-submit" type="submit">
                <img src="' .esc_url(get_stylesheet_directory_uri()).'/images/search1.svg" height="15px" />
              </button>
            </form>';

    return $form;
}

add_filter('get_search_form', 'custom_search_form', 100);

function theme_support_options()
{
    $defaults = array(
        'height'               => 100,
        'width'                => 400,
        'flex-height'          => true,
        'flex-width'           => true,
        'header-text'          => array( 'site-title', 'site-description' ),
        'unlink-homepage-logo' => true,
    );

    add_theme_support('custom-logo', $defaults);
}

add_action('after_setup_theme', 'theme_support_options');


if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
    'page_title'  => 'Theme General Settings',
    'menu_title'  => 'Theme Settings',
    'menu_slug'   => 'theme-general-settings',
    'capability'  => 'edit_posts',
    'redirect'    => false
  ));
}

function add_file_types_to_uploads($file_types)
{
    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg';
    $file_types = array_merge($file_types, $new_filetypes);

    return $file_types;
}
add_action('upload_mimes', 'add_file_types_to_uploads');

function event_list_func($atts)
{
    // return "foo and bar";
    ob_start();

    $args = array(
    'post_type' => 'mec-events',
    'posts_per_page' => 5
    // Several more arguments could go here. Last one without a comma.
);

    // Query the posts:
$obituary_query = new WP_Query($args); ?>
<div class="event-slider-section pb-5">
        <div class="container">
            <div class="owl-carousel owl-theme event-slider">
<?php // Loop through the obituaries:
$count = 1;
    while ($obituary_query->have_posts()) : $obituary_query->the_post();
    // print_r(get_post_meta(get_the_ID()));
    $post_data = get_post_meta(get_the_ID());
    $start_date = $post_data['mec_start_date'][0];
    $start_date = date("F m, Y", strtotime($start_date));
    $start_time = $post_data['mec_start_time_hour'][0].':'.$post_data['mec_start_time_minutes'][0].' '.$post_data['mec_start_time_ampm'][0];
    $end_time = $post_data['mec_end_time_hour'][0].':'.$post_data['mec_end_time_minutes'][0].' '.$post_data['mec_end_time_ampm'][0];
    // echo 'start'.$count%4;
    if ($count == 1) {
        echo "<div class='item'><div class='event-slider-detail'>
                          <div class='row'>";
    } ?>



                              <div class="col-md-6 col-12 mt-5">
                                  <a href="#" class="event-box-content">
                                      <div class="event-left-image">
                                          <span><img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="image"
                        /></span>
                                      </div>
                                      <div class="event-right-content">
                                          <small><?php echo $start_date; ?> | <?php echo $end_time; ?> - <?php echo $start_time; ?></small>
                                          <h4><?php the_title(); ?></h4>
                                          <span><?php echo $post_data['mec_repeat_type'][0]; ?></span>
                                          <p>
                                             <?php the_content(); ?>
                                          </p>
                                      </div>
                                  </a>
                              </div>
 <?php
// echo 'end'.$count%4;
  if ($count%4 == 0) {
      echo "</div></div>
                  </div><div class='item'><div class='event-slider-detail'>
                          <div class='row'>";
  }
    $count++;
    endwhile;
    if ($count%4 != 1) {
        echo "</div>";
    }
    // endwhile;?>
 </div></div></div>
    <?php
    $output = ob_get_contents();
    ob_end_clean();
    wp_reset_postdata();

    return $output;
}
add_shortcode('event_slider', 'event_list_func');
// add_shortcode( 'blog_listing', 'blog_list_func' );

// function blog_list_func( $atts ){
//   // return "foo and bar";
//     ob_start();


//     global $wp_query;
//     $page  = max( 1, get_query_var( 'paged' ) );
//     $ppp   = get_query_var('posts_per_page');
//     $start = $ppp * ( $page - 1 ) + 1;
//     $end   = $start + $wp_query->post_count - 1;
//     echo "$start - $end of $page Blog Posts";


//     $output = ob_get_contents();
//     ob_end_clean();
//     return $output;

// }
// function my_enqueue() {
//       wp_enqueue_script( 'ajax-script', get_template_directory_uri() . '/js/custom.js', array('jquery') );
//       wp_localize_script( 'ajax-script', 'my_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
//  }
//  add_action( 'wp_enqueue_scripts', 'my_enqueue' );


//  add_action( 'wp_ajax_nopriv_advanced_search', 'advanced_search' );
// add_action( 'wp_ajax_advanced_search', 'advanced_search' );

//  function advanced_search(){
//   ob_clean();
// $post_data = $_POST;
// $resourcesQuery = array(
//     'post_type' => array('mec-events'),
//     'posts_per_page' => 4,
//     'paged'    => 1,
//     // Several more arguments could go here. Last one without a comma.
// );


//     $resourcesQuery['s'] = $_GET['keyword'];



// $result = new WP_Query($resourcesQuery);

//   wp_die();
//  }

function my_acf_init()
{
    acf_update_setting('google_api_key', 'AIzaSyDSelKRHQ3sNLVaT4TSVHOwyfBuzdVNi88');
}

add_action('acf/init', 'my_acf_init');


function get_attachment_url_by_slug($slug)
{
    $args = array(
        'post_type' => 'attachment',
        'name' => sanitize_title($slug),
        'posts_per_page' => 1,
        'post_status' => 'inherit',
    );
    $_header = get_posts($args);
    $header = $_header ? array_pop($_header) : null;
    return $header ? wp_get_attachment_url($header->ID) : '';
}



function custom_pagination($pages = '', $range = 5)
{
    $showitems = ($range * 2)+1;

    global $paged;
    if (empty($paged)) {
        $paged = 1;
    }

    if ($pages == '') {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if (!$pages) {
            $pages = 1;
        }
    }

    if (1 != $pages) {
        echo "<nav aria-label=\"pagination\">";
        echo "<ul class=\"pagination\">";

        // if ($paged >= 1 && $showitems <= $pages) {
        //     echo "<li class=\"page-item\"><a class=\"prev page_numbers page-link\" href='".get_pagenum_link(1)."'> First</a></li>";
        // }
        if ($paged > 1) {
            echo "<li class=\"page-item\"><a class=\"page-link\" href=\"".get_pagenum_link($paged - 1)."\"><img class=\"left-p-arrow\" src=\"".get_stylesheet_directory_uri()."/images/left-paginantion-arrow.svg\" alt=\"arrow\" />Back</a></li>";
        } else {
            echo "<li class=\"page-item disabled\"><span class=\"page-link\"> <img class=\"left-p-arrow\" src=\"".get_stylesheet_directory_uri()."/images/left-paginantion-arrow.svg\" alt=\"arrow\" />Back</span></li>";
        }
        for ($i=1; $i <= $pages; $i++) {
            if (1 != $pages &&(!($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems)) {
                echo ($paged == $i)? "<li class=\"page-item active\" aria-current=\"page\"><span class=\"current page-link\">".$i."<span class=\"sr-only\">(current)</span></span></li>":"<li class=\"page-item\"><a class=\"page-link\" href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a></li>";
            }
        }

        if ($paged < $pages) {
            echo "<li class=\"page-item\"><a class=\"page-link\" href=\"".get_pagenum_link($pages)."\">Next<img src=\"".get_stylesheet_directory_uri()."/images/right-paginantion-arrow.svg\" class=\"right-p-arrow\" alt=\"arrow\"/> </a></li>";
        } else {
            echo "<li class=\"page-item disabled\"><span class=\"page-link\">Next<img src=\"".get_stylesheet_directory_uri()."/images/right-paginantion-arrow.svg\" class=\"right-p-arrow\" alt=\"arrow\"/> </span></li>";
        }
        // if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) {
        //     echo "<li class=\"page-item\"><a class=\"next page_numbers page-link\" href='".get_pagenum_link($pages)."'>Last</a></li>";
        // }
        echo "</ul>";
        echo "</nav>\n";
    }
}

function searchfilter($query)
{
    if ($query->is_search() && $query->is_main_query() && !is_admin() && !isset($_GET['search-educational-activities'])) {
        if (!empty($_GET['post_type'])) {
            $query->set('post_type', $_GET['post_type']);
        } else {
            $query->set('post_type', 'page');
        }
    }

    return $query;
}
add_filter('pre_get_posts', 'searchfilter', 10);

// add_filter( 'posts_orderby', 'order_search_by_posttype', 10, 2 );
// function order_search_by_posttype( $orderby, $wp_query ){
//     if( ! $wp_query->is_admin && $wp_query->is_search ) :
//         global $wpdb;
//         $orderby =
//             "
//             CASE WHEN {$wpdb->prefix}posts.post_type = 'page' THEN '1'
//                  WHEN {$wpdb->prefix}posts.post_type = 'historical_sites' THEN '2'
//                   WHEN {$wpdb->prefix}posts.post_type = 'mec-events' THEN '3'
//                    WHEN {$wpdb->prefix}posts.post_type = 'educational_activity' THEN '4'
//                    WHEN {$wpdb->prefix}posts.post_type = 'post' THEN '5'

//             ELSE {$wpdb->prefix}posts.post_type END ASC,
//             {$wpdb->prefix}posts.post_title ASC";
//     endif;
//     return $orderby;
// }

// Group SearchWP results by Source, sort by relevance within each Source group.
    add_filter('searchwp\query\mods', function ($mods, $query) {
        $mod = new \SearchWP\Mod();
        $mod->order_by(function ($mod) {
            // Search results should be grouped by Sources in this order.
            // NOTE: _ALL_ Engine Sources must be included here!
            $source_order = [
                'user',
                \SearchWP\Utils::get_post_type_source_name('page'),
                \SearchWP\Utils::get_post_type_source_name('historical_sites'),
                 \SearchWP\Utils::get_post_type_source_name('mec-events'),
                \SearchWP\Utils::get_post_type_source_name('educational_activity'),
                 \SearchWP\Utils::get_post_type_source_name('post'),

            ];

            return "FIELD({$mod->get_foreign_alias()}.source, "
                . implode(',', array_filter(array_map(function ($source_name) {
                    global $wpdb;

                    return $wpdb->prepare('%s', $source_name);
                }, $source_order))) . ')';
        }, '', 1);

        $mods[] = $mod;

        return $mods;
    }, 10, 2);


    // Allow SVG
add_filter('wp_check_filetype_and_ext', function ($data, $file, $filename, $mimes) {
    global $wp_version;
    if ($wp_version !== '4.7.1') {
        return $data;
    }

    $filetype = wp_check_filetype($filename, $mimes);

    return [
      'ext'             => $filetype['ext'],
      'type'            => $filetype['type'],
      'proper_filename' => $data['proper_filename']
  ];
}, 10, 4);

function cc_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

function fix_svg()
{
    echo '<style type="text/css">
        .attachment-266x266, .thumbnail img {
             width: 100% !important;
             height: auto !important;
        }
        </style>';
}
add_action('admin_head', 'fix_svg');
// Default image
function ns_post_thumbnail_fb( $html, $post_id, $post_thumbnail_id, $size, $attr ) {
 if ( empty( $html ) ) {
    return sprintf(
        '<img src="%s" height="%s" width="%s" />',
        get_stylesheet_directory_uri().'/images/default-img.png',
        // home_url().'/wp-content/uploads/2021/02/hub-logo-dummy.png',
        get_option( 'thumbnail_size_w' ),
        get_option( 'thumbnail_size_h' )
    );
}

return $html;
}
add_filter( 'post_thumbnail_html', 'ns_post_thumbnail_fb', 20, 5 );


function ohc_so_widget_active($active){
    $active['contact-form-custom-fields'] = true;
    return $active;
}
add_filter('siteorigin_widgets_active_widgets', 'ohc_so_widget_active');