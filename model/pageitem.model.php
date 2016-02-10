<?php
  class PageItem extends DBObject {
    public $memberVars = array("pagecat_id" => "",
                              "ord" => "",
                              "active" => "",
                              "title_de" => "",
                              "title_en" => "",
                              "content_de"=> "",
                              "content_en" => "",
                              "img" => "");
    public $belongs_to = array("pagecat" => "PageCat");
    
    function __construct() {
      parent::__construct();
    }
  }
?>