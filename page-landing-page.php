<?php
/*
Template Name: Landing Page
*/

get_header();

get_template_part('partials/header_nomenu');

?>
	<section class="page_main_section">

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post();?>
				<?php the_content();?>
			<?php endwhile; endif;?>

	</section>

<?php get_footer();
