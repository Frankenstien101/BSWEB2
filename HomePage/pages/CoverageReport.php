<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Coverage Master</title>
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
    <h3>COVERAGE MASTER</h3>

    <!-- Table Card -->
    <div class="card text-bg-light" style="max-width: 100%; height:600px; margin-bottom: .5rem; font-size: 10px;">
        <div class="card-header"></div>
        <div class="card-body card-body-scroll">
            <table id="itemsTable" class="table table-striped table-hover table-bordered table-sm" style="font-size: 10px;">
                <thead>
                  <tr>
  <th>#</th>
  <th>COMPANY ID</th>
  <th>SITE ID</th>
  <th>PROCESS ID</th>
  <th>SELLER ID</th>
  <th>CUSTOMER ID</th>
  <th>CUSTOMER NAME</th>
  <th>ADDRESS</th>
  <th>FREQUENCY</th>
  <th>WEEK 1</th>
  <th>WEEK 2</th>
  <th>WEEK 3</th>
  <th>WEEK 4</th>
  <th>WEEK 5</th>
  <th>MONDAY</th>
  <th>TUESDAY</th>
  <th>WEDNESDAY</th>
  <th>THURSDAY</th>
  <th>FRIDAY</th>
  <th>SATURDAY</th>
  <th>SUNDAY</th>
  <th>STATUS</th>
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
        let rowsPerPage = 3000;
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

            fetch(`/HomePage/datafetcher/reports/getdatareports.php?action=coverage&company=${companyId}&page=${page}&limit=${rowsPerPage}`)
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
                     <td>${item.COMPANY_ID || ''}</td>
                     <td>${item.SITE_ID || ''}</td>
                     <td>${item.PROCESS_ID || ''}</td>
                     <td>${item.SELLER_ID || ''}</td>
                     <td>${item.CUSTOMER_ID || ''}</td>
                     <td>${item.CUSTOMER_NAME || ''}</td>
                     <td>${item.ADDRESS || ''}</td>
                     <td>${item.FREQUENCY || ''}</td>
                     <td>${item.WEEK1 || ''}</td>
                     <td>${item.WEEK2 || ''}</td>
                     <td>${item.WEEK3 || ''}</td>
                     <td>${item.WEEK4 || ''}</td>
                     <td>${item.WEEK5 || ''}</td>
                     <td>${item.MONDAY || ''}</td>
                     <td>${item.TUESDAY || ''}</td>
                     <td>${item.WEDNESDAY || ''}</td>
                     <td>${item.THURSDAY || ''}</td>
                     <td>${item.FRIDAY || ''}</td>
                     <td>${item.SATURDAY || ''}</td>
                     <td>${item.SUNDAY || ''}</td>
                     <td>${item.STATUS || ''}</td>
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
            window.location.href = `/HomePage/datafetcher/reports/getdatareports.php?action=coveragecsv&company=${companyId}&all=true&export=csv`;
        }

                // CSV export triggers direct download from PHP gp format

    </script>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
