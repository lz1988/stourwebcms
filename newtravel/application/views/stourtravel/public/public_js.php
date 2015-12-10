{php echo Common::getScript('jquery-1.8.3.min.js,common.js,jquery.hotkeys.js,msgbox/msgbox.js,extjs/ext-all.js,extjs/locale/ext-lang-zh_CN.js'); }
{php echo Common::getCss('msgbox.css','js/msgbox'); }
{php echo Common::getCss('common.css')}
{php echo Common::getCss('ext-theme-neptune-all-debug.css','js/extjs/resources/ext-theme-neptune'); }
<script>
    window.SITEURL =  "{php echo URL::site();}";
    window.PUBLICURL ="{$GLOBALS['cfg_public_url']}";
    window.BASEHOST="{$GLOBALS['cfg_basehost']}";
    window.WEBLIST =  <?php echo json_encode(array_merge(array(array('webid'=>0,'webname'=>'主站')),Common::getWebList())); ?>//网站信息数组
   $(function(){
        $.hotkeys.add('f', function(){parent.window.showIndex(); });
        $(document).click(function(e) {
           try{
               parent.barmenu.close();
           }catch(e)
           {

           }
       });
    })
</script>