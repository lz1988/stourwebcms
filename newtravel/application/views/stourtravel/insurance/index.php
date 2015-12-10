<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>问答管理-思途CMS3.0</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css,base2.css,plist.css'); }

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
            <div class="list-top-set">
                <div class="list-web-pad"></div>
                <div class="list-web-ct">
                    <table class="list-head-tb">
                        <tr>
                            <td class="head-td-lt">
                                <a href="javascipt:;" id="configbtn" class="menu-shortcut" >配置</a>
                            </td>
                            <td class="head-td-rt">

                                <a href="javascript:;" class="refresh-btn" onclick="window.location.reload()">刷新</a>
                                <a href="javascript:;" class="normal-btn" id="update_btn">更新</a>

                        </tr>
                    </table>
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


    Ext.onReady(
        function () {
            Ext.tip.QuickTipManager.init();


            //产品store
            window.product_store = Ext.create('Ext.data.Store', {

                fields: [
                    'id',
                    'productcode',
                    'productname',
                    'defaultprice',
                    'ourprice'
                ],

                proxy: {
                    type: 'ajax',
                    api: {
                        read: SITEURL + 'insurance/index/action/read',  //读取数据的URL
                        update: SITEURL + 'insurance/index/action/save',
                        destroy: SITEURL + 'insurance/index/action/delete'
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
                        if (!successful) {
                            ST.Util.showMsg("{__('norightmsg')}", 5, 1000);
                        }
                        var pageHtml=ST.Util.page(store.pageSize,store.currentPage,store.getTotalCount(),10);
                        $("#line_page").html(pageHtml);
                        window.product_grid.doLayout();
                        $(".pageContainer .pagePart a").click(function () {
                            var page = $(this).attr('page');
                            product_store.loadPage(page);
                        });
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
                scroll: 'vertical', //只要垂直滚动条
                bbar: Ext.create('Ext.toolbar.Toolbar', {
                    store: product_store,  //这个和grid用的store一样
                    displayInfo: true,
                    emptyMsg: "",
                    items: [
                        {
                            xtype:'panel',
                            id:'listPagePanel',
                            html:'<div id="line_page"></div>'
                        },
                        {
                            xtype: 'combo',
                            fieldLabel: '每页显示数量',
                            width: 170,
                            labelAlign: 'right',
                            forceSelection: true,
                            value: 30,
                            store: {
                                fields: ['num'], data: [
                                    {num: 30},
                                    {num: 60},
                                    {num: 100}
                                ]
                            },
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
                          //  bar.down('tbfill').hide();


                            bar.insert(0, Ext.create('Ext.toolbar.Fill'));
                            //items.add(Ext.create('Ext.toolbar.Fill'));
                        }
                    }
                }),
                columns: [
                    {
                        text: '保险名称',
                        width: '30%',
                        dataIndex: 'productname',
                        align: 'left',
                        border: 0,
                        sortable: false,
                        menuDisabled:true,
                        renderer: function (value, metadata, record) {
                            var id = record.get('id');
                            return '<a href="javascript:;" onclick="detailInfo(' + id + ')" class="product-title">' + value + '</a>';
                        }

                    },

                    {
                        text: '方案代码',
                        width: '30%',
                        dataIndex: 'productcode',
                        align: 'left',
                        border: 0,
                        sortable: false,
                        menuDisabled:true,
                        renderer: function (value, metadata, record) {
                            return value;
                        }

                    },
                    {
                        text: '默认价格',
                        width: '15%',
                        dataIndex: 'defaultprice',
                        align: 'left',
                        border: 0,
                        sortable: false,
                        menuDisabled:true,
                        renderer: function (value, metadata, record) {
                            return value;
                        }

                    },
                    {
                        text: '我们的价格',
                        width: '15%',
                        dataIndex: 'ourprice',
                        align: 'left',
                        border: 0,
                        menuDisabled:true,
                        sortable: false,
                        editor:'textfield'

                    },
                    {
                        text: '购买',
                        width: '10%',
                        align: 'center',
                        border: 0,
                        sortable: false,
                        menuDisabled:true,
                        cls: 'mod-1',
                        renderer: function (value, metadata, record) {

                            var id = record.get('id');
                            var html = "<a href='javascript:void(0);' onclick=\"buy(" + id + ")\">购买</a>";
                            return html;
                            // return getExpandableImage(value, metadata,record);
                        }


                    }


                ],
                listeners: {
                    boxready: function () {


                        var height = Ext.dom.Element.getViewportHeight();
                        this.maxHeight = height;
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
                viewConfig: {}
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


    //按进行搜索
    function search() {
        var keyword = $.trim($("#searchkey").val());
        var datadef = $("#searchkey").attr('datadef');
        keyword = keyword == datadef ? '' : keyword;
        window.product_store.getProxy().setExtraParam('keyword', keyword);
        window.product_store.load();


    }


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
            url: SITEURL + "insurance/index/action/update",
            method: "POST",
            datatype: "JSON",
            params: {id: id, field: field, val: value, kindid: 0},
            success: function (response, opts) {
                if (response.responseText == 'ok') {
                    record.set(field, value);
                    record.commit();
                    // view_el.scrollBy(0,scroll_top,false);
                }
                else {

                    ST.Util.showMsg("{__('norightmsg')}", 5, 1000);
                }
            }
        });

    }


    //删除套餐
    function delS(id) {
        Ext.Msg.confirm("提示", "确定删除吗？", function (buttonId) {
            if (buttonId == 'yes')
                window.product_store.getById(id.toString()).destroy();
        })
    }


    //刷新保存后的结果
    function refreshField(id, arr) {
        id = id.toString();
        var id_arr = id.split('_');
        // var view_el=window.product_grid.getView().getEl()
        //var scroll_top=view_el.getScrollTop();
        Ext.Array.each(id_arr, function (num, index) {
            if (num) {
                var record = window.product_store.getById(num.toString());

                for (var key in arr) {
                    record.set(key, arr[key]);
                    record.commit();
                    // view_el.scrollBy(0,scroll_top,false);
                    // window.line_grid.getView().refresh();
                }
            }
        })
    }

    function detailInfo(id) {
        ST.Util.showBox("详情", 'insurance/dialog_detail/id/' + id);
    }
    function updateInsurance() {
        var url = SITEURL + "insurance/ajax_huizhe_update";
        ST.Util.showMsg('更新中',6,100000);
        $.ajax({
            type: 'POST',
            url: url,
            dataType: 'json',
            success: function (data) {
                ST.Util.hideMsgBox();
                if (data.status) {
                    ST.Util.showMsg(data.msg, 4)
                }
                else
                    ST.Util.showMsg(data.msg, 5)

            }
        });
    }
    function buy(id)
    {
        parent.window.addTab('购买保险',SITEURL+'/insurance/book_add/productid/'+id+'/parentkey/product/itemid/7',0);
    }
    $(document).ready(function () {
        $("#update_btn").click(updateInsurance);
    });

    //配置
     $("#configbtn").click(function(){
         var url = SITEURL+"insurance/huizhe/parentkey/system/itemid/19";
         ST.Util.addTab('保险配置',url);
     })
</script>

</body>
</html>
