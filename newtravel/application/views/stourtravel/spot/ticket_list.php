<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>门票管理-思途CMS3.0</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css,plist.css'); }
    {php echo Common::getScript("spot/ticket.js"); }
</head>
<style>
    .x-grid-row td{
        line-height: 30px;
    }
</style>
<body>
<table class="content-tab">
<tr>
<td width="119px" class="content-lt-td"  valign="top">

    <!--左侧导航区-->
    {template 'stourtravel/public/leftnav'}
    <!--右侧内容区-->
</td>
<td valign="top" class="content-rt-td">

    <!--右侧内容区-->
    <div class="content-nr">
    	<!--面包屑-->
    	<div class="crumbs">
            <label>位置：</label>
            首页
            &gt; 产品管理
            &gt; 门票管理
            &gt;  <span>{$position}门票列表</span>
      </div>
        <div class="w-set-tit bom-arrow pt10">
            {template 'stourtravel/spot/ticket_top'}
        </div>
        <div class="w-set-nr">
            <div class="add_menu-btn">
                <a href="javascript:;" class="add-btn-class" onclick="addticket()">添加</a>
            </div>
        </div>
      <div class="content-nr">

          <div id="list_pannel" class="content-nrt">

          </div>

      </div>
    </div>
 </td>
 </tr>
</table>
<input type="hidden" name="spotid" id="spotid" value="{$spotid}"/>
</body>
<script language="JavaScript">
    window.TICKETTYPELIST = {$tickettypelist};
    $(".w-set-tit").find('span').eq(0).addClass('on');

</script>


</html>
