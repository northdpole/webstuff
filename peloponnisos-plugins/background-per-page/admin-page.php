<?php
/*
Plugin Name: Background Per Page
Plugin URI: http://fishcantwhistle.com
Author: Fish Can't Whistle
Version: 0.3
*
* Additions by NorthDPole
*/

add_action( 'edit_category_form_fields', 'my_category_custom_fields' );
add_action( 'edit_category', 'save_my_category_custom_fields' );


//It's supposed to add a custom color field to a category but i haven't made it work yet
//all it needs is just a check in get_category_background to return the color if it doesn't have an image
function my_category_custom_fields( $tag ) {
    // your custom field HTML will go here
    // the $tag variable is a taxonomy term object with properties like $tag->name, $tag->term_id etc...

    // we need to know the values of our existing entries if any
    $category_meta = get_option('_bpp_cat_');
    ?>
    <tr class="form-field">
        <tr valign="top"><label for="category-title"><?php _e("Color"); ?></label></t>
        <td>
		<input id="color" name="<?php echo "_bpp_cat_[{$tag->term_id}]"; ?>" value="<?php
		if ( isset( $category_meta[ $tag->term_id ] ) )
		 esc_attr_e( $category_meta[ $tag->term_id ]['color'] ); ?>"
	<p id="_bpp_color_description" class="description">Use a background colour as well as or instead of an image.</p>
      </div>
             </td>
    </tr>
    <?php
}

function save_my_category_custom_fields() {
	
    if ( isset($_POST['_bpp_cat_'] ) && !update_option('_bpp_cat_', $_POST['_bpp_cat_']) )
        add_option('_bpp_cat_', $_POST['_bpp_cat_']);

	
}

// setup our image field and handling methods
function setup_category_image_handling() {
    // add the image field to the rest
    add_action( 'edit_category_form_fields', 'category_image' );

    global $pagenow;
    if ( is_admin() ) {
    add_action( 'admin_init', 'fix_async_upload_image' );
    if ( 'edit-tags.php' == $pagenow ) {
        add_thickbox();
        add_action('admin_print_footer_scripts', 'category_image_send_script', 1000);
    } elseif ( 'media-upload.php' == $pagenow || 'async-upload.php' == $pagenow ) {
        add_filter( 'media_send_to_editor', 'category_image_send_to_editor', 1, 8 );
        add_filter( 'gettext', 'category_image_replace_text_in_thickbox', 1, 3 );
    }
    }
}
add_action( 'admin_init', 'setup_category_image_handling' );

