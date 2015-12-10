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
    <td valign="top" class="content-rt-td" style="overflow:auto;">



            <div class="w-set-con">
                 <div class="w-set-tit bom-arrow" style="float:none;">
                {template 'stourtravel/line/kind_top'}
                     <a href="javascript:;" class="refresh-btn" onclick="window.location.reload()">刷新</a>
                 </div>
                <div class="w-set-nr">

                    <div class="add_menu-btn">
                        <a href="javascript:;" class="add-btn-class ml-10" onclick="addRow()" style="float:left">添加</a>
                    </div>

                    <div class="nor-attr-list">
                     <form id="day_fm">
                        <table width="95%" border="0" cellspacing="0" cellpadding="0" id="day_tab">
                               <tr>
                                <th scope="col" width="50%" height="40" align="center">价格范围</th>
                                <th scope="col" width="50%">删除</th>
                               </tr>
                            <?php

                               foreach($list as $k=>$v)
                               {
                            ?>
                               <tr>
                                <td height="40" class="dayname-td" align="center"><input type="text" name="lowerprice[{$v['id']}]" class="text_150 tc" value="{$v['lowerprice']}">&nbsp;<font color="#f4a460">~</font>&nbsp;<input type="text" name="highprice[{$v['id']}]" class="text_150 tc" value="{$v['highprice']}"/> </td>
                                <td align="center"> <a href="javascript:;" class="row-del-btn" onclick="delRow(this,<?php echo $v['id'];  ?>)" title="删除"></a></td>
                               </tr>
                            <?php
                               }
                            ?>
                        </table>
                     </form>
                    </div>

                    <div class="opn-btn">
                        <a class="normal-btn ml-10" href="javascript:;" onclick="rowSave()">保存</a>
                    </div>
                </div>
            </div>

    </td>
</tr>
</table>

<script>
   $(".w-set-tit").find('#tb_lineprice').addClass('on');




  function rowSave()
  {
      ST.Util.showMsg('保存中',6,10000);
      Ext.Ajax.request({
          url   :  SITEURL+"line/price/action/save",
          method  :  "POST",
          isUpload :  true,
          form  : "day_fm",
          datatype  :  "JSON",
          success  :  function(response, opts)
          {
              var text = response.responseText;
              if(text == 'ok')
              {
                  ZENG.msgbox._hide();
                  ST.Util.showMsg("保存成功",4)
              }
              else
              {
                  ST.Util.showMsg("{__('norightmsg')}",5,1000)
              }


          }});

  }
  function addRow()
  {
	     Ext.Ajax.request({
                  url   :  SITEURL+"line/price/action/add",
                  method  :  "POST",
                  datatype  :  "JSON",
                  success  :  function(response, opts)
                  {
                      var id = response.responseText;
                      if(id!='no')
                      {
      $html='<tr><td class="dayname-td" align="center"><input type="text" name="lowerprice['+id+']" value="" class="text_150 tc">&nbsp;<font color="#f4a460">~</font>&nbsp;<input type="text" class="text_150 tc" name="highprice['+id+']" value=""/></td>';
      $html+='<td align="center"><a href="javascript:;" class="row-del-btn" onclick="delRow(this,'+id+')" title="删除"></a></td></tr>';
      $("#day_tab").append($html);
					  }
				  }})

  }
  function delRow(dom,id)
  {
      ST.Util.confirmBox('提示','确定删除?',function(){
          if(id==0)
              $(dom).parents('tr').first().remove();
          else
          {
              Ext.Ajax.request({
                  url   :  SITEURL+"line/price/action/del",
                  method  :  "POST",
                  params:{id:id},
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


      });

  }


</script>

</body>
</html>
