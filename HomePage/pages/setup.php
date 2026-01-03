<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
     <link rel="icon" type="image/x-icon" href="MainImg\bscr.ico">

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
      <h1>COMPANY</h1>
    </header>
    <div class="app-container">
      <a href="home.php?page=T_Purchase_Order">
        <div class="app-card">
          <img src="\HomePage\pages\setupImg\company.png" alt="Developers/System Support" />
          <p>COMPANY DETAILS</p>
        </div>
      </a>
      <a href="home.php?page=PO_view">
        <div class="app-card">
          <img src="\HomePage\pages\setupImg\warehouse.png" alt="Developers/System Support" />
          <p>WAREHOUSE MASTER</p>
        </div>
      </a>
            <a href="#" >
        <div class="app-card">
          <img src="\HomePage\pages\setupImg\customers.png" alt="Developers/System Support" />
          <p>CUSTOMER MASTER</p>
        </div>
      </a>
      <a href="#" >
        <div class="app-card">
          <img src="\HomePage\pages\setupImg\van.png" alt="Developers/System Support" />
          <p>VAN MASTER</p>
        </div>
      </a>
        
      <br>
      <!-- Add more cards here if needed -->
    </div>

    <header>
      <h1>SELLING MANAGEMENT</h1>
    </header>
    <div class="app-container">
      <a href="home.php?page=coveragesetup" >
        <div class="app-card">
          <img src="\HomePage\pages\setupImg\tracking.png" alt="Developers/System Support" />
          <p> COVERAGE SETUP</p>
        </div>
      </a>
      <a href="#" >
        <div class="app-card">
          <img src="\HomePage\pages\setupImg\tax.png" alt="Developers/System Support" />
          <p>TAX AND MARKUP</p>
        </div>
      </a>
            <a href="#" >
        <div class="app-card">
          <img src="\HomePage\pages\setupImg\userassign.png" alt="Developers/System Support" />
          <p>CUSTOMER ASSIGNMENT</p>
        </div>
      </a>
      <a href="#" >
        <div class="app-card">
          <img src="\HomePage\pages\setupImg\updateprice.png" alt="Developers/System Support" />
          <p>ORDER PRICE UPDATE</p>
        </div>
      </a>
        <a href="#" >
        <div class="app-card">
          <img src="\HomePage\pages\setupImg\updateprice2.png" alt="Developers/System Support" />
          <p>SELL PRICE UPDATE</p>
        </div>
      </a>
   </div>

   <header>
      <h1>REASON CODE AND ADDITIONAL SETUP</h1>
    </header>
    <div class="app-container">
      <a href="home.php?page=T_Vanloading" >
        <div class="app-card">
          <img src="\HomePage\pages\setupImg\reason.png" alt="Developers/System Support" />
          <p>REASON CODE</p>
        </div>
      </a>
      <a href="home.php?page=T_VanLoadHistory" >
        <div class="app-card">
          <img src="\HomePage\pages\setupImg\catseller.png" alt="Developers/System Support" />
          <p>CATEGORY AND SELLER</p>
        </div>
      </a>
        <a href="home.php?page=T_VanInventory" >
        <div class="app-card">
          <img src="\HomePage\pages\setupImg\maspqr.png" alt="Developers/System Support" />
          <p>MAS PQR</p>
        </div>
      </a>
      <a href="#" >
        <div class="app-card">
          <img src="\HomePage\pages\setupImg\discount.png" alt="Developers/System Support" />
          <p>ITEM DISCOUNT</p>
        </div>
      </a>
   </div>

   <header>
      <h1>MOBILE MANAGEMENT</h1>
    </header>
    <div class="app-container">
      <a href="#" >
        <div class="app-card">
          <img src="\HomePage\pages\setupImg\inventoryadjust.png" alt="Developers/System Support" />
          <p> STOCK ADJUSTMENT</p>
        </div>
      </a>
      <a href="#" >
        <div class="app-card">
          <img src="\HomePage\pages\setupImg\sfa.png" alt="Developers/System Support" />
          <p>SFA-SKU MAP</p>
        </div>
      </a>
            <a href="#" >
        <div class="app-card">
          <img src="\HomePage\pages\setupImg\storetomas.png" alt="Developers/System Support" />
          <p>HFS TO MAS TRANSFER</p>
        </div>
      </a>
      <a href="#" >
        <div class="app-card">
          <img src="\HomePage\pages\setupImg\bulkupload.png" alt="Developers/System Support" />
          <p>VSB BULK UPLOAD</p>
        </div>
      </a>
        <a href="#" >
        <div class="app-card">
          <img src="\HomePage\pages\setupImg\posmupload.png" alt="Developers/System Support" />
          <p>HFS POSM UPLOAD</p>
        </div>
     </a>
      <a href="#" >
        <div class="app-card">
          <img src="\HomePage\pages\setupImg\promoupload.png" alt="Developers/System Support" />
          <p>MAS PROMO UPLOAD</p>
        </div>
     </a>
   </div>
    
    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
