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

 <!-- Font Awesome CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<h3>VAN LOADING TRANSACTION</h3>


   <input type="hidden" id="categorytxt" name="categorytxt">
<input type="hidden" id="warehouseid" name="warehouseid">


<!-- Filter Cards Container -->
<div class="d-flex flex-wrap gap-2 mb-1">
  <!-- New Transaction Button with icon -->
  <button class="btn btn-primary btn-sm" id="newTransBtn">
    <i class="fas fa-plus"></i> New Transaction
  </button>

  <!-- Load Transaction Button with icon -->
  <button type="button" style="height: 32px; font-size: 13px;" class="btn btn-primary mb-0 ml-1" data-toggle="modal" data-target="#loadmodal">
    <i class="fas fa-folder-open"></i> Load Transaction
  </button>
</div>

<div class="filter-container">
    <!-- Transaction Details Card -->
    <div class="card text-bg-light" style="font-size: 11px; text-align: left;">
        <div class="card-body">
            <div class="container-fluid p-0">
                <div class="row">
                    <!-- Row 1 -->
                    <div class="col-md-3 col-sm-6 col-12 mb-0">
                        <label for="transaction_id" class="mb-0">TRANSACTION ID</label>
                        <input type="text" id="transaction_id"  style = "max-width: 100%;" class="form-control form-control-sm" placeholder="Auto generated" readonly>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12 mb-0">
                        <label for="van" class="mb-0">VAN</label>
                        <select id="cmbvan" name="van" class="form-control form-control-sm">
          
                        </select>
                    </div>
                    <div class="col-md-5 col-sm-6 col-12 mb-0">
                        <label for="status" class="mb-0" >STATUS</label>
                        <input type="text" id="status" style = "width: 100px;" class="form-control form-control-sm" value="DRAFT" readonly>
                    </div>

                    <!-- Row 2 -->
                    <div class="col-md-3 col-sm-6 col-12 mb-0">
                        <label for="date_created" class="mb-0">DATE CREATED</label>
                        <input type="date" id="date_created"  style = "max-width: 50%;" class="form-control form-control-sm" value = "<?php echo date('Y-m-d'); ?>" placeholder="Auto"  readonly>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12 mb-0">
                        <label for="warehouse" class="mb-0">WAREHOUSE</label>
                        <select id="warehouse" name="warehouse" class="form-control form-control-sm">
                  
                        </select>
                    </div>
                    <div class="col-md-6 col-sm-6 col-12 mb-0">
                        <label for="remarks" class="mb-0">REMARKS</label>
                        <input type="text" id="remarks" style = "max-width: 100%; font-size : 10px;" class="form-control form-control-sm" placeholder="Remarks">
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
<div class="d-flex flex-wrap gap-2 mb-3">
  <!-- Insert Item Button -->
  <!-- Make sure to include Font Awesome CDN in your HTML head if not already included -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> -->

<div class="d-flex flex-wrap gap-2 mb-3">
  <!-- Insert Item Button with icon -->
  <button id="showBtn" onclick="loaditems()" class="btn btn-success btn-sm mr-1">
    <i class="fas fa-plus"></i> Insert Item
  </button>

  <!-- Hide Button with icon (initially hidden) -->
  <button id="hideBtn" class="btn btn-danger btn-sm" style="display: none;">
    <i class="fas fa-eye-slash"></i> Hide Selection
  </button>

  <!-- Load from proposal Button with icon -->
  <button type="button" onclick="loadfromproposal()" style="height: 32px; font-size: 13px;" class="btn btn-primary" data-toggle="modal" data-target="#loadTransModal">
    <i class="fas fa-file-upload"></i> Load from proposal
  </button>
</div>
</div>
<!-- Collapse Content -->
 
<div class="collapse" id="transactionDetailsCard">
    <div class="filter-container">
        <div class="card text-bg-light" style="font-size: 11px; text-align: left; width: 100%; max-width: 900px; margin: left;">
            <div class="card-body" style="overflow-y: auto; max-width: 100%; min-height: 300px; height: 300px;">
                <div class="container-fluid p-0">
                    <div class="row">
                        <div class="col-12">

                            <input type="text" id="searchtxt" class="form-control form-control-sm mb-1" style="width: 200px;" placeholder="Search item">

                            <div style="overflow-x: auto;"> <!-- make table scrollable if too wide -->
                                <table id="tblskus" class="table table-striped table-hover table-bordered table-sm" style="font-size: 10px; min-width: 850px;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>CS BARCODE</th>
                                            <th>IT BARCODE</th>
                                            <th>ITEM_ID</th>
                                            <th>BATCH</th>
                                            <th>DESCRIPTION</th>
                                            <th>AV CS</th>
                                            <th>AV SW</th>
                                            <th>AV IT</th>
                                            <th>CS</th>
                                            <th>SW</th>
                                            <th>IT</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- dynamic rows will be inserted here -->
                                    </tbody>

                                    <tfoot>
                                          <tr>
                                            <td colspan="12" class="text-right"><strong>Grand Total:</strong></td>
                                            <td id="grandTotal">0.00</td>
                                          </tr>
                                        </tfoot>
                                </table>
                            </div>

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
<div class="card-body" style="overflow-y: auto; max-width: 100%; height: 50vh; padding: 10px;">
  <table id="itemsTable" class="table table-striped table-hover table-bordered table-sm mb-0" style="font-size: 10px;">
    <thead class="thead-light">
      <tr>
        <th>#</th>
        <th>BARCODE</th>
        <th>ITEM ID</th>
        <th>BATCH</th>
        <th>DESCRIPTION</th>
         <th>IT PER CS</th>
        <th>CS</th>
        <th>SW</th>
        <th>IT</th>
        <th>TOTAL CASE AMOUNT</th>
        <th>TOTAL IT AMOUNT</th>
        <th>TOTAL SIH</th>
        <th>ACTION</th>
      </tr>
    </thead>
    <tbody>
      <!-- Filled dynamically -->
    </tbody>
  </table>
</div>
</div>

<!-- Export Button -->
 
