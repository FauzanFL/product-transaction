<div class="card">
    <div class="card-body">
        <h3 class="card-title mb-3">Tambah Faktur Produk</h3>
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
        <form method="POST" action="<?= base_url('/facture/product/save') ?>">
            <input type="number" name="facture_id" hidden value="<?= $facture_id; ?>">
            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="products">Produk</label>
                <select class="form-select" id="product_id" name="product_id">
                    <option value="">Pilih Produk</option>
                    <?php foreach ($products as $product) : ?>
                        <option value="<?= $product['id']; ?>" <?php if (old('product_id') == $product['id']) : ?>selected<?php endif ?>><?= $product['nama']; ?> stok: <?= $product['stok']; ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="jumlah_produk">Jumlah</label>
                <input type="text" id="jumlah_produk" name="jumlah_produk" value="<?= old('jumlah_produk'); ?>" class="form-control" />
            </div>

            <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4">Save</button>
        </form>
    </div>
</div>