<!--//---------------------------------+
//  Developed by dede58.com 
//  Visit http://code.dede58.com for this script and more.
//  This notice MUST stay intact for legal use
// --------------------------------->

$(document).ready(function(){
	var scrollGalleryObj=$("div.scrollGallery");
	scrollGalleryObj.each(function(i){
		var parentObj=$(this);
		var obj=$(this).find(".scroll_t");
		if(obj[0]==null){return true;}
		obj[0].scrollTop=0;
		//设置当前索引位置，从1开始的
		obj.attr("currentIndex","1");
		//获取li的个数
		var liLength=obj.find("li").length;
		var delay=parseInt(obj.attr("delay"),10);
		var step=parseInt(obj.attr("step"),10);
		if(isNaN(delay) || isNaN(step)){return true;}
		//根据传递进来的参数进行注册
		function foo(obj,delay,step){window.setInterval(function(){interalRun(obj,step);},delay);}
		//执行滚动
		function startScroll(num,where){
			//先移除可能存在的动画队列
			obj.dequeue();
			//如果where=true，则滚动到顶部，否则+=step
			if(where==true){
				obj.attr("currentIndex","1");
				obj.animate({ scrollTop:"0" },600);
			}else if(where==false){
				var i=parseInt(obj.attr("currentIndex"),10);
				if(i==liLength){i=0}
				obj.attr("currentIndex",(i+1));
				obj.animate({scrollTop:"+="+step+""},600);
			}
			//如果num不为空，那么说明是鼠标hover了
			if(num!=null){
				var h=(num-1)*step;
				obj.attr("currentIndex",num.toString());
 				obj.animate({scrollTop:h},300);
			}
			selectCurrent();
		}
		//根据滚动条位置来决定是继续向上还是向下
		function interalRun(obj,step){
			if(parentObj.attr("scroll")=="false"){return;}
			var n1 = parseInt(obj[0].scrollTop);
			var n2 = parseInt(obj[0].clientHeight);
			var n3 = parseInt(obj[0].scrollHeight);
			/*
				第一个参数：是在鼠标事件中才有意义的，这里是自动执行，因此设置为null
				第二个参数：startScroll根据这个布尔值决定是向上还是向下
			*/
			n1+n2==n3?startScroll(null,true):startScroll(null,false);
		}
		if(delay>0){foo(obj,delay,step)};
		//当鼠标移上的时候，设置一个属性scroll,为false是，interalRun方法就不会执行（return）;
		parentObj.bind("mouseover",function(event){parentObj.attr("scroll","false");})
		parentObj.bind("mouseout",function(event,obj,delay,step){parentObj.removeAttr("scroll","false");})
		//现在做锚点
		if(parentObj[0].className.indexOf("photo")>=0){
			//先获取li的数量 
			var ulObj=document.createElement("ul");
			ulObj.className="scrollNum";
			for(var i=0;i<liLength;i++){
				var liNode=document.createElement("li");
				var textNode=document.createTextNode(i+1);
				liNode.setAttribute("title",i+1);
				liNode.appendChild(textNode);
				if(i==0){liNode.className="current";}
				//给liNode添加事件
				$(liNode).bind("mouseover",function(){
					var num=parseInt($(this).attr("title"),10);
					if(isNaN(num)){return;}
					//跳至对应位置
					startScroll(num);
				});
				ulObj.appendChild(liNode);
				$(ulObj).hide();
			}
			$(ulObj).fadeIn("slow");
			parentObj[0].appendChild(ulObj);
		}
		//此方法的作用是“选中”的li
		function selectCurrent(){
			var scrollNumObj=parentObj.find("ul.scrollNum");
			if(scrollNumObj[0]==null){return;}
			var currentNum=parseInt(obj.attr("currentIndex"),10)-1;
			scrollNumObj.find("li").each(function(){
				$(this).removeClass("current");
			});
			scrollNumObj.find("li").eq(currentNum).addClass("current");
		}
		//判断是否有“上一个”或“下一个的功能”
		var prevNextObj=parentObj.find(".prevNext");
		if(prevNextObj[0]!=null){
			var prevObj=prevNextObj.find(".prev");
			var nextObj=prevNextObj.find(".next");
			if(prevObj[0]!=null){
				prevObj.bind("focus",function(){this.blur();return false;});
				prevObj.bind("click",function(){prevOrNext(true);});
			}
			if(nextObj[0]!=null){
				nextObj.bind("focus",function(){this.blur();return false;});
				nextObj.bind("click",function(){prevOrNext(false);});
			}
		}
		//上一个,接受一个参数，如果为true，表示上一个，反之下一个
		function prevOrNext(prevNext){
			var currentIndex=parseInt(obj.attr("currentIndex"),10);
			if(prevNext){
				if(currentIndex==1){currentIndex=liLength;}else{currentIndex=currentIndex-1};
			}else{
				if(currentIndex==liLength){currentIndex=1;}else{currentIndex=currentIndex+1};
			}
			startScroll(currentIndex)
		}
	})
});

