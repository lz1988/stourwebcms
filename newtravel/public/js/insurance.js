/**
 * Created by Administrator on 2015/5/6 0006.
 */
(function insurance($)
{

    var currentDialog=null;
    //类定义部分
    var _ins={};
    function getList(callback)
    {
        $.ajax({
            type:'POST',
            url:url,
            dataType:'json',
            data:{supplier:'huizhe'},
            success:function(data){


            }

        });

    }
    function chooseDialog(ele,container_sel,callback)
    {
        var selArr=[];
        $(container_sel+' span input').each(function(index,ele){
            var id=$(ele).val();
            selArr.push(id);
        });
        var selStr=selArr.join(',');
        var url=SITEURL+'insurance/dialog_set?insuranceids='+selStr;
        ST.Util.showBox("设置保险",url,600,'',null,null,document,{loadWindow:window,loadCallback:callback});

    }
    function closeDialog()
    {
        currentDialog.close();
        currentDialog=null;

    }
    _ins.closeDialog=closeDialog;
    _ins.getList=getList;
    _ins.chooseDialog=chooseDialog;
    window.Insurance=_ins;
})(jQuery)