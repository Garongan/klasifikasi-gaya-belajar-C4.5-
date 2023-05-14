<?php

require_once __DIR__ . '/../vendor/autoload.php';

use C45\C45;
use C45\FileUploader\FileUploader;

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

// echo "masukkan 30 indikator gaya belajar dengan range dari 1 sampai 4, seperti contoh dibawah ini <br>";
// echo "<pre>";
// echo "1,4,1,2,3,4,1,4,1,2,1,4,1,2,3,4,1,4,1,2,1,4,1,2,3,4,1,4,1,2
// 1,2,3,4,1,4,1,2,1,4,1,2,3,4,1,4,1,2,1,4,1,2,3,4,1,4,1,2,1,1
// 4,1,4,1,2,1,4,1,2,3,4,1,4,1,2,1,4,1,2,3,4,1,4,1,2,1,4,3,4,2
// 1,4,1,2,3,4,1,4,1,2,1,4,1,2,3,4,1,4,1,2,1,4,1,2,3,4,1,4,1,3
// 1,2,3,4,1,4,1,2,1,4,1,2,3,4,1,4,1,2,1,4,1,2,3,4,1,4,1,2,1,4
// 4,1,4,1,2,1,4,1,2,3,4,1,4,1,2,1,4,1,2,3,4,1,4,1,2,1,4,3,4,3";
// echo "</pre>";
// echo "<form method='post'>";
// echo  "<textarea name='input'></textarea> <br>";
// echo  "<input type='submit' name='submit' value='Submit'>";
// echo "</form>";


// if(isset($_POST['submit'])) {
//   // Check if textarea is empty
//   if(empty($_POST['input'])) {
//       echo "Textarea is empty";
//   } else {
//       // Explode textarea value into array
//       $lines = explode("\n", $_POST['input']);
//       foreach ($lines as $line) {
//           $data = str_getcsv($line);

//           // testing data
//           // memasukkan variabel gaya belajar ke testing data agar dapat melakukan klasifikasi
          
//           $testingData = [
//             'VIS1' => $data[0],
//             'VIS2' => $data[1],
//             'VIS3' => $data[2],
//             'VIS4' => $data[3],
//             'VIS5' => $data[4],
//             'VIS6' => $data[5],
//             'VIS7' => $data[6],
//             'VIS8' => $data[7],
//             'VIS9' => $data[8],
//             'VIS10' => $data[9],
//             'AUD1' => $data[10],
//             'AUD2' => $data[11],
//             'AUD3' => $data[12],
//             'AUD4' => $data[13],
//             'AUD5' => $data[14],
//             'AUD6' => $data[15],
//             'AUD7' => $data[16],
//             'AUD8' => $data[17],
//             'AUD9' => $data[18],
//             'AUD10' => $data[19],
//             'KIN1' => $data[20],
//             'KIN2' => $data[21],
//             'KIN3' => $data[22],
//             'KIN4' => $data[23],
//             'KIN5' => $data[24],
//             'KIN6' => $data[25],
//             'KIN7' => $data[26],
//             'KIN8' => $data[27],
//             'KIN9' => $data[28],
//             'KIN10' => $data[29],
//           ];
  
//           // dan menampilkan prediksi gaya belajar dari algoritma c4.5
  
//           echo "Gaya belajar anda adalah: ";
//           echo "<b>" . $tree->classify($testingData) . "</b> <br>";
//       }
      
//   }
// }

// html upload file testing data dan aktual data

