<?php
session_start();

if (!isset($_SESSION['Name_of_user']) || empty($_SESSION['Name_of_user'])) {
    header("Location: /PaOrder/Home/verify.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Ko</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 100px; /* Space for fixed navbar */
        }
        .navbar {
            background-color: #343a40;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }
        .page-section {
            display: none;
            min-height: 70vh;
        }
        .page-section.active {
            display: block;
        }
        .timeline {
            position: relative;
            max-width: 800px;
            margin: 40px auto;
        }
        .timeline::after {
            content: '';
            position: absolute;
            width: 6px;
            background-color: #dee2e6;
            top: 0;
            bottom: 0;
            left: 50%;
            margin-left: -3px;
        }
        .timeline-item {
            padding: 10px 40px;
            position: relative;
            background-color: inherit;
            width: 50%;
        }
        .timeline-item::after {
            content: '';
            position: absolute;
            width: 25px;
            height: 25px;
            right: -13px;
            background-color: white;
            border: 4px solid #dee2e6;
            top: 15px;
            border-radius: 50%;
            z-index: 1;
        }
        .left { left: 0; }
        .right { left: 50%; }
        .left::after { right: -13px; }
        .right::after { left: -13px; }
        .timeline-content {
            padding: 20px 30px;
            background-color: white;
            position: relative;
            border-radius: 6px;
            box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
        }
        .left .timeline-content::before {
            content: '';
            position: absolute;
            top: 20px;
            right: -15px;
            border: 15px solid transparent;
            border-left-color: white;
        }
        .right .timeline-content::before {
            content: '';
            position: absolute;
            top: 20px;
            left: -15px;
            border: 15px solid transparent;
            border-right-color: white;
        }
        .completed .timeline-content {
            background-color: #d4edda;
        }
        .completed::after {
            background-color: #28a745;
            border-color: #28a745;
        }
        .current::after {
            background-color: #ffc107;
            border-color: #ffc107;
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(255, 193, 7, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(255, 193, 7, 0); }
            100% { box-shadow: 0 0 0 0 rgba(255, 193, 7, 0); }
        }
        .logo-img {
            height: 60px;
            width: auto;
        }
    </style>
</head>
<body>

    <!-- Fixed Navigation Header -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="#" onclick="showPage('home')">
                <img src="\PaOrder\Home\img\paordernew.png" alt="PaOrder Logo" class="logo-img me-3">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="showPage('home')">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="showPage('myorders')">MY ORDERS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="showPage('history')">HISTORY</a>
                    </li>
                </ul>
                <!-- Profile Dropdown -->
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center text-white" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle fa-2x me-2"></i>
                            <span><?php echo $_SESSION['Name_of_user']; ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i> Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="verify.php"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Sections -->
    <div class="container my-5">

        <!-- Home Page -->
        <div id="home" class="page-section active text-center">
            <h1 class="display-4">Welcome to Order Ko Tracker</h1>
            <p class="lead">Track your deliveries with ease.</p>
            <hr class="my-4">
            <p>Click on <strong>My Orders</strong> to view current delivery status or <strong>History</strong> to see past orders.</p>
        </div>

   <!-- My Orders Page (with Status Tabs) -->
<div id="myorders" class="page-section">
    <h2 class="mb-4 text-center">My Orders</h2>

    <!-- Tabs for filtering -->
    <ul class="nav nav-tabs justify-content-center mb-4" id="orderTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending" type="button">
                Pending
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="fordelivery-tab" data-bs-toggle="tab" data-bs-target="#fordelivery" type="button">
                For Delivery
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="completed-tab" data-bs-toggle="tab" data-bs-target="#completed" type="button">
                Completed
            </button>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content">

        <!-- PENDING ORDERS -->
        <div class="tab-pane fade show active" id="pending">
            <div class="card mb-3">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">Order #12347 <span class="badge bg-warning text-dark float-end">Pending Payment</span></h5>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <div class="timeline">
                            <div class="timeline-item left completed">
                                <div class="timeline-content">
                                    <h6>Order Placed</h6>
                                    <small>December 12, 2025</small>
                                </div>
                            </div>
                            <div class="timeline-item right">
                                <div class="timeline-content">
                                    <h6>Awaiting Payment</h6>
                                    <p>Please complete payment to proceed.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- FOR DELIVERY (In Transit / Out for Delivery) -->
        <div class="tab-pane fade" id="fordelivery">
            <div class="card mb-3">
                <div class="card-header bg-info text-white text-center">
                    <h5>Order #12345 - Out for Delivery</h5>
                    <p class="mb-0">Estimated: Today, December 12, 2025</p>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="timeline-item left completed">
                            <div class="timeline-content">
                                <h5>Order Confirmed</h5>
                                <small>December 10, 2025</small>
                            </div>
                        </div>
                        <div class="timeline-item right completed">
                            <div class="timeline-content">
                                <h5>Packed</h5>
                                <small>December 11, 2025</small>
                            </div>
                        </div>
                        <div class="timeline-item left completed">
                            <div class="timeline-content">
                                <h5>Shipped</h5>
                                <small>December 12, 2025</small>
                            </div>
                        </div>
                        <div class="timeline-item right current">
                            <div class="timeline-content">
                                <h5>Out for Delivery</h5>
                                <p>Your package is with the courier.</p>
                                <small class="text-muted">Expected Today</small>
                            </div>
                        </div>
                        <div class="timeline-item left">
                            <div class="timeline-content">
                                <h5>Delivered</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header bg-primary text-white">
                    <h5>Order #12346</h5>
                </div>
                <div class="card-body">
                    <p><strong>Status:</strong> In Transit</p>
                    <p><strong>Tracking:</strong> Arriving tomorrow</p>
                </div>
            </div>
        </div>

        <!-- COMPLETED ORDERS -->
        <div class="tab-pane fade" id="completed">
            <div class="card mb-3 border-success">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Order #12344 Delivered</h5>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="timeline-item left completed">
                            <div class="timeline-content">
                                <h5>Order Confirmed</h5>
                                <small>December 1, 2025</small>
                            </div>
                        </div>
                        <div class="timeline-item right completed">
                            <div class="timeline-content">
                                <h5>Packed & Shipped</h5>
                                <small>December 2, 2025</small>
                            </div>
                        </div>
                        <div class="timeline-item left completed">
                            <div class="timeline-content">
                                <h5>Delivered</h5>
                                <p>Signed by: J. Smith</p>
                                <small class="text-success"><strong>December 5, 2025</strong></small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <button class="btn btn-outline-success btn-sm">Rate Order</button>
                    <button class="btn btn-outline-primary btn-sm ms-2">Buy Again</button>
                </div>
            </div>

            <div class="card mb-3 border-success">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Order #12343 Delivered</h5>
                </div>
                <div class="card-body text-center py-5">
                    <p>Delivered on November 28, 2025</p>
                </div>
            </div>
        </div>

    </div>
</div>

        <!-- History Page -->
        <div id="history" class="page-section">
            <h2 class="mb-4">Order History</h2>
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Order #12344</h5>
                        <small>Delivered on December 5, 2025</small>
                    </div>
                    <p class="mb-1">Electronics Package</p>
                    <small class="text-success">Delivered</small>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Order #12343</h5>
                        <small>Delivered on November 28, 2025</small>
                    </div>
                    <p class="mb-1">Clothing Items</p>
                    <small class="text-success">Delivered</small>
                </a>
            </div>
        </div>

    </div>

    <!-- Bootstrap & Custom JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Function to show selected page
        function showPage(pageId) {
            // Hide all pages
            document.querySelectorAll('.page-section').forEach(section => {
                section.classList.remove('active');
            });
            // Show selected page
            document.getElementById(pageId).classList.add('active');

            // Update active nav link
            document.querySelectorAll('.nav-link').forEach(link => {
                link.classList.remove('active');
            });
            event.target.classList.add('active');
        }

        // Set default active page (Home) on load
        document.addEventListener('DOMContentLoaded', () => {
            showPage('home');
            document.querySelector('a[onclick="showPage(\'home\')]').classList.add('active');
        });
    </script>
</body>
</html>