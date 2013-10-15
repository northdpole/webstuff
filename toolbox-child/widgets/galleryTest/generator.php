<?php

function generate_gallery($lang){
	$images = array();
	$caption = array();
	$link = array();
	$path =  get_stylesheet_directory_uri()."/widgets/galleryTest/images/";

	if( 'gr' == $lang){
		$file = get_stylesheet_directory_uri()."/widgets/galleryTest/caption_info_gr.txt";
	} else {
		$file = get_stylesheet_directory_uri()."/widgets/galleryTest/caption_info_en.txt";
	}
	$stuff = file_get_contents($file);
	$pieces = explode(";\n", $stuff);
	$i=0;
	foreach($pieces as $string){
		if($string[0]=="#" || empty($string))
			continue;
		$tmp = explode("=>",$string);
		$caption[$tmp[0]] = $tmp[1];
		$images[$tmp[0]] =  $tmp[2];
		$link[$tmp[0]] =  $tmp[3];
	/*
	echo"<p>";
	var_dump($caption[$tmp[0]]);
	echo "</p>";
	echo"<p>";
	var_dump($images[$tmp[0]]);
	echo "</p>";
	*/
	}
	
	foreach($images as $filename=>$description_text){?>
		<li id="<?php echo $i;?>">
			<img alt=<?php echo $filename;?> class="galleryThumbnail" src="<?php echo get_stylesheet_directory_uri();?>/widgets/galleryTest/images/<?php echo $filename;?>" />
			<div  class="info">
				<a href=<?php echo $link[$filename];?>>
					<img class="gallery_more" alt="read_moar" src="<?php echo get_stylesheet_directory_uri();?>/widgets/galleryTest/galleryMore.png">
				</a>	
				<p class="gallery_caption"><?php echo $description_text;?></p>
			</div>
				<span class="galleryThumbContainer">
					<div class="galleryExpTitle"><?php echo $caption[$filename]?></div>
				</span>
		</li>
	<?php $i++;
	}
}
?>
