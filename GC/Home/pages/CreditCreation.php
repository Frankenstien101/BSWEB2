<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Credit Creation</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>

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

    <h3 class="mt-0">Credit Creation</h3>

<div class="filter-container">
    <div class="card text-bg-light" style="font-size: 11px; text-align: left;">
    <div class="card-header">
      
    <div class="d-flex flex-wrap gap-2 mb 1">
  <button class="btn btn-primary btn-sm" id="newTransBtn">
    <i class="fas fa-plus"></i> New Transaction
  </button>

  <button type="button" style="height: 32px; font-size: 13px;" class="btn btn-primary mb-0 ml-1" data-toggle="modal" data-target="#loadmodal">
    <i class="fas fa-folder-open"></i> Load Transaction
  </button>
</div>

    </div>
    <div class="card-body">
            <div class="container-fluid p-0">
                <div class="row">
                    <!-- Row 1 -->
                    <div class="col-md-3 col-sm-6 col-12 mb-0">
                        <label for="transaction_id" class="mb-0">TRANSACTION ID</label>
                        <input type="text" id="transaction_id"  style = "max-width: 100%;" class="form-control form-control-sm" placeholder="Auto generated" readonly>
                    </div>
                 <div class="col-md-3 col-sm-6 col-12 mb-0">
                  <label for="creditor_id" class="mb-0">CREDITOR ID</label>
                  <div class="input-group input-group-sm">
                    <input type="text" id="creditor_id" class="form-control" style="width: 100px; height: 25px;" value="" readonly>
                    <button class="btn btn-primary ml-1" type="button" id="btnSelect" style ="height: 25px; font-size: 8px;">Select</button>
                  </div>
                </div>

                    <div class="col-md-5 col-sm-6 col-12 mb-0">
                        <label for="status" class="mb-0" >STATUS</label>
                        <input type="text" id="status" style = "width: 100px;" class="form-control form-control-sm" value="DRAFT" readonly>
                    </div>

                  
                      <div class="col-md-3 col-sm-6 col-12 mb-0">
                        <label for="charge_id" class="mb-0" >CHARGE ID</label>
                        <input type="text" id="charge_id" style = "width: 150px;" class="form-control form-control-sm" value="" > 
                    </div>

                  
                      <!-- Row 2 -->
                    <div class="col-md-3 col-sm-6 col-12 mb-0">
                        <label for="creditorname" class="mb-0">CREDITOR NAME</label>
                        <input type="text" id="creditorname"  style = "max-width: 300px;" class="form-control form-control-sm" readonly>
                    </div>
                    
                    <div class="col-md-6 col-sm-6 col-12 mb-0">
                  <label for="paymenttype" class="mb-0">PAYMENT TYPE</label>
                  <select id="paymenttype" class="form-control form-control-sm" style="max-width: 100px; font-size: 10px; height: 25px;">
                    <option value="Credit">CREDIT</option>
                    <option value="Cash">CASH</option>
                  </select>
                </div>                

                </div>
            </div>
        </div>
    </div>
</div>


<div class="card text-bg-light" data-bs-spy="scroll" style="max-width: 100%; height:55vh; margin-bottom: .5rem; Font-size: 10px;">
      
    <div class="card-header">
      
    <div class="col-md-3 col-sm-6 col-12 mb-0 d-flex align-items-center">
  <span class="me-2" style = "font-size: 12px;">Insert Item:</span>
  <input type="text" id="insertitem" 
         style="width: 150px; height: 25px ; font-size: 12px;" 
         class="form-control form-control-sm ml-1" 
         value="">

  <!-- Scan Button -->
  <button type="button" class="btn btn-primary btn-sm ms-2 ml-1" id="scanBtn" style="height: 30px; font-size: 13px;">
    <i class="fas fa-qrcode"></i> <!-- Font Awesome Scan Icon -->
  </button>
