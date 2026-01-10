
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders List - Modern Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.9.4/dist/css/tempus-dominus.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .card-shadow { box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075); }
        .table thead { background-color: #0d6efd; color: white; }
        .item-table th { background-color: #f1f3f5; font-weight: 600; }
        #loading { display: none; }
        .loader { text-align: center; padding: 20px; }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="card card-shadow border-0">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="bi bi-cart4 me-2"></i>Orders List</h4>
            </div>
            <div class="card-body">
                <!-- Fetch Controls (No Form Submit) -->
                <div class="row g-3 mb-4 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label">Start Date</label>
                        <div class="input-group" id="start-datepicker">
                            <input type="text" id="start_date" class="form-control" placeholder="yyyy-mm-dd" value="<?php echo date('Y-m-d'); ?> ">
                            <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">End Date</label>
                        <div class="input-group" id="end-datepicker">
                            <input type="text" id="end_date" class="form-control" placeholder="yyyy-mm-dd" value="<?php echo date('Y-m-d'); ?>">
                            <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <button id="fetch-btn" class="btn btn-primary me-2">
                            <span id="fetch-text"><i class="bi bi-download"></i> Fetch Orders</span>
                            <span id="loading" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        </button>
                        <button id="reset-btn" class="btn btn-secondary">
                            <i class="bi bi-arrow-clockwise"></i> Reset
                        </button>
                    </div>
                </div>

                <!-- Dynamic Table Container -->
                <div id="orders-container">
                    <div class="text-center text-muted py-5">
                        Select dates and click "Fetch Orders" to load data.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Dynamic Modals Container -->
    <div id="modals-container"></div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.9.4/dist/js/tempus-dominus.min.js"></script>

    <script>
        // Date Pickers
        new tempusDominus.TempusDominus(document.getElementById('start-datepicker'), {
            localization: { format: 'yyyy-MM-dd' },
            display: { components: { clock: false } }
        });
        new tempusDominus.TempusDominus(document.getElementById('end-datepicker'), {
            localization: { format: 'yyyy-MM-dd' },
            display: { components: { clock: false } }
        });

        // Constants
        const companyId = "<?php echo $_SESSION['Company_ID'] ?? 'NO_DATA'; ?>";
        const API_PATH = '/PaOrder/datafetcher/customers_data.php';

        const ordersContainer = document.getElementById('orders-container');
        const modalsContainer = document.getElementById('modals-container');
        const startInput = document.getElementById('start_date');
        const endInput = document.getElementById('end_date');
        const fetchBtn = document.getElementById('fetch-btn');
        const loading = document.getElementById('loading');
        const fetchText = document.getElementById('fetch-text');

        function showLoader() {
            loading.style.display = 'inline-block';
            fetchText.style.display = 'none';
            fetchBtn.disabled = true;
        }

        function hideLoader() {
            loading.style.display = 'none';
            fetchText.style.display = 'inline-block';
            fetchBtn.disabled = false;
        }

        function getBadgeClass(status) {
            status = (status || '').toUpperCase().trim();
            if (status === 'COMPLETED') return 'success';
            if (status === 'PENDING') return 'warning';
            if (status === 'CANCELLED') return 'danger';
            return 'secondary';
        }

        // Main Load Function — EXACTLY your preferred style
        function loadOrders() {
            const start = startInput.value.trim();
            const end = endInput.value.trim();

            showLoader();

            fetch(`${API_PATH}?action=getStoreOrders&company=${companyId}&start_date=${encodeURIComponent(start)}&end_date=${encodeURIComponent(end)}`)
                .then(res => {
                    if (!res.ok) throw new Error('Network error');
                    return res.json();
                })
                .then(res => {
                    if (res.error) throw new Error(res.message || res.error);

                    const orders = res.data || [];

                    renderTable(orders);
                    renderModals(orders);
                })
                .catch(err => {
                    console.error('Fetch error:', err);
                    ordersContainer.innerHTML = `<div class="alert alert-danger">Error: ${err.message}</div>`;
                    modalsContainer.innerHTML = '';
                })
                .finally(() => hideLoader());
        }

        function renderTable(orders) {
            if (orders.length === 0) {
                ordersContainer.innerHTML = '<div class="text-center text-muted py-5">No orders found.</div>';
                return;
            }

            let html = `
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer Name</th>
                                <th>Order Date</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>`;

            orders.forEach(order => {
                const badge = getBadgeClass(order.STATUS);
                html += `
                    <tr>
                        <td>${order.ORDER_ID || ''}</td>
                        <td>${order.CUSTOMER_NAME || ''}</td>
                        <td>${order.ORDER_DATE || ''}</td>
                        <td><strong>${parseFloat(order.TOTAL_AMOUNT || 0).toLocaleString(undefined, {minimumFractionDigits: 2})}</strong></td>
                        <td><span class="badge bg-${badge}">${order.STATUS || ''}</span></td>
                        <td>
                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#orderModal${order.ORDER_ID}">
                                <i class="bi bi-eye"></i> View Details
                            </button>
                        </td>
                    </tr>`;
            });

            html += `</tbody></table></div>`;
            ordersContainer.innerHTML = html;
        }

        function renderModals(orders) {
            let modals = '';

            orders.forEach(order => {
                const badge = getBadgeClass(order.STATUS);
                const items = order.items || [];

                let itemsTable = items.length > 0 ? `
                    <div class="table-responsive">
                        <table class="table table-striped item-table">
                            <thead>
                                <tr><th>#</th><th>Barcode</th><th>Description</th><th>Qty</th><th>Price</th><th>Amount</th></tr>
                            </thead>
                            <tbody>
                                ${items.map((item, i) => `
                                    <tr>
                                        <td>${i + 1}</td>
                                        <td>${item.BARCODE || ''}</td>
                                        <td>${item.DESCRIPTION || ''}</td>
                                        <td>${item.QTY || 0}</td>
                                        <td>${parseFloat(item.PRICE || 0).toLocaleString(undefined, {minimumFractionDigits: 2})}</td>
                                        <td>${parseFloat(item.AMOUNT || 0).toLocaleString(undefined, {minimumFractionDigits: 2})}</td>
                                    </tr>
                                `).join('')}
                            </tbody>
                            <tfoot>
                                <tr class="table-primary fw-bold">
                                    <th colspan="5" class="text-end">Total:</th>
                                    <th>${parseFloat(order.TOTAL_AMOUNT || 0).toLocaleString(undefined, {minimumFractionDigits: 2})}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>` : '<div class="alert alert-info">No items found.</div>';

                modals += `
                    <div class="modal fade" id="orderModal${order.ORDER_ID}" tabindex="-1">
                        <div class="modal-dialog modal-xl modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title"><i class="bi bi-receipt me-2"></i>Order Details - #${order.ORDER_ID}</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row g-4 mb-4">
                                        <div class="col-md-6">
                                            <div class="card border-0 shadow-sm">
                                                <div class="card-body">
                                                    <h6 class="card-title text-primary"><i class="bi bi-person"></i> Customer</h6>
                                                    <p class="mb-0"><strong>Name:</strong> ${order.CUSTOMER_NAME || 'N/A'}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card border-0 shadow-sm">
                                                <div class="card-body">
                                                    <h6 class="card-title text-primary"><i class="bi bi-calendar3"></i> Order Info</h6>
                                                    <p class="mb-0"><strong>Date:</strong> ${order.ORDER_DATE || 'N/A'}</p>
                                                    <p class="mb-0"><strong>Status:</strong> <span class="badge bg-${badge}">${order.STATUS || 'Unknown'}</span></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 text-center">
                                            <div class="card border-0 shadow-sm">
                                                <div class="card-body py-4">
                                                    <h3 class="text-primary mb-0">${parseFloat(order.TOTAL_AMOUNT || 0).toLocaleString(undefined, {minimumFractionDigits: 2})}</h3>
                                                    <p class="text-muted fw-bold mb-0">Total Amount</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h5 class="text-primary mb-3"><i class="bi bi-basket2"></i> Order Items</h5>
                                    ${itemsTable}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" onclick="window.print()">
                                        <i class="bi bi-printer"></i> Print Order
                                    </button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>`;
            });

            modalsContainer.innerHTML = modals;
        }

        // Event Listeners
        fetchBtn.addEventListener('click', loadOrders);

        document.getElementById('reset-btn').addEventListener('click', () => {
            startInput.value = '';
            endInput.value = '';
            ordersContainer.innerHTML = '<div class="text-center text-muted py-5">Select dates and click "Fetch Orders" to load data.</div>';
            modalsContainer.innerHTML = '';
        });

        // Enter key support
        [startInput, endInput].forEach(input => {
            input.addEventListener('keypress', e => {
                if (e.key === 'Enter') loadOrders();
            });
        });
    </script>
</body>
</html>