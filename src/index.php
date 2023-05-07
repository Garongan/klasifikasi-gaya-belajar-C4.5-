<?php

require_once __DIR__ . '/../vendor/autoload.php';

use C45\C45;

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

// input variabel gaya belajar
// input variabel gaya belajar dengan fitur random dari range 1 sampai 4

$VIS1 = random_int(1, 4);
$VIS2 = random_int(1, 4);
$VIS3 = random_int(1, 4);
$VIS4 = random_int(1, 4);
$VIS5 = random_int(1, 4);
$VIS6 = random_int(1, 4);
$VIS7 = random_int(1, 4);
$VIS8 = random_int(1, 4);
$VIS9 = random_int(1, 4);
$VIS10 = random_int(1, 4);
$AUD1 = random_int(1, 4);
$AUD2 = random_int(1, 4);
$AUD3 = random_int(1, 4);
$AUD4 = random_int(1, 4);
$AUD5 = random_int(1, 4);
$AUD6 = random_int(1, 4);
$AUD7 = random_int(1, 4);
$AUD8 = random_int(1, 4);
$AUD9 = random_int(1, 4);
$AUD10 = random_int(1, 4);
$KIN1 = random_int(1, 4);
$KIN2 = random_int(1, 4);
$KIN3 = random_int(1, 4);
$KIN4 = random_int(1, 4);
$KIN5 = random_int(1, 4);
$KIN6 = random_int(1, 4);
$KIN7 = random_int(1, 4);
$KIN8 = random_int(1, 4);
$KIN9 = random_int(1, 4);
$KIN10 = random_int(1, 4);

// testing data
// memasukkan variabel gaya belajar ke testing data agar dapat melakukan klasifikasi

$testingData = [
  'VIS1' => $VIS1,
  'VIS2' => $VIS2,
  'VIS3' => $VIS3,
  'VIS4' => $VIS4,
  'VIS5' => $VIS5,
  'VIS6' => $VIS6,
  'VIS7' => $VIS7,
  'VIS8' => $VIS8,
  'VIS9' => $VIS9,
  'VIS10' => $VIS10,
  'AUD1' => $AUD1,
  'AUD2' => $AUD2,
  'AUD3' => $AUD3,
  'AUD4' => $AUD4,
  'AUD5' => $AUD5,
  'AUD6' => $AUD6,
  'AUD7' => $AUD7,
  'AUD8' => $AUD8,
  'AUD9' => $AUD9,
  'AUD10' => $AUD10,
  'KIN1' => $KIN1,
  'KIN2' => $KIN2,
  'KIN3' => $KIN3,
  'KIN4' => $KIN4,
  'KIN5' => $KIN5,
  'KIN6' => $KIN6,
  'KIN7' => $KIN7,
  'KIN8' => $KIN8,
  'KIN9' => $KIN9,
  'KIN10' => $KIN10,
];

// menampilkan array dari indikator gaya belajar hasil random
// dan menampilkan prediksi gaya belajar dari algoritma c4.5

echo "Array Indikator Gaya Belajar: ";
echo "<br>";
print_r($testingData);
echo "<br>";
echo "Gaya belajar anda adalah: ";
echo "<b>" . $tree->classify($testingData) . "</b>";

// evaluasi akurasi