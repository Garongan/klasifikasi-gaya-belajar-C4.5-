<?php

require_once __DIR__ . '/../vendor/autoload.php';

use C45\C45;
use C45\FileUploader\FileUploader;

$filename = __DIR__ . '/data.csv';

// html upload file testing data dan aktual data

?>
<!-- html tag title -->
<!DOCTYPE html>
  <html>
  <head>
      <title>Prediksi Gaya Belajar dengan Algoritma C4.5</title>
      <style>
          table {
              border-collapse: collapse;
              width: 100%;
          }

          th, td {
              border: 1px solid black;
              padding: 8px;
              text-align: left;
          }
      </style>
  </head>
  <body>

  <!-- petunjuk -->
  <h3>Selamat datang di Website Klasifikasi Algoritma C4.5!</h3>
  <p>Website ini dirancang untuk melakukan klasifikasi menggunakan algoritma C4.5. Anda dapat mengunggah file testing yang berisi data yang ingin Anda klasifikasikan, serta file aktual data yang digunakan untuk melatih algoritma.</p>
  <p>Fitur utama dari website ini adalah sebagai berikut:</p>
  <ol type="1">
    <!-- <li>Upload File Testing: Anda dapat mengunggah file testing dalam format <b>CSV</b> dengan ekstensi <b>TXT</b>. File testing berisi data yang akan diklasifikasikan oleh algoritma C4.5.</li>
    <li>Upload File Data Aktual: Anda perlu mengunggah file aktual data dalam format <b>CSV</b> dengan ekstensi <b>TXT</b>. File ini akan digunakan sebagai data latih untuk algoritma C4.5 agar dapat mempelajari pola dan membangun model klasifikasi.</li> -->
    <li>Upload file input indikator gaya belajar dalam format <b>CSV</b> dengan ekstensi txt File testing berisi data yang akan diklasifikasikan oleh algoritma C4.5.</li>
    <li>Klasifikasi Data: Setelah file testing dan data aktual diunggah, algoritma C4.5 akan digunakan untuk melakukan klasifikasi pada data testing. Hasil klasifikasi akan ditampilkan kepada Anda.</li>
    <li>Evaluasi Akurasi: Website ini juga menyediakan fitur untuk mengevaluasi akurasi hasil klasifikasi. Hasil prediksi akan dibandingkan dengan label aktual pada data testing, dan akurasi akan dihitung dan ditampilkan kepada Anda.</li>
  </ol>
  <p>Pastikan file testing dan data aktual yang Anda unggah memenuhi persyaratan format yaitu <b>CSV</b> dengan ekstensi <b>TXT</b>. Format tersebut penting untuk memastikan bahwa data dapat dibaca dan diproses oleh algoritma C4.5 dengan benar.</p>
  <i>Selamat menggunakan Website Klasifikasi Algoritma C4.5 kami!</i>
  <hr>
  <!-- petunjuk end -->
    
  <!-- form upload testing dan aktual data -->
    <form method="POST" enctype="multipart/form-data">
      <label for="inputData">upload txt file tesing data dalam format csv: </label> 
      <input type="file" name="inputData" accept="text/plain">
      <hr>
      <!-- <label for="aktualData">upload txt file aktual data dalam format csv: </label> 
      <input type="file" name="aktualData" accept="text/plain">
      <hr> -->
      <label for="train">contoh rasio split (70% untuk training, 30% untuk testing) dengan mengisikan 0.7</label>
      <input type="number" name="split" min="0" step="0.01" >
      <hr>
      <input type="submit" value="Submit">
    </form>
    <hr>
  <!-- form upload testing dan aktual data end -->

<?php

$upload = new FileUploader( __DIR__ . '/');

if (!empty($_POST['split'])) {

  // train test split start
  include('./src/train_test_split.php');
  // train test split end

  // klasifikasi start
  $c45 = new C45([
    'targetAttribute' => 'Gaya Belajar',
    'trainingFile' => $trainDataName,
    'splitCriterion' => C45::SPLIT_GAIN,
  ]);

  $tree = $c45->buildTree();
  
  // prediksi test data start
  include('./src/prediksi_test_data.php');
  // prediksi test data end

  // mengolah input indikator gaya belajar untuk klasifikasi start
  if(!empty($_FILES['inputData'])) {
    $inputData = $_FILES['inputData'];

    // upload file to src start
    $upload->uploadFile($inputData);
    echo "<hr>";
    // upload file to src end

    // set input data path start
    $inputDataName = __DIR__ . '/' . $inputData['name'];
    // set input data path end

    // Explode file value into array
    $inputDataLines = file($inputDataName, FILE_IGNORE_NEW_LINES);
    // Explode file value into array end

    // prediksi data start
    $hasilPrediksiInputData = [];
    foreach ($inputDataLines as $line) {

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
        
        $hasilPrediksiInputData[] = $tree->classify($testingData);
    }
    // prediksi data end
  }

  // mengolah input indikator gaya belajar untuk klasifikasi end
?>
    <!-- table view -->
    <?php include('./src/tampilan_table.php'); ?>
    <!-- table view end -->

  </body>
  </html>
  <!-- html tag end -->

<?php
  // evaluasi akurasi hasil algoritma

  // Hitung akurasi
  $akurasi = $prediksiBenar / count($hasilPrediksi) * 100;

  echo "Akurasi: " . $akurasi . "%<br><hr>";
  // evaluasi akurasi end

  if (!empty($_FILES['inputData'])) {
    # code...
    // Hasil klasifikasi input data start
    $counter = 0;
    foreach ($hasilPrediksiInputData as $row) {
      # code...
      echo $counter + 1 . ". ";
      echo $row . "<br><hr>";
      $counter++;
    }
  // Hasil klasifikasi input data end
  }

  // delete file
  echo "<br><hr>";
  $upload->deleteFile($inputDataName);
  // echo "<br><hr>";
  // $upload->deleteFile($trainDataName);
  // echo "<br><hr>";
  // $upload->deleteFile($testDataName);
  // delete file end

}
// klasifikasi end
$treeString = $tree->toString();

// print generated tree
echo "decision tree rule:";
echo '<pre>';
print_r($treeString);
echo '</pre> <hr>';
?>