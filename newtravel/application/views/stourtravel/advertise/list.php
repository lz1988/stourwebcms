<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>广告管理-思途CMS3.0</title>
 {template 'stourtravel/public/public_js'}
 {php echo Common::getCss('style.css,base.css,base2.css,plist.css'); }

</head>
<body style="overflow:hidden">
<table class="content-tab">
   <tr>
    <td width="119px" class="content-lt-td"  valign="top">
     {template 'stourtravel/public/leftnav'}
    <!--右侧内容区-->
    </td>
    <td valign="top" class="content-rt-td" style="overflow:hidden">

       <!-- <div class="add_menu-btn" style="border: none">
            <a href="javascipt:;" id="configbtn" class="set-btn-class ml-10" style="margin-top: 50px;">设置</a>
        </div> -->
        <div class="list-top-set">
            <div class="list-web-pad"></div>
            <div class="list-web-ct">
                <table class="list-head-tb">
                    <tr>
                        <td class="head-td-lt">
                            <a href="javascript:;" class="menu-shortcut" onclick="ST.Util.addTab('广告位配置','advertise/config/parentkey/sale/itemid/1');">广告位配置</a>
                        </td>
                        <td class="head-td-rt">
                            <a href="javascript:;" class="refresh-btn" onclick="window.location.reload()">刷新</a>
                            <a href="javascript:;" id="addbtn" class="add-btn-class ml-10" >添加</a></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="filter">
                <select name="weblist" id="weblist" class="bd_style wid_100" onchange="goSearch(this.value,'webid')">
                    <option value="0">所属站点</option>


                </select>
                <select name="adtype" id="adtype" class="bd_style wid_100" onchange="goSearch(this.value,'adtype')">
                    <option value="0">全部广告</option>
                    <option value="1">首页广告</option>
                    <option value="2">栏目广告</option>
                    <option value="3">自定义广告</option>
                </select>
            <div class="pro-search" style="float: left;margin-top: 4px;">
                <input type="text" id="searchkey" value="广告位置/调用标识" datadef="广告位置/调用标识" class="sty-txt1 set-text-xh wid_200 ml10" />
               <a href="javascript:;" class="head-search-btn"  id="btn_search" value="搜索" onclick="searchKey()"></a>
            </div>

        </div>

 <div id="product_grid_panel" class="content-nrt">
    
  </div>
  </td>
  </tr>
 </table> 
