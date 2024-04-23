<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <!-- Notifikasi -->
    <?php if (session()->has('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif ?>

    <?php if (session()->has('error')) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif ?>

    <!-- Card -->
    <div class="card shadow mb-4">
        <!-- Card Header -->
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Laporan Bulanan</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <!-- Header Table -->
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Kamar Terpakai</th>
                            <th>Rata-rata Harga</th>
                            <th>Total Pendapatan</th>
                        </tr>
                    </thead>
                    <!-- Isi Tabel -->
                    <tbody>
                        <?php foreach ($data as $tanggal => $reservation) : ?>
                            <tr>
                                <td><?= $tanggal ?></td>
                                <td><?= $reservation['jumlah_kamar'] ?></td>
                                <td><?= $reservation['rata_harga'] ?></td>
                                <td><?= $reservation['jumlah_kamar'] * $reservation['rata_harga'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>