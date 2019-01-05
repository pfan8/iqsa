<!--//---------------------------------+
//  Developed by dede58.com 
//  Visit http://code.dede58.com for this script and more.
//  This notice MUST stay intact for legal use
// --------------------------------->

<!--用于返回顶部的动画效果-->
jQuery(document).ready(function() { 
jQuery('.back_to_top').click(function(){ 
if(jQuery.browser.safari) {//这里判断浏览器是否为safari 
jQuery('body').animate({scrollTop:0}, 'slow'); 
return false;//返回false可以避免在原链接后加上# 
} 
else{ 
jQuery('html').animate({scrollTop:0}, 500); 
return false; 
} 
}); 
}); 




