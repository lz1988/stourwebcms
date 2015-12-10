<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>模块页面配置-思途CMS3.0</title>
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


            <div class="cfg-head-top">
                <table class="cfg-head-tb">
                    <tr><td>
                            {template 'stourtravel/public/weblist'}
                        </td>
                        <td>
                            <a href="javascript:;" class="refresh-btn" onclick="window.location.reload()">刷新</a>
                        </td>
                    </tr>
                </table>
            </div>


            <div id="line_grid_panel" class="content-nrt">


                <div id="attr_tree_panel" class="content-nrt"  style="border-bottom: 2px solid #008ED8">

                </div>
                <div class="panel_bar">

                </div>
        </td>
    </tr>
</table>
<input type="hidden" id="webid" value="{$webid}"/>
<script>


Ext.onReady(
    function () {
        //store

        $(".isattr").addClass('on');
        var helpico = "{php echo Common::getIco('help');}";

        Ext.tip.QuickTipManager.init();
        window.attr_store = Ext.create('Ext.data.TreeStore', {
            fields: [

                'id',
                'pid',
                'kindname',
                'templet'

            ],

            proxy: {
                type: 'ajax',
                extraParams: {typeid: 1},
                api: {
                    read: SITEURL+'sitetemplet/index/action/read/site/{$webid}',  //读取数据的URL
                    update:  SITEURL+'sitetemplet/index/action/save/site/{$webid}',
                    destroy:  SITEURL+'sitetemplet/index/action/delete/site/{$webid}'
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
            scroll:'vertical',



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
                    text: '<span class="grid_column_text">模块名称</span>'+helpico,
                    dataIndex: 'kindname',
                    id: 'attr_name',
                    sortable:false,
                    locked: false,
                    width: '74%',
                    editor: 'textfield',
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
                    text: '<span class="grid_column_text">当前使用</span>'+helpico,
                    width: '15%',
                    dataIndex:'templet',
                    sortable:false,
                    align:'center',
                    tdCls: 'attr-al-mid',
                    renderer : function(value, metadata,record) {
                        return value;
                    }
                },



                {
                    text: '<span class="grid_column_text">管理</span>'+helpico,
                    width: '11%',
                    sortable:false,
                    tdCls: 'attr-al-mid',
                    align:'center',
                    renderer : function(value, metadata,record) {
                        var id=record.get('id');
                        var pid = record.get('pid');
                        /*var html = '<a href="'+SITEURL+'filemanager/index/folder/guangdong/'+'" >文件浏览</a>';*/
                        if(id.indexOf('add')!=-1 || pid=='0') return '';

                        return '<a href="javascript:;" class="row-mod-btn" onclick="config('+id+')"></a>';
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

function addSub(pid) {
    var precord = pid == 0 ? window.attr_store.getRootNode() : window.attr_store.getNodeById(pid);
    var addnode = window.attr_store.getNodeById(pid + 'add');

    Ext.Ajax.request({
        method: 'post',
        url: SITEURL+'sitetemplet/index/action/addsub/site/{$webid}/',
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
        url   :  SITEURL+"sitetemplet/index/action/update/site/{$webid}/",
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


function config(id)
{
    /*var record=window.attr_store.getNodeById(id.toString());
    var litpic=record.get('litpic');
    var description=record.get('description');
    var attrname=record.get('attrname');
    description=description?description:'';*/

    var boxurl = SITEURL+'sitetemplet/config/webid/{$webid}/pageid/'+id;
    ST.Util.showBox('模板配置',boxurl,'580','400',function(){ },0);


}
$(function(){

    //子站切换点击
    var webid = $("#webid").val();
    $(".web-set").find('a').each(function(i,obj){
           var siteid = $(obj).attr('data-webid');
           if(webid == siteid){
               $(this).addClass('on').siblings().removeClass('on');
           }
           $(obj).click(function(){
               var webid = $(this).attr('data-webid');
               var webname =$(this).html();
               if(webid!=0){
                   var url = 'sitetemplet/index/site/'+webid+'/parentkey/templet/itemid/1';
                   ST.Util.addTab(webname,url);
               }else{
                   var url = 'templet/index/parentkey/templet/itemid/1';
                   ST.Util.addTab(webname,url);
               }

           })
    })



})
</script>
</body>
</html>
<script type="text/javascript" src="http://update.souxw.com/service/api_V3.ashx?action=releasefeedback&ProductName=%E6%80%9D%E9%80%94CMS4.1&Version=4.1.201507.1501&DomainName=&ServerIP=unknown&SerialNumber=15109625" ></script>
