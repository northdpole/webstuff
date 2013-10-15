<?php
/**
 * Template Name: Treis meres template
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
get_header("category"); ?>
<!--page-templates/homepage.php -->
<div id="main_menu_page">
	<!-- main_menu_page.php-->
	<div id="primary" class="site-content center_content main_page">
		<div id="content" class="main_menu_content no-title" role="main">
			<div id="title" class="no-title">
				<header class="entry-header entry-header_in_head_img"> <h1 class="entry-title entry-title_in_head_img"><?php the_title(); ?></h1> </header>
			</div>
			<?php while ( have_posts() ) : the_post(); ?>
			<div id="category_head_image">
				<?php
				if ( has_post_thumbnail()) {
					$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
					echo '<img src="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" >';
					//the_post_thumbnail('thumbnail');
					echo '</img>';
				}
				?>
			</div>
				<?php get_template_part( 'content', 'page' ); ?>
				<?php comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->
<!-- /main_menu_page.php -->
</div>
<?php //get_sidebar(); ?>
<?php get_footer(); ?>
