<p>
  <span class="german">Name, Vorname</span> / <span class="english">name, first name</span><br />
  <input type="text" name="name" class="i1" /><input type="text" name="vorname" class="i1" />
</p>
<p>
  <span class="german">Institution 1 (fakultativ)</span> / <span class="english">institution 1 (optional)</span><br />
  <input type="text" name="institut1" class="i2" />
</p>
<p>
  <span class="german">Institution 2 (fakultativ)</span> / <span class="english">institution 2 (optional)</span><br />
  <input type="text" name="institut2" class="i2" />
</p>
<p>
  <span class="german">Strasse, Nummer</span> / <span class="english">street, no</span><br />
  <input type="text" name="strasse" class="i3" /><input type="text" name="nr" class="i4"/>
</p>
<p>
  <span class="german">PLZ, Ort</span> / <span class="english">ZIP, town</span><br />
  <input type="text" name="plz" class="i4"  /><input type="text" name="ort" class="i3" />
</p>
<p>
  <span class="german">Land</span> / <span class="english">country</span><br />
  <input type="text" name="land" class="i2" />
</p>
<p>
  <span class="german">E-Mail</span> / <span class="english">e-mail</span><br />
  <input type="text" name="mail" class="i2" />
</p>
<p>
  <span class="german">Telefon</span> / <span class="english">phone</span><br />
  <input type="text" name="tel" class="i2" />
</p>
<p>
  <span class="german">Ich habe die Lieferbedingungen gelesen und bin damit einverstanden.</span><br />
  <span class="english">I have read and agree to the terms of delivery.</span><br />
  <input type="checkbox" name="lieferbedingungen" value="1"/>
</p>
<p>
  <button type="button" value="send" onclick="return chkFormular();">
    <img src="{$uriHead}img/layout/ok.png" alt="Ok" class="formBtn" />
    <span class="german">Bestellung senden</span> / <span class="english">Submit order</span>
  </button>
</p>