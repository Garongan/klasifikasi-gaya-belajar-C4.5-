<?php 
class DecisionTree
{
    public $root;

    public function __construct($training_data, $features)
    {
        // Build the decision tree using the training data and the list of features
        $this->root = $this->buildTree($training_data, $features);
    }

    private function buildTree($data, $features)
    {
        // If all the examples in the data have the same label, return a leaf node with that label
        if ($this->allSameLabel($data)) {
            return new LeafNode($data[0]['label']);
        }

        // If there are no more features to consider, return a leaf node with the most common label
        if (empty($features)) {
            return new LeafNode($this->mostCommonLabel($data));
        }

        // Choose the best feature to split on
        $best_feature = $this->chooseBestFeature($data, $features);

        // Create a new decision node with the best feature
        $node = new DecisionNode($best_feature);

        // Split the data on the best feature
        $splits = $this->splitOnFeature($data, $best_feature);

        // Recursively build the left and right subtrees
        $node->left = $this->buildTree($splits['left'], $features);
        $node->right = $this->buildTree($splits['right'], $features);

        return $node;
    }

    // Other helper functions (e.g. allSameLabel, mostCommonLabel, chooseBestFeature, splitOnFeature) go here
}