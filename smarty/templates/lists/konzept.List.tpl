<tr>
  <th class="left">
    <div class="german">{$items[id]->title_de()|markdown}</div>
    <div class="english">{$items[id]->title_en()|markdown}</div>
  </th>
  <td class="middle">{$items[id]->content_de()|markdown}</td>
  <td class="right">{$items[id]->content_en()|markdown}</td>
  {include file="lists/listControls.tpl"}
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