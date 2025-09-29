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

    .bg-gold {
    background-color: #fac411ff; /* Classic gold */
    color: #080808ff; /* Black text for contrast */
}

</style>
</head>
<body>
<h3>VAN INVENTORY</h3>

<div class="filter-container">

    <div class="card text-bg-light mb-1 mt-2" style="width: 180px; font-size: 9px;">
        <div class="card-header d-flex justify-content-between align-items-right">
            <span>SELECT VAN</span>
           
        </div>
        <div class="card-body" style="padding: 8px;">
            <div class="table-container" style="height:30px;">
            <select id="cmbvan" name="van" class="form-control form-control-sm" style= "font-size :9px; height:25px; width: 100%;">
            </select>
        </div>
    </div>
 </div>
 </div>

<div class="card text-bg-light mt-1" style="max-width: 100%; height: 100%; margin-bottom: 0.5rem; font-size: 9px;">
    
<div class="card-header">

<div class="status-radio-group ml-1" style="display: flex; justify-content: flex-end; margin-left: auto;">

</div>

</div>
    <div class="card-body card-body-scroll">
        <table id="itemsTable" class="table table-striped table-hover table-bordered table-sm" style="font-size: 9px;">
            <thead>
                <tr>
                <thead>
                <tr>
                    <th>#</th>
                   <th>ITEM ID</th>
                  <th>BATCH</th>
                   <th>DESCRIPTION</th>
                    <th>CS</th>
                    <th>SW</th>
                    <th>IT</th>
                    <th>PRICE</th>
                    <th>IT/CS</th>
                    <th>IT/SW</th>
                    <th>SIH</th>
                    </tr>
                    </thead>
             <tbody></tbody>
        </table>
    </div>
    <div id="table-error" class="error-message"></div>
    <div id="table-success" class="success-message"></div>
</div>

  <div class="text-right mb-0">
<button class="btn btn-success mb-2" onclick="exportToExcel()">Export to Excel</button>  </div>


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

<input type="hidden" id="vanselected">

<script>

function loadvan() {
    const companyid = "<?php echo $_SESSION['COMPANY_ID'] ?? ''; ?>";
    const siteid = "<?php echo $_SESSION['SITE_ID'] ?? ''; ?>";
    const vanselect = document.getElementById('cmbvan');
    const vanfield = document.getElementById('vanselected');

    // Reset options
    vanselect.innerHTML = '<option value="" disabled selected>Select an option</option>';

    fetch(`/HomePage/datafetcher/reports/getdatareports.php?action=selecthfs&company=${encodeURIComponent(companyid)}&siteid=${encodeURIComponent(siteid)}`)
        .then(response => {
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            return response.json();
        })
        .then(data => {
            if (!Array.isArray(data)) {
                console.error("Invalid van data", data);
                return;
            }

            data.forEach(item => {
                const option = document.createElement('option');
                option.value = item.SELLER_ID || '';
                option.textContent = item.SELLER_ID || 'Unknown';
                option.dataset.category = item.SELLER_ID || ''; // ✅ use CATEGORY_DESC
                vanselect.appendChild(option);
            });
        })
        .catch(err => {
            console.error('Error loading van:', err);
        });
}

// attach change listener once
document.getElementById('cmbvan').addEventListener('change', function () {
    const selectedOption = this.options[this.selectedIndex];
    document.getElementById('vanselected').value = selectedOption.dataset.SELLER_ID || '';
    loaditems();
});

    function showLoader() {
        document.getElementById("loading").style.display = "flex";
    }
    function hideLoader() {
        document.getElementById("loading").style.display = "none";
    }


    document.addEventListener("DOMContentLoaded", function () {
        loadvan();
  
    });

let loadedPOs = [];

    function loaditems() {
    const companyid = "<?php echo $_SESSION['COMPANY_ID'] ?? ''; ?>";
    const sellerid = document.getElementById('cmbvan').value;

    const tbody = document.querySelector('#itemsTable tbody');
    if (!tbody) return;

    tbody.innerHTML = ''; // Clear previous rows
    showLoader(); // Show loader before fetch

    fetch(`/HomePage/datafetcher/reports/getdatareports.php?action=loadvaninventory&company=${encodeURIComponent(companyid)}&sellerid=${encodeURIComponent(sellerid)}`)
        .then(response => {
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            return response.json();
        })
        .then(data => {
            loadedPOs = data;
            if (!data || data.length === 0) {
                const tr = document.createElement('tr');
                tr.innerHTML = '<td colspan="11" class="text-center">No items found.</td>';
                tbody.appendChild(tr);
                return;
            }

            data.forEach((item, index) => {
                const tr = document.createElement('tr');

                tr.innerHTML = `
                    <td>${index + 1}</td>
                    <td>${item.ITEM_ID || ''}</td>
                    <td>${item.BATCH || ''}</td>
                    <td>${item.DESCRIPTION || ''}</td>
                    <td>${item.CS || ''}</td>
                    <td>${item.SW || ''}</td>
                    <td>${item.IT || ''}</td>
                    <td>${item.PRICE ? parseFloat(item.PRICE).toLocaleString('en-PH', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) : '0'}</td>
                    <td>${item.ITEM_PER_CASE || ''}</td>
                    <td>${item.ITEM_PER_SW || ''}</td>
                    <td>${item.SIH_IT || ''}</td>

                `;
                tbody.appendChild(tr);
            });
        })
        .catch(err => {
            console.error('Error loading items:', err);
        })
        .finally(() => {
            hideLoader(); // Hide loader when done
        });
}

 function formatCurrency(value) {
    return value ? Number(value).toLocaleString('en-PH', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) : '';
}

function exportToExcel() {
    if (!loadedPOs.length) {
        alert("No data to export!");
        return;
    }

    const worksheet = XLSX.utils.json_to_sheet(loadedPOs);
    const workbook = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(workbook, worksheet, "Details");

    // Use van name as filename
    const vanName = document.getElementById('cmbvan').value || 'Van';
    XLSX.writeFile(workbook, `Van_Inventory_${vanName}.xlsx`);
}



</script>
<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
<!-- SheetJS (XLSX) library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

</body>
</html>