<?php
function first_image() {
	global $post, $posts;
	$first_img = "";
	ob_start();
	ob_end_clean();
	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
	$first_img = $matches [1] [0];

	if(empty($first_img)){ //<- 	Defines a default image
		$first_img = plugin_dir_url(__FILE__)."images/default.png";
	}
		
	return $first_img;
}

function imgSize($img){

	if(strpos($img, "/") == 0){
		$img = substr($img,1);
	}
	
	$size = @getimagesize($img);
	return $size;
}

function get_direct_children($category){
	
	$args = array(
	'type'                     => 'post',
	'child_of'                 => '',
	'parent'                   => $category,
	'orderby'                  => 'name',
	'order'                    => 'ASC',
	'hide_empty'               => 1,
	'hierarchical'             => 1,
	'exclude'                  => '',
	'include'                  => '',
	'number'                   => '',
	'taxonomy'                 => 'category',
	'pad_counts'               => false );
	
	$categories = get_categories( $args );
	return $categories;
}

function show_posts($myposts,$instance){
//var_dump($instance);
foreach( $myposts as $post ) : setup_postdata($post); ?>

				<li><div class="sfpw-li-wrapper">
					<?php
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
							//var_dump($imageUrl);
							echo "<a href='".get_permalink()."' title='".get_the_title()."'><img  width='".$w."' height='".$h."' src='".$imageUrl."' alt='".the_title('','',FALSE)."'/></a>";
						} 
					?>
				<div class="sfpw-text-wrapper">
				<div class="sfpw-text">
					
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<h4><?php the_title(); ?></h4>
						</a>
					
							<?php if($instance['date'] == 1):?>
							<span class="sfpw-date"><?php the_time('j F Y') ?></span>
							<?php endif; ?>
				 <?php
					//echo "<p>tittle ==";var_dump(get_the_title());echo "</p>";
				  $title = get_the_title();
				  $skip_h1 = get_the_excerpt();
				  //echo "excerpt=="; var_dump($skip_h1);
				    $sh1 = explode($title,$skip_h1);
				    //echo "sh1 =="; var_dump($sh1);
				    if(!empty($sh1[1])){
						echo $sh1[1];
						if(!empty($sh1[2]))
							{echo $title." ".$sh1[2];}
						if(sizeof($sh1)>3)
							for($i = 3; $i<sizeof($sh1);$i++){
								echo $title." ".$sh1[$i];
								}
						}
					else
						echo $skip_h1;
				 ?>
				<?php
					$read_more = "<a class=\"sfpw-morelink\" href='".get_permalink()."' title='".get_the_title()."'>
									<img class=\"sfpw-more\" src=\"".plugin_dir_url(__FILE__)."images/arrow_list.gif\"/>";
					if($instance['lang'] == 'gr'){
						$read_more .= "Διαβάστε Περισσότερα";
					}elseif($instance['lang'] == 'en'){
						$read_more .= "Read More";
					}
					$read_more .="</a>";
					echo $read_more;
					//echo _e('Thumbnail height:');
					//var_dump($read_more);?>
				<div class="sfpw-li-clear"></div>
				</div><!-- sfpw-text-->
				</div><!-- sfpw-text-wrapper-->
				</div><!-- sfpw-li-wrapper-->
				</li>
			<?php endforeach;
			//echo "posts";
}
function build_permlinks($categories,$instance){
	
				$category_permlinks = array();

				$categories = get_direct_children($instance['category']);
				$args = array(
				'numberposts' => $instance['count'], 
				'orderby'=> $instance['order'], 
				);
				foreach ( $categories as $cat ) {
					$args['category'] = $cat->term_id;
					$tmpost = get_posts( $args );
					foreach($tmpost as $item)
						array_push($myposts,$item);

				/*start of category-post permalink build*/
				
				/*	NOTES, README!
				 * The logic behind the category-preview mode is the following:
				 * 	 You have a category e.g. bikes
				 * 		each post in this category is the details of a certain bike,
				 * 		but you dont want to show all the bikes together as in wordpress category view,
				 * 	So you have a special post named bikes (same name as the category) which has this widget
				 * 		and which serves as the category page for bikes.
				 * Now for taxonomy reasons you cant have bikes-post in the bikes category 
				 * 	So you create a second category with a naming convention.
				 * The convention is that you put the category name first (in our case bikes) and an extension second.
				 * E.g. bikes-category-post so when you configure the widget, if you want to link to the bikes post-category page
				 * you put the extension in the widget box (in our case bikes-category-post)
				 * Simple? :p
				 * 
				 * If we are in category preview mode
					 * 		. get the category which start with the same name as the category we are trying to print
					 * 			and ends with the specified extention(e.g. if we are printing bikes,
					 * 			we want to search for bikes-category, -category being the extension)
					 * 		. That category should have only 1 post the "category post" so get that post
					 * 		. Echo its permalink and title
					 */
					
				
				/*Search for 'category-name' + extension*/
				$c = get_term_by( 'name', $cat->name.$instance['extension'], 'category');
								//echo "we are searching for ".$cat->name.$instance['extension'];
								//echo "<hr><br>";
								//echo "cat===";var_dump($c);

				/*Get the single post of this category*/
						if(!empty($c) && sizeof($c) == 1){
							$ar = array( 'numberposts' => 1 );
							$ar['category'] = $c->term_id;
							$cat_post = get_posts( $ar );
								//echo "<hr><br>";
								//echo "cat_post===";var_dump($cat_post);							
							foreach($cat_post as $cpost){
								//echo "<hr>cpost ==";var_dump($cpost);echo"<hr>";
								$pid = $cpost->ID;
								$category_permlinks[$cat->term_id]=get_permalink( $pid );
							}
							//echo "<hr><br>";
							//echo "permalink_post===";var_dump($category_permlinks);
						}/*end of category-post permalink build*/
				}
				return $category_permlinks;
}
add_action('wp_head', 'first_image');
add_action('wp_head', 'imgSize');
?>
