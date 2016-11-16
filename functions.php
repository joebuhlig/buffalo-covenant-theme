<?php
/**
 * Buffalo Covenant Theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Buffalo_Covenant_Theme
 */

if ( ! function_exists( 'buffalo_covenant_theme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function buffalo_covenant_theme_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Buffalo Covenant Theme, use a find and replace
	 * to change 'buffalo-covenant-theme' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'buffalo-covenant-theme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'buffalo-covenant-theme' ),
		'mobile' => esc_html__('Mobile', 'buffalo-covenant-theme'),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'buffalo_covenant_theme_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'buffalo_covenant_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function buffalo_covenant_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'buffalo_covenant_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'buffalo_covenant_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function buffalo_covenant_theme_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Home Title', 'buffalo-covenant-theme' ),
		'id'            => 'home-title-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'buffalo-covenant-theme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Home Featured Events', 'buffalo-covenant-theme' ),
		'id'            => 'home-featured-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'buffalo-covenant-theme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'buffalo-covenant-theme' ),
		'id'            => 'footer-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'buffalo-covenant-theme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Pages Sidebar', 'buffalo-covenant-theme' ),
		'id'            => 'pages-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'buffalo-covenant-theme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'buffalo_covenant_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function buffalo_covenant_theme_scripts() {
	wp_enqueue_style( 'buffalo-covenant-theme-style', get_stylesheet_uri(), '', '1.0.70' );

	wp_enqueue_script( 'buffalo-covenant-theme-base', get_template_directory_uri() . '/js/bcc.js', array( 'jquery' ), '20161116', true);

	wp_enqueue_script( 'buffalo-covenant-theme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'buffalo_covenant_theme_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

function bcc_customize_register( $wp_customize ) {
   $wp_customize->add_section( 'header_video_section_name' , array(
        'title'    => __( 'Header Video', 'buffalo-covenant-theme' ),
        'priority' => 50
    ) );   
    $wp_customize->add_section( 'default_page_header_section_name' , array(
        'title'    => __( 'Default Page Header', 'buffalo-covenant-theme' ),
        'priority' => 55
    ) );  
    $wp_customize->add_section( 'header_logo_section_name' , array(
        'title'    => __( 'Header Logos', 'buffalo-covenant-theme' ),
        'priority' => 60
    ) );   
    $wp_customize->add_section( 'sermon_logo_section_name' , array(
        'title'    => __( 'Sermon Logo', 'buffalo-covenant-theme' ),
        'priority' => 70
    ) ); 

    $wp_customize->add_setting( 'header_video_mp4');
    $wp_customize->add_setting( 'header_video_webm');
    $wp_customize->add_setting( 'header_video_ogv');
    $wp_customize->add_setting( 'header_video_poster');
    $wp_customize->add_setting( 'header_mobile_poster');
    $wp_customize->add_setting( 'default_page_header');
    $wp_customize->add_setting( 'header_dark_logo');
    $wp_customize->add_setting( 'header_light_logo');
    $wp_customize->add_setting( 'default_sermon_logo');

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'header_video_mp4', array(
        'label'    => __( 'Header Video MP4', 'buffalo-covenant-theme' ),
        'section'  => 'header_video_section_name',
        'settings' => 'header_video_mp4',
    ) ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'header_video_webm', array(
        'label'    => __( 'Header Video WEBM', 'buffalo-covenant-theme' ),
        'section'  => 'header_video_section_name',
        'settings' => 'header_video_webm',
    ) ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'header_video_ogv', array(
        'label'    => __( 'Header Video OGV', 'buffalo-covenant-theme' ),
        'section'  => 'header_video_section_name',
        'settings' => 'header_video_ogv',
    ) ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'header_video_poster', array(
        'label'    => __( 'Header Video Poster', 'buffalo-covenant-theme' ),
        'section'  => 'header_video_section_name',
        'settings' => 'header_video_poster',
    ) ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'header_mobile_poster', array(
        'label'    => __( 'Header Mobile Poster', 'buffalo-covenant-theme' ),
        'section'  => 'header_video_section_name',
        'settings' => 'header_mobile_poster',
    ) ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'default_page_header', array(
        'label'    => __( 'Default Page Header', 'buffalo-covenant-theme' ),
        'section'  => 'default_page_header_section_name',
        'settings' => 'default_page_header',
    ) ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'header_dark_logo', array(
        'label'    => __( 'Header Dark Logo', 'buffalo-covenant-theme' ),
        'section'  => 'header_logo_section_name',
        'settings' => 'header_dark_logo',
    ) ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'header_light_logo', array(
        'label'    => __( 'Header Light Logo', 'buffalo-covenant-theme' ),
        'section'  => 'header_logo_section_name',
        'settings' => 'header_light_logo',
    ) ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'default_sermon_logo', array(
        'label'    => __( 'Default Sermon Logo', 'buffalo-covenant-theme' ),
        'section'  => 'sermon_logo_section_name',
        'settings' => 'default_sermon_logo',
    ) ) );
}
add_action( 'customize_register', 'bcc_customize_register' );

