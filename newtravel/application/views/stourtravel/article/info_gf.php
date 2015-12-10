<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>实用信息设置</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css,base2.css,plist.css'); }

</head>
<body style="overflow:hidden">
<table class="content-tab">
    <tr>
        <td width="119px" class="content-lt-td" valign="top">
            {template 'stourtravel/public/leftnav'}
            <!--右侧内容区-->
        </td>
        <td valign="top" class="content-rt-td" style="overflow:hidden">
            <div class="crumbs" id="attr_crumbs">
                <label>位置：</label>首页 &gt; 文章 &gt; <span>{$position}</span>
            </div>


            <div></div>

            <div id="line_grid_panel" class="content-nrt" style="margin-top: 40px">


                <div id="attr_tree_panel" class="content-nrt">

                </div>
                <div class="panel_bar">
                    <a class="abtn" href="javascript:;" onClick="chooseAll()">全选</a>
                    <a class="abtn" href="javascript:;" onClick="chooseDiff()">反选</a>
                    <a class="abtn" href="javascript:;" onClick="delattr()">删除</a>
                </div>
        </td>
    </tr>
</table>
<script>


Ext.onReady(
    function () {
        //store
        Ext.tip.QuickTipManager.init();
        window.attr_store = Ext.create('Ext.data.TreeStore', {
            fields: [

                'id',
                'title',
                'pid',
                'articleid',
                'displayorder'

            ],
            proxy: {
                type: 'ajax',
                extraParams: {typeid: window.display_mode},
                api: {
                    read: SITEURL+'article/infoset/action/read/articleid/{$articleid}',  //读取数据的URL
                    update:  SITEURL+'article/infoset/action/save/articleid/{$articleid}',
                    destroy:  SITEURL+'article/infoset/action/delete/articleid/{$articleid}'
                },
                reader: 'json'
            },
            autoLoad: true,
            listeners: {
                load:function( store, records, successful, eOpts )
                {



                }
            }

        });

        //树
        window.attr_treepanel = Ext.create('Ext.tree.Panel', {
            store: attr_store,
            rootVisible: false,
            padding: '2px',
            renderTo: 'attr_tree_panel',
            border: 0,
            style: 'margin-left:5px;border:0px;',
            width: "100%",
            bodyBorder: 0,
            bodyStyle: 'border-width:0px',
            // selModel:sel_model,
            scroll:'vertical', //只要垂直滚动条

            listeners: {
                itemmousedown: function (node, record, item, index, e, eOpts) {
                    var x = e.xy[0];
                    var column_x = Ext.getCmp('attr_name').getX();
                    var column_width = Ext.getCmp('attr_name').getWidth();

                    if (x < column_x || x > column_x + column_width)
                        return false;

                    window.node_moving = true;

                },
                sortchange: function (ct, column, direction, eOpts) {

                    window.sort_direction = direction;

                    var field = column.dataIndex;
                    if (field == 'kindname')
                        field = 'pinyin';
                    window.attr_store.sort(field, direction);

                },
                celldblclick: function (view, td, cellIndex, record, tr, rowIndex, e, eOpts) {

                    if (record.get('displayorder') == 'add')
                        return false;
                },
                afterlayout: function (panel) {
                    var data_height = panel.getView().getEl().down('.x-grid-table').getHeight();

                    var height = Ext.dom.Element.getViewportHeight();

                    // console.log(data_height+'---'+height);
                    if (data_height > height - 100) {
                        window.has_biged = true;
                        panel.height = height - 100;
                    }
                    else if (data_height < height - 100) {
                        if (window.has_biged) {
                            delete panel.height;
                            window.has_biged = false;
                            window.attr_treepanel.doLayout();
                        }
                    }

                }


            },
            viewConfig: {
                forceFit: true,
                border: 0,
                plugins: {
                    ptype: 'treeviewdragdrop',
                    enableDrag: true,
                    enableDrop: true,
                    displayField: 'attrname'
                },

                listeners: {
                    boxready: function () {

                        var height = Ext.dom.Element.getViewportHeight();

                        this.up('treepanel').maxHeight = height - 100;
                        this.up('treepanel').doLayout();
                    },

                    beforedrop: function (node, data, overModel, dropPosition, dropHandlers) {
                        if (dropPosition != 'append') {
                            dropHandlers.processDrop();
                            return;
                        }

                        if (overModel.isLoaded())
                            dropHandlers.processDrop();
                        else {

                            overModel.expand(false, function () {
                                dropHandlers.processDrop();
                            });
                        }

                        dropHandlers.cancelDrop();


                    },
                    drop: function (node, data, overModel, dropPosition, eOpts) {

                        var params = {};
                        params['moveid'] = data.records[0].get('id');
                        params['overid'] = overModel.get('id');
                        params['position'] = dropPosition;


                        if (dropPosition == 'append') {

                            var btn_node = window.attr_store.getNodeById(params['overid'] + 'add');
                            overModel.insertBefore(data.records[0], btn_node);

                        }

                        //alert(overModel.children);
                        Ext.Ajax.request({
                            url: SITEURL+'attrid/list/action/drag/typeid/{$typeid}',
                            params: params,
                            method: 'POST',
                            success: function (response) {
                                var text = response.responseText;
                                if (text == 'ok') {

                                } else {

                                }
                                // process server response here
                            }
                        });

                    }
                }

            },
            columns: [
                {
                    text: '<span class="grid_column_text">选择</span>'+"{php echo Common::getIco('help',137);}",
                    width: '5%',
                    dataIndex: 'issel',
                    tdCls: 'attr-al-mid',
                    align: 'center',
                    draggable: false,
                    sortable:false,
                    renderer : function(value, metadata,record) {
                        var id=record.get('id');

                        var issystem=record.get('issystem');
                        if(issystem==1)
                            return '';
                        if(id.indexOf('add')==-1)
                            return "<input type='checkbox' class='attr_check' value='" + id + "' style='cursor:pointer'/>";
                    }

                },
                {
                    text: '<span class="grid_column_text">排序</span>'+"{php echo Common::getIco('help',138);}",
                    dataIndex: 'displayorder',
                    //  tdCls:'attr-al-mid',
                    width: '5%',
                    editor: 'textfield',
                    draggable: false,
                    renderer : function(value, metadata,record) {
                        if(value==9999||value=='add')
                            return '';
                        else
                            return value;
                    }

                },
                {
                    xtype: 'treecolumn',   //有展开按钮的指定为treecolumn
                    text: '<span class="grid_column_text">段落标题</span>'+"{php echo Common::getIco('help',139);}",
                    dataIndex: 'title',
                    id: 'attr_name',
                    sortable:false,
                    locked: false,
                    width: '70%',
                    editor: 'textfield',
                    renderer : function(value, metadata,record) {
                        var id=record.get('id');
                        if(id.indexOf('add')==-1)
                        {
                            return value+"&nbsp;&nbsp;<font color='orange'>[id:"+id+"]</font>";

                        }
                        return value;
                    }
                },



                {
                    text: '<span class="grid_column_text">管理</span>'+"{php echo Common::getIco('help',141);}",
                    width: '20%',
                    tdCls: 'attr-al-mid',
                    renderer : function(value, metadata,record) {
                        var id=record.get('id');
                        var pid = record.get('pid');
                        if(id.indexOf('add')!=-1)
                            return '';
                        return '<a href="javascript:;" onclick="infoSet('+id+')">配置内容</a>';
                    }
                }
            ],
            plugins: [
                Ext.create('Ext.grid.plugin.CellEditing', {
                    clicksToEdit: 2,
                    listeners: {
                        edit: function (editor, e) {

                            e.record.commit();
                            e.record.save({params: {field: e.field}});

                        }
                    }
                })
            ]
        });


    }
);

