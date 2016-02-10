<script src="js/funcs.js" type="text/javascript"></script>

<h1><span class="german">{$cat->title_de()}</span> &mdash; <span class="english">{$cat->title_en()}</span>
  {if isset($loggedIn)}
  <a href="{$uriHead}{$controller}/{$cat->tblid}/new" class="thickbox"><acronym title="Hinzufügen"><img src="{$uriHead}img/layout/add.png" alt="Hinzufügen" /></acronym></a>
  {/if}
  </h1>
<div id="includedList">
  {include file="ajaxProdList.tpl"}
</div>