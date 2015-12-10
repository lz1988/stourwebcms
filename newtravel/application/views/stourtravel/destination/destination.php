<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>思途CMS3.0</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css,base2.css,plist.css'); }
    {php echo Common::getCss('ext-theme-neptune-all-debug.css','js/extjs/resources/ext-theme-neptune/'); }
    {php echo Common::getScript("uploadify/jquery.uploadify.min.js,listimageup.js,common.js"); }
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


            <div  class="search-bar filter" id="search_bar">
                <div class="pro-search ml-10" style=" float:left; margin-top:4px">
                    <input type="text" id="searchkey" value="目的地名称" datadef="目的地名称" class="sty-txt1 set-text-xh wid_200">
                    <a href="javascript:;" title="搜索" class="head-search-btn" onclick="searchDest()"></a>
                </div>

               <span class="display-mdd">
                  <a href="javascript:void(0);" onClick="togMod(this,0,'全局目的地')" <?php  if($typeid==0) echo 'class="on"';   ?>>全局</a>
                  <a href="javascript:void(0);" onClick="togMod(this,1,'线路目的地')" <?php  if($typeid==1) echo 'class="on"';   ?>>线路</a>
                  <a href="javascript:void(0);" onClick="togMod(this,2,'酒店目的地')" <?php  if($typeid==2) echo 'class="on"';   ?>>酒店</a>
                  <a href="javascript:void(0);" onClick="togMod(this,3,'租车目的地')" <?php  if($typeid==3) echo 'class="on"';   ?>>租车</a>
                  <a href="javascript:void(0);" onClick="togMod(this,4,'文章目的地')" <?php  if($typeid==4) echo 'class="on"';   ?>>文章</a>
                  <a href="javascript:void(0);" onClick="togMod(this,5,'景点目的地')" <?php  if($typeid==5) echo 'class="on"';   ?>>景点</a>
                  <a href="javascript:void(0);" onClick="togMod(this,6,'相册目的地')" <?php  if($typeid==6) echo 'class="on"';   ?>>相册</a>
                  <a href="javascript:void(0);" onClick="togMod(this,13,'团购目的地')"<?php  if($typeid==13) echo 'class="on"';   ?>>团购</a>
                  <a href="javascript:void(0);" onClick="togMod(this,11,'结伴目的地')"<?php  if($typeid==11) echo 'class="on"';   ?>>结伴</a>
                   {loop $addmodule $row}
                      <a href="javascript:void(0);" onClick="togMod(this,{$row['id']},'{$row['modulename']}目的地')" {if $typeid==$row['id']} class="on"{/if}>{$row['modulename']}</a>
                   {/loop}
                </span>
            </div>
            <div id="line_grid_panel" class="content-nrt">


                <div id="dest_tree_panel" class="content-nrt">

                </div>
                <div class="panel_bar">
                    <a class="abtn" href="javascript:;" onClick="chooseAll()">全选</a>
                    <a class="abtn" href="javascript:;" onClick="chooseDiff()">反选</a>
                    <a class="abtn" href="javascript:;" onClick="delDest()">删除</a>
                </div>
        </td>
    </tr>
</table>
{php Common::getEditor('jseditor','',580,200,'Sline','','print',true);}
<script>

var rootUrl = "{php echo URL::site();}";
window.display_mode ={$typeid};
var typename_json={type1:'线路',type2:'酒店',type3:'租车',type4:'攻略',type5:'景点',type6:'相册',type13:'团购'}
var typeModule={1:'lines/{dest}/',2:'hotels/{dest}/',3:'cars/{dest}/',4:'{dest}/raiders/',5:'spots/{dest}/',6:'photos/{dest}/',13:'tuan/{dest}'};
var otherModule={php echo json_encode($allmodule);};


