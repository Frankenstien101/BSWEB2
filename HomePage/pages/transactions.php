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
      <h1>PURCHASE MANAGEMENT</h1>
    </header>
    <div class="app-container">
      <a href="home.php?page=T_Purchase_Order">
        <div class="app-card">
          <img src="\HomePage\pages\transactionsImg\stock.png" alt="Developers/System Support" />
          <p>PURCHASE ORDER</p>
        </div>
      </a>
      <a href="home.php?page=PO_view">
        <div class="app-card">
          <img src="\HomePage\pages\transactionsImg\checklist.png" alt="Developers/System Support" />
          <p>PURCHASE ORDER VIEW</p>
        </div>
      </a>
            <a href="#" >
        <div class="app-card">
          <img src="\HomePage\pages\transactionsImg\return.png" alt="Developers/System Support" />
          <p>GOODS RECEIVING</p>
        </div>
      </a>
      <a href="#" >
        <div class="app-card">
          <img src="\HomePage\pages\transactionsImg\delay.png" alt="Developers/System Support" />
          <p>PURCHASE RETURNS</p>
        </div>
      </a>
        <a href="#" >
        <div class="app-card">
          <img src="\HomePage\pages\transactionsImg\product-return.png" alt="Developers/System Support" />
          <p>RECEIVING RETURN</p>
        </div>
      </a>
      <br>
      <!-- Add more cards here if needed -->
    </div>

    <header>
      <h1>SALES MANAGEMENT</h1>
    </header>
    <div class="app-container">
      <a href="#" >
        <div class="app-card">
          <img src="\HomePage\pages\transactionsImg\inventory.png" alt="Developers/System Support" />
          <p> CUSTOMER ORDER</p>
        </div>
      </a>
      <a href="#" >
        <div class="app-card">
          <img src="\HomePage\pages\transactionsImg\invoice.png" alt="Developers/System Support" />
          <p>SALES INVOICE</p>
        </div>
      </a>
            <a href="#" >
        <div class="app-card">
          <img src="\HomePage\pages\transactionsImg\cancel.png" alt="Developers/System Support" />
          <p>SALES RETURN</p>
        </div>
      </a>
      <a href="#" >
        <div class="app-card">
          <img src="\HomePage\pages\transactionsImg\payments.png" alt="Developers/System Support" />
          <p>CUSTOMER PAYMENTS</p>
        </div>
      </a>
        <a href="#" >
        <div class="app-card">
          <img src="\HomePage\pages\transactionsImg\uploadso.png" alt="Developers/System Support" />
          <p>SO UPLOAD</p>
        </div>
      </a>
       <a href="#" >
        <div class="app-card">
          <img src="\HomePage\pages\transactionsImg\export.png" alt="Developers/System Support" />
          <p>EXPORT ORDERS</p>
        </div>
      </a>
       <a href="#" >
        <div class="app-card">
          <img src="\HomePage\pages\transactionsImg\bulk.png" alt="Developers/System Support" />
          <p>BULK ALLOCATION</p>
        </div>
      </a>
   </div>

   <header>
      <h1>VAN MANAGEMENT</h1>
    </header>
    <div class="app-container">
      <a href="home.php?page=T_Vanloading" >
        <div class="app-card">
          <img src="\HomePage\pages\transactionsImg\alloc.png" alt="Developers/System Support" />
          <p> VAN ALLOCATION</p>
        </div>
      </a>
      <a href="home.php?page=T_VanLoadHistory" >
        <div class="app-card">
          <img src="\HomePage\pages\transactionsImg\cargo.png" alt="Developers/System Support" />
          <p>VAN LOAD HISTORY</p>
        </div>
      </a>
            <a href="home.php?page=T_VanInventory" >
        <div class="app-card">
          <img src="\HomePage\pages\transactionsImg\inv.png" alt="Developers/System Support" />
          <p>VAN INVENTORY</p>
        </div>
      </a>
      <a href="#" >
        <div class="app-card">
          <img src="\HomePage\pages\transactionsImg\relocate.png" alt="Developers/System Support" />
          <p>VAN STORE RELOCATION</p>
        </div>
      </a>
        <a href="#" >
        <div class="app-card">
          <img src="\HomePage\pages\transactionsImg\pqr.png" alt="Developers/System Support" />
          <p>STORE PQR</p>
        </div>
      </a>
       <a href="#" >
        <div class="app-card">
          <img src="\HomePage\pages\transactionsImg\approval.png" alt="Developers/System Support" />
          <p>NEW STORE APPROVAL</p>
        </div>
      </a>
       <a href="#" >
        <div class="app-card">
          <img src="\HomePage\pages\transactionsImg\cost.png" alt="Developers/System Support" />
          <p>VAN SALES MANUAL</p>
        </div>
      </a>
   </div>

   <header>
      <h1>INVENTORY MANAGEMENT</h1>
    </header>
    <div class="app-container">
      <a href="#" >
        <div class="app-card">
          <img src="\HomePage\pages\transactionsImg\whad.png" alt="Developers/System Support" />
          <p> STOCK ADJUSTMENT</p>
        </div>
      </a>
      <a href="#" >
        <div class="app-card">
          <img src="\HomePage\pages\transactionsImg\stocks.png" alt="Developers/System Support" />
          <p>STOCK TRANSFER</p>
        </div>
      </a>
            <a href="#" >
        <div class="app-card">
          <img src="\HomePage\pages\transactionsImg\updatetruck.png" alt="Developers/System Support" />
          <p>VAN STOCK ADJUSTMENT</p>
        </div>
      </a>
      <a href="#" >
        <div class="app-card">
          <img src="\HomePage\pages\transactionsImg\unload.png" alt="Developers/System Support" />
          <p>VAN STOCK RETURN</p>
        </div>
      </a>
        <a href="#" >
        <div class="app-card">
          <img src="\HomePage\pages\transactionsImg\scanning.png" alt="Developers/System Support" />
          <p>VAN RECON</p>
        </div>
    
   </div>
    
    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
