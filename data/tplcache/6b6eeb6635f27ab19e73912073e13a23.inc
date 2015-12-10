<div class="list_on" id="mdd_{sline:field.kindid/}">
              <h3>{sline:field.destname/}旅游目的地</h3>
              {sline:getdest flag='next' row='100'}
              <dl>
                <dt><a href="[field:url/]">[field:kindname/] [field:pinyin/]</a></dt>
                [field:id function="getDestChildHtml(@me)"/]
              
               
              </dl>
              {/sline:getdest}
              
            </div>