<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- Form Tambah Data -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Reservasi</h6>
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
                        <label for="tanggal_checkin">Rencana Check-in:</label>
                        <input type="date" class="form-control" id="tanggal_checkin" name="tanggal_checkin" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="tanggal_checkout">Rencana Check-out:</label>
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
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="metode_pembayaran">Metode Pembayaran</label>
                        <select class="form-control" id="metode_pembayaran" name="metode_bayar" required>
                            <option value="cash">Cash</option>
                            <option value="bca">Transfer BCA</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" name="keterangan" class="form-control" placeholder="Keterangan">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="rate">Rate:</label>
                        <input id="rate" type="text" name="rate" class="form-control" placeholder="Harga">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="bayar">Deposit:</label>
                        <input id="bayar" type="text" name="bayar" class="form-control" placeholder="Deposit">
                    </div>
                </div>


                <div class="form-group">
                    <label for="status_pembayaran">Status Pembayaran:</label>
                    <select class="form-control" id="status_pembayaran" name="status_bayar" required>
                        <option value="lunas">Lunas</option>
                        <option value="belum_lunas">DP</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="status_pemesanan">Status Pemesanan:</label>
                    <select class="form-control" id="status_pemesanan" name="status_order" required>
                        <option value="BOOKING">BOOKING</option>
                        <option value="CHECK-IN">CHECKIN</option>
                        <option value="DONE">DONE</option>
                        <option value="CANCEL">BATAL</option>
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