<?php
/* Plugin Name: MapImageWidget
Plugin URI: pelloponisos.telesto.gr
Description: Displays The Slogan If we are in the Home Page otherwise the article\'s image
Version: 1.0
Author: Spyros Gasteratos
Author URI: 
*/
 
define( 'PATH', dirname( __FILE__ ));
class experienceGalleryWidget extends WP_Widget
{
  function experienceGalleryWidget()
  {
    $widget_ops = array('classname' => 'experienceGalleryWidget', 'description' => 'Displays The experience gallery' );
    $this->WP_Widget('experienceGalleryWidget', 'Experience gallery', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ,'slogan'=>'','slogan2'=>'') );
    if($instance)
		$lang = $instance['lang'];
    else
		$lang = 'en';
?>
<p>
			<label for="<?php echo $this->get_field_id('lang');?>"><?php _e('Language:'); ?></label> 
			<select class="widefat" id="<?php echo $this->get_field_id('lang');?>" name="<?php echo $this->get_field_name('lang');?>" type="radio">
				<option value='<?php if($lang == "en"):?>en<?php else:?>gr<?php endif?>'><?php if($lang == "en"):?><?php _e('English'); ?><?php else:?><?php _e('Greek'); ?><?php endif?></option>
				<option value='<?php if($lang == "en"):?>gr<?php else:?>en<?php endif?>'><?php if($lang == "en"):?><?php _e('Greek'); ?><?php else:?><?php _e('English'); ?><?php endif?></option>
			</select>
		</p>
<?php
  }
 
 function update( $new_instance, $old_instance ) {
		return $new_instance;
	}
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    echo $before_widget;
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
     // WIDGET CODE GOES HERE
	include(PATH."/galleryTest/gallery.php");
	print_gallery($instance['lang']);
	
  }

 

}
add_action( 'widgets_init', create_function('', 'return register_widget("experienceGalleryWidget");') );?>
