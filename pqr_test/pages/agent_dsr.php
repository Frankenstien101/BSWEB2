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
$sql = "
WITH CTE AS (
    SELECT
        BD.BATCH,
        COUNT(BD.CUSTOMER_ID) AS TOTAL_STORE,
        SUM(BD.TOTAL_AMOUNT) AS TOTAL_VALUE,
        ISNULL(SUM(DP.COLLECTED_AMOUNT),0) AS TOTAL_DELIVERED_AMOUNT,
        SUM(CASE WHEN PD.STORE_CODE IS NOT NULL THEN 1 ELSE 0 END) AS VISITED,
        SUM(CASE WHEN BD.STATUS IN ('DELIVERED','VERIFIED') THEN 1 ELSE 0 END) AS DELIVERED,
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
    WHERE BD.DATE_TO_DELIVER = :dt1
      AND BD.COMPANY_ID = :cid1
      AND BD.SITE_ID = :sid1
    GROUP BY BD.BATCH
)
SELECT *, LOGIN_ID AS LG_ID
FROM Dash_Plan_Batch_Transaction BT
JOIN CTE ON BT.BATCH_ID = CTE.BATCH
LEFT JOIN Dash_Agent_Performance_Summary PS
       ON BT.AGENT = PS.AGENT_ID
      AND BT.DATE_TO_DELIVER = PS.DELIVERY_DATE
WHERE BT.STATUS <> 'READY'
  AND BT.DATE_TO_DELIVER = :dt2
  AND BT.COMPANY_ID = :cid2
  AND BT.SITE_ID = :sid2
";
$stmt = $conn->prepare($sql);
$stmt->execute([
  ':dt1'  => $date_selected,
  ':cid1' => $COMPANY_ID,
  ':sid1' => $SITE_ID,

  ':dt2'  => $date_selected,
  ':cid2' => $COMPANY_ID,
  ':sid2' => $SITE_ID
]);

$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

function getToDate($agent, $dt, $conn)
{
  $start = date("Y-m-01", strtotime($dt));
  $q = $conn->prepare("
        SELECT COUNT(*) TOTAL_STORE,
               SUM(TOTAL_AMOUNT) TOT_AMOUNT,
               ISNULL(SUM(COLLECTED_AMOUNT),0) TOTAL_DELIVERED,
               SUM(CASE WHEN PD.STORE_CODE IS NOT NULL THEN 1 ELSE 0 END) VISITED,
               SUM(CASE WHEN BD.STATUS IN('DELIVERED','VERIFIED') THEN 1 ELSE 0 END) DELIVERED,
               SUM(CASE WHEN BD.STATUS='FAILED' THEN 1 ELSE 0 END) FAILED
        FROM Dash_Plan_Batch_Details BD
        LEFT JOIN Dash_Payments DP ON BD.INVOICE_NUMBER=DP.INVOICE_NUMBER
        LEFT JOIN Dash_Agent_Performance_Detailed PD
             ON BD.DATE_TO_DELIVER=PD.DELIVERY_DATE
            AND BD.CUSTOMER_ID=PD.STORE_CODE
        WHERE BD.AGENT_ID=?
          AND BD.DATE_TO_DELIVER BETWEEN ? AND ?
          AND BD.COMPANY_ID=?
          AND BD.SITE_ID=?
    ");
  $q->execute([$agent, $start, $dt, $_SESSION['comp_id'], $_SESSION['ses_site']]);
  return $q->fetch(PDO::FETCH_ASSOC);
}
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

        <div class="col-md-3 col-sm-4 col-12 d-flex justify-content-md-end justify-content-start">
          <input type="date" id="dt_filter" value="<?= $date_selected ?>" class="form-control">
        </div>
      </div>



      <?php foreach ($rows as $r):
        $AGENT = $r['LG_ID'] ?? $r['AGENT'];
        $tod   = getToDate($r['AGENT'], $date_selected, $conn);
        $notVisited = $r['TOTAL_STORE'] - $r['VISITED'];
        $todNotVisited = $tod['TOTAL_STORE'] - $tod['VISITED'];
      ?>
        <div class="col-sm-12 col-lg-6 mb-2">
          <a class="btn_nav_coverage"
            href="?page=view_coverage&BATCH_ID=<?= $r['BATCH_ID'] ?>&AGENT_ID=<?= $AGENT ?>&DELIVERY_DATE=<?= $r['DATE_TO_DELIVER'] ?>">

            <div class="card">
              <div class="card-header">
                <div class="beat-info">
                  <span>DA #: <?= $r['AGENT'] ?></span><br>
                  <span>SUB-DA #: <?= $AGENT ?></span>
                  <h3><i class="fas fa-truck"></i><?= $r['VEHICLE_ID'] ?></h3>
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
                      <td><?= peso($r['TOTAL_VALUE']) ?></td>
                      <td><?= peso($r['TOTAL_DELIVERED_AMOUNT']) ?></td>
                      <td><?= percent($r['TOTAL_DELIVERED_AMOUNT'], $r['TOTAL_VALUE']) ?>%</td>
                      <td><?= peso($tod['TOT_AMOUNT']) ?></td>
                      <td><?= peso($tod['TOTAL_DELIVERED']) ?></td>
                      <td><?= percent($tod['TOTAL_DELIVERED'], $tod['TOT_AMOUNT']) ?>%</td>
                    </tr>

                    <tr>
                      <td>Visited</td>
                      <td rowspan="4"><?= $r['TOTAL_STORE'] ?></td>
                      <td><?= $r['VISITED'] ?></td>
                      <td><?= percent($r['VISITED'], $r['TOTAL_STORE']) ?>%</td>
                      <td rowspan="4"><?= $tod['TOTAL_STORE'] ?></td>
                      <td><?= $tod['VISITED'] ?></td>
                      <td><?= percent($tod['VISITED'], $tod['TOTAL_STORE']) ?>%</td>
                    </tr>

                    <tr>
                      <td>Not Visited</td>
                      <td><?= $notVisited ?></td>
                      <td><?= percent($notVisited, $r['TOTAL_STORE']) ?>%</td>
                      <td><?= $todNotVisited ?></td>
                      <td><?= percent($todNotVisited, $tod['TOTAL_STORE']) ?>%</td>
                    </tr>

                    <tr>
                      <td>Delivered</td>
                      <td><?= $r['DELIVERED'] ?></td>
                      <td><?= percent($r['DELIVERED'], $r['TOTAL_STORE']) ?>%</td>
                      <td><?= $tod['DELIVERED'] ?></td>
                      <td><?= percent($tod['DELIVERED'], $tod['TOTAL_STORE']) ?>%</td>
                    </tr>

                    <tr>
                      <td>Failed</td>
                      <td><?= $r['FAILED'] ?></td>
                      <td><?= percent($r['FAILED'], $r['TOTAL_STORE']) ?>%</td>
                      <td><?= $tod['FAILED'] ?></td>
                      <td><?= percent($tod['FAILED'], $tod['TOTAL_STORE']) ?>%</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <script>
    document.getElementById("dt_filter")?.addEventListener("change", e => {
      location.href = "?page=agent_dsr&date=" + e.target.value;
    });
  </script>