{if isset($loggedIn)}
{literal}
<script type="text/javascript">
$(document).ready(function() { 
  $("#sortable").sortable({ 
    // handle : '.handle', 
    update : function() { 
      var order = $('#sortable').sortable('serialize');
      $("#includedList").load( {/literal}
      {if isset($pproduct)}
      "{$uriHead}{$controller}/{$pproduct->tblid}/list/ord?"+order); 
      {else}
      "{$uriHead}{$controller}/list/ord?"+order); 
      {/if}
    } 
  }); 
});
{literal}
$(document).ready(function() { 
  $(".thickbox").colorbox({width:"700px", height:"650px"});
});

function confirmDelete() {
  var agree=confirm("Sind Sie sicher, dass dieses Objekt gelöscht werden soll? Diese Entscheidung kann nicht rückgängig gemacht werden!");
  if(agree) {
    return true;
  } else {
    return false;
  }
}

function toggleItem(itemnr) {
  $("#includedList").load( {/literal}
  {if isset($pproduct)}
  "{$uriHead}{$controller}/{$pproduct->tblid}/toggle/"+itemnr);
  {else}
  "{$uriHead}{$controller}/toggle/"+itemnr);
  {/if}
}
</script>
{/if}

<script type="text/javascript">
{literal}
$(document).ready(function() { 
  $(".examplebox").colorbox({width:"1000px", height:"1500px"});
});
{/literal}
</script>

{if isset($pproduct)}
<h2>{$pproduct->composer()} &mdash; {$pproduct->title_de()} &mdash; <span class="english">{$pproduct->title_en()}</span></h2>
<div class="examples">
{/if}

{if $controller == "bestellung"}
<div class="flags">
{/if}
<ul id="sortable">
{section name=id loop=$items}
<li id="listitem_{counter}" class="lisort">
  {if $items[id]->active() == 1}
    <table class="pageitem">
  {else}
    <table class="pageitem_inactive">
  {/if}
  {include file="lists/$controller.List.tpl"}
  </table>
</li>
{/section}
</ul>
{if $controller == "bestellung"}
</div>
{/if}
{if isset($pproduct)}
</div>
{/if}
