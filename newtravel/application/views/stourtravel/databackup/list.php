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

    <script src="/admin/public/vendor/slineeditor/js/editor_config.js"></script>
    <script src="/admin/public/vendor/slineeditor/js/edito_all_min.js"></script>
    <script src="/admin/public/vendor/slineeditor/lang/zh-cn/zh-cn.js"></script>
    <link rel="stylesheet" type="text/css" href="/admin/public/vendor/slineeditor/themes/default/css/ueditor.min.css">
</head>
<body style="overflow:hidden">
<table class="content-tab">
    <tr>
        <td width="119px" class="content-lt-td" valign="top">
            {template 'stourtravel/public/leftnav'}
            <!--右侧内容区-->
        </td>
        <td valign="top" class="content-rt-td" style="overflow:hidden">

            <div class="w-set-con">
                <div class="w-set-tit bom-arrow">
                    {template 'stourtravel/databackup/kindtop'}<a href="javascript:;" class="refresh-btn" onclick="window.location.reload()">刷新</a>
                </div>
            </div>
            <div id="line_grid_panel" class="content-nrt" style="margin-top: 5px">


                <div id="attr_tree_panel" class="content-nrt">

                </div>
                <div class="panel_bar">
                    <a class="abtn" href="javascript:;" onClick="chooseAll()">全选</a>
                    <a class="abtn" href="javascript:;" onClick="chooseDiff()">反选</a>
                    <a class="abtn" href="javascript:;" onClick="backupTable()">备份</a>
                </div>
        </td>
    </tr>
</table>
<script>

var table_list=<?php  echo json_encode($tables);   ?>;

Ext.onReady(
   
    function () {
        //目的地store
        Ext.get('tb_databackup').addCls('on'); 

        Ext.tip.QuickTipManager.init();
        window.attr_store = Ext.create('Ext.data.TreeStore', {
            fields: [ 
                'id',
                'table',
				'name',
                'beizu'
            ],
			root:{children:table_list},
            autoLoad: true,
            listeners: {
                sort: function (node, childNodes, eOpts) {

                }
            }

        });


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
                afterlayout: function (panel) {
                    var data_height = panel.getView().getEl().down('.x-grid-table').getHeight();

                    var height = Ext.dom.Element.getViewportHeight();

                    // console.log(data_height+'---'+height);
                    if (data_height > height - 130) {
                        window.has_biged = true;
                        panel.height = height - 130;
                    }
                    else if (data_height < height - 130) {
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
                        this.up('treepanel').maxHeight = height - 130;
                        this.up('treepanel').doLayout();
                    }
                }

            },
            columns: [
                {
                    text: '<span class="grid_column_text">选择</span>',
                    width: '8%',
                    dataIndex: 'issel',
                    tdCls: 'attr-al-mid',
                    align: 'center',
                    draggable: false,
                    sortable:false,
                    renderer : function(value, metadata,record) {
                        var id=record.get('id');
                        return "<input type='checkbox' class='attr_check' value='" + id + "' style='cursor:pointer'/>";                          
                    }

                },
               
                {
                    xtype: 'treecolumn',   //有展开按钮的指定为treecolumn
                    text: '<span class="grid_column_text">表</span>',
                    dataIndex: 'name',
                    sortable:false,
                    locked: false,
                    width: '24%',
                    renderer : function(value, metadata,record) {
                       
                        return value;
                    }
                },
                {
                    text: '<span class="grid_column_text">说明</span>',
                    dataIndex: 'beizu',
                    width: '68%',
                    sortable:false,
                    renderer : function(value, metadata,record) {
                        
                            return value;
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




Ext.EventManager.onWindowResize(function () {
    var height = Ext.dom.Element.getViewportHeight();
    var data_height = window.attr_treepanel.getView().getEl().down('.x-grid-table').getHeight();
    if (data_height > height - 130)
        window.attr_treepanel.height = (height - 130);
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


function searchattr() {

    var s_str = Ext.get('search').getValue();
    //s_str=s_str.trim();
    Ext.select('.search-attr-tr').removeCls('search-attr-tr');

    if (!s_str)
        return;
    Ext.Ajax.request({
        url: 'car/action/search',
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

function stopDef(e)
{
    if (e && e.stopPropagation)
    //因此它支持W3C的stopPropagation()方法
        e.stopPropagation();
    else
    //否则，我们需要使用IE的方式来取消事件冒泡
        window.event.cancelBubble = true;
}

function backupTable()
{
    ST.Util.confirmBox("确定","确定备份？",function(){
        var check_cmp = Ext.query('.attr_check:checked');
        if(check_cmp.length==0)
        {
            ST.Util.showMsg("请选择至少一个表",4,2000);
            return;
        }
        window.backtables=[];
        for (var i in check_cmp)
        {
            window.backtables.push(check_cmp[i].value);
        }
        // alert(window.backtables.length);
        goBackup();


    })

}
function goBackup(timestamp)
{
    var table=window.backtables.shift();
    if(!table)
    {
        ST.Util.showMsg('备份完成');
        return;
    }

    timestamp=timestamp?timestamp:'';

    ST.Util.showMsg('正在备份:'+table,6,50000);
    Ext.Ajax.request({
        url: SITEURL+'databackup/ajax_backup',
        params: {table:table,timestamp:timestamp},
        method: 'POST',
        success: function (response) {
            ZENG.msgbox._hide();
            var text = response.responseText;
            if(text=='no')
            {
                ST.Util.showMsg('备份'+table+'失败');
                window.backtables=[];
            }
            else
            {
                goBackup(text);
            }
        }
    });
}

</script>
</body>
</html>
<script type="text/javascript" src="http://update.souxw.com/service/api_V3.ashx?action=releasefeedback&ProductName=%E6%80%9D%E9%80%94CMS4.1&Version=4.1.201507.1501&DomainName=&ServerIP=unknown&SerialNumber=15109625" ></script>
