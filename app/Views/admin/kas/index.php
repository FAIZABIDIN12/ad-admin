<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<!-- Begin Page Content -->
<div class="container">
    <style>
        /* Mengurangi ukuran font untuk teks */
        .card-header h2,
        .form-label {
            font-size: 1.3rem;
            /* Sesuaikan ukurannya sesuai kebutuhan Anda */
        }

        /* Mengurangi ukuran font untuk ikon */
        .card-header i {
            font-size: 1rem;
            /* Sesuaikan ukurannya sesuai kebutuhan Anda */
        }

        #uang-masuk-table,
        #uang-keluar-table {
            font-size: 0.9rem;
            /* Sesuaikan ukurannya sesuai kebutuhan Anda */
        }
    </style>

    <div class="row">
        <!-- Form tambah data -->
        <!-- Uang Masuk -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h2 class="mb-0"><i class="fas fa-arrow-circle-down me-2 fa-sm"></i>Uang Masuk</h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="uang-masuk-table" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Keterangan</th>
                                    <th>Tanggal</th>
                                    <th>Nominal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($kas as $key => $transaksi) : ?>
                                    <?php if ($transaksi['jenis'] == 'cr') : ?>
                                        <tr>
                                            <td><?= $key + 1 ?></td>
                                            <td><?= isset($transaksi['keterangan']) ? $transaksi['keterangan'] : '' ?></td>
                                            <td><?= isset($transaksi['tanggal']) ? $transaksi['tanggal'] : '' ?></td>
                                            <td><?= 'Rp.' . number_format($transaksi['nominal'], 2) ?></td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Uang Keluar -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <h2 class="mb-0"><i class="fas fa-arrow-circle-up me-2 fa-sm"></i>Uang Keluar</h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="uang-keluar-table" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Keterangan</th>
                                    <th>Tanggal</th>
                                    <th>Nominal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($kas as $key => $transaksi) : ?>
                                    <?php if ($transaksi['jenis'] == 'db') : ?>
                                        <tr>
                                            <td><?= $key + 1 ?></td>
                                            <td><?= isset($transaksi['keterangan']) ? $transaksi['keterangan'] : '' ?></td>
                                            <td><?= isset($transaksi['tanggal']) ? $transaksi['tanggal'] : '' ?></td>
                                            <td><?= 'Rp.' . number_format($transaksi['nominal'], 2) ?></td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h2 class="fw-bold mb-0"><i class="fas fa-plus-circle me-2 fa-sm"></i>Tambah Data</h2>
                </div>
                <div class="card-body">
                    <form action="/admin/kas/simpan" method="post">
                        <div class="form-group mb-3">
                            <label for="keterangan" class="mb-1">Keterangan</label>
                            <input type="text" class="form-control" id="keterangan" name="keterangan" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="tanggal" class="mb-1">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="jenis" class="mb-1">Jenis</label>
                            <select class="form-select" id="jenis" name="jenis" required>
                                <option value="cr">Uang Masuk</option>
                                <option value="db">Uang Keluar</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="nominal" class="mb-1">Nominal</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp.</span>
                                <input type="number" class="form-control" id="nominal" name="nominal" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2 fa-sm"></i>Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<!-- DataTables JS -->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize DataTables
        $('#uang-masuk-table').DataTable();
        $('#uang-keluar-table').DataTable();
    });
</script>

<?= $this->endSection() ?>