<!-- Totals & Action Buttons -->
<div class="card mt-2">
  <div class="card-body p-2">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center" style="font-size: 0.65rem;">
      
      <!-- Totals on the left -->
      <div class="d-flex flex-wrap align-items-center mb-2 mb-md-0" style="font-size: 0.65rem;">
        <!-- Total Lines -->
        <div class="mr-3 mb-2 d-flex align-items-center">
          <label class="mb-0 mr-2 font-weight-semibold">TOTAL LINES:</label>
          <input type="text" id="totalines" readonly class="form-control form-control-sm" style="width: 70px; font-size: 0.65rem;">
        </div>
        <!-- Total Case Amount -->
        <div class="mr-3 mb-2 d-flex align-items-center">
          <label class="mb-0 mr-2 font-weight-semibold">TOTAL CASE AMOUNT:</label>
          <input type="text" id="totalCSAmount" readonly class="form-control form-control-sm" style="width: 120px; font-size: 0.65rem;">
        </div>
        <!-- Total IT Amount -->
        <div class="mr-3 mb-2 d-flex align-items-center">
          <label class="mb-0 mr-2 font-weight-semibold">TOTAL IT AMOUNT:</label>
          <input type="text" id="totalITAmount" readonly class="form-control form-control-sm" style="width: 120px; font-size: 0.65rem;">
        </div>
        <!-- Total SIH -->
        <div class="mb-2 d-flex align-items-center">
          <label class="mb-0 mr-2 font-weight-semibold">TOTAL SIH:</label>
          <input type="text" id="totalSIH" readonly class="form-control form-control-sm" style="width: 70px; font-size: 0.65rem;">
        </div>
      </div>

      <!-- Buttons on the right -->
      <div class="d-flex flex-wrap justify-content-end gap-2" style="font-size: 0.65rem;">
  <button class="btn btn-warning btn-sm mr-1" onclick="saveasdraft()">
    <i class="fas fa-save"></i> Save as Draft & Print Picklist
  </button>
  <button class="btn btn-success btn-sm mr-1" onclick="processLoadingAllInOne()">
    <i class="fas fa-cogs"></i> Process Van Loading
  </button>
  <button class="btn btn-info btn-sm" onclick="printloading()">
    <i class="fas fa-print"></i> Print
  </button>
</div>
    </div>
  </div>
</div>
<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="loadTransModal" tabindex="-1" aria-labelledby="loadTransModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 600px;">
    <div class="modal-content">
      
      <!-- Modal Header -->
      <div class="modal-header">
        <h6 class="modal-title" id="loadTransModalLabel">Stock Proposal</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body">
        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
          <table id="stockproposallist" 
                 class="table table-striped table-hover table-bordered table-sm text-center" 
                 style="font-size: 10px;">
            <thead class="thead-light">
              <tr>
                <th>#</th>
                <th>Date</th>
                <th>Proposal ID</th>
                <th>Amount</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <!-- Rows inserted dynamically -->
            </tbody>
          </table>
        </div>
      </div>

      <!-- Modal Footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>



<!-- modal load trans -->
<div class="modal fade" id="loadmodal" tabindex="-1" aria-labelledby="loadTransModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 700px; height: 500px;">
    <div class="modal-content">
      
      <!-- Modal Header -->
      <div class="modal-header">
        <h6 class="modal-title" id="loadTransModalLabel">Load Transactions</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body">

        <!-- Filter Section -->
        <div class="form-row mb-3 align-items-end">
          <div class="col-auto">
            <label for="fromDate" class="small mb-1">From Date</label>
            <input type="date" style="width: 150px;" id="fromDate" 
                   class="form-control form-control-sm"  
                   value="<?php echo date('Y-m-d'); ?>">
          </div>
          <div class="col-auto">
            <label for="toDate" class="small mb-1">To Date</label>
            <input type="date" style="width: 150px;" id="toDate" 
                   class="form-control form-control-sm"  
                   value="<?php echo date('Y-m-d'); ?>">
          </div>
          <div class="col-auto">
            <button id="btnLoadTransactions" class="btn btn-primary btn-sm">
              <i class="fa fa-search"></i> Load
            </button>
          </div>
        </div> <!-- ✅ closed form-row -->

        <!-- Table Section -->
        <div class="table-responsive" style="height: 350px; overflow-y: auto;">
          <table id="loadtranstbl" 
                 class="table table-striped table-hover table-bordered table-sm text-center" 
                 style="font-size: 10px;">
            <thead class="thead-light">
              <tr>
                <th>#</th>
                <th>DATE CREATED</th>
                <th>SELLER ID</th>
                <th>TRANSACTION ID</th>
                <th>AMOUNT</th>
                <th>TOTAL LINES</th>
                <th>REMARKS</th>
                <th>ACTION</th>
              </tr>
            </thead>
            <tbody>
              <!-- Rows inserted dynamically -->
            </tbody>
          </table>
        </div>
      </div> <!-- ✅ end modal-body -->

      <!-- Modal Footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
      </div>

    </div> <!-- ✅ end modal-content -->
  </div>   <!-- ✅ end modal-dialog -->
</div>     <!-- ✅ end modal -->



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




<script>

let loadedPOs = []; // Global storage

function showLoader() {
    const transactionEl = document.getElementById('transaction_id');
    const warehouseEl = document.getElementById('warehouse');
    const warehousecode = warehouseEl ? warehouseEl.value.trim() : "";

    // ✅ Show loader only if both checks passed
    document.getElementById("loading").style.display = "flex";
    return true;
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
//loaditems();

});


function loadWarehouses() {
    const companyId = "<?php echo $_SESSION['COMPANY_ID'] ?? ''; ?>";
    const siteid = "<?php echo $_SESSION['SITE_ID'] ?? ''; ?>";
    const warehouseSelect = document.getElementById('warehouse');
    const warehouseid = document.getElementById('warehouseid');

    // Clear existing options
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
                option.value = item.WAREHOUSE_ID || item.WAREHOUSE_CODE || '';
                option.textContent = item.WAREHOUSE_NAME || item.WAREHOUSE_CODE || 'Unknown';
                option.dataset.id = item.WAREHOUSE_ID || ''; 
                warehouseSelect.appendChild(option);
            });

            // ✅ listen for selection
            warehouseSelect.addEventListener('change', function () {
                const selectedOption = warehouseSelect.options[warehouseSelect.selectedIndex];
                warehouseid.value = selectedOption.dataset.id || '';
            });
        })
        .catch(err => {
            console.error('Error loading warehouses:', err);
        });
}

