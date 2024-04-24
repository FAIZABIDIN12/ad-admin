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
            <h6 class="m-0 font-weight-bold text-primary">Daftar Komplain Tamu</h6>
            <a class="btn btn-primary btn-icon-split" href="<?= base_url('admin/tambah-komplain') ?>">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah</span>
            </a>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <!-- Tabel -->
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <!-- Header Tabel -->
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Komplain</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <!-- Isi Tabel -->
                    <tbody>
                        <?php $nomor = 1; ?>
                        <?php foreach ($komplain as $row) : ?>
                            <tr>
                                <td><?= $nomor++ ?></td>
                                <td><?= $row->nama ?></td>
                                <td><?= $row->komplain ?></td>
                                <td>
                                    <?= $row->status ?>
                                    <a href="<?= base_url('/admin/edit-status/' . $row->id) ?>" class="btn btn-sm btn-info">
                                        <i class="fas fa-edit"></i> Edit Status
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>


                </table>
            </div>
        </div>
    </div>
</div>
<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<!-- DataTables JS -->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
<?= $this->endSection() ?>