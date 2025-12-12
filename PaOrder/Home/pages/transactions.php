<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Transactions</title>
  <style>
    h3 {
      margin-top: 50px;
      margin-bottom: 20px;
      padding-left: 15px;
      font-weight: bold;
    }
    .section-container {
      padding-left: 15px;
      padding-right: 15px;
    }
    /* Card styles */
    .card-custom {
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      width: 200px;
      height: 270px;
      margin: 10px;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 15px;
      transition: transform 0.3s, box-shadow 0.3s;
    }
    .card-custom:hover {
      transform: translateY(-8px);
      box-shadow: 0 12px 20px rgba(0,0,0,0.2);
    }
    .card-icon {
      width: 180px;
      height: 130px;
      object-fit: contain;
    }
    .card-title {
      margin-top: 10px;
      font-weight: bold;
      font-size: 1rem;
      text-align: center;
    }
    .card-text {
      margin-top: 6px;
      font-size: 0.75rem;
      color: #555;
      text-align: center;
    }

    /* Adjust margins for mobile to align the first card */
    @media (max-width: 767.98px) {
      /* Remove side margins for first child to align precisely */
      .row-cards > .col:first-child {
        padding-left: 0;
      }
    }
  </style>
  <!-- Bootstrap CSS CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
</head>
<body>
  <h3>ORDER MANAGEMENT</h3>
  <div class="section-container">
    <div class="row row-cards d-flex flex-wrap">
      <!-- Wrap each card in a col -->
      <div class="col-auto px-2 first-card">
        <a href="#" class="card-link">
          <div class="card-custom">
            <img src="\Dash\Home\img\transactions\upload.png" class="card-icon" alt="Upload Orders Icon"/>
            <div class="card-title">UPLOAD ORDERS</div>
            <div class="card-text">Upload your orders quickly and easily.</div>
          </div>
        </a>
      </div>
      <div class="col-auto px-2">
        <a href="#" class="card-link">
          <div class="card-custom">
            <img src="\Dash\Home\img\transactions\vieworders.jpg" class="card-icon" alt="Order View Icon"/>
            <div class="card-title">ORDER VIEW</div>
            <div class="card-text">View and manage your orders seamlessly.</div>
          </div>
        </a>
      </div>
      <div class="col-auto px-2">
        <a href="#" class="card-link">
          <div class="card-custom">
            <img src="\Dash\Home\img\transactions\orderpreps.jpg" class="card-icon" alt="Order Preparation Icon"/>
            <div class="card-title">ORDER PREPARATION</div>
            <div class="card-text">Prepare customer orders and create truck size configurations efficiently.</div>
          </div>
        </a>
      </div>
      <div class="col-auto px-2">
        <a href="#" class="card-link">
          <div class="card-custom">
            <img src="\Dash\Home\img\transactions\retry.jpg" class="card-icon" alt="Delivery Retry Icon"/>
            <div class="card-title">DELIVERY RETRY</div>
            <div class="card-text">Attempt to redeliver the order after a failed delivery attempt.</div>
          </div>
        </a>
      </div>
    </div>
  </div>

  <h3>DELIVERY MANAGEMENT</h3>
  <div class="section-container">
    <div class="row row-cards d-flex flex-wrap">
      <div class="col-auto px-2">
        <a href="#" class="card-link">
          <div class="card-custom">
            <img src="\Dash\Home\img\transactions\plan.jpg" class="card-icon" alt="Delivery Plan Icon"/>
            <div class="card-title">DELIVERY PLAN</div>
            <div class="card-text">Process truck size based on your delivery volume to ensure efficient and cost-effective transportation.</div>
          </div>
        </a>
      </div>
      <div class="col-auto px-2">
        <a href="#" class="card-link">
          <div class="card-custom">
            <img src="\Dash\Home\img\transactions\review.jpg" class="card-icon" alt="Review Plan Icon"/>
            <div class="card-title" style="text-align: center;">REVIEW PLAN</div>
            <div class="card-text">Evaluate and analyze the current delivery schedule and logistics strategy to identify improvements.</div>
          </div>
        </a>
      </div>
      <div class="col-auto px-2">
        <a href="#" class="card-link">
          <div class="card-custom">
            <img src="\Dash\Home\img\transactions\execution.jpg" class="card-icon" alt="Execution Icon"/>
            <div class="card-title">EXECUTION</div>
            <div class="card-text">Implement the planned logistics operations and ensure timely, accurate delivery of goods.</div>
          </div>
        </a>
      </div>
      <div class="col-auto px-2">
        <a href="#" class="card-link">
          <div class="card-custom">
            <img src="\Dash\Home\img\transactions\result.jpg" class="card-icon" alt="Result Icon"/>
            <div class="card-title">RESULT</div>
            <div class="card-text">Summary of delivery outcomes, including on-time performance, accuracy, and customer satisfaction metrics.</div>
          </div>
        </a>
      </div>
      <div class="col-auto px-2">
        <a href="#" class="card-link">
          <div class="card-custom">
            <img src="\Dash\Home\img\transactions\pay.jpg" class="card-icon" alt="Cashier Icon"/>
            <div class="card-title">CASHIER</div>
            <div class="card-text">Manage cashier operations efficiently.</div>
          </div>
        </a>
      </div>
    </div>
  </div>
</body>
</html>