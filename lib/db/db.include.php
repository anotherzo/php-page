<?php
	function db_connect() {
	  if(isset($GLOBALS['testing'])) {
	    $dbname = "mydatabase_testing";
	  } else {
	    $dbname = "mydatabase";
	  }
		try {
       $link = new PDO("mysql:host=127.0.0.1;dbname=$dbname", "user", "password");
    } catch (PDOException $e) {
       print "<p>Error!: " . $e->getMessage() . "</p>";
       die();
    }
    return $link;
	}
?>
