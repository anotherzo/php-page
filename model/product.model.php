<?php
  class Product extends DBObject {
    public $memberVars = array("prodcat_id" => "",
                              "ord" => "",
                              "active" => "",
                              "title_de" => "",
                              "title_en" => "",
                              "title_cd" => "",
                              "composer" => "",
                              "composer_first" => "",
                              "description" => "",
                              "description_cd" => "",
                              "interprets" => "",
                              "instr_de"=> "",
                              "instr_en" => "",
                              "transcription_de" => "",
                              "transcription_en" => "",
                              "transcription" => "",
                              "prod_nr" => "",
                              "ismn" => "",
                              "price_ch" => "",
                              "price_eu" => "",
                              "price_us" => "",
                              "img" => "",
                              "img_small" => "");
    public $belongs_to = array("prodcat" => "ProdCat");
    public $has_many = array("prodsamples" => "ProdSample");
    
    function __construct() {
      parent::__construct();
    }
  }
?>