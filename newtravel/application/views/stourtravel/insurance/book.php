<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>问答管理-思途CMS3.0</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css,base2.css,plist.css'); }
    {php echo Common::getCss('ext-theme-neptune-all-debug.css','js/extjs/resources/ext-theme-neptune/'); }
    {php echo Common::getScript("jquery.buttonbox.js,choose.js"); }


</head>
<style>
    /*搜索*/

</style>
<body style="overflow:hidden">
<table class="content-tab">
    <tr>
        <td width="119px" class="content-lt-td" valign="top">
            {template 'stourtravel/public/leftnav'}
            <!--右侧内容区-->
        </td>
        <td valign="top" class="content-rt-td" style="overflow:hidden">

            <div class="crumbs" id="dest_crumbs">
                <label>位置：</label>
                首页
                &gt; 保险
                &gt; <span>保险订单</span>

            </div>
            <div class="add_menu-btn" style="border: none">

            </div>



            <div class="search-bar filter" id="search_bar" style="margin-top: 40px">
                <span class="tit ml-10">筛选</span>
                <div class="pro-search ml-10 fl mt-4">

                    <input type="text" id="searchkey" value=""  class="sty-txt1 set-text-xh wid_150"/>
                    <select id="searchfield" class="set-text-xh sty-txt1"><option value="ordersn">订单号</option><option value="bookordersn">所属产品订单号</option><option value="memberaccount">会员账号</option></select>
                    <input type="button" value="搜索" class="sty-btn1 default-btn wid_60 mt-1" onclick="goSearchField()" >
                </div>

            </div>
            <div id="product_grid_panel" class="content-nrt">

            </div>
        </td>
    </tr>
