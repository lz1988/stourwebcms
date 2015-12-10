<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>思途CMS3.0</title>
    {php echo Common::getScript('jquery-1.8.3.min.js,extjs/ext-all.js,extjs/locale/ext-lang-zh_CN.js,config.js'); }
    {php echo Common::getCss('style.css,base.css,'); }
    {php echo Common::getCss('ext-theme-neptune-all-debug.css','js/extjs/resources/ext-theme-neptune/'); }
    
   {php echo Common::getScript("uploadify/jquery.uploadify.min.js"); }
   {php echo Common::getCss('uploadify.css','js/uploadify/'); }


<script src="/admin/public/vendor/slineeditor/js/editor_config.js"></script>
<script src="/admin/public/vendor/slineeditor/js/edito_all_min.js"></script>   
<script src="/admin/public/vendor/slineeditor/lang/zh-cn/zh-cn.js"></script>  
 <link rel="stylesheet" type="text/css" href="/admin/public/vendor/slineeditor/themes/default/css/ueditor.min.css">
</head>

<style>

.dest-add-btn{
	padding:1px 8px;
	cursor:pointer;
	color:#008ED8;

	font-weight:700;}
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
             <a href="javascript:;">首页</a> &gt; <a href="javascript:;">设置中心</a> &gt; <a href="javascript:;">基础设置</a> &gt; <span>目的地设置</span>
        </div>
 <div class="panel_bar" style="margin-top:50px">
 <input type="text" id="search"/>
 <a class="abtn" href="javascript:;" onClick="searchDest()">搜索</a>
 </div>     
 <div id="dest_tree_panel" class="content-nrt">

      </div>
  <div class="panel_bar">
    <a class="abtn" href="javascript:;" onClick="chooseAll()">全选</a>
    <a class="abtn" href="javascript:;" onClick="chooseDiff()">反选</a>
    <a class="abtn" href="javascript:;" onClick="delDest()">删除</a>
  </div>    
  </td>
  </tr>
 </table> 
