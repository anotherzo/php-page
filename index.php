<?php
  require_once(dirname(__FILE__).'/lib/autoloader.php');
  autoloader::init();
  
  ini_set('date.timezone', 'Europe/Zurich');
  
  session_start();
                          
  $GLOBALS['domain_sub'] = "domain";

  $requestURI = explode('/', $_SERVER['REQUEST_URI']);
  unset($requestURI[0]);
  if($requestURI[1]==$GLOBALS['domain_sub']) {
    unset($requestURI[1]);
  }
  $req = array_values($requestURI);
  
  $tmp = new PageCat();
  $cats = $tmp->findAll(1, 1, false, true);
  
  // parse routing
  for($i=0; $i<count($cats); $i++) {
    if($req[0] == $cats[$i]->uri()) {
      $conString = $cats[$i]->controller();
      $controller = new $conString;
      
      $tmp = new PageCat();
      $controller->cat = $tmp->find('uri', $req[0]);
      $controller->pageTitle = $controller->cat->title_de();
      break;
    }
  }
  // standard start page?
  if($req[0] == "") {
    $controller = new NormPage();
    $controller->isStart = true;
  }
  // admin login?
  if($req[0] == "admin") {
    $controller = new AdminPage();
    $controller->pageTitle = "Administration";
  }
  // everything else
  if(!$controller) {
    $controller = new ErrorPage();
    $controller->pageTitle = "Fehler";
  }

  $controller->setreq($req);
  $controller->show();
?>
