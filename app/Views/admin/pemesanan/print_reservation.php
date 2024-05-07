<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Reservasi</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
            text-align: center;
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
    </style>
</head>

<body>
    <div class="container">
        <div class="nota">
            <h2>Nota Reservasi</h2>
            <div class="info">
                <strong>Tanggal Reservasi:</strong> <?= $reservation['tgl'] ?>
            </div>
            <div class="info">
                <strong>Kode Order:</strong> <?= $reservation['kode_order'] ?>
            </div>
            <div class="info">
                <strong>Nama Pemesan:</strong> <?= $reservation['nama'] ?>
            </div>
            <div class="info">
                <strong>Tanggal Check-in:</strong> <?= $reservation['tgl_checkin'] ?>
            </div>
            <div class="info">
                <strong>Tanggal Check-out:</strong> <?= $reservation['tgl_checkout'] ?>
            </div>
            <div class="info">
                <strong>Jumlah Kamar:</strong> <?= $reservation['jml_kamar'] ?>
            </div>
            <div class="info">
                <strong>Rate Harga:</strong> <?= $reservation['rate'] ?>
            </div>
            <div class="info">
                <strong>Di Bayar:</strong> <?= $reservation['bayar'] ?>
            </div>
            <div class="info">
                <strong>Status Pembayaran:</strong> <?= $reservation['status_bayar'] ?>
            </div>
            <div class="info">
                <strong>Front Office:</strong> <?= $reservation['front_office'] ?>
            </div>
            <!-- Tambahkan informasi lain yang diperlukan -->

            <div class="nota-footer">
                <p>Terima kasih telah memilih kami!</p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>