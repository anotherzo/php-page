{if isset($loggedIn)}
  <td class="controls"><a href="{$uriHead}{$controller}/show/{$cats[id]->tblid}?height=500&width=700&modal=true" class="thickbox"><acronym title="Bearbeiten"><img src="{$uriHead}img/layout/edit.png" alt="Bearbeiten" /></acronym></a><br/>
    <a href="{$uriHead}{$controller}/delete/{$cats[id]->tblid}" onclick="return confirmDelete()"><acronym title="Löschen"><img src="{$uriHead}img/layout/delete.png" alt="Löschen" /></acronym></a><br/>
    <!-- <a href="{$uriHead}{$controller}/toggle/{$items[id]->tblid}"> -->
      <a  href="javascript:toggleItem({$cats[id]->tblid});">
      {if $cats[id]->active() == 1}
      <acronym title="Einschalten">
      <img src="{$uriHead}img/layout/off.png" alt="Einschalten" />
      </acronym>
      {else}
      <acronym title="Ausschalten">
      <img src="{$uriHead}img/layout/on.png" alt="Ausschalten" />
      </acronym>
      {/if}
    </a></td>
{/if}