<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'alg/Tree.php';

$root = new Node(null, 23, false, null);
$id = Query::addNode($root);
Tree::generateTree(24, $id);

?>
