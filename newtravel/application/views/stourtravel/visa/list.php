<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>思途CMS3.0</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css,base2.css,plist.css'); }
    {php echo Common::getCss('ext-theme-neptune-all-debug.css','js/extjs/resources/ext-theme-neptune/'); }

    {php echo Common::getScript("uploadify/jquery.uploadify.min.js,jquery.buttonbox.js,choose.js"); }
    {php echo Common::getCss('uploadify.css','js/uploadify/'); }
</head>
<body style="overflow:hidden">
<table class="content-tab">
    <tr>
        <td width="119px" class="content-lt-td" valign="top">
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
                    <span class="change-btn-xz btnbox" id="visatype" data-url="box/index/type/visatype" data-result="result_visatype" >签证类型&nbsp;&gt;&nbsp;<span id="result_visatype">全部</span></span>
                </div>
                <div class="change-btn-list mt-4 ml-10">
                    <span class="change-btn-xz btnbox" id="visacity" data-url="box/index/type/visacity" data-result="result_visacity" >签发城市&nbsp;&gt;&nbsp;<span id="result_visacity">全部</span></span>
                </div>

                <div class="pro-search ml-10" style=" float:left; margin-top:4px">
                    <input type="text" id="searchkey" value="签证名称/签证编号" datadef="签证名称/签证编号" class="sty-txt1 set-text-xh wid_200">
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

window.display_mode = 1;	//默认显示模式
window.product_kindid = 0;  //默认目的地ID
window.kindmenu = {$kindmenu};//分类设置菜单


