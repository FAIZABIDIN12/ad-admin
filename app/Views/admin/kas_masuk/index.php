<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>

<div class="card">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Kas Masuk</h6>
    </div>

    <div class="card-body">
        <!-- Tabel untuk Kas Masuk -->
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTableKasMasuk" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Transaksi</th>
                        <th>Uraian</th>
                        <th>Kas Masuk</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($kas_masuk)) : ?>
                        <?php foreach ($kas_masuk as $index => $kas) : ?>
                            <?php if (strpos($kas['uraian'], 'Rate') === false) : ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><?= $kas['tgl_transaksi'] ?></td>
                                    <td><?= $kas['uraian'] ?></td>
                                    <td>Rp <?= number_format($kas['kas_masuk'], 0, ',', '.') ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="4">Tidak ada data kas masuk</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Pendapatan</h6>
    </div>

    <div class="card-body">
        <!-- Tabel untuk Pendapatan -->
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTablePendapatan" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Transaksi</th>
                        <th>Uraian</th>
                        <th>Lunas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($pendapatan)) : ?>
                        <?php foreach ($pendapatan as $index => $pend) : ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= $pend['tgl_transaksi'] ?></td>
                                <td><?= $pend['uraian'] ?></td>
                                <td>Rp <?= number_format($pend['lunas'], 0, ',', '.') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="4">Tidak ada data pendapatan</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>