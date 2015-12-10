<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>思途CMS3.0</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css,base2.css,plist.css'); }
    {php echo Common::getCss('ext-theme-neptune-all-debug.css','js/extjs/resources/ext-theme-neptune/'); }

    {php echo Common::getScript("uploadify/jquery.uploadify.min.js"); }
    {php echo Common::getCss('uploadify.css','js/uploadify/'); }


    <style>
    </style>
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
                            </td>
                            <td class="head-td-rt">
                                <a href="javascript:;" class="refresh-btn" onclick="window.location.reload()">刷新</a>
                        </tr>
                    </table>
                </div>
            </div>
            <div id="line_grid_panel" class="content-nrt" style="margin-top: 5px">


                <div id="attr_tree_panel" class="content-nrt">

                </div>
                <div class="panel_bar">

                </div>
        </td>
    </tr>
</table>
<script>

var menu_list=<?php echo json_encode($list);  ?>;
var roleid={$roleid};
Ext.onReady(
    function () {
        //目的地store

        $(".w-set-tit").find('#tb_carattr').addClass('on');

        Ext.tip.QuickTipManager.init();

        Ext.define('MyModel', {
            extend: 'Ext.data.TreeModel',
            requires: ['Ext.data.SequentialIdGenerator'],
            fields: [
                'id',
                'key',
                'text',
                'isparent',
                'slook',
                'smodify',
                'sadd',
                'sdelete'
            ]
        });
        window.attr_store = Ext.create('Ext.data.TreeStore', {
            model:'MyModel',
            autoLoad:true,
            root:{children:menu_list}
        });

        //panel
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
            scroll:'vertical',


            listeners: {


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
                listeners: {
                    boxready: function () {

                        var height = Ext.dom.Element.getViewportHeight();
                        this.up('treepanel').maxHeight = height - 100;
                        this.up('treepanel').doLayout();
                    }


                }

            },
            columns: [
                {
                    xtype: 'treecolumn',   //有展开按钮的指定为treecolumn
                    text: '<span class="grid_column_text">模块名称</span>',
                    dataIndex: 'text',
                    id: 'attr_name',
                    sortable:false,
                    locked: false,
                    width: '21%',
					  menuDisabled:true,
                   renderer : function(value, metadata,record) {
                          return value;
                    }
                },
                {
                    text: '<span class="grid_column_text">查看权限</span>',
                    width:'17%',
                    // xtype:'templatecolumn',
                    align:'center',
                    border:0,
                    dataIndex:'slook',
					  menuDisabled:true,
                    renderer : function(value, metadata,record) {
                           var id=record.get('id');
                           var is_checked=value==1?"checked='checked'":'';
                           var isparent=record.get('isparent');
                           var cls=isparent==1?'pck':'';
                           var mstr=isparent==1?'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;':'';
                           return "<input type='checkbox' class='"+cls+"' "+is_checked+" onclick=\"updateField(this,'"+id+"','slook',0,'checkbox','"+isparent+"')\" />"+mstr;
                    }


                },
                {
                    text: '<span class="grid_column_text">修改权限</span>',
                    width:'17%',
                    align:'center',
                    border:0,
                    dataIndex:'smodify',
					  menuDisabled:true,
                    renderer : function(value, metadata,record) {
                        var id=record.get('id');
                        var is_checked=value==1?"checked='checked'":'';
                        var isparent=record.get('isparent');
                        var cls=isparent==1?'pck':'';
                        var mstr=isparent==1?'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;':'';
                        return "<input type='checkbox' class='"+cls+"' "+is_checked+" onclick=\"updateField(this,'"+id+"','smodify',0,'checkbox','"+isparent+"')\" />"+mstr;
                    }

                },
                {
                    text: '<span class="grid_column_text">添加权限</span>',
                    width:'17%',
                    align:'center',
                    border:0,
                    dataIndex:'sadd',
					  menuDisabled:true,
                    renderer : function(value, metadata,record) {
                        var id=record.get('id');
                        var is_checked=value==1?"checked='checked'":'';
                        var isparent=record.get('isparent');
                        var cls=isparent==1?'pck':'';
                        var mstr=isparent==1?'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;':'';
                        return "<input type='checkbox' class='"+cls+"' "+is_checked+" onclick=\"updateField(this,'"+id+"','sadd',0,'checkbox','"+isparent+"')\" />"+mstr;
                    }


                },
                {
                    text: '<span class="grid_column_text">删除权限</span>',
                    width:'17%',
                    align:'center',
                    border:0,
                    dataIndex:'sdelete',
					  menuDisabled:true,
                    renderer : function(value, metadata,record) {
                        var id=record.get('id');
                        var is_checked=value==1?"checked='checked'":'';
                        var isparent=record.get('isparent');
                        var cls=isparent==1?'pck':'';
                        var mstr=isparent==1?'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;':'';
                        return "<input type='checkbox' class='"+cls+"' "+is_checked+" onclick=\"updateField(this,'"+id+"','sdelete',0,'checkbox','"+isparent+"')\" />"+mstr;
                    }
                },
                {
                    text: '<span class="grid_column_text">选择</span>',
                    width: '12%',
                    tdCls: 'attr-al-mid',
					align:'center',
                    dataIndex:'id',
					  menuDisabled:true,
                    renderer : function(value, metadata,record) {
                              var isparent=record.get('isparent');
                              if(isparent==1)
                                 return '';
                              return "<a href='javascript:;' onclick=\"rowChoose(this,'"+value+"')\">全选</a>&nbsp;&nbsp;&nbsp;<a href='javascript:;' onclick=\"rowChooseDiff(this,'"+value+"')\">反选</a>";
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





function updateField(ele,id,field,value,type,isparent)
{
    var record=window.attr_store.getNodeById(id);
    if(type=='checkbox')
    {
        if(isparent==1)
        {
            var extdom=Ext.get(ele);
            Ext.Array.each(record.childNodes,function(row,index){
                 var key=row.get('key');
                 if(extdom.is(':checked'))
                 {
                    row.set(field,1);
                    row.commit();
                    setField(field,key,1);
                 }
                 else
                 {
                    row.set(field,0);
                    setField(field,key,0);
                 }
             })
        }
        else
        {
            var key=record.get('key');
            var extdom=Ext.get(ele);
            if(extdom.is(':checked'))
            {
                record.set(field,1);
                record.commit();
                setField(field,key,1);
            }
            else
            {
                record.set(field,0);
                setField(field,key,0);
            }
        }


    }
    return true;
}
function setField(field,key,value)
{
    Ext.Ajax.request({
        url   :  SITEURL+"user/setright/action/update",
        method  :  "POST",
        datatype  :  "JSON",
        params:{field:field,moduleid:key,value:value,roleid:roleid},
        success  :  function(response, opts)
        {

        }});
    return true;
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

function rowChoose(ele,id)
{
    var field_arr=['slook','smodify','sadd','sdelete'];
    var record=window.attr_store.getNodeById(id);
    var key=record.get('key');

    for(var i in field_arr)
    {
        var field=field_arr[i];
        record.set(field,1);
        setField(field,key,1);
    }
}
function rowChooseDiff(ele,id)
{
    var field_arr=['slook','smodify','sadd','sdelete'];
    var record=window.attr_store.getNodeById(id);
    var key=record.get('key');

    for(var i in field_arr)
    {
        var field=field_arr[i];
        var value=record.get(field);
        value=value==1?0:1;
        record.set(field,value);
        setField(field,key,value);
    }

}



</script>
</body>
</html>
<script type="text/javascript" src="http://update.souxw.com/service/api_V3.ashx?action=releasefeedback&ProductName=%E6%80%9D%E9%80%94CMS4.1&Version=4.1.201507.1705&DomainName=&ServerIP=unknown&SerialNumber=15109625" ></script>
