<?php /* Template Name: Blog Template */ ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">

<?php require get_template_directory() . '/partials/head.php'; ?>

<body <?php body_class(); ?>>


<?php get_header(); ?>

<!-- Page Content -->
<div class="blog-wrapper ">

  <?php
  // Start the loop.
  while ( have_posts() ) : the_post();
    // Include the page content template.
    the_content();
    // End of the loop.
  endwhile;
  ?>
</div>


<?php get_footer(); ?>

</body>
</html>