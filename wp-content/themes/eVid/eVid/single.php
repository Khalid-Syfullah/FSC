<?php get_header(); ?>
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<?php $video = get_post_meta(get_the_ID(), 'Video', $single = true); ?>
<?php $video = preg_replace('/<embed /','<embed wmode="transparent" ',$video);
$video = preg_replace('/<\/object>/','<param name="wmode" value="transparent" /></object>',$video); ?>
<?php if($video !== '') : ?>
<div id="header4">
    <div id="header5">
        <div class="video-nav ievideo-nav" style="margin-left: 100px;"> <span class="video-button-hover"> <img src="<?php echo get_template_directory_uri(); ?>/images/video-button-embed.png" style="margin: 2px 0px 0px 0px; border: none; cursor: pointer;" alt="embed" /> <img src="<?php echo get_template_directory_uri(); ?>/images/video-button-embed-hover.gif" alt="embed" class="embed-button video-button-hover-image"  /> </span> <span class="video-button-hover"> <img src="<?php echo get_template_directory_uri(); ?>/images/video-button-share.png" style="margin: 2px 0px 0px 0px; border: none; cursor: pointer;" alt="share" /> <img src="<?php echo get_template_directory_uri(); ?>/images/video-button-share-hover.gif" alt="share" class="share-button video-button-hover-image"  /> </span> <span class="video-button-hover"> <img src="<?php echo get_template_directory_uri(); ?>/images/video-button-link.png" style="margin: 2px 0px 0px 0px; border: none; cursor: pointer;" alt="link" /> <img src="<?php echo get_template_directory_uri(); ?>/images/video-button-link-hover.gif" alt="link" class="link-button video-button-hover-image"  /> </span> <span class="video-button-hover"> <img src="<?php echo get_template_directory_uri(); ?>/images/video-button-comment.png" style="margin: 2px 0px 0px 0px; border: none; cursor: pointer;" alt="comment"  /> <a href="#respond" class="video-button-hover-image" ><img src="<?php echo get_template_directory_uri(); ?>/images/video-button-comment-hover.gif" alt="comment" style="border: none;" class="comment-button" /></a> </span> </div>
        <div id="video">
            <div id="video-inside"> <?php echo $video; ?> </div>
        </div>
        <div class="video-embed video2"> <span class="video-titles"><?php esc_html_e('Embed This Video','eVid') ?></span> <img src="<?php echo get_template_directory_uri(); ?>/images/close.png" style="margin: 10px 10px 0px 0px; float: right; cursor: pointer;" alt="close" class="close" />
            <div style="clear: both;"></div>
            <textarea rows="4" style="border:1px solid #1F1F1F; width:90%; height: 200px; background:#373737; padding:10px; color:#CCCCCC; margin-left: 15px; float: left; margin-top: 15px;"><?php echo get_post_meta(get_the_ID(), "Video", true); ?>
