<?php get_header(); ?>

<div id="main-area">
	<?php get_template_part('includes/breadcrumbs'); ?>

	<div id="main-recent">
		<div class="entry">
			<div class="entry-top">
				<div class="entry-content">
					<!--If no results are found-->
						<h1><?php esc_html_e('No Results Found','AskIt'); ?></h1>
						<p><?php esc_html_e('The page you requested could not be found. Try refining your search, or use the navigation above to locate the post.','AskIt'); ?></p>
					<!--End if no results are found-->
				</div> <!-- end .entry-content -->
			</div> <!-- end .entry-top -->
		</div> <!-- end .entry -->
	</div> <!-- end #main-recent -->
</div> <!-- end #main-area -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>