function loaditems() {
    return new Promise((resolve, reject) => {
        const companyId = "<?php echo $_SESSION['COMPANY_ID'] ?? ''; ?>";
        const siteid = "<?php echo $_SESSION['SITE_ID'] ?? ''; ?>";
        const warehousecode = document.getElementById('warehouse').value;
        const categorytxt = document.getElementById('categorytxt').value;
        const transactionid  = document.getElementById('transaction_id').value;
        const vanid  = document.getElementById('cmbvan').value;

         const status = document.getElementById('status')?.value;

    if (!transactionid) { alert('No transaction selected'); return; }
    if (!vanid) { alert('No van selected'); return; }
    if (!warehousecode) { alert('No warehouse selected'); return; }

    if (status === 'ALLOCATED') {
  alert('Cannot process allocated transaction');
  return;
    }

        const tbody = document.querySelector('#tblskus tbody');
        if (!tbody) return resolve([]);

        tbody.innerHTML = ''; 
        showLoader();

        fetch(`/HomePage/datafetcher/transactions/Van_Loading_getdata.php?action=loadskus&company=${encodeURIComponent(companyId)}&siteid=${encodeURIComponent(siteid)}&warehousecode=${encodeURIComponent(warehousecode)}&category=${encodeURIComponent(categorytxt)}`)
            .then(response => {
                if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                return response.json(); 
            })
            .then(data => {
                if (!data || data.length === 0) {
                    const tr = document.createElement('tr');
                    tr.innerHTML = '<td colspan="12" class="text-center">No items found.</td>';
                    tbody.appendChild(tr);
                    return resolve([]);
                }

                data.forEach((item, index) => {
                    const tr = document.createElement('tr');

                    tr.dataset.itemsPerCase = item.ITEMS_PER_CASE || 0;
                    tr.dataset.itemsPerSw   = item.ITEMS_PER_SW || 0;
                    tr.dataset.itemCost     = item.ITEM_COST || 0;
                    tr.dataset.caseCost     = item.CASE_COST || 0;

                    const batch = item.BATCH || 'DEFAULT';

                    tr.innerHTML = `
                        <td>${index + 1}</td>
                        <td>${item.CS_BARCODE || ''}</td>
                        <td>${item.IT_BARCODE || ''}</td>
                        <td>${item.ITEM_ID || ''}</td>
                        <td>${batch}</td>
                        <td>${item.DESCRIPTION || ''}</td>
                        <td>${item.CS || 0}</td>
                        <td>${item.SW || 0}</td>
                        <td>${item.IT || 0}</td>
                        <td><input type="number" class="form-control form-control-sm cs-input" style="width:50px" value="0" min="0"></td>
                        <td><input type="number" class="form-control form-control-sm sw-input" style="width:50px" value="0" min="0"></td>
                        <td><input type="number" class="form-control form-control-sm it-input" style="width:50px" value="0" min="0"></td>
                        <td><button class="btn btn-sm btn-primary add-to-list-btn">Add to List</button></td>
                    `;

                    // Append row
                    tbody.appendChild(tr);

                    // Select the newly created inputs and button
                    const currentRow = tr;
                    const csInput = currentRow.querySelector('.cs-input');
                    const swInput = currentRow.querySelector('.sw-input');
                    const itInput = currentRow.querySelector('.it-input');
                    const addBtn = currentRow.querySelector('.add-to-list-btn');

                    // Function to trigger add on Enter key press
                    function triggerAdd(e) {
                        if (e.key === 'Enter') {
                            e.preventDefault(); // prevent form submit if inside a form
                            addBtn.click();
                        }
                    }

                    // Attach keydown events for Enter key
                    csInput.addEventListener('keydown', triggerAdd);
                    swInput.addEventListener('keydown', triggerAdd);
                    itInput.addEventListener('keydown', triggerAdd);

                    // Add click event for the button
                    addBtn.addEventListener('click', () => {
                        const itemId = item.ITEM_ID || '';
                        const batch = item.BATCH || 'DEFAULT';

                         const status = document.getElementById('status')?.value;
                            if (status === 'ALLOCATED') {
                              alert('Cannot process allocated transaction');
                              return;
                                }
                        const itemsTable = document.getElementById('itemsTable');
                        // Check for duplicate
                        const existingItem = Array.from(itemsTable.querySelectorAll('tr')).find(row => 
                            row.dataset.itemCode === itemId && row.dataset.batch === batch
                        );

                        console.log('Checking duplicate:', itemId, batch);
                        console.log('Existing row:', existingItem ? existingItem.dataset.itemCode + ' / ' + existingItem.dataset.batch : 'None');

                        if (existingItem) {
                            alert('This item with the same batch is already in the list.');
                            return; // Prevent duplicate
                        }

                        // Get quantities
                        const cs = parseInt(csInput.value, 10) || 0;
                        const sw = parseInt(swInput.value, 10) || 0;
                        const it = parseInt(itInput.value, 10) || 0;

                        const availcs = item.CS || 0;
                        const availsw = item.SW || 0;
                        const availit = item.IT || 0;

                        // Check stock availability
                        if (cs > availcs || sw > availsw || it > availit) {
                            alert("Quantity exceeds available stock!");
                            return;
                        }

                        const itemsPerCase = parseInt(tr.dataset.itemsPerCase, 10) || 0;
                        const itemsPerSw   = parseInt(tr.dataset.itemsPerSw, 10) || 0;
                        const itemCost     = parseFloat(tr.dataset.itemCost) || 0;
                        const caseCost     = parseFloat(tr.dataset.caseCost) || 0;

                        const csinit  = cs * itemsPerCase;
                        const swinit  = sw * itemsPerSw;
                        const totalit = csinit + swinit + it;

                        const swandit = swinit + it;

                        const caseamount = cs * caseCost;
                        const itamount   = (swinit + it) * itemCost;
                        const grandTotal = caseamount + itamount;

                        // Add item to the list table
                        const newRow = document.createElement('tr');
                        newRow.dataset.itemCode = item.ITEM_ID; // consistent attribute
                        newRow.dataset.batch = batch; // consistent attribute
                        newRow.innerHTML = `
                            <td></td>
                            <td>${item.CS_BARCODE || ''}</td>
                            <td>${item.IT_BARCODE || ''}</td>
                            <td>${item.ITEM_ID || ''}</td>
                            <td>${batch}</td>
                            <td>${item.DESCRIPTION || ''}</td>
                            <td>${cs}</td>
                            <td>${sw}</td>
                            <td>${it}</td>
                            <td>${caseamount.toFixed(2)}</td>
                            <td>${itamount.toFixed(2)}</td>
                            <td>${grandTotal.toFixed(2)}</td>
                            <td><button class="btn btn-sm btn-danger remove-from-list-btn">Remove</button></td>
                        `;
                        document.getElementById('itemsTable').querySelector('tbody').appendChild(newRow);

                        // Save to server
                        fetch(`/HomePage/datafetcher/transactions/Van_Loading_getdata.php?action=saveonvanloaddetails&company=${encodeURIComponent(companyId)}&siteid=${encodeURIComponent(siteid)}&transactionid=${encodeURIComponent(transactionid)}&vanid=${encodeURIComponent(vanid)}&barcode=${encodeURIComponent(item.IT_BARCODE || '')}&itemid=${encodeURIComponent(item.ITEM_ID)}&description=${encodeURIComponent(item.DESCRIPTION)}&batch=${encodeURIComponent(batch)}&cs=${encodeURIComponent(cs)}&sw=${encodeURIComponent(sw)}&it=${encodeURIComponent(it)}&price=${encodeURIComponent(item.ITEM_COST)}&itpercase=${encodeURIComponent(itemsPerCase)}&itpersw=${encodeURIComponent(itemsPerSw)}&sihit=${encodeURIComponent(totalit)}&totalcs=${encodeURIComponent(caseamount)}&totalit=${encodeURIComponent(itamount)}`)
                            .then(response => {
                                if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                                return response.json();
                            })
                            .then(data => {
                                if (!Array.isArray(data)) {
                                    console.error("Invalid data", data);
                                }
                            })
                            .catch(err => {
                                console.error('Error saving details:', err);
                            });

                        // Optional: give visual feedback
                        addBtn.innerText = "Added!";
                        addBtn.disabled = true;
                        loadlist(); // call your loadlist() function if needed
                    });
                });

                resolve(data);
            })
            .catch(err => {
                console.error('Error loading items:', err);
                reject(err);
            })
            .finally(() => {
                hideLoader();
            });
    });
}

//filter skus