</textarea>
        </div>
        <div class="video-share video2"> <span class="video-titles"><?php esc_html_e('Share This Video','eVid') ?></span> <img src="<?php echo get_template_directory_uri(); ?>/images/close.png" style="margin: 10px 10px 0px 0px; float: right; cursor: pointer;" alt="close" class="close" />
            <div style="clear: both;"></div>
            <a href="http://del.icio.us/post?url=<?php the_permalink() ?>&amp;title=<?php the_title(); ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/bookmark-1.gif" alt="bookmark" style="float: left; margin-left: 15px; margin-right: 8px; border: none;" /></a> <a href="http://www.digg.com/submit?phase=2&amp;url=<?php the_permalink() ?>&amp;title=<?php the_title(); ?>"  target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/bookmark-2.gif" alt="bookmark" style="float: left; margin-right: 8px; border: none;" /></a> <a href="http://www.reddit.com/submit?url=<?php the_permalink() ?>&amp;title=<?php the_title(); ?>"  target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/bookmark-3.gif" alt="bookmark" style="float: left; margin-right: 8px; border: none;" /></a> <a href="http://www.stumbleupon.com/submit?url=<?php the_permalink() ?>&amp;title=<?php the_title(); ?>"  target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/bookmark-4.gif" alt="bookmark" style="float: left; margin-right: 8px; border: none;" /></a> <a href="http://www.squidoo.com/lensmaster/bookmark?<?php the_permalink() ?>"  target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/bookmark-5.gif" alt="bookmark" style="float: left; margin-right: 8px; border: none;" /></a> <a href="http://myweb2.search.yahoo.com/myresults/bookmarklet?t=<?php the_title(); ?>&amp;u=<?php the_permalink() ?>"  target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/bookmark-6.gif" alt="bookmark" style="float: left; margin-right: 8px; border: none;" /></a> <a href="http://www.google.com/bookmarks/mark?op=edit&amp;bkmk=<?php the_permalink() ?>&amp;title=<?php the_title(); ?>"  target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/bookmark-7.gif" alt="bookmark" style="float: left; margin-right: 8px; border: none;" /></a> <a href="http://www.blinklist.com/index.php?Action=Blink/addblink.php&amp;Url=<?php the_permalink() ?>&amp;Title=<?php the_title(); ?>"  target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/bookmark-8.gif" alt="bookmark" style="float: left; margin-right: 8px; border: none;" /></a> <a href="http://www.technorati.com/faves?add=<?php the_permalink() ?>"  target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/bookmark-9.gif" alt="bookmark" style="float: left; margin-right: 8px; border: none;" /></a> <a href="http://www.furl.net/storeIt.jsp?t=<?php the_title(); ?>&amp;u=<?php the_permalink() ?>"  target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/bookmark-10.gif" alt="bookmark" style="float: left; margin-right: 8px; border: none;" /></a> <a href="http://twitter.com/home?status=<?php the_title(); echo(' '); echo $permalink; ?>"  target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/bookmark-11.gif" alt="bookmark" style="float: left; margin-right: 8px; border: none;" /></a> <a href="http://www.mixx.com/submit?page_url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>"  target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/bookmark-12.gif" alt="bookmark" style="float: left; margin-right: 8px; border: none;" /></a> </div>
        <div class="video-link video2"> <span class="video-titles"><?php esc_html_e('Link To This Video','eVid') ?></span> <img src="<?php echo get_template_directory_uri(); ?>/images/close.png" style="margin: 10px 10px 0px 0px; float: right; cursor: pointer;" alt="close" class="close" />
            <div style="clear: both;"></div>
            <textarea rows="4" style="border:1px solid #1F1F1F; width:90%; height: 200px; background:#373737; padding:10px; color:#CCCCCC; margin-left: 15px; float: left; margin-top: 15px;">
