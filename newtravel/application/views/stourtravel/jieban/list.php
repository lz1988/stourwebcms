<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>结伴管理-思途CMS3.0</title>
 {template 'stourtravel/public/public_js'}
 {php echo Common::getCss('style.css,base.css,base2.css,plist.css'); }
 {php echo Common::getScript("uploadify/jquery.uploadify.min.js,jquery.buttonbox.js,choose.js"); }

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

                    </tr>
                </table>
            </div>
        </div>

        <div class="search-bar filter" id="search_bar">


            <div class="change-btn-list mt-5 ml-10">
                <span class="change-btn-xz btnbox" id="destination" data-url="box/index/type/destlist" data-result="result_dest" >目的地&nbsp;&gt;&nbsp;<span id="result_dest">全部</span></span>

            </div>

            <div class="change-btn-list mt-5 ml-10">
                <span class="change-btn-xz btnbox" id="attrlist" data-url="box/index/type/attrlist/typeid/{$typeid}" data-result="result_attrlist" >属性&nbsp;&gt;&nbsp;<span id="result_attrlist">全部</span></span>

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
   window.kindmenu = {$kindmenu};//分类设置菜单
   window.statuslist = {$statuslist};

   var typeid = "{$typeid}";
  Ext.onReady(
    function() 
    {
		 Ext.tip.QuickTipManager.init();

        $(".btnbox").buttonBox();

        $("#searchkey").focusEffect();
        //添加按钮
        $("#addbtn").click(function(){

            ST.Util.addTab('添加{$modulename}','{$cmsurl}tongyong/add/parentkey/product/itemid/{$typeid}/typeid/{$typeid}',0);
        });

      //  var kindsetmenu=[];
        var typeid = "{$typeid}";


		
		//产品store
        window.product_store=Ext.create('Ext.data.Store',{

		 fields:[
             'id',
             'series',
             'day',
             'title',
             'kindlist',
             'attrid',
             'ishidden',
             'startdate',
             'adultnum',
             'childnum',
             'displayorder',
             'kindname',
             'attrname',
             'themelist',
             'iconlist',
             'iconname',
             'addtime',
             'membername',
             'joinnum',
             'membermobile',
             'status'

         ],

         proxy:{
		   type:'ajax',
		   api: {
              read: SITEURL+'jieban/index/action/read/typeid/{$typeid}',  //读取数据的URL
			  update:SITEURL+'jieban/index/action/save/typeid/{$typeid}',
			  destroy:SITEURL+'jieban/index/action/delete/typeid/{$typeid}'
              },
		      reader:{
                type: 'json',   //获取数据的格式 
                root: 'lists',
                totalProperty: 'total'
                }	
	         },
		 remoteSort:true,
         autoLoad:true,
		 pageSize:30,
         listeners:{
                load:function( store, records, successful, eOpts )
                {
                    if(!successful){
                        ST.Util.showMsg("{__('norightmsg')}",5,1000);
                    }
                    var pageHtml=ST.Util.page(store.pageSize,store.currentPage,store.getTotalCount(),10);
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
	   bodyBorder:0,
	   bodyStyle:'border-width:0px',
       scroll:'vertical', //只要垂直滚动条
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
								 menu: {
                                     cls:'menu-no-icon',
                                     width:"82px",
                                     shadow:false,
                                     items:[
                                     {
                                         text: '目的地', handler: function () {
                                         CHOOSE.setSome("设置目的地", {
                                             loadCallback: setDests,
                                             maxHeight: 500
                                         }, SITEURL + 'destination/dialog_setdest');
                                     }
                                     },
                                     {
                                         text: '属性', handler: function () {
                                         CHOOSE.setSome("设置属性", {loadCallback: setAttrids}, SITEURL + 'attrid/dialog_setattrid?typeid=11');
                                     }
                                     },
                                     {
                                         text: '图标', handler: function () {
                                         CHOOSE.setSome("设置图标", {loadCallback: setIcons}, SITEURL + 'icon/dialog_seticon?typeid=11');
                                     }
                                     }
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
					    return  "<input type='checkbox' class='product_check' id='box_"+id+"' style='cursor:pointer' value='"+value+"'/>";
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
				   border:0,
                   cls:'sort-col',
				   renderer : function(value, metadata,record) {
					              var id=record.get('id');

                           var newvalue=value;
                           if(value==9999||value==999999||!value)
                               newvalue='';
                           return "<input type='text' value='"+newvalue+"' class='row-edit-txt' onblur=\"updateField(this,'"+id+"','displayorder',0,'input')\"/>";
					 
					}

				  
			   },

			   {
				   text:'标题',
				   width:'15%',
				   dataIndex:'title',
				   align:'left',
				   border:0,
                   id:'column_hotelname',
				   sortable:false,
                   menuDisabled:true,
				   renderer : function(value, metadata,record) {

							    var id=record.get('id');
                                var iconname = record.get('iconname')

									 
									 if(!isNaN(id))
			                           return "<a href='/jieban/show_"+id+".html' class='product-title' target='_blank'>"+value+"&nbsp;&nbsp;"+iconname+"</a>";

			                       
						}
				  
			   },
			   {
				   text:'目的地',
				   width:'5%',
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

                    }


				  
			   },
			   {
				 text:'图标',
				   width:'5%',
				   align:'center',
				   dataIndex:'iconlist',
				   border:0,
				   cls:'mod-1 sort-col',
				   sortable:true,
                   menuDisabled:true,
				   renderer : function(value, metadata,record,rowIndex,colIndex) {
					  
					     var id=record.get('id');
                         var d_text=value?'<span style="color:green">已设</span>':'<span style="color:red">未设</span>';
						 return "<a href='javascript:void(0);' onclick=\"setOneIcons("+id+")\">"+d_text+"</a>";
                    }
			   },
			   {
				   text:'属性',
				   width:'5%',
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
                    },
                   listeners:{
                       afterrender:function(obj,eopts)
                       {
                           if(window.display_mode!=1)
                               obj.hide();
                           else
                               obj.show();
                       }
                   }

			   },
			   {
				   text:'出发时间',
				   width:'6%',
				   align:'center',
				   sortable:false,
				   dataIndex:'startdate',
				   cls:'mod-1',
                   menuDisabled:true,
				   border:0,
				   renderer : function(value, metadata,record,rowIndex,colIndex) {
                          return value;
                    }

				  
			   },
               {
                   text:'成人数量',
                   width:'5%',
                   align:'center',
                   sortable:false,
                   dataIndex:'adultnum',
                   cls:'mod-1',
                   menuDisabled:true,
                   border:0,
                   renderer : function(value, metadata,record) {
                       return value;
                   }




               },
               {
                   text:'儿童数量',
                   width:'5%',
                   align:'center',
                   sortable:false,
                   dataIndex:'childnum',
                   cls:'mod-1',
                   menuDisabled:true,
                   border:0,
                   renderer : function(value, metadata,record) {
                       return value;
                   }




               },
               {
                   text:'发起人',
                   width:'7%',
                   align:'center',
                   sortable:false,
                   dataIndex:'membername',
                   cls:'mod-1',
                   menuDisabled:true,
                   border:0,
                   renderer : function(value, metadata,record,rowIndex,colIndex) {
                        return value;
                   },
                   listeners:{
                       afterrender:function(obj,eopts)
                       {

                       }
                   }


               },
               {
                   text:'发起人电话',
                   width:'7%',
                   align:'center',
                   sortable:false,
                   dataIndex:'membermobile',
                   cls:'mod-1',
                   menuDisabled:true,
                   border:0,
                   renderer : function(value, metadata,record,rowIndex,colIndex) {
                       return value;
                   },
                   listeners:{
                       afterrender:function(obj,eopts)
                       {

                       }
                   }


               },
               {
                   text:'已加入人数',
                   width:'5%',
                   align:'center',
                   sortable:false,
                   dataIndex:'joinnum',
                   menuDisabled:true,
                   cls:'mod-1',
                   border:0,
                   renderer : function(value, metadata,record,rowIndex,colIndex) {
                        return value;
                   },
                   listeners:{
                       afterrender:function(obj,eopts)
                       {

                       }
                   }


               },

			   {
				   text:'隐藏',
				   width:'5%',
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

					   var val=record.get('ishidden');
                       var id=record.get('id');
	                   var newval=val==1?0:1;
					   updateField(null,record.get('id'),'ishidden',newval)
					   
				    }
			      }
			      ],
                   listeners:{
                       afterrender:function(obj,eopts)
                       {
                           if(window.display_mode!=1)
                               obj.hide();
                           else
                               obj.show();
                       }
                   }
				  
				  
			   },
			   {
				   text:'添加时间',
				   width:'7%',
				   align:'center',
				   border:0,
                   menuDisabled:true,
				   dataIndex:'addtime',
                   cls:'sort-col',
				   renderer : function(value, metadata,record) {
					    /* var id=record.get('id');
						 var str=Ext.Date.format(new Date(value*1000), 'Y-m-d a'); 
						 str=str.replace('上午','A.M');
						 str=str.replace('下午','P.M');
						 return str;*/
                        return value;

                    },
                   listeners:{

                   }

				  
			   },
               {
                   text: '状态',
                   width: '6%',
                   dataIndex: 'status',
                   align: 'center',
                   cls: 'mod-1',
                   sortable: false,
                   menuDisabled:true,

                   renderer: function (value, metadata, record, rowIndex, colIndex) {

                       var id = record.get('id');
                       var status = record.get('status');
                       if (!isNaN(id)) {
                           // return "<select><option>一星级</option><option>二星级</option></select>";

                           var html = "<select onchange=\"updateField(this," + id + ",'status',0,'select')\" class='row-edit-select'>";

                           Ext.Array.each(window.statuslist, function (row, index, itelf) {
                               var is_selected = row.status == value ? "selected='selected'" : '';
                               html += "<option value='" + row.status + "' " + is_selected + ">" + row.statusname + "</option>";
                           });
                           html += "</select>";
                           return html;

                       }
                   },
                   listeners: {
                       afterrender: function (obj, eopts) {
                           if (window.display_mode != 1)
                               obj.hide();
                           else
                               obj.show();
                       }
                   }
               },
			   {
				   text:'管理',
				   width:'6%',
				   align:'center',
				   border:0,
				   sortable:false,
                   menuDisabled:true,
				   renderer : function(value, metadata,record) {
					     var id=record.get('id'); 
						 return "<a href='javascript:void(0);' class='row-show-btn' title='查看详情'  onclick=\"goView("+id+")\"></a>";
						 	
                                   // return getExpandableImage(value, metadata,record);
                    },
                   listeners:{

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
					afterlayout:function(grid)
					{
						
			
			            if(window.product_kindname)
						{
							 Ext.getCmp('column_lineorder').setText(window.product_kindname+'-排序')
						}
						else
					    {
							Ext.getCmp('column_lineorder').setText('排序')
						}

                        window.product_store.each(function(record){
                            id=record.get('id');

                            if(id.indexOf('suit')!=-1)
                            {

                                var ele=window.product_grid.getView().getNode(record);
                                var cls=record.get('tr_class');
                                Ext.get(ele).addCls(cls);
                                Ext.get(ele).setVisibilityMode(Ext.Element.DISPLAY);
                                if(window.display_mode!=2)
                                {
                                    Ext.get(ele).hide();
                                }
                                else
                                {
                                    Ext.get(ele).show();
                                }

                            }
                            else if(window.display_mode==2)
                            {
                                var ele=window.product_grid.getView().getNode(record);
                                var cls=record.get('tr_class');
                                Ext.get(ele).addCls(cls);
                            }

                        });
					   var data_height=0;
					   try{
					     data_height=grid.getView().getEl().down('.x-grid-table').getHeight();
					   }catch(e)
					   {
					   }
					  var height=Ext.dom.Element.getViewportHeight();

					  if(data_height>height-106)
					  {
						  window.has_biged=true;
						  grid.height=height-106;
					  }
					  else if(data_height<height-106)
					  {
						  if(window.has_biged)
						  {


							window.has_biged=false;  
							grid.doLayout();
						  }
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
	  var data_height=window.product_grid.getView().getEl().down('.x-grid-table').getHeight();
	  if(data_height>height-106)
	     window.product_grid.height=(height-106);
	   else
         delete  window.product_grid.height;
	   window.product_grid.doLayout();

	 }) 
	

 
  
  //更新某个字段
  function updateField(ele,id,field,value,type,callback)
  {
	  var record=window.product_store.getById(id.toString());
	  if(type=='select'|| type=='input')
	  {
		  value=Ext.get(ele).getValue();
	  }
	  var view_el=window.product_grid.getView().getEl();
	
	 
	  Ext.Ajax.request({
						 url   :  SITEURL+"jieban/index/action/update/typeid/{$typeid}",
						 method  :  "POST",
						 datatype  :  "JSON",
						 params:{id:id,field:field,val:value,kindid:window.product_kindid},
						 success  :  function(response, opts) 
						 {
							 if(response.responseText=='ok')
							 {
							 
							   record.set(field,value);
							   record.commit();
                                if(typeof(callback)=='function')
                                {
                                    callback(record);
                                }
						      
							 }
                             else
                             {
                                 ST.Util.showMsg("{__('norightmsg')}",5,1000);
                             }
						 }});

  }

  //修改
    function goView(id)
    {
        var url = SITEURL+'jieban/view/id/'+id;
        //parent.window.addTab('查看结伴',url,1);
        ST.Util.showBox('查看结伴',url,700,600,function(){});
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
             //  var id=record.get('id');
             //  $("#box_"+id).attr("checked",true);
           });
           return;
       }

       $(".product_check:checked").each(function(index,element){
           var id=$(element).val();
           updateField(null,id,'kindlist',idsStr,0,function(record){
               record.set('kindname',destNamesStr);
               record.commit();
              // var id=record.get('id');
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
              // $("#box_"+id).attr("checked",true);
           });
           return;
       }
       $(".product_check:checked").each(function(index,element){
           var id=$(element).val();
           updateField(null,id,'attrid',idsStr,0,function(record){
               record.set('attrname',nameStr);
               record.commit();
             //  var id=record.get('id');
             //  $("#box_"+id).attr("checked",true);
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
             //  $("#box_"+id).attr("checked",true);
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
       CHOOSE.setSome("设置目的地",{loadCallback:setDests,maxHeight:500},SITEURL+'destination/dialog_setdest?typeid=11&id='+id,true);

   }
   function setOneIcons(id)
   {
       CHOOSE.setSome("设置图标",{loadCallback:setIcons},SITEURL+'icon/dialog_seticon?typeid=11&id='+id,true);
   }
   function setOneAttrids(id)
   {
       CHOOSE.setSome("设置属性",{loadCallback:setAttrids},SITEURL+'attrid/dialog_setattrid?typeid=11&id='+id,true);
   }
   function setOneThemes(id)
   {
       CHOOSE.setSome("设置专题",{loadCallback:setThemes},SITEURL+'theme/dialog_settheme?typeid=11&id='+id,true);
   }

</script>

</body>
</html>
