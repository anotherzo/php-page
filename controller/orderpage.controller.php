<?php
  class OrderPage extends NormPage {
    public $cats;
    public $prods;
    
    public $fromMail = "webservice@domain.com";
    public $toMail = "info@domain.com";
    
    public function setupCats() {
      $tmp = new ProdCat();
      $this->cats = $tmp->findAll('1', '1');
      usort($this->cats, "cmpItems");
      $this->cats = array_values(array_filter($this->cats, "checkActive"));
     
      $this->setupProds();
    }
    
    public function setupProds() {
      $this->prods = array();
      foreach($this->cats as $cat) {
         $tmpProdArr = $cat->products();
         usort($tmpProdArr, "cmpItems");
         $tmpProdArr = array_values(array_filter($tmpProdArr, "checkActive"));
         $this->prods[] = $tmpProdArr;
      }
    }
    
    public function makeContent(){
      if(isset($this->isStart) && $this->isStart) {
        return $this->getStartView();
      }
      if(isset($this->req[1]) && $this->req[1] != "") {
        switch($this->req[1]) {
          case "shop":
            return $this->showShop();
          case "order":
            return $this->order();
          case "new":
            return $this->newItem();
          case "create":
            return $this->createItem();
          case "edit":
            return $this->editItem();
          case "show":
            return $this->showItem();
          case "delete":
            return $this->deleteItem();
          case "list":
            return $this->listItems();
          case "toggle":
            return $this->toggleItem();
          default:
            return $this->getUserView();
        }
      } else {
        return $this->getUserView();
      }
    }
    
    public function showShop() {
      $this->setupCats();
      
      $this->smarty->assign('uriHead', $this->getURIHead());
      $this->smarty->assign('controller', "bestellung");
      $this->smarty->assign('cats', $this->cats);
      $this->smarty->assign('prods', $this->prods);
     
      if($this->req[2] == "ch") {
        $this->smarty->assign('region', "ch");
      } else {
        $this->smarty->assign('region', "eu");
      }
      return $this->smarty->fetch('shop.tpl');
    }
    
    public function order() {
      $lb = htmlentities($_POST['lieferbedingungen'], ENT_COMPAT, 'UTF-8');
      
      $amounts = $_REQUEST['amount'];
      $prodnrs = $_REQUEST['prodnr'];
      $prods = array();
      for($i=0; $i<count($amounts); $i++) {
        if(isset($amounts[$i]) && $amounts[$i]!="") {
          $prods[] = array($amounts[$i], $prodnrs[$i]);
        }
      }
      
      if(!isset($lb) || count($prods) == 0) {
        $this->redirect = $this->getURIHead();
        return;
      } else {
        $name = htmlentities($_POST['name'], ENT_COMPAT, 'UTF-8');
        $vorname = htmlentities($_POST['vorname'], ENT_COMPAT, 'UTF-8');
        $institut1 = htmlentities($_POST['institut1'], ENT_COMPAT, 'UTF-8');
        $institut2 = htmlentities($_POST['institut2'], ENT_COMPAT, 'UTF-8');
        $strasse = htmlentities($_POST['strasse'], ENT_COMPAT, 'UTF-8');
        $nr = htmlentities($_POST['nr'], ENT_COMPAT, 'UTF-8');
        $plz = htmlentities($_POST['plz'], ENT_COMPAT, 'UTF-8');
        $ort = htmlentities($_POST['ort'], ENT_COMPAT, 'UTF-8');
        $land = htmlentities($_POST['land'], ENT_COMPAT, 'UTF-8');
        $mail = htmlentities($_POST['mail'], ENT_COMPAT, 'UTF-8');
        $tel = htmlentities($_POST['tel'], ENT_COMPAT, 'UTF-8');
        $lb = htmlentities($_POST['lieferbedingungen'], ENT_COMPAT, 'UTF-8');
      
        $mailBody = "
  		  <html>
  		  <head>
  		  <title>MyPage: Bestellung eingegangen</title>
  		  </head>
  		  <body>
  		  <h2>MyPage: Bestellung eingegangen</h2>
  		  <p>".$name." ".$vorname."<br />";
  		  if(isset($institut1) && $institut1 != "") {
  		    $mailBody .= $institut1."<br />";
  		  }
  		  if(isset($institut2) && $institut2 != "") {
  		    $mailBody .= $institut2."<br />";
  		  }
  		  $mailBody .= $strasse." ".$nr."<br />
  		  ".$plz." ".$ort.", ".$land."<br />
  		  Mail: ".$mail."<br/>
  		  Telefon: ".$tel."
  		  </p>
  		  <table>
  		    <tr>
  		      <th>Anzahl</th><th>Produktnr.</th>
  		    </tr>";
  		  for($i=0; $i<count($prods); $i++) {
  		    $mailBody .= "<tr><td>".$prods[$i][0]."</td><td>".$prods[$i][1]."</td></tr>";
  		  }
  		    $mailBody .= "</table>
  		  </body></html>";
        
        $header = 'MIME-Version: 1.0'."\r\n";
        $header .= 'Content-type: text/html; charset=UTF-8'."\r\n";
        $header .= 'From: '.$this->fromMail."\r\n";
        
        mail($this->toMail, 'MyPage: Bestellung eingegangen', $mailBody, $header);
      
        return $this->smarty->fetch('shopreturn.tpl');
      }
    }
  }
?>
