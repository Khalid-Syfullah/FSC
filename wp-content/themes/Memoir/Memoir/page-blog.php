<?php
/*
Template Name: Blog Page
*/
?>
<?php
$et_ptemplate_settings = array();
$et_ptemplate_settings = maybe_unserialize( get_post_meta( get_the_ID(), 'et_ptemplate_settings', true ) );

$fullwidth = isset( $et_ptemplate_settings['et_fullwidthpage'] ) ? (bool) $et_ptemplate_settings['et_fullwidthpage'] : false;

$et_ptemplate_blogstyle = isset( $et_ptemplate_settings['et_ptemplate_blogstyle'] ) ? (bool) $et_ptemplate_settings['et_ptemplate_blogstyle'] : false;

$et_ptemplate_showthumb = isset( $et_ptemplate_settings['et_ptemplate_showthumb'] ) ? (bool) $et_ptemplate_settings['et_ptemplate_showthumb'] : false;

$blog_cats = isset( $et_ptemplate_settings['et_ptemplate_blogcats'] ) ? (array) $et_ptemplate_settings['et_ptemplate_blogcats'] : array();
$et_ptemplate_blog_perpage = isset( $et_ptemplate_settings['et_ptemplate_blog_perpage'] ) ? (int) $et_ptemplate_settings['et_ptemplate_blog_perpage'] : 10;
?>

<?php get_header(); ?>
	<div id="main-area">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<?php if (get_option('memoir_integration_single_top') <> '' && get_option('memoir_integrate_singletop_enable') == 'on') echo(get_option('memoir_integration_single_top')); ?>

		<div class="entry clearfix post">
			<h1 class="title"><?php the_title(); ?></h1>

			<?php $thumb = '';
			$width = 135;
			$height = 135;
			$classtext = '';
			$titletext = get_the_title();
			$thumbnail = get_thumbnail($width,$height,$classtext,$titletext,$titletext,false,'Entry');
			$thumb = $thumbnail["thumb"]; ?>

			<?php if($thumb <> '' && get_option('memoir_page_thumbnails') == 'on') { ?>
				<div class="post-thumbnail alignleft">
					<?php print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext, $width, $height, $classtext); ?>
					<span class="post-overlay"></span>
				</div> 	<!-- end .post-thumbnail -->
			<?php } ?>

			<?php
				echo apply_filters('the_content',et_create_dropcaps(get_the_content()));
			?>
			<?php wp_link_pages(array('before' => '<p><strong>'.esc_html__('Pages','Memoir').':</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

			<div id="et_pt_blog">
				<?php $cat_query = '';
				if ( !empty($blog_cats) ) $cat_query = '&cat=' . implode(",", $blog_cats);
				else echo '<!-- blog category is not selected -->'; ?>
				<?php
					$et_paged = is_front_page() ? get_query_var( 'page' ) : get_query_var( 'paged' );
				?>
				<?php query_posts("posts_per_page=$et_ptemplate_blog_perpage&paged=" . $et_paged . $cat_query); ?>
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					<div class="et_pt_blogentry clearfix">
						<h2 class="et_pt_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

						<p class="et_pt_blogmeta"><?php esc_html_e('Posted','Memoir'); ?> <?php esc_html_e('by','Memoir'); ?> <?php the_author_posts_link(); ?> <?php esc_html_e('on','Memoir'); ?> <?php the_time(get_option('memoir_date_format')) ?> <?php esc_html_e('in','Memoir'); ?> <?php the_category(', ') ?> | <?php comments_popup_link(esc_html__('0 comments','Memoir'), esc_html__('1 comment','Memoir'), '% '.esc_html__('comments','Memoir')); ?></p>

						<?php $thumb = '';
						$width = 184;
						$height = 184;
						$classtext = '';
						$titletext = get_the_title();

						$thumbnail = get_thumbnail($width,$height,$classtext,$titletext,$titletext);
						$thumb = $thumbnail["thumb"]; ?>

						<?php if ( $thumb <> '' && !$et_ptemplate_showthumb ) { ?>
							<div class="et_pt_thumb alignleft">
								<?php print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext, $width, $height, $classtext); ?>
								<a href="<?php the_permalink(); ?>"><span class="overlay"></span></a>
							</div> <!-- end .thumb -->
						<?php }; ?>

						<?php if (!$et_ptemplate_blogstyle) { ?>
							<p><?php truncate_post(550);?></p>
							<a href="<?php the_permalink(); ?>" class="readmore"><span><?php esc_html_e('read more','Memoir'); ?></span></a>
						<?php } else { ?>
							<?php
								global $more;
								$more = 0;
							?>
							<?php the_content(); ?>
						<?php } ?>
					</div> <!-- end .et_pt_blogentry -->

				<?php endwhile; ?>
					<div class="page-nav clearfix">
						<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); }
						else { ?>
							 <?php get_template_part('includes/navigation'); ?>
						<?php } ?>
					</div> <!-- end .entry -->
				<?php else : ?>
					<?php get_template_part('includes/no-results'); ?>
				<?php endif; wp_reset_query(); ?>

			</div> <!-- end #et_pt_blog -->

			<?php edit_post_link(esc_html__('Edit this page','Memoir')); ?>

		</div> <!-- end .entry -->

		<?php if (get_option('memoir_integration_single_bottom') <> '' && get_option('memoir_integrate_singlebottom_enable') == 'on') echo(get_option('memoir_integration_single_bottom')); ?>
	<?php endwhile; endif; ?>
	</div> <!-- end #main-area -->
	<?php if (!$fullwidth) get_sidebar(); ?>
<?php get_footer(); ?>