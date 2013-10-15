<?php /*
Plugin Name: banner Per Page
Plugin URI: http://fishcantwhistle.com
Author: Fish Can't Whistle
Version: 0.3
*/

//if (!defined("BPP_url")) { define("BPP_url", WP_PLUGIN_URL.'/banner-per-page'); } //NO TRAILING SLASH

//if (!defined("BPP_dir")) { define("BPP_dir", WP_PLUGIN_DIR.'/banner-per-page'); } //NO TRAILING SLASH

//include_once('meta-boxes/meta-box.php');

include_once('admin-page.php');
$prefix = '_banner_';

global $meta_boxes_banner_banner;

$meta_boxes_banner = array();

$meta_boxes_banner[] = array(
	'id' => 'banner',

	'title' => 'banner',

	'pages' => array( 'post', 'page'),//'pages' => array( 'post', 'page', 'bpp_settings'),

	'context' => 'normal',

	'priority' => 'high',

	'fields' => array(
		array(
			'name'		=> 'Element',
			'id'		=> "{$prefix}element",
			'type'		=> 'radio',
			'options'	=> array(
				'body'			=> 'body',
				'html'			=> 'html',
				'.page_content' => '.page_content',
				'.post_content' => '.post_content',
			),
			'std'		=> 'body',
			'desc'		=> 'Which element to apply the banner to?'
		),
		array(
			'name'	=> 'banner Image',
			'desc'	=> 'Upload the image you would like to use as the banner for this page/post.',
			'id'	=> "{$prefix}banner",
			'type'	=> 'plupload_image',
			'max_file_uploads' => 1,
		),
		array(
			'name'		=> 'Repeat-x?',
			'id'		=> "{$prefix}repeat-x",
			'type'		=> 'radio',
			'options'	=> array(
				'yes'			=> 'Yes',
				'no'			=> 'No'
			),
			'std'		=> 'yes',
			'desc'		=> 'Repeat this image on horizontaly?'
		),
		array(
			'name'		=> 'Repeat-y?',
			'id'		=> "{$prefix}repeat-y",
			'type'		=> 'radio',
			'options'	=> array(
				'yes'			=> 'Yes',
				'no'			=> 'No'
			),
			'std'		=> 'yes',
			'desc'		=> 'Repeat this image on vertically?'
		),
		array(
			'name'		=> 'Attachment',
			'id'		=> "{$prefix}attachment",
			'type'		=> 'radio',
			'options'	=> array(
				'scroll'		=> 'Scroll',
				'fixed'			=> 'Fixed'
			),
			'std'		=> 'scroll',
			'desc'		=> 'How the banner image reacts to scrolling.'
		),
		array(
			'name'		=> 'Position',
			'id'		=> "{$prefix}position",
			'type'		=> 'radio',
			'options'	=> array(
				'left'			=> 'Left',
				'center'		=> 'Center',
				'right'			=> 'Right'
			),
			'std'		=> 'center',
			'desc'		=> 'The position of the image on the page.'
		),
		array(
			'name'		=> 'Fade?',
			'id'		=> "{$prefix}fade",
			'type'		=> 'radio',
			'options'	=> array(
				'yes'			=> 'Yes',
				'no'			=> 'No'
			),
			'std'		=> 'yes',
			'desc'		=> 'Fade the bottom edge of the image out?'
		),
		array(
			'name'		=> 'Fade Height',
			'id'		=> "{$prefix}fade_height",
			'type'		=> 'text',
			'std'		=> '100',
			'desc'		=> 'How many pixels from the bottom of the image should the fade start from?'
		),
		array(
			'name'		=> 'banner colour',
			'id'		=> "{$prefix}color",
			'type'		=> 'color',
			'desc'		=> 'Use a banner colour as well as or instead of an image.'
		),
	)
);

