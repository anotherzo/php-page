<h1>Neuer Eintrag</h1>
{if isset($catid)}
  <form action="{$uriHead}{$controller}/{$catid}/create" method="post" enctype="multipart/form-data">
{elseif isset($pproduct)}
  <form action="{$uriHead}{$controller}/{$pproduct->tblid}/create" method="post" enctype="multipart/form-data">
{else}
  <form action="{$uriHead}{$controller}/create" method="post" enctype="multipart/form-data">
{/if}  
  <table>
    {if isset($catid)}
      {include file="forms/product.ItemForm.tpl"}
    {else}
      {include file="forms/$controller.ItemForm.tpl"}
    {/if}
  </table>
</form>