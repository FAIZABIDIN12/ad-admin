<?= $this->extend('admin/layouts/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Users</h6>
                </div>
                <div class="card-body">
                    <a href="<?= base_url('register') ?>" class="btn btn-primary mb-3">Tambah User</a>
                    <?php if ($users) : ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Username</th>
                                    <th>Nama</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $key => $user) : ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $user['username'] ?></td>
                                        <td><?= $user['nama'] ?></td>
                                        <td><?= $user['role'] ?></td>
                                        <td><a class="btn btn-sm btn-warning" href="<?= $user['id'] ?>">Edit</a></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    <?php else : ?>
                        <p>Anda tidak memiliki akses.</p>
                    <?php endif; ?>
                </div>
            </div>

        </div>

    </div>
</div>
<?= $this->endSection() ?>