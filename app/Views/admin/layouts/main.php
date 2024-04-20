<!-- app/Views/layouts/main.php -->
<!DOCTYPE html>
<html lang="en">


<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

<title><?= isset($title) ? $title . ' - ' : '' ?>Asri Graha Admin</title>

<!-- Custom fonts for this template-->
<!-- Menggunakan base URL untuk stylesheet dari CDN Bootstrap -->
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<!-- Menggunakan base URL untuk stylesheet Font Awesome -->
<link href="<?= base_url('vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
<!-- Menggunakan base URL untuk font dari Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<!-- Menggunakan base URL untuk stylesheet kustom -->
<link href="<?= base_url('css/sb-admin-2.min.css') ?>" rel="stylesheet">
<!-- Menggunakan base URL untuk jQuery -->
<script src="<?= base_url('vendor/jquery/jquery.min.js') ?>"></script>
</head>


<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?= $this->include('admin/layouts/sidebar') ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <?= $this->include('admin/layouts/navbar') ?>
                <div class="container-fluid">
                    <?= $this->renderSection('content') ?>
                </div>
            </div>


            <!-- Footer -->
            <?= $this->include('admin/layouts/footer') ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="/Auth/login">Logout</a>
                </div>
            </div>
        </div>
    </div>

<!-- Menggunakan base URL untuk Bootstrap JavaScript -->
<script src="<?= base_url('vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

<!-- Menggunakan base URL untuk plugin jQuery Easing -->
<script src="<?= base_url('vendor/jquery-easing/jquery.easing.min.js') ?>"></script>

<!-- Menggunakan base URL untuk custom scripts -->
<script src="<?= base_url('js/sb-admin-2.min.js') ?>"></script>

</body>
</html>