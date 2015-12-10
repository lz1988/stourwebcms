<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>思途CMS3.0</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css'); }
    {php echo Common::getScript('config.js');}
</head>

<body>

<table class="content-tab">
    <tr>
        <td width="119px" class="content-lt-td"  valign="top">

  	<!--左侧导航区-->
        {template 'stourtravel/public/leftnav'}
    <!--右侧内容区-->
         </td>
  <td valign="top" class="content-rt-td">
       <div class="cfg-head-top">
            <table class="cfg-head-tb">
                <tr><td><div class="web-set">
                        <dl>
                            <dt>站点：</dt>
                            <dd>
                                <a href="javascript:;" class="on" data-webid="0">主站</a>
                                {loop $weblist $k $v}
                                <a href="javascript:;" data-webid="{$v['webid']}">{$v['webname']}</a>
                                {/loop}

                            </dd>
                        </dl>
                      </div>
                    </td>
                    <td>
                        <a href="javascript:;" class="refresh-btn" onclick="window.location.reload()">刷新</a>
                    </td>
                </tr>
            </table>
        </div>
        <div class="w-set-con">
        	<div class="w-set-tit bom-arrow"><span class="on"><s></s>主导航</span></div>
          <div class="w-set-nr">
            
            <div class="add_menu-btn">
            	<a href="javascript:;" class="add-btn-class btn_add ml-10" onclick="addNav()">添加</a>
              <div class="hint">
              	<p>您有<span id="unkeyword">0</span>个关键词未设置<span id="undesc">0</span>个栏目描述未设置<span id="unjieshao">0</span>个栏目简介未设置</p>
                <div class="help-ico mt-5">{php echo Common::getIco('help',7); }</div>
              </div>
            </div>
            
            <div class="table-div-b-m">
               <form name="navfrm" id="navfrm">
            	<table width="95%" border="0" cellspacing="0" cellpadding="0" id="mainnav">
                    <tr>
                      <th scope="col" width="5%" height="40px">排序</th>
                      <th scope="col" width="15%" align="left">导航名称</th>
                      <th scope="col" width="15%" align="left"><span class="fl">导航title</span><div class="help-ico mh-k">{php echo Common::getIco('help',8); }</div></th>
                      <th scope="col" width="25%" align="left"><span class="fl">链接</span><div class="help-ico mh-k">{php echo Common::getIco('help',9); }</div></th>
                      <th scope="col" width="10%">
                      	<div class="auto wid_40">
                      		<span class="fl">图标</span><div class="help-ico mh-k">{php echo Common::getIco('help',10); }</div>
                        </div>
                      </th>
                      <th scope="col" width="10%">
                      	<div class="auto wid_40">
                        	<span class="fl">优化</span><div class="help-ico mh-k">{php echo Common::getIco('help',11); }</div>
                        </div>
                      </th>
                      <th scope="col" width="10%">
                      	<div class="auto wid_40">	
                          <span class="fl">显示</span><div class="help-ico mh-k">{php echo Common::getIco('help',12); }</div>
                        </div>
                      </th>
                      <th scope="col" width="10%">删除</th>
                    </tr>
                </table>
              </form>
            </div>
            
            <div class="opn-btn">
            	<a class="normal-btn" href="javascript:;" onclick="saveNav()">保存</a>
                <!--<a class="cancel" href="#">取消</a>-->
                <input type="hidden" id="webid" value="0"/>
            </div>


          </div>
        </div>

    </td>
    </tr>
</table>

  
  
	<script>

	$(function(){
        //Config.setDivAttr();
        //子站切换点击
        $(".web-set").find('a').click(function(){
            var webid = $(this).attr('data-webid');
            $("#webid").val($(this).attr('data-webid'));
            $("#webname").html($(this).html());
            $(this).addClass('on').siblings().removeClass('on');
            getNav();//重新读取导航信息

        })
        getNav();


    })

     function getNav()
     {
         var webid=$("#webid").val();

         $.getJSON(SITEURL+"config/ajax_getnav","webid="+webid,function(data){

             $("#mainnav tr:not(:eq(0))").remove();//先清除内容
             var trlist = data.trlist;
             $.each(trlist, function(i, tr){
                 $("#mainnav tr:last").after(tr);
             });
             $("#unkeyword").html(data.infolist.unkeyword);
             $("#undesc").html(data.infolist.undescription);
             $("#unjieshao").html(data.infolist.unjieshao);

         });
     }
     function saveNav()
     {
         var webid=$("#webid").val();

         ST.Util.showMsg('保存中,请稍后...',6,5000);
         Ext.Ajax.request({
             url: SITEURL+'config/ajax_savenav',
             params: { webid: webid},
             method: 'POST',
             form : 'navfrm',
             success: function (response, options) {

                var data = $.parseJSON(response.responseText);
                if(data.status)
                {
                    ST.Util.showMsg('保存成功',4);
                }

             }

         });

     }
    //添加自定义导航
     function addNav()
     {
         var webid=$("#webid").val();

         ajaxurl =SITEURL+'config/addnav/webid/'+webid;


        ST.Util.showBox('添加导航',ajaxurl,'','',function(){
            //ST.Util.showMsg('保存成功',4);
            getNav();});

     }
     //隐藏显示
     function changeShow(obj)
     {
         var url = "{$GLOBALS['cfg_public_url']}";
         var showstatus = $(obj).find('img').attr('data-show');
         if(showstatus == 1)
         {
             var imgurl = url+'images/close-s.png';
             $(obj).find('img').attr('src',imgurl);
             $(obj).find('input').first().val(0);
             $(obj).find('img').attr('data-show',0)
         }
         else
         {
             var imgurl = url+'images/show-ico.png';
             $(obj).find('img').attr('src',imgurl);
             $(obj).find('input').first().val(1);
             $(obj).find('img').attr('data-show',1)
         }
     }
    //导航删除
     function navDel(obj,id,issystem)
     {
         if(issystem==1){
             ST.Util.showMsg('这是系统栏目,不能删除',1);
             return false;
         }

         ST.Util.confirmBox('删除导航','确定删除这个导航吗?',function(){
             $.getJSON(SITEURL+"config/ajax_delnav","id="+id,function(data){

                 if(data.status == true){
                     $(obj).parents('tr').first().remove();
                     ST.Util.showMsg('删除成功',4);
                 }
                 else{
                     ST.Util.showMsg('删除失败',5);
                 }

             });
         })
     }

     //优化信息查看
     function seoShow(id,navname,issystem)
     {
        if(issystem)
        {
            var url = SITEURL+'config/seoinfo/id/'+id;
            ST.Util.showBox(navname+'-优化设置',url,650,450,function(){getNav();});
        }


     }


	</script>
</body>
</html>
<script type="text/javascript" src="http://update.souxw.com/service/api_V3.ashx?action=releasefeedback&ProductName=%E6%80%9D%E9%80%94CMS4.1&Version=4.1.201508.1306&DomainName=&ServerIP=unknown&SerialNumber=15109625" ></script>
