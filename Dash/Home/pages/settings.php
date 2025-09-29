<!doctype html>
<html lang="en">
  <head>
         <link rel="icon" type="image/x-icon" href="MainImg\bscr.ico">

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Settings</title>
  </head>
  <body>
    <h1>SETTINGS</h1>
    
<div class="card text-bg-light mt-1" 
     style="max-width: 100%; width: 400px; height: 480px; margin-bottom: 0.5rem; font-size: 9px;">
    
    <div class="card-header">
        <!-- Optional header content -->
    <H6>AGENT LOGOUT</H6>

    </div>

    <!-- Card body with scroll -->
    <div class="card-body" 
         style="overflow-y: auto; max-height: 420px; padding: 0.5rem;">
        <table id="itemsTable" 
               class="table table-striped table-hover table-bordered table-sm" 
               style="font-size: 9px;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>AGENTS</th> 
                    <th>ACTIVE</th>
                    <th>ACTION</th> 
                </tr>
            </thead>
            <tbody>
                <!-- Rows will be dynamically inserted -->
            </tbody>
        </table>
    </div>

    <div id="table-error" class="error-message"></div>
    <div id="table-success" class="success-message"></div>
</div>




<script>

document.addEventListener("DOMContentLoaded", function () {
loadagents();

});
function loadagents() {
    const companyid = "<?php echo $_SESSION['Company_ID'] ?? ''; ?>";
    const siteid = "<?php echo $_SESSION['SITE_ID'] ?? ''; ?>";
    const tbody = document.querySelector('#itemsTable tbody');
    if (!tbody) return;

    tbody.innerHTML = ''; // Clear previous rows

    fetch(`/Dash/datafetcher/settings_getdata.php?action=loadagents&companyid=${encodeURIComponent(companyid)}&siteid=${encodeURIComponent(siteid)}`)
        .then(response => {
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            return response.json();
        })
        .then(data => {
            loadedPOs = data;

            if (!data || data.length === 0) {
                const tr = document.createElement('tr');
                tr.innerHTML = '<td colspan="3" class="text-center">No items found.</td>';
                tbody.appendChild(tr);
                return;
            }

            data.forEach((item, index) => { 
                const tr = document.createElement('tr');
                const batch = item.BATCH || '';

                tr.innerHTML = `
                    <td>${index + 1}</td>
                    <td>${item.SUB_DA || ''}</td>
                    <td>${item.IS_LOGIN || ''}</td>
                    <td>
                        <button class="btn btn-danger btn-sm remove-btn" title="Sign out">
                            <i class="fa fa-sign-out-alt"></i>
                        </button>
                    </td>
                `;

                tr.dataset.itemCode = item.SUB_DA;
                tr.dataset.batch = batch;

                tbody.appendChild(tr);

                // Sign out button event
                tr.querySelector('.remove-btn').addEventListener('click', () => {
                    if (confirm('Are you sure you want to sign out this agent from the device?')) {
                        logoutagent(item.SUB_DA, companyid, siteid);
                    }
                });
            });
        })
        .catch(err => {
            console.error('Error loading list:', err);
        });
}

function logoutagent(agent, companyid, siteid) {

    fetch(`/Dash/datafetcher/settings_getdata.php?action=logoutagent&agent=${encodeURIComponent(agent)}&companyid=${encodeURIComponent(companyid)}&siteid=${encodeURIComponent(siteid)}`)
        .then(response => {
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            return response.json();
        })
        .then(data => {
            if (data.success) {
                console.log(`Agent ${agent} logged out successfully.`);
                // Optionally refresh the table:
                loadagents();
            } else {
                console.warn("Logout failed:", data.error || "Unknown error");
            }
        })
        .catch(err => {
            console.error('Error:', err);
        })
        .finally(() => {
        });
        
loadagents();

}


</script>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  </body>
</html>