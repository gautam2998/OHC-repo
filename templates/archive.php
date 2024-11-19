<?php

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>

			

			<?php
			// Start the Loop.
			while ( have_posts() ) :
				the_post();

					the_content();
				
			endwhile;

		endif;
		?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
