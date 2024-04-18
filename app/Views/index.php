<!-- app/Views/index.php -->
<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <!-- Daftar Kamar -->
        <?php foreach ($kamars as $kamar) : ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-header badge-primary">
                        <h5 class="card-title mb-0">Kamar No.<?= $kamar['no_kamar'] ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="btn-group d-flex" role="group">
                            <button type="button" class="btn btn-primary input-reservation" data-toggle="modal" data-target="#inputReservationModal" data-kamar="<?= $kamar['id_kamar'] ?>">
                                Input Reservation
                            </button>
                            <button type="button" class="btn btn-info ml-2 detail" data-toggle="modal" data-target="#detailModal" data-kamar="<?= $kamar['id_kamar'] ?>">
                                Detail
                            </button>
                        </div>
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
                <h5 class="modal-title" id="inputReservationLabel">Input Reservation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/home/simpanReservasi" method="post">
                    <input type="hidden" id="id_kamar" name="id_kamar" value="">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="tgl_checkin">Tanggal Check-in</label>
                        <input type="date" class="form-control" id="tgl_checkin" name="tgl_checkin" required>
                    </div>
                    <div class="form-group">
                        <label for="tgl_checkout">Tanggal Check-out</label>
                        <input type="date" class="form-control" id="tgl_checkout" name="tgl_checkout" required>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_orang">Jumlah Orang</label>
                        <input type="number" class="form-control" id="jumlah_orang" name="jumlah_orang" required>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_kamar">Jumlah Kamar</label>
                        <input type="number" class="form-control" id="jumlah_kamar" name="jumlah_kamar" required>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" class="form-control" id="harga" name="harga" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Check-in</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<script>
    $(document).ready(function() {
        $('.detail').click(function() {
            var kamarId = $(this).data('kamar');
            $.ajax({
                url: '/home/detailReservasi/' + kamarId,
                type: 'GET',
                success: function(response) {
                    if (response) {
                        $('#detail-reservasi').html(`
                        <p>Nama: <span>${response.nama}</span></p>
                        <p>Tanggal Check-in: <span>${response.checkin}</span></p>
                        <p>Tanggal Check-out: <span>${response.checkout}</span></p>
                        <p>Jumlah Orang: <span>${response.jumlah_orang}</span></p>
                        <p>Jumlah Kamar: <span>${response.jumlah_kamar}</span></p>
                        <p>Harga: <span>${response.harga}</span></p>
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