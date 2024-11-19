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
<?php
    while (have_posts()) :
    the_post();
?>

    <!-- inner banner start -->
    <section class="inner-banner" style="background-image: url('<?php echo get_field("hero_image")["url"]; ?>');">
        <div class="container">
            <div class="title-section">
                <h1><?php the_title(); ?></h1>
                <span><?php the_field('description'); ?></span>
            </div>
        </div>
    </section>
    <!-- inner banner end -->

    <!-- breadcrumbs start -->

    <div class="breadcrumb-detail mt-lg-5 mt-4">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo home_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo get_permalink(get_page_by_path('visit')); ?>">Visit</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo get_permalink(get_page_by_path('visit/browse-historic-sites')); ?>">Browse Historic Sites</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <?php the_title(); ?>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- breadcrumbs end -->

    <section class="site-detail-section" style="padding-bottom: 0;">
        <div class="container">
            <div class="site-detail">
                <h2><?php the_title(); ?></h2>
            </div>
        </div>
    </section>

    <!-- accordian start -->

    <div class="accordian-part">
        <div class="container">
            <div class="accodian-box">
                <div class="ac-box">
                    <div class="accordian-title">
                        <a href="javascript:void(0)">
                            <span>Address</span>
                            <img class="arrow" src="<?php echo get_stylesheet_directory_uri() ?>/images/g-right-arrow-magento.svg" alt="image" />
                        </a>
                    </div>
                    <div class="accordian-content">
                        <?php
                            // Get your field
                            $address = get_field('address');
                            // Get the Address String
                            echo '<span>'.$address['address'].'</span>';
                        ?>
                    </div>
                </div>
                <div class="ac-box">
                    <div class="accordian-title">
                        <a href="javascript:void(0)">
                            <span>Contact</span>
                            <img class="arrow" src="<?php echo get_stylesheet_directory_uri() ?>/images/g-right-arrow-magento.svg" alt="image" />
                        </a>
                    </div>
                    <div class="accordian-content">
                        <?php if (get_field('phone_1')) { ?><a href="tel:<?php the_field('phone_1'); ?>"><span><?php the_field('phone_1'); ?></span></a><?php } ?>
                        <?php if (get_field('phone_2')) { ?><a href="tel:<?php the_field('phone_2'); ?>"><span><?php the_field('phone_2'); ?></span></a><?php } ?>
                        <?php if (get_field('email_address_line_1')) { ?><a href="mailto:<?php the_field('email_address_line_1'); ?>"><span><?php the_field('email_address_line_1'); ?></span></a><?php } ?>
                        <?php if (get_field('email_address_line_2')) { ?><a href="mailto:<?php the_field('email_address_line_2'); ?>"><span><?php the_field('email_address_line_2'); ?></span></a><?php } ?>
                    </div>
                </div>
                <div class="ac-box">
                    <div class="accordian-title">
                        <a href="javascript:void(0)">
                            <span>Hours</span>
                            <img class="arrow" src="<?php echo get_stylesheet_directory_uri() ?>/images/g-right-arrow-magento.svg" alt="image" />
                        </a>
                    </div>
                    <div class="accordian-content">
                        <?php
                            echo '<span>'.get_field('open_hours').'</span>';
                        ?>
                    </div>
                </div>
                <div class="ac-box">
                    <div class="accordian-title">
                        <a href="javascript:void(0)">
                            <span>Admission</span>
                            <img class="arrow" src="<?php echo get_stylesheet_directory_uri() ?>/images/g-right-arrow-magento.svg" alt="image" />
                        </a>
                    </div>
                    <div class="accordian-content">
                        <?php if (have_rows('admission_details')): ?>
                            <?php while (have_rows('admission_details')): the_row(); ?>
                                <span><?php echo get_sub_field('admission_type') . ' - ' . get_sub_field('admission_price'); ?></span>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="ac-box">
                    <div class="accordian-title">
                        <a href="javascript:void(0)">
                            <span>What’s Nearby</span>
                            <img class="arrow" src="<?php echo get_stylesheet_directory_uri() ?>/images/g-right-arrow-magento.svg" alt="image" /></a>
                    </div>
                    <div class="accordian-content">
                        <?php
                            $nearby_sites = get_field('nearby_sites');
                            if ($nearby_sites):
                                foreach ($nearby_sites as $post):
                                    setup_postdata($post); ?>
                                        <a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a>
                                <?php endforeach;
                                wp_reset_postdata(); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- accordian end -->

    <?php if(get_field('weblink') || get_field('instagram_link') || get_field('twitter_link') || get_field('facebook_link')){ ?>
    <!-- social link start -->
    <section class="social-link-section pt-3">
        <div class="container">
            <div class="social-links">
                <?php if(get_field('weblink')){ ?>
                <a href="<?php the_field('weblink'); ?>" target="_blank" class="social-network-link">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/noun-web-1298230.svg" />
                </a>
                <?php } if(get_field('instagram_link')){ ?>
                <a href="<?php the_field('instagram_link'); ?>" target="_blank" class="social-network-link">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/instagram.svg" />
                </a>
                <?php } if(get_field('twitter_link')){ ?>
                <a href="<?php the_field('twitter_link'); ?>" target="_blank" class="social-network-link">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/twitter.svg" />
                </a>
                <?php } if(get_field('facebook_link')){ ?>
                <a href="<?php the_field('facebook_link'); ?>" target="_blank" class="social-network-link">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/facebook-f.svg" />
                </a>
                <?php } ?>
            </div>
        </div>
    </section>
    <!-- social link end -->
    <?php } ?>

    <!-- site detail start -->
