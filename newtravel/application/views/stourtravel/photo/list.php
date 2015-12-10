<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>思途CMS3.0</title>
 {template 'stourtravel/public/public_js'}
   {php echo Common::getCss('style.css,base.css,base2.css,plist.css'); }
   {php echo Common::getCss('ext-theme-neptune-all-debug.css','js/extjs/resources/ext-theme-neptune/'); }
    
   {php echo Common::getScript("uploadify/jquery.uploadify.min.js,jquery.buttonbox.js,choose.js"); }
   {php echo Common::getCss('uploadify.css','js/uploadify/'); }
</head>
<body style="overflow:hidden">
<table class="content-tab">
   <tr>
    <td width="119px" class="content-lt-td"  valign="top">
     {template 'stourtravel/public/leftnav'}
    <!--右侧内容区-->
    </td>
    <td valign="top" class="content-rt-td" style="overflow:hidden">

 <div class="list-top-set">
   <div class="list-web-pad"></div>
   <div class="list-web-ct">
       <table class="list-head-tb">
           <tr>
               <td class="head-td-lt">
                   {loop $kindmenu $menu}
                   <a href="javascript:;" class="menu-shortcut" onclick="ST.Util.addTab('{$menu['name']}','{$menu['url']}',1);">{$menu['name']}</a>
                   {/loop}
               </td>
               <td class="head-td-rt">
                   <a href="javascript:;" class="refresh-btn" onclick="window.location.reload()">刷新</a>
                   <a href="javascript:;" id="addbtn" class="add-btn-class ml-10" >添加</a></td>
           </tr>
       </table>
   </div>
 </div>

        <div class="search-bar filter" id="search_bar">
            <div class="change-btn-list mt-4 ml-10">
                <span class="change-btn-xz btnbox" id="website" data-url="box/index/type/weblist" data-result="result_webid">站点切换&nbsp;&gt;&nbsp;<span id="result_webid">全部</span></span>

            </div>

            <div class="change-btn-list mt-4 ml-10">
                <span class="change-btn-xz btnbox" id="destination" data-url="box/index/type/destlist" data-result="result_dest" >目的地&nbsp;&gt;&nbsp;<span id="result_dest">全部</span></span>

            </div>

            <div class="change-btn-list mt-4 ml-10">
                <span class="change-btn-xz btnbox" id="attrlist" data-url="box/index/type/attrlist/typeid/6" data-result="result_attrlist" >属性&nbsp;&gt;&nbsp;<span id="result_attrlist">全部</span></span>

            </div>

            <div class="pro-search ml-10" style=" float:left; margin-top:4px">
                <input type="text" id="searchkey" value="相册名称" datadef="相册名称" class="sty-txt1 set-text-xh wid_200">
                <a href="javascript:;" class="head-search-btn" onclick="CHOOSE.searchKeyword()"></a>
            </div>

     <span class="display-mod">

     </span>
        </div>
 <div id="product_grid_panel" class="content-nrt">
    
  </div>
  </td>
  </tr>
 </table> 
