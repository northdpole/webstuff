<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
	</div><!-- #main .wrapper -->
	<footer id="colophon" class="center_content" role="contentinfo">
		<div class="site-info">
			<?php if ( is_active_sidebar( 'sidebar-6' ) ) : ?><?php dynamic_sidebar( 'sidebar-6' ); ?><?php endif; ?>
			<?php //do_action( 'twentytwelve_credits' ); ?>
			<!--<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'twentytwelve' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'twentytwelve' ); ?>"><?php printf( __( 'Proudly powered by %s', 'twentytwelve' ), 'WordPress' ); ?></a> -->
		</div><!-- .site-info -->
	</footer><!-- #colophon -->

</div><!-- #page -->



<?php wp_footer(); ?>

<?php 
require(get_stylesheet_directory()."/insert_data.php");
date_default_timezone_set('Europe/Athens');

insertData();
$_SESSION['starttime'] = date('Y-m-d H:i:s');
?>


</body>
</html>
