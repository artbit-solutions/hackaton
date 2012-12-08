<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Node
 *
 * @author Stefan
 */
class Node {
    private $id;
    private $class;
    private $taken;
    private $parent;
    
    public function __construct($id, $class, $taken, $parent) {
        $this->id = $id;
        $this->class = $class;
        $this->taken = $taken;
        $this->parent = $parent;
    }
}

?>
