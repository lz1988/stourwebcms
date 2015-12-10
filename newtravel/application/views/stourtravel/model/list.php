<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>模型列表-思途CMS3.0</title>
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

                        </td>
                        <td class="head-td-rt">
                            <a href="javascript:;" class="refresh-btn" onclick="window.location.reload()">刷新</a>
                            <a href="javascript:;" id="addbtn" class="add-btn-class ml-10" >添加</a></td>
                    </tr>
                </table>
            </div>
        </div>

 <div id="product_grid_panel" class="content-nrt">

        </div>
  </td>
  </tr>
 </table>
 <input type="hidden" name="webid" id="webid" value="0"/>
<script>


  Ext.onReady(
    function() 
    {
		 Ext.tip.QuickTipManager.init();
        //添加按钮
        $("#addbtn").click(function(){

            addModel();
        });

        $(".btnbox").buttonBox();
        $("#searchkey").focusEffect();

		//模块store
        window.product_store=Ext.create('Ext.data.Store',{

		 fields:['id','modulename','pinyin','maintable','addtable','issystem','isopen'],

         proxy:{
		   type:'ajax',
		   api: {
              read: SITEURL+'model/index/action/read',  //读取数据的URL
			  update:SITEURL+'model/index/action/save',
			  destroy:SITEURL+'model/index/action/delete'
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
         listeners: {
                load: function (store, records, successful, eOpts) {
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
                        //   bar.down('tbfill').hide();

                           bar.insert(0,Ext.create('Ext.panel.Panel',{border:0,html:'<div class="panel_bar"><a class="abtn" href="javascript:void(0);" onclick="CHOOSE.chooseAll()">全选</a><a class="abtn" href="javascript:void(0);" onclick="CHOOSE.chooseDiff()">反选</a><a class="abtn" href="javascript:void(0);" onclick="CHOOSE.delMore()">删除</a></div>'}));
                          /* bar.insert(1,Ext.create('Ext.panel.Panel',{border:0,items:[{
                               xtype:'button',
                               text:'批量设置',
                               menu:[
                                   {text:'目的地',handler:function(){ CHOOSE.setSome(1)}},
                                   {text:'属性',handler:function(){ CHOOSE.setSome(2)}},
                                   {text:'专题',handler:function(){ CHOOSE.setSome(4)}},
                                   {text:'图标',handler:function(){ CHOOSE.setSome(3)}}
                               ]

                           }]}));*/
                           //bar.insert(0,Ext.create('Ext.toolbar.Fill'));
                           bar.insert(1,Ext.create('Ext.toolbar.Fill'));
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
                   var issystem=record.get('issystem');
                   if(issystem!=1){
                       return  "<input type='checkbox' class='product_check' style='cursor:pointer' value='"+value+"'/>";
                   }


               }

           },

			   {
				   text:'模块名称',
				   width:'15%',
				   dataIndex:'modulename',
				   align:'left',
				   border:0,
				   sortable:false,
                   menuDisabled:true,
                   renderer:function(value,metadata,record){
                       var modulename=record.get('modulename');
                       return "<a href='javascript:;' class='line-title'>"+modulename+"</a>";
                   }

				  
			   },
               {
                   text:'拼音标识',
                   width:'15%',
                   dataIndex:'pinyin',
                   align:'left',
                   border:0,
                   sortable:false,
                   menuDisabled:true
               },
               {
                   text:'主表',
                   width:'20%',
                   dataIndex:'maintable',
                   menuDisabled:true,
                   align:'left',
                   border:0,
                   sortable:false,
                   renderer:function(value,metadata,record){
                       var maintable='sline_'+record.get('maintable');
                       return "<a href='javascript:;' class='line-title'>"+maintable+"</a>";
                   }
               },
               {
                   text:'附加表',
                   width:'25%',
                   dataIndex:'addtable',
                   menuDisabled:true,
                   align:'left',
                   border:0,
                   sortable:false,
                   renderer:function(value,metadata,record){
                       var addtable='sline_'+record.get('addtable');
                       return "<a href='javascript:;' class='line-title'>"+addtable+"</a>";
                   }
               },
               {
                   text:'系统模型',
                   width:'10%',
                   align:'center',
                   border:0,
                   dataIndex:'issystem',
                   xtype:'actioncolumn',
                   sortable:false,
                   menuDisabled:true,
                   cls:'mod-1',
                   items:[
                       {
                           getClass: function(v, meta, rec) {          // Or return a class from a function
                               if(v==1)
                                   return 'dest-status-ok';
                               else
                                   return 'dest-status-none';
                           }

                       }]
               },
               {
                   text:'是否启用',
                   width:'12%',
                   align:'center',
                   border:0,
                   dataIndex:'isopen',
                   xtype:'actioncolumn',
                   menuDisabled:true,
                   cls:'mod-1',
                   sortable:false,
                   items:[
                       {
                           getClass: function(v, meta, rec) {          // Or return a class from a function

                               var issys = rec.get('issystem');
                               console.log(issys);
                               if(issys==0){
                                   if(v==1){
                                       return 'dest-status-ok';
                                   }
                                  else{
                                       return 'dest-status-none';
                                  }

                               }

                           },
                           handler:function(view,index,colindex,itm,e,record)
                           {
                               // togStatus(null,record,'ishidden');
                               var val=record.get('isopen');
                               var id=record.get('id');
                               var newval=val==1?0:1;
                               updateField(null,record.get('id'),'isopen',newval)

                           }

                       }]
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
					   try
                       {
					     data_height=grid.getView().getEl().down('.x-grid-table').getHeight();
					   }
                       catch(e)
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
	

	
	
	//切换每页显示数量
	function changeNum(combo,records)
	{
		
		var pagesize=records[0].get('num');
		window.product_store.pageSize=pagesize;
		window.product_grid.down('pagingtoolbar').moveFirst();
		//window.product_store.load({start:0});
	}
      //更新某个字段
      function updateField(ele,id,field,value,type)
      {
          var record=window.product_store.getById(id.toString());


          Ext.Ajax.request({
              url   :  SITEURL+"model/index/action/update",
              method  :  "POST",
              datatype  :  "JSON",
              params:{id:id,field:field,val:value,kindid:window.product_kindid},
              success  :  function(response, opts)
              {
                  if(response.responseText=='ok')
                  {
                      // var view_el=window.product_grid.getView().getEl()
                      //  var scroll_top=view_el.getScrollTop();

                      record.set(field,value);
                      record.commit();
                      // view_el.scrollBy(0,scroll_top,false);
                  }
              }});

      }

  function del(id,issystem)
  {
      if(issystem)
      {
          ST.Util.showMsg('这是系统模块不能删除!',5);
          return false;
      }
      ST.Util.confirmBox('删除模块','确定删除这个模块吗?',function(){
          var boxurl = SITEURL+'module/store/action/delete';
          $.getJSON(boxurl,"id="+id,function(data){

              window.product_store.load();
              /*if(data.status == true){

                  ST.Util.showMsg('删除成功',4);

              }
              else{
                  ST.Util.showMsg('删除失败',5);
              }*/

          });
      })

  }
    //添加
    function addModel()
    {

        var url=SITEURL+"model/add/";
        ST.Util.showBox('添加模型',url,'390','120',function(){window.product_store.load()});
    }
  /* //修改
   function modify(id)
   {
       var boxurl = SITEURL+'module/edit/id/'+id;
       ST.Util.showBox('模块修改',boxurl,600,500,function(){ window.product_store.load(); });
   }*/

 

</script>

</body>
</html>
