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


        <div class="content-nr" style="height: 351px;">
            <div class="crumbs">
                <label>位置：</label>首页 &gt; 设置中心 &gt; 租车设置 &gt; <span>套餐类型</span>
            </div>
            <div class="web-set">

            </div>
            <div class="w-set-con">
                <div class="w-set-nr">
                    <div class="add_menu-btn">
                        <a href="javascript:;" class="add-btn-class" onclick="addRow()">添加</a>
                    </div>
                    <div class="nor-attr-list">
                     <form id="day_fm">
                        <table width="95%" border="0" cellspacing="0" cellpadding="0" id="day_tab">
                               <tr>
                                <th scope="col" align="center" width="12%" align="center">排序</th>
                                <th scope="col" align="center" width="30%">类型名称</th>
                                 <th scope="col" align="center" width="30%">删除</th>
                                 <th></th>
                               </tr>
                            <?php
                               foreach($list as $k=>$v)
                               {
                            ?>
                               <tr>
                                <td align="center"><input name="displayorder[{$v['id']}]" value="{$v['displayorder']}" size="6"/></td>
                                <td align="center"><input name="kindname[{$v['id']}]" value="{$v['kindname']}" size="20"/> </td>
                                <td align="center"><img src="<?php echo URL::site(); ?>public/images/del-ico.gif" onclick="delRow(this,{$v['id']})" ></td>
                               </tr>
                            <?php
                               }
                            ?>
                        </table>
                     </form>
                    </div>
                    <div class="opn-btn">
                        <a class="save" href="javascript:;" onclick="rowSave()">保存</a>
                    </div>
                </div>
            </div>
        </div>
    </td>
</tr>
</table>

<script>

   var carid="{$carid}";
   $(".w-set-tit").find('#tb_cartype').addClass('on');




  function rowSave()
  {
      ST.Util.showMsg('保存中',6,10000);
      Ext.Ajax.request({
          url   :  SITEURL+"car/suittype/action/save",
          method  :  "POST",
          isUpload :  true,
          form  : "day_fm",
          datatype  :  "JSON",
          params:{carid:carid},
          success  :  function(response, opts)
          {
              var text = response.responseText;
              if(text='ok')
              {
                  ZENG.msgbox._hide();
                  ST.Util.showMsg("保存成功",4)
              }
              else
              {

              }


          }});

  }
  function addRow()
  {
      var html='<tr><td align="center"><input name="newdisplayorder[]" size="6"></td>';
      html+='<td align="center"><input name="newkindname[]"  size="20"> </td>';
      html+='<td align="center"><img src="{$GLOBALS['cfg_public_url']}images/del-ico.gif" onclick="delRow(this,0)"></td></tr>';
      $("#day_tab").append(html);

  }
  function delRow(dom,id)
  {
      ST.Util.confirmBox('确定删除?','',function(){
          if(id==0)
              $(dom).parents('tr').first().remove();
          else
          {
              Ext.Ajax.request({
                  url   :  SITEURL+"car/suittype/action/del",
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
<script type="text/javascript" src="http://update.souxw.com/service/api_V3.ashx?action=releasefeedback&ProductName=%E6%80%9D%E9%80%94CMS4.1&Version=4.1.201507.1501&DomainName=&ServerIP=unknown&SerialNumber=15109625" ></script>
