<?php
add_action( 'after_setup_theme', 'et_setup_theme' );
if ( ! function_exists( 'et_setup_theme' ) ){
	function et_setup_theme(){
		global $themename, $shortname, $default_colorscheme;
		$themename = "Envisioned";
		$shortname = "envisioned";
		$default_colorscheme = "Default";

		$template_dir = get_template_directory();

		require_once($template_dir . '/epanel/custom_functions.php');

		require_once( $template_dir . '/includes/functions/sanitization.php' );

		require_once($template_dir . '/includes/functions/comments.php');

		require_once($template_dir . '/includes/functions/sidebars.php');

		load_theme_textdomain('Envisioned',$template_dir.'/lang');

		require_once($template_dir . '/epanel/core_functions.php');

		require_once($template_dir . '/includes/post_thumbnails_envisioned.php');

		include($template_dir . '/includes/widgets.php');

		require_once($template_dir . '/includes/additional_functions.php');

		remove_action( 'admin_init', 'et_epanel_register_portability' );

		add_filter( 'et_print_thumbnail_dimensions', 'et_single_post_thumbnail_dimensions' );
		function et_single_post_thumbnail_dimensions( $dimensions ){
			if ( false !== strpos( $dimensions, '9999' ) ) $dimensions = '';
			return $dimensions;
		}

		add_action( 'pre_get_posts', 'et_home_posts_query' );

		add_action( 'et_epanel_changing_options', 'et_delete_featured_ids_cache' );
		add_action( 'delete_post', 'et_delete_featured_ids_cache' );
		add_action( 'save_post', 'et_delete_featured_ids_cache' );

		add_theme_support( 'title-tag' );
	}
}

if ( ! function_exists( '_wp_render_title_tag' ) ) :
/**
 * Manually add <title> tag in head for WordPress 4.1 below for backward compatibility
 * Title tag is automatically added for WordPress 4.1 above via theme support
 * @return void
 */
	function et_add_title_tag_back_compat() { ?>
		<title><?php wp_title( '-', true, 'right' ); ?></title>
<?php
	}
	add_action( 'wp_head', 'et_add_title_tag_back_compat' );
endif;

function register_main_menus() {
	register_nav_menus(
		array(
			'primary-menu' => __( 'Primary Menu', 'Envisioned' ),
			'footer-menu' => __( 'Footer Menu', 'Envisioned' )
		)
	);
}
if (function_exists('register_nav_menus')) add_action( 'init', 'register_main_menus' );

// add Home link to the custom menu WP-Admin page
function et_add_home_link( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'et_add_home_link' );

add_action('wp_head','et_add_meta_javascript');
function et_add_meta_javascript(){
	global $shortname;
	echo '<!-- used in scripts -->';
	echo '<meta name="et_featured_auto_speed" content="'.esc_attr( get_option($shortname.'_slider_autospeed') ).'" />';

	$disable_toptier = get_option($shortname.'_disable_toptier') == 'on' ? 1 : 0;
	echo '<meta name="et_disable_toptier" content="'.esc_attr( $disable_toptier ).'" />';

	$featured_slider_auto = get_option($shortname.'_slider_auto') == 'on' ? 1 : 0;
	echo '<meta name="et_featured_slider_auto" content="'.esc_attr( $featured_slider_auto ).'" />';

	$featured_slider_pause = get_option($shortname.'_pause_hover') == 'on' ? 1 : 0;
	echo '<meta name="et_featured_slider_pause" content="'.esc_attr( $featured_slider_pause ).'" />';
}

/**
 * Gets featured posts IDs from transient, if the transient doesn't exist - runs the query and stores IDs
 */
function et_get_featured_posts_ids(){
	if ( false === ( $et_featured_post_ids = get_transient( 'et_featured_post_ids' ) ) ) {
		$featured_query = new WP_Query( apply_filters( 'et_featured_post_args', array(
			'posts_per_page'	=> (int) et_get_option( 'envisioned_featured_num' ),
			'cat'				=> (int) get_catId( et_get_option( 'envisioned_feat_cat' ) )
		) ) );

		if ( $featured_query->have_posts() ) {
			while ( $featured_query->have_posts() ) {
				$featured_query->the_post();

				$et_featured_post_ids[] = get_the_ID();
			}

			set_transient( 'et_featured_post_ids', $et_featured_post_ids );
		}

		wp_reset_postdata();
	}

	return $et_featured_post_ids;
}

/**
 * Filters the main query on homepage
 */
