<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Devices For Load</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        .status-forload { background: #fff3cd; color: #856404; padding: 3px 8px; border-radius: 4px; }
        .status-ok     { background: #d4edda; color: #155724; padding: 3px 8px; border-radius: 4px; }
        .status-badge  { font-size: 9px; font-weight: 500; }
        .btn-sm { font-size: 9px; padding: 3px 8px; }
    </style>
</head>
<body class="p-3">

    <h4 class="mb-3">LOAD PURCHASING</h4>

    <div class="card text-bg-light shadow-sm" style="max-width: 100%; height: 750px; margin-bottom: 0.5rem; font-size: 9px;">
        <div class="card-header d-flex justify-content-between align-items-center py-1 px-2" style="min-height: 32px;">
     <div class="input-group input-group-sm" style="max-width: 320px;">
            <div class="input-group-prepend">
                <span class="input-group-text bg-white border-right-0">
                    <i class="fas fa-search text-muted"></i>
                </span>
            </div>
            <input type="text" 
                   id="searchInput" 
                   class="form-control border-left-0" 
                   placeholder="Search site, user, number, serial..." 
                   autocomplete="off">
        </div>

    </div>

        <div class="card-body card-body-scroll p-2" style="height: calc(100% - 32px); overflow-y: auto;">
            <table id="itemsTable" class="table table-striped table-hover table-bordered table-sm mb-0" style="font-size: 9px;">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Site</th>
                        <th>Department</th>
                        <th>Principal</th>
                        <th>Position</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Serial</th>
                        <th>Date Deployed</th>
                        <th>User</th>
                        <th>Number</th>
                        <th>Balance (GB)</th>
                        <th>Last Load</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="forLoadTable">
                    <tr>
                        <td colspan="15" class="text-center text-muted">Loading...</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="purchaseLoadModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header py-2">
                    <h6 class="modal-title" id="modalTitle">Purchase Load</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="purchaseForm">
                        <input type="hidden" id="modal_device_id">
                        <input type="hidden" id="modal_site_id">

                        <div class="form-group mb-2">
                            <label class="small mb-1">Mobile Number</label>
                            <input type="text" class="form-control form-control-sm" id="modal_number" readonly>
                        </div>

                        <div class="form-group mb-2">
                            <label class="small mb-1">Current Balance (GB)</label>
                            <input type="text" class="form-control form-control-sm" id="modal_balance" readonly>
                        </div>

                        <div class="form-group mb-2">
                            <label class="small mb-1">Amount Purchased (₱) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" min="1" class="form-control form-control-sm" id="amount" required>
                        </div>

                        <div class="form-group mb-2">
                            <label class="small mb-1">Data Added<span class="text-danger">*</span></label>
                            <input type="number" step="0.01" min="1" class="form-control form-control-sm" id="dataadded" required>
                        </div>

                        <div class="form-group mb-2">
                            <label class="small mb-1">Reference / Transaction ID <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm" id="reference" required placeholder="e.g. GCASH-123456789">
                        </div>

                        <div class="form-group mb-1">
                            <label class="small mb-1">Date / Time</label>
                            <input type="datetime-local" class="form-control form-control-sm" id="load_date" value="">
                        </div>
                    </form>
                </div>
                <div class="modal-footer py-2">
                    <button type="button" class="btn btn-secondary btn-md" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-md" id="btnConfirmPurchase">Confirm Purchase</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    let currentRowData = null;

    function loadForLoadDevices() {
        const tbody = document.getElementById('forLoadTable');
        tbody.innerHTML = `<tr><td colspan="15" class="text-center text-muted">Loading...</td></tr>`;

        fetch('/LM/datafetcher/loadcheckingdata.php?action=forload')
            .then(res => res.json())
            .then(data => {
                if (!data || data.length === 0) {
                    tbody.innerHTML = `<tr><td colspan="15" class="text-center text-muted">No devices need load</td></tr>`;
                    return;
                }

                tbody.innerHTML = '';
                data.forEach((item, index) => {
                    const statusClass = item.LOAD_STATUS === 'FOR LOAD' ? 'status-forload' : 'status-ok';
                    const canPurchase = item.LOAD_STATUS === 'FOR LOAD';

                    const actionCell = canPurchase 
                        ? `<button class="btn btn-primary btn-sm" onclick="openPurchaseModal(${item.id}, '${item.PERSON_USING || ''}', '${item.NUMBER || ''}', '${item.BALANCE ?? ''}', '${item.SITE_ID || ''}', this)">
                             Purchase Load
                           </button>`
                        : `<span class="text-muted">—</span>`;

                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${index + 1}</td>
                        <td>${item.SITE_ID || ''}</td>
                        <td>${item.DEPARTMENT || ''}</td>
                        <td>${item.PRINCIPAL || ''}</td>
                        <td>${item.POSITION || ''}</td>
                        <td>${item.BRAND || ''}</td>
                        <td>${item.MODEL || ''}</td>
                        <td>${item.SERIAL || ''}</td>
                        <td>${item.DATE_DEPLOYED || ''}</td>
                        <td>${item.PERSON_USING || ''}</td>
                        <td>${item.NUMBER || ''}</td>
                        <td>${item.BALANCE ?? ''}</td>
                        <td>${item.LAST_LOAD_HISTORY ?? ''}</td>
                        <td><span class="status-badge ${statusClass}">${item.LOAD_STATUS}</span></td>
                        <td>${actionCell}</td>
                    `;
                    tbody.appendChild(tr);
                });
            })
            .catch(err => {
                console.error(err);
                tbody.innerHTML = `<tr><td colspan="15" class="text-center text-danger">Failed to load data</td></tr>`;
            });
    }

    function openPurchaseModal(deviceId, user, number, balance, siteId, btn) {
        currentRowData = { deviceId, user, number, balance, siteId };

        document.getElementById('modal_device_id').value = deviceId;
        document.getElementById('modal_site_id').value    = siteId;
        document.getElementById('modal_number').value     = number;
        document.getElementById('modal_balance').value    = balance;

        const now = new Date();
        now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
        document.getElementById('load_date').value = now.toISOString().slice(0,16);

        $('#purchaseLoadModal').modal('show');
    }

    document.getElementById('btnConfirmPurchase').addEventListener('click', function() {
        const amount    = document.getElementById('amount').value.trim();
        const reference = document.getElementById('reference').value.trim();
        const loadDate  = document.getElementById('load_date').value;
        const dataadded  = document.getElementById('dataadded').value;

        if (!amount || parseFloat(amount) <= 0) {
            alert('Please enter a valid purchase amount.');
            return;
        }
        if (!reference) {
            alert('Please enter the reference / transaction ID.');
            return;
        }

        if (!dataadded) {
            alert('Please enter the data added.');
            return;
        }

        const payload = {
            action: 'purchase_load',
            site_id:   currentRowData.siteId,
            device_id: currentRowData.deviceId,
            user: currentRowData.user,
            number: currentRowData.number,
            amount:    parseFloat(amount),
            reference: reference,
            dataadded: dataadded,
            load_date: loadDate || null
        };

        this.disabled = true;
        this.innerText = "Saving...";

        fetch('/LM/datafetcher/loadpurchaseddata.php?action=addtopurchased', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        })
        .then(res => res.json())
        .then(res => {
            if (res.status === 'success') {
               // alert('Load purchase recorded successfully!');
                $('#purchaseLoadModal').modal('hide');
                loadForLoadDevices(); 
            } else {
                alert('Error: ' + (res.message || 'Unknown error'));
            }
        })
        .catch(err => {
            console.error(err);
            alert('Server connection error');
        })
        .finally(() => {
            this.disabled = false;
            this.innerText = "Confirm Purchase";
        });
    });

   document.addEventListener('DOMContentLoaded', function() {
    loadForLoadDevices();
    initTableSearch();   
});

    function initTableSearch() {
    const searchInput = document.getElementById('searchInput');
    if (!searchInput) return;

    searchInput.addEventListener('input', function() {
        const filter = this.value.toLowerCase().trim();
        const rows = document.querySelectorAll('#forLoadTable tr');

        rows.forEach(row => {
       
            if (row.cells.length === 1) return;

            const cells = row.querySelectorAll('td');
            let match = false;
            const columnsToSearch = [1, 2, 3, 9, 10, 7, 6]; 

            for (let idx of columnsToSearch) {
                if (cells[idx] && cells[idx].textContent.toLowerCase().includes(filter)) {
                    match = true;
                    break;
                }
            }

            row.style.display = match ? '' : 'none';
        });
    });
}

    </script>

</body>
</html>