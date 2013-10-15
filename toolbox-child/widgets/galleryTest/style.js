function vertical_center_ul(){
setTimeout( function() {
var li_h = $('#wrapper #slides .upper li').height();

$('#wrapper #slides .upper ul').css({'height': (li_h)});

console.log("1: " + li_h);
}, 500);

}

/*function horizontall_center_ul(){

var ul_width = $('.upper ul').innerWidth();
var container_width = $('#carousel #wrapper').innerWidth();
//alert(container_width);
//alert(ul_width);
$('.upper ul').css({'margin-left': (container_width - ul_width)/2});
$('.upper ul').css({'margin-right': (container_width - ul_width)/2});
}

*/
