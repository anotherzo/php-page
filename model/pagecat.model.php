<?php
  class PageCat extends DBObject {
    public $memberVars = array("ord" => "",
                              "active" => "",
                              "title_de" => "",
                              "title_en" => "");
    public $has_many = array("pageitems" => "PageItem");
    
    function __construct() {
      parent::__construct();
    }
  }
?>