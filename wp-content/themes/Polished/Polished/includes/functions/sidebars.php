<?php $path = get_template_directory_uri(); ?>
<?php
if ( function_exists('register_sidebar') )
    register_sidebar(array(
		'name' => 'Sidebar',
		'id' => 'sidebar-1',
		'before_widget' => '<div id="%1$s" class="block %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2><img width="258" height="16" alt="Sidebar Hr" src="'.$path.'/images/sidebar_hr.png" class="divider"/>',
    ));
if ( function_exists('register_sidebar') )
    register_sidebar(array(
	'name' => 'Footer',
	'id' => 'sidebar-2',
    'before_widget' => '<div class="block_b">',
    'after_widget' => '</div>',
	'before_title' => '<h2>',
    'after_title' => '</h2>',
    ));
?>