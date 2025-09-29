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
    /* Loading overlay styles - hidden by default */
    #loadingOverlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,0.5);
      display: none; /* Hidden initially */
      align-items: center;
      justify-content: center;
      z-index: 9999;
      flex-direction: column;
    }
    #loadingOverlay .spinner-border {
      width: 3rem;
      height: 3rem;
    }
  </style>

  
</head>
<body>
  <!-- Loading overlay: hidden initially -->
  <div id="loadingOverlay">
    <div class="spinner-border text-light" role="status" aria-hidden="true"></div>
    <div style="margin-top: 10px; color: #fff; font-size: 1.2em;">Generating report. Please note that large data may take some time to process.</div>
  </div>

  <div class="container-fluid p-0 m-0">
    <!-- First row -->
    <div class="d-flex flex-row flex-wrap justify-content-start m-0 p-0 row-no-margin">
      <!-- DELIVERY PLAN -->
      <div class="card text-bg-light" style="width: 240px;">
        <div class="card-header d-flex align-items-center p-2">
          <span>DELIVERY PLAN</span>
          <div class="d-flex align-items-center ml-auto m-0 p-0">
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
      
      <!-- ORDER PLAN -->
      <div class="card text-bg-light" style="width: 240px;">
        <div class="card-header d-flex align-items-center p-2">
          <span>ORDER PREPARATION</span>
          <div class="d-flex align-items-center ml-auto m-0 p-0">
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
          <button class="btn btn-success btn-sm" onclick="orderpreps()">GENERATE</button>
        </div>
      </div>
    </div>
    
    <!-- Second row -->
    <div class="d-flex flex-row flex-wrap justify-content-start m-0 p-0 mt-3 row-no-margin">
      <!-- PAYMENTS -->
      <div class="card text-bg-light" style="width: 240px;">
        <div class="card-header d-flex align-items-center p-2">
          <span>SO REPORT</span>
          <div class="d-flex align-items-center ml-auto m-0 p-0">
            <input type="checkbox" id="paymentsAllSites" class="m-0" />
            <label for="paymentsAllSites" class="m-0 ml-2" style="font-size:10px;">ALL SITES</label>
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
          <button class="btn btn-success btn-sm" onclick="exportsoreport()">GENERATE</button>
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
            <input type="date" id="resultdtfrom" class="mb-1 form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>"/>
            <label class="mb-1 ml-1 mr-1">To</label>
            <input type="date" id="resultdtto" class="mb-1 form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>"/>
          </div>
        </div>
        <div class="d-flex justify-content-end mb-1 mr-2">
          <button class="btn btn-success btn-sm" onclick="exportdeliveryresult()">GENERATE</button>
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
            <input type="date" id="delperformancedtfrom" class="mb-1 form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>"/>
            <label class="mb-1 ml-1 mr-1">To</label>
            <input type="date" id="delperformancedtto" class="mb-1 form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>"/>
          </div>
        </div>
        <div class="d-flex justify-content-end mb-1 mr-2">
          <button class="btn btn-success btn-sm" onclick="exportMultiSheet()">GENERATE</button>
        </div>
      </div>
      <!-- CROSSDOCK REPORT -->
      <div class="card text-bg-light" style="width: 240px;">
        <div class="card-header d-flex align-items-center p-2">
          <span>PERFORMANCE DETAILED</span>
          <div class="d-flex align-items-center ml-auto m-0 p-0">
            <input type="checkbox" id="crossdockReportAllSites" class="m-0" />
            <label for="crossdockReportAllSites" class="m-0 ml-2" style="font-size:10px;">ALL SITES</label>
          </div>
        </div>
        <div class="card-body p-2">
          <div class="d-flex flex-wrap align-items-center">
            <label class="mb-1 mr-1">Date From:</label>
            <input type="date" id="perffrom" class="mb-1 form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>"/>
            <label class="mb-1 ml-1 mr-1">To</label>
            <input type="date" id="perfto" class="mb-1 form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>"/>
          </div>
        </div>
        <div class="d-flex justify-content-end mb-1 mr-2">
          <button class="btn btn-success btn-sm" onclick="exportMultiSheetdetailed()">GENERATE</button>
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
            <input type="date" id="freight_datefrom" class="mb-1 form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>"/>
            <label class="mb-1 ml-1 mr-1">To</label>
            <input type="date" id="freight_dateto" class="mb-1 form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>"/>
          </div>
        </div>
        <div class="d-flex justify-content-end mb-1 mr-2">
          <button class="btn btn-success btn-sm" onclick="freightreport()">GENERATE</button>
        </div>
      </div>
       <div class="card text-bg-light" style="width: 240px;">
        <div class="card-header d-flex align-items-center p-2">
          <span>CROSSDOCK REPORT</span>
          <div class="d-flex align-items-center ml-auto m-0 p-0">
            <input type="checkbox" id="crossdockAllSites" class="m-0" />
            <label for="crossdockAllSites" class="m-0 ml-2" style="font-size:10px;">ALL SITES</label>
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

  <!-- Bootstrap JS dependencies -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
  <script>
    // Function to show the loading overlay
    function showLoading() {
      document.getElementById('loadingOverlay').style.display = 'flex';
    }
    // Function to hide the loading overlay
    function hideLoading() {
      document.getElementById('loadingOverlay').style.display = 'none';
    }

    // Example placeholder for applyFilters() - your custom logic
    function applyFilters() {
      alert("Filter applied!");
    }

    // Function to handle export with loading overlay
    async function exportMultiSheet() {
      showLoading(); // Show spinner
      const companyid = "<?php echo $_SESSION['Company_ID'] ?? ''; ?>";
      const siteid    = "<?php echo $_SESSION['SITE_ID'] ?? ''; ?>";
      const datefrom = document.getElementById('delperformancedtfrom').value;
      const dateto = document.getElementById('delperformancedtto').value;

      try {
        const res = await fetch(`/Dash/datafetcher/reports_getdata.php?action=loadagents&datefrom=${encodeURIComponent(datefrom)}&dateto=${encodeURIComponent(dateto)}&companyid=${companyid}&siteid=${siteid}`);
        const data = await res.json();

        const wb = XLSX.utils.book_new();

        for (const sheetName in data) {
          if (Array.isArray(data[sheetName])) {
            const ws = XLSX.utils.json_to_sheet(data[sheetName]);
            XLSX.utils.book_append_sheet(wb, ws, sheetName);
          }
        }

        XLSX.writeFile(wb, "Delivery_Performance_Summary_Report.xlsx");
      } catch (err) {
        console.error(err);
        alert("Export failed!");
      } finally {
        hideLoading(); // Hide spinner
      }
    }

    

    async function exportMultiSheetdetailed() {
      showLoading(); // Show spinner
      const companyid = "<?php echo $_SESSION['Company_ID'] ?? ''; ?>";
      const siteid    = "<?php echo $_SESSION['SITE_ID'] ?? ''; ?>";
      const datefrom = document.getElementById('perffrom').value;
      const dateto = document.getElementById('perfto').value;

      try {
        const res = await fetch(`/Dash/datafetcher/reports_getdata.php?action=loadagentsdetailed&datefrom=${encodeURIComponent(datefrom)}&dateto=${encodeURIComponent(dateto)}&companyid=${companyid}&siteid=${siteid}`);
        const data = await res.json();

        const wb = XLSX.utils.book_new();

        for (const sheetName in data) {
          if (Array.isArray(data[sheetName])) {
            const ws = XLSX.utils.json_to_sheet(data[sheetName]);
            XLSX.utils.book_append_sheet(wb, ws, sheetName);
          }
        }

        XLSX.writeFile(wb, "Delivery_Performance_Detailed_Report.xlsx");
      } catch (err) {
        console.error(err);
        alert("Export failed!");
      } finally {
        hideLoading(); // Hide spinner
      }
    }