function togStatus(obj, record, field) {
    var val = record.get(field);
    var id = record.get('id');
    id = id.substr(id.indexOf('_') + 1);
    var newval = val == 1 ? 0 : 1;
    Ext.Ajax.request({
        url: "attrination/action/update",
        method: "POST",
        datatype: "JSON",
        params: {id: id, field: field, val: newval, typeid: window.display_mode},
        success: function (response, opts) {
            if (response.responseText == 'ok') {
                record.set(field, newval);
                record.commit();
            }
        }});

}


Ext.getBody().on('mouseup', function () {
    window.node_moving = false;
});
Ext.getBody().on('mousemove', function (e, t, eOpts) {

    if (window.node_moving == true) {
        // console.log('mov_'+window.node_moving);

        var tree_view = window.attr_treepanel.down('treeview');
        var view_y = tree_view.getY();
        var view_bottom = view_y + tree_view.getHeight();
        var mouse_y = e.getY();
        if (mouse_y < view_y)
            tree_view.scrollBy(0, -5, false);
        if (mouse_y > view_bottom)
            tree_view.scrollBy(0, 5, false);

    }
});


Ext.EventManager.onWindowResize(function () {
    var height = Ext.dom.Element.getViewportHeight();
    var data_height = window.attr_treepanel.getView().getEl().down('.x-grid-table').getHeight();
    if (data_height > height - 100)
        window.attr_treepanel.height = (height - 100);
    else
        delete window.attr_treepanel.height;
    window.attr_treepanel.doLayout();
})

function cascadeattr(attr, index) {
    if (attr.length == 1) {
        var node = window.attr_store.getNodeById(attr[0]);
        var ele = window.attr_treepanel.getView().getNode(node);
        if (ele) {

            var edom = Ext.get(ele);
            edom.addCls('search-attr-tr');
            if (index == 0)
                viewScroll(edom);
        }
    }
    else {
        var node = window.attr_store.getNodeById(attr[0]);
        attr.shift();
        node.expand(false, function () {
            cascadeattr(attr, index);
        });

    }
}
function viewScroll(extdom)   //在treeview里滚动
{
    var tree_view = window.attr_treepanel.getView();
    var view_y = tree_view.getY();
    var dom_y = extdom.getY();


    window.setTimeout(function () {
        window.first_scroll = true;
        extdom.scrollIntoView(tree_view.getEl());
    }, 450);
    //else
    // extdom.scrollIntoView(tree_view.getEl());


}

