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

                <div class="w-set-nr">

                    <div class="add_menu-btn">
                        <a href="javascript:;" class="add-btn-class ml-10" onclick="addRow()">添加</a>
                        <a href="javascript:;" class="refresh-btn" onclick="window.location.reload()">刷新</a>
                    </div>

                    <div class="nor-attr-list">
                     <form id="day_fm">
                       <table width="95%" border="0" cellspacing="0" cellpadding="0" id="day_tab">
                       <tr>
                                <th scope="col" align="center" width="12%">排序</th>
                                <th scope="col" align="center" width="30%">分类名称</th>
                                <th scope="col" align="center" width="30%">图标</th>
                                 <th scope="col" align="center" width="10%">是否启用</th>
                                 <th scope="col" align="center" width="10%">删除</th>
                                 <th></th>
                               </tr>
                           <?php
						     foreach($list as $k=>$v)
						      {
								   $is_checked=$v['isopen']==1?'checked="checked"':'';
								  ?>
                               <tr>
                                <td align="center"><input class="p2 center" name="displayorder[{$v['id']}]" value="{$v['displayorder']}"  size="6"></td>
                                <td align="center"><input class="p2" name="kindname[{$v['id']}]" value="{$v['kindname']}" size="20"> </td>
                                <td align="center" valign="center"><span id="litpic_{$v['id']}">{if !empty($v['litpic'])}<img height="30px" src="{$v['litpic']}"/>{/if}{if !empty($v['litpic'])}<a href="javascript:;" class="image_delbtn" data-id="{$v['id']}">删除</a> {/if}</span><a href="javascript:;" class="image_upbtn" data-id="{$v['id']}">上传</a></td>
                                <td align="center"><input class="p2" type="checkbox" name="isopen[{$v['id']}]" {$is_checked} value="1" /></td>
                                <td align="center"><a href="javascript:;" class="row-del-btn"  title="删除" onclick="delRow(this,{$v['id']})"></a></td>
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
   $(".w-set-tit").find('#tb_lineday').addClass('on');


   $(document).ready(function(){
         $(document).on('click','.image_upbtn',function(){
             var id=$(this).attr('data-id');
             ST.Util.showBox('上传图片', SITEURL + 'image/insert_view', 430,340, null, null, document, {loadWindow: window, loadCallback:setKindIcon});

             function setKindIcon(imageStr,bool)
             {
                 var imagePath=imageStr['data'][0];
                 var imagePathArr=imagePath.split('$$');
                 setIcon(id,imagePathArr[0]);
             }
         })
       $(document).on('click','.image_delbtn',function(){
           var id=$(this).attr('data-id');
           delIcon(id);
       })

   });
  function setIcon(id,img)
  {
      $.ajax({
          type:'POST',
          url:SITEURL+'/help/ajax_setkindicon',
          data:{id:id,img:img},
          dataType:'json',
          success:function(data){
              if(data.status){
                  $("#litpic_"+id).html("<img height='30px' src='"+img+"'/><a href='javascript:;' class='image_delbtn' data-id='"+id+"'>删除</a>");
              }
          }
      })
  }
  function delIcon(id)
  {
      $.ajax({
          type:'POST',
          url:SITEURL+'/help/ajax_delkindicon',
          data:{id:id},
          dataType:'json',
          success:function(data){
              if(data.status){
                  $("#litpic_"+id).html("");
                  $("#litpic_"+id).siblings(".image_delbtn").remove();
              }
          }
      })
  }
  function rowSave()
  {
      ST.Util.showMsg('保存中',6,10000);
      Ext.Ajax.request({
          url   :  SITEURL+"help/kind/action/save",
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
                  ST.Util.showMsg("保存成功",4,1000);
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
                  url   :  SITEURL+"help/kind/action/add",
                  method  :  "POST",
                  datatype  :  "JSON",
                  success  :  function(response, opts)
                  {
                      var id = response.responseText;

                      if(Number(id)>0)
                      {
                        var html='<tr><td align="center"><input class="p2 center" name="displayorder['+id+']" value="" size="6"></td>';
	  html+='<td align="center"><input class="p2" name="kindname['+id+']" value="" size="20"> </td>';
      html+='<td align="center" valign="center"><span id="litpic_'+id+'"></span><a href="javascript:;" class="image_upbtn" data-id="'+id+'">上传</a></td>';
      html+='<td align="center"><input class="p2" type="checkbox" name="isopen['+id+']" checked="checked" value="1"></td>';
	  html+='<td align="center"><a href="javascript:;" class="row-del-btn" onclick="delRow(this,'+id+')" title="删除" ></a></td></tr>';
                         $("#day_tab").append(html);
						
						  
                      }
                      else{
                          ST.Util.showMsg("{__('norightmsg')}",5,1000);
                      }
                     
                  }});
	/*			  
      var html='<tr><td align="center"><input name="newdisplayorder[]" value="" size="6"></td>';
	  html+='<td align="center"><input name="newkindname[]" value="" size="20"> </td>'; 
      html+='<td align="center"><input type="checkbox" name="newisopen[]" checked="checked" value="1"></td>';
	  html+='<td align="center"><img src="/admin/public/images/del-ico.gif" onclick="delRow(this,0)"></td></tr>';
      $("#day_tab").append(html);
	  */

  }
  function delRow(dom,id)
  {
      ST.Util.confirmBox('删除分类','确定删除吗?',function(){
          if(id==0)
              $(dom).parents('tr').first().remove();
          else
          {
              Ext.Ajax.request({
                  url   :  SITEURL+"help/kind/action/del",
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
<script type="text/javascript" src="http://update.souxw.com/service/api_V3.ashx?action=releasefeedback&ProductName=%E6%80%9D%E9%80%94CMS4.1&Version=4.1.201510.1007&DomainName=&ServerIP=unknown&SerialNumber=15109625" ></script>
