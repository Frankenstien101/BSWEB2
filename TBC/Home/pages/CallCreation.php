<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Call Creation</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>

  <style>
    body {
      background:#f0f2f5;
      
    }
    .page-title {
      font-weight: bold;
    }
    .outer-wrapper {
      max-width: 100%;
      margin: 0 auto;
      margin-left: -10px;
      width: 100%;
      height: 100%;

    }

    /* Main container left/right */
    .main-container {
      display: flex;
      background: #fff;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      margin-left: 1px;
      margin-right: -1px;
      width: 100%;

    }

    .main-left {
      padding: 25px;
      width: 65%;
      background: #f7f9fb;
      border-right: 1px solid #ddd;
    }
    .main-right {
      padding: 25px;
      width: 45%;
      background: #ffffff;
    }

    /* Force card alignment */
    .card {
      border-radius: 10px;
    }

    .form-label {
      font-size: 11px;
      margin-bottom: 3px;
      font-weight: bold;
      font-size: 10px;
    }

    .form-control-sm {
      font-size: 10px;
    }

    .btn-sm {
      font-size: 12px;
    }
  </style>
</head>

<body>

<div class="outer-wrapper">

  <!-- HEADER -->
  <div class="d-flex align-items-center mb-0 mt-0">
    <button type="button" class="btn btn-secondary btn-sm mr-2" onclick="history.back();">
      ← Back
    </button>
    <h4 class="page-title mb-0">Call Creation</h4>
  </div>
  <hr>

  <!-- MAIN CONTENT (two-column layout) -->
  <div class="main-container">

    <!-- LEFT SIDE -->
    <div class="main-left">

      <!-- CALL FORM CARD -->
      <div class="card mb-3">
        <div class="card-header" style = "height: 45px; margin-top: -5px;">
          <button class="btn btn-primary btn-sm" id="newTransBtn">
            <i class="fas fa-plus"></i> New Call
          </button>
        </div>

        <div class="card-body">
          <div class="container-fluid p-0">

            <div class="row">

              <!-- CUSTOMER ID -->
              <div class="col-md-4 col-sm-6 col-12 mb-0">
                <label class="form-label">CUSTOMER ID</label>
                <input type="text" style="font-size: 10px; width: 60%;" class="form-control form-control-sm" id="field1" readonly>
              </div>

              <!-- VAN -->
              <div class="col-md-4 col-sm-6 col-12 mb-0">
                <label class="form-label">VAN</label>
                <input type="text" style="font-size: 10px;" class="form-control form-control-sm" id="field2" readonly>
              </div>

              <!-- SELLER -->
              <div class="col-md-4 col-sm-6 col-12 mb-0">
                <label class="form-label">SELLER</label>
                <input type="text" class="form-control form-control-sm" id="field3" readonly>
              </div>

              <!-- CUSTOMER NAME -->
              <div class="col-md-4 col-sm-6 col-12 mb-0">
                <label class="form-label">CUSTOMER NAME</label>
                <input type="text" class="form-control form-control-sm" readonly>
              </div>

              <!-- PHONE NUMBER + UPDATE -->
              <div class="col-md-4 col-sm-6 col-12 mb-0">
                <label class="form-label">PHONE NUMBER</label>
                <div class="d-flex">
                  <input type="text" maxlength="12" inputmode="numeric" style = "width: 60%; font-weight: bold;"
                         class="form-control form-control-sm mr-2" id="field4">
                  <button class="btn btn-primary btn-sm" style = "width: 40%; margin-top: -1px;">UPDATE</button>
                </div>
              </div>

              <!-- STATUS -->
              <div class="col-md-4 col-sm-6 col-12 mb-0">
                <label class="form-label">STATUS</label>
                <input type="text" style= "width: 40%;" class="form-control form-control-sm" id="field5" value="DRAFT" readonly>
              </div>

              <!-- INVOICE -->
              <div class="col-md-4 col-sm-6 col-12 mb-0">
                <label class="form-label">INVOICE NUMBER</label>
                <input type="text" class="form-control form-control-sm" id="field6">
              </div>

              <!-- AMOUNT + START CALL -->
              <div class="col-md-4 col-sm-6 col-12 mb-0">
                <label class="form-label">AMOUNT</label>
                <div class="d-flex">
                  <input type="text" style ="width: 60%;" class="form-control form-control-sm mr-2" id="field9">
                  <button class="btn btn-success btn-sm" style = "width: 40%; font-weight: bold; height: 38px; margin-top: -5px;">START CALL</button>
                </div>
              </div>

            </div>

          </div>
        </div>
      </div>

      <!-- CALL DETAILS CARD -->
      <div class="card" style="height: 45vh;">
        <div class="card-header">
          <strong>Call Details</strong>
        </div>
        <div class="card-body">
          <p class="card-text">
            Place your call details here.  
            You can make tables, forms, logs, summaries, etc.
          </p>
          <button class="btn btn-primary btn-sm">Go somewhere</button>
        </div>
      </div>

    </div>

    <!-- RIGHT SIDE -->
    <div class="main-right">
      <h5 class="fw-bold">CALL RESULT</h5>
      <p>This side is for results, call logs, notes, follow-up actions, etc.</p>
    </div>

  </div>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</body>
</html>
