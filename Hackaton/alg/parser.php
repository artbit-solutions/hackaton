<?php

function parseFile($myFile) {
    $file_handle = fopen($myFile, 'r') or die("can't open file");
    while (!feof($file_handle)) {
        $line = fgets($file_handle);
        $elements = preg_split('/ /', $line);
        if ($elements[0] == 'insert'){
            //echo 'insert</br>';
            $class = $elements[1];
            $lat = $elements[2];
            $long = $elements[3];
            $result = false;
            try 
            {
                $result = Tree::request(1, $lat, $long, $class);
            }
            catch (InvalidArgumentException $e)
            {
                
            }
            if ($result) echo "success insert /$class<br/>";
            else echo "fail insert /$class<br/>";
        }
        if ($elements[0] == 'delete'){
            echo 'delete</br>';
            $lat = $elements[1];
            $long = $elements[2];
            $node = Query::getByLatLong($lat, $long);
            Tree::deleteNode($node);
        }
    }
    fclose($file_handle);
}
?>