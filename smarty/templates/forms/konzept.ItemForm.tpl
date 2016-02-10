<table>
  <tr>
    <th>Titel (de):</th><td><input name="item[title_de]" type="text" size="60" value="{$title_de}" /></td>
  </tr>
  <tr>
    <th>Titel (en):</th><td><input name="item[title_en]" type="text" size="60" value="{$title_en}" /></td>
  </tr>
  <tr>
    <th>Inhalt (de):</th><td><textarea name="item[content_de]" type="text" cols="50" rows="10">{$content_de}</textarea></td>
  </tr>
  <tr>
    <th>Inhalt (en):</th><td><textarea name="item[content_en]" type="text" cols="50" rows="10">{$content_en}</textarea></td>
  </tr>
  <tr>
    <td></td><td class="formBtn"><button type="button" value="Speichern" onclick="submit();"><img src="{$uriHead}img/layout/ok.png" alt="Ok" class="formBtn"> Speichern</button></td>
  </tr>
</table>