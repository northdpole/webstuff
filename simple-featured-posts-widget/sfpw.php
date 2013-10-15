<?php
/*
Plugin Name: sfpw (modified,not updatable)
Description: Simple Featured Posts is a pratical widget that allows you to show a post list with thumbnails ordered by random or recent posts. You can also choose post's categories and how many posts you want to show.
Author: Fabio Di Stasio (customizer Spyros))
Version: 1.2.2
Author URI: http://nebulosaweb.com
Text Domain: sfpw
*/

include("sfpw-func.php");

wp_enqueue_style('sfpw-style', plugin_dir_url(__FILE__).'/sfpw-style.css');

load_plugin_textdomain('sfpw', false, basename( dirname( __FILE__ ) ) . '/languages' );

class sfpWidget extends WP_Widget {
	function sfpWidget() {
		parent::__construct(
			false,
			'Simple Featured Posts Widget',
			array( 'description' => "Show a posts list ordered by random or post date." )
		);

	}
	function widget( $args, $instance ) {
		extract($args);
		//var_dump($args);
		echo $before_widget;
		echo $before_title.$instance['title'].$after_title;

		?>

<div id='sfpw-wrapper'>
		<ul id='sfpw'>
			<?php
			global $post;
			$tmp_post = $post;

			$args = array(
				'numberposts' => $instance['nPosts'],
				'orderby'=> $instance['order'],
				'category' => $instance['category']
			);
			$ids = explode(",",$instance['postIds']);
			if(!empty($ids) && $instance['postIds'] !=""){
					//echo "<p>";var_dump($ids);echo"</p>";
				$args = array(
					'post__in'=>$ids,
					'numberposts' => $instance['nPosts'],
					'orderby'=> $instance['order'],
					'category' => $instance['category']
				);
			}
			$myposts = array();
			$categories = array('dummy_value'=>"even_dummier_value");
			if(isset($instance['mode']) && $instance['mode'] == 'cat_view'){
				$category_permlinks = build_permlinks($categories,$instance);
			}else {
				$myposts = get_posts( $args );
			}
			//echo "categories = ";var_dump($categories);
			//echo "<hr><br>";
			//echo "posts===";var_dump($myposts);
			//echo "<hr><br>";
			//echo "args===";var_dump($args);

			$cat_count = 0;
			$i=0;
			$first = true;
			foreach( $myposts as $post ) :
				setup_postdata($post);

				if(isset($instance['mode']) && $instance['mode'] == 'cat_view' && $i >= $instance['count']){
					$i=0;
					$cat_count++;
					$item = $categories[$cat_count];
				}
				if($first == true){
					$cat_count = 0;
					$item = $categories[$cat_count];
					$first = false;
				}

				$i++;
				if(isset($instance['mode']) && $instance['mode'] == 'cat_view' && $i == 1){
							//var_dump($category_permlinks[$item->term_id]);
							echo '<div class="category_title">
									<a class="sfpw-cat-title" href="'.$category_permlinks[$item->term_id].'">
										<h2>'.$item->name.'</h2>
									</a>';
				} /*end of category preview mode*/
				if(isset($instance['mode']) && $instance['mode'] === 'p_high' && (!isset($high_shown) || $high_shown == false)){
					$high_shown = true;
					//var_dump($instance['mode']);
				?>
					<li class="sfpw-highlighted-post"><div class="sfpw-li-wrapper">
				<?php
				}else{
				?>
					<li><div class="sfpw-li-wrapper">
				<?php
				}

						if($instance['image'] == 1){

							if(has_post_thumbnail()){ //<- check if the post has a Post Thumbnail assigned to it
								$extractUrl = wp_get_attachment_image_src( get_post_thumbnail_id(),'full');
								$imageUrl = $extractUrl[0];
								//var_dump($imageUrl);
								//var_dump($extractUrl);
							}
							else{
								$imageUrl = first_image();
								//var_dump($imageUrl);
							}

							if($instance['sizeH'] == NULL){ //<- if is set just width
								$size = imgSize(first_image());
								if($instance['size'] == '' or $instance['size'] == 0){
									$w = "150";
								}
								else{
									$w = $instance['size'];
								}
								$h = @ceil($size[1]/($size[0]/$w));
							}
							else{
								if($instance['size'] == '' or $instance['size'] == 0){
									$w = "150";
								}
								else{
									$w = $instance['size'];
								}
								$h = $instance['sizeH'];
							}
							echo "<a href='".get_permalink()."' title='".get_the_title()."'><img class=\"sfpw_featured_img\"  width='".$w."' height='".$h."' src='".$imageUrl."' alt='".the_title('','',FALSE)."'/></a>";
						}
					?>
					<div class="sfpw-text-wrapper">
				<?php
				if(isset($instance['mode']) && $instance['mode'] === 'p_high' && (!isset($high_shown_text) || $high_shown_text == false)){
					$high_shown_text = true;
					//var_dump($instance['mode']);
				?>
					<div id="sfpw-highlighted-post-text" class="sfpw-text">
				<?php
				}else{
				?>
					<div class="sfpw-text">
				<?php
				} ?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<h4><?php the_title(); ?></h4>
						</a>

							<?php if($instance['date'] == 1):?>
							<span class="sfpw-date"><?php the_time('j F Y') ?></span>
							<?php endif; ?>
				 <?php
					//echo "<p>tittle ==";var_dump(get_the_title());echo "</p>";
				  $title = get_the_title();
				  ?>
				  <div class="sfpw-excerpt">
				  <?php
				  /*
				   * In the last theme I set display:none to the normal
				   *  post title and instead put the title as h1 in
				   *  the post so we need the following few lines to
				   *  skip it
				   *
				   * In this theme however I don't have any such things but the excerpt does not have any h1's either way
				   */
				   /* For this function see functions.php*/
				   $ex = get_the_excerpt();
				  $skip_h1 = get_excerpt_in_chars($ex);//;
				  $sh1 = explode($title,$skip_h1);
					//echo "excerpt=="; var_dump($skip_h1);//echo "sh1 =="; var_dump($sh1);
				  if(!empty($sh1[1])){
					echo $sh1[1];
					if(!empty($sh1[2])){
						echo $title." ".$sh1[2];
					}
					if(sizeof($sh1)>3)
						for($i = 3; $i<sizeof($sh1);$i++){
							echo $title." ".$sh1[$i];
						}
				   }else
						echo $skip_h1;
					?></div>

					<?php
					/*
					 * Read more link with a language quick hack
					 */
					$read_more = '<a class="sfpw-morelink" href="'.get_permalink().'" title="'.get_the_title().'">
									<img class="sfpw-more" src="'.plugin_dir_url(__FILE__).'images/arrow_list.gif" alt="read_more"/>';
					if($instance['lang'] == 'gr'){
						$read_more .= "Διαβάστε Περισσότερα";
					}elseif($instance['lang'] == 'en'){
						$read_more .= "Read More";
					}
					$read_more .="</a>";
					echo $read_more;
					//echo _e('Thumbnail height:');//var_dump($read_more);?>
				<div class="sfpw-li-clear"></div>
				</div><!-- sfpw-text-->
				</div><!-- sfpw-text-wrapper-->
				</div><!-- sfpw-li-wrapper-->
				</li>

			<?php
			if(isset($instance['mode']) && $instance['mode'] == 'cat_view'){
				/*
				* If we are in the last item of the category(the category has fewer items than those we want to print)
				* then we close the div
				*/
				if($item->count < $instance['count'] && $i == $item->count ){
					$i = $instance['count'];
				}
				if(isset($instance['mode']) && $instance['mode'] == 'cat_view' && $i == $instance['count']){

					if($instance['lang'] == 'gr'){
						echo '<div class="category_title">
							<a class="sfpw-cat-title" href="'.$category_permlinks[$item->term_id].'">
								<p style = "color:white; box-shadow:0 0 10px #696969; background:none repeat scroll 0 0 rgba(0, 0, 0, 0.65); margin:-3% 4.4% 8% 0; padding:2% 0% 2% 3%; font-size:1.1em;">Δείτε Περισσότερα για '.$item->name.'</p>
							</a>';
					}else{
						echo '<div class="category_title">
								<a class="sfpw-cat-title" href="'.$category_permlinks[$item->term_id].'">
									<p style = "color:white; box-shadow:0 0 10px #696969; background:none repeat scroll 0 0 rgba(0, 0, 0, 0.65); margin :-3% 4.4% 8% 0; padding:2% 0% 2% 3%; font-size:1.1em;">See More About '.$item->name.'</p>
								</a>';
					}
					echo "</div>"; //<- /category_title
				}
			}
		endforeach;
			$post = $tmp_post;
			?>
		</ul></div>
		<script>
			//var total = jQuery('#sfpw').children('li').size();
					//sfpw-text-wrapper
			var getMaxHeight = function ($elms) {
				var maxH = 0;
				$elms.each(function () {
					if (jQuery(this).innerHeight() > maxH) {
						maxH = jQuery(this).innerHeight();
					}
				});
				return maxH;
			};
			//("#sfpw-text-wrapper sfpw-text")


			//var $li = jQuery('#sfpw').children('li').not('.sfpw-highlighted-post');
			var $li = jQuery('#sfpw .sfpw-text-wrapper .sfpw-text').not('#sfpw-highlighted-post-text');

			//('sfpw-text-wrapper sfpw-text')
			$li.height( getMaxHeight($li) );
		</script>-->
		<?php
		echo $after_widget;
	}
	function update( $new_instance, $old_instance ) {
		return $new_instance;
	}
	function form( $instance ) {

		//<- set default parameters of widget
		//var_dump($instance['postIds']);
		//var_dump($instance['lang']);
		$postIds = array();
		if($instance){
			$title = esc_attr($instance['title']);
			$nPosts = esc_attr($instance['nPosts']);
			$order = $instance['order'];
			$category = esc_attr($instance['category']);
			$image = $instance['image'];
			$date = $instance['date'];
			$size = $instance['size'];
			$sizeH = $instance['sizeH'];
			$postIds = explode(" ",$instance['postIds']);
			$postIds = explode(",",$instance['postIds']);
			$posts_per_cat = $instance['count'];
			$extension = $instance['extension'];
		//	$posthigh = $instance['p_high'];
			$mode = $instance['mode'];
			$lang = $instance['lang'];
		}
		else{
			$title = "Featured Posts";
			$nPosts = 5;
			$order = "rand";
			$category = "";
			$image = 1;
			$date = 1;
			$size = 150;
			$sizeH = '';
			$postIds = '';
			$posts_per_cat = 2;
			$extension = '';
			$lang = 'en';
		//	$posthigh = '';
			$mode = 'no';
		}
		$mode = array();
		switch($instance['mode']){
			case 'no':
				$mode[0][0] = 'no'; $mode[0][1] = 'normal';
				$mode[1][0] = 'cat_view'; $mode[1][1] = 'Category View';
				$mode[2][0] = 'p_high'; $mode[2][1] = 'Post Highlight';
				break;
			case 'cat_view':
				$mode[0][0] = 'cat_view'; $mode[0][1] = 'Category View';
				$mode[1][0] = 'no'; $mode[1][1] = 'normal';
				$mode[2][0] = 'p_high'; $mode[2][1] = 'Post Highlight';
				break;
			case 'p_high':
				$mode[0][0] = 'p_high'; $mode[0][1] = 'Post Highlight';
				$mode[1][0] = 'no'; $mode[1][1] = 'normal';
				$mode[2][0] = 'cat_view'; $mode[2][1] = 'Category View';
				break;
			default:
				$mode[0][0] = 'no'; $mode[0][1] = 'normal';
				$mode[1][0] = 'cat_view'; $mode[1][1] = 'Category View';
				$mode[2][0] = 'p_high'; $mode[2][1] = 'Post Highlight';
				break;

		}
 		?>
		<p>
			<label for="<?php echo $this->get_field_id('title');?>"><?php _e('Title:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" type="text" value="<?php echo $title; ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('nPosts');?>"><?php _e('Number of posts to show:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('nPosts');?>" name="<?php echo $this->get_field_name('nPosts');?>" type="text" value="<?php echo $nPosts; ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('order');?>"><?php _e('Order:'); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id('order');?>" name="<?php echo $this->get_field_name('order');?>" type="radio">
				<option value='<?php if($order == "rand"):?>rand<?php else:?>post_date<?php endif?>'><?php if($order == "rand"):?><?php _e('Random'); ?><?php else:?><?php _e('Recent Posts'); ?><?php endif?></option>
				<option value='<?php if($order == "rand"):?>post_date<?php else:?>rand<?php endif?>'><?php if($order == "rand"):?><?php _e('Recent Posts'); ?><?php else:?><?php _e('Random'); ?><?php endif?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('category');?>"><?php _e('Category ID (optional):','sfpw'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('category');?>" name="<?php echo $this->get_field_name('category');?>" type="text" value="<?php echo $category; ?>"/>
			<small>Category IDs, separated by commas</small>
		</p>
		<p>
			<input class="checkbox" <?php if($date == 1): ?>checked="checked"<?php endif?> id="<?php echo $this->get_field_id('date');?>" name="<?php echo $this->get_field_name('date');?>" type="checkbox" value="1"/>
			<label for="<?php echo $this->get_field_id('date');?>"><?php _e('Show date','sfpw'); ?></label>
		</p>
		<p>
			<input class="checkbox" <?php if($image == 1): ?>checked="checked"<?php endif?> id="<?php echo $this->get_field_id('image');?>" name="<?php echo $this->get_field_name('image');?>" type="checkbox" value="1"/>
			<label for="<?php echo $this->get_field_id('imahe');?>"><?php _e('Show thumbnail','sfpw'); ?></label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('size');?>"><?php _e('Thumbnail witdh:','sfpw'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('size');?>" name="<?php echo $this->get_field_name('size');?>" type="text" value="<?php echo $size; ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('sizeH');?>"><?php _e('Thumbnail height:','sfpw'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('sizeH');?>" name="<?php echo $this->get_field_name('sizeH');?>" type="text" value="<?php echo $sizeH; ?>"/>
			<small>Automatically set if blank</small>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('postIds');?>"><?php _e('Post Ids(coma seperated values)','sfpw'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('postIds');?>" name="<?php echo $this->get_field_name('postIds');?>" type="text" value="<?php echo implode(",",$postIds); ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('mode');?>"><?php _e('Display Mode','sfpw'); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id('mode');?>" name="<?php echo $this->get_field_name('mode');?>" type="radio">
				<option value='<?php echo $mode[0][0];?>'><?php echo $mode[0][1];?></option>
				<option value='<?php echo $mode[1][0]; ?>'><?php echo $mode[1][1];?></option>
				<option value='<?php echo $mode[2][0]; ?>'><?php echo $mode[2][1];?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('count');?>"><?php _e('If category view is on, how many posts per category should be shown?','sfpw'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('count');?>" name="<?php echo $this->get_field_name('count');?>" type="text" value="<?php echo $posts_per_cat; ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('extension');?>"><?php _e('Extension of category containing the category post','sfpw'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('extension');?>" name="<?php echo $this->get_field_name('extension');?>" type="text" value="<?php echo $extension; ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('lang');?>"><?php _e('Language:'); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id('lang');?>" name="<?php echo $this->get_field_name('lang');?>" type="radio">
				<option value='<?php if($lang == "en"):?>en<?php else:?>gr<?php endif?>'><?php if($lang == "en"):?><?php _e('English'); ?><?php else:?><?php _e('Greek'); ?><?php endif?></option>
				<option value='<?php if($lang == "en"):?>gr<?php else:?>en<?php endif?>'><?php if($lang == "en"):?><?php _e('Greek'); ?><?php else:?><?php _e('English'); ?><?php endif?></option>
			</select>
		</p>
		<?php
	}
}



function sfpw_register() {
	register_widget( 'sfpWidget' );
}

add_action( 'widgets_init', 'sfpw_register' );


/*hack to exclude the plugin from the update checks*/
function sfpw_disable_updates( $r, $url ) {
	    if ( 0 !== strpos( $url, 'http://api.wordpress.org/plugins/update-check' ) )
	        return $r; // Not a plugin update request. Bail immediately.
	    $plugins = unserialize( $r['body']['plugins'] );
	    unset( $plugins->plugins[ plugin_basename( __FILE__ ) ] );
	    unset( $plugins->active[ array_search( plugin_basename( __FILE__ ), $plugins->active ) ] );
	    $r['body']['plugins'] = serialize( $plugins );
	    return $r;
	}

add_filter( 'http_request_args', 'sfpw_disable_updates', 5, 2 );

?>
