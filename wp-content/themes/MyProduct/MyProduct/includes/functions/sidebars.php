<?php
if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => 'Sidebar',
		'id' => 'sidebar-1',
		'before_widget' => '<div id="%1$s" class="sidebar-block %2$s">',
		'after_widget' => '</div> <!-- end .sidebar-block -->',
		'before_title' => '<h3 class="title">',
		'after_title' => '</h3>',
    ));

if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => 'Sidebar Home',
		'id' => 'sidebar-2',
		'before_widget' => '<div id="%1$s" class="sidebar-block %2$s">',
		'after_widget' => '</div> <!-- end .sidebar-block -->',
		'before_title' => '<h3 class="title">',
		'after_title' => '</h3>',
    ));

if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => 'Footer',
		'id' => 'sidebar-3',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div> <!-- end .widget -->',
		'before_title' => '<h3 class="title">',
		'after_title' => '</h3>',
    ));
?>