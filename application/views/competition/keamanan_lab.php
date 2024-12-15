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
                    <form id="formPenilaian" method="POST" action="<?= base_url('competition/keamanan_lab?kelas=' . $id_kelas); ?>">
                        <div class="card-body">
                            <h4 class="card-title">Aspek Keamanan Lab</h4>
                            <br>
                            <h6 class="mt-3">Letak botol minum, jaket dan tas</h6>
                            <div class="d-flex flex-column">
                                <?php
                                $options1 = [
                                    5 => "Semua properti diletakkan pada tempat yang seharusnya dan Rapi",
                                    4 => "Sebagian besar properti diletakkan pada tempat yang seharusnya dan Rapi",
                                    3 => "Sebagian besar properti diletakkan pada tempat yang seharusnya dan Tidak Rapi",
                                    2 => "Beberapa properti diletakkan pada tempat yang seharusnya dan Rapi",
                                    1 => "Beberapa properti diletakkan pada tempat yang seharusnya dan Tidak Rapi",
                                    0 => "Properti diletakkan tidak pada tempat yang seharusnya dan tidak Rapi"
                                ];
                                $keamanan_lab_1 = isset($keamanan_lab_1) ? $keamanan_lab_1 : '';
                                foreach ($options1 as $value => $label) {
                                    $checked = ($keamanan_lab_1 == $value) ? 'checked' : ''; // Cek apakah nilai sudah dipilih sebelumnya
                                    echo "<label class='d-flex align-items-center mb-3'>
                                          <input type='radio' name='keamanan_lab_1' value='$value' class='me-2' style='margin-right: 10px;' $checked> 
                                          [$value Point] $label
                                    </label>";
                                  }
                                ?>
                            </div>

                            <h6 class="mt-4">Letak kabel - kabel</h6>
                            <div class="d-flex flex-column">
                                <?php
                                $options2 = [
                                    5 => "Kabel rapi dan safety",
                                    4 => "Sebagian besar kabel rapi dan safety",
                                    3 => "Sebagian besar kabel tidak rapi dan safety",
                                    2 => "Sebagian besar kabel rapi dan tidak safety",
                                    1 => "Beberapa kabel rapi dan tidak safety",
                                    0 => "Semua kabel tidak rapi dan tidak safety"
                                ];
                                $keamanan_lab_2 = isset($keamanan_lab_2) ? $keamanan_lab_2 : '';
                                foreach ($options1 as $value => $label) {
                                    $checked = ($keamanan_lab_2 == $value) ? 'checked' : ''; // Cek apakah nilai sudah dipilih sebelumnya
                                    echo "<label class='d-flex align-items-center mb-3'>
                                          <input type='radio' name='keamanan_lab_2' value='$value' class='me-2' style='margin-right: 10px;' $checked> 
                                          [$value Point] $label
                                    </label>";
                                  }
                                ?>
                            </div>

                            <div class="card-footer d-flex justify-content-between">
                                <a class="btn btn-warning"
                                    href="<?php echo base_url('competition/kerapihan_lab?kelas=' . $id_kelas); ?>">Kembali</a>
                                <button id="btnSubmit" type="button"
                                    class="btn btn-primary ms-auto">Selanjutnya</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger">
                <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>

        <script>
            document.getElementById('btnSubmit').addEventListener('click', function () {
                // Array of all radio button groups (name attributes)
                const radioGroups = ['keamanan_lab_1', 'keamanan_lab_2'];

                // Check if all groups have a selected option
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