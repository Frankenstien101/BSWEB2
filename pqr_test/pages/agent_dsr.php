<?php
/* ===============================
   INITIAL SETUP
================================ */
include 'db_connection.php';

$date_selected = $_GET['date'] ?? date('Y-m-d');
$COMPANY_ID    = $_SESSION['comp_id'];
$SITE_ID       = $_SESSION['ses_site'];

/* ===============================
   MAIN DASHBOARD QUERY
================================ */
$sql = "SELECT COUNT(BD.CUSTOMER_ID) AS TOTAL_STORE,
        SUM(BD.TOTAL_AMOUNT) AS TOT_AMOUNT,
        ISNULL(SUM(DP.COLLECTED_AMOUNT),0) AS TOTAL_DELIVERED_AMOUNT,
      SUM(CASE WHEN PD.STATUS = 'COMPLETE' THEN 1 ELSE 0 END) VISITED,
          COUNT(*) - SUM(CASE WHEN PD.STATUS = 'COMPLETE' THEN 1 ELSE 0 END) NOT_VISITED,
                SUM(CASE WHEN BD.STATUS IN ('DELIVERED','VERIFIED') THEN 1 ELSE 0 END) AS TOTAL_DELIVERED,
        SUM(CASE WHEN BD.STATUS='FAILED' THEN 1 ELSE 0 END) AS FAILED,
        SUM(CASE WHEN BD.RCA='NO OWNER' THEN 1 ELSE 0 END) AS NO_OWNER,
        SUM(CASE WHEN BD.RCA='NO BUDGET' THEN 1 ELSE 0 END) AS NO_BUDGET,
        SUM(CASE WHEN BD.RCA='STORE CLOSE' THEN 1 ELSE 0 END) AS STORE_CLOSE,
        SUM(CASE WHEN BD.RCA='DECLINED' THEN 1 ELSE 0 END) AS DECLINED
    FROM Dash_Plan_Batch_Details BD
    LEFT JOIN Dash_Payments DP ON BD.INVOICE_NUMBER = DP.INVOICE_NUMBER
    LEFT JOIN Dash_Agent_Performance_Detailed PD
           ON BD.DATE_TO_DELIVER = PD.DELIVERY_DATE
          AND BD.CUSTOMER_ID = PD.STORE_CODE
    WHERE BD.DATE_TO_DELIVER = '$date_selected'
      AND BD.COMPANY_ID = '$COMPANY_ID'
      AND BD.SITE_ID = '$SITE_ID'";

$query_items = $conn->query($sql)->fetch(PDO::FETCH_ASSOC);

/* ===============================
   HELPER FUNCTIONS
================================ */
function percent($a, $b)
{
  return ($b > 0) ? round(($a / $b) * 100) : 0;
}

function peso($v)
{
  return '₱' . number_format($v, 2);
}

