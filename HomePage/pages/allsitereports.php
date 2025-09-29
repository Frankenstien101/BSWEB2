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
      <h1>ALL SITE SALES REPORT</h1>
    </header>
    <div class="app-container">
      <a href="home.php?page=allsitesalesinvoicesummary">
        <div class="app-card">
          <img src="\HomePage\pages\reportsimg\invsum.png" alt="Developers/System Support" />
          <p>INVOICE SUMMARY</p>
        </div>
      </a>
      <a href="home.php?page=allsitesalesinvoicedetailed">
        <div class="app-card">
          <img src="\HomePage\pages\reportsimg\invdet.png" alt="Developers/System Support" />
          <p>INVOICE DETAILED</p>
        </div>
      </a>
            <a href="#" >
        <div class="app-card">
          <img src="\HomePage\pages\reportsimg\distribution.png" alt="Developers/System Support" />
          <p>IN-TRANSIT REPORT</p>
        </div>
      </a>
      <a href="#" >
        <div class="app-card">
          <img src="\HomePage\pages\reportsimg\express-delivery.png" alt="Developers/System Support" />
          <p>AGENT PERFORMANCE</p>
        </div>
      </a>
        <a href="#" >
        <div class="app-card">
          <img src="\HomePage\pages\transactionsImg\relocate.png" alt="Developers/System Support" />
          <p>AGENT LOCATION</p>
        </div>
      </a>
      <br>
      <!-- Add more cards here if needed -->
    </div>

    <header>
      <h1>OTHER MASTER REPORT</h1>
    </header>
    <div class="app-container">
      <a href="#" >
        <div class="app-card">
          <img src="\HomePage\pages\reportsimg\team.png" alt="Developers/System Support" />
          <p> CUSTOMER UPLOADS</p>
        </div>
      </a>
      <a href="#" >
        <div class="app-card">
          <img src="\HomePage\pages\reportsimg\sfa.png" alt="Developers/System Support" />
          <p>STORES PQR</p>
        </div>
      </a>
            <a href="#" >
        <div class="app-card">
          <img src="\HomePage\pages\transactionsImg\pqr.png" alt="Developers/System Support" />
          <p>EXPORT PQR</p>
        </div>
      </a>
      <a href="#" >
        <div class="app-card">
          <img src="\HomePage\pages\transactionsImg\payments.png" alt="Developers/System Support" />
          <p>STORE ENDING</p>
        </div>
      </a>
        <a href="home.php?page=allsiteSOReport" >
        <div class="app-card">
          <img src="\HomePage\pages\reportsimg\orders.png" alt="Developers/System Support" />
          <p>SO REPORT</p>
        </div>
      </a>
   </div>

   <header>
      <h1>OTHER INVENTORY REPORT</h1>
    </header>
    <div class="app-container">
      <a href="home.php?page=allsiteVanAllocation" >
        <div class="app-card">
          <img src="\HomePage\pages\transactionsImg\alloc.png" alt="Developers/System Support" />
          <p> VAN ALLOCATION</p>
        </div>
      </a>
     
    
    <!-- Optional JavaScript -->

  </body>
</html>
