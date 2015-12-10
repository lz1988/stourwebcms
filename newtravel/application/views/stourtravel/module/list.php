<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>模块列表-思途CMS3.0</title>
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

        <div class="search-bar filter" id="search_bar">
            <div class="change-btn-list mt-4 ml-10">
                <span class="change-btn-xz btnbox" id="website" data-url="box/index/type/weblist" data-result="result_webid">站点切换&nbsp;&gt;&nbsp;<span id="result_webid">全部</span></span>

            </div>



            <div class="pro-search ml-10" style=" float:left; margin-top:4px">
                <input type="text" id="searchkey" value="模块名称" datadef="模块名称" class="sty-txt1 set-text-xh wid_200">
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
 <input type="hidden" name="webid" id="webid" value="0"/>
<script>


  Ext.onReady(
    function() 
    {
		 Ext.tip.QuickTipManager.init();
        //添加按钮
        $("#addbtn").click(function(){

            addModule();
        });

        $(".btnbox").buttonBox();
        $("#searchkey").focusEffect();
		 


		
		//模块store
        window.product_store=Ext.create('Ext.data.Store',{

		 fields:['id','aid','webid','modulename','issystem'],

         proxy:{
		   type:'ajax',
		   api: {
              read: SITEURL+'module/store/action/read',  //读取数据的URL
			  update:SITEURL+'module/store/action/save',
			  destroy:SITEURL+'module/store/action/delete'
              },
		      reader:{
                type: 'json',   //获取数据的格式 
                root: 'lists',
                totalProperty: 'total'
                }	
	         },

		 remoteSort:true,	 
		 pageSize:30,	 	
         autoLoad:true

		  
       });
	   
	  //产品列表 
	  window.product_grid=Ext.create('Ext.grid.Panel',{ 
	   store:product_store,
	   renderTo:'product_grid_panel',
	   border:0,
	   bodyBorder:0,
	   bodyStyle:'border-width:0px',
	   scroll:'vertical',
	   bbar: Ext.create('Ext.toolbar.Paging', {
                    store: product_store,  //这个和grid用的store一样
                    displayInfo: true,
                    emptyMsg: "",
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
							  select:CHOOSE.changeNum
						  }
					  }
					
					],
                   listeners: {
                       single: true,
                       render: function(bar) {
                           var items = this.items;
                           bar.down('tbfill').hide();

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
                   id=record.get('id');
                   if(id.indexOf('suit')==-1)
                       return  "<input type='checkbox' class='product_check' style='cursor:pointer' value='"+value+"'/>";

               }

           },

			   {
				   text:'模块名称',
				   width:'70%',
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
				   text:'管理',
				   width:'26%',
				   align:'center',
				   border:0,
				   sortable:false,
                    menuDisabled:true,
				   cls:'mod-2',
				   renderer : function(value, metadata,record) {
					     var id=record.get('id');
                         var issystem = record.get('issystem');//是否系统模块
                         var html="<a href='javascript:void(0);' class='row-mod-btn' onclick=\"modify("+id+")\"></a>";
                             html+="&nbsp;&nbsp;&nbsp;<a href='javascript:void(0);' class='row-del-btn' onclick=\"del("+id+","+issystem+")\"></a>";
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
    function addModule()
    {

        var webid = $("#webid").val();
        var boxurl = SITEURL+'module/add/webid/'+webid;
        ST.Util.showBox('添加模块',boxurl,600,500,function(){ window.product_store.load(); });
    }
   //修改
   function modify(id)
   {
       var boxurl = SITEURL+'module/edit/id/'+id;
       ST.Util.showBox('模块修改',boxurl,600,500,function(){ window.product_store.load(); });
   }
 

</script>

</body>
</html>
