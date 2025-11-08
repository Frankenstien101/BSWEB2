<style>
.dashboard-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: clamp(12px, 2vw, 24px);
    margin: 0 auto;
    width: 100%;
    padding: clamp(8px, 2vw, 16px);
}

.card {
    background: white;
    border-radius: 16px;
    padding: clamp(12px, 3vw, 20px);
    box-shadow: 0 4px 16px rgba(59, 130, 246, 0.08);
    border: 1px solid rgba(59, 130, 246, 0.12);
    height: 100%;
    box-sizing: border-box;
    min-width: 0;
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(59, 130, 246, 0.12);
}

.card-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: clamp(10px, 2vw, 16px);
    gap: clamp(6px, 1.5vw, 12px);
}

.beat-info h3 {
    margin: 0 0 4px 0;
    font-size: clamp(14px, 2.5vw, 16px);
    font-weight: 600;
    color: #1f2937;
    display: flex;
    align-items: center;
    gap: 8px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    letter-spacing: -0.2px;
}

.beat-info h3 i {
  color: #3b82f6;
  font-size: 14px;
  flex-shrink: 0;
}

.beat-info span {
  font-size: 11px;
  color: #6b7280;
  display: block;
  margin-bottom: 6px;
}

.status {
  padding: 3px 8px;
  font-size: 9px;
  font-weight: 600;
  border-radius: 10px;
  color: white;
  text-transform: uppercase;
  letter-spacing: 0.3px;
  display: inline-flex;
  align-items: center;
  gap: 4px;
  flex-shrink: 0;
}

.status i {
  font-size: 8px;
}

.status.offline {
  background-color: #ef4444;
}

.status.online {
  background-color: #10b981;
}

.visit-info {
  text-align: right;
  flex-shrink: 0;
}

.visit-info span {
  font-size: clamp(16px, 3vw, 18px);
  font-weight: 700;
  color: #3b82f6;
  display: block;
  line-height: 1;
}

.visit-info p {
  margin: 2px 0 0 0;
  font-size: 10px;
  color: #6b7280;
}

.card-body .section {
  display: flex;
  justify-content: space-between;
  padding: 8px 0;
  font-size: 11px;
  border-bottom: 1px solid #f3f4f6;
  gap: 8px;
}

.card-body .section:last-child {
  border-bottom: none;
}

.section div {
  width: 48%;
  line-height: 1.4;
  display: flex;
  flex-direction: column;
  min-width: 0; /* Prevent overflow */
}

.section strong {
  color: #111827;
  font-weight: 500;
  display: flex;
  align-items: center;
  gap: 4px;
  margin-bottom: 2px;
  font-size: 11px;
  white-space: nowrap;
}

.section strong i {
  color: #9ca3af;
  font-size: 10px;
  width: 14px;
  flex-shrink: 0;
}

