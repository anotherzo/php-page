{if isset($loggedIn)}
  <td class="controls">
    {if isset($prodid)}
    <a href="{$uriHead}{$controller}/{$prodid}/show/{$items[id]->tblid}" class="thickbox">
    {elseif isset($pproduct)}
    <a href="{$uriHead}{$controller}/{$pproduct->tblid}/show/{$items[id]->tblid}" class="thickbox">
    {else}
    <a href="{$uriHead}{$controller}/show/{$items[id]->tblid}" class="thickbox">
    {/if}
    <acronym title="Bearbeiten"><img src="{$uriHead}img/layout/edit.png" alt="Bearbeiten" /></acronym></a><br/>
    {if isset($pproduct)}
    <a href="{$uriHead}{$controller}/{$pproduct->tblid}/delete/{$items[id]->tblid}" onclick="return confirmDelete()">
    {else}
    <a href="{$uriHead}{$controller}/delete/{$items[id]->tblid}" onclick="return confirmDelete()">
    {/if}
    <acronym title="Löschen"><img src="{$uriHead}img/layout/delete.png" alt="Löschen" /></acronym></a><br/>
      <a  href="javascript:toggleItem({$items[id]->tblid});">
      {if $items[id]->active() == 1}
      <acronym title="Einschalten">
      <img src="{$uriHead}img/layout/off.png" alt="Einschalten" />
      </acronym>
      {else}
      <acronym title="Ausschalten">
      <img src="{$uriHead}img/layout/on.png" alt="Ausschalten" />
      </acronym>
      {/if}
    </a>
  </td>
{/if}