<head>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>
 <script src="http://code.jquery.com/jquery-latest.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_directory_uri();?>/map.css" />
<script>
  

  function flagsAnimationShow(flagId,containerId){
  $(flagId).slideDown("slow");
  $(containerId).animate({"top":"-=50px"},"slow");
  }

  function flagsAnimationHide(flagId,containerId){
  $(flagId).slideUp("slow");
  $(containerId).animate({"top":"+=50px"},"slow");
  } 

  var flagPos = 0;
  var flagLength = 12;
  var flags = new Array();
  flags[0] = "#flagA";
  flags[1] = "#flagB";
  flags[2] = "#flagC";
  flags[3] = "#flagD";
  flags[4] = "#flagE";
  flags[5] = "#flagF";
  flags[6] = "#flagG";
  flags[7] = "#flagH";
  flags[8] = "#flagI";
  flags[9] = "#flagJ";
  flags[10] = "#flagK";
  flags[11] = "#flagL";
  flags[12] = "#flagM";

  var flagWraps = new Array();
  flagWraps[0] = "#wrapA";
  flagWraps[1] = "#wrapB";
  flagWraps[2] = "#wrapC";
  flagWraps[3] = "#wrapD";
  flagWraps[4] = "#wrapE";
  flagWraps[5] = "#wrapF";
  flagWraps[6] = "#wrapG";
  flagWraps[7] = "#wrapH";
  flagWraps[8] = "#wrapI";
  flagWraps[9] = "#wrapJ";
  flagWraps[10] = "#wrapK";
  flagWraps[11] = "#wrapL";
  flagWraps[12] = "#wrapM";

  function showFlag() {
  if(flagPos == 0)
  flagsAnimationHide(flags[flags.length-1],flagWraps[flags.length-1]);
  else
  flagsAnimationHide(flags[flagPos-1],flagWraps[flagPos-1]);

  flagsAnimationShow(flags[flagPos],flagWraps[flagPos]);
  flagPos++;
  if(flagPos>=flags.length)
  flagPos = 0;

  }

  $(document).ready(function() {

  window.setInterval(showFlag, 3000);
  /*var i;
  for(i = 0; i < flags.length; i++)
		flagsAnimationShow(flags[flagPos],flagWraps[flagPos]);*/
});
</script>
 