document.getElementById('searchtxt').addEventListener('input', function () {
    const filter = this.value.toLowerCase();
    const rows = document.querySelectorAll('#tblskus tbody tr');

    rows.forEach(row => {
        const cellsText = Array.from(row.cells)
            .map(cell => cell.textContent.toLowerCase())
            .join(' '); // combine all cell text
        if (cellsText.includes(filter)) {
            row.style.display = ''; // show row
        } else {
            row.style.display = 'none'; // hide row
        }
    });
});

// GET HFS 


function loadvan() {
    const companyId = "<?php echo $_SESSION['COMPANY_ID'] ?? ''; ?>";
    const siteid = "<?php echo $_SESSION['SITE_ID'] ?? ''; ?>";
    const vanselect = document.getElementById('cmbvan');
    const vanfield = document.getElementById('categorytxt');

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
                option.value = item.SELLER_ID || '';
                option.textContent = item.SELLER_ID || 'Unknown';
                option.dataset.category = item.CATEGORY || ''; // ✅ use CATEGORY_DESC
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
    document.getElementById('categorytxt').value = selectedOption.dataset.category || '';
});


/// CREATE NEW VAN LOADING 

document.getElementById('newTransBtn').addEventListener('click', function() {
    const companyId = "<?php echo $_SESSION['COMPANY_ID']; ?>";
    const siteId = "<?php echo $_SESSION['SITE_ID']; ?>";

    fetch(`/HomePage/datafetcher/transactions/Van_Loading_getdata.php?action=get_new_po_count&company=${companyId}&siteid=${siteId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.count !== undefined) {
               
                const transaction_id = 'VL2-' + companyId +'-'+ siteId + '-' + data.count;
           
                document.getElementById('transaction_id').value = transaction_id;
                document.getElementById('status').value = 'DRAFT';
                loadvan();
                loadlist();
                loadWarehouses();
                updateTotals();
                clearall();

                return fetch(`/HomePage/datafetcher/transactions/Van_Loading_getdata.php?action=insertnewtrans&companyid=${companyId}&siteid=${siteId}&transactionid=${transaction_id}`);
            } else {
                alert('No count value returned from server.');
                console.warn('Response data:', data);
            }
        })
        .then(response => {
            if (response) return response.json();
        })
        .then(insertResult => {
            if (insertResult) {
                if (insertResult.success) {
                    console.log("Insert success:", insertResult.transactionid);
                } else {
                    console.error("Insert failed:", insertResult.error);
                }
            }
        })
        .catch(error => {
            console.error('Error fetching or inserting PO:', error);
            alert('Error occurred. Check console for details.');
        });
});



// Helper function to format numbers as normal currency
function formatCurrency(value) {
    return value ? Number(value).toLocaleString('en-PH', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) : '';
}

// Helper function to update row numbers after a row is removed
function updateRowIndexes(tbody) {
    const rows = tbody.querySelectorAll('tr');
    rows.forEach((row, idx) => {
        const firstCell = row.querySelector('td:first-child');
        if (firstCell) firstCell.textContent = idx + 1;
    });
}

// Function to remove an item from the server
function removeitem(itemid) {
    const transactionid = document.getElementById('transaction_id').value;
    showLoader(); // show loader while removing

    fetch(`/HomePage/datafetcher/transactions/Van_Loading_getdata.php?action=removefromlist&transactionid=${encodeURIComponent(transactionid)}&itemid=${encodeURIComponent(itemid)}`)
        .then(response => {
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Remove from loadedPOs array
                loadedPOs = loadedPOs.filter(item => item.ITEM_CODE !== itemid);
                loaditems(); // refresh table if needed
            } else {
                console.warn("Remove failed:", data.error || "Unknown error");
            }
        })
        .catch(err => {
            console.error('Error removing item:', err);
        })
        .finally(() => {
            hideLoader(); // hide loader after fetch
        });
}

// Main function to load the list of items
function loadlist() {
    const transactionid = document.getElementById('transaction_id').value;
    const tbody = document.querySelector('#itemsTable tbody');
    if (!tbody) return;

    tbody.innerHTML = ''; // Clear previous rows
    showLoader();

    fetch(`/HomePage/datafetcher/transactions/Van_Loading_getdata.php?action=loadlist&transactionid=${encodeURIComponent(transactionid)}`)
        .then(response => {
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            return response.json();
        })
        .then(data => {
            loadedPOs = data;

            if (!data || data.length === 0) {
                const tr = document.createElement('tr');
                tr.innerHTML = '<td colspan="13" class="text-center">No items found.</td>';
                tbody.appendChild(tr);
                return;
            }

            data.forEach((item, index) => {
                const tr = document.createElement('tr');

                const batch = item.BATCH || '';

                tr.innerHTML = `
                    <td>${index + 1}</td>
                    <td>${item.BARCODE || ''}</td>
                    <td>${item.ITEM_CODE || ''}</td>
                    <td>${batch}</td>
                    <td>${item.DESCRIPTION || ''}</td>
                     <td>${item.ITEM_PER_CASE || ''}</td>
                    <td>${item.CS || ''}</td>
                    <td>${item.SW || ''}</td>
                    <td>${item.IT || ''}</td>
                    <td>${formatCurrency(item.TOTAL_CS_AMOUNT)}</td>
                    <td>${formatCurrency(item.TOTAL_IT_AMOUNT)}</td>
                    <td>${item.SIH_IT || ''}</td>
                    <td>
                        <button class="btn btn-danger btn-sm remove-btn" title="Remove">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                `;

                // Save batch info as data attribute
                tr.dataset.itemCode = item.ITEM_CODE;
                tr.dataset.batch = batch;

                tbody.appendChild(tr);

                // Remove button event
                tr.querySelector('.remove-btn').addEventListener('click', () => {
                    if (confirm('Are you sure you want to remove this item?')) {
                        tr.remove();                
                        // Call your server-side remove function if needed
                        removeitem(item.ITEM_CODE, batch);
                        updateTotals();
                    }
                });
            });
        })
        .catch(err => {
            console.error('Error loading list:', err);
        })
        .finally(() => {

            updateTotals();
            hideLoader();
        });
}

function updateTotals() {
    // Calculate totals
    let totalCS = 0, totalIT = 0, totalSIH = 0;

    loadedPOs.forEach(item => {
        totalCS += Number(item.TOTAL_CS_AMOUNT) || 0;
        totalIT += Number(item.TOTAL_IT_AMOUNT) || 0;
        totalSIH += Number(item.SIH_IT) || 0;
    });

    // Update total amount fields
    document.getElementById('totalCSAmount').value = totalCS.toLocaleString('en-PH', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    document.getElementById('totalITAmount').value = totalIT.toLocaleString('en-PH', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    document.getElementById('totalSIH').value = totalSIH.toLocaleString('en-PH', { minimumFractionDigits: 2, maximumFractionDigits: 2 });

    // Count rows in the table
    const rows = document.querySelectorAll('#itemsTable tbody tr');
    const rowCount = rows.length;

    // Update total lines input
    const totalLinesInput = document.getElementById('totalines');
    if (totalLinesInput) {
        totalLinesInput.value = rowCount;
    }

    // Optionally, update the display element
    const displayElement = document.getElementById('totallines');
    if (displayElement) {
        displayElement.innerText = `${rowCount}`;
    } else {
        console.log(`Total Rows: ${rowCount}`);
    }
}


// SELECT FROM PROPOSAL
function loadfromproposal() {
    const companyid = "<?php echo $_SESSION['COMPANY_ID']; ?>";
    const siteid = "<?php echo $_SESSION['SITE_ID']; ?>";
    const sellerid = document.getElementById('cmbvan').value;
    const tbody = document.querySelector('#stockproposallist tbody');
    if (!tbody) return;

    tbody.innerHTML = ''; // Clear previous rows
    showLoader();

    fetch(`/HomePage/datafetcher/transactions/Van_Loading_getdata.php?action=loadproposal&companyid=${encodeURIComponent(companyid)}&siteid=${encodeURIComponent(siteid)}&sellerid=${encodeURIComponent(sellerid)}`)
        .then(response => {
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            return response.json();
        })
        .then(data => {
            loadedPOs = data;

            if (!data || data.length === 0) {
                const tr = document.createElement('tr');
                tr.innerHTML = '<td colspan="5" class="text-center">No items found.</td>';
                tbody.appendChild(tr);
                return;
            }

            data.forEach((item, index) => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${index + 1}</td>
                    <td>${item.DATE_CREATED || ''}</td>
                    <td>${item.LOADING_ID || ''}</td>
                    <td>${formatCurrency(item.AMOUNT)}</td>

                    <td>
                        <button class="btn btn-primary btn-sm select-btn" title="Select">
                            <i class="fa fa-check"></i>
                        </button>
                    </td>
                `;
                tbody.appendChild(tr);

                // Button event
                tr.querySelector('.select-btn').addEventListener('click', () => {
                    const btn = tr.querySelector('.select-btn');

                    // Disable after selection so it cannot be clicked again
                    btn.disabled = true;
                    btn.classList.remove('btn-primary');
                    btn.classList.add('btn-secondary');
                    btn.innerHTML = '<i class="fa fa-check"></i> Selected';

                    // Remove from server/local (if ITEM_CODE is valid)
                    if (item.ITEM_CODE) {
                        removeitem(item.ITEM_CODE);
                    }

                    // Populate hidden inputs
                    const transactionIdInput = document.getElementById('transaction_id');
                    const dateCreatedInput = document.getElementById('date_created');
                    if (transactionIdInput) transactionIdInput.value = item.LOADING_ID || '';
                    if (dateCreatedInput) dateCreatedInput.value = item.DATE_CREATED || '';

                    // Close modal
                    $('#loadTransModal').modal('hide');
                    $('.modal-backdrop').remove();
                    $('body').removeClass('modal-open');

                    // Refresh items
                    loadlist();
                });
            });
        })
        .catch(err => {
            console.error('Error loading items:', err);
        })
        .finally(() => {
            hideLoader();
        });
}

