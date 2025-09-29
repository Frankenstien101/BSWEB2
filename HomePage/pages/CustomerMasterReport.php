<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Customer Master</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" />
    <style>
        #pagination {
            overflow-x: auto;
            white-space: nowrap;
        }
        #pagination .page-item {
            flex: 0 0 auto;
        }
        .card-body-scroll {
            overflow-y: auto;
            max-width: 100%;
            height: 600px;
        }
        table {
            table-layout: auto;
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            padding: 4px 8px;
        }
        .table-container {
            overflow-x: auto;
        }
    </style>
</head>
<body>
    <h3>CUSTOMER MASTER</h3>

    <!-- Table Card -->
    <div class="card text-bg-light" style="max-width: 100%; height:600px; margin-bottom: .5rem; font-size: 10px;">
        <div class="card-header">Customer List</div>
        <div class="card-body card-body-scroll">
            <table id="itemsTable" class="table table-striped table-hover table-bordered table-sm" style="font-size: 10px;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>LINE ID</th>
                        <th>COMPANY ID</th>
                        <th>SITE ID</th>
                        <th>CHANNEL</th>
                        <th>SUB CHANNEL</th>
                        <th>SELLER ID</th>
                        <th>SELLER NAME</th>
                        <th>STORE CODE</th>
                        <th>STORE TYPE</th>
                        <th>CUSTOMER NAME</th>
                        <th>DESCRIPTION</th>
                        <th>ADDRESS</th>
                        <th>BARANGAY</th>
                        <th>CITY</th>
                        <th>PROVINCE</th>
                        <th>RETAILER TYPE</th>
                        <th>FREQUENCY</th>
                        <th>LATITUDE</th>
                        <th>LONGITUDE</th>
                        <th>CREDIT LIMIT</th>
                        <th>TAX</th>
                        <th>VAT</th>
                        <th>CATEGORY</th>
                        <th>IS COVERAGE</th>
                        <th>DISCOUNT</th>
                        <th>CREDIT TERMS</th>
                        <th>DAYS</th>
                        <th>CUSTOMER STATUS</th>
                        <th>BGY LAT</th>
                        <th>BGY LONG</th>
                        <th>BGY CODE</th>
                        <th>BGY NAME</th>
                        <th>MUN NAME</th>
                        <th>PRO NAME</th>
                        <th>REG NAME</th>
                    </tr>
                </thead>
                <tbody><!-- Filled dynamically --></tbody>
            </table>
        </div>
    </div>

    <!-- Pagination Card -->
    <div class="card bg-light" style="max-width: 100%; margin-bottom: .5rem; font-size: 10px;">
        <div class="card-header">Page</div>
        <div class="card-body p-2" style="overflow-x: auto; max-width: 100%; white-space: nowrap;">
            <nav style="display: inline-block;">
                <ul id="pagination" class="pagination pagination-sm mb-0" style="display: inline-flex; flex-wrap: nowrap;"></ul>
            </nav>
        </div>
    </div>

    <!-- Export Button -->
    <div class="text-right mb-0">
        <button class="btn btn-success btn-sm mb-2" onclick="exportToCSV()">Export to CSV</button>
        <button class="btn btn-success btn-sm mb-2" onclick="exportToCSVgpformat()">Export Golden Point Format</button>

    
    </div>

    <!-- Loader -->
    <div id="loading" style="
        position: fixed;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(255, 255, 255, 0.8);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 9999;">
        <div style="text-align:center;">
            <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
            <div style="margin-top:10px;">Loading Data...</div>
        </div>
    </div>

    <script>
        let loadedPOs = [];
        let totalRecords = 0;
        let rowsPerPage = 100;
        let currentPage = 1;

        function showLoader() {
            document.getElementById("loading").style.display = "flex";
        }
        function hideLoader() {
            document.getElementById("loading").style.display = "none";
        }

        document.addEventListener("DOMContentLoaded", function () {
            loadItems(currentPage);
        });

        function loadItems(page) {
            const companyId = "<?php echo $_SESSION['COMPANY_ID'] ?? '5'; ?>";
            showLoader();

            fetch(`/HomePage/datafetcher/reports/getdatareports.php?action=loadcustomers&company=${companyId}&page=${page}&limit=${rowsPerPage}`)
                .then(res => res.json())
                .then(res => {
                    if (res.error) throw new Error(res.message);
                    totalRecords = res.total;
                    loadedPOs = res.data;
                    renderTable(loadedPOs);
                    renderPagination();
                })
                .catch(err => console.error(err))
                .finally(() => hideLoader());
        }

        function renderTable(data) {
            const tbody = document.querySelector('#itemsTable tbody');
            tbody.innerHTML = '';
            data.forEach((item, index) => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${(currentPage - 1) * rowsPerPage + index + 1}</td>
                    <td>${item.LINEID || ''}</td>
                    <td>${item.COMPANY_ID || ''}</td>
                    <td>${item.SITE_ID || ''}</td>
                    <td>${item.CHANNEL || ''}</td>
                    <td>${item.SUB_CHANNEL || ''}</td>
                    <td>${item.SELLER_ID || ''}</td>
                    <td>${item.SELLER_NAME || ''}</td>
                    <td>${item.STORE_CODE || ''}</td>
                    <td>${item.STORE_TYPE || ''}</td>
                    <td>${item.CUSTOMER_NAME || ''}</td>
                    <td>${item.DESCRIPTION || ''}</td>
                    <td>${item.ADDRESS || ''}</td>
                    <td>${item.BARANGAY || ''}</td>
                    <td>${item.CITY || ''}</td>
                    <td>${item.PROVINCE || ''}</td>
                    <td>${item.RETAILER_TYPE || ''}</td>
                    <td>${item.FREQUENCY || ''}</td>
                    <td>${item.LATITUDE || ''}</td>
                    <td>${item.LONGITUDE || ''}</td>
                    <td>${item.CREDIT_LIMIT || ''}</td>
                    <td>${item.TAX || ''}</td>
                    <td>${item.VAT || ''}</td>
                    <td>${item.CATEGORY || ''}</td>
                    <td>${item.IS_COVERAGE || ''}</td>
                    <td>${item.DISCOUNT || ''}</td>
                    <td>${item.CREDIT_TERMS || ''}</td>
                    <td>${item.DAYS || ''}</td>
                    <td>${item.CUSTOMER_STATUS || ''}</td>
                    <td>${item.BGY_LAT || ''}</td>
                    <td>${item.BGY_LONG || ''}</td>
                    <td>${item.BGY_CODE || ''}</td>
                    <td>${item.BGY_NAME || ''}</td>
                    <td>${item.MUN_NAME || ''}</td>
                    <td>${item.PRO_NAME || ''}</td>
                    <td>${item.REG_NAME || ''}</td>
                `;
                tbody.appendChild(tr);
            });
        }

        function renderPagination() {
            const totalPages = Math.ceil(totalRecords / rowsPerPage);
            const pagination = document.getElementById('pagination');
            pagination.innerHTML = '';

            for (let i = 1; i <= totalPages; i++) {
                const li = document.createElement('li');
                li.className = `page-item ${i === currentPage ? 'active' : ''}`;
                li.innerHTML = `<a class="page-link" href="#">${i}</a>`;
                li.addEventListener('click', (e) => {
                    e.preventDefault();
                    currentPage = i;
                    loadItems(currentPage);
                });
                pagination.appendChild(li);
            }
        }

        // CSV export triggers direct download from PHP
        function exportToCSV() {
            const companyId = "<?php echo $_SESSION['COMPANY_ID'] ?? ''; ?>";
            window.location.href = `/HomePage/datafetcher/reports/getdatareports.php?action=loadcustomers&company=${companyId}&all=true&export=csv`;
        }

                // CSV export triggers direct download from PHP gp format

 function exportToCSVgpformat() {
            const companyId = "<?php echo $_SESSION['COMPANY_ID'] ?? ''; ?>";
            window.location.href = `/HomePage/datafetcher/reports/getdatareports.php?action=loadcustomersgp&company=${companyId}&all=true&export=csv`;
        }

    </script>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
