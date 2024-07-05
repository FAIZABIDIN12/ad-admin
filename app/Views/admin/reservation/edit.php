<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit Data Pemesanan</h1>

    <!-- Form Edit Data -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Data</h6>
        </div>
        <div class="card-body">
            <form action="/admin/reservation/update-data/<?= $reservation['id'] ?>" method="post">
                <div class="form-group">
                    <label for="nama">Nama Pemesan:</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $reservation['nama'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="no_hp">No. Telpon:</label>
                    <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= $reservation['no_hp'] ?>" required>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="tanggal_checkin">Rencana Check-in:</label>
                        <div class="input-group date" id="datetimepicker2" data-target-input="nearest">
                            <input type="text" name="tanggal_checkin" class="form-control datetimepicker-input" data-target="#datetimepicker2" />
                            <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="far fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="tanggal_checkout">Rencana Check-out:</label>
                        <div class="input-group date" id="datetimepicker3" data-target-input="nearest">
                            <input type="text" name="tanggal_checkout" class="form-control datetimepicker-input" data-target="#datetimepicker3" />
                            <div class="input-group-append" data-target="#datetimepicker3" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="far fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="jml_kamar">jml Kamar:</label>
                        <input type="number" class="form-control" id="jml_kamar" name="jml_kamar" value="<?= $reservation['jml_kamar'] ?>" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="jml_orang">jml Orang:</label>
                        <input type="number" class="form-control" id="jml_orang" name="jml_orang" value="<?= $reservation['jml_orang'] ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="status_bayar">Status bayar:</label>
                    <select class="form-control" id="status_bayar" name="status_bayar" required>
                        <option value="lunas" <?= ($reservation['status_bayar'] == 'lunas') ? 'selected' : '' ?>>Lunas</option>
                        <option value="belum lunas" <?= ($reservation['status_bayar'] == 'belum lunas') ? 'selected' : '' ?>>Belum Lunas</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="status_order">Status Reservasi:</label>
                    <select class="form-control" id="status_order" name="status_order" required>
                        <option value="booking" <?= ($reservation['status_order'] == 'booking') ? 'selected' : '' ?>>BOOKING</option>
                        <option value="checkin" <?= ($reservation['status_order'] == 'checkin') ? 'selected' : '' ?>>CHECKIN</option>
                        <option value="done" <?= ($reservation['status_order'] == 'done') ? 'selected' : '' ?>>DONE</option>
                        <option value="cancel" <?= ($reservation['status_order'] == 'batal') ? 'selected' : '' ?>>BATAL</option>
                    </select>
                </div>

                <!-- Tambahkan input untuk data lainnya seperti tanggal checkout, jml orang, jml kamar, harga, dll. -->
                <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-2"></i> Submit</button>
            </form>
        </div>
    </div>

</div>

<script>
    var reservationData = <?php echo json_encode($reservation); ?>;
    $('input[name=tanggal_checkin]').val(ubahFormatTanggal(reservationData.tgl_checkin));
    $('input[name=tanggal_checkout]').val(ubahFormatTanggal(reservationData.tgl_checkout));

    function formatRupiah(angka) {
        var number_string = angka.toString().replace(/[^,\d]/g, ''),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // Tambahkan titik sebagai pemisah ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        // Tambahkan koma untuk pecahan desimal
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;

        return rupiah;
    }

    // Fungsi untuk mengubah nilai input menjadi format mata uang saat input berubah
    $('.uang-input').on('input', function(e) {
        var uang = e.target.value;

        // Hilangkan semua karakter selain angka dan koma
        uang = uang.replace(/[^\d,]/g, '');

        // Ubah format menjadi format mata uang Indonesia
        e.target.value = formatRupiah(uang);
    });

    $(function() {
        $('#datetimepicker2').datetimepicker({
            locale: 'id'
        });
        $('#datetimepicker3').datetimepicker({
            locale: 'id'
        });
    });

    function ubahFormatTanggal(tanggal) {
        var tanggalWaktu = tanggal.split(" ");
        var tanggalPart = tanggalWaktu[0];
        var waktuPart = tanggalWaktu[1];

        // Pisahkan tahun, bulan, dan hari
        var tanggalArr = tanggalPart.split("-");
        var tahun = tanggalArr[0];
        var bulan = tanggalArr[1];
        var hari = tanggalArr[2];

        // Ubah format tanggal menjadi DD/MM/YYYY
        var tanggalBaru = hari + "/" + bulan + "/" + tahun;

        // Pisahkan jam dan menit
        var waktuArr = waktuPart.split(":");
        var jam = waktuArr[0];
        var menit = waktuArr[1];

        // Hapus "00" jika menit adalah "00"
        menit = (menit === "00") ? "" : "." + menit;

        // Gabungkan jam dan menit baru
        var waktuBaru = jam + menit;

        // Gabungkan tanggal dan waktu baru
        var tanggalDanWaktuBaru = tanggalBaru + " " + waktuBaru;

        return tanggalDanWaktuBaru;
    }
</script>
<!-- /.container-fluid -->
<?= $this->endSection() ?>