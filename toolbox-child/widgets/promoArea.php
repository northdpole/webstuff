<?php
/* Plugin Name: MapImageWidget
Plugin URI: pelloponisos.telesto.gr
Description: Displays The Slogan If we are in the Home Page otherwise the article\'s image
Version: 1.0
Author: Spyros Gasteratos
Author URI: 
*/
 
define( 'PATH', dirname( __FILE__ ));
class MapImageWidget extends WP_Widget
{
  function MapImageWidget()
  {
    $widget_ops = array('classname' => 'MapImageWidget', 'description' => 'Displays The Slogan If we are in the Home Page otherwise the article\'s image' );
    $this->WP_Widget('MapImageWidget', 'Map and Image/Slogan', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ,'slogan'=>'','slogan2'=>'') );
    $title = $instance['title'];
    $slogan = $instance['slogan'];
    $sec_slogan = $instance['slogan2'];
    $lang = $instance['lang'];
    
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
  <p><label for="<?php echo $this->get_field_id('slogan'); ?>">Promotional Slogan: <input class="widefat" id="<?php echo $this->get_field_id('slogan'); ?>" name="<?php echo $this->get_field_name('slogan'); ?>" type="text" value="<?php echo esc_attr($slogan); ?>" /></label></p>
   <p><label for="<?php echo $this->get_field_id('slogan2'); ?>">Secondary Slogan: <input class="widefat" id="<?php echo $this->get_field_id('slogan2'); ?>" name="<?php echo $this->get_field_name('slogan2'); ?>" type="text" value="<?php echo esc_attr($sec_slogan); ?>" /></label></p>

<p>
  <label for="<?php echo $this->get_field_id('lang');?>"><?php _e('Language:'); ?></label>
  <select class="widefat" id="<?php echo $this->get_field_id('lang');?>" name="<?php echo $this->get_field_name('lang');?>" type="radio">
    <option value='<?php if($lang == "en"):?>en<?php else:?>gr<?php endif?>'><?php if($lang == "en"):?><?php _e('English'); ?><?php else:?><?php _e('Greek'); ?><?php endif?></option>
    <option value='<?php if($lang == "en"):?>gr<?php else:?>en<?php endif?>'><?php if($lang == "en"):?><?php _e('Greek'); ?><?php else:?><?php _e('English'); ?><?php endif?></option>
  </select>
</p>

<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    $instance['slogan'] = $new_instance['slogan'];
    $instance['slogan2'] = $new_instance['slogan2'];
    return $new_instance;
  }
  


public static function echo_first_image ($postID)
	{					
	$args = array(
	'numberposts' => 1,
	'order'=> 'ASC',
	'post_mime_type' => 'image',
	'post_parent' => $postID,
	'post_status' => null,
	'post_type' => 'attachment'
	);
	
	$attachments = get_children( $args );
	
	//print_r($attachments);
	
	if ($attachments) {
		foreach($attachments as $attachment) {
			$image_attributes = wp_get_attachment_image_src( $attachment->ID, 'thumbnail' )  ? wp_get_attachment_image_src( $attachment->ID, 'thumbnail' ) : wp_get_attachment_image_src( $attachment->ID, 'full' );
				
			echo '<img src="'.wp_get_attachment_thumb_url( $attachment->ID ).'" class="current">';
			
		}
	}
}
 
  function widget($args, $instance)
  {
    global $pagename;
    extract($args, EXTR_SKIP);
 
    echo $before_widget;
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
    $slogan = $instance['slogan'];
    $sec_slogan = $instance['slogan2'];
     // WIDGET CODE GOES HERE
     echo "<div id=\"head-area\">";
     if("facts" != $pagename){
		include(PATH."/mapTest/index.php");
		map_pro($instance['lang']);
	}
	//Display the slogan in the front page
	if(is_front_page() || "homepage"===$pagename){
		  if (!empty($title))
		echo $before_title . $title . $after_title;		
	?>
			<div id="promo-wrapper">
				<span id="promo">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/slogan.png" alt="leslogan"/>
					<!--<h1><?php echo $slogan;?></h1>
					<h3><?php echo $sec_slogan;?></h3>-->
				<span>
			</div>
	<?php
	}elseif("live"===$pagename){
	?>
	<span id="promo-live">
	<ul id="promo-live-ul">
		<li>
      <?php if($instance['lang'] == 'gr') {?>
      <a STYLE="text-decoration:none" href="<?php get_site_url(); ?>/blog/περιοχές/">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/image01.jpg"/>
        <span class="live-promo-caption">
          <p>
            Περιοχές
          </p>
        </span>
      </a>
      <?php }else{?>
      <a STYLE="text-decoration:none" href="<?php get_site_url(); ?>/en/territories/">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/image01.jpg"/>
        <span class="live-promo-caption">
          <p>
            Territories
          </p>
        </span>
      </a>
      <?php } ?>
		</li>
		<li>
      <?php if($instance['lang'] == 'gr') {?>
      <a STYLE="text-decoration:none" href="<?php get_site_url(); ?>/blog/πόλεις/">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/image02.jpg"/>
        <span class="live-promo-caption">
          <p>
            Πόλεις
          </p>
        </span>
      </a>
      <?php }else{?>
      <a STYLE="text-decoration:none" href="<?php get_site_url(); ?>/en/cities/">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/image02.jpg"/>
        <span class="live-promo-caption">
          <p>
            Cities
          </p>
        </span>
      </a>
      <?php } ?>
		</li>
		<li>
      <?php if($instance['lang'] == 'gr') {?>
      <a STYLE="text-decoration:none" href="<?php get_site_url(); ?>/blog/αξιοθέατα/">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/image03.jpg"/>
        <span class="live-promo-caption">
          <p>
            Αξιοθέατα
          </p>
        </span>
      </a>
      <?php }else{?>
      <a STYLE="text-decoration:none" href="<?php get_site_url(); ?>/en/iconic-places/">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/image03.jpg"/>
        <span class="live-promo-caption">
          <p>
            Iconic Places
          </p>
        </span>
      </a>
      <?php } ?>
		</li>
	</ul>
	</span>
	<?php
	}elseif("facts"=== $pagename){
		include(PATH."/facts.php");
    facts($instance['lang']);
	}else{?>
	<span id="banner-promo">
	<?php
	add_banner();
	?>
	</span>
	<?php
	}
	echo "</div>";
	echo $after_widget;
  }

 

}

add_action( 'widgets_init', create_function('', 'return register_widget("MapImageWidget");') );?>
