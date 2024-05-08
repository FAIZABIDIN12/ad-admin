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
        <h4 class="font-weight-bold" id="date-now"></h4>
    <?php
    // Ambil instance dari ReservationModel
    // Ambil data reservasi yang akan datang
    $reservationModel = new \App\Models\ReservationModel();
    
    // Ambil data reservasi yang akan datang
    $upcomingReservations = $reservationModel->getUpcomingReservations();
    
    function sortirTglCheckin($a, $b) {
        return strtotime($a['tgl_checkin']) - strtotime($b['tgl_checkin']);
    }
    
    // Melakukan penyortiran
    usort($upcomingReservations, 'sortirTglCheckin');

    $jumlah = count($upcomingReservations);

    // Tampilkan reminder jika ada reservasi yang akan datang dalam 3 hari
    if (!empty($upcomingReservations)) {
        echo '<div class="alert alert-warning" role="alert">';
        echo '<strong>Ada ' . $jumlah . ' Data Reservasi untuk 3 hari ke depan.</strong>';
        echo '<ul>';
        foreach ($upcomingReservations as $reservation) {
            $status = ($reservation['status_bayar'] == "belum_lunas") ? 'Belum Lunas' : "Lunas";
            echo '<li>';
            echo '<span class="tanggal" data-tanggal="' . $reservation['tgl_checkin'] . '"></span>' . ' | Kode Reservasi: ' . $reservation['kode_order'] . ' | Nama: ' . $reservation['nama']    . ' | Status Pembayaran: ' . $status;
            echo '</li>';
        }
        echo '</ul>';
        echo '</div>';
    }
    ?>

    <!-- Dashboard Title -->
    <div class="d-flex justify-content-between mb-2 align-items-center"> <!-- Mengurangi margin menjadi mb-2 -->
        <h5 class="font-weight-bold">Kamar</h5> <!-- Mengubah ukuran font menjadi 1.5rem -->
        <a href="/admin/history" class="btn btn-secondary btn-sm">History <i class="fas fa-history"></i></a> <!-- Mengubah tombol menjadi kecil dengan menambahkan kelas btn-sm -->
    </div>
    <!-- Daftar Kamar -->
    <div class="row">
        <?php foreach ($rooms as $key => $room) : ?>
            <?php
                $roomReady = true;
                if($room['status'] == 'trouble') {
                    $roomReady = false;
                }
            ?>
            <?php $roomTaken = false; ?> 
            <div class="col-md-2 mb-4"> 
                <div class="card"> 
                    <div class="card-header  <?= $roomReady == false ? 'bg-danger' : 'bg-primary' ?> text-white d-flex justify-content-between align-items-center py-2"> <!-- Mengurangi padding secara vertikal dengan py-2 -->
                        <h6 class="font-weight-bold card-title mb-0"><i class="fas fa-bed"></i><span class="ml-1"><?= $room['no_kamar'] ?></span></h6> <!-- Mengubah ukuran font menjadi 0.9rem -->
                        <?php foreach ($checkins as $checkin) : ?>
                            <?php if ($checkin['id_room'] == $room['id']) : ?>
                                <?php $roomTaken = true; ?>
                                <span class="badge badge-danger mb-2">Taken</span> <!-- Menambahkan margin kiri dengan ml-2 -->
                            <?php endif ?>
                        <?php endforeach ?>
                        <?= $roomTaken || !$roomReady ? '' : '<span class="badge badge-success mb-1">Ready</span>'; ?>
                        <?= $roomReady == false ? '<span class="badge badge-danger mb-1">Trouble</span>' : '' ?>
                    </div>
                    <div class="p-2"> <!-- Mengurangi padding secara vertikal dengan py-2 -->
                        <?php foreach ($checkins as $checkin) : ?>
                            <?php if ($checkin['id_room'] == $room['id']) : ?>
                                <?php $roomTaken = true; ?>
                                <div class="mb-1 text-capitalize">
                                    <?= $checkin['nama'] ?> <!-- Menampilkan nama -->
                                </div>
                                <a href="/admin/checkout/<?= $checkin['id'] ?>" type="button" class="btn btn-danger input-reservation btn btn-sm btn-block" style="font-size: 0.7rem;">
                                    Check Out <i class="fas fa-sign-out-alt"></i>
                                </a>
                                <div class="btn-group d-flex mt-2" role="group">
                                    <a href="<?= base_url('admin/printCheckin/' . $checkin['id']) ?>" class="btn btn-primary btn-sm " target="_blank" style="font-size: 0.7rem;">
                                        <i class="fas fa-print"></i>
                                    </a>
                                    <button type="button" class="btn btn-info detail btn-sm" data-toggle="modal" data-target="#detailModal" data-kamar="<?= $room['id'] ?>" style="font-size: 0.7rem;"> <!-- Mengubah ukuran font menjadi 0.7rem -->
                                       <i class="fas fa-info-circle"></i>
                                    </button>
                                    <!-- Tambahan tombol untuk mencetak nota -->
                                </div>
                            <?php endif ?>
                        <?php endforeach ?>
                        <?php if (!$roomTaken) : ?>

                            <div class="btn-group d-flex" role="group">
                                <?php if($roomReady) : ?>
                                    <button type="button" class="btn btn-primary input-reservation btn-sm" data-toggle="modal" data-target="#inputReservationModal" data-kamar="<?= $room['id'] ?>" style="font-size: 0.7rem;"> <!-- Mengubah ukuran font menjadi 0.7rem -->
                                        Checkin <i class="fas fa-calendar-plus"></i>
                                    </button>
                                <?php else: ?>
                                    <input class="keterangan" data-kamar="<?= $room['id'] ?>" type="hidden" value="<?= $room['keterangan'] ?>" />
                                    <button type="button" class="btn btn-info btn-sm detail-kamar" data-toggle="modal" data-target="#detailKamar" data-kamar="<?= $room['id'] ?>" style="font-size: 0.7rem;"> <!-- Mengubah ukuran font menjadi 0.7rem -->
                                        Detail
                                    </button>
                                <?php endif; ?>
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
<div class="modal fade" id="detailKamar" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Trouble Kamar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="detail-kamar">
               
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
                    <?php if ($reservations) : ?>
                    <div class="form-group">
                        <label for="order_id">Kode Order (Jika sudah resevasi)</label>
                        <select name="kode_order" id="order_id" class="form-control">
                            
                                <option value="" data-order="null" selected>Choose...</option>

                                <?php foreach ($reservations as $reservation) : ?>
                                    <option value="<?= $reservation['kode_order'] ?>" data-order="<?= $reservation['id'] ?>"><?= $reservation['kode_order'] ?> - <?= $reservation['nama'] ?></option>
                                <?php endforeach;?>
                        </select>
                    </div>
                    <?php endif; ?>
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
                        <label for="tanggal_checkout">Rencana Check-out:</label>
                        <div class="input-group date" id="datetimepicker3" data-target-input="nearest">
                            <input type="text" name="checkout_plan" class="form-control datetimepicker-input" data-target="#datetimepicker3" />
                            <div class="input-group-append" data-target="#datetimepicker3" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="far fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_orang">Jumlah Orang</label>
                        <input type="number" class="form-control" id="jumlah_orang" name="jumlah_orang" required>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="rate">Rate</label>
                                <input type="text" class="form-control uang-input" id="rate" name="rate" required>
                            </div>
                            <div class="col sisa d-none">
                                <label for="kurang-bayar">Kurang bayar</label>
                                <input type="text" class="form-control uang-input" id="kurang-bayar">
                            </div>
                            <div class="col sisa">
                                <label for="bayar">Bayar</label>
                                <input type="text" class="form-control uang-input" id="bayar" name="bayar" required>
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
                    <button type="reset" class="btn btn-warning"><i class="fas fa-sync-alt"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        var currentDate = moment().locale('id').format('dddd, D MMMM YYYY');
        $("#date-now").text(currentDate);
        
        $(".tanggal").each(function() {
            // Ambil tanggal dari atribut data-tanggal
            var tanggalAwal = $(this).data("tanggal");
            
            // Ubah format tanggal menggunakan Moment.js
            var tanggalBaru = moment(tanggalAwal, 'YYYY-MM-DD HH:mm:ss').locale('id').format('dddd, D MMMM YYYY [Pukul] HH:mm');
            
            // Masukkan tanggal baru ke dalam elemen
            $(this).text(tanggalBaru);
        });
        $(function() {
            $('#datetimepicker3').datetimepicker({
                locale: 'id'
            });
        });
        $('.detail-kamar').click(function() {
            var kamarId = $(this).data('kamar');
            var keterangan = $(`input[data-kamar="${kamarId}"].keterangan`).val();
            $('#detail-kamar').html(`<p>Trouble kamar: ${keterangan}</p>`);
        })
        $('#order_id option').click(function() {
            var orderId = $(this).data('order');
            if(orderId !== null) {
                $.ajax({
                url: '/admin/pemesanan/detail/' + orderId,
                type: 'GET',
                success: function(response) {
                    if(response) {
                        $('.sisa').removeClass('d-none');
                        $('#nama').val(response.nama);
                        $('#no_hp').val(response.no_hp);
                        $('.datetimepicker-input').val(ubahFormatTanggal(response.tgl_checkout));
                        $('#jumlah_orang').val(response.jml_orang);
                        $('#rate').val(formatRupiah(response.rate));
                        $('#kurang-bayar').val(formatRupiah(response.rate-response.bayar))
                    }
                },
                error: function(){
                    alert('Data tidak ditemukan')
                }
            })
            }
            
        })

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
    });
</script>
<?= $this->endSection() ?>