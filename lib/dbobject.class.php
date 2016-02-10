<?php
	require_once( 'db/db.include.php' );
	
	class DBObject {
		public $memberVars; // array of member variables
		public $tblid; // id in db
		public $tableName;  // name of table in db
		
		public $has_many; // array with has_many-targets
		public $belongs_to; // array with belongs_to-targets
		
		public $imgChanged = false;
		public $imgOld = "";
		public $imgSmallOld = "";
		
		private $link = NULL;  // link to db
		
		function __construct() {
      $this->tableName = strtolower(get_class($this))."s";
    }
    
    public function __call ($name, $arguments) {
      // database fields
      if(in_array($name, array_keys($this->memberVars))) {
        if($arguments) {  // setter
          if($name == "img") {
            $this->imgChanged = true;
            $this->imgOld = $this->memberVars['img'];
          }
          if($name == "img_small") {
            $this->imgChanged = true;
            $this->imgSmallOld = $this->memberVars['img_small'];
          }
          $this->memberVars[$name] = $arguments[0];
          return;
        } else {          // getter
          return $this->memberVars[$name];
        }
      }
      // belongs_to-targets
      if($this->belongs_to && in_array($name, array_keys($this->belongs_to))) {
        if($arguments) {  // setter
          $tmpcls = $this->belongs_to["$name"];
          if(!(get_class($arguments[0]) == $tmpcls)) {
            echo "\nBelongs_to: Argument has to be of class $tmpcls.\n";
            return false;
          }
          $this->setBelongsTo($name, $arguments[0]);
          return;
        } else {          // getter
          $tmpcls = $this->belongs_to[$name];
          $tmp = new $tmpcls;
          $tmpfield = $name."_id";
          return $tmp->find("id", $this->{$tmpfield}());
        }
      }
      // has_many-targets
      if($this->has_many && in_array($name, array_keys($this->has_many))) {
        $tmpcls = $this->has_many[$name];
        $tmpfield = strtolower(get_class($this))."_id";
        if($arguments) {  // setter
          foreach($arguments as $obj) {
            if(get_class($obj)!=$tmpcls) {
              echo "\nHas_many: Object has wrong class.\n";
              return;
            }
            $obj->{$tmpfield}($this->tblid);
            $obj->save();
          }
          return;
        } else {          // getter
          $tmp = new $tmpcls;
          return $tmp->findAll($tmpfield, $this->tblid);
        }
      }
      echo "\nClass ".get_class($this).": Member variable ".$name." does not exist.\n";
      return false;
    }
    
    public function setBelongsTo($cls, $obj) {
      $tmpfield = $cls."_id";
      $this->{$tmpfield}($obj->tblid);
      $this->save();
    }
		
		public function findAll($param, $value, $activeOnly = false, $ordered = false) {
		  if(!$this->link) {
		    $this->openDB();
		  }
		  $query = "select * from ".$this->tableName." where ".$param."= ?";
		  if($activeOnly) {
		    $query .= " and active=1";
		  }
		  if($ordered) {
		    $query .= " order by ord"; 
		  }
		  $sth = $this->link->prepare($query);
			$result = $sth->execute(array($value));
			$objArr = array();
			while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
			  $cls = get_class($this);
			  $obj = new $cls;
			  $obj->setVars($row);
        $objArr[] = $obj;
      }
      return $objArr;
		}
		
		public function find($param, $value, $activeOnly = false, $ordered = false) {
		  $arr = $this->findAll($param, $value);
		  return $arr[0];
		}
		
		public function setVars($array) {
		  foreach($array as $k => $v) {
		    if($k=="id") { continue; }
		    $this->memberVars[$k] = $v;
		  }
		  $this->tblid = $array['id'];
		}
		
		public function save() {
		  if($this->beforeSave()) {
		    if($this->tblid) {
		      $this->update();
		    } else {
		      $this->create();
		    }
		    $this->handleImg();
		  }
		}
		
		public function handleImg() {
		  if($this->imgChanged) {
		    if($this->imgOld != "" && $this->imgOld != "0") {
		      unlink($this->imgOld);
		    }
		    if($this->imgSmallOld != "" && $this->imgSmallOld != "0") {
		      unlink($this->imgSmallOld);
		    }
		    $this->imgChanged = false;
		    $this->imgOld = "";
		    $this->imgSmallOld = "";
		  }
		}
		
		public function create() {
		  $fieldStrings = $this->fieldStrings();
		  $fields = $fieldStrings[0];
		  $vals = $fieldStrings[1];
		  $valSize = count($this->memberVars);
		  $valSizeArr = array();
		  for($i=1; $i<($valSize+1); $i++) {
		    $valSizeArr[] = "?";
		  }
		  $valSizeString = implode(", ", $valSizeArr);
		  
		  if(!$this->link) {
		    $this->openDB();
		  }
		  $query = "insert into ".$this->tableName." (".implode(", ", $fields).") values (".$valSizeString.")";
		  $sth = $this->link->prepare($query);
		  
		  if(!$sth->execute($vals)) {
		    echo "Ooops, something went wrong: Object was not created. Query was: ".$query." with ".implode(", ", $vals);
		  }
		  
		  $where = implode(" and ", $this->keyArray());
		  $query = "select id from ".$this->tableName." where ".$where;
		  $sth = $this->link->prepare($query);
		  if(!$sth->execute($vals)) {
		    echo "Ooops, something went wrong: Object could not be retrieved.";
		  }
		  $row = $sth->fetch(PDO::FETCH_ASSOC);
		  if($row) {
		    $this->tblid = $row['id'];
		  } else {
		    echo "Did not find anything.";
		  }
		}
		
		public function update() {
		  if($this->checkChanged()) {
		    $fields = implode(",", $this->keyArray());
  		  if(!$this->link) {
  		    $this->openDB();
  		  }
  		  $query = "update ".$this->tableName." set ".$fields." where id=?";
  		  $sth = $this->link->prepare($query);
  		  $vals = array_values($this->memberVars);
  		  $vals[] = $this->tblid;
  		  $sth->execute($vals);
		  }
		}
		
		public function checkChanged() {
		  $dbobj = $this->find("id", $this->tblid);
		  foreach($this->memberVars as $k => $v) {
		    if($dbobj->{$k}() != $v) {
		      if(!($dbobj->{$k}()==0 && $v=="")) { return true; }
		    }
		  }
		  return false;
		}
		
		public function delete() {
		  $img = $this->img();
		  $imgSmall = $this->img_small();
		  if(isset($img) && $img != "0") {
		    unlink($img);
		  }
		  if(isset($imgSmall) && $imgSmall != "0") {
		    unlink($imgSmall);
		  }
		  
		  if(!$this->link) {
		    $this->openDB();
		  }
		  $query = "delete from ".$this->tableName." where id=?";
		  $sth = $this->link->prepare($query);
		  $sth->execute(array($this->tblid));
		}
		
		public function openDB() {
		  $this->link = db_connect();
		}
		
		private function fieldStrings() {
		  $fields = array();
		  $vals = array();
		  foreach($this->memberVars as $k => $v) {
		    $fields[] = $k;
		    if($v) {
		      $vals[] = $v;
		    } else {
		      $vals[] = 0;
		    }
		  }
		  return array($fields, $vals);
		}
		
		private function keyArray() {
		  $fields = array();
		  foreach($this->memberVars as $k => $v) {
		    $fields[] = "$k = ?";
		  }
		  return $fields;
		}
		
		protected function beforeSave() {
		  return true;
		}
  }
?>