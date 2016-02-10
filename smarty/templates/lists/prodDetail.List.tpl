<tr>
  <td class="img">
    <a name="{$prods[id]->tblid}" />
    {if $prods[id]->img() != "0"}
      {if $prods[id]->title_de() != "0"}
        <a href="{$uriHead}{$prods[id]->img()}" class="titlebox"><img src="{$uriHead}{$prods[id]->img_small()}" alt="Titelblatt" /></a>
      {else}
        <a href="{$uriHead}{$prods[id]->img()}" class="cdtitlebox"><img src="{$uriHead}{$prods[id]->img_small()}" alt="Titelblatt" /></a>
      {/if}
    {/if}
    {if (isset($loggedIn)) or (count($prods[id]->prodsamples()) > 0)}
      {if $prods[id]->title_de() != "0"}
        <p><a href="{$uriHead}beispiele/{$prods[id]->tblid}">Beispielseiten<br />Sample score</a></p>
      {/if}
    {/if}
  </td>
  {if $prods[id]->title_de() != "0"}
  <td class="proddesc">
    <h3>{if $prods[id]->composer_first()!= "0"}{$prods[id]->composer_first()} {/if}{$prods[id]->composer()}</h3>
    <span class="german">{$prods[id]->title_de()}</span><br/>
    <span class="english">{$prods[id]->title_en()}</span><br/>
    <span class="german">
      {if $prods[id]->instr_de() != "0"}
        {$prods[id]->instr_de()}
      {else}
        {$cat->title_de()}
      {/if}
    </span><br/>
    <span class="english">
      {if $prods[id]->instr_en() != "0"}
        {$prods[id]->instr_en()}
      {else}
        {$cat->title_en()}
      {/if}
    </span><br/>
    <br />
    {if $prods[id]->transcription_de() and $prods[id]->transcription() != "0"}
      <span class="german">{$prods[id]->transcription_de()}:</span><br/>
      <span class="english">{$prods[id]->transcription_en()}:</span><br/>
    {elseif $prods[id]->transcription_de() and $prods[id]->transcription() == "0"}
      <span class="german">{$prods[id]->transcription_de()}</span><br/>
      <span class="english">{$prods[id]->transcription_en()}</span><br/>
    {elseif $prods[id]->transcription() and $prods[id]->transcription() != "0"}
      Transkription:<br/>
      <span class="english">Transcription:</span><br/>
    {else}
      <br /><br />
    {/if}
    {if $prods[id]->transcription()}
      {$prods[id]->transcription()}
    {/if}
	<br />
    <br />
        {if $prods[id]->description() != "0" and $prods[id]->description() != ""}
      <a href="{$uriHead}werke/{$cat->tblid}/details/{$prods[id]->tblid}" class="contentbox"><span class="german">Inhalt</span> &mdash; <span class="english">Contents</span></a>
    {/if}
	<br />
    <br />
    <b>Nr./No. {$prods[id]->prod_nr()}</b><br />
    ISMN {$prods[id]->ismn()}<br />
    {if $prods[id]->price_ch() != "0"}
      CHF {$prods[id]->price_ch()|money_format} - Euro {$prods[id]->price_eu()|money_format} - USD {$prods[id]->price_us()|money_format}
    {/if}
  </td>
  {else}
  <td class="proddesc">
    <h3>{$prods[id]->title_cd()}</h3>
    <div class="desc_cd">
      {$prods[id]->description_cd()|markdown}
    </div>
    {if $prods[id]->description() != "0"}
      <a href="{$uriHead}werke/{$cat->tblid}/details/{$prods[id]->tblid}" class="contentbox"><span class="german">Inhalt</span> &mdash; <span class="english">Contents</span></a>
    {/if}
    <br />
    <br />
    <b>Nr./No. {$prods[id]->prod_nr()}</b><br />
    CHF {$prods[id]->price_ch()|money_format} - Euro {$prods[id]->price_eu()|money_format} {if $prods[id]->price_us() != "0"}- USD {$prods[id]->price_us()|money_format}{/if}
  </td>
  {/if}
  {include file="lists/prodListControls.tpl"}
</tr>