</table>
<script>

    window.display_mode = 1;	//默认显示模式
    window.product_kindid = 0;  //默认目的地ID

    var editico = "{php echo Common::getIco('order');}";
    var unviewico="{php echo Common::getIco('order_unview');}";

    Ext.onReady(
        function () {
            Ext.tip.QuickTipManager.init();

            //产品store
            window.product_store = Ext.create('Ext.data.Store', {

                fields: [
                    'id',
                    'ordersn',
                    'productcode',
                    'productcasename',
                    'title',
                    'bookordersn',
                    'memberid',
                    'memberaccount',
                    'insurednum',
                    'price',
                    'applicationdate',
                    'begindate',
                    'enddate',
                    'destination',
                    'trippurposeid',
                    'visacity',
                    'addtime',
                    'modtime',
                    'status',
                    'payedtime',
                    'viewstatus'
                ],

                proxy: {
                    type: 'ajax',
                    api: {
                        read: SITEURL+'insurance/book/action/read',  //读取数据的URL
                        update: SITEURL+'insurance/book/action/save',
                        destroy: SITEURL+'insurance/book/action/delete'
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
                    load: function (store, records, successful, eOpts) {
                        if(!successful){
                            ST.Util.showMsg("{__('norightmsg')}",5,1000);
                        }
                    }
                }

            });

            //产品列表
            window.product_grid = Ext.create('Ext.grid.Panel', {
                store: product_store,
                padding: '2px',
                renderTo: 'product_grid_panel',
                border: 0,
                width: "100%",
                bodyBorder: 0,
                bodyStyle: 'border-width:0px',
                scroll:'vertical', //只要垂直滚动条
                bbar: Ext.create('Ext.toolbar.Paging', {
                    store: product_store,  //这个和grid用的store一样
                    displayInfo: true,
                    emptyMsg: "",
                    items: [
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
                                select: changeNum
                            }
                        }

                    ],
                    listeners: {
                        single: true,
                        render: function (bar) {
                            var items = this.items;
                            bar.down('tbfill').hide();
                            bar.insert(0,Ext.create('Ext.panel.Panel',{border:0,html:'<div class="panel_bar"><a class="abtn" href="javascript:void(0);" onclick="CHOOSE.chooseAll()">全选</a><a class="abtn" href="javascript:void(0);" onclick="CHOOSE.chooseDiff()">反选</a><a class="abtn" href="javascript:void(0);" onclick="CHOOSE.delMore()">删除</a></div>'}));



                            bar.insert(1, Ext.create('Ext.toolbar.Fill'));
                            //items.add(Ext.create('Ext.toolbar.Fill'));
                        }
                    }
                }),
                columns: [
                    {
                        text:'选择',
                        width:'3%',
                        tdCls:'line-ch',
                        align:'center',
                        dataIndex:'id',
                        sortable:false,
                        border:0,
                        renderer : function(value, metadata,record) {
                               id=record.get('id');
                                return  "<input type='checkbox' class='product_check' style='cursor:pointer' value='"+value+"'/>";
                        }
                    },
                    {
                        text: '订单号',
                        width: '10%',
                        dataIndex: 'ordersn',
                        align: 'left',
                        border: 0,
                        sortable: false,
                        renderer : function(value, metadata,record) {
                            var id=record.get('id');
                            return  "<a href='javascript:;' style='color:green' onclick=\"editBook("+id+",'"+value+"')\">"+value+"</a>";
                        }
                    },
                    {
                        text: '所属线路订单号',
                        width: '10%',
                        dataIndex: 'bookordersn',
                        align: 'left',
                        border: 0,
                        sortable: false,
                        renderer : function(value, metadata,record) {
                           return value;
                        }
                    },
                    {
                        text: '保险方案名称',
                        width: '12%',
                        dataIndex: 'productcasename',
                        align: 'left',
                        border: 0,
                        sortable: false

                    },
                    {
                        text: '起保时间',
                        width: '9%',
                        dataIndex: 'begindate',
                        align: 'left',
                        border: 0,
                        sortable: true

                    },
                    {
                        text: '终保时间',
                        width: '9%',
                        dataIndex: 'enddate',
                        align: 'left',
                        border: 0,
                        sortable: false
                    },
                    {
                        text: '预算价格',
                        width: '8%',
                        align: 'center',
                        dataIndex:'price',
                        border: 0,
                        sortable: true
                    }
                    ,
                    {
                        text: '添加时间',
                        width: '10%',
                        align: 'center',
                        dataIndex:'addtime',
                        border: 0,
                        sortable: true
                    },
                    {
                        text: '购买完成时间',
                        width: '10%',
                        align: 'center',
                        dataIndex:'payedtime',
                        border: 0,
                        sortable: true
                    },
                    {
                        text: '查看',
                        width: '10%',
                        align: 'center',
                        border: 0,
                        sortable: false,
                        cls: 'mod-1',
                        renderer: function (value, metadata, record) {

                            var id = record.get('id');
                            var ordersn=record.get('ordersn');
                            var viewstatus=record.get('viewstatus');
                            var ico=viewstatus==1?editico:unviewico;
                            var html = "<a href='javascript:;' style='color:green' onclick=\"editBook("+id+",'"+ordersn+"')\">"+ico+"</a>";
                            return html;
                            // return getExpandableImage(value, metadata,record);
                        }
                    },
                    {
                        text: '状态',
                        width: '10%',
                        align: 'center',
                        dataIndex:'status',
                        border: 0,
                        sortable: true,
                        renderer : function(value, metadata,record) {
                         //   var linename=record.get('linename');
                        //   var str=linename?value+'('+linename+')':value;
                            var _arr={0:'未付款',1:'客户已付款',2:'已经完成购买'};
                            return  _arr[value];
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
        if (data_height > height - 106)
            window.product_grid.height = (height - 106);
        else
        // delete window.product_grid.height;
            window.product_grid.doLayout();


    })









    //切换每页显示数量
    function changeNum(combo, records) {

        var pagesize = records[0].get('num');
        window.product_store.pageSize = pagesize;
        window.product_grid.down('pagingtoolbar').moveFirst();
        //window.product_store.load({start:0});
    }
    //选择全部
    function chooseAll() {
        var check_cmp = Ext.query('.product_check');
        for (var i in check_cmp) {
            if (!Ext.get(check_cmp[i]).getAttribute('checked'))
                check_cmp[i].checked = 'checked';
        }

        //  window.sel_model.selectAll();
    }
    //反选
    function chooseDiff() {
        var check_cmp = Ext.query('.product_check');
        for (var i in check_cmp)
            check_cmp[i].click();

    }
    function del() {
        //window.product_grid.down('gridcolumn').hide();

        var check_cmp = Ext.select('.product_check:checked');

        if (check_cmp.getCount() == 0) {
            return;
        }
        Ext.Msg.confirm("提示", "确定删除", function (buttonId) {
            if (buttonId != 'yes')
                return;
            check_cmp.each(
                function (el, c, index) {
                    window.product_store.getById(el.getValue()).destroy();
                }
            );
        })
    }


    //更新某个字段
    function updateField(ele, id, field, value, type) {
        var record = window.product_store.getById(id.toString());
        console.log(record);
        if (type == 'select') {
            value = Ext.get(ele).getValue();
        }
        var view_el = window.product_grid.getView().getEl();


        Ext.Ajax.request({
            url: SITEURL+"supplier/index/action/update",
            method: "POST",
            datatype: "JSON",
            params: {id: id, field: field, val: value, kindid: 0},
            success: function (response, opts) {
                if (response.responseText == 'ok') {


                    record.set(field, value);
                    record.commit();
                    // view_el.scrollBy(0,scroll_top,false);
                }
                else{

                    ST.Util.showMsg("{__('norightmsg')}",5,1000);
                }
            }});

    }


    function goSearchField()
    {
        var keyword = $.trim($("#searchkey").val());
        var datadef = $("#searchkey").attr('datadef');
        var field=$("#searchfield").val();
        keyword = keyword==datadef ? '' : keyword;
        window.product_store.getProxy().setExtraParam('keyword',keyword);
        window.product_store.getProxy().setExtraParam('searchfield',field);
        window.product_store.load();

    }
    function editBook(id,ordersn)
    {
        ST.Util.addTab('保险:'+ordersn,SITEURL+'insurance/edit/id/'+id+'/parentkey/product/itemid/7');
    }


</script>

</body>
</html>
