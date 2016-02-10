<?php
  class User extends DBObject {
    public $memberVars = array("name" => "",
                              "mail" => "",
                              "pwdhash" => "",
                              "iforgothash" => "");
                              
    public $loggedIn;
    
    function __construct() {
      parent::__construct();
      $this->loggedIn = false;
    }
    
    public function login($pass) {
      if(sha1($pass)==$this->pwdhash()) {
        $this->loggedIn = true;
      } else {
        $this->loggedIn = false;
      }
      return $this->loggedIn;
    }
    
    public function passwd($newPass) {
      if($this->loggedIn) {
        $this->pwdhash(sha1($newPass));
      }
    }
    
    public function logout() {
      $this->loggedIn = false;
      session_unset();
      $_SESSION['user'] = array();
    }
    
    public function loggedIn() {
      return $this->loggedIn;
    }
    
    protected function beforeSave() {
      return $this->loggedIn();
    }
  }
?>