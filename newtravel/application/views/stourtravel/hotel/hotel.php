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
</head>
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
                <a href="javascript:void(0);">首页</a> &gt; <a href="javascript:void(0);">设置中心</a> &gt; <a href="javascript:void(0);">基础设置</a> &gt; <span>酒店列表</span>
                <span style="float:right;margin-right:150px"><a href="javascript:;" onClick="window.location.reload()"><img height="18" src="{php echo URL::site();}/public/images/refresh.png" title="刷新当前页面" alt="刷新当前页面"/></a></span></div>


            <div class="list-top-set">
                <div class="list-web-pad"></div>
                <div class="list-web-ct">
                    <div class="list-web-ct-lt" id="list_ot_set"></div>
                    <div class="list-web-ct-rt" id="list_ot_web"></div>
                </div>
            </div>

            <div class="search-bar" id="search_bar">
   <span id="search_bar_sp">
   </span> 
   <span class="search-title"><input type="text" id="search"/>
   <button type="button" onClick="searchDest(this)">搜索</button></span>
   <span class="display-mod">
    <a href="javascript:void(0);" class="on" onClick="togMod(this,1)">基本信息</a>
    <a href="javascript:void(0);" onClick="togMod(this,2)">房型</a>
    <a href="javascript:void(0);" onClick="togMod(this,3)">供应商</a>  
    </span>
            </div>
            <div id="product_grid_panel" class="content-nrt">

            </div>
        </td>
    </tr>
</table>
<script>

<?php

      echo  'window.attrmenu='.json_encode(Controller_Attrid::getattridlist(2)).';';
      echo 'window.rankmenu='.json_encode(Model_Hotel_Rank::getList()).';';
      echo  'window.weblist='.json_encode(ORM::factory('weblist')->get_all()).';';
  ?>

window.display_mode = 1;	//默认显示模式
window.product_kindid = 0;  //默认目的地ID

