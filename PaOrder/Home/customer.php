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
    body { background-color: #f8f9fa; padding-top: 100px; }
    .navbar { background-color: #343a40; box-shadow: 0 2px 10px rgba(0,0,0,0.2); }
    .page-section { display: none; min-height: 70vh; }
    .page-section.active { display: block; }
    .logo-img { height: 60px; width: auto; }
    .card:hover { cursor: pointer; transform: scale(1.01); transition: 0.2s; }
</style>
</head>
<body>

<!-- Fixed Navigation Header -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="#" onclick="showPage('home', event)">
            <img src="\PaOrder\Home\img\paordernew.png" alt="PaOrder Logo" class="logo-img me-3">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="#" onclick="showPage('home', event)">HOME</a></li>
                <li class="nav-item"><a class="nav-link" href="#" onclick="showPage('myorders', event)">MY ORDERS</a></li>
                <li class="nav-item"><a class="nav-link" href="#" onclick="showPage('history', event)">HISTORY</a></li>
            </ul>
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

    <!-- My Orders Page -->
    <div id="myorders" class="page-section">
        <h2 class="mb-4 text-center">My Orders</h2>

        <!-- Tabs for filtering -->
        <ul class="nav nav-tabs justify-content-center mb-4" id="orderTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending" type="button">Pending</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="fordelivery-tab" data-bs-toggle="tab" data-bs-target="#fordelivery" type="button">For Delivery</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="completed-tab" data-bs-toggle="tab" data-bs-target="#completed" type="button">Completed</button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content">
            <div class="tab-pane fade show active" id="pending">
                <div id="pendingOrders" class="mb-3"></div>
            </div>
            <div class="tab-pane fade" id="fordelivery">
                <div id="forDeliveryOrders" class="mb-3"></div>
            </div>
            <div class="tab-pane fade" id="completed">
                <div id="completedOrders" class="mb-3"></div>
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
        </div>
    </div>

</div>

<!-- Order Details Modal -->
<div class="modal fade" id="orderModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalOrderTitle">Order Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" id="modalOrderBody">
        <!-- Details populated by JS -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap & Custom JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Initialize modal once
    window.orderModal = new bootstrap.Modal(document.getElementById('orderModal'));

    // Show home page initially
    showPage('home');
});

// Show a page and handle active nav-link
function showPage(pageId, e) {
    document.querySelectorAll('.page-section').forEach(sec => sec.classList.remove('active'));
    document.getElementById(pageId).classList.add('active');

    if (e) {
        document.querySelectorAll('.nav-link').forEach(link => link.classList.remove('active'));
        e.currentTarget.classList.add('active');

        // Collapse navbar if open (mobile)
        const navbarCollapse = document.getElementById('navbarContent');
        if (navbarCollapse.classList.contains('show')) {
            const bsCollapse = bootstrap.Collapse.getInstance(navbarCollapse) || new bootstrap.Collapse(navbarCollapse);
            bsCollapse.hide();
        }
    }

    if (pageId === 'myorders') loadMyOrders();
}

// Load orders via fetch
function loadMyOrders() {
    const companytxt = "<?php echo $_SESSION['principal']; ?>";
    const storeid = "<?php echo $_SESSION['store_id']; ?>";

    fetch(`/PaOrder/datafetcher/customers_data.php?action=viewmyorders&companyid=${encodeURIComponent(companytxt)}&storeid=${encodeURIComponent(storeid)}`)
    .then(res => res.json())
    .then(data => {
        if (!data.success) return console.warn(data.error || "No data");

        const pendingEl = document.getElementById('pendingOrders');
        const deliveryEl = document.getElementById('forDeliveryOrders');
        const completedEl = document.getElementById('completedOrders');

        pendingEl.innerHTML = '';
        deliveryEl.innerHTML = '';
        completedEl.innerHTML = '';

        data.data.forEach(order => {
            let status = order.STATUS;
            let statusText = status === '' ? 'Pending' : status === '0' ? 'Pending' : status === '1' ? 'Prepared' : status === '2' ? 'Ready for Delivery' : status === '3' ? 'For Delivery' : status === '4' ? 'Completed' : 'Unknown';

            let card = document.createElement('div');
            card.className = 'card mb-3 shadow-sm';
            card.innerHTML = `
                <div class="card-header ${getHeaderColor(status)} text-white">
                    <strong>Order #${order.order_no}</strong>
                    <span class="badge bg-dark float-end">${statusText}</span>
                </div>
                <div class="card-body">
                    <p><strong>Date:</strong> ${order.order_date}</p>
                    <p><strong>Total Amount:</strong> ₱${parseFloat(order.TOTAL_AMOUNT).toLocaleString('en-PH', {minimumFractionDigits:2})}</p>
                    <p><strong>Date to Deliver:</strong> ${order.DATE_TO_DELIVER ?? 'N/A'}</p>
                </div>
            `;

            card.addEventListener('click', () => showOrderModal(order.order_no));

            if (['0','1','2'].includes(status)) pendingEl.appendChild(card);
            else if (status === '3') deliveryEl.appendChild(card);
            else if (['4','5'].includes(status)) completedEl.appendChild(card);
        });

        if (!pendingEl.hasChildNodes()) pendingEl.innerHTML = '<p class="text-center text-muted">No pending orders.</p>';
        if (!deliveryEl.hasChildNodes()) deliveryEl.innerHTML = '<p class="text-center text-muted">No orders for delivery.</p>';
        if (!completedEl.hasChildNodes()) completedEl.innerHTML = '<p class="text-center text-muted">No completed orders.</p>';
    })
    .catch(err => console.error("Fetch error:", err));
}

