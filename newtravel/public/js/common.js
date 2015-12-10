/**
 * Created by Administrator on 14-4-27.
 */
 
 var ST = {};
 ST.Util={
     addTab:function(title,url,issingle,options)
     {

         parent.window.addTab(title,url,1,options);
     },
     showMsg:function(msg,type,time)
     {
         /*--type:4 success
          type:5 failure
          type:6 loading
          type:1 notice
          ---*/
          time = time ? time : 1000;//显示时间
         ZENG.msgbox.show(msg,type,time);

     },
     //隐藏消息框
     hideMsgBox:function(){
         ZENG.msgbox._hide();
     },
     //弹出框
     showBox:function(title,url,boxwidth,boxheight,closefunc,nofade,fromdocument,params)
     {
       parent.window.floatBox(title,url,boxwidth,boxheight,closefunc,nofade,fromdocument,params);
     },


     //弹出框关闭
     closeBox:function()
     {
        parent.window.d.close().remove();
     },
     //确认框
     confirmBox:function(boxtitle,boxcontent,okfunc,cancelfunc)
     {
         boxcontent='<div class="confirm-box">'+boxcontent+'</div>';
         var d = parent.window.dialog({
             title: boxtitle,
             content: boxcontent,
             okValue: '确定',
             ok: function () {
                okfunc();
             },
             cancelValue: '取消',
             cancel: function () {
                 if(typeof(cancelfunc)=='function')
                          cancelfunc();
             }
         });
         d.showModal();

     },
     //信息框
     messagBox:function(boxtitle,boxcontent,nofade)
     {
         var d = parent.window.dialog({
             title: boxtitle,
             content: boxcontent

         });
         if(nofade){
             d.show()
         }else
         {
             d.showModal();
         }

     },

     //帮助提示框
     helpBox:function(obj,helpid,e)
     {
        /* if (e && e.stopPropagation)
         //因此它支持W3C的stopPropagation()方法
             e.stopPropagation();
         else
         //否则，我们需要使用IE的方式来取消事件冒泡
          window.event.cancelBubble = true;
         var d = parent.window.dialog({
             content: '帮助ID'+helpid+'帮助信息,这个可以很长很长....',
             quickClose: true,
             align:'bottom left'


         });

         d.show(obj);*/

     },
     getDialog:function()
     {
         var frames = parent.window.document.getElementsByTagName("iframe"); //获取父页面所有iframe
         for(i=0;i<frames.length;i++) { //遍历，匹配时弹出id
             if (frames[i].contentWindow == window) {
                 var dlgEle = $(frames[i]).parents(".ui-popup:first");
                 var dlgId = dlgEle.attr('aria-labelledby');
                 dlgId = dlgId.substr(6);
                 var dialog = parent.dialog.get(dlgId);
                 return dialog;
             }
         }
         return null;
     },
     closeDialog:function()
     {
         var dialog=this.getDialog();
         dialog.remove();

     },
     resizeDialog:function(selector)
     {
         var dialog=this.getDialog();
         var maxHeight=dialog.maxHeight;
         var height=$(selector).height();
         if(maxHeight&&height>maxHeight)
           height=maxHeight;
         dialog.height(height).show();
     }
     ,
     resizeDialogHeight:function(height)
     {
         var dialog=this.getDialog();
         var maxHeight=dialog.maxHeight;
         if(maxHeight&&height>maxHeight)
             height=maxHeight;
         dialog.height(height).show();
     }
     ,responseDialog:function(results,bool)
     {
         var dialog=this.getDialog();
         dialog.finalResponse(results,bool);

     }
     ,prevPopup:function(e,ele)
     {
        var evt = e ? e : window.event;
        if (evt.stopPropagation) {
            evt.stopPropagation();
        }
        else {

            evt.cancelBubble = true;
        }
    },
    page: function(pageSize,currentPage,totalCount,displayNum,params)
    {
        var defaultParams={
            hint:'<span class="pageHint">总共<span class="totalPage">{totalPage}</span>页,共<span class="totalCount">{totalCount}</span>条记录</span>'
        };
        if(params)
        {
            defaultParams= $.extend(defaultParams,params);
        }
        if(!totalCount||totalCount==0)
           return '';

        displayNum=!displayNum?6:displayNum;
        var totalPage=Math.ceil(totalCount/pageSize);
        var html="<div class='pageContainer'><span class='pagePart'>";
        if(currentPage<=1)
        {
            html+='<span class="firstPage short" title="第一页"></span>';
            html+='<span class="prevPage short" title="上一页"></span>';
        }
        else
        {
            html+='<a href="javascript:;" class="firstPage short" title="第一页" page="1"></a>';
            var prevPage=parseInt(currentPage)-1;
            html+='<a  href="javascript:;" class="prevPage short" title="上一页" page="'+prevPage+'"></a>';
        }
        var flowNum=Math.floor(displayNum/2);
        var leftTicks=displayNum%2==0?flowNum:flowNum;
        var rightTicks=displayNum%2==0?flowNum-1:flowNum;

        var minPage=1;
        var maxPage=totalPage;
        if(currentPage>(leftTicks+1)&&totalPage>displayNum)
        {
            minPage=currentPage-leftTicks;
            maxPage=minPage+displayNum-1;
        }
        if(currentPage>totalPage-rightTicks&&totalPage>displayNum)
        {
            maxPage=totalPage;
            minPage=totalPage-displayNum+1;
        }
        if(currentPage<=leftTicks+1&&totalPage>displayNum)
        {
            maxPage=displayNum;
        }
        if(minPage>1)
        {
            html+='<span class="more floor">...</span>';
        }
        for(var i=minPage;i<=maxPage;i++)
        {
            if(i==currentPage)
            {
                html+='<span class="current floor">'+i+'</span>';
                continue;
            }
            html+='<a href="javascript:;" class="pageable floor" page="'+i+'">'+i+'</a>';
        }
        if(maxPage<totalPage)
        {
            html+='<span class="more floor">...</span>';
        }
        if(currentPage!=totalPage)
        {
            var nextPage=parseInt(currentPage)+1;
            html+='<a href="javascript:;" title="下一页" class="nextPage short" page="'+nextPage+'"></a>';
            html+='<a href="javascript:;" title="最后一页" class="lastPage short" page="'+totalPage+'"></a>';
        }
        else
        {
            html+='<span class="nextPage short" title="下一页"></span>';
            html+='<span class="lastPage short" title="最后一页"></span>';
        }
        html+='</span>';
        var hint=defaultParams['hint'].replace('{totalPage}',totalPage);
        hint=hint.replace('{totalCount}',totalCount);
        html+=hint;
        html+='</div>';
        return html;

    },
     insertContent : function(myValue, obj,t) {
         var $t = obj[0];
         if (document.selection) { // ie
             this.focus();
             var sel = document.selection.createRange();
             sel.text = myValue;
             this.focus();
             sel.moveStart('character', -l);
             var wee = sel.text.length;
             if (arguments.length == 2) {
                 var l = $t.value.length;
                 sel.moveEnd("character", wee + t);
                 t <= 0 ? sel.moveStart("character", wee - 2 * t
                 - myValue.length) : sel.moveStart(
                     "character", wee - t - myValue.length);
                 sel.select();
             }
         } else if ($t.selectionStart
             || $t.selectionStart == '0') {
             var startPos = $t.selectionStart;
             var endPos = $t.selectionEnd;
             var scrollTop = $t.scrollTop;
             $t.value = $t.value.substring(0, startPos)
             + myValue
             + $t.value.substring(endPos,
                 $t.value.length);
             this.focus();
             $t.selectionStart = startPos + myValue.length;
             $t.selectionEnd = startPos + myValue.length;
             $t.scrollTop = scrollTop;
             if (arguments.length == 2) {
                 $t.setSelectionRange(startPos - t,
                     $t.selectionEnd + t);
                 this.focus();
             }
         } else {
             this.value += myValue;
             this.focus();
         }
     }

 }

