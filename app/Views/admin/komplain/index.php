<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
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
            <h6 class="m-0 font-weight-bold text-primary">Daftar Komplain</h6>
            <a class="btn btn-primary btn-icon-split" href="<?= base_url('admin/tambah-komplain') ?>">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah Komplain</span>
            </a>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <!-- Table Head -->
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Komplain</th>
                        </tr>
                    </thead>
                    <!-- Table Body -->
                    <tbody>
                        <?php foreach ($komplain as $row) : ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= $row['nama'] ?></td>
                                <td><?= $row['komplain'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<?= $this->endSection() ?>