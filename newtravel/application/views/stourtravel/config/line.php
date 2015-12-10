<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>思途CMS3.0</title>
    {php echo Common::getScript('jquery-1.8.3.min.js,extjs/ext-all.js,extjs/locale/ext-lang-zh_CN.js,config.js,common.js'); }
    {php echo Common::getCss('style.css,base.css,base2.css'); }
    {php echo Common::getCss('ext-theme-neptune-all-debug.css','js/extjs/resources/ext-theme-neptune/'); }
    
   {php echo Common::getScript("uploadify/jquery.uploadify.min.js"); }
   {php echo Common::getCss('uploadify.css','js/uploadify/'); }


<script src="/admin/public/vendor/slineeditor/js/editor_config.js"></script>
<script src="/admin/public/vendor/slineeditor/js/edito_all_min.js"></script>   
<script src="/admin/public/vendor/slineeditor/lang/zh-cn/zh-cn.js"></script>  
 <link rel="stylesheet" type="text/css" href="/admin/public/vendor/slineeditor/themes/default/css/ueditor.min.css">
</head>

<style>
.search-dest-tr td{
	background:#090
}
.x-body a:hover{
	text-decoration:none;
}
.panel_bar{
	margin-left:20px;
}
.panel_bar .abtn {
    background: #008ed8;
	color: #fff;
    padding: 4px 10px;
    height: 24px;
    line-height: 24px;
    margin-right: 10px;
}
.panel_bar a:hover{
	text-decoration:underline;
}
.panel_bar #search{
	height:24px;
	border:1px solid #008ED8;
}


.grid_column_text{
	float:left;
	}
.grid_column_help{
	float:left;
	margin-top:2px;
	margin-left:2px;
	cursor:pointer;
}
.dest-tip .x-tip-body-default{
	color:#008ed8;
	font-size:12px;
	
}

/* dest--public  */


.search-bar{
	width:99%;
	height:30px;
	padding-left:15px;
	background:#DCE4EA;
	border-bottom:2px solid #417B97;
	line-height:30px;
}

.search-bar .display-mod{
	float:right;
	margin-right:30px;
}
.search-bar .display-mod a{
	padding:4px 4px;
}
.search-bar .display-mod .on{
	background:#fff;
}

.suit-title
{
	color:#396769;
}
.line-title
{
	color:#15b000;
}
.row-hidden{
	display:none;
}

.suit-cell{
	color:#396769;
}

.suit-tr .x-grid-cell
{
	border-color:#fafafa;
}
.parent-line-tr .x-grid-cell
{
	border-color:#fafafa;
}
.suit-tr .line-ch,.parent-line-tr .line-ch
{
	border-bottom:0px;
}
.suit-tr  .line-order,.parent-line-tr .line-order
{
	border-bottom:0px;
}
.attr-search-cs tr,.splace-search-cs tr{
	height:30px;
	line-height:30px;
	color:#C2DBEC;
	font-size:12px;
}
.attr-search-cs sp-name,.splace-search-cs sp-name{
	float:left;
	margin-right:5px;
}
.attr-search-cs span a,.splace-search-cs span a{
	color:#C2DBEC;
	padding:4px;
}
.attr-search-cs span a:hover,.splace-search-cs span a:hover{
	background:#036;
}
.attr-search-cs span a.active,.splace-search-cs span a.active{
	background-color:#eee;
	color:black;
}






.dest-cs-dlg{
	line-height:30px;
	color:#C2DBEC;
	font-size:12px;
}
.dest-cs-dlg .sp-name{
	margin-right:8px;
} 
.dest-cs-dlg button{
	padding:2px 4px;
	color:#296B9B;
	font-size:12px;
	cursor:pointer;
}
.dest-cs-dlg span a{
	color:#C2DBEC;
	padding:4px;
}
.dest-cs-dlg span a:hover{
	background:#036;
}
.dest-cs-dlg span a.active{
	background-color:#eee;
	color:black;
}
.dest-cs-dlg .step_list{
	padding-left:20px;
	border-top:1px solid #aaa;
	margin-top:5px;
}
</style>
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
             <a href="javascript:void(0);">首页</a> &gt; <a href="javascript:void(0);">设置中心</a> &gt; <a href="javascript:void(0);">基础设置</a> &gt; <span>目的地设置</span>
         <span style="float:right;margin-right:150px"><input type="text" id="search"/>
 <a class="abtn" href="javascript:void(0);" onClick="searchDest()">搜索</a></span></div>

 
 <div style="height:80px;" class="other-module">
 
 </div>
   
 <div class="search-bar" id="search_bar">
   <span id="search_bar_sp">
   </span> 
   <span class="display-mod">
    <a href="javascript:void(0);" class="on" onClick="togMod(this,1)">基本信息</a>
    <a href="javascript:void(0);" onClick="togMod(this,2)">套餐</a>
    <a href="javascript:void(0);" onClick="togMod(this,3)">供应商</a>  
    </span>
   </div> 
 <div id="line_grid_panel" class="content-nrt">

  </div>
  <div class="panel_bar">

    <a class="abtn" href="javascript:void(0);" onClick="chooseAll()">全选</a>
    <a class="abtn" href="javascript:void(0);" onClick="chooseDiff()">反选</a>
    <a class="abtn" href="javascript:void(0);" onClick="delLine()">删除</a>
 
  </div>    
  </td>
  </tr>
 </table> 
