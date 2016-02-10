{section name=it loop=$prods[id]}
  {if $prods[id][it]->active() == 1}
    <tr class="prodListItem">
  {else}
    <tr class="prodListItem_inactive">
  {/if}
  {include file="lists/productItem.List.tpl"}
  </tr>
{/section}