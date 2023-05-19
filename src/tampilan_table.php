    <!-- table view -->
    <i>klasifikasi dengan <?php echo $train_percentage * 100; ?>% data training dan sisanya data testing </i>
      <table>
          <thead>
              <tr>
                  <th>Nomor</th>
                  <th>Kelas Prediksi</th>
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
                  <td><?php echo $counter + 1; ?></td>
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