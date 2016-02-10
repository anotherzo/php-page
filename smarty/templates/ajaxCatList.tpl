{if isset($loggedIn)}
{literal}
<script type="text/javascript">
$(document).ready(function() { 
  $("#sortable").sortable({ 
    // handle : '.handle', 
    update : function() { 
      var order = $('#sortable').sortable('serialize');
      $("#includedList").load( {/literal}
      "{$uriHead}{$controller}/list/ord?"+order); 
    } 
  }); 
});
{literal}
$(document).ready(function() { 
  $(".thickbox").colorbox({width:"700px", height:"600px"});
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
  "{$uriHead}{$controller}/toggle/"+itemnr);
}
</script>
{/if}

<ul id="sortable">
{section name=id loop=$cats}
<li id="listitem_{counter}" class="lisort">
  {if $cats[id]->active() == 1}
    <table class="catitem">
  {else}
    <table class="catitem_inactive">
  {/if}
  {include file="lists/$controller.List.tpl"}
  </table>
</li>
{/section}
</ul>