Ext.onReady(
    function () {
        Ext.tip.QuickTipManager.init();
        $(".btnbox").buttonBox();

        $("#searchkey").focusEffect();
        //添加按钮
        $("#addbtn").click(function(){

            ST.Util.addTab('添加签证','{$cmsurl}visa/add/parentkey/product/itemid/5',0);
        });

        //产品store
        window.product_store = Ext.create('Ext.data.Store', {
            fields: [
                'id',
                'aid',
                'series',
                'title',
                'ishidden',
                'displayorder',
                'iconlist',
                'iconname',
                'themelist',
                'visakind',
                'visacity',
                'price',
                'jifenbook',
                'jifentprice',
                'jifencomment',
                'suppliername',
                'linkman',
                'mobile',
                'qq',
                'address'
            ],

            proxy: {
                type: 'ajax',
                api: {
                    read: SITEURL+'visa/visa/action/read',  //读取数据的URL
                    update: SITEURL+'visa/visa/action/save',
                    destroy: SITEURL+'visa/visa/action/delete'
                },
                reader: {
                    type: 'json',   //获取数据的格式
                    root: 'lists',
                    totalProperty: 'total'
                }
            },

            remoteSort: true,
            pageSize: 30,
            autoLoad: true,
            listeners: {
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
        window.product_grid = Ext.create('Ext.grid.Panel', {
            store: product_store,
            renderTo: 'product_grid_panel',
            border: 0,
            width: "100%",
            bodyBorder: 0,
            bodyStyle: 'border-width:0px',
            scroll:'vertical', //只要垂直滚动条
                bbar: Ext.create('Ext.toolbar.Toolbar', {
                store: product_store,  //这个和grid用的store一样
                displayInfo: true,
                emptyMsg: "",
                items: [
                    {
                        xtype:'panel',
                        id:'listPagePanel',
                        html:'<div id="line_page"></div>'
                    },
                    {
                        xtype: 'combo',
                        fieldLabel: '每页显示数量',
                        width: 170,
                        labelAlign: 'right',
                        forceSelection: true,
                        value: 30,
                        store: {fields: ['num'], data: [
                            {num: 30},
                            {num: 60},
                            {num: 100}
                        ]},
                        displayField: 'num',
                        valueField: 'num',
                        listeners: {
                            select: CHOOSE.changeNum
                        }
                    }
                ],

                listeners: {
                    single: true,
                    render: function (bar) {
                        var items = this.items;
                      //  bar.down('tbfill').hide();

                        bar.insert(0, Ext.create('Ext.panel.Panel', {border: 0, html: '<div class="panel_bar"><a class="abtn" href="javascript:void(0);" onclick="CHOOSE.chooseAll()">全选</a><a class="abtn" href="javascript:void(0);" onclick="CHOOSE.chooseDiff()">反选</a><a class="abtn" href="javascript:void(0);" onclick="CHOOSE.delMore()">删除</a></div>'}));

                        bar.insert(1, Ext.create('Ext.toolbar.Fill'));
                        //items.add(Ext.create('Ext.toolbar.Fill'));
                    }
                }
            }),
            columns: [
                {
                    text: '选择',
                    width: '5%',
                    // xtype:'templatecolumn',
                    tdCls: 'product-ch',
                    align: 'center',
                    dataIndex: 'id',
                    menuDisabled:true,
                    border: 0,
                    renderer: function (value, metadata, record) {

                        return  "<input type='checkbox' class='product_check' style='cursor:pointer' value='" + value + "'/>";

                    }

                },
                {
                    text: '排序',
                    width: '5%',
                    dataIndex: 'displayorder',
                    tdCls: 'product-order',
                    id: 'column_lineorder',
                    menuDisabled:true,
                    align: 'center',
                    cls:'sort-col',
                    border: 0,
                    renderer: function (value, metadata, record) {
                        var id = record.get('id');

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
                    border:0,
                    sortable:false,
                    menuDisabled:true,
                    renderer : function(value, metadata,record) {
                        return '<span style="color:red">'+value+'</span>';
                    }


                },
                {
                    text: '签证名称',
                    width: '19%',
                    dataIndex: 'title',
                    align: 'left',
                    border: 0,
                    sortable: false,
                    menuDisabled:true,
                    renderer: function (value, metadata, record) {
                        var iconname = record.get('iconname');
                        var aid=record.get('aid');
                        return "<a href='/visa/show_"+aid+".html' class='product-title' target='_blank'>"+value+'&nbsp;&nbsp;'+iconname+"</a>";

                    }

                },
                {
                    text: '签证类型',
                    width: '8%',
                    dataIndex: 'visakind',
                    align: 'center',
                    border: 0,
                    sortable: false,
                    menuDisabled:true,
                    renderer: function (value, metadata, record) {

                        return value;
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
                    text: '签发城市',
                    width: '8%',
                    dataIndex: 'visacity',
                    align: 'center',
                    menuDisabled:true,
                    border: 0,
                    sortable: false,
                    renderer: function (value, metadata, record) {
                        return value;
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
                    text: '图标',
                    width: '5%',
                    align: 'center',
                    dataIndex: 'iconlist',
                    menuDisabled:true,
                    border: 0,
                    cls: 'mod-1 sort-col',
                    sortable: true,
                    renderer: function (value, metadata, record, rowIndex, colIndex) {

                        var id = record.get('id');
                        var d_text=value?'<span style="color:green">已设</span>':'<span style="color:red">未设</span>';
                        return "<a href='javascript:void(0);' onclick=\"setOneIcons("+id+")\">" + d_text + "</a>";
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
                    text: '专题',
                    width: '5%',
                    align: 'center',
                    sortable: true,
                    dataIndex: 'themelist',
                    menuDisabled:true,
                    cls: 'mod-1 sort-col',
                    border: 0,
                    renderer: function (value, metadata, record, rowIndex, colIndex) {

                        var id = record.get('id');
                        var d_text=value?'<span style="color:green">已设</span>':'<span style="color:red">未设</span>';
                        return "<a href='javascript:void(0);' onclick=\"setOneThemes("+id+")\">" + d_text + "</a>";
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
                    text: '价格',
                    width: '7%',
                    dataIndex: 'price',
                    align: 'center',
                    menuDisabled:true,
                    border: 0,
                    sortable: false,
                    renderer: function (value, metadata, record) {
                        var id=record.get('id');
                        return  "<input type='text' value='"+value+"' class='row-edit-txt' onblur=\"updateField(this,'"+id+"','price',0,'input')\"/>";
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
                    text: '预订积分',
                    width: '7%',
                    align: 'center',
                    border: 0,
                    sortable: false,
                    menuDisabled:true,
                    dataIndex: 'jifenbook',
                    cls: 'mod-2',
                    renderer: function (value, metadata, record) {
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
                    text: '评论积分',
                    width: '7%',
                    align: 'center',
                    border: 0,
                    sortable: false,
                    menuDisabled:true,
                    dataIndex: 'jifencomment',
                    cls: 'mod-2',
                    renderer: function (value, metadata, record) {
                        var id=record.get('id');
                        value=!value?'':value;
                        return  "<input type='text' value='"+value+"' class='row-edit-txt' onblur=\"updateField(this,'"+id+"','jifencomment',0,'input')\"/>";
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
                    text: '积分抵现',
                    width: '7%',
                    align: 'center',
                    border: 0,
                    sortable: false,
                    menuDisabled:true,

                    dataIndex: 'jifentprice',
                    cls: 'mod-2',
                    renderer: function (value, metadata, record) {
                        var id=record.get('id');
                        value=!value?'':value;
                        return  "<input type='text' value='"+value+"' class='row-edit-txt' onblur=\"updateField(this,'"+id+"','jifentprice',0,'input')\"/>";
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
                    text: '隐藏',
                    width: '5%',
                    // xtype:'templatecolumn',
                    align: 'center',
                    border: 0,
                    dataIndex: 'ishidden',
                    xtype: 'actioncolumn',
                    menuDisabled:true,
                    cls: 'mod-1',
                    items: [
                        {
                            getClass: function (v, meta, rec) {          // Or return a class from a function
                                if (v == 1)
                                    return 'dest-status-ok';
                                else
                                    return 'dest-status-none';
                            },
                            handler: function (view, index, colindex, itm, e, record) {
                                // togStatus(null,record,'ishidden');
                                var val = record.get('ishidden');
                                var id = record.get('id');
                                var newval = val == 1 ? 0 : 1;
                                updateField(null, record.get('id'), 'ishidden', newval)

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
                    text: '管理',
                    width: '8%',
                    align: 'center',
                    border: 0,
                    sortable: false,
                    cls: 'mod-1',
                    menuDisabled:true,
                    renderer: function (value, metadata, record) {

                        var id = record.get('id');
                        return "<a href='javascript:void(0);' class='row-mod-btn' title='修改' onclick=\"goModify(" + id + ")\"></a>";
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
                    width:'20%',
                    align:'left',
                    dataIndex:'suppliername',
                    menuDisabled:true,
                    cls:'mod-3',
                    border:0,
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
                    width:'10%',
                    align:'center',
                    dataIndex:'linkman',
                    menuDisabled:true,
                    cls:'mod-3',
                    border:0,
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
                    text:'联系电话',
                    width:'10%',
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
                    width:'10%',
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
                    width:'17%',
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
            listeners: {
                boxready: function () {


                    var height = Ext.dom.Element.getViewportHeight();
                    this.maxHeight = height ;
                    this.doLayout();
                },
                afterlayout: function (grid) {


                    if (window.product_kindname) {
                        Ext.getCmp('column_lineorder').setText(window.product_kindname + '-排序')
                    }
                    else {
                        Ext.getCmp('column_lineorder').setText('排序')
                    }

                    window.product_store.each(function (record) {
                        id = record.get('id');

                        if (id.indexOf('suit') != -1) {

                            var ele = window.product_grid.getView().getNode(record);
                            var cls = record.get('tr_class');
                            Ext.get(ele).addCls(cls);
                            Ext.get(ele).setVisibilityMode(Ext.Element.DISPLAY);
                            if (window.display_mode != 2) {
                                Ext.get(ele).hide();
                            }
                            else {
                                Ext.get(ele).show();
                            }

                        }
                        else if (window.display_mode == 2) {
                            var ele = window.product_grid.getView().getNode(record);
                            var cls = record.get('tr_class');
                            Ext.get(ele).addCls(cls);
                        }

                    });

                    var data_height = 0;
                    try {
                        data_height = grid.getView().getEl().down('.x-grid-table').getHeight();
                    } catch (e) {
                    }
                    var height = Ext.dom.Element.getViewportHeight();
                    // console.log(data_height+'---'+height);
                    if (data_height > height - 106) {
                        window.has_biged = true;
                        grid.height = height - 106;
                    }
                    else if (data_height < height - 106) {
                        if (window.has_biged) {
                           // delete window.grid.height;
                            window.has_biged = false;
                            grid.doLayout();
                        }
                    }
                }
            },
            plugins: [
                Ext.create('Ext.grid.plugin.CellEditing', {
                    clicksToEdit: 2,
                    listeners: {
                        edit: function (editor, e) {
                            var id = e.record.get('id');
                            //  var view_el=window.product_grid.getView().getEl();
                            //  view_el.scrollBy(0,this.scroll_top,false);
                            updateField(0, id, e.field, e.value, 0);
                            return false;

                        }

                    }
                })
            ],
            viewConfig: {

            }
        });


    })

//实现动态窗口大小
Ext.EventManager.onWindowResize(function () {
    var height = Ext.dom.Element.getViewportHeight();
    var data_height = window.product_grid.getView().getEl().down('.x-grid-table').getHeight();
    if (data_height > height - 120)
        window.product_grid.height = (height - 120);

    window.product_grid.doLayout();


})




//更新某个字段
function updateField(ele, id, field, value, type) {
    var record = window.product_store.getById(id.toString());
    if (type == 'select'|| type =='input') {
        value = Ext.get(ele).getValue();
    }
    var view_el = window.product_grid.getView().getEl();


    Ext.Ajax.request({
        url: SITEURL+"visa/visa/action/update",
        method: "POST",
        datatype: "JSON",
        params: {id: id, field: field, val: value, kindid: 0},
        success: function (response, opts) {
            if (response.responseText == 'ok') {


                record.set(field, value);
                record.commit();
                // view_el.scrollBy(0,scroll_top,false);
            }
        }});

}


//删除套餐
function del(id) {
    Ext.Msg.confirm("提示", "确定删除吗？", function (buttonId) {
        if (buttonId == 'yes')
            window.product_store.getById(id).destroy();
    })
}




//修改
function goModify(id)
{
    var url = SITEURL+'visa/edit/parentkey/product/itemid/5/id/'+id;

    parent.window.addTab('修改签证',url,0);
}

//设置多个线路的目的地
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
           // var id=record.get('id');
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
         //   var id=record.get('id');
          ///  $("#box_"+id).attr("checked",true);
        });
    });
}

function setOneIcons(id)
{
    CHOOSE.setSome("设置图标",{loadCallback:setIcons},SITEURL+'icon/dialog_seticon?typeid=8&id='+id,true);
}
function setOneThemes(id)
{
    CHOOSE.setSome("设置专题",{loadCallback:setThemes},SITEURL+'theme/dialog_settheme?typeid=8&id='+id,true);
}

</script>

</body>
</html>