document.getElementById('btnLoadTransactions').addEventListener('click', function () {
    const fromDate = document.getElementById('fromDate').value;
    const toDate = document.getElementById('toDate').value;

    // Pass filters to your fetch
    loadTransactions(fromDate, toDate);
});

function loadTransactions(fromDate = '', toDate = '') {
    const companyid = "<?php echo $_SESSION['COMPANY_ID']; ?>";
    const siteid = "<?php echo $_SESSION['SITE_ID']; ?>";
    const tbody = document.querySelector('#loadtranstbl tbody');
    tbody.innerHTML = '';

    showLoader();

    fetch(`/HomePage/datafetcher/transactions/Van_Loading_getdata.php?action=loadtransactions&companyid=${encodeURIComponent(companyid)}&siteid=${encodeURIComponent(siteid)}&datefrom=${encodeURIComponent(fromDate)}&dateto=${encodeURIComponent(toDate)}`)
        .then(res => res.json())
        .then(data => {
            if (!data || data.length === 0) {
                tbody.innerHTML = '<tr><td colspan="8" class="text-center">No transactions found.</td></tr>';
                return;
            }

            data.forEach((item, i) => {
    const tr = document.createElement('tr');
    tr.innerHTML = `
        <td>${i + 1}</td>
        <td>${item.DATE_CREATED || ''}</td>
        <td>${item.SELLER_ID || ''}</td>
        <td>${item.LOADING_ID || ''}</td>
        <td>${formatCurrency(item.AMOUNT)}</td>
        <td>${item.TOTAL_LINES || ''}</td>
        <td>${item.REMARKS || ''}</td>
        <td>
            <button class="btn btn-primary btn-sm select-btn" title="Select">
              <i class="fa fa-check"></i>
            </button>
        </td>
    `;
    tbody.appendChild(tr);

    tr.querySelector('.select-btn').addEventListener('click', () => {
        // Close modal
        $('#loadmodal').modal('hide');
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open');

        // Set values in form inputs
        const transactionIdInput = document.getElementById('transaction_id');
        const dateCreatedInput = document.getElementById('date_created');
        const remarksInput = document.getElementById('remarks');

        if (transactionIdInput) transactionIdInput.value = item.LOADING_ID || '';
        if (dateCreatedInput) dateCreatedInput.value = item.DATE_CREATED || '';
        if (remarksInput) remarksInput.value = item.REMARKS || '';

        // Update the cmbvan select element, assuming item.SELLER_ID is the correct value
        const cmbvan = document.getElementById('cmbvan');
        if (cmbvan && item.SELLER_ID) {
            cmbvan.value = item.SELLER_ID;
            // Trigger change event if necessary
            const event = new Event('change');
            cmbvan.dispatchEvent(event);
        }

        // Refresh list
        loadlist();

         const itemsTableBody = document.querySelector('#loadtranstbl  tbody');

            // Clear all rows in the table body
        itemsTableBody.innerHTML = '';

                });
            });
        })
        .catch(err => console.error('Error loading transactions:', err))
        .finally(() => hideLoader());
}

/// PROCESS TRANSACTION

