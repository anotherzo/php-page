{if isset($loggedIn)}
  <td class="prodControls"><a href="{$uriHead}{$controller}/{$cat->tblid}/show/{$prods[id]->tblid}" class="contentbox"><acronym title="Bearbeiten"><img src="{$uriHead}img/layout/edit.png" alt="Bearbeiten" /></acronym></a><br/>
    <a href="{$uriHead}{$controller}/{$cat->tblid}/delete/{$prods[id]->tblid}" onclick="return confirmDelete();"><acronym title="Löschen"><img src="{$uriHead}img/layout/delete.png" alt="Löschen" /></acronym></a><br/>
    <!-- <a href="{$uriHead}{$controller}/toggle/{$items[id]->tblid}"> -->
      <a  href="javascript:toggleItem({$prods[id]->tblid});">
      {if $prods[id]->active() == 1}
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
