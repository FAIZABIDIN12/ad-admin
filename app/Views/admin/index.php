<!-- app/Views/index.php -->
<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="container-fluid">

    <!-- Alert -->
    <?php if (session()->has('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Sukses!</strong> <?= session('success') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php elseif (session()->has('error')) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> <?= session('error') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <!-- Dashboard Title -->
    <div class="d-flex justify-content-between mb-2 align-items-center"> <!-- Mengurangi margin menjadi mb-2 -->
        <h5 class="font-weight-bold">Kamar</h5> <!-- Mengubah ukuran font menjadi 1.5rem -->
        <a href="/admin/history" class="btn btn-secondary btn-sm">History <i class="fas fa-history"></i></a> <!-- Mengubah tombol menjadi kecil dengan menambahkan kelas btn-sm -->
    </div>

    <!-- Daftar Kamar -->
    <div class="row">
        <?php foreach ($rooms as $key => $room) : ?>
            <?php $roomTaken = false; ?> <!-- Mendefinisikan variabel $roomTaken sebelum loop foreach -->
            <div class="col-md-2 mb-4"> <!-- Mengubah col-md-4 menjadi col-md-3 dan mengubah margin menjadi mb-4 -->
                <div class="card"> <!-- Menghapus kelas h-100 untuk membiarkan ketinggian menyesuaikan konten -->
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-2"> <!-- Mengurangi padding secara vertikal dengan py-2 -->
                        <h5 class="font-weight-bold card-title mb-0" style="font-size: 0.9rem;">Kamar No.<?= $room['no_kamar'] ?></h5> <!-- Mengubah ukuran font menjadi 0.9rem -->
                        <?php foreach ($checkins as $checkin) : ?>
                            <?php if ($checkin['id_room'] == $room['id']) : ?>
                                <?php $roomTaken = true; ?>
                                <span class="badge badge-danger mb-2">Taken</span> <!-- Menambahkan margin kiri dengan ml-2 -->
                            <?php endif ?>
                        <?php endforeach ?>
                    </div>
                    <div class="p-2"> <!-- Mengurangi padding secara vertikal dengan py-2 -->
                        <?php foreach ($checkins as $checkin) : ?>
                            <?php if ($checkin['id_room'] == $room['id']) : ?>
                                <?php $roomTaken = true; ?>
                                <div class="mb-1" style="font-size: 0.8rem;"> <!-- Mengubah ukuran font menjadi 0.8rem dan mengurangi margin bawah menjadi mb-1 -->
                                    <?= $checkin['nama'] ?> <!-- Menampilkan nama -->
                                </div>
                                <div class="mb-1" style="font-size: 0.8rem;"> <!-- Mengubah ukuran font menjadi 0.8rem dan mengurangi margin bawah menjadi mb-1 -->
                                    Check-out: <?= $checkin['checkout_plan'] ?> <!-- Menampilkan tanggal check-out -->
                                </div>
                                <div class="btn-group d-flex" role="group">
                                    <a href="/admin/checkout/<?= $checkin['id'] ?>" type="button" class="btn btn-danger input-reservation btn-sm" style="font-size: 0.7rem;">
                                        Check Out <i class="fas fa-sign-out-alt"></i>
                                    </a>
                                    <button type="button" class="btn btn-info ml-2 detail btn-sm" data-toggle="modal" data-target="#detailModal" data-kamar="<?= $room['id'] ?>" style="font-size: 0.7rem;"> <!-- Mengubah ukuran font menjadi 0.7rem -->
                                        Detail <i class="fas fa-info-circle"></i>
                                    </button>
                                </div>
                            <?php endif ?>
                        <?php endforeach ?>
                        <?php if (!$roomTaken) : ?>
                            <span class="badge badge-success mb-1">Ready</span>
                            <div class="btn-group d-flex" role="group">
                                <button type="button" class="btn btn-primary input-reservation btn-sm" data-toggle="modal" data-target="#inputReservationModal" data-kamar="<?= $room['id'] ?>" style="font-size: 0.7rem;"> <!-- Mengubah ukuran font menjadi 0.7rem -->
                                    Checkin <i class="fas fa-calendar-plus"></i>
                                </button>
                                <a href="/admin/edit-kamar/<?= $room['id'] ?>" class="btn btn-warning btn-sm ml-auto" style="font-size: 0.7rem;">Edit <i class="fas fa-edit"></i></a> <!-- Mengubah ukuran font menjadi 0.7rem dan menggunakan ml-auto untuk menempatkan tombol edit di ujung kanan -->
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>

<!-- Modal untuk detail reservasi -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Reservasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="detail-reservasi">
                <!-- Data reservasi akan ditampilkan di sini -->
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk input reservasi -->
<div class="modal fade" id="inputReservationModal" tabindex="-1" role="dialog" aria-labelledby="inputReservationLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="inputReservationLabel">Input Checkin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/admin/simpan-checkin" method="post">
                    <input type="hidden" id="id_kamar" name="id_kamar" value="">
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                            <div class="col">
                                <label for="no_hp">No. HP</label>
                                <input type="text" class="form-control" id="no_hp" name="no_hp" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="checkout_plan">Check-out</label>
                        <input type="date" class="form-control" id="checkout_plan" name="checkout_plan" required>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_orang">Jumlah Orang</label>
                        <input type="number" class="form-control" id="jumlah_orang" name="jumlah_orang" required>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="rate">Rate</label>
                                <input type="number" class="form-control" id="rate" name="rate" required>
                            </div>
                            <div class="col">
                                <label for="bayar">Bayar</label>
                                <input type="number" class="form-control" id="bayar" name="bayar" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="inputState">Metode Pembayaran</label>
                                <select name="metode_bayar" id="inputState" class="form-control" required>
                                    <option selected>Choose...</option>
                                    <option value="transfer">Transfer</option>
                                    <option value="cash">Cash</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="keterangan">Keterangan</label>
                                <input type="text" class="form-control" id="keterangan" name="keterangan">
                            </div>
                        </div>
 
                    </div>
                    <button type="submit" class="btn btn-primary">Check-in</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.detail').click(function() {
            var kamarId = $(this).data('kamar');
            $.ajax({
                url: '/admin/detail-checkin/' + kamarId,
                type: 'GET',
                success: function(response) {
                    if (response) {
                        $('#detail-reservasi').html(`
                        <p>Nama: <span>${response.nama}</span></p>
                        <p>No. HP: <span>${response.no_hp}</span></p>
                        <p>Tanggal Check-in: <span>${response.checkin}</span></p>
                        <p>Tanggal Check-out: <span>${response.checkout_plan}</span></p>
                        <p>Jumlah Orang: <span>${response.jml_orang}</span></p>
                        <p>Bayar: <span> Rp.${response.bayar}</span></p>
                        <p>Status: <span> ${response.status_order}</span></p>
                    `);
                    } else {
                        $('#detail-reservasi').html('<p>Data reservasi tidak ditemukan.</p>');
                    }
                },
                error: function() {
                    $('#detail-reservasi').html('<p>Terjadi kesalahan saat mengambil data reservasi.</p>');
                }
            });
        });

        $('.input-reservation').click(function() {
            var idKamar = $(this).data('kamar');
            $('#id_kamar').val(idKamar); // Set nilai id_kamar di input field tersembunyi
        });
    });
</script>
<?= $this->endSection() ?>