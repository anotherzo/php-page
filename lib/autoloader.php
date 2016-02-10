<?php
// 	require_once dirname(__FILE__).'/DBObject.class.php';
//	require_once dirname(__FILE__).'/smarty/Smarty.class.php';

  class autoloader {

      public static $loader;

      public static function init()
      {
          if (self::$loader == NULL)
              self::$loader = new self();

          return self::$loader;
      }

      public function __construct()
      {
          spl_autoload_register(array($this,'model'));
         spl_autoload_register(array($this,'lib'));
          spl_autoload_register(array($this,'controller'));
          spl_autoload_register(array($this,'smarty'));
      }

      public function smarty($class)
      {
          set_include_path(get_include_path().PATH_SEPARATOR.dirname(__FILE__).'/smarty/');
          spl_autoload_extensions('.class.php');
          spl_autoload($class);
      }

      public function controller($class)
      {
          $class = preg_replace('/_controller$/ui','',$class);

          set_include_path(get_include_path().PATH_SEPARATOR.dirname(__FILE__).'/../controller/');
          spl_autoload_extensions('.controller.php');
          spl_autoload($class);
      }

      public function model($class)
      {
          $class = preg_replace('/_model$/ui','',$class);

          set_include_path(get_include_path().PATH_SEPARATOR.dirname(__FILE__).'/../model/');
          spl_autoload_extensions('.model.php');
          spl_autoload($class);
      }
      
      public function lib($class)
      {
        set_include_path(get_include_path().PATH_SEPARATOR.dirname(__FILE__));
        spl_autoload_extensions('.class.php');
        spl_autoload($class);
      }

  }
?>
