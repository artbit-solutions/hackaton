<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require_once("includes.php");
$result = Query::getAllMarkers();
echo json_encode($result);
?>