<script>

   var rootUrl="{php echo URL::site();}";
  Ext.onReady(
    function() 
    {
		//目的地store
        window.dest_store=Ext.create('Ext.data.TreeStore',{
		 fields:[
		      {name:'displayorder',
			    sortType:sortTrans

			  },
			  {name:'isopen',
			    sortType:sortTrans

			  },
			  {name:'isnav',
			    sortType:sortTrans

			  },
			  {name:'ishot',
			    sortType:sortTrans
			  },
			  {
				 name:'istopnav',
			     sortType:sortTrans
			  },
			  {
				  name:'pinyin',
				  sortType:sortPinyin
			  },
		      {name:'id',convert:function(v,record){return 'dest_'+v;}},'kindname','pid','seotitle','keyword','description','tagword','jieshao','kindtype','isfinishseo','templetpath','litpic','piclist','issel'],	
         proxy:{
		   type:'ajax',
		   api: {
              read: 'destination/action/read',  //读取数据的URL
			  update:'destination/action/save',
			  destroy:'destination/action/delete'
              },
		      reader:'json'	
	         },	
         autoLoad:true,
		  listeners:{
			  sort:function(node,childNodes,eOpts )
			  { 
			     
			  }
		  }
		  
       });
	  
	   window.sel_model= Ext.create('Ext.selection.CheckboxModel'); 
	  
	   //目的地panel
	   window.dest_treepanel=Ext.create('Ext.tree.Panel',{ 
	   store:dest_store,
	   rootVisible:false,
	   padding:'2px',
	   renderTo:'dest_tree_panel',
	   border:0,
	   style:'margin-left:5px;border:0px;',
	   width:"99%",
	   bodyBorder:0,
	   bodyStyle:'border-width:0px',
	  // selModel:sel_model,
	   autoScroll:true,
	
	  
	   listeners:{
	   itemmousedown:function(node, record, item, index, e, eOpts )
		   {
			     var x=e.xy[0];
				 var column_x=Ext.getCmp('dest_name').getX();
				 var column_width=Ext.getCmp('dest_name').getWidth();
				 
				 if(x<column_x||x>column_x+column_width)
				    return false;

			 	 window.node_moving=true;
				
		   },
		   sortchange:function(ct, column, direction, eOpts)
		   {
			    		  	  
			     window.sort_direction=direction;
			     
				 var field=column.dataIndex;
				 if(field=='kindname')
				    field='pinyin';
			     window.dest_store.sort(field,direction);
				
		   },
		   celldblclick:function(view, td, cellIndex, record, tr, rowIndex, e, eOpts )
		   {
			   
			   if(record.get('displayorder')=='add')
			      return false;
		   },
		   afterlayout:function(panel)
		   {
			  var data_height=panel.getView().getEl().down('.x-grid-table').getHeight();
			   
			  var height=Ext.dom.Element.getViewportHeight();
			  
			// console.log(data_height+'---'+height);
              if(data_height>height-150)
			  {
				  window.has_biged=true;
				  panel.height=height-150;  
			  }
			  else if(data_height<height-150)
			  {
				  if(window.has_biged)
				  {
					delete panel.height;
					window.has_biged=false;  
			        window.dest_treepanel.doLayout();
				  }
			  }
					
		   }
		  
		 
	   },
	   viewConfig:{
		        forceFit:true,
				  border:0,
	               plugins: {
					   ptype: 'treeviewdragdrop',
					   enableDrag: true,
					   enableDrop: true,
					   displayField:'kindname'
				   },
				
				   listeners:{
		            boxready:function()
		            {
				
					var height=Ext.dom.Element.getViewportHeight();

                  
					   this.up('treepanel').maxHeight=height-150;  
					   this.up('treepanel').doLayout();
		            },
					
				   beforedrop:function(node, data, overModel, dropPosition, dropHandlers) {
						      if(dropPosition!='append')
							  {
								   dropHandlers.processDrop();
								   return;
							  }
                             
						      if(overModel.isLoaded())
							    dropHandlers.processDrop();
							  else 
							  {
								  
								  overModel.expand(false,function(){ dropHandlers.processDrop();});
							  }
							  
							  dropHandlers.cancelDrop();
							  
							   
								
                      }, 
					drop:function(node,data,overModel,dropPosition,eOpts )
				      {
						
						 var params={};
						 params['moveid']=data.records[0].get('id');
						 params['overid']=overModel.get('id');
						 params['position']=dropPosition;
						 
						 params['moveid']=params['moveid'].substr(params['moveid'].indexOf('_')+1);
						 params['overid']=params['overid'].substr(params['overid'].indexOf('_')+1);
						 
					
						 
						 if(dropPosition=='append')
						 {
							 
							 var  btn_node=window.dest_store.getNodeById(params['overid']+'add');
								 overModel.insertBefore(data.records[0],btn_node);

						 }
						 
						 //alert(overModel.children);
						  Ext.Ajax.request({
							url:'destination/action/drag',
							params:params,
							method:'POST',
							success: function(response){
								var text = response.responseText;
								if(text=='ok')
								{
									
								}else
								{
									
								}
								// process server response here
							}
						});
	 
				      }   
				   }
	   
	            },
	   columns:[
			   {
				   text:'<span class="grid_column_text">选择</span><img  src="/admin/public/images/help-ico.png" onclick="getHelp(event)" class="grid_column_help" alt="帮助" title="帮助">',
				   width:'8%',
				   dataIndex:'issel',
				   tdCls:'dest-al-mid',
				   xtype:'templatecolumn',
				   align:'center',
				   draggable:false,
				   border:0,
                   style: {
                    borderColor: 'white',
                    borderStyle: 'solid',
					background:'white'
                   },
				   tpl: new Ext.XTemplate(
					 '{[this.realName(values.id,values.issel)]}', 
                     {
					    realName: function (id,issel) {
						     if(id.indexOf('add')>1)
							    return '';
							  id=id.substr(id.indexOf('_')+1);
							// var ischecked=issel?"checked='checked'":'';  	
						    return "<input type='checkbox' class='dest_check' value='"+id+"' style='cursor:pointer' onclick='togCheck("+id+")'/>"; 	  
					     }
					 }
					) 
			   },
	           {
				  text:'<span class="grid_column_text">排序</span><img  src="/admin/public/images/help-ico.png" class="grid_column_help" alt="帮助" title="帮助">',
				  dataIndex:'displayorder',
				//  tdCls:'dest-al-mid',
			      width:'8%',
				  xtype:'templatecolumn',

				  editor: 'textfield',
				  draggable:false,
				  border:0,
                   style: {
                    borderColor: 'white',
                    borderStyle: 'solid',
					background:'white'
                   },
				   tpl: new Ext.XTemplate(
					 '{[this.realName(values.displayorder)]}', 
                     {
					    realName: function (order) {
						      if(order=='9999'||order=='add')
							      return '';
							  else
							      return order;	  
					     }
					 }
					) 
				  
			   },
			   {
				  xtype:'treecolumn',   //有展开按钮的指定为treecolumn
				  text:'<span class="grid_column_text">目的地</span><img  src="/admin/public/images/help-ico.png" class="grid_column_help" alt="帮助" title="帮助">',
				  dataIndex:'kindname',
				  id:'dest_name',
				  locked:false,
				  width:'16%',
				  editor: 'textfield',
				  border:0,
                   style: {
                    borderColor: 'white',
                    borderStyle: 'solid',
					background:'white'
                   }
			   },
			   {	
				   text:'<span class="grid_column_text">开启/关闭</span><img  src="/admin/public/images/help-ico.png" class="grid_column_help" alt="帮助" title="帮助">',
				   dataIndex:'isopen',
				   width:'15%',
				   xtype:'actioncolumn',
				   tdCls:'dest-al-mid',
				   align:'center',
				   border:0,
                   style: {
                    borderColor: 'white',
                    borderStyle: 'solid',
					background:'white'
                   },
		           items:[
			       {
			        getClass: function(v, meta, rec) {          // Or return a class from a function
					     
						var id=rec.get('id');
						if(id.indexOf('add')>0)
						    return '';
					    if(v==1)
						  return 'dest-status-ok';
						else
						  return 'dest-status-none';  
                    },
				    handler:function(view,index,colindex,itm,e,record)
				    {
					   // alert(itm);
					 //  var val=record.get('isopen');
					   togStatus(null,record,'isopen');
					  
					    
				    }
			      }
			      ]
			   },
			   {
				   text:'<span class="grid_column_text">首页显示</span><img  src="/admin/public/images/help-ico.png" class="grid_column_help" alt="帮助" title="帮助">',
				   dataIndex:'isnav',
				   width:'15%',
				   xtype:'actioncolumn',
				   tdCls:'dest-al-mid',
				   align:'center',
				   border:0,
                   style: {
                    borderColor: 'white',
                    borderStyle: 'solid',
					background:'white'
                   },
		           items:[
			       {
			        getClass: function(v, meta, rec) {          // Or return a class from a function
					    var id=rec.get('id');
						if(id.indexOf('add')>0)
						    return '';
					    if(v==1)
						  return 'dest-status-ok';
						else
						  return 'dest-status-none';  
                    },
				    handler:function(view,index,colindex,itm,e,record)
				    {
					   // alert(itm);
					 //  var val=record.get('isopen');
					   togStatus(null,record,'isnav');
					  
					    
				    }
			      }
			      ]
			   },
			   {
				  text:'<span class="grid_column_text">是否热门</span><img  src="/admin/public/images/help-ico.png" class="grid_column_help" alt="帮助" title="帮助">',
				   dataIndex:'ishot',
				   width:'15%',
				   xtype:'actioncolumn',
				   tdCls:'dest-al-mid',
				   align:'center',
				   border:0,
                   style: {
                    borderColor: 'white',
                    borderStyle: 'solid',
					background:'white'
                   },
		           items:[
			       {
			        getClass: function(v, meta, rec) {          // Or return a class from a function
					    var id=rec.get('id');
						if(id.indexOf('add')>0)
						    return '';
					    if(v==1)
						  return 'dest-status-ok';
						else
						  return 'dest-status-none';  
                    },
				    handler:function(view,index,colindex,itm,e,record)
				    {
					   // alert(itm);
					 //  var val=record.get('isopen');
					   togStatus(null,record,'ishot');
					  
					    
				    }
			      }
			      ]
			   },
			   {
				  text:'<span class="grid_column_text">智能主导航</span><img  src="/admin/public/images/help-ico.png" class="grid_column_help" alt="帮助" title="帮助">',
				   dataIndex:'istopnav',
				   width:'14%',
				   xtype:'actioncolumn',
				   tdCls:'dest-al-mid',
				   align:'center',
				   border:0,
                   style: {
                    borderColor: 'white',
                    borderStyle: 'solid',
					background:'white'
                   },
		           items:[
			       {  
			        getClass: function(v, meta, rec) {          // Or return a class from a function
					    var id=rec.get('id');
						if(id.indexOf('add')>0)
						    return '';
					    if(v==1)
						  return 'dest-status-ok';
						else
						  return 'dest-status-none';  
                    },
				    handler:function(view,index,colindex,itm,e,record)
				    {
					   togStatus(null,record,'istopnav'); 
				    }
			      }
			      ]
			   },
			   {
				   text:'<span class="grid_column_text">设置</span><img  src="/admin/public/images/help-ico.png" class="grid_column_help" alt="帮助" title="帮助">',
				   dataIndex:'id',
				   width:'8%',
				   tdCls:'dest-al-mid',
				   xtype:'templatecolumn',
				   sortable:false,
				   border:0,
                   style: {
                    borderColor: 'white',
                    borderStyle: 'solid',
					background:'white'
                   },
				   tpl: new Ext.XTemplate(
					 '{[this.realName(values.id)]}', 
                     {
					    realName: function (id) {
						     if(id.indexOf('add')>1)
							    return '';
						    return '<a href="javascript:;" onclick="destSet(\''+id+'\')">设置</a>' 	  
					     }
					 }
					) 
				  
			   }
		 ],
		  plugins: [
             Ext.create('Ext.grid.plugin.CellEditing', {
                  clicksToEdit:2,
                  listeners:{
					 edit:function(editor, e)
					 {
						 
					     e.record.commit();
					     e.record.save({params:{field:e.field}});
						 
					 }
				 }
               })
             ]
	   });
		   
	
  
	}
  );
  
  function togStatus(obj,record,field)
  {
       var val=record.get(field);
       var id=record.get('id');
	   id=id.substr(id.indexOf('_')+1);
	   var newval=val==1?0:1;
	   Ext.Ajax.request({
						 url   :  "destination/action/update",
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
  function destSet(dest_id)
  {
	var oid=dest_id.substr(dest_id.indexOf('_')+1);
	var record=window.dest_store.getNodeById(oid);
	var title=record.get('kindname')+'设置';
	
	var dest_description=record.get('description');
	var dest_jieshao=record.get('jieshao');
	Ext.create('Ext.window.Window',
	{
		title:title,
		width:500,
		autoShow:true,
		componentCls:'sm-window',
		frame:false,
		ghost:false,
		shadow:false,
		layout:'fit',
		style: {
			borderStyle: 'solid',
			borderWidth:'1px'
		},
		header:{
			componentCls:'sm-window-header'
		},
		items:[
		  {
			  xtype:'form',
			  layout:'fit',
			  items:[
			     {
					xtype:'tabpanel',
					cls:'gbl_tabs',
				
					bodyStyle:'margin-top:-2px;border-color:white;border-width:0px;border-style:none',
					tabBar:{
							style:"padding-right:90px;padding-bottom:0px;border-width:0px;background:#008ed8;height:30px",
							componentCls:'gbl-tbar',
							height:30,
							border:0
							
						},
					items:
					[
					   {
						   title:'基础设置',
						   padding:10,
						   defaults:{labelWidth:80,width:300},
						   items: [{
								xtype: 'textfield',
								name: 'kindname',
								fieldLabel: '目的地',
								allowBlank: false  // requires a non-empty value
							}, {
								xtype: 'textfield',
								name: 'seotitle',
								fieldLabel: '优化标题'
							},
							{
								xtype: 'textfield',
								name: 'tagword',
								fieldLabel: 'Tag词'
							
								
							},
							{
								xtype: 'textfield',
								name: 'pinyin',
								fieldLabel: '拼音',	
								allowBlank:false
							},
							{
								xtype: 'textfield',
								name: 'keyword',
								fieldLabel: '关键词'
							}
							]
						   
		
					   },
					   {
						  title:'描述与介绍',
						   padding:10,
						   defaults:{width:400,labelWidth:80},
						   html:'<table width="400"><tr><td  width="85">描述</td><td><textarea style="width:400px;height:80px" name="description">'+dest_description+'</textarea></td></tr><tr><td  width="85">介绍</td><td><textarea id="'+dest_id+'_dest_content" name="jieshao">'+dest_jieshao+'</textarea></td></tr></table>',
						listeners:{
							  afterrender:function()
									    {
											if(!window.dest_editor_set)
											   window.dest_editor_set={};
											if(window.dest_editor_set[dest_id+'_dest_content'])
											{
												window.dest_editor_set[dest_id+'_dest_content'].destroy();
											}
											window.dest_editor_set[dest_id+'_dest_content']=UE.getEditor(dest_id+'_dest_content',{toolbars:[['source', '|', 'undo', 'redo', '|',
                'bold', 'italic', 'underline','forecolor', 'backcolor'] ],initialFrameWidth:400,initialFrameHeight:100,zIndex:29000
				                      });
								        }
						 }
					   },
					   {
						   title:'图片列表',
						   html:"<table width='400'><tr><td id='"+dest_id+"_pic_list'></td></tr><tr><td><button id='"+dest_id+"_pic_btn'></button></td></tr></table>",
						   autoScroll:true,
						   minHeight:250,
						   padding:5,
						   listeners:{
							   boxready:function(picpanel)
							   {
								   var template='<tr><td align="center"><a href="javascript:;" onclick="delImgs(this,{img})">删除</a></td></tr><tr><td><img width="120" height="100" src="{img}"></td></tr><tr><td><input type="text" onblur="picName(this)"></td></tr>'; 
									
								   
									$("#"+dest_id+'_pic_btn').uploadify({
									'swf'      : rootUrl+'/public/js/uploadify/uploadify.swf',
									'uploader' : rootUrl+'destination/destination/action/uploadfile',
                                    'formData'     : {
                                            'webid':webid,
                                            'thumb':1,
                                            uploadcookie:"<?php echo Cookie::get('username')?>"
                                        },
									//'buttonImage' : '/resource/uploadify/up.jpg',  //指定背景图
									'auto':true,   //是否自动上传
									'height':27,  
									'width':120,
									'onUploadSuccess': function (file, data, response)
									  {  
										  if(data.indexOf('error')==-1)
										  {
											  var content=template.replace(/\{img\}/g,data);
											  Ext.get(dest_id+"_pic_list").appendChild({tag:'table','class':'pictab',html:content});  
										  }	
										 }
									  });

							   }
						   }
					   }
					] 
				 }
			  
			  ],
			  buttons:
		      {
		      style:"background:#fff;margin:0px",	 
		      items:[
				{ xtype: 'button', text:'提交',handler:function(bar){
					    
						 var cur_form=bar.up('form');
					     cur_form.updateRecord(record);
						 if(!cur_form.isValid())
						 {
							 return;
						 }
						try{ 
						var cur_description=cur_form.getEl().select('textarea[name=description]').first().getValue();
						var cur_jieshao=window.dest_editor_set[dest_id+'_dest_content'].getContent();
						record.set('description',cur_description);
						record.set('jieshao',cur_jieshao);
						}catch(e)
						{
							
						}

					    record.save({callback:function(records,operation,success){  
									 var hint=null;
									 if(success)
									 {
									   hint=Ext.Msg.show({msg:'保存成功',modal:false});
									 }
									 else
									 {
										hint=Ext.Msg.show({msg:'保存失败,请确认数据是否有过变动',modal:false}); 
									 } 
									 window.setTimeout(function(){hint.close()},1600)
							 }});
					
					}},
				{ xtype: 'button', text: '取消',handler:function(){ this.up('window').close();} }
			   ]
		     },
			 listeners:{
				 boxready:function(form)
				 {
					 form.loadRecord(record);
				 }
			 }
		  }
		],
		listeners:{
			boxready:function()
			{
				this.getEl().setStyle('z-index',500);
			}
		}
	})
	
	//alert(kindname);
  }
  
  
  function  addSub(pid)
  {
	  var precord=window.dest_store.getNodeById(pid);
	  var addnode=window.dest_store.getNodeById(pid+'add');
	  
	  Ext.Ajax.request({
					method:'post',
					url : 'destination/action/addsub',
					params:{pid:pid},
					success : function(response) {
					    var newrecord= Ext.decode(response.responseText);
						
						var view_el=window.dest_treepanel.getView().getEl()
						var scroll_top=view_el.getScrollTop();
						precord.insertBefore(newrecord,addnode);
					
						//view_el.scroll('t',scroll_top);
					}
				   });
	  
  }
  
  
  Ext.getBody().on('mouseup',function(){
	     window.node_moving=false;  
		 
		 //console.log('up_'+window.node_moving);
	  });
  Ext.getBody().on('mousemove',function(e, t, eOpts){
	  
	   if(window.node_moving==true)
	   { 
	    // console.log('mov_'+window.node_moving);
		  
	      var tree_view=window.dest_treepanel.down('treeview');
		  var view_y=tree_view.getY();
		  var view_bottom=view_y+tree_view.getHeight();
		   var mouse_y=e.getY();
		   if(mouse_y<view_y)
		      tree_view.scrollBy(0,-5,false);
		   if(mouse_y>view_bottom)
		      tree_view.scrollBy(0,5,false);	  
		  
	   }
	  });	  
  
  
  
  Ext.EventManager.onWindowResize(function(){ 
      var height=Ext.dom.Element.getViewportHeight();
	  
	    
	   window.dest_treepanel.height=(height-150);
	   window.dest_treepanel.doLayout();
	   
	 }) 
	   
  function cascadeDest(dest,index)
  {
	  if(dest.length==1)
	  {
		  var node=window.dest_store.getNodeById(dest[0]);
		  var ele=window.dest_treepanel.getView().getNode(node);
	      if(ele)
		  {
			  
			  var edom=Ext.get(ele);
			  edom.addCls('search-dest-tr');
			  if(index==0)
			  viewScroll(edom);
		  }
	  }
	  else
	  {
		  var node=window.dest_store.getNodeById(dest[0]);
		  dest.shift();
		  node.expand(false,function(){
			     cascadeDest(dest,index);
			  });
		  
	  }
  }
  function viewScroll(extdom)   //在treeview里滚动
  {
	     var tree_view=window.dest_treepanel.getView();
		 var view_y=tree_view.getY();
		 var dom_y=extdom.getY();
		 
		
	
	    window.setTimeout(function(){
			    window.first_scroll=true;
			    extdom.scrollIntoView(tree_view.getEl());
			},450);
	    //else
	      // extdom.scrollIntoView(tree_view.getEl());
		
		
  }
  function togCheck(id)
  {
	 
	 
	 /* var check_arr=Ext.query('.dest_check[checked]');
	  
	  var del_btn=Ext.ComponentQuery.query("#dest_del_btn")[0];
	  
	  if(check_arr.length>0)
	  {
		  del_btn.enable();
	  }
	  else
	      del_btn.disable();
		  */
	  
  }
  function chooseAll()
  {
	 var check_cmp=Ext.query('.dest_check');
	 for(var i in check_cmp)
	 {
		if(!Ext.get(check_cmp[i]).getAttribute('checked'))
		check_cmp[i].click();
	 } 
	 
	//  window.sel_model.selectAll();
  }
  function chooseDiff()
  {
	  var check_cmp=Ext.query('.dest_check');
		for(var i in check_cmp)
		  check_cmp[i].click();
		//var records=window.sel_model.getSelection();
		//window.sel_model.selectAll(true);
	
		//	window.sel_model.deselect(records,true);
	
		//var
  }
  function delDest()
  {
	  Ext.Msg.confirm("提示","确定删除",function(buttonId){
					   
	 if(buttonId=='no')
		 return;
	 var check_cmp=Ext.select('.dest_check:checked');
	 check_cmp.each(
	  function(el,c,index)
			{
						 //alert(el.getValue()); 
						 window.dest_store.getNodeById(el.getValue()).destroy();
						 
			}
		 );
		});
	  
  }
  function searchDest()
  {
	
	    var s_str=Ext.get('search').getValue();
					//s_str=s_str.trim();
					Ext.select('.search-dest-tr').removeCls('search-dest-tr');
					
					if(!s_str)
					   return;
				    Ext.Ajax.request({
							url:'destination/action/search',
							params:{keyword:s_str},
							method:'POST',
							success: function(response){
								
								alert('xxxx');
								var text = response.responseText;
								if(text=='no')
								{
									Ext.Msg.alert('查询结果', "未找到与'"+s_str+"'相关的目的地");
								}else
								{
									var list=Ext.decode(text);
									var index=0;
									for(var i in list)
									{
										var dest=list[i];
										cascadeDest(dest,index);
										index++;
									}	
								}
								// process server response here
							}
				});
			   
  }
  
  function getHelp(e)
  {
	  if ( e && e.stopPropagation ) 
    //因此它支持W3C的stopPropagation()方法 
        e.stopPropagation(); 
     else
    //否则，我们需要使用IE的方式来取消事件冒泡 
    window.event.cancelBubble = true; 
  }
  function sortTrans(val)
  {
	  if(!window.sort_direction)
	     return window.parseInt(val);
	  else
	  {
		 
		  if(val=='add')
		  {
			  if(window.sort_direction=='ASC')
			      return 100000000000000000;
			  else
			      return -10;	  
		  }
		  else
		     return window.parseInt(val);
	  }
	 // alert(val);
  }
  function sortPinyin(val)
  {

	  if(!window.sort_direction)
	     return val;
	  else
	  {
		  if(val=='add')
		  {
			  if(window.sort_direction=='ASC')
			      return 100000000000000000;
			  else
			      return 1;	  
		  }
		  else
		  {
			  if(!val)
			     return 555555555555;
			  else
			  {	 
			      val.toLowerCase();
				  var num1=val.charCodeAt(0);
				  var num2=val.charCodeAt(1);
				  if(isNaN(num2))
				     num2='000';
				  if(num2<100)
				     num2='0'+num2;  
					 
				  var num3=val.charCodeAt(2);
				  if(isNaN(num3))
				     num3='000';
				   if(num3<100)
				     num3='0'+num3;	 
				
				   var num4=val.charCodeAt(3);
				   if(isNaN(num4))
				     num4='000';
				  if(num4<100)
				     num4='0'+num4;
				  		 
				 var result=window.parseInt(num1+''+num2+''+num3+''+num4);	
				 
			 	 console.log(val+'_'+result);	 
				 return result; 
			  }
		  }
	  }
  }
</script>


<script>
 	
	
		
</script>
</body>
</html>
<script type="text/javascript" src="http://update.souxw.com/service/api_V3.ashx?action=releasefeedback&ProductName=%E6%80%9D%E9%80%94CMS4.1&Version=4.1.201507.1501&DomainName=&ServerIP=unknown&SerialNumber=15109625" ></script>
