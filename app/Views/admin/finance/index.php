<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>

<div class="card">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Laporan Keuangan</h6>
    </div>
    <!-- Tambahkan input tanggal -->

    <div class="card-body">

        <!-- Tampilkan total saldo saat ini dari uang masuk -->
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="start_date" class="col col-form-label">Tanngal Awal</label>
                    <div class="">
                        <input type="date" class="form-control" id="start_date">
                    </div>
                </div>
                <div class="form-group">
                    <label for="end_date" class="col-sm-5 col-form-label">Tangal Akhir</label>
                    <div class="">
                        <input type="date" class="form-control" id="end_date">
                    </div>
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-primary btn-block" id="filterBtn">Filter</button>
                </div>
            </div>
        </div>


        <div class="row mt-4">
            <div class="col">
                <button type="button" class="btn btn-primary btn-lg mb-3" data-toggle="modal" data-target="#inputDataModal" style="font-size: 0.7rem;">
                    Tambah Data <i class="fas fa-plus"></i>
                </button>
            </div>
            <div class="col text-right">

                <!-- Tombol untuk download Excel -->
                <button type="button" class="btn btn-success btn-lg mb-3 mr-2" id="downloadExcelBtn" style="font-size: 0.7rem;">
                    Download Excel <i class="fas fa-file-excel"></i>
                </button>
                <!-- Tombol untuk download CSV -->
                <button type="button" class="btn btn-success btn-lg mb-3" id="downloadCsvBtn" style="font-size: 0.7rem;">
                    Download CSV <i class="fas fa-download"></i>
                </button>
            </div>

        </div>

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Waktu</th>
                        <th>Keterangan</th>
                        <th>Jenis</th>
                        <th>Nominal</th>
                        <th>Kategori</th>
                        <th>Front Office</th>
                        <th>Shift</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cashs as $cash) : ?>
                        <tr>
                            <td><?= $cash['tanggal'] ?></td>
                            <td><?= $cash['keterangan'] ?></td>
                            <td><?= $cash['jenis'] == 'cr' ? 'Uang Masuk' : 'Uang Keluar' ?></td>
                            <td><?= number_format($cash['nominal'], 0, ',', '.'); ?></td>
                            <td><?= $cash['kategori'] ?></td>
                            <td>
                                <?php
                                $userModel = new \App\Models\UserModel();
                                $frontOffice = $userModel->find($cash['front_office']);
                                echo $frontOffice ? $frontOffice['nama'] : 'Nama tidak ditemukan';
                                ?>
                            </td>
                            <td class="text-capitalize"><?= $cash['shift'] ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            <h5>Total Saldo Saat ini:Rp. <?= number_format($saldo, 0, ',', '.') ?></h5>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.3/xlsx.full.min.js"></script>
<script>
    $(document).ready(function() {
        var filterFunction = null; // Variabel untuk menyimpan fungsi pencarian tambahan
        $('#dataTable').DataTable({
            responsive: true
        });

        // Filter data berdasarkan tanggal
        $('#filterBtn').on('click', function() {
            var startDate = $('#start_date').val();
            var endDate = $('#end_date').val();

            // Lakukan filter jika kedua tanggal telah dipilih
            if (startDate !== '' && endDate !== '') {
                filterFunction = function(settings, data, dataIndex) {
                    var dataDate = new Date(data[0]); // Kolom pertama adalah tanggal
                    var filterStartDate = new Date(startDate);
                    var filterEndDate = new Date(endDate);

                    // Set waktu ke 00:00:00 untuk memastikan hanya tanggal yang dibandingkan
                    dataDate.setHours(0, 0, 0, 0);
                    filterStartDate.setHours(0, 0, 0, 0);
                    filterEndDate.setHours(0, 0, 0, 0);

                    if (dataDate >= filterStartDate && dataDate <= filterEndDate) {
                        return true;
                    }
                    return false;
                };

                // Tambahkan fungsi pencarian tambahan
                $.fn.dataTable.ext.search.push(filterFunction);

                // Redraw tabel setelah filter diterapkan
                $('#dataTable').DataTable().draw();
            }
        });

        // Handle download Excel
        $('#downloadExcelBtn').on('click', function() {
            var table = $('#dataTable').DataTable();
            var data = [];

            // Cek apakah filter telah diterapkan
            if (filterFunction !== null) {
                // Ambil hanya data yang terfilter
                table.rows().every(function() {
                    if (filterFunction(null, this.data(), this.index())) {
                        data.push(this.data());
                    }
                });
            } else {
                // Jika tidak ada filter, ambil semua data
                data = table.rows().data().toArray();
            }

            // Buat workbook dan tambahkan worksheet
            var ws = XLSX.utils.json_to_sheet(data);
            var wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, "Sheet1");

            // Simpan workbook ke file Excel dan unduh
            XLSX.writeFile(wb, 'data.xlsx');
        });

        // Handle download CSV
        $('#downloadCsvBtn').on('click', function() {
            var table = $('#dataTable').DataTable();
            var data = [];

            // Cek apakah filter telah diterapkan
            if (filterFunction !== null) {
                // Ambil hanya data yang terfilter
                table.rows().every(function() {
                    if (filterFunction(null, this.data(), this.index())) {
                        data.push(this.data());
                    }
                });
            } else {
                // Jika tidak ada filter, ambil semua data
                data = table.rows().data().toArray();
            }

            // Buat header CSV
            var csv = '';
            var header = [];
            table.columns().every(function() {
                header.push(this.header().textContent.trim());
            });
            csv += header.join(',') + '\n';

            // Tambahkan data ke CSV
            data.forEach(function(row) {
                csv += row.join(',') + '\n';
            });

            // Buat elemen <a> untuk mengunduh file CSV
            var csvBlob = new Blob([csv], {
                type: 'text/csv;charset=utf-8;'
            });
            var csvUrl = URL.createObjectURL(csvBlob);
            var link = document.createElement('a');
            link.href = csvUrl;
            link.setAttribute('download', 'data.csv');
            document.body.appendChild(link);
            link.click();

            // Hapus elemen <a> setelah selesai mengunduh
            document.body.removeChild(link);
        });

    });
</script>



<?= $this->endSection() ?>