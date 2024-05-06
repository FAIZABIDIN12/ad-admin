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
            <h6 class="m-0 font-weight-bold text-primary">Data Reservasi</h6>
        </div>

        <!-- Tambahkan tombol "Tambah Data" -->
        <div class="card-body">
            <a href="/admin/pemesanan/tambah-data" class="btn btn-primary mb-3">
                <i class="fas fa-plus-circle mr-1"></i> Tambah Reservasi
            </a>
            <!-- DataTales Example -->
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tanggal Reservasi</th>
                            <th>Kode Order</th>
                            <th>Nama Pemesan</th>
                            <th>Check-in</th>
                            <th>Check-out</th>
                            <th>Jumlah Kamar</th>
                            <th>Deposit</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pemesanan as $index => $row) : ?>
                            <tr>
                                <td><?= $row['tgl'] ?></td>
                                <td><?= $row['kode_order'] ?></td>
                                <td><?= $row['nama'] ?></td>
                                <td><?= date('d F Y', strtotime($row['tgl_checkin'])) ?></td>
                                <td><?= date('d F Y', strtotime($row['tgl_checkout'])) ?></td>
                                <td><?= $row['jml_kamar'] ?></td>
                                <td><?= number_format($row['bayar'], 0, ',', '.') ?></td>
                                <td><?= $row['status_order'] ?></td>
                                <td>
                                    <a href="/admin/pemesanan/edit/<?= $row['id'] ?>" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-info btn-detail" data-toggle="modal" data-reservation-id="<?= $row['id'] ?>" data-target="#detailModal">
                                        <i class="fas fa-info-circle"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- Modal untuk menampilkan detail reservasi -->
            <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="detailModalLabel">Detail Reservasi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Tempat untuk menampilkan detail reservasi -->
                            <div id="detailContent"></div>
                        </div>
                    </div>
                </div>
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
    $(document).ready(function() {
        // Ketika tombol detail diklik


        $('.btn-detail').click(function() {
            var reservationId = $(this).data('reservation-id');
            $.ajax({
                url: '/admin/pemesanan/detail/' + reservationId,
                type: 'GET',
                success: function(response) {
                    if (response) {
                        console.log(response);
                        $('#detailContent').html(`
                        <p>Tanggal Reservasi: <span>${response.tgl}</span></p>
                        <p>Kode Order: <span>${response.kode_order}</span></p>
                        <p>Nama: <span>${response.nama}</span></p>
                        <p>No. HP: <span>${response.no_hp}</span></p>
                        <p>Tanggal Check-in: <span>${response.tgl_checkin}</span></p>
                        <p>Tanggal Check-out: <span>${response.tgl_checkout}</span></p>
                        <p>Jumlah Kamar: <span>${response.jml_kamar}</span></p>
                        <p>Jumlah Orang: <span>${response.jml_orang}</span></p>
                        <p>Harga: <span> Rp.${response.rate}</span></p>
                        <p>Deposit: <span> Rp.${response.bayar}</span></p>
                        <p>Status Pembayaran: <span> Rp.${response.status_bayar}</span></p>
                        <p>Status Tamu: <span> ${response.status_order}</span></p>
                        `);
                    } else {
                        $('#detailContent').html('<p>Data reservasi tidak ditemukan.</p>');
                    }
                },
                error: function() {
                    $('#detailContent').html('<p>Terjadi kesalahan saat mengambil data reservasi.</p>');
                }
            });
        });
    });
</script>

<?= $this->endSection() ?>