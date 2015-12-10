/**
 * Created by Administrator on 14-7-8.
 * 产品添加修改等页面
 */
Product={
    switchTab:function(dom,name,callback)
    {
        $(".w-set-tit span.on").removeClass("on");
        $(dom).addClass('on');
        $(".product-add-div").hide();
        $(".product-add-div#content_"+name).show();
		if(callback)
		   callback(name);
    },
    getDest:function(dom,selector,typeid)
    {
        var kindlist='';
        $(selector+" input:hidden").each(function(index,ele){
             kindlist+=$(ele).val()+',';
        });
        kindlist=kindlist?kindlist.slice(0,-1):'';
       // ST.Destination.setDest(0,typeid,0,kindlist,Product.listDest,1,selector);
        CHOOSE.setSome("设置目的地",{maxHeight:500,loadWindow:window,loadCallback:Product.listDest},SITEURL+'destination/dialog_setdest?kindlist='+kindlist+'&typeid='+typeid+"&selector="+encodeURI(selector),1)


    },
    listDest:function(result,bool)
    {
        if(!bool)
         return;
        var html="";
        for(var i in result.data)
        {

          html+="<span><s onclick=\"$(this).parent('span').remove()\"></s>"+result.data[i].kindname+"<input type='hidden' name='kindlist[]' value='"+result.data[i].id+"'/></span>";
          $(result.selector).html(html);
        }
    },
    getAttrid:function(dom,selector,typeid)
    {
        var attr='';
        $(selector+" input:hidden").each(function(index,ele){
            attr+=$(ele).val()+',';
        });
        attr=attr?attr.slice(0,-1):'';
        CHOOSE.setSome("设置属性",{maxHeight:500,loadWindow:window,loadCallback:Product.listAttr},SITEURL+'attrid/dialog_setattrid?typeid='+typeid+'&attrlist='+attr+'&selector='+encodeURI(selector),1);

    }
	,
	listAttr:function(result,bool)
	{
        if(!bool)
           return;
		var html="";
        for(var i in result.data)
        {
          html+="<span><s onclick=\"$(this).parent('span').remove()\"></s>"+result.data[i].attrname+"<input type='hidden' name='attrlist[]' value='"+result.data[i].id+"'/></span>";
          $(result.selector).html(html);
        }
	}
	,getIcon:function(dom,selector)
	{
		//alert(5);
		var icon='';
        $(selector+" input:hidden").each(function(index,ele){
            icon+=$(ele).val()+',';
        });
        icon=icon?icon.slice(0,-1):'';
        CHOOSE.setSome("设置图标",{loadWindow:window,loadCallback:Product.listIcon},SITEURL+'icon/dialog_seticon?iconlist='+icon+'&selector='+encodeURI(selector),1);
	},
	listIcon:function(result,bool)
	{
		var html="";
        var icon_arr=result.data;
        for(var i in icon_arr)
        {
          html+="<span><s onclick=\"$(this).parent('span').remove()\"></s>"+"<img src='"+icon_arr[i].url+"'/>"+"<input type='hidden' name='iconlist[]' value='"+icon_arr[i].id+"'/></span>";
          $(result.selector).html(html);
        }
	},
    getSupplier:function(dom,selector)
    {
        var supplier='';
        $(selector+" input:hidden").each(function(index,ele){
            supplier+=$(ele).val()+',';
        });
        supplier=supplier?supplier.slice(0,-1):'';
        CHOOSE.setSome("设置供应商",{loadWindow:window,loadCallback:Product.listSupplier,maxHeight:50},SITEURL+'supplier/dialog_set?&suppliers='+supplier+'&selector='+encodeURI(selector),1);

    },
    listSupplier:function(result,bool)
    {
        var html="";
        for(var i in result.data)
        {
            html+="<span><s onclick=\"$(this).parent('span').remove()\"></s>"+ result.data[i].suppliername+"<input type='hidden' name='supplierlist[]' value='"+ result.data[i].id+"'/></span>";
            $(result.selector).html(html);
        }
    },
    Coordinates:function(boxwidth,boxheight)
    {
        var url = SITEURL+'public/vendor/baidumap/index.html';
        ST.Util.showBox('地图坐标识取',url,boxwidth,boxheight,function(){},0,document); 
    },
    /*
    * obj:当前对象
    * contentclass:内容对象class
    * */
    changeTab:function(obj,contentclass)
    {
        var dataid = $(obj).attr('data-id');
        $(obj).addClass('on').siblings().removeClass('on');
        $(contentclass).each(function(){
            if($(this).attr('data-id') == dataid){
                $(this).show();
            }
            else{
                $(this).hide();
            }

        })

    }



}
