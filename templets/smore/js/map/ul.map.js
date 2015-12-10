// JavaScript Document
var map={}
var mapobj=null;
var mapaddress=null;
var mappoint=null;
map.initMap=function(hotelname,address){
	if(address=='')return '';
    mapobj = new BMap.Map("myMap");
	mapobj.addControl(new BMap.NavigationControl);
	mapobj.addControl(new BMap.ScaleControl);
	mapobj.addControl(new BMap.OverviewMapControl);
	mapobj.enableScrollWheelZoom();
	map.loadingStar();
	mapaddress=address;
	map.getPosition(address,hotelname);
	//map.addIco();
	//map.addLable(hotelname);
	map.loadingEnd();
}   
//添加位置
map.addPoint=function(point,hotelname){

  if (point){
	
     map.addIco(point,hotelname);

  }


}

//根据地址获取经纬度
map.getPosition=function(address,hotelname){
  var myGeo = new BMap.Geocoder();// 创建地址解析器实例
   myGeo.getPoint(mapaddress,function(point){map.addPoint(point,hotelname);},"北京市");

}
//添加ico
map.addIco=function(point,hotelname){

    mapobj.centerAndZoom(point, 16);

   var pt = new BMap.Point(point.lng,point.lat);
   var myIcon = new BMap.Icon("http://www.u6.com/sline/templets/standard/js/map/here.gif", new BMap.Size(32,32));
   var marker2 = new BMap.Marker(pt,{icon:myIcon});  // 创建标注         
	var label = new BMap.Label(hotelname,{offset:new BMap.Size(20,-10)});
    marker2.setLabel(label);
	mapobj.addOverlay(marker2);  // 将标注添加到地图中
 
   var info="<p style='font-size:12px;'>"+hotelname+"</p>";
  var infoWindow2 = new BMap.InfoWindow(info);
  marker2.addEventListener("click", function(){this.openInfoWindow(infoWindow2);});

}
map.loadingStar=function() {
	$("#divWaiting").show()
}
map.loadingEnd=function() {
	$("#divWaiting").hide()
}

