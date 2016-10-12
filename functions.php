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
	wp_enqueue_style( 'buffalo-covenant-theme-style', get_stylesheet_uri() );

	wp_enqueue_script( 'buffalo-covenant-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'buffalo-covenant-theme-base', get_template_directory_uri() . '/js/bcc.js', array( 'jquery' ), '20161011', true);

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
    $wp_customize->add_section( 'header_logo_section_name' , array(
        'title'    => __( 'Header Logos', 'buffalo-covenant-theme' ),
        'priority' => 60
    ) );   

    $wp_customize->add_setting( 'header_video_mp4');
    $wp_customize->add_setting( 'header_video_webm');
    $wp_customize->add_setting( 'header_video_ogv');
    $wp_customize->add_setting( 'header_video_poster');
    $wp_customize->add_setting( 'header_dark_logo');
    $wp_customize->add_setting( 'header_light_logo');

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
			echo '<div class="home-title-footer">' . $instance[ 'home_title_footer' ] . '</div>';
			
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

?>