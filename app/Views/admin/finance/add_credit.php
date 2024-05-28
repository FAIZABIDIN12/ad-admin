<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- Form Tambah Data -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Uang Masuk</h6>
        </div>
        <div class="card-body">
        <form action="/admin/save-credit" method="post">
                    <div class="form-group">
                        <label for="nominal">Nominal</label>
                        <input type="text" class="form-control uang-input" id="nominal" name="nominal" required>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Uraian</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah</button>
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