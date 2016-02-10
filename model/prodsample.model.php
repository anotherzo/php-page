<?php
  class ProdSample extends DBObject {
    public $memberVars = array("ord" => "",
                              "active" => "",
                              "title_de" => "",
                              "title_en" => "",
                              "product_id" => "",
                              "img" => "");
    public $belongs_to = array("product" => "Product");
    
    function __construct() {
      parent::__construct();
    }
  }
?>