function addUploadMimes($mimes) {
    $mimes['webm'] = 'video/webm';
	$mimes['ogv'] = 'video/ogv';    
    return $mimes;
}
add_filter('mime_types', 'addUploadMimes');

add_action( 'widgets_init', function(){
     register_widget( 'Home_Title_Widget' );
});	

function get_latest_sermon(){
	$sermons = new WP_Query( array(
	    'post_type' => 'sermon',
        'posts_per_page' => 1
    ) );
	$speaker = get_the_terms( $sermons->posts[0], 'speakers');
	$series = get_the_terms( $sermons->posts[0], 'series');
	if ($series){
		$posts_array = get_posts(
		    array(
		        'posts_per_page' => -1,
		        'post_type' => 'attachment',
		        'tax_query' => array(
		            array(
		                'taxonomy' => 'series',
		                'field' => 'term_id',
		                'terms' => wp_list_pluck( $series, 'term_id' ),
		            )
		        )
		    )
		);
		$thumb_src = $posts_array[0]->guid;
		$sermon['thumb_src'] = $thumb_src;
	};
    $title = $sermons->posts[0]->post_title;
	$date = date("F j" , strtotime($sermons->posts[0]->post_date));
	$link = "/sermons/" . $sermons->posts[0]->post_name . "?autoplay=true";
	$sermon['title'] = $title;
	$sermon['date'] = $date;
	$sermon['link'] = $link;
	if ($speaker){
		$sermon['speaker'] = $speaker[0]->name;
	}
	else {
		$sermon['speaker'] = null;
	};
	return $sermon;
}

function get_podcast_episode($guid){
	$location = 'http://buffalocov.libsyn.com/rss';
	$xml = simplexml_load_file($location);
	$items = $xml->xpath('channel/item');
	$episode = [];
	if ($guid == "latest"){
		$item = $items[0];
		$link = $item->link;
		$episode["title"] = $item->title;
		$episode["description"] = $item->description;
		$url = explode('?', $item->enclosure["url"]);
		$url = reset($url);
		$episode["link"] = $url;
	}
	else {
		foreach($items as $item) {
			$link = $item->link;
			if ($item->guid == $guid) {
				$episode["title"] = $item->title;
				$episode["description"] = $item->description;
				$url = explode('?', $item->enclosure["url"]);
				$url = reset($url);
				$episode["link"] = $url;
			}
		}
	};
	return $episode;
}

function add_search_nav_item($items) {
  $items .= '<li id="search-menu-item"><a href="#"><svg x="0px" y="0px" viewBox="0 0 451 451"><path d="M447.05,428l-109.6-109.6c29.4-33.8,47.2-77.9,47.2-126.1C384.65,86.2,298.35,0,192.35,0C86.25,0,0.05,86.3,0.05,192.3   s86.3,192.3,192.3,192.3c48.2,0,92.3-17.8,126.1-47.2L428.05,447c2.6,2.6,6.1,4,9.5,4s6.9-1.3,9.5-4   C452.25,441.8,452.25,433.2,447.05,428z M26.95,192.3c0-91.2,74.2-165.3,165.3-165.3c91.2,0,165.3,74.2,165.3,165.3   s-74.1,165.4-165.3,165.4C101.15,357.7,26.95,283.5,26.95,192.3z"/></svg></a></li>';
  return $items .= '<li id="search-menu-item-form"><form role="search" method="get" class="search-form" action="/"><label><span class="screen-reader-text">Search for:</span><input type="search" class="search-field" placeholder="Search …" value="" name="s"></label><input type="submit" class="search-submit" value="Search"></form></li>';
}
add_filter('wp_nav_menu_items','add_search_nav_item');

