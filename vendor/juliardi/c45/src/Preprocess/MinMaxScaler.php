<?php

namespace C45\Preprocess;

class MinMaxScaler {
    private $min;
    private $max;
    private $input_file_path;

    public function __construct($min=0, $max=1) {
        $this->min = $min;
        $this->max = $max;
    }

    public function fit($data) {
        $this->min = min($data);
        $this->max = max($data);
    }

    public function transform($data) {
        $range = $this->max - $this->min;
        $scaled = array_map(function ($x) use ($range) {
            return ($x - $this->min) / $range;
        }, $data);
        return $scaled;
    }

    public function fit_transform($data) {
        $this->fit($data);
        return $this->transform($data);
    }

    public function scale_csv($input_file, $output_file) {
        // set the input file path
        $this->input_file_path = $input_file;

        // Load the data from the input CSV file
        $input_data = $this->load_data($input_file);

        // Loop through each column of the data
        foreach ($input_data as &$column) {
            // Convert the column to floats
            $column = array_map('floatval', $column);
            // Fit and transform the column using the MinMaxScaler
            $column = $this->fit_transform($column);
        }

        // Transpose the data array back to the original format
        $output_data = array_map(null, ...$input_data);

        // Write the scaled data to the output CSV file
        $this->write_data($output_file, $output_data);
    }

    private function load_data($filename) {
        // Open the CSV file
        $csv_file = fopen($filename, 'r');

        // Read the header row
        $header = fgetcsv($csv_file); // Read the header row and ignore it

        // Initialize the data array
        $data = array();

        // Read the input CSV file into an array
        while (($row = fgetcsv($csv_file)) !== false) {
            array_pop($row); // remove the last column
            $data[] = $row;
        }

        // Close the file handle
        fclose($csv_file);

        // Transpose the data array to group data by column
        $data = array_map(null, ...$data);

        return $data;
    }

    private function write_data($filename, $data) {
        // Open input file for reading
        $inputData = fopen($this->input_file_path, 'r');
        $header = fgetcsv($inputData); // Read the header row and ignore it
        $input_data = array();
        while (($row = fgetcsv($inputData)) !== false) {
            $input_data[] = array_pop($row);;
        }

        // Open output file for writing
        $outputFile = fopen($filename, 'w');

        // Write the scaled data to the output CSV file
        $outputFile = fopen($filename, 'w');
        fputcsv($outputFile, $header); // Write the header row
        foreach ($data as $rowIndex => $row) {
            $row[] = $input_data[$rowIndex]; // Append the last column from the input data
            fputcsv($outputFile, $row);
        }

        fclose($inputData);
        fclose($outputFile);
    }
}


