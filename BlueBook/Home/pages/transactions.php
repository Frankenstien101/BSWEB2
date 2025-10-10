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

  <h3>TRANSACTIONAL</h3>
  <div class="section-container">
    <div class="row row-cards d-flex flex-wrap">
      <!-- Wrap each card in a col -->
      <div class="col-auto px-2 first-card">
        <a href="#" class="card-link">
          <div class="card-custom">
            <img src="\BlueBook\Home\img\transactions\receipt.jpg" class="card-icon" alt="Upload Orders Icon"/>
            <div class="card-title">📥 Receipts / Income</div>
            <div class="card-text">Track money coming into your business.</div>
          </div>
        </a>
      </div>
      <div class="col-auto px-2">
        <a href="#" class="card-link">
          <div class="card-custom">
            <img src="\BlueBook\Home\img\transactions\payments.jpg" class="card-icon" alt="Order View Icon"/>
            <div class="card-title">📤 Payments / Expenses</div>
            <div class="card-text">Log outgoing payments and bills.</div>
          </div>
        </a>
      </div>
      <div class="col-auto px-2">
        <a href="#" class="card-link">
          <div class="card-custom">
            <img src="\BlueBook\Home\img\transactions\debit.png" class="card-icon" alt="Order Preparation Icon"/>
            <div class="card-title">🔄 Journal Entries</div>
            <div class="card-text">Enter manual debit and credit records.</div>
          </div>
        </a>
      </div>
      <div class="col-auto px-2">
        <a href="#" class="card-link">
          <div class="card-custom">
            <img src="\BlueBook\Home\img\transactions\deposit.jpg" class="card-icon" alt="Delivery Retry Icon"/>
            <div class="card-title">🏦 Bank Deposits & Withdrawal</div>
            <div class="card-text">Record bank-related cash flow.</div>
          </div>
        </a>
      </div>
       <div class="col-auto px-2">
        <a href="#" class="card-link">
          <div class="card-custom">
            <img src="\BlueBook\Home\img\transactions\pettycash.jpg" class="card-icon" alt="Delivery Retry Icon"/>
            <div class="card-title">🪙 Petty Cash</div>
            <div class="card-text">Manage small day-to-day cash expenses like office supplies and travel costs.</div>
          </div>
        </a>
      </div>
       <div class="col-auto px-2">
        <a href="#" class="card-link">
          <div class="card-custom">
            <img src="\BlueBook\Home\img\transactions\refund.jpg" class="card-icon" alt="Delivery Retry Icon"/>
            <div class="card-title">💸 Refund</div>
            <div class="card-text">Record and track money returned to customers/employees.</div>
          </div>
        </a>
      </div>
    </div>
  </div>

  <h3>ACCOUNTS</h3>
  <div class="section-container">
    <div class="row row-cards d-flex flex-wrap">
      <div class="col-auto px-2">
        <a href="#" class="card-link">
          <div class="card-custom">
            <img src="\BlueBook\Home\img\transactions\chart.jpg" class="card-icon" alt="Delivery Plan Icon"/>
            <div class="card-title">🏦 Chart of Accounts</div>
            <div class="card-text">List and organize all accounts used in bookkeeping.</div>
          </div>
        </a>
      </div>
      <div class="col-auto px-2">
        <a href="#" class="card-link">
          <div class="card-custom">
            <img src="\BlueBook\Home\img\transactions\generalledger.jpg" class="card-icon" alt="Review Plan Icon"/>
            <div class="card-title" style="text-align: center;">📂 General Ledger</div>
            <div class="card-text">View all transactions affecting your accounts.</div>
          </div>
        </a>
      </div>
      <div class="col-auto px-2">
        <a href="#" class="card-link">
          <div class="card-custom">
            <img src="\BlueBook\Home\img\transactions\ar.jpg" class="card-icon" alt="Execution Icon"/>
            <div class="card-title">💵 Accounts Receivable</div>
            <div class="card-text">Monitor customer debts and payments.</div>
          </div>
        </a>
      </div>
      <div class="col-auto px-2">
        <a href="#" class="card-link">
          <div class="card-custom">
            <img src="\BlueBook\Home\img\transactions\payable.jpg" class="card-icon" alt="Result Icon"/>
            <div class="card-title">💳 Accounts Payable</div>
            <div class="card-text">Track supplier bills and pending dues.</div>
          </div>
        </a>
      </div>
      <div class="col-auto px-2">
        <a href="#" class="card-link">
          <div class="card-custom">
            <img src="\Dash\Home\img\transactions\pay.jpg" class="card-icon" alt="Cashier Icon"/>
            <div class="card-title">🔎 Trial Balance</div>
            <div class="card-text">Summarize account balances to ensure accuracy.</div>
          </div>
        </a>
      </div>
    </div>
  </div>

   <h3>INVENTORY</h3>
  <div class="section-container">
    <div class="row row-cards d-flex flex-wrap">
      <!-- Wrap each card in a col -->
      <div class="col-auto px-2 first-card">
        <a href="#" class="card-link">
          <div class="card-custom">
            <img src="\Dash\Home\img\transactions\upload.png" class="card-icon" alt="Upload Orders Icon"/>
            <div class="card-title">📦 Products & Services</div>
            <div class="card-text">Manage items you sell or purchase.</div>
          </div>
        </a>
      </div>
      <div class="col-auto px-2">
        <a href="#" class="card-link">
          <div class="card-custom">
            <img src="\Dash\Home\img\transactions\vieworders.jpg" class="card-icon" alt="Order View Icon"/>
            <div class="card-title">📥 Purchases</div>
            <div class="card-text">Record goods bought from suppliers.</div>
          </div>
        </a>
      </div>
      <div class="col-auto px-2">
        <a href="#" class="card-link">
          <div class="card-custom">
            <img src="\Dash\Home\img\transactions\orderpreps.jpg" class="card-icon" alt="Order Preparation Icon"/>
            <div class="card-title">📤 Sales</div>
            <div class="card-text">Track items sold to customers.</div>
          </div>
        </a>
      </div>
      <div class="col-auto px-2">
        <a href="#" class="card-link">
          <div class="card-custom">
            <img src="\Dash\Home\img\transactions\retry.jpg" class="card-icon" alt="Delivery Retry Icon"/>
            <div class="card-title">📊 Stock Movement Report</div>
            <div class="card-text">Monitor stock-in and stock-out activities.</div>
          </div>
        </a>
      </div>
    </div>
  </div>

   <h3>BILLING AND INVOICING</h3>
  <div class="section-container">
    <div class="row row-cards d-flex flex-wrap">
      <!-- Wrap each card in a col -->
      <div class="col-auto px-2 first-card">
        <a href="#" class="card-link">
          <div class="card-custom">
            <img src="\BlueBook\Home\img\transactions\invoice.jpg" class="card-icon" alt="Upload Orders Icon"/>
            <div class="card-title">🧾 Create Invoice</div>
            <div class="card-text">Generate a new invoice.</div>
          </div>
        </a>
      </div>
      <div class="col-auto px-2">
        <a href="#" class="card-link">
          <div class="card-custom">
            <img src="\BlueBook\Home\img\transactions\sendinvoice.jpg" class="card-icon" alt="Order View Icon"/>
            <div class="card-title">📤 Send Invoice</div>
            <div class="card-text">Email or print invoices for customers.</div>
          </div>
        </a>
      </div>
      <div class="col-auto px-2">
        <a href="#" class="card-link">
          <div class="card-custom">
            <img src="\BlueBook\Home\img\transactions\cuspayments.jpg" class="card-icon" alt="Order Preparation Icon"/>
            <div class="card-title">💸 Customer Payments</div>
            <div class="card-text">Record received payments.</div>
          </div>
        </a>
      </div>
      <div class="col-auto px-2">
        <a href="#" class="card-link">
          <div class="card-custom">
            <img src="\BlueBook\Home\img\transactions\paymenthistory.jpg" class="card-icon" alt="Delivery Retry Icon"/>
            <div class="card-title">📑 Invoice History</div>
            <div class="card-text">Review past invoices and their statuses.</div>
          </div>
        </a>
      </div>
    </div>
  </div>

   <h3>BANKING</h3>
  <div class="section-container">
    <div class="row row-cards d-flex flex-wrap">
      <!-- Wrap each card in a col -->
      <div class="col-auto px-2 first-card">
        <a href="#" class="card-link">
          <div class="card-custom">
            <img src="\BlueBook\Home\img\transactions\bankaccount.png" class="card-icon" alt="Upload Orders Icon"/>
            <div class="card-title">🏦 Bank Accounts</div>
            <div class="card-text">Add and manage linked accounts.</div>
          </div>
        </a>
      </div>
      <div class="col-auto px-2">
        <a href="#" class="card-link">
          <div class="card-custom">
            <img src="\BlueBook\Home\img\transactions\bankrecon.png" class="card-icon" alt="Order View Icon"/>
            <div class="card-title">🔄 Bank Reconciliation</div>
            <div class="card-text">Match accounting records with bank statements..</div>
          </div>
        </a>
      </div>
      <div class="col-auto px-2">
        <a href="#" class="card-link">
          <div class="card-custom">
            <img src="\BlueBook\Home\img\transactions\banktransfer.jpg" class="card-icon" alt="Order Preparation Icon"/>
            <div class="card-title">💱 Fund Transfers</div>
            <div class="card-text">Record money moved between accounts.</div>
          </div>
        </a>
      </div>
      <div class="col-auto px-2">
        <a href="#" class="card-link">
          <div class="card-custom">
            <img src="\BlueBook\Home\img\transactions\bankstatements.jpg" class="card-icon" alt="Delivery Retry Icon"/>
            <div class="card-title">📜 Bank Statements</div>
            <div class="card-text">View and download transaction history.</div>
          </div>
        </a>
      </div>
    </div>
  </div>

   <h3>TAXES</h3>
  <div class="section-container">
    <div class="row row-cards d-flex flex-wrap">
      <div class="col-auto px-2 first-card">
        <a href="#" class="card-link">
          <div class="card-custom">
            <img src="\BlueBook\Home\img\transactions\tax.png" class="card-icon" alt="Upload Orders Icon"/>
            <div class="card-title">🧾 VAT / Sales Tax</div>
            <div class="card-text">Record and calculate tax on sales/purchases.</div>
          </div>
        </a>
      </div>
      <div class="col-auto px-2">
        <a href="#" class="card-link">
          <div class="card-custom">
            <img src="\BlueBook\Home\img\transactions\taxfile.jpg" class="card-icon" alt="Order View Icon"/>
            <div class="card-title">💰 Tax Filing</div>
            <div class="card-text">Prepare reports for tax submission.</div>
          </div>
        </a>
      </div>
      <div class="col-auto px-2">
        <a href="#" class="card-link">
          <div class="card-custom">
            <img src="\BlueBook\Home\img\transactions\taxded.jpeg" class="card-icon" alt="Order Preparation Icon"/>
            <div class="card-title">📑 Tax Deductions</div>
            <div class="card-text">Track deductible expenses.</div>
          </div>
        </a>
      </div>
      <div class="col-auto px-2">
        <a href="#" class="card-link">
          <div class="card-custom">
            <img src="\BlueBook\Home\img\transactions\taxsum.jpg" class="card-icon" alt="Delivery Retry Icon"/>
            <div class="card-title">📝 Tax Summary</div>
            <div class="card-text">Get a consolidated view of taxes due.</div>
          </div>
        </a>
      </div>
    </div>
  </div>

   <h3>PAYROLL</h3>
  <div class="section-container">
    <div class="row row-cards d-flex flex-wrap">
      <div class="col-auto px-2 first-card">
        <a href="#" class="card-link">
          <div class="card-custom">
            <img src="\Dash\Home\img\transactions\upload.png" class="card-icon" alt="Upload Orders Icon"/>
            <div class="card-title">👤 Employee Management</div>
            <div class="card-text">Add and manage employee details.</div>
          </div>
        </a>
      </div>
      <div class="col-auto px-2">
        <a href="#" class="card-link">
          <div class="card-custom">
            <img src="\Dash\Home\img\transactions\vieworders.jpg" class="card-icon" alt="Order View Icon"/>
            <div class="card-title">💵 Salary Processing</div>
            <div class="card-text">Calculate and process wages.</div>
          </div>
        </a>
      </div>
      <div class="col-auto px-2">
        <a href="#" class="card-link">
          <div class="card-custom">
            <img src="\Dash\Home\img\transactions\orderpreps.jpg" class="card-icon" alt="Order Preparation Icon"/>
            <div class="card-title">📆 Payslip History</div>
            <div class="card-text">Store and access issued payslips.</div>
          </div>
        </a>
      </div>
      <div class="col-auto px-2">
        <a href="#" class="card-link">
          <div class="card-custom">
            <img src="\Dash\Home\img\transactions\retry.jpg" class="card-icon" alt="Delivery Retry Icon"/>
            <div class="card-title">🧾 Payroll Reports</div>
            <div class="card-text">Generate salary and deduction summaries.</div>
          </div>
        </a>
      </div>
    </div>
  </div>

</body>
</html>