<style>
  .card-body {
    max-height: 600px;
    /* Batasi tinggi maksimal */
    overflow-y: auto;
    /* Tambahkan scrollbar vertikal */
    overflow-x: hidden;
  }
</style>

<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper pb-0">
    <div class="page-header flex-wrap">
      <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
        <div class="d-flex align-items-center">
          <a href="#">
            <p class="m-0 pr-3">Dashboard</p>
          </a>
          <a class="pl-3 mr-4" href="#">
            <p class="m-0">ADE-00234</p>
          </a>
        </div>
      </div>
    </div>
    <!-- first row starts here -->
    <div class="row">
      <div class="col-xl-12 grid-margin">
        <div class="card">
          <div class="card-header bg-primary text-white">
            <h4>Penilaian Kompetisi 5K2S</h4>
          </div>
          <form id="formPenilaian" method="POST"
            action="<?php echo base_url('competition/kerapihan_lab?kelas=' . $id_kelas); ?>">

            <div class="card-body">
              <h4 class="card-title">Aspek Kerapihan Lab</h4>
              <br>

              <!-- Kerapihan Letak Properti Lab -->
              <h6 class="mt-3">Kerapihan Letak Properti Lab</h6>
              <div class="d-flex flex-column">
                <?php
                $options1 = [
                  5 => "Semua properti diletakkan pada tempat yang seharusnya dan Rapi",
                  4 => "Sebagian besar properti diletakkan pada tempat yang seharusnya dan Rapi",
                  3 => "Sebagian besar properti diletakkan pada tempat yang seharusnya dan Tidak Rapi",
                  2 => "Beberapa properti diletakkan pada tempat yang seharusnya dan Rapi",
                  1 => "Beberapa properti diletakkan pada tempat yang seharusnya dan Tidak Rapi",
                  0 => "Properti diletakkan tidak pada tempat yang seharusnya dan Tidak Rapi"
                ];

                // Jika tidak ada nilai dalam session, biarkan $kerapihan_lab_1 kosong
                $kerapihan_lab_1 = isset($kerapihan_lab_1) ? $kerapihan_lab_1 : '';
                foreach ($options1 as $value => $label) {
                  $checked = ($kerapihan_lab_1 == $value && $value != 0) ? 'checked' : ''; // Cek apakah nilai sudah dipilih dan bukan 0
                  echo "<label class='d-flex align-items-center mb-3'>
                <input type='radio' name='kerapihan_lab_1' value='$value' class='me-2' style='margin-right: 10px;' $checked> 
                [$value Point] $label
              </label>";
                }
                ?>
              </div>


              <!-- Kerapihan Atribut -->
              <h6 class="mt-4">Kerapihan Atribut yang Digunakan Pengguna Lab</h6>
              <div class="d-flex flex-column">
                <?php
                $options2 = [
                  5 => "90-100% Atribut digunakan pengguna Lab",
                  4 => "80-89% Atribut digunakan pengguna Lab",
                  3 => "70-79% Atribut digunakan pengguna Lab",
                  2 => "60-69% Atribut digunakan pengguna Lab",
                  1 => "50-59% Atribut digunakan pengguna Lab",
                  0 => "&lt;50% Atribut digunakan pengguna Lab"
                ];
                $kerapihan_lab_2 = isset($kerapihan_lab_2) ? $kerapihan_lab_2 : '';
                foreach ($options2 as $value => $label) {
                  $checked = ($kerapihan_lab_2 == $value) ? 'checked' : ''; // Cek apakah nilai sudah dipilih sebelumnya
                  echo "<label class='d-flex align-items-center mb-3'>
                        <input type='radio' name='kerapihan_lab_2' value='$value' class='me-2' style='margin-right: 10px;' $checked> 
                        [$value Point] $label
                  </label>";
                }
                ?>
              </div>

              <!-- Kerapihan Rambut dan Seragam -->
              <h6 class="mt-4">Kerapihan Rambut dan Seragam Pengguna Lab</h6>
              <div class="d-flex flex-column">
                <?php
                $options3 = [
                  5 => "90-100% rambut dan seragam pengguna Lab rapi",
                  4 => "80-89% rambut dan seragam pengguna Lab rapi",
                  3 => "70-79% rambut dan seragam pengguna Lab rapi",
                  2 => "60-69% rambut dan seragam pengguna Lab rapi",
                  1 => "50-59% rambut dan seragam pengguna Lab rapi",
                  0 => "&lt;50% rambut dan seragam pengguna Lab rapi"
                ];
                $kerapihan_lab_3 = isset($kerapihan_lab_3) ? $kerapihan_lab_3 : '';
                foreach ($options3 as $value => $label) {
                  $checked = ($kerapihan_lab_3 == $value) ? 'checked' : ''; // Cek apakah nilai sudah dipilih sebelumnya
                  echo "<label class='d-flex align-items-center mb-3'>
                        <input type='radio' name='kerapihan_lab_3' value='$value' class='me-2' style='margin-right: 10px;' $checked> 
                        [$value Point] $label
                  </label>";
                }
                ?>
              </div>

              <div class="card-footer d-flex justify-content-between">
                <a class="btn btn-warning" href="<?php echo base_url('competition'); ?>">Kembali</a>
                <button id="btnSubmit" class="btn btn-primary ms-auto">Selanjutnya</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger">
      <?php echo $this->session->flashdata('error'); ?>
    </div>
  <?php endif; ?>

  <script>
    document.getElementById('btnSubmit').addEventListener('click', function (event) {
      // Mencegah form submit default
      event.preventDefault();

      // Array of all radio button groups (name attributes)
      const radioGroups = ['kerapihan_lab_1', 'kerapihan_lab_2', 'kerapihan_lab_3'];

      let allSelected = true;
      for (const group of radioGroups) {
        const radios = document.getElementsByName(group);
        const isSelected = Array.from(radios).some(radio => radio.checked);
        if (!isSelected) {
          allSelected = false;
          break;
        }
      }

      // Show SweetAlert or submit the form
      if (allSelected) {
        document.getElementById('formPenilaian').submit();
      } else {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Semua pertanyaan harus diisi sebelum melanjutkan!',
        });
      }
    });
  </script>