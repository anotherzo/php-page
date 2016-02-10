{literal}
<script type="text/javascript">
function isNotNil(value) {
  var obj = document.getElementsByName(value)[0];
  if (obj.value == "") {
    obj.style.border = "4px solid red";
    obj.focus();
    return false;
  } else {
    obj.style.border = "";
    return true;
  }
}

function isChecked(value) {
  var obj = document.getElementsByName(value)[0];
  if (obj.checked == false) {
    obj.style.border = "4px solid red";
    obj.focus();
    return false;
  } else {
    obj.style.border = "";
    return true;
  }
}

function isValidAddress(value) {
  var obj = document.getElementsByName(value)[0];
  if (obj.value == "") {
    obj.style.border = "4px solid red";
    obj.focus();
    return false;
  } else {
    if (obj.value.indexOf("@") == -1) {
      obj.style.border = "4px solid red";
      obj.focus();
      return false;
    } else {
      obj.style.border = "";
      return true;
    }
  }
}

function isNumber(value) {
  var obj = document.getElementsByName(value)[0];
  if (obj.value == "") {
    obj.style.border = "4px solid red";
    obj.focus();
    return false;
  } else {
    var chkZ = 1;
    for (i = 0; i < obj.value.length; ++i) {
      if (obj.value.charAt(i) < "0" ||
          obj.value.charAt(i) > "9")
        chkZ = -1;
    }
    if (chkZ == -1) {
      obj.style.border = "4px solid red";
      obj.focus();
      return false;
    } else {
      obj.style.border = "";
      return true;
    }
  }
}

function chkFormular() {
  if(!isNotNil("name")
      || !isNotNil("vorname")
      || !isNotNil("strasse")
      || !isNotNil("nr")
      || !isNumber("plz")
      || !isNotNil("ort")
      || !isNotNil("land")
      || !isValidAddress("mail")
      || !isNotNil("tel")
      || !isChecked("lieferbedingungen")) {
        return false;
      } else {
        document.getElementById('shopform').submit();
      }
}

function calcAmount() {
  var obj = document.getElementsByName("orderAmount")[0];
  var am = obj.value * 39.9;
  document.getElementById("calc").innerHTML = am.toFixed(2);
}
</script>
{/literal}

<form action="{$uriHead}{$controller}/order" method="post" id="shopform">
  <table class="shop">
    <tr>
      <td>
        <div id="tableContainer" class="tableContainer">
          <table class="shoplist">
            {include file="lists/shopList.tpl"}
          </table>
        </div>
      </td>
      <td class="shopform">
        {include file="forms/shopForm.tpl"}
      </td>
    </tr>
  </table>
</form>