<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(esc_attr__('Permanent Link to %s','eVid'), get_the_title()) ?>"><?php the_title(); ?></a>
</textarea>
        </div>
        <div class="video-comment video2"> <img src="<?php echo get_template_directory_uri(); ?>/images/close.png" style="margin: 10px 10px 0px 0px; float: right; cursor: pointer;" alt="embed" class="close" /> <?php esc_html_e('test','eVid') ?> </div>
        <div class="video-rate video2"> <span class="video-titles"><?php esc_html_e('Rate This Video','eVid') ?></span> <img src="<?php echo get_template_directory_uri(); ?>/images/close.png" style="margin: 10px 10px 0px 0px; float: right; cursor: pointer;" alt="embed" class="close" />
            <div style="clear: both;"></div>
            <div style="border:1px solid #1F1F1F; width:90%; height: 200px; background:#373737; padding:10px; color:#CCCCCC; margin-left: 15px; float: left; margin-top: 15px;">
                <?php if(function_exists('the_ratings')) { the_ratings(); } ?>
            </div>
        </div>
        <div class="video-tags video2"> <span class="video-titles"><?php esc_html_e('Tags For This Video','eVid') ?></span> <img src="<?php echo get_template_directory_uri(); ?>/images/close.png" style="margin: 10px 10px 0px 0px; float: right; cursor: pointer;" alt="tags" class="close" />
            <div style="clear: both;"></div>
            <?php the_tags('', ' ', ''); ?>
        </div>
        <div class="video-related video2"> <span class="video-titles"><?php esc_html_e('Related Videos','eVid') ?></span> <img src="<?php echo get_template_directory_uri(); ?>/images/close.png" style="margin: 10px 10px 0px 0px; float: right; cursor: pointer;" alt="related posts" class="close" />
            <div style="clear: both;"></div>
            <?php wp_related_posts(); ?>
        </div>
        <div class="video-nav"> <span class="video-button-hover"> <img src="<?php echo get_template_directory_uri(); ?>/images/video-button-rate.png" style="margin: 2px 0px 0px 0px; border: none; cursor: pointer;" alt="rate" /> <img src="<?php echo get_template_directory_uri(); ?>/images/video-button-rate-hover.gif" alt="rate" style="left: 5px !important;" class="rate-button video-button-hover-image"  /> </span> <span class="video-button-hover"> <img src="<?php echo get_template_directory_uri(); ?>/images/video-button-tags.png" style="margin: 2px 0px 0px 0px; border: none; cursor: pointer;" alt="tags" /> <img src="<?php echo get_template_directory_uri(); ?>/images/video-button-tags-hover.gif" alt="tags" style="left: 5px !important;" class="tags-button video-button-hover-image"  /> </span> <span class="video-button-hover"> <img src="<?php echo get_template_directory_uri(); ?>/images/video-button-related.png" style="margin: 2px 0px 0px 0px; border: none; cursor: pointer;" alt="related" /> <img src="<?php echo get_template_directory_uri(); ?>/images/video-button-related-hover.gif" alt="related" style="left: 5px !important;" class="related-button video-button-hover-image"  /> </span> <span class="video-button-hover"> <img src="<?php echo get_template_directory_uri(); ?>/images/video-button-lights.png" style="margin: 2px 0px 0px 0px; border: none; cursor: pointer;" alt="lights" /> <img src="<?php echo get_template_directory_uri(); ?>/images/video-button-lights-hover.gif" alt="lights" style="left: 5px !important;" class="lights-button video-button-hover-image"  /> </span> </div>
    </div>
</div>
<?php else : ?>

    <?php $width = 950;
          $height = 287;

          $classtext = 'single-image';
          $titletext = get_the_title();

          $thumbnail = get_thumbnail($width,$height,$classtext,$titletext,$titletext,false,'Image');
          $thumb = $thumbnail["thumb"]; ?>

    <?php if( isset($image) && $image != '') : ?>

        <div id="header2">
            <div id="header3">

               <?php print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext, $width, $height, $classtext); ?>

            </div>
        </div>

    <?php endif; ?>

<?php endif; ?>
<div id="wrapper2">

<div id="container">
    <div id="left-div">
        <div id="left-inside">
            <!--Begin Post-->
            <div class="post-wrapper">
            <?php if (get_option('evid_integration_single_top') <> '' && get_option('evid_integrate_singletop_enable') == 'on') echo(get_option('evid_integration_single_top')); ?>
                <h1 class="post-title"><?php the_title(); ?></h1>
                <?php get_template_part('includes/postinfo'); ?>

                <?php if (get_option('evid_thumbnails') == 'on') { get_template_part('includes/thumbnail'); } ?>
                <?php the_content(); ?>
                <?php if (get_option('evid_integration_single_bottom') <> '' && get_option('evid_integrate_singlebottom_enable') == 'on') echo(get_option('evid_integration_single_bottom')); ?>
                <?php if (get_option('evid_foursixeight') == 'on') { get_template_part('includes/468x60'); } ?>
                <div style="clear: both;"></div>
                <?php if (get_option('evid_show_postcomments') == 'on') { comments_template('', true); }; ?>
                <?php endwhile; ?>
            </div>
            <?php else : ?>
            <!--If no results are found-->
            <h1><?php esc_html_e('No Results Found','eVid') ?></h1>
            <p><?php esc_html_e('The page you requested could not be found. Try refining your search, or use the navigation above to locate the post.','eVid') ?></p>
            <!--End if no results are found-->
            <?php endif; ?>
        </div>
    </div>
    <!--Begin Sidebar-->
    <?php get_sidebar(); ?>
    <!--End Sidebar-->
    <!--Begin Footer-->
    <?php get_footer(); ?>
    <!--End Footer-->
</div>
</body>
</html>