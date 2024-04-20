<!-- app/Views/index.php -->
<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Pemesanan</h1>

    <!-- Tambahkan tombol "Tambah Data" -->
    <a href="/admin/pemesanan/tambah-data" class="btn btn-primary mb-3">Tambah Data</a>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Pemesan</th>
                            <th>No.HP</th>
                            <th>Check-in</th>
                            <th>Check-out</th>
                            <th>Jumlah Kamar</th>
                            <th>Jumlah Orang</th>
                            <th>Status Pembayaran</th>
                            <th>Status Pemesanan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pemesanan as $index => $row) : ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= $row['nama_pemesan'] ?></td>
                                <td><?= $row['no_hp'] ?></td>
                                <td><?= $row['tanggal_checkin'] ?></td>
                                <td><?= $row['tanggal_checkout'] ?></td>
                                <td><?= $row['jumlah_kamar'] ?></td>
                                <td><?= $row['jumlah_orang'] ?></td>
                                <td><?= $row['status_pembayaran'] ?></td>
                                <td><?= $row['status_pemesanan'] ?></td>
                                <td>
                                    <a href="/admin/pemesanan/edit/<?= $row['id_pemesanan'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<?= $this->endSection() ?>