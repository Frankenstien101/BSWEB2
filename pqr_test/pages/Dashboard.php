<?php
include_once("db_connection.php");

$year = date("Y");
$company_id = $_SESSION['comp_id'] ?? "";

/* ✅ Fast Month Summary Query */
$month_query = "
    SELECT MONTH, TOTAL_AMOUNT
    FROM Sales_Summary_By_Month
    WHERE COMPANY_ID = :company_id AND YEAR = :year
    ORDER BY MONTH ASC
";

$month_stmt = $conn->prepare($month_query);
$month_stmt->execute([
    ':company_id' => $company_id,
    ':year' => $year
]);

$month_results = $month_stmt->fetchAll(PDO::FETCH_ASSOC);
$month_json = json_encode($month_results ?: []);

/* ✅ Fast Year Summary Query */
$year_query = "
    SELECT YEAR, TOTAL_AMOUNT
    FROM Sales_Summary_By_Year
    WHERE COMPANY_ID = :company_id
    ORDER BY YEAR ASC
";

$year_stmt = $conn->prepare($year_query);
$year_stmt->execute([
    ':company_id' => $company_id
]);
$year_results = $year_stmt->fetchAll(PDO::FETCH_ASSOC);
$year_json = json_encode($year_results ?: []);
?>

<style>
    :root {
      --primary: #4361ee;
      --primary-light: #4895ef;
      --secondary: #3f37c9;
      --success: #4cc9f0;
      --warning: #f72585;
      --danger: #e63946;
      --dark: #1d3557;
      --light: #f8f9fa;
      --gray: #6c757d;
      --border-radius: 12px;
      --box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      --transition: all 0.3s ease;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #f5f7fa 0%, #e4edf5 100%);
      color: var(--dark);
      line-height: 1.6;
      min-height: 100vh;
      padding: 20px;
    }

    .dashboard {
      margin: 0 auto;
    }

    .dashboard-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
      flex-wrap: wrap;
      gap: 15px;
    }

    .dashboard-title {
      font-size: 2.2rem;
      font-weight: 700;
      color: var(--dark);
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .dashboard-title i {
      color: var(--primary);
    }

    .dashboard-controls {
      display: flex;
      gap: 15px;
      align-items: center;
    }

    .date-filter {
      background: white;
      border-radius: var(--border-radius);
      padding: 10px 15px;
      box-shadow: var(--box-shadow);
      display: flex;
      align-items: center;
      gap: 10px;
      font-weight: 500;
    }

    .date-filter select {
      border: none;
      background: transparent;
      font-weight: 500;
      color: var(--dark);
      outline: none;
    }

    /* Tabs */
    .tabs {
      display: flex;
      background: white;
      border-radius: var(--border-radius);
      padding: 8px;
      box-shadow: var(--box-shadow);
      margin-bottom: 30px;
      overflow-x: auto;
    }

    .tab {
      padding: 12px 24px;
      cursor: pointer;
      border-radius: 8px;
      color: var(--gray);
      font-weight: 600;
      transition: var(--transition);
      white-space: nowrap;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .tab:hover {
      color: var(--primary);
      background: rgba(67, 97, 238, 0.05);
    }

    .tab.active {
      background: var(--primary);
      color: white;
    }

    /* Stats Cards */
    .stats-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
      gap: 20px;
      margin-bottom: 30px;
    }

    .stat-card {
      background: white;
      border-radius: var(--border-radius);
      padding: 20px;
      box-shadow: var(--box-shadow);
      display: flex;
      align-items: center;
      gap: 15px;
      transition: var(--transition);
    }

    .stat-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .stat-icon {
      width: 50px;
      height: 50px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
      color: white;
    }

    .stat-info h3 {
      font-size: 0.9rem;
      color: var(--gray);
      margin-bottom: 5px;
    }

    .stat-value {
      font-size: 1.8rem;
      font-weight: 700;
      color: var(--dark);
    }

    /* Layout for charts */
    .chart-section {
      display: grid;
      grid-template-columns: 2fr 1fr;
      gap: 25px;
      margin-bottom: 30px;
    }

    .chart-large {
      background: white;
      border-radius: var(--border-radius);
      padding: 25px;
      box-shadow: var(--box-shadow);
      display: flex;
      flex-direction: column;
    }

    .chart-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .chart-title {
      font-size: 1.3rem;
      font-weight: 600;
      color: var(--dark);
    }

    .chart-actions {
      display: flex;
      gap: 10px;
    }

    .chart-action-btn {
      background: rgba(67, 97, 238, 0.1);
      border: none;
      border-radius: 6px;
      padding: 6px 12px;
      color: var(--primary);
      font-size: 0.85rem;
      cursor: pointer;
      transition: var(--transition);
    }

    .chart-action-btn:hover {
      background: var(--primary);
      color: white;
    }

    .chart-small {
      display: flex;
      flex-direction: column;
      gap: 25px;
    }

    .chart-card {
      background: white;
      border-radius: var(--border-radius);
      padding: 25px;
      box-shadow: var(--box-shadow);
      display: flex;
      flex-direction: column;
    }

    .chart-card h4 {
      font-size: 1.1rem;
      margin-bottom: 15px;
      color: var(--dark);
    }

    .sales-summary {
      background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
      color: white;
      border-radius: var(--border-radius);
      padding: 25px;
      box-shadow: var(--box-shadow);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
    }

    .sales-summary h3 {
      font-size: 1rem;
      margin-bottom: 10px;
      opacity: 0.9;
    }

    .sales-amount {
      font-size: 2.2rem;
      font-weight: 700;
      margin-bottom: 5px;
    }

    .sales-change {
      display: flex;
      align-items: center;
      gap: 5px;
      font-size: 0.9rem;
      opacity: 0.9;
    }

    .sales-change.positive {
      color: #4ade80;
    }

    .sales-change.negative {
      color: #f87171;
    }

    canvas {
      width: 100% !important;
      height: 300px !important;
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
      .chart-section {
        grid-template-columns: 1fr;
      }

      .chart-small {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 768px) {
      .dashboard-header {
        flex-direction: column;
        align-items: flex-start;
      }

      .dashboard-controls {
        width: 100%;
        justify-content: space-between;
      }

      .stats-container {
        grid-template-columns: repeat(2, 1fr);
      }

      .chart-small {
        grid-template-columns: 1fr;
      }

      .chart-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
      }

      .chart-actions {
        width: 100%;
        justify-content: space-between;
      }
    }

    @media (max-width: 576px) {
      .stats-container {
        grid-template-columns: 1fr;
      }

      .tabs {
        flex-direction: column;
        padding: 5px;
      }

      .dashboard-title {
        font-size: 1.8rem;
      }
    }
  </style>

<body>
  <div class="dashboard">
    <!-- Header -->
    <div class="dashboard-header">
      <h1 class="dashboard-title">
        <i>📊</i> Sales Dashboard
      </h1>
          <div class="tabs">
      <div class="tab active" data-mode="year">
        <span>📅</span> Per Year Sales
      </div>
      <div class="tab" data-mode="month">
        <span>📆</span> Per Month Sales
      </div>
        <div class="tab" data-mode="today">
        <span>📆</span> Today's Sales
      </div>
    </div>

    </div>

    <!-- Stats Cards -->
    <div class="stats-container">
      <div class="stat-card">
        <div class="stat-icon" style="background: var(--primary);">
          💰
        </div>
        <div class="stat-info">
          <h3>Total Sales</h3>
          <div class="stat-value">₱810,000</div>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-icon" style="background: var(--success);">
          📈
        </div>
        <div class="stat-info">
          <h3>Growth</h3>
          <div class="stat-value">--%</div>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-icon" style="background: var(--warning);">
          🎯
        </div>
        <div class="stat-info">
          <h3>Target Achievement</h3>
          <div class="stat-value">--%</div>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-icon" style="background: var(--danger);">
          ⏱️
        </div>
        <div class="stat-info">
          <h3>Avg. Sales Cycle</h3>
          <div class="stat-value">-- Days</div>
        </div>
      </div>
    </div>

    <!-- Charts -->
    <div class="chart-section">
      <div class="chart-large">
        <div class="chart-header">
          <h3 class="chart-title" id="chartTitle">Sales Overview (Per Year)</h3>
          <div class="chart-actions">
            <button class="chart-action-btn">Export</button>
            <button class="chart-action-btn">Share</button>
          </div>
        </div>
        <canvas id="salesChart"></canvas>
      </div>

      <div class="chart-small">
        <div class="chart-card">
          <h4>Sales per Site</h4>
          <canvas id="pqrChart"></canvas>
        </div>

        <div class="chart-card d-none">
          <h4>Sales by Site</h4>
          <canvas id="siteChart"></canvas>
        </div>

      </div>
    </div>
  </div>
  
  <script>




/* ✅ SAMPLE DATA FOR PIE CHART - Sales per Site */
const siteLabels = ["Site A", "Site B", "Site C", "Site D"];
const siteSales = [25000, 18000, 32000, 15000]; // sample values

const ctxSite = document.getElementById("pqrChart").getContext("2d");

let siteChart = new Chart(ctxSite, {
    type: "pie",
    data: {
        labels: siteLabels,
        datasets: [{
            data: siteSales,
            backgroundColor: [
                "#4e79a7",
                "#f28e2b",
                "#e15759",
                "#76b7b2"
            ]
        }]
    },
    plugins: [ChartDataLabels],
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: "bottom"
            },
            datalabels: {
                color: "#ffffff",
                font: {
                    weight: "bold"
                },
                formatter: (value) => "₱" + value.toLocaleString()
            }
        }
    }
});



