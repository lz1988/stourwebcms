<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>文章管理-思途CMS3.0</title>
 {template 'stourtravel/public/public_js'}
 {php echo Common::getCss('style.css,base.css,base2.css,plist.css'); }
 {php echo Common::getScript("jquery.buttonbox.js,choose.js"); }

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
                <span class="change-btn-xz btnbox" id="helpkind" data-url="box/index/type/helpkind" data-result="result_helpkind" >分类&nbsp;&gt;&nbsp;<span id="result_helpkind">全部</span></span>
            </div>
            <div class="pro-search ml-10" style=" float:left; margin-top:4px">
                <input type="text" id="searchkey" value="帮助名称" datadef="帮助名称" class="sty-txt1 set-text-xh wid_200">
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

   var kindlist={$kindlist};
   var typearr={json_encode($posArr)};
   window.kindmenu = {$kindmenu};//分类设置菜单
  Ext.onReady(
    function() 
    {
		 Ext.tip.QuickTipManager.init();
         $(".btnbox").buttonBox();

         $("#searchkey").focusEffect();
        //添加按钮
         $("#addbtn").click(function(){

            ST.Util.addTab('添加帮助','{$cmsurl}help/add/parentkey/article/itemid/6',1);
        });



		//产品store
        window.product_store=Ext.create('Ext.data.Store',{

		 fields:[
             'id',
             'aid',
             'webid',
             'title',
             'displayorder',
             'kindid',
             'modtime',
             'type_id'
         ],

         proxy:{
		   type:'ajax',
		   api: {
              read: SITEURL+'help/list/action/read',  //读取数据的URL
			  update:SITEURL+'help/list/action/save',
			  destroy:SITEURL+'help/list/action/delete'
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
						//	bar.down('tbfill').hide();

							bar.insert(0,Ext.create('Ext.panel.Panel',{border:0,html:'<div class="panel_bar"><a class="abtn" href="javascript:void(0);" onclick="CHOOSE.chooseAll()">全选</a><a class="abtn" href="javascript:void(0);" onclick="CHOOSE.chooseDiff()">反选</a><a class="abtn" href="javascript:void(0);" onclick="CHOOSE.delMore()">删除</a></div>'}));
							
							bar.insert(1,Ext.create('Ext.toolbar.Fill'));
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
                   menuDisabled:true,
				   border:0,
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
				   border:0,
                   menuDisabled:true,
                   cls:'sort-col',
			       editor: 'textfield',
				   renderer : function(value, metadata,record) {
					              var id=record.get('id');

                           var newvalue=value;
                           if(value==9999||value==999999||!value)
                               newvalue='';
                           return "<input type='text' value='"+newvalue+"' class='row-edit-txt' onblur=\"updateField(this,'"+id+"','displayorder',0,'input')\"/>";

					}

				  
			   },
			   {
				   text:'帮助标题',
				   width:'28%',
				   dataIndex:'title',
				   align:'left',
				   border:0,
				   sortable:false,
                   menuDisabled:true,
				   renderer : function(value, metadata,record) {
					            var aid=record.get('aid');
							 var id=record.get('id');
									 
									 if(!isNaN(id))
			                           return "<a href='/help/show_"+aid+".html' class='product-title' target='_blank'>"+value+"</a>";
			                       
						}
				  
			   },
			   {
				   text:'显示位置',
				   width:'30%',
				   align:'center',
				   border:0,
				   sortable:false,
                   menuDisabled:true,
				   dataIndex:'type_id',
				   renderer : function(value, metadata,record) {
					        var id=record.get('id');
					        var kind_arr=value?value.split(','):[];
							var html="";
							Ext.Array.each(kind_arr,function(row,index){
								     if(typearr['type'+row])
								       html+=typearr['type'+row]+'|';
								})
						    if(!html)
							 html="<font color='red'>暂无</font>"
						    else
							 html=html.slice(0,-1);	
								
						    html="<a href='javascript:;' onclick=\"setPosition(this,'"+value+"',"+id+")\">"+html+"</a>";
						    return html;

                    }			  
			   },
			   {
				   text:'分类',
				   width:'12%',
				   align:'center',
				   border:0,
				   dataIndex:'kindid',
                   menuDisabled:true,
				   sortable:false,
				   renderer : function(value, metadata,record) {
					       var id=record.get('id');
						   var html="<select onchange=\"updateField(this,"+id+",'kindid',0,'select')\" class='row-edit-select'>";
                               html+="<option value='0'>请选择</option>";
						   Ext.Array.each(kindlist,function(row,index){     
								 var is_selected=value==row.id?"selected='selected'":'';
							     html+="<option value='"+row.id+"' "+is_selected+">"+row.kindname+"</option>";
							   });
						   html+="</select>";
						   return html;	   
                    }

				  
			   },
			   {
				   text:'更新时间',
				   width:'10%',
				   align:'center',
                   menuDisabled:true,
				   border:0,
				   dataIndex:'modtime',
                   cls:'sort-col',
				  renderer : function(value, metadata,record) {
					    return value;

                    }

				  
			   },
			   {
				   text:'管理',
				   width:'9%',
				   align:'center',
				   border:0,
                   menuDisabled:true,
				   sortable:false,
				  renderer : function(value, metadata,record) {
					     var id=record.get('id'); 
						 return "<a href='javascript:void(0);' title='编辑'  class='row-mod-btn' onclick=\"goModify('"+id+"')\"></a>";
						 	
                                   // return getExpandableImage(value, metadata,record);
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

          window.product_grid.doLayout();
	  
	   
	 }) 


 
  
  //更新某个字段
  function updateField(ele,id,field,value,type)
  {
	  var record=window.product_store.getById(id.toString());
	  if(type=='select'||type=='input')
	  {
		  value=Ext.get(ele).getValue();
	  }
	  var view_el=window.product_grid.getView().getEl();
	
	 
	  Ext.Ajax.request({
						 url   :  "list/action/update",
						 method  :  "POST",
						 datatype  :  "JSON",
						 params:{id:id,field:field,val:value,kindid:window.product_kindid},
						 success  :  function(response, opts) 
						 {
							 if(response.responseText=='ok')
							 {
							 
							   record.set(field,value);
							   record.commit(); 
						      
							 }
						 }});
  }
  

  //设置帮助的显示位置
  function setPosition(dom,types,id)
  {
	  Ext.create('Ext.window.Window',
	           { 
			     title:'设置显示位置',
				 border:1,
				 style: {
                     borderStyle: 'solid',
					 borderWidth:'1px'
                  },
				 bodyStyle:'padding:10px', 
				 ghost:false,
				 autoShow:true,
				 listeners:{
					  boxready:function(win)
					  {

						  var html="<div>";
						  var  choosed=types.split(',');
						  Ext.Object.each(typearr, function(key, value, myself)
						  {
							   var tid=key.slice(4);
							   
							   var is_checked='';
							   if(Ext.Array.contains(choosed,tid))
							       is_checked="checked='checked'" 
							   
							   html+="<span style='margin-left:10px'><input onclick=\"choosePos(this,"+id+","+tid+")\" type='checkbox' "+is_checked+" value='"+tid+"' style='vertical-align:middle'/>"+value+"</span>"
						  });
						  html+="</div>";
						  win.update(html);
					  }
					 
					 }
			   });
	  
	  
  }
  //选择位置
  function choosePos(dom,id,typeid)
  {
	  var pdom=Ext.get(dom).up('div');
	  
	  var choosed=pdom.select('input:checked');
	  var typelist='';
	  choosed.each(function(el){
		      typelist+=el.getValue()+',';
		  })
	   typelist=typelist.slice(0,-1);
	   
	  updateField(0,id,'type_id',typelist); 	  
	  
  }
   //设置帮助的显示位置
   function setPosition(dom,types,id)
   {
       ST.Util.showBox('设置显示位置',SITEURL+'friendlink/dialog_setpos?id='+id+'&types='+types,400,'',null,null,document,{loadWindow:window,loadCallback:savePos});
   }
   function savePos(result,bool)
   {
       //  alert(result.typestr);
       updateField(0,result.id,'type_id',result.typestr,0);

   }
  
  //修改
  function goModify(id)
  {
	 
	  ST.Util.addTab("修改帮助",'help/edit/parentkey/article/itemid/6/helpid/'+id);
  }
  
</script>

</body>
</html>
