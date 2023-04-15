<?php

require_once __DIR__ . '/../vendor/autoload.php';

use C45\C45;
use C45\Preprocess\MinMaxScaler;
use C45\ConfusionMatrix\ConfusionMatrix;

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

// evaluasi menggunakan confusion matriks

$labels = ['cat', 'dog', 'fish'];
$matrix = new ConfusionMatrix($labels);

$matrix->addPrediction('cat', 'cat');
$matrix->addPrediction('cat', 'dog');
$matrix->addPrediction('dog', 'cat');
$matrix->addPrediction('dog', 'dog');
$matrix->addPrediction('fish', 'fish');
$matrix->addPrediction('fish', 'fish');
$matrix->addPrediction('fish', 'fish');

$print_evaluasi = $matrix->printMatrix();

echo '<pre>';
print_r($print_evaluasi);
echo '</pre>';