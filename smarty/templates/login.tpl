<form action="{$uriHead}admin/login" method="post">
  <table>
    <tr>
      <th>Benutzername:</th><td><input name="login" type="text" size="30" /></td>
    </tr>
    <tr>
      <th>Passwort:</th><td><input name="passwd" type="password" size="30"></td>
    </tr>
    <tr>
      <td></td><td><input type="submit" value="Anmelden" /></td>
    </tr>
    <tr>
      <td></td><td><a href="{$uriHead}admin/iforgot">Passwort vergessen</a></td>
    </tr>
  </table>
</form>