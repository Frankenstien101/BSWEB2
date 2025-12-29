<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Call Creation</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>

  <style>


  .card-group .card {
    margin-right: 10px;
    width: 50px;
    height: 150px;
  }

  

  .card-headertime {
    font-size: 1.2rem;
    text-align: center;
    margin-top: 10px;
    border-bottom: 1px solid #fff;
  } 

  .card-titletime {
    font-size: 1.2rem;
    text-align: center;
  }

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

    .card card-title {
      font-size: 10px;
      font-weight: bold;
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
                <input type="text" style="font-size: 10px; width: 60%;" class="form-control form-control-sm" id="customeridtxt" readonly>
              </div>

              <!-- VAN -->
              <div class="col-md-4 col-sm-6 col-12 mb-0">
                <label class="form-label">VAN</label>
                <input type="text" style="font-size: 10px;" class="form-control form-control-sm" id="vantxt" readonly>
              </div>

              <!-- SELLER -->
              <div class="col-md-4 col-sm-6 col-12 mb-0">
                <label class="form-label">SELLER</label>
                <input type="text" class="form-control form-control-sm" id="sellertxt" readonly>
              </div>

              <!-- CUSTOMER NAME -->
              <div class="col-md-4 col-sm-6 col-12 mb-0">
                <label class="form-label">CUSTOMER NAME</label>
                <input type="text" class="form-control form-control-sm" id="customerNametxt" readonly>
              </div>

              <!-- PHONE NUMBER + UPDATE -->
              <div class="col-md-4 col-sm-6 col-12 mb-0">
                <label class="form-label">PHONE NUMBER</label>
                <div class="d-flex">
                  <input type="number" maxlength="12" inputmode="numeric" style = "width: 60%; font-weight: bold;"
                         class="form-control form-control-sm mr-2" id="phoneNumbertxt">
                  <button class="btn btn-primary btn-sm" style = "width: 40%; margin-top: -1px;" onclick="updatePhoneNumber()">UPDATE</button>
                </div>
              </div>

              <!-- STATUS -->
              <div class="col-md-4 col-sm-6 col-12 mb-0">
                <label class="form-label">STATUS</label>
                <input type="text" style= "width: 40%;" class="form-control form-control-sm" id="statustxt" value="DRAFT" readonly>
              </div>

              <!-- INVOICE -->
              <div class="col-md-4 col-sm-6 col-12 mb-0">
                <label class="form-label">INVOICE NUMBER</label>
                <input type="text" class="form-control form-control-sm" id="invoiceNumbertxt" inputmode="numeric">
              </div>

              <!-- AMOUNT + START CALL -->
              <div class="col-md-4 col-sm-6 col-12 mb-0">
                <label class="form-label">AMOUNT</label>
                <div class="d-flex">
                  <input type="number" style ="width: 60%;" class="form-control form-control-sm mr-2" id="amounttxt">
                  <button class="btn btn-success btn-sm" onclick="startcall()" style = "width: 40%; font-weight: bold; height: 38px; margin-top: -5px;">START CALL</button>
                </div>
              </div>

            </div>

          </div>
        </div>
      </div>

      <!-- CALL DETAILS CARD -->
      <div class="card" style="height: 48vh;">
        <div class="card-header mb-1" style = "height: 48px; margin-top: -5px;">
          <strong>Call Details</strong>
        </div>
        <div class="card-body">
         <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="intro-tab" data-toggle="tab" href="#intro" role="tab" aria-controls="intro" aria-selected="true">Introduction</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="verification-tab" data-toggle="tab" href="#verification" role="tab" aria-controls="verification" aria-selected="false">Verification</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="storevisit-tab" data-toggle="tab" href="#storevisit" role="tab" aria-controls="storevisit" aria-selected="false">Store Visit</a>
  </li>
   <li class="nav-item" role="presentation">
    <a class="nav-link" id="prodcall-tab" data-toggle="tab" href="#prodcall" role="tab" aria-controls="prodcall" aria-selected="false">Prod Call</a>
  </li>
   <li class="nav-item" role="presentation">
    <a class="nav-link" id="amount-tab" data-toggle="tab" href="#amount" role="tab" aria-controls="amount" aria-selected="false">Amount</a>
  </li>
   <li class="nav-item" role="presentation">
    <a class="nav-link" id="endcall-tab" data-toggle="tab" href="#endcall" role="tab" aria-controls="endcall" aria-selected="false">End call</a>
  </li>
</ul>


<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="intro" role="tabpanel" aria-labelledby="intro-tab">
    <H6></H6><p></p>
      <H1></H1>
  
Good Morning/Afternoon!    <H1></H1>
Taga - "INTRODUCE YOURSELF USING OUR STRONGEST BRANDS!"
Ako po si (pangalan) mula sa Bluesun/WDC/Nebraska/KFI. Kami po ang nag
bebenta ngSafeguard, Ariel, Silver Swan, Papa Ketchup, Datu Puti, Del Monte,
Breadbox, Eden, Tang,Tambal ni unilab (biogesic, Neosep)


<div class="text-left mt-3">
<button class="btn btn-danger">Cannot Be Reached</button>
</button>
</div>
<div class="text-left mt-1">
<button class="btn btn-danger">Not Picked</button>
</button>
</div>
<div class="text-left mt-1">
<button class="btn btn-danger">Wrong Number</button>
</button>
</div>

<div class="text-right mt-3">
<button class="btn btn-primary next-tab">Next</button>
    
  </button>
</div>

  </div>
  <div class="tab-pane fade" id="verification" role="tabpanel" aria-labelledby="verification-tab">
    <h1></h1>
      <H6>VERIFICATION</H6><p></p>
      <H1></H1>
  
Tanong ko lang po kung (sabihin ang pangalang ng tindahan) po ang pangalan ng
tindahan ninyo? at kung tama po ang address ninyo na (sabihin ang address)?
  <H1></H1>
<div class="form-group">
  <label class="font-weight-bold d-block">Answer:</label>

  <div class="custom-control custom-radio custom-control-inline">
    <input type="radio"
           id="resultCorrect"
           name="verificationStatus"
           value="CORRECT"
           class="custom-control-input">
    <label class="custom-control-label text-success" for="resultCorrect">
      ✅ Correct
    </label>
  </div>

  <div class="custom-control custom-radio custom-control-inline">
    <input type="radio"
           id="resultIncorrect"
           name="verificationStatus"
           value="INCORRECT"
           class="custom-control-input">
    <label class="custom-control-label text-danger" for="resultIncorrect">
      ❌ Incorrect
    </label>
  </div>
</div>

<div id="incorrectFields" style="display:none;">

  <!-- Store Name -->
  <div class="form-group row align-items-center mb-1">
    <label class="col-sm-2 col-form-label py-0" style="font-size:11px;">
      Store Name
    </label>
    <div class="col-sm-5">
      <input type="text" class="form-control form-control-sm" id="storeName">
    </div>
  </div>

  <!-- Store Address -->
  <div class="form-group row align-items-center mb-1">
    <label class="col-sm-2 col-form-label py-0" style="font-size:11px;">
      Store Address
    </label>
    <div class="col-sm-7">
      <textarea class="form-control form-control-sm" id="storeAddress" rows="2"></textarea>
    </div>
  </div>

</div>

<div class="text-right mt-3">
<button class="btn btn-primary next-tab">Next</button>
</div>
</div>

<!-- Store Visit -->

<div class="tab-pane fade" id="storevisit" role="tabpanel" aria-labelledby="storevisit-tab">
    <h1></h1>
      <H6>VERIFICATION</H6><p></p>
      <H1></H1>
  
Salamat po mam/sir. Mangayo lang unta mig gamay na oras para magvalidate maam/sir.
1. Nibisita ba ang among panel sa inyo gahapon maam/Sir (or last week for Neb)

  <H1></H1>
<div class="form-group">
  <label class="font-weight-bold d-block">Answer:</label>

  <div class="custom-control custom-radio custom-control-inline">
    <input type="radio"
           id="visitedCorrect"
           name="storeVisitStatus"
           value="CORRECT"
           class="custom-control-input">
    <label class="custom-control-label text-success" for="visitedCorrect">
      ✅ VISITED
    </label>
  </div>

  <div class="custom-control custom-radio custom-control-inline">
    <input type="radio"
           id="visitedIncorrect"
           name="storeVisitStatus"
           value="INCORRECT"
           class="custom-control-input">
    <label class="custom-control-label text-danger" for="visitedIncorrect">
      ❌ NOT VISITED
    </label>
  </div>
</div>

<div class="text-right mt-3">
<button class="btn btn-primary next-tab">Next</button>
</div>
</div>



<!-- Prod Call -->

<div class="tab-pane fade" id="prodcall" role="tabpanel" aria-labelledby="prodcall-tab">
    <h1></h1>
      <H6>VERIFICATION</H6><p></p>
      <H1></H1>
  
Salamat maam/sir. Nipalit pud ba mo maam/Sir?
  <H1></H1>
<div class="form-group">
  <label class="font-weight-bold d-block">Answer:</label>

  <div class="custom-control custom-radio custom-control-inline">
    <input type="radio"
           id="purchasedCorrect"
           name="purchaseStatus"
           value="CORRECT"
           class="custom-control-input">
    <label class="custom-control-label text-success" for="purchasedCorrect">
      ✅ YES
    </label>
  </div>

  <div class="custom-control custom-radio custom-control-inline">
    <input type="radio"
           id="purchasedIncorrect"
           name="purchaseStatus"
           value="INCORRECT"
           class="custom-control-input">
    <label class="custom-control-label text-danger" for="purchasedIncorrect">
      ❌ NO
    </label>
  </div>


  <div class="custom-control custom-radio custom-control-inline">
    <input type="radio"
           id="purchasedCantRemember"
           name="purchaseStatus"
           value="INCORRECT"
           class="custom-control-input">
    <label class="custom-control-label text-dark" for="purchasedCantRemember">
       ❓CAN'T REMEMBER
    </label>
  </div>
</div>

<div class="text-right mt-3">
<button class="btn btn-primary next-tab">Next</button>
</div>
</div>


<!-- Amount -->

<div class="tab-pane fade" id="amount" role="tabpanel" aria-labelledby="amount-tab">
    <h1></h1>
      <H6>VERIFICATION</H6><p></p>
      <H1></H1>
  
Mga pila pud na amount imong napalit maam/sir?
  <H1></H1>
If within the range amount reflected in system/invoice – VERIFIED
(and put the amount mentioned by store)
IF NOT MATCHED – put INCORRECT AMOUNT;
  <H1></H1>

<div class="form-group">
  <label class="font-weight-bold d-block">Answer:</label>

  <div class="custom-control custom-radio custom-control-inline">
    <input type="radio"
           id="amountCorrect"
           name="amountStatus"
           value="CORRECT"
           class="custom-control-input">
    <label class="custom-control-label text-success" for="amountCorrect">
      ✅ MATCHED
    </label>
  </div>

  <div class="custom-control custom-radio custom-control-inline">
    <input type="radio"
           id="amountIncorrect"
           name="amountStatus"
           value="INCORRECT"
           class="custom-control-input">
    <label class="custom-control-label text-danger" for="amountIncorrect">
      ❌ NOT MATCHED
    </label>
  </div>


  <div class="custom-control custom-radio custom-control-inline">
    <input type="radio"
           id="amountCantRemember"
           name="amountStatus"
           value="INCORRECT"
           class="custom-control-input">
    <label class="custom-control-label text-dark" for="amountCantRemember">
       ❓CAN'T REMEMBER
    </label>
  </div>
</div>


<div id="amountIncorrectfields" style="display:none;">

  <!-- Correct Amount -->
  <div class="form-group row align-items-center mb-1">
    <label class="col-sm-2 col-form-label py-0" style="font-size:11px;">
      Amount Purchased
    </label>
    <div class="col-sm-5">
      <input type="text" class="form-control form-control-sm" id="amountPurchased">
    </div>
  </div>

</div>

<div class="text-right mt-3">
<button class="btn btn-primary next-tab">Next</button>
</div>
</div>


<!-- End Call -->

<div class="tab-pane fade" id="endcall" role="tabpanel" aria-labelledby="endcall-tab">

<p><center>Salamat sa pakig-istorya sa amoa, ma'am/sir. Maayong adlaw. Paalam.
</center></p>

  <H1></H1>


<div class="text-center mt-3">
<button class="btn btn-danger next-tab" onclick="endcall()">END CALL</button>
</div>
</div>


  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
  </div>
  </div>
      </div>

    </div>





    <!-- RIGHT SIDE -->
    <div class="main-right">
      <h5 class="fw-bold">CALL RESULT</h5>


<div class="card text-white bg-dark mb-3" style="max-width: 10rem; height: 110px;">
  <div class="card-headertime">Call Duration</div>
  <div class="card-body">
    <h5 class="card-titletime" id="callTimer">00:00:00</h5>
  </div>
</div>



<div class="card-group">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Store Name Right?</h5>
      <input type="text" class="form-control form-control-sm" id="storeNameRight" style="border:none; background-color: ; text-align: center; font-size: 1rem;" value = "YES" readonly>
    <p class="card-text"></p>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Phone # Correct?</h5>
      <input type="text" class="form-control form-control-sm" id="phoneNumberCorrect" style="border:none; background-color: ; text-align: center; font-size: 1rem;" value = "YES" readonly>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Is Store Visited?</h5>
      <input type="text" class="form-control form-control-sm" id="storeVisited" style="border:none; background-color: ; text-align: center; font-size: 1rem;" value = "YES" readonly>
    </div>
  </div>
</div>


<div class="card-group mt-2">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Productive Call?</h5>
      <input type="text" class="form-control form-control-sm" id="productiveCall" style="border:none; background-color: ; text-align: center; font-size: 1rem;" value = "YES" readonly>
    <p class="card-text"></p>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Amount Correct?</h5>
      <input type="text" class="form-control form-control-sm" id="amountCorrect" style="border:none; background-color: ; text-align: center; font-size: 1rem;" value = "YES" readonly>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Amount Verified</h5>
      <input type="text" class="form-control form-control-sm" id="amountVerified" style="border:none; background-color: ; text-align: center; font-size: 1rem;" value = "YES" readonly>
    </div>
  </div>
</div>

<div class="text-center mt-3">
<button class="btn btn-success" id="submitcallbtn">SUBMIT CALL</button>
</div>
</div>

    </div>

  </div>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<script>

  function toggleIncorrectFields() {
  const isIncorrect = document.getElementById('resultIncorrect').checked;

  const storeName = document.getElementById('storeName');
  const storeAddress = document.getElementById('storeAddress');

  document.getElementById('incorrectFields').style.display = isIncorrect ? 'block' : 'none';

  storeName.required = isIncorrect;
  storeAddress.required = isIncorrect;
}
  document.getElementById('resultCorrect').addEventListener('change', toggleIncorrectFields);
  document.getElementById('resultIncorrect').addEventListener('change', toggleIncorrectFields
);


  function toggleamountIncorrectFields() {
  const isIncorrect = document.getElementById('amountIncorrect').checked;
  const isnotremember = document.getElementById('amountCantRemember').checked;

  const amountPurchased = document.getElementById('amountPurchased');

  document.getElementById('amountIncorrectfields').style.display = isIncorrect ? 'block' : 'none';
  document.getElementById('amountCantRememberfields').style.display = isnotremember ? 'block' : 'none';

  amountPurchased.required = isIncorrect;
}
  document.getElementById('amountCorrect').addEventListener('change', toggleamountIncorrectFields);
  document.getElementById('amountIncorrect').addEventListener('change', toggleamountIncorrectFields
);

  function activateFirstTab() {
  $('#myTab a:first').tab('show');
}

  $('.next-tab').click(function () {
    let $active = $('.nav-tabs .nav-link.active');
    let $next = $active.parent().next().find('.nav-link');

    if ($next.length) {
      $next.tab('show');
    }
  });

  $('#newTransBtn').click(function () {
    $('#newCallModal').modal('show');
  });

function updatePhoneNumber() {
    const phoneNumber = document.getElementById('phoneNumbertxt').value;
    const customerId = document.getElementById('customeridtxt').value;
   // alert('Phone number updated to: ' + phoneNumber);

   if (!customerId) {
        alert('Customer ID is missing. Cannot update phone number.');
        return;
    }

    if (!phoneNumber) {
        alert('Please enter a phone number.');
        return;
    }

 fetch(`/TBC/datafetcher/transaction/callcreation_data.php?action=updatephonenumber&phonenumber=${encodeURIComponent(phoneNumber)}&customerid=${encodeURIComponent(customerId)}`)
                .then(response => {
                    if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
                    return response.json();
                })
                .then(result => {
                    if (result.success === true) {
                       // alert('Item removed successfully.');
                        alert('Phone number updated successfully.');
                    } else {
                        console.warn('Response data:', result);
                    }
                })
                .catch(error => {
                    console.error('Error removing item:', error);
                    alert(`Error: ${error.message}`);
                });
    // Here you can add code to send the updated phone number to the server if needed
  }

function startcall() {
    // Implement start call functionality here
    const customerId = document.getElementById('customeridtxt').value;
    const phoneNumber = document.getElementById('phoneNumbertxt').value;
    const amount = document.getElementById('amounttxt').value;
    const invoiceNumber = document.getElementById('invoiceNumbertxt').value;

if (!customerId) {
        alert('Customer ID is missing. Cannot start call.');
        return;
    }

    if (!phoneNumber) {
        alert('Please enter a phone number.');
        return;

    }

     if (!invoiceNumber) {
        alert('Please enter an invoice number.');
        return;
    }

    if (!amount) {
        alert('Please enter an amount.');
        return;

    }

activateFirstTab();
  //  alert('Call started for Customer ID: ' + customerId + '\nPhone Number: ' + phoneNumber + '\nAmount: ' + amount + '\nInvoice Number: ' + invoiceNumber);
  
 // startCallTimer();

}

  let callSeconds = 0;
  let callInterval = null;

  function startCallTimer() {
    callInterval = setInterval(() => {
      callSeconds++;

      const hours = String(Math.floor(callSeconds / 3600)).padStart(2, '0');
      const minutes = String(Math.floor((callSeconds % 3600) / 60)).padStart(2, '0');
      const seconds = String(callSeconds % 60).padStart(2, '0');

      document.getElementById('callTimer').textContent = 
        `${hours}:${minutes}:${seconds}`;
    }, 1000);
  }

  function stopCallTimer() {
    clearInterval(callInterval);
  }

  // ✅ Auto-start when page loads
  document.addEventListener("DOMContentLoaded", startCallTimer);

  // ✅ Stop when END CALL button is clicked
  document.getElementById("endCallBtn")?.addEventListener("click", stopCallTimer);

function endcall() {
    stopCallTimer();
    alert('Call ended. Duration: ' + document.getElementById('callTimer').textContent);
  }


</script>

</body>
</html>
