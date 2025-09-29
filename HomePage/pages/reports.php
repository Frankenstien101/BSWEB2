<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Transactions</title>
    <style>
      body {
        margin: 0;
        font-family: Arial, sans-serif;
        background-color: #0a0a10;
        color: black;
        text-align: center;
      }

      h1 {
        margin: 10px 0;
        font-size: 1.0em;
        color: #080000ff;
        
      }

      .app-container {
        display: flex;
        justify-content: left;
        align-items: flex-start;
        gap: 20px;
        padding: 20px;
        flex-wrap: wrap;
      }

      .app-card {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        transition: transform 0.3s ease;
        text-align: center;
        padding: 20px;
        cursor: pointer;
         width: 110px;
        height: 120px;
      }

      .app-card:hover {
        transform: scale(1.15);
      }

      .app-card img {
        width: 50px;
        height: 50px;
        margin-bottom: 10px;
      }

      .app-card p {
        margin: 10;
  font-weight: bold;
  color: #000;
  font-family: 'Segoe UI', Arial, sans-serif;
  font-size: 11px;
      }

      a {
        text-decoration: none;
        color: inherit;
       font-family: Arial, sans-serif;

      }

           header {
        color: white;
        padding: 0px;
         text-align: left;
      }

    </style>
  </head>
  <body>
    <header>
      <h1>MASTER DATA</h1>
    </header>
    <div class="app-container">
      <a href="home.php?page=ProductMasterReport">
        <div class="app-card">
          <img src="\HomePage\pages\reportsimg\dairy-products.png" alt="Developers/System Support" />
          <p>PRODUCT MASTER</p>
        </div>
      </a>
      <a href="home.php?page=CustomerMasterReport">
        <div class="app-card">
          <img src="\HomePage\pages\reportsimg\team.png" alt="Developers/System Support" />
          <p>CUSTOMERS</p>
        </div>
      </a>
            <a href="home.php?page=SellerMasterReport" >
        <div class="app-card">
          <img src="\HomePage\pages\reportsimg\businessman.png" alt="Developers/System Support" />
          <p>SELLERS</p>
        </div>
      </a>
      <a href="home.php?page=CoverageReport" >
        <div class="app-card">
          <img src="\HomePage\pages\reportsimg\map.png" alt="Developers/System Support" />
          <p>COVERAGE</p>
        </div>
      </a>
        <a href="home.php?page=WarehouseMasterReport" >
        <div class="app-card">
          <img src="\HomePage\pages\reportsimg\wh.png" alt="Developers/System Support" />
          <p>WAREHOUSE MASTER</p>
        </div>
      </a>

      </a>
        <a href="home.php?page=SchemeMasterReport" >
        <div class="app-card">
          <img src="\HomePage\pages\reportsimg\bonus.png" alt="Developers/System Support" />
          <p>SCHEME MASTER</p>
        </div>
      </a>
      </a>
        <a href="#" >
        <div class="app-card">
          <img src="\HomePage\pages\reportsimg\map2.png" alt="Developers/System Support" />
          <p>COVERAGE MAP</p>
        </div>
      </a>

      </a>
        <a href="#" >
        <div class="app-card">
          <img src="\HomePage\pages\reportsimg\route.png" alt="Developers/System Support" />
          <p>SELLER ON MARKET</p>
        </div>
      </a>
      <br>
      <!-- Add more cards here if needed -->
    </div>

    <header>
      <h1>PURCHASES</h1>
    </header>
    <div class="app-container">
      <a href="home.php?page=IntransitSummary" >
        <div class="app-card">
          <img src="\HomePage\pages\reportsimg\express-delivery.png" alt="Developers/System Support" />
          <p> IN-TRANSIT SUMMARY</p>
        </div>
      </a>
      <a href="home.php?page=intransitdetailedReport" >
        <div class="app-card">
          <img src="\HomePage\pages\reportsimg\distribution.png" alt="Developers/System Support" />
          <p>IN-TRANSIT DETAILED</p>
        </div>
      </a>
            <a href="home.php?page=PurchasereturnReport" >
        <div class="app-card">
          <img src="\HomePage\pages\reportsimg\bo.png" alt="Developers/System Support" />
          <p>PURCHASE RETURN</p>
        </div>
      </a>
      <a href="home.php?page=StockViewReport" >
        <div class="app-card">
          <img src="\HomePage\pages\reportsimg\stocks.png" alt="Developers/System Support" />
          <p>STOCK VIEW</p>
        </div>
      </a>
        <a href="home.php?page=VanAllocationReport" >
        <div class="app-card">
          <img src="\HomePage\pages\reportsimg\v1.png" alt="Developers/System Support" />
          <p>VAN ALLOCATION</p>
        </div>
      </a>
      
   </div>

   <header>
      <h1>SALES</h1>
    </header>
    <div class="app-container">
      <a href="home.php?page=InvoiceSummaryReport" >
        <div class="app-card">
          <img src="\HomePage\pages\reportsimg\invsum.png" alt="Developers/System Support" />
          <p> INVOICE SUMMARY</p>
        </div>
      </a>
      <a href="home.php?page=InvoiceDetailedReport" >
        <div class="app-card">
          <img src="\HomePage\pages\reportsimg\invdet.png" alt="Developers/System Support" />
          <p>INVOICE DETAILED</p>
        </div>
      </a>
            <a href="home.php?page=SalesReturnReport" >
        <div class="app-card">
          <img src="\HomePage\pages\reportsimg\invreturn.png" alt="Developers/System Support" />
          <p>SALES RETURN</p>
        </div>
      </a>
      <a href="#" >
        <div class="app-card">
          <img src="\HomePage\pages\reportsimg\vfr.png" alt="Developers/System Support" />
          <p>VFR REPORT</p>
        </div>
      </a>
        <a href="#" >
        <div class="app-card">
          <img src="\HomePage\pages\reportsimg\bo2.png" alt="Developers/System Support" />
          <p>STORE BO</p>
        </div>
      </a>
       <a href="home.php?page=SOReport" >
        <div class="app-card">
          <img src="\HomePage\pages\reportsimg\orders.png" alt="Developers/System Support" />
          <p>SO REPORT</p>
        </div>
      </a>
       <a href="#" >
        <div class="app-card">
          <img src="\HomePage\pages\reportsimg\del.png" alt="Developers/System Support" />
          <p>DELIVERY REPORT</p>
        </div>
      </a>
   </div>

   <header>
      <h1>OTHER REPORTS</h1>
    </header>
    <div class="app-container">
      <a href="home.php?page=VanStockReport" >
        <div class="app-card">
          <img src="\HomePage\pages\reportsimg\vanstock.png" alt="Developers/System Support" />
          <p> VAN STOCK REPORT</p>
        </div>
      </a>
      <a href="#" >
        <div class="app-card">
          <img src="\HomePage\pages\reportsimg\ar.png" alt="Developers/System Support" />
          <p>A/R REPORTS</p>
        </div>
      </a>
      <a href="home.php?page=allsitereports" >
        <div class="app-card">
          <img src="\HomePage\pages\reportsimg\allsite.png" alt="Developers/System Support" />
          <p>ALL SITE REPORTS</p>
        </div>
      </a>
      <a href="home.php?page=SFAMappingReport" >
        <div class="app-card">
          <img src="\HomePage\pages\reportsimg\sfa.png" alt="Developers/System Support" />
          <p>SFA MAPPING</p>
        </div>
      </a>
        <a href="home.php?page=StockLedgerReport" >
        <div class="app-card">
          <img src="\HomePage\pages\reportsimg\ledger.png" alt="Developers/System Support" />
          <p>STOCK LEDGER</p>
        </div>
    
   </div>
    
    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
