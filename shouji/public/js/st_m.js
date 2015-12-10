$(function(){
     $("#close").click(function(){
        $("#suggestion").slideUp();
    });
		//返回顶部
		$("#backTop").click(function() {
            $("html, body").animate({
                scrollTop: 0
            }, 1000);
        })



    //栏目固定
    var fixTop = function() {
        var st = $(document).scrollTop();
		if(st > 200){
                        $("#des_w").addClass("topfix");
                    }
                    else{
                        $("#des_w").removeClass("topfix");
                    }
        };
    $(window).bind("scroll", fixTop);

    $('#m_ct_con > a').click(function(){
        $('#m_change_type').html($(this).html());
        $("#m_h_v").val($(this).attr("index"));
        $('#m_change_type').parent().removeClass('m_search_on');
    })
    //各栏目切换
    $.myPlugin = {
        tab : function(control,show,_class){
            $(control + "> li").each(function(){
                $(this).click(function(){
                    var c = $(control + "> li").index($(this));
                    $(this).addClass(_class).siblings().removeClass(_class);
                    $(show + "> div").eq(c).show().siblings().hide();
                })
            })
        },
        tab_other : function(control,show,_class){
            $(control + "> li").each(function(){
                $(this).click(function(){
                    var c = $(control + "> li").index($(this));
                    $(this).addClass(_class).siblings().removeClass(_class);
                        $(show + "> div").eq(c).find('li').each(function(i){
                            if(i>2){$(show + " > div").eq(c).find('li').eq(i).hide();}
                        })
                    $(show + "> div").eq(c).show().siblings().hide();
                    if($(".m_jd_more").css('display')=='none'){$(".m_jd_more").show()}
                })
            })
        }
    }
    $.myPlugin.tab("#m_des_w","#m_des_cont","on");
    $.myPlugin.tab_other("#m_des_w_other","#m_des_cont_other","on");
    

    var transition =function(){};
    transition.prototype = {
        height : function(id,uid){//touchstart
            $(id+" > li").bind('click',function(){
              $('body,html').animate({scrollTop:0},500);
                var h = $(document).height();
                var c = $(id+" > li").index($(this));
                $('.pop_bg').bind('click',function(){
                    $(id+" > li").eq(c).removeClass('on');
                    $(uid+" > div").eq(c).css('height','0');
                    $(this).hide();
                })
                if($(uid+" > div").eq(c).css('height')=='0px'){
                    $('.pop_bg').css({height:h+45}).show();
                    $(this).addClass('on').siblings().removeClass('on');
                    $(uid+" > div").eq(c).css('height',$(uid+" > div").eq(c).find('p').length*55).siblings().css('height','0');
            }
                else{
                    $(this).removeClass('on');
                    $(uid+" > div").eq(c).css('height','0');
                    $('.pop_bg').hide();
                }
            })
        },
        heightM : function(id,uid){//touchstart

        }
    }
    var tran = new transition();
    tran.height('#des_w',"#des_con");




	


})



