<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>思途CMS3.0</title>
 {template 'stourtravel/public/public_js'}
   {php echo Common::getCss('style.css,base.css,base2.css,plist.css'); }
   {php echo Common::getCss('ext-theme-neptune-all-debug.css','js/extjs/resources/ext-theme-neptune/'); }
    
   {php echo Common::getScript("uploadify/jquery.uploadify.min.js"); }
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
     
  <div class="crumbs" id="dest_crumbs">
            <label>位置：</label>
             <a href="javascript:void(0);">首页</a>
      &gt; <a href="javascript:void(0);">产品中心</a>
      &gt; <a href="javascript:void(0);">线路管理</a>
   </div>

 
<div class="list-top-set">
   <div class="list-web-pad"></div>
   <div class="list-web-ct">
      <div class="list-web-ct-lt" id="list_ot_set">
          <a href="javascript:;" id="addbtn" class="add-btn-class ml-10">添加</a>


      </div>
      <div class="list-web-ct-rt" id="list_ot_web"></div>
   </div>
 </div>
   
 <div class="search-bar filter" id="search_bar">
     <span class="tit ml-10">筛选</span>
     <div class="change-btn-list mt-5 ml-10">
       <span class="change-btn-xz">站点切换&nbsp;&gt;&nbsp;<a href="#">全部</a></span>
       <div class="change-box-more">
         <div class="level">
           <a href="#">出境旅游</a>
           <a class="cur" href="#">国内旅游</a>
           <a href="#">特色旅游</a>
         </div>
         <div class="level">
           <a href="#">安徽</a>
           <a href="#">澳门</a>
           <a href="#">北京</a>
           <a href="#">福建</a>
           <a href="#">甘肃</a>
           <a href="#">广东</a>
           <a href="#">广西</a>
           <a href="#">贵州</a>
           <a href="#">河北</a>
           <a href="#">黑龙江</a>
           <a href="#">河南</a>
           <a href="#">湖北</a>
           <a href="#">湖南</a>
           <a class="cur" href="#">四川</a>
           <a href="#">三亚</a>
           <a href="#">江苏</a>
           <a href="#">云南</a>
         </div>
         <div class="level">
           <a href="#">成都</a>
           <a class="cur" href="#">稻城亚丁</a>
           <a href="#">达州</a>
           <a href="#">德阳</a>
           <a href="#">都江堰</a>
           <a href="#">青城山</a>
           <a href="#">峨眉乐山</a>
           <a href="#">海螺沟</a>
           <a href="#">红原若尔盖</a>
           <a href="#">黄龙旅游</a>
           <a href="#">九寨沟</a>
           <a href="#">阆中古城</a>
           <a href="#">四姑娘山</a>
           <a href="#">西昌泸沽湖</a>
           <a href="#">蜀南竹海</a>
         </div>
       </div>
     </div>
     
     <div class="change-btn-list mt-5 ml-10">
       <span class="change-btn-xz">出发地&nbsp;&gt;&nbsp;<a href="#">成都</a></span>
       <div class="">
       
       </div>
     </div>
     
     <div class="change-btn-list mt-5 ml-10">
       <span class="change-btn-xz">目的地&nbsp;&gt;&nbsp;<a href="#">九寨沟黄龙景区</a></span>
       <div class="">
       
       </div>
     </div>
     
     <div class="change-btn-list mt-5 ml-10">
       <span class="change-btn-xz">属性&nbsp;&gt;&nbsp;<a href="#">自驾游</a></span>
       <div class="">
       
       </div>
     </div>
   
   	 <div class="pro-search ml-10" style=" float:left; margin-top:5px">
        <input type="text" value="关键词/产品编号" class="sty-txt1 set-text-xh wid_200">
        <input type="button" value="搜索" class="sty-btn1 default-btn wid_60">
     </div>
   
     <span class="display-mod">
      <a href="javascript:void(0);" class="on" onClick="togMod(this,1)">基本信息</a>
      <a href="javascript:void(0);" onClick="togMod(this,2)">套餐</a>
      <a href="javascript:void(0);" onClick="togMod(this,3)">供应商</a>  
     </span>
   </div> 
 <div id="line_grid_panel" class="content-nrt">
    
  </div>
  </td>
  </tr>
 </table> 
