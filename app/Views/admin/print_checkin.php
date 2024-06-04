<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Checkin</title>
    <!-- Bootstrap CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin: 0;
            padding: 10px;
            background-color: #f8f9fa;
        }

        .nota {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 0 auto;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .info {
            margin-bottom: 15px;
        }

        .info strong {
            font-weight: bold;
        }

        .nota-footer {
            margin-top: 30px;
            text-align: center;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>
<?php
function formatRupiah($angka, $prefix = "Rp ")
{
    $angka = (int)$angka;
    $formatted = number_format($angka, 0, ',', '.');
    return $prefix . $formatted;
}

function calculateDateDifference($startDate, $endDate)
{
    $start = new \DateTime($startDate);
    $start->setTime(0, 0, 0);

    $end = new \DateTime($endDate);
    $end->setTime(0, 0, 0);

    $interval = $start->diff($end);
    return $interval->days;
}

$jmlHari = calculateDateDifference($checkin['checkin'], $checkin['checkout_plan']);
$tagihan = $checkin['rate'] * $jmlHari;

?>

<body>
    <div class="container">
        <div class="nota">
            <div class="text-center">
                <img class="mb-3" src="<?= base_url('img/logo-asri.png') ?>" height="50">
                <!-- <h2 class="text-center">Nota Checkin</h2> -->
                <p>Jl. Veteran No.184 A, Pandeyan, Kec. Umbulharjo, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55161</p>
                <hr>
            </div>

            <table class="table table-borderless">
                <tr>
                    <td><strong>Kode Order</strong></td>
                    <td>:</td>
                    <td><?= $checkin['kode_order'] ?></td>
                </tr>
                <tr>
                    <td><strong>Nama</strong></td>
                    <td>:</td>
                    <td><?= $checkin['nama'] ?></td>
                </tr>
                <tr>
                    <td><strong>No. Kamar</strong></td>
                    <td>:</td>
                    <td><?= $checkin['id_room'] ?></td>
                </tr>
                <tr>
                    <td><strong>Tanggal Check-in</strong></td>
                    <td>:</td>
                    <td><?= $checkin['checkin'] ?></td>
                </tr>
                <tr>
                    <td><strong>Tanggal Check-out</strong></td>
                    <td>:</td>
                    <td><?= $checkin['checkout_plan'] ?></td>
                </tr>
                <tr>
                    <td><strong>Harga</strong></td>
                    <td>:</td>
                    <td><?= formatRupiah($tagihan) ?></td>
                </tr>
                <tr>
                    <td><strong>Bayar</strong></td>
                    <td>:</td>
                    <td><?= formatRupiah($checkin['bayar']) ?></td>
                </tr>
                <?php if ($checkin['kurang_bayar'] > 0) : ?>
                    <tr>
                        <td><strong>Kurang Bayar</strong></td>
                        <td>:</td>
                        <td><?= formatRupiah($checkin['kurang_bayar']) ?></td>
                    </tr>
                <?php endif; ?>
            </table>
            <hr>
            <div class="d-flex flex-column gap-3 align-items-end">
                <div>
                    Front Office
                </div>
                <div>
                    <?php
                    $userModel = new \App\Models\UserModel();
                    $frontOffice = $userModel->where('id', $checkin['front_office'])->first();
                    echo $frontOffice ? $frontOffice['nama'] : 'Unknown';
                    ?>
                </div>

            </div>
            <div class="nota-footer">
                <p><strong>Terima kasih telah memilih kami!</strong></p>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>