function custom_tribe_events_get_this_week_title( $start_date ) {
	$this_week_title = sprintf( __( 'Week of %s', 'tribe-events-calendar-pro' ),
		date_i18n( "F j", strtotime( $start_date ) )
	);

	return $this_week_title;
}

/**
 * Adds My_Widget widget.
 */
class Home_Title_Widget extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'Home_Title_Widget', // Base ID
			__('Home Title Widget', 'text_domain'), // Name
			array('description' => __( 'Adds text on top of home video.', 'text_domain' ),) // Args
		);
	}
	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
				
		if ( array_key_exists('before_widget', $args) ) echo $args['before_widget'];
		
			echo '<div class="home-title-large">' . $instance[ 'home_title_large' ] . '</div>';
			echo '<div class="home-title-subtext">' . $instance[ 'home_title_subtext' ] . '</div>';
			echo '<div class="home-title-button"><a href="' . $instance[ 'home_title_button_link' ] . '">' . $instance[ 'home_title_button' ] . '</a></div>';
			echo '<div class="home-title-footer"><a href="/map">' . $instance[ 'home_title_footer' ] . '</a></div>';
			
		if ( array_key_exists('after_widget', $args) ) echo $args['after_widget'];
	}
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		
		if ( isset( $instance[ 'home_title_large' ] ) ) {
			$home_title_large = $instance[ 'home_title_large' ];
		}
		else {
			$home_title_large = "";
		}

		if ( isset( $instance[ 'home_title_subtext' ] ) ) {
			$home_title_subtext = $instance[ 'home_title_subtext' ];
		}
		else {
			$home_title_subtext = "";
		}

		if ( isset( $instance[ 'home_title_button' ] ) ) {
			$home_title_button = $instance[ 'home_title_button' ];
		}
		else {
			$home_title_button = "";
		}

		if ( isset( $instance[ 'home_title_button_link' ] ) ) {
			$home_title_button_link = $instance[ 'home_title_button_link' ];
		}
		else {
			$home_title_button_link = "";
		}	

		if ( isset( $instance[ 'home_title_footer' ] ) ) {
			$home_title_footer = $instance[ 'home_title_footer' ];
		}
		else {
			$home_title_footer = "";
		}
		?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'home_title_large' ); ?>"><?php _e( 'Home Title Large:' ); ?></label> 
			
			<input id="<?php echo $this->get_field_id( 'home_title_large' ); ?>" type="text" name="<?php echo $this->get_field_name( 'home_title_large' ); ?>" value="<?php echo $instance[ 'home_title_large' ] ?>"><br>

			<label for="<?php echo $this->get_field_id( 'home_title_subtext' ); ?>"><?php _e( 'Home Title Subtext:' ); ?></label> 
			
			<input id="<?php echo $this->get_field_id( 'home_title_subtext' ); ?>" type="text" name="<?php echo $this->get_field_name( 'home_title_subtext' ); ?>" value="<?php echo $instance[ 'home_title_subtext' ] ?>"><br>

			<label for="<?php echo $this->get_field_id( 'home_title_button' ); ?>"><?php _e( 'Home Title Button:' ); ?></label> 
			
			<input id="<?php echo $this->get_field_id( 'home_title_button' ); ?>" type="text" name="<?php echo $this->get_field_name( 'home_title_button' ); ?>" value="<?php echo $instance[ 'home_title_button' ] ?>"><br>

			<label for="<?php echo $this->get_field_id( 'home_title_button_link' ); ?>"><?php _e( 'Home Title Button Link:' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'home_title_button_link' ); ?>" type="text" name="<?php echo $this->get_field_name( 'home_title_button_link' ); ?>" value="<?php echo $instance[ 'home_title_button_link' ] ?>"><br>

			<label for="<?php echo $this->get_field_id( 'home_title_footer' ); ?>"><?php _e( 'Home Title Footer:' ); ?></label> 
			
			<input id="<?php echo $this->get_field_id( 'home_title_footer' ); ?>" type="text" name="<?php echo $this->get_field_name( 'home_title_footer' ); ?>" value="<?php echo $instance[ 'home_title_footer' ] ?>">
		</p>
		<?php 
	}
	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		
		$instance = array();
		$instance['home_title_large'] = ( ! empty( $new_instance['home_title_large'] ) ) ? strip_tags( $new_instance['home_title_large'] ) : '';
		$instance['home_title_subtext'] = ( ! empty( $new_instance['home_title_subtext'] ) ) ? strip_tags( $new_instance['home_title_subtext'] ) : '';
		$instance['home_title_button'] = ( ! empty( $new_instance['home_title_button'] ) ) ? strip_tags( $new_instance['home_title_button'] ) : '';
		$instance['home_title_button_link'] = ( ! empty( $new_instance['home_title_button_link'] ) ) ? strip_tags( $new_instance['home_title_button_link'] ) : '';
		$instance['home_title_footer'] = ( ! empty( $new_instance['home_title_footer'] ) ) ? strip_tags( $new_instance['home_title_footer'] ) : '';
		return $instance;
	}
} // class My_Widget

