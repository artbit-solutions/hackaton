<?php
require_once '../bd/Query.php';

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
        while ($class >= 24)
        {
            $availableNodes = Query::getAvNodes($class);
            if (count($availableNodes) == 0) 
            {
                $class --;
                continue;
            }
            $node = Query::getById($availableNodes[0]);
            $nodes = array_merge($node->getAllParents(), $node->getAllChildren());
            $nodes[] = $node;
            Query::setTaken($nodes, true);
            Query::addUserXNode($userId, $node, $lat, $long);
            break;
        }
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
            if (!Query::freeNode($node)) break;
            $node = $node->getParent();
        }
    }
    
}

?>
