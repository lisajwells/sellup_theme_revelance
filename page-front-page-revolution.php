<?php

/*
Template Name: Front Page - Fullscreen Revolution Slider
*/

get_header();

$values = get_post_custom( $post->ID );
?>

	<section id="abdev_main_slider">
		<?php

		if ( wp_is_mobile() ) {

			/* Display and echo mobile specific stuff here */
			/* Our Parallax Slider is 1060x600 */
			?>

			<div id="mobile-hero"><img src="http://sellup.net/wp-content/uploads/2016/08/SellUp-Email-Marketing-Message-Match_mobl.jpg"></div>

		<?php
		}	else {

				if( isset( $values['revslider_alias'][0]) && $values['revslider_alias'][0] != '' ){
					if(function_exists('putRevSlider')){
						putRevSlider( $values['revslider_alias'][0] );
					}
				}
				else{
					_e('You did not select any slider in <i>Front Page Options</i> metabox.', 'ABdev_revelance');
				}


		}	?> <!-- end if is mobile -->

	</section>

	<?php get_template_part('partials/header_menu'); ?>

	<?php if ( have_posts()) : while (have_posts()) : the_post();
		the_content();
	endwhile;
	endif;
	?>

<?php get_footer();
