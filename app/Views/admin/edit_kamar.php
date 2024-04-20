<!-- app/Views/index.php -->
<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<!-- Begin Page Content -->

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit Data Kamar</h1>

    <!-- Content Row -->
    <div class="row">

        <!-- Form Edit Kamar -->
        <div class="col-lg-12">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Kamar</h6>
                </div>
                <div class="card-body">
                    <!-- Formulir Edit Kamar -->
                    <form action="/admin/update-kamar" method="post">
                        <input type="hidden" name="id_kamar" value="<?= $kamar['id_kamar'] ?>">
                        <div class="form-group">
                            <label for="no_kamar">Nomor Kamar</label>
                            <input type="text" class="form-control" id="no_kamar" name="no_kamar" value="<?= $kamar['no_kamar'] ?>">
                        </div>

                        <!-- Tambahkan field lain sesuai kebutuhan -->
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="Ready">Ready</option>
                                <option value="Proses">Proses</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan"><?= $kamar['keterangan'] ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>

        </div>

    </div>

</div>
<!-- /.container-fluid -->
<?= $this->endSection() ?>