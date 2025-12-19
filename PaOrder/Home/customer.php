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

    /* Loading Overlay */
    #loadingOverlay {
        z-index: 9999;
        transition: opacity 0.5s ease-out;
    }
    #loadingOverlay.hidden {
        opacity: 0;
        pointer-events: none;
    }
</style>
</head>
<body>

<!-- Loading Overlay -->
<div id="loadingOverlay" class="position-fixed top-0 start-0 w-100 h-100 bg-light bg-opacity-75 d-flex align-items-center justify-content-center">
    <div class="text-center">
        <div class="spinner-border text-primary mb-3" role="status" style="width: 4rem; height: 4rem;">
            <span class="visually-hidden">Loading...</span>
        </div>
        <h4 class="text-muted">Loading your orders...</h4>
    </div>
</div>

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
const orderModal = new bootstrap.Modal(document.getElementById('orderModal'));
const loadingOverlay = document.getElementById('loadingOverlay');

/* =========================
   PAGE NAV
========================= */
function showPage(id, e){
    if (e) e.preventDefault();

    document.querySelectorAll('.page-section').forEach(p => p.classList.remove('active'));
    document.getElementById(id).classList.add('active');

    if(id === 'myorders'){
        // Show loading overlay
        loadingOverlay.classList.remove('hidden');

        // Load all tabs in parallel
        Promise.all([
            loadPendingOrders(),
            loadForDeliveryOrders(),
            loadCompletedOrders()
        ]).then(() => {
            // Hide loading after all data is loaded
            setTimeout(() => {
                loadingOverlay.classList.add('hidden');
            }, 300);
        }).catch(() => {
            // Hide even if error
            loadingOverlay.classList.add('hidden');
        });
    } else {
        loadingOverlay.classList.add('hidden');
    }
}

/* =========================
   LOADERS
========================= */

function loadPendingOrders(){
    return fetchOrders(
        'viewmyorders',
        document.getElementById('pendingOrders'),
        createPendingCard
    );
}

function loadForDeliveryOrders(){
    return fetchOrders(
        'viewForDeliveryOrders',
        document.getElementById('forDeliveryOrders'),
        createForDeliveryCard
    );
}

function loadCompletedOrders(){
    return fetchOrders(
        'viewCompletedOrders',
        document.getElementById('completedOrders'),
        createCompletedCard
    );
}

function fetchOrders(action, container, cardBuilder){
    const company = "<?= $_SESSION['principal']; ?>";
    const store   = "<?= $_SESSION['store_id']; ?>";

    container.innerHTML = '<p class="text-center text-muted">Loading...</p>';

    return fetch(`/PaOrder/datafetcher/customers_data.php?action=${action}&companyid=${company}&storeid=${store}`)
    .then(res => res.json())
    .then(res => {
        container.innerHTML = '';
        if(!res.success || res.data.length === 0){
            container.innerHTML = '<p class="text-center text-muted">No orders found.</p>';
            return;
        }
        res.data.forEach(o => container.appendChild(cardBuilder(o)));
    })
    .catch(err => {
        console.error(err);
        container.innerHTML = '<p class="text-danger text-center">Load failed.</p>';
    });
}

/* =========================
   CARD BUILDERS
========================= */

function createPendingCard(o){
    return createCard(o, getStatusText(o.STATUS), getHeaderColor(o.STATUS),
        () => showOrderModalPending(o.order_no));
}

function createForDeliveryCard(o){
    return createCard(o, 'For Delivery', 'bg-warning',
        () => showOrderModalForDelivery(o.order_no));
}

function createCompletedCard(o){
    return createCard(o, 'Completed', 'bg-success',
        () => showOrderModalCompleted(o.order_no));
}

