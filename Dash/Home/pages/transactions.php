<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Transactions</title>
  <style>
    /* Remove default link styles and make the entire card clickable */
    .card-link {
      text-decoration: none;
      color: inherit;
      display: block;
    }
    /* Style for the floating cards with fixed size */
    .floating-card {
      background-color: #fff;
      border-radius: 25px;
      padding: 2px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      transition: box-shadow 0.3s, transform 0.3s;
      width: 210px;
      height: 230px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: flex-start;
      box-sizing: border-box;
    }
    .floating-card:hover {
      box-shadow: 0 12px 25px rgba(0,0,0,0.2);
      transform: translateY(-10px);
    }
    /* Style for icons inside cards */
    .card-icon {
      width: 180px;
      height: 130px;
      object-fit: contain;
    }
    /* Style for card titles */
    .card-title {
      font-weight: bold;
      font-size: 1.0rem;
      margin-top: 1px;
      text-align: center;
    }
    /* Style for card text */
    .card-text {
      font-size: 0.7rem;
      color: #555;
      text-align: center;
    }
  </style>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>
<body>
<h3>ORDER MANAGEMENT</h3>

<div class="container py-1">
  <div class="row gy-0 justify-content-start"> <!-- Changed gy-4 to gy-2 for less vertical spacing -->
    <!-- UPLOAD ORDERS Card -->
    <div class="col-md-3 col-sm-6 d-flex justify-content-start">
      <a href="#" class="card-link">
        <div class="floating-card">
          <img src="\Dash\Home\img\transactions\upload.png" class="card-icon" alt="Upload Orders Icon"/>
          <div class="card-title">UPLOAD ORDERS</div>
          <div class="card-text">Upload your orders quickly and easily.</div>
        </div>
      </a>
    </div>
    <!-- ORDER VIEW Card -->
    <div class="col-md-3 col-sm-6 d-flex justify-content-start">
      <a href="#" class="card-link">
        <div class="floating-card">
          <img src="\Dash\Home\img\transactions\vieworders.jpg" class="card-icon" alt="Order View Icon"/>
          <div class="card-title" style="text-align: center;">ORDER VIEW</div>
          <div class="card-text">View and manage your orders seamlessly.</div>
        </div>
      </a>
    </div>
    <!-- ORDER PREPARATION Card -->
    <div class="col-md-3 col-sm-6 d-flex justify-content-start">
      <a href="#" class="card-link">
        <div class="floating-card">
          <img src="\Dash\Home\img\transactions\orderpreps.jpg" class="card-icon" alt="Order Preparation Icon"/>
          <div class="card-title">ORDER PREPARATION</div>
          <div class="card-text">Prepare customer orders and create truck size configurations efficiently.</div>
        </div>
      </a>
    </div>
    <!-- DELIVERY RETRY Card -->
    <div class="col-md-3 col-sm-6 d-flex justify-content-start">
      <a href="#" class="card-link">
        <div class="floating-card">
          <img src="\Dash\Home\img\transactions\retry.jpg" class="card-icon" alt="Delivery Retry Icon"/>
          <div class="card-title">DELIVERY RETRY</div>
          <div class="card-text">Attempt to redeliver the order after a failed delivery attempt.</div>
        </div>
      </a>
    </div>
  </div>
</div>
<h3></h3>
<h3>DELIVERY MANAGEMENT</h3> 

<div class="container">
  <div class="row justify-content-start ">
    <!-- DELIVERY PLAN Card -->
    <div class="col-md-3 col-sm-6 d-flex justify-content-start">
      <a href="#" class="card-link">
        <div class="floating-card">
          <img src="\Dash\Home\img\transactions\plan.jpg" class="card-icon" alt="Delivery Plan Icon"/>
          <div class="card-title">DELIVERY PLAN</div>
          <div class="card-text">Process truck size based on your delivery volume to ensure efficient and cost-effective transportation.</div>
        </div>
      </a>
    </div>
    <!-- REVIEW PLAN Card -->
    <div class="col-md-3 col-sm-6 d-flex justify-content-start">
      <a href="#" class="card-link">
        <div class="floating-card">
          <img src="\Dash\Home\img\transactions\review.jpg" class="card-icon" alt="Review Plan Icon"/>
          <div class="card-title" style="text-align: center;">REVIEW PLAN</div>
          <div class="card-text">Evaluate and analyze the current delivery schedule and logistics strategy to identify improvements.</div>
        </div>
      </a>
    </div>
    <!-- EXECUTION Card -->
    <div class="col-md-3 col-sm-6 d-flex justify-content-start">
      <a href="#" class="card-link">
        <div class="floating-card">
          <img src="\Dash\Home\img\transactions\execution.jpg" class="card-icon" alt="Execution Icon"/>
          <div class="card-title">EXECUTION</div>
          <div class="card-text">Implement the planned logistics operations and ensure timely, accurate delivery of goods</div>
        </div>
      </a>
    </div>
    <!-- RESULT Card -->
    <div class="col-md-3 col-sm-6 d-flex justify-content-start">
      <a href="#" class="card-link">
        <div class="floating-card">
          <img src="\Dash\Home\img\transactions\result.jpg" class="card-icon" alt="Result Icon"/>
          <div class="card-title">RESULT</div>
          <div class="card-text">Summary of delivery outcomes, including on-time performance, accuracy, and customer satisfaction metrics.</div>
        </div>
      </a>
    </div>

    <h6></h6>
    <!-- CASHIER Card -->
    <div class="col-md-3 col-sm-6 mt-3 d-flex justify-content-start">
      <a href="#" class="card-link">
        <div class="floating-card">
          <img src="\Dash\Home\img\transactions\pay.jpg" class="card-icon" alt="Cashier Icon"/>
          <div class="card-title">CASHIER</div>
          <div class="card-text">Manage cashier operations efficiently.</div>
        </div>
      </a>
    </div>
  </div>
</div>

<!-- Bootstrap JS CDN -->

</body>
</html>