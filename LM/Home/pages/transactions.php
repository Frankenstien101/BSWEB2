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
      color:chocolate;
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
  <h3>LOAD MANAGEMENT</h3>
  <div class="section-container">
    <div class="row row-cards d-flex flex-wrap">
      <!-- Wrap each card in a col -->
      <div class="col-auto px-2 first-card">
        <a href="portal.php?page=addnewdevice" class="card-link">
          <div class="card-custom">
            <img src="\LM\Home\img\transactions\sim-card.PNG" class="card-icon mb-4 mt-2" alt="Upload Orders Icon" style="height:100px;"/>
            <div class="card-title">REGISTER NEW</div>
            <div class="card-text">Create your orders quickly and easily.</div>
          </div>
        </a>
      </div>
      <div class="col-auto px-2">
        <a href="portal.php?page=loadchecking" class="card-link">
          <div class="card-custom">
            <img src="\LM\Home\img\transactions\smartphone.png" class="card-icon" alt="Order View Icon"/>
            <div class="card-title">LOAD CHECKING</div>
            <div class="card-text">View and manage your orders seamlessly.</div>
          </div>
        </a>
      </div>
      <div class="col-auto px-2">
        <a href="portal.php?page=loadrequest" class="card-link">
          <div class="card-custom">
            <img src="\LM\Home\img\transactions\sim-req.png" class="card-icon mb-3 mt-3" alt="Order Preparation Icon" style="height:100px;"/>
            <div class="card-title">LOAD REQUEST</div>
            <div class="card-text">Prepare customer orders and create truck size configuration.</div>
          </div>
        </a>
      </div>
            <div class="col-auto px-2">
        <a href="" class="card-link">
          <div class="card-custom">
            <img src="\LM\Home\img\transactions\phone-sim.png" class="card-icon mb-3 mt-3" alt="Order Preparation Icon" style="height:100px;"/>
            <div class="card-title">LOAD PURCHASE</div>
            <div class="card-text">Prepare customer orders and create truck size configuration.</div>
          </div>
        </a>
      </div>
    </div>
  </div>

  
  </div>
</body>
</html>