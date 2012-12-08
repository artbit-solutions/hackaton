<?php

class Query {

    public static function addUser($username, $password) {
        $query = "INSERT into `user` (`username`, `password` ) VALUES ( '$username', 'md5($password)' )";
        $connection = SingletonDB::connect();
        $connection->real_query($query);

        if ($connection->error != '') {
            return "0";
        }

        return "1";
    }

    public static function login($username, $password) {
        $connection = SingletonDB::connect();
        $username = $connection->real_escape_string($username);
        $password = $connection->real_escape_string($password);
        $query = "SELECT * from `user` WHERE `username` = '$username' AND `password` = md5('$password')";
        $result = $connection->query($query);

        if ($connection->error != '' || $result->num_rows != 1) {
            return "-1";
        }

        $row = $result->fetch_assoc();


        $_SESSION['username'] = $row['username'];
        $_SESSION['id'] = $row['id'];

        return $row['id'];
    }

    public static function getAvNodes($class) {
        $query = "SELECT * from node n WHERE n.class = '$class' AND (not n.taken)";
        //echo "$query<br/>";
        $connection = SingletonDB::connect();
        $result = $connection->query($query);

        if ($connection->error != '') {
            return "-1";
        }
        $list = array();
        while ($row = $result->fetch_assoc()) {
            $list[] = new Node($row['id'], $row['class'], $row['taken'], $row['parent']);
        }
        return $list;
    }

    public static function getById($id) {
        $query = "SELECT * from node n WHERE `id` = '$id'";
        $connection = SingletonDB::connect();
        $result = $connection->query($query);

        if ($connection->error != '') {
            return "-1";
        }
        $row = $result->fetch_assoc();
        
        $node = new Node($row['id'], $row['class'], $row['taken'], $row['parent']);
        return $node;
    }

    public static function getChildren($node) {

        $id = $node->getId();
        $query = "SELECT * from node n WHERE `parent` = '$id'";
        $connection = SingletonDB::connect();
        $result = $connection->query($query);

        if ($connection->error != '') {
            return "-1";
        }

        $list = array();
        while ($row = $result->fetch_assoc()) {
            $n = new Node($row['id'], $row['class'], $row['taken'], $row['parent']);
            $list[] = $n;
        }
        return $list;
    }

    public static function setTaken($list, $taken) {

        foreach ($list as $node) {
            $id = $node->getId();
            $vals [] = $id;
        }
        $vals = implode(',', array_values($vals));
        $query = "UPDATE `node` SET `taken` = '$taken' WHERE `id` IN ($vals)";

        $connection = SingletonDB::connect();
        $connection->query($query);
        if ($connection->error != '') {
            return "-1";
        }
    }

    public static function addUserXNode($user, $node, $lat, $long) {
        $id = $node->getId();
        $query = "INSERT into `user_x_node` (`fk_user`, `fk_node`, `lat`, `long` ) VALUES ( '$user', '$id', '$lat', '$long')";
        //echo $query;
        $connection = SingletonDB::connect();
        $connection->real_query($query);
        if ($connection->error != '') {
            return "0";
        }
        return "1";
    }

    public static function removeUserXNode($node) {
        $id = $node->getId();
        $query = "DELETE from `user_x_node` where `fk_node` = '$id'";
        $connection = SingletonDB::connect();
        $connection->real_query($query);
        if ($connection->error != '') {
            return "0";
        }
        return "1";
    }
    
    public static function addNode($node) {
        $class = $node->getClass();
        $taken = $node->isTaken();
        $parent = $node->getParent();
        if (!$taken){
            $taken = 0;
        } else {
            $taken = 1;
        }
        if ($parent == null){
            $parent = 'null';
        } else {
            $parent = "'" . $parent->getId() . "'";
        }
        
        $query = "INSERT into `node` (`class`, `taken`, `parent`) VALUES ( '$class', '$taken', $parent)";
        $connection = SingletonDB::connect();
        $connection->real_query($query);
        if ($connection->error != '') {
            return "-1";
        }
        return $connection->insert_id;
    }

}

?>