</div>

      </div>
      <div class="card-body" style="overflow-y: auto; max-width: 100%; height: 55vh;"  >
        <table id="itemsTable" class="table table-striped table-hover table-bordered table-sm " style="font-size: 10px;">
          
  <thead>
    <tr>
      <th>ITEM ID</th>
      <th>BARCODE</th>
<th>DESCRIPTION</th>
<th>QTY</th>
<th>UOM</th>
<th>PRICE</th>
<th>LESS</th>
<th>TOTAL</th>
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
<button class="btn btn-success mb-2" onclick="exportToExcel()">Process</button>  </div>


<script src="https://cdn.jsdelivr.net/npm/es6-promise/dist/es6-promise.auto.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/whatwg-fetch@3.6.2/dist/fetch.umd.min.js"></script>


<script>
 document.addEventListener("DOMContentLoaded", function () {
  const newTransBtn = document.getElementById('newTransBtn');
  if (!newTransBtn) {
    alert("New Transaction button not found!");
    return;
  }

  newTransBtn.addEventListener('click', function (event) {
    event.preventDefault();

    // Get PHP session variables safely
    const companyId = <?php echo json_encode($_SESSION['COMPANY_ID'] ?? ''); ?>;
    const siteId = <?php echo json_encode($_SESSION['SITE_ID'] ?? ''); ?>;

    if (!companyId || !siteId) {
      alert('Session expired or missing. Please log in again.');
      window.location.href = '/login.php';
      return;
    }

    const baseURL = window.location.origin;
    const getTransURL = `${baseURL}/GC/datafetcher/transaction/creditcreation_data.php?action=get_new_transaction&company=${companyId}&siteid=${siteId}`;

    console.log("Fetching from:", getTransURL);

    // Modern fetch version
    const safeFetch = async (url) => {
      try {
        const response = await fetch(url);
        if (!response.ok) throw new Error("HTTP Error " + response.status);
        return await response.json();
      } catch (e) {
        console.warn("Fetch failed, trying XHR fallback...", e);
        // Fallback using XMLHttpRequest for older browsers
        return new Promise((resolve, reject) => {
          const xhr = new XMLHttpRequest();
          xhr.open("GET", url);
          xhr.onload = () => {
            if (xhr.status === 200) {
              try {
                resolve(JSON.parse(xhr.responseText));
              } catch (err) {
                reject(err);
              }
            } else reject(new Error("XHR Error " + xhr.status));
          };
          xhr.onerror = () => reject(new Error("XHR network error"));
          xhr.send();
        });
      }
    };

    safeFetch(getTransURL)
      .then(data => {
        if (!data || typeof data.count === 'undefined') {
          alert('No count value returned from server.');
          console.warn("Response data:", data);
          return;
        }

        const dttimeid = new Date().toISOString().slice(0, 19).replace(/[-:T]/g, '');
        const transaction_id = `TRN-${companyId}-${siteId}-${dttimeid}-${data.count}`;

        document.getElementById('transaction_id').value = transaction_id;
        document.getElementById('status').value = 'DRAFT';
        document.getElementById('charge_id').value = dttimeid;
        document.getElementById('creditor_id').value = '';
        document.getElementById('creditorname').value = '';
        document.getElementById('paymenttype').value = 'Credit';

        const insertURL = `${baseURL}/HomePage/datafetcher/transactions/Van_Loading_getdata.php?action=insertnewtrans&companyid=${companyId}&siteid=${siteId}&transactionid=${transaction_id}`;
        console.log("Inserting new transaction:", insertURL);

        return safeFetch(insertURL);
      })
      .then(insertResult => {
        if (insertResult && insertResult.success) {
          alert("✅ New Transaction Created Successfully!");
        } else if (insertResult) {
          alert("❌ Failed to insert transaction: " + (insertResult.error || 'Unknown error'));
        }
      })
      .catch(err => {
        alert("⚠️ Error during transaction creation: " + err.message);
        console.error(err);
      });
  });
});
</script>

</body>
</html>