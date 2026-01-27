<?php

$get_total_accounts = [];
$get_geotag_status = [];
$get_audit_compliance = [];


$selectec_comp = isset($_SESSION['selected_comp']) ? $_SESSION['selected_comp'] : '0';
$selected_site = isset($_SESSION['selected_site']) ? $_SESSION['selected_site'] : '0';

$query_accounts = "SELECT ACCOUNT_TYPE, COUNT(*) AS TOTAL from [dbo].[KAVS_ACCOUNTS]
WHERE  COMPANY_ID=$selectec_comp AND SITE_ID=$selected_site  GROUP BY ACCOUNT_TYPE";

$stmt_accounts = $conn->query($query_accounts);
while ($row = $stmt_accounts->fetch(PDO::FETCH_ASSOC)) {
    $get_total_accounts[$row['ACCOUNT_TYPE']] = $row['TOTAL'];
}

$query_geotag = "SELECT ACCOUNT_STATUS, COUNT(*) AS TOTAL from [dbo].[KAVS_ACCOUNTS]
WHERE   COMPANY_ID=$selectec_comp AND SITE_ID=$selected_site GROUP BY ACCOUNT_STATUS ";

$stmt_geotag = $conn->query($query_geotag);
while ($row = $stmt_geotag->fetch(PDO::FETCH_ASSOC)) {
    $get_geotag_status[$row['ACCOUNT_STATUS']] = $row['TOTAL'];
}

?>

<style>
    .stat-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 20px 22px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
        height: 100%;
    }

    .stat-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: #6c757d;
        font-size: 0.9rem;
        margin-bottom: 8px;
    }

    .stat-header i {
        font-size: 1.3rem;
        color: #0B2D5F;
    }

    .stat-number {
        font-weight: 700;
        margin-bottom: 12px;
        color: #212529;
    }

    /* Mobile spacing */
    @media (max-width: 768px) {
        .stat-number {
            font-size: 1.8rem;
        }
    }
</style>
<div class="container-fluid p-4">

    <h4 class="fw-bold mb-4">Account Overview</h4>

    <div class="row g-4">

        <!-- Total Accounts -->
        <div class="col-lg-3 col-md-6">
            <div class="stat-card">
                <div class="stat-header">
                    <span>Total Accounts</span>
                    <i class="fas fa-store"></i>
                </div>
                <h2 class="stat-number"><?php echo array_sum($get_total_accounts); ?></h2>
                <canvas id="accountTypeChart" height="50"></canvas>
            </div>
        </div>

        <!-- Geotag Status -->
        <div class="col-lg-3 col-md-6">
            <div class="stat-card">
                <div class="stat-header">
                    <span>Geotag Status</span>
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <h2 class="stat-number"><?php echo array_sum($get_geotag_status); ?></h2>
                <canvas id="geotagChart" height="50"></canvas>
            </div>
        </div>

        <!-- Audit Compliance -->
        <div class="col-lg-3 col-md-12">
            <div class="stat-card">
                <div class="stat-header">
                    <span>Audit Compliance</span>
                    <i class="fas fa-clipboard-check"></i>
                </div>
                <h2 class="stat-number"><?php echo array_sum($get_geotag_status); ?></h2>
                <canvas id="auditChart" height="50"></canvas>
            </div>
        </div>
        <div class="col-lg-3 col-md-12">
            <div class="stat-card">
                <div class="stat-header">
                    <span>Account Categories</span>
                    <i class="fas fa-clipboard-check"></i>
                </div>
                <h2 class="stat-number"><?php echo array_sum($get_geotag_status); ?></h2>
                <canvas id="categoryChart" height="50"></canvas>
            </div>
        </div>

    </div>
</div>

<script>
    const chartOptions = {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    boxWidth: 12,
                    padding: 15
                }
            }
        }
    };

    // Account Type (Billboard vs Partner Store)
    new Chart(document.getElementById('accountTypeChart'), {
        type: 'doughnut',
        data: {
            labels: ['Billboard (' + <?= $get_total_accounts['Billboard'] ?? 0; ?> + ')', 'Partner Store (' + <?= $get_total_accounts['Partner Store'] ?? 0; ?> + ')'],
            datasets: [{
                data: [<?php echo $get_total_accounts['Billboard'] ?? 0; ?>, <?php echo $get_total_accounts['Partner Store'] ?? 0; ?>],
                backgroundColor: ['#0B2D5F', '#adb5bd']
            }]
        },
        options: chartOptions
    });

    // Geotag Status
    new Chart(document.getElementById('geotagChart'), {
        type: 'doughnut',
        data: {
            labels: ['Active (' + <?= $get_geotag_status['ACTIVE'] ?? 0; ?> + ')', 'NEW (' + <?= $get_geotag_status['NEW'] ?? 0; ?> + ')', 'Geotagged (' + <?= $get_geotag_status['GEOTAGGED'] ?? 0; ?> + ')', 'For Geotagging (' + <?= $get_geotag_status['FOR GEOTAGGING'] ?? 0; ?> + ')'],
            datasets: [{
                data: [<?php echo $get_geotag_status['ACTIVE'] ?? 0; ?>, <?php echo $get_geotag_status['NEW'] ?? 0; ?>, <?php echo $get_geotag_status['GEOTAGGED'] ?? 0; ?>, <?php echo $get_geotag_status['FOR GEOTAGGING'] ?? 0; ?>],
                backgroundColor: ['#198754', '#F39625', '#2596F3', '#dc3545']
            }]
        },
        options: chartOptions
    });

    // Audit Compliance
    new Chart(document.getElementById('auditChart'), {
        type: 'doughnut',
        data: {
            labels: ['Compliant', 'Non-Compliant'],
            datasets: [{
                data: [0, 0],
                backgroundColor: ['#0d6efd', '#ffc107']
            }]
        },
        options: chartOptions
    });
</script>