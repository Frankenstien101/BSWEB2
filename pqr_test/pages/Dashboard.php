<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sales Dashboard</title>

  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <!-- Chart.js Data Labels plugin -->
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
      max-width: 1400px;
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
</head>
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
          <div class="stat-value">$810,000</div>
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

    <!-- Tabs -->

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
    // Data
    const monthlySales2025 = [12000, 15000, 18000, 22000, 25000, 30000, 28000, 35000, 40000, 42000, 45000, 47000];
    const yearlySales = {
      2023: 170000,
      2024: 250000,
      2025: 390000
    };

    const siteSales = {
      KOR: 150000,
      DVO: 120000,
      CDO: 90000
    };

    const pqrData = {
      executed: 75,
      pending: 15,
      failed: 10
    };

    // PQR Chart
    const ctxPqr = document.getElementById("pqrChart").getContext("2d");
    new Chart(ctxPqr, {
      type: "doughnut",
      data: {
        labels: ["KOR", "DVO", "CDO"],
        datasets: [
          {
            data: [pqrData.executed, pqrData.pending, pqrData.failed],
            backgroundColor: ["#2ecc71", "#f1c40f", "#e74c3c"],
            borderWidth: 0,
          },
        ],
      },
      options: {
        plugins: { 
          legend: { 
            position: "bottom",
            labels: {
              padding: 20,
              usePointStyle: true,
            }
          } 
        },
        responsive: true,
        cutout: '70%',
      },
    });

    // Site Sales Chart
    const ctxSite = document.getElementById("siteChart").getContext("2d");
    new Chart(ctxSite, {
      type: "bar",
      data: {
        labels: Object.keys(siteSales),
        datasets: [
          {
            label: "Site Sales ($)",
            data: Object.values(siteSales),
            backgroundColor: ["#4e79a7", "#59a14f", "#9c755f"],
            borderRadius: 6,
          },
        ],
      },
      options: {
        responsive: true,
        plugins: {
          legend: { display: false },
          datalabels: {
            anchor: "end",
            align: "top",
            formatter: (val) => "$" + val.toLocaleString(),
            color: "#333",
            font: {
              weight: 'bold'
            }
          },
        },
        scales: { 
          y: { 
            beginAtZero: true,
            grid: {
              drawBorder: false
            }
          },
          x: {
            grid: {
              display: false
            }
          }
        },
      },
      plugins: [ChartDataLabels],
    });

    // Sales Chart
    const ctxSales = document.getElementById("salesChart").getContext("2d");
    let salesChart = new Chart(ctxSales, {
      type: "bar",
      data: {
        labels: ["2023", "2024", "2025"],
        datasets: [
          {
            label: "Total Sales ($)",
            data: Object.values(yearlySales),
            backgroundColor: "#4e79a7",
            borderRadius: 6,
          },
        ],
      },
      options: {
        responsive: true,
        plugins: {
          legend: { display: false },
          datalabels: {
            anchor: "end",
            align: "top",
            formatter: (val) => "$" + val.toLocaleString(),
            color: "#333",
            font: {
              weight: 'bold'
            }
          },
        },
        scales: { 
          y: { 
            beginAtZero: true,
            grid: {
              drawBorder: false
            }
          },
          x: {
            grid: {
              display: false
            }
          }
        },
      },
      plugins: [ChartDataLabels],
    });

    $("#totalSales").text(`$${yearlySales[2025].toLocaleString()}`);

    // Tab switch handler
    $(".tab").click(function () {
    $(".tab").removeClass("active");
    $(this).addClass("active");

      const mode = $(this).data("mode");
      if (mode === "year") {
        $("#chartTitle").text("Sales Overview (Per Year)");
        salesChart.destroy();
        salesChart = new Chart(ctxSales, {
          type: "bar",
          data: {
            labels: ["2023", "2024", "2025"],
            datasets: [
              {
                label: "Total Sales ($)",
                data: Object.values(yearlySales),
                backgroundColor: "#4e79a7",
                borderRadius: 6,
              },
            ],
          },
          options: {
            responsive: true,
            plugins: {
              legend: { display: true },
              datalabels: {
                anchor: "end",
                align: "top",
                formatter: (val) => "$" + val.toLocaleString(),
                color: "#333",
                font: {
                  weight: 'bold'
                }
              },
            },
            scales: { 
              y: { 
                beginAtZero: true,
                grid: {
                  drawBorder: false
                }
              },
              x: {
                grid: {
                  display: false
                }
              }
            },
          },
          plugins: [ChartDataLabels],
        });
        $("#totalSales").text(`$${yearlySales[2025].toLocaleString()}`);
      }
      else {
        $("#chartTitle").text("Sales Overview (Per Month, 2025)");
        salesChart.destroy();
        salesChart = new Chart(ctxSales, {
          type: "bar",
          data: {
            labels: [
              "Jan", "Feb", "Mar", "Apr", "May", "Jun",
              "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
            ],
            datasets: [
              {
                label: "Monthly Sales ($)",
                data: monthlySales2025,
                 backgroundColor: "#4e79a7",
                borderRadius: 6,
              },
            ],
          },
          options: {
            responsive: true,
            plugins: {
              legend: { display: false },
              datalabels: {
                anchor: "end",
                align: "top",
                formatter: (val) => "$" + val.toLocaleString(),
                color: "#333",
                font: {
                  weight: 'bold'
                }
              },
            },
            scales: { 
              y: { 
                beginAtZero: true,
                grid: {
                  drawBorder: false
                }
              },
              x: {
                grid: {
                  display: false
                }
              }
            },
          },
          plugins: [ChartDataLabels],
        });

        const total2025 = monthlySales2025.reduce((a, b) => a + b, 0);
        $("#totalSales").text(`$${total2025.toLocaleString()}`);
      }
    });
  </script>
</body>
</html>