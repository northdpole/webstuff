<?php
require_once( get_stylesheet_directory(). '/../toolbox/functions.php' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'custom-background');
define( 'SEARCHPATH', dirname( __FILE__ ));
/**
 * Register widgetized area and update sidebar with default widgets
 */
function toolbox_child_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Search/PressKit', 'toolbox' ),
		'id' => 'sidebar-1',
		'description' => __( 'The Footer Menu', 'toolbox' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	) );
	register_sidebar( array(
		'name' => __( 'Map_and_Promo/Image', 'toolbox' ),
		'id' => 'sidebar-3',
		'description' => __( 'The area where the map widget and promo appears', 'toolbox' ),
		'before_widget' => '<div class="map"><aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside></div>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	register_sidebar( array(
		'name' => __( 'Main Menu', 'toolbox' ),
		'id' => 'sidebar-4',
		'description' => __( 'The Main Menu', 'toolbox' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	) );
	register_sidebar( array(
		'name' => __( 'Footer Menu', 'toolbox' ),
		'id' => 'sidebar-5',
		'description' => __( 'The Footer Menu', 'toolbox' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	) );
}
add_action( 'init', 'toolbox_child_widgets_init');

include("widgets/promoArea.php");
include("widgets/banner-per-page.php");
include("widgets/gallery.php");


function toolbox_child_widget_search($args) {
		extract($args);
		//echo $before_widget;
		//echo $before_title;
		_e("");
		//echo $after_title;
		include (SEARCHPATH.'/searchform.php');
		//echo $after_widget;
	}
$widgetOptions = array('classname' => 'widget_search', 'description' => __( "A custom search form for your blog"));
wp_register_sidebar_widget('search',__('Search'),'toolbox_child_widget_search',$widgetOptions);


function SearchFilter($query) {
if ($query->is_search) {
$query->set('post_type', 'post');
}
return $query;
}

add_filter('pre_get_posts','SearchFilter');

function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function security_remove_emails($content) {
    $pattern = '/([a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4})/i';
    $fix = preg_replace_callback($pattern,"security_remove_emails_logic", $content);
    return $fix;
}
function security_remove_emails_logic($result) {
    return antispambot($result[1]);
}
add_filter( 'the_content', 'security_remove_emails', 20 );
add_filter( 'widget_text', 'security_remove_emails', 20 );
add_filter('the_content', 'my_addlightboxrel');

function my_addlightboxrel($content) {
       global $post;
       $pattern ="/<a(.*?)href=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>/i";
       $replacement = '<a$1href=$2$3.$4$5 rel="lytebox" title="'.$post->post_title.'"$6>';
       $content = preg_replace($pattern, $replacement, $content);
       return $content;
}

@ini_set( 'upload_max_size' , '20M' );
@ini_set( 'post_max_size', '20M');
@ini_set( 'max_execution_time', '300' );
?>
