<tr>
  <th class="left">
    <a href="{$uriHead}werke/{$cats[id]->tblid}">
      <span class="german">{$cats[id]->title_de()}</span><br/>
      <span class="english">{$cats[id]->title_en()}</span>
    </a>
  </th>
  <td><table class="prodListSmall">{include file="lists/product.List.tpl"}</table></td>
  {include file="lists/catListControls.tpl"}
</tr>
{if !($smarty.section.id.last)}
<tr>
  {if isset($loggedIn)}
  <td colspan="3" class="hline_long"></td>
  {else}
  <td colspan="2" class="hline_long"></td>
  {/if}
</tr>
{/if}