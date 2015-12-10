<!doctype html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="admin/public/css/common.css"/>
    <meta charset="utf-8">
<title>帮助 添加/修改</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css,base2.css'); }
    {php echo Common::getScript("uploadify/jquery.uploadify.min.js,product_add.js,imageup.js"); }
    {php echo Common::getCss('uploadify.css','js/uploadify/'); }
</head>


<body>
	<table class="content-tab">
    <tr>
    <td width="119px" class="content-lt-td"  valign="top">
     {template 'stourtravel/public/leftnav'}
    <!--右侧内容区-->
    </td>
     <td valign="top" class="content-rt-td ">

          <form method="post" name="product_frm" id="product_frm">
          <div class="manage-nr">
              <div class="w-set-tit bom-arrow" id="nav">
                  <span class="on"><s></s>基础信息</span>
                  <a href="javascript:;" class="refresh-btn" onclick="window.location.reload()">刷新</a>
              </div>

               <!--基础信息开始-->
                  <div class="product-add-div">
                      <div class="add-class">
                          <dl>
                              <dt>标题：</dt>
                              <dd>
                                 <input type="text" name="title" id="articlename" class="set-text-xh text_700 mt-2" value="{$info['title']}"/>
                                 <input type="hidden" name="helpid" id="helpid" value="{$info['id']}"/>
                              </dd>
                          </dl>
                          <dl>
                              <dt>分类：</dt>
                              <dd>
                                 <select name="kindid">
                                    <?php
									  foreach($kindlist as $v)
									  {
										  $is_selected=$v['id']==$info['kindid']?'selected="selected"':'';
										  echo "<option value='".$v['id']."' ".$is_selected.">".$v['kindname']."</option>";  
									  }
									?>
                                 </select>    
                              </dd>
                          </dl>
                          <dl>
                              <dt>显示位置：</dt>
                              <dd class="type-sp">
                                   <label><input class="fl mt-8 mr-3" type="checkbox" onClick="chooseAll(this)"/><span class="fl mr-20">全部</span></label>
                                   <?php
								       $selected=is_null($info['type_id']) ? null : explode(',',$info['type_id']);
								       $cnt=1;
                                       foreach($typearr as $k=>$v)
									   {
										  $is_checked=in_array($k,$selected)?'checked="checked"':'';
										  echo "<label><input class='fl mt-8 mr-3' type='checkbox' name='typeid[]' ".$is_checked." value='".$k."'/><span class='fl mr-20'>".$v."</span></label>";
                                          if($cnt % 10==0)
                                              echo "<br/>";
                                           $cnt++;
									   }
								   ?>
                              </dd>
                          </dl>
                         
                          <dl>
                              <dt>文章内容: </dt>
                              <dd style="line-height:20px">
                                  {php Common::getEditor('body',$info['body'],700,400);}
                              </dd>

                          </dl>

                      </div>

                  </div>
              <!--/基础信息结束-->

                  <div class="opn-btn">
                      <a class="normal-btn ml-20" id="btn_save" href="javascript:;">保存</a>
                  </div>

          </div>
        </form>

    </td>
    </tr>
    </table>

	<script>

	$(document).ready(function(){

      
        var action = "{$action}";

     


       
        //保存
        $("#btn_save").click(function(){

               var title = $("#articlename").val();

            //验证名称
             if(articlename==''){
                   $("#nav").find('span').first().trigger('click');
                   $("#articlename").focus();
                   ST.Util.showMsg('请填写帮助标题',5,2000);
               }
               else
               {
                   Ext.Ajax.request({
                       url   :  SITEURL+"help/ajax_save",
                       method  :  "POST",
                       isUpload :  true,
                       form  : "product_frm",
                       datatype  :  "JSON",
                       success  :  function(response, opts)
                       {

                           var text=response.responseText;
                           if(text!='no')
                           {
                              $("#helpid").val(text);
                               ST.Util.showMsg('保存成功!','4',2000);
                           }
                       }});
               }

        })

     });

   function chooseAll(dom)
   {
	   if(Ext.get(dom).is(":checked"))
	   {

		   Ext.get(dom).up('dd').select('input').set({'checked':true},false);
	   }
	   else
	   {
		    Ext.get(dom).up('dd').select('input').set({'checked':false},false);
	   }
   } 


</script>
</body>
</html>
