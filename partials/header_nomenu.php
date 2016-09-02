<?php
	global $revelance_options;
?>
<header id="abdev_main_header" class="clearfix">
	<div class="container">
		<div id="logo">
			<a href="<?php echo home_url(); ?>">
				<img id="main_logo" src="<?php echo (isset($revelance_options['header_logo']['url']) && $revelance_options['header_logo']['url'] != '') ? $revelance_options['header_logo']['url'] : TEMPPATH.'/images/logo.png';?>" alt="<?php bloginfo('name');?>">
			</a>
		</div>
		<div id="ABdev_menu_toggle"><i class="entypo-list2"></i></div>
	</div>
</header>
