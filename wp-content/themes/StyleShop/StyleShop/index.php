<?php get_header(); ?>

<div id="content-area" class="clearfix">
	<div id="main-area">

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<?php get_template_part('includes/entry', 'index'); ?>
	<?php
	endwhile;
		if ( function_exists( 'wp_pagenavi' ) ) wp_pagenavi();
		else get_template_part( 'includes/navigation', 'entry' );
	else:
		get_template_part( 'includes/no-results', 'entry' );
	endif; ?>

	</div> <!-- #main-area -->

	<?php get_sidebar(); ?>
</div> <!-- #content-area -->

<?php get_footer(); ?>