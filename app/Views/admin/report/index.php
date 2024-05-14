<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>

<!-- Filter berdasarkan bulan -->

<div class="card">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Report Bulanan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="uang-masuk-table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Kamar Terpakai</th>
                        <th>Total Pendapatan</th>
                        <th>Terbayar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reports as $tgl => $report) : ?>
                        <tr>
                            <td><?= $tgl ?></td>
                            <td><?= $report['kamar_terpakai'] ?></td>
                            <td><?= number_format($report['harga'], 0, ',', '.'); ?></td>
                            <td><?= number_format($report['terbayar'], 0, ',', '.'); ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<!-- DataTables JS -->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize DataTables
        var table = $('#uang').DataTable();

        // Event listener untuk filter bulan
        $('#bulan').change(function() {
            var selectedMonth = $(this).val();
            // Menentukan rentang tanggal berdasarkan bulan yang dipilih
            var startDate = '2024-' + selectedMonth + '-01';
            var endDate = '2024-' + selectedMonth + '-31'; // Ini asumsi 31 hari untuk setiap bulan
            // Mengatur filter pada kolom pertama (tanggal) untuk rentang yang dipilih
            table.column(0).search(startDate + ' to ' + endDate).draw();
        });
    });
</script>

<?= $this->endSection() ?>