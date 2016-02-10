<table>
  <tr>
    <th>Titel (de):</th><td><input name="item[title_de]" type="text" size="60" value="{$title_de}" /></td>
  </tr>
  <tr>
    <th>Titel (en):</th><td><input name="item[title_en]" type="text" size="60" value="{$title_en}" /></td>
  </tr>
  <tr>
    <th>CD-Titel:</th><td><input name="item[title_cd]" type="text" size="60" value="{$title_cd}" /></td>
  </tr>
  <tr>
    <th>Komponist:</th><td><input name="item[composer]" type="text" size="60" value="{$composer}" /></td>
  </tr>
  <tr>
    <th>Komponist, Vorname:</th><td><input name="item[composer_first]" type="text" size="60" value="{$composer_first}" /></td>
  </tr>
  <tr>
     <th>Transkription (de):</th><td><input name="item[transcription_de]" type="text" size="60" value="{$transcription_de}" /></td>
  </tr>
  <tr>
    <th>Transkription (en):</th><td><input name="item[transcription_en]" type="text" size="60" value="{$transcription_en}" /></td>
  </tr>
  <tr>
    <th>Bearbeitet von:</th><td><input name="item[transcription]" type="text" size="60" value="{$transcription}" /></td>
  </tr>
  <tr>
    <th>Interpreten:</th><td><input name="item[interprets]" type="text" size="60" value="{$interprets}" /></td>
  </tr>
  <tr>
    <th>Instrumente (de):</th><td><input name="item[instr_de]" type="text" size="60" value="{$instr_de}" /></td>
  </tr>
  <tr>
    <th>Instrumente (en):</th><td><input name="item[instr_en]" type="text" size="60" value="{$instr_en}" /></td>
  </tr>
  <tr>
    <th>Beschreibung:</th><td><textarea name="item[description]" type="text" cols="40" rows="10">{$description}</textarea></td>
  </tr>
  <tr>
    <th>Beschreibung CD:</th><td><textarea name="item[description_cd]" type="text" cols="40" rows="10">{$description_cd}</textarea></td>
  </tr>
  <tr>
    <th>Produkt-Nr.:</th><td><input name="item[prod_nr]" type="text" size="60" value="{$prod_nr}" /></td>
  </tr>
  <tr>
    <th>ISMN:</th><td><input name="item[ismn]" type="text" size="60" value="{$ismn}" /></td>
  </tr>
  <tr>
    <th>CHF:</th><td><input name="item[price_ch]" type="text" size="60" value="{$price_ch}" /></td>
  </tr>
  <tr>
    <th>Euro:</th><td><input name="item[price_eu]" type="text" size="60" value="{$price_eu}" /></td>
  </tr>
  <tr>
    <th>USD:</th><td><input name="item[price_us]" type="text" size="60" value="{$price_us}" /></td>
  </tr>
  <tr>
    <th>Titelbild (jpg, png):</th><td><input name="fileupload" type="file"/></td>
  <tr>
    <td></td><td class="formBtn"><button type="button" value="Speichern" onclick="submit();"><img src="{$uriHead}img/layout/ok.png" alt="Ok" class="formBtn"> Speichern</button></td>
  </tr>
</table>