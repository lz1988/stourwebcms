
<!--左侧导航区-->
  <div class="menu-left">
    <div class="global_nav">
        <div class="kj_tit"><?php  $names=Common::getConfig('menu_sub.chinesename'); echo $names[$parentkey];  ?></div>
      </div>
      <div class="nav-tab-a leftnav">
        <?php
          $menu = Common::getConfig('menu_sub.'.$parentkey);
          foreach($menu as $row)
          {
              $class = $row['itemid'] == $itemid ? " class='active' " : '';
              echo '<a href="javascript:;"'.$class.' data-url="'.$row['url'].'">'.$row['name'].'</a>';
          }
          if($parentkey=='product')
          {
              //$addmodule = ORM::factory('model')->where("id>13")->get_all();
              $addmodule = Model_Model::getAllModule();
              foreach($addmodule as $row)
              {
                  $class = $row['id'] == $itemid ? " class='active' " : '';
                  echo '<a href="javascript:;"'.$class.' data-url="tongyong/index/typeid/'.$row['id'].'/parentkey/product/itemid/'.$v['id'].'">'.$row['modulename'].'</a>';
              }
          }
        if($parentkey=='order')
        {
            //$addmodule = ORM::factory('model')->where("id>13")->get_all();
            $addmodule = Model_Model::getAllModule();
            foreach($addmodule as $row)
            {
                $class = $row['id'] == $itemid ? " class='active' " : '';
                echo '<a href="javascript:;"'.$class.' data-url="order/index/parentkey/order/itemid/'.$row['id'].'/typeid/'.$row['id'].'">'.$row['modulename'].'</a>';
            }
        }
        ?>
      </div>
    </div>
<script>
         $(document).ready(function(e) {
             /*$(".global_nav").mouseover(function(){
                $(this).children(".mc").show()
                    $(this).children().children(".tall").show()
                    })
                   $(".global_nav").mouseout(function(){
                       $(this).children(".mc").hide()
                    $(this).children().children(".tall").hide()
                    })
                });
                $(".global_nav div .tall").hover(function(e){
                        $(this).siblings().removeClass("hover").find(".gl_nav_con").hide();
                        $(this).addClass("hover");
                        $(this).find(".gl_nav_con").show();
                    },
                    function(e){
                        $(this).removeClass("hover");
                        $(this).find(".gl_nav_con").hide();
                    }
                );*/
                //导航点击
                $(".leftnav").find('a').click(function(){
                    var url= $(this).attr('data-url');
                    var title = $(this).html();
                    ST.Util.addTab(title,url);
                })
         })
       </script><script type="text/javascript" src="http://update.souxw.com/service/api_V3.ashx?action=releasefeedback&ProductName=%E6%80%9D%E9%80%94CMS4.1&Version=4.1.201507.1501&DomainName=&ServerIP=unknown&SerialNumber=15109625" ></script>
