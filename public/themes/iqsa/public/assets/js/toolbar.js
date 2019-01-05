<!--//---------------------------------+
//  Developed by dede58.com 
//  Visit http://code.dede58.com for this script and more.
//  This notice MUST stay intact for legal use
// --------------------------------->

<!--控制内容文字大小-->
function doZoom(size)
{$(".content").css({fontSize:size+"px"});};

<!--打印指定区域-->
function CallPrint(strid)
{
 var prtContent = document.getElementById(strid);
 var WinPrint = window.open('','','letf=0,top=0,width=600,height=800,toolbar=1,scrollbars=1,status=1,menubar=1');
 WinPrint.document.write(prtContent.innerHTML);
 WinPrint.document.close();
 WinPrint.focus();
 WinPrint.print();
 WinPrint.close();
 //prtContent.innerHTML=strOldOne;
}

<!--加入收藏夹-->
$('.t_favorites').jFav(); 