Ext.onReady(
    function () {

        $("#searchkey").focusEffect();
        //目的地store
        window.dest_store = Ext.create('Ext.data.TreeStore', {
            fields: [
                {name: 'displayorder',
                    sortType: sortTrans

                },
                {name: 'isopen',
                    sortType: sortTrans

                },
                {name: 'isnav',
                    sortType: sortTrans

                },
                {name: 'ishot',
                    sortType: sortTrans
                },
                {
                    name: 'istopnav',
                    sortType: sortTrans
                },
                {
                    name: 'iswebsite',
                    sortType: sortTrans
                },
                {
                    name: 'pinyin',
                    sortType: sortPinyin
                },
                {name: 'id', convert: function (v, record) {
                    return 'dest_' + v;
                }},
                'kindname',
                'pid',
                'seotitle',
                'keyword',
                'description',
                'tagword',
                'jieshao',
                'kindtype',
                'isfinishseo',
                'templetpath',
                'litpic',
                'piclist',
                'issel',
                'shownum',
                'templet',
                'weburl'

            ],
            proxy: {
                type: 'ajax',
                extraParams: {typeid: window.display_mode},
                api: {
                    read: SITEURL+'destination/destination/action/read',  //读取数据的URL
                    update: SITEURL+'destination/destination/action/save',
                    destroy: SITEURL+'destination/destination/action/delete'
                },
                reader: 'json'
            },
            autoLoad: true,
            listeners: {
                sort: function (node, childNodes, eOpts) {

                },
                load:function( store, records, successful, eOpts )
                {
                    if(!successful){
                        ST.Util.showMsg("{__('norightmsg')}",5,1000);
                    }


                }
            }

        });

        window.sel_model = Ext.create('Ext.selection.CheckboxModel');

        //目的地panel
        window.dest_treepanel = Ext.create('Ext.tree.Panel', {
            store: dest_store,
            rootVisible: false,
            renderTo: 'dest_tree_panel',
            border: 0,
            style: 'border:0px;',
            width: "100%",
            bodyBorder: 0,
            bodyStyle: 'border-width:0px',
            scroll:'vertical',


            listeners: {
                itemmousedown: function (node, record, item, index, e, eOpts) {
                    var x = e.xy[0];
                    var column_x = Ext.getCmp('dest_name').getX();
                    var column_width = Ext.getCmp('dest_name').getWidth();

                    if (x < column_x || x > column_x + column_width)
                        return false;

                    window.node_moving = true;

                },
                sortchange: function (ct, column, direction, eOpts) {

                    window.sort_direction = direction;

                    var field = column.dataIndex;
                    if (field == 'kindname')
                        field = 'pinyin';
                    window.dest_store.sort(field, direction);

                },
                cellclick: function (view, td, cellIndex, record, tr, rowIndex, e, eOpts) {

                    if (record.get('displayorder') == 'add')
                        return false;
                },
                afterlayout: function (panel) {
                    var data_height = panel.getView().getEl().down('.x-grid-table').getHeight();

                    var height = Ext.dom.Element.getViewportHeight();

                    // console.log(data_height+'---'+height);
                    if (data_height > height - 120) {
                        window.has_biged = true;
                        panel.height = height - 120;
                    }
                    else if (data_height < height - 120) {
                        if (window.has_biged) {
                            delete panel.height;
                            window.has_biged = false;
                            window.dest_treepanel.doLayout();
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
                    displayField: 'kindname'
                },
                listeners: {
                    boxready: function () {

                        var height = Ext.dom.Element.getViewportHeight();

                        this.up('treepanel').maxHeight = height - 120;
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
                        params['moveid'] = params['moveid'].substr(params['moveid'].indexOf('_') + 1);
                        params['overid'] = params['overid'].substr(params['overid'].indexOf('_') + 1);


                        if (dropPosition == 'append') {

                            var btn_node = window.dest_store.getNodeById(params['overid'] + 'add');
                            overModel.insertBefore(data.records[0], btn_node);

                        }

                        //alert(overModel.children);
                        Ext.Ajax.request({
                            url: 'destination/action/drag',
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
                    text: '<span class="grid_column_text">选择</span>'+"{php echo Common::getIco('help',131);}",
                    width: '6%',
                    dataIndex: 'issel',
                    tdCls: 'dest-al-mid',
                    xtype: 'templatecolumn',
                    align: 'center',
                    draggable: false,
                    menuDisabled:true,
                    sortable:false,
                    tpl: new Ext.XTemplate(
                        '{[this.realName(values.id,values.issel)]}',
                        {
                            realName: function (id, issel) {
                                if (id.indexOf('add') > 1)
                                    return '';
                                id = id.substr(id.indexOf('_') + 1);
                                // var ischecked=issel?"checked='checked'":'';
                                return "<input type='checkbox' class='dest_check' value='" + id + "' style='cursor:pointer' onclick='togCheck(" + id + ")'/>";
                            }
                        }
                    )
                },
                {
                    text: '<span class="grid_column_text">排序</span>'+"{php echo Common::getIco('help',132);}",
                    dataIndex: 'displayorder',
                    //  tdCls:'dest-al-mid',
                    align:'center',
                    width: '6%',
                    cls:'sort-col',
                    draggable: false,
                    menuDisabled:true,
                    renderer : function(value, metadata,record) {
                        var id=record.get('id');
                        if (value == 'add')
                            return '';
                        else {
                            if(value=='9999'||value=='999999'||!value)
                               value='';
                            id = id.substr(id.indexOf('_') + 1);
                            return "<input type='text' class='row-edit-txt' onclick=\"prevPopup(event,this)\" onblur=\"updateField(this,"+id+",'displayorder',0,'input')\" value='" + value + "'/>";
                        }
                    }

                },
                {
                    xtype: 'treecolumn',   //有展开按钮的指定为treecolumn
                    text: '<span class="grid_column_text">目的地</span>'+"{php echo Common::getIco('help',133);}",
                    dataIndex: 'kindname',
                    id: 'dest_name',
                    menuDisabled:true,
                    sortable:false,
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
                    width: '38%',
                    renderer : function(value, metadata,record) {
                        var id=record.get('id');
                        id = id.substr(id.indexOf('_') + 1);
                        if(id.indexOf('add')==-1)
                        {
                            //var editHtml="<input type='text' class='row-edit-txt' value='"+value+"'  />";
                            return "<span class='row-editable-sp'>"+value+"</span>"+"&nbsp;&nbsp;<font color='orange'>[id:"+id+"]</font>";

                        }
                        return value;
                    },
                    listeners: {
                        afterrender: function (obj, eopts) {

                            if (window.display_mode != 0) {
                                obj.width = '51%';
                               // dest_treepanel.doLayout()
                            }
                            else {
                                obj.width = '33%';
                               // dest_treepanel.doLayout();
                            }

                        }
                    }
                },
                {
                    text: '<span class="grid_column_text">开启/关闭</span>'+"{php echo Common::getIco('help',134);}",
                    dataIndex: 'isopen',
                    width: '9%',
                    xtype: 'actioncolumn',
                    tdCls: 'dest-al-mid',
                    align: 'center',
                    cls:'sort-col',
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
                                //  var val=record.get('isopen');
                                togStatus(null, record, 'isopen');


                            }
                        }
                    ]
                },
                {
                    text: '<span class="grid_column_text">首页显示</span>'+"{php echo Common::getIco('help',135);}",
                    dataIndex: 'isnav',
                    width: '9%',
                    xtype: 'actioncolumn',
                    tdCls: 'dest-al-mid',
                    align: 'center',
                    border: 0,
                    menuDisabled:true,
                    cls:'sort-col',
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
                                //  var val=record.get('isopen');
                                togStatus(null, record, 'isnav');


                            }
                        }
                    ]
                },
                {
                    text: '<span class="grid_column_text">是否热门</span>'+"{php echo Common::getIco('help',136);}",
                    dataIndex: 'ishot',
                    width: '9%',
                    xtype: 'actioncolumn',
                    tdCls: 'dest-al-mid',
                    align: 'center',
                    cls:'sort-col',
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
                                //  var val=record.get('isopen');
                                togStatus(null, record, 'ishot');


                            }
                        }
                    ]
                },
                {
                    text: '<span class="grid_column_text">智能主导航</span>'+"{php echo Common::getIco('help',137);}",
                    dataIndex: 'istopnav',
                    width: '9%',
                    xtype: 'actioncolumn',
                    tdCls: 'dest-al-mid',
                    align: 'center',
                    menuDisabled:true,
                    cls:'sort-col',
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
                                togStatus(null, record, 'istopnav');
                            }
                        }
                    ],
                    listeners: {
                        afterrender: function (obj, eopts) {

                            if (window.display_mode != 0)
                                obj.hide();
                            else
                                obj.show();
                        }
                    }
                },
                {
                    text: '<span class="grid_column_text">子站</span>',
                    dataIndex: 'iswebsite',
                    width: '9%',
                    xtype: 'actioncolumn',
                    tdCls: 'dest-al-mid',
                    align: 'center',
                    cls:'sort-col',
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
                                togSiteStatus(null, record, 'iswebsite');
                            }
                        }
                    ],
                    listeners: {
                        afterrender: function (obj, eopts) {

                            if (window.display_mode != 0)
                                obj.hide();
                            else
                                obj.show();
                        }
                    }
                },
                {
                    text: '<span class="grid_column_text">管理</span>'+"{php echo Common::getIco('help',138);}",
                    dataIndex: 'id',
                    width: '10%',
                    tdCls: 'dest-al-mid',
                    align: 'center',
                    sortable: false,
                    menuDisabled:true,
                    renderer : function(value, metadata,record) {
                        var id=record.get('id');
                        var pinyin=record.get('pinyin');
                        var iswebsite=record.get('iswebsite');
                        if (id.indexOf('add') > 1)
                            return '';
                        var delhtml = '';
                        if(id != 36 && id!=37)
                        {
                            delhtml = '&nbsp;&nbsp;&nbsp;<a href="javascript:;" class="row-del-btn" title="删除" onclick="delSingle(\''+id+'\',\''+iswebsite+'\')"></a>';
                        }


                        var viewHtml='&nbsp;&nbsp;&nbsp;<a href="javascript:;" title="预览" class="row-view-btn" onclick="viewDest(\''+id+'\')"></a>';
                        return '<a href="javascript:;" title="优化设置" class="row-mod-btn" onclick="destSet(\'' + id + '\')"></a>'+viewHtml+delhtml;
                        // return getExpandableImage(value, metadata,record);
                    },
                    listeners: {
                        afterrender: function (obj, eopts) {

                            if (window.display_mode != 0)
                                obj.hide();
                            else
                                obj.show();
                        }
                    }

                },
                {
                    text: '<span class="grid_column_text">管理</span>',
                    dataIndex: 'id',
                    width: '10%',
                    tdCls: 'dest-al-mid',
                    xtype: 'templatecolumn',
                    sortable: false,
                    align: 'center',
                    border: 0,
                    menuDisabled:true,

                    tpl: new Ext.XTemplate(
                        '{[this.realName(values.id)]}',
                        {
                            realName: function (id) {
                                if (id.indexOf('add') > 1)
                                    return '';
                                var viewHtml=window.display_mode!=11?'&nbsp;&nbsp;&nbsp;<a href="javascript:;" class="row-view-btn" title="预览" onclick="viewDestType(\''+id+'\')"></a>':'';

                                return '<a href="javascript:;" class="row-mod-btn" title="优化设置" onclick="destProductSet(\'' + id + '\')"></a>'+viewHtml;
                            }
                        }
                    ),
                    listeners: {
                        afterrender: function (obj, eopts) {

                            if (window.display_mode != 0)
                                obj.show();
                            else
                                obj.hide();
                        }
                    }

                }
            ],
            plugins: [
                Ext.create('Ext.grid.plugin.CellEditing', {
                    clicksToEdit: 1,
                    listeners: {
                        beforeEdit:function(editor,e){
                            if(window.display_mode!=0 && e.field!='displayorder') //排除非主目的地的编辑
                                return false;
                        },
                        edit: function (editor, e) {

                            var pinyin = e.record.get('pinyin');
                            e.record.save({params: {field: e.field,pinyin:pinyin}});
                            e.record.commit();

                        }
                    }
                })
            ]
        });


    }
);

