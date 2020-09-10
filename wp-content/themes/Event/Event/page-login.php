<?php
/*
Template Name: Login Page
*/
?>
<?php
	$et_ptemplate_settings = array();
	$et_ptemplate_settings = maybe_unserialize( get_post_meta(get_the_ID(),'et_ptemplate_settings',true) );

	$fullwidth = isset( $et_ptemplate_settings['et_fullwidthpage'] ) ? (bool) $et_ptemplate_settings['et_fullwidthpage'] : false;
?>

<?php get_header(); ?>

	<?php get_template_part('includes/breadcrumbs'); ?>

	<div id="left-area"<?php if ($fullwidth) echo ' class="fullwidth"'; ?>>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<div class="big-box">
			<div class="big-box-top">
				<div class="big-box-content">
					<div class="post clearfix single">
						<?php if (get_option('event_page_thumbnails') == 'on') { ?>
							<?php
								$thumb = '';
								$width = 188;
								$height = 188;
								$classtext = 'post-thumb';
								$titletext = get_the_title();

								$thumbnail = get_thumbnail($width,$height,$classtext,$titletext,$titletext,false,'Entry');
								$thumb = $thumbnail["thumb"];
							?>
							<?php if($thumb <> '') { ?>
								<div class="post-thumbnail">
									<?php print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext, $width, $height, $classtext); ?>
									<span class="post-overlay"></span>
								</div> 	<!-- end .post-thumbnail -->
							<?php } ?>
						<?php } ?>

						<h1 class="title"><?php the_title(); ?></h1>

						<?php the_content(); ?>
						<?php wp_link_pages(array('before' => '<p><strong>'.esc_html__('Pages','Event').':</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

						<div id="et-login">
							<div class='et-protected'>
								<div class='et-protected-form'>
									<?php $scheme = apply_filters( 'et_forms_scheme', null ); ?>

									<form action='<?php echo esc_url( home_url( '', $scheme ) ); ?>/wp-login.php' method='post'>
										<p><label><span><?php esc_html_e('Username','Event'); ?>: </span><input type='text' name='log' id='log' value='<?php echo esc_attr($user_login); ?>' size='20' /><span class='et_protected_icon'></span></label></p>
										<p><label><span><?php esc_html_e('Password','Event'); ?>: </span><input type='password' name='pwd' id='pwd' size='20' /><span class='et_protected_icon et_protected_password'></span></label></p>
										<input type='submit' name='submit' value='Login' class='etlogin-button' />
									</form>
								</div> <!-- .et-protected-form -->
							</div> <!-- .et-protected -->
						</div> <!-- end #et-login -->

						<div class="clear"></div>

						<?php edit_post_link(esc_html__('Edit this page','Event')); ?>
					</div> 	<!-- end .post-->
				</div> 	<!-- end .big-box-content-->
			</div> 	<!-- end .big-box-top-->
		</div> 	<!-- end .big-box-->
	<?php endwhile; endif; ?>
	</div> 	<!-- end #left-area -->

	<?php if (!$fullwidth) get_sidebar(); ?>

<?php get_footer(); ?>