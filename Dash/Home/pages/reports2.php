<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" />

  <style>
    .card { margin:5px; font-size:11px; }
    .card-header, .card-body { padding:4px; }
    .form-control-sm { font-size:10px; padding:2px 4px; }
    .btn-sm { font-size:10px; padding:2px 6px; }
    .container-fluid { padding:0; margin:0; }
    .row-no-margin { margin:0; }
    
    .card-body-scroll {
        overflow-y: auto;
        max-height: 76vh; /* Adjustable for your design */
    }
    
    /* For two-column layout */
    .report-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 5px;
        width: %;
    }
    
    .report-card {
        width: 95%;
        min-width: 0; /* Prevents overflow */
    }

  </style>
</head>
<body>

  <!-- Progress Modal -->
  <div class="modal fade" id="progressModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-sm modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header p-2">
          <h6 class="modal-title">Generating Report...</h6>
        </div>
        <div class="modal-body">
          <div class="progress">
            <div id="progressBar" class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                 style="width: 0%">0%</div>
          </div>
          <p class="mt-2 mb-0 text-center" style="font-size:12px;" id="progressMessage">Please wait while we generate your report.</p>
        </div>
      </div>
    </div>
  </div>
  
  <div class="card mb-2 mt-1" style="max-width: 100%; width:100%;">
    
  <div class="row no-gutters">

    <div class="col-md-5 mt-1" style="width:30%">
        
    <div class="container-fluid p-0 m-0">
    <!-- === TWO COLUMN GRID === -->
    <div class="report-grid">
      <!-- DELIVERY PLAN -->
      <div class="card text-bg-light report-card">
        <div class="card-header d-flex align-items-center p-2">
          <span>DELIVERY PLAN</span>
          <div class="ml-auto d-flex align-items-center">
            <input type="checkbox" id="deliveryPlanAllSites" class="m-0" />
            <label for="deliveryPlanAllSites" class="m-0 ml-2" style="font-size:10px;">ALL SITES</label>
          </div>
        </div>
        <div class="card-body p-2">
          <div class="d-flex flex-wrap align-items-center">
            <label class="mb-1 mr-1">Date From:</label>
            <input type="date" id="delivery_datefrom" class="mb-1 form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>" />
            <label class="mb-1 ml-1 mr-1">To</label>
            <input type="date" id="delivery_dateto" class="mb-1 form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>" />
          </div>
        </div>
        <div class="d-flex justify-content-end mb-1 mr-2">
          <button class="btn btn-success btn-sm" onclick="deliveryplan()">GENERATE</button>
        </div>
      </div>

      <!-- ORDER PREPARATION -->
      <div class="card text-bg-light report-card">
        <div class="card-header d-flex align-items-center p-2">
          <span>ORDER PREPARATION</span>
          <div class="ml-auto d-flex align-items-center">
            <input type="checkbox" id="orderPlanAllSites" class="m-0" />
            <label for="orderPlanAllSites" class="m-0 ml-2" style="font-size:10px;">ALL SITES</label>
          </div>
        </div>
        <div class="card-body p-2">
          <div class="d-flex flex-wrap align-items-center">
            <label class="mb-1 mr-1">Date From:</label>
            <input type="date" id="order_datefrom" class="mb-1 form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>"/>
            <label class="mb-1 ml-1 mr-1">To</label>
            <input type="date" id="order_dateto" class="mb-1 form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>"/>
          </div>
        </div>
        <div class="d-flex justify-content-end mb-1 mr-2">
          <button class="btn btn-success btn-sm" onclick="orderpreparation()">GENERATE</button>
        </div>
      </div>

      <!-- SO REPORT -->
      <div class="card text-bg-light report-card">
        <div class="card-header d-flex align-items-center p-2">
          <span>SO REPORT</span>
          <div class="ml-auto d-flex align-items-center">
            <input type="checkbox" id="soreportallsites" class="m-0" />
            <label for="soreportallsites" class="m-0 ml-2" style="font-size:10px;">ALL SITES</label>
          </div>
        </div>
        <div class="card-body p-2">
          <div class="d-flex flex-wrap align-items-center">
            <label class="mb-1 mr-1">Date From:</label>
            <input type="date" id="soreportdatefrom" class="mb-1 form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>"/>
            <label class="mb-1 ml-1 mr-1">To</label>
            <input type="date" id="soreportdateto" class="mb-1 form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>"/>
          </div>
        </div>
        <div class="d-flex justify-content-end mb-1 mr-2">
          <button class="btn btn-success btn-sm" onclick="soreport()">GENERATE</button>
        </div>
      </div>

      <!-- DELIVERY RESULT -->
      <div class="card text-bg-light report-card">
        <div class="card-header d-flex align-items-center p-2">
          <span>DELIVERY RESULT</span>
          <div class="ml-auto d-flex align-items-center">
            <input type="checkbox" id="resultallsites" class="m-0" />
            <label for="resultallsites" class="m-0 ml-2" style="font-size:10px;">ALL SITES</label>
          </div>
        </div>
        <div class="card-body p-2">
          <div class="d-flex flex-wrap align-items-center">
            <label class="mb-1 mr-1">Date From:</label>
            <input type="date" id="resultdtfrom" class="mb-1 form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>"/>
            <label class="mb-1 ml-1 mr-1">To</label>
            <input type="date" id="resultdtto" class="mb-1 form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>"/>
          </div>
        </div>
        <div class="d-flex justify-content-end mb-1 mr-2">
          <button class="btn btn-success btn-sm" onclick="deliveryresult()">GENERATE</button>
        </div>
      </div>

      <!-- DELIVERY PERFORMANCE -->
      <div class="card text-bg-light report-card">
        <div class="card-header d-flex align-items-center p-2">
          <span>DELIVERY PERFORMANCE</span>
          <div class="ml-auto d-flex align-items-center">
            <input type="checkbox" id="deliveryperformanceallsites" class="m-0" />
            <label for="deliveryperformanceallsites" class="m-0 ml-2" style="font-size:10px;">ALL SITES</label>
          </div>
        </div>
        <div class="card-body p-2">
          <div class="d-flex flex-wrap align-items-center">
            <label class="mb-1 mr-1">Date From:</label>
            <input type="date" id="deliveryperformancedtfrom" class="mb-1 form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>"/>
            <label class="mb-1 ml-1 mr-1">To</label>
            <input type="date" id="deliveryperformancedtto" class="mb-1 form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>"/>
          </div>
        </div>
        <div class="d-flex justify-content-end mb-1 mr-2">
          <button class="btn btn-success btn-sm" onclick="deliveryperformance()">GENERATE</button>
        </div>
      </div>

      <!-- PERFORMANCE DETAILED -->
      <div class="card text-bg-light report-card">
        <div class="card-header d-flex align-items-center p-2">
          <span>PERFORMANCE DETAILED</span>
          <div class="ml-auto d-flex align-items-center">
            <input type="checkbox" id="performanceDetailedAllSites" class="m-0" />
            <label for="performanceDetailedAllSites" class="m-0 ml-2" style="font-size:10px;">ALL SITES</label>
          </div>
        </div>
        <div class="card-body p-2">
          <div class="d-flex flex-wrap align-items-center">
            <label class="mb-1 mr-1">Date From:</label>
            <input type="date" id="deliveryperformancedetailedfrom" class="mb-1 form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>"/>
            <label class="mb-1 ml-1 mr-1">To</label>
            <input type="date" id="deliveryperformancedetailedto" class="mb-1 form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>"/>
          </div>
        </div>
        <div class="d-flex justify-content-end mb-1 mr-2">
          <button class="btn btn-success btn-sm" onclick="deliveryperformancedetailed()">GENERATE</button>
        </div>
      </div>

      <!-- FREIGHT REPORT -->
      <div class="card text-bg-light report-card">
        <div class="card-header d-flex align-items-center p-2">
          <span>FREIGHT REPORT</span>
          <div class="ml-auto d-flex align-items-center">
            <input type="checkbox" id="freightAllSites" class="m-0" />
            <label for="freightAllSites" class="m-0 ml-2" style="font-size:10px;">ALL SITES</label>
          </div>
        </div>
        <div class="card-body p-2">
          <div class="d-flex flex-wrap align-items-center">
            <label class="mb-1 mr-1">Date From:</label>
            <input type="date" id="freightfrom" class="mb-1 form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>"/>
            <label class="mb-1 ml-1 mr-1">To</label>
            <input type="date" id="freightto" class="mb-1 form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>"/>
          </div>
        </div>
        <div class="d-flex justify-content-end mb-1 mr-2">
          <button class="btn btn-success btn-sm" onclick="freightReport()">GENERATE</button>
        </div>
      </div>

      <!-- CROSSDOCK REPORT -->
      <div class="card text-bg-light report-card">
        <div class="card-header d-flex align-items-center p-2">
          <span>CROSSDOCK REPORT</span>
          <div class="ml-auto d-flex align-items-center">
            <input type="checkbox" id="cdockallsites" class="m-0" />
            <label for="cdockallsites" class="m-0 ml-2" style="font-size:10px;">ALL SITES</label>
          </div>
        </div>
        <div class="card-body p-2">
          <div class="d-flex flex-wrap align-items-center">
            <label class="mb-1 mr-1">Date From:</label>
            <input type="date" id="cdockfrom" class="mb-1 form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>"/>
            <label class="mb-1 ml-1 mr-1">To</label>
            <input type="date" id="cdockto" class="mb-1 form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>"/>
          </div>
        </div>
        <div class="d-flex justify-content-end mb-1 mr-2">
          <button class="btn btn-success btn-sm" onclick="crossdock()">GENERATE</button>
        </div>
      </div>
    </div>
  </div>
    </div>

    <div class="col-md-7 ml-0" width="70%">
      <div class="card-body">
        <h5 class="card-title">GENERATED REPORTS</h5>

        <div class="alert alert-info" role="alert">
          Select a report from the left panel and click "GENERATE" to create and download the report.   
        </div>
        
        <div class="card mb-3" style="width:100%;">
          <div class="card-body card-body-scroll">
            <table id="itemsTable" class="table table-striped table-hover table-bordered table-sm" style="font-size: 9px;">
              <thead>
                <tr>
                  <th>REQUEST ID</th>
                  <th>REPORT</th>
                  <th>DATE REQUESTED</th>
                  <th>STATUS</th>
                  <th>ACTION</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

  <!-- Bootstrap JS and jQuery -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script>

