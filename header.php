<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything until after the header closes.
 *
 * @package WordPress
 * @subpackage Salt
 * @since Salt 1.0
 */
?><!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,minimum-scale=1" />
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<!--[if lt IE 9]>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5shiv.min.js"></script>
	<![endif]-->
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php 
	if ($favicon = get_option('salt_custom_favicon')) {
		echo '<link rel="shortcut icon" href="' . $favicon .'" type="image/x-icon" />';
	}
	?>
	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php do_action('salt_top'); ?>

	<div id="wrapper" <?php do_action('salt_wrapper_class'); ?>>

		<div id="header-wrapper">
			
			<?php do_action('salt_header_above'); ?>
			
			<header id="header" <?php do_action('salt_header_class'); ?>>
		
				<?php do_action('salt_header_inside_above'); ?>
		
				<div class="container">
					
					<div class="inner-wrapper">
					<?php if( 'wide' == get_theme_mod( 'salt_layout_type' ) ) {
						get_template_part( 'partials/header' , 'wide' );
					} else {
						get_template_part( 'partials/header' , 'boxed' );
					}  ?>
					</div>
					
				</div>
		
				<?php do_action('salt_header_inside_below'); ?>
		
			</header>
			
			<?php if( 'boxed' == get_theme_mod( 'salt_layout_type' ) ) { ?>
			<div class="nav-wrapper navbar-collapse">
				<div class="container">
					<nav role="navigation" id="primary-menu">
						<?php wp_nav_menu (  array (  'container' => 'div', 'items_wrap' => '<ul class="%2$s">%3$s</ul>', 'menu_class' => 'menu', 'theme_location' => 'primary-menu' )); ?>
						<?php if( 'right' == get_theme_mod( 'salt_social_position' ) ) { ?>				
						<div class="pull-right social-links">
							<?php 
							if ( $t=get_theme_mod('salt_social_type') )
								$args['type'] = $t;
						
							if ( $s=get_theme_mod('salt_social_shape') )
								$args['shape'] = $s;
						
							if ( $z=get_theme_mod('salt_social_size') )
								$args['size'] = $z;
							
							salt_social_icons( $args ); ?>
						</div>
						<?php } ?>
					</nav>
				</div>
			</div>
			<?php } ?>
	
			<?php do_action('salt_header_below'); ?>

		</div>
		
		<?php do_action('salt_header_outside_below'); ?>