Ext.onReady(
    function () {
        Ext.tip.QuickTipManager.init();
        /*顶部按钮，相关设置，站点等*/
        Ext.create('Ext.button.Button', {
            renderTo: 'list_ot_set',
            style: 'margin-left:10px;background:#07C3D9',
            text: '添加'
        });
        Ext.create('Ext.button.Button', {
            text: '相关设置',
            renderTo: 'list_ot_set',
            style: 'margin-left:10px;background:#07C3D9',
            menu: {
                items: [
                    {
                        text: '酒店目的地',
                        handler: function () {
                        }
                    },
                    {
                        text: '酒店属性',
                        handler: function () {
                        }
                    },
                    {
                        text: '图标管理',
                        handler: function () {
                        }
                    },
                    {
                        text: '专题管理',
                        handler: function () {
                        }
                    },
                ]
            }

        });

        var web_menu_items = [];
        Ext.Array.each(window.weblist, function (row, index, itself) {
            web_menu_items.push({text: row.webname, webid: row.webid});
        });
        //站点切换
        Ext.create('Ext.button.Cycle', {
            renderTo: 'list_ot_web',
            text: '主站',
            showText: true,
            style: "background:#07C3D9",
            menu: {
                items: web_menu_items
            },
            changeHandler: function (cycleBtn, activeItem) {
                if (!window.web_togfirst) {
                    window.web_togfirst = 1;
                    return;
                }
                window.product_store.getProxy().setExtraParam('webid', activeItem.webid);
                window.product_store.load({start: 0});

            }

        });
        //产品store
        window.product_store = Ext.create('Ext.data.Store', {

            fields: ['id', 'aid', 'webid', 'title', 'hotelrankid', 'telephone', 'hotelkind', 'fuwu', 'shownum', 'kindlist', 'attrid', 'ishidden', 'displayorder', 'kindname', 'iconlist', 'attrname', 'themelist', 'tr_class', 'price', 'sellprice', 'breakfirst', 'computer'],
            proxy: {
                type: 'ajax',
                api: {
                    read: 'hotel/action/read',  //读取数据的URL
                    update: 'hotel/action/save',
                    destroy: 'hotel/action/delete'
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

            }

        });

        //产品列表
        window.product_grid = Ext.create('Ext.grid.Panel', {
            store: product_store,
            padding: '2px',
            renderTo: 'product_grid_panel',
            border: 0,
            width: "99%",
            bodyBorder: 0,
            bodyStyle: 'border-width:0px',
            autoScroll: true,
            bbar: Ext.create('Ext.toolbar.Paging', {
                store: product_store,  //这个和grid用的store一样
                displayInfo: true,
                emptyMsg: "没有数据了",
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

                        bar.insert(0, Ext.create('Ext.panel.Panel',
                            {
                                border: 0,
                                html: '<div class="panel_bar"><a class="abtn" href="javascript:void(0);" onclick="chooseAll()">全选</a><a class="abtn" href="javascript:void(0);" onclick="chooseDiff()">反选</a><a class="abtn" href="javascript:void(0);" onclick="delLine()">删除</a></div>'}));
                                bar.insert(1, Ext.create('Ext.panel.Panel', {border: 0, items: [
                                {
                                xtype: 'button',
                                text: '批量设置',
                                menu: [
                                    {text: '目的地', handler: function () {
                                        setSome(1)
                                    }},
                                    {text: '属性', handler: function () {
                                        setSome(2)
                                    }},
                                    {text: '专题', handler: function () {
                                        setSome(4)
                                    }},
                                    {text: '图标', handler: function () {
                                        setSome(3)
                                    }},
                                ]

                            }
                        ]}));
                        bar.insert(2, Ext.create('Ext.toolbar.Fill'));
                        //items.add(Ext.create('Ext.toolbar.Fill'));
                    }
                }
            }),
            columns: [
                {
                    text: '选择',
                    width: '5%',
                    // xtype:'templatecolumn',
                    tdCls: 'product-ch',
                    align: 'center',
                    dataIndex: 'id',
                    border: 0,
                    renderer: function (value, metadata, record) {
                        id = record.get('id');

                        if (id.indexOf('suit') == -1)
                            return  "<input type='checkbox' class='product_check' style='cursor:pointer' value='" + value + "'/>";

                    }

                },
                {
                    text: '排序',
                    width: '10%',
                    dataIndex: 'displayorder',
                    tdCls: 'product-order',
                    id: 'column_lineorder',
                    align: 'center',
                    border: 0,
                    editor: 'textfield',
                    renderer: function (value, metadata, record) {
                        var id = record.get('id');
                        if (id.indexOf('suit') != -1)
                            metadata.tdAttr = "data-qtip='指同一酒店下房型的显示顺序'" + "data-qclass='dest-tip'";

                        if (value == 9999 || value == 999999 || value == 0)
                            return '';
                        else
                            return value;

                    }


                },
                {
                    text: '酒店名称',
                    width: '25%',
                    dataIndex: 'title',
                    align: 'left',
                    id: 'column_hotelname',
                    border: 0,
                    sortable: false,
                    renderer: function (value, metadata, record) {
                        var aid = record.get('aid');
                        var id = record.get('id');
                        var hotelid = record.get('hotelid');

                        if (!isNaN(id))
                            return "<a href='/hotels/show_" + aid + ".html' class='product-title' target='_blank'>" + value + "</a>";
                        else if (id.indexOf('suit') != -1) {
                            metadata.tdAttr = "data-qtip='点击跳转到房型设置页面'  data-qclass='dest-tip'";
                            return "&nbsp;&nbsp;&nbsp;&nbsp;<a href='javascript:void(0);' class='suit-title' onclick='roomList("+hotelid+")'>" + value + "</a>";
                        }
                    }

                },
                {
                    text: '星级',
                    width: '10%',
                    dataIndex: 'hotelrankid',
                    align: 'center',
                    cls: 'mod-1',
                    sortable: false,

                    renderer: function (value, metadata, record, rowIndex, colIndex) {

                        var id = record.get('id');
                        if (!isNaN(id)) {
                            // return "<select><option>一星级</option><option>二星级</option></select>";
                            var html = "<select onchange=\"updateField(this," + id + ",'hotelrankid',0,'select')\"><option>所有</option>";
                            Ext.Array.each(window.rankmenu, function (row, index, itelf) {
                                var is_selected = row.aid == value ? "selected='selected'" : '';
                                html += "<option value='" + row.aid + "' " + is_selected + ">" + row.hotelrank + "</option>";
                            });
                            html += "</select>";
                            return html;

                        }
                    },
                    listeners: {
                        afterrender: function (obj, eopts) {
                            if (window.display_mode != 1)
                                obj.hide();
                            else
                                obj.show();
                        }
                    }
                },
                {
                    text: '目的地',
                    width: '7%',
                    dataIndex: 'kindlist',
                    align: 'center',
                    cls: 'mod-1',
                    sortable: false,
                    renderer: function (value, metadata, record, rowIndex, colIndex) {

                        var kindname = record.get('kindname');
                        if (kindname)
                            metadata.tdAttr = "data-qtip='" + kindname + "'" + "data-qclass='dest-tip'";
                        var id = record.get('id');
                        var d_text = value ? '已设' : '未设';
                        return "<a href='javascript:void(0);' onclick=\"ST.Destination.setDest(this,2," + id + ",'" + value + "',destSetBack)\">" + d_text + "</a>";
                        // return getExpandableImage(value, metadata,record);
                    },
                    listeners: {
                        afterrender: function (obj, eopts) {

                            if (window.display_mode != 1)
                                obj.hide();
                            else
                                obj.show();
                        }
                    }


                },
                {
                    text: '图标',
                    width: '7%',
                    align: 'center',
                    dataIndex: 'iconlist',
                    border: 0,
                    cls: 'mod-1',
                    sortable: false,
                    renderer: function (value, metadata, record, rowIndex, colIndex) {

                        var id = record.get('id');
                        var d_text = value ? '已设' : '未设';
                        return "<a href='javascript:void(0);' onclick=\"ST.Icon.setIcon(this,2," + id + ",'" + value + "',iconSetBack)\">" + d_text + "</a>";
                        // return getExpandableImage(value, metadata,record);
                    },
                    listeners: {
                        afterrender: function (obj, eopts) {

                            if (window.display_mode != 1)
                                obj.hide();
                            else
                                obj.show();
                        }
                    }


                },
                {
                    text: '属性',
                    width: '7%',
                    align: 'center',
                    dataIndex: 'attrid',
                    border: 0,
                    sortable: false,
                    cls: 'mod-1',
                    renderer: function (value, metadata, record, rowIndex, colIndex) {

                        var attrname = record.get('attrname');
                        if (attrname)
                            metadata.tdAttr = "data-qtip='" + attrname + "'data-qclass='dest-tip'";

                        var id = record.get('id');
                        var d_text = value != 0 ? '已设' : '未设';
                        return "<a href='javascript:void(0);' onclick=\"ST.Attrid.setAttrid(this,2," + id + ",'" + value + "',attrSetBack)\">" + d_text + "</a>";
                        // return getExpandableImage(value, metadata,record);
                    },
                    listeners: {
                        afterrender: function (obj, eopts) {
                            if (window.display_mode != 1)
                                obj.hide();
                            else
                                obj.show();
                        }
                    }

                },
                {
                    text: '专题',
                    width: '7%',
                    align: 'center',
                    sortable: false,
                    dataIndex: 'themelist',
                    cls: 'mod-1',
                    border: 0,
                    renderer: function (value, metadata, record, rowIndex, colIndex) {

                        var id = record.get('id');
                        var d_text = value ? '已设' : '未设';
                        return "<a href='javascript:void(0);' onclick=\"ST.Theme.setTheme(this,2," + id + ",'" + value + "',themeSetBack)\">" + d_text + "</a>";
                        // return getExpandableImage(value, metadata,record);
                    },
                    listeners: {
                        afterrender: function (obj, eopts) {

                            if (window.display_mode != 1)
                                obj.hide();
                            else
                                obj.show();

                        }
                    }

                },
                {
                    text: '房型',
                    width: '7%',
                    align: 'center',
                    sortable: false,
                    dataIndex: 'id',
                    cls: 'mod-1',
                    border: 0,
                    renderer: function (value, metadata, record, rowIndex, colIndex) {

                        var id = record.get('id');

                        return "<a href='javascript:void(0);' onclick=\"roomList(" + id + ")\">房型管理</a>";

                    },
                    listeners: {
                        afterrender: function (obj, eopts) {

                                obj.show();

                        }
                    }

                },
               /* {
                    text: '价格',
                    width: '7%',
                    dataIndex: 'price',
                    align: 'center',
                    border: 0,
                    cls: 'mod-1',
                    sortable: false,
                    renderer: function (value, metadata, record, rowIndex, colIndex) {


                        var id = record.get('id');
                        return "<a href='javascript:void(0);' onclick=\"setPrice(" + id + ",'" + value + "')\">设置";
                        // return getExpandableImage(value, metadata,record);
                    },
                    listeners: {
                        afterrender: function (obj, eopts) {

                            if (window.display_mode != 1)
                                obj.hide();
                            else
                                obj.show();

                        }
                    }
                },*/
                {
                    text: '隐藏',
                    width: '7%',
                    // xtype:'templatecolumn',
                    align: 'center',
                    border: 0,
                    dataIndex: 'ishidden',
                    xtype: 'actioncolumn',
                    cls: 'mod-1',
                    items: [
                        {
                            getClass: function (v, meta, rec) {          // Or return a class from a function
                                if (v == 1)
                                    return 'dest-status-ok';
                                else
                                    return 'dest-status-none';
                            },
                            handler: function (view, index, colindex, itm, e, record) {
                                // togStatus(null,record,'ishidden');
                                var val = record.get('ishidden');
                                var id = record.get('id');
                                var newval = val == 1 ? 0 : 1;
                                updateField(null, record.get('id'), 'ishidden', newval)

                            }
                        }
                    ],
                    listeners: {
                        afterrender: function (obj, eopts) {

                            if (window.display_mode != 1)
                                obj.hide();
                            else
                                obj.show();

                        }
                    }


                },
                {
                    text: '修改',
                    width: '6%',
                    align: 'center',
                    border: 0,
                    sortable: false,
                    cls: 'mod-1',
                    renderer: function (value, metadata, record) {

                        var id = record.get('id');
                        return "<a href='javascript:void(0);' onclick=\"goModify(" + id + ")\">设置";
                        // return getExpandableImage(value, metadata,record);
                    },
                    listeners: {
                        afterrender: function (obj, eopts) {

                            if (window.display_mode != 1)
                                obj.hide();
                            else
                                obj.show();

                        }
                    }

                },
                {
                    text: '门市价',
                    width: '10%',
                    align: 'center',
                    border: 0,
                    sortable: false,
                    dataIndex: 'sellprice',
                    cls: 'mod-2',
                    renderer: function (value, metadata, record, rowindex, colindex) {


                        var id = record.get('id');
                        if (id.indexOf('suit') != -1)
                            return value;
                        else
                            return '';
                        // return getExpandableImage(value, metadata,record);
                    },
                    listeners: {
                        afterrender: function (obj, eopts) {
                            if (window.display_mode != 2)
                                obj.hide();
                            else
                                obj.show();

                        }
                    }

                },
                {
                    text: '优惠价',
                    width: '10%',
                    align: 'center',
                    border: 0,
                    sortable: false,
                    dataIndex: 'price',
                    cls: 'mod-2',
                    renderer: function (value, metadata, record) {
                        var id = record.get('id');
                        if (id.indexOf('suit') != -1)
                            return value;
                        else
                            return '';
                        // return getExpandableImage(value, metadata,record);
                    },
                    listeners: {
                        afterrender: function (obj, eopts) {
                            if (window.display_mode != 2)
                                obj.hide();
                            else
                                obj.show();
                        }
                    }

                },
                {
                    text: '餐标',
                    width: '10%',
                    align: 'center',
                    border: 0,
                    sortable: false,
                    dataIndex: 'breakfirst',
                    cls: 'mod-2',
                    renderer: function (value, metadata, record) {
                        var id = record.get('id');
                        var food_arr = [
                            {value: 0, name: '不含'},
                            {value: 1, name: '含'},
                            {value: 2, name: '双早'},
                            {value: 3, name: '单早'},
                            {value: 4, name: '早餐'},
                            {value: 5, name: '早晚餐'},
                            {value: 6, name: '三餐'},
                            {value: 7, name: '一价全包'},
                            {value: 8, name: '用晚含早'}
                        ];
                        if (id.indexOf('suit') != -1) {
                            var html = "<select onchange=\"updateField(this,'" + id + "','breakfirst',0,'select')\">";
                            Ext.Array.each(food_arr, function (row, index, itself) {
                                var is_selected = value == row.value ? "selected='selected'" : '';
                                html += "<option value='" + row.value + "' " + is_selected + ">" + row.name + "</option>"
                            });
                            html += "</select>";
                            return html;

                        }
                        else
                            return '';
                        // return getExpandableImage(value, metadata,record);
                    },
                    listeners: {
                        afterrender: function (obj, eopts) {
                            if (window.display_mode != 2)
                                obj.hide();
                            else
                                obj.show();
                        }
                    }

                },
                {
                    text: '宽带',
                    width: '10%',
                    align: 'center',
                    border: 0,
                    sortable: false,
                    dataIndex: 'computer',
                    cls: 'mod-2',
                    renderer: function (value, metadata, record) {
                        var id = record.get('id');
                        var wifi_arr = [
                            {value: 0, name: '不含'},
                            {value: 1, name: '含'},
                            {value: 2, name: '有线'},
                            {value: 3, name: 'WIFI'}
                        ];
                        if (id.indexOf('suit') != -1) {
                            var html = "<select onchange=\"updateField(this,'" + id + "','computer',0,'select')\">";
                            Ext.Array.each(wifi_arr, function (row, index, itself) {
                                var is_selected = value == row.value ? "selected='selected'" : '';
                                html += "<option value='" + row.value + "' " + is_selected + ">" + row.name + "</option>"
                            });
                            html += "</select>";
                            return html;

                        }
                        else
                            return '';
                        // return getExpandableImage(value, metadata,record);
                    },
                    listeners: {
                        afterrender: function (obj, eopts) {
                            if (window.display_mode != 2)
                                obj.hide();
                            else
                                obj.show();
                        }
                    }

                },
                {
                    text: '管理',
                    width: '10%',
                    align: 'center',
                    border: 0,
                    sortable: false,
                    dataIndex: 'computer',
                    cls: 'mod-2',
                    renderer: function (value, metadata, record) {
                        var id = record.get('id');
                        if (id.indexOf('suit') != -1) {
                            return "<a href='javascript:;'>修改</a>&nbsp;&nbsp;<a href='javascript:;' onclick=\"delSuit('" + id + "')\">删除</a>";
                        }
                        else
                            return '';
                        // return getExpandableImage(value, metadata,record);
                    },
                    listeners: {
                        afterrender: function (obj, eopts) {
                            if (window.display_mode != 2)
                                obj.hide();
                            else
                                obj.show();
                        }
                    }

                }

            ],
            listeners: {
                boxready: function () {


                    var height = Ext.dom.Element.getViewportHeight();
                    this.Maxheight = height - 150;
                    this.doLayout();
                },
                afterlayout: function (grid) {

                    if (window.product_kindname) {
                        Ext.getCmp('column_lineorder').setText(window.product_kindname + '-排序')
                    }
                    else {
                        Ext.getCmp('column_lineorder').setText('排序')
                    }

                    window.product_store.each(function (record) {
                        id = record.get('id');

                        if (id.indexOf('suit') != -1) {

                            var ele = window.product_grid.getView().getNode(record);
                            var cls = record.get('tr_class');
                            Ext.get(ele).addCls(cls);
                            Ext.get(ele).setVisibilityMode(Ext.Element.DISPLAY);
                            if (window.display_mode != 2) {
                                Ext.get(ele).hide();
                            }
                            else {
                                Ext.get(ele).show();
                            }

                        }
                        else if (window.display_mode == 2) {
                            var ele = window.product_grid.getView().getNode(record);
                            var cls = record.get('tr_class');
                            Ext.get(ele).addCls(cls);
                        }

                    });

                    var data_height = 0;
                    try {
                        data_height = grid.getView().getEl().down('.x-grid-table').getHeight();
                    } catch (e) {
                    }
                    var height = Ext.dom.Element.getViewportHeight();
                    // console.log(data_height+'---'+height);
                    if (data_height > height - 120) {
                        window.has_biged = true;
                        grid.height = height - 120;
                    }
                    else if (data_height < height - 120) {
                        if (window.has_biged) {
                            delete window.grid.height;
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
                            //   var view_el=window.product_grid.getView().getEl();
                            //  view_el.scrollBy(0,this.scroll_top,false);
                            updateField(0, id, e.field, e.value, 0);
                            return false;

                        },
                        beforeedit: function (editor, e) {
                            //  var view_el=window.product_grid.getView().getEl();
                            //   this.scroll_top=view_el.getScrollTop();


                        }
                    }
                })
            ],
            viewConfig: {
                enableTextSelection: true
            }
        });


    })

