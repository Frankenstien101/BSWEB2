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


   <input type="hidden" id="categorytxt" name="categorytxt">
<input type="hidden" id="warehouseid" name="warehouseid">


<!-- Filter Cards Container -->
<button class="btn btn-primary btn-sm" id="newTransBtn">New transaction</button>
<button class="btn btn-primary btn-sm" onclick="">Load transaction</button>

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
                        <input type="text" id="remarks" style = "max-width: 100%;" class="form-control form-control-sm" placeholder="Remarks">
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
      <div class="card-body" style="overflow-y: auto; max-width: 100%; height: 450px;"  >
        <table id="itemsTable" class="table table-striped table-hover table-bordered table-sm " style="font-size: 10px;">
          
        <thead>
    <tr>
      <th>#</th>
        <th>BARCODE</th>
        <th>ITEM ID</th>
        <th>DESCRIPTION</th>
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

            <!-- ...repeat rows as needed... -->
          </tbody>
        </table>
      </div>
    </div>

<!-- Export Button -->
<div style="display: flex; justify-content: space-between; align-items: center; margin-top: 2px; font-size: 10px;">
    <!-- Totals on the left -->
    <div>
        <label style="margin-right: 10px;">TOTAL CASE AMOUNT 
            <input type="text" id="totalCSAmount" readonly style="width:80px; font-size: 10px;">
        </label>
        <label style="margin-right: 10px;">TOTAL IT AMOUNT 
            <input type="text" id="totalITAmount" readonly style="width:80px; font-size: 10px;">
        </label>
        <label>TOTAL SIH: 
            <input type="text" id="totalSIH" readonly style="width:80px; font-size: 10px;">
        </label>
    </div>

    <!-- Button on the right -->
    <div>
        <button class="btn btn-success btn-sm" onclick="">PROCESS VAN LOADING</button>
    </div>
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
    const transactionEl = document.getElementById('transaction_id');
    const warehouseEl = document.getElementById('warehouse');
    const warehousecode = warehouseEl ? warehouseEl.value.trim() : "";

    // Check if transaction exists & has a value
    if (!transactionEl || !transactionEl.value.trim()) {
        alert("No transaction found");
        return false;  // stop function
    }

    // Check if warehouse is selected
    if (!warehousecode) {
        alert("No warehouse selected");
        return false;  // stop function
    }

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
    const companyId = "<?php echo $_SESSION['COMPANY_ID'] ?? ''; ?>";
    const siteid = "<?php echo $_SESSION['SITE_ID'] ?? ''; ?>";
    const warehousecode = document.getElementById('warehouse').value;
    const categorytxt = document.getElementById('categorytxt').value;
    const transactionid  = document.getElementById('transaction_id').value;
    const vanid  = document.getElementById('cmbvan').value;



    const tbody = document.querySelector('#tblskus tbody');
    if (!tbody) return;

    tbody.innerHTML = ''; // Clear previous rows
    showLoader();

    fetch(`/HomePage/datafetcher/transactions/Van_Loading_getdata.php?action=loadskus&company=${encodeURIComponent(companyId)}&siteid=${encodeURIComponent(siteid)}&warehousecode=${encodeURIComponent(warehousecode)}&category=${encodeURIComponent(categorytxt)}`)
        .then(response => {
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            return response.json(); 
        })
        .then(data => {
            loadedPOs = data;
            if (!data || data.length === 0) {
                const tr = document.createElement('tr');
                tr.innerHTML = '<td colspan="12" class="text-center">No items found.</td>';
                tbody.appendChild(tr);
                return;
            }

                   data.forEach((item, index) => {
            const tr = document.createElement('tr');

             tr.dataset.itemsPerCase = item.ITEMS_PER_CASE || 0;
              tr.dataset.itemsPerSw   = item.ITEMS_PER_SW || 0;
              tr.dataset.itemCost     = item.ITEM_COST || 0;
              tr.dataset.caseCost     = item.CASE_COST || 0;


            tr.innerHTML = `
                <td>${index + 1}</td>
                <td>${item.CS_BARCODE || ''}</td>
                <td>${item.IT_BARCODE || ''}</td>
                <td>${item.ITEM_ID || ''}</td>
                <td>${item.BATCH || ''}</td>
                <td>${item.DESCRIPTION || ''}</td>
                <td>${item.CS || 0}</td>
                <td>${item.SW || 0}</td>
                <td>${item.IT || 0}</td>
                <td><input type="number" class="form-control form-control-sm cs-input" style="width:50px" value="0" min="0"></td>
                <td><input type="number" class="form-control form-control-sm sw-input" style="width:50px" value="0" min="0"></td>
                <td><input type="number" class="form-control form-control-sm it-input" style="width:50px" value="0" min="0"></td>
                <td><button class="btn btn-sm btn-primary add-to-list-btn">Add to List</button></td>
            `;
            tbody.appendChild(tr);
                
            // Add click event for the button
            const addBtn = tr.querySelector('.add-to-list-btn');
            addBtn.addEventListener('click', () => {
                const cs = parseInt(tr.querySelector('.cs-input').value, 10) || 0;
                const sw = parseInt(tr.querySelector('.sw-input').value, 10) || 0;
                const it = parseInt(tr.querySelector('.it-input').value, 10) || 0;
            
                const availcs = item.CS || 0;
                const availsw = item.SW || 0;
                const availit = item.IT || 0;
                const barcode = item.IT_BARCODE || 0;
                const description = item.DESCRIPTION || 0;
                const batch = item.BATCH || 'DEFAULT';
                const itemid = item.ITEM_ID || 0;


                // Example check: prevent exceeding available stock
                if (cs > availcs || sw > availsw || it > availit) {
                    alert("Quantity exceeds available stock!");
                    return;
                }

                 const itemsPerCase = parseInt(tr.dataset.itemsPerCase, 10) || 0;
                 const itemsPerSw   = parseInt(tr.dataset.itemsPerSw, 10) || 0;
                 const itemCost     = parseFloat(tr.dataset.itemCost) || 0;
                 const caseCost     = parseFloat(tr.dataset.caseCost) || 0;
                             
                 const csinit  = cs * itemsPerCase;   // total items from cases
                 const swinit  = sw * itemsPerSw;     // total items from SW
                 const totalit = csinit + swinit + it; // grand total items
                             
                 const swandit = swinit + it;         
                             
                 const caseamount = cs * caseCost;                          // total cost of cases
                 const itamount   = (swinit + it) * itemCost;               // total cost of sw+it
                 const grandTotal = caseamount + itamount;                  // final combined cost

                // Example: push to some array or handle as needed
                console.log(`Added: ITEM_ID=${item.ITEM_ID}, CS=${cs}, SW=${sw}, IT=${it}`);
            

                     // SAVE TO VAN LOADING DETAILS 

                    fetch(`/HomePage/datafetcher/transactions/Van_Loading_getdata.php?action=saveonvanloaddetails&company=${encodeURIComponent(companyId)}&siteid=${encodeURIComponent(siteid)}&transactionid=${encodeURIComponent(transactionid)}
                    &vanid=${encodeURIComponent(vanid)}&transactionid=${encodeURIComponent(transactionid)}&barcode=${encodeURIComponent(barcode)}&itemid=${encodeURIComponent(itemid)}
                    &description=${encodeURIComponent(description)}&batch=${encodeURIComponent(batch)}&description=${encodeURIComponent(description)}
                    &batch=${encodeURIComponent(batch)}&cs=${encodeURIComponent(cs)}&sw=${encodeURIComponent(sw)}&it=${encodeURIComponent(it)}
                    &price=${encodeURIComponent(itemCost)}&itpercase=${encodeURIComponent(itemsPerCase)}&itpersw=${encodeURIComponent(itemsPerSw)}
                    &sihit=${encodeURIComponent(totalit)}&totalcs=${encodeURIComponent(caseamount)}&totalit=${encodeURIComponent(itamount)}`)
                        .then(response => {
                            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                            return response.json();
                        })
                        .then(data => {
                            if (!Array.isArray(data)) {
                                console.error("Invalid data", data);
                                return;
                            }
                    
                        })
                        .catch(err => {
                            console.error('Error saving details:', err);
                        });

                // Optionally, give visual feedback
                addBtn.innerText = "Added!";
                addBtn.disabled = true;
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
                const transaction_id = 'VL2' + companyId + siteId + data.count;
           
                document.getElementById('transaction_id').value = transaction_id;
                     document.getElementById('status').value = 'DRAFT';
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
    showLoader(); // Show loader before fetch

    fetch(`/HomePage/datafetcher/transactions/Van_Loading_getdata.php?action=loadlist&transactionid=${encodeURIComponent(transactionid)}`)
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
                    <td>${item.BARCODE || ''}</td>
                    <td>${item.ITEM_CODE || ''}</td>
                    <td>${item.DESCRIPTION || ''}</td>
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

                tbody.appendChild(tr);

                        updateTotals();

                // Remove button click event
                tr.querySelector('.remove-btn').addEventListener('click', () => {
                    if (confirm('Are you sure you want to remove this item?')) {
                        tr.remove();                // Remove row from table
                        updateRowIndexes(tbody);    // Update row numbers
                        removeitem(item.ITEM_CODE); // Remove from server and loadedPOs
                        updateTotals();
                        
                    }
                });
            });
        })
        .catch(err => {
            console.error('Error loading items:', err);
        })
        .finally(() => {
            hideLoader(); // Hide loader when done
        });
}



function updateTotals() {
    let totalCS = 0, totalIT = 0, totalSIH = 0;

    loadedPOs.forEach(item => {
        totalCS += Number(item.TOTAL_CS_AMOUNT) || 0;
        totalIT += Number(item.TOTAL_IT_AMOUNT) || 0;
        totalSIH += Number(item.SIH_IT) || 0;
    });

    document.getElementById('totalCSAmount').value = totalCS.toLocaleString('en-PH', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    document.getElementById('totalITAmount').value = totalIT.toLocaleString('en-PH', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    document.getElementById('totalSIH').value = totalSIH.toLocaleString('en-PH', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
}


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