<?php function map_pro($lang) { ?> 
<div id="mapContainer">
	<div id="map" >
    <?php if($lang == 'gr') {?>
	<div id="wrapA" class="wrap">
		<a id="foo" href="<?php get_site_url(); ?>/blog/κόρινθος/ ">
      <span id="flagA" class="flag">
        <img class="flag-img" src="<?php echo get_stylesheet_directory_uri();?>/widgets/mapTest/flag1.png"/>
        <span class="maptext">Κόρινθος</span> 
      </span>
		</a>
	</div>
    <?php }else{?>
    <div id="wrapA" class="wrap">
      <a id="foo" href="<?php get_site_url(); ?>/en/corinth/ ">
        <span id="flagA" class="flag">
          <img class="flag-img" src="<?php echo get_stylesheet_directory_uri();?>/widgets/mapTest/flag1.png"/>
          <span class="maptext">Corinth</span>
        </span>
      </a>
    </div>
   <?php } ?>

    <?php if($lang == 'gr') {?>
    <div id="wrapB" class="wrap">
      <a id="foo" href="<?php get_site_url(); ?>/blog/αρχαιολογικός-χώρος-ηραίου-περαχώρα/">
        <span id="flagB" class="flag">
          <img class="flag-img" src="<?php echo get_stylesheet_directory_uri();?>/widgets/mapTest/flag2.png"/>
          <span class="maptext">Ηραίο</span>
        </span>
      </a>
    </div>
    <?php }else{?>
    <div id="wrapB" class="wrap">
      <a id="foo" href="<?php get_site_url(); ?>/en/archaeological-site-of-heraion-perachora/ ">
        <span id="flagB" class="flag">
          <img class="flag-img" src="<?php echo get_stylesheet_directory_uri();?>/widgets/mapTest/flag2.png"/>
          <span class="maptext">Heraion</span>
        </span>
      </a>
    </div>
    <?php } ?>

    <?php if($lang == 'gr') {?>
    <div id="wrapC" class="wrap">
      <a id="foo" href="<?php get_site_url(); ?>/blog/κάστρο-μεθώνης/">
        <span id="flagC" class="flag">
          <img class="flag-img" src="<?php echo get_stylesheet_directory_uri();?>/widgets/mapTest/flag3.png"/>
          <span class="maptext">Μεθώνη</span>
        </span>
      </a>
    </div>
    <?php }else{?>
    <div id="wrapC" class="wrap">
      <a id="foo" href="<?php get_site_url(); ?>/en/the-castle-of-methoni/ ">
        <span id="flagC" class="flag">
          <img class="flag-img" src="<?php echo get_stylesheet_directory_uri();?>/widgets/mapTest/flag3.png"/>
          <span class="maptext">Methoni</span>
        </span>
      </a>
    </div>
    <?php } ?>

    <?php if($lang == 'gr') {?>
    <div id="wrapD" class="wrap">
      <a id="foo" href="<?php get_site_url(); ?>/blog/driving-mani/">
        <span id="flagD" class="flag">
          <img class="flag-img" src="<?php echo get_stylesheet_directory_uri();?>/widgets/mapTest/flag4.png"/>
          <span class="maptext">Μάνη</span>
        </span>
      </a>
    </div>
    <?php }else{?>
    <div id="wrapD" class="wrap">
      <a id="foo" href="<?php get_site_url(); ?>/en/driving-around-mani/ ">
        <span id="flagD" class="flag">
          <img class="flag-img" src="<?php echo get_stylesheet_directory_uri();?>/widgets/mapTest/flag4.png"/>
          <span class="maptext">Mani</span>
        </span>
      </a>
    </div>
    <?php } ?>

    <?php if($lang == 'gr') {?>
    <div id="wrapE" class="wrap">
      <a id="foo" href="<?php get_site_url(); ?>/blog/μυστράς/">
        <span id="flagE" class="flag">
          <img class="flag-img" src="<?php echo get_stylesheet_directory_uri();?>/widgets/mapTest/flag5.png"/>
          <span class="maptext">Μυστράς</span>
        </span>
      </a>
    </div>
    <?php }else{?>
    <div id="wrapΕ" class="wrap">
      <a id="foo" href="<?php get_site_url(); ?>/en/mystras/ ">
        <span id="flagΕ" class="flag">
          <img class="flag-img" src="<?php echo get_stylesheet_directory_uri();?>/widgets/mapTest/flag5.png"/>
          <span class="maptext">Mystras</span>
        </span>
      </a>
    </div>
    <?php } ?>

    <?php if($lang == 'gr') {?>
    <div id="wrapF" class="wrap">
      <a id="foo" href="<?php get_site_url(); ?>/blog/κάστρο-μονεμβασιάς/">
        <span id="flagF" class="flag">
          <img class="flag-img" src="<?php echo get_stylesheet_directory_uri();?>/widgets/mapTest/flag6.png"/>
          <span class="maptext">Μονεμβασιά</span>
        </span>
      </a>
    </div>
    <?php }else{?>
    <div id="wrapF" class="wrap">
      <a id="foo" href="<?php get_site_url(); ?>/en/the-castle-of-monemvasia/ ">
        <span id="flagF" class="flag">
          <img class="flag-img" src="<?php echo get_stylesheet_directory_uri();?>/widgets/mapTest/flag6.png"/>
          <span class="maptext">Monemvasia</span>
        </span>
      </a>
    </div>
    <?php } ?>

    <?php if($lang == 'gr') {?>
    <div id="wrapG" class="wrap">
      <a id="foo" href="<?php get_site_url(); ?>/blog/νιόκαστρο-πύλος/ ">
        <span id="flagG" class="flag">
          <img class="flag-img" src="<?php echo get_stylesheet_directory_uri();?>/widgets/mapTest/flag7.png"/>
          <span class="maptext">Πύλος</span>
        </span>
      </a>
    </div>
    <?php }else{?>
    <div id="wrapG" class="wrap">
      <a id="foo" href="<?php get_site_url(); ?>/en/niokastro-pylos/ ">
        <span id="flagG" class="flag">
          <img class="flag-img" src="<?php echo get_stylesheet_directory_uri();?>/widgets/mapTest/flag7.png"/>
          <span class="maptext">Pylos</span>
        </span>
      </a>
    </div>
    <?php } ?>
    
        <?php if($lang == 'gr') {?>
    <div id="wrapH" class="wrap">
      <a id="foo" href="<?php get_site_url(); ?>/blog/μεγάλο-θέατρο-επιδαύρου-2/ ">
        <span id="flagH" class="flag">
          <img class="flag-img" src="<?php echo get_stylesheet_directory_uri();?>/widgets/mapTest/flag8.png"/>
          <span class="maptext">Επίδαυρος</span>
        </span>
      </a>
    </div>
    <?php }else{?>
    <div id="wrapH" class="wrap">
      <a id="foo" href="<?php get_site_url(); ?>/en/the-theater-of-epidaurus-2/ ">
        <span id="flagH" class="flag">
          <img class="flag-img" src="<?php echo get_stylesheet_directory_uri();?>/widgets/mapTest/flag8.png"/>
          <span class="maptext">Epidaurus</span>
        </span>
      </a>
    </div>
    <?php } ?>
    
        <?php if($lang == 'gr') {?>
    <div id="wrapI" class="wrap">
      <a id="foo" href="<?php get_site_url(); ?>/blog/χιονοδρομικό-κέντρο-μαινάλου/">
        <span id="flagI" class="flag">
          <img class="flag-img" src="<?php echo get_stylesheet_directory_uri();?>/widgets/mapTest/flag9.png"/>
          <span class="maptext">Μαίναλο</span>
        </span>
      </a>
    </div>
    <?php }else{?>
    <div id="wrapI" class="wrap">
      <a id="foo" href="<?php get_site_url(); ?>/en/the-ski-center-in-mainalo/ ">
        <span id="flagI" class="flag">
          <img class="flag-img" src="<?php echo get_stylesheet_directory_uri();?>/widgets/mapTest/flag9.png"/>
          <span class="maptext">Mainalo</span>
        </span>
      </a>
    </div>
    <?php } ?>
    
        <?php if($lang == 'gr') {?>
    <div id="wrapJ" class="wrap">
      <a id="foo" href="<?php get_site_url(); ?>/blog/μυκήνες/ ">
        <span id="flagJ" class="flag">
          <img class="flag-img" src="<?php echo get_stylesheet_directory_uri();?>/widgets/mapTest/flag10.png"/>
          <span class="maptext">Μυκήνες</span>
        </span>
      </a>
    </div>
    <?php }else{?>
    <div id="wrapJ" class="wrap">
      <a id="foo" href="<?php get_site_url(); ?>/en/mycenae-2/ ">
        <span id="flagJ" class="flag">
          <img class="flag-img" src="<?php echo get_stylesheet_directory_uri();?>/widgets/mapTest/flag10.png"/>
          <span class="maptext">Mycenae</span>
        </span>
      </a>
    </div>
    <?php } ?>
    
        <?php if($lang == 'gr') {?>
    <div id="wrapK" class="wrap">
      <a id="foo" href="<?php get_site_url(); ?>/blog/ναύπλιο/ ">
        <span id="flagK" class="flag">
          <img class="flag-img" src="<?php echo get_stylesheet_directory_uri();?>/widgets/mapTest/flag11.png"/>
          <span class="maptext">Ναύπλιο</span>
        </span>
      </a>
    </div>
    <?php }else{?>
    <div id="wrapK" class="wrap">
      <a id="foo" href="<?php get_site_url(); ?>/en/nafplio/ ">
        <span id="flagK" class="flag">
          <img class="flag-img" src="<?php echo get_stylesheet_directory_uri();?>/widgets/mapTest/flag11.png"/>
          <span class="maptext">Nafplio</span>
        </span>
      </a>
    </div>
    <?php } ?>
    
        <?php if($lang == 'gr') {?>
    <div id="wrapL" class="wrap">
      <a id="foo" href="<?php get_site_url(); ?>/blog/ναβαρίνο/ ">
        <span id="flagL" class="flag">
          <img class="flag-img" src="<?php echo get_stylesheet_directory_uri();?>/widgets/mapTest/flag12.png"/>
          <span class="maptext">Ναβαρίνο</span>
        </span>
      </a>
    </div>
    <?php }else{?>
    <div id="wrapL" class="wrap">
      <a id="foo" href="<?php get_site_url(); ?>/en/navarino/ ">
        <span id="flagL" class="flag">
          <img class="flag-img" src="<?php echo get_stylesheet_directory_uri();?>/widgets/mapTest/flag12.png"/>
          <span class="maptext">Navarino</span>
        </span>
      </a>
    </div>
    <?php } ?>
    
        <?php if($lang == 'gr') {?>
    <div id="wrapM" class="wrap">
      <a id="foo" href="<?php get_site_url(); ?>/blog/τα-μονοπάτια-του-ταΰγετου/ ">
        <span id="flagM" class="flag">
          <img class="flag-img" src="<?php echo get_stylesheet_directory_uri();?>/widgets/mapTest/flag13.png"/>
          <span class="maptext">Ταΰγετος</span>
        </span>
      </a>
    </div>
    <?php }else{?>
    <div id="wrapM" class="wrap">
      <a id="foo" href="<?php get_site_url(); ?>/en/mount-taygetus-paths/ ">
        <span id="flagM" class="flag">
          <img class="flag-img" src="<?php echo get_stylesheet_directory_uri();?>/widgets/mapTest/flag13.png"/>
          <span class="maptext">Taygetus</span>
        </span>
      </a>
    </div>
    <?php } ?>
    
    

    <img id="mapImg" src="<?php echo get_stylesheet_directory_uri();?>/widgets/mapTest/map.png"/>

</div>
</div>
<?php } ?>

