<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Product Master</title>
  </head>
  <body>
    <h3>STOCK VIEW</h3>

<STYLE>
    .card.text-bg-light {
    max-width: 50%;
    font-size: 9px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.card-header {
    padding: 0.25rem 1rem;
    border-bottom: 1px solid #ddd;
    background-color: #f8f9fa;
}

.date-filter-body {
    padding: 0.5rem 1rem;
}

.date-filter-body .header {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem 0.5rem;
    align-items: center;
}

.date-filter-body label {
    font-weight: 600;
    margin-bottom: 0;
    white-space: nowrap;
}

.date-filter-body select.form-select,
.date-filter-body input {
    font-size: 9px;
    height: 28px;
    min-width: 15px;
    padding: 0 5px;
}

.date-filter-body input {
    border: 1px solid #ced4da;
    border-radius: 4px;
}

.date-filter-body button.btn {
    height: 28px;
    font-size: 8.5px;
    padding: 0 25px;
    white-space: nowrap;
}

.error-message {
    color: #dc3545;
    margin-top: 0.25rem;
    font-size: 8px;
}

</STYLE>

 <div class="card text-bg-light ml-1" style="max-width: 35%; font-size: 9px;">

 <h3></h3>
        <div class="card-header d-flex justify-content-between align-items-left">
        </div>
        <div class="card-body date-filter-body ">
            <div class="header">
                <label>WAREHOUSE:</label>
                <select id="warehouse" name="ware" class="form-select">
                <option value="" disabled selected>Select an option</option>
                <!-- options will be dynamically inserted here -->
                </select>
                <label>SUB WAREHOUSE:</label>
                  <select id="subwarehouse" name="subware" class="form-select">
                  <option value="" disabled selected>Select an option</option>
                  <option value="SALABLE">SALABLE</option>
                  <option value="DAMAGE">DAMAGE</option>
                  <option value="EXPIRED">EXPIRED</option>
                </select> 
                <button class="btn btn-primary btn-sm" onclick="loaditems()">GENERATE</button>
            </div>
            <div id="date-error" class="error-message"></div>
        </div>
    </div>
    
      <!-- item details -->
    <div class="card text-bg-light" data-bs-spy="scroll" style="max-width: 100%; height:100%; margin-bottom: .5rem; Font-size: 10px;">
      <div class="card-header"></div>
      <div class="card-body" style="overflow-y: auto; max-width: 100%; height: 610px;"  >
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

    <div class="text-right mb-0">
<button class="btn btn-success mb-2" onclick="exportToExcel()">Export to Excel</button>  </div>


  <div id="loading" style="
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(255, 255, 255, 0.8);
    display: none; /* hidden by default */
    justify-content: center;
    align-items: center;
    z-index: 9999;
">
    <div style="text-align:center;">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
        <div style="margin-top:10px;">Loading Data...</div>
    </div>
</div>

<!-- Add this before your script that calls XLSX -->
<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>

    <!-- ...SCRIPT TO FILL TABLE WHEN PAGE LOADS... -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    //loaditems();
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
      const warehouse = document.getElementById('warehouse').value;
       const subwarehouse = document.getElementById('subwarehouse').value;

    const tbody = document.querySelector('#itemsTable tbody');
    if (!tbody) return;

    tbody.innerHTML = ''; // Clear previous rows
    showLoader(); // Show loader before fetch

    fetch(`/HomePage/datafetcher/reports/getdatareports.php?action=getwarehouseinventory&company=${encodeURIComponent(companyId)}&siteid=${encodeURIComponent(siteid)}&warehouse=${encodeURIComponent(warehouse)}&subwarehouse=${encodeURIComponent(subwarehouse)}`)
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

                tr.innerHTML = `
                    <td>${index + 1}</td>
                    <td>${item.ITEM_ID || ''}</td>
                     <td>${item.BATCH || ''}</td>
                      <td>${item.DESCRIPTION || ''}</td>
                       <td>${item.CS || ''}</td>
                        <td>${item.SW || ''}</td>
                         <td>${item.IT || ''}</td>
                        <td>${item.CS_BARCODE || ''}</td>
                        <td>${item.IT_BARCODE || ''}</td>
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
    XLSX.writeFile(workbook, "Stock_View_report.xlsx");
}



document.addEventListener("DOMContentLoaded", function () {
    loadWarehouses();
   // loaditems();  // your existing function
});

// get warehosue 


function loadWarehouses() {
    const companyId = "<?php echo $_SESSION['COMPANY_ID'] ?? ''; ?>";
     const siteid = "<?php echo $_SESSION['SITE_ID'] ?? ''; ?>";
    const warehouseSelect = document.getElementById('warehouse');

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
                warehouseSelect.appendChild(option);
            });
        })
        .catch(err => {
            console.error('Error loading warehouses:', err);
        });
}

</script>








    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
       <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  

  </body>
</html>