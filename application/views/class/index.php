<div class="main-panel">
    <div class="content-wrapper pb-0">
        <div class="page-header flex-wrap">
            <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
                <div class="d-flex align-items-center">
                    <a href="<?php echo base_url('class'); ?>">
                        <p class="m-0 pr-3">Kelas Saya</p>
                    </a>
                    <a class="pl-3 mr-4" href="#">
                        <p class="m-0">ADE-00234</p>
                    </a>
                </div>
            </div>
        </div>

        <!-- Loop untuk setiap kelas yang dikelompokkan -->
        <div class="row">
            <?php foreach ($grouped_by_kelas as $kelas_id => $kelas_data): ?>
                <?php if ($kelas_data[0]['id_user'] == $user_id): ?> <!-- Check if the id_user is 1 -->
                    <div class="col-xl-12 stretch-card grid-margin">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">History Penilaian Kelas <?php echo $kelas_data[0]['kelas_nama']; ?></h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-bootstrap">
                                    <thead>
                                        <tr>
                                            <th class="text-center thStyle">No</th>
                                            <th class="text-center thStyle">Bulan</th>
                                            <th class="text-center thStyle">Tahun</th>
                                            <th class="text-center thStyle">Kerapihan</th>
                                            <th class="text-center thStyle">Keamanan</th>
                                            <th class="text-center thStyle">Ketertiban dan Kedisiplinan</th>
                                            <th class="text-center thStyle">Kebersihan</th>
                                            <th class="text-center thStyle">Total</th>
                                            <th class="text-center thStyle">Peringkat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php foreach ($kelas_data as $item): ?>
                                            <tr>
                                                <td class="text-center"><?php echo $no++; ?></td>
                                                <td class="text-center"><?php echo $item['bulan']; ?></td>
                                                <td class="text-center"><?php echo $item['tahun']; ?></td>
                                                <td class="text-center"><?php echo $item['kerapihan_lab']; ?></td>
                                                <td class="text-center"><?php echo $item['keamanan_lab']; ?></td>
                                                <td class="text-center"><?php echo $item['ketertiban_lab']; ?></td>
                                                <td class="text-center"><?php echo $item['kebersihan_lab']; ?></td>
                                                <td class="text-center"><?php echo $item['total']; ?></td>
                                                <td class="text-center">
                                                    <?php 
                                                        // Menampilkan peringkat berdasarkan bulan dan tahun
                                                        $bulan_tahun = $item['bulan'] . ' ' . $item['tahun'];
                                                        if (isset($ranked_data[$bulan_tahun][$item['id_kelas']])) {
                                                            echo $ranked_data[$bulan_tahun][$item['id_kelas']]['peringkat'];
                                                        } else {
                                                            echo '-';
                                                        }
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tbody>
                                        <tr>
                                            <th class="text-center" colspan="7">Total Poin</th>
                                            <th class="text-center" colspan="2"><?php echo isset($total_poin_keseluruhan[$kelas_id]) ? $total_poin_keseluruhan[$kelas_id] : 0; ?></th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