//实现动态窗口大小
Ext.EventManager.onWindowResize(function () {

    var height = Ext.dom.Element.getViewportHeight();
    var data_height = window.product_grid.getView().getEl().down('.x-grid-table').getHeight();
    if (data_height > height - 120)
        window.product_grid.height = (height - 120);
    else
        delete window.product_grid.height;
    window.product_grid.doLayout();


    /* var height=Ext.dom.Element.getViewportHeight();
     window.product_grid.maxHeight=(height-150);
     window.product_grid.doLayout();
     */
})


//目的地搜索按钮

window.dest_btn = Ext.create('Ext.button.Button', {
    renderTo: 'search_bar_sp',
    text: '目的地',
    style: 'margin-left:10px',
    menu: {
        xtype: 'menu',
        plain: true,
        style: 'border-width:0px;',
        bodyStyle: 'border:0px;padding:0px;border-width:0px;background:#008ED8',
        border: 0,
        items: {
            xtype: 'panel',
            style: 'background:#008ED8;',
            bodyStyle: 'background:#008ED8;padding:5px',
            width: 700,
            html: '<div class="dest-cs-dlg"><div><input type="text" class="dest-keyword"/>&nbsp;&nbsp;<button onclick="getNextDest(0,0,1)">搜索</button></div><div id="dest_list" style=""></div></div>',
            border: 0,
            listeners: {
                afterrender: function (panel) {
                    getNextDest(0, 0, 1);
                }
            }
        }
    }
});


