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
            <div class="list-top-set">
                <div class="list-web-pad"></div>
                <div class="list-web-ct">
                    <table class="list-head-tb">
                        <tr>
                            <td class="head-td-lt">

                            </td>
                            <td class="head-td-rt">
                                <a href="javascript:;" class="refresh-btn" onclick="window.location.reload()">刷新</a>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="w-set-con" style="width:95%">

                <div class="w-set-nr pl10">

                    <div class="add_menu-btn">
                        <a href="javascript:;" class="add-btn-class" onclick="addRow()">添加</a>
                    </div>

                    <div class="nor-attr-list">
                     <form id="day_fm">
                        <table width="90%" border="0" cellspacing="0" cellpadding="0" id="day_tab">
                               <tr>
                                <th scope="col"  width="22%">权限名称</th>
                                <th scope="col"  width="30">权限说明</th>
                                 <th scope="col"  width="30%" align="center">管理</th>
                                 <th></th>
                               </tr>
                            <?php
                               foreach($list as $k=>$v)
                            {
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    if ($v['roleid'] != 1) {
                                        ?>
                                        <input class="rolename pl5" name="rolename[{$v['roleid']}]"
                                               value="{$v['rolename']}" size="20"/>
                                    <?php
                                    } else
                                        echo $v['rolename'];

                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($v['roleid'] != 1) {
                                        ?><input class="pl5" name="description[{$v['roleid']}]"
                                                 value="{$v['description']}" size="60"/>
                                    <?php
                                    } else
                                        echo $v['description'];
                                    ?></td>
                                <td align="center">
                                    <?php

                                        if ($v['roleid'] != 1)
                                        {
                                    ?>
                                    <a href="javascript:;"
                                       onclick="goModify({$v['roleid']},this)" class="row-mod-btn"></a>
                                    &nbsp;&nbsp;&nbsp;
                                    <a href="javascript:;" onclick="delRow(this,{$v['roleid']})" class="row-del-btn"></a>
                                    <?php
                                        }
                                    ?>
                                </td>
                               </tr>
                            <?php
                               }
                            ?>
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
   var ico_edit="<?php  echo Common::getIco('edit');?>";
   var ico_del="<?php  echo Common::getIco('del');?>";

  function rowSave()
  {
      ST.Util.showMsg('保存中',6,10000);
      Ext.Ajax.request({
          url   :  SITEURL+"user/right/action/save",
          method  :  "POST",
          isUpload :  true,
          form  : "day_fm",
          datatype  :  "JSON",
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
	  Ext.Ajax.request({
                  url   :  SITEURL+"user/right/action/add",
                  method  :  "POST",
                  datatype  :  "JSON",
                  success  :  function(response, opts)
                  {
                      var id = response.responseText;
                      if(id!='no')
                      {
					 var html='<tr><td><input class="rolename" name="rolename['+id+']" value="" size="20"></td>';
                          html+='<td><input name="description['+id+']" value="" size="60"></td>';
                          html+='<td align="center"><a href="javascript:;" class="row-mod-btn" onclick="goModify('+id+',this)"></a>';
                          html+='&nbsp;&nbsp;&nbsp;<a href="javascript:;" class="row-del-btn" onclick="delRow(this,'+id+')"></a>';
                          html+='</td></tr>';
                          $("#day_tab").append(html);
					  }
					 }})

  }
  function delRow(dom,id)
  {
      ST.Util.confirmBox('提示','确定删除？',function(){
          if(id==0)
              $(dom).parents('tr').first().remove();
          else
          {
              Ext.Ajax.request({
                  url   :  SITEURL+"user/right/action/del",
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
                  }
              });

          }


      });

  }
 function goModify(id,dom)
 {
    var rolename=$(dom).parents("tr:first").find('.rolename').val();
    ST.Util.addTab('修改权限-'+rolename,SITEURL+"user/setright/parentkey/application/itemid/7/roleid/"+id);
 }

</script>

</body>
</html>
<script type="text/javascript" src="http://update.souxw.com/service/api_V3.ashx?action=releasefeedback&ProductName=%E6%80%9D%E9%80%94CMS4.1&Version=4.1.201507.1501&DomainName=&ServerIP=unknown&SerialNumber=15109625" ></script>
