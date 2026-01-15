<?php
session_start();
include 'query/user_login.php';
$page_main = $_SESSION['page_main'] ?? '';
if (!isset($_SESSION['user_id'])) {
    header('Location:../pqr_test/pages/login_form.php');
}
$selected_comp = $_SESSION['comp_id'] ?? '';
$selected_site = $_SESSION['ses_site'] ?? '';
$selected_guideline = $_SESSION['guideline_id'] ?? '';
$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';
$user_id = isset($_SESSION['id']) ? $_SESSION['id'] : '0';
$condition = ($role != 'Admin') ? " AND USER_ID=$user_id" : "";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PQR Incentive System v1</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Chart.js Data Labels plugin -->
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
    <!-- Icons & Fonts -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Libraries -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        :root {
            --primary: #4361ee;
            --primary-dark: #3a56d4;
            --secondary: #6c757d;
            --success: #28a745;
            --danger: #dc3545;
            --warning: #ffc107;
            --info: #17a2b8;
            --light: #f8f9fa;
            --dark: #212529;
            --sidebar-bg: #1a1d29;
            --sidebar-hover: #2d3246;
            --content-bg: #f5f7fb;
            --card-bg: #ffffff;
            --text-primary: #2c3e50;
            --text-secondary: #6c757d;
            --border: #e9ecef;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--content-bg);
            color: var(--text-primary);
            line-height: 1.6;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 280px;
            background: var(--sidebar-bg);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1000;
            overflow-y: auto;
            box-shadow: 2px 0 20px rgba(0, 0, 0, 0.1);
        }

        .sidebar.collapsed {
            width: 80px;
        }

        .sidebar-header {
            padding: 24px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar-header img {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .sidebar.collapsed .sidebar-header img {
            width: 35px;
            height: 35px;
        }

        .logo-text {
            color: white;
            font-weight: 700;
            font-size: 1.3rem;
            transition: opacity 0.3s ease;
        }

        .sidebar.collapsed .logo-text {
            opacity: 0;
            width: 0;
        }

        .sidebar-menu {
            padding: 20px 0;
            list-style: none;
        }

        .sidebar-menu li {
            margin-bottom: 4px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 14px 20px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            border-radius: 8px;
            margin: 0 12px;
            font-weight: 500;
        }

        .sidebar-menu a:hover {
            background: var(--sidebar-hover);
            color: white;
            transform: translateX(5px);
        }

        .sidebar-menu li.active a {
            background: var(--primary);
            color: white;
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
        }

        .sidebar-menu i {
            font-size: 1.2rem;
            margin-right: 12px;
            min-width: 24px;
            text-align: center;
            transition: margin 0.3s ease;
        }

        .sidebar.collapsed .sidebar-menu i {
            margin-right: 0;
        }

        .menu-text {
            transition: opacity 0.3s ease;
        }

        .sidebar.collapsed .menu-text {
            opacity: 0;
            width: 0;
        }

        /* Main Content */
        .main-content {
            margin-left: 280px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            min-height: 100vh;
            background: var(--content-bg);
        }

        .main-content.expanded {
            margin-left: 80px;
        }

        /* ✅ Compact Top Navigation (Updated) */
        .top-nav {
            background: var(--card-bg);
            padding: 8px 20px;
            /* Reduced padding */
            height: 60px;
            /* Compact height */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
            position: sticky;
            top: 0;
            z-index: 99;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }

        .nav-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .nav-left h5 {
            font-size: 1rem;
            font-weight: 600;
            margin: 0;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .menu-toggle {
            background: none;
            border: none;
            font-size: 1.3rem;
            color: var(--text-primary);
            cursor: pointer;
            padding: 6px;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .menu-toggle:hover {
            background: var(--light);
        }

        .filter-controls {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: nowrap;
        }

        .form-control-sm,
        .form-select {
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 4px 10px !important;
            height: 34px !important;
            font-size: 0.85rem;
            transition: all 0.3s ease;
        }

        .form-control-sm:focus,
        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
        }

        /* Avatar and User Info */
        .user-menu {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .user-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
        }

        .user-info small {
            font-size: 0.75rem;
        }

        /* Main Area */
        .main-area {
            padding: 30px;
        }

        .content-card {
            background: var(--card-bg);
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            border: none;
            overflow: hidden;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .sidebar {
                width: 250px;
            }

            .main-content {
                margin-left: 250px;
            }

            .main-content.expanded {
                margin-left: 80px;
            }
        }

        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.mobile-open {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0 !important;
            }

            .top-nav {
                height: auto;
                padding: 10px 15px;
            }

            .filter-controls {
                flex-wrap: wrap;
                width: 100%;
                margin-top: 10px;
            }

            .form-control-sm,
            .form-select {
                width: 100% !important;
            }
        }

        @media (max-width: 768px) {
            .main-area {
                padding: 20px 15px;
            }

            .filter-controls {
                display: none;
                width: 100%;
                margin-top: 10px;
                flex-direction: column;
                gap: 10px;
                background: #fff;
                padding: 10px;
                border-radius: 10px;
            }

            .filter-controls.show {
                display: flex !important;
            }
        }

        @media (max-width: 576px) {
            .top-nav {
                padding: 10px 12px;
            }

            .main-area {
                padding: 15px 10px;
            }

            .user-info {
                display: none;
            }
        }

        /* Overlay for mobile */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            backdrop-filter: blur(2px);
        }

        .sidebar-overlay.active {
            display: block;
        }

        /* Scrollbar Styling */
        .sidebar::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
        }

        /* Animation */
        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Badge */
        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.75rem;
        }

        /* Select2 */
        .select2-container--default .select2-selection--single {
            border: 1px solid var(--border);
            border-radius: 8px;
            height: 38px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 38px;
            padding-left: 12px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px;
        }
    </style>

