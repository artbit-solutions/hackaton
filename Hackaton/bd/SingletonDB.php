<?php
require_once("includes.php");
class SingletonDB{
        private static $instance;
        var $mysqli;

        private function __construct()
        {
            $this->mysqli = new mysqli(ADDRESS , USERNAME , PASSWORD , DB);
            $this->mysqli->set_charset("utf8");
        }

        public static function connect()
        {
            if (!isset(self::$instance)) {
                //echo 'Creating new instance.';
                $className = __CLASS__;
                self::$instance = new $className;
            }
            return self::$instance->mysqli;
        }

        public function __clone()
        {
            trigger_error('Clone is not allowed.', E_USER_ERROR);
        }

        public function __wakeup()
        {
            trigger_error('Unserializing is not allowed.', E_USER_ERROR);
        }

}

?>
