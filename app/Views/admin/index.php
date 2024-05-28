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

    function sortirTglCheckin($a, $b)
    {
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

    <div class="d-flex justify-content-between mb-2 align-items-center">
        <h5 class="font-weight-bold">Kamar</h5>
        <a href="/admin/history" class="btn btn-secondary btn-sm">History <i class="fas fa-history"></i></a>
    </div>

    <div class="row">
        <?php foreach ($rooms as $key => $room) : ?>
            <?php
            $roomReady = true;
            if ($room['status'] == 'trouble') {
                $roomReady = false;
            }
            ?>
            <?php $roomTaken = false; ?>
            <div class="col-md-2 mb-4">
                <div class="card">
                    <div class="card-header  <?= $roomReady == false ? 'bg-danger' : 'bg-primary' ?> text-white d-flex justify-content-between align-items-center py-2">
                        <h6 class="font-weight-bold card-title mb-0"><i class="fas fa-bed"></i><span class="ml-1"><?= $room['no_kamar'] ?></span></h6>
                        <?php foreach ($checkins as $checkin) : ?>
                            <?php if ($checkin['id_room'] == $room['id']) : ?>
                                <?php $roomTaken = true; ?>
                                <span class="badge badge-danger mb-2">Taken</span>
                            <?php endif ?>
                        <?php endforeach ?>
                        <?= $roomTaken || !$roomReady ? '' : '<span class="badge badge-success mb-1">Ready</span>'; ?>
                        <?= $roomReady == false ? '<span class="badge badge-danger mb-1">Trouble</span>' : '' ?>
                    </div>
                    <div class="p-2">
                        <?php foreach ($checkins as $checkin) : ?>
                            <?php if ($checkin['id_room'] == $room['id']) : ?>
                                <?php $roomTaken = true; ?>
                                <div class="mb-1 text-capitalize">
                                    <?= $checkin['nama'] ?>
                                </div>

                                <button type="button" class="btn btn-danger btn-block checkout-btn btn-sm" data-toggle="modal" data-target="#checkoutConfirm" data-kamar="<?= $room['id'] ?>" data-checkin="<?= $checkin['id'] ?>" style="font-size: 0.7rem;">
                                    Check Out <i class="fas fa-sign-out-alt"></i>
                                </button>
                                <div class="btn-group d-flex mt-2" role="group">
                                    <a href="<?= base_url('admin/printCheckin/' . $checkin['id']) ?>" class="btn btn-primary btn-sm " target="_blank" style="font-size: 0.7rem;">
                                        <i class="fas fa-print"></i>
                                    </a>
                                    <button type="button" class="btn btn-info detail btn-sm" data-toggle="modal" data-target="#detailModal" data-kamar="<?= $room['id'] ?>" style="font-size: 0.7rem;">
                                        <i class="fas fa-info-circle"></i>
                                    </button>
                                </div>
                            <?php endif ?>
                        <?php endforeach ?>
                        <?php if (!$roomTaken) : ?>

                            <div class="btn-group d-flex" role="group">
                                <?php if ($roomReady) : ?>
                                    <button type="button" class="btn btn-primary input-reservation btn-sm" data-toggle="modal" data-target="#inputReservationModal" data-kamar="<?= $room['id'] ?>" style="font-size: 0.7rem;"> <!-- Mengubah ukuran font menjadi 0.7rem -->
                                        Checkin <i class="fas fa-calendar-plus"></i>
                                    </button>
                                <?php else : ?>
                                    <input class="keterangan" data-kamar="<?= $room['id'] ?>" type="hidden" value="<?= $room['keterangan'] ?>" />
                                    <button type="button" class="btn btn-info btn-sm detail-kamar" data-toggle="modal" data-target="#detailKamar" data-kamar="<?= $room['id'] ?>" style="font-size: 0.7rem;"> <!-- Mengubah ukuran font menjadi 0.7rem -->
                                        Detail
                                    </button>
                                <?php endif; ?>
                                <a href="/admin/edit-kamar/<?= $room['id'] ?>" class="btn btn-warning btn-sm ml-auto" style="font-size: 0.7rem;">Edit <i class="fas fa-edit"></i></a>
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
                <h5 class="modal-title font-weight-bold" id="detailModalLabel">Detail Reservasi</h5>
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


<!-- Modal -->
<div class="modal fade" id="checkoutConfirm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Periksa data berikut sebelum check out</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="detail-checkout">

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
                                <?php endforeach; ?>
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
                        <div class="row">

                            <div class="col">
                                <label for="tanggal_checkout">Rencana Check-out:</label>
                                <div class="input-group date" id="datetimepicker3" data-target-input="nearest">
                                    <input type="text" name="checkout_plan" class="form-control datetimepicker-input" data-target="#datetimepicker3" />
                                    <div class="input-group-append" data-target="#datetimepicker3" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="far fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <label for="jumlah_orang">Jumlah Orang</label>
                                <input type="number" class="form-control" id="jumlah_orang" name="jumlah_orang" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="rate">Rate / Hari</label>
                                <input type="text" class="form-control uang-input" id="rate" name="rate" required>
                            </div>
                            <div id="dp-wrap" class="col d-none">
                                <label for="dp">DP</label>
                                <input type="text" class="form-control uang-input" id="dp" value="0" disabled>
                            </div>
                            <div class="col">
                                <label for="tagihan">Tagihan</label>
                                <input type="text" class="form-control uang-input" id="tagihan" disabled>
                            </div>
                            <div class="col sisa">
                                <label for="bayar">Bayar</label>
                                <input type="text" class="form-control uang-input" id="bayar" name="bayar" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">



                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="inputState">Metode Pembayaran</label>
                                <select name="metode_bayar" id="inputState" class="form-control" required>
                                    <option value="" disabled selected>Choose...</option>
                                    <option value="cash">Cash</option>
                                    <option value="transfer">Transfer</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="keterangan">Keterangan</label>
                                <input type="text" class="form-control" id="keterangan" name="keterangan">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-primary">Check-in</button>
                            <button id="reset" type="reset" class="btn btn-warning"><i class="fas fa-sync-alt"></i></button>
                        </div>
                        <div class="col text-right">
                            <div id="kurang-bayar"></div>
                        </div>

                    </div>
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
            var tanggalAwal = $(this).data("tanggal");
            var tanggalBaru = moment(tanggalAwal, 'YYYY-MM-DD HH:mm:ss').locale('id').format('dddd, D MMMM YYYY [Pukul] HH:mm');
            $(this).text(tanggalBaru);
        });

        $(function() {
            $('#datetimepicker3').datetimepicker({
                locale: 'id',
                minDate: moment().add(1, 'days')
            });
        });
        $('.detail-kamar').click(function() {
            var kamarId = $(this).data('kamar');
            var keterangan = $(`input[data-kamar="${kamarId}"].keterangan`).val();
            $('#detail-kamar').html(`<p>Trouble kamar: ${keterangan}</p>`);
        })

        $('#reset').click(function() {
            $('#dp-wrap').addClass('d-none');
            $('#nama').prop('disabled', false);
            $('#no_hp').prop('disabled', false);
            $('.datetimepicker-input').prop('disabled', false);
            $('#jumlah_orang').prop('disabled', false);
            $('#rate').prop('disabled', false);
        })
        $('#order_id option').click(function() {
            var orderId = $(this).data('order');
            if (orderId !== null) {
                $.ajax({
                    url: '/admin/reservation/detail/' + orderId,
                    type: 'GET',
                    success: function(response) {
                        if (response) {
                            $('#dp-wrap').removeClass('d-none');
                            $('#nama').val(response.nama);
                            $('#no_hp').val(response.no_hp);
                            $('#dp').val(formatRupiah(response.bayar));
                            $('.datetimepicker-input').val(ubahFormatTanggal(response.tgl_checkout));
                            $('#jumlah_orang').val(response.jml_orang);
                            $('#rate').val(formatRupiah(response.rate));
                            $('#tagihan').val(formatRupiah(response.kurang_bayar))
                        }
                    },
                    error: function() {
                        alert('Data tidak ditemukan')
                    }
                })
            }

        })

        function ubahFormatTanggal(tanggal) {
            var tanggalWaktu = tanggal.split(" ");
            var tanggalPart = tanggalWaktu[0];
            var waktuPart = tanggalWaktu[1];

            var tanggalArr = tanggalPart.split("-");
            var tahun = tanggalArr[0];
            var bulan = tanggalArr[1];
            var hari = tanggalArr[2];

            var tanggalBaru = hari + "/" + bulan + "/" + tahun;

            var waktuArr = waktuPart.split(":");
            var jam = waktuArr[0];
            var menit = waktuArr[1];

            var waktuBaru = jam + "." + menit;
            var tanggalDanWaktuBaru = tanggalBaru + " " + waktuBaru;

            return tanggalDanWaktuBaru;
        }

        $('.checkout-btn').click(function() {
            var checkinId = $(this).data('checkin');
            var kamarId = $(this).data('kamar');
            $.ajax({
                url: '/admin/detail-checkin/' + kamarId,
                type: 'GET',
                success: function(response) {
                    if (response) {
                        $('#detail-checkout').html(`
                        <table class="table table-borderless">
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td class="text-capitalize">${response.nama}</td>
                            </tr>
                            <tr>
                                <td>No. HP</td>
                                <td>:</td>
                                <td>${response.no_hp}</td>
                            </tr>
                            <tr>
                                <td>Check-in</td>
                                <td>:</td>
                                <td>${response.checkin}</td>
                            </tr>
                            <tr>
                                <td>Rencana Check-out</td>
                                <td>:</td>
                                <td>${response.checkout_plan}</td>
                            </tr>
                            <tr>
                                <td>Status Pelunasan</td>
                                <td>:</td>
                                <td>${response.status_bayar == 'lunas' ? '<span class="badge badge-success">Lunas</span>' : '<span class="badge badge-danger">Belum Lunas</span>'}</td>
                            </tr>
                            <tr>
                                <td>Kurang Bayar</td>
                                <td>:</td>
                                <td>Rp. ${formatRupiah(response.kurang_bayar)}</td>
                            </tr>
                        </table>
                        <div id="modal-footer-checkout" class="modal-footer"></div>
                        <div id="form-lunas"></div>
                    `);

                        if (response.kurang_bayar > 0) {
                            $('#form-lunas').html(`
                                <form action="/admin/pelunasan/${checkinId}" method="post">
                                    <div class="form-group">
                                        <label>Pelunasan</label>
                                        <input id="pelunasan" type="text" class="form-control" name="pelunasan">
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button id="co-dsb" type="submit" class="btn btn-danger" disabled>Check Out</button>
                                    </div>
                                </form>
                            `)
                            $('#pelunasan').on('change keyup', function() {
                                if ($(this).val() == response.kurang_bayar) {
                                    $('#co-dsb').removeAttr('disabled');
                                } else {
                                    $('#co-dsb').attr('disabled', 'disabled');
                                }
                            });

                        } else {
                            $('#modal-footer-checkout').html(`
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <a href="/admin/checkout/${checkinId}" class="btn btn-danger">Check Out</a>
                            `)
                        }
                    } else {
                        $('#detail-checkout').html('<p>Data reservasi tidak ditemukan.</p>');
                    }
                },
                error: function() {
                    $('#detail-checkout').html('<p>Terjadi kesalahan saat mengambil data reservasi.</p>');
                }
            });
        });

        $('.detail').click(function() {
            var kamarId = $(this).data('kamar');
            $.ajax({
                url: '/admin/detail-checkin/' + kamarId,
                type: 'GET',
                success: function(response) {
                    if (response) {
                        $('#detail-reservasi').html(`
                        <table class="table table-borderless">
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td class="text-capitalize">${response.nama}</td>
                            </tr>
                            <tr>
                                <td>No. HP</td>
                                <td>:</td>
                                <td>${response.no_hp}</td>
                            </tr>
                            <tr>
                                <td>Check-in</td>
                                <td>:</td>
                                <td>${response.checkin}</td>
                            </tr>
                            <tr>
                                <td>Rencana Check-out</td>
                                <td>:</td>
                                <td>${response.checkout_plan}</td>
                            </tr>
                            <tr>
                                <td>Status Pelunasan</td>
                                <td>:</td>
                                <td>${response.status_bayar == 'lunas' ? '<span class="badge badge-success">Lunas</span>' : '<span class="badge badge-danger">Belum Lunas</span>'}</td>
                            </tr>
                            <tr>
                                <td>Kurang Bayar</td>
                                <td>:</td>
                                <td>Rp. ${formatRupiah(response.kurang_bayar)}</td>
                            </tr>
                        </table>
                        <div id="form-extend"></div>
                        <div class="modal-footer">
                            <button id="extend" class="btn btn-primary">Extend</button>
                        </div>
                        <div id="tagihan-extend"></div>
                    `);

                        $('#extend').click(function() {
                            $(this).addClass('d-none');
                            $('#form-extend').html(`
                                <form method="post" action="/admin/extend/${response.id}">
                                    <div class="form-group">
                                        <label>Extend Checkout</label>
                                        <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                                            <input id="date-extend" type="text" name="extend_checkout" class="form-control datetimepicker-input" data-target="#datetimepicker4" />
                                            <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="far fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        <input type="hidden" id="input-tagihan-extend" name="tagihan_extend">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-warning">Simpan</button>
                                    </div>
                                    
                                </form>
                            `)
                            $(function() {
                                $('#datetimepicker4').datetimepicker({
                                    locale: 'id',
                                    minDate: response.checkout_plan
                                });
                            });
                            $('#date-extend').on('change input', function() {
                                var selisihHari = calculateDateDifferenceIgnoringTime(response.checkout_plan, $(this).val());
                                $('#tagihan-extend').html(`
                                    <span>Total Tagihan: Rp. ${formatRupiah((response.rate * selisihHari) + parseInt(response.kurang_bayar))}</span>
                                `)
                                $('#input-tagihan-extend').val(formatRupiah((response.rate * selisihHari) + parseInt(response.kurang_bayar)))
                            });
                        })
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
            $('#id_kamar').val(idKamar);
        });

        function calculateTotalCost() {
            var checkoutDate = $('.datetimepicker-input').val();
            var rate = $('#rate').val().replace(/\./g, '');


            if (checkoutDate && rate) {
                var checkinMoment = moment({
                    locale: 'id'
                });
                var checkoutMoment = moment(checkoutDate, 'DD/MM/YYYY HH.mm');

                if (checkoutMoment.isValid()) {
                    var duration = checkoutMoment.diff(checkinMoment, 'days');
                    var totalCost = duration * parseInt(rate);

                    $('#tagihan').val(new Intl.NumberFormat('id-ID').format(totalCost));
                    calculateTotalBayar()
                }
            }


        }

        $('#rate').on('change keyup', calculateTotalCost);

        function calculateTotalBayar() {
            var checkoutDate = $('.datetimepicker-input').val();
            var rate = $('#rate').val().replace(/\./g, ''); // Remove dots from rate

            var bayar = $('#bayar').val().replace(/\./g, ''); // Remove dots from rate

            var dp = $('#dp').val().replace(/\./g, '');

            if (checkoutDate && rate) {
                var checkinMoment = moment({
                    locale: 'id'
                });
                var checkoutMoment = moment(checkoutDate, 'DD/MM/YYYY HH.mm');

                if (checkoutMoment.isValid()) {
                    var duration = checkoutMoment.diff(checkinMoment, 'days');
                    var totalCost = duration * parseInt(rate);

                    var jumlah = totalCost - bayar;

                    $('#kurang-bayar').html("Kurang Bayar: <span class='text-danger font-weight-bold'> Rp. " + new Intl.NumberFormat('id-ID').format(jumlah)) + "</span>";

                    if (dp > 0) {
                        var tagihan = $('#tagihan').val().replace(/\./g, '');
                        var jumlah = tagihan - bayar;

                        $('#kurang-bayar').html("Kurang Bayar: <span class='text-danger font-weight-bold'> Rp. " + new Intl.NumberFormat('id-ID').format(jumlah)) + "</span>";
                    }

                }
            }
        }

        $('#bayar').on('change keyup', calculateTotalBayar);

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

        function parseDate(dateString) {
            let dateParts;
            if (dateString.includes('/')) {
                // Format dd/mm/yyyy hh.mm
                dateParts = dateString.split(' ');
                const [day, month, year] = dateParts[0].split('/');
                const [hour, minute] = dateParts[1].split('.');
                return new Date(year, month - 1, day, hour, minute);
            } else if (dateString.includes('-')) {
                // Format yyyy-mm-dd hh:mm:ss
                return new Date(dateString);
            } else {
                throw new Error('Unsupported date format');
            }
        }

        function calculateDateDifferenceIgnoringTime(dateStr1, dateStr2) {
            const date1 = parseDate(dateStr1);
            const date2 = parseDate(dateStr2);

            // Set both dates to midnight to ignore the time part
            date1.setHours(0, 0, 0, 0);
            date2.setHours(0, 0, 0, 0);

            // Calculate the difference in time (milliseconds)
            const timeDifference = date2 - date1;

            // Convert time difference to days
            const dayDifference = timeDifference / (1000 * 60 * 60 * 24);

            return Math.abs(dayDifference);
        }
    });
</script>
<?= $this->endSection() ?>