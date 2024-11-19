<html <?php language_attributes(); ?> class="no-js">

<?php require get_template_directory() . '/partials/head.php'; ?>

<body <?php body_class(); ?>>
<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package ohc
 */

get_header();

$searchPostTypes = [
    'page' => 'Pages',
    'post' => 'Posts',
    'mec-events' => 'Events',
    'historical_sites' => 'Historical Sites',
    'educational_activity' => 'Educational Activities',
    'media' => 'Media'
];

$currentPostType = $_GET['post_type'] ?? 'page';

?>
<div class="inner-background" style="background-image: url('<?php echo get_field('search_img', 'option'); ?>')">
        <div class="container">
            <div class="inner-bg-text ">
                <h2 style="color: #fff;">Search Results</h2>
                <span><?php echo get_field('search_subcontent', 'option'); ?></span>
            </div>

        </div>
    </div>
	<div class="container">
        <header class="page-header">
            <h3 class="page-title search_title">
                <?php
                /* translators: %s: search query. */
                printf(esc_html__('"%s" Results', 'ohc'), '<span>' . get_search_query() . '</span>');
                ?>
            </h3>
        </header>
        <div class="search_in mb-4">
                <?php get_search_form(); ?>
        </div>
        <div class="mb-4">
            <ul class="nav nav-pills">
                <li class="nav-item"><span class="nav-link disabled">Search In:</span></li>
            <?php foreach ($searchPostTypes as $postType => $typeName) { ?>
                    <li class="nav-item"><a href="/?s=<?php echo get_search_query(); ?>&post_type=<?php echo $postType; ?>" class="nav-link <?php echo ($currentPostType === $postType) ? 'active' : ''; ?>"><?php echo $typeName; ?></a></li>
            <?php } ?>
            </ul>
        </div>

		<?php if (have_posts()) : ?>
			<!-- blog post start -->
			<div class="blog-post-section py-2">
			    <!-- <div class="container"> -->
			        <div class="row">
			        	<div class="col-12">
			                <div class="pagination-number">
			                    <?php
                                    echo custom_pagination($wp_query->max_num_pages);
                                 ?>
			                </div>
			            </div>
			            <div  class="col-12">

						<?php
                        /* Start the Loop */
                        while (have_posts()) :
                            the_post();

                            /**
                             * Run the loop for the search to output the results.
                             * If you want to overload this in a child theme then include a file
                             * called content-search.php and that will be used instead.
                             */
                            get_template_part('template-parts/content', 'search');

                        endwhile;?>

			            </div>

						<div class="col-12 mt-4">
				            <div class="pagination-number">
			                    <?php
                                    echo custom_pagination($wp_query->max_num_pages);
                                 ?>
			                </div>
			            </div>
					</div>
	    		<!-- </div> -->
			</div>
			<!-- blog post end -->
		<?php

            else :

                get_template_part('template-parts/content', 'none');

            endif;
        ?>

	</div>

<?php
get_footer();