function setWeb(result,bool)
{

    var id=result.id;

    var record= dest_store.getNodeById(id);


    var weburl=result.weburl;
    Ext.Ajax.request({
        url: "destination/action/update",
        method: "POST",
        datatype: "JSON",
        params: {id: id, field: 'weburl', val: weburl, typeid: window.display_mode},
        success: function (response, opts) {
            if (response.responseText == 'ok') {
                ST.Util.showMsg('开启子站成功!','4',2000);
                togStatus(null,record,'iswebsite');
                addsite(id);//添加站点默认数据.
            }else if(response.responseText =='py_repeat'){
                ST.Util.showMsg('子站拼音重复,子站开启失败',5,1000);
            }else{
                ST.Util.showMsg('开启子站失败!','1',2000);
            }
        }
    });

}
//开关子站功能
function togSiteStatus(obj, record, field) {

    var val = record.get(field);
    var id = record.get('id');

   /* var domsiteurl = document.domain;
    var urlarr = domsiteurl.split('.');
    if(urlarr.length == 3){
        domsiteurl = urlarr[1]+'.'+urlarr[2];
    }
    domsiteurl = 'http://'+record.get('pinyin')+'.'+domsiteurl;
    */
    id = id.substr(id.indexOf('_') + 1);
    var pinyin=record.get('pinyin');
    var newval = val == 1 ? 0 : 1;
    if(newval==1)
        ST.Util.showBox('子站开启',SITEURL+'destination/dialog_setweb?id='+id+'&pinyin='+pinyin,500,'',null,null,document,{loadWindow:window,loadCallback:setWeb});
    else
    {
        ST.Util.confirmBox("提示","关闭子站功能,当前子站的导航等配置将会删除，确认关闭？",function() {
            togStatus(obj, record, field);
            cancelSite(id);
        })
    }

}

