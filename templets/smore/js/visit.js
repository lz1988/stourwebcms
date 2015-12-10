/**
 * Created by Administrator on 15-4-2.
 * 访问统计
 */
window.onload = function(){
   // visitStats();
};
function visitStats()
{
    var referrer = document.referrer;
    var phpself = document.location.href;
    var title = document.title;
    $.ajax({
        type: "post",
        data: "dopost=visit&referrer="+encodeURIComponent(referrer)+"&php_self="+phpself+"&title="+encodeURIComponent(title),
        url: "/ajax/stats.php",
        beforeSend: function(){
        },
        success: function(data)
        {
        },
        error: function()
        {
            //alert("请求出错，请重试");
        }
    });
}