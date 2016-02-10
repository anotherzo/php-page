<?php
  class PartituraPage {
    public $pageTitle;
    public $cat;
    public $req;
    public $smarty;
    public $isStart;
    
    public $redirect;
    public $ajaxOut;
    
    public function __construct() {
      $this->smarty = new Smarty();

      $this->smarty->template_dir = dirname(__FILE__).'/../smarty/templates';
      $this->smarty->compile_dir = dirname(__FILE__).'/../smarty/templates_c';
      $this->smarty->cache_dir = dirname(__FILE__).'/../smarty/cache';
      $this->smarty->config_dir = dirname(__FILE__).'/../smarty/configs';
    }
    
    public function setreq($request) {
      $this->req = $request;
      $this->parseRequest();
    }
    
    private function parseRequest() {
      return;
    }
    
    public function getURIHead() {
      $result = "http://".$_SERVER['SERVER_NAME']."/";
      if($GLOBALS['domain_sub']!="") {
        $result .= $GLOBALS['domain_sub']."/";
      }
      return $result;
    }
    
    public function show() {
      $output = $this->makeHeader();
      $output .= $this->makeMenu();
      $output .= $this->makeContent();
      $output .= $this->makeFooter();
      
      if($this->redirect != "") {
        echo header("Location: $this->redirect");
      } elseif($this->ajaxOut != "") {
        echo $this->ajaxOut;
      } else {
        echo $output;
      }
    }
    
    private function makeHeader() {
      $this->smarty->assign('uriHead', $this->getURIHead());
      $this->smarty->assign('pageTitle', $this->pageTitle);
      $this->passLogin();
      return $this->smarty->fetch('header.tpl');
    }
    
    private function makeFooter() {
      $this->smarty->assign('uriHead', $this->getURIHead());
      return $this->smarty->fetch('footer.tpl');
    }
    
    private function makeMenu() {
      $tmp = new PageCat();
      $cats = $tmp->findAll('active', 1);
      $this->smarty->assign('uriHead', $this->getURIHead());
      $this->smarty->assign('pageCats', $cats);
      if(!isset($this->isStart) && isset($this->cat) && $this->cat->uri() == "beispiele") {
        $werke = $tmp->find('uri', "werke");
        $this->smarty->assign('activeId', $werke->tblid);
      } else {
        $this->smarty->assign('activeId', $this->cat->tblid);
      }
      $this->passLogin();
      return $this->smarty->fetch('menu.tpl');
    }
    
    public function makeContent() {
      $this->smarty->assign('uriHead', $this->getURIHead());
      $this->smarty->assign('controllerclass', get_class($this));
      $this->smarty->assign('aReq', $this->req);
      $this->smarty->assign('sessUser', $_SESSION['user']);
      return $this->smarty->fetch('testcontent.tpl');
    }
    
    public function passLogin() {
      if($this->isLoggedIn()) {
        $this->smarty->assign('loggedIn', true);
      }
    }
    
    public function isLoggedIn() {
      return (is_object($_SESSION['user']) && $_SESSION['user']->loggedIn());
    }
  }
?>
