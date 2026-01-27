<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Devices For Load</title>

    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- SheetJS for Excel export -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

    <style>
        .status-badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 9px;
            font-weight: bold;
            display: inline-block;
            min-width: 60px;
            text-align: center;
        }
        .status-ok {
            background-color: #28a745;
            color: white;
        }
        .status-forload {
            background-color: #dc3545;
            color: white;
        }
        .card-body-scroll {
            height: calc(100% - 32px);
            overflow-y: auto;
        }
    </style>
</head>
<body>

    <div class="container-fluid mt-3">
        <div class="card text-bg-light" style="max-width: 100%; height: 730px; margin-bottom: 0.5rem; font-size: 9px;">
            <div class="card-header d-flex justify-content-between align-items-center py-1 px-2" style="min-height: 32px;">
                <h5 class="mb-0">Devices For Load</h5>
 
            </div>

            <div class="card-body card-body-scroll p-2">
                <table id="itemsTable" class="table table-striped table-hover table-bordered table-sm mb-0" style="font-size: 9px;">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center">#</th>
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
                            <th class="text-right">Balance (GB)</th>
                            <th>Last Load</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="forLoadTable">
                        <tr>
                            <td colspan="14" class="text-center text-muted">Loading...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

               <div class="d-flex align-items-center py-1 px-2" style="min-height: 32px;">
    <button id="exportExcelBtn" class="btn btn-sm btn-success ml-auto" disabled>
        <i class="fas fa-file-excel mr-1"></i> Export to Excel
    </button>
</div>


    <script>
        // Global variable to hold the data for export
        let forLoadDevicesData = [];

        function requestLoad(id, personUsing, number, balance, lastLoad, siteId, btn) {
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
                    SITE_ID: siteId
                })
            })
            .then(res => res.json())
            .then(res => {
                if (res.status === 'success') {
                    alert(`Load status updated: ${res.load_status}`);
                    loadForLoadDevices();
                } else {
                    alert('Error: ' + (res.message || 'Unknown error'));
                    btn.disabled = false;
                }
            })
            .catch(err => {
                console.error(err);
                alert('Server error');
                btn.disabled = false;
            });
        }

        function loadForLoadDevices() {
            const tbody = document.getElementById('forLoadTable');
            const exportBtn = document.getElementById('exportExcelBtn');

            tbody.innerHTML = `<tr><td colspan="14" class="text-center text-muted">Loading...</td></tr>`;
            exportBtn.disabled = true;

            fetch('/LM/datafetcher/loadcheckingdata.php?action=forload')
                .then(res => res.json())
                .then(data => {
                    forLoadDevicesData = data || [];

                    if (!data || data.length === 0) {
                        tbody.innerHTML = `<tr><td colspan="14" class="text-center text-muted">No devices for load</td></tr>`;
                        return;
                    }

                    tbody.innerHTML = '';
                    data.forEach((item, index) => {
                        const statusClass = item.LOAD_STATUS === 'FOR LOAD' ? 'status-forload' : 'status-ok';

                        const tr = document.createElement('tr');
                        tr.innerHTML = `
                            <td class="text-center">${index + 1}</td>
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
                            <td class="text-right">${Number(item.BALANCE ?? 0).toFixed(2)}</td>
                            <td>${item.LAST_LOAD_HISTORY ?? ''}</td>
                            <td><span class="status-badge ${statusClass}">${item.LOAD_STATUS || '—'}</span></td>
                        `;
                        tbody.appendChild(tr);
                    });

                    exportBtn.disabled = false;
                })
                .catch(err => {
                    console.error(err);
                    tbody.innerHTML = `<tr><td colspan="14" class="text-center text-danger">Failed to load devices</td></tr>`;
                });
        }

        function exportToExcel() {
            if (!forLoadDevicesData || forLoadDevicesData.length === 0) {
                alert("No data available to export.");
                return;
            }

            const exportData = forLoadDevicesData.map((item, index) => ({
                "#": index + 1,
                "Site": item.SITE_ID || "",
                "Department": item.DEPARTMENT || "",
                "Principal": item.PRINCIPAL || "",
                "Position": item.POSITION || "",
                "Brand": item.BRAND || "",
                "Model": item.MODEL || "",
                "Serial": item.SERIAL || "",
                "Date Deployed": item.DATE_DEPLOYED || "",
                "User": item.PERSON_USING || "",
                "Number": item.NUMBER || "",
                "Balance (GB)": Number(item.BALANCE ?? 0).toFixed(2),
                "Last Load": item.LAST_LOAD_HISTORY || "",
                "Status": item.LOAD_STATUS || ""
            }));

            const ws = XLSX.utils.json_to_sheet(exportData);

            // Auto-size columns (basic)
            const colWidths = [];
            Object.keys(exportData[0] || {}).forEach((key, i) => {
                let maxLen = String(key).length;
                exportData.forEach(row => {
                    const val = String(row[key] || "");
                    if (val.length > maxLen) maxLen = val.length;
                });
                colWidths[i] = { wch: Math.min(maxLen + 3, 45) };
            });
            ws['!cols'] = colWidths;

            const wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, "Devices For Load");

            const today = new Date().toISOString().slice(0,10).replace(/-/g, '');
            XLSX.writeFile(wb, `Devices_For_Load_${today}.xlsx`);
        }

        // Bind export button
        document.getElementById('exportExcelBtn')?.addEventListener('click', exportToExcel);

        // Initial load
        document.addEventListener('DOMContentLoaded', loadForLoadDevices);
    </script>

</body>
</html>