<script src="js/funcs.js" type="text/javascript"></script>

{if isset($loggedIn)}
<table class="pageitem">
  <tr>
    <td class="controls">
      {if $controller=="beispiele"}
      <a href="{$uriHead}{$controller}/{$pproduct->tblid}/new" class="thickbox">
      {else}
      <a href="{$uriHead}{$controller}/new" class="thickbox">
      {/if}
      <acronym title="Hinzufügen"><img src="{$uriHead}img/layout/add.png" alt="Hinzufügen" /></acronym></a>
    </td>
  </tr>
</table>
{/if}

<div id="includedList">
  {if $controller == "werke"}
  {include file="ajaxCatList.tpl"}
  {else}
  {include file="ajaxList.tpl"}
  {/if}
</div>