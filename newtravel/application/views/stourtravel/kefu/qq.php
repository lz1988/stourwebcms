<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>客服电话设置</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css,jqtransform.css,plist.css'); }
    {php echo Common::getScript('config.js');}


</head>
<style>
    .jqTransformRadioWrapper{
        float: left;
        display: block;
        margin: 0px 4px;
        margin-top: 10px;
    }
    .jqTransformInputWrapper {

        height: 31px;
        padding: 0px;
        float: left;
        margin-left: 5px;
</style>
<body>
<table class="content-tab">
    <tr>
        <td width="119px" class="content-lt-td"  valign="top">
            {template 'stourtravel/public/leftnav'}
            <!--右侧内容区-->
        </td>
        <td valign="top" class="content-rt-td">

                    <form id="frm" name="frm" onsubmit="return false;">
                        <div class="w-set-con">
                            <div class="w-set-tit bom-arrow">
                                {template 'stourtravel/kefu/kind_top'}
                                <a href="javascript:;" class="refresh-btn" onclick="window.location.reload()">刷新</a>
                            </div>
                            <div class="w-set-nr">
                                <div id="qq_tree_panel" class="content-nrt">

                                </div>
                                <div class="product-add-div">

                                    <div class="add-class">
                                        <dl>
                                            <dt>是否开启：</dt>
                                            <dd>

                                                    <div class="on-off">
                                                        <input type="radio" id="" name="display" value="1" {if $display=='1'}checked="checked"{/if}>
                                                        <label>开启</label>
                                                        <input type="radio" id="" name="display" value="0" {if  $display=='0'}checked="checked"{/if}>
                                                        <label>关闭</label>
                                                    </div>

                                            </dd>
                                        </dl>
                                        <dl>
                                            <dt>显示位置：</dt>
                                            <dd>

                                                    <div class="on-off">
                                                        <input type="radio"  name="position" value="left" {if $pos=='left'}checked="checked"{/if}>
                                                        <label>居左显示</label>
                                                        <input type="radio" name="position" value="right" {if $pos=='right'}checked="checked"{/if}>
                                                        <label>居右显示</label>
                                                    </div>

                                            </dd>
                                        </dl>

                                        <dl>
                                            <dt>边距设置：</dt>
                                            <dd>
                                                <div class="fl mr-30">
                                                    <span class="fl ml-5">左/右边距</span>&nbsp;&nbsp;<input type="text" style="margin-left: 5px;" name="posh" class="set-text-xh text_60 mt-2 ml-10" value="{$posh}">
                                                    <div class="help-ico mt-10 ml-5"></div>
                                                </div>
                                                <div class="fl">
                                                    <span class="fl">上边距</span>&nbsp;&nbsp;<input type="text" style="" name="post" value="{$post}" class="set-text-xh text_60 mt-2 ml-10">
                                                    <div class="help-ico mt-10 ml-5"></div>
                                                </div>
                                            </dd>
                                        </dl>
                                        <dl>
                                            <dt>客服电话：</dt>
                                            <dd>
                                                <div class="fl mr-30">
                                                    <span class="fl ml-5"></span>&nbsp;&nbsp;<input type="text" style="margin-left: 5px;" name="phonenum" class="set-text-xh text_300 mt-2 ml-10" value="{$phonenum}">
                                                    <div class="help-ico mt-10 ml-5"></div>
                                                </div>

                                            </dd>
                                        </dl>

                                        <dl>
                                            <dt>客服模版：</dt>
                                            <dd style="width: 790px;">

                                                    <ul class="kf-temp">
                                                        <li>
                                                            <p class="p1"><img src="{$GLOBALS['cfg_public_url']}/images/kf1.jpg" width="160" height="160" ></p>
                                                            <p class="p2">
                                                                <input type="radio" name="qqcl" value="1" {if $qqcl=='1'}checked="checked"{/if}>
                                                                <label>客服模版1</label>
                                                            </p>
                                                        </li>
                                                        <li>
                                                            <p class="p1"><img src="{$GLOBALS['cfg_public_url']}/images/kf2.jpg" width="140" height="180" ></p>
                                                            <p class="p2">
                                                                <input type="radio" name="qqcl" value="2" {if $qqcl=='2'}checked="checked"{/if}>
                                                                <label>客服模版2</label>
                                                            </p>
                                                        </li>
                                                       <li>
                                                            <p class="p1"><img src="{$GLOBALS['cfg_public_url']}/images/kf3.jpg" width="150" height="180" ></p>
                                                            <p class="p2">
                                                                <input type="radio" name="qqcl" value="3" {if $qqcl=='3'}checked="checked"{/if}>
                                                                <label>客服模版3</label>
                                                            </p>
                                                        </li>
                                                        <!--<li>
                                                            <p class="p1"><img src="../images/pic/test01.jpg" width="160" height="180" ></p>
                                                            <p class="p2">
                                                                <input type="radio" name="qqcl" value="4" {if $qqcl=='4'}checked="checked"{/if}>
                                                                <label>客服模版4</label>
                                                            </p>
                                                        </li>-->
                                                    </ul>

                                            </dd>
                                        </dl>

                                    </div>

                                </div>
                                <div class="opn-btn">
                                    <a class="normal-btn" href="javascript:;" id="btn_save">保存</a>
                                    <!-- <a class="cancel" href="#">取消</a>-->
                                    <input type="hidden" name="webid" id="webid" value="0">
                                </div>

                            </div>
                        </div>
                    </form>

        </td>
    </tr>
</table>



<script>

    $(document).ready(function(){

        //选中分类
        $(".w-set-tit").find('span').eq(1).addClass('on');
        //配置信息保存
        $("#btn_save").click(function(){
            Ext.Ajax.request({
                url   :  SITEURL+"kefu/ajax_save",
                method  :  "POST",
                isUpload :  true,
                form  : "frm",
                success  :  function(response, opts)
                {

                    var data = $.parseJSON(response.responseText);
                    if(data.status)
                    {


                        ST.Util.showMsg('保存成功!','4',2000);


                    }


                }});

        })





    });


    Ext.onReady(
        function () {
            //store

            //选中分类
            $(".w-set-tit").find('span').eq(1).addClass('on');
            var helpico = "{php echo Common::getIco('help');}";

            Ext.tip.QuickTipManager.init();
            window.attr_store = Ext.create('Ext.data.TreeStore', {
                fields: [

                    'id',
                    'qqname',
                    'qqnum',
                    'isopen',
                    'displayorder',
                    'pid'

                ],
                proxy: {
                    type: 'ajax',
                    extraParams: {typeid: window.display_mode},
                    api: {
                        read: SITEURL+'kefu/qqlist/action/read/',  //读取数据的URL
                        update:  SITEURL+'kefu/qqlist/action/save/',
                        destroy:  SITEURL+'kefu/qqlist/action/delete/'
                    },
                    reader: 'json'
                },
                autoLoad: true,
                listeners: {
                    sort: function (node, childNodes, eOpts) {

                    }
                }

            });

            //属性树
            window.attr_treepanel = Ext.create('Ext.tree.Panel', {
                store: attr_store,
                rootVisible: false,
                padding: '2px',
                renderTo: 'qq_tree_panel',
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

                        if (data_height > height - 100) {
                            window.has_biged = true;
                            panel.height = height - 100;
                        }
                        else if (data_height < height - 100) {
                            if (window.has_biged) {

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
                        text: '<span class="grid_column_text">排序</span>'+helpico,
                        dataIndex: 'displayorder',
                        //  tdCls:'attr-al-mid',
                        width: '5%',
                        draggable: false,
                        renderer : function(value, metadata,record) {
                            var id=record.get('id');
                            if (value == 'add')
                                return '';
                            else {
                                if(value=='9999'||value=='999999'||!value)
                                    value='';
                                return "<input type='text' class='row-edit-txt' onclick=\"ST.Util.prevPopup(event,this)\" onblur=\"updateField(this,"+id+",'displayorder',0,'input')\" value='" + value + "'/>";
                            }
                        }

                    },
                    {
                        xtype: 'treecolumn',   //有展开按钮的指定为treecolumn
                        text: '<span class="grid_column_text">组名/QQ</span>'+helpico,
                        dataIndex: 'qqname',
                        id: 'attr_name',
                        sortable:false,
                        locked: false,
                        width: '26%',
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
                        renderer : function(value, metadata,record) {
                            var id=record.get('id');
                            if(id.indexOf('add')==-1)
                            {
                                //var editHtml="<input type='text' class='row-edit-txt' value='"+value+"'  />";
                                return "<span class='row-editable-sp'>"+value+"</span>";

                            }
                            return value;

                        }
                    },
                    {
                        text: '<span class="grid_column_text">qq号码</span>'+helpico,
                        dataIndex: 'qqnum',
                        //  tdCls:'attr-al-mid',
                        width: '20%',
                        sortable:false,
                        renderer : function(value, metadata,record) {
                            var id=record.get('id');
                            var pid=record.get('pid');
                            if(id.indexOf('add')==-1&&pid!=0)
                            {
                                return '<input type="text" class="row-edit-txt" style="text-align:left" onclick=\"ST.Util.prevPopup(event,this)\" onblur=\"updateField(this,'+id+',\'qqnum\',0,\'input\')\" value="'+value+'"/>';
                            }
                            return value;
                        }

                    },


                    {
                        text: '<span class="grid_column_text">开启/关闭</span>'+helpico,
                        dataIndex: 'isopen',
                        width: '10%',
                        xtype: 'actioncolumn',
                        tdCls: 'attr-al-mid',
                        sortable:false,
                        align:'center',

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
                                    var id=record.get('id');
                                    var val=record.get('isopen');
                                    var newval=val==1?0:1;
                                    updateField(null,id, 'isopen',newval);


                                }
                            }
                        ],
                        renderer : function(value, metadata,record) {
                            var id=record.get('id');
                            if(id.indexOf('add')!=-1)
                                return '';
                        }
                    },
                    {
                        text: '<span class="grid_column_text">管理</span>'+helpico,
                        width: '10%',
                        tdCls: 'attr-al-mid',
                        align:'center',
                        renderer : function(value, metadata,record) {
                            var id=record.get('id');
                            var pid = record.get('pid');
                            if(id.indexOf('add')!=-1 || pid=='0')
                                return '';
                            return '<a href="javascript:;" class="row-del-btn" onclick="delS('+id+')"></a>';
                        }
                    }
                ],
                plugins: [
                    Ext.create('Ext.grid.plugin.CellEditing', {
                        clicksToEdit: 1,
                        listeners: {
                            edit: function (editor, e) {

                                e.record.commit();
                                e.record.save({params: {field: e.field}});

                            },
                            beforeEdit:function(editor,e){
                                var id=e.record.get('id');
                                if(id.indexOf('add')!=-1)
                                    return false;

                            }
                        }
                    })
                ]
            });


        }
    );


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
            url: SITEURL+'kefu/qqlist/action/addsub/',
            params: {pid: pid},
            success: function (response) {

                var newrecord = Ext.decode(response.responseText);
                if(pid==0)
                {
                    newrecord.leaf=false;
                }
                else
                {
                    newrecord.leaf=true;
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
        if(type=='select'|| type=='input')
        {
            value=Ext.get(ele).getValue();
        }


        Ext.Ajax.request({
            url   :  SITEURL+"kefu/qqlist/action/update/",
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
    function delS(id) {
        ST.Util.confirmBox("提示","确定删除？",function(){
                window.attr_store.getById(id.toString()).destroy();
        })
    }




</script>

</body>
</html>
