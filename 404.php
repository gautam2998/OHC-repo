<html <?php language_attributes(); ?> class="no-js">

<?php require get_template_directory() . '/partials/head.php'; ?>

<body <?php body_class(); ?>>
<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package ohc
 */

get_header();
?>

<main id="primary" class="site-main">
	<section class="error-page not-found">
        <div class="container c-container">
            <div class="error-details">
                <span><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/404.svg" class="img-fluid"></span>
                <h4>OOPS....</h4>
                <label>The page you are looking for doesn’t exist.</label>
                <p>Please check the URL for proper spelling. If you're having trouble locating your destination,
                    please click the link below to go Home or to the last page you visited.</p>
                <a href="<?php echo get_home_url(); ?>" class="error-btn">RETURN TO HOME</a>
            </div>
        </div>
    </section>
</main><!-- #main -->

<?php
get_footer();
