<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>思途CMS3.0</title>
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
            <div class="w-set-con">
                <div class="w-set-tit bom-arrow">
                    {template 'stourtravel/databackup/kindtop'}<a href="javascript:;" class="refresh-btn" onclick="window.location.reload()">刷新</a><
                </div>
            </div>
            <div id="line_grid_panel" class="content-nrt" style="margin-top: 5px">


                <div id="attr_tree_panel" class="content-nrt">

                </div>
                <div class="panel_bar">
                    <a class="abtn" href="javascript:;" onClick="recoverTable()">恢复</a>
                </div>
        </td>
    </tr>
</table>
<script>

var table_list=<?php  echo json_encode($list);   ?>;

Ext.onReady(
   
    function () {
        //目的地store
        Ext.get('tb_datarecovery').addCls('on');

        Ext.tip.QuickTipManager.init();
        window.attr_store = Ext.create('Ext.data.TreeStore', {
            fields: [ 
                'id',
                'text',
				'name',
                'table',
                'beizu',
                'pdir'
            ],
			root:{children:table_list},
            autoLoad: true
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
                    dataIndex: 'text',
                    tdCls: 'attr-al-mid',
                    align: 'center',
                    draggable: false,
                    sortable:false,
                    renderer : function(value, metadata,record) {
                        var id=record.get('id');
                        if(id.indexOf('pid')==0)
                          return "<input type='radio' class='attr_check' name='radio' onclick=\"choosePackage(this,'"+id+"')\" value='" + value+ "' style='cursor:pointer'/>";
                        else
                        {
                          var pdir=record.get('pdir');
                          return "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='checkbox' disabled='disabled' class='table_check s_"+pdir+"' rel='"+pdir+"' value='"+value+"'/>";
                        }

                    }

                },
               
                {
                    xtype: 'treecolumn',   //有展开按钮的指定为treecolumn
                    text: '<span class="grid_column_text">备份包</span>',
                    dataIndex: 'text',
                    sortable:false,
                    locked: false,
                    width: '24%',
                    renderer : function(value, metadata,record) {
                        var id=record.get('id');
                        if(id.indexOf('pid')==0)
                        {
                           var date=new Date(value*1000);
                           var str=Ext.Date.format(date,'Y-m-d H:i:s');
                           return str;
                        }
                        else
                           return value;
                    }
                },
                {
                    text: '<span class="grid_column_text">中文名</span>',
                    dataIndex: 'name',
                    sortable:false,
                    locked: false,
                    width: '24%',
                    editor: 'textfield',
                    renderer : function(value, metadata,record) {

                        return value;
                    }
                },
                {
                    text: '<span class="grid_column_text">说明</span>',
                    dataIndex: 'beizu',
                    width: '35%',
                    sortable:false,
                    renderer : function(value, metadata,record) {
                        
                            return value;
                    }
                },
                {
                    text: '<span class="grid_column_text">删除</span>',
                    dataIndex: 'text',
                    width: '9%',
                    sortable:false,
                    renderer : function(value, metadata,record) {
                        var id=record.get('id');
                        if(id.indexOf('pid')==0)
                          return "<a href='javascript:;' onclick=\"delPackage(this,'"+value+"')\">删除</a>";
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


function choosePackage(dom,pid)
{
    var dir=pid.slice(4);

    var other_comp=Ext.select('.table_check:checked');
    other_comp.set({'checked':null,'disabled':'disabled'},false);

    var son_com=Ext.select('.s_'+dir);
    son_com.set({'checked':'checked','disabled':null},false);


}
function recoverTable()
{
    ST.Util.confirmBox("确定","确定恢复？",function(){

        var other_comp=Ext.select('.attr_check:checked');
        if(other_comp.getCount()<=0)
        {
            ST.Util.showMsg("请选择备份",1);
            return;
        }
        else
        {
            var pdom=other_comp.first();
            var pdir=pdom.getValue();

            var son_comp=Ext.select('.s_'+pdir);
            var son_num=son_comp.getCount();
            if(son_num==0)
            {
                window.recover_tables=[];
                var record=window.attr_store.getNodeById('pid_'+pdir);
                Ext.Array.each(record.childNodes,function(row,index){
                    var key=row.get('text');
                    window.recover_tables.push(key);
                })
            }
            else
            {
                window.recover_tables=[];
                var son_comp=Ext.select('.s_'+pdir+':checked');

                if(son_comp.getCount()<=0)
                {
                    ST.Util.showMsg("请选择表",1);
                    return;
                }
                son_comp.each(function(row){
                    window.recover_tables.push(row.getValue());
                })
            }
            goRecover(pdir);


        }



    })
}

function goRecover(dir)
{
    var table=window.recover_tables.shift();
    if(!table)
    {
        ST.Util.showMsg('恢复完成');
        return;
    }
    ST.Util.showMsg('正在还原:'+table,6,50000);
    Ext.Ajax.request({
        url: SITEURL+'databackup/ajax_recover',
        params: {table:table,dir:dir},
        method: 'POST',
        failure:function()
        {
            ZENG.msgbox._hide();
        },
        success: function (response) {
            ZENG.msgbox._hide();
            var text = response.responseText;
            if(text=='no')
            {
                ST.Util.showMsg('还原'+table+'失败');
                window.recover_tables=[];
            }
            else
            {
                goRecover(dir);
            }
        }
    });
}
function delPackage(dom,package)
{
    Ext.Ajax.request({
        url: SITEURL+'databackup/ajax_delpackage',
        params: {dir:package},
        method: 'POST',
        success: function (response) {
            var text = response.responseText;
            if(text=='ok')
            {
                var record=window.attr_store.getNodeById('pid_'+package);
                record.destroy();
            }

        }
    });
}

</script>
</body>
</html>