.section span {
  color: #6b7280;
  font-size: 11px;
  padding-left: 18px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.footer {
  margin-top: 12px;
  padding-top: 12px;
  border-top: 1px solid #f3f4f6;
  display: flex;
  justify-content: space-between;
  gap: 8px;
}

.footer div {
  text-align: center;
  flex: 1;
  min-width: 0; /* Prevent overflow */
}

.footer strong {
  font-size: 11px;
  color: #111827;
  font-weight: 500;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 4px;
  margin-bottom: 2px;
  white-space: nowrap;
}

.footer strong i {
  flex-shrink: 0;
}

.footer span {
  font-size: 10px;
  color: #6b7280;
  display: block;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

@media (max-width: 1024px) {
  .container {
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  }
}

@media (max-width: 768px) {
  .container {
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
  }
  
  .card {
    padding: 14px;
  }
}

@media (max-width: 480px) {
  .container {
    grid-template-columns: 1fr;
  }
  
  .card-header {
    flex-direction: column;
    gap: 6px;
  }
  
  .visit-info {
    text-align: left;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  
  .section div {
    width: 45%;
  }
}
.btn_nav_coverage {
  text-decoration: none;
}
.date-filter {
  width: 100%;
  padding: 10px 14px;
  border: 1px solid rgba(59,130,246,0.25);
  border-radius: 10px;
  font-size: 14px;
  background: #f9fafb;
  outline: none;
  transition: 0.25s ease;
}

.date-filter:focus {
  border-color: #3b82f6;
  box-shadow: 0 0 0 3px rgba(59,130,246,0.15);
  background: white;
}
</style>
<?php
include 'db_connection.php';

$date_selected = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');
$COMPANY_ID = $_SESSION['comp_id'];
$site_id = $_SESSION['ses_site'];


$sql = "WITH CTE AS (
    SELECT
        BD.BATCH,
        COUNT(BD.CUSTOMER_ID) AS TOTAL_STORE,
        SUM(BD.TOTAL_AMOUNT) AS TOT_AMOUNT,
        SUM(CASE WHEN PD.STORE_CODE IS NOT NULL THEN 1 ELSE 0 END) AS VISITED
    FROM Dash_Plan_Batch_Details BD
    LEFT JOIN Dash_Agent_Performance_Detailed PD
        ON BD.DATE_TO_DELIVER = PD.DELIVERY_DATE
       AND BD.CUSTOMER_ID = PD.STORE_CODE
    WHERE BD.DATE_TO_DELIVER = :date1
      AND BD.COMPANY_ID  = :company1
      AND BD.SITE_ID     = :site1
    GROUP BY BD.BATCH
)
SELECT *
FROM Dash_Plan_Batch_Transaction BT
LEFT JOIN Dash_Agent_Performance_Summary PS
    ON BT.AGENT = PS.AGENT_ID
   AND BT.DATE_TO_DELIVER = PS.DELIVERY_DATE
JOIN CTE ON BT.BATCH_ID = CTE.BATCH
WHERE BT.STATUS <> 'READY'
  AND BT.DATE_TO_DELIVER = :date2
  AND BT.COMPANY_ID  = :company2
  AND BT.SITE_ID     = :site2
";

$stmt = $conn->prepare($sql);

$stmt->bindParam(':date1', $date_selected);
$stmt->bindParam(':company1', $COMPANY_ID);
$stmt->bindParam(':site1', $site_id);

$stmt->bindParam(':date2', $date_selected);
$stmt->bindParam(':company2', $COMPANY_ID);
$stmt->bindParam(':site2', $site_id);

$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="container-fluid">
  <div class="dashboard-container">
 <div class="row">  
<div class="row g-2 justify-content-end align-items-center mb-3">
    <div class="col-md-1 col-sm-4 col-12 d-flex justify-content-md-end justify-content-start" data-mode="dsp">
        <a href="#" class="btn btn-primary w-100">DSP</a>
    </div>
    <div class="col-md-1 col-sm-4 col-12 d-flex justify-content-md-end justify-content-start" data-mode="da">
        <a href="#" class="btn btn-secondary w-100">DA</a>
    </div>
    <div class="col-md-3 col-sm-4 col-12 d-flex justify-content-md-end justify-content-start">
        <input type="date" id="dt_filter" value="<?= $date_selected ?>" class="form-control">
    </div>
</div>

<?php
foreach($result as $row){    
?>
 <div class="col-md-6 col-sm-12 col-lg-4 mb-2">
  <a class="btn_nav_coverage" href="?page=view_coverage&BATCH_ID=<?= $row['BATCH_ID'] ?>&AGENT_ID=<?= $row['AGENT'] ?>&DELIVERY_DATE=<?= $row['DATE_TO_DELIVER'] ?>">
    <div class="card">
    <div class="card-header">
      <div class="beat-info">
        <h3><i class="fas fa-store"></i><?= $row['VEHICLE_ID'] ?></h3>  
        <span><?= $row['AGENT'] ?></span>      
        <div class="status online"><i class="fas fa-circle"></i> Online</div>
      </div>
      <div class="visit-info">
        <span><?= $row['TOTAL_STORE']." / ".$row['VISITED'] ?> </span>
        <p>Visited</p>
      </div>
    </div>
    <div class="card-body">
      <div class="section d-none">
        <div><strong><i class="fas fa-route"></i> Distance</strong><span>0.0 km</span></div>
        <div><strong><i class="fas fa-map-marker-alt"></i> Market</strong><span>0.0 km</span></div>
      </div>
      <div class="section">
        <div><strong><i class="far fa-clock"></i> Market timing</strong><span>–</span></div>
        <div><strong><i class="fas fa-door-open"></i> Entry / Exit</strong><span> <?= 
    ($row['TIME_ENTRY'] ? date("g:i A", strtotime($row['TIME_ENTRY'])) : '-') . 
    " / " . 
    ($row['TIME_EXIT'] ? date("g:i A", strtotime($row['TIME_EXIT'])) : '-') 
?></span></div>
      </div>
      <div class="section">
        <div><strong><i class="far fa-hourglass"></i> Time spent</strong><span><?= 
    $row['TIME_SPENT'] ? 
    (floor($row['TIME_SPENT'] / 60) . 'h ' . ($row['TIME_SPENT'] % 60) . 'm') : 
    '-'
?></span></div>
        <div><strong><i class="fas fa-user-clock"></i>AVG In Store</strong><span>–</span></div>
      </div>
    </div>
    <div class="footer">
      <div>
        <strong><i class="fas fa-chart-line"></i> Productivity</strong>
        <span>– / 11</span>
      </div>
      <div>
        <strong><i class="fas fa-layer-group"></i> Lines</strong>
        <span>–</span>
      </div>
      <div>
        <strong><i class="fas fa-bullseye"></i> Target</strong>
        <span>–</span>
      </div>
    </div>
  </div>
  </a>    
 </div>
<?php } ?>
  </div>   
</div>


<script>
    $("#dt_filter").on("change", function() {
        var selectedDate = $(this).val();
        window.location.href = "?page=agent_dash&date=" + selectedDate;
    });
</script>