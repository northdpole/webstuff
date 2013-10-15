<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Toolbox-child
 * @since Toolbox 0.1
 */
?>		<!--sidebar-3.php-->
<?php //die("young");?>
		<div id="footer-menu" class="widget-area" role="complementary">
			
			<?php
			 if ( is_active_sidebar( 'sidebar-5' ) ){
				dynamic_sidebar( 'sidebar-5' ) ?>
			<?php
			}
			// end sidebar widget area ?>
		</div>