//目的地操作对象 
 ST.Destination={

     setDest:function(ele,typeid,productid,kindlist,callback,noremote,selector)//设置目的地
	 {  
	     if(Ext.getCmp('dest_window_'+productid))
		    return;
		 
		
		 
         Ext.create('Ext.window.Window',{
			     title:'设置目的地',
				 maxWidth:700,
                 maxHeight:500,

                 overflowY:'auto',
				 border:1,
				 style: {
                     borderStyle: 'solid',
					 borderWidth:'1px'
                  },
				 id:'dest_window_'+productid,
				 minWidth:350,
				 ghost:false,
				 autoShow:true,
				 buttons:
					{
						style:"background:#fff",	   //设置背景色，这样就不会有透明 的了.
						items:[
							{ xtype: 'button', text:'提交',handler:function()
						    	{
									var me=this;
									var selected_dests= Ext.select("#dest_set_"+productid+" .dest-set-selected-td input");
									  var dest_str='';
									  var dest_arr=[];
									  selected_dests.each(function(ele,c,index)
									  {
										 dest_str+=ele.getValue()+',';
										 var _dest_arr={id:ele.getValue(),name:ele.getAttribute('rel')}; 
										 dest_arr.push(_dest_arr); 
										  
									  });
									  dest_str=dest_str.slice(0,-1);
                                    if(noremote)
                                    {
                                      me.up('window').close();
                                      Ext.isFunction(callback)
                                      {
                                        callback(productid,dest_arr,0,selector);
                                      }
                                      return;
                                    }
									 Ext.Ajax.request({
									 url   : SITEURL+"destination/ajax_setdest",
									 method  :  "POST",
									 datatype  :  "JSON",
									 params:{typeid:typeid,productid:productid,kindlist:dest_str},
									 success  :  function(response, opts) 
									 { 
									    
										var msg=response.responseText;
										var bl=msg=='ok'?true:false;
									    me.up('window').close();
										Ext.isFunction(callback)
										{
											callback(productid,dest_arr,bl);
										}
										 
									 
									 }})
								
						      }
							},
							{ xtype: 'button', text: '取消' ,handler:function(){
								
								  this.up('window').close();
								
								}}
						 ]
					 },
				 html:"<table class='cm-dest-set' id='dest_set_"+productid+"' style='table-layout:fixed'><tr class='dest-set-selected-tr'><td width='50' class='td-left'>已选：</td><td class='dest-set-selected-td'></td></tr><tr class='dest-set-search-tr'><td width='50' class='td-left'>搜索：</td><td><input type='text' name='keyword' class='set-text-xh dest-set-keyword'/><button onclick=\"ST.Destination.getNextDestSet(0,0,1,0,'"+productid+"')\" class='outbox-ser-btn wid_60 mt-2 ml-5'>搜索</button></td></tr></tr><tr><td valign='top' class='td-left pt-5'>列表：</td><td class='dest-set-list'><div class='dest-set-list-div' style='border-top:0px'><a href='javascript:;' onclick=\"ST.Destination.getNextDestSet(0,0,0,0,'"+productid+"')\">全部</a></div></td></tr></table>",
				 listeners:{
					 afterrender:function()
					  {
						  ST.Destination.getNextDestSet(0,0,0,kindlist,productid);
					  }
					 }
			 });
			 
		 
			 
			 
			 
	 },
	 //获取下一级目的地或搜索的目的地,和setDest配合使用
	 getNextDestSet:function(ele,pid,status,kindlist,productid) 
		  {
			   var keyword='';
			   if(ele==0)
			   {
				   keyword=Ext.select("#dest_set_"+productid+" .dest-set-keyword").first().getValue();
				   keyword=Ext.String.trim(keyword);
				   
			   }
			   Ext.Ajax.request({
							 url   : SITEURL+"destination/ajax_getDestsetList",
							 method  :  "POST",
							 datatype  :  "JSON",
							 params:{pid:pid,keyword:keyword,kindlist:kindlist,status:status},
							 success  :  function(response, opts) 
							 { 
							      var data=Ext.decode(response.responseText);
								  
								  //设置新获取的目的地的层级，PID为0的目的地的step为1.依次类推
								  var step=0;
								  if(pid==0)
								  {
									  step=1;
								  }
								  else
								      step=2;
								  	   
								  if(data.parents)
								  {
									  step=data.parents.length+2;
								  }
								  
								  
								  //删除多余的后面所有级
								   var del_i=step;
									 while(true)
									 {
										var remove_div=Ext.select("#dest_set_"+productid+" .dest-set-list-"+del_i);                                 if(remove_div.getCount()<=0)
										  break;
										else
										  remove_div.remove();  
                                        del_i++; 
										 
									 }
									 
								  
								  //显示已设置的目的地
								  if(data.selected)
								  {
									  Ext.Array.each(data.selected,function(row,index)
									  {
										  var sp_str="<label class='mr-20 cor_666 dest-set-one-"+row.id+"' style='float:left;cursor:pointer;white-space:nowrap'><input type='checkbox' checked='checked' class='mr-3' rel='"+row.kindname+"' value='"+row.id+"' onclick='ST.Destination.cancelDest(this,"+row.id+")'/>"+row.kindname+"</label>";                      
										   Ext.select("#dest_set_"+productid+" .dest-set-selected-td").first().insertHtml('beforeEnd',sp_str);
										  
									  })
									  
								  }
								  
								  //加入新的一级
								  if(data.nextlist.length>0)
								  {
									  
									 var selected_dests= Ext.select("#dest_set_"+productid+" .dest-set-selected-td input");
									  var selected_dests_idarr=[];
									  selected_dests.each(function(ele,c,index)
									  {
										  selected_dests_idarr.push(ele.getValue());
										  
									  });
		  
									 var list_str="<div class='dest-set-list-div dest-set-list-"+step+"'>";
									 Ext.Array.each(data.nextlist, function(row, index, itself){
	                                      var ischecked=Ext.Array.contains(selected_dests_idarr,row.id)?"checked='checked'":'';
										 
										  list_str+="<label class='wid_100 box-hide dest-set-spc-"+row.id+"'><input type='checkbox' "+ischecked+" onclick=\"ST.Destination.chooseDest(this,"+row.id+",'"+row.kindname+"','"+productid+"')\" value='"+row.id+"'/><span step='"+step+"' onclick=\"ST.Destination.getNextDestSet(this,"+row.id+",0,0,'"+productid+"')\">"+row.kindname+"(<font color='red'>"+row.childnum+"</font>)"+"</span></label>";
									  });
									 list_str+="</div>"; 
									
									 
									 Ext.select("#dest_set_"+productid+" "+".dest-set-list").first().insertHtml('beforeEnd',list_str);
									 Ext.getCmp('dest_window_'+productid).hide().show();
								  }
								  
								   
							 }
						})   
	      }, 
		  
	   //选取目的地,与setDest配合使用  
	   chooseDest:function(ele,id,kindname,productid)
	   {
		   var is_checked=Ext.get(ele).is(":checked");
		   
		   if(is_checked)
		   {
			   var selectedDest=Ext.query("#dest_set_"+productid+" .dest-set-one-"+id);
			   if(selectedDest.length<=0)
			   {
			  var sp_str="<label class='mr-20 cor_666 dest-set-one-"+id+"' style='float:left;cursor:pointer;white-space:nowrap'><input type='checkbox' checked='checked' class='mr-3' rel='"+kindname+"' value="+id+" onclick='ST.Destination.cancelDest(this,"+id+")'/>"+kindname+"</label>";
			   Ext.select("#dest_set_"+productid+" .dest-set-selected-td").first().insertHtml('beforeEnd',sp_str);
			    Ext.getCmp('dest_window_'+productid).hide().show();
			   }
		   }
		   else
		   {
			   //Ext.select("#dest_set_"+productid+" .dest-set-one-"+id+" input").first().dom.click();
			  
		   }
		   

	   },
	   //取消当前选择的目的地
	   cancelDest:function(ele,id)
	   {
		   var tab=Ext.get(ele).up('.cm-dest-set');
		   Ext.get(ele).parent().remove();  
		   tab.select('.dest-set-spc-'+id+' input').set({'checked':null},false);
		   
	   }

	      



 }
 
 
 //属性操作 
 ST.Attrid={
	 setAttrid:function(ele,typeid,productid,attrids,callback,noremote,selector)//设置目的地,callback为一个回调函数，参数分别为产品ID,设置的属性数组，布尔状态
	 {
		 if(Ext.getCmp('attr_window_'+productid))
		    return;
		  Ext.create('Ext.window.Window',{
			     title:'设置属性',
				 maxWidth:600,
				 border:1,
				 style: {
                     borderStyle: 'solid',
					 borderWidth:'1px'
                  },
				 id:'attr_window_'+productid,
				 minWidth:200,
				 minHeight:100,
				 ghost:false,
				 autoShow:true,
				 buttons:
				 {
					style:"background:#fff",	   //设置背景色，这样就不会有透明 的了.
					items:[
						{ xtype: 'button', text:'提交',handler:function(){
							     var me=this;
								 var selected=Ext.get('attrid_set_'+productid).select('input:checked');
								 var selected_str='';
								 var selected_arr=[];
							     selected.each(function(ele,comp,index)
								 {
									 selected_str+=ele.getValue()+',';
									 selected_arr.push({name:ele.getAttribute('rel'),id:ele.getValue()});
								 });
								 selected_str=selected_str.slice(0,-1);
								 if(noremote)
                                   {
                                      me.up('window').close();
                                      Ext.isFunction(callback)
                                      {
                                        callback(productid,selected_arr,0,selector);
                                      }
                                      return;
                                   }
								 
								 
								  Ext.Ajax.request({
									 url   : SITEURL+"attrid/ajax_setattrid",
									 method  :  "POST",
									 datatype  :  "JSON",
									 params:{typeid:typeid,productid:productid,attrids:selected_str},
									 success  :  function(response, opts) 
									 { 
									       var bl=response.responseText=='ok'?true:false;
									       if(Ext.isFunction(callback))
										   {
											   callback(productid,selected_arr,bl);
										   }
									       me.up('window').close();
									 }})
							     
							}
						},
						{ xtype: 'button', text: '取消',handler:function(){ this.up('window').close();} }
					 ]
				  },
				 listeners:{
					 afterrender:function(wind)
					 {
						  
						  Ext.Ajax.request({
							 url   : SITEURL+"attrid/ajax_attridlist",
							 method  :  "POST",
							 datatype  :  "JSON",
							 params:{typeid:typeid},
							 success  :  function(response, opts) 
							 { 
							     var data=Ext.decode(response.responseText);
								 var attrid_arr=attrids?attrids.split(','):[];
								 
								 //生成json列表
								 var html="<table class='cm-attrid-set' id='attrid_set_"+productid+"'>";
								 Ext.Array.each(data, function(row, index){
									 var checked_tpl="{pchecked}"; //checked模板。用来判断子属性是否被选中。 
									 html+="<tr class='set-attrid-row-p'><td height='40' colspan='2'><span class='ml-10'>"+row.attrname+"</span></td></tr>";
									 var pchecked=Ext.Array.contains(attrid_arr,row.id)?"checked='checked'":'';
									
									 if(row.children)
									 {
		
										 html+="<tr class='set-attrid-row-c cld-one-"+row.id+"'><td height='30' valign='top' colspan='2' style='border-bottom:1px solid #eee'>"
									     Ext.Array.each(row.children, function(crow, cindex){
											 var checked_c='';
											 if(Ext.Array.contains(attrid_arr,crow.id))
											 {
												 checked_c="checked='checked'"
												 pchecked="checked='checked'"
											 }
											
										    html+="<span class='outbox-sx-sp'><label><input type='checkbox' class='mr-3' onclick=\"ST.Attrid.chooseAttr(this,"+crow.id+","+row.id+")\" "+checked_c+" rel='"+crow.attrname+"' value='"+crow.id+"'/>"+crow.attrname+"<label></span>";
										 });
										 html+="</td></tr>";
									 }
									 html=html.replace(/\{pchecked\}/ig,pchecked);
								  })
								 html+="</table>" ;
								 wind.update(html);
								 
							 
							 }
							 });
						 
						 
						 
					 }
					}
				 
				 });
		 
		 
		 
		 
	 },//选择属性 ，ele:dom元素，id: 属性ID，PID：属性的PID
	 chooseAttr:function(ele,id,pid)
	 {
		 var tab=Ext.get(ele).up('.cm-attrid-set');
		 var is_checked=Ext.get(ele).is(':checked');
		 if(!pid)
		 {
		    var children_checked=tab.select('.cld-one-'+id+' input:checked');
			if(children_checked.getCount()>0)
			{
			   Ext.get(ele).set({checked:'checked'},false);
			    ST.Util.showMsg('下级属性如果被选中的话，主属性也会被选中');
			}
		 }
		 else
		 {
			  tab.select('.set-attrid-one-'+pid).set({checked:'checked'},false);
		 }
	 } 
	 
    }
 
