<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit Data Pemesanan</h1>

    <!-- Form Edit Data -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Data</h6>
        </div>
        <div class="card-body">
            <form action="/admin/pemesanan/update-data/<?= $reservation['id'] ?>" method="post">
                <div class="form-group">
                    <label for="nama">Nama Pemesan:</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $reservation['nama'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="no_hp">No. Telpon:</label>
                    <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= $reservation['no_hp'] ?>" required>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="tgl_checkin">Tanggal Check-in:</label>
                        <input type="date" class="form-control" id="tgl_checkin" name="tgl_checkin" value="<?= $reservation['tgl_checkin'] ?>" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="tgl_checkout">Tanggal Check-out:</label>
                        <input type="date" class="form-control" id="tgl_checkout" name="tgl_checkout" value="<?= $reservation['tgl_checkout'] ?>" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="jml_kamar">jml Kamar:</label>
                        <input type="number" class="form-control" id="jml_kamar" name="jml_kamar" value="<?= $reservation['jml_kamar'] ?>" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="jml_orang">jml Orang:</label>
                        <input type="number" class="form-control" id="jml_orang" name="jml_orang" value="<?= $reservation['jml_orang'] ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="status_bayar">Status bayar:</label>
                    <select class="form-control" id="status_bayar" name="status_bayar" required>
                        <option value="lunas" <?= ($reservation['status_bayar'] == 'lunas') ? 'selected' : '' ?>>Lunas</option>
                        <option value="belum lunas" <?= ($reservation['status_bayar'] == 'belum lunas') ? 'selected' : '' ?>>Belum Lunas</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="status_order">Status reservation$reservation:</label>
                    <select class="form-control" id="status_order" name="status_order" required>
                        <option value="BOOKING" <?= ($reservation['status_order'] == 'BOOKING') ? 'selected' : '' ?>>BOOKING</option>
                        <option value="DONE" <?= ($reservation['status_order'] == 'DONE') ? 'selected' : '' ?>>DONE</option>
                        <option value="BATAL" <?= ($reservation['status_order'] == 'BATAL') ? 'selected' : '' ?>>BATAL</option>
                    </select>
                </div>

                <!-- Tambahkan input untuk data lainnya seperti tanggal checkout, jml orang, jml kamar, harga, dll. -->
                <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-2"></i> Submit</button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<?= $this->endSection() ?>