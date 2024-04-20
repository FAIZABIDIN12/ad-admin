<!-- app/Views/tambah_kamar.php -->
<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-flex">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Tambah Kamar Baru</h5>
                </div>
                <div class="card-body">
                    <form action="/admin/simpan-kamar" method="post">
                        <div class="form-group">
                            <label for="no_kamar">Nomor Kamar</label>
                            <input type="text" class="form-control" id="no_kamar" name="no_kamar" required>
                        </div>
                        <!-- <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="Ready">Ready</option>
                                <option value="Checkin">checkin</option>
                                <option value="Trouble">Trouble</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <input type="number" class="form-control" id="keterangan" name="keterangan" required>
                        </div> -->
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>