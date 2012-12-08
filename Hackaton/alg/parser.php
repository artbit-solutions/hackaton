<?php
require_once('../alg/Tree.php');
require_once('../bd/Query.php');
parseFile('C:\Users\MirceaM\Desktop\test.txt');

function parseFile($myFile) {
    $file_handle = fopen($myFile, 'r') or die("can't open file");
    while (!feof($file_handle)) {
        $line = fgets($file_handle);
        $elements = preg_split('/ /', $line);
        if ($elements[0] == 'insert'){
            echo 'insert</br>';
            $class = $elements[1];
            $lat = $elements[2];
            $long = $elements[3];
            Tree::request(1, $lat, $long, $class);
        }
        if ($elements[0] == 'delete'){
            echo 'delete</br>';
            $lat = $elements[1];
            $long = $elements[2];
            $node = Query::getByLatLong($lat, $long);
            Tree::deleteNode($node->getId());
        }
    }
    fclose($file_handle);
}
?>