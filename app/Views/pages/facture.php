<div class="container mt-4 bg-white">
    <div class="card">
        <div class="card-header">
            <h3>Daftar Faktur</h3>
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
            <a href="<?= base_url('facture/create') ?>" class="btn btn-success mb-2">Buat Faktur</a>
            <table class="table align-middle mb-0 bg-white">
                <thead class="bg-light">
                    <tr>
                        <th>Nomor</th>
                        <th>Tujuan</th>
                        <th>Penerima</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($factures as $facture) : ?>
                        <tr>
                            <td><?= $facture['no_faktur']; ?></td>
                            <td><?= $facture['tujuan']; ?></td>
                            <td><?= $facture['penerima']; ?></td>
                            <td>
                                <a href="<?= base_url('facture/detail/' . $facture['id']) ?>" class="btn btn-secondary">Lihat</a>
                                <a href="<?= base_url('facture/edit/' . $facture['id']) ?>" class="btn btn-warning">Edit</a>
                                <form action="<?= base_url('/facture/delete/' . $facture['id']); ?>" method="post" class="d-inline">
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