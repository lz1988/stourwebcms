<?php


return array(

    '产品' => array(

        'line'=>array(
            'name'=>'线路',
            'url'=>'line_info.php?dopost=viewall',
            'menukind'=>'line',
            'parentname'=>'产品'

        ),
        'hotel'=>array(

            'name'=>'酒店',
            'url'=>'hotel_info.php?dopost=viewall',
            'menukind'=>'hotel',
            'parentname'=>'产品'

        ),
        array(

            'name'=>'车辆',
            'url'=>'car_info.php?dopost=viewall',
            'ico'=>'car_u.gif',
            'ico2'=>'car_s.gif',
            'menukind'=>'car',
            'parentname'=>'产品'

        ),
        array(
            'name'=>'景点',
            'url'=>'spot_info.php?dopost=viewall',
            'ico'=>'spot_u.gif',
            'ico2'=>'spot_s.gif',
            'menukind'=>'spot',
            'parentname'=>'产品'
        ),

        array(

            'name'=>'签证',
            'url'=>'visa_info.php',
            'ico'=>'visa_u.gif',
            'ico2'=>'visa_s.gif',
            'menukind'=>'visa',
            'parentname'=>'产品'

        ),
        array(

            'name'=>'专题',
            'url'=>'theme_info.php',
            'ico'=>'theme_u.gif',
            'ico2'=>'theme_s.gif',
            'menukind'=>'theme',
            'parentname'=>'产品'

        ),
        array(

            'name'=>'机票',
            'url'=>'ticket_info.php',
            'ico'=>'plane_u.gif',
            'ico2'=>'plane_s.gif',
            'menukind'=>'ticket',
            'parentname'=>'产品'

        ),
        array(

            'name'=>'团购',
            'url'=>'tuan_info.php',
            'ico'=>'tuan_u.gif',
            'ico2'=>'tuan_s.gif',
            'menukind'=>'tuan',
            'parentname'=>'产品'

        )
    ),
    '文章' => array(
       array(
            'name'=>'文章',
            'url'=>'article_info.php?dopost=viewall',
            'menukind'=>'article',
            'parentname'=>'文章'
        ),
        array(
            'name'=>'景点',
            'url'=>'spot_info.php?dopost=viewall',
            'menukind'=>'spot',
            'parentname'=>'文章'
        ),

        array(
            'name'=>'相册',
            'url'=>'photo_info.php?dopost=viewall',
            'menukind'=>'photo',
            'parentname'=>'文章'
        ),
        array(
            'name'=>'问答',
            'url'=>'question_info.php',
            'menukind'=>'question',
            'parentname'=>'文章'
        ),
        array(
            'name'=>'评论',
            'url'=>'pinlun_info.php',
            'menukind'=>'pinlun',
            'parentname'=>'文章'
        ),
        array(
            'name'=>'帮助',
            'url'=>'',
            'parentname'=>'文章'
        )




    ),
    '订单中心'=>array(
        array(

                array(
                    'name'=>'线路订单',
                    'url'=>'line_booking.php',
                    'parentname'=>'订单'

                ),
                array(
                    'name'=>'酒店订单',
                    'url'=>'hotel_booking.php',
                    'parentname'=>'订单'

                ),
                array(
                    'name'=>'车辆订单',
                    'url'=>'car_booking.php',
                    'parentname'=>'订单'

                ),
                array(
                    'name'=>'门票订单',
                    'url'=>'spot_booking.php',
                    'parentname'=>'订单'

                ),
                array(
                    'name'=>'签证订单',
                    'url'=>'visa_booking.php',
                    'parentname'=>'订单'

                ),
                array(
                    'name'=>'团购订单',
                    'url'=>'tuan_booking.php',
                    'parentname'=>'订单'

                ),
                array(
                    'name'=>'定制订单',
                    'url'=>'customize_booking.php'

                ),
                array(
                    'name'=>'协议订单',
                    'url'=>'dzorder.php',
                    'parentname'=>'订单'

                ),
                array(
                    'name'=>'订单提醒',
                    'url'=>'sys_info.php?dopost=config&pagename=book139',
                    'parentname'=>'订单'

                )

        )


    ),
    '会员中心'=>array(
        array(

                array(
                    'name'=>'全部会员',
                    'url'=>'member_info.php',
                    'parentname'=>'会员'

                ),
                array(
                    'name'=>'添加会员',
                    'url'=>'member_info.php?dopost=add',
                    'parentname'=>'会员'

                )

        )
    ),
    '设置中心'=>array(

        array(
            'name'=>'基础设置',
            'url'=>'sys_info.php?dopost=config&pagename=siteword&subpage=siteword',
            'menukind'=>'basic'

        ),
        array(
            'name'=>'分类设置',
            'url'=>'ssmall_kindlist.php?typeid=1&subpage=linekind',
            'ico'=>'class_u.gif',
            'ico2'=>'class_s.gif',
            'menukind'=>'kind',
            'parentname'=>'设置'

        ),
        array(
            'name'=>'模板管理',
            'url'=>'templet_info.php?subpage=templet',
            'menukind'=>'templet',
            'parentname'=>'设置'
        ),
        array(
            'name'=>'站点管理',
            'url'=>'site_info.php?subpage=site',
            'menukind'=>'site',
            'parentname'=>'设置'
        ),
        array(
            'name'=>'系统设置',
            'url'=>'sys_info.php?dopost=config&pagename=alipay&subpage=alipay',
            'ico'=>'sys_u.gif',
            'ico2'=>'sys_s.gif',
            'menukind'=>'system',
            'parentname'=>'设置'
        ),

    ),

    '智能助手'=>array(



    )



);