function deliveryplan() {
    const datefrom = document.getElementById('delivery_datefrom').value;
    const dateto = document.getElementById('delivery_dateto').value;
    const allsites = document.getElementById('deliveryPlanAllSites').checked ? 1 : 0;
    const userid = "<?php echo $_SESSION['UserID'] ?? ''; ?>";

    // Your column-specific SQL query as a string
    const columnQuery = `
        SELECT 
            D.COMPANY_ID,
            D.SITE_ID,
            D.BATCH,
            D.INVOICE_NUMBER,
            D.TOTAL_AMOUNT,
            D.INVOICE_VOLUME,
            D.DISTANCE,
            D.DISTANCE_IN_DECIMAL,
            D.STATUS,
            D.DATE_TO_DELIVER,
            D.STORE_LAT,
            D.STORE_LONG,
            D.CUSTOMER_ID,
            D.CUSTOMER_NAME,
            D.AGENT_ID,
            T.VEHICLE_ID
        FROM [dbo].[Dash_Plan_Batch_Details] D
        LEFT JOIN Dash_Plan_Batch_Transaction T 
            ON T.BATCH_ID = D.BATCH
        WHERE D.DATE_TO_DELIVER BETWEEN '${datefrom}' AND '${dateto}'
        ORDER BY D.BATCH ASC
    `;

    // Numeric-only request ID
    const now = new Date();
    const pad = (num) => num.toString().padStart(2, '0');
    const requestId = `${now.getFullYear()}${pad(now.getMonth() + 1)}${pad(now.getDate())}${pad(now.getHours())}${pad(now.getMinutes())}${pad(now.getSeconds())}`;

   // console.log("Column Query:", columnQuery);
    console.log("Request ID:", requestId);

    // Send as parameter to PHP
    fetch(`/Dash/datafetcher/reports_getdata2.php?action=deliveryplan&requestid=${encodeURIComponent(requestId)}&columnQuery=${encodeURIComponent(columnQuery)}&allsites=${encodeURIComponent(allsites)}&UserID=${encodeURIComponent(userid)}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log("Request inserted successfully:", data);
                loaditems();
            } else {
                console.warn("Insert failed:", data.error || "Unknown error");
            }
        })
        .catch(err => console.error('Error:', err));
}

function deliveryplan() {
    const companyId = "<?php echo $_SESSION['Company_ID'] ?? ''; ?>";
    const datefrom = document.getElementById('delivery_datefrom').value;
    const dateto = document.getElementById('delivery_dateto').value;
    const allsites = document.getElementById('deliveryPlanAllSites').checked ? 1 : 0;
    const userid = "<?php echo $_SESSION['UserID'] ?? ''; ?>";

    // Your column-specific SQL query as a string
    const columnQuery = `
        SELECT 
            D.COMPANY_ID,
            D.SITE_ID,
            D.BATCH,
            D.INVOICE_NUMBER,
            D.TOTAL_AMOUNT,
            D.INVOICE_VOLUME,
            D.DISTANCE,
            D.DISTANCE_IN_DECIMAL,
            D.STATUS,
            D.DATE_TO_DELIVER,
            D.STORE_LAT,
            D.STORE_LONG,
            D.CUSTOMER_ID,
            D.CUSTOMER_NAME,
            D.AGENT_ID,
            T.VEHICLE_ID
        FROM [dbo].[Dash_Plan_Batch_Details] D
        LEFT JOIN Dash_Plan_Batch_Transaction T 
            ON T.BATCH_ID = D.BATCH
        WHERE D.COMPANY_ID = '${companyId}' AND D.DATE_TO_DELIVER BETWEEN '${datefrom}' AND '${dateto}'
        ORDER BY D.BATCH ASC
    `;

    // Numeric-only request ID
    const now = new Date();
    const pad = (num) => num.toString().padStart(2, '0');
    const requestId = `${now.getFullYear()}${pad(now.getMonth() + 1)}${pad(now.getDate())}${pad(now.getHours())}${pad(now.getMinutes())}${pad(now.getSeconds())}`;

   // console.log("Column Query:", columnQuery);
    console.log("Request ID:", requestId);

    // Send as parameter to PHP
    fetch(`/Dash/datafetcher/reports_getdata2.php?action=sendreport&title=Delivery Plan&filename=Delivery_Plan&sheet1name=sheet1&sheet2name=sheet2&sheet3name=sheet3&sheet4name=sheet4&sheet5name=sheet5&requestid=${encodeURIComponent(requestId)}&columnQuery=${encodeURIComponent(columnQuery)}&allsites=${encodeURIComponent(allsites)}&UserID=${encodeURIComponent(userid)}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log("Request inserted successfully:", data);
                loaditems();
            } else {
                console.warn("Insert failed:", data.error || "Unknown error");
            }
        })
        .catch(err => console.error('Error:', err));
}


// ORDER PREPARATION
function orderpreparation() {

    const companyId = "<?php echo $_SESSION['Company_ID'] ?? ''; ?>";
    const datefrom = document.getElementById('order_datefrom').value;
    const dateto = document.getElementById('order_dateto').value;
    const allsites = document.getElementById('orderPlanAllSites').checked ? 1 : 0;
    const userid = "<?php echo $_SESSION['UserID'] ?? ''; ?>";

    // Your column-specific SQL query as a string
    const columnQuery = `
        SELECT Dash_SO_Plan_Batch_Details.COMPANY_ID,
        Dash_SO_Plan_Batch_Details.SITE_ID,
        Dash_SO_Plan_Batch_Details.SO_PLAN_NUMBER,
        SO_NUMBER,
        VEHICLE_ID,
        SO_PICK_BATCH,
        CUSTOMER_ID,
        CUSTOMER_NAME,
        TOTAL_AMOUNT,
        STORE_LAT,
        STORE_LONG,
        ORDER_DATE,
        Dash_SO_Plan_Batch_Details.STATUS,
        SUB_BATCH,
        SUB_DA,
        VEHICLE_IDS
 FROM Dash_SO_Plan_Batch_Details
 LEFT JOIN Dash_SO_Plan_Transaction
 ON Dash_SO_Plan_Transaction.SO_PLAN_NUMBER = Dash_SO_Plan_Batch_Details.SO_PLAN_NUMBER
 WHERE Dash_SO_Plan_Batch_Details.COMPANY_ID = '${companyId}'
   AND ORDER_DATE BETWEEN '${datefrom}' AND '${dateto}'
   AND Dash_SO_Plan_Batch_Details.STATUS != 'NEW'
    `;

    // Numeric-only request ID
    const now = new Date();
    const pad = (num) => num.toString().padStart(2, '0');
    const requestId = `${now.getFullYear()}${pad(now.getMonth() + 1)}${pad(now.getDate())}${pad(now.getHours())}${pad(now.getMinutes())}${pad(now.getSeconds())}`;

   // console.log("Column Query:", columnQuery);
    console.log("Request ID:", requestId);

    // Send as parameter to PHP
    fetch(`/Dash/datafetcher/reports_getdata2.php?action=sendreport&title=Order Preparation&filename=Order_Preparation&sheet1name=Details&sheet2name=sheet2&sheet3name=sheet3&sheet4name=sheet4&sheet5name=sheet5&requestid=${encodeURIComponent(requestId)}&columnQuery=${encodeURIComponent(columnQuery)}&allsites=${encodeURIComponent(allsites)}&UserID=${encodeURIComponent(userid)}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log("Request inserted successfully:", data);
                loaditems();
            } else {
                console.warn("Insert failed:", data.error || "Unknown error");
            }
        })
        .catch(err => console.error('Error:', err));
}

// SO REPORT
function soreport() {

    const companyId = "<?php echo $_SESSION['Company_ID'] ?? ''; ?>";
    const datefrom = document.getElementById('soreportdatefrom').value;
    const dateto = document.getElementById('soreportdateto').value;
    const allsites = document.getElementById('soreportallsites').checked ? 1 : 0;
    const userid = "<?php echo $_SESSION['UserID'] ?? ''; ?>";

    // Your column-specific SQL query as a string
    const columnQuery = `
       SELECT
                    [COMPANY_ID]
                    ,[SITE_ID]
                    ,[UPLOAD_BY_USER_ID]
                    ,[DIST_NAME]
                    ,[BRANCH_NAME]
                    ,[SELLER_TYPE]
                    ,[SELLER_NAME]
                    ,[CUSTOMER_NAME]
                    ,[STORE_CODE]
                    ,[CHANNEL_NAME]
                    ,[SUB_CHANNEL_NAME]
                    ,[ORDER_DATE]
                    ,[ORDER_ID]
                    ,[PRD_SKU_CODE]
                    ,[PRD_SKU_NAME]
                    ,[BARCODE]
                    ,[CS_QTY]
                    ,[QTY_PIECE]
                    ,[PRICE_PIECE]
                    ,[SCHEME_CODE]
                    ,[SCHEME_DESC]
                    ,[ORDER_VALUE_WITHOUTSCHEME]
                    ,[SCHEME_VALUE]
                    ,[ORDER_VALUE]
                    ,[ORDER_SOURCE]
                    ,[IS_PLAN]
                FROM [dbo].[PRFR_SO_UPLOAD] WHERE COMPANY_ID = '${companyId}' AND ORDER_DATE BETWEEN '${datefrom}' AND '${dateto}'
    `;

    // Numeric-only request ID
    const now = new Date();
    const pad = (num) => num.toString().padStart(2, '0');
    const requestId = `${now.getFullYear()}${pad(now.getMonth() + 1)}${pad(now.getDate())}${pad(now.getHours())}${pad(now.getMinutes())}${pad(now.getSeconds())}`;

   // console.log("Column Query:", columnQuery);
    console.log("Request ID:", requestId);

    // Send as parameter to PHP
    fetch(`/Dash/datafetcher/reports_getdata2.php?action=sendreport&title=Sales Order&filename=SalesOrder&sheet1name=Details&sheet2name=sheet2&sheet3name=sheet3&sheet4name=sheet4&sheet5name=sheet5&requestid=${encodeURIComponent(requestId)}&columnQuery=${encodeURIComponent(columnQuery)}&allsites=${encodeURIComponent(allsites)}&UserID=${encodeURIComponent(userid)}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log("Request inserted successfully:", data);
                loaditems();
            } else {
                console.warn("Insert failed:", data.error || "Unknown error");
            }
        })
        .catch(err => console.error('Error:', err));
}

// delivery result


