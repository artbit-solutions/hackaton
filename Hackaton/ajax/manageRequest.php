<?php
require_once("includes.php");
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$requests = $_POST['req'];

usort($requests, function($a, $b) {return $a['space'] - $b['space'];});

$done = array();

foreach ($requests as $req)
{
    if (Tree::request(1, $req['loc']['lat'], $req['loc']['lng'], $req['space']))
    {
        $done[] = $req['id'];
    }
}
json_encode($done);

?>
