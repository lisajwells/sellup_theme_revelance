<?php 
get_header();
$portfolio_data = get_post_custom();

get_template_part('partials/header_menu'); 

?>

<?php //check if portfolio plugin is activated
if(current_user_can( 'manage_options' ) && !in_array( 'abdev-portfolio/abdev-portfolio.php', get_option( 'active_plugins') )):?>
	<section class="page_main_section">
		<div class="container">
			<p>
				<strong><?php _e('This page requires Portfolio plugin to be activated','ABdev_revelance');?></strong>
			</p>
		</div>
	</section>
<?php endif; ?>

<section class="page_main_section">
	<div class="container">
		
		<?php if (have_posts()) : while (have_posts()) : the_post();?>
			<div class="row">
				<div class="span9 content_with_right_sidebar">
					<?php the_post_thumbnail('full', array('class' => 'portfolio_item_image')); ?>
				</div>
				<div id="portfolio_item_meta" class="span3">
					
											<p>
						<span class="portfolio_item_meta_label"><?php _e('CATEGORY', 'ABdev_revelance');?></span>
						<span class="portfolio_item_meta_data">
							<?php 
							$terms = get_the_terms( $post->ID , 'portfolio-category' );
							foreach ( $terms as $term ) {
								if(is_object($term)){
									echo $term->name . '<br>';
									$related_cat[] = $term->slug;
								}
							} ?>
						</span>
					</p>

					<?php if(isset($portfolio_data['ABp_portfolio_link'])):?>
						<p>
							<span class="portfolio_item_meta_label"><?php _e('LINK', 'ABdev_revelance');?></span>
							<span class="portfolio_item_meta_data"><a href="<?php echo (!preg_match("~^(?:f|ht)tps?://~i", $portfolio_data['ABp_portfolio_link'][0])) ? "http://" . $portfolio_data['ABp_portfolio_link'][0] : $portfolio_data['ABp_portfolio_link'][0];?>" target="<?php echo $portfolio_data['ABp_portfolio_link_target'][0];?>"><?php echo $portfolio_data['ABp_portfolio_link'][0];?></a></span>
						</p>
					<?php endif; ?>

				</div>
			</div>
			
			<?php the_content();?>
		<?php endwhile; endif;?>
	</div>
</section>


<?php if(isset($portfolio_data['ABp_portfolio_show_related'][0]) && $portfolio_data['ABp_portfolio_show_related'][0]==1): ?>
	<section id="related_portfolio">
		<h3 class="main_title"><span><?php _e('Related Projects', 'ABdev_revelance'); ?></span></h3>
		<div class="clearfix ab_latest_portfolio">

			<div class="row">
				<?php 
				$args = array(
					'post_type' => 'portfolio',
					'portfolio-category' => implode(',', $related_cat),
					'posts_per_page'=>4,
					'post__not_in'=>array($post->ID),
				);
				$related = new WP_Query( $args );
				$out = $error = '';
				if ($related->have_posts()){
					while ($related->have_posts()){
						$related->the_post();
						$slugs=$in_category='';		
						$terms = get_the_terms( $post->ID , 'portfolio-category' );
						foreach ( $terms as $term ) {
							if(is_object($term)){
								$slugs.=' '.$term->slug;
								$filter_slugs[$term->slug] = $term->name;
								$in_category[] = $term->name;
							}
						}

						$in_category = implode(', ', $in_category);

						$thumbnail_id = get_post_thumbnail_id(get_the_ID());
						$thumbnail_object = get_post($thumbnail_id);
						$thumbnail_src=$thumbnail_object->guid;

						$custom = get_post_custom(get_the_ID());
						$effect = (isset($custom["ABp_portfolio_effect"][0])) ? $custom["ABp_portfolio_effect"][0] : 'sadie'; 

						echo '<div class="portfolio_item portfolio_item_4' . $slugs . '">
							<figure class="effect-'.$effect.'">
								' . get_the_post_thumbnail() . '
								<figcaption>
									<h4>' . get_the_title() . '</h4>
									<p>'.$in_category.'</p>
									<a href="' . get_permalink() . '"></a>
								</figcaption>			
							</figure>
						</div>
						';


						// $thumbnail_id = get_post_thumbnail_id($post->ID);
						// $thumbnail_object = get_post($thumbnail_id);
						// $thumbnail_src=$thumbnail_object->guid;

						// echo '<div class="portfolio_item portfolio_item_4' . $slugs . '">
						// 	<div class="overlayed">
						// 		' . get_the_post_thumbnail() . '
						// 		<div class="overlay">
						// 			<div class="overlay_content">
						// 				<h4><a href="' . get_permalink() . '">' . get_the_title() . '</a></h4>
						// 				<p class="portfolio_item_tags">
						// 					'.$in_category.'
						// 				</p>
						// 			</div>
						// 		</div>
						// 	</div>
						// </div>';
					}
				}
				wp_reset_postdata();
				?>
		</div>
	</div>
	</section>
<?php endif; ?>



<section id="portfolio_pagination" class="clearfix">
	<div class="container">
		<!--
<div id="single_post_pagination">
			<span class="prev"><?php previous_post_link('%link','&laquo; %title'); ?></span>
			<span class="next"><?php next_post_link('%link','%title &raquo;'); ?></span>
		</div>
-->
	</div>
</section>


<?php get_footer();