<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<?php elegant_description(); ?>
<?php elegant_keywords(); ?>
<?php elegant_canonical(); ?>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link href='https://fonts.googleapis.com/css?family=Droid+Sans:regular,bold' rel='stylesheet' type='text/css' />
<link href='https://fonts.googleapis.com/css?family=Goudy+Bookletter+1911' rel='stylesheet' type='text/css' />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<!--[if lt IE 7]>
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/ie6style.css" />
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/DD_belatedPNG_0.0.8a-min.js"></script>
	<script type="text/javascript">DD_belatedPNG.fix('img#logo, span.overlay, a.zoom-icon, a.more-icon, #menu, #menu-right, #menu-content, ul#top-menu ul, #featured a#left-arrow, #featured a#right-arrow, #top-bottom, #top .container, #recent-projects, #recent-projects-right, #recent-projects-content, .project-overlay, span#down-arrow, #footer-content, #footer-top, .footer-widget ul li, span.post-overlay, #content-area, .avatar-overlay, .comment-arrow');</script>
<![endif]-->
<!--[if IE 7]>
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/ie7style.css" />
<![endif]-->
<!--[if IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/ie8style.css" />
<![endif]-->

<script type="text/javascript">
	document.documentElement.className = 'js';
</script>

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
	<div id="top"<?php if ( get_option('webly_display_landscape') == 'false' || get_option('webly_featured') == 'false' ) echo ' class="nolandscape"'; ?>>
		<div id="top-center"<?php if (!is_home()) echo ' class="index"'; ?>>
			<div id="top-bottom"<?php if ( get_option('webly_featured') == 'false' && is_home() ) echo ' class="nofeatured"'; ?>>
				<div class="container">
					<div id="header" class="clearfix">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<?php $logo = (get_option('webly_logo') <> '') ? get_option('webly_logo') : get_template_directory_uri() . '/images/logo.png'; ?>
							<img src="<?php echo esc_attr( $logo ); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" id="logo"/>
						</a>

						<p id="slogan"><?php bloginfo('description'); ?></p>

						<div id="menu">
							<div id="menu-right">
								<div id="menu-content">
									<?php $menuClass = 'nav';
									$menuID = 'top-menu';
									$primaryNav = '';
									if (function_exists('wp_nav_menu')) {
										$primaryNav = wp_nav_menu( array( 'theme_location' => 'primary-menu', 'container' => '', 'fallback_cb' => '', 'menu_class' => $menuClass, 'menu_id' => $menuID, 'echo' => false ) );
									};
									if ($primaryNav == '') { ?>
										<ul id="<?php echo esc_attr( $menuID ); ?>" class="<?php echo esc_attr( $menuClass ); ?>">
											<?php if (get_option('webly_home_link') == 'on') { ?>
												<li <?php if (is_home()) echo('class="current_page_item"') ?>><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e('Home','Webly') ?></a></li>
											<?php }; ?>

											<?php show_page_menu($menuClass,false,false); ?>
											<?php show_categories_menu($menuClass,false); ?>
										</ul> <!-- end ul#nav -->
									<?php }
									else echo($primaryNav); ?>
								</div> <!-- end #menu-content -->
							</div> <!-- end #menu-right -->
						</div> <!-- end #menu -->

						<div class="clear"></div>

						<?php if ( is_home() && get_option('webly_featured') == 'on' ) get_template_part('includes/featured'); ?>

					</div> <!-- end #header -->

					<?php if ( is_home() && get_option('webly_buttons') == 'on' ) { ?>
						<div id="top-buttons" class="clearfix">
							<?php if (get_option('webly_button1_text') <> '' ) { ?>
								<a href="<?php echo esc_url(get_option('webly_button1_url')); ?>" class="button">
									<span><?php echo esc_html(get_option('webly_button1_text')); ?></span>
								</a>
							<?php } ?>
							<?php if (get_option('webly_button2_text') <> '' ) { ?>
								<a href="<?php echo esc_url(get_option('webly_button2_url')); ?>" class="button">
									<span><?php echo esc_html(get_option('webly_button2_text')); ?></span>
								</a>
							<?php } ?>
						</div> <!-- end #top-buttons -->
					<?php } ?>

					<?php if ( !is_home() ) get_template_part('includes/top_info'); ?>

				</div> <!-- end .container -->
			</div> <!-- end #top-bottom -->
		</div> <!-- end #top-center -->
	</div> <!-- end #top -->