async function processLoadingAllInOne() {
    const transactionid = document.getElementById('transaction_id').value;
    const companyid = "<?php echo $_SESSION['COMPANY_ID']; ?>";
    const siteid = "<?php echo $_SESSION['SITE_ID']; ?>";
    const nameofuser = "<?php echo $_SESSION['Name_of_user']; ?>";
    const userid = "<?php echo $_SESSION['UserID']; ?>";
    const sellerid = document.getElementById('cmbvan').value;
    const warehousecode = document.getElementById('warehouse').value;
    const tbody = document.querySelector('#tblskus tbody');
    const status = document.getElementById('status')?.value;

    if (!transactionid) { alert('No transaction selected'); return; }
    if (!sellerid) { alert('No van selected'); return; }
    if (!warehousecode) { alert('No warehouse selected'); return; }

    if (status === 'ALLOCATED') {
  alert('Cannot process allocated transaction');
  return;
    }

    // Load items and get actual stock data
    let itemsData = [];
    try {
        itemsData = await loaditems();
        if (!Array.isArray(itemsData) || !itemsData.length) {
            alert('No items loaded from data source!');
            return;
        }
    } catch (err) {
        console.error("Error loading items:", err);
        alert('Failed to load items!');
        return;
    }

    // Wait until table rows are populated
    await waitForTableRows(tbody, 5000).catch(err => {
        alert('No items loaded in table or timeout!');
        throw err;
    });

    const rows = tbody.querySelectorAll('tr');
    if (!rows.length) { alert('No items to process'); return; }

    // Get the itemsTable rows to get REQUESTED values
    const itemsTable = document.querySelector('#itemsTable tbody');
    if (!itemsTable) {
        alert('Items table not found!');
        return;
    }
    const itemsTableRows = itemsTable.querySelectorAll('tr');

    // Create a map of requested values from itemsTable
    const requestedMap = {};
    itemsTableRows.forEach(row => {
        const itemid = row.cells[2]?.innerText.trim() || "";
        const requested_cs = parseInt(row.cells[6]?.innerText.trim(), 10) || 0;
        const requested_sw = parseInt(row.cells[7]?.innerText.trim(), 10) || 0;
        const requested_it = parseInt(row.cells[8]?.innerText.trim(), 10) || 0;

        requestedMap[itemid] = { requested_cs, requested_sw, requested_it };
    });

    // Validate each row against actual stock
    let hasInvalidRows = false;
    rows.forEach(row => {
        const itemid = row.cells[3]?.innerText.trim() || "";
        const requested = requestedMap[itemid] || { requested_cs: 0, requested_sw: 0, requested_it: 0 };
        const availcs = parseInt(row.cells[6]?.innerText.trim(), 10) || 0;
        const availsw = parseInt(row.cells[7]?.innerText.trim(), 10) || 0;
        const availit = parseInt(row.cells[8]?.innerText.trim(), 10) || 0;

        if (requested.requested_cs > availcs || requested.requested_sw > availsw || requested.requested_it > availit) {
            row.style.backgroundColor = 'rgba(248, 13, 13, 0.2)';
            hasInvalidRows = true;
        } else {
            row.style.backgroundColor = '';
        }
    });

    if (hasInvalidRows) {
        alert('Some rows exceed available stock! Fix highlighted rows before processing.');
        return;
    }

    // Process each row, passing requestedMap
    await processTableRows(requestedMap);

    updatetransaction();

    alert('✅ All items processed successfully!');

    document.getElementById('status').value = "ALLOCATED";

}


async function processTableRows(requestedMap) { // Accept requestedMap as parameter
    const rows = document.querySelectorAll('#itemsTable tbody tr');
    const transactionid = document.getElementById('transaction_id').value;
    const companyid = "<?php echo $_SESSION['COMPANY_ID']; ?>";
    const siteid = "<?php echo $_SESSION['SITE_ID']; ?>";
      const nameofuser = "<?php echo $_SESSION['Name_of_user']; ?>";
    const userid = "<?php echo $_SESSION['UserID']; ?>";
        const warehousecode = document.getElementById('warehouse').value;
            const sellerid = document.getElementById('cmbvan').value;

    for (let i = 0; i < rows.length; i++) {
        const row = rows[i];

        const itemid = row.cells[2]?.innerText.trim() || "";
        const batch = row.cells[3]?.innerText.trim() || "";
        const description = row.cells[4]?.innerText.trim() || "";
        const cs_barcode = row.cells[1]?.innerText.trim() || "";
        const it_barcode = row.cells[2]?.innerText.trim() || "";

        // Get requested values from the map
        const requested = requestedMap[itemid] || { requested_cs: 0, requested_sw: 0, requested_it: 0 };
        const cs =  row.cells[6]?.innerText.trim() || "";
        const sw =  row.cells[7]?.innerText.trim() || "";
        const it =  row.cells[8]?.innerText.trim() || "";

        // Parse dataset attributes
        const itemsPerCase = parseInt(row.dataset.itemsPerCase, 10) || 0;
        const itemsPerSw = parseInt(row.dataset.itemsPerSw, 10) || 0;
        const itemCost = parseFloat(row.dataset.itemCost) || 0;
        const caseCost = parseFloat(row.dataset.caseCost) || 0;

        // Calculate initial amounts
        const csinit = cs * itemsPerCase;
        const swinit = sw * itemsPerSw;
        const totalit = csinit + swinit + it;
        const caseamount = cs * caseCost;
        const itamount = (swinit + it) * itemCost;
        const grandTotal = caseamount + itamount;

        try {
            const response = await fetch(`/HomePage/datafetcher/transactions/Van_Loading_getdata.php?action=processtransactions`
                + `&company=${encodeURIComponent(companyid)}`
                + `&siteid=${encodeURIComponent(siteid)}`
                + `&transactionid=${encodeURIComponent(transactionid)}`
                + `&barcode=${encodeURIComponent(cs_barcode || it_barcode)}`
                + `&itemid=${encodeURIComponent(itemid)}`
                + `&batch=${encodeURIComponent(batch)}`
                + `&description=${encodeURIComponent(description)}`
                + `&cs=${cs}&sw=${sw}&it=${it}`
                + `&userid=${encodeURIComponent(userid)}`
                + `&username=${encodeURIComponent(nameofuser)}`
                + `&warehousecode=${encodeURIComponent(warehousecode)}`
                + `&vanid=${encodeURIComponent(sellerid)}`
                
              
            );

            const data = await response.json();
            if (!data.success) {
                alert(`Error processing row ${i + 1}: ${data.error || "Unknown error"}`);
                return; // Exit on error
            }
        } catch (err) {
           // console.error("Fetch error:", err);
            return; // Exit on network error
        }
    }
}

// Helper function to wait for table rows
function waitForTableRows(tbody, timeout = 3000) {
    return new Promise((resolve, reject) => {
        const interval = 50;
        let waited = 0;
        const check = () => {
            if (tbody.querySelectorAll('tr').length > 0) {
                resolve();
            } else {
                waited += interval;
                if (waited >= timeout) reject('Timeout waiting for table rows');
                else setTimeout(check, interval);
            }
        };
        check();
    });
}


/// process transaction 

function updatetransaction() {
    const transactionid = document.getElementById('transaction_id')?.value.trim();
    const sellerid = document.getElementById('cmbvan')?.value.trim();
    const remarks = document.getElementById('remarks')?.value.trim();
    const totallinesStr = document.getElementById('totalines')?.value.trim();
    const totalCSStr = document.getElementById('totalCSAmount')?.value.trim();
    const totalITStr = document.getElementById('totalITAmount')?.value.trim();

    // Basic validation
    if (!transactionid) { alert('Transaction ID is missing'); return; }
    if (!sellerid) { alert('Seller ID is missing'); return; }
    if (!totallinesStr) { alert('Total lines is missing'); return; }

    const totalcs = parseFloat(totalCSStr.replace(/,/g, '')) || 0;
    const totalit = parseFloat(totalITStr.replace(/,/g, '')) || 0;
    const total = totalcs + totalit;

    showLoader();

    fetch(`/HomePage/datafetcher/transactions/Van_Loading_getdata.php?action=processupdate&transactionid=${encodeURIComponent(transactionid)}&sellerid=${encodeURIComponent(sellerid)}&remarks=${encodeURIComponent(remarks)}&totallines=${encodeURIComponent(totallinesStr)}&total=${encodeURIComponent(total)}`)
        .then(response => {
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            return response.json();
        })
        .then(data => {
            if (data.success) {
               //alert('Transaction saved as draft.');
                // Optionally, refresh data or update UI
            } else {
                alert(`Update failed: ${data.error || 'Unknown error'}`);
            }
        })
        .catch(err => {
            alert(`An error occurred: ${err.message}`);
        })
        .finally(() => {
            hideLoader();
        });
}


