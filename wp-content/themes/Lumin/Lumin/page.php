<?php if (is_front_page()) { ?>
	<?php get_template_part('home'); ?>
<?php } else { ?>
	<?php get_header(); ?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<h1 id="post-title"><span><?php the_title(); ?></span></h1>
		<div id="main">
			<div class="post">
				<?php $width = (int) get_option('lumin_thumbnail_width_pages');
					  $height = (int) get_option('lumin_thumbnail_height_pages');
					  $classtext = 'thumbnail-post alignleft';
					  $titletext = get_the_title();

					  $thumbnail = get_thumbnail($width,$height,$classtext,$titletext,$titletext);
					  $thumb = $thumbnail["thumb"]; ?>

				<?php if($thumb <> '' && get_option('lumin_page_thumbnails') == 'on') { ?>
					<?php print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext , $width, $height, $classtext); ?>
				<?php }; ?>
				<?php the_content(); ?>
				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
				<?php edit_post_link(esc_html__('Edit this page','Lumin')); ?>
				<div class="clear"></div>
			</div> <!-- end .post -->

			<?php if (get_option('lumin_show_pagescomments') == 'on') comments_template('', true); ?>

		</div> <!-- end #main -->
	<?php endwhile; ?>
	<?php else : ?>
		<?php get_template_part('includes/noresults'); ?>
	<?php endif; ?>
	<?php get_sidebar(); ?>
	<?php get_footer(); ?>
<?php } ?>