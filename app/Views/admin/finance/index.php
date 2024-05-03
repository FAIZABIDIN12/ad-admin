<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>

    <div class="card">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Laporan Keuangan</h6>
    </div>
    <div class="card-body">
    <button type="button" class="btn btn-primary btn-lg mb-3" data-toggle="modal" data-target="#inputDataModal" style="font-size: 0.7rem;"> <!-- Mengubah ukuran font menjadi 0.7rem -->
        Tambah Data <i class="fas fa-plus"></i>
    </button>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Waktu</th>
                        <th>Keterangan</th>
                        <th>Jenis</th>
                        <th>Nominal</th>
                        <th>Kategori</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cashs as $cash): ?>
                        <tr>
                            <td><?= $cash['tanggal'] ?></td>
                            <td><?= $cash['keterangan'] ?></td>
                            <td><?= $cash['jenis'] == 'cr' ? 'Uang Masuk' : 'Uang Keluar' ?></td>
                            <td><?= number_format($cash['nominal'], 0, ',', '.'); ?></td>
                            <td><?= $cash['kategori'] ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
    <div class="modal fade" id="inputDataModal" tabindex="-1" role="dialog" aria-labelledby="inputReservationLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="inputReservationLabel">Input Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/admin/add-cash-flow" method="post">
                        <div class="form-group">
                            <label for="nominal">Nominal</label>
                            <input type="number" class="form-control" id="nominal" name="nominal" required>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" class="form-control" id="keterangan" name="keterangan" required>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="jenis">Jenis</label>
                                    <select name="jenis" id="jenis" class="form-control" required>
                                        <option selected disabled>Pilih Jenis...</option>
                                        <option value="cr">Uang Masuk</option>
                                        <option value="db">Uang Keluar</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="kategori">Kategori</label>
                                    <select name="kategori" id="kategori" class="form-control">
                                        <option selected disabled>Pilih Kategori...</option>
                                        <option value="uang_makan">Uang Makan</option>
                                        <option value="hk">HK</option>
                                        <option value="other">Lainnya</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </form>
                </div>
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
        // $('#dataTable').DataTable();
    });
</script>

<?= $this->endSection() ?>