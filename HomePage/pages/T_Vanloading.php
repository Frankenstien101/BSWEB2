<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<title>Stock ledger</title>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" />
<style>
    .filter-container {
        display: flex;
        justify-content: left;
        align-items: left;
        margin-top: 5px;
    }

    .filter-container .card {
        font-size: 9px;
    }

    .filter-container .card-body .row {
        display: flex;
        align-items: top;
         margin-top: 0px;
    }

    .filter-container label {
        font-weight: bold;
        font-size: 9px;
    }

    .filter-container input,
    .filter-container select {
        font-size: 9px;
    }

</style>
</head>
<body>
<h3>VAN LOADING TRANSACTION</h3>


   <input type="hidden" id="category">


<!-- Filter Cards Container -->
<button class="btn btn-primary btn-sm" onclick="loaditems()">New transaction</button>
<button class="btn btn-primary btn-sm" onclick="">Load transaction</button>

<div class="filter-container">
    <!-- Transaction Details Card -->
    <div class="card text-bg-light" style="font-size: 11px; text-align: left;">
        <div class="card-body">
            <div class="container-fluid p-0">
                <div class="row">
                    <!-- Row 1 -->
                    <div class="col-md-4 col-sm-6 col-12 mb-0">
                        <label for="transaction_id" class="mb-0">TRANSACTION ID</label>
                        <input type="text" id="transaction_id" class="form-control form-control-sm" placeholder="Auto generated" readonly>
                    </div>
                    <div class="col-md-4 col-sm-6 col-12 mb-2">
                        <label for="van" class="mb-0">VAN</label>
                        <select id="cmbvan" name="van" class="form-control form-control-sm">
          
                        </select>
                    </div>
                    <div class="col-md-4 col-sm-6 col-12 mb-0">
                        <label for="status" class="mb-0" >STATUS</label>
                        <input type="text" id="datecreated" style = "width: 100px;" class="form-control form-control-sm" value="DRAFT" readonly>
                    </div>

                    <!-- Row 2 -->
                    <div class="col-md-4 col-sm-6 col-12 mb-0">
                        <label for="date_created" class="mb-0">DATE CREATED</label>
                        <input type="date" id="date_created" class="form-control form-control-sm" value = "<?php echo date('Y-m-d'); ?>" placeholder="Auto"  readonly>
                    </div>
                    <div class="col-md-4 col-sm-6 col-12 mb-0">
                        <label for="warehouse" class="mb-0">WAREHOUSE</label>
                        <select id="warehouse" name="warehouse" class="form-control form-control-sm">
                  
                        </select>
                    </div>
                    <div class="col-md-4 col-sm-6 col-12 mb-0">
                        <label for="remarks" class="mb-0">REMARKS</label>
                        <input type="text" id="remarks" class="form-control form-control-sm" placeholder="Remarks">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Summary Card -->

  <div class="card text-bg-light" data-bs-spy="scroll" style="max-width: 100%; height:100%; margin-bottom: .5rem; Font-size: 11px;">
  <div class="card-header"  style= "height : 50px;">

<!-- Show Button -->
<button id="showBtn" onclick = "loaditems()" class="btn btn-success btn-sm mb-2">
    Insert Item
</button>

<!-- Hide Button -->
<button id="hideBtn" class="btn btn-danger btn-sm mb-2" style="display: none;">
    Hide Selection
</button>

   <button type="button" style="height: 30px; font-size:12px;" class="btn btn-primary mb-2" data-toggle="modal" data-target="#loadTransModal">Load from proposal</button>

<!-- Collapse Content -->
<div class="collapse" id="transactionDetailsCard">
    <div class="filter-container">
        <div class="card text-bg-light" style="font-size: 11px; text-align: left; width:650px;">
            <div class="card-body" style="overflow-y: auto; max-width: 100%; min-height: 300px;">
                <div class="container-fluid p-0">
                    <div class="row">
                        <div class="col-12">

                             <input type="text" id="remarks" class="form-control form-control-sm mb-1" style = "width:200px" placeholder="Search item">

                            <table id="tblskus" class="table table-striped table-hover table-bordered table-sm " style="font-size: 10px;">

                             <thead>
                               <tr>
                                 <th>#</th>
                                   <th>CS BARCODE</th>
                                   <th>IT BARCODE</th>
                                   <th>ITEM_ID</th>
                                   <th>BATCH</th>
                                   <th>DESCRIPTION</th>
                                   <th>AVAILABLE CS</th>
                                   <th>AVAILABLE SW</th>
                                   <th>AVAILABLE IT</th>
                                </tr>
                            </thead>
                                  
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ✅ Bootstrap 4 JS (order matters) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const showBtn = document.getElementById('showBtn');
    const hideBtn = document.getElementById('hideBtn');
    const collapseEl = $('#transactionDetailsCard');

    function showDetails() {
        collapseEl.collapse('show');
        showBtn.style.display = 'none';
        hideBtn.style.display = 'inline-block';
    }

    function hideDetails() {
        collapseEl.collapse('hide');
        hideBtn.style.display = 'none';
        showBtn.style.display = 'inline-block';
    }

    showBtn.addEventListener('click', showDetails);
    hideBtn.addEventListener('click', hideDetails);
</script>



      </div>
      <div class="card-body" style="overflow-y: auto; max-width: 100%; height: 450px;"  >
        <table id="itemsTable" class="table table-striped table-hover table-bordered table-sm " style="font-size: 10px;">
          
  <thead>
    <tr>
      <th>#</th>
        <th>ITEM_ID</th>
        <th>BATCH</th>
        <th>DESCRIPTION</th>
        <th>CS</th>
        <th>SW</th>
        <th>IT</th>
        <th>CS BARCODE</th>
        <th>IT BARCODE</th>
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

