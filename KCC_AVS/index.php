<?php
session_start();
include 'db_connection.php';
$page = isset($_GET["page"]) ? $_GET["page"] : "dashboard";
$user_id = $_SESSION['user_id'];
if (!isset($_SESSION['user_id'])) {
    header('Location:../KCC_AVS/pages/login_form.php');
}
$selected_comp = $_SESSION['selected_comp'] ?? '';
$selected_site = $_SESSION['selected_site'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Dashboard</title>
    <!-- =======================
     CSS
======================= -->

    <!-- Bootstrap 5 -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- DataTables Bootstrap 5 -->
    <link rel="stylesheet"
        href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <!-- DataTables Buttons -->
    <link rel="stylesheet"
        href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">

    <!-- Select2 -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">


    <!-- =======================
     JS
======================= -->

    <!-- jQuery (MUST be first) -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables Core -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <!-- DataTables Bootstrap 5 -->
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <!-- DataTables Buttons -->
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <style>
        :root {
            --primary-color: #0B2D5F;
            /* deep blue */
            --secondary-color: #0B2D5F;
            /* same for gradient */
            --sidebar-width: 250px;
            --sidebar-collapsed-width: 70px;
            --header-height: 70px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #ffffff;
            overflow-x: hidden;
            color: #0B2D5F;
        }

        /* Sidebar */
        #sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            background: linear-gradient(180deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            transition: all 0.3s ease;
            box-shadow: 3px 0 10px rgba(0, 0, 0, 0.1);
        }

        #sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        #sidebar .sidebar-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px;
            height: var(--header-height);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        #sidebar .sidebar-header h3 {
            font-size: 1.5rem;
            white-space: nowrap;
            overflow: hidden;
        }

        #sidebar.collapsed .sidebar-header h3 {
            display: none;
        }

        #sidebarToggle {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            border-radius: 5px;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
        }

        #sidebarToggle:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        #sidebar.collapsed #sidebarToggle i {
            transform: rotate(180deg);
        }

        .sidebar-menu {
            padding: 20px 0;
            list-style: none;
        }

        .sidebar-menu li {
            margin-bottom: 5px;
        }

        .sidebar-menu a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            padding: 12px 15px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            transition: all 0.3s;
            white-space: nowrap;
            overflow: hidden;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: rgba(255, 255, 255, 0.2);
            color: #ffffff;
        }

        .sidebar-menu i {
            width: 30px;
            min-width: 30px;
            font-size: 1.2rem;
        }

        .menu-text {
            margin-left: 10px;
            transition: opacity 0.3s;
        }

        #sidebar.collapsed .menu-text {
            opacity: 0;
            width: 0;
        }

        /* Main content */
        #mainContent {
            margin-left: var(--sidebar-width);
            transition: all 0.3s ease;
            padding-top: var(--header-height);
        }

        #mainContent.expanded {
            margin-left: var(--sidebar-collapsed-width);
        }

        /* Header */
        #mainHeader {
            position: fixed;
            top: 0;
            left: var(--sidebar-width);
            right: 0;
            height: var(--header-height);
            background: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 15px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: all 0.3s ease;
            z-index: 999;
        }

        #mainHeader.expanded {
            left: var(--sidebar-collapsed-width);
        }

        .header-title h1 {
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--primary-color);
            margin: 0;
        }

        .header-filters {
            display: flex;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .filter-group {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .filter-label {
            font-weight: 500;
            color: var(--primary-color);
            white-space: nowrap;
        }

        .filter-select {
            border-radius: 8px;
            border: 1px solid #0B2D5F;
            padding: 8px 12px;
            background: #ffffff;
            color: var(--primary-color);
            min-width: 140px;
        }

        /* Body */
        .main-body {
            padding: 25px;
        }

        .dashboard-card {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            padding: 25px;
            margin-bottom: 25px;
            height: 100%;
        }

        .dashboard-card h3 {
            color: var(--primary-color);
            margin-bottom: 20px;
            font-weight: 600;
        }

        .card-icon {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            background: rgba(11, 45, 95, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
        }

        .card-icon i {
            font-size: 1.8rem;
            color: var(--primary-color);
        }

        .stats-number {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .stats-label {
            color: #0B2D5F;
            font-size: 0.95rem;
        }

        /* Responsive */
        @media (max-width: 992px) {
            #sidebar {
                left: -100%;
            }

            #sidebar.mobile-open {
                left: 0;
            }

            #mainContent {
                margin-left: 0;
            }

            #mainHeader {
                left: 0;
            }
        }

        @media (max-width: 768px) {
            .filter-select {
                flex-grow: 1;
            }

            .main-body {
                padding: 15px;
            }

            .dashboard-card {
                padding: 20px;
            }
        }

        @media (max-width: 576px) {
            .header-title h1 {
                font-size: 1.5rem;
            }

            .stats-number {
                font-size: 1.8rem;
            }
        }

        img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            cursor: pointer;
        }

        img:hover {
            opacity: 0.8;
        }

        .preview-image {
            width: auto;
            height: auto;
            max-width: 100vw;
            max-height: 100vh;
            object-fit: contain;
            transition: transform 0.2s ease;
            transform-origin: center center;
            cursor: grab;
        }

        .modal-content {
            background: transparent;
        }
    </style>
