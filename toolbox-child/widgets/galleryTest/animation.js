
/*
 * Put the last element of each ul before the first and
 * move each list on li to the left
 * (we do that to hide the last element which is now before the first)
 *
 */
function initUl(){

	var li_width = $('.upper li').outerWidth();
	var upper_width=$('.upper').outerWidth();
	var upper_pos = $('.upper').position();

	lastBeforeFirst();
	$('.upper').css({'width': upper_width + li_width});
	$('.upper').css({'left': upper_pos.left + (-1*li_width)});
}

function moveBothRight(){
	var speed = 200;
	var li_width = $('.upper li').outerWidth();
	var upper_pos = $('.upper').position();
	
	$('.upper').animate({'left' :upper_pos.left + li_width}, speed,fixUpperPosR);

}
function fixUpperPosR(){
	var li_width = $('.upper li').outerWidth();
	var upper_pos = $('.upper').position();
	lastBeforeFirst();
	$('.upper').css({'left': upper_pos.left + (-1*li_width)});

}

function moveBothLeft(){
	var speed = 200;
	var li_width = $('.upper li').outerWidth(true);
	var upper_pos = $('.upper').position();

	$('.upper').animate({'left' :upper_pos.left - li_width}, speed,fixUpperPosL);
}

function fixUpperPosL(){
	var li_width = $('.upper li').outerWidth();
	var upper_pos = $('.upper').position();
	firstBeforeLast();
	$('.upper').css({'left': upper_pos.left + li_width});
}

function firstBeforeLast(){

	var first = $('.upper ul li:first');
	var last = $('.upper ul li:last');

	$(last).before($(first));
}

function lastBeforeFirst(){

	var first;
	var last;
	first= $('.upper ul li:first');
	last = $('.upper ul li:last');
	//$(last).css({'display':'none'});
	$(first).before($(last));
}

function nextClick(){
	$('.upper').stop(true, true);
	moveBothRight();
	return false;
}

function prevClick(){
	$('.upper').stop(true, true);
	moveBothLeft();
	return false;
}

function carousel(){
 //rotation speed and timer
	var speed = 6000000000000;
	var run;
	
	initUl();
	$('#next').click(nextClick);       
	$('#prev').click(prevClick);  
}
function infoText(){
	$(".galleryThumbnail").mouseover(function(){
		$(this).next().show();
		}).mouseout(function(){
			$(this).next().hide();
		});
	$(".info").mouseover(function(){$(this).show();}).mouseout(function(){
			$(this).hide();});
}
