<?php
  class AdminPage extends PartituraPage {
    
    public $fromMail = "webservice@domain.com";
    
    public function makeContent() {
      switch($this->req[1]) {
        case "login":
          return $this->doLogin();
        case "logout":
          return $this->doLogout();
        case "show":
          return $this->showItem();
        case "edit":
          return $this->editItem();
        case "iforgot":
          return $this->iforgot();
        case "send":
          return $this->send();
        case "reset":
          return $this->resetForm();
        case "setpw":
          return $this->setpw();
        default:
          return $this->showLogin();
      }
    }
    
    public function setpw() {
      $new_pw1 = $_REQUEST['pwd1'];
      $new_pw2 = $_REQUEST['pwd2'];
      if(!($new_pw1 == $new_pw2)) {
        $this->redirect = $this->getURIHead();
        return;
      } else {
        $_SESSION['user']->passwd($new_pw1);
        $_SESSION['user']->save();
        $this->smarty->assign('username', $_SESSION['user']->name());
        return $this->smarty->fetch('admin/pwdok.tpl');
      }
    }
    
    public function iforgot() {
      $this->smarty->assign("uriHead", $this->getURIHead());
      return $this->smarty->fetch('admin/iforgot.tpl');
    }
    
    public function resetForm() {
      if(!(isset($this->req[2]))) {
        $this->redirect = $this->getURIHead();
        return;
      } else {
        $hash = $this->req[2];
        $tmp = new User();
        $user = $tmp->find('iforgothash', $hash);
        if(!(isset($user)) || $user->name() == "") {
          $this->redirect = $this->getURIHead();
          return;
        } else {
          $user->iforgothash("");
          $user->save();
          $user->loggedIn = true;
          $_SESSION['user'] = $user;
          $this->smarty->assign('username', $user->name());
          return $this->smarty->fetch('admin/resetform.tpl');
        }
      }
    }
    
    public function send() {
      $address = $_REQUEST['mail'];
      if(!(isset($address)) || $address == "") {
        $this->redirect = $this->getURIHead();
        return;
      } else {
        $tmp = new User();
        $user = $tmp->find('mail', $address);
        if(!isset($user) || $user->name == "0") {
          $this->redirect = $this->getURIHead();
          return;
        } else {
          $hash = sha1(rand().$user->name());
          $user->iforgothash("$hash");
          $user->loggedIn = true;
          $user->save();
          
          $mailBody = "
    		  <html>
    		  <head>
    		  <title>MyPage: Passwort zurücksetzen</title>
    		  </head>
    		  <body>
    		  <h2>MyPage: Passwort zurücksetzen</h2>
    		  <p>Jemand möchte das Passwort für das Konto ".$user->name()." auf der MyPage zurücksetzen.</p>
    		  <p>Wenn Du das nicht selbst veranlasst hast, vergiss diese Mail einfach; das alte Passwort wird erhalten bleiben.</p>
    		  <p>Wenn Du das Passwort zurücksetzen möchtest, klick bitte auf folgenden Link und folge den Anweisungen:</p>
    		  <p><a href='".$this->getURIHead()."admin/reset/".$hash."'>Zurücksetzen</a></p>
    		  </body></html>";
          
          $header = 'MIME-Version: 1.0'."\r\n";
          $header .= 'Content-type: text/html; charset=UTF-8'."\r\n";
          $header .= 'From: '.$this->fromMail."\r\n";
          
          mail($user->mail(), 'MyPage: Passwort zurücksetzen', $mailBody, $header);
          
          $this->smarty->assign('username', $user->name());
          return $this->smarty->fetch('admin/sent.tpl');
        }
      }
    }
  
    public function showItem() {
      if(!$this->isLoggedIn() || $this->req[2] == "") {
        $this->redirect = $this->getURIHead();
        return;
      } else {
        $tmp = new PageCat();
        $item = $tmp->find('id', $this->req[2]);
        
        $this->smarty->assign('uriHead', $this->getURIHead());
        $formname = "menu.ItemForm.tpl";
        $this->smarty->assign('tmp_name', $formname);
        $this->smarty->assign('controller', "admin");
        $this->smarty->assign('itemid', $item->tblid);
        
        foreach($item->memberVars as $k => $v) {
          $tmp = str_replace("\\\"", "\"", $v);
          $this->smarty->assign($k, str_replace("\\'", "'", $tmp));
        }
        
        $this->ajaxOut = $this->smarty->fetch('showItem.tpl');
        return;
      }
    }
    
    public function editItem() {
      if(!$this->isLoggedIn() || $this->req[2] == "") {
        $this->redirect = $this->getURIHead();
        return;
      } else {
        $itemVals = $_REQUEST['item'];
        $tmp = new PageCat();
        $item = $tmp->find('id', $this->req[2]);
        foreach($itemVals as $k => $v) {
          $item->{$k}($v);
        }
        $item->save();
        $this->redirect = $this->getURIHead();
        return;
      }
    }
    
    public function showLogin() {
      $this->smarty->assign('uriHead', $this->getURIHead());
      return $this->smarty->fetch('login.tpl');
    }
    
    public function doLogin() {
      $username = $_REQUEST['login'];
      $passwd = $_REQUEST['passwd'];
      
      $tmp = new User();
      $user = $tmp->find("name", $username);
      if(is_object($user)) {
        $user->login($passwd);
        if($user->loggedIn()) {
          $_SESSION['user'] = $user;
          $this->redirect = $this->getURIHead();
          return;
        }
      }
      return $this->showLogin();
    }
    
    public function doLogout() {
      $_SESSION['user']->logout();
      $this->redirect = $this->getURIHead();
      return;
    }
  }
?>
