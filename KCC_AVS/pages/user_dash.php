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
        min-width: 0;
        /* Prevent overflow */
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
        min-width: 0;
        /* Prevent overflow */
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
        border: 1px solid rgba(59, 130, 246, 0.25);
        border-radius: 10px;
        font-size: 14px;
        background: #f9fafb;
        outline: none;
        transition: 0.25s ease;
    }

    .date-filter:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        background: white;
    }
</style>
<?php


$date_selected = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');

$COMPANY_ID = $_SESSION['selected_comp'];
$site_id = $_SESSION['selected_site'];


$sql = "select * from [dbo].[KAVS_USERS] WHERE STATUS=1 AND COMPANY_ID = :company1 AND SITE_ID = :site1";

$stmt = $conn->prepare($sql);

$stmt->bindParam(':company1', $COMPANY_ID);
$stmt->bindParam(':site1', $site_id);


$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);



function get_last_location_time($AGENT_ID, $conn)
{
    $date  = date("Y-m-d");
    $get_last_loc = $conn->query("
    SELECT TOP(1) TIME_STAMP 
    FROM Dash_Agent_Time_Stamp
    WHERE agent_id = '$AGENT_ID' 
      AND delivery_date = '$date'
    ORDER BY TIME_STAMP DESC
")->fetch(PDO::FETCH_ASSOC);

    $time_stamp = isset($get_last_loc['TIME_STAMP']) ? $get_last_loc['TIME_STAMP'] : "$date 00:00:00";

    $last = strtotime($time_stamp);
    $now  = time();

    $diff = $now - $last;  // ✔ CORRECT


    if ($diff < 300) {
        return "online";
    } else {
        return "offline";
    }
}

function get_travel_distance($AGENT_ID, $conn, $dt)
{

    $get_distance = $conn->query("WITH OrderedPoints AS (
    SELECT
        TIME_STAMP,
        geography::Point(LAT_CAPTURED, LONG_CAPTURED, 4326) AS GeoPoint,
        LAG(geography::Point(LAT_CAPTURED, LONG_CAPTURED, 4326))
            OVER (ORDER BY TIME_STAMP) AS PrevGeoPoint
    FROM Dash_Agent_Time_Stamp
    WHERE LAT_CAPTURED IS NOT NULL
      AND LONG_CAPTURED IS NOT NULL AND AGENT_ID='$AGENT_ID' AND DELIVERY_DATE='$dt'
)
SELECT
   CONCAT(ROUND(SUM(GeoPoint.STDistance(PrevGeoPoint)) / 1000.0,2),' KM') AS TotalDistanceKM
FROM OrderedPoints
WHERE PrevGeoPoint IS NOT NULL;")->fetch(PDO::FETCH_ASSOC);

    return isset($get_distance['TotalDistanceKM']) ? $get_distance['TotalDistanceKM'] : 0;
}

function get_mkt_travel_distance($AGENT_ID, $conn, $dt, $t_start, $t_end)
{

    $get_distance = $conn->query("WITH OrderedPoints AS (
    SELECT
        TIME_STAMP,
        geography::Point(LAT_CAPTURED, LONG_CAPTURED, 4326) AS GeoPoint,
        LAG(geography::Point(LAT_CAPTURED, LONG_CAPTURED, 4326))
            OVER (ORDER BY TIME_STAMP) AS PrevGeoPoint
    FROM Dash_Agent_Time_Stamp
    WHERE LAT_CAPTURED IS NOT NULL
      AND LONG_CAPTURED IS NOT NULL AND AGENT_ID='$AGENT_ID' and TIME_MINUTES BETWEEN '$t_start' AND '$t_end' AND DELIVERY_DATE='$dt'
)
SELECT
   CONCAT(ROUND(SUM(GeoPoint.STDistance(PrevGeoPoint)) / 1000.0,2),' KM') AS TotalDistanceKM
FROM OrderedPoints
WHERE PrevGeoPoint IS NOT NULL;")->fetch(PDO::FETCH_ASSOC);

    return isset($get_distance['TotalDistanceKM']) ? $get_distance['TotalDistanceKM'] : 0;
}
?>


<div class="container-fluid">
    <div class="dashboard-container">
        <div class="row">
            <div class="row g-2 justify-content-end align-items-center mb-3">

                <div class="col-md-3 col-sm-4 col-12 d-flex justify-content-md-end justify-content-start">
                    <input type="date" id="dt_filter" value="<?= $date_selected ?>" class="form-control">
                </div>
            </div>

            <?php
            foreach ($result as $row) {
                // $DA_ID =  ($row['LG_ID'] == NULL) ? $row['AGENT'] : $row['LG_ID'];

                // $is_online_stat = get_last_location_time($DA_ID, $conn) ?: "offline";
                // $travel_dist = get_travel_distance($DA_ID, $conn, $date_selected) ?: 0;
                // $travel_mkt_dist = get_mkt_travel_distance($DA_ID, $conn, $date_selected, $row['TIME_ENTRY'], $row['TIME_EXIT']) ?: 0;

                //local
            ?>
                <div class="col-md-6 col-sm-12 col-lg-4 mb-2">
                    <a class="btn_nav_coverage" href="#">
                        <div class="card">
                            <div class="card-header">
                                <div class="beat-info">
                                    <h3><i class="fas fa-store"></i><?= "SAMPLE " ?></h3>
                                    <span><?= "USER1" ?></span>
                                    <div class="status <?= $is_online_stat ?>"><i class="fas fa-circle"></i> <?= $is_online_stat ?></div>
                                </div>
                                <div class="visit-info">
                                    <span><?= "1 / 1" ?> </span>
                                    <p>Visited</p>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="section ">
                                    <div><strong><i class="fas fa-route"></i> Distance</strong><span><?= $travel_dist ?></span></div>
                                    <div><strong><i class="fas fa-map-marker-alt"></i> Market</strong><span><?= $travel_mkt_dist ?></span></div>
                                </div>
                                <div class="section">
                                    <div><strong><i class="fas fa-door-open"></i>Market Entry / Exit</strong><span> <?=
                                                                                                                    "1:00"
                                                                                                                    ?></span></div>
                                </div>
                                <div class="section">
                                    <div><strong><i class="far fa-hourglass"></i> Time spent</strong><span><?= "10:00" ?></span></div>
                                    <div><strong><i class="fas fa-user-clock"></i>AVG In Store</strong><span>–</span></div>
                                </div>
                            </div>

                            <div class="footer d-none">
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