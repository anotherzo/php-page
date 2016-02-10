<tr>
  <th class="left">
    <div class="german">{$items[id]->title_de()}</div>
    <div class="english">{$items[id]->title_en()}</div>
  </th>
  <td class="middle"><div class="german">{$items[id]->content_de()|markdown}</div></td>
  <td class="right"><div class="english">{$items[id]->content_en()|markdown}</div></td>
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