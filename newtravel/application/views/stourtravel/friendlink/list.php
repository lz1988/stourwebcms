<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>文章管理-思途CMS3.0</title>
 {template 'stourtravel/public/public_js'}
 {php echo Common::getCss('style.css,base.css,base2.css,plist.css'); }
 {php echo Common::getScript("jquery.buttonbox.js,choose.js"); }
<style>
  .yqlj-set-tab tr{
	   height:30px;
	   line-height:30px; 
	  }
  
</style>

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
                <input type="text" id="searchkey" value="站点名称" datadef="站点名称" class="sty-txt1 set-text-xh wid_200">
                <a href="javascript:;" class="head-search-btn" onclick="CHOOSE.searchKeyword()"></a>
            </div>
        </div>
 <div id="product_grid_panel" class="content-nrt">
    
  </div>
  </td>
  </tr>
 </table> 
 
<script>

   var typearr={json_encode($posArr)};//{type0:'首页',type1:'线路',type2:'酒店',type3:'租车',type5:'景点',type6:'相册',type4:'攻略',type8:'签证',type13:'团购',type12:'目的地'};
  Ext.onReady(
    function() 
    {

		 Ext.tip.QuickTipManager.init();
         $(".btnbox").buttonBox();

         $("#searchkey").focusEffect();
         //添加按钮
         $("#addbtn").click(function(){
             ST.Util.showBox('添加友情链接',SITEURL+'friendlink/dialog_addlink',400,'',null,null,document,{loadWindow:window,loadCallback:addLink});


        });


	
		//产品store
        window.product_store=Ext.create('Ext.data.Store',{

		 fields:['id','webid','sitename','siteurl','addtime','address','displayorder'],	

         proxy:{
		   type:'ajax',
		   api: {
			  create :SITEURL+'friendlink/list/action/create',
              read: SITEURL+'friendlink/list/action/read',  //读取数据的URL
			  update:SITEURL+'friendlink/list/action/save',
			  destroy:SITEURL+'friendlink/list/action/delete'
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
				   width:'5%',
				  // xtype:'templatecolumn',
				   tdCls:'product-ch',
				   align:'center',
				   dataIndex:'id',
				   border:0,
				   renderer : function(value, metadata,record) {
					    id=record.get('id');
					    if(id.indexOf('suit')==-1)
					    return  "<input type='checkbox' class='product_check' style='cursor:pointer' value='"+value+"'/>"; 
					 
					}
				  
			   },
			   {
				   text:'排序',
				   width:'8%',
				   dataIndex:'displayorder',
                   tdCls:'product-order',
				   id:'column_lineorder',
				   align:'center',
				   border:0,
				   renderer : function(value, metadata,record) {
					              var id=record.get('id');
                           var newvalue=value;
                           if(value==9999||value==999999||!value)
                               newvalue='';
                           return "<input type='text' value='"+newvalue+"' class='row-edit-txt' onblur=\"updateField(this,'"+id+"','displayorder',0,'input')\" />";
					 
					}

				  
			   },
			   {
				   text:'站点名称',
				   width:'21%',
				   dataIndex:'sitename',
				   align:'left',
				   border:0,
				   sortable:false,
				   renderer : function(value, metadata,record) {
                           var id=record.get('id');
					       return "<input type='text' class='row-edit-txt' onblur=\"updateField(this,"+id+",'sitename',0,'input')\" style='text-align:left;' value='"+value+"'/>";
						}
				  
			   },
			    {
				   text:'地址',
				   width:'28%',
				   align:'center',
				   border:0,
				   dataIndex:'siteurl',
				   sortable:false,
				   renderer : function(value, metadata,record) {

                       var id=record.get('id');
                       return "<input type='text' class='row-edit-txt' onblur=\"updateField(this,"+id+",'siteurl',0,'input')\" style='text-align:left;' value='"+value+"'/>";
                    }

				  
			   },
			   {
				   text:'显示位置',
				   width:'29%',
				   align:'center',
				   border:0,
				   sortable:false,
				   dataIndex:'address',
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
				   text:'管理',
				   width:'10%',
				   align:'center',
				   border:0,
				   sortable:false,
				   dataIndex:'siteurl',
				   renderer : function(value, metadata,record) {    
						   return "<a href='javascript:;' class='row-view-btn' title='查看' onclick=\"window.open('"+value+"','_blank')\"></a>";
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
	      delete window.product_grid.height;
	   window.product_grid.doLayout();
	  
	   
	 }) 

  //进行搜索
  function goSearch(ele,val,field)
  {
	 
	  if(field=='kindid')
	  {
	     Ext.select('.kind-search-cs a').removeCls('active');
	    Ext.get(ele).addCls('active'); 
	  }
	  window.product_store.getProxy().setExtraParam(field,val);
	  window.product_store.load();
	  
  }
  
    
  function searchDest(ele)
  {
	   var keyword=Ext.get(ele).prev().getValue();
	   keyword=Ext.String.trim(keyword);
	   goSearch(0,keyword,'keyword');
  }
	
	//切换每页显示数量
  function changeNum(combo,records)
  {
		
		var pagesize=records[0].get('num');
		window.product_store.pageSize=pagesize;
		window.product_grid.down('pagingtoolbar').moveFirst();

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
	   Ext.Msg.confirm("提示","确定删除",function(buttonId){
		    if(buttonId!='yes')
		       return;
	 check_cmp.each(
		  function(el,c,index)
				{
						window.product_store.getById(el.getValue()).destroy();	 
				}
			 );
	   })
  }
 
  
  //更新某个字段
  function updateField(ele,id,field,value,type)
  {
	  var record=window.product_store.getById(id.toString());
	  if(type=='select'|| type=='input')
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
                             else{
                                 ST.Util.showMsg("{__('norightmsg')}",5,1000);
                             }
						 }});
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
  
  //设置帮助的显示位置
  function setPosition(dom,types,id)
  {
      ST.Util.showBox('设置显示位置',SITEURL+'friendlink/dialog_setpos?id='+id+'&types='+types,400,'',null,null,document,{loadWindow:window,loadCallback:savePos});
  }
  function savePos(result,bool)
  {
    //  alert(result.typestr);
      updateField(0,result.id,'address',result.typestr,0);

  }
  //选择位置
  function choosePos(dom,id,typeid)
  {
	  var pdom=Ext.get(dom).up('div');

	  if(typeid==-1)
	  {
		  if(Ext.get(dom).is(":checked"))
		     pdom.select('input').set({checked:'checked'},false);
		  else
		    pdom.select('input').set({checked:null},false);	 
	  }
	  
	  var choosed=pdom.select('input:checked');
	  var typelist='';
	  choosed.each(function(el){
		      var v=el.getValue();
			  if(v!=-1)
		      typelist+=v+',';
		  })
	   typelist=typelist.slice(0,-1);
	   updateField(0,id,'address',typelist); 	  
	  
  }
  
  //修改
  function goModify(id,title)
  {
	 
  }
  function addLink(result,bool)
  {
      if(!bool)
        return;
      Ext.Ajax.request({
          url   :  "list/action/create",
          method  :  "POST",
          datatype  :  "JSON",
          params:result.data,
          success  :  function(response, opts)
          {
              var data=Ext.decode(response.responseText);
              if(data.success)
              {
                  ST.Util.showMsg("添加成功",4);
                  window.product_store.load();
                  btn.up('window').close();
              }
              else{
                  ST.Util.showMsg("{__('norightmsg')}",5,1000);
              }
          }});

  }
  
  
  
</script>

</body>
</html>
