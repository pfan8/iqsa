<!--//---------------------------------+
//  Developed by dede58.com 
//  Visit http://code.dede58.com for this script and more.
//  This notice MUST stay intact for legal use
// --------------------------------->


$(document).ready(function(){

<!--读取cookie并设置列表样式-->
var val = $.cookie('list_style');
   if(val =='1')set_list_style('1');
   if(val =='0')set_list_style('0');
<!--设置展示，按钮点击-->
$(".btn_view_1").click(function(){set_list_style('0');});
$(".btn_view_2").click(function(){set_list_style('1');});


// 设置列表样式 style 为样式值，0为列表，1为图片
function set_list_style(style)
{
if(style=='0')
{
$(".btn_view_1").removeClass("btn_view_on")
$(".btn_view_2").removeClass("btn_view_on")
$(".btn_view_1").addClass("btn_view_on")

$("#page ul").removeClass()
$("#page ul").addClass("list_txt_page_1")

$.cookie('list_style', '0'); // 设置cookie 为图文列表样式
}
if(style=='1')
{
$(".btn_view_1").removeClass("btn_view_on")
$(".btn_view_2").removeClass("btn_view_on")
$(".btn_view_2").addClass("btn_view_on")
$("#page ul").removeClass()
$("#page ul").addClass("list_img_page")
$.cookie('list_style', '1'); // 设置cookie 为图片列表样式
}
};
	
});