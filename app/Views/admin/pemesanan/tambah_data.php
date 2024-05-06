<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- Form Tambah Data -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Reservasi</h6>
        </div>
        <div class="card-body">
            <form action="/admin/pemesanan/tambah" method="post">
                <div class="form-row">
                    <div class="form-group col">
                        <label for="nama_pemesan">Nama Pemesan:</label>
                        <input type="text" class="form-control" id="nama_pemesan" name="nama_pemesan" placeholder="Masukkan nama pemesan" required>
                    </div>
                    <div class="form-group col">
                        <label for="no_hp">No. Hp:</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="Masukkan No. HP" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="tanggal_checkin">Rencana Check-in:</label>
                        <div class="input-group date" id="datetimepicker2" data-target-input="nearest">
                            <input type="text" name="tanggal_checkin" class="form-control datetimepicker-input" data-target="#datetimepicker2" placeholder="Tanggal dan waktu checkin"/>
                            <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="far fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="tanggal_checkout">Rencana Check-out:</label>
                        <div class="input-group date" id="datetimepicker3" data-target-input="nearest">
                            <input type="text" name="tanggal_checkout" class="form-control datetimepicker-input" data-target="#datetimepicker3" placeholder="Tanggal dan waktu checkout"/>
                            <div class="input-group-append" data-target="#datetimepicker3" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="far fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="jumlah_kamar">Jumlah Kamar:</label>
                        <input type="number" class="form-control" id="jumlah_kamar" name="jumlah_kamar" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="jumlah_orang">Jumlah Orang:</label>
                        <input type="number" class="form-control" id="jumlah_orang" name="jumlah_orang" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="metode_pembayaran">Metode Pembayaran</label>
                        <select class="form-control" id="metode_pembayaran" name="metode_bayar" required>
                            <option value="cash">Cash</option>
                            <option value="bca">Transfer BCA</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" name="keterangan" class="form-control" placeholder="Keterangan">
                    </div>
                </div>
                <div class="form-group">

                </div>
                <div class="form-row">
                <div class="form-group col">
                        <label for="rate">Rate:</label>
                        <input id="rate" type="text" name="rate" class="form-control uang-input" placeholder="Harga">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="status_pembayaran">Pembayaran:</label>
                        <select class="form-control" id="status_pembayaran" name="status_bayar" required>
                            <option value="belum_lunas">Deposit</option>
                            <option value="lunas">Lunas</option>
                        </select>
                    </div>
 
                    <div class="form-group col">
                        <label for="bayar">Total Bayar:</label>
                        <input id="bayar" type="text" name="bayar" class="form-control uang-input" placeholder="Bayar">
                    </div>
                </div>



                <div class="form-group">
                    <label for="status_pemesanan">Status Pemesanan:</label>
                    <select class="form-control" id="status_pemesanan" name="status_order" required>
                        <option value="book">BOOKING</option>
                        <option value="checkin">CHECKIN</option>
                        <option value="done">DONE</option>
                        <option value="cancel">BATAL</option>
                    </select>
                </div>
                <!-- Tambahkan input untuk data lainnya seperti tanggal checkout, jumlah orang, jumlah kamar, harga, dll. -->
                <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-2"></i> Submit</button>
            </form>
        </div>
    </div>

</div>

<script>
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

        $(function () {
            $('#datetimepicker2').datetimepicker({
                locale: 'id'
            });
            $('#datetimepicker3').datetimepicker({
                locale: 'id'
            });
        });
</script>
<!-- /.container-fluid -->
<?= $this->endSection() ?>