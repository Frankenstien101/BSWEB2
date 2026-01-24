<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Devices For Load</title>

<!-- Bootstrap 4 & FontAwesome -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>
<body>

    <div class="">
        <h4>Devices For Load</h4>
    </div>

    <div class="card text-bg-light" style="max-width: 100%; height: 750px; margin-bottom: 0.5rem; font-size: 9px;">
    <div class="card-header d-flex justify-content-between align-items-center py-1 px-2" style="min-height: 32px;">

    </div>

   <div class="card-body card-body-scroll p-2" style="height: calc(100% - 32px); overflow-y: auto;">
        <table id="itemsTable" class="table table-striped table-hover table-bordered table-sm mb-0" style="font-size: 9px;">
            <thead>
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
</div>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
function requestLoad(id, personUsing, number, balance, lastLoad, siteId, btn) {
    // Disable the button immediately
    btn.disabled = true;

    fetch(`/LM/datafetcher/load_request.php?action=loadrequest`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ 
            device_id: id, 
            person_using: personUsing, 
            number: number, 
            balance: balance, 
            last_load: lastLoad,
            SITE_ID: siteId  // include SITE_ID
        })
    })
    .then(res => res.json())
    .then(res => {
        if (res.status === 'success') {
            alert(`Load status updated: ${res.load_status}`);
            loadForLoadDevices();
        } else {
            alert('Error: ' + res.message);
            btn.disabled = false; // Re-enable button if error
        }
    })
    .catch(err => {
        console.error(err);
        alert('Server error');
        btn.disabled = false; // Re-enable button if server error
    });
}

// Updated table row button call to include SITE_ID
function loadForLoadDevices() {
    const tbody = document.getElementById('forLoadTable');
    tbody.innerHTML = `<tr><td colspan="15" class="text-center text-muted">Loading...</td></tr>`;

    fetch('/LM/datafetcher/loadcheckingdata.php?action=forload')
        .then(res => res.json())
        .then(data => {
            if (!data || data.length === 0) {
                tbody.innerHTML = `<tr><td colspan="15" class="text-center text-muted">No devices for load</td></tr>`;
                return;
            }

            tbody.innerHTML = '';
            data.forEach((item, index) => {
                const statusClass = item.LOAD_STATUS === 'FOR LOAD' ? 'status-forload' : 'status-ok';

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
                   
                `;
                tbody.appendChild(tr);
            });
        })
        .catch(err => {
            console.error(err);
            tbody.innerHTML = `<tr><td colspan="15" class="text-center text-danger">Failed to load devices</td></tr>`;
        });
}

document.addEventListener('DOMContentLoaded', loadForLoadDevices);
</script>



</body>
</html>
