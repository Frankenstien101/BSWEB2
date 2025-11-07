
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Petty Cash Management</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
</head>

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

        .filter-container {
        display: flex;
        justify-content: left;
        align-items: left;
        margin-top: 5px;
    }

    .filter-container .card {
        font-size: 9px;
    }

    .filter-container .card-body .row {
        display: flex;
        align-items: top;
         margin-top: 0px;
    }

    .filter-container label {
        font-weight: bold;
        font-size: 9px;
    }

    .filter-container input,
    .filter-container select {
        font-size: 9px;
    }
  </style>

<div class="d-flex align-items-center mb-3">
  <button type="button" class="btn btn-secondary" style="margin-right: 15px;" onclick="history.back();">
    ← Back
  </button>
  <h4 class="mb-0 fw-bold ">Call Creation</h4>
</div>
<hr>
<div class="filter-container">
    <!-- Transaction Details Card -->
    <div class="card text-bg-light" style="font-size: 11px; text-align: left;">
      <header class="card-header fw-bold">Call Details</header>
        <div class="card-body">
            <div class="container-fluid p-0">
                <div class="row">
                    <!-- Row 1 -->
                    <div class="col-md-3 col-sm-6 col-12 mb-0">
                        <label for="transaction_id" class="mb-0">TRANSACTION ID</label>
                        <input type="text" id="transaction_id"  style = "max-width: 100%;" class="form-control form-control-sm" placeholder="Auto generated" readonly>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12 mb-0">
                        <label for="van" class="mb-0">VAN</label>
                        <select id="cmbvan" name="van" class="form-control form-control-sm">
          
                        </select>
                    </div>
                    <div class="col-md-5 col-sm-6 col-12 mb-0">
                        <label for="status" class="mb-0" >STATUS</label>
                        <input type="text" id="status" style = "width: 100px;" class="form-control form-control-sm" value="DRAFT" readonly>
                    </div>

                    <!-- Row 2 -->
                    <div class="col-md-3 col-sm-6 col-12 mb-0">
                        <label for="date_created" class="mb-0">DATE CREATED</label>
                        <input type="date" id="date_created"  style = "max-width: 50%;" class="form-control form-control-sm" value = "<?php echo date('Y-m-d'); ?>" placeholder="Auto"  readonly>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12 mb-0">
                        <label for="warehouse" class="mb-0">WAREHOUSE</label>
                        <select id="warehouse" name="warehouse" class="form-control form-control-sm">
                  
                        </select>
                    </div>
                    <div class="col-md-6 col-sm-6 col-12 mb-0">
                        <label for="remarks" class="mb-0">REMARKS</label>
                        <input type="text" id="remarks" style = "max-width: 100%; font-size : 10px;" class="form-control form-control-sm" placeholder="Remarks">
                    </div>
                </div>
            </div>
        </div>
    </div>

    
</div>




  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>