function get_color_class($percentage)
{
  if ($percentage >= 90) {
    return 'bg-success text-white';
  } elseif ($percentage >= 80 and $percentage < 90) {
    return 'bg-warning text-white';
  } elseif ($percentage < 80 && $percentage >= 1) {
    return 'bg-danger text-white';
  }
}
function get_color_class_negative($percentage)
{

  if ($percentage >= 90) {
    return 'bg-danger text-white';
  } elseif ($percentage >= 10 and $percentage < 90) {
    return 'bg-warning text-white';
  } elseif ($percentage < 10 && $percentage >= 1) {
    return 'bg-success text-white';
  }
}
function getToDate($dt, $conn)
{
  $start = date("Y-m-01", strtotime($dt));
  $q = $conn->prepare("SELECT COUNT(*) TOTAL_STORE,
               SUM(TOTAL_AMOUNT) TOT_AMOUNT,
               ISNULL(SUM(COLLECTED_AMOUNT),0) TOTAL_DELIVERED,
               SUM(CASE WHEN PD.STATUS = 'COMPLETE' THEN 1 ELSE 0 END) VISITED,
               COUNT(*) - SUM(CASE WHEN PD.STATUS = 'COMPLETE' THEN 1 ELSE 0 END) NOT_VISITED,
               SUM(CASE WHEN BD.STATUS IN('DELIVERED','VERIFIED') THEN 1 ELSE 0 END) DELIVERED,
               SUM(CASE WHEN BD.STATUS='FAILED' THEN 1 ELSE 0 END) FAILED
        FROM Dash_Plan_Batch_Details BD
        LEFT JOIN Dash_Payments DP ON BD.INVOICE_NUMBER=DP.INVOICE_NUMBER
        LEFT JOIN Dash_Agent_Performance_Detailed PD
             ON BD.DATE_TO_DELIVER=PD.DELIVERY_DATE
            AND BD.CUSTOMER_ID=PD.STORE_CODE
        WHERE  BD.DATE_TO_DELIVER BETWEEN ? AND ?
          AND BD.COMPANY_ID=?
          AND BD.SITE_ID=?
    ");
  $q->execute([$start, $dt, $_SESSION['comp_id'], $_SESSION['ses_site']]);
  return $q->fetch(PDO::FETCH_ASSOC);
}

$tod = getToDate($date_selected, $conn);
?>


<style>
  :root {
    --primary: #3b82f6;
    --border: #e5e7eb;
    --muted: #6b7280;
  }




  .card {
    background: #fff;
    border-radius: 16px;
    padding: 16px;
    border: 1px solid rgba(59, 130, 246, .12);
    box-shadow: 0 4px 16px rgba(59, 130, 246, .08);
    transition: .3s ease;
  }

  .card:hover {
    transform: translateY(-2px);
  }

  .card-header {
    margin-bottom: 12px;
  }

  .beat-info span {
    font-size: 11px;
    color: var(--muted);
  }

  .beat-info h3 {
    margin: 4px 0;
    font-size: 15px;
    display: flex;
    gap: 8px;
  }

  table {
    width: 100%;
    border-collapse: collapse;
  }

  th,
  td {
    border: 1px solid #ddd;
    padding: 6px;
    font-size: 12px;
    text-align: center;
  }

  th {
    background: #f3f4f6
  }

  .btn_nav_coverage {
    text-decoration: none;
    color: inherit;
  }

  @media(max-width:480px) {
    .dashboard-container {
      grid-template-columns: 1fr
    }
  }
</style>


<body>

  <div class="dashboard-container">
    <div class="row">
      <div class="row g-2 justify-content-end align-items-center mb-3">

        <div class="col-md-4 col-lg-4 col-sm-12   d-flex justify-content-md-end justify-content-start">
          <input type="date" id="dt_filter" value="<?= $date_selected ?>" class="form-control">
        </div>
      </div>
      <div class="col-sm-12 mb-2">
        <a class="btn_nav_coverage"
          href="?page=agent_dsr_det&date=<?= $date_selected ?>">

          <div class="card">
            <div class="card-header">
              <div class="beat-info">
                <h3><i class="fas fa-info-circle"></i>DSR SUMMARY</h3>
              </div>
            </div>
            <div class="table-responsive">
              <table class="data-table">
                <thead>
                  <tr>
                    <th rowspan="2">Metrics</th>
                    <th colspan="3">Today</th>
                    <th colspan="3">Todate</th>
                  </tr>
                  <tr>
                    <th>Obj</th>
                    <th>Act</th>
                    <th>%</th>
                    <th>Obj</th>
                    <th>Act</th>
                    <th>%</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Volume</td>
                    <td><?= peso($query_items['TOT_AMOUNT']) ?></td>
                    <td><?= peso($query_items['TOTAL_DELIVERED_AMOUNT']) ?></td>
                    <td class="<?= get_color_class(percent($query_items['TOTAL_DELIVERED_AMOUNT'], $query_items['TOT_AMOUNT'])) ?>"><?= percent($query_items['TOTAL_DELIVERED_AMOUNT'], $query_items['TOT_AMOUNT']) ?>%</td>

                    <td><?= peso($tod['TOT_AMOUNT']) ?></td>
                    <td><?= peso($tod['TOTAL_DELIVERED']) ?></td>
                    <td class="<?= get_color_class(percent($tod['TOTAL_DELIVERED'], $tod['TOT_AMOUNT'])) ?>"><?= percent($tod['TOTAL_DELIVERED'], $tod['TOT_AMOUNT']) ?>%</td>
                  </tr>

                  <tr>
                    <td>Visited</td>
                    <td rowspan="4"><?= $query_items['TOTAL_STORE'] ?></td>
                    <td><?= $query_items['VISITED'] ?></td>
                    <td class="<?= get_color_class(percent($query_items['VISITED'], $query_items['TOTAL_STORE'])) ?>"><?= percent($query_items['VISITED'], $query_items['TOTAL_STORE']) ?>%</td>
                    <td rowspan="4"><?= $tod['TOTAL_STORE'] ?></td>
                    <td><?= $tod['VISITED'] ?></td>
                    <td class="<?= get_color_class(percent($tod['VISITED'], $tod['TOTAL_STORE'])) ?>"><?= percent($tod['VISITED'], $tod['TOTAL_STORE']) ?>%</td>
                  </tr>
                  <tr>
                    <td>Delivered</td>
                    <td><?= $query_items['TOTAL_DELIVERED'] ?></td>
                    <td class="<?= get_color_class(percent($query_items['TOTAL_DELIVERED'], $query_items['TOTAL_STORE'])) ?>"><?= percent($query_items['TOTAL_DELIVERED'], $query_items['TOTAL_STORE']) ?>%</td>
                    <td><?= $tod['DELIVERED'] ?></td>
                    <td class="<?= get_color_class(percent($tod['DELIVERED'], $tod['TOTAL_STORE'])) ?>"><?= percent($tod['DELIVERED'], $tod['TOTAL_STORE']) ?>%</td>
                  </tr>
                  <tr>
                    <td>Not Visited</td>
                    <td><?= $query_items['NOT_VISITED'] ?></td>
                    <td class="<?= get_color_class_negative(percent($query_items['NOT_VISITED'], $query_items['TOTAL_STORE'])) ?>"><?= percent($query_items['NOT_VISITED'], $query_items['TOTAL_STORE']) ?>%</td>
                    <td><?= $tod['NOT_VISITED'] ?></td>
                    <td class="<?= get_color_class_negative(percent($tod['NOT_VISITED'], $tod['TOTAL_STORE'])) ?>"><?= percent($tod['NOT_VISITED'], $tod['TOTAL_STORE']) ?>%</td>
                  </tr>



                  <tr>
                    <td>Failed</td>
                    <td><?= $query_items['FAILED'] ?></td>
                    <td class="<?= get_color_class_negative(percent($query_items['FAILED'], $query_items['TOTAL_STORE'])) ?>"><?= percent($query_items['FAILED'], $query_items['TOTAL_STORE']) ?>%</td>
                    <td><?= $tod['FAILED'] ?></td>
                    <td class="<?= get_color_class_negative(percent($tod['FAILED'], $tod['TOTAL_STORE'])) ?>"><?= percent($tod['FAILED'], $tod['TOTAL_STORE']) ?>%</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </a>
      </div>

    </div>
  </div>

  <script>
    document.getElementById("dt_filter")?.addEventListener("change", e => {
      location.href = "?page=agent_dsr&date=" + e.target.value;
    });
  </script>