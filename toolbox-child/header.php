<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Toolbox
 * @since Toolbox 0.1
 */
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->

<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicon.ico" />
	<!--[if lte IE 9]>
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/ie.css" />
<![endif]-->
<meta name="google-site-verification" content="jV2SbTYXtRvRftWJC_8udGf8KaroTqD7gp1K7aHYbjE" />
<!--google analytics verification meta -->
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page()  || ("homepage"===$pagename)  ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'toolbox' ), max( $paged, $page ) );

	?></title>
	<!-- Caching meta, in case of problems or dev continuing put this line in comments first-->
	<meta http-equiv="Expires" content="Sun, 19 Jan 2014 23:59:59 GMT">
	<!-- compression meta tag -->
<script src="<?php echo get_stylesheet_directory_uri(); ?>/scripts/BrowserDetect.js"></script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-38820405-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>                                            
<script>
var Detect = (function() {
	var
		props = "borderRadius,opacity".split(","),
		CSSprefix = "Webkit,Moz,O,ms,Khtml".split(","),
		d = document.createElement("detect"),
		test = [],
		p, pty;
	function TestPrefixes(prop) {
		var
			Uprop = prop.charAt(0).toUpperCase() + prop.substr(1),
			All = (prop + ' ' + CSSprefix.join(Uprop + ' ') + Uprop).split(' ');
		for (var n = 0, np = All.length; n < np; n++) {
			if (d.style[All[n]] === "") return true;
		}
        return false;
	}
	for (p in props) {
		pty = props[p];
		test[pty] = TestPrefixes(pty);
	}
	return test;
}());
var css3Existance = true;

for (t in Detect) {
	if(Detect[t] == false) {
		css3Existance = false;
		alert("Please Update your Browser to support CSS 3 in order to properly view this Site!");
	}
}
var browser = BrowserDetect.browser;
var bversion = BrowserDetect.version;

if (browser == "Firefox") {
	if (bversion < 10) {
		alert("Please Update your Browser to version 10 or newer to properly view this Site!");
	}
}else if (browser == "Explorer") {
	if (bversion < 9) {
		alert("Please Update your Browser to version 9 or newer to properly view this Site!");
	}
}else if (browser == "Chrome") {
	if (bversion < 16){
		alert("Please Update your Browser to version 16 or newer to properly view this Site!");
	}
}else if (browser == "Safari") {
	if (bversion < 5){
		alert("Please Update your Browser to version 5 or newer to properly view this Site!");
	}
}else if (browser == "Opera") {
	if (bversion < 10){
		alert("Please Update your Browser to version 10 or newer to properly view this Site!");
	}
}
</script>

	
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<?php if(!is_front_page() && !("Live"=== the_title("","",false)) && !("homepage"===$pagename)){?>
<style>
#content{
	background:none repeat scroll 0 0 rgba(255, 255, 255, 0.9);
	}
</style>
<?php }else if(is_front_page() || ("Live"=== the_title("","",false)) || ("homepage"===$pagename)){?>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_directory_uri(); ?>/live.css" />
<?php }
	if(("Plan"=== the_title("","",false))){?>
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_directory_uri(); ?>/plan.css" />
	<?php } if("Facts"=== the_title("","",false)){?>
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_directory_uri(); ?>/facts.css" />
	<?php }if("Live"=== the_title("","",false)){?>
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_directory_uri(); ?>/live-promo.css" />
	<?php } ?>
	<?php if("Participate"=== the_title("","",false)){?>
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_directory_uri(); ?>/participate.css" />
	<?php } ?>
	<?php if(is_404()){?>
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_directory_uri(); ?>/404.css" />
	<?php }?>
<?php if(is_search()){?>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_directory_uri(); ?>/search.css" />
<?php }?>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript">

$(document).ready(function() {
$("#access ul li").mouseover(function(){
		$(this).find('> :nth-child(2)').show();
		}).mouseout(function(){
			$('> :nth-child(2)',this).hide();
		});
/*$("#access ul li li").mouseover(function(){
		$(':nth-child(2)',this).show();
		}).mouseout(function(){
			$(this).next(".sub-menu").hide();
		});*/
});
	
	/*$(".info").mouseover(function(){$(this).show();}).mouseout(function(){
			$(this).hide();});}*/



	/*
function adaptFontSize() {
    var defaultW = 1000;
    var defaultFontSize = 16;
    var  width = parseInt($("#header-widget-area").width());
    var fontSize = (defaultFontSize * width)/defaultW+"px";

    $("#branding").css('font-size', fontSize);
    
   // alert(width +" "+ defaultFontSize * width+ " " fontSize);
}
$(document).ready(adaptFontSize);
//$(window).resize(adaptFontSize);*/
</script>

