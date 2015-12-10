document.write('<style type="text/css">' +
    '.edui-default .edui-for-vseem .edui-icon{background-position: -380px 0;}' +
    '.edui-default .edui-for-vseem .edui-dialog-content {height: 390px;overflow: hidden;width: 640px;}' +
    '</style>');
UE.commands['vseem'] = {
    execCommand:function (cmd, opt) {
        var me = this;
        ST.Util.showBox('插入图片', SITEURL + 'image/insert_view', 430,340, null, null, document, {loadWindow: window, loadCallback: Insert});
        function Insert(result,bool){
            var imgs=result.data;
            var html='';
            for(var i in imgs){
                if(imgs[i].indexOf("$$")>-1){
                    var temp=imgs[i].split('$$');
                    if(temp[0].indexOf(temp[1])>-1){
                        html+='<img src="'+temp[0]+'" alt="" title=""/>';
                    }else{
                        html+='<img src="'+temp[0]+'" alt="'+temp[1]+'" title="'+temp[1]+'"/>';
                    }
                }else{
                    html+='<img src="'+imgs[i]+'" alt="" title=""/>';
                }

            }
            me.execCommand('insertHtml',html);
        }
    }
};
