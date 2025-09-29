<!doctype html>
<html lang="en">
  <head>

  
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link
  href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
  rel="stylesheet"
/>

  <title>PO VIEW</title>
  </head>

<style>

  .bg-green {
    background-color: green;
    color: white; /* Optional: for better text visibility */
}

.bg-gold {
    background-color: gold;
}

.bg-blue {
    background-color: blue;
    color: white; /* Optional: for better text visibility */
}

</style>

<!-- Bootstrap JS for modal -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <body>
    
    <h2>PURCHASE ORDER VIEW</h2>

        <input type="hidden" id="PONUMBER">

  <div class="card mt-1" style="width: 30rem; margin-bottom: 1rem; font-size: 12px; max-width: 100%;">

  <div class="card-body p-2 mt-1" style="font-size: 10px;">
    <form>
      <div class="form-row align-items-end">
        <div class="form-group col-md-4">
          <label for="dateFrom">From</label>
          <input
            type="date"
            class="form-control" style="font-size: 10px;"
            id="dateFrom"
            name="dateFrom"
            required
            value="<?php echo date('Y-m-d'); ?>"
          />
        </div>

        <div class="form-group col-md-4">
          <label for="dateTo">To</label>
          <input
            type="date"
            class="form-control " style="font-size: 10px;"
            id="dateTo"
            name="dateTo"
            required
            value="<?php echo date('Y-m-d'); ?>"
          />
        </div>

        <div class="form-group col-md-4">
          <button style = "font-size : 12px; width : 120px;" type="button" onclick= "loadItemsByDateRange()" class="btn btn-primary btn-block">
            Filter
          </button>
        </div>
      </div>
    </form>
  </div>
</div>

  <!-- item details -->
    <div class="card text-bg-light" data-bs-spy="scroll" style="max-width: 100%; height:100%; margin-bottom: .5rem; Font-size: 10px;">
      <div class="card-header">Result</div>
      <div class="card-body" style="overflow-y: auto; max-width: 100%; height: 590px;"  >
        <table id="itemsTable" class="table table-striped table-hover table-bordered table-sm " style="font-size: 10px;">
  <thead>
    <tr>
      <th>#</th>
      <th>DATE CREATED</th>
      <th>PO NUMBER</th>
      <th>PO DATE</th>
      <th>EXPECTED DAYS</th>
      <th>TOTAL LINES</th>
      <th>TOTAL AMOUNT</th>
      <th>ADDRESS</th>
      <th>DATE RECEIVED</th>
      <th>INVOICE DATE</th>
      <th>INVOICE NUMBER</th>
      <th>STATUS</th>
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

<!-- Modal -->
<div class="modal fade" id="loadTransModal" tabindex="-1" aria-labelledby="loadTransModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loadTransModalLabel" style="font-size: 12px; font-weight: bold;">
        <span id="modalTitlePoNumber"></span>
        </h5>
      </div>
      <div class="modal-body" style = "overflow-y: auto; max-height: 500px; font-size: 10px;">
        <div class="container-fluid">
          <div class="row">
        <!-- item details -->

        <table id="itemsTable111" class="table table-striped table-hover table-bordered table-sm " style="font-size: 10px;">
          
  <thead>
    <tr>
      <th>#</th>
       <th>CASE_BARCODE</th>
        <th>IT_BARCODE</th>
      <th>ITEM_ID</th>
      <th>DESCRIPTION</th>
      <th>PO CS</th>
      <th>PO SW</th>
      <th>PO IT</th>
      <th>ACTUAL CS</th>
      <th>ACTUAL SW</th>
      <th>ACTUAL IT</th>
      <th>AMOUNT</th>
    </tr>
  </thead>
  <tbody>
    <!-- Filled dynamically -->
  </tbody>
            <!-- ...repeat rows as needed... -->
          </tbody>
        </table>
          <!-- Add more content here -->
        </div>
      </div>
      <div class="modal-footer" style = "overflow-y: auto">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>

/// This script fetches and displays purchase order data based on date range and company/site filters
let loadedPOs = []; // Global to store fetched data