<?php

$categories = get_the_category();
$separator = ' ';
$output = '';
if($categories){
	foreach($categories as $category) {
		if("Experiences" === $category->cat_name){
			//echo "<style> body{background-image: url(\"images/per_page/experiences.png\");}</style>";
			}
	}

}
$dir = get_stylesheet_directory_uri();
if(("Plan"=== the_title("","",false))){
	echo "<style> body{background-image: url(\"".$dir."/images/per_page/plan.jpg\");}</style>";
}elseif(("Facts"=== the_title("","",false))){
	echo "<style> body{background-image: url(\"".$dir."/images/per_page/facts.jpg\");}</style>";
}elseif(("Live"=== the_title("","",false))){
	echo "<style> body{background-image: url(\"".$dir."/images/per_page/live.jpg\");}</style>";
}elseif(("Participate"=== the_title("","",false))){
	echo "<style> body{background-image: url(\"".$dir."/images/per_page/participate.jpg\");}</style>";
}


?>


<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed">
<div id="header-wrapper">
<?php do_action( 'before' ); ?>
	<header id="branding" role="banner">
		<span id="header1">
		<span id="header1-clear1" class="header-clear1"></span>
		<img id="leftbg" src="<?php echo get_stylesheet_directory_uri(); ?>/images/bg_left.png" alt="leftbg"/>
		<span id="logo-img">
			<?php $url = get_site_url();
			if(strpos($url, "/en") != false)
				$url.="/homepage";
			?>
			<a href="<?php echo $url;?>">
			
			<?php $pos = strpos($url, "/en");
					if($pos=== false){
			?>
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png" alt="logo"/>
			<?php }else{?>
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo_eng.png" alt="logo"/><?php }?>
			</a>
			</span>
		<span id="header1-clear2" class="header-clear2"></span>
		</span>
	<span id="header2-wrapper">
	<img id="rightbg" src="<?php echo get_stylesheet_directory_uri(); ?>/images/bg_right.png" alt="rightbg"/>
	<span id="header2">
		<span id="header2-clear1" class="header-clear1"></span>
		<span id="top-menu">
			<nav id="access" role="navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
				<?php //get_sidebar('4');?><!-- main menu-->
			
			</nav>
			</span><!-- #access -->
			<span id="social">
					<a STYLE="text-decoration:none" href="<?php get_site_url(); ?>/">
        				<img src="<?php echo get_stylesheet_directory_uri(); ?>/languageflags/greekflag.png" alt="GR"></a>
					<a STYLE="text-decoration:none" href="<?php get_site_url(); ?>/en/homepage">
       			   	 <img src="<?php echo get_stylesheet_directory_uri(); ?>/languageflags//ukflag.png" alt="EN"></a>
       			    <a STYLE="text-decoration:none" href="https://www.facebook.com/mythicalpeloponnese">
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/facebook_icon.jpg" alt="facebook"></a>
				    <a STYLE="text-decoration:none" href="https://www.twitter.com/mythpeloponnese">
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/twitter_icon.jpg" alt="twitter"></a>
					<a STYLE="text-decoration:none" href="https://www.youtube.com/mythicalpeloponnese">
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/ytube.jpg" alt="youtube"></a>
			</span>
			<span id="misc">
			<div id="misc-clear"></div>
				<?php get_sidebar('top');?>
			</span><!--search,pressKite.t.c.-->

		<!--<hgroup>
			<h1 id="site-title"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
		</hgroup>

		<nav id="access" role="navigation">
			<h1 class="assistive-text section-heading"><?php _e( 'Main menu', 'toolbox' ); ?></h1>
			<div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'toolbox' ); ?>"><?php _e( 'Skip to content', 'toolbox' ); ?></a></div>

			
		</nav><!-- #access -->
		
		<span id="header2-clear2" class="header-clear2"></span>
		</span>
		</span>
	<div id="clear"></div>
	</header></div><!-- #branding, #header-wrapper -->
	<div id="main">
		
		<?php
		get_sidebar('3');?>
	
