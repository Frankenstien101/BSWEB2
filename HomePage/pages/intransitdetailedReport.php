<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<title>Stock ledger</title>
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
<h3>IN-TRANSIT DETAILED REPORT</h3>

<!-- Filter Cards Container -->
<div class="filter-container">
    <!-- Seller Selection Card -->
   

    <!-- Date Filter Card -->
    <div class="card text-bg-light mb-1 justify-content-between" style="width: 24%; font-size: 9px;">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>SELECT DATE FILTER</span>
        </div>
        <div class="card-body date-filter-body">
            <div class="header">
                <label>Date From:</label>
                <input type="date" id="datefrom"  value="<?php echo date('Y-m-d'); ?>" />
                <label>to</label>
                <input type="date" id="dateto"  value="<?php echo date('Y-m-d'); ?>" />
                <button class="btn btn-primary btn-sm" onclick="loaditems()">GENERATE</button>
            </div>
            <div id="date-error" class="error-message"></div>
        </div>
    </div>
</div>

<!-- Summary Card -->

<!-- Table Card -->
<div class="card text-bg-light" style="max-width: 100%; height: 630px; margin-bottom: 0.5rem; font-size: 9px;">
    <div class="card-header"></div>
    <div class="card-body card-body-scroll">
        <table id="itemsTable" class="table table-striped table-hover table-bordered table-sm" style="font-size: 9px;">
   <thead>
    <tr>
    <th>#</th>
    <th>LINEID</th>
    <th>PO DATE</th>
    <th>DATE RECEIVED</th>
    <th>PO NUMBER</th>
    <th>GRN NUMBER</th>
    <th>CASE BARCODE</th>
    <th>IT BARCODE</th>
    <th>ITEM ID</th>
    <th>BATCH</th>
    <th>DESCRIPTION</th>
    <th>AMOUNT</th>
    <th>PO CS</th>
    <th>PO SW</th>
    <th>PO IT</th>
    <th>SERVE CS</th>
    <th>SERVE SW</th>
    <th>SERVE IT</th>
    <th>AMOUNT SERVED</th>
    <th>ACTUAL CS</th>
    <th>ACTUAL SW</th>
    <th>ACTUAL IT</th>
    <th>STATUS</th>

    </tr>
</thead>
            <tbody></tbody>
        </table>
    </div>
    <div id="table-error" class="error-message"></div>
    <div id="table-success" class="success-message"></div>
</div>

<!-- Pagination Card -->


<!-- Export Button -->
<div class="text-right mb-0">
    <button class="btn btn-success btn-sm mb-2" onclick="exportToExcel()">Export Data</button>
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
  <div class="toast" id="poprocessed" data-delay="3000">
    <div class="toast-header bg-success text-white">
      <strong class="mr-auto">Exporting Data</strong>
      <small>Just now</small>
      <button type="button" class="ml-2 mb-1 close text-white" data-dismiss="toast">&times;</button>
    </div>
    <div class="toast-body">
      Generating Report, Data will be sent to download list. 
    </div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
   // loaditems();
});

let loadedPOs = []; // Global storage

function showLoader() {
    document.getElementById("loading").style.display = "flex";
}

function hideLoader() {
    document.getElementById("loading").style.display = "none";
}
function loaditems() {
    const companyId = "<?php echo $_SESSION['COMPANY_ID'] ?? ''; ?>";
    const siteid = "<?php echo $_SESSION['SITE_ID'] ?? ''; ?>";
    const dateFrom = document.getElementById('datefrom').value;
    const dateTo = document.getElementById('dateto').value;

    const tbody = document.querySelector('#itemsTable tbody');
    if (!tbody) return;

    tbody.innerHTML = '';
    showLoader();

    fetch(`/HomePage/datafetcher/reports/getdatareports.php?action=intransitdetailed&company=${encodeURIComponent(companyId)}&siteid=${encodeURIComponent(siteid)}&datefrom=${encodeURIComponent(dateFrom)}&dateto=${encodeURIComponent(dateTo)}`)
        .then(response => {
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            return response.json();
        })
        .then(data => {
            loadedPOs = data;
            if (!data || data.length === 0) {
                const tr = document.createElement('tr');
                tr.innerHTML = '<td colspan="23" class="text-center">No items found.</td>';
                tbody.appendChild(tr);
                return;
            }

            data.forEach((item, index) => {
                const tr = document.createElement('tr');

                 let statusClass = '';
                  if (item.STATUS === 'RECEIVED') {
                      statusClass = 'bg-green';
                  } else if (item.STATUS === 'ALLOCATED') {
                      statusClass = 'bg-yellow';
                  } else if (item.STATUS === 'DRAFT') {
                      statusClass = 'bg-blue';
                  }
               tr.innerHTML = `
               <td>${index + 1}</td>
               <td>${item.LINEID || ''}</td>
                <td>${item.PO_DATE || ''}</td>
                <td>${item.DATE_RECEIVED || ''}</td>
                <td>${item.PO_NUMBER || ''}</td>
                <td>${item.GRN_NUMBER || ''}</td>
                <td>${item.CASE_BARCODE || ''}</td>
                <td>${item.IT_BARCODE || ''}</td>
                <td>${item.ITEM_ID || ''}</td>
                <td>${item.BATCH || ''}</td>
                <td>${item.DESCRIPTION || ''}</td>
                <td>${item.AMOUNT || ''}</td>
                <td>${item.PO_CS || ''}</td>
                <td>${item.PO_SW || ''}</td>
                <td>${item.PO_IT || ''}</td>
                <td>${item.SERVE_CS || ''}</td>
                <td>${item.SERVE_SW || ''}</td>
                <td>${item.SERVE_IT || ''}</td>
                <td>${item.AMOUNT_SERVED || ''}</td>
                <td>${item.ACTUAL_CS || ''}</td>
                <td>${item.ACTUAL_SW || ''}</td>
                <td>${item.ACTUAL_IT || ''}</td>
                <td class="${statusClass}">${item.STATUS || ''}</td>
            `;

                tbody.appendChild(tr);
            });
        })
        .catch(err => {
            console.error('Error loading items:', err);
        })
        .finally(() => {
            hideLoader();
        });
}

function exportToExcel() {
    if (!loadedPOs.length) {
        alert("No data to export!");
        return;
    }

    // Convert array of objects to worksheet
    const worksheet = XLSX.utils.json_to_sheet(loadedPOs);

    // Create workbook and add worksheet
    const workbook = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(workbook, worksheet, "Details");

    // Export the Excel file
    XLSX.writeFile(workbook, "IntransitReportDetailed.xlsx");
}

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>
</html>