function deliveryresult() {
    const companyId = "<?php echo $_SESSION['Company_ID'] ?? ''; ?>";
    const datefrom = document.getElementById('resultdtfrom').value;
    const dateto = document.getElementById('resultdtto').value;
    const allsites = document.getElementById('resultallsites').checked ? 1 : 0;
    const userid = "<?php echo $_SESSION['UserID'] ?? ''; ?>";

    // Your queries here (columnQuery ... columnQuery5)
    const columnQuery = `SELECT [COMPANY_ID]
                    ,[SITE_ID]
                    ,[UPLOAD_BY_USER_ID]
                    ,[DIST_NAME]
                    ,[BRANCH_NAME]
                    ,[SELLER_TYPE]
                    ,[SELLER_NAME]
                    ,[CUSTOMER_NAME]
                    ,[STORE_CODE]
                    ,[CHANNEL_NAME]
                    ,[SUB_CHANNEL_NAME]
                    ,[ORDER_DATE]
                    ,[ORDER_ID]
                    ,[PRD_SKU_CODE]
                    ,[PRD_SKU_NAME]
                    ,[BARCODE]
                    ,[CS_QTY]
                    ,[QTY_PIECE]
                    ,[PRICE_PIECE]
                    ,[SCHEME_CODE]
                    ,[SCHEME_DESC]
                    ,[ORDER_VALUE_WITHOUTSCHEME]
                    ,[SCHEME_VALUE]
                    ,[ORDER_VALUE]
                    ,[ORDER_SOURCE]
                    ,[IS_PLAN]
                FROM [dbo].[PRFR_SO_UPLOAD] WHERE COMPANY_ID = '${companyId}' AND ORDER_DATE BETWEEN '${datefrom}' AND '${dateto}'`;  // keep your query definitions
 
 
    const columnQuery2 = `  SELECT    PRFR_Invoice_Detailed.[DISTRIBUTOR_CODE],
                    PRFR_Invoice_Detailed.[BRANCH_CODE],
                    PRFR_Invoice_Detailed.[BRANCH],
                    Dash_Plan_Batch_Details.ORDER_DATE,
                    PRFR_Invoice_Detailed.[DATE] AS INVOICE_DATE,
                    Dash_Plan_Batch_Details.DATE_TO_DELIVER AS DATE_DELIVERED,
                  
                    PRFR_Invoice_Detailed.[SALES_REP],
                    PRFR_Invoice_Detailed.[SELLER_NAME],
                        Dash_Plan_Batch_Transaction.AGENT AS LEG_1,
                       CASE WHEN Dash_Plan_Batch_Details.SUB_DA IS NULL OR Dash_Plan_Batch_Details.SUB_DA = '' 
         THEN Dash_Plan_Batch_Details.AGENT_ID 
         ELSE Dash_Plan_Batch_Details.SUB_DA 
              END AS LEG_2,
                   isnull(Dash_Plan_Batch_Details.AGENT_DELIVERED,Dash_Agent_Performance_Detailed.BATCH_ID) as AGENT_DELIVERED,
                    Dash_Plan_Batch_Details.SUB_BATCH,
                    Dash_Plan_Batch_Details.SUB_DA,
                    Dash_Plan_Batch_Details.STATUS,                    
                    CASE 
                        WHEN SUM(ISNULL(Dash_Returns.[RETURN_AMOUNT], 0)) = 0 THEN 'NO' 
                        ELSE 'YES' 
                    END AS HAS_RETURN,
                
                    PRFR_Invoice_Detailed.CUSTOMER_ID,
                    PRFR_Invoice_Detailed.CUSTOMER_NAME,
                   
                    -- Added from Customer Master
                    Dash_Customer_Master.ADDRESS,
                    Dash_Customer_Master.CITY,
                    Dash_Customer_Master.PROVINCE,
                                
                	 PRFR_Invoice_Detailed.[DOCUMENT_NUMBER],
                	 
                    -- Added SKU count
                    COUNT(DISTINCT PRFR_Invoice_Detailed.IT_BARCODE) AS SKU_COUNT,
                
                    SUM(PRFR_Invoice_Detailed.[SALES_AMOUNT]) AS TOTAL,
                    PRFR_Invoice_Detailed.PG_LOCAL_SUBSEGMENT,
                
                    MIN(Dash_Agent_Performance_Detailed.STORE_ENTRY) AS STORE_ENTRY,
                    MAX(Dash_Agent_Performance_Detailed.STORE_EXIT) AS STORE_EXIT,
                    MAX(Dash_Agent_Performance_Detailed.STORE_TIME_SPENT) AS STORE_TIME_SPENT
                
                FROM [dbo].[PRFR_Invoice_Detailed]
                
                LEFT JOIN Dash_Plan_Batch_Details 
                    ON Dash_Plan_Batch_Details.INVOICE_NUMBER = PRFR_Invoice_Detailed.DOCUMENT_NUMBER 
                    AND PRFR_Invoice_Detailed.DISTRIBUTOR_CODE = Dash_Plan_Batch_Details.COMPANY_ID                            
                 left join Dash_Plan_Batch_Transaction on Dash_Plan_Batch_Details.BATCH = Dash_Plan_Batch_Transaction.BATCH_ID
                -- JOIN customer master (new)

                LEFT JOIN Dash_Returns 
                    ON Dash_Returns.INVOICE_NUMBER = PRFR_Invoice_Detailed.DOCUMENT_NUMBER 
                    AND PRFR_Invoice_Detailed.DISTRIBUTOR_CODE = Dash_Returns.COMPANY_ID 
                    AND Dash_Returns.IT_BARCODE = PRFR_Invoice_Detailed.IT_BARCODE
                    
                LEFT JOIN Dash_Agent_Performance_Detailed
                    ON Dash_Agent_Performance_Detailed.DELIVERY_DATE = Dash_Plan_Batch_Details.DATE_TO_DELIVER
                    AND Dash_Agent_Performance_Detailed.STORE_CODE = PRFR_Invoice_Detailed.CUSTOMER_ID
                    AND Dash_Agent_Performance_Detailed.COMPANY_ID = PRFR_Invoice_Detailed.DISTRIBUTOR_CODE  
                     AND Dash_Agent_Performance_Detailed.BATCH_ID =
        CASE 
            WHEN Dash_Plan_Batch_Details.AGENT_DELIVERED IS NULL THEN Dash_Plan_Batch_Details.AGENT_DELIVERED
            ELSE Dash_Plan_Batch_Details.AGENT_ID
        END
               
                LEFT JOIN Dash_Customer_Master
                    ON Dash_Customer_Master.COMPANY_ID = PRFR_Invoice_Detailed.DISTRIBUTOR_CODE
                    AND Dash_Customer_Master.CODE = PRFR_Invoice_Detailed.CUSTOMER_ID
                
                    WHERE Dash_Plan_Batch_Details.COMPANY_ID = '${companyId}'
                                        AND Dash_Plan_Batch_Details.DATE_TO_DELIVER BETWEEN '${datefrom}' AND '${dateto}'
                GROUP BY 
                    PRFR_Invoice_Detailed.[DISTRIBUTOR_CODE],
                    PRFR_Invoice_Detailed.[BRANCH_CODE],
                    PRFR_Invoice_Detailed.[BRANCH],
                    Dash_Plan_Batch_Details.ORDER_DATE,
                    PRFR_Invoice_Detailed.[DATE],
                    Dash_Plan_Batch_Details.DATE_TO_DELIVER,
                    PRFR_Invoice_Detailed.[SALES_REP],
                    PRFR_Invoice_Detailed.[SELLER_NAME],
                    Dash_Plan_Batch_Details.AGENT_ID,
                    Dash_Plan_Batch_Details.SUB_DA,
                    Dash_Plan_Batch_Details.AGENT_DELIVERED,
                    Dash_Plan_Batch_Details.BATCH,
                    Dash_Plan_Batch_Details.SUB_BATCH,
                    Dash_Plan_Batch_Details.SUB_DA,
                    Dash_Plan_Batch_Details.STATUS,
                    PRFR_Invoice_Detailed.CUSTOMER_ID,
                    PRFR_Invoice_Detailed.CUSTOMER_NAME,
                    PRFR_Invoice_Detailed.[DOCUMENT_NUMBER],
                    PRFR_Invoice_Detailed.PG_LOCAL_SUBSEGMENT,
                    Dash_Customer_Master.ADDRESS,
                    Dash_Customer_Master.CITY,
                    Dash_Customer_Master.PROVINCE,
                     Dash_Plan_Batch_Transaction.AGENT,Dash_Plan_Batch_Details.AGENT_DELIVERED,Dash_Agent_Performance_Detailed.BATCH_ID
    `;
    const columnQuery3 = ` SELECT [DISTRIBUTOR_CODE]
                         ,[BRANCH_CODE]
                         ,[BRANCH]
                    	  ,Dash_Plan_Batch_Details.ORDER_DATE
                         ,[DATE] AS INVOICE_DATE
                    	  ,Dash_Plan_Batch_Details.DATE_TO_DELIVER AS DATE_DELIVERED
                         ,[SALES_REP]
                         ,[SELLER_NAME]
                    	  ,Dash_Plan_Batch_Transaction.AGENT AS LEG_1
                          , CASE WHEN Dash_Plan_Batch_Details.SUB_DA IS NULL OR Dash_Plan_Batch_Details.SUB_DA = '' 
         THEN Dash_Plan_Batch_Details.AGENT_ID 
         ELSE Dash_Plan_Batch_Details.SUB_DA 
              END AS LEG_2,AGENT_DELIVERED
                          ,DATETIME_PROCESSED 
                    	  ,BATCH
                    	  ,Dash_Plan_Batch_Details.STATUS
						  , CASE WHEN ISNULL([RETURN_AMOUNT], 0) = 0 THEN 'NO' ELSE 'YES' END AS HAS_RETURN
                         ,PRFR_Invoice_Detailed.CUSTOMER_ID
                         ,PRFR_Invoice_Detailed.CUSTOMER_NAME
                         ,[NAME] AS ITEM_ID
                         ,[SCHEME_CODE]
                         ,[SCHEME_SLAB_DESCRIPTION]
                         ,[SCHEME_GROUP_NAME]
                         ,PRFR_Invoice_Detailed.IT_BARCODE
                         ,[SW_BARCODE]
                         ,[DESCRIPTION]
                         ,[BRAND]
                         ,[ITEM_CATEGORY]
                         ,[BRANDFORM]
                         ,[TRADE_CHANNEL]
                         ,[DOCUMENT_NUMBER]
                         ,[CS]
                         ,[AMOUNT]
                         ,[DISCOUNT_VALUE]
                         ,[SCHEME_VALUE]
                         ,[SALES_EX_VAT]
                         ,[VAT_AMOUNT]
                         ,[SALES_AMOUNT],
                    	  ISNULL([QTY_RETURN], 0) AS QTY_RETURN,
                          ISNULL([RETURN_AMOUNT], 0) AS RETURN_AMOUNT
                        ,[MONTHLY_TRANSACTION]
                         ,[PG_LOCAL_SUBSEGMENT]
                         ,[SALES_SUPERVISOR]
                         ,[ITEM_QTY]
                         ,[GIV]
                         ,[NIV]
                         ,[ITEM_QTY_CS]
                         ,[ITEM_QTY_SW]
                         ,[ITEM_QTY_IT]
                    	  
                     FROM [dbo].[PRFR_Invoice_Detailed]
                     LEFT JOIN Dash_Plan_Batch_Details ON Dash_Plan_Batch_Details.INVOICE_NUMBER = PRFR_Invoice_Detailed.DOCUMENT_NUMBER AND PRFR_Invoice_Detailed.DISTRIBUTOR_CODE = Dash_Plan_Batch_Details.COMPANY_ID
                     JOIN [dbo].[Dash_Plan_Batch_Transaction] ON Dash_Plan_Batch_Transaction.BATCH_ID = Dash_Plan_Batch_Details.BATCH                    
                     LEFT JOIN Dash_Returns ON Dash_Returns.INVOICE_NUMBER = PRFR_Invoice_Detailed.DOCUMENT_NUMBER AND PRFR_Invoice_Detailed.DISTRIBUTOR_CODE = Dash_Returns.COMPANY_ID AND Dash_Returns.IT_BARCODE = PRFR_Invoice_Detailed.IT_BARCODE
                     WHERE  Dash_Plan_Batch_Details.COMPANY_ID = '${companyId}' AND Dash_Plan_Batch_Details.DATE_TO_DELIVER BETWEEN '${datefrom}' AND '${dateto}' AND Dash_Plan_Batch_Details.STATUS NOT IN ('READY', 'DRAFT') 
    `;
    const columnQuery4 = ` WITH CTE AS ( SELECT
            COUNT(INVOICE_NUMBER) AS TOTAL_INVOICE,
            SUM(TOTAL_AMOUNT) AS SUM_TOTAL_AMOUNT,
            [DATE_TO_DELIVER],
            [AGENT_DELIVERED]
        FROM [dbo].[Dash_Plan_Batch_Details]
        GROUP BY [DATE_TO_DELIVER], [AGENT_DELIVERED]
    )
    SELECT 
    s.COMPANY_ID,
    s.SITE_ID,
    a.USERNAME AS LEG_1,
    a.NAME_OF_USER AS LEG_2,
     a.SUB_DA AS AGENT_DELIVERED,
    s.DELIVERY_DATE,
    s.WH_ENTRY,
    s.WH_DEPARTURE,
    s.TIME_ENTRY,
    s.TIME_EXIT,
    s.STATUS,
    s.LOGIN_ID,
    s.TIME_SPENT,
    CASE 
        WHEN a.AGENT_TYPE = 'MAIN' THEN 'LEG1'
        WHEN a.AGENT_TYPE = 'SUB'  THEN 'LEG2'
        ELSE 'INB'
    END AS AGENT_TYPE,
    ISNULL(MAX(CTE.TOTAL_INVOICE), 0) AS NUM_OF_DOORS,
    ISNULL(SUM(CTE.SUM_TOTAL_AMOUNT), 0) AS AMOUNT
FROM Dash_Agent_Performance_Summary s
LEFT JOIN Dash_Agents a 
    ON s.COMPANY_ID = a.COMPANY_ID 
   AND s.SITE_ID = a.SITE_ID 
   AND s.LOGIN_ID = a.SUB_DA

    LEFT JOIN CTE ON CTE.DATE_TO_DELIVER = s.DELIVERY_DATE AND CTE.AGENT_DELIVERED = a.SUB_DA

  
    WHERE s.COMPANY_ID = '${companyId}'
    AND s.DELIVERY_DATE BETWEEN  '${datefrom}' AND '${dateto}'
  

GROUP BY 

    s.COMPANY_ID,
    s.SITE_ID,
    a.USERNAME,
    a.NAME_OF_USER,
    a.SUB_DA,
    s.DELIVERY_DATE,
    s.TIME_ENTRY,
    s.TIME_EXIT,
       s.WH_ENTRY,
    s.WH_DEPARTURE,
    s.STATUS,
    s.LOGIN_ID,
    s.TIME_SPENT,
    a.AGENT_TYPE ORDER BY  s.DELIVERY_DATE DESC`;
    const columnQuery5 = `                           WITH CTAE AS (SELECT 
      [SELLER_NAME]
      ,[DOCUMENT_NUMBER]
    FROM [dbo].[PRFR_Invoice_Detailed] GROUP BY SELLER_NAME , DOCUMENT_NUMBER) 

    SELECT 
    COMPANY_ID, 
    SITE_ID,     
    SITE_NAME, 
    ORDER_DATE,
    DATE_TO_DELIVER AS DATE_DELIVERED, 
    SELLER_NAME,
    AGENT AS LEG_1, 
    LEG2,
    AGENT_DELIVERED,   
    STORE_ENTRY, 
    STORE_EXIT, 
    STORE_TIME_SPENT, 
    PERFORMANCE_STATUS,
    CUSTOMER_ID, 
    CUSTOMER_NAME, 
    PHONE, 
    ADDRESS, 
    CITY,   
    PROVINCE,
    IMAGE1, 
    IMG1 AS POD1,
    IMG2 AS POD2,
    LATITUDE, 
    LONGITUDE, 
    STATUS,
    SUB_BATCH,
    IS_RECEIVED,
    VEHICLE_IDS,
    IS_DROP_STATUS

FROM ( 
    SELECT 
        b.COMPANY_ID, 
        a.SITE_ID,                              
        Dash_Sites.SITE_NAME, 
        a.ORDER_DATE,
        b.DATE_TO_DELIVER, 
        CTAE.SELLER_NAME,
        a.AGENT,
       (case when b.SUB_DA = '' then a.AGENT else  b.SUB_DA end)  as  LEG2,
        ISNULL(d.AGENT_DELIVERED,d.BATCH_ID) AS  AGENT_DELIVERED,
        d.STORE_ENTRY, 
        d.STORE_EXIT, 
        d.STORE_TIME_SPENT, 
        d.STATUS AS PERFORMANCE_STATUS,
        b.CUSTOMER_ID, 
        b.CUSTOMER_NAME, 
        c.PHONE, 
        c.ADDRESS,
        c.CITY,
        c.PROVINCE,
        c.IMAGE1,
        pod.IMG1,
        pod.IMG2 ,
        c.LATITUDE, 
        c.LONGITUDE, 
        b.STATUS, 
        b.SUB_BATCH,
        b.IS_RECEIVED,
        b.VEHICLE_IDS,
        b.IS_DROP_STATUS,
        ROW_NUMBER() OVER (
            PARTITION BY b.CUSTOMER_ID, b.COMPANY_ID 
            ORDER BY d.STORE_EXIT DESC
        ) AS rn 
    FROM 
        Dash_Plan_Batch_Transaction a 
    JOIN 
        Dash_Plan_Batch_Details b 
        ON a.BATCH_ID = b.BATCH AND a.COMPANY_ID = b.COMPANY_ID
    LEFT JOIN 
        Dash_Customer_Master c 
        ON c.CODE = b.CUSTOMER_ID AND c.COMPANY_ID = b.COMPANY_ID  
        LEFT JOIN CTAE ON CTAE.DOCUMENT_NUMBER = b.INVOICE_NUMBER 
    LEFT JOIN 
        Dash_Agent_Performance_Detailed d 
        ON b.CUSTOMER_ID = d.STORE_CODE 
        AND b.DATE_TO_DELIVER = d.DELIVERY_DATE 
       AND b.COMPANY_ID = d.COMPANY_ID  AND d.BATCH_ID =
       CASE 
           WHEN b.AGENT_DELIVERED IS NOT NULL THEN b.AGENT_DELIVERED
           ELSE b.AGENT_ID
       END left join
        Dash_Sites 
        ON Dash_Sites.SITE_ID = a.SITE_ID   
   LEFT JOIN Dash_PaymentPOD pod ON CTAE.DOCUMENT_NUMBER = pod.INV_ID
    WHERE 
        b.DATE_TO_DELIVER BETWEEN '${datefrom}' AND '${dateto}'
        AND a.STATUS = 'PROCESSED' 
        AND b.COMPANY_ID = '${companyId}' 
) AS subquery 
where  rn=1`;

    const now = new Date();
    const pad = (num) => num.toString().padStart(2, '0');
    const requestId = `${now.getFullYear()}${pad(now.getMonth() + 1)}${pad(now.getDate())}${pad(now.getHours())}${pad(now.getMinutes())}${pad(now.getSeconds())}`;

    // POST body
    const postData = {
        action: 'sendreportpost',
        title: 'Delivery Result',
        filename: 'DeliveryResult',
        sheet1name: 'SO Report',
        sheet2name: 'DeliveryResultSummary',
        sheet3name: 'DeliveryResultDetailed',
        sheet4name: 'DeliveryPerformanceSummary',
        sheet5name: 'DeliveryPerformanceDetailed',
        requestid: requestId,
        columnQuery,
        columnQuery2,
        columnQuery3,
        columnQuery4,
        columnQuery5,
        allsites,
        UserID: userid
    };

    fetch('/Dash/datafetcher/reports_getdata2.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(postData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log("Request inserted successfully:", data);
            loaditems();
        } else {
            console.warn("Insert failed:", data.error || "Unknown error");
        }
    })
    .catch(err => console.error('Error:', err));
}




