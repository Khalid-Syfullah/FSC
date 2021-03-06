<!--Begin Featured Articles-->
<span class="headings"><?php esc_html_e('featured articles','GrungeMag'); ?></span>
<div style="clear: both;"></div>

<?php
	  $featured_cat = get_option('grungemag_feat_cat');
	  query_posts("posts_per_page=".get_option('grungemag_featured_num')."&cat=".get_catId($featured_cat));
	  while (have_posts()) : the_post();  ?>
			<?php $thumb = '';
				  $width = 80;
				  $height = 80;
				  $classtext = 'no_border';
				  $titletext = get_the_title();

				  $thumbnail = get_thumbnail($width,$height,$classtext,$titletext,$titletext);
				  $thumb = $thumbnail["thumb"]; ?>
			<div class="random">
				<div class="random-image">
					<?php if($thumb != '') { ?>
						<a href="<?php the_permalink() ?>" title="<?php printf(esc_attr__('Permanent Link to %s','GrungeMag'), get_the_title()) ?>">
							<?php print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext , $width, $height, $classtext); ?>
						</a>
					<?php }; ?>
				</div>
				<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(esc_attr__('Permanent Link to %s','GrungeMag'), get_the_title()) ?>">
					<?php truncate_title(23); ?>
				</a>
			   <?php truncate_post(85); ?>
			</div>
	  <?php
	  endwhile; wp_reset_query(); ?>
<!--End Featured Article-->