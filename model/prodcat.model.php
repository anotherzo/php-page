<?php
  class ProdCat extends DBObject {
    public $memberVars = array("ord" => "",
                              "active" => "",
                              "title_de" => "",
                              "title_en" => "");
    public $has_many = array("products" => "Product");
    
    function __construct() {
      parent::__construct();
    }
  }
?>