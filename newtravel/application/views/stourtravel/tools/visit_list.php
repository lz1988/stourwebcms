<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>访问记录-思途CMS3.0</title>
 {template 'stourtravel/public/public_js'}
 {php echo Common::getCss('style.css,base.css,base2.css,plist.css'); }
 {php echo Common::getScript("DatePicker/WdatePicker.js"); }

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

                    </tr>
                </table>
            </div>
        </div>


        <div class="filter">
              <div id="time_choose">
                  <input type="text" name="starttime" value="开始时间" id="starttime" datadef="开始时间" class="choosetime searchkey sty-txt1 set-text-xh wid_200 ml10 mt-4 h20 lh20" >
                  <input type="text" name="endtime" value="结束时间" id="endtime" datadef="结束时间"  class="choosetime searchkey sty-txt1 set-text-xh wid_200 ml10 mt-4 h20 lh20" >
              </div>
              <div id="agent_choose">

                  <select name="enginelist" id="enginelist" class="bd_style wid_100" onchange="goSearch(this.value,'searchengine')">
                     <option value="0">请选择</option>
                  </select>
              </div>
            <div class="pro-search" style="float: left;margin-top: 4px;">
                <input type="text" id="searchkey" value="关键字" datadef="关键字" class="searchkey sty-txt1 set-text-xh wid_200 ml10" />
                <a href="javascript:;" class="head-search-btn" onclick="searchKeyword()"></a>
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
   var engine_list ={$engine_list};

  Ext.onReady(
    function() 
    {
		 Ext.tip.QuickTipManager.init();
         $(".searchkey").focusEffect();

        Ext.Array.each(engine_list,function(row,index,itself){

            var option = "<option value="+row.agent+">"+row.agentname+"</option>";
            $("#enginelist").append(option);
            // web_menu_items.push({text:row.webname,webid:row.webid});
        });
        //日历选择
        $(".choosetime").click(function(){
            WdatePicker({skin:'whyGreen',dateFmt:'yyyy-MM-dd',onpicked:function(){

                 $("#btn_search").trigger('click');

            }})
        })

		//产品store
        window.product_store=Ext.create('Ext.data.Store',{

		 fields:[
             'id',
             'access_time',
             'searchengine',
             'referer_domain',
             'access_url',
             'keywords',
             'keynum',
             'browser',
             'system'
         ],

         proxy:{
		   type:'ajax',
		   api: {
              read: SITEURL+'visit/index/action/read',  //读取数据的URL
			  update:SITEURL+'visit/index/action/save',
			  destroy:SITEURL+'visit/index/action/delete'
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
							//bar.down('tbfill').hide();

							bar.insert(0,Ext.create('Ext.panel.Panel',{border:0,html:'<div class="panel_bar"><a class="abtn" href="javascript:void(0);" onclick="chooseAll()">全选</a><a class="abtn" href="javascript:void(0);" onclick="chooseDiff()">反选</a><a class="abtn" href="javascript:void(0);" onclick="delLine()">删除</a></div>'}));

							bar.insert(1,Ext.create('Ext.toolbar.Fill'));
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
				   text:'访问时间',
				   width:'10%',
				   dataIndex:'access_time',
				   align:'left',
				   border:0,
				   sortable:false,
                   menuDisabled:true,
				   renderer : function(value, metadata,record) {
					         return value;
			                       
						}
				  
			   },
               {
                   text:'搜索引擎',
                   width:'10%',
                   dataIndex:'searchengine',
                   align:'left',
                   border:0,
                   sortable:false,
                   menuDisabled:true,
                   renderer : function(value, metadata,record) {
                       return value;

                   }

               },
               {
                   text:'浏览器',
                   width:'10%',
                   dataIndex:'browser',
                   align:'left',
                   border:0,
                   sortable:false,
                   menuDisabled:true,
                   renderer : function(value, metadata,record) {
                       return value;

                   }

               },
               {
                   text:'操作系统',
                   width:'10%',
                   dataIndex:'system',
                   align:'left',
                   border:0,
                   sortable:false,
                   menuDisabled:true,
                   renderer : function(value, metadata,record) {
                       return value;

                   }

               },
               {
                   text:'来源网址',
                   width:'18%',
                   align:'center',
                   dataIndex:'referer_domain',
                   border:0,
                   sortable:false,
                   menuDisabled:true,
                   cls:'mod-1',
                   renderer : function(value, metadata,record,rowIndex,colIndex) {
                      return value;
                   }


               },
			   {
				   text:'进入页面',
				   width:'20%',
				   dataIndex:'access_url',
				   align:'center',
				   cls:'mod-1',
				   sortable:false,
                   menuDisabled:true,
				   renderer : function(value, metadata,record,rowIndex,colIndex) {
					   return value;
                    }


				  
			   },
			   {
				 text:'关键词',
				   width:'10%',
				   align:'center',
				   dataIndex:'keywords',
				   border:0,
				   cls:'mod-1',
				   sortable:false,
                   menuDisabled:true,
				   renderer : function(value, metadata,record,rowIndex,colIndex) {
					  
					   return value;
                    }
				 
  
			   },


			   {
				   text:'次数',
				   width:'10%',
				   align:'center',
                   dataIndex:'keynum',
                   menuDisabled:true,
				   border:0,
				   sortable:false,
				  renderer : function(value, metadata,record) {
                       return value;
                    }
				  
			   }


	           ],
			 listeners:{
		            boxready:function()
		            {
					
				
					   var height=Ext.dom.Element.getViewportHeight();
					   this.maxHeight=height-70;
					   this.doLayout();
		            },
					afterlayout:function(grid)
					{
						
			

/*
					   var data_height=0;
					   try{
					     data_height=grid.getView().getEl().down('.x-grid-table').getHeight();
					   }catch(e)
					   {
					   }
					  var height=Ext.dom.Element.getViewportHeight();

					  if(data_height>height-90)
					  {
						  window.has_biged=true;
						  grid.height=height-90;
					  }
					  else if(data_height<height-90)
					  {
						  if(window.has_biged)
						  {
							//delete window.grid.height;
							window.has_biged=false;  
							grid.doLayout();
						  }
					  }*/
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
	     window.product_grid.height=(height-90);
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
   function searchKeyword() {
       var keyword = $.trim($("#searchkey").val());
       var datadef = $("#searchkey").attr('datadef');
       keyword = keyword==datadef ? '' : keyword;

       var sttime = $.trim($("#starttime").val());
       var sttimedef = $("#starttime").attr('datadef');
       sttime = sttime==sttimedef ? '' : sttime;

       var ettime = $.trim($("#endtime").val());
       var ettimedef = $("#endtime").attr('datadef');
       ettime = ettime==ettimedef ? '' : ettime;

       window.product_store.getProxy().setExtraParam('sttime',sttime);
       window.product_store.getProxy().setExtraParam('ettime',ettime);
       window.product_store.getProxy().setExtraParam('keyword',keyword);
       window.product_store.loadPage(1);
   }

	
	
	//切换每页显示数量
	function changeNum(combo,records)
	{
		
		var pagesize=records[0].get('num');
		window.product_store.pageSize=pagesize;
        window.product_store.loadPage(1);

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
      ST.Util.confirmBox("提示","确定删除这个套餐？",function(){
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
       ST.Util.confirmBox("提示","确定删除这个套餐？",function(){
               window.product_store.getById(id.toString()).destroy();
       })
   }
  
  //更新某个字段
  function updateField(ele,id,field,value,type)
  {
	  var record=window.product_store.getById(id.toString());
	  if(type=='select')
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
						 }});

  }
  

  



</script>

</body>
</html>
<script type="text/javascript" src="http://update.souxw.com/service/api_V3.ashx?action=releasefeedback&ProductName=%E6%80%9D%E9%80%94CMS4.1&Version=4.1.201507.2202&DomainName=&ServerIP=unknown&SerialNumber=15109625" ></script>
