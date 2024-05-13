<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>

<!-- Filter berdasarkan bulan -->
<div class="mb-3">
    <label for="bulan">Pilih Bulan:</label>
    <select id="bulan">
        <option value="01">Januari</option>
        <option value="02">Februari</option>
        <option value="03">Maret</option>
        <option value="04">April</option>
        <option value="05">Mei</option>
        <option value="06">Juni</option>
        <option value="07">Juli</option>
        <option value="08">Agustus</option>
        <option value="09">September</option>
        <option value="10">Oktober</option>
        <option value="11">November</option>
        <option value="12">Desember</option>
    </select>
</div>

<div class="card">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"></h6>
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
        $('#uang-masuk-table').DataTable();

        // Event listener untuk filter bulan
        $('#bulan').change(function() {
            var selectedMonth = $(this).val();
            $('#uang-masuk-table').DataTable().column(0).search(selectedMonth).draw();
        });
    });
</script>

<?= $this->endSection() ?>