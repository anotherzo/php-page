<?php
  class ErrorPage extends PartituraPage {
    public function makeContent() {
      return $this->smarty->fetch('error.tpl');
    }
  }
?>