<!-- Export Button -->
<div class="text-right mb-0">
    <button class="btn btn-success btn-sm mb-2" onclick="exportToExcel()">Export Data</button>
</div>

<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="loadTransModal" tabindex="-1" aria-labelledby="loadTransModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 400px;">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header" style = "100px">
        <h6 class="modal-title" id="loadTransModalLabel">Stock proposal</h6>
      </div>

       <table id="stockproposallist" class="table table-striped table-hover table-bordered table-sm " style="font-size: 10px;">
          
  <thead>
    <tr>
      <th>#</th>
        <th>Proposal ID</th>
        <th>Amount</th>
        <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <!-- Filled dynamically -->
  </tbody>

            <!-- ...repeat rows as needed... -->
          </tbody>
        </table>

      <!-- Modal Body -->
      <div class="modal-body" style="max-height: 500px; overflow-y: auto;">
        <div class="container-fluid">
          
        </div>
      </div>

    </div>
  </div>
</div>


<!-- Modal insert item -->

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

let loadedPOs = []; // Global storage

function showLoader() {
   
    document.getElementById("loading").style.display = "flex";

}

function hideLoader() {
    document.getElementById("loading").style.display = "none";
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
    XLSX.writeFile(workbook, "Stock_Ledger_Report.xlsx");
}

document.addEventListener("DOMContentLoaded", function () {
 loadWarehouses();
  loadvan()
});






function loadWarehouses() {
    const companyId = "<?php echo $_SESSION['COMPANY_ID'] ?? ''; ?>";
     const siteid = "<?php echo $_SESSION['SITE_ID'] ?? ''; ?>";
    const warehouseSelect = document.getElementById('warehouse');
    const warehouseid = document.getElementById('warehouseid');

    // Clear existing options except first
    warehouseSelect.innerHTML = '<option value="" disabled selected>Select an option</option>';

    fetch(`/HomePage/datafetcher/reports/getdatareports.php?action=selectwarehouse&company=${encodeURIComponent(companyId)}&siteid=${encodeURIComponent(siteid)}`)
        .then(response => {
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            return response.json();
        })
        .then(data => {
            if (!Array.isArray(data)) {
                console.error("Invalid warehouse data", data);
                return;
            }
            data.forEach(item => {
                const option = document.createElement('option');
                // Customize label and value below, e.g., SITE_ID or WAREHOUSE_NAME
                option.value = item.WAREHOUSE_ID || item.WAREHOUSE_CODE || '';
                option.textContent = item.WAREHOUSE_NAME || item.WAREHOUSE_CODE || 'Unknown';
            option.dataset.category = item.WAREHOUSE_ID || ''; // store category
                warehouseSelect.appendChild(option);
            });
        })
        .catch(err => {
            console.error('Error loading warehouses:', err);
        });

}


function loaditems() {
    const companyId = "<?php echo $_SESSION['COMPANY_ID'] ?? ''; ?>";
    const siteid = "<?php echo $_SESSION['SITE_ID'] ?? ''; ?>";
    const warehouseCode = document.getElementById('warehouse').value;

    const tbody = document.querySelector('#itemsTable tbody');
    if (!tbody) return;

    tbody.innerHTML = ''; // Clear previous rows
    showLoader(); // Show loader before fetch

    fetch(`/HomePage/datafetcher/reports/getdatareports.php?action=loadskus&company=${encodeURIComponent(companyId)}`)
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

                let statusClass = '';
                if (item.IS_LOCKED === '0') statusClass = 'bg-green';
                else if (item.IS_LOCKED === '1') statusClass = 'bg-red';
                else statusClass = 'bg-blue';

                tr.innerHTML = `
                    <td>${index + 1}</td>
                      <td>${item.LINEID || ''}</td>
                    <td>${item.COMPANY_ID || ''}</td>
                    <td>${item.SITE_ID || ''}</td>
                    <td>${item.WAREHOUSE_ID || ''}</td>
                    <td>${item.WAREHOUSE_CODE || ''}</td>
                     <td>${item.SUB_WAREHOUSE || ''}</td>
                    <td class="${statusClass}">${item.IS_LOCKED || ''}</td>
                    <td>${item.WAREHOUSE_ADDRESS || ''}</td>
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


// GET HFS 

function loadvan() {
    const companyId = "<?php echo $_SESSION['COMPANY_ID'] ?? ''; ?>";
    const siteid = "<?php echo $_SESSION['SITE_ID'] ?? ''; ?>";
    const vanselect = document.getElementById('cmbvan');
    const vanfield = document.getElementById('category'); // your text field

    // Reset options
    vanselect.innerHTML = '<option value="" disabled selected>Select an option</option>';

    fetch(`/HomePage/datafetcher/reports/getdatareports.php?action=selecthfs&company=${encodeURIComponent(companyId)}&siteid=${encodeURIComponent(siteid)}`)
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
                option.value = item.SELLER_ID || ''; // keep seller ID
                option.textContent = item.SELLER_ID || 'Unknown';
                option.dataset.category = item.CATEGORY || ''; // store category
                vanselect.appendChild(option);
            });
        })
        .catch(err => {
            console.error('Error loading van:', err);
        });

    // Listen for changes and update text field
    vanselect.addEventListener('change', function () {
        const selectedOption = vanselect.options[vanselect.selectedIndex];
        const category = selectedOption.dataset.category || '';
        vanfield.value = category;
    });
}

// Declare global variables (accessible to all functions)





</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<!-- Bootstrap JS -->

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <!-- <link stylesheet="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css"> -->

   <!-- Bootstrap CSS -->

<!-- DataTables CSS -->
<link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JS Bundle -->

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
   



</body>
</html>