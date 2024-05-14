<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>

<!-- Form Filter -->
<form id="filterForm">
    <div class="form-group">
        <label for="bulan">Pilih Bulan</label>
        <select name="bulan" id="bulan" class="form-control">
            <option value="01">Januari</option>
            <option value="02">Februari</option>
            <option value="03">Maret</option>
            <!-- Tambahkan opsi bulan lainnya -->
        </select>
    </div>
    <div class="form-group">
        <label for="tahun">Pilih Tahun</label>
        <input type="text" name="tahun" id="laporan" class="form-control" value="<?= date('Y') ?>">
    </div>
    <!-- Hapus tombol filter -->
</form>

<!-- Tabel Laporan -->
<div class="card">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Report Bulanan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="laporanTable">
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

<!-- Script JavaScript -->
<script>
    // Fungsi untuk mengirim permintaan filter dan memperbarui tabel laporan
    function filterLaporan() {
        var formData = $('#filterForm').serialize();
        $.ajax({
            url: '<?= site_url('admin/report/filterByMonth') ?>',
            method: 'POST',
            data: formData,
            success: function(response) {
                $('#laporanTable').html(response);
            }
        });
    }

    // Saat dokumen siap, tambahkan event listener untuk perubahan pada pilihan bulan dan tahun
    $(document).ready(function() {
        $('#bulan, #tahun').change(filterLaporan);

        // Panggil fungsi filterLaporan() untuk pertama kali saat halaman dimuat
        filterLaporan();
    });
</script>


<?= $this->endSection() ?>