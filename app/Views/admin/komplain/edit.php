<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="mb-3">
        <h1>Edit Complaint</h1>
    </div>
    <form action="/admin/komplain/update/<?= $komplain['id'] ?>" method="post">
        <input type="hidden" name="id" value="<?= $komplain['id'] ?>">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= $komplain['nama'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <textarea class="form-control" id="keterangan" name="keterangan" required><?= $komplain['keterangan'] ?></textarea>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status" required>
                <?php $statuses = ['No Action', 'Done']; ?>
                <?php foreach ($statuses as $key => $value) : ?>
                    <option value="<?= $key ?>" <?= ($komplain['status'] == $key) ? 'selected' : '' ?>><?= $value ?></option>
                <?php endforeach; ?>
            </select>
        </div>


        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
<?= $this->endSection() ?>