ST.Theme={
	 setTheme:function(ele,typeid,productid,themelist,callback)
	 {
		  if(Ext.getCmp('theme_window_'+productid))
		        return;
		  Ext.create('Ext.window.Window',{
			     title:'设置专题',
				 maxWidth:600,
				 border:1,
				 style: {
                     borderStyle: 'solid',
					 borderWidth:'1px'
                  },
				 id:'theme_window_'+productid,
				 minWidth:200,
				 minHeight:100,
				 ghost:false,
				 autoShow:true,
				 buttons:
				 {
					style:"background:#fff",	   //设置背景色，这样就不会有透明 的了.
					items:[
						{xtype: 'button', text:'提交',handler:function(){
							    var me=this; 
						         var selected=Ext.get('theme_set_'+productid).select('input:checked');
								 var selected_str='';
								 var selected_arr=[];
							     selected.each(function(ele,comp,index)
								 {
									 selected_str+=ele.getValue()+',';
									 selected_arr.push({name:ele.getAttribute('rel'),id:ele.getValue()});
								 });
							     selected_str=selected_str.slice(0,-1);
						        Ext.Ajax.request({
									 url   : SITEURL+"theme/ajax_settheme",
									 method  :  "POST",
									 datatype  :  "JSON",
									 params:{typeid:typeid,productid:productid,themes:selected_str},
									 success  :  function(response, opts) 
									 { 
									       var bl=response.responseText=='ok'?true:false;
									       if(Ext.isFunction(callback))
										   {
											   callback(productid,selected_arr,bl);
										   }
									       me.up('window').close();
									 }})
							        
						 
							}
						},
						{ xtype: 'button', text: '取消',handler:function(){ this.up('window').close();} }
					 ]
				  },
				 listeners:{
					 afterrender:function(wind)
					 {
						 if(window.theme_list)
						 {
						    ST.Theme.geneList(wind,typeid,productid,themelist,callback,window.theme_list) 
						 }
						 else
						 {
						     Ext.Ajax.request({
							 url   : SITEURL+"theme/ajax_themelist",
							 method  :  "POST",
							 datatype  :  "JSON",
							 success  :  function(response, opts) 
							  { 
							      
							     var data=Ext.decode(response.responseText);
								 window.theme_list=data;
								 ST.Theme.geneList(wind,typeid,productid,themelist,callback,data);
							  }
					       	})
						 }
					 }
					}
				 
				 });
	 },
	 geneList:function(wind,typeid,productid,themelist,callback,data)
	 {
		 var html="<div class='cm-theme-set' id='theme_set_"+productid+"'>";
		  var theme_arr=themelist?themelist.split(','):[];
		  Ext.Array.each(data, function(row, index){
			  var checked_str=Ext.Array.contains(theme_arr,row.id)?"checked='checked'":'';
		       html+="<span><input type='checkbox' rel='"+row.ztname+"' value='"+row.id+"' "+checked_str+"/>"+row.ztname+"</span>";
		  })
		 html+="</div>";
		 wind.update(html);
		 wind.hide();
		 wind.show();
		 
	 }	
 }
 
 ST.Icon={
	  setIcon:function(ele,typeid,productid,iconlist,callback,noremote,selector)
	  {
		  if(Ext.getCmp('icon_window_ '+productid))
		    return;
		   Ext.create('Ext.window.Window',{
			     title:'设置图标',
				 maxWidth:600,
				 border:1,
				 style: {
                     borderStyle: 'solid',
					 borderWidth:'1px'
                  },
				 id:'icon_window_'+productid,
				 minWidth:400,
				 minHeight:300,
				 ghost:false,
				 autoShow:true,
				 buttons:
				 {
					style:"background:#fff",	   //设置背景色，这样就不会有透明 的了.
					items:[
						{xtype: 'button', text:'提交',handler:function(){
							    var me=this; 
						         var selected=Ext.get('icon_set_'+productid).select('input:checked');
								 var selected_str='';
								 var selected_arr=[];
							     selected.each(function(ele,comp,index)
								 {
									 selected_str+=ele.getValue()+',';
                                     var imgpath=ele.next('img').getAttribute('src');  
									 selected_arr.push({name:ele.getAttribute('rel'),id:ele.getValue(),image:imgpath});
								 });
								 if(noremote)
                                   {
                                      me.up('window').close();
                                      Ext.isFunction(callback)
                                      {
                                        callback(productid,selected_arr,0,selector);
                                      }
                                      return;
                                   }
								 
							     selected_str=selected_str.slice(0,-1);
						        Ext.Ajax.request({
									 url   : SITEURL+"icon/ajax_seticon",
									 method  :  "POST",
									 datatype  :  "JSON",
									 params:{typeid:typeid,productid:productid,icons:selected_str},
									 success  :  function(response, opts) 
									 { 
									       var bl=response.responseText=='ok'?true:false;
									       if(Ext.isFunction(callback))
										   {
											   callback(productid,selected_arr,bl);
										   }
									       me.up('window').close();
									 }})
							      
						 
							}
						},
						{ xtype: 'button', text: '取消',handler:function(){ this.up('window').close();} }
					 ]
				  },
				 listeners:{
					 afterrender:function(wind)
					 {
						 if(window.icon_list)
						 {
						    ST.Icon.geneList(wind,typeid,productid,iconlist,callback,window.icon_list) 
						 }
						 else
						 {
						     Ext.Ajax.request({
							 url   : SITEURL+"icon/ajax_iconlist",
							 method  :  "POST",
							 datatype  :  "JSON",
							 success  :  function(response, opts) 
							  { 
							      
							     var data=Ext.decode(response.responseText);
								 window.icon_list=data;
								 ST.Icon.geneList(wind,typeid,productid,iconlist,callback,data);
							  }
					       	 })
						 }
					 }
					}
				 
				 });
		    
	  },
	  geneList:function(wind,typeid,productid,iconlist,callback,data)
	  {
		 var html="<div class='cm-icon-set' id='icon_set_"+productid+"'>";
		  var icon_arr=iconlist?iconlist.split(','):[];
		  Ext.Array.each(data, function(row, index){
			  var checked_str=Ext.Array.contains(icon_arr,row.id)?"checked='checked'":'';
		       html+="<span class='fl'><input class='fl' type='checkbox' rel='"+row.kind+"' value='"+row.id+"' "+checked_str+"/><img class='fl' alt='"+row.kind+"' title='"+row.kind+"' src='"+row.picurl+"'/></span>";
		  })
		 html+="</div>";
		 wind.update(html);
		 wind.hide();
		 wind.show(); 
		  
	  }

}
//修改页面使用共公函数
ST.Modify={
    //获取选择的目的地
    getSelectDest:function(arr)
    {
        var html = '';
        $.each(arr, function(i, item){
                html+="<span><s onclick=\"$(this).parent('span').remove()\"></s>"+item.kindname;
                html+="<input type=\"hidden\" name=\"kindlist[]\" value=\""+item.id+"\"></span>";
        });
        return html;
    },
    //获取选择的属性
    getSelectAttr:function(arr)
    {
        var html = '';
        $.each(arr, function(i, item){

            html+="<span><s onclick=\"$(this).parent('span').remove()\"></s>"+item.attrname;
            html+="<input type=\"hidden\" name=\"attrlist[]\" value=\""+item.id+"\"></span>";
        });
        return html;
    },
    //获取选择的图标
    getSelectIcon:function(arr)
    {

        var html = '';
        $.each(arr, function(i, item){

            html+="<span><s onclick=\"$(this).parent('span').remove()\"></s><img src=\""+item.picurl+"\">";
            html+="<input type=\"hidden\" name=\"iconlist[]\" value=\""+item.id+"\"></span>";
            });
        return html;
    },
    getUploadFile:function(arr,showsethead)
    {

        var html = '';
        var sethead = showsethead==0 ? 0 : 1;
        $.each(arr,function(i,item){
            var k=i+1;

            html+='<li class="img-li">';
            html+='<img class="fl" src="'+item.litpic+'" width="100" height="100">';
            html+='<p class="p1">';
            html+='<input type="text" class="img-name" name="imagestitle['+k+']" value="'+item.desc+'" style="width:90px">';
            html+='<input type="hidden" class="img-path" name="images['+k+']" value="'+item.litpic+'">';
            html+='</p>';
            html+='<p class="p2">';
            if(sethead){
                html+='<span class="btn-ste" onclick="Imageup.setHead(this,'+k+')">设为封面</span>';
            }

            html+='<span class="btn-closed" onclick="Imageup.delImg(this,\''+item.litpic+'\','+k+')"></span>';
            html+='</p>';
            html+='</li>';


        })
       return html;


    }


}

