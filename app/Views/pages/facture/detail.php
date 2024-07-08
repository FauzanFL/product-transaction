<?php
$dateTime = new DateTime($facture['tanggal']);
$formattedDate = $dateTime->format('j F Y');
?>
<div class="">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title mb-3 no-print">Detail Faktur</h3>
            <div class="mb-4 d-flex justify-content-between">
                <a href="<?= base_url('facture') ?>" class="btn btn-secondary no-print">Kembali</a>
                <button onclick="window.print()" class="btn btn-success no-print">Print</button>
            </div>
            <div class="mb-4">
                <table class="table">
                    <tr>
                        <td>
                            <h4 class="lh-1">PT. Bhinneka Sangkuriang Transport</h4>
                            <p class="lh-1">Jl. Gedebage Selatan no. 121A,</p>
                            <p class="lh-1">Cisaranten Kidul, Kec. Gedebage,</p>
                            <p class="lh-1">Kota Bandung, Jawa barat 40552</p>
                        </td>
                        <td>
                            <p class="lh-1">Kepada Yth :</p>
                            <h4 class="lh-1"><?= $facture['tujuan']; ?></h4>
                            <p class="lh-1"><?= $facture['alamat']; ?></p>
                            <p class="lh-1">Up: <?= $facture['penerima']; ?></p>
                        </td>
                    </tr>
                </table>
                <div class="fs-5">No. Faktur: <?= $facture['no_faktur']; ?></div>
                <!-- <table class="table">
                    <tr>
                        <th>Nomor Faktur</th>
                        <td><?= $facture['no_faktur']; ?></td>
                    </tr>
                    <tr>
                        <th>Purchasing</th>
                        <td><?= $facture['nama']; ?></td>
                    </tr>
                    <tr>
                        <th>Perusahaan Tujuan</th>
                        <td><?= $facture['tujuan']; ?></td>
                    </tr>
                    <tr>
                        <th>Penerima</th>
                        <td><?= $facture['penerima']; ?></td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td><?= $facture['alamat']; ?></td>
                    </tr>
                    <tr>
                        <th>Tempat</th>
                        <td><?= $facture['tempat']; ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td><?= $formattedDate ?></td>
                    </tr>
                </table> -->
                <?php
                $session = \Config\Services::session();

                if ($session->getFlashdata('success')) {
                ?>
                    <div class="alert alert-success">
                        <?php echo $session->getFlashdata('success'); ?>
                    </div>
                <?php
                }
                ?>
                <a href="<?= base_url('/facture/' . $facture['id'] . '/product/add') ?>" class="btn btn-success no-print">Tambah Produk</a>
                <table class="table align-middle mb-0 bg-white">
                    <thead class="bg-light">
                        <tr>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Satuan</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Total Harga</th>
                            <th class="no-print">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $totalJumlah = 0;
                        $totalHarga = 0;
                        $totalAll = 0 ?>
                        <?php foreach ($facture['products'] as $item) : ?>
                            <?php
                            $totalJumlah += $item['jumlah_produk'];
                            $totalHarga += $item['harga'];
                            $totalAll += $item['harga'] * $item['jumlah_produk'];
                            ?>
                            <tr>
                                <td><?= $item['kode']; ?></td>
                                <td><?= $item['nama']; ?></td>
                                <td><?= $item['satuan']; ?></td>
                                <td><?= $item['jumlah_produk']; ?></td>
                                <td><?= number_format($item['harga']); ?></td>
                                <td><?= number_format($item['harga'] * $item['jumlah_produk']); ?></td>
                                <td class="no-print">
                                    <form action="<?= base_url('/facture/product/delete/' . $item['id']); ?>" method="post" class="d-inline">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin?');">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach ?>
                        <tr class="fw-bold">
                            <td colspan="3" class="text-center">Total</td>
                            <td><?= $totalJumlah; ?></td>
                            <td><?= number_format($totalHarga); ?></td>
                            <td><?= number_format($totalAll); ?></td>
                        </tr>
                    </tbody>
                </table>
                <div class="d-flex justify-content-between mt-5 me-5 ms-5">
                    <div class="text-center">
                        <p>Purchasing</p>
                        <br>
                        <br>
                        <p class="fw-bold"><?= $facture['nama']; ?></p>
                    </div>
                    <div class="text-center">
                        <p><?= $facture['tempat']; ?>, <?= $formattedDate; ?></p>
                        <br>
                        <br>
                        <p class="fw-bold"><?= $facture['penerima']; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>