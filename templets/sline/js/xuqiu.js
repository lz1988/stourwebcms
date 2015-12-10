// JavaScript Document
var  orderCookie = {
    cookieList:[
        "destlist", "subdestlist", "linelist","themelist",
        'u_destmain',"u_destmain_id",'u_destchild',"u_destchild_id", "u_userplace", "u_startdate",
        "u_vartime","u_day", "u_adultnum","u_childnum","u_lineid","u_themeid","u_usertheme","u_memo",
        "u_mobile","u_nickname"
    ]
};
//清除所有cookie
orderCookie.clearCookie = function() {
    for( var i in this.cookieList ) {
        this.storageSave( this.cookieList[i], null );
    }
    return true;
};
orderCookie.getStorage = function( key ) {
    var str = $.cookie(key);
    if( !str ) return null;
/*    var json = JSON.parse( str );
    if( !$.isPlainObject( json ) || $.isEmptyObject( json ) )
        return false;
    return json;*/
    return str;
};

//保存cookie
orderCookie.storageSave = function( key, value ) {
    var string = $.isPlainObject( value ) ? JSON.stringify(value) : value;
    $.cookie( key, string, {expires:30, path:'/'} );
    return true;
};
//检测cookie
orderCookie.checkCookie = function () {
    for( var i in this.cookieList ) {
        var jsonStr = $.cookie( this.cookieList[i] );
        if( jsonStr )
            return true;
    }
    return false;
};
var jieban={
    scrollBottom:function(){

        $("#im_scroll").animate({scrollTop: $("#trip_order").height()+100},100);
    },
    storageSave : function(key,value){
         orderCookie.storageSave(key,value)
    },
    getStorage:function(key){
       return orderCookie.getStorage(key);
    },
    showPage:function(pg){
       $("#"+pg).show();
       jieban.scrollBottom();
    },
    step1:function(){

            $.ajax({
                type:'POST',
                url:siteUrl+'jieban/ajax.jieban.php',
                data:{action:'step1_getdestlist'},
                dataType:'json',
                success:function(data){
                    if(data.status==1){//successful
                        var str = '';
                        $.each(data.list,function(i,row){

                            str+="<span data-id="+row.id+">"+row.kindname+"</span>";


                        })
                        $("#destlist").html(str);
                        jieban.storageSave('destlist',str);
                        jieban.showPage('pg1');
                        jieban.step1BindEvent();
                    }
                }
            })



    },
    step1BindEvent:function(){
        $("#destlist").find('span').unbind('click').click(function(){
            $(this).addClass('on').siblings().removeClass('on');
            var dest = $(this).text();
            var destid = $(this).attr('data-id');
            $('#pg1_ans').find('.im-you-txt').html('我想去'+dest);
            jieban.storageSave('u_destmain',dest);
            jieban.storageSave('u_destmain_id',destid);
            jieban.showPage('pg1_ans');
            jieban.step2(destid);//显示子目的地选择对话框.


        })
    },
    step2:function(maindestid){
            $.ajax({
                type:'POST',
                url:siteUrl+'jieban/ajax.jieban.php',
                data:{action:'step2_getsubdestlist',pid:maindestid},
                dataType:'json',
                success:function(data){
                    if(data.status==1){//successful
                        var str = '';
                        $.each(data.list,function(i,row){
                            //$class = row.kindname == u_destmain ? 'class="on"' : '';
                            str+="<span data-id="+row.id+">"+row.kindname+"</span>";
                            $("#subdestlist").html(str);
                            jieban.storageSave('subdestlist',str);
                            jieban.showPage('pg2');
                            jieban.step2BindEvent();

                        })
                    }
                }
            })



    },
    step2BindEvent:function(){
        $("#subdestlist").find('span').unbind('click').click(function(){
            $(this).addClass('on').siblings().removeClass('on');
        })
       $("#pg2").find('.btn_confirm').click(function(){
           var ans= '我的目的地是: ';
           var dest='';
           var destid='';
           var choose = $("#subdestlist").find('.on');

           if(choose.length>0){
                dest = choose.text();
                destid = choose.attr('data-id');
               ans+=dest;
               jieban.storageSave('u_destchild',dest);
               jieban.storageSave('u_destchild_id',destid);
           }else{
               var userplace = $("#userplace").val();//自选目的地
               jieban.storageSave('u_userplace',userplace);
               ans+=userplace;
           }
           if(dest=='' && userplace==''){
               layer.msg('请选择你的目的地', 2,8);
           }
           else{
               $('#pg2_ans').find('.im-you-txt').html(ans);
               jieban.showPage('pg2_ans');
               jieban.step3();
           }

       })
    },
    step3:function(){
        jieban.showPage('pg3');
        jieban.step3BindEvent();

    },
    step3BindEvent:function(){
        //日期选择
        $('.startdate').click(function(){
            WdatePicker({skin:'whyGreen',dateFmt:'yyyy-MM-dd',minDate:'%y-%M-%d'})
        })
        //确认选择
        $("#pg3").find('.btn_confirm').click(function(){
            var startdate = $(".startdate").val();
            var day = $(".day").val();
            var vartime = $(".vartime").val();
            if(startdate==''){
                layer.msg('请选择你的出发日期', 2,8);
                return false;
            }
            if(day==''){
                layer.msg('请填写你的旅行天数', 2,8);
                return false;
            }

            jieban.storageSave('u_startdate',startdate);
            jieban.storageSave('u_vartime',vartime);
            jieban.storageSave('u_day',day);

            var _html="计划出发日期："+startdate;
            if(vartime!=''){
                _html+="±"+vartime+"天";
            }
            _html+="，出行天数"+day+"天";
            $('#pg3_ans').find('.im-you-txt').html(_html);
            jieban.showPage('pg3_ans');
            jieban.step4();


        })


    },
    step4:function(){
        jieban.showPage('pg4');
        jieban.step4BindEvent();
    },
    step4BindEvent:function(){
        $("#pg4").find('.adultprev').unbind('click').click(function(){
            var num = Number($('.adultnum').val());
            num = num-1;
            num = num==0 ? 1 : num;
            $("#pg4").find('.adultnum').val(num);
        })
        $("#pg4").find('.childprev').click(function(){
            var num = Number($("#pg4").find('.childnum').val());

            num = num-1;
            num = num==-1 ? 0 : num;
            $("#pg4").find('.childnum').val(num);
        })

        $("#pg4").find('.adultnext').unbind('click').click(function(){
            var num = Number($('.adultnum').val());
            num = num+1;

            $("#pg4").find('.adultnum').val(num);
        })
        $("#pg4").find('.childnext').unbind('click').click(function(){
            var num = Number($("#pg4").find('.childnum').val());
            num = num+1;
            $("#pg4").find('.childnum').val(num);
        })

        $("#pg4").find('.btn_confirm').unbind('click').click(function(){
            var adultnum = Number($("#pg4").find('.adultnum').val());
            var childnum = Number($("#pg4").find('.childnum').val())
            jieban.storageSave('u_adultnum',adultnum);
            jieban.storageSave('u_childnum',childnum);

            var _html="成人："+adultnum+'名,儿童: '+childnum;
            $('#pg4_ans').find('.im-you-txt').html(_html);
            jieban.showPage('pg4_ans');
            jieban.step5();


        });


    },
    step5:function(){
        var destid = jieban.getStorage('u_destchild_id');
        var userplace = jieban.getStorage('u_userplace');
        var uday = jieban.getStorage('u_day');
        userplace = userplace!=false ? userplace : '';
        $.ajax({
            type:'POST',
            url:siteUrl+'jieban/ajax.jieban.php',
            data:{action:'step5_getproductlist',destid:destid,userplace:userplace,uday:uday},
            dataType:'json',
            success:function(data){
                if(data.status==1){//successful
                    var str = '';
                    var linenum = 0;
                    $.each(data.list,function(i,row){
                        str+='<div class="pro-list" data-lineid="'+row.id+'">';
                        str+='<a class="fl" target="_blank" href="javascript:;"><img class="fl" src="'+row.litpic+'"  width="174" height="129" /></a>';
                        str+='<p class="tit"><a target="_blank" href="javascript:;">'+row.title+'</a></p>';
                        str+='<p class="txt">'+row.desc+'</p>';
                        str+='<p class="price">参考价：<span>&yen;'+row.price+'</span>/人</p>';
                        str+='<p class="more"><a target="_blank" href="'+row.url+'">查看详情</a></p>';
                        str+='</div>';
                        linenum++;
                    })
                    $("#linenum").html(linenum);
                    $("#linelist").html(str);
                    jieban.storageSave('linelist',str);
                    jieban.storageSave('linenum',linenum);
                    jieban.showPage('pg5');
                    jieban.step5BindEvent();
                }else{
                    jieban.step6();
                }
            }
        })

    },
    step5BindEvent:function(){
          var u_lineid = '';
          $("#pg5").find('.pro-list').click(function(){
              $(this).addClass('active').siblings().removeClass('active');
               u_lineid = $(this).attr('data-lineid')
               jieban.storageSave('u_lineid',u_lineid);
          })
          //确定
         $("#pg5").find('.btn_confirm').click(function(){
             var u_lineid = jieban.getStorage('u_lineid');
             var linenum = Number($("#linenum").html());
             if(linenum>0){
                 if(u_lineid==''){
                     layer.msg('请选择参考行程', 1,8);
                     return false;
                 }
                 else{
                     var _html="已选择行程";
                     $('#pg5_ans').find('.im-you-txt').html(_html);
                     jieban.showPage('pg5_ans');
                     jieban.step6();
                 }

             }

         })
        //自己规划
         $("#pg5").find('.btn_designmyself').click(function(){
                  var _html = "不满意，我自己规划";
                 jieban.storageSave('u_lineid','');
                 jieban.storageSave('u_lineid_userdefine',1);
                 $('#pg5_ans').find('.im-you-txt').html(_html);
                 jieban.showPage('pg5_ans');
                 jieban.step6();
         })
    },
    step6:function(){
        $.ajax({
            type:'POST',
            url:siteUrl+'jieban/ajax.jieban.php',
            data:{action:'step6_getthemelist'},
            dataType:'json',
            success:function(data){
                if(data.status==1){//successful
                    var str = '';
                    $.each(data.list,function(i,row){

                        str+="<span data-id="+row.id+">"+row.attrname+"</span>";


                    })
                    $("#themelist").html(str);
                    jieban.storageSave('themelist',str);
                    jieban.showPage('pg6');
                    jieban.step6BindEvent();
                }
            }
        })
    },
    step6BindEvent:function(){
        $("#themelist").find('span').click(function(){
            $(this).toggleClass('on');
        })

        $("#pg6").find('.btn_confirm').click(function(){

            var themeid = '';
            var themename = '';
            var _html = "";
            $("#themelist").find('.on').each(function(i,obj){
                themeid+=$(obj).attr('data-id')+','
                themename+=$(obj).html()+';';
            })
            if(themeid!=''){
                jieban.storageSave('u_themeid',themeid);
            }
            if(themename!=''){
                jieban.storageSave('u_themename',themename);
                _html = themename;
            }

            var usertheme = $("#usertheme").val();
            if(usertheme!=''){
                jieban.storageSave('u_usertheme',usertheme);
                _html = usertheme;
            }

            $('#pg6_ans').find('.im-you-txt').html(_html);
            jieban.showPage('pg6_ans');
            jieban.step7();

        })
    },
    step7:function(){
        jieban.showPage('pg7');
        jieban.step7BindEvent();
    },
    step7BindEvent:function(){
        $("#pg7").find('.btn_confirm').click(function(){
            var memo = $('#memo').val();
            if(memo!=''){
                jieban.storageSave('u_memo',memo);
            }
            jieban.showPage('pg7_ans');
            jieban.step8();
        });
    },
    step8:function(){
        $.ajax({
            type:'POST',
            url:siteUrl+'jieban/ajax.jieban.php',
            data:{action:'step8_getmsgstatus'},
            dataType:'json',
            success:function(data){
                if(data.status==1){//successful
                    $("#cftoken").val(data.token);
                    if(data.msgopen==1){
                        $('.txtcode_phone').hide();
                        $("#msgtype").val('msg');
                    }else{
                        $('.msgcode_phone').hide();
                        $("#msgtype").val('txt');
                    }
                    if(data.islogin==0){ //如果是登陆状态,直接跳转到保存.
                        jieban.showPage('pg8');
                        jieban.step8BindEvent();
                    }else{
                        jieban.step9();
                    }

                }
            }
        })


    },
    step8BindEvent:function(){

      //发送短信验证码

        $("#btn_sendmsgcode").unbind('click').click(function(){
            jieban.sendmsgEvent();
        })

      $("#pg8").find('.btn_confirm').click(function(){

          var mobile = '';
          var msgtype = $("#msgtype").val();
          var nickname = $("#nickname").val();
          var flag = true;
          if(msgtype=='msg'){
              //验证短信验证码是否正确,获取手机号
                mobile = $("#phone1").val();
                var checkcode = $("#checkcode1").val();

              $.ajax({
                  type:'POST',
                  url:siteUrl+'jieban/ajax.jieban.php',
                  data:{action:'checkmsgcode',code:checkcode},
                  async:false,
                  dataType:'json',
                  success:function(data){
                      if(data.status==0){
                          layer.msg("验证码错误",1,8);
                          flag = false;
                          return false;
                      }else{
                          jieban.storageSave('u_mobile',mobile); //保存用户手机号
                      }
                  }
              })
          }
          else if(msgtype=='txt'){
                  mobile = $("#phone2").val();
                  var checkcode = $("#checkcode2").val();
                  var regPartton=/^1[3-8][0-9]{9}$/ig;
                  if (!regPartton.test(mobile))
                  {
                      layer.msg('请输入正确的手机号码', 1,8);
                      return false;
                  }
                 $.ajax({
                      type:'POST',
                      url:siteUrl+'jieban/ajax.jieban.php',
                      data:{action:'checktxtcode',code:checkcode},
                      async:false,
                      dataType:'json',
                      success:function(data){
                          if(data.status==0){
                              layer.msg("验证码错误",1,8);
                              flag = false;
                              return false;
                          }else{
                              jieban.storageSave('u_mobile',mobile); //保存用户手机号
                          }
                      }
                  })
          }
          if(mobile==''){
              layer.msg("请填写手机号码",1,8);
              return false;
          }
          if(nickname==''){
              layer.msg("请填写昵称",1,8);
              return false;
          }
          jieban.storageSave('u_nickname',nickname);
          if(!flag)return false;
          var _html = "我的昵称:"+nickname+" 手机号是:"+mobile;
          $('#pg8_ans').find('.im-you-txt').html(_html);
          jieban.showPage('pg8_ans');
          jieban.step9();

      })
    },
    sendmsgEvent:function(){
        var mobile = $("#phone1").val();
        var cftoken = $("#cftoken").val();
        //alert(mobile);
        var regPartton=/^1[3-8][0-9]{9}$/ig;
        if (!regPartton.test(mobile))
        {
            layer.msg('请输入正确的手机号码', 1,8);
            return false;
        }
        var t=this;
        t.disabled=true;
        var url = siteUrl+"jieban/ajax.jieban.php?action=sendmsgcode&mobile="+mobile+"&k="+cftoken;
        var sendnum = $.cookie('sendnum') ? $.cookie('sendnum') : 0;
        if(sendnum>3){
            layer.msg("验证码发送请求过于频繁,请过15分钟后再试",1,8);
            return false;
        }
        if(sendnum!=0){
            $.cookie('sendnum', sendnum++);
        }else{
            $.cookie('sendnum', 1,{ expires: 1/96 });
        }
        $.post(url,true,function(data) {

            if(data=='ok')
            {
                $("#btn_sendmsgcode").unbind('click');
                CodeTimeout(60);
                return false;
            }
            else
            {

                return false;
            }
        });
    },
    step9:function(){
        jieban.save();
    },
    save:function(){
       $.ajax({
           type:'POST',
           url:siteUrl+'jieban/ajax.jieban.php',
           dataType:'json',
           data:{action:'savejieban'},
           success:function(data){
               if(data.status==1){
                   jieban.showPage('pg9');
                   orderCookie.clearCookie();//清空cookie
               }
           }
       })
    },
    newChat:function(){//新的会话
        orderCookie.clearCookie();
        $('input').val('');
        $('.adultnum').val(1);
        jieban.hideAll();

        jieban.step1();
        $(".mask-disable").hide();
    },
    continueChat:function(){ //继续上次结伴继续.
        $(".mask-disable").hide();
    },
    readSaveJieban:function(){ //读取用户已填写信息

        //第一步
        var destlist = jieban.getStorage('destlist');
        if(destlist!=null){
            $("#destlist").html(destlist);
            jieban.showPage('pg1');

            jieban.step1BindEvent();
        }
        var dest = jieban.getStorage('u_destmain');
        var destid = jieban.getStorage('u_destmain_id');
        if(dest!='null' && destid!='null')
        {
            $('#pg1_ans').find('.im-you-txt').html('我想去'+dest);
            jieban.showPage('pg1_ans');
        }
        else{
            return false;//如果没选择则直接返回.
        }
        //第二步
        var subdestlist = jieban.getStorage('subdestlist');
        if(subdestlist!='null'){
            $("#subdestlist").html(subdestlist);
            jieban.showPage('pg2');
            jieban.step2BindEvent();
        }
        var u_destchild = jieban.getStorage('u_destchild');
        var u_destchild_id = jieban.getStorage('u_destchild_id');
        var u_userplace = jieban.getStorage('u_userplace');
        if(u_userplace!='null'){
            $('#pg2_ans').find('.im-you-txt').html(u_userplace);
            jieban.showPage('pg2_ans');


        }else if(u_destchild!='null'){
            $('#pg2_ans').find('.im-you-txt').html(u_destchild);
            jieban.showPage('pg2_ans');
        }else{
            return false;
        }
        //第三步
        var u_startdate = jieban.getStorage('u_startdate');
        var u_vartime = jieban.getStorage('u_vartime');
        var u_day = jieban.getStorage('u_day');
        if(u_startdate!='null'&&u_startdate!=null)$(".startdate").val(u_startdate);
        if(u_day!='null'&&u_day!=null)  $(".day").val(u_day);
        if(u_vartime!='null'&&u_vartime!=null) $(".vartime").val(u_vartime);
        jieban.showPage('pg3');
        jieban.step3BindEvent();
        if(u_startdate!='null' && u_day!='null'){
            var _html="计划出发日期："+u_startdate;
            if(u_vartime!='null'){
                _html+="±"+u_vartime+"天";
            }
            _html+="，出行天数"+u_day+"天";
            $('#pg3_ans').find('.im-you-txt').html(_html);
            jieban.showPage('pg3_ans');
        }
        //第四步
        var u_adultnum = jieban.getStorage('u_adultnum');
        var u_childnum = jieban.getStorage('u_childnum');
        if(u_adultnum!='')$(".adultnum").val(u_adultnum);
        if(u_childnum!='')$(".childnum").val(u_childnum);
        jieban.showPage('pg4');
        jieban.step4BindEvent();
        if(u_adultnum!='null' || u_childnum!='null'){
            u_adultnum = u_adultnum=='null' ? 1 : u_adultnum;
            u_childnum = u_childnum=='null' ? 0 : u_childnum;
            var _html="成人："+u_adultnum+'名,儿童: '+u_childnum;
            $('#pg4_ans').find('.im-you-txt').html(_html);
            jieban.showPage('pg4_ans');
        }else{
            return false;
        }
        //第五步
        var linenum = jieban.getStorage('linenum');
        var linelist = jieban.getStorage('linelist');
        if(linelist!='null'){
            $("#linenum").html(linenum);
            $("#linelist").html(linelist);
            jieban.showPage('pg5');
            jieban.step5BindEvent();
        }
        else{
            jieban.step5();
        }
        var u_lineid = jieban.getStorage('u_lineid');
        var userdefine = jieban.getStorage('u_lineid_userdefine');
        if(u_lineid!='null'){
            var _html="已选择行程";
            $('#pg5_ans').find('.im-you-txt').html(_html);
            jieban.showPage('pg5_ans');
        }
        else if(userdefine == 1 && u_lineid=='null'){
            var _html = "不满意，我自己规划";
            $('#pg5_ans').find('.im-you-txt').html(_html);
            jieban.showPage('pg5_ans');
        }else{
            return false;
        }
        //第六步
        var themelist = jieban.getStorage('themelist');
        $("#themelist").html(themelist);
        if(themelist!='null'){
            jieban.showPage('pg6');
            jieban.step6BindEvent();

        }
        else{
            jieban.step6();
        }


        var u_themeid = jieban.getStorage('u_themeid');
        var u_themename = jieban.getStorage('u_themename');
        var u_usertheme = jieban.getStorage('u_usertheme');
        if(u_themeid!='null'){
            _html = u_themename;
            $('#pg6_ans').find('.im-you-txt').html(_html);
            jieban.showPage('pg6_ans');

        }
        else if(u_usertheme!='null'){
            _html = u_usertheme;
            $('#pg6_ans').find('.im-you-txt').html(_html);
            jieban.showPage('pg6_ans');

        }else{
            return false;
        }
        //第七步

        var u_memo = jieban.getStorage('u_memo');
        var islogin = $("#loginstatus").val();
        if(u_memo!='null'){
            jieban.showPage('pg7');
            jieban.step7BindEvent();
            $('#memo').html(u_memo);
            jieban.showPage('pg7_ans');
            if(!islogin){
                jieban.step8();//第八步
            }else{

            }

        }else{
            jieban.step7();
        }






    },
    hidePage:function(pg){
        $("#"+pg).hide();
    },
    hideAll:function(){
        for(var i=1;i<=9;i++){
            jieban.hidePage('pg'+i);
            jieban.hidePage('pg'+i+'_ans');
        }

    }
}


$(function(){


    var checknum = jieban.getStorage('u_destmain_id');//检测用户是否填写过结伴信息.

    if(checknum=='null'){
        jieban.step1();
        $(".mask-disable").hide();
    }else{
        jieban.readSaveJieban();
        $(".mask-disable").show();
    }



})



function CodeTimeout(v){
    if(v>0)
    {
        var _html = --v+'秒可重发';
        $("#time").html(_html);
        $("#time").show();

        setTimeout(function(){CodeTimeout(v)},1000);
    }
    else
    {
        $("#btn_sendmsgcode").unbind('click');
        $("#time").hide();

    }
}
