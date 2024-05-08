<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Tambahkan notifikasi -->
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
        <!-- Page Heading -->
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Trouble Kamar</h6>
        </div>

        <!-- Tambahkan tombol "Tambah Data" -->
        <div class="card-body">
            <!-- DataTales Example -->
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>No Kamar</th>
                            <th>Trouble</th>
                            <th>Progress</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($troubles as $trouble) : ?>
                            <tr>
                                <td><?= $trouble['tanggal'] ?></td>
                                <td><?= $trouble['no_kamar'] ?></td>
                                <td><?= $trouble['trouble'] ?></td>
                                <td><?= $trouble['progress'] ?></td>
                                <td><?= $trouble['is_done'] ? "Done" : "Belum" ?></td>
                                <td>
                                    <button data-target="#pogressModal" data-trouble="<?= $trouble['id'] ?>" data-toggle="modal" class="btn add-trouble btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <?php if(!$trouble['is_done']): ?>
                                    <a href="/admin/solved-room/<?= $trouble['id'] ?>" class="btn btn-sm btn-success">
                                        <i class="fas fa-check"></i>
                                    </a>
                                    <?php endif; ?>
                                    
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- Modal untuk menampilkan detail reservasi -->
            <div class="modal fade" id="pogressModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="detailModalLabel">Tambah Pogress</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="/admin/progress-trouble">
                            <input id="id_trouble" type="hidden" name="id" value="">
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Progess Trouble</label>
                                <textarea name="progress" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary mb-2">Simpan</button>
                            </form>
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
        $('.add-trouble').click(function() {
            var idTrouble = $(this).data('trouble');
            $('#id_trouble').val(idTrouble); // Set nilai id_kamar di input field tersembunyi
        });
    })
</script>

<?= $this->endSection() ?>