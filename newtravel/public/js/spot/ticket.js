Ext.onReady(function () {
    Ext.tip.QuickTipManager.init();

    var spotid = $("#spotid").val();


//store
    window.product_store = Ext.create('Ext.data.Store', {

        fields: ['id', 'displayorder', 'title', 'jifencomment', 'jifentprice', 'jifenbook', 'paytype','sellprice','ourprice','tickettypeid'],

        proxy: {
            type: 'ajax',
            api: {
                read: SITEURL + 'spot/ticket/action/read/spotid/'+spotid,  //读取数据的URL
                update: SITEURL  ,
                destroy: SITEURL + 'spot/ticket/action/delete/spotid/'
            },
            reader: {
                type: 'json',   //获取数据的格式
                root: 'lists',
                totalProperty: 'total'
            }
        },

        remoteSort: true,
        pageSize: 30,
        autoLoad: true


    });

//产品列表
    window.product_grid = Ext.create('Ext.grid.Panel', {
        store: product_store,
        padding: '2px',
        renderTo: 'list_pannel',
        border: 0,
        width: "99%",
        bodyBorder: 0,
        bodyStyle: 'border-width:0px',
        autoScroll: true,
        bbar: Ext.create('Ext.toolbar.Paging', {
            store: product_store,  //这个和grid用的store一样
            displayInfo: true,
            emptyMsg: "",
            items: [
                {
                    xtype: 'combo',
                    fieldLabel: '每页显示数量',
                    width: 170,
                    labelAlign: 'left',
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
                render: function(bar) {
                    var items = this.items;
                    bar.down('tbfill').hide();

                    bar.insert(0,Ext.create('Ext.panel.Panel',{
                        border:0,
                        html:'<div class="panel_bar"><a class="abtn" href="javascript:void(0);" onclick="chooseAll()">全选</a><a class="abtn" href="javascript:void(0);" onclick="chooseDiff()">反选</a><a class="abtn" href="javascript:void(0);" onclick="delChoose()">删除</a></div>'
                    }));

                    bar.insert(1,Ext.create('Ext.toolbar.Fill'));
                    //items.add(Ext.create('Ext.toolbar.Fill'));
                }
            }

        }),
        columns: [
            {
                text:'选择',
                width:'5%',
                // xtype:'templatecolumn',
                tdCls:'product-ch',
                align:'center',
                dataIndex:'id',
                border:0,
                renderer : function(value, metadata,record) {
                    id=record.get('id');

                     return  "<input type='checkbox' class='product_check' style='cursor:pointer' value='"+value+"'/>";

                }

            },

            {
                text: '排序',
                width: '5%',
                height: '30',
                dataIndex: 'displayorder',
                tdCls: 'product-order',
                id: 'column_lineorder',
                align: 'center',
                border: 0,
                editor: 'textfield',
                renderer: function (value, metadata, record) {
                    var id = record.get('id');
                    if (id.indexOf('suit') != -1)
                        metadata.tdAttr = "data-qtip='指门票显示顺序'" + "data-qclass='dest-tip'";

                    if (value == 9999 || value == 999999 || value == 0)
                        return '';
                    else
                        return value;

                }


            },
            {
                text: '门票名称',
                width: '15%',
                height: '30',
                dataIndex: 'title',
                align: 'left',
                id: 'column_title',
                border: 0,
                editor: 'textfield',
                sortable: false,
                renderer: function (value, metadata, record) {
                    return value;

                }

            },
            {
                text: '门票类型',
                width: '10%',
                height: '30',
                dataIndex: 'tickettypeid',
                align: 'left',
                border: 0,
                cls:'mod-1',
                sortable: false,
                renderer: function (value, metadata, record) {
                    var id=record.get('id');

                    if(!isNaN(id))
                    {
                        // return "<select><option>一星级</option><option>二星级</option></select>";
                        var html="<select onchange=\"updateField(this,"+id+",'tickettypeid',0,'select')\"><option>未选</option>";
                        Ext.Array.each(window.TICKETTYPELIST, function(row, index, itelf) {
                            var is_selected=row.id==value ? "selected='selected'":'';
                            html+="<option value='"+row.id+"' "+is_selected+">"+row.kindname+"</option>";
                        });
                        html+="</select>";
                        return html;

                    }

                }

            },

            {
                text: '市场价格',
                width: '10%',
                height: '30',
                dataIndex: 'sellprice',
                align: 'left',
                border: 0,
                sortable: false,
                editor: 'textfield',
                renderer: function (value, metadata, record) {
                    return value;

                }

            },
            {
                text: '销售价格',
                width: '10%',
                height: '30',
                dataIndex: 'ourprice',
                align: 'left',
                border: 0,
                sortable: false,
                editor: 'textfield',
                renderer: function (value, metadata, record) {
                    return value;

                }

            },
            {
                text: '积分抵现',
                width: '10%',
                height: '30',
                dataIndex: 'jifentprice',
                align: 'left',
                border: 0,
                sortable: false,
                editor: 'textfield',
                renderer: function (value, metadata, record) {
                    return value;

                }

            },
            {
                text: '预订积分',
                width: '10%',
                height: '30',
                dataIndex: 'jifenbook',
                align: 'left',
                border: 0,
                sortable: false,
                editor: 'textfield',
                renderer: function (value, metadata, record) {
                    return value;

                }

            },
            {
                text: '评论积分',
                width: '10%',
                height: '30',
                dataIndex: 'jifencomment',
                align: 'left',
                border: 0,
                sortable: false,
                editor: 'textfield',
                renderer: function (value, metadata, record) {
                    return value;

                }

            },


            {
                text: '管理',
                width: '15%',
                height: '30',
                align: 'center',
                border: 0,
                sortable: false,
                cls: 'mod-2',
                renderer: function (value, metadata, record) {
                    var id = record.get('id');

                    var html = "<a href='javascript:void(0);' onclick=\"modify(" + id + ")\">修改";
                    html += "&nbsp;&nbsp;<a href='javascript:void(0);' onclick=\"del(" + id + ")\">删除";
                    return html;

                    // return getExpandableImage(value, metadata,record);
                }


            }

        ],
        listeners: {
            boxready: function () {
                var height = Ext.dom.Element.getViewportHeight();
                this.maxHeight = height - 100;
                this.doLayout();
            },
            afterlayout: function (grid) {

                var data_height = 0;
                try {
                    data_height = grid.getView().getEl().down('.x-grid-table').getHeight();
                }
                catch (e) {

                }
                var height = Ext.dom.Element.getViewportHeight();

                if (data_height > height - 120) {
                    window.has_biged = true;
                    grid.height = height - 120;
                }
                else if (data_height < height - 120) {
                    if (window.has_biged) {

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
                        updateField(0, id, e.field, e.value, 0);
                        return false;

                    },
                    beforeedit: function (editor, e) {


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
    if (data_height > height - 106)
        window.product_grid.height = (height - 106);
    else

    window.product_grid.doLayout();

})

//更新某个字段
function updateField(ele, id, field, value, type) {
    var record = window.product_store.getById(id.toString());
    if (type == 'select') {
        value = Ext.get(ele).getValue();
    }
    var view_el = window.product_grid.getView().getEl();
    var spotid = $("#spotid").val();


    Ext.Ajax.request({
        url: SITEURL+"spot/ticket/action/update/spotid/"+spotid,
        method: "POST",
        datatype: "JSON",
        params: {id: id, field: field, val: value},
        success: function (response, opts) {
            if (response.responseText == 'ok') {


                record.set(field, value);
                record.commit();

            }
        }});

}
//切换每页显示数量
function changeNum(combo, records) {

    var pagesize = records[0].get('num');
    window.product_store.pageSize = pagesize;
    window.product_grid.down('pagingtoolbar').moveFirst();
    //window.product_store.load({start:0});
}

//选择全部
function chooseAll()
{
    var check_cmp=Ext.query('.product_check');
    for(var i in check_cmp)
    {
        if(!Ext.get(check_cmp[i]).getAttribute('checked'))
            check_cmp[i].checked='checked';
    }

}
//反选
function chooseDiff()
{
    var check_cmp=Ext.query('.product_check');
    for(var i in check_cmp)
        check_cmp[i].click();

}
function delChoose()
{
    //window.product_grid.down('gridcolumn').hide();

    var check_cmp=Ext.select('.product_check:checked');

    if(check_cmp.getCount()==0)
    {
        return;
    }
   /* Ext.Msg.confirm("提示","确定删除",function(buttonId){
        if(buttonId!='yes')
            return;
        check_cmp.each(
            function(el,c,index)
            {
                //console.log(el.getValue());

               // window.product_store.getById(el.getValue()).destroy();
                window.product_store.getById(id).destroy();
            }
        );
    })*/
    ST.Util.confirmBox('删除门票','确定删除吗?',function(){

        check_cmp.each(
            function(el,c,index)
            {

                window.product_store.getById(el.getValue()).destroy();

            });

    })
}

//删除单个
function del(id)
{
   ST.Util.confirmBox('删除门票','确定删除吗?',function(){

       window.product_store.getById(''+id).destroy();
   })

}
//添加
function addticket()
{
    var spotid = $("#spotid").val();
    var url = SITEURL+'spot/ticket_op/parentkey/product/itemid/4/action/add/spotid/'+spotid;
    ST.Util.addTab('添加门票',url);
}
//修改
function modify(ticketid)
{
    var spotid = $("#spotid").val();
    var url = SITEURL+'spot/ticket_op/parentkey/product/itemid/5/action/edit/spotid/'+spotid+'/ticketid/'+ticketid;
    ST.Util.addTab('修改门票',url);
}
//数据类型
function getType(o) {
    var _t; return ((_t = typeof(o)) == "object" ? o==null && "null" || Object.prototype.toString.call(o).slice(8,-1):_t).toLowerCase();
}