/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function _banner__register_meta_boxes_banner()
{
	global $meta_boxes_banner;

	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( class_exists( 'RW_Meta_Box' ) )
	{
		foreach ( $meta_boxes_banner as $meta_box )
		{
			new RW_Meta_Box( $meta_box );
		}
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', '_banner__register_meta_boxes_banner' );

function _banner_add_banner_per_page(){

	global $post;
	global $pagename;
	global $wp_query;

	if ( is_home() || is_front_page() ) {
		//load default theme banner
	} elseif ( is_single()  ) {
		$data = _banner_get_data($post->ID, "post" );
		if (("" == $data['src']) && ("Transparent" == $data['color'] ) ){
			$cat = get_the_category( $post->ID );
			$data = _banner_get_data($cat[0]->term_id, "category" );
		}
		//if data has any meaningful value load the banner 
		//else load default theme banner
	} elseif ( isset($pagename) && is_page() ) {
		$data = _banner_get_data( $post->ID, "page" );
		//load the page-specific banner if it exists
		//else logad default theme banner
	} elseif ( is_category() ) {
		$cat_ID = get_query_var('cat');
		$data = _banner_get_data($cat_ID, "category");
		//load the category specific banner
	}

	$element = $data['element'];
	$src_height = $data['src_height'];
	$src_width = $data['src_width'];
	$src = $data['src'];
	$repeat = $data['repeat'];
	$color = $data['color'];
	$position = $data['position'];
	$attachment = $data['attachment'];
	$fade = $data['fade'];
	$fade_height = $data['fade_height'];

	if($fade == 'yes'){ 

		$top = $src_height - $fade_height; ?>
	
		<script type="text/javascript">
			jQuery(document).ready(function(){
				jQuery('<div id="fade"></div>').prependTo( '<?php echo $element; ?>' );
				jQuery('#fade')
					.css('width', jQuery('body').width())
			});
		
		</script>
	
	<?php }

	if($src != '' || $color != 'Transparent'){

		?><style type="text/css">
		
			<?php echo $element; ?>, <?php echo $element; ?>.custom-banner  { 
				<?php if($color != ''){ ?>
					banner-color: <?php echo $color; ?>; 
				<?php } ?>
				<?php if($src != ''){ ?>
					banner-image: url('<?php echo $src; ?>'); 
				<?php } ?>
				<?php if($repeat != ''){ ?>
					banner-repeat: <?php echo $repeat; ?>; 
				<?php } ?>
				<?php if($position != ''){ ?>
					banner-position: <?php echo $position; ?>; 
				<?php } ?>
				<?php if($attachment != ''){ ?>
					banner-attachment: <?php echo $attachment; ?>; 
				<?php } ?>
				
			}
			
			<?php echo $element; ?> > div#fade{ 
				
				position: absolute;
				top: <?php echo $top; ?>px;
				left: 0px;
				height: <?php echo $fade_height; ?>px;
							
				banner-color: rgba(255,255,255,0);
			   	banner-image: none;
			   	banner-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(rgba(255,255,255,0)), to(<?php echo $color; ?>));
			   	banner-image: -webkit-linear-gradient(top, rgba(255,255,255,0), <?php echo $color; ?>);
			   	banner-image:    -moz-linear-gradient(top, rgba(255,255,255,0), <?php echo $color; ?>);
			   	banner-image:     -ms-linear-gradient(top, rgba(255,255,255,0), <?php echo $color; ?>);
			   	banner-image:      -o-linear-gradient(top, rgba(255,255,255,0), <?php echo $color; ?>);
			}
			
		</style><?php

	/*$defaults = array(
	'default-color'          => '',
	'default-image'          => '',
	'wp-head-callback'       => '_custom_banner_cb',
	'admin-head-callback'    => '',
	'admin-preview-callback' => ''
	);
	add_theme_support( 'custom-banner', $defaults );*/
	}

}


function _banner_get_data($id, $type = "post"){

	$element = '';
	$src = '';
	$repeat = '';
	$fade = '';
	$position = '';
	$attachment = '';

	switch ($type) {
    case "post":
		$element = get_post_meta( $id, '_banner_element', true );
		$images = get_post_meta( $id, '_banner_banner', false );
		$x = get_post_meta( $id, '_banner_repeat-x', true );
		$y = get_post_meta( $id, '_banner_repeat-y', true );
		$color = get_post_meta( $id, '_banner_color', true );
		$position = get_post_meta( $id, '_banner_position', true );
		$attachment = get_post_meta( $id, '_banner_attachment', true );
		$fade = get_post_meta( $id, '_banner_fade', true );
		$fade_height = get_post_meta( $id, '_banner_fade_height', true );
        break;
    case "page":
		$element = get_post_meta( $id, '_banner_element', true );
		$images = get_post_meta( $id, '_banner_banner', false );
		$x = get_post_meta( $id, '_banner_repeat-x', true );
		$y = get_post_meta( $id, '_banner_repeat-y', true );
		$color = get_post_meta( $id, '_banner_color', true );
		$position = get_post_meta( $id, '_banner_position', true );
		$attachment = get_post_meta( $id, '_banner_attachment', true );
		$fade = get_post_meta( $id, '_banner_fade', true );
		$fade_height = get_post_meta( $id, '_banner_fade_height', true );
        break;
        //according to the codex pages and posts share meta
    case "category":
	$images = _banner_get_category_banner($id);
	$element = 'body';
        //get fields stored in the db with the key as the catID
        break;
}
	if(is_array($images)){	
		foreach ( $images as $att ){
		    $src = wp_get_attachment_image_src( $att, 'full' );
		    $src_width = $src[1];
		    $src_height = $src[2];
		    $src = $src[0];
		}
	}
	if($x == 'yes' && $y == 'yes'){
		$repeat = 'repeat';
	}elseif($x == 'yes' && $y == 'no'){
		$repeat = 'repeat-x';
	}elseif($y == 'yes' && $x == 'no'){
		$repeat = 'repeat-y';
	}elseif($x == 'no' && $y == 'no'){
		$repeat = 'no-repeat';
	}
	if($color == '#'){
		$color = 'Transparent';
	}

	$data = array();

	$data['element'] = $element;
	$data['src'] = $src;
	$data['src_width'] = $src_width;
	$data['src_height'] = $src_height;
	$data['x'] = $x;
	$data['y'] = $y;
	$data['repeat'] = $repeat;
	$data['position'] = $position;
	$data['attachment'] = $attachment;
	$data['color'] = $color;
	$data['fade'] = $fade;
	$data['fade_height'] = $fade_height;
	return $data;

}

function _banner_add_banner_per_page_ret(){
	global $post;
	$data = _banner_get_data( $post->ID, "page" );
	$src = $data['src'];
	$img = $src;
	if($img == "")
	$img = plugin_dir_url(__FILE__)."image_sl_03.png";
	$ret = "<img src=\"".$img."\"alt=\"banner-img\"/>";
	return $ret;
}
add_action( 'wp_head', '_banner_add_banner_per_page', 999998 );
?>
