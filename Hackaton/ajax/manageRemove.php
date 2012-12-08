<?php
require_once("includes.php");
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$requests = $_POST['req'];

$done = array();

foreach ($requests as $req)
{
    try {
        $node = Query::getByLatLong($req['loc']['lat'], $req['loc']['lng']);
        if (Tree::deleteNode($node))
        {
            $done[] = $req['id'];
        }
    }
    catch (InvalidArgumentException $e)
    {
        
    }
}
echo json_encode($done);

?>
