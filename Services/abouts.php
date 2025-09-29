<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About – BLUESYS Applications</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: #0a0f1a;
      color: #fff;
      line-height: 1.6;
    }

    header {
      text-align: center;
      padding: 40px 20px 20px;
    }
    header h1 {
      font-size: 2.2rem;
      color: #1e90ff;
      text-shadow: 0 0 10px rgba(30, 144, 255, 0.8);
      margin-bottom: 10px;
    }
    header p {
      font-size: 1rem;
      color: #ccc;
    }

    .container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
      gap: 20px;
      padding: 20px;
      max-width: 1100px;
      margin: auto;
    }

    .card {
      background: rgba(20, 30, 50, 0.9);
      border: 1px solid rgba(30, 144, 255, 0.5);
      border-radius: 10px;
      padding: 20px;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      box-shadow: 0 0 12px rgba(30,144,255,0.2);
    }
    .card:hover {
      transform: translateY(-6px);
      box-shadow: 0 0 20px rgba(30,144,255,0.6);
    }
    .card h3 {
      font-size: 1.2rem;
      color: #1e90ff;
      margin-bottom: 10px;
    }
    .card p {
      font-size: 0.9rem;
      color: #ddd;
    }

    footer {
      text-align: center;
      padding: 20px;
      color: #999;
      font-size: 0.85rem;
    }
    footer a {
      color: #1e90ff;
      text-decoration: none;
    }
  </style>
</head>
<body>

  <header>
    <h1>About Our Applications</h1>
    <p>Optimized solutions for distribution, delivery, and management.</p>
  </header>

  <div class="container">
    <!-- Delivery Dash -->
    <div class="card">
      <h3>Delivery Dash</h3>
      <p>Optimizes delivery routes, manages purchases, and tracks delivery performance to ensure faster and more efficient operations.</p>
    </div>

    <!-- Goods Credit -->
    <div class="card">
      <h3>Goods Credit</h3>
      <p>Manages product credits from damaged warehouses and redirects them into new purchases, reducing waste and improving accountability.</p>
    </div>


    <!-- Distributor Management System -->
    <div class="card">
      <h3>Distributor Management System</h3>
      <p>Enhances distributor visibility, covering sales, stock, and territory management to strengthen supply chain efficiency.</p>
    </div>

    <!-- Reporting & Exports -->
    <div class="card">
      <h3>Reporting & Exports</h3>
      <p>Provides customizable dashboards and reports, enabling data-driven decision-making and seamless information sharing across teams.</p>
    </div>
  </div>

   <footer>
    <p>For inquiries and support: 
      <a href="mailto:frankpadios.bspi@gmail.com">frankpadios.bspi@gmail.com</a>
    </p>
  </footer>


</body>
</html>
