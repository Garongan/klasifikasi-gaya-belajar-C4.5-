<?php

include './src/index.php';

// Decision tree string representation (sample)
$treeString = "
KIN10 = 1
|	AUD2 = 3
|	|	AUD4 = 1
|	|	|	VIS8 = 4 : visual (4.0)
|	|	|	VIS8 = 1 : visual (1.0)
|	|	|	VIS8 = 3 : auditori (1.0)
|	|	|	VIS8 = 2 : visual (4.0)
|	|	AUD4 = 3
|	|	|	AUD1 = 1 : visual (2.0)
|	|	|	AUD1 = 2 : auditori (2.0)
|	|	|	AUD1 = 4 : visual (1.0)
|	|	|	AUD1 = 3 : visual (1.0)
|	|	AUD4 = 2 : visual (4.0)
|	|	AUD4 = 4
|	|	|	VIS7 = 4
|	|	|	|	VIS2 = 2 : auditori (0.0)
|	|	|	|	VIS2 = 1 : auditori (1.0)
|	|	|	|	VIS2 = 4 : visual (2.0)
|	|	|	|	VIS2 = 3 : visual (1.0)
|	|	|	VIS7 = 1 : auditori (1.0)
|	|	|	VIS7 = 2 : auditori (5.0)
|	|	|	VIS7 = 3
|	|	|	|	VIS1 = 2 : kinestetik (1.0)
|	|	|	|	VIS1 = 1 : auditori (0.0)
|	|	|	|	VIS1 = 4 : visual (0.0)
|	|	|	|	VIS1 = 3 : auditori (1.0)
|	AUD2 = 2
|	|	VIS1 = 2
|	|	|	VIS8 = 4 : kinestetik (1.0)
|	|	|	VIS8 = 1 : auditori (3.0)
|	|	|	VIS8 = 3
|	|	|	|	VIS2 = 2 : visual (1.0)
|	|	|	|	VIS2 = 1 : visual (1.0)
|	|	|	|	VIS2 = 4 : auditori (1.0)
|	|	|	|	VIS2 = 3 : visual (0.0)
|	|	|	VIS8 = 2
|	|	|	|	VIS7 = 4 : kinestetik (1.0)
|	|	|	|	VIS7 = 1 : kinestetik (1.0)
|	|	|	|	VIS7 = 2 : visual (1.0)
|	|	|	|	VIS7 = 3 : visual (1.0)
|	|	VIS1 = 1
|	|	|	AUD1 = 1 : kinestetik (3.0)
|	|	|	AUD1 = 2
|	|	|	|	VIS3 = 4 : visual (0.0)
|	|	|	|	VIS3 = 3 : visual (1.0)
|	|	|	|	VIS3 = 2 : visual (0.0)
|	|	|	|	VIS3 = 1 : kinestetik (1.0)
|	|	|	AUD1 = 4 : auditori (2.0)
|	|	|	AUD1 = 3 : kinestetik (2.0)
|	|	VIS1 = 4
|	|	|	VIS3 = 4 : kinestetik (1.0)
|	|	|	VIS3 = 3 : visual (3.0)
|	|	|	VIS3 = 2 : visual (2.0)
|	|	|	VIS3 = 1 : visual (2.0)
|	|	VIS1 = 3
|	|	|	VIS6 = 3 : visual (1.0)
|	|	|	VIS6 = 2 : auditori (3.0)
|	|	|	VIS6 = 4 : visual (1.0)
|	|	|	VIS6 = 1 : auditori (1.0)
|	AUD2 = 1
|	|	VIS1 = 2
|	|	|	VIS2 = 2 : auditori (1.0)
|	|	|	VIS2 = 1 : kinestetik (1.0)
|	|	|	VIS2 = 4 : visual (0.0)
|	|	|	VIS2 = 3 : kinestetik (1.0)
|	|	VIS1 = 1
|	|	|	VIS5 = 2 : visual (1.0)
|	|	|	VIS5 = 3 : auditori (2.0)
|	|	|	VIS5 = 1 : auditori (2.0)
|	|	|	VIS5 = 4
|	|	|	|	VIS4 = 4 : kinestetik (1.0)
|	|	|	|	VIS4 = 1 : visual (1.0)
|	|	|	|	VIS4 = 2 : kinestetik (0.0)
|	|	|	|	VIS4 = 3 : visual (1.0)
|	|	VIS1 = 4 : visual (6.0)
|	|	VIS1 = 3
|	|	|	VIS2 = 2 : auditori (2.0)
|	|	|	VIS2 = 1
|	|	|	|	VIS3 = 4 : auditori (1.0)
|	|	|	|	VIS3 = 3 : visual (0.0)
|	|	|	|	VIS3 = 2 : visual (0.0)
|	|	|	|	VIS3 = 1 : kinestetik (1.0)
|	|	|	VIS2 = 4 : visual (1.0)
|	|	|	VIS2 = 3 : visual (1.0)
|	AUD2 = 4
|	|	AUD1 = 1
|	|	|	VIS10 = 3 : visual (2.0)
|	|	|	VIS10 = 1 : auditori (2.0)
|	|	|	VIS10 = 4 : visual (2.0)
|	|	|	VIS10 = 2 : auditori (1.0)
|	|	AUD1 = 2
|	|	|	AUD5 = 1 : visual (3.0)
|	|	|	AUD5 = 4 : auditori (2.0)
|	|	|	AUD5 = 3 : auditori (1.0)
|	|	|	AUD5 = 2 : auditori (1.0)
|	|	AUD1 = 4
|	|	|	VIS5 = 2 : auditori (2.0)
|	|	|	VIS5 = 3 : visual (1.0)
|	|	|	VIS5 = 1 : auditori (2.0)
|	|	|	VIS5 = 4 : auditori (1.0)
|	|	AUD1 = 3 : auditori (7.0)
";

// Function to parse the tree string and generate DOT code
function generateDotCode($treeString)
{
    $lines = explode(PHP_EOL, $treeString);
    $dotCode = "digraph decision_tree {\n";
    $dotCode .= "    node [shape=box];\n";
    $dotCode .= "    edge [fontname=\"Arial\", fontsize=10];\n\n";

    $parentNode = '';
    $nodeCount = 0;

    foreach ($lines as $line) {
        $line = trim($line);
        $level = 0;

        while (substr($line, 0, 2) === '│ ') {
            $line = substr($line, 2);
            $level++;
        }

        if (preg_match('/^(.*?)─ (.*?): (.*)$/', $line, $matches)) {
            $nodeType = trim($matches[1]);
            $edgeLabel = trim($matches[2]);
            $nodeValue = trim($matches[3]);

            $nodeCount++;
            $nodeId = 'node' . $nodeCount;

            $dotCode .= "    $nodeId [label=\"$nodeValue\"];\n";

            if ($level === 0) {
                $parentNode = $nodeId;
            } else {
                $dotCode .= "    $parentNode -> $nodeId [label=\"$edgeLabel\"];\n";
                $parentNode = $nodeId;
            }
        }
    }

    $dotCode .= "}";

    return $dotCode;
}

// Generate DOT code from the tree string
$dotCode = generateDotCode($treeString);

// Write DOT code to a file
$dotFile = 'decision_tree.dot';
file_put_contents($dotFile, $dotCode);

echo "DOT file generated successfully: $dotFile";