<div class="web-set">
    <dl>
        <dt>站点：</dt>
        <dd>
            <a href="javascript:;" class="on" data-webid="0">主站</a>
            {loop $weblist $k $v}
            <a href="javascript:;" data-webid="{$v['webid']}">{$v['webname']}</a>
            {/loop}

        </dd>
    </dl>
</div>