function et_home_posts_query( $query = false ) {
	/* Don't proceed if it's not homepage or the main query */
	if ( ! is_home() || ! is_a( $query, 'WP_Query' ) || ! $query->is_main_query() ) return;

	if ( 'false' == et_get_option( 'envisioned_blog_style', 'false' ) ) {
		$query->set( 'posts_per_page', et_get_option( 'envisioned_posts_media', '10' ) );

		$exclude_media_categories = et_get_option( 'envisioned_exlcats_media', false );
		if ( $exclude_media_categories ) $query->set( 'category__not_in', array_map( 'intval', et_generate_wpml_ids( $exclude_media_categories, 'category' ) ) );

		return;
	}

	/* Set the amount of posts per page on homepage */
	$query->set( 'posts_per_page', (int) et_get_option( 'envisioned_homepage_posts', '6' ) );

	/* Exclude categories set in ePanel */
	$exclude_categories = et_get_option( 'envisioned_exlcats_recent', false );
	if ( $exclude_categories ) $query->set( 'category__not_in', array_map( 'intval', et_generate_wpml_ids( $exclude_categories, 'category' ) ) );

	/* Exclude slider posts, if the slider is activated, pages are not featured and posts duplication is disabled in ePanel  */
	if ( 'on' == et_get_option( 'envisioned_featured', 'on' ) && 'false' == et_get_option( 'envisioned_use_pages', 'false' ) && 'false' == et_get_option( 'envisioned_duplicate', 'on' ) )
		$query->set( 'post__not_in', et_get_featured_posts_ids() );
}

/**
 * Deletes featured posts IDs transient, when the user saves, resets ePanel settings, creates or moves posts to trash in WP-Admin
 */
function et_delete_featured_ids_cache(){
	if ( false !== get_transient( 'et_featured_post_ids' ) ) delete_transient( 'et_featured_post_ids' );
}

if ( ! function_exists( 'et_list_pings' ) ){
	function et_list_pings($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment; ?>
		<li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?> - <?php comment_excerpt(); ?>
	<?php }
}

