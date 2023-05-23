<?php
// train test split

// Load the CSV file
$csv = array_map('str_getcsv', file($filename));

// Get the number of rows in the CSV file
$num_rows = count($csv);

// Get the percentage of data to use for the training set
$train_percentage = $_POST['split'];  

// Calculate the number of rows to use for the training set
$num_train_rows = floor($train_percentage * $num_rows);

// Remove the header row
array_shift($csv);

// Shuffle the rows in the CSV file
// shuffle($csv);

// Split the rows into the training and testing sets
$train_set = array_slice($csv, 0, $num_train_rows);
$test_set = array_slice($csv, $num_train_rows);

// Save the training and testing sets to CSV files
$headerTrainData = '"VIS1","VIS2","VIS3","VIS4","VIS5","VIS6","VIS7","VIS8","VIS9","VIS10","AUD1","AUD2","AUD3","AUD4","AUD5","AUD6","AUD7","AUD8","AUD9","AUD10","KIN1","KIN2","KIN3","KIN4","KIN5","KIN6","KIN7","KIN8","KIN9","KIN10","Gaya Belajar"' . "\n";
$trainData = '';
foreach ($train_set as $row) {
    if (end($row) != 'unknown') {
        # code...
        $trainData .= implode(',', $row) . "\n";
    }
}
$trainDataName = __DIR__ . '/train.csv';
file_put_contents($trainDataName, ($headerTrainData . $trainData));

$testData = '';
foreach ($test_set as $row) {
    if (end($row) != 'unknown') {
        # code...
        $testData .= implode(',', $row) . "\n";
    }
}
$testDataName = __DIR__ . '/test.csv';
file_put_contents($testDataName, $testData);
// train test split end