<div class="card">
    <div class="card-body">
        <h3 class="card-title mb-3">Edit Produk</h3>
        <?php
        $session = \Config\Services::session();

        if ($session->getFlashdata('warning')) {
        ?>
            <div class="alert alert-warning">
                <ul>
                    <?php foreach ($session->getFlashdata('warning') as $key => $value) { ?>
                        <li><?php echo $value; ?></li>
                    <?php } ?>
                </ul>
            </div>
        <?php
        }
        ?>
        <form method="POST" action="<?= base_url('/product/update/') . $product['id'] ?>">
            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="kode">Kode</label>
                <input type="text" id="kode" name="kode" value="<?= (old('kode')) ? old('kode') : $product['kode'] ?>" class="form-control" />
            </div>
            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="nama">Nama</label>
                <input type="text" id="nama" name="nama" value="<?= (old('nama')) ? old('nama') : $product['nama'] ?>" class="form-control" />
            </div>
            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="satuan">Satuan</label>
                <input type="text" id="satuan" name="satuan" value="<?= (old('satuan')) ? old('satuan') : $product['satuan'] ?>" class="form-control" />
            </div>
            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="stok">Stok</label>
                <input type="number" id="stok" name="stok" value="<?= (old('stok')) ? old('stok') : $product['stok'] ?>" class="form-control" />
            </div>
            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="harga">Harga</label>
                <input type="number" id="harga" name="harga" value="<?= (old('harga')) ? old('harga') : $product['harga'] ?>" class="form-control" />
            </div>

            <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4">Update</button>
        </form>
    </div>
</div>