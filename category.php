<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ohc
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">

<?php require get_template_directory() . '/partials/head.php'; ?>

<body <?php body_class(); ?>>


<?php get_header(); ?>

	<div class="container">
		<header class="page-header">
			<?php
			the_archive_title( '<h1 class="page-title">', '</h1>' );
			the_archive_description( '<div class="archive-description">', '</div>' );
			?>
		</header><!-- .page-header -->

		<?php if ( have_posts() ) : ?>	
			<!-- blog post start -->
				<div class="blog-post-section py-5">
				    <div class="container">
				        <div class="row">
				        	<div class="col-12">
				                <div class="pagination-number">
				                    <?php
				                    	echo custom_pagination($wp_query->max_num_pages);
				                     ?>
				                </div>
				            </div>		

							<?php
							/* Start the Loop */
							while ( have_posts() ) :
								the_post();

								/*
								 * Include the Post-Type-specific template for the content.
								 * If you want to override this in a child theme, then include a file
								 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
								 */
								get_template_part( 'template-parts/content', get_post_type() );

							endwhile;

							?>
			            
							<div class="col-12 mt-4">
				                <div class="pagination-number">
				                    <?php
				                    	echo custom_pagination($wp_query->max_num_pages);
				                     ?>
				                </div>
				            </div>
						</div>
		    		</div>
				</div>
			<!-- blog post end -->
			<?php

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</div>
<script type="text/javascript">
	 var dimensionValue = <?php echo get_the_category()[0]->name; ?>
        ga('set', 'dimension1', <?php echo get_the_category()[0]->name; ?>);
</script>
<?php get_footer(); ?>

</body>
</html>
