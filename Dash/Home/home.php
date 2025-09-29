<?php
session_start();

include '../../DB/dbcon.php';

   // Unset all session variables

// Check if site is passed via GET
if (isset($_GET['site'])  && isset($_GET['siteid'])) {
    $_SESSION['SITE_NAME'] = $_GET['site'];
    $_SESSION['SITE_ID']    = $_GET['siteid'];
  

} elseif (!isset($_SESSION['SITE_NAME'])  || !isset($_SESSION['SITE_ID'])) {
    // Fetch default site

$sql = "SELECT TOP 1  SITE_ID, SITE_NAME
        FROM Dash_User_Site
        WHERE USER_ID = :userid
        ORDER BY SITE_NAME ASC";

$stmt = $conn->prepare($sql);
$stmt->execute(['userid' => $_SESSION['UserID']]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $_SESSION['SITE_NAME'] = $row['SITE_NAME'];
        $_SESSION['SITE_ID']    = $row['SITE_ID'];

        header("Location: home.php?page=dashboard&site=" . urlencode($row['SITE_NAME']) . "&company=" . urlencode($row['COMPANY_ID']) . "&siteid=" . urlencode($row['SITE_ID']));
        exit();
    } else {
        $_SESSION['SITE_NAME'] = 'NO_SITE';
        $_SESSION['SITE_ID']    = 'NO_SITE_ID';
    }
}
if (isset($_GET['site']) && isset($_GET['company']) && isset($_GET['siteid'])) {
    $_SESSION['SITE_NAME'] = $_GET['site'];
    $_SESSION['SITE_ID']    = $_GET['siteid'];
}

// If site not set in session, get the first available site for the user

?>
<!doctype html>
<html lang="en">
<head>
         <link rel="icon" type="image/x-icon" href="\Services\img\dash.png">

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

  <!-- AdminLTE CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <title>Delivery Dash</title>
</head>
<body class="hold-transition sidebar-mini">

<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark bg-dark-orange">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button">
          <i class="fas fa-bars"></i>
        </a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="home.php?page=dashboard" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown">
          Help
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
          <a class="dropdown-item" href="#">FAQ</a>
          <a class="dropdown-item" href="#">Support</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Contact</a>
        </div>
      </li>
    </ul>

  <!-- Right navbar links -->
<ul class="navbar-nav ml-auto">
  <!-- User Dropdown Menu -->

  <li class="nav-item dropdown">
    
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
<?= $_SESSION['SITE_NAME'] ?? 'NO_SITE' ?> &nbsp;

    <i class="far fa-bell"></i>
      <img src="/MainImg/icons8-user-50.png" alt="User Icon" style="width:20px; height:20px; margin-left:5px;">
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
      <div class="text-center">
        <img src="/MainImg/icons8-user-48.png" alt="User Icon" style="width:75px; height:75px;">
      </div>
      <span class="dropdown-header">
        <?php echo $_SESSION['Name_of_user']; ?>
      </span>

      <div class="dropdown-divider"></div>

      <!-- Dropdown Button with Selectable Items -->
  <div class="d-flex justify-content-center">
      <div class="dropdown px-2">
  <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    Select Site
  </button>

  <div class="dropdown-menu">
    
            <?php
            $query = "SELECT 
                USER_ID,
                SITE_ID,
                SITE_NAME
            FROM Dash_User_Site  
            WHERE USER_ID = '" . $_SESSION['UserID'] . "' 
            GROUP BY USER_ID, SITE_ID, SITE_NAME";
            $query_result = $conn->query($query);

            foreach ($query_result as $data) {
                echo '<a class="dropdown-item" href="home.php?page=dashboard'
                   . '&site=' . urlencode($data['SITE_NAME'])
                   . '&siteid=' . urlencode($data['SITE_ID']) . '">'
                   . htmlspecialchars($data['SITE_NAME']) . '</a>';
            }
            ?>

  </div>
    </div>
</div>

      <div class="dropdown-divider"></div>
      <a href="#" class="dropdown-item">
        <i class="fas fa-users mr-2"></i> <?php echo $_SESSION['Role']; ?> &nbsp;
      </a>
      <div class="dropdown-divider"></div>
      <a href="#" class="dropdown-item">
    <i class="fas fa-cog mr-2"></i> Account Settings
      </a> 
      <div class="dropdown-divider"></div>
      <a href="#" class="dropdown-item dropdown-footer bg-danger text-white text-center" onclick="confirmLogout();">
        Logout Account
      </a>
    </div>
  </li>
</ul>

<script>
  function confirmLogout() {
    if (confirm('Are you sure you want to logout?')) {
      window.location.href = 'verify.php';
    }
  }
