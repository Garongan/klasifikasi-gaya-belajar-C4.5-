<?php

namespace C45\ConfusionMatrix;

class ConfusionMatrix {
    
    private $matrix;
    private $labels;

    public function __construct($labels) {
        $this->labels = $labels;
        $this->matrix = array_fill(0, count($labels), array_fill(0, count($labels), 0));
    }

    public function addPrediction($predicted, $actual) {
        $this->matrix[array_search($predicted, $this->labels)][array_search($actual, $this->labels)]++;
    }

    public function printMatrix() {
        $header = array_merge([''], $this->labels);
        $rows = [];
        for ($i = 0; $i < count($this->labels); $i++) {
            $rows[] = array_merge([$this->labels[$i]], $this->matrix[$i]);
        }
        $table = array_merge([$header], $rows);
        $rowLengths = array_map('max', array_map('array_map', array_fill(0, count($table[0]), 'strlen'), $table));
        $formatString = implode('  ', array_map(function($len) { return "%-{$len}s"; }, $rowLengths));
        foreach ($table as $row) {
            echo vsprintf($formatString, $row) . PHP_EOL;
        }
    }
}

