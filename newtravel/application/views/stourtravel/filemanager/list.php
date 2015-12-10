<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>文件浏览器-思途CMS3.0</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css,base2.css,plist.css'); }
    {php echo Common::getScript("jquery.upload.js"); }


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

        </td>
    </tr>
</table>
<script>

    var issline="{$issline}";

Ext.onReady(
    function () {
        //store


        var helpico = "{php echo Common::getIco('help');}";

        Ext.tip.QuickTipManager.init();
        window.attr_store = Ext.create('Ext.data.TreeStore', {
            fields: [

                'id',
                'text',
                'ext'
            ],

            proxy: {
                type: 'ajax',
                extraParams: {folder: '{$folder}',issline:issline},
                api: {
                    read: SITEURL+'filemanager/index/action/read/',  //读取数据的URL
                    update:  SITEURL+'filemanager/index/action/save/',
                    destroy:  SITEURL+'filemanager/index/action/delete/'
                },
                reader: 'json',
                listeners:{
                    metachange:function(){
                        alert('here');
                    }
                }
            },
            autoLoad: true,
            listeners: {
                sort: function (node, childNodes, eOpts) {

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
            width: "99%",
            bodyBorder: 0,
            bodyStyle: 'border-width:0px',
            // selModel:sel_model,
            autoScroll: true,

            listeners: {



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
                    text: '<span class="grid_column_text">文件名称</span>'+helpico,
                    dataIndex: 'text',
                    id: 'attr_name',
                    sortable:false,
                    locked: false,
                    width: '70%',
                    renderer : function(value, metadata,record) {
                        var id=record.get('id');
                        if(id.indexOf('add')==-1)
                        {
                            return value;

                        }
                        return value;
                    }
                },
                {
                    text: '<span class="grid_column_text">管理</span>'+helpico,
                    width: '20%',
                    sortable:false,
                    align:'center',
                    tdCls: 'attr-al-mid',
                    renderer : function(value, metadata,record) {
                        var id=record.get('id');


                        var ext = record.get('ext');

                        //var ext = reocrd.get('ext');

                        var extarr= ['htm','html','php','css','js'];


                        //是否显示
                        if(id.indexOf('add')!=-1 || $.inArray(ext,extarr)==-1) return '';



                        return '<a href="javascript:;" class="row-mod-btn" onclick="pageedit(\''+id+'\',\''+ext+'\')"></a>';
                    }
                }

            ]



        });


    }
);



Ext.EventManager.onWindowResize(function () {
    var height = Ext.dom.Element.getViewportHeight();
    var data_height = window.attr_treepanel.getView().getEl().down('.x-grid-table').getHeight();
    if (data_height > height - 100)
        window.attr_treepanel.height = (height - 100);
    else
        delete window.attr_treepanel.height;
    window.attr_treepanel.doLayout();
})


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

//上传
function uploadFile(obj,path) {

        // 上传方法
        $.upload({
            // 上传地址
            url: SITEURL+'uploader/uploadotherfile',
            // 文件域名字
            fileName: 'filedata',
            // 其他表单数据
            params: {path: path},
            // 上传完成后, 返回json, text
            dataType: 'json',
            // 上传之前回调,return true表示可继续上传
            onSend: function() {
                return true;
            },
            // 上传之后回调
            onComplate: function(data) {

                if(path.split('/').length>1){
                    var precord = window.attr_store.getNodeById(path);
                }
                else{
                    var precord = window.attr_store.getRootNode();
                }


                var addnode = window.attr_store.getNodeById(path + 'add');
                var newrecord = Ext.decode(data);
                precord.insertBefore(newrecord, addnode);

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
        url   :  SITEURL+"templet/index/action/update/",
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

//页面编辑
function pageedit(id,ext)
{
    /*var record=window.attr_store.getNodeById(id.toString());
    var litpic=record.get('litpic');
    var description=record.get('description');
    var attrname=record.get('attrname');
    description=description?description:'';*/
    var file = encodeURIComponent(id);

    var boxurl = SITEURL+'filemanager/pageedit/?file='+file+'&ext='+ext+'&issline='+issline;
    ST.Util.showBox('页面编辑',boxurl,'900','600',function(){ });


}

</script>
</body>
</html>
