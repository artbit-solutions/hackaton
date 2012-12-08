<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once("includes.php");
$root = Query::getRoot();
if ($root != null)
{
?>
<ul>
<?php
    $root->printTree();
?>
</ul>
<?php
}
?>
