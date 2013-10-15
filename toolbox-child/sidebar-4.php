<?php
/**
 * The Sidebar containing the main widget areas. (text)
 *
 * @package Toolbox-child
 * @since Toolbox 0.1
 */
?>		<!--sidebar-3.php-->
<?php //die("young");?>
		<div id="main-menu" class="widget-area" role="complementary">
			
			<?php
			 if ( is_active_sidebar( 'sidebar-4' ) ){
				dynamic_sidebar( 'sidebar-4' ) ?>
			<?php
			}
			// end sidebar widget area ?>
		</div><!-- #header-widget-area .widget-area -->

