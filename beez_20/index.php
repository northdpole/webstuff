<?php
/**
 * @package                Joomla.Site
 * @subpackage	Templates.beez_20
 * @copyright        Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license                GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

jimport('joomla.filesystem.file');

// check modules
$showRightColumn	= ($this->countModules('position-3') or $this->countModules('position-6') or $this->countModules('position-8'));
$showbottom			= ($this->countModules('position-9') or $this->countModules('position-10') or $this->countModules('position-11'));
$showleft			= ($this->countModules('position-4') or $this->countModules('position-7') or $this->countModules('position-5'));

if ($showRightColumn==0 and $showleft==0) {
	$showno = 0;
}

JHtml::_('behavior.framework', true);

// get params
$color				= $this->params->get('templatecolor');
$logo				= $this->params->get('logo');
$navposition		= $this->params->get('navposition');
$app				= JFactory::getApplication();
$doc				= JFactory::getDocument();
$templateparams		= $app->getTemplate(true)->params;

$doc->addStyleSheet($this->baseurl.'/templates/system/css/system.css');
$doc->addStyleSheet($this->baseurl.'/templates/'.$this->template.'/css/position.css', $type = 'text/css', $media = 'screen,projection');
$doc->addStyleSheet($this->baseurl.'/templates/'.$this->template.'/css/layout.css', $type = 'text/css', $media = 'screen,projection');
$doc->addStyleSheet($this->baseurl.'/templates/'.$this->template.'/css/print.css', $type = 'text/css', $media = 'print');

$files = JHtml::_('stylesheet', 'templates/'.$this->template.'/css/general.css', null, false, true);
if ($files):
	if (!is_array($files)):
		$files = array($files);
	endif;
	foreach($files as $file):
		$doc->addStyleSheet($file);
	endforeach;
endif;

$doc->addStyleSheet('templates/'.$this->template.'/css/'.htmlspecialchars($color).'.css');
if ($this->direction == 'rtl') {
	$doc->addStyleSheet($this->baseurl.'/templates/'.$this->template.'/css/template_rtl.css');
	if (file_exists(JPATH_SITE . '/templates/' . $this->template . '/css/' . $color . '_rtl.css')) {
		$doc->addStyleSheet($this->baseurl.'/templates/'.$this->template.'/css/'.htmlspecialchars($color).'_rtl.css');
	}
}

$doc->addScript($this->baseurl.'/templates/'.$this->template.'/javascript/md_stylechanger.js', 'text/javascript');
$doc->addScript($this->baseurl.'/templates/'.$this->template.'/javascript/hide.js', 'text/javascript');



JHTML::_('behavior.calendar');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >
<head>
<jdoc:include type="head" />

<!--[if lte IE 6]>
<link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/ieonly.css" rel="stylesheet" type="text/css" />
<?php if ($color=="personal") : ?>
<style type="text/css">
#line {
	width:98% ;
}
.logoheader {
	height:200px;
}
#header ul.menu {
	display:block !important;
	width:98.2% ;
}
</style>
<?php endif; ?>
<![endif]-->

<!--[if IE 7]>
<link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/ie7only.css" rel="stylesheet" type="text/css" />
<![endif]-->

<script type="text/javascript">
	var big ='<?php echo (int)$this->params->get('wrapperLarge');?>%';
	var small='<?php echo (int)$this->params->get('wrapperSmall'); ?>%';
	var altopen='<?php echo JText::_('TPL_BEEZ2_ALTOPEN', true); ?>';
	var altclose='<?php echo JText::_('TPL_BEEZ2_ALTCLOSE', true); ?>';
	var bildauf='<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/images/plus.png';
	var bildzu='<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/images/minus.png';
	var rightopen='<?php echo JText::_('TPL_BEEZ2_TEXTRIGHTOPEN', true); ?>';
	var rightclose='<?php echo JText::_('TPL_BEEZ2_TEXTRIGHTCLOSE', true); ?>';
	var fontSizeTitle='<?php echo JText::_('TPL_BEEZ2_FONTSIZE', true); ?>';
	var bigger='<?php echo JText::_('TPL_BEEZ2_BIGGER', true); ?>';
	var reset='<?php echo JText::_('TPL_BEEZ2_RESET', true); ?>';
	var smaller='<?php echo JText::_('TPL_BEEZ2_SMALLER', true); ?>';
	var biggerTitle='<?php echo JText::_('TPL_BEEZ2_INCREASE_SIZE', true); ?>';
	var resetTitle='<?php echo JText::_('TPL_BEEZ2_REVERT_STYLES_TO_DEFAULT', true); ?>';
	var smallerTitle='<?php echo JText::_('TPL_BEEZ2_DECREASE_SIZE', true); ?>';
</script>
<?php
  // load jQuery, if not loaded before
  if(!JFactory::getApplication()->get('jquery')){
     JFactory::getApplication()->set('jquery',true);
     $document = JFactory::getDocument();
     $document->addScript(JURI::root() . "templates/beez_20/javascript/jquery-1.8.3.min.js");
  }
?>
<script>
<?php
$doc->addScript($this->baseurl.'/templates/'.$this->template.'/javascript/slides.min.jquery.js', 'text/javascript');

?>

//OTHER FUNCTIONS & SUBMIT THE BOOK REQUEST 
		
	function validateEmail(email) {
	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	if( !emailReg.test( email ) ) {
	return false;
	} else {
	return true;
	}
	}
	
	function menuPos() {
	jQuery(".menu").css({"width":"auto"});
	var logo_size=jQuery(".logoheader").outerWidth();
	var menu_size=jQuery(".menu").outerWidth();
	var wrapper_size=jQuery("#back").outerWidth();
	if ((logo_size+menu_size)>wrapper_size) {
	jQuery(window).unbind("resize",menuPos);
	jQuery(".menu").css({"position":"relative", "width":"100%","left":"0px","height":"auto","overflow":"visible"});
	
	}
	
	else {
	jQuery(".menu").css({"position":"absolute","right":"-13px","height":"2.5em","left":"auto"});
	}
	
	jQuery(window).bind("resize",menuPos);
	
	
	
	
	}
	jQuery(document).ready(function() {
	//menu position
	menuPos();
	//
	jQuery(window).bind("resize",menuPos);
	
	
	//hotels 
	jQuery("#hotel_sliders > div").hide();
	jQuery("#choose_loc li").click(function() {
	jQuery("#choose_loc li").removeClass("press");
	var tab="#"+jQuery(this).attr("class");
	//alert(tab);
	jQuery(this).addClass("press");
	jQuery("#hotel_sliders > div").fadeOut(800);
	setTimeout(function() {jQuery(tab).fadeIn(800);},800);
	
	
	}) //end click
	
	//multicategories
	if (jQuery(".multi").length)
	{
	jQuery(".multi").css({"width":"30%","height":"auto","margin-right":"3%"});
	jQuery(".multi").find("img").css({"width":"100%","max-height":"180px","height":"75%"});
	
	}
	
	//SLIDESHOW
	if (jQuery("#slideshow").length)
	{
	
         
		 
      jQuery("#slideshow").slidesjs({
        width: 1200,
        height: 403,
		play: {
          active: false,
          auto: true,
          interval: 4000,
          swap: true
        },
		navigation: {
      active: true,
       effect: "slide"
        
    },
	pagination:{
	active:true,
	effect:"slide"
	
	},
	effect: {
      slide: {
        
        speed: 800
          // [number] Speed in milliseconds of the slide animation.
      },
      fade: {
        speed: 300,
          // [number] Speed in milliseconds of the fade animation.
        crossfade: true
          // [boolean] Cross-fade the transition.
      }
    }
      });
    
      
    
	}
	
	//VM
	if(jQuery(".vmproductSnapshot").length){
	
	jQuery(".vmproductSnapshot").find("br").remove();
	
	}
	if (jQuery("#BookNow").length)
	
	{
	jQuery("#bookform").submit(function (){
			
			jQuery(".formerror").remove();
			jQuery("#bookform").find("br").remove();
			jQuery('#bookform input').css("border","1px solid #CCCCCC");
            var surname = jQuery('input[name="surname"]').val();
			var name = jQuery('input[name="name"]').val();
			var email = jQuery('input[name="email"]').val();
			var numofpersons = parseInt(jQuery('input[name="numofpersons"]').val());
			var num1 = parseInt(jQuery('input[name="num1"]').val());
			var num2 = parseInt(jQuery('input[name="num2"]').val());
			var sum = parseInt(jQuery('input[name="sum"]').val());
			var vmid = jQuery('input[name="vmid"]').val();
			var depart = jQuery('input[name="depart"]').val();
			var return1 = jQuery('input[name="return1"]').val();
			var prname = jQuery('input[name="prname"]').val();
        
		// DO SOME BASIC CHECKS BEFORA SUBMITING THE FORM   
       if (surname=="") {
	   jQuery('input[name="surname"]').css({"border-color":"red","border-width":"3px"}).parent().append("<br/><div class='formerror'>You have to fill in this field</div>");
	   var error=1;
	   }
	   if (name=="") {
	   jQuery('input[name="name"]').css({"border-color":"red","border-width":"3px"}).parent().append("<br/><div class='formerror'>You have to fill in this field</div>")
	   var error=1;
	   }
	   if ((!validateEmail(email)) || (email=="")) {
	   jQuery('input[name="email"]').css({"border-color":"red","border-width":"3px"}).parent().append("<br/><div class='formerror'>You have provided a wrong email</div>")
	   var error=1;
	   }
	    
	   if (parseInt(sum)!=parseInt(num1+num2)) {
	   jQuery('input[name="sum"]').css({"border-color":"red","border-width":"3px"}).parent().append("<br/><div class='formerror'>The number you provided is wrong</div>")
	   var error=1;
	   }
	   
	   if (error==1) {
	   return false;
	   }
	   
	   else {
        var formdata = jQuery("#bookform").serialize();
		jQuery.ajax({
            type: "POST",
            url: "http://heaven2.telesto.gr/book_now.php",
            data:formdata,
            dataType: "json",
            cache: false,
			beforeSend: function(){
		// Handle the beforeSend event
			jQuery('#bookresults').html('<strong>Loading</strong>');
			},

        complete: function(){
        // Handle the complete event
		
         setTimeout("jQuery('#bookresults').slideUp()",4000);
		 
        },
            success: function(data) {
				
					jQuery('#bookresults').html('<div class="notification '+data.class+' png_bg"><div>'+data.state+'</div></div>');
					jQuery('#bookresults').slideDown();
					if(data.class=="success") {
					setTimeout('window.location.href = "/"',6000);
					}
   //setTimeout ('hide()', 5000);
 
              
            }
        });
        
    } //end if statement regarding the error variable
	return false;
	}) //end live trigger
	} //end if book statement for checking of BookNow exists
	}) //end ready statement

</script>
<script>
jQuery(window).load(function(){
var n_height=jQuery(window).height();
jQuery("html").height(n_height);


});


</script>

</head>

<body>

<div id="all">
        <div id="back">
                <div id="header">
				                <div class="logo_menu">
                                <div class="logoheader">
									<a href="<?php JURI::base(); ?>">
                                        <h1 id="logo">
							
                                        <?php if ($logo): ?>
                                        
                                        <img src="<?php echo $this->baseurl ?>/<?php echo htmlspecialchars($logo); ?>"  alt="<?php echo htmlspecialchars($templateparams->get('sitetitle'));?>" />
                                        <?php endif;?>
                                        <?php if (!$logo ): ?>
                                        <?php echo htmlspecialchars($templateparams->get('sitetitle'));?>
                                        <?php endif; ?>
                                        <span class="header1">
                                        <?php echo htmlspecialchars($templateparams->get('sitedescription'));?>
                                        </span></h1>
                                        </a>
                                </div><!-- end logoheader -->
                                        <ul class="skiplinks">
                                                <li><a href="#main" class="u2"><?php echo JText::_('TPL_BEEZ2_SKIP_TO_CONTENT'); ?></a></li>
                                                <li><a href="#nav" class="u2"><?php echo JText::_('TPL_BEEZ2_JUMP_TO_NAV'); ?></a></li>
                                            <?php if($showRightColumn ):?>
                                            <li><a href="#additional" class="u2"><?php echo JText::_('TPL_BEEZ2_JUMP_TO_INFO'); ?></a></li>
                                           <?php endif; ?>
                                        </ul>
                                        <h2 class="unseen"><?php echo JText::_('TPL_BEEZ2_NAV_VIEW_SEARCH'); ?></h2>
                                        <h3 class="unseen"><?php echo JText::_('TPL_BEEZ2_NAVIGATION'); ?></h3>
                                        <jdoc:include type="modules" name="position-1" />
                                        <div id="languange-bar"><jdoc:include type="modules" name="language-bar" /></div>
                                        </div>
                                        <!--<div id="line">
                                        <div id="fontsize"></div>
                                        <h3 class="unseen"><?php echo JText::_('TPL_BEEZ2_SEARCH'); ?></h3>
                                        </div> <!-- end line -->

						<div id="banner-area">
							  <jdoc:include type="modules" name="position-0" />
						</div>
                        </div><!-- end header -->
                        <div id="<?php echo $showRightColumn ? 'contentarea2' : 'contentarea'; ?>">
                                        <div id="breadcrumbs">

                                                        <jdoc:include type="modules" name="position-2" />

                                        </div>

                                        <?php if ($navposition=='left' and $showleft) : ?>


                                                        <div class="left1 <?php if ($showRightColumn==NULL){ echo 'leftbigger';} ?>" id="nav">
                                                   <jdoc:include type="modules" name="position-7" style="beezDivision" headerLevel="3" />
                                                                <jdoc:include type="modules" name="position-4" style="beezHide" headerLevel="3" state="0 " />
                                                                <jdoc:include type="modules" name="position-5" style="beezTabs" headerLevel="2"  id="3" />


                                                        </div><!-- end navi -->
               <?php endif; ?>

                                        <div id="<?php echo $showRightColumn ? 'wrapper' : 'wrapper2'; ?>" <?php if (isset($showno)){echo 'class="shownocolumns"';}?>>

                                                <div id="main">

                                                <?php if ($this->countModules('position-12')): ?>
                                                        <div id="top"><jdoc:include type="modules" name="position-12"   />
                                                        </div>
                                                <?php endif; ?>

                                                        <jdoc:include type="message" />
                                                        <jdoc:include type="component" />

                                                </div><!-- end main -->

                                        </div><!-- end wrapper -->

                                <?php if ($showRightColumn) : ?>
                                        <h2 class="unseen">
                                                <?php echo JText::_('TPL_BEEZ2_ADDITIONAL_INFORMATION'); ?>
                                        </h2>
                                        <div id="close">
                                                <a href="#" onclick="auf('right')">
                                                        <span id="bild">
                                                                <?php echo JText::_('TPL_BEEZ2_TEXTRIGHTCLOSE'); ?></span></a>
                                        </div>


                                        <div id="right">
                                                <a id="additional"></a>
                                                <jdoc:include type="modules" name="position-6" style="beezDivision" headerLevel="3"/>
                                                <jdoc:include type="modules" name="position-8" style="beezDivision" headerLevel="3"  />
                                                <jdoc:include type="modules" name="position-3" style="beezDivision" headerLevel="3"  />
                                        </div><!-- end right -->
                                        <?php endif; ?>

                        <?php if ($navposition=='center' and $showleft) : ?>

                                        <div class="left <?php if ($showRightColumn==NULL){ echo 'leftbigger';} ?>" id="nav" >

                                                <jdoc:include type="modules" name="position-7"  style="beezDivision" headerLevel="3" />
                                                <jdoc:include type="modules" name="position-4" style="beezHide" headerLevel="3" state="0 " />
                                                <jdoc:include type="modules" name="position-5" style="beezTabs" headerLevel="2"  id="3" />


                                        </div><!-- end navi -->
                   <?php endif; ?>

                                <div class="wrap"></div>

                                </div> <!-- end contentarea -->

                        </div><!-- back -->

                </div><!-- all -->

                <div id="footer-outer">
                        <?php if ($showbottom) : ?>
                        <div id="footer-inner">

                                <div id="bottom">
                                        <div class="box box1"> <jdoc:include type="modules" name="position-9" style="beezDivision" headerlevel="3" /></div>
                                        <div class="box box2"> <jdoc:include type="modules" name="position-10" style="beezDivision" headerlevel="3" /></div>
                                        <div class="box box3"> <jdoc:include type="modules" name="position-11" style="beezDivision" headerlevel="3" /></div>
                                        <div class="box box4"> <jdoc:include type="modules" name="footer-right" /></div>
                                </div>


                        </div>
                                <?php endif ; ?>

                        <div id="footer-sub">


                                <div id="footer">

                                        <jdoc:include type="modules" name="position-14" />
                                        <!--<p>
                                                <?php echo "Powered by Telesto Ltd - All rights reserved";?> 
                                        </p>-->


                                </div><!-- end footer -->

                        </div>

                </div>
				<jdoc:include type="modules" name="debug" />
				<script>

			var as = document.getElementsByTagName("a");
			[].forEach.call(as, function (a) {
			if (a.textContent.indexOf("powered by \"DM PinBoard Lite\" - get \"DM PinBoard Pro\" now!") > -1) {
			a.style.display = "none";
			}
		});
		</script>
		
        </body>
</html>
