<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>思途CMS3.0</title>
 {template 'stourtravel/public/public_js'}
   {php echo Common::getCss('style.css,base.css,base2.css,plist.css'); }
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
                <span class="change-btn-xz btnbox" id="attrlist" data-url="box/index/type/attrlist/typeid/13" data-result="result_attrlist" >属性&nbsp;&gt;&nbsp;<span id="result_attrlist">全部</span></span>

            </div>

            <div class="pro-search ml-10" style=" float:left; margin-top:4px">
                <input type="text" id="searchkey" value="团购名称/团购编号" datadef="团购名称/团购编号" class="sty-txt1 set-text-xh wid_200">
                <a href="javascript:;" class="head-search-btn" onclick="CHOOSE.searchKeyword()"></a>
            </div>

     <span class="display-mod">
       <span class="list-1 fl"><a href="javascript:void(0);" title="基本信息" class="on" onClick="CHOOSE.togMod(this,1)">基本信息</a></span>
       <span class="list-3 fl"><a href="javascript:void(0);" title="供应商" onClick="CHOOSE.togMod(this,3)">供应商</a></span>
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
  Ext.onReady(
    function() 
    {
		 Ext.tip.QuickTipManager.init();

        $(".btnbox").buttonBox();

        $("#searchkey").focusEffect();
        //添加按钮
        $("#addbtn").click(function(){
            var url=SITEURL+"hotel/add/parentkey/member/itemid/1";
            ST.Util.addTab('添加团购','{$cmsurl}tuan/add/parentkey/product/itemid/6',0);
        });


		//产品store
        window.product_store=Ext.create('Ext.data.Store',{

		 fields:[
             'id',
             'aid',
             'series',
             'webid',
             'title',
             'kindlist',
             'attrid',
             'ishidden',
             'displayorder',
             'kindname',
             'iconlist',
             'attrname',
             'themelist',
             'jifenbook',
             'jifentprice',
             'jifencomment',
             'iconlist',
             'iconname',
             'suppliername',
             'linkman',
             'endtime',
             'mobile',
             'qq',
             'address'
         ],

         proxy:{
		   type:'ajax',
		   api: {
              read: SITEURL+'tuan/tuan/action/read',  //读取数据的URL
			  update:SITEURL+'tuan/tuan/action/save',
			  destroy:SITEURL+'tuan/tuan/action/delete'
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
	   width:"100%",
	   bodyBorder:0,
	   bodyStyle:'border-width:0px',
	   scroll:'vertical',
	   bbar: Ext.create('Ext.toolbar.Toolbar', {
                    store: product_store,  //这个和grid用的store一样
                    displayInfo: true,
                    emptyMsg: "没有数据了",
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
								 menu:
                                     {
                                         cls:'menu-no-icon',
                                         width:"82px",
                                         shadow:false,
                                         items:[
                                         {text:'目的地',handler:function(){ CHOOSE.setSome("设置目的地",{loadCallback:setDests,maxHeight:500},SITEURL+'destination/dialog_setdest');}},
                                         {text:'属性',handler:function(){ CHOOSE.setSome("设置属性",{loadCallback:setAttrids},SITEURL+'attrid/dialog_setattrid?typeid=13');}},
                                         {text:'专题',handler:function(){ CHOOSE.setSome("设置专题",{loadCallback:setThemes},SITEURL+'theme/dialog_settheme?typeid=13');}},
                                         {text:'图标',handler:function(){  CHOOSE.setSome("设置图标",{loadCallback:setIcons},SITEURL+'icon/dialog_seticon?typeid=13');}}
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
				   width:'5%',
				  // xtype:'templatecolumn',
				   tdCls:'product-ch',
				   align:'center',
				   dataIndex:'id',
                   menuDisabled:true,
				   border:0,
				   renderer : function(value, metadata,record) {
					    id=record.get('id');
					    if(id.indexOf('suit')==-1)
					    return  "<input type='checkbox' class='product_check' style='cursor:pointer' id='box_"+id+"' value='"+value+"'/>";
					 
					}
				  
			   },
			   {
				   text:'排序',
				   width:'7%',
				   dataIndex:'displayorder',
                   tdCls:'product-order',
				   id:'column_lineorder',
                   menuDisabled:true,
                   cls:'sort-col',
				   align:'center',
				   border:0,
				   renderer : function(value, metadata,record) {
					              var id=record.get('id');
                       var newvalue=value;
                       if(value==9999||value==999999||!value)
                           newvalue='';
                       return "<input type='text' value='"+newvalue+"' class='row-edit-txt' onblur=\"updateField(this,'"+id+"','displayorder',0,'input')\"/>";


                   }

				  
			   },
               {
                   text:'编号',
                   width:'5%',
                   dataIndex:'series',
                   align:'center',
                   id:'column_series',
                   menuDisabled:true,
                   border:0,
                   sortable:false,
                   renderer : function(value, metadata,record) {

                       return '<span style="color:red">'+value+'</span>';
                   }


               },
			   {
				   text:'团购名称',
				   width:'25%',
				   dataIndex:'title',
				   align:'left',
                   menuDisabled:true,
				   border:0,
				   sortable:false,
				   renderer : function(value, metadata,record) {
					            var aid=record.get('aid');
							    var id=record.get('id');
                                var iconname = record.get('iconname');
									 
									 if(!isNaN(id))
			                           return "<a href='/tuan/show_"+aid+".html' class='product-title' target='_blank'>"+value+iconname+"</a>";
			                       
						}
				  
			   },
               {
                   text: '报价有效期',
                   width: '8%',
                   align: 'center',
                   dataIndex:'endtime',
                   menuDisabled:true,
                   border: 0,
                   cls: 'mod-1 sort-col',
                   sortable: true,
                   renderer: function (value, metadata, record) {
                       //  return  "<input type='checkbox' class='product_check' value='"+value+"'/>";
                       var curdate=new Date();
                       var curtimestamp=curdate.getTime();

                       var date=new Date(value*1000);
                       if(value!=0) {
                           var color=value*1000<curtimestamp?'red':'green';
                           return '<span style="color:'+color+'">' + Ext.Date.format(date, 'Y-m-d') + '</span>';
                       }
                       else
                           return '<span style="color:red">无</span>';


                   }
               },
			   {
				   text:'目的地',
				   width:'5%',
				   dataIndex:'kindlist',
				   align:'center',
				   cls:'mod-1 sort-col',
                   menuDisabled:true,
				   sortable:true,
				   renderer : function(value, metadata,record,rowIndex,colIndex) {
					   
					     var kindname=record.get('kindname');
						 if(kindname)
						 metadata.tdAttr ="data-qtip='"+kindname+"'"+"data-qclass='dest-tip'";
						 var id=record.get('id');
                       var d_text=value?'<span style="color:green">已设</span>':'<span style="color:red">未设</span>';
						 return "<a href='javascript:void(0);' onclick=\"setOneDests("+id+")\">"+d_text+"</a>";
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
				 text:'图标',
				   width:'5%',
				   align:'center',
				   dataIndex:'iconlist',
				   border:0,
                   menuDisabled:true,
				   cls:'mod-1 sort-col',
				   sortable:true,
				   renderer : function(value, metadata,record,rowIndex,colIndex) {
					  
					     var id=record.get('id');
                         var d_text=value?'<span style="color:green">已设</span>':'<span style="color:red">未设</span>';
						 return "<a href='javascript:void(0);' onclick=\"setOneIcons("+id+")\">"+d_text+"</a>";
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
				   text:'专题',
				   width:'5%',
				   align:'center',
				   sortable:true,
                   menuDisabled:true,
				  dataIndex:'themelist',
				  cls:'mod-1 sort-col',
				   border:0,
				  renderer : function(value, metadata,record,rowIndex,colIndex) {
					
						 var id=record.get('id');
                         var d_text=value?'<span style="color:green">已设</span>':'<span style="color:red">未设</span>';
						 return "<a href='javascript:void(0);' onclick=\"setOneThemes("+id+")\">"+d_text+"</a>";
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
					  // togStatus(null,record,'ishidden');
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
				   text:'预订送积分',
				   width:'6%',
				   align:'center',
				   border:0,
				   sortable:false,
				   dataIndex:'jifenbook',
				   cls:'mod-2',
                   menuDisabled:true,
				   renderer : function(value, metadata,record) {
                       var id=record.get('id');
                       value=!value?'':value;
                       return  "<input type='text' value='"+value+"' class='row-edit-txt' onblur=\"updateField(this,'"+id+"','jifenbook',0,'input')\"/>";
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
				   text:'积分抵现金',
				   width:'6%',
				   align:'center',
                   menuDisabled:true,
				   border:0,
				   sortable:false,
				   dataIndex:'jifentprice',
				   cls:'mod-2',
				   renderer : function(value, metadata,record) {

                       var id=record.get('id');
                       value=!value?'':value;
                       return  "<input type='text' value='"+value+"' class='row-edit-txt' onblur=\"updateField(this,'"+id+"','jifentprice',0,'input')\"/>";
					   
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
				   text:'评论送积分',
				   width:'6%',
				   align:'center',
				   border:0,
				   sortable:false,
                   menuDisabled:true,
				   dataIndex:'jifencomment',
				   cls:'mod-2',
				   renderer : function(value, metadata,record) {
                       var id=record.get('id');
                       value=!value?'':value;
                       return  "<input type='text' value='"+value+"' class='row-edit-txt' onblur=\"updateField(this,'"+id+"','jifencomment',0,'input')\"/>";
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
				   text:'管理',
				   width:'7%',
				   align:'center',
				   border:0,
				   sortable:false,
                    menuDisabled:true,
				   cls:'mod-2',
				  renderer : function(value, metadata,record) {
					     var id=record.get('id');
                         var title=record.get('title');
						 return "<a href='javascript:void(0);' class='row-mod-btn' title='编辑' onclick=\"goModify('"+id+"')\"></a>";
						 	
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
                       text:'供应商',
                       width:'14%',
                       align:'center',
                       dataIndex:'suppliername',
                       cls:'mod-3',
                       border:0,
                       menuDisabled:true,
                       sortable:false,
                       listeners:{
                           afterrender:function(obj,eopts)
                           {
                               if(window.display_mode!=3)
                                   obj.hide();
                               else
                                   obj.show();

                           }
                       }

                   },
                   {
                       text:'联系人',
                       width:'9%',
                       align:'center',
                       dataIndex:'linkman',
                       cls:'mod-3',
                       border:0,
                       sortable:false,
                       menuDisabled:true,
                       listeners:{
                           afterrender:function(obj,eopts)
                           {
                               if(window.display_mode!=3)
                                   obj.hide();
                               else
                                   obj.show();

                           }
                       }

                   },
                   {
                       text:'联系电话',
                       width:'9%',
                       align:'center',
                       dataIndex:'mobile',
                       cls:'mod-3',
                       border:0,
                       sortable:false,
                       menuDisabled:true,
                       listeners:{
                           afterrender:function(obj,eopts)
                           {
                               if(window.display_mode!=3)
                                   obj.hide();
                               else
                                   obj.show();

                           }
                       }

                   },
                   {
                       text:'QQ',
                       width:'9%',
                       align:'center',
                       dataIndex:'qq',
                       cls:'mod-3',
                       border:0,
                       sortable:false,
                       menuDisabled:true,
                       listeners:{
                           afterrender:function(obj,eopts)
                           {
                               if(window.display_mode!=3)
                                   obj.hide();
                               else
                                   obj.show();

                           }
                       }

                   },
                   {
                       text:'地址',
                       width:'11%',
                       align:'left',
                       dataIndex:'address',
                       cls:'mod-3',
                       border:0,
                       sortable:false,
                       menuDisabled:true,
                       listeners:{
                           afterrender:function(obj,eopts)
                           {
                               if(window.display_mode!=3)
                                   obj.hide();
                               else
                                   obj.show();

                           }
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
					// console.log(data_height+'---'+height);
					  if(data_height>height-106)
					  {
						  window.has_biged=true;
						  grid.height=height-106;
					  }
					  else if(data_height<height-106)
					  {
						  if(window.has_biged)
						  {
							delete window.product_grid.height;
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
	      delete window.product_grid.height;
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
						 url   :  "tuan/action/update",
						 method  :  "POST",
						 datatype  :  "JSON",
						 params:{id:id,field:field,val:value,kindid:window.product_kindid},
						 success  :  function(response, opts) 
						 {
							 if(response.responseText=='ok')
							 {
							 // var view_el=window.product_grid.getView().getEl()
	                            // var scroll_top=view_el.getScrollTop();				   
					   
							   record.set(field,value);
							   record.commit();
                               if(typeof(callback)=='function')
                               {
                                   callback(record);
                               }
						     //  view_el.scrollBy(0,scroll_top,false);
							 }
						 }});

  }
  
  //修改
  function goModify(id)
  {
      var url = SITEURL+'tuan/edit/parentkey/product/itemid/6/tuanid/'+id;

      parent.window.addTab('修改团购',url,0);
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
               var id=record.get('id');
               $("#box_"+id).attr("checked",true);
           });
           return;
       }

       $(".product_check:checked").each(function(index,element){
           var id=$(element).val();
           updateField(null,id,'kindlist',idsStr,0,function(record){
               record.set('kindname',destNamesStr);
               record.commit();
             //  var id=record.get('id');
            //   $("#box_"+id).attr("checked",true);
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
             //  var id=record.get('id');
             //  $("#box_"+id).attr("checked",true);
           });
           return;
       }
       $(".product_check:checked").each(function(index,element){
           var id=$(element).val();
           updateField(null,id,'attrid',idsStr,0,function(record){
               record.set('attrname',nameStr);
               record.commit();
              // var id=record.get('id');
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
            //   var id=record.get('id');
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
       CHOOSE.setSome("设置目的地",{loadCallback:setDests,maxHeight:500},SITEURL+'destination/dialog_setdest?typeid=13&id='+id,true);

   }
   function setOneIcons(id)
   {
       CHOOSE.setSome("设置图标",{loadCallback:setIcons},SITEURL+'icon/dialog_seticon?typeid=13&id='+id,true);
   }
   function setOneAttrids(id)
   {
       CHOOSE.setSome("设置属性",{loadCallback:setAttrids},SITEURL+'attrid/dialog_setattrid?typeid=13&id='+id,true);
   }
   function setOneThemes(id)
   {
       CHOOSE.setSome("设置专题",{loadCallback:setThemes},SITEURL+'theme/dialog_settheme?typeid=13&id='+id,true);
   }

</script>

</body>
</html>
