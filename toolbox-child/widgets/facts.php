<?php
define( 'PATH', dirname( __FILE__ ));
define('STYLESHEET',get_stylesheet_directory_uri());
function facts($lang){
$images=array();
$images[0] = STYLESHEET."/widgets/facts_img/nature.png";
$images[1] = STYLESHEET."/widgets/facts_img/archaelogy.png";
$images[2] = STYLESHEET."/widgets/facts_img/year_round.png";
$images[3] = STYLESHEET."/widgets/facts_img/activities.png";
$images[4] = STYLESHEET."/widgets/facts_img/medieval.png";
$images[5] = STYLESHEET."/widgets/facts_img/special.png";
$images[6] = STYLESHEET."/widgets/facts_img/museums.png";
$images[7] = STYLESHEET."/widgets/facts_img/religion.png";
$images[8] = STYLESHEET."/widgets/facts_img/modern.png";
$i=0;
?>

<div id="promo_facts_wrapper">
	<span id="facts_promo_upper">
		<ul id="facts_promo_upper_ul"> 
			<li class="color-849784">
			 <?php if($lang == 'gr') {?>
        <a STYLE="text-decoration:none" href="<?php get_site_url(); ?>/blog/φύση/">
        <img src="<? echo $images[$i];$i++?>" class="facts_promo_img 849784" alt="Nature"/>
          <span class="facts_promo_caption_wrapper">
					<span class="facts_promo_caption">
            		 Φύση
					</span>
				</span>
        </a>
        <?php }else{?>
        <a STYLE="text-decoration:none" href="<?php get_site_url(); ?>/en/nature/">
        <img src="<? echo $images[$i];$i++?>" class="facts_promo_img  849784" alt="Nature"/>
          <span class="facts_promo_caption_wrapper">
					<span class="facts_promo_caption">
             			Nature
					</span>
				</span>
        </a>
        <?php } ?>
			</li>
			<li class="color-c2b088">
        <?php if($lang == 'gr') {?>
        <a STYLE="text-decoration:none" href="<?php get_site_url(); ?>/blog/αρχαιολογία/">
          <img src="<? echo $images[$i];$i++?>" class="facts_promo_img c2b088" alt="Αρχαιολογία"/>
          <span class="facts_promo_caption_wrapper">
            <span class="facts_promo_caption">
              Αρχαιολογία
            </span>
          </span>
        </a>
        <?php }else{?>
        <a STYLE="text-decoration:none" href="<?php get_site_url(); ?>/en/archaeology/">
          <img src="<? echo $images[$i];$i++?>" class="facts_promo_img c2b088" alt="Archaeology"/>
          <span class="facts_promo_caption_wrapper">
            <span class="facts_promo_caption">
              Archaeology
            </span>
          </span>
        </a>
        <?php } ?>
			</li>
		<!--	<li class="color-a5b0b4">
        <?php if($lang == 'gr') {?>
        <a STYLE="text-decoration:none" href="<?php get_site_url(); ?>/blog/τουρισμός-τεσσάρων-εποχών/">
          <img src="<? echo $images[$i];$i++?>" class="facts_promo_img a5b0b4 " alt="Τουρισμός Τεσσάρων Εποχών"/>
          <span class="facts_promo_caption_wrapper">
            <span class="facts_promo_caption">
              Τουρισμός Τεσσάρων Εποχών
            </span>
          </span>
        </a>
        <?php }else{?>
        <a STYLE="text-decoration:none" href="<?php get_site_url(); ?>/en/year-round-tourism/">
          <img src="<? echo $images[$i];$i++?>" class="facts_promo_img a5b0b4" alt="Year round Tourism"/>
          <span class="facts_promo_caption_wrapper">
            <span class="facts_promo_caption">
              Year round Tourism
            </span>
          </span>
        </a>
        <?php } ?>
			</li> -->
			<li class="color-d3a49c">
        <?php if($lang == 'gr') {?>
        <a STYLE="text-decoration:none" href="<?php get_site_url(); ?>/blog/δραστηριότητες/">
          <img src="<? echo $images[$i];$i++?>" class="facts_promo_img d3a49c" alt="Εξορμήσεις"/>
            <span class="facts_promo_caption_wrapper">
            <span class="facts_promo_caption">
              Εξορμήσεις
            </span>
          </span>
        </a>
        <?php }else{?>
        <a STYLE="text-decoration:none" href="<?php get_site_url(); ?>/en/activities/">
          <img src="<? echo $images[$i];$i++?>" class="facts_promo_img d3a49c " alt="Activities"/>
          <span class="facts_promo_caption_wrapper">
            <span class="facts_promo_caption">
              Activities
            </span>
          </span>
        </a>
        <?php } ?>
			</li>
			<li class="color-c9b092">
        <?php if($lang == 'gr') {?>
        <a STYLE="text-decoration:none" href="<?php get_site_url(); ?>/blog/βυζάντιο-μεσαίωνας/">
          <img src="<? echo $images[$i];$i++?>" class="facts_promo_img c9b092 " alt="Βυζάντιο-Μεσαίωνας"/>
            <span class="facts_promo_caption_wrapper">
            <span class="facts_promo_caption">
              Βυζάντιο-Μεσαίωνας
            </span>
          </span>
        </a>
        <?php }else{?>
        <a STYLE="text-decoration:none" href="<?php get_site_url(); ?>/en/medieval/">
          <img src="<? echo $images[$i];$i++?>" class="facts_promo_img c9b092 " alt="Medieval"/>
            <span class="facts_promo_caption_wrapper">
            <span class="facts_promo_caption">
              Medieval
            </span>
          </span>
        </a>
        <?php } ?>
			</li>
		</ul>
	</span>
	<span id="facts_promo_lower">
		<ul id="facts_promo_lower_ul">
			<li class="color-b58f8e">
        <?php if($lang == 'gr') {?>
        <a STYLE="text-decoration:none" href="<?php get_site_url(); ?>/blog/ειδικές-εκδηλώσεις/">
          <img src="<? echo $images[$i];$i++?>" class="facts_promo_img b58f8e " alt="Ειδικές Εκδηλώσεις"/>
          <span class="facts_promo_caption_wrapper">
            <span class="facts_promo_caption">
              Ειδικές Εκδηλώσεις
            </span>
          </span>
        </a>
        <?php }else{?>
        <a STYLE="text-decoration:none" href="<?php get_site_url(); ?>/en/special-events/">
          <img src="<? echo $images[$i];$i++?>" class="facts_promo_img b58f8e " alt="Special Events"/>
          <span class="facts_promo_caption_wrapper">
            <span class="facts_promo_caption">
              Special Events
            </span>
          </span>
        </a>
        <?php } ?>
      </li>
			<li class="color-9498a1">
        <?php if($lang == 'gr') {?>
        <a STYLE="text-decoration:none" href="<?php get_site_url(); ?>/blog/μουσεία/">
          <img src="<? echo $images[$i];$i++?>" class="facts_promo_img 9498a1 " alt="Μουσεία"/>
          <span class="facts_promo_caption_wrapper">
            <span class="facts_promo_caption">
              Μουσεία
            </span>
          </span>
        </a>
        <?php }else{?>
        <a STYLE="text-decoration:none" href="<?php get_site_url(); ?>/en/museums/">
          <img src="<? echo $images[$i];$i++?>" class="facts_promo_img 9498a1 " alt="Museums"/>
          <span class="facts_promo_caption_wrapper">
            <span class="facts_promo_caption">
              Museums
            </span>
          </span>
        </a>
        <?php } ?>
			</li>
			<li class="color-999798">
        <?php if($lang == 'gr') {?>
        <a STYLE="text-decoration:none" href="<?php get_site_url(); ?>/blog/μοναστήρια/">
          <img src="<? echo $images[$i];$i++?>" class="facts_promo_img 999798 " alt="Μοναστήρια"/>
            <span class="facts_promo_caption_wrapper">
            <span class="facts_promo_caption">
              Μοναστήρια
            </span>
          </span>
        </a>
        <?php }else{?>
        <a STYLE="text-decoration:none" href="<?php get_site_url(); ?>/en/religious-places/">
          <img src="<? echo $images[$i];$i++?>" class="facts_promo_img 999798 " alt="Religious Places"/>
          <span class="facts_promo_caption_wrapper">
            <span class="facts_promo_caption">
              Religious Places
            </span>
          </span>
        </a>
        <?php } ?>
			</li>
			<li class="color-8a9b8b">
        <?php if($lang == 'gr') {?>
        <a STYLE="text-decoration:none" href="<?php get_site_url(); ?>/blog/σημεία-ενδιαφέροντος/">
          <img src="<? echo $images[$i];$i++?>" class="facts_promo_img 8a9b8b " alt="Σημεία Ενδιαφέροντος"/>
          <span class="facts_promo_caption_wrapper">
            <span class="facts_promo_caption">
              Σημεία Ενδιαφέροντος
            </span>
          </span>
        </a>
        <?php }else{?>
        <a STYLE="text-decoration:none" href="<?php get_site_url(); ?>/en/hotspots/">
          <img src="<? echo $images[$i];$i++?>" class="facts_promo_img 8a9b8b " alt="Hotspots"/>
            <span class="facts_promo_caption_wrapper">
            <span class="facts_promo_caption">
              Hotspots
            </span>
          </span>
        </a>
        <?php } ?>
			</li>
		</ul>
	</span>
</div>
<?php }
?>


