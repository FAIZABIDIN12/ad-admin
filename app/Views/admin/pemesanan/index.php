<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Tambahkan notifikasi -->
    <?php if (session()->has('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif ?>

    <?php if (session()->has('error')) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif ?>

    <div class="card">
        <!-- Page Heading -->
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Booking</h6>
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

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<!-- DataTables JS -->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Inisialisasi DataTables
        $('#dataTable').DataTable();
    });
</script>
<?= $this->endSection() ?>