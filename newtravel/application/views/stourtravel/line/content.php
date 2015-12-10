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


        <div class="content-nr" style="height: 351px;">
            <div class="crumbs">
                <label>位置：</label>首页 &gt; 设置中心 &gt; 基础设置 &gt; <span>线路行程</span>
            </div>
            <div class="web-set">

            </div>
            <div class="w-set-con">
                 <div class="w-set-tit bom-arrow" style="float:none;">
                {template 'stourtravel/line/kind_top'}
                 </div>
                <div class="w-set-nr">

                    <div class="add_menu-btn">
                        <a href="javascript:;" class="add-btn-class ml-10 additem">添加</a>
                    </div>

                    <div class="nor-attr-list">
                     <form id="day_fm">
                        <table width="90%" border="0" cellspacing="0" cellpadding="0" id="day_tab">
                               <tr>
                                <th scope="col" width="5%" height="35" align="center">排序</th>
                                <th scope="col" width="45%" align="center">分类名称</th>
                                <th scope="col" width="45%" align="center">字段名</th>
                                <th scope="col" width="5%">显示</th>
                               </tr>

                                {loop $list $k $v}
                                <tr>
                                  <td height="35" align="center"><input type="text" name="displayorder[{$v['id']}]" class="text_60 center" value="{$v['displayorder']}" size="6"/></td>
                                  <td align="center"><input type="text" name="chinesename[{$v['id']}]" class="text_300 pl-5" value="{$v['chinesename']}" size="20"/></td>
                                  <td align="center">{$v['columnname']}</td>
                                  <td align="center"><input type="checkbox" name="isopen[{$v['id']}]" value="1"
                                  {if $v['isopen']==1}checked="checked"{/if}/></td>
                                </tr>
                                {/loop}
                        </table>
                     </form>
                    </div>

                    <div class="opn-btn" style="margin-left: 10px">
                        <a class="save" href="javascript:;" onclick="rowSave()">保存</a>
                    </div>
                </div>
            </div>
        </div>
    </td>
</tr>
</table>

<script>
   $(".w-set-tit").find('#tb_linejieshao').addClass('on');

   //添加按钮
   $(".additem").click(function(){
       var url=SITEURL+"box/add_extend_field/typeid/1";
       ST.Util.showBox('添加线路内容项',url,450,'',function(){window.location.reload()});
   });

  function rowSave()
  {
      ST.Util.showMsg('保存中',6,10000);
      Ext.Ajax.request({
          url   :  SITEURL+"line/content/action/save",
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
  /*function addRow()
  {
	  window.newrow=window.newrow?window.newrow:1;
	  
      var html='<tr><td align="center"><input type="text" name="newdisplayorder['+window.newrow+']" value="" size="6"></td>';
	  html+='<td align="center"><input type="text" name="newchinesename['+window.newrow+']" value="" size="20"></td><td></td>'
      html+='<td align="center"><input type="checkbox" name="newisopen['+window.newrow+']" checked="checked" value="1"/></td></tr>';
      $("#day_tab").append(html);
	  window.newrow++;

  }*/
 /* function delRow(dom,id)
  {
      ST.Util.confirmBox('确定删除?','',function(){
          if(id==0)
              $(dom).parents('tr').first().remove();
          else
          {
              Ext.Ajax.request({
                  url   :  SITEURL+"line/content/action/del",
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

  }*/


</script>

</body>
</html>
