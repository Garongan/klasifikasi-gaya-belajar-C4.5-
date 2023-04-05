<?php

require_once __DIR__ . '/../vendor/autoload.php';

use C45\C45;

$filename = __DIR__ . '/data.csv';

$c45 = new C45([
                'targetAttribute' => 'Gaya Belajar',
                'trainingFile' => $filename,
                'splitCriterion' => C45::SPLIT_GAIN,
            ]);

$tree = $c45->buildTree();
$treeString = $tree->toString();

// print generated tree
echo '<pre>';
print_r($treeString);
echo '</pre>';

$testingData = [
  // 'outlook' => 'rain',
  // 'windy' => 'false',
  // 'humidity' => 'high',
];

echo $tree->classify($testingData); // prints 'no'