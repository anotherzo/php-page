<table>
  <tr>
    <th>Titel (de):</th><td><input name="item[title_de]" type="text" size="60" value="{$title_de}" /></td>
  </tr>
  <tr>
    <th>Titel (en):</th><td><input name="item[title_en]" type="text" size="60" value="{$title_en}" /></td>
  </tr>
  <tr>
    <th>Link:</th><td><input name="item[content_de]" type="text" size="60" value="{$content_de}" /></td>
  </tr>
  <tr>
    <th>Bild:</th><td><input name="fileupload" type="file"/></td>
  <tr>
    <td></td><td class="formBtn"><button type="button" value="Speichern" onclick="submit();"><img src="{$uriHead}img/layout/ok.png" alt="Ok" class="formBtn"> Speichern</button></td>
  </tr>
</table>