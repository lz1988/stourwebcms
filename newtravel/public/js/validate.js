/**
 * Created by Administrator on 14-7-28.
 */
(function($) {
    $.fn.validate = function(options) {
        var defaults ={
             errfunc:function(ele){}
        };
        var opts = $.extend(defaults, options);
        var flag = true;

        return this.each(function() {
            var $this = $(this);
            $this.find("input[datatype]").each(function(i,ele){

                var thisobj = $(this);
                var datatype = thisobj.attr('datatype');
                var errormsg = thisobj.attr('errormsg');


                if(datatype == 'require'){
                    thisobj.bind('blur keyup',function(){
                        var val=$(this).val();
                        if(!val)
                        {
                            $(this).css("border","1px solid red");
                            var y=$(this).offset().top;
                            var x=$(this).offset().left;
                            var width=$(this).width();
                            flag = false;
                            errormsg = errormsg ? errormsg : '必填项';

                            if(opts.errfunc){
                                opts.errfunc(this);
                            }
                            $.fn.validate.showMsg(errormsg,x+width+5,y-4,1000);

                        }
                        else
                        {
                            $(this).removeAttr("style");
                            flag = true;
                        }

                    })
                }
                else if(datatype == 'digital'){

                }

                $this.bind('submit',function(){
                    $this.find("input[datatype]").each(function(i,ele){

                        $(this).trigger('keyup');

                    });
                    $.fn.validate.flag = flag;
                    return false;

                })







            })


        });

    };
    /*
    * 验证通过状态
    * */
    $.fn.validate.flag = null;

    $.fn.validate.showMsg=function(msg,x,y){
        var hint=$("<div class='validate-hint' style='line-height:30px;background:white;color:red;margin-left:5px;position:absolute;top:"+y+"px;left:"+x+"px'>"+msg+"</div>");
        if(isNaN(seconds)||seconds==0)
            seconds=1000;
        $(".validate-hint").remove();
        $("body").append(hint);
        window.setTimeout(function(){

            hint.remove();

        },seconds);

    }


})(jQuery);