function deliveryresult1() {

    const companyId = "<?php echo $_SESSION['Company_ID'] ?? ''; ?>";
    const datefrom = document.getElementById('resultdtfrom').value;
    const dateto = document.getElementById('resultdtto').value;
    const allsites = document.getElementById('resultallsites').checked ? 1 : 0;
    const userid = "<?php echo $_SESSION['UserID'] ?? ''; ?>";

    // Your column-specific SQL query as a string
    const columnQuery = `
       SELECT
                    [COMPANY_ID]
                    ,[SITE_ID]
                    ,[UPLOAD_BY_USER_ID]
                    ,[DIST_NAME]
                    ,[BRANCH_NAME]
                    ,[SELLER_TYPE]
                    ,[SELLER_NAME]
                    ,[CUSTOMER_NAME]
                    ,[STORE_CODE]
                    ,[CHANNEL_NAME]
                    ,[SUB_CHANNEL_NAME]
                    ,[ORDER_DATE]
                    ,[ORDER_ID]
                    ,[PRD_SKU_CODE]
                    ,[PRD_SKU_NAME]
                    ,[BARCODE]
                    ,[CS_QTY]
                    ,[QTY_PIECE]
                    ,[PRICE_PIECE]
                    ,[SCHEME_CODE]
                    ,[SCHEME_DESC]
                    ,[ORDER_VALUE_WITHOUTSCHEME]
                    ,[SCHEME_VALUE]
                    ,[ORDER_VALUE]
                    ,[ORDER_SOURCE]
                    ,[IS_PLAN]
                FROM [dbo].[PRFR_SO_UPLOAD] WHERE COMPANY_ID = '${companyId}' AND ORDER_DATE BETWEEN '${datefrom}' AND '${dateto}'
    `;


    const columnQuery2 = `
      SELECT    PRFR_Invoice_Detailed.[DISTRIBUTOR_CODE],
                    PRFR_Invoice_Detailed.[BRANCH_CODE],
                    PRFR_Invoice_Detailed.[BRANCH],
                    Dash_Plan_Batch_Details.ORDER_DATE,
                    PRFR_Invoice_Detailed.[DATE] AS INVOICE_DATE,
                    Dash_Plan_Batch_Details.DATE_TO_DELIVER AS DATE_DELIVERED,
                  
                    PRFR_Invoice_Detailed.[SALES_REP],
                    PRFR_Invoice_Detailed.[SELLER_NAME],
                        Dash_Plan_Batch_Transaction.AGENT AS LEG_1,
                       CASE WHEN Dash_Plan_Batch_Details.SUB_DA IS NULL OR Dash_Plan_Batch_Details.SUB_DA = '' 
         THEN Dash_Plan_Batch_Details.AGENT_ID 
         ELSE Dash_Plan_Batch_Details.SUB_DA 
              END AS LEG_2,
                   isnull(Dash_Plan_Batch_Details.AGENT_DELIVERED,Dash_Agent_Performance_Detailed.BATCH_ID) as AGENT_DELIVERED,
                    Dash_Plan_Batch_Details.SUB_BATCH,
                    Dash_Plan_Batch_Details.SUB_DA,
                    Dash_Plan_Batch_Details.STATUS,                    
                    CASE 
                        WHEN SUM(ISNULL(Dash_Returns.[RETURN_AMOUNT], 0)) = 0 THEN 'NO' 
                        ELSE 'YES' 
                    END AS HAS_RETURN,
                
                    PRFR_Invoice_Detailed.CUSTOMER_ID,
                    PRFR_Invoice_Detailed.CUSTOMER_NAME,
                   
                    -- Added from Customer Master
                    Dash_Customer_Master.ADDRESS,
                    Dash_Customer_Master.CITY,
                    Dash_Customer_Master.PROVINCE,
                                
                	 PRFR_Invoice_Detailed.[DOCUMENT_NUMBER],
                	 
                    -- Added SKU count
                    COUNT(DISTINCT PRFR_Invoice_Detailed.IT_BARCODE) AS SKU_COUNT,
                
                    SUM(PRFR_Invoice_Detailed.[SALES_AMOUNT]) AS TOTAL,
                    PRFR_Invoice_Detailed.PG_LOCAL_SUBSEGMENT,
                
                    MIN(Dash_Agent_Performance_Detailed.STORE_ENTRY) AS STORE_ENTRY,
                    MAX(Dash_Agent_Performance_Detailed.STORE_EXIT) AS STORE_EXIT,
                    MAX(Dash_Agent_Performance_Detailed.STORE_TIME_SPENT) AS STORE_TIME_SPENT
                
                FROM [dbo].[PRFR_Invoice_Detailed]
                
                LEFT JOIN Dash_Plan_Batch_Details 
                    ON Dash_Plan_Batch_Details.INVOICE_NUMBER = PRFR_Invoice_Detailed.DOCUMENT_NUMBER 
                    AND PRFR_Invoice_Detailed.DISTRIBUTOR_CODE = Dash_Plan_Batch_Details.COMPANY_ID                            
                 left join Dash_Plan_Batch_Transaction on Dash_Plan_Batch_Details.BATCH = Dash_Plan_Batch_Transaction.BATCH_ID
                -- JOIN customer master (new)

                LEFT JOIN Dash_Returns 
                    ON Dash_Returns.INVOICE_NUMBER = PRFR_Invoice_Detailed.DOCUMENT_NUMBER 
                    AND PRFR_Invoice_Detailed.DISTRIBUTOR_CODE = Dash_Returns.COMPANY_ID 
                    AND Dash_Returns.IT_BARCODE = PRFR_Invoice_Detailed.IT_BARCODE
                    
                LEFT JOIN Dash_Agent_Performance_Detailed
                    ON Dash_Agent_Performance_Detailed.DELIVERY_DATE = Dash_Plan_Batch_Details.DATE_TO_DELIVER
                    AND Dash_Agent_Performance_Detailed.STORE_CODE = PRFR_Invoice_Detailed.CUSTOMER_ID
                    AND Dash_Agent_Performance_Detailed.COMPANY_ID = PRFR_Invoice_Detailed.DISTRIBUTOR_CODE  
                     AND Dash_Agent_Performance_Detailed.BATCH_ID =
        CASE 
            WHEN Dash_Plan_Batch_Details.AGENT_DELIVERED IS NULL THEN Dash_Plan_Batch_Details.AGENT_DELIVERED
            ELSE Dash_Plan_Batch_Details.AGENT_ID
        END
               
                LEFT JOIN Dash_Customer_Master
                    ON Dash_Customer_Master.COMPANY_ID = PRFR_Invoice_Detailed.DISTRIBUTOR_CODE
                    AND Dash_Customer_Master.CODE = PRFR_Invoice_Detailed.CUSTOMER_ID
                
                    WHERE Dash_Plan_Batch_Details.COMPANY_ID = '${companyId}'
                                        AND Dash_Plan_Batch_Details.DATE_TO_DELIVER BETWEEN '${datefrom}' AND '${dateto}'
                GROUP BY 
                    PRFR_Invoice_Detailed.[DISTRIBUTOR_CODE],
                    PRFR_Invoice_Detailed.[BRANCH_CODE],
                    PRFR_Invoice_Detailed.[BRANCH],
                    Dash_Plan_Batch_Details.ORDER_DATE,
                    PRFR_Invoice_Detailed.[DATE],
                    Dash_Plan_Batch_Details.DATE_TO_DELIVER,
                    PRFR_Invoice_Detailed.[SALES_REP],
                    PRFR_Invoice_Detailed.[SELLER_NAME],
                    Dash_Plan_Batch_Details.AGENT_ID,
                    Dash_Plan_Batch_Details.SUB_DA,
                    Dash_Plan_Batch_Details.AGENT_DELIVERED,
                    Dash_Plan_Batch_Details.BATCH,
                    Dash_Plan_Batch_Details.SUB_BATCH,
                    Dash_Plan_Batch_Details.SUB_DA,
                    Dash_Plan_Batch_Details.STATUS,
                    PRFR_Invoice_Detailed.CUSTOMER_ID,
                    PRFR_Invoice_Detailed.CUSTOMER_NAME,
                    PRFR_Invoice_Detailed.[DOCUMENT_NUMBER],
                    PRFR_Invoice_Detailed.PG_LOCAL_SUBSEGMENT,
                    Dash_Customer_Master.ADDRESS,
                    Dash_Customer_Master.CITY,
                    Dash_Customer_Master.PROVINCE,
                     Dash_Plan_Batch_Transaction.AGENT,Dash_Plan_Batch_Details.AGENT_DELIVERED,Dash_Agent_Performance_Detailed.BATCH_ID
    `;


    const columnQuery3 = `
      SELECT [DISTRIBUTOR_CODE]
                         ,[BRANCH_CODE]
                         ,[BRANCH]
                    	  ,Dash_Plan_Batch_Details.ORDER_DATE
                         ,[DATE] AS INVOICE_DATE
                    	  ,Dash_Plan_Batch_Details.DATE_TO_DELIVER AS DATE_DELIVERED
                         ,[SALES_REP]
                         ,[SELLER_NAME]
                    	  ,Dash_Plan_Batch_Transaction.AGENT AS LEG_1
                          , CASE WHEN Dash_Plan_Batch_Details.SUB_DA IS NULL OR Dash_Plan_Batch_Details.SUB_DA = '' 
         THEN Dash_Plan_Batch_Details.AGENT_ID 
         ELSE Dash_Plan_Batch_Details.SUB_DA 
              END AS LEG_2,AGENT_DELIVERED
                          ,DATETIME_PROCESSED 
                    	  ,BATCH
                    	  ,Dash_Plan_Batch_Details.STATUS
						  , CASE WHEN ISNULL([RETURN_AMOUNT], 0) = 0 THEN 'NO' ELSE 'YES' END AS HAS_RETURN
                         ,PRFR_Invoice_Detailed.CUSTOMER_ID
                         ,PRFR_Invoice_Detailed.CUSTOMER_NAME
                         ,[NAME] AS ITEM_ID
                         ,[SCHEME_CODE]
                         ,[SCHEME_SLAB_DESCRIPTION]
                         ,[SCHEME_GROUP_NAME]
                         ,PRFR_Invoice_Detailed.IT_BARCODE
                         ,[SW_BARCODE]
                         ,[DESCRIPTION]
                         ,[BRAND]
                         ,[ITEM_CATEGORY]
                         ,[BRANDFORM]
                         ,[TRADE_CHANNEL]
                         ,[DOCUMENT_NUMBER]
                         ,[CS]
                         ,[AMOUNT]
                         ,[DISCOUNT_VALUE]
                         ,[SCHEME_VALUE]
                         ,[SALES_EX_VAT]
                         ,[VAT_AMOUNT]
                         ,[SALES_AMOUNT],
                    	  ISNULL([QTY_RETURN], 0) AS QTY_RETURN,
                          ISNULL([RETURN_AMOUNT], 0) AS RETURN_AMOUNT
                        ,[MONTHLY_TRANSACTION]
                         ,[PG_LOCAL_SUBSEGMENT]
                         ,[SALES_SUPERVISOR]
                         ,[ITEM_QTY]
                         ,[GIV]
                         ,[NIV]
                         ,[ITEM_QTY_CS]
                         ,[ITEM_QTY_SW]
                         ,[ITEM_QTY_IT]
                    	  
                     FROM [dbo].[PRFR_Invoice_Detailed]
                     LEFT JOIN Dash_Plan_Batch_Details ON Dash_Plan_Batch_Details.INVOICE_NUMBER = PRFR_Invoice_Detailed.DOCUMENT_NUMBER AND PRFR_Invoice_Detailed.DISTRIBUTOR_CODE = Dash_Plan_Batch_Details.COMPANY_ID
                     JOIN [dbo].[Dash_Plan_Batch_Transaction] ON Dash_Plan_Batch_Transaction.BATCH_ID = Dash_Plan_Batch_Details.BATCH                    
                     LEFT JOIN Dash_Returns ON Dash_Returns.INVOICE_NUMBER = PRFR_Invoice_Detailed.DOCUMENT_NUMBER AND PRFR_Invoice_Detailed.DISTRIBUTOR_CODE = Dash_Returns.COMPANY_ID AND Dash_Returns.IT_BARCODE = PRFR_Invoice_Detailed.IT_BARCODE
                     WHERE  Dash_Plan_Batch_Details.COMPANY_ID = '${companyId}' AND Dash_Plan_Batch_Details.DATE_TO_DELIVER BETWEEN '${datefrom}' AND '${dateto}' AND Dash_Plan_Batch_Details.STATUS NOT IN ('READY', 'DRAFT') 
    `;


    const columnQuery4 = `
                     WITH CTE AS ( SELECT
            COUNT(INVOICE_NUMBER) AS TOTAL_INVOICE,
            SUM(TOTAL_AMOUNT) AS SUM_TOTAL_AMOUNT,
            [DATE_TO_DELIVER],
            [AGENT_DELIVERED]
        FROM [dbo].[Dash_Plan_Batch_Details]
        GROUP BY [DATE_TO_DELIVER], [AGENT_DELIVERED]
    )
    SELECT 
    s.COMPANY_ID,
    s.SITE_ID,
    a.USERNAME AS LEG_1,
    a.NAME_OF_USER AS LEG_2,
     a.SUB_DA AS AGENT_DELIVERED,
    s.DELIVERY_DATE,
    s.WH_ENTRY,
    s.WH_DEPARTURE,
    s.TIME_ENTRY,
    s.TIME_EXIT,
    s.STATUS,
    s.LOGIN_ID,
    s.TIME_SPENT,
    CASE 
        WHEN a.AGENT_TYPE = 'MAIN' THEN 'LEG1'
        WHEN a.AGENT_TYPE = 'SUB'  THEN 'LEG2'
        ELSE 'INB'
    END AS AGENT_TYPE,
    ISNULL(MAX(CTE.TOTAL_INVOICE), 0) AS NUM_OF_DOORS,
    ISNULL(SUM(CTE.SUM_TOTAL_AMOUNT), 0) AS AMOUNT
FROM Dash_Agent_Performance_Summary s
LEFT JOIN Dash_Agents a 
    ON s.COMPANY_ID = a.COMPANY_ID 
   AND s.SITE_ID = a.SITE_ID 
   AND s.LOGIN_ID = a.SUB_DA

    LEFT JOIN CTE ON CTE.DATE_TO_DELIVER = s.DELIVERY_DATE AND CTE.AGENT_DELIVERED = a.SUB_DA

  
    WHERE s.COMPANY_ID = '${companyId}'
    AND s.DELIVERY_DATE BETWEEN  '${datefrom}' AND '${dateto}'
  

GROUP BY 

    s.COMPANY_ID,
    s.SITE_ID,
    a.USERNAME,
    a.NAME_OF_USER,
    a.SUB_DA,
    s.DELIVERY_DATE,
    s.TIME_ENTRY,
    s.TIME_EXIT,
       s.WH_ENTRY,
    s.WH_DEPARTURE,
    s.STATUS,
    s.LOGIN_ID,
    s.TIME_SPENT,
    a.AGENT_TYPE ORDER BY  s.DELIVERY_DATE DESC
    `;


  const columnQuery5 = `
                                 WITH CTAE AS (SELECT 
      [SELLER_NAME]
      ,[DOCUMENT_NUMBER]
    FROM [dbo].[PRFR_Invoice_Detailed] GROUP BY SELLER_NAME , DOCUMENT_NUMBER) 

    SELECT 
    COMPANY_ID, 
    SITE_ID,     
    SITE_NAME, 
    ORDER_DATE,
    DATE_TO_DELIVER AS DATE_DELIVERED, 
    SELLER_NAME,
    AGENT AS LEG_1, 
    LEG2,
    AGENT_DELIVERED,   
    STORE_ENTRY, 
    STORE_EXIT, 
    STORE_TIME_SPENT, 
    PERFORMANCE_STATUS,
    CUSTOMER_ID, 
    CUSTOMER_NAME, 
    PHONE, 
    ADDRESS, 
    CITY,   
    PROVINCE,
    IMAGE1, 
      IMG1 AS POD1,
        IMG2 AS POD2,
    LATITUDE, 
    LONGITUDE, 
    STATUS,
    SUB_BATCH,
    IS_RECEIVED,
    VEHICLE_IDS,
    IS_DROP_STATUS

FROM ( 
    SELECT 
        b.COMPANY_ID, 
        a.SITE_ID,                              
        Dash_Sites.SITE_NAME, 
        a.ORDER_DATE,
        b.DATE_TO_DELIVER, 
        CTAE.SELLER_NAME,
        a.AGENT,
       (case when b.SUB_DA = '' then a.AGENT else  b.SUB_DA end)  as  LEG2,
        ISNULL(d.AGENT_DELIVERED,d.BATCH_ID) AS  AGENT_DELIVERED,
        d.STORE_ENTRY, 
        d.STORE_EXIT, 
        d.STORE_TIME_SPENT, 
        d.STATUS AS PERFORMANCE_STATUS,
        b.CUSTOMER_ID, 
        b.CUSTOMER_NAME, 
        c.PHONE, 
        c.ADDRESS,
        c.CITY,
        c.PROVINCE,
        c.IMAGE1,
        pod.IMG1,
        pod.IMG2 ,
        c.LATITUDE, 
        c.LONGITUDE, 
        b.STATUS, 
        b.SUB_BATCH,
        b.IS_RECEIVED,
        b.VEHICLE_IDS,
        b.IS_DROP_STATUS,
        ROW_NUMBER() OVER (
            PARTITION BY b.CUSTOMER_ID, b.COMPANY_ID 
            ORDER BY d.STORE_EXIT DESC
        ) AS rn 
    FROM 
        Dash_Plan_Batch_Transaction a 
    JOIN 
        Dash_Plan_Batch_Details b 
        ON a.BATCH_ID = b.BATCH AND a.COMPANY_ID = b.COMPANY_ID
    LEFT JOIN 
        Dash_Customer_Master c 
        ON c.CODE = b.CUSTOMER_ID AND c.COMPANY_ID = b.COMPANY_ID  
        LEFT JOIN CTAE ON CTAE.DOCUMENT_NUMBER = b.INVOICE_NUMBER 
    LEFT JOIN 
        Dash_Agent_Performance_Detailed d 
        ON b.CUSTOMER_ID = d.STORE_CODE 
        AND b.DATE_TO_DELIVER = d.DELIVERY_DATE 
       AND b.COMPANY_ID = d.COMPANY_ID  AND d.BATCH_ID =
       CASE 
           WHEN b.AGENT_DELIVERED IS NOT NULL THEN b.AGENT_DELIVERED
           ELSE b.AGENT_ID
       END left join
        Dash_Sites 
        ON Dash_Sites.SITE_ID = a.SITE_ID   
   LEFT JOIN Dash_PaymentPOD pod ON CTAE.DOCUMENT_NUMBER = pod.INV_ID
    WHERE 
        b.DATE_TO_DELIVER BETWEEN '${datefrom}' AND '${dateto}'
        AND a.STATUS = 'PROCESSED' 
        AND b.COMPANY_ID = '${companyId}' 
) AS subquery 
where  rn=1
    `;


    // Numeric-only request ID
    const now = new Date();
    const pad = (num) => num.toString().padStart(2, '0');
    const requestId = `${now.getFullYear()}${pad(now.getMonth() + 1)}${pad(now.getDate())}${pad(now.getHours())}${pad(now.getMinutes())}${pad(now.getSeconds())}`;

    //console.log("Column Query:", columnQuery);
    console.log("Request ID:", requestId);

    // Send as parameter to PHP
    fetch(`/Dash/datafetcher/reports_getdata2.php?action=sendreport&title=Delivery Result&filename=DeliveryResult&sheet1name=SO Report&sheet2name=DeliveryResultSummary&sheet3name=DeliveryResultDetailed&sheet4name=DeliveryPerformanceSummary&sheet5name=DeliveryPerformanceDetailed&requestid=${encodeURIComponent(requestId)}&columnQuery=${encodeURIComponent(columnQuery)}&columnQuery2=${encodeURIComponent(columnQuery2)}&columnQuery3=${encodeURIComponent(columnQuery3)}&columnQuery4=${encodeURIComponent(columnQuery4)}&columnQuery5=${encodeURIComponent(columnQuery5)}&allsites=${encodeURIComponent(allsites)}&UserID=${encodeURIComponent(userid)}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log("Request inserted successfully:", data);
                loaditems();
            } else {
                console.warn("Insert failed:", data.error || "Unknown error");
            }
        })
        .catch(err => console.error('Error:', err));
}


//PERFORMANCE SUMMARY

function deliveryperformance() {

    const companyId = "<?php echo $_SESSION['Company_ID'] ?? ''; ?>";
    const datefrom = document.getElementById('deliveryperformancedtfrom').value;
    const dateto = document.getElementById('deliveryperformancedtto').value;
    const allsites = document.getElementById('deliveryperformanceallsites').checked ? 1 : 0;
    const userid = "<?php echo $_SESSION['UserID'] ?? ''; ?>";

    // Your column-specific SQL query as a string
    const columnQuery = `
                     WITH CTE AS ( SELECT
            COUNT(INVOICE_NUMBER) AS TOTAL_INVOICE,
            SUM(TOTAL_AMOUNT) AS SUM_TOTAL_AMOUNT,
            [DATE_TO_DELIVER],
            [AGENT_DELIVERED]
        FROM [dbo].[Dash_Plan_Batch_Details]
        GROUP BY [DATE_TO_DELIVER], [AGENT_DELIVERED]
    )
    SELECT 
    s.COMPANY_ID,
    s.SITE_ID,
    a.USERNAME AS LEG_1,
    a.NAME_OF_USER AS LEG_2,
     a.SUB_DA AS AGENT_DELIVERED,
    s.DELIVERY_DATE,
    s.WH_ENTRY,
    s.WH_DEPARTURE,
    s.TIME_ENTRY,
    s.TIME_EXIT,
    s.STATUS,
    s.LOGIN_ID,
    s.TIME_SPENT,
    CASE 
        WHEN a.AGENT_TYPE = 'MAIN' THEN 'LEG1'
        WHEN a.AGENT_TYPE = 'SUB'  THEN 'LEG2'
        ELSE 'INB'
    END AS AGENT_TYPE,
    ISNULL(MAX(CTE.TOTAL_INVOICE), 0) AS NUM_OF_DOORS,
    ISNULL(SUM(CTE.SUM_TOTAL_AMOUNT), 0) AS AMOUNT
FROM Dash_Agent_Performance_Summary s
LEFT JOIN Dash_Agents a 
    ON s.COMPANY_ID = a.COMPANY_ID 
   AND s.SITE_ID = a.SITE_ID 
   AND s.LOGIN_ID = a.SUB_DA

    LEFT JOIN CTE ON CTE.DATE_TO_DELIVER = s.DELIVERY_DATE AND CTE.AGENT_DELIVERED = a.SUB_DA

  
    WHERE s.COMPANY_ID = '${companyId}'
    AND s.DELIVERY_DATE BETWEEN  '${datefrom}' AND '${dateto}'
  

GROUP BY 

    s.COMPANY_ID,
    s.SITE_ID,
    a.USERNAME,
    a.NAME_OF_USER,
    a.SUB_DA,
    s.DELIVERY_DATE,
    s.TIME_ENTRY,
    s.TIME_EXIT,
       s.WH_ENTRY,
    s.WH_DEPARTURE,
    s.STATUS,
    s.LOGIN_ID,
    s.TIME_SPENT,
    a.AGENT_TYPE ORDER BY  s.DELIVERY_DATE DESC
    `;

    // Numeric-only request ID
    const now = new Date();
    const pad = (num) => num.toString().padStart(2, '0');
    const requestId = `${now.getFullYear()}${pad(now.getMonth() + 1)}${pad(now.getDate())}${pad(now.getHours())}${pad(now.getMinutes())}${pad(now.getSeconds())}`;

   // console.log("Column Query:", columnQuery);
    console.log("Request ID:", requestId);

    // Send as parameter to PHP
    fetch(`/Dash/datafetcher/reports_getdata2.php?action=sendreport&title=Delivery Performance&filename=DeliveryPerformance&sheet1name=Details&sheet2name=sheet2&sheet3name=sheet3&sheet4name=sheet4&sheet5name=sheet5&requestid=${encodeURIComponent(requestId)}&columnQuery=${encodeURIComponent(columnQuery)}&allsites=${encodeURIComponent(allsites)}&UserID=${encodeURIComponent(userid)}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log("Request inserted successfully:", data);
                loaditems();
            } else {
                console.warn("Insert failed:", data.error || "Unknown error");
            }
        })
        .catch(err => console.error('Error:', err));
}