function createCard(o, statusText, headerClass, onClick){
    const card = document.createElement('div');
    card.className = 'card mb-3 shadow-sm';
    card.innerHTML = `
        <div class="card-header ${headerClass} text-white">
            <strong>${o.order_no}</strong>
            <span class="badge bg-dark float-end">${statusText}</span>
        </div>
        <div class="card-body">
            <p><strong>Date:</strong> ${o.order_date}</p>
            <p><strong>Total Amount:</strong> ₱${Number(o.TOTAL_AMOUNT).toLocaleString('en-PH',{minimumFractionDigits:2})}</p>
            <p><strong>Date to Deliver:</strong> ${o.DATE_TO_DELIVER ?? 'N/A'}</p>
        </div>
    `;
    card.onclick = onClick;
    return card;
}

/* =========================
   HELPERS
========================= */

function getStatusText(s){
    return s==='1'?'Prepared':s==='2'?'Ready':'Pending';
}

function getHeaderColor(s){
    return s==='1'?'bg-warning text-dark':s==='2'?'bg-info text-dark':'bg-secondary' ;
}

/* =========================
   MODALS
========================= */

function showOrderModalPending(orderNo){
    loadModal(
        `${orderNo}`,
        `getOrderDetails&order_no=${orderNo}`,
        buildItemsTable
    );
}

function showOrderModalForDelivery(orderNo){
    loadModal(
        `${orderNo}`,
        `getDeliveryDetails&order_no=${orderNo}`,
        buildDeliveryView

    );
}

function showOrderModalCompleted(orderNo){
    loadModal(
        `${orderNo}`,
        `getCompletedOrderDetails&order_no=${orderNo}`,
        buildCompletedView
    );
}

/* =========================
   MODAL CORE
========================= */

function loadModal(title, actionQuery, renderer){
    document.getElementById('modalOrderTitle').innerText = title;
    document.getElementById('modalOrderBody').innerHTML = 'Loading...';

    fetch(`/PaOrder/datafetcher/customers_data.php?action=${actionQuery}`)
    .then(r=>r.json())
    .then(res=>{
        document.getElementById('modalOrderBody').innerHTML = renderer(res.data);
        orderModal.show();
    })
    .catch(() => {
        document.getElementById('modalOrderBody').innerHTML = '<p class="text-danger">Failed to load details.</p>';
        orderModal.show();
    });
}

/* =========================
   MODAL VIEWS
========================= */

function buildItemsTable(items){
    const rows = items.map(i=>`
        <tr>
            <td>${i.PRD_SKU_NAME}</td>
            <td class="text-center">${i.QTY_PIECE}</td>
            <td class="text-end">₱${Number(i.PRICE_PIECE * 1.12).toLocaleString('en-PH',{minimumFractionDigits:2})}</td>
            <td class="text-end">₱${Number(i.ORDER_VALUE).toLocaleString('en-PH',{minimumFractionDigits:2})}</td>
        </tr>`).join('');

    return `
        <table class="table table-sm table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Item</th><th class="text-center">Qty</th>
                    <th class="text-end">Price</th><th class="text-end">Subtotal</th>
                </tr>
            </thead>
            <tbody>${rows}</tbody>
        </table>`;
}

function buildDeliveryView(data){
    return `
        <p><strong>Rider:</strong> ${data[0].RIDER_NAME || 'N/A'}</p>
        <p><strong>Vehicle:</strong> ${data[0].VEHICLE || 'N/A'}</p>
        <p><strong>ETA:</strong> ${data[0].ETA || 'N/A'}</p>
    `;
    
}

function buildCompletedView(data){
    return `
        <p><strong>Delivered On:</strong> ${data[0].DATE_TO_DELIVER || 'N/A'}</p>
        <p><strong>Agent:</strong> ${data[0].AGENT_ID || 'N/A'}</p>
        <p><strong>Proof of Delivery:</strong></p>
        ${data[0].POD_IMAGE ? `<img src="${data[0].POD_IMAGE}" class="img-fluid rounded mt-2" alt="Proof of Delivery">` : '<p class="text-muted">No image available</p>'}
    `;
}

// Hide loading overlay on initial load (Home page is default)
document.addEventListener('DOMContentLoaded', () => {
    loadingOverlay.classList.add('hidden');
});

</script>

</body>
</html>