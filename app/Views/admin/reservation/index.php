<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <?php if (session()->has('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session('success') ?>
        </div>
    <?php endif ?>

    <?php if (session()->has('error')) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session('error') ?>
        </div>
    <?php endif ?>

    <div class="card">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Reservasi</h6>
        </div>
        <div class="card-body">
            <a href="/admin/reservation/add" class="btn btn-primary mb-3">
                <i class="fas fa-plus-circle mr-1"></i> Tambah Reservasi
            </a>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Reservasi</th>
                            <th>Kode Order</th>
                            <th>Nama Pemesan</th>
                            <th>Check-in</th>
                            <th>Jml Kamar</th>
                            <th>Deposit</th>
                            <th>Status</th>
                            <th>FO</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reservations as $index => $reservation) : ?>
                            <tr>
                                <td><?= date('d F Y', strtotime($reservation['tgl'])) ?></td>
                                <td><?= $reservation['kode_order'] ?></td>
                                <td><?= $reservation['nama'] ?></td>
                                <td><?= date('d F Y', strtotime($reservation['tgl_checkin'])) ?></td>
                                <td><?= $reservation['jml_kamar'] ?></td>
                                <td><?= number_format($reservation['bayar'], 0, ',', '.') ?></td>
                                <td><?= $reservation['status_order'] ?></td>
                                <td>
                                    <?php
                                    $userModel = new \App\Models\UserModel();
                                    $frontOffice = $userModel->where('id', $reservation['front_office'])->first();

                                    // Tampilkan nama jika front office ditemukan
                                    echo $frontOffice ? $frontOffice['nama'] : 'Unknown';
                                    ?>
                                </td>

                                <td class="text-center">
                                    <a href="/admin/reservation/edit/<?= $reservation['id'] ?>" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="<?= base_url('/admin/reservation/printReservation/' . $reservation['id']) ?>" class="btn btn-sm btn-primary" target="_blank">
                                        <i class="fas fa-print"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-info btn-detail" data-toggle="modal" data-reservation-id="<?= $reservation['id'] ?>" data-target="#detailModal">
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
        function formatRupiah(angka) {
            var number_string = angka.toString().replace(/[^,\d]/g, ''),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;

            return rupiah;
        }

        function calculateDate(startDate, endDate) {
            const start = new Date(startDate);
            const end = new Date(endDate);

            if (isNaN(start) || isNaN(end)) {
                throw new Error('Invalid date format. Please use "YYYY-MM-DD HH:mm:ss" format.');
            }

            start.setHours(0, 0, 0, 0);
            end.setHours(0, 0, 0, 0);

            const differenceInMillis = end - start;
            const differenceInDays = differenceInMillis / (1000 * 60 * 60 * 24);
            return differenceInDays;
        }

        $('.btn-detail').click(function() {
            var reservationId = $(this).data('reservation-id');
            $.ajax({
                url: '/admin/reservation/detail/' + reservationId,
                type: 'GET',
                success: function(response) {
                    if (response) {
                        $('#detailContent').html(`
                        <table class="table table-borderless">
                            <tr>
                                <td>Tanggal Reservasi</td>
                                <td>:</td>
                                <td>${response.tgl}</td>
                            </tr>
                            <tr>
                                <td>Kode Order</td>
                                <td>:</td>
                                <td>${response.kode_order}</td>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td>${response.nama}</td>
                            </tr>
                            <tr>
                                <td>No. HP</td>
                                <td>:</td>
                                <td>${response.no_hp}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Check-in</td>
                                <td>:</td>
                                <td>${response.tgl_checkin}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Check-out</td>
                                <td>:</td>
                                <td>${response.tgl_checkout}</td>
                            </tr>
                            <tr>
                                <td>Jumlah Kamar / Orang</td>
                                <td>:</td>
                                <td>${response.jml_kamar} / ${response.jml_orang}</td>
                            </tr>
                            <tr>
                                <td>Rate / Hari</td>
                                <td>:</td>
                                <td>Rp. ${formatRupiah(response.rate)}</td>
                            </tr>
                            <tr>
                                <td>Tagihan</td>
                                <td>:</td>
                                <td>Rp. ${formatRupiah(response.rate * calculateDate(response.tgl_checkin, response.tgl_checkout))}</td>
                            </tr>
                            <tr>
                                <td>Deposit / Bayar</td>
                                <td>:</td>
                                <td>Rp. ${formatRupiah(response.bayar)}</td>
                            </tr>
                            <tr>
                                <td>Status Pembayaran</td>
                                <td>:</td>
                                <td>${response.status_bayar == 'lunas' ? '<span class="badge badge-success">Lunas</span>' : '<span class="badge badge-danger">Belum Lunas</span>'}</td>
                            </tr>
                            <tr>
                                <td>Status Tamu</td>
                                <td>:</td>
                                <td>${response.status_order}</td>
                            </tr>
                        </table>
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