</head>

<body>
    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-sign-out-alt me-2"></i>Logout Confirmation
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <i class="fas fa-question-circle fa-3x text-warning mb-3"></i>
                    <h6>Are you sure you want to logout?</h6>
                    <p class="text-muted mb-0">You will need to login again to access the system</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a href="query/logout.php" class="btn btn-primary">Yes, Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <img src="images/pqr_icon.png" alt="PQR Logo">
            <div class="logo-text">KCC AVS</div>
        </div>

        <ul class="sidebar-menu">
            <li id="Dashboard" class="<?= ($_GET['page'] ?? '') === 'Dashboard' ? 'active' : '' ?>">
                <a href="index.php?page=Dashboard">
                    <i class='fas fa-chart-line'></i>
                    <span class="menu-text">Dashboard</span>
                </a>
            </li>
            <?php if ($role == "Admin" || $role == "GSM" || $role == "OM" || $role == "DSS") {
            ?>
                <li id="PREVIEW_PQR" class="<?= ($_GET['page'] ?? '') === 'PREVIEW_PQR' ? 'active' : '' ?>">
                    <a href="index.php?page=PREVIEW_PQR">
                        <i class='fas fa-eye'></i>
                        <span class="menu-text">PQR View</span>
                    </a>
                </li>
                <li id="agent_dsr" class="<?= ($_GET['page'] ?? '') === 'agent_dsr' || ($_GET['page'] ?? '') === 'view_dsr' || ($_GET['page'] ?? '') === 'agent_dsr_det'  ? 'active' : '' ?>">
                    <a href="index.php?page=agent_dsr">
                        <i class='fas fa-map'></i>
                        <span class="menu-text">Agent DSR</span>
                    </a>
                </li>
                <li id="agent_dash" class="<?= ($_GET['page'] ?? '') === 'agent_dash' || ($_GET['page'] ?? '') === 'view_coverage' ? 'active' : '' ?>">
                    <a href="index.php?page=agent_dash">
                        <i class='fas fa-map'></i>
                        <span class="menu-text">Agent Trip</span>
                    </a>
                </li>

            <?php


            } ?>

            <li id="PQR_VALIDATOR" class="<?= ($_GET['page'] ?? '') === 'PQR_VALIDATOR' ? 'active' : '' ?>">
                <a href="index.php?page=PQR_VALIDATOR">
                    <i class='fas fa-check-double'></i>
                    <span class="menu-text">PQR Validator</span>
                </a>
            </li>
            <li id="PQR_VALIDATOR_NEW" class="<?= ($_GET['page'] ?? '') === 'PQR_VALIDATOR_NEW' ? 'active' : '' ?>">
                <a href="index.php?page=PQR_VALIDATOR_NEW">
                    <i class='fas fa-check-double'></i>
                    <span class="menu-text">PQR Validator ISKU</span>
                </a>
            </li>
            <?php if ($role == "Admin" || $role == "GSM" || $role == "OM") {
            ?>
                <li id="PQR_CAS_VALIDATOR" class="<?= ($_GET['page'] ?? '') === 'PQR_CAS_VALIDATOR' ? 'active' : '' ?>">
                    <a href="index.php?page=PQR_CAS_VALIDATOR">
                        <i class='fas fa-tasks'></i>
                        <span class="menu-text">PQR CAS</span>
                    </a>
                </li>
            <?php
                // code...
            } ?>


            <?php if ($role == "Admin") {
            ?>
                <li id="Users" class="<?= ($_GET['page'] ?? '') === 'Users' ? 'active' : '' ?>">
                    <a href="index.php?page=Users">
                        <i class='fas fa-users'></i>
                        <span class="menu-text">Users</span>
                    </a>
                </li>

                <li id="Operation" class="<?= ($_GET['page'] ?? '') === 'Operation' ? 'active' : '' ?>">
                    <a href="index.php?page=Operation">
                        <i class='fas fa-cogs'></i>
                        <span class="menu-text">Operation</span>
                    </a>
                </li>
            <?php
                // code...
            } ?>


            <li id="REPORT" class="<?= ($_GET['page'] ?? '') === 'REPORT' ? 'active' : '' ?>">
                <a href="index.php?page=REPORT">
                    <i class='fas fa-chart-bar'></i>
                    <span class="menu-text">Reports</span>
                </a>
            </li>
        </ul>

        <ul class="sidebar-menu" style="margin-top: auto;">
            <li>
                <a href="#" data-bs-toggle="modal" data-bs-target="#logoutModal" style="color: #ff6b6b;">
                    <i class='fas fa-sign-out-alt'></i>
                    <span class="menu-text">Logout</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Mobile Overlay -->
    <div class="sidebar-overlay"></div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Navigation -->
        <nav class="top-nav">
            <div class="nav-left">
                <button class="menu-toggle">
                    <i class="fas fa-bars"></i>
                </button>
                <h5 class="mb-0 d-none d-md-block">
                    <?php
                    $pageTitles = [
                        'Dashboard' => 'Dashboard Overview',
                        'PREVIEW_PQR' => 'PQR Preview',
                        'PQR_VALIDATOR' => 'PQR Validation',
                        'PQR_CAS_VALIDATOR' => 'PQR CAS Management',
                        'Users' => 'User Management',
                        'Operation' => 'System Operations',
                        'REPORT' => 'Reports & Analytics'
                    ];
                    echo $pageTitles[$_GET['page'] ?? 'Dashboard'] ?? 'Dashboard';
                    ?>
                </h5>
            </div>

            <button class="btn btn-outline-dark d-md-none filter-toggle-btn" type="button">
                <i class="bi bi-sliders"></i> Filter
            </button>

            <div class="filter-controls">
                <input type="date" id="date" value="<?= $_GET['date'] ?? date('Y-m-d') ?>"
                    class="form-control form-control-sm" style="width: 140px; display: none;">

                <select class="form-select SEL" id="sel_comp">
                    <option value="">Select Company</option>
                    <?php
                    if ($role == "Admin") {
                        $query = "SELECT ID, CODE, NAME FROM [dbo].[Aquila_COMPANY]  WHERE STATUS='ACTIVE'";
                    } else {
                        $query = "SELECT C.ID, CODE, NAME FROM [dbo].[Aquila_COMPANY] c join [dbo].[Aquila_PQR_Users_Company_Mapping] m on c.ID = m.COMPANY_ID
                    WHERE c.STATUS='ACTIVE' AND USER_ID=$user_id";
                    }
                    foreach ($conn->query($query) as $row) {
                        $selected = ($selected_comp == $row['ID']) ? 'selected' : '';
                        echo "<option value='{$row['ID']}' $selected>{$row['CODE']}</option>";
                    }
                    ?>
                </select>

                <select class="form-select SEL sel-site" id="SELECT_SITE"
                    <?= empty($selected_site) ? 'disabled' : '' ?>>
                    <option value="">Select Site</option>
                    <?php
                    if (!empty($selected_comp)) {
                        $query = "SELECT SITEID, SITE_CODE FROM [dbo].[Aquila_Sites]  s join [dbo].[Aquila_PQR_Users_Branch_Mapping] b on s.SITEID=b.SITE_ID WHERE COMPANY_ID = '$selected_comp' $condition group by SITEID, SITE_CODE order by SITE_CODE ";
                        foreach ($conn->query($query) as $row) {
                            $selected = ($selected_site == $row['SITEID']) ? 'selected' : '';
                            echo "<option value='{$row['SITEID']}' $selected>{$row['SITE_CODE']}</option>";
                        }
                    }
                    ?>
                </select>


            </div>

            <!--  <div class="nav-right">
                <div class="user-menu">
                    <div class="user-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="user-info d-none d-md-block">
                        <small class="text-muted">Welcome back,</small>
                        <div class="fw-semibold"><?= $_SESSION['user_name'] ?? 'User' ?></div>
                    </div>
                </div>
            </div> -->
        </nav>

        <!-- Main Area -->
        <div class="main-area fade-in">
            <?php
            $page = isset($_GET["page"]) ? $_GET["page"] . ".php" : "Dashboard.php";
            if (file_exists("pages/" . $page)) {
                include "pages/" . $page;
            } else {
                echo '<div class="alert alert-danger">Page not found: ' . htmlspecialchars($page) . '</div>';
            }
            ?>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize Select2
            $(".SEL").select2({
                minimumResultsForSearch: 6,
                width: '100%'
            });
            $(".filter-toggle-btn").on("click", function() {
                $(".filter-controls").toggleClass("show");
            });


            $("#SELECT_SITE").change(function() {
                $(".filter-controls").removeClass("show");

            });
            // Hide on scroll
            $(window).on("scroll", function() {
                $(".filter-controls").removeClass("show");
            });



            // Sidebar toggle functionality
            $('.menu-toggle, .sidebar-overlay').click(function() {
                $('.sidebar').toggleClass('mobile-open');
                $('.sidebar-overlay').toggleClass('active');

                // For desktop: toggle collapsed state
                if (window.innerWidth > 992) {
                    $('.sidebar').toggleClass('collapsed');
                    $('.main-content').toggleClass('expanded');
                }
            });

            // AJAX for company selection
            $("#sel_comp").change(function() {
                const companyId = $(this).val();
                $(".sel-site").prop('disabled', true).html('<option value="">Loading...</option>');

                if (companyId) {
                    $.post('query/select_comp.php', {
                        comp: companyId
                    }, function(data) {
                        $(".sel-site").html(data).prop('disabled', false);
                    }).fail(function() {
                        $(".sel-site").html('<option value="">Error loading sites</option>');
                    });
                } else {
                    $(".sel-site").html('<option value="">Select Site</option>').prop('disabled', true);
                }
            });

            // AJAX for site selection
            $("#SELECT_SITE").change(function() {
                const siteId = $(this).val();
                $(".sel-pqrid").prop('disabled', true).html('<option value="">Loading...</option>');

                if (siteId) {
                    $.post('query/select_site.php', {
                        site: siteId
                    }, function(data) {
                        $(".sel-pqrid").html(data).prop('disabled', false);
                        window.location.reload();
                    }).fail(function() {
                        $(".sel-pqrid").html('<option value="">Error loading guidelines</option>');
                    });
                } else {
                    $(".sel-pqrid").html('<option value="">Select Guidelines</option>').prop('disabled', true);
                }
            });

            // Date change handler
            $("#date").change(function() {
                const newDate = $(this).val();
                const currentPage = "<?= $_GET['page'] ?? '' ?>";
                if (newDate) {
                    window.location.href = `index.php?page=${currentPage}&date=${newDate}`;
                }
            });

            // Handle window resize
            $(window).resize(function() {
                if (window.innerWidth <= 992) {
                    $('.sidebar').removeClass('collapsed');
                    $('.main-content').removeClass('expanded');
                }
            });

            // Add loading states
            $('.SEL').on('select2:opening', function() {
                $(this).addClass('loading');
            });

            $('.SEL').on('select2:close', function() {
                $(this).removeClass('loading');
            });
        });
    </script>
</body>

</html>