async function exportsoreport() {
  showLoading(); // Show spinner
  const companyid = "<?php echo $_SESSION['Company_ID'] ?? ''; ?>";
  const siteid    = "<?php echo $_SESSION['SITE_ID'] ?? ''; ?>";
  const datefrom = document.getElementById('soreportdatefrom').value;
  const dateto   = document.getElementById('soreportdateto').value;

  try {
    // Direct download link (backend streams CSV row by row)
    const url = `/Dash/datafetcher/reports_getdata.php?action=soreport&datefrom=${encodeURIComponent(datefrom)}&dateto=${encodeURIComponent(dateto)}&companyid=${companyid}&siteid=${siteid}`;
    
    // Create hidden <a> element to trigger download
    const a = document.createElement("a");
    a.href = url;
    a.download = "SO_Report.csv"; // will be served as CSV
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);

  } catch (err) {
    console.error(err);
    alert("Export failed!");
  } finally {
    hideLoading(); // Hide spinner
  }
}


async function deliveryplan() {

  showLoading(); // Show spinner

    const isall = document.getElementById('deliveryPlanAllSites').checked;
  const companyid = "<?php echo $_SESSION['Company_ID'] ?? ''; ?>";
  const siteid    = "<?php echo $_SESSION['SITE_ID'] ?? ''; ?>";
  const datefrom = document.getElementById('delivery_datefrom').value;
  const dateto   = document.getElementById('delivery_dateto').value;

  try {
    // Direct download link (backend streams CSV row by row)
    const url = `/Dash/datafetcher/reports_getdata.php?action=deliveryplan&datefrom=${encodeURIComponent(datefrom)}&dateto=${encodeURIComponent(dateto)}&companyid=${companyid}&siteid=${siteid}&isall=${isall}`;
    
    // Create hidden <a> element to trigger download
    const a = document.createElement("a");
    a.href = url;
    a.download = "Delivery_Plan.csv"; // will be served as CSV
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);

  } catch (err) {
    console.error(err);
    alert("Export failed!");
  } finally {
    hideLoading(); // Hide spinner
  }
}

    
 async function exportdeliveryresult() {
      showLoading(); 
      const companyid = "<?php echo $_SESSION['Company_ID'] ?? ''; ?>";
      const siteid    = "<?php echo $_SESSION['SITE_ID'] ?? ''; ?>";
      const datefrom = document.getElementById('resultdtfrom').value;
      const dateto = document.getElementById('resultdtto').value;

      try {
        const res = await fetch(`/Dash/datafetcher/reports_getdata.php?action=result&datefrom=${encodeURIComponent(datefrom)}&dateto=${encodeURIComponent(dateto)}&companyid=${companyid}&siteid=${siteid}`);
        const data = await res.json();

        const wb = XLSX.utils.book_new();

        for (const sheetName in data) {
          if (Array.isArray(data[sheetName])) {
            const ws = XLSX.utils.json_to_sheet(data[sheetName]);
            XLSX.utils.book_append_sheet(wb, ws, sheetName);
          }
        }

        XLSX.writeFile(wb, "Delivery_Result_Report.xlsx");
      } catch (err) {
        console.error(err);
        alert("Export failed!");
      } finally {
        hideLoading(); // Hide spinner
      }
    }

     async function orderpreps() {
      showLoading(); // Show spinner

      const isall = document.getElementById('orderPlanAllSites').checked;

      const companyid = "<?php echo $_SESSION['Company_ID'] ?? ''; ?>";
      const siteid    = "<?php echo $_SESSION['SITE_ID'] ?? ''; ?>";
      const datefrom = document.getElementById('order_datefrom').value;
      const dateto = document.getElementById('order_dateto').value;

      try {
        const res = await fetch(`/Dash/datafetcher/reports_getdata.php?action=orderprep&datefrom=${encodeURIComponent(datefrom)}&dateto=${encodeURIComponent(dateto)}&companyid=${companyid}&siteid=${siteid}&isall=${isall}`);
        const data = await res.json();

        const wb = XLSX.utils.book_new();

        for (const sheetName in data) {
          if (Array.isArray(data[sheetName])) {
            const ws = XLSX.utils.json_to_sheet(data[sheetName]);
            XLSX.utils.book_append_sheet(wb, ws, sheetName);
          }
        }

        XLSX.writeFile(wb, "Order_Preparation_Report.xlsx");
      } catch (err) {
        console.error(err);
        alert("Export failed!");
      } finally {
        hideLoading(); // Hide spinner
      }
    }

    async function freightreport() {
      showLoading(); // Show spinner
      const companyid = "<?php echo $_SESSION['Company_ID'] ?? ''; ?>";
      const siteid    = "<?php echo $_SESSION['SITE_ID'] ?? ''; ?>";
      const datefrom = document.getElementById('freight_datefrom').value;
      const dateto = document.getElementById('freight_dateto').value;

      try {
        const res = await fetch(`/Dash/datafetcher/reports_getdata.php?action=freight&datefrom=${encodeURIComponent(datefrom)}&dateto=${encodeURIComponent(dateto)}&companyid=${companyid}&siteid=${siteid}`);
        const data = await res.json();

        const wb = XLSX.utils.book_new();

        for (const sheetName in data) {
          if (Array.isArray(data[sheetName])) {
            const ws = XLSX.utils.json_to_sheet(data[sheetName]);
            XLSX.utils.book_append_sheet(wb, ws, sheetName);
          }
        }

        XLSX.writeFile(wb, "Freight_Report.xlsx");
      } catch (err) {
        console.error(err);
        alert("Export failed!");
      } finally {
        hideLoading(); // Hide spinner
      }
    }


      async function crossdock() {
      showLoading(); // Show spinner
      const companyid = "<?php echo $_SESSION['Company_ID'] ?? ''; ?>";
      const siteid    = "<?php echo $_SESSION['SITE_ID'] ?? ''; ?>";
      const datefrom = document.getElementById('cdockfrom').value;
      const dateto = document.getElementById('cdockto').value;

      try {
        const res = await fetch(`/Dash/datafetcher/reports_getdata.php?action=crossdock&datefrom=${encodeURIComponent(datefrom)}&dateto=${encodeURIComponent(dateto)}&companyid=${companyid}&siteid=${siteid}`);
        const data = await res.json();

        const wb = XLSX.utils.book_new();

        for (const sheetName in data) {
          if (Array.isArray(data[sheetName])) {
            const ws = XLSX.utils.json_to_sheet(data[sheetName]);
            XLSX.utils.book_append_sheet(wb, ws, sheetName);
          }
        }

        XLSX.writeFile(wb, "CrossDock_Report.xlsx");
      } catch (err) {
        console.error(err);
        alert("Export failed!");
      } finally {
        hideLoading(); // Hide spinner
      }
    }

  </script>
</body>
</html>