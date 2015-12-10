/**
 * Created by Administrator on 14-12-24.
 */
$(function(){
    var FilesArray=[
        './suggest/aircity.js',
        './suggest/j.dimensions.js',
        './suggest/j.suggest.js',
        './suggest/jquery.suggest.css'
    ]
    Loader.loadFileList(FilesArray,function(){
        $("#startcity").suggest(
            citys,
            {
                hot_list:commoncitys,
                dataContainer:'#startcity_3word',
                onSelect:function(){$("#endcity").click();},
                attachObject:'#suggest1'
            }
        );

        $("#endcity").suggest(
            citys,
            {
                hot_list:commoncitys,
                dataContainer:'#endcity_3word',
                attachObject:"#suggest2"
            }
        );

    });
    //切换
    $("#sechange").click(function(){
        var scity = $("#startcity");
        var scity_word = $("#startcity_3word");
        var ecity = $("#endcity");
        var ecity_word = $("#endcity_3word");
        var temp = scity.val();
        scity.val(ecity.val());
        ecity.val(temp);
        temp = scity_word.val();
        scity_word.val(ecity_word.val());
        ecity_word.val(temp);

    })
    //时间选择
    var myDate = new Date();//今天
    var tomo = new   Date((myDate/1000+86400*1)*1000);


    var Year = myDate.getFullYear();
    var Month = myDate.getMonth()+1;
    var Day = myDate.getDate();

    var tYear = tomo.getFullYear();
    var tMonth = tomo.getMonth()+1;
    var tDay = tomo.getDate();

    Month = Month<10 ? '0'+Month : Month;
    Day = Day<10 ? '0'+Day : Day;
    var startdate=Year+"-"+Month+"-"+Day;
    var enddate=tYear+"-"+tMonth+"-"+tDay;
    $("#startdate").focus(function(){

        WdatePicker({skin:'ext',dateFmt:'yyyy-MM-dd',minDate:'%y-%M-%d',doubleCalendar:true,isShowClear:false,readOnly:true,errDealMode:1})
        $(this).css("color","#333");
        $(this).blur();
    })
    $("#enddate").focus(function(){
        WdatePicker({skin:'ext',minDate:'#F{$dp.$D(\'startdate\',{d:1});}',dateFmt:'yyyy-MM-dd',doubleCalendar:true,isShowClear:false,readOnly:true,errDealMode:1});
        $(this).css("color","#333");
        $(this).blur();
    })
    $("#startdate").val(startdate);//开始时间赋初值.
    //单程,往返

    $('input').iCheck({
        checkboxClass: 'icheckbox_minimal-red',
        radioClass: 'iradio_minimal-red',
        increaseArea: '20%' // optional
    });
    $('input').on('ifChecked', function(event){
        //单程
        if($(this).val()=='S'){
            $("#enddate").attr("disabled",true);
        }
        else{
            $("#enddate").attr("disabled",false); ;
        }
        $("#searchtype").val($(this).val());
    });




    Flight.getFlight();

    //查询
    $("#btn_search").click(function(){
        Flight.getFlight();
    })



})

//获取低价

var backsearch=0;
Flight={}

