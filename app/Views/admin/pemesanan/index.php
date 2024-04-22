<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card">
        <!-- Page Heading -->
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Pemesanan</h6>
        </div>

        <!-- Tambahkan tombol "Tambah Data" -->
        <div class="card-body">
            <a href="/admin/pemesanan/tambah-data" class="btn btn-primary mb-3">
                <i class="fas fa-plus-circle mr-1"></i> Tambah Data
            </a>

            <!-- DataTales Example -->
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
                                    <a href="/admin/pemesanan/edit/<?= $row['id_pemesanan'] ?>" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
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