{if isset($loggedIn)}
{literal}
<script type="text/javascript">
$(document).ready(function() { 
  $("#products_sortable").sortable({ 
    // handle : '.handle', 
    update : function() { 
      var order = $('#products_sortable').sortable('serialize');
      $("#includedList").load( {/literal}
      "{$uriHead}{$controller}/{$cat->tblid}/list/ord?"+order); 
    } 
  }); 
});
{literal}
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
  "{$uriHead}{$controller}/{$cat->tblid}/toggle/"+itemnr);
}
</script>
{/if}
{literal}
<script type="text/javascript">
$(document).ready(function() { 
  $(".titlebox").colorbox({width:"600px", height:"870px"});
});

$(document).ready(function() { 
  $(".cdtitlebox").colorbox({width:"467px", height:"480px"});
});

$(document).ready(function() { 
  $(".contentbox").colorbox({width:"750px", height:"780px"});
});
</script>
{/literal}

<ul id="products_sortable">
{section name=id loop=$prods}
<li id="listitem_{counter}" class="lisort">
  {if $prods[id]->active() == 1}
    <table class="product">
  {else}
    <table class="product_inactive">
  {/if}
  {include file="lists/prodDetail.List.tpl"}
  </table>
</li>
{if !(isset($loggedIn)) and $smarty.section.id.iteration is even and !($smarty.section.id.last)}
<li class="hlinerule"></li>
{/if}
{/section}
</ul>
