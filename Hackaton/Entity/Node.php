<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor. HELLLLLOOOO
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
    private $dist = null;
    
    public function __construct($id, $class, $taken, $parent) {
        $this->id = $id;
        $this->class = $class;
        $this->taken = $taken;
        $this->parent = $parent;
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getClass()
    {
        return $this->class;
    }
    
    public function isTaken()
    {
        return $this->taken;
    }
    
    public function getParent()
    {
        if ($this->parent != null && getType( $this->parent ) != "object")
        {
            $this->parent = Query::getById($this->parent);
        }
        return $this->parent;
    }
    
    public function getChildren()
    {
        return Query::getChildren($this);
    }
    
    public function getAllParents()
    {
        if ($this->parent === null) return array();
        $parents = $this->getParent()->getAllParents();
        $parents[] = $this->parent;
        return $parents;    
    }
    
    public function getAllChildren()
    {
        $children = Query::getChildren($this);
        $result = array();
        foreach ($children as $c)
        {
            $result = array_merge($result, $c->getAllChildren());
            $result[] = $c;
        }
        return $result;
    }
    
    public function getDistance()
    {
        if ($this->dist !== null) return $this->dist;
        if ($this->taken || $this->parent === null){
            $this->dist = 0;
            return 0;
        }
        $this->dist = 1 + $this->getParent()->getDistance();
        return $this->dist;
    }
    
}

?>
