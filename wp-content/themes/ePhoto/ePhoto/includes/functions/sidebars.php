<?php
if ( function_exists('register_sidebar') )
  register_sidebar(array(
  'name' => 'Sidebar',
  'id' => 'sidebar-1',
 'before_widget' => '<div class="sidebar-box">  <div class="sidebar-box-inside"> ',
 'after_widget' => '</div></div>',
 'before_title' => '<span class="sidebar-box-title">',
 'after_title' => '</span><div style="clear: both;"></div>',
    ));
if ( function_exists('register_sidebar') )
    register_sidebar(array(
    'name' => 'Homepage',
    'id' => 'sidebar-2',
 'before_widget' => '<div class="sidebar-box">  <div class="sidebar-box-inside"> ',
 'after_widget' => '</div></div>',
 'before_title' => '<span class="sidebar-box-title">',
 'after_title' => '</span><div style="clear: both;"></div>',
    ));
if ( function_exists('register_sidebar') )
    register_sidebar(array(
    'name' => 'Footer',
    'id' => 'sidebar-3',
    'before_widget' => '<div class="bottom-box2">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
    ));
?>