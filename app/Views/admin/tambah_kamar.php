<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Kamar Baru</h6>
                </div>
                <div class="card-body">
                    <form action="/admin/simpan-kamar" method="post">
                        <div class="form-group">
                            <label for="no_kamar">Nomor Kamar</label>
                            <input type="text" class="form-control" id="no_kamar" name="no_kamar" required>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>