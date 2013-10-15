<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package Toolbox
 * @since Toolbox 0.1
 */
?>

	</div><!-- #main -->
	
	<footer id="colophon footer" role="contentinfo">
		<div id="footer-wrapper">
			<div id="foot1"></div>
		<div id="footer-stuff">
		<?php get_sidebar('5'); ?>
		</div>
      
		<div id="footer-clear"></div>
		</div><!-- #footer-wrapper -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
