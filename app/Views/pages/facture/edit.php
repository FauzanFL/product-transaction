<div class="card">
    <div class="card-body">
        <h3 class="card-title mb-3">Edit Faktur</h3>
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
        <form method="POST" action="<?= base_url('/facture/update/' . $facture['id']) ?>">
            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="no_faktur">Nomor Faktur</label>
                <input type="text" id="no_faktur" name="no_faktur" value="<?= (old('no_faktur')) ? old('no_faktur') : $facture['no_faktur'] ?>" class="form-control" />
            </div>
            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="tujuan">Perusahaan Tujuan</label>
                <input type="text" id="tujuan" name="tujuan" value="<?= (old('tujuan')) ? old('tujuan') : $facture['tujuan'] ?>" class="form-control" />
            </div>
            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="penerima">Penerima</label>
                <input type="text" id="penerima" name="penerima" value="<?= (old('penerima')) ? old('penerima') : $facture['penerima'] ?>" class="form-control" />
            </div>
            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="alamat">Alamat</label>
                <input type="text" id="alamat" name="alamat" value="<?= (old('alamat')) ? old('alamat') : $facture['alamat'] ?>" class="form-control" />
            </div>
            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="tempat">Tempat</label>
                <input type="text" id="tempat" name="tempat" value="<?= (old('tempat')) ? old('tempat') : $facture['tempat'] ?>" class="form-control" />
            </div>
            <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="tanggal">Tanggal</label>
                <input type="date" id="tanggal" name="tanggal" value="<?= (old('tanggal')) ? old('tanggal') : $facture['tanggal'] ?>" class="form-control" />
            </div>

            <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4">Save</button>
        </form>
    </div>
</div>