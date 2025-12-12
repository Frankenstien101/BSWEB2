<?php
session_start();

include '../../DB/dbcon.php';

// Check if site is passed via GET
if (isset($_GET['site'])  && isset($_GET['siteid'])) {
    $_SESSION['SITE_NAME'] = $_GET['site'];
    $_SESSION['SITE_ID']    = $_GET['siteid'];
  

} elseif (!isset($_SESSION['SITE_NAME'])  || !isset($_SESSION['SITE_ID'])) {
    // Fetch default site

$sql = "SELECT TOP 1  SITE_ID, SITE_NAME
        FROM TBC_User_Site_Mapping
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
         <link rel="icon" type="image/x-icon" href="\Services\img\TBC.png">

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

  <!-- AdminLTE CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <title>TBC</title>

   <style>
    /* Ensure table scrolls within card-body */
    .table-scroll {
      max-height: 50vh;
      overflow-y: auto;
      overflow-x: auto;
    }

    /* Optional: fix header background while scrolling */
  

    /* Reduce modal padding */
    .modal-body {
      padding: 0.5rem 1rem;
      font-size: 10px;
    }

    .card-body {
      padding: 0.5rem;
    }
  </style>
  


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
            FROM TBC_User_Site_Mapping  
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
  <title>TBC</title>
  <style>
    /* Custom gradient for sidebar */
    .sidebar-dark-primary {
      background: linear-gradient(135deg, #033301ff 0%, #079702ff 100%) !important;
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
  background-color: #2b2c2cff !important; /* dark orange */
}

.content-wrapper {
  position: absolute;
  top: 10;
  left: 0;
  right: 0;
  height: 90vh;
  overflow-y: auto;
  background: #f4f6f9;
  padding: 2rem 2rem 2rem 0;
  z-index: 1; /* Lower than sidebar */
  transition: left 0.3s;
}
  </style>
</head>

  <!-- Main Sidebar Container - UPDATED WITH GRADIENT -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link text-center">
      <img src="/Services/img/tbc.png" alt="Logo" style="width: 100px; height: 100px;">
      <span class="brand-text font-weight-bold d-block">TBC</span>
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
              <img src="\TBC\Home\img\dashboard.png" style=" width: 25px; height: 25px; margin-right: 10px;">
              <p class="mb-0">Dashboard</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="home.php?page=transactions" class="nav-link d-flex align-items-center">
              <img src="\TBC\Home\img\transaction.png" style="width: 30px; height: 30px; margin-right: 10px;">
              <p class="mb-0">Transactions</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="home.php?page=reports" class="nav-link d-flex align-items-center">
              <img src="\TBC\Home\img\report.png" style="width: 30px; height: 30px; margin-right: 10px;">
              <p class="mb-0">Report</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="home.php?page=settings" class="nav-link d-flex align-items-center">
              <img src="\TBC\Home\img\setting.png" style="width: 30px; height: 30px; margin-right: 10px;">
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
        $allowedPages = ['dashboard', 'transactions', 'reports' , 'settings' , 'CallCreation','PreviousCall'];
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

<!-- NEW CALL MODAL -->
<div class="modal fade" id="newCallModal" tabindex="-1">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Select Details</h5>
        <button type="button" class="close" data-dismiss="modal">
          <span>&times;</span>
        </button>
      </div>

      <div class="modal-body">

        <div class="row">

          <!-- PRINCIPAL (LEFT – SMALL) -->
          <div class="col-md-3">
            <div class="card h-100 border-gray">
              <div class="card-header font-weight-bold" style="height: 55px;">PRINCIPAL</div>
              <div class="card-body table-scroll">
                <table id="principalTable" class="table table-striped table-hover table-bordered table-sm mb-0">
                  <thead>
                    <tr>
                      <th>Principal</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                   
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <!-- SELLERS (RIGHT – 70%+) -->
       <div class="col-md-9">
  <div class="card h-100">
   <div class="card-header d-flex justify-content-between align-items-center font-weight-bold">
  <span>STORES</span>

  <div class="d-flex align-items-center ml-auto" style="gap: 0.5rem;">

  <button id="balloonBtn" class="btn btn-primary btn-sm" 
            data-toggle="tooltip" data-placement="left" title="Click to open menu">
      Walk-in
    </button>

    <!-- Search Box -->
    <div style="width: 200px;">
      <div class="input-group input-group-sm">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-search"></i></span>
        </div>
        <input type="text" class="form-control form-control-sm" placeholder="Search stores" id="storeSearch">
      </div>
    </div>
  </div>
</div>

    <div class="card-body table-scroll" style="max-height:450px; overflow-y:auto;">
      <table id="sellerTable" class="table table-striped table-hover table-bordered table-sm mb-0">
        <thead>
          <tr>
            <th>Seller ID</th>
            <th>Name</th>
            <th>Customer ID</th>
            <th>Customer Name</th>
            <th>Address</th>
            <th>Phone Number</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
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


function createCall(sellerId, customerId, customerName, phoneNumber, sellerName, siteId) {
    // Logic to create a new call    // For demonstration, just alerting the details
   // alert(`Seller ID: ${sellerIdOnly}\nCustomer ID: ${customerId}\nCustomer Name: ${customerName}\nPhone Number: ${phoneNumber}\nSeller Name: ${sellerName}\nSite ID: ${siteId}`);

     document.getElementById('customeridtxt').value = customerId;
     document.getElementById('vantxt').value = sellerId;
     document.getElementById('sellertxt').value = sellerName;
     document.getElementById('customerNametxt').value = customerName;
     document.getElementById('phoneNumbertxt').value = phoneNumber;


   // alert('New call created!');
    $('#newCallModal').modal('hide');
  }

  document.addEventListener("DOMContentLoaded", function () {
    // Load principals when modal is shown
    $('#newCallModal').on('shown.bs.modal', function () {
      loadPrincipals();
    });
  });

loadPrincipals = () => {
    fetch('/TBC/datafetcher/transaction/callcreation_data.php?action=getprincipals&site=<?= $_SESSION['SITE_ID'] ?>&company=<?= $_SESSION['Company_ID'] ?>')
      .then(response => response.json())
      .then(data => {
        const principalTableBody = document.querySelector('#principalTable tbody');
        principalTableBody.innerHTML = '';

        data.forEach(principal => {
          const tr = document.createElement('tr');
          tr.innerHTML = `
            <td>${principal.PRINCIPAL}</td>
            <td>
              <button class="btn btn-primary btn-sm select-principal-btn" data-id="${principal.PRINCIPAL}">
                Select
              </button>
            </td>
          `;
          principalTableBody.appendChild(tr);
        });

        // Add event listeners to select buttons
        document.querySelectorAll('.select-principal-btn').forEach(button => {
          button.addEventListener('click', function () {
            const principalId = this.getAttribute('data-id');
            loadSellers(principalId);
            walkinloadSellers(principalId);
          });
        });
      })
      .catch(error => console.error('Error loading principals:', error));
  };

function loadSellers(principalId) {
const principalIdtxt = principalId;

    fetch(`/TBC/datafetcher/transaction/callcreation_data.php?action=getsellers&principal=${encodeURIComponent(principalIdtxt)}&site=<?= $_SESSION['SITE_ID'] ?>`)
      .then(response => response.json())
      .then(data => {
        const sellerTableBody = document.querySelector('#sellerTable tbody');
        sellerTableBody.innerHTML = '';

        data.forEach(seller => {
          const tr = document.createElement('tr');
          tr.innerHTML = `
            <td>${seller.SELLER_ID}</td>
            <td>${seller.SELLER_NAME}</td>
            <td>${seller.CUSTOMER_ID}</td>
            <td>${seller.CUSTOMER_NAME}</td>
            <td>${seller.ADDRESS}</td>
            <td>${seller.PHONE_NUMBER}</td>
            <td>
              <button class="btn btn-success btn-sm create-call-btn" data-id="${seller.SELLER_ID},${seller.CUSTOMER_ID},${seller.CUSTOMER_NAME},${seller.PHONE_NUMBER},${seller.SELLER_NAME},<?= $_SESSION['SITE_ID'] ?>">
                Create Call
              </button>
            </td>
          `;
          sellerTableBody.appendChild(tr);
        });

        // Add event listeners to create call buttons
        document.querySelectorAll('.create-call-btn').forEach(button => {
          button.addEventListener('click', function () {
            const sellerDetails = this.getAttribute('data-id').split(',');
            const sellerIdOnly = sellerDetails[0];  
            const customerId = sellerDetails[1];
            const customerName = sellerDetails[2];
            const phoneNumber = sellerDetails[3];
            const sellerName = sellerDetails[4];
            const siteId = sellerDetails[5];
            createCall(sellerIdOnly, customerId, customerName, phoneNumber, sellerName, siteId);
          });
        });
      })
      .catch(error => console.error('Error loading sellers:', error));
  }


// Search filter for Stores table
document.getElementById('storeSearch').addEventListener('keyup', function() {
    const searchValue = this.value.toLowerCase();
    const rows = document.querySelectorAll('#sellerTable tbody tr');

    rows.forEach(row => {
        const cells = row.querySelectorAll('td');
        let match = false;
        cells.forEach(cell => {
            if (cell.textContent.toLowerCase().includes(searchValue)) {
                match = true;
            }
        });
        row.style.display = match ? '' : 'none';
    });
});

function addWalkIn() {
   
  const customerName = document.getElementById('walkinCustomerName').value;
    const phoneNumber = document.getElementById('walkinPhoneNumber').value;
    const sellerId = document.getElementById('selectseller').value;

    if (!customerName) {
        alert('Please enter a customer name.');
        return;
    }

    if (!phoneNumber) {
        alert('Please enter a phone number.');
        return;
    }

    if (!sellerId) {
        alert('Please select a seller.');
        return;
    }

    // Logic to add walk-in customer
   // alert(`Walk-in added:\nCustomer Name: ${customerName}\nPhone Number: ${phoneNumber}`);

    document.getElementById('customeridtxt').value = 'WALK-IN';
     document.getElementById('vantxt').value = selectseller.value;
     document.getElementById('sellertxt').value = selectseller.value;
     document.getElementById('customerNametxt').value = customerName;
     document.getElementById('phoneNumbertxt').value = phoneNumber;

    // Close modal
    $('#leftModal').modal('hide');
    $('#newCallModal').modal('hide');

    // Clear input fields
    document.getElementById('walkinCustomerName').value = '';
    document.getElementById('walkinPhoneNumber').value = '';
}

</script>

<!-- Balloon Button -->


<!-- Left Slide Modal -->
<div class="modal left fade" id="leftModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content" style="height: 100vh;">
      <div class="modal-header">
        <h5 class="modal-title">ADD WALK-IN</h5>
        <button type="button" class="close" data-dismiss="modal">
          <span>&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>SELLER:</p>
          <select id="selectseller" class="form-control form-control-sm mb-2" style="width: 200px;">
    <option value="">Select Seller</option>
  </select>
        <p>CUSTOMER NAME:</p>
        <input type="text" class="form-control form-control-sm mb-3 mt-1" id="walkinCustomerName">
        <p>PHONE NUMBER:</p>
        <input type="text" class="form-control form-control-sm mb-3 mt-1" id="walkinPhoneNumber">
        <button class="btn btn-success btn-sm mt-3 " onclick="addWalkIn()" style="width: 100%; height: 40px;">ADD WALK-IN</button>
      </div>
    </div>
  </div>
</div>

<style>
/* Slide-in from left */
.modal.left .modal-dialog {
  position: fixed;
  margin: 0;
  width: 300px;
  height: 100%;
  right: -300px;
  transition: all 0.3s;
}

.modal.left.show .modal-dialog {
  right: 0;
}

.modal.left .modal-content {
  height: 100%;
  border-radius: 0;
}
</style>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script>
$(function () {
  // Initialize tooltip
  $('#balloonBtn').tooltip();

  // Open left modal when balloon clicked
  $('#balloonBtn').on('click', function () {
    $('#leftModal').modal('show');
  });
});

// Load sellers for walk-in when left modal is shown
$('#leftModal').on('shown.bs.modal', function () {
  walkinloadSellers(principalId);
});

function walkinloadSellers(principalId) {

  const principalIdtxt = principalId;

    fetch(`/TBC/datafetcher/transaction/callcreation_data.php?action=getsellerswalkin&site=<?= $_SESSION['SITE_ID'] ?>&principal=${encodeURIComponent(principalIdtxt)}`)
      .then(response => response.json())
      .then(data => {
        const selectSeller = document.getElementById('selectseller');
        selectSeller.innerHTML = '<option value="">Select Seller</option>'; // Clear existing options

        data.forEach(seller => {
          const option = document.createElement('option');
          option.value = seller.SELLER_ID;
          option.textContent = seller.SELLER_NAME;
          selectSeller.appendChild(option);
        });
      })
      .catch(error => console.error('Error loading sellers for walk-in:', error));
  }

</script>


</body>
</html>