// SAVE AS DRAFT

function saveasdraft() {
    const transactionid = document.getElementById('transaction_id')?.value.trim();
    const sellerid = document.getElementById('cmbvan')?.value.trim();
    const remarks = document.getElementById('remarks')?.value.trim();
    const totallinesStr = document.getElementById('totalines')?.value.trim();
    const totalCSStr = document.getElementById('totalCSAmount')?.value.trim();
    const totalITStr = document.getElementById('totalITAmount')?.value.trim();

    // Basic validation
    if (!transactionid) { alert('Transaction ID is missing'); return; }
    if (!sellerid) { alert('Seller ID is missing'); return; }
    if (!totallinesStr) { alert('Total lines is missing'); return; }

    const totalcs = parseFloat(totalCSStr.replace(/,/g, '')) || 0;
    const totalit = parseFloat(totalITStr.replace(/,/g, '')) || 0;
    const total = totalcs + totalit;

    showLoader();

    fetch(`/HomePage/datafetcher/transactions/Van_Loading_getdata.php?action=saveasdraft&transactionid=${encodeURIComponent(transactionid)}&sellerid=${encodeURIComponent(sellerid)}&remarks=${encodeURIComponent(remarks)}&totallines=${encodeURIComponent(totallinesStr)}&total=${encodeURIComponent(total)}`)
        .then(response => {
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            return response.json();
        })
        .then(data => {
            if (data.success) {
               alert('Transaction saved as draft.');
                // Optionally, refresh data or update UI
                printReport()

            } else {
                alert(`Update failed: ${data.error || 'Unknown error'}`);
            }
        })
        .catch(err => {
            alert(`An error occurred: ${err.message}`);
        })
        .finally(() => {
            hideLoader();
        });
}

function clearall(){

    document.getElementById('remarks').value = "";
    document.getElementById('totalines').value = 0;
    document.getElementById('totalCSAmount').value = 0;
    document.getElementById('totalITAmount').value = 0;
    document.getElementById('totalSIH').value = 0;


 const itemsTableBody = document.querySelector('#itemsTable tbody');

// Clear all rows in the table body
itemsTableBody.innerHTML = '';

}


/// print picklist
function printReport() {
  const transactionId   = document.getElementById('transaction_id').value;
  const sellerName      = document.getElementById('cmbvan').value;
  const transactionDate = document.getElementById('date_created').value;
  const remarks         = document.getElementById('remarks').value;
  const companyname     = "<?php echo $_SESSION['Company_Name']; ?>";

  // Get items table
  const itemsTable = document.getElementById('itemsTable') || 
                     document.querySelector('table') || 
                     document.querySelector('.items-table');

  if (!itemsTable) {
    alert('Items table not found!');
    return;
  }

  // Clone and clean table
  const clonedTable = itemsTable.cloneNode(true);
  clonedTable.querySelectorAll('button, input, select, a').forEach(btn => btn.remove());
  const columnsToRemove = [9,10,11,12]; 
  clonedTable.querySelectorAll('tr').forEach(row => {
    const cells = row.querySelectorAll('th, td');
    columnsToRemove.forEach(index => { if (cells[index]) cells[index].remove(); });
  });

  // Style widths
  const columnWidths = { 0:"10px", 1:"80px", 2:"50px", 3:"50px", 4:"350px" };
  clonedTable.querySelectorAll('tr').forEach(row => {
    const cells = row.querySelectorAll('th, td');
    Object.entries(columnWidths).forEach(([i, w]) => {
      if (cells[i]) { 
        cells[i].style.width = w; 
        cells[i].style.minWidth = w; 
        cells[i].style.maxWidth = w; 
      }
    });
  });

  // Build the report HTML
  const reportContent = `
    <html>
      <head>
        <title>Van Picklist</title>
        <style>
          body { font-family: Arial, sans-serif; margin: 10px; font-size: 11px; line-height: 1.2; }
          .header { text-align: center; margin-bottom: 15px; border-bottom: 2px solid #000; padding-bottom: 10px; }
          .company-name { font-size: 14px; font-weight: bold; }
          .report-title { font-size: 12px; font-weight: bold; margin: 10px 0; }
          .transaction-info { margin: 10px 0; padding: 5px; border: 1px solid #ccc; }
          .transaction-info p { margin: 3px 0; }
          .items-table { width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 9px; page-break-inside: avoid; }
          .items-table th, .items-table td { border: 1px solid #000; padding: 4px; text-align: center; }
          .items-table th { background-color: #f0f0f0; font-weight: bold; }
          .total-row { font-weight: bold; background-color: #e0e0e0; }
          .signature-section { margin-top: 30px; padding-top: 20px; border-top: 1px solid #000; }
          .report-buttons { margin-bottom: 15px; }
          .report-buttons button { margin-right: 10px; padding: 6px 12px; font-size: 12px; cursor: pointer; }
          @media print { .report-buttons { display: none !important; } }
        </style>
      </head>
      <body>
        <div id="reportContent">
          <div class="header">
            <div class="company-name">${companyname}</div>
            <div class="report-title">VAN PICKLIST</div>
          </div>

          <div class="report-buttons">
            <button onclick="printOnly()">🖨️ Print</button>
            <button onclick="exportExcel()">📊 Export Excel</button>
            <button onclick="exportPDF()">📄Export PDF</button>
          </div>

          <div class="transaction-info">
            <p><strong>TRANSACTION ID:</strong> ${transactionId}</p>
            <p><strong>DATE CREATED:</strong> ${transactionDate}</p>
            <p><strong>SELLER:</strong> ${sellerName}</p>
          </div>

          <table id="reportTable" class="items-table">
            ${clonedTable.innerHTML}
          </table>

          <div class="signature-section">
            <p>REMARKS: ${remarks}</p>
            <br><br>
            <p>PREPARED BY: _________________________</p>
            <p>DATE: _________________________</p>
          </div>
        </div>

        <script>
          function exportExcel() {
            const report = document.getElementById('reportContent').cloneNode(true);
            const btns = report.querySelector('.report-buttons');
            if (btns) btns.remove();

            const excelFile = \`
              <html xmlns:o="urn:schemas-microsoft-com:office:office"
                    xmlns:x="urn:schemas-microsoft-com:office:excel"
                    xmlns="http://www.w3.org/TR/REC-html40">
              <head><meta charset="UTF-8"></head>
              <body>
                \${report.innerHTML}
              </body>
              </html>\`;

            const blob = new Blob([excelFile], { type: 'application/vnd.ms-excel' });
            const link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = 'van_picklist.xls';
            link.click();
          }

          function exportPDF() {
            const btns = document.querySelector('.report-buttons');
            if (btns) btns.style.display = 'none';
            window.print();
            if (btns) btns.style.display = 'block';
          }

          function printOnly() {
            const btns = document.querySelector('.report-buttons');
            if (btns) btns.style.display = 'none';
            window.print();
            if (btns) btns.style.display = 'block';
          }
        <\/script>
      </body>
    </html>
  `;

  // Open popup
const width = 800;
const height = 700;

// calculate center position
const left = (window.screen.width / 2) - (width / 2);
const top = (window.screen.height / 2) - (height / 2);

// open centered popup
const features = `width=${width},height=${height},top=${top},left=${left},` +
                 `resizable=yes,scrollbars=yes,status=no,toolbar=no,menubar=no,location=no`;

const printWindow = window.open('', '', features);

printWindow.document.write(reportContent);
printWindow.document.close();
}



