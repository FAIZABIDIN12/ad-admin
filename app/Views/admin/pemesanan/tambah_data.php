<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Tambah Data Pemesanan</h1>

    <!-- Form Tambah Data -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Data</h6>
        </div>
        <div class="card-body">
            <form action="/admin/pemesanan/tambah" method="post">
                <div class="form-group">
                    <label for="nama_pemesan">Nama Pemesan:</label>
                    <input type="text" class="form-control" id="nama_pemesan" name="nama_pemesan" required>
                </div>
                <div class="form-group">
                    <label for="no_hp">No. Hp:</label>
                    <input type="text" class="form-control" id="no_hp" name="no_hp" required>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="tanggal_checkin">Tanggal Check-in:</label>
                        <input type="date" class="form-control" id="tanggal_checkin" name="tanggal_checkin" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="tanggal_checkout">Tanggal Check-out:</label>
                        <input type="date" class="form-control" id="tanggal_checkout" name="tanggal_checkout" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="jumlah_kamar">Jumlah Kamar:</label>
                        <input type="number" class="form-control" id="jumlah_kamar" name="jumlah_kamar" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="jumlah_orang">Jumlah Orang:</label>
                        <input type="number" class="form-control" id="jumlah_orang" name="jumlah_orang" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="status_pembayaran">Status Pembayaran:</label>
                    <select class="form-control" id="status_pembayaran" name="status_pembayaran" required>
                        <option value="lunas">Lunas</option>
                        <option value="belum lunas">Belum Lunas</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="status_pemesanan">Status Pemesanan:</label>
                    <select class="form-control" id="status_pemesanan" name="status_pemesanan" required>
                        <option value="BOOKING">BOOKING</option>
                        <option value="DONE">DONE</option>
                        <option value="BATAL">BATAL</option>
                    </select>
                </div>
                <!-- Tambahkan input untuk data lainnya seperti tanggal checkout, jumlah orang, jumlah kamar, harga, dll. -->
                <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-2"></i> Submit</button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<?= $this->endSection() ?>