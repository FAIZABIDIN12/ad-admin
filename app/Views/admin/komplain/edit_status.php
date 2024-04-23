<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">Edit Status Komplain</h6>
        </div>
        <div class="card-body">
            <form action="<?= base_url('admin/update-status/' . $komplain->id) ?>" method="post">
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="slesai" <?= ($komplain->status == 'slesai') ? 'selected' : '' ?>>Slesai</option>
                        <option value="proses" <?= ($komplain->status == 'proses') ? 'selected' : '' ?>>Proses</option>
                        <option value="no-action" <?= ($komplain->status == 'no-action') ? 'selected' : '' ?>>No Action</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>