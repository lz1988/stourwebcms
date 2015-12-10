
<span class="kinditem isattr on" data-url="attrid/modelattr/parentkey/kind/itemid/{$typeid}/typeid/{$typeid}" data-name="属性分类"><s></s>属性分类</span>
<span class="kinditem " data-url="destination/destination/parentkey/kind/itemid/{$typeid}/typeid/{$typeid}" data-name="目的地"><s></s>目的地</span>
<span class="kinditem " data-url="attrid/extendlist/parentkey/kind/itemid/{$typeid}/typeid/{$typeid}" data-name="扩展字段"><s></s>扩展字段</span>
<script>
    $('.kinditem').click(function(){

        var url = $(this).attr('data-url');
        var urlname = $(this).attr('data-name');
        ST.Util.addTab(urlname,url);
    })

</script>
