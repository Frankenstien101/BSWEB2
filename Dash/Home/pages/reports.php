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

  <div class="container-fluid p-0 m-0">
    <!-- === FIRST ROW === -->
    <div class="d-flex flex-row flex-wrap justify-content-start m-0 p-0 row-no-margin">
      <!-- DELIVERY PLAN -->
      <div class="card text-bg-light" style="width: 240px;">
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
      <div class="card text-bg-light" style="width: 240px;">
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
          <button class="btn btn-success btn-sm" onclick="orderpreps()">GENERATE</button>
        </div>
      </div>
    </div>

    <!-- === SECOND ROW === -->
    <div class="d-flex flex-row flex-wrap justify-content-start m-0 p-0 mt-3 row-no-margin">
      <!-- SO REPORT -->
      <div class="card text-bg-light" style="width: 240px;">
        <div class="card-header d-flex align-items-center p-2">
          <span>SO REPORT</span>
          <div class="ml-auto d-flex align-items-center">
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

      <!-- DELIVERY RESULT -->
      <div class="card text-bg-light" style="width: 240px;">
        <div class="card-header d-flex align-items-center p-2">
          <span>DELIVERY RESULT</span>
          <div class="ml-auto d-flex align-items-center">
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

    <!-- === THIRD ROW === -->
    <div class="d-flex flex-row flex-wrap justify-content-start m-0 p-0 mt-3 row-no-margin">
      <!-- DELIVERY PERFORMANCE -->
      <div class="card text-bg-light" style="width: 240px;">
        <div class="card-header d-flex align-items-center p-2">
          <span>DELIVERY PERFORMANCE</span>
          <div class="ml-auto d-flex align-items-center">
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

      <!-- PERFORMANCE DETAILED -->
      <div class="card text-bg-light" style="width: 240px;">
        <div class="card-header d-flex align-items-center p-2">
          <span>PERFORMANCE DETAILED</span>
          <div class="ml-auto d-flex align-items-center">
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

    <!-- === FOURTH ROW === -->
    <div class="d-flex justify-content-start flex-wrap m-0 p-0 mt-3 row-no-margin">
      <!-- FREIGHT REPORT -->
      <div class="card text-bg-light" style="width: 240px;">
        <div class="card-header d-flex align-items-center p-2">
          <span>FREIGHT REPORT</span>
          <div class="ml-auto d-flex align-items-center">
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

      <!-- CROSSDOCK REPORT -->
      <div class="card text-bg-light" style="width: 240px;">
        <div class="card-header d-flex align-items-center p-2">
          <span>CROSSDOCK REPORT</span>
          <div class="ml-auto d-flex align-items-center">
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

  <!-- Bootstrap JS and jQuery -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    // Configure the backend URL (adjust if needed)
    const baseUrl = '/Dash/datafetcher/reports_getdata.php';

    // Generate a unique progress key
    function generateProgressKey() {
      return 'report_' + Math.random().toString(36).substr(2, 9) + '_' + Date.now();
    }

    // Poll backend for progress
    function pollProgress(progressKey, callback) {
      const checkProgress = () => {
        $.ajax({
          url: baseUrl,
          method: 'GET',
          data: { action: 'progress', key: progressKey },
          dataType: 'json',
          xhrFields: { withCredentials: true },
          success: function(response) {
            console.log('Progress response:', response);
            if (!response.success) {
              $('#progressBar').removeClass('progress-bar-animated bg-success').addClass('bg-danger');
              $('#progressBar').css('width', '100%').text('Error');
              $('#progressMessage').text(response.progress.message || 'An error occurred.');
              setTimeout(() => $('#progressModal').modal('hide'), 3000);
              return;
            }
            const progress = response.progress;
            $('#progressBar').css('width', progress.percent + '%').text(progress.percent + '%');
            $('#progressMessage').text(progress.message || 'Please wait while we generate your report.');
            if (progress.status === 'done' && progress.download_url && progress.file) {
              $('#progressBar').removeClass('progress-bar-animated');
              // Fetch the file as a blob for better compatibility
              fetch(progress.download_url, { credentials: 'include' })
                .then(response => {
                  if (!response.ok) throw new Error('Network response was not ok');
                  return response.blob();
                })
                .then(blob => {
                  const link = document.createElement('a');
                  link.href = window.URL.createObjectURL(blob);
                  link.download = progress.file;
                  document.body.appendChild(link);
                  link.click();
                  document.body.removeChild(link);
                  window.URL.revokeObjectURL(link.href);
                  $('#progressMessage').text('Downloading: ' + progress.file);
                  setTimeout(() => $('#progressModal').modal('hide'), 1000);
                  callback && callback();
                })
                .catch(error => {
                  console.error('Download error:', error);
                  $('#progressBar').removeClass('progress-bar-animated bg-success').addClass('bg-danger');
                  $('#progressMessage').text('Failed to download file: ' + error.message);
                  setTimeout(() => $('#progressModal').modal('hide'), 3000);
                });
            } else if (progress.status === 'error') {
              $('#progressBar').removeClass('progress-bar-animated bg-success').addClass('bg-danger');
              $('#progressMessage').text(progress.message || 'An error occurred.');
              setTimeout(() => $('#progressModal').modal('hide'), 3000);
            } else {
              setTimeout(checkProgress, 1000);
            }
          },
          error: function(xhr, status, error) {
            console.error('Progress fetch error:', status, error, xhr.responseText);
            $('#progressBar').removeClass('progress-bar-animated bg-success').addClass('bg-danger');
            $('#progressBar').css('width', '100%').text('Error');
            $('#progressMessage').text('Failed to fetch progress: ' + error);
            setTimeout(() => $('#progressModal').modal('hide'), 3000);
          }
        });
      };
      checkProgress();
    }

    // Modified triggerDownload
    function triggerDownload(url, progressKey) {
      showProgress(progressKey);
      $.ajax({
        url: url,
        method: 'GET',
        dataType: 'json',
        xhrFields: { withCredentials: true },
        success: function(response) {
          console.log('Report generation response:', response);
          if (!response.success) {
            $('#progressBar').removeClass('progress-bar-animated bg-success').addClass('bg-danger');
            $('#progressBar').css('width', '100%').text('Error');
            $('#progressMessage').text(response.message || 'Failed to generate report.');
            setTimeout(() => $('#progressModal').modal('hide'), 3000);
          }
        },
        error: function(xhr, status, error) {
          console.error('Report generation error:', status, error, xhr.responseText);
          $('#progressBar').removeClass('progress-bar-animated bg-success').addClass('bg-danger');
          $('#progressBar').css('width', '100%').text('Error');
          $('#progressMessage').text('Failed to start report generation: ' + error);
          setTimeout(() => $('#progressModal').modal('hide'), 3000);
        }
      });
    }

    // Show progress modal
    function showProgress(progressKey) {
      $('#progressModal').modal('show');
      $('#progressBar').css('width', '0%').text('0%').addClass('progress-bar-animated bg-success');
      $('#progressMessage').text('Please wait while we generate your report.');
      pollProgress(progressKey);
    }

    // Handle ARIA-hidden for modal
    $(document).ready(function() {
      $('#progressModal').on('show.bs.modal', function () {
        $(this).attr('aria-hidden', 'false');
      });
      $('#progressModal').on('hide.bs.modal', function () {
        $(this).attr('aria-hidden', 'true');
      });
    });

    // === JS Functions for each button ===
    function exportMultiSheet() {
      const companyid = "<?php echo $_SESSION['Company_ID'] ?? ''; ?>";
      const siteid = "<?php echo $_SESSION['SITE_ID'] ?? ''; ?>";
      const datefrom = document.getElementById('delperformancedtfrom').value;
      const dateto = document.getElementById('delperformancedtto').value;
      const progressKey = generateProgressKey();
      const url = `${baseUrl}?action=loadagents&datefrom=${datefrom}&dateto=${dateto}&companyid=${companyid}&siteid=${siteid}&progress_key=${progressKey}`;
      triggerDownload(url, progressKey);
    }

    function exportMultiSheetdetailed() {
      const companyid = "<?php echo $_SESSION['Company_ID'] ?? ''; ?>";
      const siteid = "<?php echo $_SESSION['SITE_ID'] ?? ''; ?>";
      const datefrom = document.getElementById('perffrom').value;
      const dateto = document.getElementById('perfto').value;
      const progressKey = generateProgressKey();
      const url = `${baseUrl}?action=loadagentsdetailed&datefrom=${datefrom}&dateto=${dateto}&companyid=${companyid}&siteid=${siteid}&progress_key=${progressKey}`;
      triggerDownload(url, progressKey);
    }

    function exportsoreport() {
      const companyid = "<?php echo $_SESSION['Company_ID'] ?? ''; ?>";
      const siteid = "<?php echo $_SESSION['SITE_ID'] ?? ''; ?>";
      const datefrom = document.getElementById('soreportdatefrom').value;
      const dateto = document.getElementById('soreportdateto').value;
      const progressKey = generateProgressKey();
      const url = `${baseUrl}?action=soreport&datefrom=${datefrom}&dateto=${dateto}&companyid=${companyid}&siteid=${siteid}&progress_key=${progressKey}`;
      triggerDownload(url, progressKey);
    }

    function deliveryplan() {
      const isall = document.getElementById('deliveryPlanAllSites').checked;
      const companyid = "<?php echo $_SESSION['Company_ID'] ?? ''; ?>";
      const siteid = "<?php echo $_SESSION['SITE_ID'] ?? ''; ?>";
      const datefrom = document.getElementById('delivery_datefrom').value;
      const dateto = document.getElementById('delivery_dateto').value;
      const progressKey = generateProgressKey();
      const url = `${baseUrl}?action=deliveryplan&datefrom=${datefrom}&dateto=${dateto}&companyid=${companyid}&siteid=${siteid}&isall=${isall}&progress_key=${progressKey}`;
      triggerDownload(url, progressKey);
    }

    function exportdeliveryresult() {
      const companyid = "<?php echo $_SESSION['Company_ID'] ?? ''; ?>";
      const siteid = "<?php echo $_SESSION['SITE_ID'] ?? ''; ?>";
      const datefrom = document.getElementById('resultdtfrom').value;
      const dateto = document.getElementById('resultdtto').value;
      const progressKey = generateProgressKey();
      const url = `${baseUrl}?action=result&datefrom=${datefrom}&dateto=${dateto}&companyid=${companyid}&siteid=${siteid}&progress_key=${progressKey}`;
      triggerDownload(url, progressKey);
    }

    function orderpreps() {
      const isall = document.getElementById('orderPlanAllSites').checked;
      const companyid = "<?php echo $_SESSION['Company_ID'] ?? ''; ?>";
      const siteid = "<?php echo $_SESSION['SITE_ID'] ?? ''; ?>";
      const datefrom = document.getElementById('order_datefrom').value;
      const dateto = document.getElementById('order_dateto').value;
      const progressKey = generateProgressKey();
      const url = `${baseUrl}?action=orderprep&datefrom=${datefrom}&dateto=${dateto}&companyid=${companyid}&siteid=${siteid}&isall=${isall}&progress_key=${progressKey}`;
      triggerDownload(url, progressKey);
    }

    function freightreport() {
      const companyid = "<?php echo $_SESSION['Company_ID'] ?? ''; ?>";
      const siteid = "<?php echo $_SESSION['SITE_ID'] ?? ''; ?>";
      const datefrom = document.getElementById('freight_datefrom').value;
      const dateto = document.getElementById('freight_dateto').value;
      const progressKey = generateProgressKey();
      const url = `${baseUrl}?action=freight&datefrom=${datefrom}&dateto=${dateto}&companyid=${companyid}&siteid=${siteid}&progress_key=${progressKey}`;
      triggerDownload(url, progressKey);
    }

    function crossdock() {
      const companyid = "<?php echo $_SESSION['Company_ID'] ?? ''; ?>";
      const siteid = "<?php echo $_SESSION['SITE_ID'] ?? ''; ?>";
      const datefrom = document.getElementById('cdockfrom').value;
      const dateto = document.getElementById('cdockto').value;
      const progressKey = generateProgressKey();
      const url = `${baseUrl}?action=crossdock&datefrom=${datefrom}&dateto=${dateto}&companyid=${companyid}&siteid=${siteid}&progress_key=${progressKey}`;
      triggerDownload(url, progressKey);
    }
  </script>
</body>
</html>