</script>

        </div>
      </li>
    </ul>
  </nav>
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="icon" type="image/x-icon" href="MainImg\bscr.ico">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <title>Delivery Dash</title>
  <style>
    /* Custom gradient for sidebar */
    .sidebar-dark-primary {
      background: linear-gradient(135deg, #020146ff 0%, #3b05cfff 100%) !important;
    }
    
    /* Improve text visibility on gradient */
    .brand-text, .nav-link p, .info a {
      text-shadow: 0 1px 2px rgba(224, 219, 219, 0.3);
    }
    
    /* Hover effects for menu items */
    .nav-item .nav-link:hover {
      background-color: rgba(255, 255, 255, 0.15) !important;
    }

    .bg-dark-orange {
  background-color: #ca5303ff !important; /* dark orange */
}
  </style>
</head>

  <!-- Main Sidebar Container - UPDATED WITH GRADIENT -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link text-center">
      <img src="/Services/img/dash.png" alt="Logo" style="width: 100px; height: 100px;">
      <span class="brand-text font-weight-bold d-block">DELIVERY DASH</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- User panel -->
      <div class="user-panel mt-3 pb-3 mb-1 d-flex">
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION['Company_Name']; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
          <li class="nav-item">
            <a href="home.php?page=dashboard" class="nav-link d-flex align-items-center">
              <img src="\Dash\Home\img\analysis.png" style=" width: 30px; height: 30px; margin-right: 10px;">
              <p class="mb-0">Dashboard</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="home.php?page=transactions" class="nav-link d-flex align-items-center">
              <img src="\Dash\Home\img\transaction.png" style="width: 30px; height: 35px; margin-right: 10px;">
              <p class="mb-0">Transactions</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="home.php?page=reports" class="nav-link d-flex align-items-center">
              <img src="\Dash\Home\img\documents.png" style="width: 30px; height: 30px; margin-right: 10px;">
              <p class="mb-0">Reports</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="home.php?page=settings" class="nav-link d-flex align-items-center">
              <img src="\Dash\Home\img\settings.png" style="width: 30px; height: 30px; margin-right: 10px;">
              <p class="mb-0">Settings</p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>

  <!-- Content Wrapper -->
  <div class="content-wrapper p-4">
    <?php
    // Your PHP content logic remains unchanged
    $role = $_SESSION['Role'] ?? '';
    
    if ($role === 'ADMIN') {
        // Admin pages logic
        $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
        $allowedPages = ['dashboard', 'transactions', 'reports' , 'settings'];
        if (in_array($page, $allowedPages)) {
            include "pages/{$page}.php";
        } else {
            echo "<h1 class='text-center'>Page not found or not allowed</h1>";
        }
    } elseif ($role === 'TRUCK-SIZER') {
        // Encoder pages logic
        $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
        $allowedPages = ['dashboard', 'transactions', 'PO_view', 'reports','ProductMasterReport', 'CustomerMasterReport'
          ,'SellerMasterReport','CoverageReport','InvoiceSummaryReport','InvoiceDetailedReport'
        ,'SalesReturnReport','StockViewReport','SOReport','StockLedgerReport','WarehouseMasterReport','SchemeMasterReport','IntransitSummary'
       ,'intransitdetailedReport','PurchasereturnReport','VanAllocationReport','VanStockReport'
     ,'SFAMappingReport','T_Vanloading','T_VanLoadHistory'];
        if (in_array($page, $allowedPages)) {
            include "pages/{$page}.php";
        } else {
            echo "<h1 class='text-center'>Page not found or not allowed</h1>";
        }
    } elseif ($role === 'CASHIER') {
        // IRA pages logic
        $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
        $allowedPages = ['dashboard','PO_view', 'transactions', 'reports','ProductMasterReport', 'CustomerMasterReport'
          ,'SellerMasterReport','CoverageReport','InvoiceSummaryReport','InvoiceDetailedReport'
        ,'SalesReturnReport','StockViewReport','SOReport','StockLedgerReport','WarehouseMasterReport' , 'SchemeMasterReport','IntransitSummary'
       ,'intransitdetailedReport','PurchasereturnReport','VanAllocationReport','VanStockReport','SFAMappingReport','T_VanLoadHistory'];
        if (in_array($page, $allowedPages)) {
            include "pages/{$page}.php";
        } else {
            echo "<h1 class='text-center'>Page not found or not allowed</h1>";
        }
   
    } else {
        // Default case
        echo "<h3 class='text-center'>
                Session expired or account logged out, 
                <a href='verify.php' onclick='handleLoginClick(event)'>Login again</a> to continue
              </h3>";
        echo "<script>
        function handleLoginClick(event) {
            event.preventDefault();
            window.location.href = 'verify.php';
        }
        </script>";
        exit();
    }
    ?>
  </div>
</div>

<!-- JS Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

<script>
  function confirmLogout() {
    if (confirm('Are you sure you want to logout?')) {
      window.location.href = 'verify.php';
    }
  }
  
  $(document).on('click', '#click_me', function(){
    let site_id = $(this).data("id");
    $("#site_name").text(site_id);
    alert(site_id);
  });
</script>
</body>
</html>