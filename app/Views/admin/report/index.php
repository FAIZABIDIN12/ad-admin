<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>

<div class="card">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Report</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Kamar Terpakai</th>
                        <th>Total Pendapatan</th>
                        <th>Terbayar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reports as $tgl => $report): ?>
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
    // $(document).ready(function() {
    //     // Initialize DataTables
    //     $('#uang-masuk-table').DataTable();
    //     $('#uang-keluar-table').DataTable();
    // });
</script>

<?= $this->endSection() ?>