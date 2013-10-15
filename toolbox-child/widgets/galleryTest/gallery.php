<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta content="text/html; charset=UTF-8" http-equiv="Content-Type"/>

<title>Gallery Test</title>
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri();?>/widgets/galleryTest/style.css" />
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script> 
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script> 
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri();?>/widgets/galleryTest/animation.js"></script> 
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri();?>/widgets/galleryTest/style.js"></script> 
<script type="text/javascript">

function infofix(){
	var li_height = $('.upper li').outerHeight();
	$('.info').css({'height': li_height});

	//alert(li_height);
}

/*
function adaptImageSize() {
    var size = $('.upper ul').outerWidth();
    var width = 13.4*size/100;

    $(".upper li").css('width',width);
    
    alert(width +" "+ size);
}
$(window).resize(adaptImageSize);
*/
$(document).ready(function() {
infoText();
carousel();
//horizontall_center_ul();
//adaptImageSize();
});

$(window).load(function(){
infofix();
vertical_center_ul();

})

</script>
</head>
<body>
<?php 
function print_gallery($lang){
?>
	<div id="carousel">
		<div id="buttons">
			<a href="#" id="prev"><img src="<?php echo get_stylesheet_directory_uri();?>/widgets/galleryTest/back.png"></a>
			<a href="#" id="next"><img src="<?php echo get_stylesheet_directory_uri();?>/widgets/galleryTest/next.png"></a>
			<div  class="clear"></div>
		</div>
		<div  class="clear"></div>
	<div id="wrapper">
		<div id="slides">
			<div class="upper">
				<ul>
					<?php
					require 'generator.php'; 
					generate_gallery($lang);?>
				</ul>
			</div>
			<div  class="clear"></div>
		</div>
	</div></div>
<?php }
?>
</body>
</html>
