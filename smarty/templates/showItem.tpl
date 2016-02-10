<h1>Eintrag bearbeiten</h1>
{if isset($catid)}
<form action="{$uriHead}{$controller}/{$catid}/edit/{$itemid}" method="post" enctype="multipart/form-data">
{elseif $tmp_name == "menu.ItemForm.tpl"}
<form action="{$uriHead}admin/edit/{$itemid}" method="post" enctype="multipart/form-data">
{elseif isset($pproduct)}
<form action="{$uriHead}{$controller}/{$pproduct->tblid}/edit/{$itemid}" method="post" enctype="multipart/form-data">
{else}
<form action="{$uriHead}{$controller}/edit/{$itemid}" method="post" enctype="multipart/form-data">
{/if}
  <table>
    {include file="forms/$tmp_name"}
  </table>
</form>