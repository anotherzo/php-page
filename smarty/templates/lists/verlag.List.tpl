<tr>
  <th class="leftimg">
    {if $items[id]->img() != "0"}
    <img src="{$uriHead}{$items[id]->img()}" alt="{$items[id]->title_de()}" />
    {/if}
  </th>
  <td class="middle">
    {if $items[id]->title_de() != "0"}
    <div class="german_b">{$items[id]->title_de()}</div>
    {/if}
    <div class="german">{$items[id]->content_de()|markdown}</div>
  </td>
  <td class="right">
    {if $items[id]->title_de() != "0"}
    <div class="english_b">{$items[id]->title_en()}</div>
    {/if}
    <div class="english">{$items[id]->content_en()|markdown}</div>
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