<?php

require_once __DIR__ . '/../vendor/autoload.php';

use C45\C45;
use C45\Preprocess\MinMaxScaler;
use C45\ConfusionMatrix\ConfusionMatrix;
use C45\DownloadButton\DownloadButton;

$button = new DownloadButton();

$data = __DIR__ . '/data.csv';
// raw download hanlder
if (isset($_POST['download']) && $_POST['download'] == 'downloadData') {
    $button->generate($data);
}
// raw download handler end

echo "download raw data:";
echo '<form method="post">';
echo '   <input type="hidden" name="download" value="downloadData">';
echo '    <button type="submit">Download File</button>';
echo '</form> <hr>';


// preproses
$scaler = new MinMaxScaler();
$scaler->scale_csv($data, __DIR__ . '/scaled_data.csv');
$scaledData = __DIR__ . '/scaled_data.csv';


// raw download hanlder
if (isset($_POST['download']) && $_POST['download'] == 'downloadScaledData') {
    $button->generate($scaledData);
}
// raw download handler end

echo "download scaled data:";
echo '<form method="post">';
echo '   <input type="hidden" name="download" value="downloadScaledData">';
echo '    <button type="submit">Download File</button>';
echo '</form> <hr>';

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
echo "decision tree rule:";
echo '<pre>';
print_r($treeString);
echo '</pre> <hr>';

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


echo "evaluation confusion matrix:";
echo '<pre>';
$matrix->printMatrix();
echo '</pre> <hr>';