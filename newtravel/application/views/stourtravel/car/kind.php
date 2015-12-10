<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>思途CMS3.0</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css,base2.css,jqtransform.css'); }
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
                {template 'stourtravel/car/kind_top'}
                     <a href="javascript:;" class="refresh-btn" onclick="window.location.reload()">刷新</a>
                 </div>
                <div class="w-set-nr">

                    <div class="add_menu-btn">
                        <a href="javascript:;" class="add-btn-class ml-10" onclick="addRow()">添加</a>
                    </div>

                    <div class="nor-attr-list">
                     <form id="day_fm">
                        <table width="95%" border="0" cellspacing="0" cellpadding="0" id="day_tab">
                               <tr>
                                <th scope="col" align="center" width="12%" align="center">排序</th>
                                <th scope="col" align="center" width="30%">车型</th>
                                 <th scope="col" align="center" width="30%">优化标题</th>
                                 <th scope="col" align="center" width="30%">删除</th>
                                 <th></th>
                               </tr>

                              {loop $list $k $v}
                               <tr>
                                <td align="center"><input class="p2 center" name="displayorder[{$v['id']}]" value="{$v['displayorder']}" size="6"/></td>
                                <td align="center"><input class="p2" name="kindname[{$v['id']}]" value="{$v['kindname']}" size="20"/> </td>
                                <td align="center"><input class="p2" name="title[{$v['id']}]" value="{$v['title']}" size="30" /></td>
                                <td align="center"><a href="javascript:;" class="row-del-btn" onclick="delRow(this,'{$v['id']}')" title="删除"></a></td>
                               </tr>
                             {/loop}
                        </table>
                     </form>
                    </div>

                    <div class="opn-btn">
                        <a class="normal-btn" href="javascript:;" onclick="rowSave()">保存</a>
                    </div>
                </div>
            </div>
    </td>
</tr>
</table>

<script>
   $(".w-set-tit").find('#tb_cartype').addClass('on');




  function rowSave()
  {

      Ext.Ajax.request({
          url   :  SITEURL+"car/kind/action/save",
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
                  ST.Util.showMsg("{__('norightmsg')}",5,1000);
              }


          }});

  }
  function addRow()
  {
	  Ext.Ajax.request({
                  url   :  SITEURL+"car/kind/action/add",
                  method  :  "POST",
                  datatype  :  "JSON",
                  success  :  function(response, opts)
                  {
                      var id = response.responseText;
                      if(id!='no')
                      {
					  var html='<tr><td align="center"><input class="p2" class="center" name="displayorder['+id+']" size="6"></td>';
					  html+='<td align="center"><input class="p2" name="kindname['+id+']"  size="20"> </td>';
					  html+='<td align="center"><input class="p2" name="title['+id+']" size="30"></td>';
					  html+='<td align="center"><a href="javascript:;" class="row-del-btn" onclick="delRow(this,'+id+')" title="删除"></a></td></tr>';
					  $("#day_tab").append(html);
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
                  url   :  SITEURL+"car/kind/action/del",
                  method  :  "POST",
                  params:{id:id},
                  datatype  :  "JSON",
                  success  :  function(response, opts)
                  {
                      var text = response.responseText;
                      if(text=='ok')
                      {
                          $(dom).parents('tr').first().remove();
                      }
                      else
                      {
                          ST.Util.showMsg("{__('norightmsg')}",5,1000);
                      }
                  }});

          }


      });

  }


</script>

</body>
</html>
