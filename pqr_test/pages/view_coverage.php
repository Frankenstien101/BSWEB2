<?php
include 'db_connection.php';
$BATHC_ID = isset($_GET['BATCH_ID']) ? $_GET['BATCH_ID'] : '';
$AGENT_ID = isset($_GET['AGENT_ID']) ? $_GET['AGENT_ID'] : '';
$DELIVERY_DATE = isset($_GET['DELIVERY_DATE']) ? $_GET['DELIVERY_DATE'] : '';

$query = "SELECT *,BD.STATUS AS DELIVERY_STATUS   from [dbo].[Dash_Plan_Batch_Transaction] BT join Dash_Plan_Batch_Details BD on
BT.BATCH_ID = BD.BATCH  LEFT JOIN [dbo].[Dash_Agent_Performance_Detailed] PD ON 
BD.DATE_TO_DELIVER=PD.DELIVERY_DATE AND BD.CUSTOMER_ID=PD.STORE_CODE  AND PD.BATCH_ID='$AGENT_ID' WHERE BT.BATCH_ID=:batch_id order by PD.STORE_ENTRY ASC";
$stmt = $conn->prepare($query);
$stmt->bindParam(':batch_id', $BATHC_ID);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<style>
  .custom-card-visited {
    border-left: 5px solid green;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    border-radius: 0.5rem;
  }

  .custom-card-notvisited {
    border-left: 5px solid black;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    border-radius: 0.5rem;
  }

  .card-body {
    padding: 1rem;
  }

  .code-title {
    font-weight: bold;
    font-size: 0.8rem;
  }

  .location-text {
    font-size: 0.8rem;
    color: #6c757d;
  }

  .time-meta {
    text-align: right;
    font-size: 0.80rem;
  }

  .duration {
    font-size: 0.80rem;
    color: #6c757d;
  }

  .btn_stores {
    text-decoration: none;
    color: inherit;
  }
</style>

<div class="container py-5">
  <div class="mb-2">
    <a href="javascript:history.back()" class="btn btn-secondary">
      ← Back
    </a>
    <a href="index.php?page=agent_trip&AGENT_ID=<?= $AGENT_ID ?>&DELIVERY_DATE=<?= $DELIVERY_DATE ?>&BATCH_ID=<?= $BATHC_ID ?>" class="btn btn-primary">
      <i class="fas fa-route"></i> View Maps
    </a>
  </div>
  <div class="row gy-4">
    <?php
    foreach ($result as $row) {
      $bg_status =
        (($row['DELIVERY_STATUS'] === 'VERIFIED' || $row['DELIVERY_STATUS'] === 'DELIVERED')
          ? 'bg-success'
          : (($row['DELIVERY_STATUS'] === 'FOR DELIVERY')
            ? 'bg-secondary'
            : (($row['DELIVERY_STATUS'] === 'FAILED')
              ? 'bg-danger'
              : 'bg-secondary'
            )
          )
        );


    ?>
      <div class="col-12 col-sm-6 col-md-4 col-lg-3 ">
        <a href="" class="btn_stores">
          <div class="card <?php echo ($row['STORE_CODE'] ? 'custom-card-visited' : 'custom-card-notvisited'); ?>">
            <div class="card-body d-flex justify-content-between align-items-start">
              <div>
                <div class="code-title"><?= $row['CUSTOMER_ID'] ?></div>
                <div class="location-text"><?= $row['CUSTOMER_NAME'] ?></div>
                <span class="location-text <?= $bg_status ?> text-white p-1"><?= $row['DELIVERY_STATUS'] ?></span>
              </div>
              <div class="text-end">
                <div class="time-meta"><?= ($row['STORE_ENTRY'] ? date("g:i A", strtotime($row['STORE_ENTRY'])) : '-') ?></div>
                <div class="duration"><?= $row['STORE_TIME_SPENT'] . "m" ?></div>
                <div class="duration"><?= "₱" . number_format($row['TOTAL_AMOUNT'], 2)  ?></div>
              </div>
            </div>
          </div>
        </a>
      </div>
    <?php
    }
    ?>


    <!-- Repeat other cards -->

  </div>
</div>