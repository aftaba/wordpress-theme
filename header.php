<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and navigation menu
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Venet
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
	  	<script type="text/javascript">
	  		document.documentElement.className = document.documentElement.className.replace('no-js ','no-js').replace('no-js','');
	  	</script>
  	  	<title><?php wp_title(''); ?></title>
  		<meta charset="utf-8">
  		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
  		<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
  		<link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96">
		  <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">

		<!-- Must live here to provide html5 shiv in IE8 -->
		<!--  <script src="HTMLResources/js/modernizr-2.8.3.js"></script> -->

		<!--[if lt IE 9]>    	
		<script src="HTMLResources/js/respond.min.js"></script>
		<![endif]-->
		<?php wp_head(); ?>
  	</head>

  	<body <?php body_class(); ?>>
		<div id="wrapper">

			<nav class="navbar navbar-default navbar-fixed-top js-main-nav">
				<div class="container">
					<div class="navbar-header">

						<div class="pull-left pull-center">
							<div class="logo">
								<a href="<?php echo site_url(); ?>" class="logo" title="Venet Foundation">
						  			<?php echo get_bloginfo( 'name' ); ?>
					      		</a>
				  			</div>
						</div>

						<div class="pull-right">
							<?php $curr_lang = qtranxf_getLanguage(); ?>
				  			<div class="language">
								<select id="language-switcher" name="language-switcher">
							  		<option <?php selected( $curr_lang, "en" ); ?> value="en"><?php esc_html_e( 'English', 'venet' ); ?></option>
							  		<option <?php selected( $curr_lang, "fr" ); ?> value="fr"><?php esc_html_e( 'French', 'venet' ); ?></option>
								</select>
								<i class="fa fa-chevron-down"></i>
							</div>
				  	
				  			<div class="links">
				  				<div class="menu">
								  	<i class="fa fa-bars"></i>
								</div>
				  				<?php 
				  					wp_nav_menu( 
				  						array(
				  							'theme_location' => 'primary',
				  							'container' => '',
				  							'menu_class' => '',
				  						)
				  					); 
				  				?>
				  			</div>
						</div>
					</div>
				</div><!-- /.container --> 
			</nav>