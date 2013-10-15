<?php
/**
 * Template Name: HomePage Template (This is the template for the front page)
 *
 * Description: A page template that provides a key component of WordPress as a CMS
 * by meeting the need for a carefully crafted introductory page. The front page template
 * in Twenty Twelve consists of a page content area for adding text, images, video --
 * anything you'd like -- followed by front-page-only widgets in one or two columns.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

<?php
get_header(); ?>
<!--page-templates/homepage.php -->
<div id="homepage">
	<!-- homepage.php-->
	<div id="title" class="no-title">
		<!--<header class="entry-header entry-header_in_head_img"> <h1 class="entry-title entry-title_in_head_img"><?php the_title(); ?></h1> </header>-->
	</div>
	<div id="primary" class="site-content center_content home">
		<div id="content" class="homepage no-title" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
				<?php comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->
<!-- /homepage.php -->
</div>
<?php //get_sidebar( '../front' ); ?>
<?php get_footer(); ?>
