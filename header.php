<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<?php
	global $revelance_options;
?>
<title><?php bloginfo('name'); wp_title(' - ',true); ?></title>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="description" content="<?php bloginfo('description'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" type="image/x-icon" href="<?php echo (isset($revelance_options['favicon']['url']) && $revelance_options['favicon']['url'] != '') ? $revelance_options['favicon']['url'] : TEMPPATH.'/images/favicon.png';?>" />
		
<!--[if lt IE 9]>
  <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<?php 
$classes='';

if(isset($revelance_options['enable_preloader']) && $revelance_options['enable_preloader']==1){
	$classes = 'preloader';
}

if ( is_singular() ){
	wp_enqueue_script( "comment-reply" );
}
wp_head();
?>
<!-- Google Code for Remarketing Tag -->
<!--------------------------------------------------
Remarketing tags may not be associated with personally identifiable information or placed on pages related to sensitive categories. See more information and instructions on how to setup the tag on: http://google.com/ads/remarketingsetup
--------------------------------------------------->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 952238124;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/952238124/?value=0&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
</head>

<body <?php body_class($classes); ?>>




