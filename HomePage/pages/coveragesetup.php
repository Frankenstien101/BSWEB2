<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Coverage Upload</title>

    <!-- Bootstrap 4 -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">

    <!-- SheetJS for Excel -->
    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>

    <style>
        html, body {
            height: 100%;
            margin: 0;
        }

        .container-fluid {
            padding: 10px;
        }

        table {
            font-size: 11px;
        }

        th, td {
            padding: 3px 6px !important;
            white-space: nowrap;
        }

        .schedule-box {
            display: none;
        }
    </style>
</head>

<body>

<div class="container-fluid">

    <!-- HEADER -->
    <div class="row mb-2">
        <div class="col">
            <h3 class="mb-1">📊 Coverage Upload</h3>
        </div>
    </div>

    <!-- UPLOAD OPTIONS -->
    <div class="card mb-2">
        <div class="card-body p-2">

            <div class="form-inline">

                <label class="mr-2 mb -2">Upload Type:</label>

                <div class="form-check mr-2 ">
                    <input class="form-check-input" type="radio" name="type" value="NOW" checked>
                    <label class="form-check-label">On Time</label>
                </div>

                <div class="form-check mr-3 ">
                    <input class="form-check-input" type="radio" name="type" value="SCHEDULED">
                    <label class="form-check-label">Scheduled</label>
                </div>

                <div class="schedule-box form-inline mr-3 mb-2">
                    <input type="date" class="form-control form-control-sm mr-1" id="schedDate">
                    <input type="time" class="form-control form-control-sm" id="schedTime">
                </div>

                <input type="file"
                       class="form-control-file mr-2 mb-1 mt-2"
                       id="excelFile"
                       accept=".xls,.xlsx,.csv">

                <button class="btn btn-sm btn-success mt-2">
                    Upload
                </button>

            </div>

        </div>
    </div>

    <!-- EXCEL PREVIEW -->
    <div class="card mb-2">
        <div class="card-header p-1 bg-info text-white">
            Excel Preview (Coverage Data)
        </div>
        <div class="card-body p-0" style="overflow:auto;height:40vh; max-height:40vh;">

            <table class="table table-bordered table-sm mb-0" id="excelTable">
                <thead class="thead-light">
                <tr>
                    <th>COMPANY_ID</th>
                    <th>SITE_ID</th>
                    <th>PROCESS_ID</th>
                    <th>SELLER_ID</th>
                    <th>CUSTOMER_ID</th>
                    <th>FREQUENCY</th>
                    <th>WEEK1</th>
                    <th>WEEK2</th>
                    <th>WEEK3</th>
                    <th>WEEK4</th>
                    <th>WEEK5</th>
                    <th>MON</th>
                    <th>TUE</th>
                    <th>WED</th>
                    <th>THU</th>
                    <th>FRI</th>
                    <th>SAT</th>
                    <th>SUN</th>
                    <th>STATUS</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td colspan="19" class="text-center text-muted">
                        No file loaded
                    </td>
                </tr>
                </tbody>
            </table>

        </div>
    </div>

    <!-- PENDING REQUESTS -->
    <div class="card">
        <div class="card-header p-1 bg-info">
            Pending Requests
        </div>
        <div class="card-body p-0">

            <table class="table table-bordered table-sm mb-0" style="overflow:auto;height:15vh; max-height:15vh;">
                <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>File</th>
                    <th>Type</th>
                    <th>Schedule</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td colspan="5" class="text-center text-muted">
                        No pending requests
                    </td>
                </tr>
                </tbody>
            </table>

        </div>
    </div>

</div>

<!-- SCRIPTS -->
<script>
    // Toggle schedule inputs
    document.querySelectorAll("input[name='type']").forEach(r => {
        r.addEventListener("change", () => {
            document.querySelector(".schedule-box").style.display =
                r.value === "SCHEDULED" && r.checked ? "inline-flex" : "none";
        });
    });

    // Excel preview
    document.getElementById("excelFile").addEventListener("change", function (e) {

        const file = e.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function (evt) {

            const workbook = XLSX.read(evt.target.result, { type: "binary" });
            const sheet = workbook.Sheets[workbook.SheetNames[0]];
            const data = XLSX.utils.sheet_to_json(sheet, { header: 1 });

            const tbody = document.querySelector("#excelTable tbody");
            tbody.innerHTML = "";

            data.slice(1).forEach(row => {

                let tr = document.createElement("tr");

                for (let i = 0; i < 18; i++) {
                    let td = document.createElement("td");
                    td.innerText = row[i] || "";
                    tr.appendChild(td);
                }

                let statusTd = document.createElement("td");
                statusTd.innerText = "UPLOADING";
                tr.appendChild(statusTd);

                tbody.appendChild(tr);
            });
        };

        reader.readAsBinaryString(file);
    });
</script>

</body>
</html>
