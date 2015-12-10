<dl>
                <dt>出发地：</dt>
                <dd id="startcity_list">
                    <span class="sp_1"><a class="on" href="{sline:global.startcity function=getSearchUrl(0,'startcity')/}" data-field="destid" data-value="0" >全部</a></span>
                  <span class="sp_2">
                    {sline:getstartplace flag='top'}
                     <a href="[field:id function=getSearchUrl(@me,'startcity')/]" data-field="startcity" data-value="[field:id/]" >[field:cityname/]</a>
                    {/sline:getstartplace}


                  </span>
                </dd>
            </dl>