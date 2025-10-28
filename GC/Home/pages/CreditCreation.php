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
  <span class="me-2" style = "">Insert Item:</span>
  <input type="text" id="insertitem" style="width: 150px; height: 25px" class="form-control form-control-sm ml-1" value="">
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




<script>
  // Safely pass PHP session variables to JavaScript

  document.getElementById('newTransBtn').addEventListener('click', function(event) {
  // Prevent the default behavior (page refresh)
  event.preventDefault();

  const companyId = <?php echo json_encode($_SESSION['COMPANY_ID'] ?? ''); ?>;
  const siteId = <?php echo json_encode($_SESSION['SITE_ID'] ?? ''); ?>;

  if (!companyId || !siteId) {
    console.error('Session variables COMPANY_ID or SITE_ID are not set.');
    alert('Session variables are missing. Please log in again.');
    window.location.href = '/login.php'; // Redirect to login page
    return;
  }

  fetch(`/GC/datafetcher/transaction/creditcreation_data.php?action=get_new_transaction&company=${companyId}&siteid=${siteId}`)
    .then(response => {
      if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
      }
      return response.json();
    })
    .then(data => {
      if (data.count !== undefined) {
        const dttimeid = new Date().toISOString().slice(0, 19).replace(/[-:T]/g, '');
        const transaction_id = 'TRN-' + companyId + '-' + siteId + '-' + dttimeid + '-' + data.count;

        document.getElementById('transaction_id').value = transaction_id;
        document.getElementById('status').value = 'DRAFT';
        document.getElementById('charge_id').value = dttimeid;
        document.getElementById('creditor_id').value = '';
        document.getElementById('creditorname').value = '';
        document.getElementById('paymenttype').value = 'Credit';

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
</script>

</body>
</html>