<script>
   <?php 
     if(!empty($attrmenu))
     {
		 echo  'window.attrmenu='.json_encode(Controller_Attrid::getattridlist(1)).';';
		 echo  'window.startplacemenu='.json_encode(Model_Startplace::getList()).';';
	 }
	 ?>

   window.display_mode=1;	
   var rootUrl="{php echo URL::site();}";
  Ext.onReady(
    function() 
    {
		 Ext.tip.QuickTipManager.init();
		//目的地store
        window.line_store=Ext.create('Ext.data.Store',{

		 fields:['id','aid','webid','title'
		 ,'kindlist','kindname','starttime','endtime','attrid','attrname','tprice','profit','lineprice','isjian','istejia','addtime','modtime','displayorder','ishidden','suit','jifentprice','jifencomment','jifenbook','propgroup','minprice','minprofit','tr_class'],	

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
	   
	   
	  window.line_grid=Ext.create('Ext.grid.Panel',{ 
	   store:line_store,
	   padding:'2px',
	   renderTo:'line_grid_panel',
	   border:0,
	   width:"99%",
	   bodyBorder:0,
	   bodyStyle:'border-width:0px',
	   autoScroll:true,
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
							bar.insert(0,Ext.create('Ext.toolbar.Fill'));
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
				   width:'35%',
				   dataIndex:'title',
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
				   width:'7%',
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
				   width:'7%',
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
				   text:'删除',
				   width:'5%',
				   align:'center',
				   border:0,
				   cls:'mod-2',
				   sortable:false,
				   renderer : function(value, metadata,record) {
					  //  return  "<input type='checkbox' class='line_check' value='"+value+"'/>"; 
		
			                         var aid=record.get('aid');
									 var id=record.get('id');
			                          if(id.indexOf('suit')!=-1)
									     return "<a href='javascript:void(0);' onclick=\"delSuit('"+id+"')\">删除</a>"; 
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
				   width:'7%',
				   dataIndex:'kindlist',
				   align:'center',
				    cls:'mod-1',
				   sortable:false,
				   renderer : function(value, metadata,record) {
					     var kindname=record.get('kindname');
						 if(kindname)
						 metadata.tdAttr ="data-qtip='"+kindname+"'"+"data-qclass='dest-tip'";
						 var id=record.get('id');
						 return "<a href='javascript:void(0);' onclick=\"ST.Destination.setDest(this,1,"+id+",'"+value+"',destFunc)\">设置";
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
				 //  dataIndex:'attrid',
				   border:0,
				   cls:'mod-1',
				   sortable:false,
				   renderer : function(value, metadata,record) {
					     var id=record.get('id');
						 return "<a href='javascript:void(0);' onclick=\"setIcon("+id+")\">设置";
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
						 return "<a href='javascript:void(0);' onclick=\"ST.Attrid.setAttrid(this,1,"+id+",'"+value+"')\">设置";
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
				   width:'7%',
				   align:'center',
				   sortable:false,
				 //  dataIndex:'theme',
				  cls:'mod-1',
				   border:0,
				  renderer : function(value, metadata,record) {
					    
						 var id=record.get('id');
						 return "<a href='javascript:void(0);' onclick=\"setTheme("+id+",'"+value+"')\">设置";
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
				   width:'7%',
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
				   width:'7%',
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
				   width:'6%',
				   align:'center',
				   border:0,
				   sortable:false,
				   cls:'mod-1',
				   renderer : function(value, metadata,record) {
					     var id=record.get('id');
						 return "<a href='javascript:void(0);' onclick=\"goModify("+id+")\">设置";
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
						 
					     e.record.commit();
					     e.record.save({params:{field:e.field,kindid:window.line_kindid}});
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
    window.startplace_btn=Ext.create('Ext.button.Button', {
    renderTo: 'search_bar_sp',
    text: '出发地',
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
  });
  
 
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
    
 
  
 	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	function changeNum(combo,records)
	{
		
		var pagesize=records[0].get('num');
		
		window.line_store.pageSize=pagesize;
		
		window.line_grid.down('pagingtoolbar').moveFirst();
		//window.line_store.load({start:0});
	}
	 
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
							   record.set(field,newval);
							   record.commit();
							 }
						 }});
	 
  }
  function delSuit(id)
  {
	  Ext.Msg.confirm("提示","确定删除这个套餐？",function(buttonId){
		    if(buttonId=='yes')
	         window.line_store.getById(id).destroy();
		  })
  }
  
  function togMod(obj,num)
  {
	  window.display_mode=num;
	  Ext.get(obj).parent().select("a.on").removeCls('on');
	  Ext.get(obj).addCls('on');
	  
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
  function destFunc(kind_arr,bl,productid)
  {
	  if(bl)
	  Ext.Msg.alert('提示','保存成功');
	  else 
	  {
		  Ext.Msg.alert('提示','保存失败');
	  }
  }
	
</script>

</body>
</html>
