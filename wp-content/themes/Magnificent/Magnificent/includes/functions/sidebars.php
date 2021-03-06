<?php
if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Sidebar Left Top',
		'id' => 'sidebar-1',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div></div><!-- end .widget -->',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4><div class="widgetcontent">',
	));

if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Sidebar Left Bottom',
		'id' => 'sidebar-2',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div></div><!-- end .widget -->',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4><div class="widgetcontent">',
	));

if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Sidebar Right Top',
		'id' => 'sidebar-3',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div></div><!-- end .widget -->',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4><div class="widgetcontent">',
	));

if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Sidebar Right Bottom',
		'id' => 'sidebar-4',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div></div><!-- end .widget -->',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4><div class="widgetcontent">',
	));

if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => 'Footer',
		'id' => 'sidebar-6',
		'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
		'after_widget' => '</div> <!-- end .footer-widget -->',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
    ));
?>