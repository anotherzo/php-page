<h1>Passwort vergessen</h1>
<form action="{$uriHead}admin/send" method="post">
  <p>Geben Sie die Mail-Adresse ein, die mit Ihrem Konto gespeichert worden ist:</p>
  <p><input type="text" name="mail" size="50" /></p>
  <p>
    <button type="button" value="send" onclick="submit();">
      <img src="{$uriHead}img/layout/ok.png" alt="Ok" class="formBtn">
      Passwort zurücksetzen
    </button>
  </p>
</form>
    