// the taxonomy edit screen image field
function category_image( $tag ) {
    // get our category meta data
    $category_meta = get_option('_bpp_cat_');
    ?>
           <tr class="form-field hide-if-no-js">
               <th scope="row" valign="top"><label for="taxonomy-image"><?php _e("Image"); ?></label></th>
               <td>
                   <div id="taxonomy-image-holder">
               <?php if( !empty($category_meta[$tag->term_id]['image']) ) { ?>
                   <img style="max-width:100%;display:block;" src="<?php echo esc_attr( $category_meta[ $tag->term_id ]['image']['thumb'] ); ?>" alt="" />
                   <a id="taxonomy-image-select" class="thickbox" href="media-upload.php?is_term=true&amp;type=image&amp;TB_iframe=1"><?php _e('Change image'); ?></a>
                   <a class="deletion" id="taxonomy-image-remove" href="#remove-image">Remove image</a>
               <?php } else { ?>
                   <a id="taxonomy-image-select" class="thickbox" href="media-upload.php?is_term=true&amp;type=image&amp;TB_iframe=1"><?php _e('Choose an image'); ?></a>
               <?php } ?>
                   </div>
                   <input type="hidden" name="_bpp_cat_[<?php echo $tag->term_id ?>][image][id]" value="<?php if( isset($category_meta[ $tag->term_id ]['image']['id']) ) echo esc_attr($category_meta[ $tag->term_id ]['image']['id']); ?>" class="tax-image-id" />
                   <input type="hidden" name="_bpp_cat_[<?php echo $tag->term_id ?>][image][thumb]" value="<?php if( isset($category_meta[ $tag->term_id ]['image']['thumb']) ) echo esc_attr($category_meta[ $tag->term_id ]['image']['thumb']); ?>" class="tax-image-thumb" />
               <span class="description"><?php _e('A category image.'); ?></span></td>
           </tr>
    <?php
}

   // required for uploading images on non post/page screens
   function fix_async_upload_image() {
       if(isset($_REQUEST['attachment_id'])) {
           $GLOBALS['post'] = get_post($_REQUEST['attachment_id']);
       }
   }

   // are we dealing with the taxonomy edit screen?
   function is_category_context() {
       if ( isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'],'is_term') !== false ) {
           return true;
       } elseif ( isset($_REQUEST['_wp_http_referer']) && strpos($_REQUEST['_wp_http_referer'],'is_term') !== false ) {
           return true;
       } elseif ( isset($_REQUEST['is_term']) && $_REQUEST['is_term'] !== false ) {
           return true;
       }
       return false;
   }

   // replace Insert Into Post text with something more appropriate
   function category_image_replace_text_in_thickbox($translated_text, $source_text, $domain) {
       if ( is_category_context() ) {
           if ('Insert into Post' == $source_text) {
               return __('Use this image', MB_DOM );
           }
       }
       return $translated_text;
   }

   // output a script that sets variables on the window object so that they can be accessed elsewhere
   function category_image_send_to_editor( $html, $id, $attachment ) {
       // context check might not be necessary, and, might not work in all cases
       if ( is_category_context() ) {
           $item = get_post($id);
           $src = wp_get_attachment_image_src($id,'thumbnail',true); // 0 = url, 1 = width, 2 = height, 3 = icon(bool)
           ?>
           <script type="text/javascript">
               // send image variables back to opener
               var win = window.dialogArguments || opener || parent || top;
               win.TI.id = <?php echo $id ?>;
               win.TI.thumb = '<?php echo $src[0]; ?>';
           </script>
           <?php
       }
       return $html;
   }

   // write out the javascript that handles what happens when a user clicks to use an image
   function category_image_send_script() { ?>
       <script>
           self.TI = {};
           var tb_position;

           function send_to_editor(h) {
               // ignore content returned from media uploader and use variables passed to window instead
               jQuery('.tax-image-id').val( self.TI.id );
               jQuery('.tax-image-thumb').val( self.TI.thumb );

               // display image
               jQuery('#taxonomy-image-holder img, #taxonomy-image-remove').remove();
               jQuery('#taxonomy-image-holder')
                   .prepend('<img style="max-width:100%;display:block;" src="'+ self.TI.thumb +'" alt="" />')
                   .append('<a class="deletion" id="taxonomy-image-remove" href="#remove-image">Remove image</a>');

               jQuery('#taxonomy-image-select').html('Change image');

               // close thickbox
               tb_remove();
           }

           (function($){
               $(document).ready(function() {

                   tb_position = function() {
                       var tbWindow = $('#TB_window'), width = $(window).width(), H = $(window).height(), W = ( 720 < width ) ? 720 : width;

                       if ( tbWindow.size() ) {
                           tbWindow.width( W - 50 ).height( H - 45 );
                           $('#TB_iframeContent').width( W - 50 ).height( H - 75 );
                           tbWindow.css({'margin-left': '-' + parseInt((( W - 50 ) / 2),10) + 'px'});
                           if ( typeof document.body.style.maxWidth != 'undefined' )
                               tbWindow.css({'top':'20px','margin-top':'0'});
                       };

                       return $('a.thickbox').each( function() {
                           var href = $(this).attr('href');
                           if ( ! href ) return;
                           href = href.replace(/&width=[0-9]+/g, '');
                           href = href.replace(/&height=[0-9]+/g, '');
                           $(this).attr( 'href', href + '&width=' + ( W - 80 ) + '&height=' + ( H - 85 ) );
                       });
                   };
                   $(window).resize(function(){ tb_position(); });

                   $('#taxonomy-image-select').click(function(event){
                       tb_show("Choose an image:", $(this).attr("href"), false);
                       return false;
                   });
                   $('#taxonomy-image-remove').live('click',function(event){
                       $('#taxonomy-image-select').html('Choose an image');
                       $('#taxonomy-image-holder img').remove();
                       $('input[class^="tax-image"]').val("");
                       $(this).remove();
                       return false;
                   });
               });
           })(jQuery);
       </script>
       <?php
   }

function get_category_background($term_id){

    // get our category meta data and exit out if there isn't any
    $category_meta = get_option("_bpp_cat_");
	if ( !$category_meta )
		return;
	else {
		//var_dump(array($category_meta[ $term_id ]['image']['id']));
		return array($category_meta[ $term_id ]['image']['id']);
	}
}
?>
