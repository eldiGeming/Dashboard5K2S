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
                    <div class="card-body">
                        <form id="formPenilaian"
                            action="<?= base_url('competition/kebersihan_lab?kelas=' . $id_kelas) ?>" method="post">
                            <h4 class="card-title">Aspek Kebersihan Lab</h4>
                            <br>
                            <h6 class="mt-3">Kebersihan meja dan laci, serta lemari </h6>
                            <div class="d-flex flex-column">
                                <?php
                                $optionsKebersihan = [
                                    5 => "Meja, laci dan lemari bersih",
                                    4 => "Meja dan laci bersih dan lemari tidak bersih",
                                    3 => "Meja dan lemari bersih dan laci tidak bersih",
                                    2 => "Laci dan lemari bersih dan meja tidak bersih",
                                    1 => "Laci atau lemari bersih dan yang lain tidak bersih",
                                    0 => "Meja dan laci dan lemari tidak bersih"
                                ];
                                $kebersihan_lab = isset($kebersihan_lab) ? $kebersihan_lab : '';
                                foreach ($optionsKebersihan as $value => $label) {
                                    $checked = ($kebersihan_lab == $value) ? 'checked' : ''; // Cek apakah nilai sudah dipilih sebelumnya
                                    echo "<label class='d-flex align-items-center mb-3'>
                        <input type='radio' name='kebersihan_lab' value='$value' class='me-2' style='margin-right: 10px;' $checked> 
                        [$value Point] $label
                  </label>";
                                }
                                ?>
                            </div>

                            <div class="card-footer d-flex justify-content-between">
                                <a class="btn btn-warning"
                                    href="<?php echo base_url('competition/ketertiban_lab?kelas=' . $id_kelas); ?>">Kembali</a>
                                <button id="btnSubmit" class="btn btn-primary ms-auto">Selesai</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('btnSubmit').addEventListener('click', function (event) {
            // Mencegah form submit default
            event.preventDefault();

            // Array of all radio button groups (name attributes)
            const radioGroups = ['kebersihan_lab'];

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