<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once("includes.php");
$result = array();
for ($i = 24; $i < 31; $i++)
{
    $available = Query::getAvNodes($i);
    if ($available == -1) $result[] = array('space' => $i, 'no' => -1);
    else $result[] = array('space' => $i, 'no' => count($available));
}
echo json_encode($result);
?>
