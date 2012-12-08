<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Tree
 *
 * @author Stefan
 */
class Tree {
    
    
    
    public static function request($userId, $lat, $long, $class)
    {
        if ($class < 24 || $class > 30) throw new InvalidArgumentException();
        $availableNodes = Query::getAvNodes($class);
        if (count($availableNodes) == 0) return false;
        $node = null;
        $dist = 1000;
        foreach ($availableNodes as $n)
        {
            if ($n->getDistance() < $dist) 
            {
                $dist = $n->getDistance();
                $node = $n;
                if ($dist == 1) break;
            }
        }
        $nodes = array_merge($node->getAllParents(), $node->getAllChildren());
        $nodes[] = $node;
        Query::setTaken($nodes, true);
        Query::addUserXNode($userId, $node, $lat, $long);
    }
    
    public static function deleteNode($nodeId)
    {
        $node = Query::getById($nodeId);
        $children = $node->getAllChildren();
        $children[] = $node;
        Query::setTaken($children, false);
        $node = $node->getParent();
        while ($node != null)
        {
            $children = $node->getChildren();
            $ok = true;
            foreach ($children as $c)
                if ($c->isTaken())
                {
                    $ok = false;
                    break;
                }
            $arr = array();
            $arr[] = $node;
            if ($ok) Query::setTaken($arr, false);
            $node = $node->getParent();
        }
    }
    
    public static function generateTree($class, $parentId)
    {
        if ($class > 30) return null;
        $node = new Node(null, $class, false, $parentId);
        $id = Query::addNode($node);
        if ($id == -1) return;
        Tree::generateTree($class + 1, $id);
        Tree::generateTree($class + 1, $id);
    }
    
}

?>
