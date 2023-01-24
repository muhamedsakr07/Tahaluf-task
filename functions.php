<?php
/**
 * tahaluf-task functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package tahaluf-task
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.6' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function tahaluf_task_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on tahaluf-task, use a find and replace
		* to change 'tahaluf-task' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'tahaluf-task', get_template_directory() . '/languages' );

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
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'tahaluf-task' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'tahaluf_task_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'tahaluf_task_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function tahaluf_task_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'tahaluf_task_content_width', 640 );
}
add_action( 'after_setup_theme', 'tahaluf_task_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function tahaluf_task_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'tahaluf-task' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'tahaluf-task' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'tahaluf_task_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function tahaluf_task_scripts() {
	wp_enqueue_style( 'tahaluf-task-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'tahaluf-task-style', 'rtl', 'replace' );

	wp_enqueue_script( 'tahaluf-task-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	
	  wp_enqueue_style( 'main-style', get_stylesheet_directory_uri() . '/css/jquery-ui.css', [], time(), 'all' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'tahaluf_task_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

function wpdocs_custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

add_action( 'wp_enqueue_scripts', 'add_my_script' );

function add_my_script() {
    wp_enqueue_script(
        'your-script', // name your script so that you can attach other scripts and de-register, etc.
        get_template_directory_uri() . '/js/main.js', // this is the location of your script file
        array('jquery') // this array lists the scripts upon which your script depends
    );
    wp_enqueue_script(
        'your-script', // name your script so that you can attach other scripts and de-register, etc.
        get_template_directory_uri() . '/js/jquery-ui.js', // this is the location of your script file
        array('jquery') // this array lists the scripts upon which your script depends
    );
    wp_enqueue_script(
        'your-script', // name your script so that you can attach other scripts and de-register, etc.
        get_template_directory_uri() . '/js/jquery-3.6.0.js', // this is the location of your script file
        array('jquery') // this array lists the scripts upon which your script depends
    );
    
    
}

function tahaluf_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'tahaluf_content_width', 1290 );
}
add_action( 'after_setup_theme', 'tahaluf_content_width', 0 );

function tahaluf_get_post_excerpt( $limit, $post = null ) {
    $excerpt = explode( ' ', get_the_excerpt( $post ), $limit );
    if( count( $excerpt ) >= $limit ) {
        array_pop( $excerpt );
        $excerpt = implode( ' ', $excerpt );
    } else {
        $excerpt = implode( ' ', $excerpt );
    }
    $excerpt = preg_replace( '`\[[^\]]*\]`', '', $excerpt );

    return sprintf( '<span>%s</span>', esc_html( $excerpt ) );
}

function weichie_load_more() {
  $ajaxposts = new WP_Query([
    'post_type' => 'post',
    'posts_per_page' => -1,
    'orderby' => 'date',
    'order' => 'ASC',
    'paged' =>$_POST['paged'],
  ]);

  $response = '';

  if($ajaxposts->have_posts()) {
    while($ajaxposts->have_posts()) : $ajaxposts->the_post();
      $response .= get_template_part( 'template-parts/blog-grid' );
    endwhile;
  } else {
    $response = '';
  }

  echo $response;
  exit;
}
add_action('wp_ajax_weichie_load_more', 'weichie_load_more');
add_action('wp_ajax_nopriv_weichie_load_more', 'weichie_load_more');

function the_breadcrumb() {

    $sep = ' > ';

    if (!is_front_page()) {
	
	// Start the breadcrumb with a link to your homepage
        echo '<div class="breadcrumbs">';
        echo '<a href="';
        echo get_option('home');
        echo '">';
        bloginfo('name');
        echo '</a>' . $sep;
	
	// Check if the current page is a category, an archive or a single page. If so show the category or archive name.
        if (is_category() || is_single() ){
            the_category('title_li=');
        } elseif (is_archive() || is_single()){
            if ( is_day() ) {
                printf( __( '%s', 'text_domain' ), get_the_date() );
            } elseif ( is_month() ) {
                printf( __( '%s', 'text_domain' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'text_domain' ) ) );
            } elseif ( is_year() ) {
                printf( __( '%s', 'text_domain' ), get_the_date( _x( 'Y', 'yearly archives date format', 'text_domain' ) ) );
            } else {
                _e( 'Blog Archives', 'text_domain' );
            }
        }
	
	// If the current page is a single post, show its title with the separator
        if (is_single()) {
            echo $sep;
            the_title();
        }
	
	// If the current page is a static page, show its title.
        if (is_page()) {
            echo the_title();
        }
	
	// if you have a static page assigned to be you posts list page. It will find the title of the static page and display it. i.e Home >> Blog
        if (is_home()){
            global $post;
            $page_for_posts_id = get_option('page_for_posts');
            if ( $page_for_posts_id ) { 
                $post = get_post($page_for_posts_id);
                setup_postdata($post);
                the_title();
                rewind_posts();
            }
        }

        echo '</div>';
    }
}

?>
