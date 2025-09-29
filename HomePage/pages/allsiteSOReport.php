<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<title>Invoice Detailed</title>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" />
<style>
    #pagination {
        overflow-x: auto;
        white-space: nowrap;
    }
    #pagination .page-item {
        flex: 0 0 auto;
    }
    .card-body-scroll {
        overflow-y: auto;
        max-width: 100%;
        height: 600px;
    }
    table {
        table-layout: auto;
        width: 100%;
        border-collapse: collapse;
    }
    table th, table td {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        padding: 4px 8px;
    }
    .table-container {
        overflow: auto;
    }
    .table-container::-webkit-scrollbar {
        width: 6px;
        height: 6px;
    }
    .table-container::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 3px;
    }
    .table-container::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 3px;
    }
    .table-container::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
    .seller-table {
        font-size: 9px;
        width: 100%;
        border: 1px solid #dee2e6;
    }
    .seller-table th, .seller-table td {
        padding: 2px 6px;
        text-align: left;
        border-bottom: 1px solid #dee2e6;
    }
    .seller-table th {
        background-color: #f8f9fa;
        font-weight: 600;
    }
    .card {
        border: 1px solid #dee2e6;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }
    .card-header {
        background-color: #e9ecef;
        font-weight: 600;
        padding: 6px 10px;
        font-size: 9px;
    }
    .filter-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 0.5rem;
    }
    .date-filter-body {
        padding: 8px;
    }
    .date-filter-body .header {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .date-filter-body input[type="date"],
    .date-filter-body button {
        font-size: 9px;
        padding: 3px 6px;
    }
    .error-message {
        color: red;
        font-size: 9px;
        margin-top: 5px;
    }
    .success-message {
        color: green;
        font-size: 9px;
        margin-top: 5px;
    }
    .sortable {
        cursor: pointer;
    }
    .sortable:hover {
        background-color: #f8f9fa;
    }
    .sort-asc::after {
        content: " ↑";
    }
    .sort-desc::after {
        content: " ↓";
    }
    @media (max-width: 768px) {
        .filter-container {
            flex-direction: column;
        }
        .card {
            width: 100% !important;
        }
    }
</style>
</head>
<body>
<h3>ALL SITE S.O REPORT</h3>

<!-- Filter Cards Container -->
<div class="filter-container">
    <!-- Seller Selection Card -->
    <div class="card text-bg-light" style="width: 250px; font-size: 9px;">
        <div class="card-header d-flex justify-content-between align-items-right">
            <span>SELECT SITE</span>
        </div>
        <div class="card-body" style="padding: 8px;">
            <div class="table-container" style="height:100px;">
                <table class="seller-table">
                    <thead>
                        <tr>
                            <th>Site</th>
                            <th>Select</th>
                        </tr>
                    </thead>
                    <tbody id="seller-table-body">
                        <!-- Dynamic sellers will be appended here -->
                    </tbody>
                </table>
            </div>
            <div id="seller-error" class="error-message"></div>
        </div>
    </div>

    <!-- Date Filter Card -->
    <div class="card text-bg-light" style="max-width: 50%; font-size: 9px;">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>SELECT DATE FILTER</span>
        </div>
        <div class="card-body date-filter-body">
            <div class="header">
                <label>Date From:</label>
                <input type="date" id="datefrom"  value="<?php echo date('Y-m-d'); ?>" />
                <label>to</label>
                <input type="date" id="dateto"  value="<?php echo date('Y-m-d'); ?>" />
                <button class="btn btn-primary btn-sm" onclick="applyFilters()">GENERATE</button>
            </div>
            <div id="date-error" class="error-message"></div>
        </div>
    </div>
</div>

<!-- Summary Card -->

<!-- Table Card -->
<div class="card text-bg-light" style="max-width: 100%; height: 450px; margin-bottom: 0.5rem; font-size: 9px;">
    <div class="card-header"></div>
    <div class="card-body card-body-scroll">
        <table id="itemsTable" class="table table-striped table-hover table-bordered table-sm" style="font-size: 9px;">
            <thead>
                <tr>
<thead>
<tr>
    <th>#</th>
   <th>COMPANY_ID</th>
                <th>SITE ID</th>
                <th>TRANSACTION ID</th>
                <th>INVOICE TYPE</th>
                <th>TRANSACTION DATE</th>
                <th>SELLER ID</th>
                <th>SELLER NAME</th>
                <th>CUSTOMER ID</th>
                <th>CUSTOMER NAME</th>
                <th>ITEM ID</th>
                <th>BATCH</th>
                <th>DESCRIPTION</th>
                <th>CS</th>
                <th>SW</th>
                <th>IT</th>
                <th>ALLOCATED CS</th>
                <th>ALLOCATED SW</th>
                <th>ALLOCATED IT</th>
                <th>CS AMOUNT</th>
                <th>SW AMOUNT</th>
                <th>IT AMOUNT</th>
                <th>TOTAL AMOUNT</th>
                <th>TAX AMOUNT</th>
                <th>TOTAL</th>
                <th>DISCOUNT</th>
                <th>TAX</th>
                <th>IT PER CS</th>
                <th>IT PER SW</th>
                <th>STATUS</th>
                <th>DISCOUNT AMOUNT</th>
</tr>
</thead>

            <tbody></tbody>
        </table>
    </div>
    <div id="table-error" class="error-message"></div>
    <div id="table-success" class="success-message"></div>
</div>

<!-- Pagination Card -->
<div class="card bg-light" style="max-width: 100%; margin-bottom: 0.5rem; font-size: 9px;">
    <div class="card-header">Page</div>
    <div class="card-body p-2" style="overflow-x: auto; max-width: 100%; white-space: nowrap;">
        <nav style="display: inline-block;">
            <ul id="pagination" class="pagination pagination-sm mb-0" style="display: inline-flex; flex-wrap: nowrap;"></ul>
        </nav>
    </div>
</div>

<!-- Export Button -->
<div class="text-right mb-0">
    <button class="btn btn-success btn-sm mb-2" onclick="exportToCSV()">Export to CSV</button>

</div>

<!-- Loader -->
<div id="loading" style="
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(255, 255, 255, 0.8);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 9999;">
    <div style="text-align:center;">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
        <div style="margin-top:10px;">Loading Data...</div>
    </div>
</div>


<div aria-live="polite" aria-atomic="true" style="position: fixed; bottom: 80px; right: 20px; min-width: 250px; z-index: 1080; pointer-events: none;">
  <div class="toast" id="poprocessed" data-delay="5000">
    <div class="toast-header bg-success text-white">
      <strong class="mr-auto">Exporting Data</strong>
      <small>Just now</small>
      <button type="button" class="ml-2 mb-1 close text-white" data-dismiss="toast">&times;</button>
    </div>
    <div class="toast-body">
      Generating Report, Data will be sent to download list. Large data may take some time. 
    </div>
  </div>
</div>

<script>
    
    let loadedPOs = [];
    let totalRecords = 0;
    let rowsPerPage = 500;
    let currentPage = 1;
    let sortColumn = null;
    let sortDirection = 'asc';

    // For filters
    window.filters = {};

    // Show/hide loader
    function showLoader() {
        document.getElementById("loading").style.display = "flex";
    }
    function hideLoader() {
        document.getElementById("loading").style.display = "none";
    }

    function showMessage(elementId, message, isError = true) {
        const el = document.getElementById(elementId);
        el.textContent = message;
        el.style.display = 'block';
        el.className = isError ? 'error-message' : 'success-message';
        if (!isError) {
            setTimeout(() => { el.style.display = 'none'; }, 3000);
        }
    }

    function clearMessages() {
        document.querySelectorAll('.error-message, .success-message').forEach(el => {
            el.style.display = 'none';
            el.textContent = '';
        });
    }

    // Fetch sellers on page load
    document.addEventListener("DOMContentLoaded", function () {
        fetchSellers();
       // loadItems2(1);
    });

    // Fetch sellers from server
    function fetchSellers() {
        const companyId = "<?php echo $_SESSION['COMPANY_ID'] ?? 'default'; ?>";
        const siteId = "<?php echo $_SESSION['SITE_ID'] ?? 'default'; ?>";

        clearMessages();
        showLoader();

        fetch(`/HomePage/datafetcher/reports/getdatareports.php?action=getsites&company=${encodeURIComponent(companyId)}&site=${encodeURIComponent(siteId)}`)
            .then(res => {
                if (!res.ok) return res.text().then(t => { throw new Error(t); });
                return res.json();
            })
            .then(res => {
                if (res.error) throw new Error(res.message);
                const tbody = document.getElementById('seller-table-body');
                tbody.innerHTML = '<tr><td>ALL</td><td><input type="checkbox" id="seller-all"></td></tr>';

                res.forEach(seller => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${seller.SITE_CODE || seller.SITEID}</td>
                        <td><input type="checkbox" name="seller" value="${seller.SITEID}" class="seller-checkbox"></td>
                    `;
                    tbody.appendChild(tr);
                });

                // Add event for 'All' checkbox
                const allCheckbox = document.getElementById('seller-all');
                allCheckbox.addEventListener('change', function () {
                    document.querySelectorAll('input[name="seller"]').forEach(cb => cb.checked = this.checked);
                });

                // Add change event for individual checkboxes
                document.querySelectorAll('input[name="seller"]').forEach(cb => {
                    cb.addEventListener('change', function () {
                        const allChecked = Array.from(document.querySelectorAll('input[name="seller"]')).every(c => c.checked);
                        document.getElementById('seller-all').checked = allChecked;
                    });
                });
            })
            .catch(err => {
                console.error('fetchSellers error:', err);
                showMessage('seller-error', 'Failed to load sites: ' + err.message);
            })
            .finally(() => hideLoader());
    }

    // Toggle all sellers
    function toggleAllSellers(selectAll) {
        document.querySelectorAll('input[name="seller"]').forEach(cb => cb.checked = selectAll);
        document.getElementById('seller-all').checked = selectAll;
    }

    // Clear filters
    function clearFilters() {
        document.getElementById('datefrom').value = '';
        document.getElementById('dateto').value = '';
        toggleAllSellers(false);
        clearMessages();
    }

    // Validate date range
    function validateDateRange() {
        const dateFrom = document.getElementById('datefrom').value;
        const dateTo = document.getElementById('dateto').value;
        if (dateFrom && dateTo && dateFrom > dateTo) {
            showMessage('date-error', 'End date must be after start date');
            return false;
        }
        return true;
    }

    // Get selected sellers
    function getSelectedSellers() {
        const checkboxes = document.querySelectorAll('input[name="seller"]:checked');
        const selectedSellers = Array.from(checkboxes).map(cb => cb.value);
      // alert(selectedSellers)
        return selectedSellers;
    }

    // Apply filters and fetch data
    function applyFilters() {
        if (!validateDateRange()) return;

        const sellers = getSelectedSellers();

        if (sellers.length === 0) {
            showMessage('seller-error', 'Please select at least one site.');
            return;
        }

        const dateFrom = document.getElementById('datefrom').value;
        const dateTo = document.getElementById('dateto').value;

        window.filters = {
            sellers: sellers,
            dateFrom: dateFrom,
            dateTo: dateTo
        };

        loadItems2(1);
    }

    // Load data based on filters
    

    // Load general data (initial load or fallback)
 // JS part

// Example rowsPerPage variable (set as needed)
//const rowsPerPage = 10;

// Load items and render table
     // Global current page tracker
  // Rows per page, adjust as needed
   // Total records count from server
window.filters = {};     // Placeholder for filters object

function loadItems2(page = 1) {
    currentPage = page;  // Update global current page

    const companyId = "<?php echo $_SESSION['COMPANY_ID'] ?? ''; ?>";
    const siteid = "<?php echo $_SESSION['SITE_ID'] ?? ''; ?>";

    const dateFrom = document.getElementById('datefrom');
    const dateTo = document.getElementById('dateto');

    if (!dateFrom || !dateTo) {
        hideLoader();
        alert("Please ensure 'datefrom' and 'dateto' inputs exist.");
        return;
    }

    const datefrom = dateFrom.value;
    const dateto = dateTo.value;

    if (!datefrom || !dateto) {
       hideLoader();
       alert("Please enter valid dates.");
       return;
    }

    const sellerCheckboxes = document.querySelectorAll('input[name="seller"]');
    if (!sellerCheckboxes) {
        hideLoader();
        alert("Please ensure seller checkboxes exist.");
        return;
    }

    const sellers = Array.from(sellerCheckboxes)
                        .filter(cb => cb.checked)
                        .map(cb => cb.value);

    console.log("companyId:", companyId);
    console.log("siteid:", siteid);
    console.log("page:", page);
    console.log("rowsPerPage:", rowsPerPage);
    console.log("sellers:", sellers);

    showLoader();

    fetch(`/HomePage/datafetcher/reports/getdatareports.php?action=allsiteSOreport&company=${companyId}&siteid=${siteid}&page=${page}&limit=${rowsPerPage}&sellers=${encodeURIComponent(sellers.join(','))}&datefrom=${encodeURIComponent(datefrom)}&dateto=${encodeURIComponent(dateto)}`)
        .then(response => {
            if (!response.ok) {
                hideLoader();
                console.error("HTTP error! status:", response.status);
                return response.text().then(text => alert(`Error fetching data: ${text}`));
            }
            return response.json();
        })
        .then(data => {
            hideLoader();
            console.log("Data received:", data);

            if (data.total !== undefined) {
                totalRecords = data.total;  // Update total records for pagination
            }

            if (data.data) {
               renderTable(data.data, page);
            } else {
                renderTable(data, page);
            }

            renderPagination();

            if (data.debug_sql) {
                console.log("Debug SQL:", data.debug_sql);
            }
        })
        .catch(error => {
            hideLoader();
            console.error("Fetch error:", error);
            alert("Error fetching data from the server.");
        });
}

// Render table rows from data array
function renderTable(data, currentPage = 1) {
    const tbody = document.querySelector('#itemsTable tbody');
    if (!tbody) return;

    tbody.innerHTML = '';

    data.forEach((item, index) => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
          <td>${(currentPage - 1) * rowsPerPage + index + 1}</td>
            <td>${item.COMPANY_ID || ''}</td>
            <td>${item.SITE_ID || ''}</td>
            <td>${item.TRANSACTION_ID || ''}</td>
            <td>${item.INVOICE_TYPE || ''}</td>
            <td>${item.TRANSACTION_DATE || ''}</td>
            <td>${item.SELLER_ID || ''}</td>
            <td>${item.SELLER_NAME || ''}</td>
            <td>${item.CUSTOMER_ID || ''}</td>
            <td>${item.CUSTOMER_NAME || ''}</td>
            <td>${item.ITEM_ID || ''}</td>
            <td>${item.BATCH || ''}</td>
            <td>${item.DESCRIPTION || ''}</td>
            <td>${item.CS || ''}</td>
            <td>${item.SW || ''}</td>
            <td>${item.IT || ''}</td>
            <td>${item.ALLOCATED_CS || ''}</td>
            <td>${item.ALLOCATED_SW || ''}</td>
            <td>${item.ALLOCATED_IT || ''}</td>
            <td>${item.CS_AMOUNT || ''}</td>
            <td>${item.SW_AMOUNT || ''}</td>
            <td>${item.IT_AMOUNT || ''}</td>
            <td>${item.TOTAL_AMOUNT || ''}</td>
            <td>${item.TAX_AMOUNT || ''}</td>
            <td>${item.TOTAL || ''}</td>
            <td>${item.DISCOUNT || ''}</td>
            <td>${item.TAX || ''}</td>
            <td>${item.IT_PER_CS || ''}</td>
            <td>${item.IT_PER_SW || ''}</td>
            <td>${item.STATUS || ''}</td>
            <td>${item.DISCOUNT_AMOUNT || ''}</td>
        `;
        tbody.appendChild(tr);
    });
}

// Render pagination UI
function renderPagination() {
    const totalPages = Math.ceil(totalRecords / rowsPerPage);
    const pagination = document.getElementById('pagination');
    if (!pagination) return;

    pagination.innerHTML = '';

    for (let i = 1; i <= totalPages; i++) {
        const li = document.createElement('li');
        li.className = `page-item ${i === currentPage ? 'active' : ''}`;
        li.innerHTML = `<a class="page-link" href="#">${i}</a>`;
        li.addEventListener('click', (e) => {
            e.preventDefault();
            currentPage = i;
            if (Object.keys(window.filters).length > 0) {
                if (typeof loadFilteredItems === 'function') {
                    loadFilteredItems(currentPage);
                } else {
                    loadItems2(currentPage);
                }
            } else {
                loadItems2(currentPage);
            }
        });
        pagination.appendChild(li);
    }
}

    // Update summary info
    function updateSummaryInfo(total, showingStart, showingEnd) {
        document.getElementById('total-records').textContent = total;
        document.getElementById('showing-range').textContent = `${showingStart}-${showingEnd}`;
        document.getElementById('total-count').textContent = total;
    }

    // Export to CSV (placeholder)
   function exportToCSV() {
    const companyId = "<?php echo $_SESSION['COMPANY_ID'] ?? ''; ?>";
    const siteid = "<?php echo $_SESSION['SITE_ID'] ?? ''; ?>";

    const dateFrom = document.getElementById('datefrom');
    const dateTo = document.getElementById('dateto');

    if (!dateFrom || !dateTo) {
        alert("Please ensure 'datefrom' and 'dateto' inputs exist.");
        return;
    }

    const datefrom = dateFrom.value;
    const dateto = dateTo.value;

    if (!datefrom || !dateto) {
        alert("Please enter valid dates.");
        return;
    }

    const sellerCheckboxes = document.querySelectorAll('input[name="seller"]');
    if (!sellerCheckboxes.length) {
        alert("Please ensure seller checkboxes exist.");
        return;
    }

    const sellers = Array.from(sellerCheckboxes)
        .filter(cb => cb.checked)
        .map(cb => cb.value);

    if (sellers.length === 0) {
        alert("Please select at least one seller.");
        return;
    }

    // Build export URL dynamically with your variables, URL-encoded
    const url = `/HomePage/datafetcher/reports/getdatareports.php?action=allsiteSOreportcsv&export=csv` +
        `&company=${encodeURIComponent(companyId)}` +
        `&siteid=${encodeURIComponent(siteid)}` +
        `&sellers=${encodeURIComponent(sellers.join(','))}` +
        `&datefrom=${encodeURIComponent(datefrom)}` +
        `&dateto=${encodeURIComponent(dateto)}`;

    // Trigger the download by navigating the browser to this URL
    window.location.href = url;

 $('#poprocessed').toast('show');

}

   function exportToCSVpurifier() {
    const companyId = "<?php echo $_SESSION['COMPANY_ID'] ?? ''; ?>";
    const siteid = "<?php echo $_SESSION['SITE_ID'] ?? ''; ?>";

    const dateFrom = document.getElementById('datefrom');
    const dateTo = document.getElementById('dateto');

    if (!dateFrom || !dateTo) {
        alert("Please ensure 'datefrom' and 'dateto' inputs exist.");
        return;
    }

    const datefrom = dateFrom.value;
    const dateto = dateTo.value;

    if (!datefrom || !dateto) {
        alert("Please enter valid dates.");
        return;
    }

    const sellerCheckboxes = document.querySelectorAll('input[name="seller"]');
    if (!sellerCheckboxes.length) {
        alert("Please ensure seller checkboxes exist.");
        return;
    }

    const sellers = Array.from(sellerCheckboxes)
        .filter(cb => cb.checked)
        .map(cb => cb.value);

    if (sellers.length === 0) {
        alert("Please select at least one seller.");
        return;
    }

    // Build export URL dynamically with your variables, URL-encoded
    const url = `/HomePage/datafetcher/reports/getdatareports.php?action=invoicedetailedexportcsvpurifier&export=csv` +
        `&company=${encodeURIComponent(companyId)}` +
        `&siteid=${encodeURIComponent(siteid)}` +
        `&sellers=${encodeURIComponent(sellers.join(','))}` +
        `&datefrom=${encodeURIComponent(datefrom)}` +
        `&dateto=${encodeURIComponent(dateto)}`;

    // Trigger the download by navigating the browser to this URL
    window.location.href = url;

 $('#poprocessed').toast('show');

}

    // Sorting table (placeholder)
    function sortTable(n) {
        // Sorting logic here
    }
</script>
<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>
</html>