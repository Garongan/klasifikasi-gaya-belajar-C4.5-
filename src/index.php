<?php

require_once __DIR__ . '/../vendor/autoload.php';

use C45\C45;
use C45\Preprocess\MinMaxScaler;

// preproses
$data = __DIR__ . '/data.csv';
$scaler = new MinMaxScaler();
$scaler->scale_csv($data, __DIR__ . '/scaled_data.csv');
// preproses end

// classify
$filename = __DIR__ . '/scaled_data.csv';

$c45 = new C45([
                'targetAttribute' => 'Gaya Belajar',
                'trainingFile' => $filename,
                'splitCriterion' => C45::SPLIT_GAIN,
            ]);

$tree = $c45->buildTree();
$treeString = $tree->toString();
// classify end

// print generated tree
echo '<pre>';
print_r($treeString);
echo '</pre>';

// $testingData = [
//   // 'outlook' => 'rain',
//   // 'windy' => 'false',
//   // 'humidity' => 'high',
// ];

// echo $tree->classify($testingData); // prints 'no'