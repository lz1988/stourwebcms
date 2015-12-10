
    <span class="kinditem" id="tb_databackup" data-url="databackup/index/parentkey/tool/itemid/8" data-name="数据备份"><s></s>数据备份</span>
    <span class="kinditem" id="tb_datarecovery" data-url="databackup/recovery/parentkey/tool/itemid/8" data-name="数据恢复"><s></s>数据恢复</span>
    <script>
        $('.kinditem').click(function(){
            var url = $(this).attr('data-url');
            var urlname = $(this).attr('data-name');
            ST.Util.addTab(urlname,url);
        })
    </script>