?>
<!-- html tag title -->
<!DOCTYPE html>
  <html>
  <head>
      <title>Prediksi Algoritma C4.5</title>
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
    <li>Upload File Testing: Anda dapat mengunggah file testing dalam format <b>CSV</b> dengan ekstensi <b>TXT</b>. File testing berisi data yang akan diklasifikasikan oleh algoritma C4.5.</li>
    <li>Upload File Data Aktual: Anda perlu mengunggah file aktual data dalam format <b>CSV</b> dengan ekstensi <b>TXT</b>. File ini akan digunakan sebagai data latih untuk algoritma C4.5 agar dapat mempelajari pola dan membangun model klasifikasi.</li>
    <li>Klasifikasi Data: Setelah file testing dan data aktual diunggah, algoritma C4.5 akan digunakan untuk melakukan klasifikasi pada data testing. Hasil klasifikasi akan ditampilkan kepada Anda.</li>
    <li>Evaluasi Akurasi: Website ini juga menyediakan fitur untuk mengevaluasi akurasi hasil klasifikasi. Hasil prediksi akan dibandingkan dengan label aktual pada data testing, dan akurasi akan dihitung dan ditampilkan kepada Anda.</li>
  </ol>
  <p>Pastikan file testing dan data aktual yang Anda unggah memenuhi persyaratan format yaitu <b>CSV</b> dengan ekstensi <b>TXT</b>. Format tersebut penting untuk memastikan bahwa data dapat dibaca dan diproses oleh algoritma C4.5 dengan benar.</p>
  <i>Selamat menggunakan Website Klasifikasi Algoritma C4.5 kami!</i>
  <hr>
  <!-- petunjuk end -->
    
  <!-- form upload testing dan aktual data -->
    <form method="POST" enctype="multipart/form-data">
      <label>upload txt file tesing data dalam format csv: </label> 
      <input type="file" name="testingData" accept="text/plain">
      <hr>
      <label>upload txt file aktual data dalam format csv: </label> 
      <input type="file" name="aktualData" accept="text/plain">
      <hr>
      <input type="submit" value="Upload">
    </form>
    <hr>
  <!-- form upload testing dan aktual data end -->

<?php
// upload class
$upload = new FileUploader(__DIR__ . '/');
if (!empty($_FILES['testingData'])) {
  # code...
  $testingData = $_FILES['testingData'];
  $aktualData = $_FILES['aktualData'];
  $upload->uploadFile($testingData);
  echo "<hr>";
  $upload->uploadFile($aktualData);
  echo "<hr>";

  // name
  $testingDataName = __DIR__ . '/' . $testingData['name'];
  $aktualDataName = __DIR__ . '/' . $aktualData['name'];

  // mulai klasifikasi

  // Explode textarea value into array
  $testingDataLines = file($testingDataName, FILE_IGNORE_NEW_LINES);
  $aktualDataLines = file($aktualDataName, FILE_IGNORE_NEW_LINES);
  // Explode textarea value into array end

  // klasifikasi algoritma
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
  // klasifikasi algoritma end

  // klasifikasi survey
  $aktualDataGet = [];
  foreach ($aktualDataLines as $line) {
    # code...
    $aktualDataGetFromText = str_getcsv($line);
    $aktualDataGet[] = $aktualDataGetFromText[0];
  }
  // klasifikasi survey end
?>
  <!-- table view -->
      <table>
          <thead>
              <tr>
                  <th>Kelas Predikasi</th>
                  <th>Kelas Aktual</th>
              </tr>
          </thead>
          <tbody>
              <?php
              $counter = 0;
              $prediksiBenar = 0;
              foreach ($hasilPrediksi as $row): 
              ?>
              <tr>
                  <td><?php echo $row; ?></td>
                  <td><?php echo $aktualDataGet[$counter]; ?></td>
                  <?php
                  // jumlah prediksi benar
                  if ($row == $aktualDataGet[$counter]) {
                    # code...
                    $prediksiBenar++;
                  }
                  // jumlah prediksi benar end
                  ?>
              </tr>
              <?php 
              $counter++; 
              endforeach; 
              ?>
          </tbody>
      </table>
      <hr>
    <!-- table view end -->
  </body>
  </html>
  <!-- html tag end -->

<?php
  // evaluasi akurasi

  // Hitung akurasi
  $akurasi = $prediksiBenar / count($hasilPrediksi) * 100;

  echo "Akurasi: " . $akurasi . "%";
  // evaluasi akurasi end

  // delete file
  echo "<br><hr>";
  $upload->deleteFile($testingDataName);
  echo "<br><hr>";
  $upload->deleteFile($aktualDataName);
  // delete file end

}
// klasifikasi end
?>