<script>
   <?php 

	   echo  'window.attrmenu='.json_encode(Controller_Attrid::getattridlist(1)).';';
	   echo  'window.startplacemenu='.json_encode(Model_Startplace::getList()).';';
	   echo  'window.weblist='.json_encode(ORM::factory('weblist')->get_all()).';';
	   echo 'window.kindmenu='.json_encode(Common::getConfig('menu_sub.linekind')).';';
	 ?>

   window.display_mode=1;	
   var rootUrl="{php echo URL::site();}";
  Ext.onReady(
    function() 
    {
		 Ext.tip.QuickTipManager.init();
		 
		  /*顶部按钮，相关设置，站点等*/
		/* Ext.create('Ext.button.Button',{
			 renderTo:'list_ot_set',
			 style:'margin-left:10px;background:#07C3D9',
			 text:'添加',
             handler:function()
             {
               parent.window.addTab('添加线路','{$cmsurl}line/add/parentkey/product/itemid/1',0);
             }
			});*/
		
		 var kindsetmenu=[];	
		 Ext.Object.each(window.kindmenu,function(key,row,itself){
							       kindsetmenu.push({text:row.name,handler:function(){
									 
									        ST.Util.addTab(row.name,row.url);
								   }})
		 })
		 Ext.create('Ext.button.Button',{
			  text:'设置',
			  renderTo:'list_ot_set',
              cls:'ext-configbutton',
              focusCls:'ext-configbutton',
              componentCls:'',
			  menu: {
					items:kindsetmenu
				}
			 
			 });

		 
		 var web_menu_items=[];
		 Ext.Array.each(window.weblist,function(row,index,itself){
							     web_menu_items.push({text:row.webname,webid:row.webid});
							});
		
		 Ext.create('Ext.button.Cycle',{
			   renderTo:'list_ot_web',
			   text:'主站',
			   showText:true,
			   style:"background:#07C3D9;border:none",
			   menu:{
				   items:web_menu_items
			   },
			   changeHandler: function(cycleBtn, activeItem) {
                       if(!window.web_togfirst)
					   {
						   window.web_togfirst=1;
					       return;
					   }
					  window.line_store.getProxy().setExtraParam('webid',activeItem.webid);
					  window.line_store.load();
					   
                   }
			 
			 });
		//线路store
        window.line_store=Ext.create('Ext.data.Store',{

		 fields:['id','aid','webid','linename'
		 ,'kindlist','kindname','starttime','endtime','attrid','attrname','tprice','profit','lineprice','isjian','istejia','addtime','modtime','displayorder','ishidden','suit','jifentprice','jifencomment','jifenbook','propgroup','minprice','minprofit','tr_class','themelist','iconlist'],	

         proxy:{
		   type:'ajax',
		   api: {
              read: 'line/action/read',  //读取数据的URL
			  update:'line/action/save',
			  destroy:'line/action/delete'
              },
		      reader:{
                type: 'json',   //获取数据的格式 
                root: 'lines',
                totalProperty: 'total'
                }	
	         },

		 remoteSort:true,	 
		 pageSize:30,	 	


         autoLoad:true,
		 listeners:{
			 load:function( store, records, successful, eOpts )
			 {
				 if(window.display_mode==2)
				    return true;
				 for(var i in records)
				 {
					 var id=records[i].get('id');
					 if(id&&id.indexOf('suit')!=-1)
					 {
						 
				        var ele=window.line_grid.getView().getNode(records[i]);
						// Ext.get(ele).addCls('suit-tr');
						Ext.get(ele).setVisibilityMode(Ext.Element.DISPLAY);
					    Ext.get(ele).hide();
					 }
					
				 }
			 }
		 }
		  
       });
	   
	  //线路列表框 
	  window.line_grid=Ext.create('Ext.grid.Panel',{ 
	   store:line_store,
	   padding:'2px',
	   renderTo:'line_grid_panel',
	   border:0,
	   bodyBorder:0,
	   bodyStyle:'border-width:0px',
	   scroll:'vertical',
	   bbar: Ext.create('Ext.toolbar.Paging', {
                    store: line_store,  //这个和grid用的store一样
                    displayInfo: true,
                    emptyMsg: "没有数据了",
					items:[
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
							  select:changeNum
						  }
					  }
					
					],
				  listeners: {
						single: true,
						render: function(bar) {
							var items = this.items;
							bar.down('tbfill').hide();

							bar.insert(0,Ext.create('Ext.panel.Panel',{border:0,html:'<div class="panel_bar"><a class="abtn" href="javascript:void(0);" onclick="chooseAll()">全选</a><a class="abtn" href="javascript:void(0);" onclick="chooseDiff()">反选</a><a class="abtn" href="javascript:void(0);" onclick="delLine()">删除</a></div>'}));
							bar.insert(1,Ext.create('Ext.panel.Panel',{border:0,items:[{
								 xtype:'button',
								 text:'批量设置',
								 menu:[
								       {text:'目的地',handler:function(){ setSome(1)}},
									   {text:'属性',handler:function(){ setSome(2)}},
									   {text:'专题',handler:function(){ setSome(4)}},
									   {text:'图标',handler:function(){ setSome(3)}},
									 ]
								
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
				   tdCls:'line-ch',
				   align:'center',
				   dataIndex:'id',
                   sortable:false,
				   border:0,
				   renderer : function(value, metadata,record) {
					    id=record.get('id');
					    if(id.indexOf('suit')==-1)
					    return  "<input type='checkbox' class='line_check' style='cursor:pointer' value='"+value+"'/>"; 
					 
					}
				  
			   },
			   {
				   text:'排序',
				   width:'10%',
				   dataIndex:'displayorder',
                   tdCls:'line-order',
				   id:'column_lineorder',
				   align:'center',
				   border:0,
			       editor: 'textfield',
				   renderer : function(value, metadata,record) {
					              var id=record.get('id'); 
								   if(id.indexOf('suit')!=-1)
								        metadata.tdAttr ="data-qtip='指同一条线路下套餐的显示顺序'"+"data-qclass='dest-tip'";

								  if(value==9999||value==999999)
								      return '';
							      else 
								      return value;		  
					 
					}

				  
			   },
			   {
				   text:'线路名称',
				   width:'25%',
				   dataIndex:'linename',
				   align:'left',
				   id:'column_linename',
				   
				   border:0,
				   sortable:false,
				   renderer : function(value, metadata,record) {
					  //  return  "<input type='checkbox' class='line_check' value='"+value+"'/>"; 
		
			                         var aid=record.get('aid');
									 var id=record.get('id');
									 
									 if(!isNaN(id))
			                           return "<a href='/lines/show_"+aid+".html' class='line-title' target='_blank'>"+value+"</a>";
			                         else if(id.indexOf('suit')!=-1)
									 {
									    metadata.tdAttr ="data-qtip='点击跳转到套餐设置页面'  data-qclass='dest-tip'";
									   return "&nbsp;&nbsp;&nbsp;&nbsp;<a href='javascript:void(0);' class='suit-title'>"+value+"</a>";
									 }
					}
				  
			   }
			   ,
			   {
				   text:'积分抵现金',
				   width:'8%',
				   dataIndex:'jifentprice',
				   align:'center',
				   cls:'mod-2',	
				   editor:'textfield',
				   tdCls:'suit-cell',   
				   border:0,
				   sortable:false,
				   renderer : function(value, metadata,record) {
					                 var id=record.get('id');
			                         if(id.indexOf('suit')!=-1)
									 {
									    metadata.tdAttr ="data-qtip='双击修改积分'  data-qclass='dest-tip'";
									    return value;
									 }
					},
				   listeners:{
					    afterrender:function(obj,eopts)
						{
							if(window.display_mode!=2)
							    obj.hide();

					    }
					}
			   }
			   ,
			   {
				   text:'评论送积分',
				   width:'8%',
				   editor:'textfield',
				   dataIndex:'jifencomment',
				   align:'center',
				    cls:'mod-2',
				    tdCls:'suit-cell',   	
				   border:0,
				   sortable:false,
				    renderer : function(value, metadata,record) {
					                 var id=record.get('id');
			                         if(id.indexOf('suit')!=-1)
									 {
									    metadata.tdAttr ="data-qtip='双击修改积分'  data-qclass='dest-tip'";
									    return value;
									 }
					},
				   listeners:{
					    afterrender:function(obj,eopts)
						{
							if(window.display_mode!=2)
							    obj.hide();

					    }
					} 
			   }
			   ,
			   {
				   text:'购买送积分',
				   width:'8%',
				   dataIndex:'jifenbook',
				   align:'center',
				   editor:'textfield',
				   border:0,
				    cls:'mod-2',
				    tdCls:'suit-cell',   	
				   sortable:false,
				    renderer : function(value, metadata,record) {
					                 var id=record.get('id');
			                         if(id.indexOf('suit')!=-1)
									 {
									    metadata.tdAttr ="data-qtip='双击修改积分'  data-qclass='dest-tip'";
									    return value;
									 }
					},
				   listeners:{
					    afterrender:function(obj,eopts)
						{
							if(window.display_mode!=2)
							    obj.hide();

					    }
					}
			   },
			   {
				   text:'适用人群',
				   width:'8%',
				   dataIndex:'propgroup',
				   align:'center',
				   border:0,
				   cls:'mod-2',
				   tdCls:'suit-cell', 	
				   sortable:false,
				   renderer : function(value, metadata,record) {
						 var id=record.get('id');
						 if(!value)
						   return '';
						 else
						 {
							 var arr=value.split(',');
							 var str='';
							 for(var i in arr)
							 {
								 if(arr[i]==1)
								  str+='小孩'+',';
								 else if(arr[i]==2)
								  str+='成人'+',';
								 else if(arr[i]==3)
								  str+='老人'+',';
								
							 }
							 return str.slice(0,-1);     
							 
						 }
						
						 
						 
						
                    },
				   listeners:{
					    afterrender:function(obj,eopts)
						{
							if(window.display_mode!=2)
							    obj.hide();

					    }
					}
			   },
			    {
				   text:'最低价格(元)',
				   width:'9%',
				   align:'center',
				   border:0,
				   cls:'mod-2',
				   dataIndex:'minprice',
				   sortable:false,
				   listeners:{
					    afterrender:function(obj,eopts)
						{
							if(window.display_mode!=2)
							    obj.hide();

					    }
					}			  
				},
			    {
				   text:'最低利润(元)',
				   width:'8%',
				   align:'center',
				   dataIndex:'minprofit',
				   border:0,
				   cls:'mod-2',
				   sortable:false,
				   listeners:{
					    afterrender:function(obj,eopts)
						{
							if(window.display_mode!=2)
							    obj.hide();

					    }
					}			  
				},
				{
				   text:'管理',
				   width:'12%',
				   align:'center',
				   border:0,
				   cls:'mod-2',
				   sortable:false,
				   renderer : function(value, metadata,record) {
					  //  return  "<input type='checkbox' class='line_check' value='"+value+"'/>"; 
		
			                         var aid=record.get('aid');
									 var id=record.get('id');
                                     var name=record.get('linename');
			                          if(id.indexOf('suit')!=-1)
                                      {
                                         var suitid=id.slice(id.indexOf('_')+1);
									     return "<a href='javascript:;' onclick=\"ST.Util.addTab(\'修改套餐\',\'line/editsuit/suitid/"+suitid+"\')\">修改</a>&nbsp;&nbsp;<a href='javascript:void(0);' onclick=\"delSuit('"+id+"')\">删除</a>";
                                      }
                                      else
                                      {
                                          return '<a href="javascript:;" onclick="ST.Util.addTab(\'添加套餐\',\'line/addsuit/lineid/'+id+'\')">添加套餐</a>';
                                      }
					},				 
				   listeners:{
					    afterrender:function(obj,eopts)
						{
							if(window.display_mode!=2)
							    obj.hide();
					    }
					}			  
				
				}
			    ,
			   {
				   text:'提供商',
				   width:'8%',
				   align:'center',
				   //dataIndex:'attrid',
				   cls:'mod-3',
				   border:0,
				   sortable:false,
					listeners:{
					    afterrender:function(obj,eopts)
						{
							if(window.display_mode!=3)
							    obj.hide();

					    }
					}
				   
			   },
			   {
				   text:'提供商电话',
				   width:'8%',
				   align:'center',
				   //dataIndex:'attrid',
				   cls:'mod-3',
				   border:0,
				   sortable:false,
					listeners:{
					    afterrender:function(obj,eopts)
						{
							if(window.display_mode!=3)
							    obj.hide();

					    }
					}
				   
			   },
			   {
				   text:'目的地',
				   width:'10%',
				   dataIndex:'kindlist',
				   align:'center',
				    cls:'mod-1',
				   sortable:false,
				   renderer : function(value, metadata,record) {
					     var kindname=record.get('kindname');	 
						 if(kindname)
						 metadata.tdAttr ="data-qtip='"+kindname+"'"+"data-qclass='dest-tip'";
						 var id=record.get('id');
						 var d_text=value?'已设':'未设';
						
						 return "<a href='javascript:void(0);' onclick=\"ST.Destination.setDest(this,1,"+id+",'"+value+"',destSetBack)\">"+d_text+"</a>";
                                   // return getExpandableImage(value, metadata,record);
                    },
					 listeners:{
					    afterrender:function(obj,eopts)
						{
							if(window.display_mode!=1)
							    obj.hide();

					    }
					}

				  
			   },
			   {
				 text:'图标',
				   width:'7%',
				   align:'center',
				   dataIndex:'iconlist',
				   border:0,
				   cls:'mod-1',
				   sortable:false,
				   renderer : function(value, metadata,record) {
					     var id=record.get('id');
						 var d_text=value?'已设':'未设';
						 return "<a href='javascript:void(0);' onclick=\"ST.Icon.setIcon(this,1,"+id+",'"+value+"',iconSetBack)\">"+d_text+"</a>";
                                   // return getExpandableImage(value, metadata,record);
                    },
					 listeners:{
					    afterrender:function(obj,eopts)
						{
							if(window.display_mode!=1)
							    obj.hide();

					    }
					}
				 
  
			   },
			   {
				   text:'属性',
				   width:'7%',
				   align:'center',
				   dataIndex:'attrid',
				   border:0,
				   sortable:false,
				   cls:'mod-1',
				   renderer : function(value, metadata,record) {
					     var attrname=record.get('attrname');
						 if(attrname)
						 metadata.tdAttr ="data-qtip='"+attrname+"'data-qclass='dest-tip'";
						 var id=record.get('id');
						 var d_text=value?'已设':'未设';
						 return "<a href='javascript:void(0);' onclick=\"ST.Attrid.setAttrid(this,1,"+id+",'"+value+"',attrSetBack)\">"+d_text+"</a>";
                                   // return getExpandableImage(value, metadata,record);
                    },
					 listeners:{
					    afterrender:function(obj,eopts)
						{
							if(window.display_mode!=1)
							    obj.hide();

					    }
					}

			   },
			   {
				   text:'专题',
				   width:'10%',
				   align:'center',
				   sortable:false,
				  dataIndex:'themelist',
				  cls:'mod-1',
				   border:0,
				  renderer : function(value, metadata,record) {
					    
						 var id=record.get('id');
						 var d_text=value?'已设':'未设';
						 return "<a href='javascript:void(0);' onclick=\"ST.Theme.setTheme(this,1,"+id+",'"+value+"',themeSetBack)\">"+d_text+"</a>";
                                   // return getExpandableImage(value, metadata,record);
                    },
					 listeners:{
					    afterrender:function(obj,eopts)
						{
							if(window.display_mode!=1)
							    obj.hide();

					    }
					}
				  
			   },
			   {
				   text:'价格',
				   width:'9%',
                   dataIndex:'price',
				   align:'center',
				   border:0,
				   cls:'mod-1',
				   sortable:false,
				   renderer : function(value, metadata,record) {
					     var id=record.get('id');
						 return "<a href='javascript:void(0);' onclick=\"setPrice("+id+",'"+value+"')\">设置";
                                   // return getExpandableImage(value, metadata,record);
                    },
					 listeners:{
					    afterrender:function(obj,eopts)
						{
							if(window.display_mode!=1)
							    obj.hide();

					    }
					}
			   },
			   {
				   text:'隐藏',
				   width:'9%',
				  // xtype:'templatecolumn',
				   align:'center',
				   border:0,
				   dataIndex:'ishidden',
				   xtype:'actioncolumn',
				    cls:'mod-1',
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
					   togStatus(null,record,'ishidden');
					   
				    }
			      }
			      ],
				   listeners:{
					    afterrender:function(obj,eopts)
						{
							if(window.display_mode!=1)
							    obj.hide();

					    }
					}
				  
				  
			   },
			    {
				   text:'修改',
				   width:'9%',
				   align:'center',
				   border:0,
				   sortable:false,
				   cls:'mod-1',
				   renderer : function(value, metadata,record) {
                         var linename=record.get('linename');
					     var id=record.get('id');
						 return "<a href='javascript:void(0);' onclick=\"goModify("+id+",'"+linename+"')\">设置";
                                   // return getExpandableImage(value, metadata,record);
                    },
					 listeners:{
					    afterrender:function(obj,eopts)
						{
							if(window.display_mode!=1)
							    obj.hide();

					    }
					} 
				  
			   }
	           ],
			 listeners:{
		            boxready:function()
		            {
				
					    var height=Ext.dom.Element.getViewportHeight();
					   this.maxHeight=height-150;  
					   this.doLayout();
		            },
					afterlayout:function()
					{
			
			            if(window.line_kindname)
						{
							 Ext.getCmp('column_lineorder').setText(window.line_kindname+'-排序')
						}
						else
					    {
							Ext.getCmp('column_lineorder').setText('排序')
						}
					
						window.line_store.each(function(record){
				        id=record.get('id');
					    if(id.indexOf('suit')!=-1)
						  {
						     var ele=window.line_grid.getView().getNode(record);
							 var cls=record.get('tr_class');
							 Ext.get(ele).addCls(cls);
						  }
						else if(window.display_mode==2)
						 {
							 var ele=window.line_grid.getView().getNode(record);
							 var cls=record.get('tr_class');
							 Ext.get(ele).addCls(cls);
						 }
						
					   });
				  }
			 },
			 plugins: [
                Ext.create('Ext.grid.plugin.CellEditing', {
                  clicksToEdit:2,
                  listeners:{
					 edit:function(editor, e)
					 {
						   var id=e.record.get('id');
						   var view_el=window.line_grid.getView().getEl();
						  view_el.scrollBy(0,this.scroll_top,false);
						  updateField(0,id,e.field,e.value,0);
						  return false;
					 },
					 beforeedit:function(editor,e)
					 {
						 if(e.field=='jifentprice'||e.field=='jifenbook'||e.field=='jifencomment')
						 {
							  var id=e.record.get('id');
							  if(id.indexOf('suit')==-1)
							  {
								  return false;
							  }
						 }
						  var view_el=window.line_grid.getView().getEl()
	                       this.scroll_top=view_el.getScrollTop();		
						 
					 }
				 }
               })
             ]
			
			  
			   
			   
	   });
	   
	  
	  
	})
	
	//实现动态窗口大小
  Ext.EventManager.onWindowResize(function(){ 
      var height=Ext.dom.Element.getViewportHeight();
	   window.line_grid.maxHeight=(height-150);
	   window.line_grid.doLayout();
	   
	 }) 
	
	//出发地html
    var startplace_html='<table class="splace-search-cs"><tr><td colspan="2"><span class="sp-name"><a href="javascript:void(0);" onclick="goSearch(this,0,\'startcity\')" class="active">全部</a></span></td></tr>';
	for(var i in startplacemenu)
   {
	   startplace_html+="<tr><td colspan='2'>"+"<span class='sp-name'><a href='javascript:void(0);' onclick=\"goSearch(this,"+startplacemenu[i]['id']+",'startcity')\">"+startplacemenu[i]['cityname']+"</a></span></td></tr>";
	   
	   //alert(attrmenu[i]['menu']);
	   startplace_html+="<tr><td width='20'></td><td>";
	   for(var j in startplacemenu[i]['children'])
	   {
		   startplace_html+="<span class='sp-name'><a href='javascript:void(0);' onclick=\"goSearch(this,"+startplacemenu[i]['children'][j]['id']+",'startcity')\">"+startplacemenu[i]['children'][j]['cityname']+"</a></span>";
	   }
	   startplace_html+="</td></tr>";
    }
   startplace_html+='</table>';
   
   //出发地搜索按钮 
    /*window.startplace_btn=Ext.create('Ext.button.Button', {
    renderTo: 'search_bar_sp',
    text: '出发地',
		cls:'hj',
    menu: {
             xtype: 'menu',
             plain: true,
			 style:'border-width:0px',
			 bodyStyle:'border:0px;padding:0px;border-width:0px;background:#008ED8',	
			 border:0,
             items: {
                  xtype: 'panel',
				  style:'background:#008ED8;',
				  bodyStyle:'background:#008ED8;padding:5px',
				  html:startplace_html,
				  width:700,
				  border:0
				 }
		   }
    });	 
	 
	 
	 	
	
	//目的地搜索按钮
 
   window.dest_btn=Ext.create('Ext.button.Button', {
    renderTo: 'search_bar_sp',
    text: '目的地',
	style:'margin-left:10px',
    menu: {
             xtype: 'menu',
             plain: true,
			 style:'border-width:0px;',
			 bodyStyle:'border:0px;padding:0px;border-width:0px;background:#008ED8',
			 border:0,
             items: {
                  xtype: 'panel',
				  style:'background:#008ED8;',
				  bodyStyle:'background:#008ED8;padding:5px',
				  width:700,
				  html:'<div class="dest-cs-dlg"><div><input type="text" class="dest-keyword"/>&nbsp;&nbsp;<button onclick="getNextDest(0,0,1)">搜索</button></div><div id="dest_list" style=""></div></div>',
				  border:0,
				  listeners:{
					   afterrender:function(panel)
					   {
						   getNextDest(0,0,1);
					   }
				   }
				 }
		   }
    });
  	
	
	//属性搜索的html
   var attr_html='<table class="attr-search-cs"><tr><td colspan="2"><span class="sp-name"><a href="javascript:void(0);" onclick="goSearch(this,0,\'attrid\')" class="active">全部</a></span></td></tr>';
   for(var i in attrmenu)
   {
	   attr_html+="<tr><td colspan='2'>"+"<span class='sp-name'><a href='javascript:void(0);' onclick=\"goSearch(this,"+attrmenu[i]['id']+",'attrid')\">"+attrmenu[i]['attrname']+"</a></span></td></tr>";
	   
	   //alert(attrmenu[i]['menu']);
	   attr_html+="<tr><td width='20'></td><td>";
	   for(var j in attrmenu[i]['children'])
	   {
		   attr_html+="<span class='sp-name'><a href='javascript:void(0);' onclick=\"goSearch(this,"+attrmenu[i]['children'][j]['id']+",'attrid')\">"+attrmenu[i]['children'][j]['attrname']+"</a></span>";
	   }
	   attr_html+="</td></tr>";
    }
    attr_html+='</table>';
	
//属性搜索的菜单 
  window.attr_btn=Ext.create('Ext.button.Button', {
    renderTo: 'search_bar_sp',
	style:'margin-left:10px',
    text: '属性',
    menu: {
             xtype: 'menu',
             plain: true,
			 style:'border-width:0px',
			 bodyStyle:'border:0px;padding:0px;border-width:0px;background:#008ED8',
			 border:0,
             items: {
                  xtype: 'panel',
				  style:'background:#008ED8',
				  bodyStyle:'background:#008ED8;padding:5px',
				  html:attr_html,
				  border:0
				  }
		   }
  });*/
  
 
    function chooseDest(ele,id)
	{
		
		
	}
	function getNextDest(ele,pid,isfirst)   //获取目的地
	{
		 if(!isfirst)
		 goSearch(ele,pid,'kindid');
		 
		 var keyword='',step=0;
		 if(ele==0)
		 {
            keyword=Ext.select(".dest-keyword").first().getValue();
		 }
		 else
		 {
			step=Ext.get(ele).getAttribute('step');
			step=!step?0:step;
			step++;
		 }
		 
		 
		 
		 //var class=pid==0?
		 Ext.Ajax.request({
							 url   :  rootUrl+"destination/ajax_getNextDestList",
							 method  :  "POST",
							 datatype  :  "JSON",
							 params:{pid:pid,keyword:keyword,step:step},
							 success  :  function(response, opts) 
							 { 
								 var list=Ext.decode(response.responseText);
								 
								 if(list.length<=0)
								    return;
								 
								 
								 var str='<div class="step_'+step+' step_list">';
								 if(step==0)
								 {
								   var s_cls=isfirst||!pid?'active':'';	 
								   str='<div class="step_0 step_flist"><span class="sp-name"><a href="javascript:void(0);" step="0" class="step_all '+s_cls+'"  onclick="getNextDest(0)">全部</a></span>';                  
								 }
								 for(var i in list)
								 {
									 str+="<span class='sp-name'><a href='javascript:void(0);' step='"+step+"' onclick=\"getNextDest(this,"+list[i]['id']+",0)\">"+list[i]['kindname']+"</a></span>";
								 }
								  str+='</div>';
								
								var del_index=step;
								while(true)
								{
								    var todel=Ext.select(".step_"+del_index);
									if(todel.getCount()==0)
									    break;
									else
									{
										todel.remove();
										del_index++;
									}
									
								}
								  
								  
								Ext.get('dest_list').appendChild({html:str});
								window.dest_btn.down('panel').hide();
								window.dest_btn.down('panel').show();
								 // alert(list);
								 
								 
							 }});
	}

  
  
  
  //进行搜索
  function goSearch(ele,val,field)
  {
	  if(field=='attrid')
	  {
		  Ext.select('.attr-search-cs a').removeCls('active');
		  Ext.get(ele).addCls('active');
	  }
	  else if(field=='startcity')
	  {
		   Ext.select('.splace-search-cs a').removeCls('active');
		  Ext.get(ele).addCls('active');
	  }
	  else if(field=='kindid')
	  {
		 if(ele)
		 {
			Ext.select('#dest_list a').removeCls('active');
			Ext.get(ele).addCls('active'); 
			window.line_kindname=Ext.get(ele).getHTML();
			// Ext.select("dest-hint").first().update('当前目的地:'+Ext.get(ele).getHTML());;
		 }
		 else
		 {
			 Ext.select('.step_all').addCls('active');
			 window.line_kindname='';
		 }
		 
		window.line_kindid=val;  
	  }
	  
	  window.line_store.getProxy().setExtraParam(field,val);
	  window.line_store.load();
	  
  }
  
  function searchDest(ele)
  {
	   var keyword=Ext.get(ele).prev().getValue();
	   keyword=Ext.String.trim(keyword);
	   goSearch(0,keyword,'keyword');
  }
    
 
  
 	
	//更新某个字段
  function updateField(ele,id,field,value,type)
  {
	  var record=window.line_store.getById(id.toString());
	  if(type=='select')
	  {
		  value=Ext.get(ele).getValue();
	  }
	  Ext.Ajax.request({
						 url   :  "line/action/update",
						 method  :  "POST",
						 datatype  :  "JSON",
						 params:{id:id,field:field,val:value,kindid:window.line_kindid},
						 success  :  function(response, opts) 
						 {
							 if(response.responseText=='ok')
							{
							   var view_el=window.line_grid.getView().getEl()
	                           var scroll_top=view_el.getScrollTop();				   
							   record.set(field,value);
							   record.commit(); 
						       view_el.scrollBy(0,scroll_top,false);
							 }
						 }});

  }
	//切换每页显示数量
	function changeNum(combo,records)
	{
		
		var pagesize=records[0].get('num');
		window.line_store.pageSize=pagesize;
		window.line_grid.down('pagingtoolbar').moveFirst();
		//window.line_store.load({start:0});
	}
	//选择全部 
  function chooseAll()
  {
	 var check_cmp=Ext.query('.line_check');
	 for(var i in check_cmp)
	 {
		if(!Ext.get(check_cmp[i]).getAttribute('checked'))
		    check_cmp[i].checked='checked';
	 } 
	 
	//  window.sel_model.selectAll();
  }
  //反选
  function chooseDiff()
  {
	  var check_cmp=Ext.query('.line_check');
		for(var i in check_cmp)
		  check_cmp[i].click();

  }
  function delLine()
  {
	  //window.line_grid.down('gridcolumn').hide();
	  
	  var check_cmp=Ext.select('.line_check:checked');
	  
	  if(check_cmp.getCount()==0)
	  {
		  return;
	  }
	   Ext.Msg.confirm("提示","确定删除",function(buttonId){
		    if(buttonId!='yes')
		       return;
	 check_cmp.each(
		  function(el,c,index)
				{
						window.line_store.getById(el.getValue()).destroy();	 
				}
			 );
	   })
  }
  //切换显示或隐藏
   function togStatus(obj,record,field)
  {
       var val=record.get(field);
       var id=record.get('id');
	   var newval=val==1?0:1;
	   Ext.Ajax.request({
						 url   :  "line/action/update",
						 method  :  "POST",
						 datatype  :  "JSON",
						 params:{id:id,field:field,val:newval},
						 success  :  function(response, opts) 
						 {
							 if(response.responseText=='ok')
							{
								var view_el=window.line_grid.getView().getEl()
	                            var scroll_top=view_el.getScrollTop();		
							   record.set(field,newval);
							   record.commit();
							    view_el.scrollBy(0,scroll_top,false);
							 }
						 }});
	 
  }
  //删除套餐
  function delSuit(id)
  {
	  Ext.Msg.confirm("提示","确定删除这个套餐？",function(buttonId){
		    if(buttonId=='yes')
	         window.line_store.getById(id).destroy();
		  })
  }
  //切换视图，比如套餐，基本等
  function togMod(obj,num)
  {
	  window.display_mode=num;
	  Ext.get(obj).parent().select("a.on").removeCls('on');
	  Ext.get(obj).addCls('on');
	  
	   window.temp_records=Ext.clone(window.line_store.data.items);
	   	  window.line_store.removeAll();
	  var columns_1=window.line_grid.query("gridcolumn[cls=mod-1]");
	  var columns_2=window.line_grid.query("gridcolumn[cls=mod-2]");
	  var columns_3=window.line_grid.query("gridcolumn[cls=mod-3]");
	  
	  var allcolumns=[columns_1,columns_2,columns_3];
	  for(var j in allcolumns)
	  {
		     
			for(var i in allcolumns[j])
			{
				if(j==num-1)
			     allcolumns[j][i].show();
				else
				 allcolumns[j][i].hide();  
			}
		  
	  }
	  
     

	 
      //window.product_store.load();
   

window.line_store.loadData(window.temp_records);

	window.line_store.each(function(record){
		   id=record.get('id');
		   if(id.indexOf('suit')!=-1)
		   {
		      var ele=window.line_grid.getView().getNode(record);
				Ext.get(ele).setVisibilityMode(Ext.Element.DISPLAY);
				//Ext.get(ele).addCls('suit-tr');
				if(num!=2)
					Ext.get(ele).hide();
			    else
				   	Ext.get(ele).show();	
		   }
		});
	  
	
	  
	  
	  
  }
  //批量设置属性目的地图标专题等
  function setSome(num)
  {
	  var check_cmp=Ext.select('.line_check:checked');
	  if(check_cmp.getCount()==0)
	  {
	     ST.Util.showMsg('请选择线路',5);
		 return;
	  }
	  var products='';
	  check_cmp.each(function(el,c,index)
		{
			products+=el.getValue()+'_';
		});
	  switch(num)
	  {
		  case 1:
		     if(Ext.get('dest_window_'+products))
			     return;
		     ST.Destination.setDest(0,1,products,0,destSetBack);
	          break;
		  case 2:
		    if(Ext.get('attr_window_'+products))
			       return;
		     ST.Attrid.setAttrid(0,1,products,0,attrSetBack);
			  break;
		  case 3:
		       if(Ext.get('theme_window_'+products))
			     return;
		      ST.Icon.setIcon(0,1,products,0,iconSetBack);
			  break;
		  case 4:
		     if(Ext.get('icon_window_'+products))
			     return;
		     ST.Theme.setTheme(0,1,products,0,themeSetBack);
			 break;	 	  
	  }
	 
	  
	  
  }
  function attrSetBack(id,arr,bl)
  {
	   if(bl)
	   {
	      ST.Util.showMsg('设置属性成功',4);
	      
		  var attrid='';
		  var attrname='';
		  for(var i in arr)
		  {
			  attrid+=arr[i].id+',';
			  attrname+=arr[i].name+',';
		  }
		  attrid=attrid.slice(0,-1);
		  attrname=attrname.slice(0,-1);
		  refreshField(id,{attrid:attrid,attrname:attrname});
	   }
	  else 
	  {
		  ST.Util.showMsg('保存失败',5);
	  }
  }
  
  //目的地设置回调函数
  function destSetBack(productid,arr,bl)
  {
	  if(bl)
	  {
	     ST.Util.showMsg('设置目的地成功',4);
	      var kindlist='';
		  var kindname='';
		  for(var i in arr)
		  {
			  kindlist+=arr[i].id+',';
			  kindname+=arr[i].name+',';
		  }
		  kindlist=kindlist.slice(0,-1);
		  kindname=kindname.slice(0,-1);
		  refreshField(productid,{kindlist:kindlist,kindname:kindname});



	  }
	  else 
	  {
		  ST.Util.showMsg('保存失败',5);
	  }
  }
  //主题设置回调函数
  function themeSetBack(id,arr,bl)
  {
	   if(bl)
	   {
	     ST.Util.showMsg('设置主题成功',4);
		  var themelist='';
		  for(var i in arr)
		  {
			  themelist+=arr[i].id+',';
		  }
		  themelist=themelist.slice(0,-1);
		  refreshField(id,{themelist:themelist});
	   }
	  else 
	  {
		  ST.Util.showMsg('保存失败',5);
	  }
  }
  
  //图标设置回调函数
  function iconSetBack(id,arr,bl)
  {
	  if(bl)
	  {
	      ST.Util.showMsg('设置图标成功',4,1500);
	      var iconlist='';
		  for(var i in arr)
		  {
			  iconlist+=arr[i].id+',';
		  }
		  iconlist=iconlist.slice(0,-1);
		  refreshField(id,{iconlist:iconlist});
	   
	  }
	  else 
	  {
		  ST.Util.showMsg('保存失败',5,1500);
	  }
  }
  
  
  //刷新保存后的结果
  function refreshField(id,arr)
  {
	  id=id.toString();
	  var id_arr=id.split('_');
	  var view_el=window.line_grid.getView().getEl()
	  var scroll_top=view_el.getScrollTop();				   			      
	 Ext.Array.each(id_arr,function(num,index)
	  {
		   if(num)
		   {
		     var record=window.line_store.getById(num.toString());
			 
			 for(var key in arr)
			 {
				 record.set(key,arr[key]);
				 record.commit();
				 view_el.scrollBy(0,scroll_top,false); 
				// window.line_grid.getView().refresh();
			 }
		   }
	  })
	  
  }

  function goModify(lineid,linename)
  {
      parent.window.addTab(linename,SITEURL+'/line/edit/lineid/'+lineid,1);
  }
	
</script>

</body>
</html>
<script type="text/javascript" src="http://update.souxw.com/service/api_V3.ashx?action=releasefeedback&ProductName=%E6%80%9D%E9%80%94CMS4.1&Version=4.1.201507.1501&DomainName=&ServerIP=unknown&SerialNumber=15109625" ></script>