function et_epanel_custom_colors_css(){
	global $shortname; ?>

	<style type="text/css">
		body { color: #<?php echo esc_html(get_option($shortname.'_color_mainfont')); ?>; }
		#content-area a { color: #<?php echo esc_html(get_option($shortname.'_color_mainlink')); ?>; }
		ul.nav li a { color: #<?php echo esc_html(get_option($shortname.'_color_pagelink')); ?>; }
		ul.nav > li.current_page_item > a, ul#top-menu > li:hover > a, ul.nav > li.current-cat > a { color: #<?php echo esc_html(get_option($shortname.'_color_pagelink_active')); ?>; }
		h1, h2, h3, h4, h5, h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a { color: #<?php echo esc_html(get_option($shortname.'_color_headings')); ?>; }

		#sidebar a { color:#<?php echo esc_html(get_option($shortname.'_color_sidebar_links')); ?>; }
		div#footer { color:#<?php echo esc_html(get_option($shortname.'_footer_text')); ?> }
		#footer a, ul#bottom-menu li a { color:#<?php echo esc_html(get_option($shortname.'_color_footerlinks')); ?> }
	</style>

<?php }

add_action( 'wp_enqueue_scripts', 'et_envisioned_load_scripts_styles' );
function et_envisioned_load_scripts_styles(){
	global $shortname;

	$et_prefix = ! et_options_stored_in_one_row() ? "{$shortname}_" : '';
	$heading_font_option_name = "{$et_prefix}heading_font";
	$body_font_option_name = "{$et_prefix}body_font";

	$et_gf_enqueue_fonts = array();
	$et_gf_heading_font = sanitize_text_field( et_get_option( $heading_font_option_name, 'none' ) );
	$et_gf_body_font = sanitize_text_field( et_get_option( $body_font_option_name, 'none' ) );

	if ( 'none' != $et_gf_heading_font ) $et_gf_enqueue_fonts[] = $et_gf_heading_font;
	if ( 'none' != $et_gf_body_font ) $et_gf_enqueue_fonts[] = $et_gf_body_font;

	if ( ! empty( $et_gf_enqueue_fonts ) ) et_gf_enqueue_fonts( $et_gf_enqueue_fonts );
}

if ( function_exists( 'get_custom_header' ) ) {
	// compatibility with versions of WordPress prior to 3.4

	add_action( 'customize_register', 'et_envisioned_customize_register' );
	function et_envisioned_customize_register( $wp_customize ) {
		$google_fonts = et_get_google_fonts();

		$font_choices = array();
		$font_choices['none'] = 'Default Theme Font';
		foreach ( $google_fonts as $google_font_name => $google_font_properties ) {
			$font_choices[ $google_font_name ] = $google_font_name;
		}

		$wp_customize->remove_section( 'title_tagline' );
		$wp_customize->remove_section( 'background_image' );
		$wp_customize->remove_section( 'colors' );

		$wp_customize->add_section( 'et_google_fonts' , array(
			'title'		=> __( 'Fonts', 'Envisioned' ),
			'priority'	=> 50,
		) );

		$wp_customize->add_setting( 'envisioned_heading_font', array(
			'default'		    => 'none',
			'type'			    => 'option',
			'capability'	    => 'edit_theme_options',
			'sanitize_callback' => 'et_sanitize_font_choices',
		) );

		$wp_customize->add_control( 'envisioned_heading_font', array(
			'label'		=> __( 'Header Font', 'Envisioned' ),
			'section'	=> 'et_google_fonts',
			'settings'	=> 'envisioned_heading_font',
			'type'		=> 'select',
			'choices'	=> $font_choices
		) );

		$wp_customize->add_setting( 'envisioned_body_font', array(
			'default'		    => 'none',
			'type'			    => 'option',
			'capability'	    => 'edit_theme_options',
			'sanitize_callback' => 'et_sanitize_font_choices',
		) );

		$wp_customize->add_control( 'envisioned_body_font', array(
			'label'		=> __( 'Body Font', 'Envisioned' ),
			'section'	=> 'et_google_fonts',
			'settings'	=> 'envisioned_body_font',
			'type'		=> 'select',
			'choices'	=> $font_choices
		) );
	}

	add_action( 'wp_head', 'et_envisioned_add_customizer_css' );
	add_action( 'customize_controls_print_styles', 'et_envisioned_add_customizer_css' );
	function et_envisioned_add_customizer_css(){ ?>
		<style type="text/css">
		<?php
			global $shortname;

			$et_prefix = ! et_options_stored_in_one_row() ? "{$shortname}_" : '';
			$heading_font_option_name = "{$et_prefix}heading_font";
			$body_font_option_name = "{$et_prefix}body_font";

			$et_gf_heading_font = sanitize_text_field( et_get_option( $heading_font_option_name, 'none' ) );
			$et_gf_body_font = sanitize_text_field( et_get_option( $body_font_option_name, 'none' ) );

			if ( 'none' != $et_gf_heading_font || 'none' != $et_gf_body_font ) :

				if ( 'none' != $et_gf_heading_font )
					et_gf_attach_font( $et_gf_heading_font, 'h1, h2, h3, h4, h5, h6, .service h3.title, #quote-inner p, a.additional-info, h4.widgettitle, h1.category-title, h2.title, h3#comments, .entry h1, .entry h2, .entry h3, .entry h4, .entry h5, .entry h6, h3#reply-title span, .post p.meta-info, #sidebar h4.widgettitle, #featured .description h2, .comment-meta, .wp-pagenavi span, .wp-pagenavi a, .wp-pagenavi span.current' );

				if ( 'none' != $et_gf_body_font )
					et_gf_attach_font( $et_gf_body_font, 'body' );

			endif;
		?>
		</style>
	<?php }

	add_action( 'customize_controls_print_footer_scripts', 'et_load_google_fonts_scripts' );
	function et_load_google_fonts_scripts() {
		wp_enqueue_script( 'et_google_fonts', get_template_directory_uri() . '/epanel/google-fonts/et_google_fonts.js', array( 'jquery' ), '1.0', true );
		wp_localize_script( 'et_google_fonts', 'et_google_fonts', array(
			'options_in_one_row' => ( et_options_stored_in_one_row() ? 1 : 0 )
		) );
	}

	add_action( 'customize_controls_print_styles', 'et_load_google_fonts_styles' );
	function et_load_google_fonts_styles() {
		wp_enqueue_style( 'et_google_fonts_style', get_template_directory_uri() . '/epanel/google-fonts/et_google_fonts.css', array(), null );
	}
}

function et_remove_additional_epanel_styles() {
	return true;
}
add_filter( 'et_epanel_is_divi', 'et_remove_additional_epanel_styles' );

function et_register_updates_component() {
	require_once( get_template_directory() . '/core/updates_init.php' );

	et_core_enable_automatic_updates( get_template_directory_uri(), et_get_theme_version() );
}
add_action( 'admin_init', 'et_register_updates_component' );

if ( ! function_exists( 'et_core_portability_link' ) && ! class_exists( 'ET_Builder_Plugin' ) ) :
function et_core_portability_link() {
	return '';
}
endif;

function et_theme_maybe_load_core() {
	if ( et_core_exists_in_active_plugins() ) {
		return;
	}

	if ( defined( 'ET_CORE' ) ) {
		return;
	}

	require_once get_template_directory() . '/core/init.php';

	et_core_setup( get_template_directory_uri() );
}
add_action( 'after_setup_theme', 'et_theme_maybe_load_core' );

