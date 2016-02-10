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

  class NormPage extends PartituraPage {
    public $highestItemOrder;
    
    public function setupItems() {
      $this->items = $this->cat->pageitems();
      usort($this->items, "cmpItems");
      if(!$this->isLoggedIn()) {
        $this->items = array_values(array_filter($this->items, "checkActive")); 
      }
      if(count($this->items) > 0) {
        $this->highestItemOrder = $this->items[count($this->items)-1]->ord();
      } else {
        $this->highestItemOrder = 0;
      }
    }
    
    public function makeContent(){
      // $this->setupItems();
      
      if(isset($this->isStart) && $this->isStart) {
        return $this->getStartView();
      }
      if(isset($this->req[1]) && $this->req[1] != "") {
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
      } else {
        return $this->getUserView();
      }
    }
    
    public function getStartView() {
      $this->smarty->assign('uriHead', $this->getURIHead());
      return $this->smarty->fetch('startpage.tpl');
    }
    
    public function getUserView() {
      // $controllerLink = $this->cat->uri();
      $this->setupItems();
      
      $this->smarty->assign('uriHead', $this->getURIHead());
      $this->smarty->assign('controller', $this->cat->uri());
      $this->smarty->assign('items', $this->items);
      return $this->smarty->fetch('normpage.tpl');
    }
    
    public function listItems() {
      if(!$this->isLoggedIn()) {
        $this->smarty->assign('uriHead', $this->getURIHead());
        $this->smarty->assign('controller', $this->cat->uri());
        $this->smarty->assign('items', $this->items);
        $this->ajaxOut = $this->smarty->fetch("lists/".$this->cat->uri().".List.tpl");
        return;
      } else {
        $this->setupItems();
        for($i=0; $i<count($_GET['listitem']); $i++) {
          $this->items[$_GET['listitem'][$i]-1]->ord($i);
          $this->items[$_GET['listitem'][$i]-1]->save();
        }
        $this->setupItems();
              
        $this->getAjaxList();
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
        $newItem = new PageItem();
        foreach($itemVals as $k => $v) {
          $newItem->{$k}($v);
        }
        $newItem->ord($this->highestItemOrder + 1);
        $newItem->active(1);
        $newItem->pagecat($this->cat);
        
        if(isset($_FILES['fileupload']) && $_FILES['fileupload']['name'] != "") {
          $newItem->img($this->handleUpload());
        }
        
        $newItem->save();
        
        return $this->getUserView();
      }
    }
    
    public function newItem() {
      if(!$this->isLoggedIn()) {
        return $this->getUserView();
      } else {
        $this->smarty->assign('uriHead', $this->getURIHead());
        $this->smarty->assign('controller', $this->cat->uri());
        $this->ajaxOut = $this->smarty->fetch('newItem.tpl');
        return;
      }
    }
    
    public function editItem() {
      if(!$this->isLoggedIn() || $this->req[2] == "") {
        return $this->getUserView();
      } else {
        $itemVals = $_REQUEST['item'];
        $tmp = new PageItem();
        $item = $tmp->find('id', $this->req[2]);
        foreach($itemVals as $k => $v) {
          $item->{$k}($v);
        }
        if(is_uploaded_file($_FILES['fileupload']['tmp_name'])) {
          $item->img($this->handleUpload());
        }
        $item->save();
        
        // $this->setupItems();
        return $this->getUserView();
      }
    }
    
    public function showItem() {
      if(!$this->isLoggedIn() || $this->req[2] == "") {
        return $this->getUserView();
      } else {
        $tmp = new PageItem();
        $item = $tmp->find('id', $this->req[2]);
        
        $this->smarty->assign('uriHead', $this->getURIHead());
        $formname = $this->cat->uri().".ItemForm.tpl";
        $this->smarty->assign('tmp_name', $formname);
        $this->smarty->assign('controller', $this->cat->uri());
        $this->smarty->assign('itemid', $item->tblid);
        
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
        $tmp = new PageItem();
        $item = $tmp->find('id', $this->req[2]);
        $item->delete();
        
        // $this->setupItems();
        return $this->getUserView();
      }
    }
    
    public function toggleItem() {
      if(!$this->isLoggedIn() || $this->req[2] == "") {
        return $this->getUserView();
      } else {
        $tmp = new PageItem();
        $item = $tmp->find('id', $this->req[2]);
        if($item->active() == 0) {
          $item->active(1);
        } else {
          $item->active(0);
        }
        $item->save();
        
        $this->setupItems();
        $this->getAjaxList();
        return;
      }
    }
    
    public function getAjaxList() {
      $this->smarty->assign('uriHead', $this->getURIHead());
      $this->smarty->assign('controller', $this->cat->uri());
      $this->smarty->assign('items', $this->items);
      $this->ajaxOut = $this->smarty->fetch("ajaxList.tpl");
    }
  }
?>