<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>思途CMS3.0</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css,jqtransform.css'); }
    {php echo Common::getScript('jquery.upload.js');}
</head>
<style>
    .templetbox{
        width:559px; height:35px; border-bottom:#dcdcdc 1px solid;
    }
    .head{
        width:563px;
        height:39px;
        border-bottom:1px #008ed8 solid;
    }
    .column1{
        float:left;
        width:80px;
        height:40px;
        margin-left:42px;
        line-height:40px;
        color:#333;
        font-size:12px

    }
    .column2{
        float:right;
        width:78px;
        height:40px;
        line-height:40px;
        color:#333;
        font-size:12px;
        margin-right:10px;

    }
    .column3{
        float:right;
        width:78px;
        height:40px;
        line-height:40px;
        color:#333;
        font-size:12px;
        margin-right:10px;


    }
    .v1{
        float:left;
        width:160px;
        height:36px;
        margin-left:40px;
        line-height:36px;
        color:#333;
        font-size:12px;
    }
    .v2{
        float:right;

        width:78px;
        height:36px;
        margin-top: 10px;
    }
    .v3{
        float:right;

        width:78px;
        height:36px;
        margin-top: 6px;
    }
    .onedata{
        width:559px;
        height:35px;
        border-bottom:#dcdcdc 1px solid;
        float:left
    }

</style>
<body style="background-color: #fff">

    <div class="out-box-con">
        <form id="frm" name="frm">
        <!--表格头开始-->
        <div class="head">
            <div class="column1">
                模版名称
            </div>
            <div class="column2">
                管理文件
            </div>
            <div class="column3">
                设为默认
            </div>
        </div>
        <!--表格头结束-->

      <div id="templet_list">
          <div class="onedata">
            <div class="v1">
                标准模板
            </div>
            <div class="v2">
                <a href="javascript:;"></a>
            </div>
            <div class="v3">
                <input name="isuse" type="radio" value="0" data-id="0"/>
            </div>
          </div>

          {loop $templet_list $v}
            <div class="onedata" id="tpl_{$v['id']}">
              <div class="v1">
                  {$v['path']}
              </div>
              <div class="v2">
                  <a href="javascript:;" class="row-mod-btn" data-path="{$v['path']}" ></a>
                  &nbsp;&nbsp;&nbsp; <a href="javascript:;"  data-path="{$v['path']}" class="row-del-btn"></a>
              </div>
              <div class="v3">
                  <input name="isuse" type="radio" data-id="{$v['id']}" value="{$v['isuse']}" {if $v['isuse']==1}checked="checked"{/if}/>
              </div>
            </div>
          {/loop}


        </div>

       <input type="hidden" name="pageid" id="pageid" value="{$pageid}">
        </form>
    </div>


   <div style="width:563px; height:30px;float:left ">
       <div style="width:559px; height:30px; margin-left:2px; padding-top: 20px;">
           <a href="#" style="display:block; width:80px; height:22px; float:left; margin:4px 0px">
               <img src="{$GLOBALS['cfg_public_url']}images/shangchuan.png" style="border:0;" onclick="uploadTemplet()" />

           </a>
           <p style="display:block; float:left; height:30px; margin-left:10px; line-height:30px; color:#ff393a; font-size:12px;">
               *模板使用英文字母命名的.zip压缩包上传！
           </p>
           <a href="#" style="display:block; width:110px; height:30px; float:right;">
               <img src="{$GLOBALS['cfg_public_url']}images/shangcheng.png" style="border:0;" />
           </a>
       </div>
   </div>

<script language="JavaScript">



    var editico = "{php echo Common::getIco('edit');}";

    var pageid = "{$pageid}";

    $(function(){

        if($("input[name=isuse]:checked").length==0){
            $('.onedata').first().find('input').attr('checked',true);
        }
        addEvent();

    })

    //添加页面文件浏览事件
    function addEvent()
    {

        $(".v2").find('.row-mod-btn').unbind('click').click(function(){

            var folder = $(this).attr('data-path');
            var url = SITEURL+'filemanager/index/parentkey/templet/itemid/1/folder/'+folder+'/';
            ST.Util.addTab(folder+'模板文件查看',url,1);
            ST.Util.closeDialog();

        })
         $(".v2").find('.row-del-btn').unbind('click').click(function(){

            var path = $(this).attr('data-path');
            var ele=this;
            ST.Util.confirmBox("提示","确定删除？",function() {
                $.ajax({
                    type: 'POST',
                    url: SITEURL + 'templet/ajax_del',
                    data: {path:path},
                    dataType: 'json',
                    success: function (data) {
                        if (data.status) {
                            $(ele).parents('.onedata:first').remove();
                            ST.Util.showMsg('删除成功', 4, 1000);
                        }

                    }

                })
            });

        })

        $(".v3").find('input').unbind('click').click(function(){
            var id = $(this).attr('data-id');

            $.ajax({
                type:'POST',
                url:SITEURL+'templet/ajax_config_save',
                data:{id:id,pageid:pageid},
                dataType:'json',
                success:function(data){
                  if(data.status){
                      ST.Util.showMsg('保存成功',4,1000);
                  }

                }

            })

        })
    }

    //上传模板
    function uploadTemplet()
    {

            var pageid = $("#pageid").val();
            // 上传方法
            $.upload({
                // 上传地址
                url: SITEURL+'templet/ajax_upload_templet',
                // 文件域名字
                fileName: 'filedata',
                fileType: 'zip',
                // 其他表单数据
                params: {pageid: pageid},

                // 上传之前回调,return true表示可继续上传
                onSend: function() {
                    return true;
                },
                // 上传之后回调
                onComplate: function(data) {

                    var data = $.parseJSON(data);
                    //如果上传成功
                    if(data.status&&$("#tpl_"+data.id).length<=0){
                        var html='<div class="onedata" id="tpl_'+data.id+'">'
                            html+='<div class="v1">'+data.path+'</div>';
                            html+='<div class="v2">  <a href="javascript:;" class="row-mod-btn" data-path="'+data.path+'" ></a>'+
                                   '&nbsp;&nbsp;&nbsp; <a href="javascript:;"  data-path="'+data.path+'" class="row-del-btn"></a></div>';
                            html+='<div class="v3"><input name="isuse" type="radio" value="0" data-id="'+data.id+'"/></div>';
                            html+='</div>';
                        $("#templet_list").append(html);
                        addEvent();


                    }



                }
            });





    }

</script>

</body>
</html>