// 输入框焦点事件
$.fn.focusEffect = function() {
    var $input = this;

    $input.focus(function() {

        if ($(this).val() == '' || $(this).val() == $(this).attr('datadef')) {
            $(this).val('');
            $(this).css({
                color : '#333'
            })
        }
    });
    $input.blur(function() {
        //alert($(this).attr('id'));
        if ($(this).val() == '') {

            $(this).val($(this).attr('datadef'));
            $(this).css({
                color : '#aaa'
            })
        }
    })
}


ST.Supplier={
    setSupplier:function(ele,typeid,productid,supplierlist,callback,selector)
    {
        if(Ext.getCmp('supplier_window_'+productid))
            return;
        Ext.create('Ext.window.Window',{
            title:'设置供应商',
            maxWidth:600,
            border:1,
            style: {
                borderStyle: 'solid',
                borderWidth:'1px'
            },
            id:'supplier_window_'+productid,
            minWidth:200,
            minHeight:100,
            ghost:false,
            autoShow:true,
            buttons:
            {
                style:"background:#fff",	   //设置背景色，这样就不会有透明 的了.
                items:[
                    {xtype: 'button', text:'提交',handler:function(){
                        var me=this;
                        var selected=Ext.get('supplier_set_'+productid).select('input:checked');
                        var selected_str='';
                        var selected_arr=[];
                        selected.each(function(ele,comp,index)
                        {
                            selected_str+=ele.getValue()+',';
                            selected_arr.push({name:ele.getAttribute('rel'),id:ele.getValue()});
                        });
                        selected_str=selected_str.slice(0,-1);
                        Ext.Ajax.request({
                            url   : SITEURL+"supplier/ajax_set_supplier",
                            method  :  "POST",
                            datatype  :  "JSON",
                            params:{typeid:typeid,productid:productid,supplierids:selected_str},
                            success  :  function(response, opts)
                            {
                                var bl=response.responseText=='ok'?true:false;
                                if(Ext.isFunction(callback))
                                {
                                    callback(productid,selected_arr,bl,selector);
                                }
                                me.up('window').close();
                            }})


                    }
                    },
                    { xtype: 'button', text: '取消',handler:function(){ this.up('window').close();} }
                ]
            },
            listeners:{
                afterrender:function(wind)
                {
                    if(window.supplier_list)
                    {
                        ST.Supplier.geneList(wind,typeid,productid,supplierlist,callback,window.supplier_list)
                    }
                    else
                    {
                        Ext.Ajax.request({
                            url   : SITEURL+"supplier/ajax_supplier_list",
                            method  :  "POST",
                            datatype  :  "JSON",
                            success  :  function(response, opts)
                            {

                                var data=Ext.decode(response.responseText);

                                window.supplier_list=data;
                                ST.Supplier.geneList(wind,typeid,productid,supplierlist,callback,data);
                            }
                        })
                    }
                }
            }

        });
    },
    geneList:function(wind,typeid,productid,supplierlist,callback,data)
    {
        var html="<div class='cm-supplier-set' id='supplier_set_"+productid+"'>";
        var supplier_arr=supplierlist?supplierlist.split(','):[];
        Ext.Array.each(data, function(row, index){
            var checked_str=Ext.Array.contains(supplier_arr,row.id)?"checked='checked'":'';
            html+="<label class='supplier-sp'><input class='fl mt-3 mr-3' type='radio' name='suppliername' rel='"+row.suppliername+"' value='"+row.id+"' "+checked_str+"/>"+row.suppliername+"</label>";
        })
        html+="</div>";
        wind.update(html);
        wind.hide();
        wind.show();

    }
}





