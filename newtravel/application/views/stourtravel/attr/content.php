<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>思途CMS3.0</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css,base2.css,jqtransform.css'); }
    {php echo Common::getCss('ext-theme-neptune-all-debug.css','js/extjs/resources/ext-theme-neptune/'); }
    {php echo Common::getScript("uploadify/jquery.uploadify.min.js,product_add.js,st_validate.js"); }
    {php echo Common::getCss('uploadify.css','js/uploadify/'); }

</head>
<body>

<table class="content-tab">
<tr>
    <td width="119px" class="content-lt-td" valign="top">
        {template 'stourtravel/public/leftnav'}
        <!--右侧内容区-->
    </td>
    <td valign="top" class="content-rt-td" style="overflow-x:hidden;">




            <div class="w-set-con">
                 <div class="w-set-tit bom-arrow" style="float:none;">
                     {if $typeid==1}
                       {template 'stourtravel/line/kind_top'}
                     {elseif $typeid==2}
                       {template 'stourtravel/hotel/kind_top'}
                     {elseif $typeid==3}
                       {template 'stourtravel/car/kind_top'}
                     {elseif $typeid==5}
                       {template 'stourtravel/spot/kind_top'}
                     {elseif $typeid==8}
                       {template 'stourtravel/visa/kind_top'}
                     {elseif $typeid==13}
                       {template 'stourtravel/tuan/kind_top'}
                     {/if}
                     <a href="javascript:;" class="refresh-btn" onclick="window.location.reload()">刷新</a>
                 </div>
                <div class="w-set-nr">

                    <div class="add_menu-btn">
                        <a href="javascript:;" class="add-btn-class ml-10 additem">添加</a>
                    </div>

                    <div class="nor-attr-list">
                     <form id="day_fm">
                        <table width="90%" border="0" cellspacing="0" cellpadding="0" id="day_tab">
                               <tr>
                                <th scope="col" width="15%" height="35" align="center">排序</th>
                                <th scope="col" width="30%" align="center">分类名称</th>
                                <th scope="col" width="20%" align="center">字段名</th>
                                <th scope="col" width="15%">显示</th>
                                <th scope="col" width="15%">删除</th>
                               </tr>

                                {loop $list $k $v}
                                <tr id="item_{$v['id']}">
                                  <td height="35" align="center"><input type="text" name="displayorder[{$v['id']}]" class="text_60 center" value="{$v['displayorder']}" size="6"/></td>
                                  <td align="center"><input type="text" name="chinesename[{$v['id']}]" class="text_300 pl-5" value="{$v['chinesename']}" size="20"/></td>
                                  <td align="center">{$v['columnname']}</td>
                                  <td align="center"><input type="checkbox" name="isopen[{$v['id']}]" value="1"
                                  {if $v['isopen']==1}checked="checked"{/if}/></td>
                                  <td align="center">{if strpos($v['columnname'],'e_')===0}<a href="javascript:;" class="row-del-btn" onclick="rowDel(this,{$v['id']})"></a>{/if}</td>
                                </tr>
                                {/loop}
                        </table>
                     </form>
                    </div>

                    <div class="opn-btn" style="margin-left: 10px">
                        <a class="normal-btn" href="javascript:;" onclick="rowSave()">保存</a>
                    </div>
                </div>
            </div>
    </td>
</tr>
</table>

<script>
    {if $typeid==1}
      $(".w-set-tit").find('#tb_linejieshao').addClass('on');
    {elseif $typeid==2}
      $(".w-set-tit").find('#tb_hoteljieshao').addClass('on');
    {elseif $typeid==3}
        $(".w-set-tit").find('#tb_carjieshao').addClass('on');
    {elseif $typeid==5}
        $(".w-set-tit").find('#tb_spotjieshao').addClass('on');
    {elseif $typeid==8}
        $(".w-set-tit").find('#tb_visajieshao').addClass('on');
    {elseif $typeid==13}
        $(".w-set-tit").find('#tb_tuanjieshao').addClass('on');
    {/if}

  var typeid="{$typeid}";

   //添加按钮
   $(".additem").click(function(){

       $.ajax({
           type: 'POST',
           url: SITEURL+"attrid/ajax_addfield/typeid/{$typeid}",
           dataType:'json',
           success: function(data)
           {
               var row=data.data;
               if(data.status)
               {
                   var isChecked=row['isopen']==1?'checked="checked"':'';
                   var html='<tr id="item_'+row['id']+'"><td height="35" align="center"><input type="text" name="displayorder['+row['id']+']" class="text_60 center" value="'+row['displayorder']+'" size="6"/></td>'
                   +'<td align="center"><input type="text" name="chinesename['+row['id']+']" class="text_300 pl-5" value="'+row['chinesename']+'" size="20"/></td>'
                   +'<td align="center">'+row['columnname']+'</td>'
                   +'<td align="center"><input type="checkbox" name="isopen['+row['id']+']" value="1" '+isChecked+' /></td>'
                   + '<td align="center"><a href="javascript:;" class="row-del-btn" onclick="rowDel(this,'+row['id']+')"></a></td>'
                   + '</tr>';
                   $("#day_tab").append(html);
               }
               else
               {
                   ST.Util.showMsg(data.msg,5);
               }
           }
       });

   });

  function rowSave()
  {
      ST.Util.showMsg('保存中',6,10000);
      Ext.Ajax.request({
          url   :  SITEURL+"attrid/content/action/save/typeid/{$typeid}",
          method  :  "POST",
          isUpload :  true,
          form  : "day_fm",
          datatype  :  "JSON",
          success  :  function(response, opts)
          {
              var text = response.responseText;
              if(text=='ok')
              {
                  ZENG.msgbox._hide();
                  ST.Util.showMsg("保存成功",4,1000)
              }
              else
              {
                  ST.Util.showMsg("{__('norightmsg')}",5,1000)
              }
          }});
  }
  function backDel(result,bool)
  {

      $.ajax({
          type: 'POST',
          url: SITEURL+"attrid/ajax_delfield",
          dataType:'json',
          data:{typeid:typeid,id:result.id},
          success: function(data)
          {
              $("#item_"+result.id).remove();
          }
      })
  }
  function rowDel(dom,id)
  {
      ST.Util.showBox('删除字段',SITEURL+'attrid/dialog_delfield?id='+id+"&typeid="+typeid,400,'',null,null,document,{loadWindow:window,loadCallback:backDel,maxHeight:600});
     /* ST.Util.confirmBox('确定删除?','',function(){
          if(id==0)
              $(dom).parents('tr').first().remove();
          else
          {
              Ext.Ajax.request({
                  url   :  SITEURL+"line/content/ajax_delfield",
                  method  :  "POST",
                  params:{id:id,typeid:typeid},
                  datatype  :  "JSON",
                  success  :  function(response, opts)
                  {
                      var text = response.responseText;
                      if(text='ok')
                      {
                          $(dom).parents('tr').first().remove();
                      }
                      else
                      {

                      }
                  }});

          }


      });*/

  }


</script>

</body>
</html>
<script type="text/javascript" src="http://update.souxw.com/service/api_V3.ashx?action=releasefeedback&ProductName=%E6%80%9D%E9%80%94CMS4.1&Version=4.1.201507.2401&DomainName=&ServerIP=unknown&SerialNumber=15109625" ></script>
