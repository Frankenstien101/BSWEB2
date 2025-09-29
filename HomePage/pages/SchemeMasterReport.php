<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<title>Scheme Master</title>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" />
<style>
    #pagination { overflow-x: auto; white-space: nowrap; }
    #pagination .page-item { flex: 0 0 auto; }
    .card-body-scroll { overflow-y: auto; max-width: 100%; height: 600px; }
    table { table-layout: auto; width: 100%; border-collapse: collapse; }
    table th, table td { white-space: nowrap; overflow: hidden; text-overflow: ellipsis; padding: 4px 8px; }
    .table-container { overflow: auto; }
    .table-container::-webkit-scrollbar { width: 6px; height: 6px; }
    .table-container::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 3px; }
    .table-container::-webkit-scrollbar-thumb { background: #888; border-radius: 3px; }
    .table-container::-webkit-scrollbar-thumb:hover { background: #555; }
    .seller-table { font-size: 9px; width: 100%; border: 1px solid #dee2e6; }
    .seller-table th, .seller-table td { padding: 2px 6px; text-align: left; border-bottom: 1px solid #dee2e6; }
    .seller-table th { background-color: #f8f9fa; font-weight: 600; }
    .card { border: 1px solid #dee2e6; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); border-radius: 8px; }
    .card-header { background-color: #e9ecef; font-weight: 600; padding: 6px 10px; font-size: 9px; }
    .filter-container { display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 0.5rem; }
    .date-filter-body { padding: 8px; }
    .date-filter-body .header { display: flex; align-items: center; gap: 8px; }
    .date-filter-body input[type="date"], .date-filter-body button { font-size: 9px; padding: 3px 6px; }
    .error-message { color: red; font-size: 9px; margin-top: 5px; }
    .success-message { color: green; font-size: 9px; margin-top: 5px; }
    @media (max-width: 768px) {
        .filter-container { flex-direction: column; }
        .card { width: 100% !important; }
    }
</style>
</head>
<body>
<h3>SCHEME MASTER</h3>

<!-- Filter Container -->
<div class="filter-container">
    <div class="card text-bg-light mb-1" style="width: 24%; font-size: 9px;">
        <div class="card-header">SELECT DATE FILTER</div>
        <div class="card-body date-filter-body">
            <div class="header">
                <label>Date From:</label>
                <input type="date" id="datefrom" value="<?php echo date('Y-m-d'); ?>" />
                <label>to</label>
                <input type="date" id="dateto" value="<?php echo date('Y-m-d'); ?>" />
                <button class="btn btn-primary btn-sm" onclick="loaditems()">GENERATE</button>
            </div>
            <div id="date-error" class="error-message"></div>
        </div>
    </div>
</div>

<!-- Table -->
<div class="card text-bg-light" style="max-width: 100%; height: 630px; margin-bottom: 0.5rem; font-size: 9px;">
    <div class="card-body card-body-scroll">
        <table id="itemsTable" class="table table-striped table-hover table-bordered table-sm" style="font-size: 9px;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>LINEID</th>
                    <th>COMPANY ID</th>
                    <th>SITE ID</th>
                    <th>SCHEME CODE</th>
                    <th>SCHEME DESCRIPTION</th>
                    <th>IT MOQ</th>
                    <th>LESS AMOUNT</th>
                    <th>DATE ADDED</th>
                    <th>IS MAS APPLIED</th>
                    <th>IS SFA APPLIED</th>
                    <th>STATUS</th>
                    <th>SELLER GROUP</th>
                    <th>START DATE</th>
                    <th>END DATE</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<!-- Export Button -->
<div class="text-right mb-0">
    <button class="btn btn-success btn-sm mb-2" onclick="exportToExcel()">Export Data</button>
</div>

<!-- Loader -->
<div id="loading" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%;
    background: rgba(255, 255, 255, 0.8); display: none; justify-content: center;
    align-items: center; z-index: 9999;">
    <div style="text-align:center;">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
        <div style="margin-top:10px;">Loading Data...</div>
    </div>
</div>

<!-- Scheme Modal -->
<div class="modal fade" id="schemeModal" tabindex="-1" role="dialog" aria-labelledby="schemeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="font-size: 12px;">
      <div class="modal-header">
        <h5 class="modal-title" id="schemeModalLabel">Scheme Details</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" id="schemeModalBody">
     
      <div class="card-body" style="overflow-y: auto; max-width: 100%; height: 500px;"  >
        <table id="detailstbl" class="table table-striped table-hover table-bordered table-sm " style="font-size: 10px;">
          
  <thead>
    <tr>
      <th>#</th>
      <th>SITE ID</th>
       <th>ITEM ID</th>
        <th>DESCRIPTION</th>
        <th>SELLER GROUP</th>
      <th>STATUS</th>
    </tr>
  </thead>
  <tbody>
    <!-- Filled dynamically -->
  </tbody>

            <!-- ...repeat rows as needed... -->
          </tbody>
        </table>
      </div>
    </div>

      </div>
    </div>
  </div>
</div>

<script>
let loadedPOs = [];

function showLoader() { document.getElementById("loading").style.display = "flex"; }
function hideLoader() { document.getElementById("loading").style.display = "none"; }
function loaditems() {
    const companyId = "<?php echo $_SESSION['COMPANY_ID'] ?? ''; ?>";
    const siteid = "<?php echo $_SESSION['SITE_ID'] ?? ''; ?>";
    const dateFrom = document.getElementById('datefrom').value;
    const dateTo = document.getElementById('dateto').value;

    const tbody = document.querySelector('#itemsTable tbody');
    tbody.innerHTML = '';
    showLoader();

    fetch(`/HomePage/datafetcher/reports/getdatareports.php?action=schememaster&company=${encodeURIComponent(companyId)}&siteid=${encodeURIComponent(siteid)}&datefrom=${encodeURIComponent(dateFrom)}&dateto=${encodeURIComponent(dateTo)}`)
        .then(res => res.json())
        .then(data => {
            loadedPOs = data;
            if (!data.length) {
                tbody.innerHTML = '<tr><td colspan="15" class="text-center">No items found.</td></tr>';
                return;
            }

            data.forEach((item, index) => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${index + 1}</td>
                    <td>${item.LINEID || ''}</td>
                    <td>${item.COMPANY_ID || ''}</td>
                    <td>${item.SITE_ID || ''}</td>
                    <td><a href="#" class="scheme-link" data-code="${item.SCHEME_CODE || ''}">${item.SCHEME_CODE || ''}</a></td>
                    <td>${item.SCHEME_DESCRIPTION || ''}</td>
                    <td>${item.IT_MOQ || ''}</td>
                    <td>${item.LESS_AMOUNT || ''}</td>
                    <td>${item.DATE_ADDED || ''}</td>
                    <td>${item.IS_MAS_APPLIED || ''}</td>
                    <td>${item.IS_SFA_APPLIED || ''}</td>
                    <td>${item.STATUS || ''}</td>
                    <td>${item.SELLER_GROUP || ''}</td>
                    <td>${item.START_DATE || ''}</td>
                    <td>${item.END_DATE || ''}</td>
                `;
                tbody.appendChild(tr);
            });
        })
        .catch(err => console.error(err))
        .finally(() => hideLoader());
}

document.addEventListener("click", function (e) {
    if (e.target.classList.contains("scheme-link")) {
        e.preventDefault();
        const schemeCode = e.target.dataset.code;
        const companyId = "<?php echo $_SESSION['COMPANY_ID'] ?? ''; ?>";

        const tbody = document.querySelector('#detailstbl tbody');
        tbody.innerHTML = '';
        //showLoader();

        fetch(`/HomePage/datafetcher/reports/getdatareports.php?action=schememasterdetails&company=${encodeURIComponent(companyId)}&schemecode=${encodeURIComponent(schemeCode)}`)
            .then(res => res.json())
            .then(data => {
                if (!data.length) {
                    tbody.innerHTML = '<tr><td colspan="6" class="text-center">No details found.</td></tr>';
                    return;
                }
                data.forEach((item, index) => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${index + 1}</td>
                              <td>${item.SITE_ID || ''}</td>
                        <td>${item.PARENT_SKU || ''}</td>
                        <td>${item.DESCRIPTION || ''}</td>
                        <td>${item.SELLER_GROUP || ''}</td>
                         <td>${item.STATUS || ''}</td>
                    `;
                    tbody.appendChild(tr);
                });
            })
            .catch(err => console.error(err))
            .finally(() => hideLoader());

        $('#schemeModal').modal('show');
    }
});




/// for modal details


function loadetails() {
   
}


function exportToExcel() {
    if (!loadedPOs.length) { alert("No data to export!"); return; }
    const worksheet = XLSX.utils.json_to_sheet(loadedPOs);
    const workbook = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(workbook, worksheet, "Details");
    XLSX.writeFile(workbook, "Scheme_Master_Report.xlsx");
}
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
