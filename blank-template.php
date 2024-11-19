<?php /* Template Name: Blank Template */ ?>
<html <?php language_attributes(); ?> class="no-js">

<?php require get_template_directory() . '/partials/head.php'; ?>

<body <?php body_class(); ?>>
	<div class="container">
		<?php the_content(); ?>
	</div>
</body>
<?php wp_footer(); ?>