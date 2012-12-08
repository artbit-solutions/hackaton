<?php
class Query {
    
    public static function addUser ($username, $password){
            
            $query = "INSERT into `user` (`username`, `password` ) VALUES ( '$username', '$password' )";
            $connection = SingletonDB::connect();
            $connection->real_query($query);
            
            if ($connection->error != ''){
                throw new MySQLException();
                return "0";
            }
            
            return "1";
    }
    public static function login ($username, $password){
            $query = "SELECT from `user` WHERE `username` = '$username' AND `password` = md5('$password')";
            $connection = SingletonDB::connect();
            $result = $connection->query($query);
            
            if ($connection->error != ''){
                throw new MySQLException();
                return "-1";
            }
            
            $row = $result->fetch_assoc();
            
            
            $_SESSION['username'] = $row['username'];
            $_SESSION['id'] = $row['id'];
            
            return $row['id'];
    }
    
    public static function getAvNodes($class){
            $query = "SELECT * from node n, node p WHERE `n.class` = '$class' AND n.parent = p.id AND p.taken = true";
            $connection = SingletonDB::connect();
            $result = $connection->query($query);
            
            if ($connection->error != ''){
                throw new MySQLException();
                return "-1";
            }
            
            while ($row = $result->fetch_assoc() )
            { 
               $list[] = $row; 
            }
            
            return $list;
    }
    
}


?>
