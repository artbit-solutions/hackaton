<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once("includes.php");
if (Query::reset() != -1) echo "Resetarea s-a realizat cu succes";
else echo "Resetarea nu s-a putut realiza";
?>