</head>


<div class="modal fade" id="customerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 rounded-4 shadow">

            <!-- HEADER -->
            <div class="modal-header bg-primary text-white rounded-top-4">
                <div>
                    <h5 class="modal-title mb-0" id="customerName">Account Name</h5>
                    <h6 class="modal-title mb-0" id="customerId">Account Name</h6>
                    <small id="accountType" class="badge bg-light text-dark mt-1">
                        Account Type
                    </small>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <!-- BODY -->
            <div class="modal-body">

                <!-- IMAGES -->
                <div class="row g-3 mb-3">
                    <div class="col-md-6 text-center">
                        <img id="img1" class="img-fluid rounded shadow-sm img-thumb" data-bs-toggle="modal"
                            data-bs-target="#imageModal"
                            style="max-height:220px;object-fit:cover;"
                            src="" alt="Image 1">
                    </div>
                    <div class="col-md-6 text-center">
                        <img id="img2" class="img-fluid rounded shadow-sm img-thumb" data-bs-toggle="modal"
                            data-bs-target="#imageModal"
                            style="max-height:220px;object-fit:cover;"
                            src="" alt="Image 2">
                    </div>
                </div>

                <!-- DETAILS -->
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <strong>Ads Type:</strong>
                        <div id="adsType" class="text-muted">—</div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <strong>Ads Specific:</strong>
                        <div id="adsSpecific" class="text-muted">—</div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <strong>Category:</strong>
                        <div id="accountCategory" class="text-muted">—</div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <strong>Status:</strong>
                        <div>
                            <span id="accountStatus" class="badge bg-success">
                                Active
                            </span>
                        </div>
                    </div>
                </div>

                <!-- ADDRESS -->
                <div class="mt-3">
                    <strong>Address:</strong>
                    <p id="accountAddress" class="text-muted mb-0">
                        —
                    </p>
                </div>

            </div>

            <!-- FOOTER -->
            <div class="modal-footer justify-content-between">
                <button class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button class="btn btn-primary">
                    Navigate
                </button>
            </div>

        </div>
    </div>
</div>


<!-- Image Preview Modal -->
<div class="modal fade" id="imageModal" tabindex="-1">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content bg-dark">

            <!-- Toolbar -->
            <div class="position-absolute top-0 end-0 p-3 d-flex gap-2 z-3">
                <button id="zoomIn" class="btn btn-sm btn-light">+</button>
                <button id="zoomOut" class="btn btn-sm btn-light">−</button>
                <a id="downloadImage" class="btn btn-sm btn-success" download>Download</a>
                <button class="btn btn-sm btn-danger" id="btn_img_close">✕</button>
            </div>

            <!-- Image -->
            <div class="modal-body d-flex justify-content-center align-items-center p-0">
                <img id="modalImage" class="preview-image" alt="Preview">
            </div>

        </div>
    </div>
</div>


