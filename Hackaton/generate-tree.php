<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once("includes.php");

$root = new Node(null, 19, false, null);
$id = Query::addNode($root);
Tree::generateTree(20, $id);

?>
