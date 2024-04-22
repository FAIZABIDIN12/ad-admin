<!-- app/Views/index.php -->
<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Uang Masuk -->
    <div class="uang-masuk">
        <h2>Uang Masuk</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Keterangan</th>
                    <th>Tanggal</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Pendapatan dari Penjualan Produk A</td>
                    <td>1 April 2024</td>
                    <td>$500</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Penerimaan Pembayaran Sewa</td>
                    <td>5 April 2024</td>
                    <td>$1,200</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Pembayaran Pinjaman dari Pelanggan</td>
                    <td>10 April 2024</td>
                    <td>$300</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Uang Keluar -->
    <div class="uang-keluar">
        <h2>Uang Keluar</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Keterangan</th>
                    <th>Tanggal</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Pembelian Bahan Baku</td>
                    <td>3 April 2024</td>
                    <td>$700</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Pengeluaran untuk Biaya Listrik</td>
                    <td>8 April 2024</td>
                    <td>$150</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Pembayaran Gaji Karyawan</td>
                    <td>15 April 2024</td>
                    <td>$1,000</td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
<!-- /.container-fluid -->
<?= $this->endSection() ?>