Flight.getLowerPrice=function(isback){
    var startdate = $("#startdate").val();
    var dCode = $("#startcity_3word").val();
    var aCode = $("#endcity_3word").val();
    if(isback){
        startdate = $("#enddate").val();
        dCode = $("#endcity_3word").val();
        aCode = $("#startcity_3word").val();
    }
    $.ajax({
        url:siteUrl+'/ticket/ajax.ticket.php',
        data:{action:'getLowerPrice',startdate:startdate,dCode:dCode,aCode:aCode},
        beforeSend:function(){$("#calendar_ul").html('')},
        dataType:'json',
        success:function(data){

            var listr ='';
            $.each(data,function(i,row){
                $class = i==0 ? "class='current'" : '';
                listr+= '<li '+$class+' data-date="'+row.departdate_full+'"><a href="javascript:void(0);"><span class="calendar_date">'+row.departdate+'&nbsp;'+row.week+'</span><span class="base_price02"><dfn>&yen;</dfn>'+row.LowestPrice+'</span></a></li>';

            })

            $("#calendar_ul").html(listr);
            $('.calendar_ul li').click(function(){
                var departDate = $(this).attr('data-date');
                $("#startdate").val(departDate);
                $("#enddate").val('');
                Flight.getFlight();

            })

            //日期选择
            $liNum = $('.calendar_ul li').length;

            $singleWidth = 137;
            $needLeft = $singleWidth * 7;
            $liWhidth = $('.calendar_ul').find('li').outerWidth()*$liNum
            $('.calendar_ul').width($liWhidth);

            var $number = 1;
            var $hasscroll = 0;
            $('#prevDate').click(function(){

                $need = $hasscroll-$needLeft;
                if($need<0){
                    $need=0;
                    $number=0;
                    $hasscroll = $need;
                }
                else{
                    $number--;
                    $hasscroll = 0;
                    $need = 0;
                }



                $('.calendar_ul').animate({left:-$need}, 2000);
            })

            $('#nextDate').click(function(){


                $leftWidth = $liWhidth-$number*$needLeft;
                if($leftWidth < $needLeft){
                    $need = $number * $needLeft-$leftWidth+50;
                    $number = 0;
                }
                else
                {
                    $need = $number * $needLeft;
                    $number++;

                }

                $hasscroll = $need;
                $('.calendar_ul').animate({left:-$need}, 2000)


            })
        }
    })
}

