<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>思途CMS3.0</title>
    <?php echo Common::getScript('jquery-1.8.3.min.js,common.js'); ?>
    <?php echo Common::getCss('index.css,base.css'); ?>

</head>
<body>
<div class="mid_w">
    <!--更新提示-->
    <div class="update-meat">
      <p class="p1 fl">欢迎使用思途CMS！www.stouweb.com已获得授权，受法律保护！</p>
      <p class="p2 fr">系统有新的版本发布，建议升级！<a href="javascript:;">立即升级</a></p>
    </div>

    <!--产品管理-->
    <div class="pro-manage">
      <h3><span>产品管理</span><s class="closed"></s></h3>
      <ul class="pro-ul-list">
      	<li>
        	<div class="top">
          	<img class="fl" src="<?php echo $GLOBALS['cfg_public_url']; ?>images/manage_ico1.png" title="线路" alt="线路" />
            <p>线路</p>
          </div>
          <div class="bom">
          	<a class="ba-1" title="订单" href="javascript:;" onclick="ST.Util.addTab('线路订单','{$cmsurl}order/index/parentkey/order/itemid/1/typeid/1');"><img src="<?php echo $GLOBALS['cfg_public_url']; ?>images/order_ico.png" /></a>
          	<a class="ba-2" title="管理" onclick="ST.Util.addTab('线路','{php echo URL::site();}line/line/parentkey/product/itemid/1');" href="javascript:;"><img src="<?php echo $GLOBALS['cfg_public_url']; ?>images/gl_ico.png" /></a>
          	<a class="ba-3" title="添加" href="javascript:;" onclick="ST.Util.addTab('添加线路','{$cmsurl}line/add/parentkey/product/itemid/1');"><img src="<?php echo $GLOBALS['cfg_public_url']; ?>images/add_ico.png" /></a>
          </div>
        </li>
        <li>
        	<div class="top">
          	<img class="fl" src="<?php echo $GLOBALS['cfg_public_url']; ?>images/manage_ico2.png" title="酒店"  />
            <p>酒店</p>
          </div>
          <div class="bom">
          	<a class="ba-1" title="订单" href="javascript:;" onclick="ST.Util.addTab('酒店订单','{$cmsurl}order/index/parentkey/order/itemid/2/typeid/2');"><img src="<?php echo $GLOBALS['cfg_public_url']; ?>images/order_ico.png"  /></a>
          	<a class="ba-2" title="管理" href="javascript:;" onclick="ST.Util.addTab('酒店','{$cmsurl}hotel/hotel/parentkey/product/itemid/2');"><img src="<?php echo $GLOBALS['cfg_public_url']; ?>images/gl_ico.png" /></a>
          	<a class="ba-3" title="添加" href="javascript:;" onclick="ST.Util.addTab('添加酒店','{$cmsurl}hotel/add/parentkey/product/itemid/2');"><img src="<?php echo $GLOBALS['cfg_public_url']; ?>images/add_ico.png" /></a>
          </div>
        </li>
        <li>
        	<div class="top">
          	<img class="fl" src="<?php echo $GLOBALS['cfg_public_url']; ?>images/manage_ico3.png" title="租车" alt="线路" />
            <p>租车</p>
          </div>
          <div class="bom">
          	<a class="ba-1" title="订单" href="javascript:;" onclick="ST.Util.addTab('租车订单','{$cmsurl}order/index/parentkey/order/itemid/3/typeid/3');"><img src="<?php echo $GLOBALS['cfg_public_url']; ?>images/order_ico.png" /></a>
          	<a class="ba-2" title="管理" href="javascript:;" onclick="ST.Util.addTab('租车','{php echo URL::site();}car/car/parentkey/product/itemid/3',1);"><img src="<?php echo $GLOBALS['cfg_public_url']; ?>images/gl_ico.png" /></a>
          	<a class="ba-3" title="添加" href="javascript:;" onclick="ST.Util.addTab('添加车辆','{$cmsurl}car/add/parentkey/product/itemid/2');" ><img src="<?php echo $GLOBALS['cfg_public_url']; ?>images/add_ico.png" /></a>
          </div>
        </li>
        <li>
        	<div class="top">
          	<img class="fl" src="<?php echo $GLOBALS['cfg_public_url']; ?>images/manage_ico4.png" title="门票" alt="线路" />
            <p>门票</p>
          </div>
          <div class="bom">
          	<a class="ba-1" title="订单" href="javascript:;" onclick="ST.Util.addTab('门票订单','{$cmsurl}order/index/parentkey/order/itemid/5/typeid/5');"><img src="<?php echo $GLOBALS['cfg_public_url']; ?>images/order_ico.png" /></a>
          	<a class="ba-2" title="管理" href="javascript:;" onclick="ST.Util.addTab('门票','{php echo URL::site();}spot/spot/parentkey/product/itemid/4',1);"><img src="<?php echo $GLOBALS['cfg_public_url']; ?>images/gl_ico.png" /></a>
          	<a class="ba-3" title="添加" href="javascript:;" onclick="ST.Util.addTab('添加门票','{$cmsurl}spot/add/parentkey/product/itemid/5');"><img src="<?php echo $GLOBALS['cfg_public_url']; ?>images/add_ico.png" /></a>
          </div>
        </li>
        <li>
        	<div class="top">
          	<img class="fl" src="<?php echo $GLOBALS['cfg_public_url']; ?>images/manage_ico5.png" title="签证" alt="线路" />
            <p>签证</p>
          </div>
          <div class="bom">
          	<a class="ba-1" title="订单" href="javascript:;" onclick="ST.Util.addTab('签证订单','{$cmsurl}order/index/parentkey/order/itemid/8/typeid/8');"><img src="<?php echo $GLOBALS['cfg_public_url']; ?>images/order_ico.png" /></a>
          	<a class="ba-2" title="管理" href="javascript:;" onclick="ST.Util.addTab('签证','{php echo URL::site();}visa/visa/parentkey/product/itemid/5',1);"><img src="<?php echo $GLOBALS['cfg_public_url']; ?>images/gl_ico.png" /></a>
          	<a class="ba-3" title="添加" href="javascript:;" onclick="ST.Util.addTab('添加签证','{$cmsurl}visa/add/parentkey/product/itemid/5');"><img src="<?php echo $GLOBALS['cfg_public_url']; ?>images/add_ico.png" /></a>
          </div>
        </li>
        <li>
        	<div class="top">
          	<img class="fl" src="<?php echo $GLOBALS['cfg_public_url']; ?>images/manage_ico6.png" title="团购" alt="线路" />
            <p>团购</p>
          </div>
          <div class="bom">
          	<a class="ba-1" title="订单" href="javascript:;" onclick="ST.Util.addTab('团购订单','{$cmsurl}order/index/parentkey/order/itemid/13/typeid/13');"><img src="<?php echo $GLOBALS['cfg_public_url']; ?>images/order_ico.png" /></a>
          	<a class="ba-2" title="管理" href="javascript:;" onclick="ST.Util.addTab('团购','{$cmsurl}tuan/tuan/parentkey/product/itemid/6',1);"><img src="<?php echo $GLOBALS['cfg_public_url']; ?>images/gl_ico.png" /></a>
          	<a class="ba-3" title="添加" href="javascript:;" onclick="ST.Util.addTab('添加团购','{$cmsurl}tuan/add/parentkey/product/itemid/6');"><img src="<?php echo $GLOBALS['cfg_public_url']; ?>images/add_ico.png" /></a>
          </div>
        </li>
        <li>
        	<div class="top">
          	<img class="fl" src="<?php echo $GLOBALS['cfg_public_url']; ?>images/manage_ico7.png" title="行程定制" alt="线路" />
            <p>行程定制</p>
          </div>
          <div class="bom">
          	<a class="ba-4" title="订单" href="javascript:;" onclick="ST.Util.addTab('定制订单','{$cmsurl}order/dz/parentkey/order/itemid/14/')"><img src="<?php echo $GLOBALS['cfg_public_url']; ?>images/order_ico.png" /></a>
          </div>
        </li>
      </ul>
    </div>

    <!--文章管理-->
    <div class="pro-manage">
      <h3><span>文章管理</span><s class="closed"></s></h3>
      <ul class="pro-ul-list">
      	<li>
        	<div class="top">
          	<img class="fl" src="<?php echo $GLOBALS['cfg_public_url']; ?>images/manage_ico8.png" title="线路" alt="线路"  />
            <p>文章</p>
          </div>
          <div class="bom">
          	<a class="ba-5" title="管理" href="javascript:;" onclick="ST.Util.addTab('文章','{$cmsurl}article/article/parentkey/article/itemid/1',1);"><img src="<?php echo $GLOBALS['cfg_public_url']; ?>images/gl_ico.png" /></a>
          	<a class="ba-5" title="添加" href="javascript:;" onclick="ST.Util.addTab('添加文章','{$cmsurl}article/add/parentkey/article/itemid/1');"><img src="<?php echo $GLOBALS['cfg_public_url']; ?>images/add_ico.png" /></a>
          </div>
        </li>
        <li>
        	<div class="top">
          	<img class="fl" src="<?php echo $GLOBALS['cfg_public_url']; ?>images/manage_ico9.png" title="酒店" alt="线路" />
            <p>景点</p>
          </div>
          <div class="bom">
          	<a class="ba-5" title="管理" onclick="ST.Util.addTab('景点','{$cmsurl}spot/spot/parentkey/article/itemid/2',1);" href="javascript:;"><img src="<?php echo $GLOBALS['cfg_public_url']; ?>images/gl_ico.png" /></a>
          	<a class="ba-5" title="添加" href="javascript:;" onclick="ST.Util.addTab('添加景点','{$cmsurl}spot/add/parentkey/article/itemid/2',1)"><img src="<?php echo $GLOBALS['cfg_public_url']; ?>images/add_ico.png" /></a>
          </div>
        </li>
        <li>
        	<div class="top">
          	<img class="fl" src="<?php echo $GLOBALS['cfg_public_url']; ?>images/manage_ico10.png" title="租车" alt="线路" />
            <p>相册</p>
          </div>
          <div class="bom">
          	<a class="ba-5" title="管理" href="javascript:;" onclick="ST.Util.addTab('相册','{php echo URL::site();}photo/photo/parentkey/article/itemid/3',1);"><img src="<?php echo $GLOBALS['cfg_public_url']; ?>images/gl_ico.png" /></a>
          	<a class="ba-5" title="添加" href="javascript:;" onclick="ST.Util.addTab('添加相册','{$cmsurl}photo/add/parentkey/article/itemid/3',1)"><img src="<?php echo $GLOBALS['cfg_public_url']; ?>images/add_ico.png" /></a>
          </div>
        </li>
        <li>
        	<div class="top">
          	<img class="fl" src="<?php echo $GLOBALS['cfg_public_url']; ?>images/manage_ico11.png" title="门票" alt="线路" />
            <p>帮助</p>
          </div>
           <div class="bom">
          	<a class="ba-5" title="管理" href="javascript:;" onclick="ST.Util.addTab('帮助','{$cmsurl}help/list/parentkey/article/itemid/6',1);"><img src="<?php echo $GLOBALS['cfg_public_url']; ?>images/gl_ico.png"  /></a>
          	<a class="ba-5" title="添加" href="javascript:;" onclick="ST.Util.addTab('添加帮助','{$cmsurl}help/add/parentkey/article/itemid/6',1)"><img src="<?php echo $GLOBALS['cfg_public_url']; ?>images/add_ico.png" /></a>
          </div>
        </li>
        <li>
        	<div class="top">
          	<img class="fl" src="<?php echo $GLOBALS['cfg_public_url']; ?>images/manage_ico12.png" title="签证" alt="线路"  />
            <p>问答</p>
          </div>
          <div class="bom">
          	<a class="ba-4" title="管理" href="javascript:;" onclick="ST.Util.addTab('问答','{$cmsurl}question/index/parentkey/article/itemid/4')"><img src="<?php echo $GLOBALS['cfg_public_url']; ?>images/gl_ico.png" /></a>
          </div>
        </li>
        <li>
        	<div class="top">
          	<img class="fl" src="<?php echo $GLOBALS['cfg_public_url']; ?>images/manage_ico13.png" title="团购" alt="线路" />
            <p>点评</p>
          </div>
          <div class="bom">
          	<a class="ba-4" title="管理" href="javascript:;" onclick="ST.Util.addTab('评论','{$cmsurl}comment/index/parentkey/article/itemid/5')"><img src="<?php echo $GLOBALS['cfg_public_url']; ?>images/gl_ico.png" /></a>
          </div>
        </li>
      </ul>
    </div>

    <!--设置中心-->
    <div class="set-up">
    	<h3><span>设置中心</span><s class="closed"></s></h3>
      <div class="box-list">
      	<dl>
        	<dt><a href="javascript:;">基础设置</a></dt>
          <dd>
              <?php
                $sub = Common::getConfig('menu_sub.basic');
                foreach($sub as $row)
                {
                    echo "<a href='javascript:;' data-url='".$row['url']."'>".$row['name']."</a>";
                }

              ?>

          </dd>
        </dl>
        <dl>
        	<dt><a href="javascript:;">分类设置</a></dt>
          <dd>
              <?php
              $sub = Common::getConfig('menu_sub.kind');
              foreach($sub as $row)
              {
                  echo "<a href='javascript:;' data-url='".$row['url']."'>".$row['name']."</a>";
              }

              ?>

          </dd>
        </dl>
        <dl>
        	<dt><a href="javascript:;">模板管理</a></dt>
          <dd>
              <?php
              $sub = Common::getConfig('menu_sub.templet');
              foreach($sub as $row)
              {
                  echo "<a href='javascript:;' data-url='".$row['url']."'>".$row['name']."</a>";
              }

              ?>
          </dd>
        </dl>

        <dl>
        	<dt><a href="javascript:;">系统设置</a></dt>
          <dd>
              <?php
              $sub = Common::getConfig('menu_sub.system');
              foreach($sub as $row)
              {
                  echo "<a href='javascript:;' data-url='".$row['url']."'>".$row['name']."</a>";
              }

              ?>
          </dd>
        </dl>
         <dl>
        	<dt><a href="javascript:;">营销策划</a></dt>
          <dd>
              <?php
              $sub = Common::getConfig('menu_sub.sale');
              foreach($sub as $row)
              {
                  echo "<a href='javascript:;' data-url='".$row['url']."'>".$row['name']."</a>";
              }

              ?>
          </dd>
        </dl>
      </div>
    </div>

    <!--运营管理-->
    <div class="business">
    	<h3><span>运营管理</span><s class="closed"></s></h3>
      <div class="member">
      	<ul class="fl">
        	<li>
          	<a class="fl" href="javascript:;"  onclick="ST.Util.addTab('会员','{$cmsurl}member/index/parentkey/member/itemid/1',1)">
              <p class="p1"><img src="<?php echo $GLOBALS['cfg_public_url']; ?>images/mb_head.png" alt="会员管理" title="会员管理" /></p>
              <p class="p2">会员管理</p>
            </a>
          </li>
            <li>
                <a class="fl" href="javascript:;"  onclick="ST.Util.addTab('供应商','{$cmsurl}supplier/index/parentkey/member/itemid/2')">
                    <p class="p1"><img src="<?php echo $GLOBALS['cfg_public_url']; ?>images/mb_head.png"  /></p>
                    <p class="p2">供应商管理</p>
                </a>
            </li>
        	<li>
          	<a class="fl" href="javascript:;" onclick="ST.Util.addTab('会员','{$cmsurl}member/index/parentkey/member/itemid/1',1)">
              <p class="p1"><img src="<?php echo $GLOBALS['cfg_public_url']; ?>images/mb_add.png" alt="添加会员" title="添加会员" /></p>
              <p class="p2">添加会员</p>
            </a>
          </li>
        	<li>
          	<a class="fl" href="javascript:;">
              <p class="p1">20</p>
              <p class="p2">今日新增</p>
            </a>
          </li>
          <li>
          	<a class="fl" href="javascript:;">
              <p class="p1">654</p>
              <p class="p2">全部会员</p>
            </a>
          </li>
        </ul>
      </div>

      <!--智能助手-->
      <div class="helper">
      	<dl>
        	<dt>智能助手</dt>
          <dd>
              <?php
              $sub = Common::getConfig('menu_sub.tool');
              foreach($sub as $row)
              {
                  echo "<a href='javascript:;' data-url='".$row['url']."'>".$row['name']."</a>";
              }

              ?>
          </dd>
        </dl>
      </div>

      <!--增值应用-->
      <div class="apply">
      	<dl>
        	<dt>增值应用</dt>
          <dd>

              <?php
              $sub = Common::getConfig('menu_sub.application');
              foreach($sub as $row)
              {
                  echo "<a href='javascript:;' data-url='".$row['url']."'>".$row['name']."</a>";
              }

              ?>
          </dd>
        </dl>
      </div>

    </div>

    <!--思途营销-->
    <div class="market">
    	<h3><span>思途营销</span></h3>
      <ul>
      	<li><s>·</s><a href="javascript:;" target="_blank">[经营管理]</a><a class="max" href="javascript:;" target="_blank">以用户互动为核心的旅游营销策略以用户互动为核心的旅游营销策略以用户互动为核心的旅游营销策略</a></li>
        <li><s>·</s><a href="javascript:;" target="_blank">[经营管理]</a><a class="max" href="javascript:;" target="_blank">以用户互动为核心的旅游营销策略以用户互动为核心的旅游营销策略以用户互动为核心的旅游营销策略</a></li>
        <li><s>·</s><a href="javascript:;" target="_blank">[经营管理]</a><a class="max" href="javascript:;" target="_blank">以用户互动为核心的旅游营销策略以用户互动为核心的旅游营销策略以用户互动为核心的旅游营销策略</a></li>
        <li><s>·</s><a href="javascript:;" target="_blank">[经营管理]</a><a class="max" href="javascript:;" target="_blank">以用户互动为核心的旅游营销策略以用户互动为核心的旅游营销策略以用户互动为核心的旅游营销策略</a></li>
        <li><s>·</s><a href="javascript:;" target="_blank">[经营管理]</a><a class="max" href="javascript:;" target="_blank">以用户互动为核心的旅游营销策略以用户互动为核心的旅游营销策略以用户互动为核心的旅游营销策略</a></li>
        <li><s>·</s><a href="javascript:;" target="_blank">[经营管理]</a><a class="max" href="javascript:;" target="_blank">以用户互动为核心的旅游营销策略以用户互动为核心的旅游营销策略以用户互动为核心的旅游营销策略</a></li>
      </ul>
      <div class="column">
      	<a href="javascript:;">SEO优化</a>
      	<a href="javascript:;">社会化</a>
      	<a href="javascript:;">整合营销</a>
      	<a href="javascript:;">行业</a>
      	<a href="javascript:;">经营管理</a>
      </div>
    </div>

    <!--关于思途-->
    <div class="about">
    	<h3><span>关于思途</span></h3>
      <dl>
      	<dt>版权所有：</dt>
        <dd>成都梦旅程网络科技有限公司</dd>
      </dl>
      <dl>
      	<dt>系统授权：</dt>
        <dd>《思途CMS软件授权合同》</dd>
      </dl>
      <dl>
      	<dt>开发团队：</dt>
        <dd>Netman、Nabo、Snake、wang、豆子、孜龍、许强、邓顺元</dd>
      </dl>
      <dl>
      	<dt>优化团队：</dt>
        <dd>讨口子、镀金尐鋤頭、泉水叮咚、华生、浩然 、雪樱、小芳、思琦</dd>
      </dl>
      <dl>
      	<dt>官方网站：</dt>
        <dd>www.stouweb.com</dd>
      </dl>
    </div>

  </div>
<script language="JavaScript">
    $(function(){
        //box-list
        $('.box-list,.helper,.apply').find('a').click(function(){
            var title = $(this).html();
            var url = $(this).attr('data-url');
            ST.Util.addTab(title,url);
        })
    })
</script>
</body>
</html>

