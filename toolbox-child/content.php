<?php
/**
 * @package Toolbox
 */
?>
<?php 
	if(is_search()){
	if(has_post_thumbnail()){
		$extractUrl = wp_get_attachment_image_src( get_post_thumbnail_id(),'full');
		$imageUrl = $extractUrl[0];
	}
	else{$imageUrl = first_image();}
	if(empty($imageUrl) || $imageUrl == "")
	$imageUrl = get_template_directory_uri()."/images/logo.png";
    echo "<a href='".get_permalink()."' title='".get_the_title()."'><img  width=\"125\" height=\"125\" src='".$imageUrl."' alt='".the_title('','',FALSE)."'/></a>";
    }	?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	 <?php if(!is_search()){ ?>
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'toolbox' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php // toolbox_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->
	
	<?php }else {
		$title_small = true;?>
	<?php }?>
	<?php if ( is_search() ) { // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<div class="sfpw-text">
		<?php
		if(true === $title_small){?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
		<h4><?php the_title(); ?></h4></a>
		<?php }
		the_excerpt(); ?>
		<?php echo "<a class=\"sfpw-morelink\" href='".get_permalink()."' title='".get_the_title()."'><img class=\"sfpw-more\" src=\"".get_stylesheet_directory_uri()."/images/arrow_list.gif\"/>Read More</a>";?>
		<div class="sfpw-li-clear"></div>
		</div>
	</div><!-- .entry-summary -->
	<?php } else{ ?>
	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'toolbox' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'toolbox' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	<?php } ?>

	<footer class="entry-meta">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'toolbox' ) );
				if ( $categories_list && toolbox_categorized_blog() ) :
			?>
			<span class="cat-links">
				<?php printf( __( 'Posted in %1$s', 'toolbox' ), $categories_list ); ?>
			</span>
			<span class="sep"> | </span>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'toolbox' ) );
				if ( $tags_list ) :
			?>
			<span class="tag-links">
				<?php printf( __( 'Tagged %1$s', 'toolbox' ), $tags_list ); ?>
			</span>
			<span class="sep"> | </span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php if ( comments_open() || ( '0' != get_comments_number() && ! comments_open() ) ) : ?>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'toolbox' ), __( '1 Comment', 'toolbox' ), __( '% Comments', 'toolbox' ) ); ?></span>
		<span class="sep"> | </span>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'toolbox' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- #entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
