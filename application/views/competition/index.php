<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper pb-0">
    <div class="page-header flex-wrap">
      <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
        <div class="d-flex align-items-center">
          <a href="<?php echo base_url('competition'); ?>">
            <p class="m-0 pr-3">Penilaian Kompetisi</p>
          </a>
          <a class="pl-3 mr-4" href="#">
            <p class="m-0">ADE-00234</p>
          </a>
          <?php if ($this->session->flashdata('success_message')): ?>
            <div class="alert alert-success">
              <?php echo $this->session->flashdata('success_message'); ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <!-- first row starts here -->
    <div class="row">
      <div class="col-xl-12 stretch-card grid-margin">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Penilaian Kompetisi 5K2S</h4>
          </div>
          <div class="card-body">
            <a class="btn btn-primary" data-toggle="modal" data-target="#tambah_data">Tambah Penilaian</a>
            <table id="tableCompetition" class="table table-bootstrap">
              <thead>
                <tr>
                  <th rowspan="2" class="text-center thStyle">No</th>
                  <th rowspan="2" class="text-center thStyle">Tanggal</th>
                  <th rowspan="2" class="text-center thStyle">Kelas</th>
                  <th colspan="4" class="text-center thStyle">Poin</th>
                  <th rowspan="2" class="text-center thStyle">Total</th>
                  <th rowspan="2" class="text-center thStyle">Aksi</th>
                </tr>
                <tr>
                  <th class="text-center thStyle">Kerapihan</th>
                  <th class="text-center thStyle">Keamanan</th>
                  <th class="text-center thStyle">Ketertiban dan Kedisiplinan</th>
                  <th class="text-center thStyle">Kebersihan</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($aspek as $cpm):
                  // Tanggal input data
                  $tanggal_input = strtotime($cpm->create_at);

                  // Tentukan minggu ke berapa tanggal input
                  $minggu_ke = date('W', $tanggal_input) - date('W', strtotime('first day of ' . date('F Y', $tanggal_input))) + 1;

                  // Batas waktu edit
                  if ($minggu_ke == 1) {
                    // Jika data diinput minggu pertama bulan ini
                    $batas_waktu_edit = strtotime('first sunday of ' . date('F Y', $tanggal_input));
                  } else {
                    // Jika data diinput minggu kedua atau setelahnya
                    $batas_waktu_edit = strtotime('first sunday of next month', $tanggal_input);
                  }

                  // Tanggal sekarang
                  $tanggal_sekarang = time();

                  // Logika validasi
                  // $allow_edit = $tanggal_sekarang <= $batas_waktu_edit;
                  $allow_edit = $tanggal_sekarang <= $batas_waktu_edit && $tanggal_sekarang > $tanggal_input;
                  ?>
                  <tr>
                    <td><?php echo $no++; ?></td>
                    <td class="text-center">
                      <?php echo date('d F Y', $tanggal_input); ?>
                    </td>
                    <td class="text-center">
                      <?php
                      foreach ($competisi2 as $kelas) {
                        if ($cpm->id_kelas == $kelas->id_kelas) {
                          echo $kelas->nama_kelas;
                          break;
                        }
                      }
                      ?>
                    </td>
                    <td class="text-center">
                      <?php echo array_sum(explode(',', $cpm->kerapihan_lab)); ?>
                    </td>
                    <td class="text-center">
                      <?php echo array_sum(explode(',', $cpm->keamanan_lab)); ?>
                    </td>
                    <td class="text-center">
                      <?php echo array_sum(explode(',', $cpm->ketertiban_lab)); ?>
                    </td>
                    <td class="text-center">
                      <?php echo $cpm->kebersihan_lab; ?>
                    </td>
                    <td class="text-center">
                      <?php
                      $total = array_sum(explode(',', $cpm->kerapihan_lab)) + array_sum(explode(',', $cpm->keamanan_lab)) + array_sum(explode(',', $cpm->ketertiban_lab)) + $cpm->kebersihan_lab;
                      echo $total;
                      ?>
                    </td>
                    <td>
                      <?php if ($allow_edit): ?>
                        <?php echo anchor(
                          'competition/kerapihan_lab_edit/edit/' . $cpm->id_aspek,
                          '<div class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></div>'
                        ); ?>
                      <?php else: ?>
                        <div class="btn btn-secondary btn-sm disabled"><i class="fas fa-edit"></i></div>
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Tambah Data -->
  <div class="modal fade" id="tambah_data" tabindex="-1" aria-labelledby="tambahDataLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tambahDataLabel">Tambah Penilaian</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="get" action="" id="formTambahData">
          <div class="modal-body">
            <div class="form-group">
              <label for="kelas">Pilih Kelas</label>
              <select class="form-control" id="kelas" name="kelas" required>
                <option disabled selected value="">-- Pilih Kelas --</option>
                <?php foreach ($competisi as $kelas): ?>
                  <option value="<?php echo $kelas->id_kelas; ?>"><?php echo $kelas->nama_kelas; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="btnSimpan" disabled>Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Tambahkan Script -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const selectKelas = document.getElementById('kelas');
      const btnSimpan = document.getElementById('btnSimpan');
      const formTambahData = document.getElementById('formTambahData');

      // Event listener untuk mengaktifkan tombol "Simpan" ketika pilihan kelas dipilih
      selectKelas.addEventListener('change', function () {
        if (selectKelas.value) {
          btnSimpan.disabled = false;
          formTambahData.action = '<?php echo base_url("competition/kerapihan_lab"); ?>?id_kelas=' + selectKelas.value;
        } else {
          btnSimpan.disabled = true;
          formTambahData.action = '';
        }
      });
    });
  </script>