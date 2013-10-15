<?php
/**
 * The Sidebar containing the main widget areas. (map etc)
 *
 * @package Toolbox-child
 * @since Toolbox 0.1
 */
?>		<!--sidebar-3.php-->
<?php //die("young");?>
		<div id="header-widget-area" class="widget-area" role="complementary">
			
			<?php
			 if ( is_active_sidebar( 'sidebar-3' ) ){
				dynamic_sidebar( 'sidebar-3' ) ?>
			<?php
			}
			// end sidebar widget area ?>
		</div><!-- #header-widget-area .widget-area -->