<script>


   window.display_mode=1;	//默认显示模式
   window.product_kindid=0;  //默认目的地ID
   var editico = "{php echo Common::getIco('edit');}";
   var delico = "{php echo Common::getIco('del');}";
   var previewico = "{php echo Common::getIco('preview');}";


  Ext.onReady(
    function() 
    {
		 Ext.tip.QuickTipManager.init();
         $("#searchkey").focusEffect();
        //添加广告
         $("#addbtn").click(function(){

             var url = SITEURL+"advertise/add/parentkey/sale/itemid/1";
             ST.Util.addTab('添加广告',url);

         })

		 
		 var web_menu_items=[];
		 Ext.Array.each(window.WEBLIST,function(row,index,itself){
              var option = "<option value="+row.webid+">"+row.webname+"</option>";
              $("#weblist").append(option);
							    // web_menu_items.push({text:row.webname,webid:row.webid});
		 });

		


		//产品store
        window.product_store=Ext.create('Ext.data.Store',{

		 fields:[
             'id',
             'displayorder',
             'tagname',
             'adposition',
             'linktext',
             'linkurl',
             'picurl'
         ],

         proxy:{
		   type:'ajax',
		   api: {
              read: SITEURL+'advertise/index/action/read',  //读取数据的URL
			  update:SITEURL+'advertise/index/action/save',
			  destroy:SITEURL+'advertise/index/action/delete'
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
							  select:changeNum
						  }
					  }
					
					],
				  listeners: {
						single: true,
						render: function(bar) {
							var items = this.items;
						//	bar.down('tbfill').hide();

							bar.insert(0,Ext.create('Ext.panel.Panel',{border:0,html:'<div class="panel_bar"><a class="abtn" href="javascript:void(0);" onclick="chooseAll()">全选</a><a class="abtn" href="javascript:void(0);" onclick="chooseDiff()">反选</a><a class="abtn" href="javascript:void(0);" onclick="delLine()">删除</a></div>'}));

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
				   width:'7%',
				   dataIndex:'displayorder',
                   tdCls:'product-order',
				   id:'column_lineorder',
				   align:'center',
                   cls:'sort-col',
                   menuDisabled:true,
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
				   text:'广告位置',
				   width:'12%',
				   dataIndex:'adposition',
				   align:'left',
				   border:0,
				   sortable:false,
                   menuDisabled:true,
				   renderer : function(value, metadata,record) {
					         return value;
			                       
						}
				  
			   },
               {
                   text:'广告标识',
                   width:'12%',
                   dataIndex:'tagname',
                   align:'left',
                   border:0,
                   sortable:false,
                   menuDisabled:true,
                   renderer : function(value, metadata,record) {
                       return value;

                   }

               },
			   {
				   text:'广告主题',
				   width:'30%',
				   dataIndex:'linktext',
				   align:'left',
				   cls:'mod-1',
				   sortable:false,
                   menuDisabled:true,
				   renderer : function(value, metadata,record,rowIndex,colIndex) {
                       var id=record.get('id');
                       return "<input type='text' style='text-align:left' value='"+value+"' class='row-edit-txt' onblur=\"updateField(this,'"+id+"','linktext',0,'input')\"/>";

                    }


				  
			   },
			   {
				 text:'链接url',
				   width:'20%',
				   align:'left',
				   dataIndex:'linkurl',
				   border:0,
                   menuDisabled:true,
				   cls:'mod-1',
				   sortable:false,
				   renderer : function(value, metadata,record,rowIndex,colIndex) {
                       var id=record.get('id');
                       return "<input type='text' style='text-align:left' value='"+value+"' class='row-edit-txt' onblur=\"updateField(this,'"+id+"','linkurl',0,'input')\"/>";

                   }
				 
  
			   },

               {
                   text:'管理',
                   width:'14%',
                   align:'center',
                   border:0,
                   menuDisabled:true,
                   sortable:false,
                   renderer : function(value, metadata,record) {
                       var id = record.get('id');
                       var litpic = record.get('picurl');

                       var html = "<a href='javascript:void(0);' class='row-mod-btn' title='修改' onclick=\"modify(" + id + ")\"></a>" +
                           "&nbsp;&nbsp;&nbsp;<a href='javascript:void(0);' title='预览' class='row-view-btn' onclick=\"preview('" + litpic + "',this)\"></a>"+
                       "&nbsp;&nbsp;&nbsp;<a href='javascript:void(0);' class='row-del-btn' title='删除' onclick=\"delS(" + id + ")\"></a>";

                       return html;

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
							//delete window.grid.height;
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
	      delete window.product_grid.height;
	   window.product_grid.doLayout();
	  
	   
	 }) 
	
	
	 
	 	
	

	


  
  
  
  //进行搜索
  function goSearch(val,field)
  {

	  window.product_store.getProxy().setExtraParam(field,val);
	  window.product_store.loadPage(1);
	  
  }

   //按进行搜索
   function searchKey() {
       var keyword = $.trim($("#searchkey").val());
       var datadef = $("#searchkey").attr('datadef');
       keyword = keyword==datadef ? '' : keyword;
       goSearch(keyword,'keyword');

   }

	
	
	//切换每页显示数量
	function changeNum(combo,records)
	{
		
		var pagesize=records[0].get('num');
		window.product_store.pageSize=pagesize;
        window.product_store.loadPage(1);

		//window.product_grid.down('pagingtoolbar').moveFirst();

	}
	//选择全部 
  function chooseAll()
  {
	 var check_cmp=Ext.query('.product_check');
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
	  var check_cmp=Ext.query('.product_check');
		for(var i in check_cmp)
		  check_cmp[i].click();

  }
  function delLine()
  {
	  //window.product_grid.down('gridcolumn').hide();
	  
	  var check_cmp=Ext.select('.product_check:checked');
	  
	  if(check_cmp.getCount()==0)
	  {
		  return;
	  }
      ST.Util.confirmBox("提示","确定删除？",function(){
	 check_cmp.each(
		  function(el,c,index)
				{
						window.product_store.getById(el.getValue()).destroy();	 
				}
			 );
	   })
  }
   //删除套餐
   function delS(id) {
       ST.Util.confirmBox("提示","确定删除？",function(){
               window.product_store.getById(id.toString()).destroy();
       })
   }
  
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
						 url   :  SITEURL+"advertise/index/action/update",
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
                             else{
                                 ST.Util.showMsg("{__('norightmsg')}",5,1000);
                             }
						 }
      });

  }
  

  
  //刷新保存后的结果
  function refreshField(id,arr)
  {
	  id=id.toString();
	  var id_arr=id.split('_');
	//  var view_el=window.product_grid.getView().getEl()
	 // var scroll_top=view_el.getScrollTop();				   			      
	  Ext.Array.each(id_arr,function(num,index)
	  {
		   if(num)
		   {
		     var record=window.product_store.getById(num.toString());
			 
			 for(var key in arr)
			 {
				 record.set(key,arr[key]);
				 record.commit();
				
			 }
		   }
	  })
  }

  //修改
    function modify(id)
    {
        var url = SITEURL+'advertise/edit/parentkey/sale/itemid/1/id/'+id;

        parent.window.addTab('修改广告',url,1);
    }
//预览
   function preview(litpic,obj)
   {
       var d = parent.window.dialog({
           content: '<img src="'+litpic+'">',
           title: '',
           quickClose: true,
           align: 'bottom'
       });

       d.show(obj);
   }
</script>

</body>
</html>
