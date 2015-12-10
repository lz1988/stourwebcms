<?php
/****---修正版子菜单-----*/
return array(
       'line'=>array(
						array('name'=>'添加线路','url'=>'line_info.php?dopost=add','subpage'=>'add')

	   ),
	   'hotel'=>array(
						
						array('name'=>'添加酒店','url'=>'hotel_info.php?dopost=add','subpage'=>'add')
									   
	   ),
	   'car'=>array(
						array('name'=>'添加车辆','url'=>'car_info.php?dopost=add','subpage'=>'add')
						
	   ),
	   'visa'=>array(
						 array('name'=>'添加签证','url'=>'visa_info.php?dopost=add','subpage'=>'add')
						
	   ),
	   'theme'=>array(
						 array('name'=>'添加专题','url'=>'theme_info.php?dopost=add','subpage'=>'add')
						
	   ),
	   'ticket'=>array(
						 array('name'=>'添加机票','url'=>'ticket_info.php?dopost=add','subpage'=>'add')
						
						
	   ),
	   'tuan'=>array(
						 array('name'=>'添加团购','url'=>'tuan_info.php?dopost=add','subpage'=>'add')
						 
						
						
	   ),
	   'article'=>array(
						 array('name'=>'添加文章','url'=>'article_info.php?dopost=add','subpage'=>'add')
						 
						
	   ),
	   'spot'=>array(
						 array('name'=>'添加景点','url'=>'spot_info.php?dopost=add','subpage'=>'add')
					
						
	   ),
	   'photo'=>array(
						 array('name'=>'添加相册','url'=>'photo_info.php?dopost=add','subpage'=>'add')
					   
						
	   ),
	   'question'=>array(
						  array('name'=>'全部问答','url'=>'question_info.php'),
						  array('name'=>'邮件问候语','url'=>'question_info.php?dopost=mailset','subpage'=>'greet')
						  
						
	   ),
	   'pinlun'=>array(
						 array('name'=>'全部评论','url'=>'pinlun_info.php','nopara'=>true,'subpage'=>'all')
						
	   ),
	   'booking'=>array(
						 array('name'=>'线路订单','url'=>'line_booking.php','nopara'=>true),
						 array('name'=>'酒店订单','url'=>'hotel_booking.php','nopara'=>true),
						 array('name'=>'车辆订单','url'=>'car_booking.php','nopara'=>true),
						 array('name'=>'签证订单','url'=>'visa_booking.php','nopara'=>true),
						 array('name'=>'订单提醒','url'=>'sys_info.php?dopost=config&pagename=book139')
						
	   ),
	   'member'=>array(
						 array('name'=>'全部会员','url'=>'member_info.php','nopara'=>true,'subpage'=>'all'),
						 array('name'=>'添加会员','url'=>'member_info.php?dopost=add','nopara'=>true,'subpage'=>'add')
						
	   ),
	   'core'=>array(
						 array('name'=>'网站定位','url'=>'sys_info.php?dopost=config&pagename=siteword','subpage'=>'siteword'),
						 array('name'=>'目的地','url'=>'smore_destination.php','nopara'=>true,'subpage'=>'mdd'),
						 array('name'=>'出发地','url'=>'smore_startplace.php','nopara'=>true,'subpage'=>'startplace'),
						 array('name'=>'主导航','url'=>'ssmall_nav_info.php','nopara'=>true,'subpage'=>'mainnav'),
						 array('name'=>'底部导航','url'=>'nav_server.php','nopara'=>true,'subpage'=>'subnav'),
						 array('name'=>'帮助管理','url'=>'help_info.php','nopara'=>true,'subpage'=>'help'),
						 array('name'=>'网页底部','url'=>'sys_info.php?dopost=config&pagename=footer','subpage'=>'footer')
						
	   ),
	   //分类设置
	    'kind'=>array(
						  array('name'=>'线路分类','url'=>'ssmall_kindlist.php?typeid=1','subpage'=>'linekind'),
						  array('name'=>'酒店分类','url'=>'ssmall_kindlist.php?typeid=2','subpage'=>'hotelkind'),
						  array('name'=>'租车分类','url'=>'ssmall_kindlist.php?typeid=3','subpage'=>'carkind'),
						  array('name'=>'文章分类','url'=>'ssmall_kindlist.php?typeid=4','subpage'=>'articlekind'),
						  array('name'=>'景点分类','url'=>'ssmall_kindlist.php?typeid=5','subpage'=>'spotkind'),
						  array('name'=>'相册分类','url'=>'ssmall_kindlist.php?typeid=6','subpage'=>'photokind'),
						  array('name'=>'签证分类','url'=>'visa_info.php?dopost=viewkind','subpage'=>'visakind'),
						  array('name'=>'机票分类','url'=>'ticket_info.php?dopost=airportlist','subpage'=>'ticketkind'),
						  array('name'=>'团购分类','url'=>'ssmall_kindlist.php?typeid=13','subpage'=>'tuankind'),
						  array('name'=>'问答分类','url'=>'ssmall_kindlist.php?typeid=10','subpage'=>'faqkind') 
						
	   ),
	   //模板管理
	    'templet'=>array(
						  array('name'=>'模板管理','url'=>'templet_info.php','nopara'=>true,'subpage'=>'templet'),
						  array('name'=>'模块设置','url'=>'module_info.php','nopara'=>true,'subpage'=>'module'),
						  array('name'=>'广告管理','url'=>'ad_info.php?adtype=1','subpage'=>'ad'),
						  array('name'=>'logo设置','url'=>'sys_info.php?dopost=config&pagename=logoset','subpage'=>'logo'),
						  array('name'=>'旅行社标志','url'=>'sys_info.php?dopost=config&pagename=lxslogo','subpage'=>'lxslogo'),
						  array('name'=>'图标管理','url'=>'icon_info.php','nopara'=>true,'subpage'=>'ico'),
						  array('name'=>'无图设置','url'=>'sys_info.php?dopost=config&pagename=nophoto','subpage'=>'nophoto'),
						  array('name'=>'水印设置','url'=>'sys_info.php?dopost=config&pagename=syswater','subpage'=>'water') 
						
	   ),
	   //站点管理
	    'site'=>array(
						  array('name'=>'子站管理','url'=>'site_info.php','nopara'=>true,'subpage'=>'site'),
						  array('name'=>'帐户管理','url'=>'user_info.php','nopara'=>true,'subpage'=>'user'),
						  array('name'=>'客服设置','url'=>'ta_info.php','nopara'=>true,'subpage'=>'kefu'),
						  array('name'=>'公告设置','url'=>'sys_info.php?dopost=config&pagename=welcome','subpage'=>'welcome'),
						  array('name'=>'证书管理','url'=>'license_info.php','nopara'=>true,'subpage'=>'license'),
						  array('name'=>'友情链接','url'=>'flink_info.php','nopara'=>true,'subpage'=>'flink'),
						  array('name'=>'签约付款','url'=>'sys_info.php?dopost=config&pagename=payment','subpage'=>'payment'),
						  array('name'=>'天气代码','url'=>'sys_info.php?dopost=config&pagename=weather','subpage'=>'weather'),
						  array('name'=>'网站备案','url'=>'sys_info.php?dopost=config&pagename=sitenum','subpage'=>'sitenum') 
						
	   ),
	   //系统设置
	    'system'=>array(
						  array('name'=>'支付宝和快钱设置','url'=>'sys_info.php?dopost=config&pagename=alipay','subpage'=>'alipay'),
                          array('name'=>'微博微信','url'=>'sys_info.php?dopost=config&pagename=weibo','subpage'=>'weibo'),
						  array('name'=>'Robots设置','url'=>'sys_info.php?dopost=config&pagename=robot','subpage'=>'robot'),
                          array('name'=>'统计代码','url'=>'sys_info.php?dopost=config&pagename=tongji','subpage'=>'tongji'),
                          array('name'=>'第三方登陆','url'=>'sys_info.php?dopost=config&pagename=thirdpart','subpage'=>'thirdpart'),
						  array('name'=>'应用插件','url'=>'plugin_info.php','nopara'=>true,'subpage'=>'app'),
						  array('name'=>'系统参数','url'=>'sys_info.php?dopost=config&pagename=syspara','subpage'=>'syspara'),
						  array('name'=>'短信接口','url'=>'sms_info.php?dopost=list&pagename=sms','subpage'=>'sms'),
						  
		
	   ),
	   
	   
	   
		
					 
					 
	)

 ?>