/* ✅ Load PHP results into JS */
const monthData = <?php echo $month_json ?>;
const yearData  = <?php echo $year_json ?>;

/* ✅ Convert DB results to chart arrays (Fix Month Name) */
const monthLabels = monthData.map(r => {
    const names = ["", "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    return names[r.MONTH];
});
const monthValues = monthData.map(r => Number(r.TOTAL_AMOUNT));

const yearLabels = yearData.map(r => r.YEAR);
const yearValues = yearData.map(r => Number(r.TOTAL_AMOUNT));

/* ✅ Create Chart */
const ctxSales = document.getElementById("salesChart").getContext("2d");
let salesChart = new Chart(ctxSales, {
    type: "bar",
    data: { 
        labels: yearLabels, 
        datasets: [{
            data: yearValues,
            backgroundColor: "#4e79a7",
            borderRadius: 6
        }]
    },
    plugins: [ChartDataLabels],
    options: {
        responsive: true,
        plugins: {
            legend: { display: false },
            datalabels: {
                color: "#FFFFFF",
                anchor: "bottom",
                align: "start",
                rotation: -90,       // ✅ Vertical Label
                clamp: true,
                font: { weight: "bold" },
                formatter: value => "₱" + value.toLocaleString()
            }
        },
        scales: {
            y: { beginAtZero: true }
        }
    }
});


/* ✅ Tab Switch Logic */
$(".tab").click(function () {
    $(".tab").removeClass("active");
    $(this).addClass("active");

    const mode = $(this).data("mode");
    salesChart.destroy();

    if (mode === "year") {
        $("#chartTitle").text("Sales Overview (Per Year)");
        salesChart = new Chart(ctxSales, {
            type: "bar",
            data: { 
                labels: yearLabels, 
                datasets: [{ data: yearValues, backgroundColor: "#4e79a7", borderRadius: 6 }]
            },
            plugins: [ChartDataLabels],
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                      datalabels: {
                color: "#FFFFFF",
                anchor: "bottom",
                align: "start",
                rotation: -90,       // ✅ Vertical Label
                clamp: true,
                font: { weight: "bold" },
                formatter: value => "₱" + value.toLocaleString()
            }
                },
                scales: { y: { beginAtZero: true } }
            }
        });
    }

    if (mode === "month") {
        $("#chartTitle").text("Sales Overview (Per Month)");
        salesChart = new Chart(ctxSales, {
            type: "bar",
            data: { 
                labels: monthLabels, 
                datasets: [{ data: monthValues, backgroundColor: "#4e79a7", borderRadius: 6 }]
            },
            plugins: [ChartDataLabels],
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                      datalabels: {
                color: "#FFFFFF",
                anchor: "bottom",
                align: "start",
                rotation: -90,       // ✅ Vertical Label
                clamp: true,
                font: { weight: "bold" },
                formatter: value => "₱" + value.toLocaleString()
            }
                },
                scales: { y: { beginAtZero: true } }
            }
        });
    }

    if (mode === "today") {
        $("#chartTitle").text("Today's Sales");

        // ✅ If no data for month, today = 0
        const todayValue = monthValues.length > 0 ? monthValues[monthValues.length - 1] : 0;

        salesChart = new Chart(ctxSales, {
            type: "bar",
            data: {
                labels: ["Today"],
                datasets: [{ data: [todayValue], backgroundColor: "#4e79a7", borderRadius: 6 }],
            },
            plugins: [ChartDataLabels],
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                     datalabels: {
                color: "#FFFFFF",
                anchor: "bottom",
                align: "start",
                rotation: -90,       // ✅ Vertical Label
                clamp: true,
                font: { weight: "bold" },
                formatter: value => "₱" + value.toLocaleString()
            }
                },
                scales: { y: { beginAtZero: true } }
            }
        });
    }
});
</script>