Flight.getFlight = function(isback){


    isback = isback ? isback : 0 ;
    backsearch = isback ? 1 : 0;
    Flight.getLowerPrice(isback);//查询低价
    var startdate = $("#startdate").val();
    var enddate = $("#enddate").val();
    var dCode = $("#startcity_3word").val();
    var aCode = $("#endcity_3word").val();
    var searchType = $("#searchtype").val();
    var startcity = $("#startcity").val();
    var endcity = $("#endcity").val();


    if(isback){
        startdate = $("#enddate").val();
        dCode = $("#endcity_3word").val();
        aCode = $("#startcity_3word").val();

        $('#txtstartcity').html(endcity);
        $('#txtendcity').html(startcity);
        $('#txtdate').html(enddate);


    }
    else{
        $('#txtstartcity').html(startcity);
        $('#txtendcity').html(endcity);
        $('#txtdate').html(startdate);
    }

    $.ajax({
        url:siteUrl+'/ticket/ajax.ticket.php',
        data:{action:'getFlight',startdate:startdate,dCode:dCode,aCode:aCode,searcType:searchType,enddate:enddate},
        dataType:'json',
        beforeSend:function(){
            $('.loadmore').show();
            $(".flight_list_con").html('');
        },
        success:function(data){
            var $flight = '';
            $dingtext = searchType == 'S'||backsearch==1 ? '预订' : '选定';


            $.each(data,function(i,row){

                $flightinfo = "{flightname:'"+row.flightname+"',airlinecode:'"+row.airlinecode+"', flightno:'"+row.flightno+"', crafttype:'"+row.crafttype+"', departairport:'"+row.startairport+"',arriveairport:'"+row.arriveairport+"',departtime:'"+row.departtime+"',arrivetime:'"+row.arrivetime+"'}";

                $flight+= '<table class="search_table">';
                $flight+= '   <tr>';
                $flight+= '       <td width="135" height="70">';
                $flight+= '  <span class="cf_time">'+row.departtime+'</span>';
                $flight+= '            <span class="dd_time">'+row.arrivetime+'</span>';
                $flight+= '       </td>';
                $flight+= '      <td width="150">'
                $flight+= '            <span class="cf_jc">'+row.startairport+'</span>';
                $flight+= '           <span class="dd_jc">'+row.arriveairport+'</span>';
                $flight+= '       </td>';
                $flight+= '        <td width="210">';
                $flight+= '            <span class="fj_jx"><b class="pubFlights_'+row.airlinecode+'">'+row.flightname+'</b>'+row.flightno+'</span>'
                $flight+= '            <span class="jh_jx">计划机型：<b>'+row.crafttype+'</b></span>';
                $flight+= '      </td>';
                $flight+= '        <td width="120"><span class="cx">'+row.seatlist[0].seat+'</span></td>'
                $flight+= '        <td width="200">'
                $flight+= '            <span class="tj_num">特价：<b><s>￥</s>'+row.seatlist[0].price+'</b></span>'
                $flight+= '            <span class="ck_num">'+row.seatlist[0].rate+'折<b>退改签</b>  <div class="box_none">'
                $flight+= '   <p><em>退签条件：</em>'+row.seatlist[0].refnote+'</p>'
                $flight+= '   <p><em>改签条件：</em>'+row.seatlist[0].rernote+'</p>'
                $flight+= '   <p><em>签转条件：</em>'+row.seatlist[0].endnote+'</p></div>'
                $flight+= '   </span></td>'
                $flight+= '        <td>'
                $flight+= '            <span class="yd_btn"><a href="javascript:;" class="yuding" data-producttype="'+ row.seatlist[0].producttype+'" data-policyid="'+row.seatlist[0].policyid+'" data-class="'+row.seatlist[0].class+'" data-price="'+row.seatlist[0].price+'" data-flight="'+$flightinfo+'">'+$dingtext+'</a></span>'
                $flight+= '           <span class="more_cw"><a class="up" href="javascript:;">更多舱位</a></span>'
                $flight+= '       </td>'
                $flight+= '       </tr>' ;

                $.each(row.seatlist,function(k,s){
                    if(k>1){
                        $flight+=' <tr>'
                        $flight+='    <td height="70">&nbsp;</td>'
                        $flight+='      <td>&nbsp;</td>'
                        $flight+='      <td>&nbsp;</td>'
                        $flight+='       <td width="120"><span class="cx">'+s.seat+'</span></td>'
                        $flight+='      <td width="200">'
                        $flight+='          <span class="tj_num">特价：<b><s>￥</s>'+s.price+'</b></span>'
                        $flight+= '            <span class="ck_num">'+row.seatlist[0].rate+'折<b>退改签</b>  <div class="box_none">'
                        $flight+= '   <p><em>退签条件：</em>'+s.refnote+'</p>'
                        $flight+= '   <p><em>改签条件：</em>'+s.rernote+'</p>'
                        $flight+= '   <p><em>签转条件：</em>'+s.endnote+'</p></div>'
                        $flight+= '   </span></td>'
                        $flight+='      <td>'
                        $flight+='          <span class="yd_btn"><a class="yuding" href="javascript:;" data-policyid="'+s.policyid+'" data-class="'+s.class+'" data-price="'+ s.price+'" data-producttype="'+ s.producttype+'" data-flight="'+$flightinfo+'" >'+$dingtext+'</a></span>'
                        $flight+='      </td>'
                        $flight+='   </tr>'

                    }

                })
               $flight+='</table>';


            })
            $(".flight_list_con").html($flight);
            $('.loadmore').hide();//关闭搜索状态
            $('.search_table').each(function() {
                $(this).find('tr').first().show();
            });
            $('.search_table .more_cw a').toggle(function(){
                $(this).parents('.search_table').first().find('tr').show();
                $(this).addClass('down').removeClass('up');
            },function(){
                $(this).removeClass('down').addClass('up');
                $(this).parents('.search_table').first().find('tr').not(':first').hide();
            })
            //签转
            $('.jh_jx').hover(function(){
                $(this).children('.box_none').show();
            },function(){
                $(this).children('.box_none').hide();
            });

            $('.ck_num').hover(function(){
                $(this).children('.box_none').show();
            },function(){
                $(this).children('.box_none').hide();
            });

            //预订事件
            $('.yuding').click(function(){
                    var txt = $(this).html();
                    var flightinfo = $(this).attr('data-flight');//flightinfo
                    var seatprice = $(this).attr('data-price');
                    var seatpolicy = $(this).attr('data-policyid');
                    var seatclass = $(this).attr('data-class');
                    //seatpolicy = seatpolicy == 'undefined' ? 0 : seatpolicy;
                    var protype = $(this).attr('data-producttype');
                    $flight =  eval('('+flightinfo+')');

                    //往返航班
                    if(txt == '选定'){
                        var html = '';
                        var startcity = $("#startcity").val();
                        var endcity = $("#endcity").val();
                        var startdate = $("#startdate").val();
                        var enddate = $("#enddate").val();
                        $goflight = "{flightno:'"+$flight.flightno+"', seatprice:'"+seatprice+"',seatpolicy:'"+seatpolicy+"',seatclass:'"+seatclass+"',protype:'"+protype+"'}";

                        html+="<h3>";
                        html+='<span class="sp_1">去程已选定</span>'
                        html+='<span class="sp_2"><em>'+startcity+' -'+ endcity+'</em>'+startdate+'</span>'
                        html+='</h3>'
                        html+='<table width="100%">'
                        html+='   <tr>'
                        html+='        <td height="70">'
                        html+='            <span class="hk_name pubFlights_'+$flight.airlinecode+'">'+$flight.flightname+$flight.flightno+'</span>'
                        html+='            <span class="hk_jx">机型：<b>'+$flight.crafttype+'</b></span>'
                        html+='        </td>'
                        html+='        <td>'
                        html+='            <span class="cf_time">'+$flight.departtime+'</span>'
                        html+='            <span class="cf_jc">'+$flight.departairport+'</span>'
                        html+='        </td>'
                        html+='        <td>'
                        html+='            <span class="dc"></span>'
                        html+='        </td>'
                        html+='        <td>'
                        html+='            <span class="dd_time">'+$flight.arrivetime+'</span>'
                        html+='            <span class="dd_jc">'+$flight.arriveairport+'</span>'
                        html+='        </td>'
                        html+='        <td>'
                        html+='            <span class="price">特价：<b><s>￥</s>'+seatprice+'</b>起</span>'
                        html+='        </td>'
                        html+='        <td>'
                        html+='            <a class="revise-btn" href="javascript:;" onclick="Flight.reSearch()">修改航班</a>'
                        html+='        </td>'
                        html+='    </tr>'
                        html+='    </table>'
                        html+='<input type="hidden" id="goflight" value="'+$goflight+'">'


                        $('.choosed').html(html);
                        $('.choosed').show();
                        Flight.getFlight(1);//查询返程航班





                    }

                    else //预订
                    {

                        var dCode = $("#startcity_3word").val();
                        var aCode = $("#endcity_3word").val();
                        var startdate = $("#startdate").val();
                        var enddate = $("#enddate").val();
                        //单程预订
                        if(backsearch == 0){


                            $url = 'http://u.ctrip.com/union/CtripRedirect.aspx?TypeID=22&AllianceID='+allianceId+'&SID='+siteid+'&Ouid=&SSOh=f808753c9bc4bc1e1cadb5b21eea9607&SSOt=20130419161317&ACity1='+aCode+'&DCity1='+dCode+'&DDate1='+startdate+'&Flight1='+$flight.flightno+'&PassengerQuantity=1&PassengerType=ADU&SendTicketCityID=1&Subclass1='+seatclass+'&ProductType1='+protype+'&Price1='+seatprice+'&PolicyID1='+seatpolicy;

                            window.open($url);
                        }
                        //往返预订
                        else if(backsearch == 1){

                           $goflight = $("#goflight").val();
                           $goflightinfo =  eval('('+$goflight+')');

                           $url =' http://u.ctrip.com/union/CtripRedirect.aspx?TypeID=23&AllianceID='+allianceId+'&SID='+siteid+'&Ouid=&SSOh=497da9301fd76be9a64ce34ce7d68972&SSOt=20130802172151&ACity1='+aCode+'&DCity1='+dCode+'&ACity2='+dCode+'&DCity2='+aCode+'&DDate1='+startdate+'&DDate2='+enddate+'&Flight1='+$goflightinfo.flightno+'&Flight2='+$flight.flightno+'&FlightWay=D&PassengerQuantity=1&PassengerType=ADU&SendTicketCityID=1&Subclass1='+$goflightinfo.seatclass+'&Subclass2='+seatclass+'&ProductType1='+$goflightinfo.protype+'&ProductType2='+protype+'&PolicyID1='+$goflightinfo.seatpolicy+'&PolicyID2='+seatpolicy+'&Price1='+$goflightinfo.seatprice+'&Price2='+seatprice;
                            window.open($url);
                        }


                        //window.location.href=$url;



                    }



            })


        }

    })


}

Flight.reSearch=function(){

    Flight.getFlight();
    $('.choosed').html('');
    $('.choosed').hide();
}