function getHeaderColor(status) {
    switch(status) {
        case '1': return 'bg-warning text-dark';
        case '2': return 'bg-info text-dark';
        case '3': return 'bg-primary text-white';
        case '4': return 'bg-success text-white';
        case '5': return 'bg-danger text-white';
        default: return 'bg-secondary text-white';
    }
}

function showOrderModal(order_id) {
    const modalTitle = document.getElementById('modalOrderTitle');
    const modalBody = document.getElementById('modalOrderBody');

    modalTitle.textContent = `Order #${order_id} Details`;
    modalBody.innerHTML = 'Loading...';

    fetch(`/PaOrder/datafetcher/customers_data.php?action=getOrderDetails&order_no=${encodeURIComponent(order_id)}`)
    .then(res => res.json())
    .then(data => {
        if (!data.success) {
            modalBody.innerHTML = `<p class="text-danger">Error fetching order details.</p>`;
            return;
        }

        const orderItems = data.data.filter(d => d.ORDER_ID === order_id);

        if (orderItems.length === 0) {
            modalBody.innerHTML = `<p class="text-center text-muted">No items found for this order.</p>`;
            return;
        }

        const itemsTableRows = orderItems.map(i => `
            <tr>
                <td>${i.PRD_SKU_NAME}</td>
                <td class="text-center">${i.QTY_PIECE}</td>
                <td class="text-end">₱${parseFloat(i.PRICE_PIECE).toLocaleString('en-PH', {minimumFractionDigits:2})}</td>
                <td class="text-end">₱${(i.ORDER_VALUE_WITHOUTSCHEME).toLocaleString('en-PH', {minimumFractionDigits:2})}</td>
            </tr>
        `).join('');

     // Calculate totals dynamically
const totalAmount = orderItems.reduce((sum, i) => sum + parseFloat(i.ORDER_VALUE || 0), 0);
const schemeAmount = orderItems.reduce((sum, i) => sum + parseFloat(i.SCHEME_VALUE || 0), 0);
const netAmount = orderItems.reduce((sum, i) => sum + parseFloat(i.ORDER_VALUE_WITHOUTSCHEME || 0), 0);

modalBody.innerHTML = `
    <p><strong>Date:</strong> ${orderItems[0].ORDER_DATE}</p>
    <p><strong>Total Amount:</strong> ₱${totalAmount.toLocaleString('en-PH', {minimumFractionDigits:2})}</p>
    <p><strong>Scheme Amount:</strong> ₱${schemeAmount.toLocaleString('en-PH', {minimumFractionDigits:2})}</p>
    <p><strong>Net Amount:</strong> ₱${netAmount.toLocaleString('en-PH', {minimumFractionDigits:2})}</p>
    <p><strong>Status:</strong> ${orderItems[0].STATUS || 'Pending'}</p>
    <hr>
    <div class="table-responsive">
        <table class="table table-bordered table-sm">
            <thead class="table-light">
                <tr>
                    <th>Item Name</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-end">Price</th>
                    <th class="text-end">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                ${itemsTableRows}
            </tbody>
        </table>
    </div>
`;


        const orderModalEl = document.getElementById('orderModal');
        const orderModal = new bootstrap.Modal(orderModalEl);
        orderModal.show();

    }).catch(err => {
        modalBody.innerHTML = `<p class="text-danger">Fetch error: ${err}</p>`;
    });
}
</script>

</body>
</html>
