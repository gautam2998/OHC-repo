<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package OHC
 */
?>

<html <?php language_attributes(); ?> class="no-js">

<?php require get_template_directory() . '/partials/head.php'; ?>

<body <?php body_class(); ?>>


<?php get_header(); ?>
<?php if (!empty(get_field('hero_image'))) { ?>
<div class="blog-slider-section" style="background-image: url(<?php echo get_field('hero_image')['url']; ?>);">
    <div class="container">
        <div class="blog-slider-content">
            <div class="row align-items-center">
                <div class="col-md-5 col-12" style="text-align:left;">
                    <h1><?php echo get_the_title(); ?></h1>
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
                                    echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
                                    if ($showCurrent == 1) {
                                        echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
                                    }
                                } else {
                                    $cat = get_the_category();
                                    $cat = isset($cat[0]) ? $cat[0] : null;
                                    $cats = get_category_parents($cat, true, ' ' . $delimiter . ' ');
                                    if (!is_wp_error($cats)) {
                                        if ($showCurrent == 0) {
                                            $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
                                        }
                                        echo $cats;
                                        if ($showCurrent == 1) {
                                            echo $before . get_the_title() . $after;
                                        }
                                    }
                                }
                            } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
                                $post_type = get_post_type_object(get_post_type());
                                echo $before . $post_type->labels->singular_name . $after;
                            } elseif (is_attachment()) {
                                $parent = get_post($post->post_parent);
                                $cat = get_the_category($parent->ID);
                                $cat = isset($cat[0]) ? $cat[0] : null;
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
// while ( have_posts() ) :
    // the_post();
    ?>
<div class="buy-ticket-section">
    <div class="container -c-container">
        <div class="row">
            <div class="col-lg-8">
                <div class="title-text">
                   <?php the_title(); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="caption-content border-b-content text-justify content-wrap">
                    <div style="margin-bottom: 20px;"><?php  echo get_field('content'); ?></div>
                    <span>Posted<?php echo ' '.get_the_date(); ?></span>
                </div>
            </div>
            <div class="col-12">
                <div class="caption-content d-flex flex-column" style="margin-top: 30px;gap:10px;">
                    <?php $topics = get_field('topics'); ?>
                    <?php
                        if ($topics) { ?>
                        <div class="topic_single">
                            <span class="topic_span" style="text-decoration:none">Topics: </span>
                            <b><?php
                            foreach ($topics as $key => $value) {
                                echo '<span>'.$value.'</span>';
                            }
                            echo '</b>'; ?>
                        </div>
                    <?php } ?>
                    <?php
                        $tags_list = get_the_tag_list('<b><span>', '</span><span>', '</span></b>');
                        if ($tags_list) { ?>
                        <div class="topic_single">
                            <span class="topic_span" style="text-decoration:none">Tagged with: </span>
                            <?php
                            if ($tags_list) {
                                /* translators: 1: list of tags. */
                                printf(esc_html__('%1$s', 'allied-mf'), $tags_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                            }
                            ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 content-wrap">
                <?php the_content(); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <?php if (!get_field('exclude_additional_posts')) {?>
                    <section class="exhibits-and-events-section">
                        <?php
                            $args = array(
                                'post_type' => 'post',
                                'posts_per_page' => 4,
                            );

                        $posts = new WP_Query($args);
                        ?>
                        <div class="container">
                            <div class="center-line pink">
                                <h4 style="color: #aa237a; ">Read More Blogs & Posts</h4>
                            </div>
                            <div class="row">
                                <?php while ($posts->have_posts()) : $posts->the_post(); ?>
                                    <div class="col-lg-3 col-md-4 col-12 d-flex">
                                        <div class="box-exhibits">
                                            <?php
                         $url = get_the_permalink();
                        $target = '';
                        if (get_field('external_redirect')) {
                            $url = get_field('external_redirect');
                            $target = '_blank';
                        }
                        $thumbnail = get_blog_thumbnail(get_the_ID()); ?>
                                           <a href="<?php echo $url; ?>" target="<?php echo $target; ?>">
                               <?php if ($thumbnail) { ?>
                                                        <span><img src="<?php echo $thumbnail; ?>" alt="blog-image"
                                            /></span><?php } ?>
                                                <div class="blog-content-detail content-wrap">
                                                    <h5><?php echo get_the_title(); ?></h5>
                                                    <?php if (get_field('description')) {
                            echo '<p style="margin-bottom:0px !important">'.get_field('description').'</p>';
                        } ?>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                <?php endwhile;
                                wp_reset_postdata(); ?>
                                <div class="col-12">
                                    <div class="see-more-btn">
                                        <a href="/blog" class="button-link">See More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                <?php } ?>


            </div>
        </div>
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
        <div class="call-to-action newsletter cta-five mt-5 pt-5 " style=" background-color: #f1f9ff;background-image: url(<?php echo $bg_img_url; ?>);background-repeat: no-repeat;">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div><?php
                        if ($response != '') {
                            echo $response;
                        } ?></div>
                        <div class="section-content">
                            <h4>Subscribe to Our Blogs</h4>
                        </div>
                        <div class="newsletter-form">
                            <?php echo do_shortcode('[gravityform id="47" title="false" description="false" ajax="true"]'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    } ?>
    <!-- newslatter  end -->
</div>
<?php
 //  endwhile; // End of the loop.
?>

<script>
window.dataLayer = window.dataLayer || [];
window.dataLayer.push({
 'blogCategory': '<?php echo get_the_category()[0]->name; ?>'
 });
</script>

 <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-1619316-2', 'auto');

    var dimensionValue = '<?php echo get_the_category()[0]->name; ?>';
    ga('set', 'dimension1', dimensionValue);

    ga('send', 'pageview');

    jQuery(function() {

        jQuery(".accordion-content:not(:first-of-type)").css("display", "none");
        jQuery(".js-accordion-title:first-of-type").addClass("open");

        jQuery(".js-accordion-title").click(function() {
            jQuery(".open").not(this).removeClass("open").next().slideUp(300);
            jQuery(this).toggleClass("open").next().slideToggle(300);
        });
    });
    jQuery(".accordian-title a").click(function() {
        jQuery(".accordian-content").slideUp();
        jQuery(".accordian-title a").removeClass("active");
        jQuery(this).toggleClass("active arrow icon-change");
        jQuery(this)
            .closest(".ac-box")
            .find(".accordian-content")
            .stop()
            .slideToggle();
    });
</script>

<?php get_footer(); ?>
