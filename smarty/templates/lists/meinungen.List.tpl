<tr>
  <th class="leftimg"><img src="{$uriHead}{$items[id]->img()}" alt="{$items[id]->title_de()}" /></th>
  <td class="middle">
    <div class="german_b"><div class="doublepoint">{$items[id]->title_de()}</div></div>
    <div class="german"><div class="quote">{$items[id]->content_de()|markdown}</div></div>
  </td>
  <td class="right">
    <div class="english_b"><div class="doublepoint">{$items[id]->title_en()}</div></div>
    <div class="english"><div class="quote">{$items[id]->content_en()|markdown}</div></div>
    {include file="lists/listControls.tpl"}
  </td>
</tr>
{if !($smarty.section.id.last)}
<tr>
  {if isset($loggedIn)}
  <td colspan="4" class="hline_long"></td>
  {else}
  <td colspan="3" class="hline_long"></td>
  {/if}
</tr>
{/if}