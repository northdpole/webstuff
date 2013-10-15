<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Toolbox
 * @since Toolbox 0.1
 */

get_header(); ?>

	<div id="primary">
		<div id="content" role="main">

			<article id="post-0" class="post error404 not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Well this is somewhat embarrassing, isn&rsquo;t it?', 'toolbox' ); ?></h1>
				</header>

				<div class="entry-content">
					<p id="text_404"><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for.', 'toolbox' ); ?></p>
						<div class="content404" id="img_wrapper404">
		<!-- The page you requested was not found -->
		<img id="image404" class="content404" src="<?php echo get_stylesheet_directory_uri(); ?>/images/404error.png" alt="four_o'_four">
	</div>
		<span id="clearfix_404"></span>
	
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>
