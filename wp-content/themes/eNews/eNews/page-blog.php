<?php
/*
Template Name: Blog Page
*/
?>
<?php get_header(); ?>
<?php
$et_ptemplate_settings = array();
$et_ptemplate_settings = maybe_unserialize( get_post_meta( get_the_ID(), 'et_ptemplate_settings', true ) );

$fullwidth = isset( $et_ptemplate_settings['et_fullwidthpage'] ) ? (bool) $et_ptemplate_settings['et_fullwidthpage'] : false;

$et_ptemplate_blogstyle = isset( $et_ptemplate_settings['et_ptemplate_blogstyle'] ) ? (bool) $et_ptemplate_settings['et_ptemplate_blogstyle'] : false;

$et_ptemplate_showthumb = isset( $et_ptemplate_settings['et_ptemplate_showthumb'] ) ? (bool) $et_ptemplate_settings['et_ptemplate_showthumb'] : false;

$blog_cats = isset( $et_ptemplate_settings['et_ptemplate_blogcats'] ) ? (array) $et_ptemplate_settings['et_ptemplate_blogcats'] : array();
$et_ptemplate_blog_perpage = isset( $et_ptemplate_settings['et_ptemplate_blog_perpage'] ) ? (int) $et_ptemplate_settings['et_ptemplate_blog_perpage'] : 10;
?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<div id="post-top">
	<div class="breadcrumb">
		<?php if(function_exists('bcn_display')) { bcn_display(); }
		else { ?>
			<?php esc_html_e('You are currently viewing','eNews') ?>: <em><?php the_title() ?></em>
		<?php }; ?>
	</div> <!-- end breadcrumb -->
</div> <!-- end post-top -->

<div id="main-area-wrap" <?php if($fullwidth) echo ('class="no_sidebar"');?>>
	<div id="wrapper">
		<div id="main" class="noborder">
			<h1 class="page-title"><?php the_title() ?></h1>
			<div id="post-content">

				<?php $width = (int) get_option('enews_thumbnail_width_pages');
					  $height = (int) get_option('enews_thumbnail_height_pages');
					  $classtext = 'thumbnail alignleft';
					  $titletext = get_the_title();

				$thumbnail = get_thumbnail($width,$height,$classtext,$titletext,$titletext);
				$thumb = $thumbnail["thumb"];  ?>

				<?php if($thumb <> '' && get_option('enews_page_thumbnails') == 'on') { ?>
					<?php print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext, $width, $height, $classtext); ?>
				<?php }; ?>

				<?php the_content(); ?>
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

								<p class="et_pt_blogmeta"><?php esc_html_e('Posted','eNews'); ?> <?php esc_html_e('by','eNews'); ?> <?php the_author_posts_link(); ?> <?php esc_html_e('on','eNews'); ?> <?php the_time(get_option('enews_date_format')) ?> <?php esc_html_e('in','eNews'); ?> <?php the_category(', ') ?> | <?php comments_popup_link(esc_html__('0 comments','eNews'), esc_html__('1 comment','eNews'), '% '.esc_html__('comments','eNews')); ?></p>

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
									<a href="<?php the_permalink(); ?>" class="readmore"><span><?php esc_html_e('read more','eNews'); ?></span></a>
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
				<?php edit_post_link(esc_html__('Edit this page','eNews')); ?>

			</div> <!-- end post-content -->
			<br class="clearfix"/>
			<?php if (get_option('enews_show_pagescomments') == 'on') comments_template('', true); ?>

		</div> <!-- end main -->
<?php endwhile; endif; ?>
<?php if (!$fullwidth) get_sidebar(); ?>
<?php get_footer(); ?>