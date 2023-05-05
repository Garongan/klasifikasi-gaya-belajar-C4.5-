<?php

require_once __DIR__ . '/../vendor/autoload.php';

use C45\C45;
use C45\Preprocess\MinMaxScaler;
use C45\ConfusionMatrix\ConfusionMatrix;
use C45\DownloadButton\DownloadButton;

// $button = new DownloadButton();

// $data = __DIR__ . '/data.csv';
// preproses
// $scaler = new MinMaxScaler();
// $scaler->scale_csv($data, __DIR__ . '/scaled_data.csv');
// $scaledData = __DIR__ . '/scaled_data.csv';
// preprosess end

// raw download hanlder
// if (isset($_POST['downloadData']) && $_POST['downloadData'] == 'downloadData') {
//     $button->generate($data);
// }
// raw download handler end

// scaled download hanlder
// if (isset($_POST['downloadScaledData']) && $_POST['downloadScaledData'] == 'downloadScaledData') {
//     $button->generate($scaledData);
// }
// scaled download handler end

// raw download button
// echo "download raw data:";
// echo '<form method="post">';
// echo '   <input type="hidden" name="downloadData" value="downloadData">';
// echo '    <button type="submit">Download File</button>';
// echo '</form> <hr>';
// raw download button end

// scaled download button
// echo "download scaled data:";
// echo '<form method="post">';
// echo '   <input type="hidden" name="downloadScaledData" value="downloadScaledData">';
// echo '    <button type="submit">Download File</button>';
// echo '</form> <hr>';
// scaled download button

// classify
$filename = __DIR__ . '/data.csv';

$c45 = new C45([
                'targetAttribute' => 'Gaya Belajar',
                'trainingFile' => $filename,
                'splitCriterion' => C45::SPLIT_GAIN,
            ]);

$tree = $c45->buildTree();
$treeString = $tree->toString();
// classify end

// print generated tree
// echo "decision tree rule:";
// echo '<pre>';
// print_r($treeString);
// echo '</pre> <hr>';

$testingData = [
  'VIS1' => '2',
  'VIS2' => '1',
  'VIS3' => '3',
  'VIS4' => '4',
  'VIS5' => '1',
  'VIS6' => '3',
  'VIS7' => '2',
  'VIS8' => '4',
  'VIS9' => '1',
  'VIS10' => '2',
  'AUD1' => '3',
  'AUD2' => '2',
  'AUD3' => '1',
  'AUD4' => '2',
  'AUD5' => '2',
  'AUD6' => '3',
  'AUD7' => '2',
  'AUD8' => '1',
  'AUD9' => '3',
  'AUD10' => '3',
  'KIN1' => '1',
  'KIN2' => '2',
  'KIN3' => '3',
  'KIN4' => '4',
  'KIN5' => '1',
  'KIN6' => '2',
  'KIN7' => '4',
  'KIN8' => '3',
  'KIN9' => '4',
  'KIN10' => '1',
];

echo "Gaya belajar anda adalah: ";
echo $tree->classify($testingData);

// evaluasi menggunakan confusion matriks

// $labels = ['cat', 'dog', 'fish'];
// $matrix = new ConfusionMatrix($labels);

// $matrix->addPrediction('cat', 'cat');
// $matrix->addPrediction('cat', 'dog');
// $matrix->addPrediction('dog', 'cat');
// $matrix->addPrediction('dog', 'dog');
// $matrix->addPrediction('fish', 'fish');
// $matrix->addPrediction('fish', 'fish');
// $matrix->addPrediction('fish', 'fish');


// echo "evaluation confusion matrix:";
// echo '<pre>';
// $matrix->printMatrix();
// echo '</pre> <hr>';