<body>

    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3><i class="fas fa-chart-line me-2"></i> KCC AVS</h3>
            <button id="sidebarToggle"><i class="fas fas fa-bars"></i></button>
        </div>
        <ul class="sidebar-menu">

            <li><a href="index.php" class="<?= ($page == "dashboard") ? "active" : "" ?>"> <i class="fas fa-home"></i><span class="menu-text">Dashboard</span></a></li>
            <li><a href="index.php?page=account_monitoring" class="<?= ($page == "account_monitoring" || $page == "account_monitoring_map") ? "active" : "" ?>"><i class="fas fa-building "></i><span class="menu-text">Account's Monitoring</span></a></li>
            <li><a href="index.php?page=user_dash" class="<?= ($page == "user_trip") || ($page == "user_dash") ? "active" : "" ?>"><i class="fas fa-building "></i><span class="menu-text">Users's Trip</span></a></li>

            <!-- <li><a href="#"><i class="fas fa-chart-bar"></i><span class="menu-text">Analytics</span></a></li> -->
            <?php if ($_SESSION['role'] == 'Admin'): ?>
                <li><a href="index.php?page=user" class="<?= ($page == "user") ? "active" : "" ?>"><i class="fas fa-users"></i><span class="menu-text">Users</span></a></li>
            <?php endif; ?>
            <!-- <li><a href="#"><i class="fas fa-cog"></i><span class="menu-text">Profile</span></a></li> -->
            <li><a href="query/logout.php"><i class="fas fa-cog"></i><span class="menu-text">Logout</span></a></li>
        </ul>
    </nav>

    <!-- Main Content -->
    <div id="mainContent">
        <header id="mainHeader">
            <button id="mobileMenuToggle" class="btn btn-outline-primary d-lg-none me-3"><i class="fas fa-bars"></i></button>
            <div class="header-title">
                <h6>Welcome, <?= $_SESSION['fullname'] ?></h6>
            </div>
            <div class="header-filters">
                <div class="row g-2 align-items-center">
                    <div class="col-md-auto">
                        <select id="companyFilter" class="form-select">
                            <option value="">Select Company</option>
                            <?php
                            $comp_list = $conn->query("SELECT COMPANY_ID,CODE FROM [dbo].[KAVS_COMP_MAPPING] C JOIN [dbo].[KAVS_COMPANY] KV 
                           ON C.COMPANY_ID=KV.COMP_ID AND C.STATUS =1 AND KV.STATUS=1 AND ACCOUNT_ID='" . $user_id . "'");
                            while ($row = $comp_list->fetch(PDO::FETCH_ASSOC)) {
                                $selected_comp_attr = ($row['COMPANY_ID'] == $selected_comp) ? 'selected' : '';
                            ?>
                                <option value="<?= $row['COMPANY_ID'] ?>" <?= $selected_comp_attr ?>><?= $row['CODE'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-auto">
                        <select id="siteFilter" class="form-select">
                            <option value="all">All Sites</option>
                            <?php
                            $comp_list = $conn->query("SELECT C.SITE_ID,CODE FROM [dbo].[KAVS_SITE_MAPPING] C JOIN [dbo].[KAVS_SITE] KV 
                           ON C.SITE_ID=KV.SITE_ID AND C.STATUS =1 AND KV.STATUS=1 AND ACCOUNT_ID='" . $user_id . "'");
                            while ($row = $comp_list->fetch(PDO::FETCH_ASSOC)) {
                                $selected_site_attr = ($row['SITE_ID'] == $selected_site) ? 'selected' : '';
                            ?>
                                <option value="<?= $row['SITE_ID'] ?>" <?= $selected_site_attr ?>><?= $row['CODE'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>

                </div>
            </div>
        </header>

        <div class="main-body">
            <?php
            $pge =  $page . ".php";
            if (file_exists("pages/" . $pge)) {
                include "pages/" . $pge;
            } else {
                echo '<div class="alert alert-danger">Page not found: ' . htmlspecialchars($pge) . '</div>';
            }
            ?>
        </div>
    </div>


</body>

</html>

<script>
    $(document).ready(function() {
        let scale = 1;

        $(document).on('click', '.img-thumb', function() {

            const imgSrc = $(this).attr('src');

            scale = 1; // reset zoom

            $('#modalImage')
                .attr('src', imgSrc)
                .css({
                    transform: 'scale(1)',
                    maxWidth: '100vw',
                    maxHeight: '100vh'
                });

            $('#downloadImage').attr('href', imgSrc);
        });

        $('#zoomIn').on('click', function() {
            scale += 0.2;
            $('#modalImage').css('transform', `scale(${scale})`);
        });

        $('#zoomOut').on('click', function() {
            if (scale > 0.6) {
                scale -= 0.2;
                $('#modalImage').css('transform', `scale(${scale})`);
            }
        });

        $('#modalImage').on('wheel', function(e) {
            e.preventDefault();
            scale += e.originalEvent.deltaY < 0 ? 0.1 : -0.1;
            scale = Math.max(scale, 0.6);
            $(this).css('transform', `scale(${scale})`);
        });
        // Desktop Sidebar Toggle
        $('#sidebarToggle').click(function() {
            $('#sidebar').toggleClass('collapsed');
            $('#mainContent').toggleClass('expanded');
            $('#mainHeader').toggleClass('expanded');
            $(this).find('i').toggleClass('fa-chevron-left fa-chevron-right');
        });
        $("#btn_img_close").click(function() {
            $('#imageModal').modal('hide');
        });
        // Mobile Sidebar Toggle
        $('#mobileMenuToggle').click(function() {
            $('#sidebar').toggleClass('mobile-open');
        });

        // Close mobile sidebar when clicking outside
        $(document).click(function(e) {
            if ($(window).width() <= 992 && !$(e.target).closest('#sidebar,#mobileMenuToggle').length) {
                $('#sidebar').removeClass('mobile-open');
            }
        });

        $("#companyFilter").change(function() {
            var select = $(this);
            var company_id = $(this).val();
            select.attr("disabled", true);
            $.ajax({
                url: 'query/select_comp.php',
                type: 'POST',
                data: {
                    company_id: company_id
                },
                success: function(response) {
                    select.attr("disabled", false);
                },
                error: function(xhr, status, error) {
                    select.attr("disabled", true);
                    alert("An error occurred: " + error);
                }
            });
        });
        $("#siteFilter").change(function() {
            var select = $(this);
            var site_id = $(this).val();
            select.attr("disabled", true);
            $.ajax({
                url: 'query/select_site.php',
                type: 'POST',
                data: {
                    site_id: site_id
                },
                success: function(response) {
                    alert(response);
                    select.attr("disabled", false);
                    location.reload();
                },
                error: function(xhr, status, error) {
                    select.attr("disabled", false);
                    alert("An error occurred: " + error);
                }
            });
        });

    });
</script>