function chooseAll() {
    var check_cmp = Ext.query('.attr_check');
    for (var i in check_cmp) {
        if (!Ext.get(check_cmp[i]).getAttribute('checked'))
            check_cmp[i].click();
    }

    //  window.sel_model.selectAll();
}
function chooseDiff() {
    var check_cmp = Ext.query('.attr_check');
    for (var i in check_cmp)
        check_cmp[i].click();
    //var records=window.sel_model.getSelection();
    //window.sel_model.selectAll(true);

    //	window.sel_model.deselect(records,true);

    //var
}
function delattr() {
    Ext.Msg.confirm("提示", "确定删除", function (buttonId) {

        if (buttonId == 'no')
            return;
        var check_cmp = Ext.select('.attr_check:checked');
        check_cmp.each(
            function (el, c, index) {
                // alert(el.getValue());
                //  window.attr_store.getNodeById(el.getValue().toString()).destroy();
                // window.attr_store.

                var id=el.getValue();
                var node=window.attr_store.getNodeById(id);
                node.destroy();


            }
        );
    });

}
function searchattr() {

    var s_str = Ext.get('search').getValue();
    //s_str=s_str.trim();
    Ext.select('.search-attr-tr').removeCls('search-attr-tr');

    if (!s_str)
        return;
    Ext.Ajax.request({
        url: 'attrination/action/search',
        params: {keyword: s_str},
        method: 'POST',
        success: function (response) {


            var text = response.responseText;
            if (text == 'no') {
                Ext.Msg.alert('查询结果', "未找到与'" + s_str + "'相关的目的地");
            } else {
                var list = Ext.decode(text);
                var index = 0;
                for (var i in list) {
                    var attr = list[i];
                    cascadeattr(attr, index);
                    index++;
                }
            }
            // process server response here
        }
    });

}

function getHelp(e) {
    if (e && e.stopPropagation)
    //因此它支持W3C的stopPropagation()方法 
        e.stopPropagation();
    else
    //否则，我们需要使用IE的方式来取消事件冒泡 
        window.event.cancelBubble = true;
}
function sortTrans(val) {
    if (!window.sort_direction)
        return window.parseInt(val);
    else {
        if (val == 'add'){
            if (window.sort_direction == 'ASC')
                return 10000000000000;
            else
                return -10;
        }
        else
            return window.parseInt(val);
    }
    // alert(val);
}

function addSub(pid) {
    var precord = pid == 0 ? window.attr_store.getRootNode() : window.attr_store.getNodeById(pid);
    var addnode = window.attr_store.getNodeById(pid + 'add');

    Ext.Ajax.request({
        method: 'post',
        url: SITEURL+'article/infoset/action/addsub/articleid/{$articleid}',
        params: {pid: pid},
        success: function (response) {

            var newrecord = Ext.decode(response.responseText);
            if(pid==0)
            {
                newrecord.leaf=false;
            }
            var view_el = window.attr_treepanel.getView().getEl()
            var scroll_top = view_el.getScrollTop();
            precord.insertBefore(newrecord, addnode);
            //view_el.scroll('t',scroll_top);
        }
    });

}
function updateField(ele,id,field,value,type)
{
    var record=window.attr_store.getNodeById(id.toString());
    if(type=='select')
    {
        value=Ext.get(ele).getValue();
    }


    Ext.Ajax.request({
        url   :  SITEURL+"article/infoset/action/update",
        method  :  "POST",
        datatype  :  "JSON",
        params:{id:id,field:field,val:value},
        success  :  function(response, opts)
        {
            //  alert(value);
            record.set(field,value);
            record.commit();

        }});

}

function stopDef(e)
{
    if (e && e.stopPropagation)
    //因此它支持W3C的stopPropagation()方法
        e.stopPropagation();
    else
    //否则，我们需要使用IE的方式来取消事件冒泡
        window.event.cancelBubble = true;
}
function listDest(productid,dest_arr,bl,selector)
{
    var kindlist="";
    var kindname="";
    for(var i in dest_arr)
    {
        // html+="<span><s onclick=\"$(this).parent('span').remove()\"></s>"+dest_arr[i].name+"<input type='hidden' name='kindlist[]' value='"+dest_arr[i].id+"'/></span>";
        //  $(selector).html(html);
        kindlist+=dest_arr[i].id+',';
        kindname+=dest_arr[i].name+',';
    }
    kindlist=kindlist.slice(0,-1);
    kindname=kindname.slice(0,-1);
    updateField(null,productid,'articleid',kindlist);

}

function infoSet(id)
{
    /*var record=window.attr_store.getNodeById(id.toString());
     var litpic=record.get('litpic');
     var description=record.get('description');
     var attrname=record.get('attrname');
     description=description?description:'';*/

    var boxurl = SITEURL+'article/infoconfig/id/'+id;
    ST.Util.showBox('段落内容配置',boxurl,'750','550',function(){ });


}

</script>
</body>
</html>
