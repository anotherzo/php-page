<?php
  function cmpItems($a, $b) {
    if ($a->ord() == $b->ord()) {
      return 0;
    }
    return ($a->ord() < $b->ord()) ? -1 : 1;
  }
  
  function checkActive($item) {
    if($item->active()==0) {
      return false;
    } else {
      return true;
    }
  }

  class CatPage extends PartituraPage {
    public $highestCatOrder;
    public $cats;
    public $prods;
    public $controller = "werke";
    
    public function setupCats() {
      $tmp = new ProdCat();
      $this->cats = $tmp->findAll('1', '1');
      usort($this->cats, "cmpItems");
      if(!$this->isLoggedIn()) {
        $this->cats = array_values(array_filter($this->cats, "checkActive")); 
      }
      $this->highestCatOrder = $this->cats[count($this->cats)-1]->ord();
      
      $this->setupProds();
    }
    
    public function setupProds() {
      $this->prods = array();
      foreach($this->cats as $cat) {
         $tmpProdArr = $cat->products();
         usort($tmpProdArr, "cmpItems");
         if(!$this->isLoggedIn()) {
           $tmpProdArr = array_values(array_filter($tmpProdArr, "checkActive")); 
         }
         $this->prods[] = $tmpProdArr;
      }
    }
    
    public function makeContent(){
      if(isset($this->req[1]) && $this->req[1] != "") {
        if(is_numeric($this->req[1])) {
          if(isset($this->req[2]) && $this->req[2] != "") {
            switch($this->req[2]) {
              case "new":
                return $this->prodNewItem();
              case "create":
                return $this->prodCreateItem();
              case "edit":
                return $this->prodEditItem();
              case "show":
                return $this->prodShowItem();
              case "delete":
                return $this->prodDeleteItem();
              case "list":
                return $this->prodListItems();
              case "toggle":
                return $this->prodToggleItem();
              case "details":
                return $this->details();
              default:
                return $this->getCatUserView();
            }
          } else {
            return $this->getCatUserView();
          }
        } else {
          switch($this->req[1]) {
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
        }
      } else {
        return $this->getUserView();
      }
    }
    
    public function createTitlePic($name, $isCD) {
      $namearr = explode('/', $name);
      $newname = $namearr[0]."/".$namearr[1]."/"."title_".$namearr[2];
      if($isCD) {
        $thumb_w = 152;
        $thumb_h = 152;
      } else {
        $thumb_w = 152;
        $thumb_h = 211;
      }
      $system = explode('.', $name);
      if(preg_match('/jpg|jpeg/', $system[1])) {
      	$src_img = imagecreatefromjpeg($name);
      }
      if(preg_match('/png/', $system[1])) {
      	$src_img = imagecreatefrompng($name);
      }
      $dst_img = ImageCreateTrueColor($thumb_w, $thumb_h);
      imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $thumb_w, $thumb_h, imageSX($src_img), imageSY($src_img));
      if(preg_match("/png/", $system[1])) {
      	imagepng($dst_img, $newname); 
      } else {
      	imagejpeg($dst_img, $newname); 
      }
      imagedestroy($dst_img);
      return $newname;
    }
    
    public function getCatUserView() {
      $tmp = new ProdCat();
      $cat = $tmp->find('id', $this->req[1]);
      $prods = $cat->products();
      usort($prods, "cmpItems");
      if(!$this->isLoggedIn()) {
        $prods = array_values(array_filter($prods, "checkActive")); 
      }
      
      $this->smarty->assign('uriHead', $this->getURIHead());
      $this->smarty->assign('controller', $this->controller);
      $this->smarty->assign('cat', $cat);
      $this->smarty->assign('prods', $prods);
      return $this->smarty->fetch('prodcatpage.tpl');
    }
    
    public function getUserView() {
      $this->setupCats();
      
      $this->smarty->assign('uriHead', $this->getURIHead());
      $this->smarty->assign('controller', $this->controller);
      $this->smarty->assign('cats', $this->cats);
      $this->smarty->assign('prods', $this->prods);
      return $this->smarty->fetch('normpage.tpl');
    }
    
    public function listItems() {
      if(!$this->isLoggedIn()) {
        $this->getAjaxList();
        return;
      } else {
        $this->setupCats();
        for($i=0; $i<count($_GET['listitem']); $i++) {
          $this->cats[$_GET['listitem'][$i]-1]->ord($i);
          $this->cats[$_GET['listitem'][$i]-1]->save();
        }
        $this->setupCats();
              
        $this->getAjaxList();
        return;
      }
    }
    
    public function prodListItems() {
      if(!$this->isLoggedIn()) {
        $this->getAjaxProdList();
        return;
      } else {
        $tmp = new ProdCat();
        $cat = $tmp->find('id', $this->req[1]);
        $prods = $cat->products();
        usort($prods, "cmpItems");
        for($i=0; $i<count($_GET['listitem']); $i++) {
          $prods[$_GET['listitem'][$i]-1]->ord($i);
          $prods[$_GET['listitem'][$i]-1]->save();
        }
              
        $this->getAjaxProdList();
        return;
      }
    }
    
    public function handleUpload() {
      $target_path = "img/db/".date("mdHis").basename( $_FILES['fileupload']['name']);
      if(move_uploaded_file($_FILES['fileupload']['tmp_name'], $target_path)) {
          return $target_path;
      } else{
          return "";
      }
    }
    
    public function createItem() {
      if(!$this->isLoggedIn()) {
        return $this->getUserView();
      } else {
        $itemVals = $_REQUEST['item'];
        $newItem = new ProdCat();
        foreach($itemVals as $k => $v) {
          $newItem->{$k}($v);
        }
        $newItem->ord($this->highestItemOrder + 1);
        $newItem->active(1);
        
        $newItem->save();
        
        return $this->getUserView();
      }
    }
    
    public function prodCreateItem() {
      if(!$this->isLoggedIn()) {
        return $this->getCatUserView();
      } else {
        $itemVals = $_REQUEST['item'];
        $newItem = new Product();
        foreach($itemVals as $k => $v) {
          $newItem->{$k}($v);
        }
        $newItem->ord($this->highestItemOrder + 1);
        $newItem->active(1);
        
        $tmp = new ProdCat();
        $cat = $tmp->find('id', $this->req[1]);
        
        $newItem->prodcat($cat);
        
        if(isset($_FILES['fileupload']) && $_FILES['fileupload']['name'] != "") {
          $newItem->img($this->handleUpload());
          if($newItem->title_cd() != "" && $newItem->title_cd() != "0") {
            $isCD = true;
          } else {
            $isCD = false;
          }
          $newItem->img_small($this->createTitlePic($newItem->img(), $isCD));
        }
        
        $newItem->save();
        
        return $this->getCatUserView();
      }
    }
    
    public function newItem() {
      if(!$this->isLoggedIn()) {
        return $this->getUserView();
      } else {
        $this->smarty->assign('uriHead', $this->getURIHead());
        $this->smarty->assign('controller', "werke");
        $this->ajaxOut = $this->smarty->fetch('newItem.tpl');
        return;
      }
    }
    
    public function prodNewItem() {
      if(!$this->isLoggedIn()) {
        return $this->getCatUserView();
      } else {
        $this->smarty->assign('uriHead', $this->getURIHead());
        $this->smarty->assign('controller', "werke");
        $this->smarty->assign('catid', $this->req[1]);
        $this->ajaxOut = $this->smarty->fetch('newItem.tpl');
        return;
      }
    }
    
    public function editItem() {
      if(!$this->isLoggedIn() || $this->req[2] == "") {
        return $this->getUserView();
      } else {
        $itemVals = $_REQUEST['item'];
        $tmp = new ProdCat();
        $item = $tmp->find('id', $this->req[2]);
        foreach($itemVals as $k => $v) {
          $item->{$k}($v);
        }
        $item->save();

        return $this->getUserView();
      }
    }
    
    public function prodEditItem() {
      if(!$this->isLoggedIn()) {
        return $this->getCatUserView();
      } else {
        $itemVals = $_REQUEST['item'];
        $tmp = new Product();
        $item = $tmp->find('id', $this->req[3]);
        foreach($itemVals as $k => $v) {
          $item->{$k}($v);
        }
        if(is_uploaded_file($_FILES['fileupload']['tmp_name'])) {
          $item->img($this->handleUpload());
          if($item->title_cd() != "" && $item->title_cd() != "0") {
            $isCD = true;
          } else {
            $isCD = false;
          }
          $item->img_small($this->createTitlePic($item->img(), $isCD));
        }
        $item->save();

        return $this->getCatUserView();
      }
    }
    
    public function showItem() {
      if(!$this->isLoggedIn() || $this->req[2] == "") {
        return $this->getUserView();
      } else {
        $tmp = new ProdCat();
        $item = $tmp->find('id', $this->req[2]);
        
        $this->smarty->assign('uriHead', $this->getURIHead());
        $formname = $this->cat->uri().".ItemForm.tpl";
        $this->smarty->assign('tmp_name', $formname);
        $this->smarty->assign('controller', "werke");
        $this->smarty->assign('itemid', $item->tblid);
        
        foreach($item->memberVars as $k => $v) {
          $tmp = str_replace("\\\"", "\"", $v);
          $this->smarty->assign($k, str_replace("\\'", "'", $tmp));
        }
        
        $this->ajaxOut = $this->smarty->fetch('showItem.tpl');
        return;
      }
    }
    
    public function prodShowItem() {
      if(!$this->isLoggedIn() || $this->req[2] == "") {
        return $this->getUserView();
      } else {
        $tmp = new Product();
        $item = $tmp->find('id', $this->req[3]);
        
        $this->smarty->assign('uriHead', $this->getURIHead());
        $formname = "product.ItemForm.tpl";
        $this->smarty->assign('tmp_name', $formname);
        $this->smarty->assign('controller', "werke");
        $this->smarty->assign('itemid', $item->tblid);
        $this->smarty->assign('catid', $this->req[1]);
        
        foreach($item->memberVars as $k => $v) {
          $tmp = str_replace("\\\"", "\"", $v);
          $this->smarty->assign($k, str_replace("\\'", "'", $tmp));
        }
        
        $this->ajaxOut = $this->smarty->fetch('showItem.tpl');
        return;
      }
    }
    
    public function deleteItem() {
      if(!$this->isLoggedIn() || $this->req[2] == "") {
        return $this->getUserView();
      } else {
        $tmp = new ProdCat();
        $item = $tmp->find('id', $this->req[2]);
        $item->delete();
        
        // $this->setupItems();
        return $this->getUserView();
      }
    }
    
    public function prodDeleteItem() {
      if(!$this->isLoggedIn() || $this->req[2] == "") {
        return $this->getUserView();
      } else {
        $tmp = new Product();
        $item = $tmp->find('id', $this->req[3]);
        $item->delete();
        
        // $this->setupItems();
        return $this->getCatUserView();
      }
    }
    
    public function toggleItem() {
      if(!$this->isLoggedIn() || $this->req[2] == "") {
        return $this->getUserView();
      } else {
        $tmp = new ProdCat();
        $item = $tmp->find('id', $this->req[2]);
        if($item->active() == 0) {
          $item->active(1);
        } else {
          $item->active(0);
        }
        $item->save();
        
        $this->setupCats();
        $this->getAjaxList();
        return;
      }
    }
    
    public function prodToggleItem() {
      if(!$this->isLoggedIn() || $this->req[2] == "") {
        return $this->getUserView();
      } else {
        $tmp = new Product();
        $item = $tmp->find('id', $this->req[3]);
        if($item->active() == 0) {
          $item->active(1);
        } else {
          $item->active(0);
        }
        $item->save();
        
        $this->getAjaxProdList();
        return;
      }
    }
    
    public function details() {
      $tmp = new Product();
      $item = $tmp->find('id', $this->req[3]);
      $this->smarty->assign("product", $item);
      $this->ajaxOut = $this->smarty->fetch("prodDetails.tpl");
    }
    
    public function getAjaxList() {
      $this->smarty->assign('uriHead', $this->getURIHead());
      $this->smarty->assign('controller', $this->controller);
      $this->smarty->assign('cats', $this->cats);
      $this->smarty->assign('prods', $this->prods);
      $this->ajaxOut = $this->smarty->fetch("ajaxCatList.tpl");
    }
    
    public function getAjaxProdList() {
      $tmp = new ProdCat();
      $cat = $tmp->find('id', $this->req[1]);
      $prods = $cat->products();
      usort($prods, "cmpItems");
      
      $this->smarty->assign('uriHead', $this->getURIHead());
      $this->smarty->assign('controller', $this->controller);
      $this->smarty->assign('cat', $cat);
      $this->smarty->assign('prods', $prods);
      $this->ajaxOut = $this->smarty->fetch("ajaxProdList.tpl");
    }
  }
?>