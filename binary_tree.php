<?php
/**
 * - Check if the binary tree is balanced
 * - Checking for balanced, not perfectly balanced
 */

class TreeNode
{
    public $leftChild = null;
    public $rightChild = null;
    public $payload = null;

    /**
     * @param mixed $payload
     */
    public function __construct($payload)
    {
        $this->payload = $payload;
    }
}

class BinaryTree
{
    /**
     * @var TreeNode
     */
    private $root = null;

    /**
     * Insert new node
     *
     * @param TreeNode $new
     * @param TreeNode $node
     */
    private function _insert(TreeNode $new, TreeNode &$node = null)
    {
        if ($node === null) {
            $node = $new;

            return;
        }

        if ($new->payload <= $node->payload) {
            if ($node->leftChild === null) {
                $node->leftChild = $new;
            } else {
                $this->_insert($new, $node->leftChild);
            }
        } else {
            if ($node->rightChild === null) {
                $node->rightChild = $new;
            } else {
                $this->_insert($new, $node->rightChild);
            }
        }
    }

    /**
     * Check if tree is balanced
     *
     * @param TreeNode $node
     * @return bool True if tree is balanced
     */
    private function _isBalanced(TreeNode $node = null)
    {
        if ($node === null) {
            return true;
        }

        if (abs($this->getDepth($node->leftChild) - $this->getDepth($node->rightChild)) > 1) {
            return false;
        }

        return $this->_isBalanced($node->leftChild) && $this->_isBalanced($node->rightChild);
    }

    /**
     * Get the depth of the tree
     *
     * @param TreeNode $root
     * @return int
     */
    private function getDepth(TreeNode $root = null)
    {
        if ($root === null) {
            return 1;
        }

        return 1 + max($this->getDepth($root->leftChild), $this->getDepth($root->rightChild));
    }

    /**
     * Insert new node into tree
     *
     * @param TreeNode $node
     * @return $this
     */
    public function insert(TreeNode $node)
    {
        $this->_insert($node, $this->root);

        return $this;
    }

    /**
     * Check if tree is balanced
     *
     * @return bool True if tree is balanced
     */
    public function isBalanced()
    {
        return $this->_isBalanced($this->root);
    }
}

// Test cases
// Unbalanced Tree
$tree1 = new BinaryTree();
$tree1->insert(new TreeNode(3))
    ->insert(new TreeNode(2))
    ->insert(new TreeNode(4))
    ->insert(new TreeNode(7))
    ->insert(new TreeNode(6));
var_dump($tree1->isBalanced()); // bool -> false
// Balanced Tree
$tree2 = new BinaryTree();
$tree2->insert(new TreeNode(15))
    ->insert(new TreeNode(10))
    ->insert(new TreeNode(20))
    ->insert(new TreeNode(8))
    ->insert(new TreeNode(12))
    ->insert(new TreeNode(16))
    ->insert(new TreeNode(25));
var_dump($tree2->isBalanced()); // bool -> true