function printloading() {
  const transactionId = document.getElementById('transaction_id').value;
  const sellerName = document.getElementById('cmbvan').value;
  const transactionDate = document.getElementById('date_created').value;
  const remarks = document.getElementById('remarks').value;
  const companyname = "<?php echo $_SESSION['Company_Name']; ?>";
  const status = document.getElementById('status').value;

  const totalCSStr = document.getElementById('totalCSAmount')?.value.trim();
  const totalITStr = document.getElementById('totalITAmount')?.value.trim();

  if (!transactionId) { alert('Transaction ID is missing'); return; }
  if (status !== 'ALLOCATED') {
    alert('Cannot print not allocated transactions');
    return;
  }

  const totalcs = parseFloat(totalCSStr.replace(/,/g, '')) || 0;
  const totalit = parseFloat(totalITStr.replace(/,/g, '')) || 0;
  const total = totalcs + totalit;

  const itemsTable = document.getElementById('itemsTable') || 
                    document.querySelector('table') || 
                    document.querySelector('.items-table');

  if (!itemsTable) {
    alert('Items table not found!');
    return;
  }

  const clonedTable = itemsTable.cloneNode(true);

  // Remove unwanted controls
  clonedTable.querySelectorAll('button, input, select, a').forEach(el => el.remove());

  // Remove unwanted columns (e.g. ACTION, TOTAL SIH)
  const removeCols = ["ACTION", "TOTAL SIH"];
  const headerCells = clonedTable.querySelectorAll("thead th");
  let removeIndexes = [];

  headerCells.forEach((th, i) => {
    if (removeCols.includes(th.innerText.trim().toUpperCase())) {
      removeIndexes.push(i);
    }
  });

  clonedTable.querySelectorAll("tr").forEach(row => {
    const cells = row.querySelectorAll("th, td");
    removeIndexes.forEach(idx => {
      if (cells[idx]) cells[idx].remove();
    });
  });

  // Calculate totals
  let totalCS = 0, totalSW = 0, totalIT = 0, totalCSAmount = 0, totalITAmount = 0;
  clonedTable.querySelectorAll("tbody tr").forEach(row => {
    const cells = row.querySelectorAll("td");
    if (cells.length > 0) {
      totalCS += parseFloat(cells[3].innerText) || 0;
      totalSW += parseFloat(cells[4].innerText) || 0;
      totalIT += parseFloat(cells[5].innerText) || 0;
      totalCSAmount += parseFloat(cells[7].innerText.replace(/,/g, "")) || 0;
      totalITAmount += parseFloat(cells[8].innerText.replace(/,/g, "")) || 0;
    }
  });

  // Append totals row
  const tfoot = document.createElement("tfoot");
  tfoot.innerHTML = `
    <tr class="total-row">
      <td colspan="3" style="text-align:right;">TOTAL:</td>
      <td>${totalCS}</td>
      <td>${totalSW}</td>
      <td>${totalIT}</td>
      <td></td>
      <td>${totalCSAmount.toLocaleString(undefined, {minimumFractionDigits:2, maximumFractionDigits:2})}</td>
      <td>${totalITAmount.toLocaleString(undefined, {minimumFractionDigits:2, maximumFractionDigits:2})}</td>
    </tr>
  `;
  clonedTable.appendChild(tfoot);

  const reportContent = `
  <html>
    <head>
      <style>
        body { font-family: Arial, sans-serif; margin: 20px; font-size: 11px; line-height: 1.3; }
        .header { text-align: center; margin-bottom: 20px; }
        .company-name { font-size: 14px; font-weight: bold; }
        .company-address { font-size: 11px; margin: 3px 0; }
        .report-title { font-size: 14px; font-weight: bold; margin: 10px 0; text-decoration: underline; }
        .transaction-section { width: 100%; margin-bottom: 10px; font-size: 11px; }
        .transaction-section td { padding: 2px 5px; }
        .items-table { width: 100%; border-collapse: collapse; margin-top: 15px; font-size: 10px; }
        .items-table th, .items-table td { border: 1px solid #000; padding: 4px; text-align: center; }
        .items-table td:nth-child(3) { text-align: left; } /* DESCRIPTION column */
        .items-table th { font-weight: bold; }
        .total-row td { font-weight: bold; }
        .signature-section { margin-top: 40px; font-size: 11px; }
        .signature-section p { margin: 5px 0; }
        .line { display: inline-block; width: 200px; border-bottom: 1px solid #000; margin-left: 10px; }
        @media print { body { margin: 0; padding: 20px; } }
      </style>
    </head>
    <body>
      <div class="header">
        <div class="company-name">EMPERADOR DISTILLERS, INC.</div>
        <div class="company-address">Vensu Ventures Inc., Leon Llido St., General Santos City</div>
        <div class="report-title">VAN LOADING REPORT</div>
      </div>

      <table class="transaction-section">
        <tr>
          <td><strong>TRANSACTION ID:</strong> ${transactionId}</td>
          <td><strong>DATE CREATED:</strong> ${transactionDate}</td>
        </tr>
        <tr>
          <td><strong>SELLER:</strong> ${sellerName}</td>
          <td><strong>STATUS:</strong> ALLOCATED</td>
        </tr>
        <tr>
          <td><strong>AMOUNT:</strong> ${total.toLocaleString(undefined, {minimumFractionDigits:2, maximumFractionDigits:2})}</td>
          <td></td>
        </tr>
      </table>

      ${clonedTable.outerHTML}

      <div class="signature-section">
        <p>RECEIVE THE ABOVE GOODS IN GOOD CONDITION</p>
        <br><br>
        <p>CHECKED BY: <span class="line"></span></p>
        <p>DATE: <span class="line"></span></p>
      </div>
    </body>
  </html>
  `;

  const printWindow = window.open('', '_blank', 'width=1000,height=700');
  printWindow.document.write(reportContent);
  printWindow.document.close();

  printWindow.onload = function() {
    setTimeout(() => {
      printWindow.focus();
      printWindow.print();
      printWindow.close();
    }, 500);
  };
}


</script>


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