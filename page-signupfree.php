<?php
/*
Template Name: Signup For Free
*/
get_header();

get_template_part('partials/header_menu');

?>

<section class="page_main_section">
	<div class="container">

		<div class="row">

			<div class="span12 content content_with_right_sidebar">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post();?>
					<?php the_content();?>
					<?php endwhile; endif;?>

				<script>(function(t,e,n,o){var s,c,r;t.SMCX=t.SMCX||[],e.getElementById(o)||(s=e.getElementsByTagName(n),c=s[s.length-1],r=e.createElement(n),r.type="text/javascript",r.async=!0,r.id=o,r.src=["https:"===location.protocol?"https://":"http://","widget.surveymonkey.com/collect/website/js/AYtALSZ1uhDzICJG8nl6BPnosMcJoTkrmVygYurWkAI6tu5oMHzU8wX1Q80_2BznKt.js"].join(""),c.parentNode.insertBefore(r,c))})(window,document,"script","smcx-sdk");</script><a style="font: 12px Helvetica, sans-serif; color: #999; text-decoration: none;" href=https://www.surveymonkey.com/mp/customer-satisfaction-surveys/> Create your own user feedback survey </a>
			</div><!-- end span8 main-content -->



		</div><!-- end row -->

	</div>
</section>

<?php get_footer();