function loadItemsByDateRange() {
  const dateFrom = document.querySelector('#dateFrom')?.value;
  const dateTo = document.querySelector('#dateTo')?.value;
  const companyId = "<?php echo $_SESSION['COMPANY_ID'] ?? ''; ?>";
  const siteid = "<?php echo $_SESSION['SITE_ID'] ?? ''; ?>";

  if (!dateFrom || !dateTo) {
    console.error('Date range inputs missing or empty');
    return;
  }

  const tbody = document.querySelector('#itemsTable tbody');
  if (!tbody) {
    console.error('Table tbody not found');
    return;
  }
  tbody.innerHTML = ''; // Clear previous rows

  fetch(`/HomePage/datafetcher/transactions/PO_view_getdata.php?action=loadtransactions&dateFrom=${encodeURIComponent(dateFrom)}&dateTo=${encodeURIComponent(dateTo)}&company=${encodeURIComponent(companyId)}&siteid=${encodeURIComponent(siteid)}`)
    .then(response => {
      if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
      return response.json();
    })
    .then(data => {
      loadedPOs = data; // Save globally
      if (!data || data.length === 0) {
        const tr = document.createElement('tr');
        tr.innerHTML = '<td colspan="13" class="text-center">No items found.</td>';
        tbody.appendChild(tr);
        return;
      }

      data.forEach((item, index) => {
        const tr = document.createElement('tr');
        
        // Determine the background color class based on STATUS
        let statusClass = '';
        if (item.STATUS === 'RECEIVED') {
            statusClass = 'bg-green';
        } else if (item.STATUS === 'ALLOCATED') {
            statusClass = 'bg-gold';
        } else if (item.STATUS === 'DRAFT') {
            statusClass = 'bg-blue';
        }
        
        tr.innerHTML = `
          <td>${index + 1}</td>
          <td>${item.DATE_CREATED || ''}</td>
          <td>${item.PO_NUMBER || ''}</td>
          <td>${item.PO_DATE || ''}</td>
          <td>${item.EXPECTED_DAYS || ''}</td>
          <td>${item.TOTAL_QTY || ''}</td>
          <td>${item.TOTAL_AMOUNT ? parseFloat(item.TOTAL_AMOUNT).toLocaleString('en-PH', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) : '0.00'}</td>
          <td>${item.ADDRESS || ''}</td>
           <td>${item.DATE_RECEIVED || ''}</td>
          <td>${item.INVOICE_DATE || ''}</td>
          <td>${item.INVOICE_NUMBER || ''}</td>
          <td class="${statusClass}">${item.STATUS || ''}</td>
          <td>
            <button type="button" id="btnview" onclick = "loaditemsperpo()" class="btn btn-sm btn-info select-btn" 
                    data-itemid="${item.PO_NUMBER || ''}" 
                    data-bs-toggle="modal" 
                    data-bs-target="#loadTransModal"
                    data-po-number="${item.PO_NUMBER || ''}">
              View
            </button>
            <button class="btn btn-sm btn-info select-btn" id="btnprintpo" data-itemid="${item.PO_NUMBER || ''}">Print PO</button>
            <button class="btn btn-sm btn-warning select-btn" id="btnprintpotogrn" data-itemid="${item.PO_NUMBER || ''}">Print PO to GRN</button>
            <button class="btn btn-sm btn-light select-btn" id="btndownload" data-itemid="${item.PO_NUMBER || ''}">Download</button>
          </td>
        `;
        tbody.appendChild(tr);
      });
    })
    .catch(err => {
      console.error('Error loading items:', err);
    });
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
  // Event delegation for all buttons
  document.querySelector('#itemsTable tbody').addEventListener('click', function(e) {
    const target = e.target.closest('.select-btn');
    if (!target) return;
    
    const poNumber = target.getAttribute('data-itemid');
    const item = loadedPOs.find(po => po.PO_NUMBER === poNumber);
    
    if (!item) {
     // alert('Selected PO not found in loaded data');
      return;
    }

    // Handle different button actions
    if (target.id === 'btnview') {
      // Update modal content with PO details
      document.getElementById('PONUMBER').textContent = poNumber;
      document.getElementById('modalPoDate').textContent = item.PO_DATE || 'N/A';
      document.getElementById('modalTotalAmount').textContent = item.TOTAL_AMOUNT || '0.00';
      // Add more fields as needed

      alert(`Viewing PO: ${poNumber}`);
      loaditemsperpo(); // Load items for this PO

      // Modal will open automatically due to data-bs-toggle and data-bs-target attributes
    } 
    else if (target.id === 'btnprintpo') {
      console.log('Print PO:', poNumber);
      // Add print PO logic here
    } 
    else if (target.id === 'btnprintpotogrn') {
      console.log('Print PO to GRN:', poNumber);
      // Add print PO to GRN logic here
    } 
    else if (target.id === 'btndownload') {
      console.log('Download PO:', poNumber);
      // Add download logic here
    }
  });

  // Initialize modal event listeners
  const viewModal = document.getElementById('loadTransModal');
  if (viewModal) {
    viewModal.addEventListener('show.bs.modal', function(event) {
      const button = event.relatedTarget; // Button that triggered the modal
      const poNumber = button.getAttribute('data-po-number');
      document.getElementById('PONUMBER').value = poNumber;
      document.getElementById('modalTitlePoNumber').textContent = `PO Number: ${poNumber}`;

    });
  }
});