//属性搜索的html


//属性搜索的菜单 
window.attr_btn = Ext.create('Ext.button.Button', {
    renderTo: 'search_bar_sp',
    style: 'margin-left:10px',
    text: '属性',
    menu: {
        xtype: 'menu',
        plain: true,
        style: 'border-width:0px',
        bodyStyle: 'border:0px;padding:0px;border-width:0px;background:#008ED8',
        border: 0,
        items: {
            xtype: 'panel',
            style: 'background:#008ED8',
            bodyStyle: 'background:#008ED8;padding:5px',
            border: 0,
            listeners: {
                afterrender: function (panel) {
                    var attr_html = '<table class="attr-search-cs"><tr><td colspan="2"><span class="sp-name"><a href="javascript:void(0);" onclick="goSearch(this,0,\'attrid\')" class="active">全部</a></span></td></tr>';
                    for (var i in attrmenu) {
                        attr_html += "<tr><td colspan='2'>" + "<span class='sp-name'><a href='javascript:void(0);' onclick=\"goSearch(this," + attrmenu[i]['id'] + ",'attrid')\">" + attrmenu[i]['attrname'] + "</a></span></td></tr>";

                        //alert(attrmenu[i]['menu']);
                        attr_html += "<tr><td width='20'></td><td>";
                        for (var j in attrmenu[i]['children']) {
                            attr_html += "<span class='sp-name'><a href='javascript:void(0);' onclick=\"goSearch(this," + attrmenu[i]['children'][j]['id'] + ",'attrid')\">" + attrmenu[i]['children'][j]['attrname'] + "</a></span>";
                        }
                        attr_html += "</td></tr>";
                    }
                    attr_html += '</table>';
                    panel.update(attr_html);
                }
            }
        }
    }
});


