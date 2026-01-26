<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<title>Load Checking</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" />

<style>
    .card-body-scroll { overflow-y: auto; max-width: 100%; height: 600px; }
    table { table-layout: auto; width: 100%; border-collapse: collapse; }
    table th, table td { white-space: nowrap; overflow: hidden; text-overflow: ellipsis; padding: 4px 8px; }
    .table-container::-webkit-scrollbar { width: 6px; height: 6px; }
    .table-container::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 3px; }
    .table-container::-webkit-scrollbar-thumb { background: #888; border-radius: 3px; }
    .table-container::-webkit-scrollbar-thumb:hover { background: #555; }
    .card { border: 1px solid #dee2e6; box-shadow: 0 2px 4px rgba(0,0,0,0.1); border-radius: 8px; }
    .card-header { background-color: #e9ecef; font-weight: 600; padding: 6px 10px; font-size: 9px; }
    .error-message { color: red; font-size: 9px; margin-top: 5px; }
    .success-message { color: green; font-size: 9px; margin-top: 5px; }
    @media (max-width: 768px) { 
        .card { width: 100% !important; } 
    }
    .modern-input {
        border: 1px solid #d1d9e0;
        border-radius: 6px;
        transition: all 0.2s ease;
        font-size: 9.5px !important;
        height: 28px;
        padding: 4px 10px;
    }
    .modern-input:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        outline: none;
    }
    .form-check-input:checked {
        background-color: #3b82f6;
        border-color: #3b82f6;
    }
    .card { transition: box-shadow 0.2s; }
    .card:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.08); }
    .text-muted { color: #6b7280 !important; }


    /* Checklist enhancements */
.checklist-radio {
    transform: scale(1.3);
    margin-top: 0.15rem;
    cursor: pointer;
}

.form-check {
    min-width: 60px;
}

.form-check-label {
    user-select: none;
    color: #495057;
}

.form-check-input:checked {
    background-color: #0d6efd;
    border-color: #0d6efd;
}

/* Better spacing on mobile */
@media (max-width: 576px) {
    .d-flex.gap-5 {
        gap: 3rem !important;
    }
    .checklist-radio {
        transform: scale(1.4);
    }
}

</style>
</head>
<body>
<h3>LOAD CHECKING RESULT</h3>
<div class="card text-bg-light" style="max-width: 100%; height: 750px; margin-bottom: 0.5rem; font-size: 9px;">

    <!-- CARD HEADER -->
    <div class="card-header d-flex align-items-center justify-content-between py-1 px-2" style="min-height:32px;">
        
        <div class="d-flex align-items-end gap-2">
            <div class="form-group mb-0">
                <input type="date" id="datefrom"
                       class="form-control form-control-sm"
                       value="<?php echo date('Y-m-d'); ?>">
            </div>

            <div class="form-group mb-0 ml-2">
                <input type="date" id="dateto"
                       class="form-control form-control-sm"
                       value="<?php echo date('Y-m-d'); ?>">
            </div>

            <button class="btn btn-primary btn-sm px-3 ml-2" onclick="loaddeviceschecked()">
                <i class="fas fa-filter mr-1"></i> Generate
            </button>
        </div>

    </div>

    <!-- CARD BODY -->
    <div class="card-body card-body-scroll p-2" style="height: calc(100% - 32px); overflow-y: auto;">
        <table id="itemsTable"
               class="table table-striped table-hover table-bordered table-sm mb-0"
               style="font-size: 9px;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>SITE</th>
                    <th>DATE</th>
                    <th>USER</th>
                    <th>NUMBER</th>
                    <th>DATA BALANCE</th>
                    <th>IS SUBMITTED</th>
                    <th>IS PHYSICALLY OK</th>
                    <th>HAS GAMES</th>
                    <th>IS SYSTEM UPDATED</th>
                    <th>OTHER ISSUES</th>
                    <th>CHECKED BY</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <!-- MESSAGES -->
    <div id="table-error" class="error-message text-danger small p-1"></div>
    <div id="table-success" class="success-message text-success small p-1"></div>

</div>


<!-- EDIT MODAL -->
<div class="modal fade" id="editDeviceModal" tabindex="-1" role="dialog" aria-labelledby="editDeviceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header border-0 bg-light py-3 px-4">
                <h5 class="modal-title font-weight-bold" id="editDeviceModalLabel" style="font-size: 14px; color: #2c3e50;">
                    Device Submission
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="font-size: 1.4rem;">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body px-4 pb-4 pt-2" style="font-size: 9.5px; background: #f9fafb;">
                <form id="editDeviceForm">
                    <input type="hidden" id="edit_id" name="id">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-1">
                                <label class="font-weight-medium text-muted small" style = "font-size:12px;">Site</label>
                                <input type="text" class="form-control form-control-sm modern-input" id="edit_site" name="SITE_ID">
                            </div>
                            <div class="form-group mb-1">
                                <label class="font-weight-medium text-muted small"style = "font-size:12px;">Department</label>
                                <input type="text" class="form-control form-control-sm modern-input" id="edit_dept" name="DEPARTMENT">
                            </div>
                            <div class="form-group mb-1">
                                <label class="font-weight-medium text-muted small"style = "font-size:12px;">Principal</label>
                                <input type="text" class="form-control form-control-sm modern-input" id="edit_principal" name="PRINCIPAL">
                            </div>
                            <div class="form-group mb-1">
                                <label class="font-weight-medium text-muted small"style = "font-size:12px;">Position</label>
                                <input type="text" class="form-control form-control-sm modern-input" id="edit_position" name="POSITION">
                            </div>
                            <div class="form-group mb-1">
                                <label class="font-weight-medium text-muted small"style = "font-size:12px;">Brand</label>
                                <input type="text" class="form-control form-control-sm modern-input" id="edit_brand" name="BARND">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-1">
                                <label class="font-weight-medium text-muted small"style = "font-size:12px;">Model</label>
                                <input type="text" class="form-control form-control-sm modern-input" id="edit_model" name="MODEL">
                            </div>
                            <div class="form-group mb-1">
                                <label class="font-weight-medium text-muted small"style = "font-size:12px;">IMEI</label>
                                <input type="text" class="form-control form-control-sm modern-input" id="edit_imei" name="IMEI">
                            </div>
                            <div class="form-group mb-1">
                                <label class="font-weight-medium text-muted small"style = "font-size:12px;">Serial</label>
                                <input type="text" class="form-control form-control-sm modern-input" id="edit_serial" name="SERIAL">
                            </div>
                            <div class="form-group mb-1">
                                <label class="font-weight-medium text-muted small"style = "font-size:12px;">Date Deployed</label>
                                <input type="date" class="form-control form-control-sm modern-input" id="edit_date" name="DATE_DEPLOYED">
                            </div>
                            <div class="form-group mb-1">
                                <label class="font-weight-medium text-muted small"style = "font-size:12px;" >Person Using</label>
                                <input type="text" class="form-control form-control-sm modern-input" id="edit_user" name="PERSON_USING">
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="form-group mb-1">
                                <label class="font-weight-medium text-muted small" style = "font-size:12px;">Number</label>
                                <input type="text" class="form-control form-control-sm modern-input" id="edit_number" name="NUMBER">
                            </div>

                            <div class="form-group mb-1">
                                <label class="font-weight-medium text-muted small" style = "font-size:12px;">Data Left <span class="text-primary small">(current balance)</span></label>
                                <input type="number" class="form-control form-control-sm modern-input" id="edit_data_left" name="DATA_LEFT" placeholder="e.g. 1.8" autofocus>
                            </div>

                            <div class="form-group mb-1">
                                <label class="font-weight-medium text-muted small" style = "font-size:12px;">Remarks</label>
                                <textarea class="form-control form-control-sm modern-input" id="edit_remarks" name="REMARKS" rows="2"></textarea>
                            </div>
                        </div>
                    </div>

                  <div class="card border-0 shadow-sm bg-white mb-0" style="border-radius: 10px;">
    <div class="card-body py-4 px-4">

        <div class="row">
            <div class="col-md-6">
                <!-- Question 1 -->
                <div class="form-group mb-0">
                    <label class="font-weight-medium mb-1" style="font-size: 11px; color: #495057;">
                        Data Usage Submitted?
                    </label>
                    <div class="d-flex align-items-center gap-5">
                        <div class="form-check">
                            <input class="form-check-input checklist-radio" type="radio" name="data_submitted" id="data_yes" value="Yes" checked>
                            <label class="form-check-label" for="data_yes" style="font-size: 11px; cursor: pointer;">Yes</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input checklist-radio" type="radio" name="data_submitted" id="data_no" value="No">
                            <label class="form-check-label" for="data_no" style="font-size: 11px; cursor: pointer;">No</label>
                        </div>
                    </div>
                </div>

                <!-- Question 2 -->
                <div class="form-group mb-0">
                    <label class="font-weight-medium mb-2" style="font-size: 11px; color: #495057;">
                        Physically OK?
                    </label>
                    <div class="d-flex align-items-center gap-5">
                        <div class="form-check">
                            <input class="form-check-input checklist-radio" type="radio" name="physically_ok" id="phys_ok_yes" value="Yes" checked>
                            <label class="form-check-label" for="phys_ok_yes" style="font-size: 11px; cursor: pointer;">Yes</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input checklist-radio" type="radio" name="physically_ok" id="phys_ok_no" value="No">
                            <label class="form-check-label" for="phys_ok_no" style="font-size: 11px; cursor: pointer;">No</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <!-- Question 3 -->
                <div class="form-group mb-0">
                    <label class="font-weight-medium mb-2" style="font-size: 11px; color: #495057;">
                        Games Installed / Used?
                    </label>
                    <div class="d-flex align-items-center gap-5">
                        <div class="form-check">
                            <input class="form-check-input checklist-radio" type="radio" name="games" id="games_yes" value="Yes">
                            <label class="form-check-label" for="games_yes" style="font-size: 11px; cursor: pointer;">Yes</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input checklist-radio" type="radio" name="games" id="games_no" value="No" checked>
                            <label class="form-check-label" for="games_no" style="font-size: 11px; cursor: pointer;">No</label>
                        </div>
                    </div>
                </div>

                <!-- Question 4 -->
                <div class="form-group mb-0">
                    <label class="font-weight-medium mb-2" style="font-size: 11px; color: #495057;">
                        System Updated?
                    </label>
                    <div class="d-flex align-items-center gap-5">
                        <div class="form-check">
                            <input class="form-check-input checklist-radio" type="radio" name="system_updated" id="sys_upd_yes" value="Yes" checked>
                            <label class="form-check-label" for="sys_upd_yes" style="font-size: 11px; cursor: pointer;">Yes</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input checklist-radio" type="radio" name="system_updated" id="sys_upd_no" value="No">
                            <label class="form-check-label" for="sys_upd_no" style="font-size: 11px; cursor: pointer;">No</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Other Issues -->
        <div class="form-group mt-3 mb-0">
            <label class="font-weight-medium mb-2" style="font-size: 11px; color: #495057;">
                Other Issues / Notes
            </label>
            <textarea class="form-control modern-input" id="other_issues" name="OTHER_ISSUES" rows="3" 
                      placeholder="Enter any additional observations or comments..." 
                      style="font-size: 11px; resize: vertical;"></textarea>
        </div>
    </div>
</div>
                </form>
            </div>

            <div class="modal-footer border-0 bg-light py-3 px-4">
                <button type="button" class="btn btn-outline-secondary btn-sm px-4" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary btn-sm px-4 shadow-sm" id="btnUpdateOnly">UPDATE ONLY</button>
                <button type="button" class="btn btn-success btn-sm px-4 shadow-sm" id="btnSaveChanges">SET AS SUBMITTED</button>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>

<script>
let loadedPOs = [];

// Helper to safely set radio button
function setRadio(name, value) {
    const radio = document.querySelector(`input[name="${name}"][value="${value}"]`);
    if (radio) {
        radio.checked = true;
    } else {
        // Fallback to default if value not found
        const defaultValue = (name === 'games') ? 'No' : 'Yes';
        const defaultRadio = document.querySelector(`input[name="${name}"][value="${defaultValue}"]`);
        if (defaultRadio) defaultRadio.checked = true;
        console.warn(`Radio not found for ${name}=${value} → defaulted to ${defaultValue}`);
    }
}
function isForLoad(lastLoadDate, balance) {
    // Rule 1: balance below 5GB
    if (Number(balance) < 5) return true;

    // Rule 2: last load 6 months ago
    if (lastLoadDate) {
        const lastLoad = new Date(lastLoadDate);
        const now = new Date();

        if (!isNaN(lastLoad)) {
            const diffMonths =
                (now.getFullYear() - lastLoad.getFullYear()) * 12 +
                (now.getMonth() - lastLoad.getMonth());

            if (diffMonths >= 6) return true;
        }
    }
    return false;
}

function getBalanceColor(balance) {
    const bal = Number(balance);
    if (bal < 1) return 'red';
    if (bal < 5) return 'yellow';
    return 'green';
}

function loaddeviceschecked() {
    // Get parameters
    const companyId = "<?php echo $_SESSION['Company_ID'] ?? ''; ?>";
    const datefrom  = document.getElementById('datefrom').value;
    const dateto    = document.getElementById('dateto').value;

    // Check if table body exists
    const tbody = document.querySelector('#itemsTable tbody');
    if (!tbody) return;

    tbody.innerHTML = ''; 

    tbody.innerHTML = `
        <tr>
            <td colspan="12" class="text-center">Loading...</td>
        </tr>
    `;

    fetch(`/LM/datafetcher/loadcheckingdata.php?action=loadcheckresult&company=${encodeURIComponent(companyId)}&datefrom=${encodeURIComponent(datefrom)}&dateto=${encodeURIComponent(dateto)}`)
        .then(response => {
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            return response.json();
        })
        .then(data => {
            tbody.innerHTML = ''; 

            if (!data || data.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="12" class="text-center">No items found.</td>
                    </tr>
                `;
                return;
            }

            data.forEach((item, index) => {

                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${index + 1}</td>
                    <td>${item.SITE_ID || ''}</td>
                    <td>${item.DATE_CHECKED || ''}</td>
                    <td>${item.USER || ''}</td>
                    <td>${item.NUMBER || ''}</td>
                    <td>${item.LOAD_BALANCE || ''}</td>
                    <td>${item.IS_SUBMIT || ''}</td>
                    <td>${item.IS_PHYSICAL_OK || ''}</td>
                    <td>${item.HAS_GAMES || ''}</td>
                    <td>${item.IS_SYSTEM_UPDATED || ''}</td>
                    <td>${item.OTHER_ISSUES || ''}</td>
                    <td>${item.CHECKED_BY || ''}</td>
                `;
                tbody.appendChild(tr);
            });
        })
        .catch(err => {
            console.error('Error loading items:', err);
            tbody.innerHTML = `
                <tr>
                    <td colspan="12" class="text-center text-danger">Failed to load data.</td>
                </tr>
            `;
        });
}

function exportToExcel() {
    if (!loadedPOs.length) {
        alert("No data to export!");
        return;
    }

    // Convert array of objects to worksheet
    const worksheet = XLSX.utils.json_to_sheet(loadedPOs);

    // Generate CSV content from worksheet
    const csvOutput = XLSX.utils.sheet_to_csv(worksheet);

    // Create a Blob with CSV data
    const blob = new Blob([csvOutput], { type: 'text/csv;charset=utf-8;' });

    // Create a download link and trigger click
    const link = document.createElement("a");
    const url = URL.createObjectURL(blob);
    link.setAttribute("href", url);
    link.setAttribute("download", ".csv");
    link.style.visibility = 'hidden';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    URL.revokeObjectURL(url);
}

</script>

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

</body>
</html>