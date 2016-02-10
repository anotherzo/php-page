{literal}
<script language="JavaScript" type="text/javascript"> 
<!-- 
function comparePwd() {
  var pwd1 = document.getElementsByName('pwd1')[0];
  var pwd2 = document.getElementsByName('pwd2')[0];
  if (pwd1.value != pwd2.value) { 
    alert ("Die Passworte sind nicht identisch."); 
    pwd1.focus(); 
    return false; 
  }
  document.getElementsByName('resetform')[0].submit();
} 

//--> 
</script>
{/literal}

<h1>Passwort zurücksetzen</h1>
<form action="{$uriHead}admin/setpw" method="post" name="resetform">
  <p>Wie soll das neue Passwort für {$username} lauten (bitte geben Sie es zweimal ein):</p>
  <p><input type="password" name="pwd1" size="50" /></p>
  <p><input type="password" name="pwd2" size="50" /></p>
  <p>
    <button type="button" value="send" onclick="comparePwd();">
      <img src="{$uriHead}img/layout/ok.png" alt="Ok" class="formBtn">
      Passwort zurücksetzen
    </button>
  </p>
</form>
