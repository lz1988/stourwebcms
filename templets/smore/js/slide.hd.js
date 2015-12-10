function $E(el)
{
	if(!el)
	{
		return null;
	}
	else if(typeof el=='string')
	{
		return document.getElementById(el);
	}
	else if(typeof el=='object')
	{
		return el;
	}
}

var Drag={
	obj: null,
	leftTime: null,
	rightTime: null,
	init: function (o,minX,maxX,btnRight,btnLeft) {
		o.onmousedown=Drag.start;
		o.hmode=true;
		if(o.hmode&&isNaN(parseInt(o.style.left))) { o.style.left="0px"; }
		if(!o.hmode&&isNaN(parseInt(o.style.right))) { o.style.right="0px"; }
		o.minX=typeof minX!='undefined'?minX:null;
		o.maxX=typeof maxX!='undefined'?maxX:null;
		o.onDragStart=new Function();
		o.onDragEnd=new Function();
		o.onDrag=new Function();
		btnLeft.onmousedown=Drag.startLeft;
		btnRight.onmousedown=Drag.startRight;
		btnLeft.onmouseup=Drag.stopLeft;
		btnRight.onmouseup=Drag.stopRight;
	},
	start: function (e) {
		var o=Drag.obj=this;
		e=Drag.fixE(e);
		var x=parseInt(o.hmode?o.style.left:o.style.right);
		o.onDragStart(x);
		o.lastMouseX=e.clientX;
		if(o.hmode) {
			if(o.minX!=null) { o.minMouseX=e.clientX-x+o.minX; }
			if(o.maxX!=null) { o.maxMouseX=o.minMouseX+o.maxX-o.minX; }
		} else {
			if(o.minX!=null) { o.maxMouseX= -o.minX+e.clientX+x; }
			if(o.maxX!=null) { o.minMouseX= -o.maxX+e.clientX+x; }
		}
		document.onmousemove=Drag.drag;
		document.onmouseup=Drag.end;
		return false;
	},
	drag: function (e) {
		e=Drag.fixE(e);
		var o=Drag.obj;
		var ex=e.clientX;
		var x=parseInt(o.hmode?o.style.left:o.style.right);
		var nx;
		if(o.minX!=null) { ex=o.hmode?Math.max(ex,o.minMouseX):Math.min(ex,o.maxMouseX); }
		if(o.maxX!=null) { ex=o.hmode?Math.min(ex,o.maxMouseX):Math.max(ex,o.minMouseX); }
		nx=x+((ex-o.lastMouseX)*(o.hmode?1:-1));
		
		$E("scrollcontent").style[o.hmode?"left":"right"]=(-nx*barUnitWidth)+"px";
		Drag.obj.style[o.hmode?"left":"right"]=nx+"px";
		Drag.obj.lastMouseX=ex;
		Drag.obj.onDrag(nx);
		return false;
	},
	startLeft: function () {
		Drag.leftTime=setInterval("Drag.scrollLeft()",1);
	},
	scrollLeft: function () {
		var c=$E("scrollcontent");
		var o=$E("scrollbar");
		if((parseInt(o.style.left.replace("px",""))<=418)&&(parseInt(o.style.left.replace("px",""))>=0)) {
			o.style.left=(parseInt(o.style.left.replace("px",""))+1)+"px";
			c.style.left=(-(parseInt(o.style.left.replace("px",""))+1)*barUnitWidth)+"px";
		} else {
			Drag.stopLeft();
		}
	},
	stopLeft: function () {
		clearInterval(Drag.leftTime);
	},
	startRight: function () {
		Drag.rightTime=setInterval("Drag.scrollRight()",1);
	},
	scrollRight: function () {
		var c=$E("scrollcontent");
		var o=$E("scrollbar");
		
		if((parseInt(o.style.left.replace("px",""))<=418)&&(parseInt(o.style.left.replace("px",""))>0)) {
			o.style.left=(parseInt(o.style.left.replace("px",""))-1)+"px";
			c.style.left=(-(parseInt(o.style.left.replace("px",""))-1)*barUnitWidth)+"px";
		} else {
			Drag.stopRight();
		}
	},
	stopRight: function () {
		clearInterval(Drag.rightTime);
	},
	end: function () {
		document.onmousemove=null;
		document.onmouseup=null;
		Drag.obj.onDragEnd(parseInt(Drag.obj.style[Drag.obj.hmode?"left":"right"]));
		Drag.obj=null;
	},
	fixE: function (e) {
		if(typeof e=='undefined') { e=window.event; }
		if(typeof e.layerX=='undefined') { e.layerX=e.offsetX; }
		return e;
	}
};
$(document).ready(function(){
	var scrollbar = $E('scrollbar');
	var scrollleft = $E('scrollleft');
	var scrollright = $E('scrollright');
	if(scrollbar&&scrollright){
		Drag.init(scrollbar,0,418,scrollleft,scrollright);
	}
});
