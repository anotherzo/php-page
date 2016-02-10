{if $prods[id][it]->title_de() != "0"}
<td class="middle">
  <a href="{$uriHead}werke/{$cats[id]->tblid}#{$prods[id][it]->tblid}">
  <span class="german">{$prods[id][it]->composer()} {$prods[id][it]->title_de()}
  {if $prods[id][it]->transcription_de() != "0"}
    {$prods[id][it]->transcription_de()}
  {/if}
  </span>
  </a>
</td>
<td class="right">
  <a href="{$uriHead}werke/{$cats[id]->tblid}#{$prods[id][it]->tblid}">
  <span class="english">{$prods[id][it]->composer()} {$prods[id][it]->title_en()} 
    {if $prods[id][it]->transcription_en() != "0"}
      {$prods[id][it]->transcription_en()}
    {/if}
  </span>
  </a>
</td>
{else}
<td class="middle">
  <a href="{$uriHead}werke/{$cats[id]->tblid}#{$prods[id][it]->tblid}">
    <span class="german">{$prods[id][it]->title_cd()} - {$prods[id][it]->interprets()}</span>
  </a>
</td>
<td class="right">
  <a href="{$uriHead}werke/{$cats[id]->tblid}#{$prods[id][it]->tblid}">
    <span class="english">{$prods[id][it]->title_cd()} - {$prods[id][it]->interprets()}</span>
  </a>
</td>
{/if}