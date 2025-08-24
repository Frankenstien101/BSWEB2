<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" />
  <style>
    /* Small, tight cards */
    .card {
      margin: 5px;
      font-size: 11px;
    }
    /* Reduce padding inside cards */
    .card-header, .card-body {
      padding: 4px;
    }
    /* Smaller inputs/buttons */
    .form-control-sm {
      font-size: 10px;
      padding: 2px 4px;
    }
    .btn-sm {
      font-size: 10px;
      padding: 2px 6px;
    }
    /* Container takes full width with no padding or margin */
    .container-fluid {
      padding: 0;
      margin: 0;
    }
    /* Remove margin for rows to make them flush */
    .row-no-margin {
      margin: 0;
    }
  </style>
</head>
<body>
  <div class="container-fluid p-0 m-0">

    <!-- First row -->
    <div class="d-flex flex-row flex-wrap justify-content-start m-0 p-0 row-no-margin">
      <!-- DELIVERY PLAN -->
      <div class="card text-bg-light" style="width: 240px;">
        <div class="card-header d-flex align-items-center p-2">
          <span>DELIVERY PLAN</span>
          <!-- Right-aligned, no overlap -->
          <div class="d-flex align-items-center ml-auto m-0 p-0">
            <input type="checkbox" id="deliveryPlanAllSites" class="m-0" />
            <label for="deliveryPlanAllSites" class="m-0 ml-2" style="font-size:10px;">ALL SITES</label>
          </div>
        </div>
        <div class="card-body p-2">
          <div class="d-flex flex-wrap align-items-center">
            <label class="mb-1 mr-1">Date From:</label>
            <input type="date" id="delivery_datefrom" class="mb-1 form-control form-control-sm" />
            <label class="mb-1 ml-1 mr-1">To</label>
            <input type="date" id="delivery_dateto" class="mb-1 form-control form-control-sm" />
          </div>
        </div>
        <div class="d-flex justify-content-end mb-1 mr-2">
          <button class="btn btn-success btn-sm" onclick="applyFilters()">GENERATE</button>
        </div>
      </div>
      
      <!-- ORDER PLAN -->
      <div class="card text-bg-light" style="width: 240px;">
        <div class="card-header d-flex align-items-center p-2">
          <span>ORDER PLAN</span>
          <div class="d-flex align-items-center ml-auto m-0 p-0">
            <input type="checkbox" id="orderPlanAllSites" class="m-0" />
            <label for="orderPlanAllSites" class="m-0 ml-2" style="font-size:10px;">ALL SITES</label>
          </div>
        </div>
        <div class="card-body p-2">
          <div class="d-flex flex-wrap align-items-center">
            <label class="mb-1 mr-1">Date From:</label>
            <input type="date" id="order_datefrom" class="mb-1 form-control form-control-sm" />
            <label class="mb-1 ml-1 mr-1">To</label>
            <input type="date" id="order_dateto" class="mb-1 form-control form-control-sm" />
          </div>
        </div>
        <div class="d-flex justify-content-end mb-1 mr-2">
          <button class="btn btn-success btn-sm" onclick="applyFilters()">GENERATE</button>
        </div>
      </div>
    </div>
    
    <!-- Second row -->
    <div class="d-flex flex-row flex-wrap justify-content-start m-0 p-0 mt-3 row-no-margin">
      <!-- PAYMENTS -->
      <div class="card text-bg-light" style="width: 240px;">
        <div class="card-header d-flex align-items-center p-2">
          <span>PAYMENTS</span>
          <div class="d-flex align-items-center ml-auto m-0 p-0">
            <input type="checkbox" id="paymentsAllSites" class="m-0" />
            <label for="paymentsAllSites" class="m-0 ml-2" style="font-size:10px;">ALL SITES</label>
          </div>
        </div>
        <div class="card-body p-2">
          <div class="d-flex flex-wrap align-items-center">
            <label class="mb-1 mr-1">Date From:</label>
            <input type="date" id="payments_datefrom" class="mb-1 form-control form-control-sm" />
            <label class="mb-1 ml-1 mr-1">To</label>
            <input type="date" id="payments_dateto" class="mb-1 form-control form-control-sm" />
          </div>
        </div>
        <div class="d-flex justify-content-end mb-1 mr-2">
          <button class="btn btn-success btn-sm" onclick="applyFilters()">GENERATE</button>
        </div>
      </div>
      <!-- SALES / DELIVERY RESULT -->
      <div class="card text-bg-light" style="width: 240px;">
        <div class="card-header d-flex align-items-center p-2">
          <span>DELIVERY RESULT</span>
          <div class="d-flex align-items-center ml-auto m-0 p-0">
            <input type="checkbox" id="salesAllSites" class="m-0" />
            <label for="salesAllSites" class="m-0 ml-2" style="font-size:10px;">ALL SITES</label>
          </div>
        </div>
        <div class="card-body p-2">
          <div class="d-flex flex-wrap align-items-center">
            <label class="mb-1 mr-1">Date From:</label>
            <input type="date" id="sales_datefrom" class="mb-1 form-control form-control-sm" />
            <label class="mb-1 ml-1 mr-1">To</label>
            <input type="date" id="sales_dateto" class="mb-1 form-control form-control-sm" />
          </div>
        </div>
        <div class="d-flex justify-content-end mb-1 mr-2">
          <button class="btn btn-success btn-sm" onclick="applyFilters()">GENERATE</button>
        </div>
      </div>
    </div>
    
    <!-- Third row -->
    <div class="d-flex flex-row flex-wrap justify-content-start m-0 p-0 mt-3 row-no-margin">
      <!-- DELIVERY PERFORMANCE -->
      <div class="card text-bg-light" style="width: 240px;">
        <div class="card-header d-flex align-items-center p-2">
          <span>DELIVERY PERFORMANCE</span>
          <div class="d-flex align-items-center ml-auto m-0 p-0">
            <input type="checkbox" id="deliveryPerformanceAllSites" class="m-0" />
            <label for="deliveryPerformanceAllSites" class="m-0 ml-2" style="font-size:10px;">ALL SITES</label>
          </div>
        </div>
        <div class="card-body p-2">
          <div class="d-flex flex-wrap align-items-center">
            <label class="mb-1 mr-1">Date From:</label>
            <input type="date" id="purchase_datefrom" class="mb-1 form-control form-control-sm" />
            <label class="mb-1 ml-1 mr-1">To</label>
            <input type="date" id="purchase_dateto" class="mb-1 form-control form-control-sm" />
          </div>
        </div>
        <div class="d-flex justify-content-end mb-1 mr-2">
          <button class="btn btn-success btn-sm" onclick="applyFilters()">GENERATE</button>
        </div>
      </div>
      <!-- CROSSDOCK REPORT -->
      <div class="card text-bg-light" style="width: 240px;">
        <div class="card-header d-flex align-items-center p-2">
          <span>CROSSDOCK REPORT</span>
          <div class="d-flex align-items-center ml-auto m-0 p-0">
            <input type="checkbox" id="crossdockReportAllSites" class="m-0" />
            <label for="crossdockReportAllSites" class="m-0 ml-2" style="font-size:10px;">ALL SITES</label>
          </div>
        </div>
        <div class="card-body p-2">
          <div class="d-flex flex-wrap align-items-center">
            <label class="mb-1 mr-1">Date From:</label>
            <input type="date" id="supplier_datefrom" class="mb-1 form-control form-control-sm" />
            <label class="mb-1 ml-1 mr-1">To</label>
            <input type="date" id="supplier_dateto" class="mb-1 form-control form-control-sm" />
          </div>
        </div>
        <div class="d-flex justify-content-end mb-1 mr-2">
          <button class="btn btn-success btn-sm" onclick="applyFilters()">GENERATE</button>
        </div>
      </div>
    </div>

    <!-- Fourth row -->
    <div class="d-flex justify-content-start flex-wrap m-0 p-0 mt-3 row-no-margin">
      <!-- FREIGHT REPORT -->
      <div class="card text-bg-light" style="width: 240px;">
        <div class="card-header d-flex align-items-center p-2">
          <span>FREIGHT REPORT</span>
          <div class="d-flex align-items-center ml-auto m-0 p-0">
            <input type="checkbox" id="freightReportAllSites" class="m-0" />
            <label for="freightReportAllSites" class="m-0 ml-2" style="font-size:10px;">ALL SITES</label>
          </div>
        </div>
        <div class="card-body p-2">
          <div class="d-flex flex-wrap align-items-center">
            <label class="mb-1 mr-1">Date From:</label>
            <input type="date" id="customer_datefrom" class="mb-1 form-control form-control-sm" />
            <label class="mb-1 ml-1 mr-1">To</label>
            <input type="date" id="customer_dateto" class="mb-1 form-control form-control-sm" />
          </div>
        </div>
        <div class="d-flex justify-content-end mb-1 mr-2">
          <button class="btn btn-success btn-sm" onclick="applyFilters()">GENERATE</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS dependencies -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"></script>
  <script>
    function applyFilters() {
      alert("Filter applied!"); // your logic here
    }
  </script>
</body>
</html>