function chooseDest(ele, id) {


}
function getNextDest(ele, pid, isfirst)   //获取目的地
{
    if (!isfirst)
        goSearch(ele, pid, 'kindid');

    var keyword = '', step = 0;
    if (ele == 0) {
        keyword = Ext.select(".dest-keyword").first().getValue();
    }
    else {
        step = Ext.get(ele).getAttribute('step');
        step = !step ? 0 : step;
        step++;
    }


    //var class=pid==0?
    Ext.Ajax.request({
        url: SITEURL + "destination/ajax_getNextDestList",
        method: "POST",
        datatype: "JSON",
        params: {pid: pid, keyword: keyword, step: step},
        success: function (response, opts) {
            var list = Ext.decode(response.responseText);

            if (list.length <= 0)
                return;


            var str = '<div class="step_' + step + ' step_list">';
            if (step == 0) {
                var s_cls = isfirst || !pid ? 'active' : '';
                str = '<div class="step_0 step_flist"><span class="sp-name"><a href="javascript:void(0);" step="0" class="step_all ' + s_cls + '"  onclick="getNextDest(0)">全部</a></span>';
            }
            for (var i in list) {
                str += "<span class='sp-name'><a href='javascript:void(0);' step='" + step + "' onclick=\"getNextDest(this," + list[i]['id'] + ",0)\">" + list[i]['kindname'] + "</a></span>";
            }
            str += '</div>';

            var del_index = step;
            while (true) {
                var todel = Ext.select(".step_" + del_index);
                if (todel.getCount() == 0)
                    break;
                else {
                    todel.remove();
                    del_index++;
                }

            }


            Ext.get('dest_list').appendChild({html: str});
            window.dest_btn.down('panel').hide();
            window.dest_btn.down('panel').show();
            // alert(list);


        }});
}


