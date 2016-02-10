<tr>
  <td class="exampleImg">
    <a href="{$uriHead}{$items[id]->img()}" class="examplebox">
      <img src="{$uriHead}{$items[id]->img()}" class="exampleImg" alt="Beispiel" />
    </a>
  </td>
  {include file="lists/listControls.tpl"}
</tr>
<tr>
  <td>
    <span class="german_b">{$items[id]->title_de()} &mdash;</span> <span class="english_b">{$items[id]->title_en()}</span><br />
    <a href="{$uriHead}{$items[id]->img()}" class="examplebox">Seite vergrössern &mdash; Enlarge page</a>
  </td>
</tr>
