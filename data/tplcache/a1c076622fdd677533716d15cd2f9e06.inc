<dl>
              <dt>{sline:field.groupname/}：</dt>
              <dd class="attr_list">
                <span class="sp_1"><a class="on" href="{sline:field.attrid function=getSearchUrl(null,null,@me)/}" data-field="attrid" data-value="0">全部</a></span>
                <span class="sp_2">
                   {sline:getattrbygroup}
                      <a href="[field:attrid function=getSearchUrl(@me,'attrid')/]"  data-field="attrid" data-value="[field:attrid/]">[field:title/]</a>
                   {/sline:getattrbygroup}
                   
                </span>
              </dd>
            </dl>