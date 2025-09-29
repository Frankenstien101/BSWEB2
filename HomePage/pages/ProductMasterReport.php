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
    <h3>PRODUCT MASTER</h3>

      <!-- item details -->
    <div class="card text-bg-light" data-bs-spy="scroll" style="max-width: 100%; max-height:80vh; margin-bottom: .5rem; Font-size: 10px;">
      <div class="card-header"></div>
  <div class="card-body" style="overflow-y: auto; overflow-x: auto;  height: 75vh;">
        <table id="itemsTable" class="table table-striped table-hover table-bordered table-sm " style="font-size: 10px;">
          
  <thead>
    <tr>
      <th>#</th>
         <th>ITEMID</th>
        <th>DESCRIPTION</th>
        <th>ORDERING UNIT</th>
        <th>LOT NUMBER INDICATOR</th>
        <th>STOCK UOM</th>
        <th>PURCHASE UOM</th>
        <th>SELLING UOM</th>
        <th>CATEGORY</th>
        <th>BRAND</th>
        <th>VARIANT</th>
        <th>CS PER PALLET</th>
        <th>IT PER CS</th>
        <th>IT PER SW</th>
        <th>IT COST</th>
        <th>CS COST</th>
        <th>CS BARCODE</th>
        <th>IT BARCODE</th>
        <th>TAX</th>
        <th>ITEM TIER</th>
        <th>STATUS</th>
        <th>CS EX VAT</th>
        <th>IT EX VAT</th>
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
    loaditems();
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
    const tbody = document.querySelector('#itemsTable tbody');
    if (!tbody) return;

    tbody.innerHTML = ''; // Clear previous rows
    showLoader(); // Show loader before fetch

    fetch(`/HomePage/datafetcher/reports/getdatareports.php?action=loaditems&company=${encodeURIComponent(companyId)}`)
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
                if (item.STATUS === 'ACTIVE') statusClass = 'bg-green';
                else if (item.STATUS === 'INACTIVE') statusClass = 'bg-red';
                else statusClass = 'bg-blue';

                tr.innerHTML = `
                    <td>${index + 1}</td>
                    <td>${item.ITEMID || ''}</td>
                    <td>${item.DESCRIPTION || ''}</td>
                    <td>${item.ORDERING_UNIT || ''}</td>
                    <td>${item.LOT_NUMBER_INDICATOR || ''}</td>
                    <td>${item.STOCK_UOM || ''}</td>
                    <td>${item.PURCHASE_UOM || ''}</td>
                    <td>${item.SELLING_UOM || ''}</td>
                    <td>${item.CATEGORY || ''}</td> 
                    <td>${item.BRAND || ''}</td>
                    <td>${item.VARIANT || ''}</td>
                    <td>${item.CASES_PER_PALLET || ''}</td>
                    <td>${item.ITEMS_PER_CS || ''}</td>
                    <td>${item.ITEMS_PER_SW || ''}</td>
                    <td>${item.ITEM_COST || ''}</td>
                    <td>${item.CASE_COST || ''}</td>
                    <td>${item.CASE_BARCODE || ''}</td>
                    <td>${item.IT_BARCODE || ''}</td>
                    <td>${item.TAX || ''}</td>
                    <td>${item.ITEM_TIER || ''}</td>
                    <td class="${statusClass}">${item.STATUS || ''}</td>
                    <td>${item.CS_EX_VAT || ''}</td>
                    <td>${item.IT_EX_VAT || ''}</td>
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
    XLSX.utils.book_append_sheet(workbook, worksheet, "Products");

    // Export the Excel file
    XLSX.writeFile(workbook, "items_report.xlsx");
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