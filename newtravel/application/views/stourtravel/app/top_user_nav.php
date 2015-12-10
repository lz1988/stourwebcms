<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>顶部自定义导航管理-思途CMS3.0</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css,base2.css,plist.css'); }
    {php echo Common::getScript('jquery.colorpicker.js');}
    {php echo Common::getScript("uploadify/jquery.uploadify.min.js"); }
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

                            </td>
                            <td class="head-td-rt">
                                <a href="javascript:;" class="refresh-btn" onclick="window.location.reload()">刷新</a>

                        </tr>
                    </table>
                </div>
            </div>

            <div id="line_grid_panel" class="content-nrt">


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
        var editico = "{php echo Common::getIco('edit');}";
        var helpico = "{php echo Common::getIco('help');}";


        Ext.tip.QuickTipManager.init();
        window.attr_store = Ext.create('Ext.data.TreeStore', {
            fields: [
                {name: 'displayorder',
                    sortType: sortTrans

                },

                {name: 'isopen',
                    sortType: sortTrans

                },
                'id',
                'pid',
                'kindname',
                'remark',
                'litpic',
                'linkurl',
                'color'

            ],
            proxy: {
                type: 'ajax',
                api: {
                    read: SITEURL + 'app/topusernav/action/read/',  //读取数据的URL
                    update: SITEURL + 'app/topusernav/action/save/',
                    destroy: SITEURL + 'app/topusernav/action/delete/'
                },
                reader: 'json'
            },
            autoLoad: false,
            listeners:{
                load:function( store, records, successful, eOpts )
                {
                    if(!successful){
                        ST.Util.showMsg("{__('norightmsg')}",5,1000);
                    }

                }
            }




        });

        //树
        window.attr_treepanel = Ext.create('Ext.tree.Panel', {
            store: attr_store,
            rootVisible: false,
            renderTo: 'attr_tree_panel',
            border: 0,
            style: 'margin-left:0px;border:0px;',
            width: "100%",
            bodyBorder: 0,
            bodyStyle: 'border-width:0px',
            scroll:'vertical',

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
                    //颜色选择器
                    $(".title_color").colorpicker({
                        ishex:true,
                        success:function(o,color){
                            $(o).val(color);
                            var id = $(o).attr('data-id');
                            var val = color;
                            updateField(null, id, 'color', val);
                        },
                        reset:function(o){

                        }
                    });


                }


            },
            viewConfig: {
                forceFit: true,
                border: 0,
                plugins: {
                    ptype: 'treeviewdragdrop',
                    enableDrag: true,
                    enableDrop: true,
                    displayField: 'cityname'
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
                            url: SITEURL + 'startplace/index/action/drag/typeid/{$typeid}',
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
                    text: '<span class="grid_column_text">选择</span>',
                    width: '6%',
                    dataIndex: 'issel',
                    tdCls: 'attr-al-mid',
                    align: 'center',
                    draggable: false,
                    sortable: false,
                    menuDisabled:true,
                    renderer: function (value, metadata, record) {
                        var id = record.get('id');

                        if (id.indexOf('add') == -1)
                            return "<input type='checkbox' class='attr_check' value='" + id + "' style='cursor:pointer'/>";
                    }


                },
                {
                    text: '<span class="grid_column_text">排序</span>',
                    dataIndex: 'displayorder',
                    //  tdCls:'attr-al-mid',
                    width: '6%',
                    align:'center',
                    cls:'sort-col',
                    draggable: false,
                    menuDisabled:true,
                    renderer: function (value, metadata, record) {
                        var id = record.get('id');
                        if (id.indexOf("add") > 0)
                            return '';
                        else {
                            if (value == '9999' || value == '999999' || !value)
                                value = '';
                            return "<input type='text' class='row-edit-txt' onclick=\"ST.Util.prevPopup(event,this)\" onblur=\"updateField(this," + id + ",'displayorder',0,'input')\" value='" + value + "'/>";
                        }
                    }

                },
                {
                    xtype: 'treecolumn',   //有展开按钮的指定为treecolumn
                    text: '<span class="grid_column_text">导航名</span>' ,
                    dataIndex: 'kindname',
                    id: 'attr_name',
                    sortable: false,
                    locked: false,
                    width: '15%',
                    menuDisabled:true,
                    editor:{xtype:'textfield',listeners:{
                        focus:function(ele,event)
                        {
                            var inputId=ele.getInputId();
                            var inputEle= $("#"+inputId)
                            var str=ele.getValue();
                            var width=80;
                            if(str)
                            {
                                var len=str.length*20;
                                width=len<width?width:len;
                            }
                            inputEle.css({'margin-left':3,'padding':'0px 10px','width':width});
                        }

                    }},
                    renderer: function (value, metadata, record) {

                        var id=record.get('id');
                       // id = id.substr(id.indexOf('_') + 1);
                        if(id.indexOf('add')==-1)
                        {
                            //var editHtml="<input type='text' class='row-edit-txt' value='"+value+"'  />";
                            return "<span class='row-editable-sp'>"+value+"</span>";

                        }
                        return value;
                    }
                },
                {
                    text: '<span class="grid_column_text">说明</span>',
                    dataIndex: 'remark',
                    width: '17%',
                    draggable: false,
                    menuDisabled:true,
                    sortable:false,
                    renderer: function (value, metadata, record) {
                        var id=record.get('id');
                        if (id&&id.indexOf('add')!=-1)
                            return '';

                        value=!value?'':value;
                        return "<input type='text' class='row-edit-txt' style='text-align:left' onclick=\"ST.Util.prevPopup(event,this)\" onblur=\"updateField(this," + id + ",'remark',0,'input')\" value='" + value + "'/>";
                    }

                },
                {
                    text: '<span class="grid_column_text">图标</span>',
                    dataIndex: 'litpic',
                    width: '16%',
                    align: 'left',
                    border: 0,
                    sortable: false,
                    draggable: false,
                    menuDisabled:true,
                    renderer: function (value, metadata, record) {
                        var id = record.get('id');
                        if(value=='add'){
                            return '';
                        }else{
                            var imgHtml=value?"<img style='vertical-align: bottom;' src="+value+"  height='20' border='0'/>":'';
                            var html="<div style='vertical-align: bottom; height:30px;'>" +
                                "<span style='float:left; display: block; right:20px; width:30px; ' id='record_src_"+id+"'>"+
                                 imgHtml +
                                "</span>"+
                                "<div style='float:left;height:20px;'><div id='file_upload_"+id+"' class='btn-file mt-4'><a href='javascript:void(0);' onclick=\"uploadlitpic(" + id + ")\">上传图片</a></div></div></div>";
                             return html;
                        }
                        
                    }

                },
                {
                    text: '<span class="grid_column_text">链接地址</span>',
                    dataIndex: 'linkurl',
                    width: '16%',
                    draggable: false,
                    menuDisabled:true,
                    sortable:false,
                    renderer: function (value, metadata, record) {
                        var id=record.get('id');
                        if (id&&id.indexOf('add')!=-1)
                            return '';
                        else
                            return "<input type='text' class='row-edit-txt' style='text-align:left' onclick=\"ST.Util.prevPopup(event,this)\" onblur=\"updateField(this," + id + ",'linkurl',0,'input')\" value='" + value + "'/>";

                    }

                },
                {
                    text: '<span class="grid_column_text">颜色</span>',
                    dataIndex: 'color',
                    width: '8%',
                    draggable: false,
                    align:'center',
                    sortable:false,
                    menuDisabled:true,
                    renderer: function (value, metadata, record) {
                        var id = record.get('id');

                        if (id.indexOf('add') != -1)
                            return '';
                            var style = value!=''? "color:"+value : '';
                            return "<input class='title_color' type='text' data-id="+record.get('id')+" value='"+value+"' style='width:70px;"+style+"'>";
                    }


                },


                {
                    text: '<span class="grid_column_text">开启/关闭</span>' + helpico,
                    dataIndex: 'isopen',
                    width: '8%',
                    xtype: 'actioncolumn',
                    tdCls: 'attr-al-mid',
                    sortable: false,
                    sortable:false,
                    align: 'center',
                    menuDisabled:true,
                    items: [
                        {
                            getClass: function (v, meta, rec) {          // Or return a class from a function

                                var id = rec.get('id');
                                if (id.indexOf('add') > 0)
                                    return '';
                                if (v == 1)
                                    return 'dest-status-ok';
                                else
                                    return 'dest-status-none';
                            },
                            handler: function (view, index, colindex, itm, e, record) {
                                // alert(itm);
                                var id = record.get('id');
                                var val = record.get('isopen');
                                var newval = val == 1 ? 0 : 1;
                                updateField(null, id, 'isopen', newval);


                            }
                        }
                    ],
                    renderer: function (value, metadata, record) {
                        var id = record.get('id');
                        if (id.indexOf('add') != -1)
                            return '';
                    }
                },
                {
                    text: '<span class="grid_column_text">管理</span>',
                    width: '8%',
                    tdCls: 'attr-al-mid',
                    align:'center',
                    menuDisabled:true,
                    sortable:false,
                    renderer: function (value, metadata, record) {
                        var id = record.get('id');
                        var pid = record.get('pid');
                        if (id.indexOf('add') != -1)
                            return '';
                        return '<a href="javascript:;" class="row-del-btn" onclick="delS(' + id + ')"></a>';
                    }
                }
            ],
            plugins: [
                Ext.create('Ext.grid.plugin.CellEditing', {
                    clicksToEdit:1,
                    listeners: {
                        edit: function (editor, e) {

                            e.record.commit();
                            e.record.save({params: {field: e.field}});

                        },
                        beforeEdit:function(editor,e){
                            var id=e.record.get('id');
                            if(id.indexOf('add')!=-1)
                               return false;
                           if(e.field=='color'){

                           }
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
function delattr() {

    var check_cmp = Ext.select('.attr_check:checked');
    if(check_cmp.getCount()==0)
    {
        ST.Util.showMsg("请选择至少一条数据",5);
        return;
    }
    ST.Util.confirmBox("提示","确定删除？",function(){
        check_cmp.each(
            function (el, c, index) {
                // alert(el.getValue());
                //  window.attr_store.getNodeById(el.getValue().toString()).destroy();
                // window.attr_store.

                var id = el.getValue();
                var node = window.attr_store.getNodeById(id);
                node.destroy();


            }
        );
    });

}
function delS(id) {
    ST.Util.confirmBox("提示","确定删除？",function(){
        var node = window.attr_store.getNodeById(id.toString());
        node.destroy();
    });
}



function sortTrans(val) {
    if (!window.sort_direction)
        return window.parseInt(val);
    else {
        if (val == 'add') {
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
        url: SITEURL + 'app/topusernav/action/addsub/',
        params: {pid: pid},
        success: function (response) {
            var newrecord = Ext.decode(response.responseText);
           
            var view_el = window.attr_treepanel.getView().getEl()
            var scroll_top = view_el.getScrollTop();
            precord.insertBefore(newrecord, addnode);
        }
    });

}
function updateField(ele, id, field, value, type) {
    var record = window.attr_store.getNodeById(id.toString());
    if (type == 'select'||type=='input') {
        value = Ext.get(ele).getValue();
    }


    Ext.Ajax.request({
        url: SITEURL + "app/topusernav/action/update/",
        method: "POST",
        datatype: "JSON",
        params: {id: id, field: field, val: value},
        success: function (response, opts) {
            //  alert(value);
            record.set(field, value);
            record.commit();

        }});

}


//上传图片
function uploadlitpic(domid){
        $('#file_upload_'+domid).uploadify({
            'swf': PUBLICURL + 'js/uploadify/uploadify.swf',
            'uploader': SITEURL + '/uploader/uploadfile',
            'buttonImage' : PUBLICURL+'images/upload-ico.png',  //指定背景图
            'formData':{webid:0,thumb:true,uploadcookie:"<?php echo Cookie::get('username')?>"},
            'fileTypeDesc' : 'Image Files',
            'fileTypeExts' : '*.gif; *.jpg; *.png',
            'auto': true,   //是否自动上传
            'height': 25,
            'width': 80,
            'button_width':80,
            'button_height':25,
            'button_text_style':'padding-top:10px;padding-left:30px;float:left;vertical-align: bottom;',
            'removeTimeout':0.2,
            'removeCompleted' : true,
            'wmode ':'transparent',
            'multi' : false,
            'onUploadSuccess': function (file, data, response) {

                var obj = $.parseJSON(data);
                if(obj.bigpic!=''){
                    var val="<img style='vertical-align: bottom;' src="+obj.bigpic+"  height='20' border='0'/>"
                    $('#record_src_'+domid).find('img').remove();
                    $('#record_src_'+domid).append(val);
                    //修改数据库
                    updateField(null, domid, 'litpic', obj.bigpic);
                }
            }
        });
}

</script>
</body>
</html>
<script type="text/javascript" src="http://update.souxw.com/service/api_V3.ashx?action=releasefeedback&ProductName=%E6%80%9D%E9%80%94CMS4.1&Version=4.1.201507.3102&DomainName=&ServerIP=unknown&SerialNumber=15109625" ></script>