<?php
    endwhile; // End of the loop.
?>
    <section class="site-detail-section">
        <div class="container">
            <div class="site-detail">
                <?php the_field('historical_main_content'); ?>
            </div>

            <div class="site-visit-detail">
                <ul>
                    <?php if (get_field('audiences')) { ?>
                    <li><strong>Audiences:</strong>
                        <?php
                        $value = get_field('audiences');
                        $last_value = '';
                        if (count($value) > 1) {
                            $last_value = ' & '.array_pop($value);
                        }
                        echo implode(', ', $value),$last_value; ?>
                    </li>
                    <?php } ?>

                    <?php if (get_field('historical_topics')) { ?>
                    <li><strong>Historical Topics:</strong>
                        <?php
                        $value = get_field('historical_topics');
                        $last_value = '';
                        if (count($value) > 1) {
                            $last_value = ' & '.array_pop($value);
                        }
                        echo implode(', ', $value),$last_value; ?>
                    </li>
                    <?php } ?>

                    <?php if (get_field('regions')) { ?>
                    <li><strong>Regions:</strong>
                        <?php
                        $value = get_field('regions');
                        $last_value = '';
                        if (count($value) > 1) {
                            $last_value = ' & '.array_pop($value);
                        }
                        echo implode(', ', $value),$last_value; ?>
                    </li>
                    <?php } ?>

                    <?php if (get_field('site_activity')) { ?>
                    <li><strong>Site Activities:</strong>
                        <?php
                        $value = get_field('site_activity');
                        $last_value = '';
                        if (count($value) > 1) {
                            $last_value = ' & '.array_pop($value);
                        }
                        echo implode(', ', $value),$last_value; ?>
                    </li>
                    <?php } ?>

                    <?php if (get_field('site_type')) { ?>
                    <li><strong>Museum & Site Type:</strong>
                        <?php
                        $value = get_field('site_type');
                        $last_value = '';
                        if (count($value) > 1) {
                            $last_value = ' & '.array_pop($value);
                        }
                        echo implode(', ', $value),$last_value; ?>
                    </li>
                    <?php } ?>

                </ul>
            </div>
        </div>
    </section>

    <!-- site detail end -->

    <!-- exhibits and events section start -->
    <?php the_content(); ?>

    <!-- exhibits and events section end -->
    <script>
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
            jQuery(this).toggleClass("active arrow");
            jQuery(this)
                .closest(".ac-box")
                .find(".accordian-content")
                .stop()
                .slideToggle();
        });
    </script>

<?php get_footer(); ?>
