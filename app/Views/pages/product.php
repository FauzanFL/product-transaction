<div class="container mt-4 bg-white">
    <div class="card">
        <div class="card-header">
            <h3>Daftar Produk</h3>
        </div>
        <div class="card-body">
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
            <a href="<?= base_url('product/create') ?>" class="btn btn-success mb-2">Tambah Produk</a>
            <table class="table align-middle mb-0 bg-white">
                <thead class="bg-light">
                    <tr>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Satuan</th>
                        <th>Stok</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product) : ?>
                        <tr>
                            <td><?= $product['kode']; ?></td>
                            <td><?= $product['nama']; ?></td>
                            <td><?= $product['satuan']; ?></td>
                            <td><?= $product['stok']; ?></td>
                            <td><?= $product['harga']; ?></td>
                            <td>
                                <a href="<?= base_url('product/edit/' . $product['id']) ?>" class="btn btn-warning">Edit</a>
                                <form action="<?= base_url('/product/delete/' . $product['id']); ?>" method="post" class="d-inline">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin?');">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>