<script>



   window.display_mode=1;	//默认显示模式
   window.product_kindid=0;  //默认目的地ID


  Ext.onReady(
    function() 
    {
		 Ext.tip.QuickTipManager.init();

        $(".btnbox").buttonBox();

        $("#searchkey").focusEffect();
        //添加按钮
        $("#addbtn").click(function(){

            ST.Util.addTab('添加相册','{$cmsurl}photo/add/parentkey/article/itemid/3',0);
        });


		 

		
		//产品store
        window.product_store=Ext.create('Ext.data.Store',{

		 fields:[
             'id',
             'aid',
             'webid',
             'title',
             'kindlist',
             'attrid',
             'ishidden',
             'displayorder',
             'kindname',
             'attrname',
             'themelist',
             'modtime',
             'litpic'
         ],

         proxy:{
		   type:'ajax',
		   api: {
              read: SITEURL+'photo/photo/action/read',  //读取数据的URL
			  update:SITEURL+'photo/photo/action/save',
			  destroy:SITEURL+'photo/photo/action/delete'
              },
		      reader:{
                type: 'json',   //获取数据的格式 
                root: 'lists',
                totalProperty: 'total'
                }	
	         },

		 remoteSort:true,	 
		 pageSize:30,	 	
         autoLoad:true,
		 listeners:{
			 load:function( store, records, successful, eOpts )
			 {
                 if(!successful){
                     ST.Util.showMsg("{__('norightmsg')}",5,1000);
                 }
                 var pageHtml = ST.Util.page(store.pageSize, store.currentPage, store.getTotalCount(), 10);
                 $("#line_page").html(pageHtml);
                 window.product_grid.doLayout();

                 $(".pageContainer .pagePart a").click(function () {
                     var page = $(this).attr('page');
                     product_store.loadPage(page);
                 });


             }
		 }
		  
       });
	   
	  //产品列表 
	  window.product_grid=Ext.create('Ext.grid.Panel',{ 
	   store:product_store,
	   renderTo:'product_grid_panel',
	   border:0,
	   width:"100%",
	   bodyBorder:0,
	   bodyStyle:'border-width:0px',
	   scroll:'vertical',
	   bbar: Ext.create('Ext.toolbar.Toolbar', {
                    store: product_store,  //这个和grid用的store一样
                    displayInfo: true,
                    emptyMsg: "",
					items:[
                       {
                            xtype:'panel',
                            id:'listPagePanel',
                            html:'<div id="line_page"></div>'
                      },
					  {
						  xtype:'combo',
						  fieldLabel:'每页显示数量',
						  width:170,
						  labelAlign:'right',
						  forceSelection:true,
						  value:30,  
						  store:{fields:['num'],data:[{num:30},{num:60},{num:100}]},
						  displayField:'num',
						  valueField:'num',
						  listeners:{
							  select:CHOOSE.changeNum
						  }
					  }
					
					],
				  listeners: {
						single: true,
						render: function(bar) {
							var items = this.items;
							//bar.down('tbfill').hide();

							bar.insert(0,Ext.create('Ext.panel.Panel',{border:0,html:'<div class="panel_bar"><a class="abtn" href="javascript:void(0);" onclick="CHOOSE.chooseAll()">全选</a><a class="abtn" href="javascript:void(0);" onclick="CHOOSE.chooseDiff()">反选</a><a class="abtn" href="javascript:void(0);" onclick="CHOOSE.delMore()">删除</a></div>'}));
							bar.insert(1,Ext.create('Ext.panel.Panel',{border:0,items:[{
								 xtype:'button',
								 text:'批量设置',
                                 cls:'my-extjs-btn',
								 menu:{
                                     cls:'menu-no-icon',
                                     width:"82px",
                                     shadow:false,
                                     items:[
                                         {text:'目的地',handler:function(){ CHOOSE.setSome("设置目的地",{loadCallback:setDests,maxHeight:500},SITEURL+'destination/dialog_setdest');}},
                                         {text:'属性',handler:function(){ CHOOSE.setSome("设置属性",{loadCallback:setAttrids},SITEURL+'attrid/dialog_setattrid?typeid=6');}},
                                         {text:'专题',handler:function(){ CHOOSE.setSome("设置专题",{loadCallback:setThemes},SITEURL+'theme/dialog_settheme?typeid=6');}},
									 ]
                            }
								
								}]}));
							bar.insert(2,Ext.create('Ext.toolbar.Fill'));
							//items.add(Ext.create('Ext.toolbar.Fill'));
						}
					}	
                 }), 		 			 
	   columns:[
			   {
				   text:'选择',
				   width:'6%',
				  // xtype:'templatecolumn',
				   tdCls:'product-ch',
				   align:'center',
				   dataIndex:'id',
				   border:0,
                   menuDisabled:true,
				   renderer : function(value, metadata,record) {
					    id=record.get('id');
					    if(id.indexOf('suit')==-1)
					    return  "<input type='checkbox' class='product_check' style='cursor:pointer' value='"+value+"'/>";
					}
			   },
			   {
				   text:'排序',
				   width:'6%',
				   dataIndex:'displayorder',
                   tdCls:'product-order',
				   id:'column_lineorder',
				   align:'center',
                   menuDisabled:true,
                   cls:'sort-col',
				   border:0,
			       editor: 'textfield',
				   renderer : function(value, metadata,record) {
                       var id = record.get('id');
                       var newvalue=value;
                       if(value==9999||value==999999||!value)
                           newvalue='';
                       return "<input type='text' value='"+newvalue+"' class='row-edit-txt' onblur=\"updateField(this,'"+id+"','displayorder',0,'input')\"/>";
					 
					}
			   },
			   {
				   text:'相册名称',
				   width:'18%',
				   dataIndex:'title',
				   align:'left',
				   border:0,
				   sortable:false,
                   menuDisabled:true,
				   renderer : function(value, metadata,record) {
					            var aid=record.get('aid');
							 var id=record.get('id');
									 
									 if(!isNaN(id))
			                           return "<a href='/photos/show_"+aid+".html' class='product-title' target='_blank'>"+value+"</a>";
						}
				  
			   },
			   {
				   text:'封面',
				   width:'18%',
				   dataIndex:'litpic',
				   align:'left',
				   border:0,
				   sortable:false,
                   menuDisabled:true,
				   renderer : function(value, metadata,record) {
					            var aid=record.get('aid');
							 var id=record.get('id');
									 
							if(!isNaN(id))
			                           return "<img height='80px' src='"+value+"'/>";           
						}
				  
			   },
			   {
				   text:'目的地',
				   width:'8%',
				   dataIndex:'kindlist',
				   align:'center',
				   cls:'mod-1 sort-col',
				   sortable:true,
                   menuDisabled:true,
				   renderer : function(value, metadata,record,rowIndex,colIndex) {
					   
					     var kindname=record.get('kindname');
						 if(kindname)
						 metadata.tdAttr ="data-qtip='"+kindname+"'"+"data-qclass='dest-tip'";
						 var id=record.get('id');
                         var d_text=value?'<span style="color:green">已设</span>':'<span style="color:red">未设</span>';
						 return "<a href='javascript:void(0);' onclick=\"setOneDests("+id+")\">"+d_text+"</a>";
                                   // return getExpandableImage(value, metadata,record);
                    }
			   },  
			   {
				   text:'属性',
				   width:'8%',
				   align:'center',
				   dataIndex:'attrid',
				   border:0,
				   sortable:true,
                   menuDisabled:true,
				   cls:'mod-1 sort-col',
				   renderer : function(value, metadata,record,rowIndex,colIndex) {
					  
					     var attrname=record.get('attrname');
						 if(attrname)
						    metadata.tdAttr ="data-qtip='"+attrname+"'data-qclass='dest-tip'";

						 var id=record.get('id');
                         var d_text=value?'<span style="color:green">已设</span>':'<span style="color:red">未设</span>';
						 return "<a href='javascript:void(0);' onclick=\"setOneAttrids("+id+")\">"+d_text+"</a>";
                                   // return getExpandableImage(value, metadata,record);
                    }
			   },
			   {
				   text:'专题',
				   width:'8%',
				   align:'center',
				   sortable:true,
				  dataIndex:'themelist',
				  cls:'mod-1 sort-col',
                   menuDisabled:true,
				   border:0,
				  renderer : function(value, metadata,record,rowIndex,colIndex) {
					
						 var id=record.get('id');
                         var d_text=value?'<span style="color:green">已设</span>':'<span style="color:red">未设</span>';
						 return "<a href='javascript:void(0);' onclick=\"setOneThemes("+id+")\">"+d_text+"</a>";
                                   // return getExpandableImage(value, metadata,record);
                    }
				  
			   },
			   {
				   text:'隐藏',
				   width:'8%',
				  // xtype:'templatecolumn',
				   align:'center',
				   border:0,
				   dataIndex:'ishidden',
				   xtype:'actioncolumn',
                   menuDisabled:true,
				    cls:'mod-1 sort-col',
		           items:[
			       {
			        getClass: function(v, meta, rec) {          // Or return a class from a function
					    if(v==1)
						  return 'dest-status-ok';
						else
						  return 'dest-status-none';  
                    },
				    handler:function(view,index,colindex,itm,e,record)
				    {
					  // togStatus(null,record,'ishidden');
					   var val=record.get('ishidden');
                       var id=record.get('id');
	                    var newval=val==1?0:1;
					  updateField(null,record.get('id'),'ishidden',newval)
					   
				    }
			      }
			      ]
				  
				  
			   },
			   {
				   text:'更新时间',
				   width:'10%',
				   align:'center',
				   border:0,
				   dataIndex:'modtime',
                   menuDisabled:true,
                   cls:'sort-col',
				   renderer : function(value, metadata,record) {
					     return value;
                    }
				  
			   },
			   {
				   text:'管理',
				   width:'11%',
				   align:'center',
				   border:0,
				   sortable:false,
                   menuDisabled:true,
				  renderer : function(value, metadata,record) {
					     var id=record.get('id');
                         var photoname=record.get('title');
						 return "<a href='javascript:void(0);' class='row-mod-btn' title='编辑' onclick=\"goModify('"+id+"')\"></a>";
						 	

                    }
				  
			   }
	           ],
			 listeners:{
		            boxready:function()
		            {
					
				
					    var height=Ext.dom.Element.getViewportHeight();
					   this.maxHeight=height-106;
					   this.doLayout();
		            },
					afterlayout:function()
					{
						
			
			            if(window.product_kindname)
						{
							 Ext.getCmp('column_lineorder').setText(window.product_kindname+'-排序')
						}
						else
					    {
							Ext.getCmp('column_lineorder').setText('排序')
						}
					

				  }
			 },
			 plugins: [
                Ext.create('Ext.grid.plugin.CellEditing', {
                  clicksToEdit:2,
                  listeners:{
					 edit:function(editor, e)
					 {
						  var id=e.record.get('id');
						  //var view_el=window.product_grid.getView().getEl();
						 // view_el.scrollBy(0,this.scroll_top,false);
						  updateField(0,id,e.field,e.value,0);
						  return false;
						  
					 },
					 beforeedit:function(editor,e)
					 {

					 }
				 }
               })
             ],
			viewConfig:{
				//enableTextSelection:true
				}	   
	   });
	   
	  
	  
	})
	
	//实现动态窗口大小
  Ext.EventManager.onWindowResize(function(){
      var height=Ext.dom.Element.getViewportHeight();
      window.product_grid.maxHeight=(height-106);
      window.product_grid.doLayout();
	   
	 }) 
	
	
	 
	 	
	

  	

  

 
  
  //更新某个字段
  function updateField(ele,id,field,value,type,callback)
  {
	  var record=window.product_store.getById(id.toString());
	  if(type=='select'||type=='input')
	  {
		  value=Ext.get(ele).getValue();
	  }
	  var view_el=window.product_grid.getView().getEl();
	
	 
	  Ext.Ajax.request({
						 url   :  "photo/action/update",
						 method  :  "POST",
						 datatype  :  "JSON",
						 params:{id:id,field:field,val:value,kindid:window.product_kindid},
						 success  :  function(response, opts) 
						 {
							 if(response.responseText=='ok')
							 {
							  //var view_el=window.product_grid.getView().getEl()
	                            // var scroll_top=view_el.getScrollTop();				   
					   
							   record.set(field,value);
							   record.commit();
                               if(typeof(callback)=='function')
                                    callback(record);
						      // view_el.scrollBy(0,scroll_top,false);
							 }
						 }});

  }


   //修改
   function goModify(id)
   {
       var url = SITEURL+'photo/edit/parentkey/article/itemid/3/photoid/'+id;

       parent.window.addTab('修改相册',url,1);
   }


   //设置多个线路的目的地
   function setDests(result,bool)
   {
       if(!bool)
           return;
       var ids=[];
       var destNames=[];
       for(var i in result.data)
       {
           var arr=result.data;
           ids.push(arr[i]['id']);
           destNames.push(arr[i]['kindname']);
       }
       var idsStr=ids.join(',');
       var destNamesStr=destNames.join(',');
       if(result.id)
       {
           updateField(null,result.id,'kindlist',idsStr,0,function(record){
               record.set('kindname',destNamesStr);
               record.commit();
              // var id=record.get('id');
              // $("#box_"+id).attr("checked",true);
           });
           return;
       }

       $(".product_check:checked").each(function(index,element){
           var id=$(element).val();
           updateField(null,id,'kindlist',idsStr,0,function(record){
               record.set('kindname',destNamesStr);
               record.commit();
            //   var id=record.get('id');
              // $("#box_"+id).attr("checked",true);
           });
       });


   }
   //设置属性
   function setAttrids(result,bool)
   {
       if(!bool)
           return;
       var ids=[];
       var names=[];
       for(var i in result.data)
       {
           var arr=result.data;
           ids.push(arr[i]['id']);
           names.push(arr[i]['attrname']);
       }
       var idsStr=ids.join(',');
       var nameStr=names.join(',');
       if(result.id)
       {
           updateField(null,result.id,'attrid',idsStr,0,function(record){
               record.set('attrname',nameStr);
               record.commit();
              // var id=record.get('id');
             //  $("#box_"+id).attr("checked",true);
           });
           return;
       }
       $(".product_check:checked").each(function(index,element){
           var id=$(element).val();
           updateField(null,id,'attrid',idsStr,0,function(record){
               record.set('attrname',nameStr);
               record.commit();
             //  var id=record.get('id');
              // $("#box_"+id).attr("checked",true);
           });
       });

   }
   function setIcons(result,bool)
   {
       if(!bool)
           return;
       var ids=[];
       for(var i in result.data)
       {
           var oneId=result.data[i]['id'];
           ids.push(oneId);
       }
       var idsStr=ids.join(',');
       if(result.id)
       {
           updateField(null,result.id,'iconlist',idsStr,0);
           return;
       }
       $(".product_check:checked").each(function(index,element){
           var id=$(element).val();
           updateField(null,id,'iconlist',idsStr,0,function(record){
             //  var id=record.get('id');
              // $("#box_"+id).attr("checked",true);
           });
       });

   }
   function setThemes(result,bool)
   {
       if(!bool)
           return;
       var ids=[];
       var names=[];
       for(var i in result.data)
       {
           var row=result.data[i];
           ids.push(row['id']);
           names.push(row['ztname']);
       }
       var idsStr=ids.join(',');
       var nameStr=names.join(',');
       if(result.id)
       {
           updateField(null,result.id,'themelist',idsStr,0);
           return;
       }
       $(".product_check:checked").each(function(index,element){
           var id=$(element).val();
           updateField(null,id,'themelist',idsStr,0,function(record){
             //  var id=record.get('id');
             //  $("#box_"+id).attr("checked",true);
           });
       });
   }
   function setOneDests(id)
   {
       CHOOSE.setSome("设置目的地",{loadCallback:setDests,maxHeight:500},SITEURL+'destination/dialog_setdest?typeid=6&id='+id,true);

   }
   function setOneIcons(id)
   {
       CHOOSE.setSome("设置图标",{loadCallback:setIcons},SITEURL+'icon/dialog_seticon?typeid=6&id='+id,true);
   }
   function setOneAttrids(id)
   {
       CHOOSE.setSome("设置属性",{loadCallback:setAttrids},SITEURL+'attrid/dialog_setattrid?typeid=6&id='+id,true);
   }
   function setOneThemes(id)
   {
       CHOOSE.setSome("设置专题",{loadCallback:setThemes},SITEURL+'theme/dialog_settheme?typeid=6&id='+id,true);
   }

</script>

</body>
</html>
<script type="text/javascript" src="http://update.souxw.com/service/api_V3.ashx?action=releasefeedback&ProductName=%E6%80%9D%E9%80%94CMS4.1&Version=4.1.201509.0901&DomainName=&ServerIP=unknown&SerialNumber=15109625" ></script>