// function to load items for a specific PO 


function loaditemsperpo() {
  const companyId = "<?php echo $_SESSION['COMPANY_ID'] ?? ''; ?>";
  const siteid = "<?php echo $_SESSION['SITE_ID'] ?? ''; ?>";
  const poNumber = document.getElementById('PONUMBER').value;


  if (!poNumber || !poNumber) {
    console.error('PO number inputs missing or empty');
    return;
  }

  const tbody = document.querySelector('#itemsTable111 tbody');
  if (!tbody) {
    console.error('Table tbody not found');
    return;
  }
  tbody.innerHTML = ''; // Clear previous rows

  fetch(`/HomePage/datafetcher/transactions/PO_view_getdata.php?action=loaddetails&company=${encodeURIComponent(companyId)}&siteid=${encodeURIComponent(siteid)}&ponumber=${encodeURIComponent(poNumber)}`)
    .then(response => {
      if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
      return response.json();
    })
    .then(data => {
      loadedPOs = data; // Save globally
      if (!data || data.length === 0) {
        const tr = document.createElement('tr');
        tr.innerHTML = '<td colspan="6" class="text-center">No items found.</td>';
        tbody.appendChild(tr);
        return;
      }

      data.forEach((item, index) => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
          <td>${index + 1}</td>
          <td>${item.CASE_BARCODE || ''}</td>
          <td>${item.IT_BARCODE || ''}</td>
          <td>${item.ITEM_ID || ''}</td>
          <td>${item.DESCRIPTION || ''}</td>
         <td>${item.PO_CS ? parseFloat(item.PO_CS).toLocaleString('en-PH', { minimumFractionDigits: 0}) : '0'}</td>
         <td>${item.PO_SW ? parseFloat(item.PO_SW).toLocaleString('en-PH', { minimumFractionDigits: 0}) : '0'}</td>
         <td>${item.PO_IT ? parseFloat(item.PO_IT).toLocaleString('en-PH', { minimumFractionDigits: 0}) : '0'}</td>
        <td>${item.ACTUAL_CS ? parseFloat(item.ACTUAL_CS).toLocaleString('en-PH', { minimumFractionDigits: 0}) : '0'}</td>
        <td>${item.ACTUAL_SW ? parseFloat(item.ACTUAL_SW).toLocaleString('en-PH', { minimumFractionDigits: 0}) : '0'}</td>
        <td>${item.ACTUAL_IT ? parseFloat(item.ACTUAL_IT).toLocaleString('en-PH', { minimumFractionDigits: 0}) : '0'}</td>          <td>${item.AMOUNT ? parseFloat(item.AMOUNT).toLocaleString('en-PH', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) : '0.00'}</td>
        `;
        tbody.appendChild(tr);
      });
    })
    .catch(err => {
      console.error('Error loading items:', err);
    });
};

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