// perfoamnce detailed

function deliveryperformancedetailed() {

    const companyId = "<?php echo $_SESSION['Company_ID'] ?? ''; ?>";
    const datefrom = document.getElementById('deliveryperformancedetailedfrom').value;
    const dateto = document.getElementById('deliveryperformancedetailedto').value;
    const allsites = document.getElementById('performanceDetailedAllSites').checked ? 1 : 0;
    const userid = "<?php echo $_SESSION['UserID'] ?? ''; ?>";

    // Your column-specific SQL query as a string
    const columnQuery = `
                                 WITH CTAE AS (SELECT 
      [SELLER_NAME]
      ,[DOCUMENT_NUMBER]
    FROM [dbo].[PRFR_Invoice_Detailed] GROUP BY SELLER_NAME , DOCUMENT_NUMBER) 

    SELECT 
    COMPANY_ID, 
    SITE_ID,     
    SITE_NAME, 
    ORDER_DATE,
    DATE_TO_DELIVER AS DATE_DELIVERED, 
    SELLER_NAME,
    AGENT AS LEG_1, 
    LEG2,
    AGENT_DELIVERED,   
    STORE_ENTRY, 
    STORE_EXIT, 
    STORE_TIME_SPENT, 
    PERFORMANCE_STATUS,
    CUSTOMER_ID, 
    CUSTOMER_NAME, 
    PHONE, 
    ADDRESS, 
    CITY,   
    PROVINCE,
    IMAGE1, 
      IMG1 AS POD1,
        IMG2 AS POD2,
    LATITUDE, 
    LONGITUDE, 
    STATUS,
    SUB_BATCH,
    IS_RECEIVED,
    VEHICLE_IDS,
    IS_DROP_STATUS

FROM ( 
    SELECT 
        b.COMPANY_ID, 
        a.SITE_ID,                              
        Dash_Sites.SITE_NAME, 
        a.ORDER_DATE,
        b.DATE_TO_DELIVER, 
        CTAE.SELLER_NAME,
        a.AGENT,
       (case when b.SUB_DA = '' then a.AGENT else  b.SUB_DA end)  as  LEG2,
        ISNULL(d.AGENT_DELIVERED,d.BATCH_ID) AS  AGENT_DELIVERED,
        d.STORE_ENTRY, 
        d.STORE_EXIT, 
        d.STORE_TIME_SPENT, 
        d.STATUS AS PERFORMANCE_STATUS,
        b.CUSTOMER_ID, 
        b.CUSTOMER_NAME, 
        c.PHONE, 
        c.ADDRESS,
        c.CITY,
        c.PROVINCE,
        c.IMAGE1,
        pod.IMG1,
        pod.IMG2 ,
        c.LATITUDE, 
        c.LONGITUDE, 
        b.STATUS, 
        b.SUB_BATCH,
        b.IS_RECEIVED,
        b.VEHICLE_IDS,
        b.IS_DROP_STATUS,
        ROW_NUMBER() OVER (
            PARTITION BY b.CUSTOMER_ID, b.COMPANY_ID 
            ORDER BY d.STORE_EXIT DESC
        ) AS rn 
    FROM 
        Dash_Plan_Batch_Transaction a 
    JOIN 
        Dash_Plan_Batch_Details b 
        ON a.BATCH_ID = b.BATCH AND a.COMPANY_ID = b.COMPANY_ID
    LEFT JOIN 
        Dash_Customer_Master c 
        ON c.CODE = b.CUSTOMER_ID AND c.COMPANY_ID = b.COMPANY_ID  
        LEFT JOIN CTAE ON CTAE.DOCUMENT_NUMBER = b.INVOICE_NUMBER 
    LEFT JOIN 
        Dash_Agent_Performance_Detailed d 
        ON b.CUSTOMER_ID = d.STORE_CODE 
        AND b.DATE_TO_DELIVER = d.DELIVERY_DATE 
       AND b.COMPANY_ID = d.COMPANY_ID  AND d.BATCH_ID =
       CASE 
           WHEN b.AGENT_DELIVERED IS NOT NULL THEN b.AGENT_DELIVERED
           ELSE b.AGENT_ID
       END left join
        Dash_Sites 
        ON Dash_Sites.SITE_ID = a.SITE_ID   
   LEFT JOIN Dash_PaymentPOD pod ON CTAE.DOCUMENT_NUMBER = pod.INV_ID
    WHERE 
        b.DATE_TO_DELIVER BETWEEN '${datefrom}' AND '${dateto}'
        AND a.STATUS = 'PROCESSED' 
        AND b.COMPANY_ID = '${companyId}' 
) AS subquery 
where  rn=1
    `;

    // Numeric-only request ID
    const now = new Date();
    const pad = (num) => num.toString().padStart(2, '0');
    const requestId = `${now.getFullYear()}${pad(now.getMonth() + 1)}${pad(now.getDate())}${pad(now.getHours())}${pad(now.getMinutes())}${pad(now.getSeconds())}`;

   // console.log("Column Query:", columnQuery);
    console.log("Request ID:", requestId);

    // Send as parameter to PHP
    fetch(`/Dash/datafetcher/reports_getdata2.php?action=sendreport&title=Delivery Performance Detailed&filename=DeliveryPerformanceDetailed&sheet1name=Details&sheet2name=sheet2&sheet3name=sheet3&sheet4name=sheet4&sheet5name=sheet5&requestid=${encodeURIComponent(requestId)}&columnQuery=${encodeURIComponent(columnQuery)}&allsites=${encodeURIComponent(allsites)}&UserID=${encodeURIComponent(userid)}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log("Request inserted successfully:", data);
                loaditems();
            } else {
                console.warn("Insert failed:", data.error || "Unknown error");
            }
        })
        .catch(err => console.error('Error:', err));
}



//freight report

function freightReport() {

    const companyId = "<?php echo $_SESSION['Company_ID'] ?? ''; ?>";
    const datefrom = document.getElementById('freightfrom').value;
    const dateto = document.getElementById('freightto').value;
    const allsites = document.getElementById('freightAllSites').checked ? 1 : 0;
    const userid = "<?php echo $_SESSION['UserID'] ?? ''; ?>";

    // Your column-specific SQL query as a string
    const columnQuery = `
        SELECT 
        S.SITE_NAME,
        D.SITE_ID,
        AVG(D.DailyTruckCount) AS Average_Trucks_Used_Per_Day,
        AVG(D.AverageInvoiceDrops) AS Average_Invoice_Drops_Per_Day,
        CONVERT(VARCHAR(8), DATEADD(SECOND, AVG(DATEDIFF(SECOND, 0, TRY_CONVERT(time, A.TIME_ENTRY))), 0), 108) AS Average_Market_Entry_Time,
        CONVERT(VARCHAR(8), DATEADD(SECOND, AVG(DATEDIFF(SECOND, 0, TRY_CONVERT(time, A.TIME_EXIT))), 0), 108) AS Average_Market_Exit_Time
    FROM (
        SELECT 
            SITE_ID,
            CAST([ORDER_DATE] AS DATE) AS DeliveryDate,
            COUNT(DISTINCT VEHICLE_ID) AS DailyTruckCount,
            SUM(NUM_OF_INVOICES) AS AverageInvoiceDrops,
            COMPANY_ID
        FROM [dbo].[Dash_Plan_Batch_Transaction]
        WHERE ORDER_DATE BETWEEN '${datefrom}' AND '${dateto}'
          AND VEHICLE_ID IS NOT NULL
          AND STATUS = 'PROCESSED'
        GROUP BY SITE_ID, CAST([ORDER_DATE] AS DATE), COMPANY_ID
    ) AS D
    JOIN [dbo].[Dash_Sites] AS S ON D.SITE_ID = S.SITE_ID
    LEFT JOIN [dbo].[Dash_Agent_Performance_Summary] AS A 
        ON D.SITE_ID = A.SITE_ID AND D.DeliveryDate = A.DELIVERY_DATE
    WHERE 
        TRY_CONVERT(time, A.TIME_ENTRY) IS NOT NULL
        AND TRY_CONVERT(time, A.TIME_EXIT) IS NOT NULL
        AND D.COMPANY_ID = '${companyId}'
    GROUP BY D.SITE_ID, S.SITE_NAME
    ORDER BY S.SITE_NAME;
    `;

    const columnQuery2 = `
       SELECT 
                        S.SITE_NAME,
                        D.SITE_ID,
                        D.DeliveryDate,
                        D.DailyTruckCount AS Trucks_Used_On_Day,
                        D.AverageInvoiceDrops AS Invoice_Drops_On_Day,
                        CONVERT(VARCHAR(8), DATEADD(SECOND, AVG(DATEDIFF(SECOND, 0, TRY_CONVERT(time, A.TIME_ENTRY))), 0), 108) AS Average_Market_Entry_Time,
                        CONVERT(VARCHAR(8), DATEADD(SECOND, AVG(DATEDIFF(SECOND, 0, TRY_CONVERT(time, A.TIME_EXIT))), 0), 108) AS Average_Market_Exit_Time
                    FROM (
                        SELECT 
                            SITE_ID,
                            CAST([ORDER_DATE] AS DATE) AS DeliveryDate,
                            COUNT(DISTINCT VEHICLE_ID) AS DailyTruckCount,
                            SUM(NUM_OF_INVOICES) AS AverageInvoiceDrops,
                            COMPANY_ID
                        FROM [dbo].[Dash_Plan_Batch_Transaction]
                        WHERE ORDER_DATE BETWEEN '${datefrom}' AND '${dateto}'
                          AND VEHICLE_ID IS NOT NULL
                          AND STATUS = 'PROCESSED'
                        GROUP BY SITE_ID, CAST([ORDER_DATE] AS DATE), COMPANY_ID
                    ) AS D
                    JOIN [dbo].[Dash_Sites] AS S ON D.SITE_ID = S.SITE_ID
                    LEFT JOIN [dbo].[Dash_Agent_Performance_Summary] AS A 
                        ON D.SITE_ID = A.SITE_ID AND D.DeliveryDate = A.DELIVERY_DATE
                    WHERE 
                        TRY_CONVERT(time, A.TIME_ENTRY) IS NOT NULL
                        AND TRY_CONVERT(time, A.TIME_EXIT) IS NOT NULL
                        AND D.COMPANY_ID = '${companyId}'
                    GROUP BY 
                        D.SITE_ID, 
                        S.SITE_NAME,
                        D.DeliveryDate,
                        D.DailyTruckCount,
                        D.AverageInvoiceDrops
                    ORDER BY 
                      
                        D.DeliveryDate;
    `;

const columnQuery3 = `
SELECT 
      t.[COMPANY_ID],
      t.[SITE_ID],
      t.[BATCH_ID],
      t.[DROP_COUNT],
      t.[NUM_OF_INVOICES],
      t.[TOTAL_VALUE],
      t.[TOTAL_VOLUME],
      t.[WEIGHT],
      t.[STATUS],
      t.[VEHICLE_ID],
      t.[AGENT],
      a.[SUB_DA],
      t.[DATE_TO_DELIVER],
      t.[ORDER_DATE],
      t.[IS_SENT]
FROM [dbo].[Dash_Plan_Batch_Transaction] t
LEFT JOIN [dbo].[Dash_Agents] a
       ON a.COMPANY_ID = t.COMPANY_ID
      AND a.SITE_ID = t.SITE_ID
      AND a.NAME_OF_USER = t.AGENT
WHERE t.DATE_TO_DELIVER BETWEEN '${datefrom}' AND '${dateto}'
  AND t.STATUS = 'PROCESSED'
  AND t.COMPANY_ID = '${companyId}'
    `;


    // Numeric-only request ID
    const now = new Date();
    const pad = (num) => num.toString().padStart(2, '0');
    const requestId = `${now.getFullYear()}${pad(now.getMonth() + 1)}${pad(now.getDate())}${pad(now.getHours())}${pad(now.getMinutes())}${pad(now.getSeconds())}`;

   // console.log("Column Query:", columnQuery);
    console.log("Request ID:", requestId);

    // Send as parameter to PHP
    fetch(`/Dash/datafetcher/reports_getdata2.php?action=sendreport&title=Freight Report&filename=FreightReport&sheet1name=Summary&sheet2name=Details&sheet3name=TrucksUsed&sheet4name=sheet4&sheet5name=sheet5&requestid=${encodeURIComponent(requestId)}&columnQuery=${encodeURIComponent(columnQuery)}&columnQuery2=${encodeURIComponent(columnQuery2)}&columnQuery3=${encodeURIComponent(columnQuery3)}&allsites=${encodeURIComponent(allsites)}&UserID=${encodeURIComponent(userid)}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log("Request inserted successfully:", data);
                loaditems();
            } else {
                console.warn("Insert failed:", data.error || "Unknown error");
            }
        })
        .catch(err => console.error('Error:', err));
}

