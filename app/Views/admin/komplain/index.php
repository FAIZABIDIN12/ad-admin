<!-- app/Views/admin/komplain/index.php -->
<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<?php if (session()->has('success')) : ?>
    <div class="alert alert-success" role="alert">
        <?= session('success') ?>
    </div>
<?php endif; ?>
<div class="container-fluid">
    <div class="mb-3">
        <h1>Complaints List</h1>
        <a href="/admin/komplain/tambah" class="btn btn-primary">Tambah Data</a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Keterangan</th>
                    <th>Status</th>
                    <th>Action</th> <!-- Menambahkan kolom Action -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($komplains as $komplain) : ?>
                    <tr>
                        <td><?= $komplain['nama'] ?></td>
                        <td><?= $komplain['keterangan'] ?></td>
                        <td><?= ($komplain['status'] == 0) ? 'No Action' : 'Done' ?></td>
                        <td>
                            <a href="/admin/komplain/edit/<?= $komplain['id'] ?>" class="btn btn-info btn-sm">Edit</a> <!-- Tombol edit -->
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>