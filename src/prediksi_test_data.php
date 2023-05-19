<?php
// Explode file value into array
$testingDataLines = file($testDataName, FILE_IGNORE_NEW_LINES);
// Explode file value into array end

// prediksi data start
$hasilPrediksi = [];
foreach ($testingDataLines as $line) {
    $testingDataGet = str_getcsv($line);

    // testing data
    // memasukkan variabel gaya belajar ke testing data agar dapat melakukan klasifikasi
    
    $testingData = [
      'VIS1' => $testingDataGet[0],
      'VIS2' => $testingDataGet[1],
      'VIS3' => $testingDataGet[2],
      'VIS4' => $testingDataGet[3],
      'VIS5' => $testingDataGet[4],
      'VIS6' => $testingDataGet[5],
      'VIS7' => $testingDataGet[6],
      'VIS8' => $testingDataGet[7],
      'VIS9' => $testingDataGet[8],
      'VIS10' => $testingDataGet[9],
      'AUD1' => $testingDataGet[10],
      'AUD2' => $testingDataGet[11],
      'AUD3' => $testingDataGet[12],
      'AUD4' => $testingDataGet[13],
      'AUD5' => $testingDataGet[14],
      'AUD6' => $testingDataGet[15],
      'AUD7' => $testingDataGet[16],
      'AUD8' => $testingDataGet[17],
      'AUD9' => $testingDataGet[18],
      'AUD10' => $testingDataGet[19],
      'KIN1' => $testingDataGet[20],
      'KIN2' => $testingDataGet[21],
      'KIN3' => $testingDataGet[22],
      'KIN4' => $testingDataGet[23],
      'KIN5' => $testingDataGet[24],
      'KIN6' => $testingDataGet[25],
      'KIN7' => $testingDataGet[26],
      'KIN8' => $testingDataGet[27],
      'KIN9' => $testingDataGet[28],
      'KIN10' => $testingDataGet[29],
    ];
    
    $hasilPrediksi[] = $tree->classify($testingData);
}
// prediksi data end

// aktual data start

// Read the CSV file into an array
$aktualDataLines = array_map('str_getcsv', file(__DIR__ . '/test.csv', FILE_IGNORE_NEW_LINES));
$aktualDataGet = [];
foreach ($aktualDataLines as $line) {
  # code...
  $aktualDataGet[] = array_pop($line);
}
// aktual data end