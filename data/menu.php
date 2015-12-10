<?php


return array(
	
		'产品系统' => array(
		
		      	'1'=>array(
					  
					  'name'=>'线路管理',
					  'url'=>'line_info.php?dopost=viewall',
					  'ico'=>'line_u.gif',
					  'ico2'=>'line_s.gif',
					  'menukind'=>'line'
					  ),
			    '2'=>array(
					     
						 'name'=>'酒店管理',
						 'url'=>'hotel_info.php?dopost=viewall',
						 'ico'=>'hotel_u.gif',
						 'ico2'=>'hotel_s.gif',
						 'menukind'=>'hotel'
					 
					 ),
				'3'=>array(
					     
						 'name'=>'车辆管理',
						 'url'=>'car_info.php?dopost=viewall',
						 'ico'=>'car_u.gif',
						 'ico2'=>'car_s.gif',
						 'menukind'=>'car'
					 
					 ),
				 '4'=>array(
					    'name'=>'景点管理',
						'url'=>'spot_info.php?dopost=viewall',
						'ico'=>'spot_u.gif',
						'ico2'=>'spot_s.gif',
						'menukind'=>'spot'
					 ),
					
				'5'=>array(
					     
						 'name'=>'签证管理',
						 'url'=>'visa_info.php',
						 'ico'=>'visa_u.gif',
						 'ico2'=>'visa_s.gif',
						 'menukind'=>'visa'
					 
					 ),
				'6'=>array(
					     
						 'name'=>'专题管理',
						 'url'=>'theme_info.php',
						 'ico'=>'theme_u.gif',
						 'ico2'=>'theme_s.gif',
						 'menukind'=>'theme'
					 
					 ),
				'7'=>array(
					    
						 'name'=>'机票管理',
						 'url'=>'ticket_info.php',
						 'ico'=>'plane_u.gif',
						 'ico2'=>'plane_s.gif',
						 'menukind'=>'ticket'
					 
					 ),
				'8'=>array(
					     
						 'name'=>'团购管理',
						 'url'=>'tuan_info.php',
						 'ico'=>'tuan_u.gif',
						 'ico2'=>'tuan_s.gif',
						 'menukind'=>'tuan'
					 
					)
		),
		'文章系统' => array(
		            '1'=>array(
					    'name'=>'文章管理',
						'url'=>'article_info.php?dopost=viewall',
						'ico'=>'article_u.gif',
						'ico2'=>'article_s.gif',
						'menukind'=>'article'
					 ),
					
					  array(
					    'name'=>'相册管理',
						'url'=>'photo_info.php?dopost=viewall',
						'ico'=>'photo_u.gif',
						'ico2'=>'photo_s.gif',
						'menukind'=>'photo'
					 ),
					 array(
					    'name'=>'问答管理',
						'url'=>'question_info.php',
						'ico'=>'faq_u.gif',
						'ico2'=>'faq_s.gif',
						'menukind'=>'question'
					 ),
					 array(
					    'name'=>'评论管理',
						'url'=>'pinlun_info.php',
						'ico'=>'comment_u.gif',
						'ico2'=>'comment_s.gif',
						'menukind'=>'pinlun'
					 )
					 
		
		
		
		),
	  '订单中心'=>array(
				  array(
					  'name'=>'订单管理',
					  'onlyone'=>1,
					  'url'=>'line_booking.php',
					  'childmenu'=>array(
						  array(
						    'name'=>'线路订单',
							'url'=>'line_booking.php',
							'ico'=>'line_u.gif',
							'ico2'=>'line_s.gif'
							),
						  array(
						    'name'=>'酒店订单',
							'url'=>'hotel_booking.php',
							'ico'=>'hotel_u.gif',
							'ico2'=>'hotel_s.gif'
							),
						  array(
						  'name'=>'车辆订单',
						  'url'=>'car_booking.php',
						  'ico'=>'car_u.gif',
						  'ico2'=>'car_s.gif'
						  ),
						  array(
						  'name'=>'门票订单',
						  'url'=>'spot_booking.php',
						  'ico'=>'spot_u.gif',
						  'ico2'=>'spot_s.gif'
						  ),
						  array(
						  'name'=>'签证订单',
						  'url'=>'visa_booking.php',
						  'ico'=>'visa_u.gif',
						  'ico2'=>'visa_s.gif'
						  ),
						   array(
						  'name'=>'团购订单',
						  'url'=>'tuan_booking.php',
						  'ico'=>'tuan_u.gif',
						  'ico2'=>'tuan_u.gif'
						  ),
						  array(
						    'name'=>'定制订单',
							'url'=>'customize_booking.php',
							'ico'=>'customize_u.gif',
							'ico2'=>'customize_s.gif'
						  ),
						  array(
						    'name'=>'协议订单',
							'url'=>'dzorder.php',
							'ico'=>'dzorder_1.gif',
							'ico2'=>'dzorder_2.gif'
						  ),
						  array(
						  'name'=>'订单提醒',
						  'url'=>'sys_info.php?dopost=config&pagename=book139',
						  'ico'=>'order_u.gif',
						  'ico2'=>'order_s.gif'
						  )
					  )
				   )
				  
				  
	  ),
		'会员中心'=>array(
		          array(
				     'name'=>'会员管理',
					 'onlyone'=>1,
					 'url'=>'member_info.php',
					 'childmenu'=>array(
					       array(
						     'name'=>'全部会员',
							 'url'=>'member_info.php',
							 'ico'=>'m_all_u.gif',
							 'ico2'=>'m_all_s.gif'
							 ),
						   array(
						    'name'=>'添加会员',
							'url'=>'member_info.php?dopost=add',
							'ico'=>'m_add_u.gif',
							'ico2'=>'m_add_s.gif'
							)
					 )
				  )
		),
		'设置中心'=>array(
		
		           array(
				      'name'=>'核心设置',
					  'url'=>'sys_info.php?dopost=config&pagename=siteword&subpage=siteword',
					  'ico'=>'core_u.gif',
					  'ico2'=>'core_s.gif',
					  'menukind'=>'core'
				   
				   
				   
				   ),
		
		 
		           array(
				      'name'=>'分类设置',
					  'url'=>'ssmall_kindlist.php?typeid=1&subpage=linekind',
					  'ico'=>'class_u.gif',
					  'ico2'=>'class_s.gif',
					  'menukind'=>'kind'
				   ),
				   array(
				      'name'=>'模板管理',
					  'url'=>'templet_info.php?subpage=templet',
					  'ico'=>'templet_u.gif',
					  'ico2'=>'templet_s.gif',
					  'menukind'=>'templet'
				   ),
				   array(
				      'name'=>'站点管理',
					  'url'=>'site_info.php?subpage=site',
					  'ico'=>'site_u.gif',
					  'ico2'=>'site_s.gif',
					  'menukind'=>'site'
				   ),
				   array(
				      'name'=>'系统设置',
					  'url'=>'sys_info.php?dopost=config&pagename=alipay&subpage=alipay',
					  'ico'=>'sys_u.gif',
					  'ico2'=>'sys_s.gif',
					  'menukind'=>'system'
				   ),   
		
		),
		'系统商城'=>array(
		               array(
								'name'=>'系统商城',
								'onlyone'=>1,
								'childmenu'=>array(
									array(
									 'name'=>'帐户权限',
									 'url'=>'index.php?dopost=userright',
									 'ico'=>'right_u.gif',
									 'ico2'=>'right_s.gif'
									 ),
									 array(
									  'name'=>'系统升级',
									  'url'=>'index.php?dopost=upgrade',
									  'ico'=>'ver_u.gif',
									  'ico2'=>'ver_s.gif'
									  ),
									 array(
									 'name'=>'模板商城',
									 'url'=>'http://www.stourweb.com/cms/moban',
									 'ico'=>'t_mall_u.gif',
									 'ico2'=>'t_mall_s.gif'
									 ),
									array(
									  'name'=>'营销服务',
									  'url'=>'http://www.stourweb.com/seo',
									  'ico'=>'app_u.gif',
									  'ico2'=>'app_s.gif'
									  
									 ),
									 array(
									  'name'=>'提交工单',
									  'url'=>'http://www.stourweb.com/Member/problem',
									  'ico'=>'adv_u.gif',
									  'ico2'=>'adv_s.gif'
									  
									  ),
									array(
									 'name'=>'服务合同',
									 'url'=>'http://www.stourweb.com/Member',
									 'ico'=>'contract_u.gif',
									 'ico2'=>'contract_s.gif'
									 )

									
								)
					 )
		),
		'智能助手'=>array(
					 array(
								'name'=>'智能助手',
								'onlyone'=>1,
								'childmenu'=>array(
								    array('name'=>'关键词管理','url'=>'keyword_info.php'),
						            array('name'=>'智能链接管理','url'=>'link_info.php'),
						            array('name'=>'Tag词管理','url'=>'tagword_info.php'),
									array('name'=>'智能统计','url'=>'searchengine.php'),
									array('name'=>'数据备份','url'=>'db_info.php?dopost=indexpage'),
									array('name'=>'数据恢复','url'=>'db_info.php?dopost=recover'),
									array('name'=>'备份文件管理','url'=>'db_info.php?dopost=filelist'),
									array('name'=>'操作日志','url'=>'log_info.php'),
                                    array('name'=>'热搜词管理','url'=>'search_info.php'),
									array('name'=>'智能Sitemap','url'=>'sys_info.php?dopost=config&pagename=sitemap','subpage'=>'sitemap') 
								)
					 )
					
		)
		
		

);
