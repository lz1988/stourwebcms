
{php echo Common::getScript('jquery-1.8.3.min.js,common.js,msgbox/msgbox.js'); }
{php echo Common::getCss('msgbox.css','js/msgbox'); }
<script>
    window.SITEURL =  "{php echo URL::site();}";
    window.PUBLICURL ="{$GLOBALS['cfg_public_url']}";
    window.WEBLIST =  <?php echo json_encode(array_merge(array(array('webid'=>0,'webname'=>'主站')),Common::getWebList())); ?>//网站信息数组
</script>