//进行搜索
function goSearch(ele, val, field) {
    if (field == 'attrid') {
        Ext.select('.attr-search-cs a').removeCls('active');
        Ext.get(ele).addCls('active');
    }
    else if (field == 'startcity') {
        Ext.select('.splace-search-cs a').removeCls('active');
        Ext.get(ele).addCls('active');
    }
    else if (field == 'kindid') {
        if (ele) {
            Ext.select('#dest_list a').removeCls('active');
            Ext.get(ele).addCls('active');
            window.product_kindname = Ext.get(ele).getHTML();
            // Ext.select("dest-hint").first().update('当前目的地:'+Ext.get(ele).getHTML());;
        }
        else {
            Ext.select('.step_all').addCls('active');
            window.product_kindname = '';
        }

        window.product_kindid = val;
    }

    window.product_store.getProxy().setExtraParam(field, val);
    window.product_store.load({start: 0});

}

function searchDest(ele) {
    var keyword = Ext.get(ele).prev().getValue();
    keyword = Ext.String.trim(keyword);
    goSearch(0, keyword, 'keyword');
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
function delLine() {
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
    if (type == 'select') {
        value = Ext.get(ele).getValue();
    }
    var view_el = window.product_grid.getView().getEl();


    Ext.Ajax.request({
        url: "hotel/action/update",
        method: "POST",
        datatype: "JSON",
        params: {id: id, field: field, val: value, kindid: window.product_kindid},
        success: function (response, opts) {
            if (response.responseText == 'ok') {
                // var view_el=window.product_grid.getView().getEl()
                //  var scroll_top=view_el.getScrollTop();

                record.set(field, value);
                record.commit();
                // view_el.scrollBy(0,scroll_top,false);
            }
        }});

}


//删除套餐
function delSuit(id) {
    Ext.Msg.confirm("提示", "确定删除这个套餐？", function (buttonId) {
        if (buttonId == 'yes')
            window.product_store.getById(id).destroy();
    })
}
//切换视图，比如套餐，基本等
function togMod(obj, num) {

    window.display_mode = num;
    Ext.get(obj).parent().select("a.on").removeCls('on');
    Ext.get(obj).addCls('on');
    // window.product_grid.doLayout();

    var temp_records = Ext.clone(window.product_store.data.items);
    window.product_store.removeAll();
    for (var i in window.product_grid.columns) {
        window.product_grid.columns[i].fireEvent('afterrender', window.product_grid.columns[i]);
    }
    //window.product_store.load();
    window.product_store.loadData(temp_records);


}


//批量设置属性目的地图标专题等
function setSome(num) {
    var check_cmp = Ext.select('.product_check:checked');
    if (check_cmp.getCount() == 0) {
        ST.Util.showMsg('请选择酒店', 5);
        return;
    }
    var products = '';
    check_cmp.each(function (el, c, index) {
        products += el.getValue() + '_';
    });

    switch (num) {
        case 1:
            if (Ext.get('dest_window_' + products))
                return;
            ST.Destination.setDest(0, 2, products, 0, destSetBack);
            break;
        case 2:
            if (Ext.get('attr_window_' + products))
                return;
            ST.Attrid.setAttrid(0, 2, products, 0, attrSetBack);
            break;
        case 3:
            if (Ext.get('theme_window_' + products))
                return;
            ST.Icon.setIcon(0, 2, products, 0, iconSetBack);
            break;
        case 4:
            if (Ext.get('icon_window_' + products))
                return;
            ST.Theme.setTheme(0, 2, products, 0, themeSetBack);
            break;
    }


}
function attrSetBack(id, arr, bl) {
    if (bl) {
        ST.Util.showMsg('设置属性成功', 4);

        var attrid = '';
        var attrname = '';
        for (var i in arr) {
            attrid += arr[i].id + ',';
            attrname += arr[i].name + ',';
        }
        attrid = attrid.slice(0, -1);
        attrname = attrname.slice(0, -1);
        refreshField(id, {attrid: attrid, attrname: attrname});
    }
    else {
        ST.Util.showMsg('保存失败', 5);
    }
}

//目的地设置回调函数
function destSetBack(productid, arr, bl) {
    if (bl) {
        ST.Util.showMsg('设置目的地成功', 4);
        var kindlist = '';
        var kindname = '';
        for (var i in arr) {
            kindlist += arr[i].id + ',';
            kindname += arr[i].name + ',';
        }
        kindlist = kindlist.slice(0, -1);
        kindname = kindname.slice(0, -1);
        refreshField(productid, {kindlist: kindlist, kindname: kindname});

    }
    else {
        ST.Util.showMsg('保存失败', 5);
    }
}
//主题设置回调函数
function themeSetBack(id, arr, bl) {
    if (bl) {
        ST.Util.showMsg('设置主题成功', 4);
        var themelist = '';
        for (var i in arr) {
            themelist += arr[i].id + ',';
        }
        themelist = themelist.slice(0, -1);
        refreshField(id, {themelist: themelist});
    }
    else {
        ST.Util.showMsg('保存失败', 5);
    }
}

//图标设置回调函数
function iconSetBack(id, arr, bl) {
    if (bl) {
        ST.Util.showMsg('设置图标成功，请刷新线路以查看结果', 4);
        var iconlist = '';
        for (var i in arr) {
            iconlist += arr[i].id + ',';
        }
        iconlist = iconlist.slice(0, -1);
        refreshField(id, {iconlist: iconlist});

    }
    else {
        ST.Util.showMsg('保存失败', 5);
    }
}


//刷新保存后的结果
function refreshField(id, arr) {
    id = id.toString();
    var id_arr = id.split('_');
    // var view_el=window.product_grid.getView().getEl()
    // var scroll_top=view_el.getScrollTop();
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

//酒店房型管理
function roomList(hotelid)
{

}

</script>

</body>
</html>