function togStatus(obj, record, field) {

    var val = record.get(field);
    var id = record.get('id');
    id = id.substr(id.indexOf('_') + 1);
    var newval = val == 1 ? 0 : 1;
    Ext.Ajax.request({
        url: "destination/action/update",
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
function updateField(ele,id,field,val,type)
{
    if(type=='input')
       val=$(ele).val();

    Ext.Ajax.request({
        url: "destination/action/update",
        method: "POST",
        datatype: "JSON",
        params: {id: id, field: field, val: val, typeid: window.display_mode},
        success: function (response, opts) {
            if (response.responseText == 'ok') {
                record.set(field, val);
                record.commit();
            }
        }});
}



function setProductInfo(result,bool)
{
    if(!bool)
      return;
    var id=result.id;
    var typeid=result.typeid;
    var record = dest_store.getNodeById(id);
    for(var i in result.data)
    {
        var val=result.data[i];
        record.set(i,val);
    }
    record.save({extraParams:{typeid:typeid},callback: function (records, operation, success) {
        if (success) {
            ST.Util.showMsg("修改成功",4);
        }
        else {
            ST.Util.showMsg("修改失败",5);
        }
    }});



}
function destProductSet(dest_id) {
    var id = dest_id.substr(dest_id.indexOf('_') + 1);
    //var record = window.dest_store.getNodeById(id);
    ST.Util.showBox('设置',SITEURL+'destination/dialog_productinfo?id='+id+"&typeid="+display_mode,600,'',null,null,document,{loadCallback:setProductInfo,loadWindow:window});

}
function setInfo(result,bool)
{
    console.log(result.data);
    if(!bool)
      return;
    var id=result.id;
    var record = dest_store.getNodeById(id);

    for(var i in result.data)
    {
        var val=result.data[i];
        record.set(i,val);
    }
    record.save({callback: function (records, operation, success) {
        var hint = null;
        if (success) {
            ST.Util.showMsg("修改成功",4);
        }
        else {
            ST.Util.showMsg("修改失败",5);
        }

    }});

}
function destSet(dest_id) {

    var id=dest_id.replace('dest_','');
    ST.Util.showBox('设置',SITEURL+'destination/dialog_basicinfo?id='+id,600,'',null,null,document,{loadCallback:setInfo,loadWindow:window});
}
//设置模板
function setTemplet(obj,destid)
{
    var templet = $(obj).attr('data-value');
    $(obj).addClass('on').siblings().removeClass('on');
    $("#templet_"+destid).val(templet);

}

function addSub(pid) {
    var precord = pid == 0 ? window.dest_store.getRootNode() : window.dest_store.getNodeById(pid);
    var addnode = window.dest_store.getNodeById(pid + 'add');

    Ext.Ajax.request({
        method: 'post',
        url: 'destination/action/addsub',
        params: {pid: pid},
        success: function (response) {
            var newrecord = Ext.decode(response.responseText);

            var view_el = window.dest_treepanel.getView().getEl()
            var scroll_top = view_el.getScrollTop();

            precord.insertBefore(newrecord, addnode);

            //view_el.scroll('t',scroll_top);
        }
    });

}


Ext.getBody().on('mouseup', function () {
    window.node_moving = false;

    //console.log('up_'+window.node_moving);
});
Ext.getBody().on('mousemove', function (e, t, eOpts) {

    if (window.node_moving == true) {
        // console.log('mov_'+window.node_moving);

        var tree_view = window.dest_treepanel.down('treeview');
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
    var data_height = window.dest_treepanel.getView().getEl().down('.x-grid-table').getHeight();
    if (data_height > height - 120)
        window.dest_treepanel.height = (height - 120);
    else
        delete window.dest_treepanel.height;
    window.dest_treepanel.doLayout();
})

function cascadeDest(dest, index) {
    if (dest.length == 1) {
        var node = window.dest_store.getNodeById(dest[0]);
        var ele = window.dest_treepanel.getView().getNode(node);
        if (ele) {

            var edom = Ext.get(ele);
            edom.addCls('search-dest-tr');
            if (index == 0)
                viewScroll(edom);
        }
    }
    else {
        var node = window.dest_store.getNodeById(dest[0]);
        dest.shift();
        node.expand(false, function () {
            cascadeDest(dest, index);
        });

    }
}
function viewScroll(extdom)   //在treeview里滚动
{
    var tree_view = window.dest_treepanel.getView();
    var view_y = tree_view.getY();
    var dom_y = extdom.getY();


    window.setTimeout(function () {
        window.first_scroll = true;
        extdom.scrollIntoView(tree_view.getEl());
    }, 450);
    //else
    // extdom.scrollIntoView(tree_view.getEl());


}
function togCheck(id) {


    /* var check_arr=Ext.query('.dest_check[checked]');

     var del_btn=Ext.ComponentQuery.query("#dest_del_btn")[0];

     if(check_arr.length>0)
     {
     del_btn.enable();
     }
     else
     del_btn.disable();
     */

}
function chooseAll() {
    var check_cmp = Ext.query('.dest_check');
    for (var i in check_cmp) {
        if (!Ext.get(check_cmp[i]).getAttribute('checked'))
            check_cmp[i].click();
    }

    //  window.sel_model.selectAll();
}
function chooseDiff() {
    var check_cmp = Ext.query('.dest_check');
    for (var i in check_cmp)
        check_cmp[i].click();
    //var records=window.sel_model.getSelection();
    //window.sel_model.selectAll(true);

    //	window.sel_model.deselect(records,true);

    //var
}
function delDest() {

    var check_cmp = Ext.select('.dest_check:checked');
    if(check_cmp.getCount()==0)
    {
        ST.Util.showMsg("请选择至少一条数据",5);
        return;
    }

    ST.Util.confirmBox("提示","确定删除？",function(){

        check_cmp.each(
            function (el, c, index) {

                window.dest_store.getNodeById(el.getValue()).destroy();

            }
        );
    });

}
function searchDest() {

    var s_str = Ext.get('searchkey').getValue();
    //s_str=s_str.trim();
    Ext.select('.search-dest-tr').removeCls('search-dest-tr');

    if (!s_str)
        return;
    Ext.Ajax.request({
        url: 'destination/action/search',
        params: {keyword: s_str},
        method: 'POST',
        success: function (response) {


            var text = response.responseText;
            if (text == 'no') {
                ST.Util.showMsg('未找到与'+s_str+'相关的目的地',5,1000);
                //Ext.Msg.alert('查询结果', "未找到与'" + s_str + "'相关的目的地");
            } else {
                var list = Ext.decode(text);
                var index = 0;
                for (var i in list) {

                    var dest = list[i];
                    cascadeDest(dest, index);
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

        if (val == 'add') {
            if (window.sort_direction == 'ASC')
                return 100000000000000000;
            else
                return -10;
        }
        else
            return window.parseInt(val);
    }
    // alert(val);
}
function sortPinyin(val) {

    if (!window.sort_direction)
        return val;
    else {
        if (val == 'add') {
            if (window.sort_direction == 'ASC')
                return 1000000000000;
            else
                return 1;
        }
        else {
            if (!val)
                return 555555555555;
            else {
                val.toLowerCase();
                var num1 = val.charCodeAt(0);
                var num2 = val.charCodeAt(1);
                if (isNaN(num2))
                    num2 = '000';
                if (num2 < 100)
                    num2 = '0' + num2;

                var num3 = val.charCodeAt(2);
                if (isNaN(num3))
                    num3 = '000';
                if (num3 < 100)
                    num3 = '0' + num3;

                var num4 = val.charCodeAt(3);
                if (isNaN(num4))
                    num4 = '000';
                if (num4 < 100)
                    num4 = '0' + num4;

                var result = window.parseInt(num1 + '' + num2 + '' + num3 + '' + num4);

               // console.log(val + '_' + result);
                return result;
            }
        }
    }
}


//模块列表
var model_list = {
    mod_1: '线路',
    mod_2: '酒店',
    mod_3: '租车',
    mod_4: '攻略',
    mod_5: '景点',
    mod_6: '相册',
    mod_13: '团购'
}
//切换模块
function togMod(obj, num,title) {
    window.display_mode = num;
    Ext.get(obj).parent().select("a.on").removeCls('on');
    Ext.get(obj).addCls('on');
    for (var i in window.dest_treepanel.columns) {
        window.dest_treepanel.columns[i].fireEvent('afterrender', window.dest_treepanel.columns[i]);
    }
    window.dest_store.getProxy().setExtraParam('typeid', num);
    window.dest_store.load();
    $("#position").html(title);
    if(num!=0)
    {
        $(".panel_bar").hide();
        $(".dest_check").hide();

    }
    else
    {
        $(".panel_bar").show();
        $(".dest_check").show();
    }


}
//删除目的地
function delSingle(id,iswebsite)
{

    if(iswebsite==1){
        ST.Util.showMsg('当前目的地已经设置成子站,不能删除!',5);
        return;
    }
    id = id.substr(id.indexOf('_') + 1);
    ST.Util.confirmBox("提示","当前目的地和下级目的地都将被删除,确定删除吗？",function(){
            window.dest_store.getById(id.toString()).destroy();
    })
}
//取消子站
function cancelSite(id)
{
    var siteid = id.substr(id.indexOf('_') + 1);
    $.post(SITEURL+'destination/cancelsite/siteid/'+siteid);
}
//设置站点成功,添加默认导航数据
function addsite(siteid)
{
    $.post(SITEURL+'destination/addsite/siteid/'+siteid);
}
function viewDest(id)
{
    id = id.substr(id.indexOf('_') + 1);
    var record= dest_store.getNodeById(id);
    var name=record.get('kindname');
    var iswebsite=record.get('iswebsite');
    var weburl=record.get('weburl');
    var pinyin=record.get('pinyin');
    if(iswebsite==1)
    {
        window.open(weburl);
    }
    else
    {
        if(!pinyin)
        {
            ST.Util.showMsg('请选填写目的地拼音',5);
            return;
        }
        window.open(BASEHOST+'/'+pinyin);
    }

}
function viewDestType(id){
    id = id.substr(id.indexOf('_') + 1);
    var record= dest_store.getNodeById(id);
    var pinyin=record.get('pinyin');

    for(var i in typeModule)
    {
        if(i==window.display_mode)
        {
            var url=BASEHOST+'/'+typeModule[i].replace('{dest}',pinyin);
            window.open(url);
            return;
        }
    }

    for(var i in otherModule)
    {
        var row=otherModule[i];
        if(row['id']==window.display_mode)
        {
            var url=BASEHOST+'/'+row['pinyin']+'/'+pinyin;
            window.open(url);
            return;
        }
    }


}
function prevPopup(e,ele) {
    var evt = e ? e : window.event;
    if (evt.stopPropagation) {
        evt.stopPropagation();
    }
    else {

        evt.cancelBubble = true;
    }
}
</script>



</body>
</html>
<script type="text/javascript" src="http://update.souxw.com/service/api_V3.ashx?action=releasefeedback&ProductName=%E6%80%9D%E9%80%94CMS4.1&Version=4.1.201507.3102&DomainName=&ServerIP=unknown&SerialNumber=15109625" ></script>