//Page Slug Body Class
function add_slug_body_class( $classes ) {
global $post;
if ( isset( $post ) ) {
$classes[] = $post->post_type . '-' . $post->post_name;
}
return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );

function staff_members_func( $atts ){
    $a = shortcode_atts( array(
        'role' => 'staff'
    ), $atts );

	$args = array('post_type' => 'staff',
        'order' => 'ASC',
        'orderby' => 'menu_order',
        'tax_query' => array(
		array(
			'taxonomy' => 'staff-roles',
			'field'    => 'slug',
			'terms'    => $a['role'],
		),
	),
        'posts_per_page' => 1000
     );
	$term = get_term_by('slug', $a['role'], 'staff-roles');
	echo '<h2>' . $term->name . '</h2>';
     $loop = new WP_Query($args);
     if($loop->have_posts()){
     	echo '<div class="staff-group">';
     		while($loop->have_posts()) : $loop->the_post();
     			get_template_part( 'template-parts/content', 'staff' );
		    endwhile;
		echo '</div>';
     }
}
add_shortcode( 'staff', 'staff_members_func' );

function tile_func( $atts ){
    $a = shortcode_atts( array(
        'image' => '',
        'title' => 'Blank',
        'link' => '/'
    ), $atts );
    $result = "";
	$result .= '<div class="page-tile">';
    $result .= '<a href="'  . $a['link'] . '" >';
	$result .= '<img class="grayscale" src="' . $a['image'] . '" >';
	$result .= '<div class="page-tile-title">' . $a['title'] . '</div>';
	$result .= '</a>';
	$result .= '</div>';
	return $result;
}
add_shortcode( 'tile', 'tile_func');

function custom_tribe_events_this_week_previous_link( $start_date, $text = '' ) {

	if ( empty( $text ) ) {
		$text = __( '<span class="dashicons dashicons-arrow-left-alt2"></span>', 'tribe-events-calendar-pro' );
	}

	$attributes = sprintf( ' data-week="%s" ', date( Tribe__Date_Utils::DBDATEFORMAT, strtotime( $start_date . ' -7 days' ) ) );

	return sprintf( '<a %s href="#" rel="prev">%s</a>', $attributes, $text );

}

function custom_tribe_events_this_week_next_link( $start_date, $text = '' ) {

	if ( empty( $text ) ) {
		$text = __( '<span class="dashicons dashicons-arrow-right-alt2"></span>', 'tribe-events-calendar-pro' );
	}

	$attributes = sprintf( ' data-week="%s" ', $start_date );

	return sprintf( '<a %s href="#" rel="next">%s</a>', $attributes, $text );

}
?>