// crossdock report
function crossdock() {

    const companyId = "<?php echo $_SESSION['Company_ID'] ?? ''; ?>";
    const datefrom = document.getElementById('cdockfrom').value;
    const dateto = document.getElementById('cdockto').value;
    const allsites = document.getElementById('cdockallsites').checked ? 1 : 0;
    const userid = "<?php echo $_SESSION['UserID'] ?? ''; ?>";

    // Your column-specific SQL query as a string
    const columnQuery = `SELECT 
    xd.COMPANY_ID,
    xd.SITE_ID,
    xd.BATCH,
    xd.DELIVERY_AMOUNT,
    xd.AGENT,
    xd.VEHICLE,
    xd.TRANSACTION_DATE,

    CONVERT(varchar(8), xd.WH_ENTRY, 108) AS WAREHOUSE_ENTRY,
    CONVERT(varchar(8), xd.DEPARTURE_TIME, 108) AS DEPARTURE_TIME,
    CONVERT(varchar(8), xd.ARRIVAL_TIME, 108) AS CROSS_DOCK_ARRIVAL_TIME,
    CONVERT(varchar(8), xd.XD_EXIT, 108) AS CROSS_DOCK_EXIT,
    CONVERT(varchar(8), xd.WH_RETURN, 108) AS WAREHOUSE_RETURN_TIME,

    ad.TotalDistanceKm AS DISTANCE_TRAVELLED_IN_KM,
    ROUND(ad.TotalDistanceKm * ISNULL(v.CONSUMPTION_PER_100_METERS,0)/100,2)
        AS FUEL_CONSUMED_IN_LITER

FROM Dash_XDock_Status xd
LEFT JOIN dbo.Agent_Daily_Distance ad
    ON ad.AGENT_ID = xd.AGENT
   AND ad.DELIVERY_DATE = xd.TRANSACTION_DATE
LEFT JOIN Dash_Vehicles v
    ON v.PLATE_NUM = xd.VEHICLE
WHERE xd.TRANSACTION_DATE BETWEEN '${datefrom}' AND '${dateto}'
  AND xd.COMPANY_ID = '${companyId}'
ORDER BY xd.AGENT, xd.TRANSACTION_DATE;


    `;

    // Numeric-only request ID
    const now = new Date();
    const pad = (num) => num.toString().padStart(2, '0');
    const requestId = `${now.getFullYear()}${pad(now.getMonth() + 1)}${pad(now.getDate())}${pad(now.getHours())}${pad(now.getMinutes())}${pad(now.getSeconds())}`;

   // console.log("Column Query:", columnQuery);
    console.log("Request ID:", requestId);

    // Send as parameter to PHP
    fetch(`/Dash/datafetcher/reports_getdata2.php?action=sendreport&title=Cross Dock&filename=CrossDock&sheet1name=Details&sheet2name=sheet2&sheet3name=sheet3&sheet4name=sheet4&sheet5name=sheet5&requestid=${encodeURIComponent(requestId)}&columnQuery=${encodeURIComponent(columnQuery)}&allsites=${encodeURIComponent(allsites)}&UserID=${encodeURIComponent(userid)}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log("Request inserted successfully:", data);
                loaditems();
            } else {
                console.warn("Insert failed:", data.error || "Unknown error");
            }
        })
        .catch(err => console.error('Error:', err));
}



function loaditems() {
    const userid = "<?php echo $_SESSION['UserID'] ?? ''; ?>";
    const datecreated = new Date().toISOString().split('T')[0];
    const tbody = document.querySelector('#itemsTable tbody');

    return fetch(`/Dash/datafetcher/reports_getdata2.php?action=loadlist&userid=${encodeURIComponent(userid)}&datecreated=${encodeURIComponent(datecreated)}`)
        .then(response => response.json())
        .then(data => {
            if (!Array.isArray(data)) return;

            data.forEach(item => {
                const rowId = "row_" + item.REQUEST_ID;
                let row = document.getElementById(rowId);

                if (!row) {
                    row = document.createElement("tr");
                    row.id = rowId;

                    row.innerHTML = `
                        <td>${item.REQUEST_ID}</td>
                        <td>${item.TITLE}</td>
                        <td>${item.DATE_CREATED}</td>
                        <td id="status_${item.REQUEST_ID}">${item.STATUS}</td>
                        <td id="link_${item.REQUEST_ID}"></td>
                    `;

                    tbody.prepend(row);
                }
                const statusCell = document.getElementById("status_" + item.REQUEST_ID);
                if (statusCell) statusCell.innerText = item.STATUS;

                const linkCell = document.getElementById("link_" + item.REQUEST_ID);

                if (item.LINK && item.LINK.trim() !== "") {
                    linkCell.innerHTML = `
                        <button class="btn btn-sm btn-primary" onclick="window.open('${item.LINK}', '_blank')">
                            Download
                        </button>
                    `;
                } else {
                    linkCell.innerHTML = "";
                }
            });
        })
        .catch(err => console.error("Error:", err));
}





document.addEventListener('DOMContentLoaded', function() {
    loaditems();
});


setInterval(() => {
    loaditems();
}, 5000);



</script>

</body>
</html>