<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <!-- <link stylesheet="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css"> -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" />
   
   <!-- Bootstrap CSS -->

<!-- DataTables CSS -->
<link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

  
   <style>
      .autocomplete-list {
        position: absolute;
        z-index: 1000;
        background: #fff;
        border: 1px solid #ccc;
        width: 100%;
        max-height: 150px;
        overflow-y: auto;
      }
      .autocomplete-item {
        padding: 5px 10px;
        cursor: pointer;
      }
      .autocomplete-item:hover {
        background-color: #f1f1f1;
      }
      .card {
        font-family: 'Roboto', sans-serif;
        font-size: 9px;
      }
      .card .form-label,
      .card .form-control,
      .card .btn {
        font-family: inherit;
        font-size: inherit;
      }
      .mb-31 {
        font-family: 'Roboto', sans-serif;
        font-size: 8px;
        margin-top: 5px;
        margin-bottom: -2px;
      }
      .input-item {
        font-family: 'Roboto', sans-serif;
        font-size: 9px;
        
      }

      .toast-container {
  pointer-events: none; /* Ignore pointer events */
  position: fixed;
  bottom: 5px;
  right: 5px;
  min-width: 200px;
  z-index: 1080;
}

.toast-container .toast {
  pointer-events: auto; /* Enable pointer events on toast only */
}
      .toast-header {
        font-family: 'Roboto', sans-serif;
        font-size: 12px;
      }
      .toast-body {
        font-family: 'Roboto', sans-serif;
        font-size: 12px;
      }
    </style>
  </head>
  <body>

    <h3>PURCHASE ORDER</h3>

       <button id="newTransBtn" style ="font-size : 12px;" class="btn btn-primary mb-1">New Transaction</button>
        <button type="button" class="btn btn-primary mb-1" style ="font-size : 12px;" data-bs-toggle="modal" data-bs-target="#loadTransModal">
          Load Transaction
        </button>  
    
      <div class="row align-items-start">
        <div class="col-sm-4 ">
          <div class="card card-outline card-primary mb-1">
            <div class="container-fluid text-left">
              <div class="row align-items-start">
                <div class="col-sm-4">
                  <div class="mb-31">
                    <label for="po_number" class="form-label">PO NUMBER</label>
                    <input type="text" id="poNumber" class="form-control" readonly>
                  </div>
                  <div class="mb-31">
                    <label for="po_date" class="form-label">PO DATE</label>
                    <input type="date" class="form-control" id="po_date" value="<?php echo date('Y-m-d'); ?>" style="width: 100%">
                  </div>
                  <div class="mb-31">
                    <label for="expected_days" class="form-label">EXPECTED DAYS</label>
                    <input type="number" class="form-control" id="expected_days" value="1" style="width: 50%">
                  </div>
                  <br>
                </div>
                <div class="col-sm-8">
                  <div class="mb-31">
                    <label for="po_number" class="form-label">ADDRESS</label>
                    <input type="text" class="form-control" id="address" placeholder="Enter Address" style="width:100%">
                  </div>
                  <div class="mb-31">
                    <label for="po_number" class="form-label">PRICING</label>
                    <input type="text" class="form-control" id="pricing" disabled placeholder="" style="width:25%">
                  </div>
                  <div class="mb-31">
                    <label for="po_number" class="form-label">STATUS</label>
                    <input type="text" class="form-control" id="status" disabled placeholder="" style="width:25%">
                  </div>
                </div>
              </div>
            </div>
          </div>     
        </div>
      </div>   

<div class="card mb-2 shadow-sm">
  <div class="card-body d-flex flex-wrap align-items-center gap-2">
    <!-- Search input with autocomplete dropdown -->
    <div class="position-relative flex-fill" style="max-width: 550px;">
      <input type="text" id="productSearch" class="form-control form-control-sm" placeholder="Search product..." aria-label="Product Search" autocomplete="off" />
      <div id="productResults" class="autocomplete-list position-absolute top-100 start-0 mt-1 bg-white border rounded shadow-sm w-100 z-index-1050"></div>
    </div>

    <!-- Hidden inputs for data -->
    <div class="d-none">
      <input type="hidden" id="selectedItemId" />
      <input type="hidden" id="selectedDescription" />
      <input type="hidden" id="selectedCSPrice" />
      <input type="hidden" id="selectedITPrice" />
      <input type="hidden" id="selectedItemsPerCase" />
      <input type="hidden" id="selectedBrand" />
      <input type="hidden" id="selectedITBarcode" />
      <input type="hidden" id="selectedCaseBarcode" />
      <input type="hidden" id="selectedtotalamount" />
      <input type="hidden" id="updatecscost" />
      <input type="hidden" id="updateitcost" />
      <input type="hidden" id="updateitpersw" />
    </div>

    <!-- Quantity inputs -->
    <div class="d-flex align-items-center gap-1">
      <div class="d-flex align-items-center">
        <label for="CStosave" class="form-label mb-0 me-1 ml-1 fw-bold">CS</label>
        <input type="number" id="CStosave" class="form-control form-control-sm" style="width: 70px;" placeholder="CS" />
      </div>
      <div class="d-flex align-items-center">
        <label for="SWtosave" class="form-label mb-0 me-1 ml-1 fw-bold">SW</label>
        <input type="number" id="SWtosave" class="form-control form-control-sm" style="width: 70px;" placeholder="SW" />
      </div>
      <div class="d-flex align-items-center">
        <label for="ITtosave" class="form-label mb-0 me-1 ml-1 fw-bold">IT</label>
        <input type="number" id="ITtosave" class="form-control form-control-sm" style="width: 70px;" placeholder="IT" />
      </div>

      <!-- Add to list button -->
      <button type="button" id="addtolist" style ="font-size : 12px;" class="btn btn-success d-flex align-items-center ml-1">
        <i class="bi bi-plus-lg me-1"></i> Add to list
      </button>
    </div>
  </div>
</div>
    
    <!-- item details -->
    <div class="card text-bg-light" data-bs-spy="scroll" style="max-width: 100%; height: 50%; margin-bottom: .5rem;">
      <div class="card-header">ITEM DETAILS</div>
      <div class="card-body" style="overflow-y: auto; height: 360px;" >
        <table id="itemsTable" class="table table-striped table-hover table-bordered table-sm ">
          
  <thead>
    <tr>
      <th>#</th>
       <th>CASE BARCODE</th>
        <th>IT BARCODE</th>
      <th>ITEM_ID</th>
      <th>DESCRIPTION</th>
      <th>PO_CS</th>
      <th>PO_SW</th>
      <th>PO_IT</th>
      <th>AMOUNT</th>
      <th>ACTION</th>
    </tr>
  </thead>
  <tbody>
    <!-- Filled dynamically -->
  </tbody>

            <!-- ...repeat rows as needed... -->
          </tbody>
        </table>
      </div>
    </div>
    <!-- below btn -->
<div class="card mb-0 shadow-sm">
  <div class="card-body row align-items-center p-1 m-1">
    <!-- Left side: Total lines and Total amount -->
    <div class="col d-flex flex-wrap align-items-center gap-1 px-3">
      <div class="d-flex align-items-center">
        <label for="totallines" class="me-1 fw-bold mb-0 ml-1">Total lines:</label>
        <input type="text" id="totallines" class="form-control form-control-sm" placeholder="0" readonly aria-label="Total lines" style="width: 60px;" value="0" />
      </div>
      <div class="d-flex align-items-center">
        <label for="totalamount" class="me-1 fw-bold mb-0 ml-1">Total Amount:</label>
        <input type="text" id="totalamount" class="form-control form-control-sm" placeholder="0" readonly aria-label="Total amount" style="width: 100px;" value="0" />
      </div>
    </div>
    <!-- Right side: Button -->
    <div class="col-auto text-end pe-1">

      <button type="button" id="btnprocess" onclick="confirmProcessPO('#poNumber')" class="btn btn-success ml-1 mr-0" style="width: 140px; height: 40px; font-size:12px;">Process Order</button>
   
      <button class="btn btn-info btn-bg ml-1 mr-0 "  style="width: 70px; height: 40px; font-size:12px;" onclick="print()">
    <i class="fas fa-print"></i> Print
  </button>

    </div>

   
  </div>
</div>
    
  
  <div class="modal fade" id="processConfirmModal" tabindex="-1" role="dialog" aria-labelledby="processConfirmLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title" id="processConfirmLabel">Confirm Processing</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span>&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to process this Purchase Order?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" id="confirmProcessBtn" class="btn btn-success">Yes, Process</button>
      </div>
    </div>
  </div>
</div>
  
<div aria-live="polite" aria-atomic="true" style="position: fixed; bottom: 80px; right: 20px; min-width: 250px; z-index: 1080; pointer-events: none;">
  <div class="toast" id="itemSavedToast" data-delay="100">
    <div class="toast-header bg-success text-white">
      <strong class="mr-auto">Success</strong>
      <small>Just now</small>
      <button type="button" class="ml-2 mb-1 close text-white" data-dismiss="toast">&times;</button>
    </div>
    <div class="toast-body">
      Item saved successfully!
    </div>
  </div>
</div>


<div aria-live="polite" aria-atomic="true" style="position: fixed; bottom: 80px; right: 20px; min-width: 250px; z-index: 1080; pointer-events: none;">
  <div class="toast" id="itemExistToast" data-delay="100">
    <div class="toast-header bg-danger text-white">
      <strong class="mr-auto">Sorry</strong>
      <small>Just now</small>
      <button type="button" class="ml-2 mb-1 close text-white" data-dismiss="toast">&times;</button>
    </div>
    <div class="toast-body">
      Item already on the list!
    </div>
  </div>
</div>

<div aria-live="polite" aria-atomic="true" style="position: fixed; bottom: 80px; right: 20px; min-width: 250px; z-index: 1080; pointer-events: none;">
  <div class="toast" id="updated" data-delay="100">
    <div class="toast-header bg-success text-white">
      <strong class="mr-auto">Complete</strong>
      <small>Just now</small>
      <button type="button" class="ml-2 mb-1 close text-white" data-dismiss="toast">&times;</button>
    </div>
    <div class="toast-body">
      Data updated successfully!
    </div>
  </div>
</div>

<div aria-live="polite" aria-atomic="true" style="position: fixed; bottom: 80px; right: 20px; min-width: 250px; z-index: 1080; pointer-events: none;">
  <div class="toast" id="removed" data-delay="100">
    <div class="toast-header bg-success text-white">
      <strong class="mr-auto">Complete</strong>
      <small>Just now</small>
      <button type="button" class="ml-2 mb-1 close text-white" data-dismiss="toast">&times;</button>
    </div>
    <div class="toast-body">
      Data removed successfully!
    </div>
  </div>
</div>

<div aria-live="polite" aria-atomic="true" style="position: fixed; bottom: 80px; right: 20px; min-width: 250px; z-index: 1080; pointer-events: none;">
  <div class="toast" id="poprocessed" data-delay="1000">
    <div class="toast-header bg-success text-white">
      <strong class="mr-auto">Complete</strong>
      <small>Just now</small>
      <button type="button" class="ml-2 mb-1 close text-white" data-dismiss="toast">&times;</button>
    </div>
    <div class="toast-body">
      P.O Transaction processed successfully!
    </div>
  </div>
</div>

  <!-- Modal -->


<!-- Modal -->
<div class="modal fade" id="loadTransModal" tabindex="-1" aria-labelledby="loadTransModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loadTransModalLabel">Load Transactions</h5>
        <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close" style = "font-size:15px" >Close</button>
      </div>
      <div class="modal-body">

<div class="mb-3 row align-items-center g-2">
  <label for="dateFrom" class="col-auto col-form-label fw-semibold mb-3">From:</label>
  <div class="col-auto p-0">
    <input type="date" id="dateFrom" class="form-control form-control-sm mb-3" aria-label="From date" style="min-width: 120px;" value="<?php echo date('Y-m-d'); ?>">
  </div>

  <label for="dateTo" class="col-auto col-form-label fw-semibold mb-3 ms-3">To:</label>
  <div class="col-auto p-0 mb-3">
    <input type="date" id="dateTo" class="form-control form-control-sm" aria-label="To date" style="min-width: 120px;" value="<?php echo date('Y-m-d'); ?>">
  </div>
 &nbsp;
  <div class="col-auto p-0 mb-3">

<button id="filterbtn" 
  onclick= "loadItemsByDateRange()"
  class="btn btn-primary btn-sm" style="width:100px">
  Filter
</button>
 
</div>

<div class="card text-bg-light" data-bs-spy="scroll" style=" width: 800px; height: 480px; margin-bottom: .5rem;">
      <div class="card-header">Details</div>
      <div class="card-body" style="overflow-y: auto; height: 550px;" >
        <table id="loadtbl" class="table table-striped table-hover table-bordered table-sm ">
          
  <thead>
    <tr>
      <th>#</th>
       <th>Date created</th>
        <th>PO Number</th>
      <th>Total Qty</th>
      <th>Total Amount</th>
       <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <!-- Filled dynamically -->
  </tbody>

            <!-- ...repeat rows as needed... -->
          </tbody>
        </table>
      </div>
    </div>

        <!-- Empty body -->
      </div>
      <div class="modal-footer">
     
      </div>
    </div>
  </div>
</div>


    <!-- Confirmation Modal -->


    <!-- New Trans -->
    <?php
    $companyId = isset($_SESSION['COMPANY_ID']) ? $_SESSION['COMPANY_ID'] : '';
    $siteid = isset($_SESSION['SITE_ID']) ? $_SESSION['SITE_ID'] : '';
    ?>
    <!-- JS scripts at the end of body for best practice -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"></script>
    <script>
    document.getElementById('newTransBtn').addEventListener('click', function() {
        const companyId = "<?php echo $_SESSION['COMPANY_ID']; ?>";
        const siteId = "<?php echo $_SESSION['SITE_ID']; ?>";
        const po_date = document.getElementById('po_date').value;

    clearPOData();

        fetch(`/HomePage/getData.php?action=get_new_po_count&company=${companyId}&siteid=${siteId}&po_date=${po_date}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.count !== undefined) {
                    const poNumber = 'PO000' + companyId  + siteId + data.count;
                    document.getElementById('poNumber').value = poNumber;
                    document.getElementById('address').value = '';
                    document.getElementById('status').value = 'DRAFT';
                    document.getElementById('pricing').value = data.pricing;
                    return fetch(`/HomePage/getData.php?action=insert_po&company=${companyId}&siteid=${siteId}&ponumber=${poNumber}&po_date=${po_date}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(`HTTP error! Status: ${response.status}`);
                            }
                            return response;
                        });
                } else {
                    alert('No count value returned from server.');
                    console.warn('Response data:', data);
                }
            })
            .then(response => {
                if (response) {
                    return response.text();
                }
            })
            .then(insertResult => {
                if (insertResult) {
                    console.log("Insert result:", insertResult);
                  
                }
            })
            .catch(error => {
                console.error('Error fetching or inserting PO:', error);
                alert('Error occurred. Check console for details.');
            });
    });

    // Autocomplete logic
    $(document).ready(function(){
        function fetchProducts() {
            // Get companyId from PHP session, pricing from input
            const companyId = "<?php echo isset($_SESSION['COMPANY_ID']) ? $_SESSION['COMPANY_ID'] : ''; ?>";
            const pricing = $("#pricing").val() || $("#pricing").attr("value") || "";

            // Build query string with filters
            const params = new URLSearchParams({
                action: "get_products",
                company_id: companyId,
                pricing: pricing
            });

            return fetch('/HomePage/getData.php?' + params.toString())
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data && Array.isArray(data)) {
                        return data;
                    } else {
                        throw new Error("Invalid data format");
                    }
                })
                .catch(error => {
                    throw error;
                });
        }

        let debounceTimeout = null;
        let lastSearch = "";

        $("#productSearch").on("input", function(){
            const search = $(this).val().toLowerCase().trim();
            const $results = $("#productResults");
            $results.empty();

            if(search.length === 0) return;

            $results.append('<div class="autocomplete-item">Loading products...</div>');

            if (debounceTimeout) clearTimeout(debounceTimeout);

            lastSearch = search;
            debounceTimeout = setTimeout(() => {
                const currentSearch = search;
                fetchProducts()
                    .then(products => {
                        if (currentSearch !== lastSearch) return;
                        $results.empty();

                        if(!products || products.length === 0) {
                            $results.append('<div class="autocomplete-item">No products found</div>');
                            return;
                        }

                        const filtered = products.filter(item => {
                            const desc = (item.DESCRIPTION || '').toLowerCase();
                            const brand = (item.BRAND || '').toLowerCase();
                            const itemCode = (item.IT_BARCODE || '').toLowerCase();
                            const caseCode = (item.CASE_BARCODE || '').toLowerCase();
                            return desc.includes(search) ||
                                   brand.includes(search) ||
                                   itemCode.includes(search) ||
                                   caseCode.includes(search);
                        });
                        if(filtered.length === 0) {
                            $results.append('<div class="autocomplete-item">No matches found</div>');
                            return;
                        }
                        filtered.forEach(item => {
                            const displayText = [
                               `<b>Code:</b> ${item.ITEMID || ''}`,
                                `<b>Description:</b> ${item.DESCRIPTION || ''}`,
                                   `<b>Brand:</b> ${item.BRAND || ''}`,
                                `<b>IT_Code:</b> ${item.IT_BARCODE || ''}`,
                                `<b>CS_Code:</b> ${item.CASE_BARCODE || ''}`,
                                `<b>IT Price:</b> ${item.ITEM_COST || ''}`,
                                `<b>CS Price:</b> ${item.CASE_COST || ''}`,
                                `<b>IT per CS:</b> ${item.ITEMS_PER_CASE || ''}`
                             
                            ].join(' - ');

                            $results.append(
                                `<div class="autocomplete-item" role="option"
                                      data-id="${item.ITEMID || ''}"
                                      data-description="${item.DESCRIPTION || ''}"
                                      data-brand="${item.BRAND || ''}"
                                        data-it_price="${item.ITEM_COST || ''}"
                                        data-cs_price="${item.CASE_COST || ''}"
                                        data-items_per_case="${item.ITEMS_PER_CASE || ''}"
                                        data-it_barcode="${item.IT_BARCODE || ''}"
                                        data-case_barcode="${item.CASE_BARCODE || ''}"
                                      style="font-size:10px; text-align:left;">
                                    ${displayText}
                                </div>`
                            );
                        });
                    })
                    .catch(error => {
                        if (currentSearch !== lastSearch) return;
                        $results.empty().append(
                            `<div class="autocomplete-item text-danger">
                                Error: ${error.message || error}
                            </div>`
                        );
                    });
            }, 350);
        });

        $(document).on("click", ".autocomplete-item:not(.text-danger)", function(){
            const $item = $(this);
            let itemText = $item.text().trim(); // Trim leading/trailing spaces
            if(itemText.match(/loading|error|no products|no matches/i)) return;
            $("#productSearch").val(itemText);
            $("#productResults").empty();
            $("#selectedItemId").val($item.data('id'));
           $("#selectedDescription").val($item.data('description'));
            $("#selectedCSPrice").val($item.data('cs_price') || '');
            $("#selectedITPrice").val($item.data('it_price') || '');
            $("#selectedItemsPerCase").val($item.data('items_per_case') || '');
            $("#selectedBrand").val($item.data('brand') || '');
            $("#selectedITBarcode").val($item.data('it_barcode') || '');
            $("#selectedCaseBarcode").val($item.data('case_barcode') || '');
            
                $("#CStosave").focus();

        });

        $(document).on('keydown', '#CStosave', function(e) {
    if (e.key === 'Enter' || e.keyCode === 13) {
        e.preventDefault();
        $('#addtolist').click();
    }
    });

        $(document).on('keydown', '#SWtosave', function(e) {
    if (e.key === 'Enter' || e.keyCode === 13) {
        e.preventDefault();
        $('#addtolist').click();
    }
    });

        $(document).on('keydown', '#ITtosave', function(e) {
    if (e.key === 'Enter' || e.keyCode === 13) {
        e.preventDefault();
        $('#addtolist').click();
    }
    });
        $(document).on('click', function(e) {
            if(!$(e.target).closest('#productSearch, #productResults').length) {
                $("#productResults").empty();
            }
        });
    });

    // Add to list button
<!-- Add to list button -->
$(document).ready(function() {
    function resetForm() {
        $("#productSearch, #selectedItemId, #selectedDescription").val('');
        $("#CStosave, #SWtosave, #ITtosave").val('0');
        $("#selectedCSPrice, #selectedITPrice").val('');
        $("#selectedItemsPerCase, #selectedBrand").val('');
        $("#selectedITBarcode, #selectedCaseBarcode").val('');
        $("#productResults").empty();
        $("#productSearch").focus();
    }

    function calculateTotalAmount(csPrice, itPrice, csQty, swQty, itQty) {
        return (parseFloat(csPrice) * parseFloat(csQty)) + 
               (parseFloat(itPrice) * parseFloat(swQty)) + 
               (parseFloat(itPrice) * parseFloat(itQty));
    }

    $(document).on('click', '#addtolist', function() {
        if (!$("#selectedItemId").val()) {
            alert("Please select a product first.");
            return;
        }

        const newItemId = $("#selectedItemId").val().trim();

        // ✅ Check if this item already exists in the table
        let exists = false;
        $("#itemsTable tbody tr").each(function() {
            const existingItemId = $(this).find("td").eq(3).text().trim(); // Column where ITEM_ID is stored
            if (existingItemId === newItemId) {
                exists = true;
                return false; // break loop
            }
        });

        if (exists) {
            //alert("This item is already on the list.");
           $('#itemExistToast').toast('show');

            return;
        }

        const formData = {
            companyId: "<?php echo $_SESSION['COMPANY_ID'] ?? ''; ?>",
            siteId: "<?php echo $_SESSION['SITE_ID'] ?? ''; ?>",
            poNumber: $("#poNumber").val(),
            itemId: newItemId,
            description: $("#selectedDescription").val(),
            csQty: $("#CStosave").val() || '0',
            swQty: $("#SWtosave").val() || '0',
            itQty: $("#ITtosave").val() || '0',
            csPrice: $("#selectedCSPrice").val() || '0',
            itPrice: $("#selectedITPrice").val() || '0',
            itemsPerCase: $("#selectedItemsPerCase").val() || '1',
            brand: $("#selectedBrand").val() || '',
            itBarcode: $("#selectedITBarcode").val() || '',
            caseBarcode: $("#selectedCaseBarcode").val() || ''
        };

        const totalAmount = calculateTotalAmount(
            formData.csPrice, 
            formData.itPrice, 
            formData.csQty, 
            formData.swQty, 
            formData.itQty
        );

        const $btn = $(this).prop('disabled', true)
                           .html('<span class="spinner-border spinner-border-sm"></span> Saving...');

        const params = new URLSearchParams({
            action: "POsavelist",
            company: formData.companyId,
            siteid: formData.siteId,
            ponumber: formData.poNumber,
            itemid: formData.itemId,
            description: formData.description,
            csqty: formData.csQty,
            swqty: formData.swQty,
            itqty: formData.itQty,
            totalamount: totalAmount.toFixed(2),
            itbarcode: formData.itBarcode,
            csbarcode: formData.caseBarcode,
            itemspercase: formData.itemsPerCase,
            brand: formData.brand
        });

        fetch(`/HomePage/getData.php?${params.toString()}`)
            .then(async response => {
                const text = await response.text();
                if (!response.ok) {
                    throw new Error(text || `HTTP error! Status: ${response.status}`);
                }
                return text;
            })
            .then(data => {
                const poNumber = $('#poNumber').val();
                loadItemsByPONumber(poNumber);
             
                $('#itemSavedToast').toast('show');
                resetForm();
                
            })
            .catch(error => {
                console.error('Error adding item:', error);
                alert(`Error: ${error.message}`);
            })
            .finally(() => {
                $btn.prop('disabled', false).text('Add to list');
            });
    });
});



// load to table
//  $('#itemsTable').DataTable();
function loadItemsByPONumber(poNumber) {
  if (!poNumber) return;

  fetch(`/HomePage/getData.php?action=get_items_by_po&ponumber=${encodeURIComponent(poNumber)}`)
    .then(response => {
      if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
      return response.json();
    })
    .then(data => {
      const tbody = document.querySelector('#itemsTable tbody');
      if (!tbody) {
        console.error('Table tbody not found');
        return;
      }
      tbody.innerHTML = '';

      if (!data || data.length === 0) {
        const tr = document.createElement('tr');
        tr.innerHTML = '<td colspan="10" class="text-center">No items found.</td>'; // 8 cols now with Action
        tbody.appendChild(tr);
        return;
      }

      let totalAmount = 0;

     data.forEach((item, index) => {
  const amount = parseFloat(item.AMOUNT || 0);
  totalAmount += amount;

  const tr = document.createElement('tr');
  tr.innerHTML = `
    <td>${index + 1}</td>
    <td>${item.CASE_BARCODE || ''}</td>
    <td>${item.IT_BARCODE || ''}</td>
    <td>${item.ITEM_ID || ''}</td>
    <td>${item.DESCRIPTION || ''}</td>
    <td class="po_cs">${item.PO_CS || 0}</td>
    <td class="po_sw">${item.PO_SW || 0}</td>
    <td class="po_it">${item.PO_IT || 0}</td>
    <td>₱${amount.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
    <td>
      <button class="btn btn-sm btn-primary edit-btn" data-itemid="${item.ITEM_ID}">Edit</button>
      <button class="btn btn-sm btn-danger remove-btn" data-itemid="${item.ITEM_ID}">Remove</button>
    </td>
  `;
  tbody.appendChild(tr);
});


    $("#totallines").val(data.length);
    $("#totalamount").val(totalAmount.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }));

   saveasdraft(poNumber);

    })
    .catch(err => {
      console.error('Error loading items:', err);
    });
}

document.querySelector('#itemsTable tbody').addEventListener('click', function(e) {
    const row = e.target.closest('tr');

    // EDIT/UPDATE BUTTON HANDLER
    if (e.target.classList.contains('edit-btn')) {
        if (e.target.textContent === 'Edit') {
            const poCsCell = row.cells[5];
            const poSwCell = row.cells[6];
            const poItCell = row.cells[7];

            poCsCell.innerHTML = `<input type="number" value="${poCsCell.textContent.trim()}" class="form-control form-control-sm">`;
            poSwCell.innerHTML = `<input type="number" value="${poSwCell.textContent.trim()}" class="form-control form-control-sm">`;
            poItCell.innerHTML = `<input type="number" value="${poItCell.textContent.trim()}" class="form-control form-control-sm">`;

            e.target.textContent = 'Update';
            e.target.classList.remove('btn-primary');
            e.target.classList.add('btn-success');
        } 
        else if (e.target.textContent === 'Update') {
            const poCsValue = row.cells[5].querySelector('input').value;
            const poSwValue = row.cells[6].querySelector('input').value;
            const poItValue = row.cells[7].querySelector('input').value;

            row.cells[5].textContent = poCsValue;
            row.cells[6].textContent = poSwValue;
            row.cells[7].textContent = poItValue;

            const itemid = row.cells[3];
            const companyId = "<?php echo $_SESSION['COMPANY_ID']; ?>";
            const pricing = document.getElementById('pricing').value;
            const ponumber = document.getElementById('poNumber').value;

            fetch(`/HomePage/getData.php?action=getnewprice&company=${companyId}&pricing=${pricing}&itemid=${itemid.textContent.trim()}`)
                .then(response => {
                    if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
                    return response.json();
                })
                .then(data => {
                    if (data.CSCOST !== undefined) {
                        const newcsamount = poCsValue * data.CSCOST;
                        const newitamount = poItValue * data.ITCOST;
                        const newswamount = (poItValue * data.ITPERSW) * data.ITCOST;
                        const newTotalAmount = newcsamount + newitamount + newswamount;

                        return fetch(`/HomePage/getData.php?action=updatelineitem&ponumber=${encodeURIComponent(ponumber)}&cs=${encodeURIComponent(poCsValue)}&sw=${encodeURIComponent(poSwValue)}&it=${encodeURIComponent(poItValue)}&itemid=${encodeURIComponent(itemid.textContent.trim())}&totalamount=${encodeURIComponent(newTotalAmount.toFixed(2))}`);
                    } else {
                        throw new Error('No price value returned from server.');
                    }
                })
                .then(response => {
                    if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
                    return response.json();
                })
                .then(result => {
                    if (result.status === 'success') {
                       // alert('Data updated successfully.');
                          $('#updated').toast('show');
                        loadItemsByPONumber(ponumber);
                    } else {
                        console.warn('Response data:', result);
                    }
                })
                .catch(error => {
                    console.error('Error updating item:', error);
                    alert(`Error: ${error.message}`);
                });

            e.target.textContent = 'Edit';
            e.target.classList.remove('btn-success');
            e.target.classList.add('btn-primary');
        }
    }

    // REMOVE BUTTON HANDLER
    if (e.target.classList.contains('remove-btn')) {
        if (confirm('Are you sure you want to remove this item?')) {
            const itemid = row.cells[3].textContent.trim();
            const ponumber = document.getElementById('poNumber').value;

            fetch(`/HomePage/getData.php?action=removelineitem&ponumber=${encodeURIComponent(ponumber)}&itemid=${encodeURIComponent(itemid)}`)
                .then(response => {
                    if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
                    return response.json();
                })
                .then(result => {
                    if (result.status === 'success') {
                       // alert('Item removed successfully.');

                          $('#removed').toast('show');
                         loadItemsByPONumber(ponumber);
                        row.remove();
                    } else {
                        alert('Failed to remove item.');
                        console.warn('Response data:', result);
                    }
                })
                .catch(error => {
                    console.error('Error removing item:', error);
                    alert(`Error: ${error.message}`);
                });
        }
    }
});

// PROCESS BUTTON HANDLER

function confirmProcessPO(poNumberSelector) {

    let poNumber = document.querySelector(poNumberSelector).value;
    const totallines = document.getElementById('totallines');

    if (!poNumber) {
        alert('Purchase Order number is missing.');
        return;
    }

    if (totallines.value === '0') {
        alert('No items to process in this Purchase Order.');
        return;
    }

    // Store the PO number in the confirm button for later use
    document.getElementById('confirmProcessBtn').setAttribute('data-ponumber', poNumber);
    $('#processConfirmModal').modal('show');
}

document.getElementById('confirmProcessBtn').addEventListener('click', function () {
    let poNumber = this.getAttribute('data-ponumber');
    processPO(poNumber);
    $('#processConfirmModal').modal('hide');
});

function processPO(poNumber) {

if (!poNumber) {
        alert('No transaction found.');
        return;
    }

  //alert(`Processing Purchase Order: ${poNumber}`);
  const ponumber = document.getElementById('poNumber').value;
  const totallines = document.getElementById('totallines');
  const totalamount = document.getElementById('totalamount');
  const datecreated = document.getElementById('po_date').value;
  const expected_days = document.getElementById('expected_days').value;
  const address = document.getElementById('address').value;

   const formData = {
            poNumber: $("#poNumber").val(),
            totallines: totallines.value,
            totalamount: totalamount.value, 
            datecreated: datecreated,
            expected_days: expected_days,
            address: address
        };

         const $btn = $(this).prop('disabled', true)
                           .html('<span class="spinner-border spinner-border-sm"></span> Saving...');

        const params = new URLSearchParams({
            action: "processpo",
            company: "<?php echo $_SESSION['COMPANY_ID'] ?? ''; ?>",
            siteid: "<?php echo $_SESSION['SITE_ID'] ?? ''; ?>",
            ponumber: formData.poNumber,
            totallines: formData.totallines,
            totalamount: formData.totalamount,
            datecreated: formData.datecreated,
            expected_days: formData.expected_days,
            address: formData.address

        });

        fetch(`/HomePage/getData.php?${params.toString()}`)
            .then(async response => {
                const text = await response.text();
                if (!response.ok) {
                    throw new Error(text || `HTTP error! Status: ${response.status}`);
                }
                return text;
            })
            .then(data => {
                const poNumber = $('#poNumber').val();
              //  loadItemsByPONumber(poNumber);
                $('#poprocessed').toast('show');
                clearPOData();
                //alert('Purchase Order processed successfully.');
            })
            .catch(error => {
                console.error('Error Processing Transaction:', error);
                alert(`Error: ${error.message}`);
            })
            .finally(() => {
                $btn.prop('disabled', false).text('PROCESS');
            });

}



// save as draft button handler

function saveasdraft(poNumber) {

  //alert(`Processing Purchase Order: ${poNumber}`);
  const ponumber = document.getElementById('poNumber').value;
  const totallines = document.getElementById('totallines');
  const totalamount = document.getElementById('totalamount');
  const datecreated = document.getElementById('po_date').value;
  const expected_days = document.getElementById('expected_days').value;
  const address = document.getElementById('address').value;

   const formData = {
            poNumber: $("#poNumber").val(),
            totallines: totallines.value,
            totalamount: totalamount.value, 
            datecreated: datecreated,
            expected_days: expected_days,
            address: address
        };

         const $btn = $(this).prop('disabled', true)
                           .html('<span class="spinner-border spinner-border-sm"></span> Saving...');

        const params = new URLSearchParams({
            action: "saveasdraft",
            company: "<?php echo $_SESSION['COMPANY_ID'] ?? ''; ?>",
            siteid: "<?php echo $_SESSION['SITE_ID'] ?? ''; ?>",
            ponumber: formData.poNumber,
            totallines: formData.totallines,
            totalamount: formData.totalamount,
            datecreated: formData.datecreated,
            expected_days: formData.expected_days,
            address: formData.address

        });

        fetch(`/HomePage/getData.php?${params.toString()}`)
            .then(async response => {
                const text = await response.text();
                if (!response.ok) {
                    throw new Error(text || `HTTP error! Status: ${response.status}`);
                }
                return text;
            })
            .then(data => {
                const poNumber = $('#poNumber').val();
              //  loadItemsByPONumber(poNumber);
             
                //alert('Purchase Order processed successfully.');
            })
            .catch(error => {
                console.error('Error Processing Transaction:', error);
                alert(`Error: ${error.message}`);
            })
            .finally(() => {
                $btn.prop('disabled', false).text('PROCESS');
            });

}



function clearPOData() {

    // Clear header fields
    document.getElementById('poNumber').value = '';
    document.getElementById('po_date').value = '<?php echo date('Y-m-d'); ?>';
    document.getElementById('expected_days').value = '1';
    document.getElementById('address').value = '';
    document.getElementById('status').value = '';
    document.getElementById('pricing').value = '';
    document.getElementById('totallines').value = '0';
    document.getElementById('totalamount').value = '0.00';

 // Reset pricing if needed

  const itemsTableBody = document.querySelector('#itemsTable tbody');

// Clear all rows in the table body
itemsTableBody.innerHTML = '';
}


// LOAD TRANSACTIONS BUTTON HANDLER
let loadedPOs = []; // Global to store fetched data

function loadItemsByDateRange() {
  const dateFrom = document.querySelector('#dateFrom')?.value;
  const dateTo = document.querySelector('#dateTo')?.value;
  const companyId = "<?php echo $_SESSION['COMPANY_ID'] ?? ''; ?>";
  const siteid = "<?php echo $_SESSION['SITE_ID'] ?? ''; ?>";

  if (!dateFrom || !dateTo) {
    console.error('Date range inputs missing or empty');
    return;
  }

  const tbody = document.querySelector('#loadtbl tbody');
  if (!tbody) {
    console.error('Table tbody not found');
    return;
  }
  tbody.innerHTML = ''; // Clear previous rows

  fetch(`/HomePage/getData.php?action=loadtrans&dateFrom=${encodeURIComponent(dateFrom)}&dateTo=${encodeURIComponent(dateTo)}&company=${encodeURIComponent(companyId)}&siteid=${encodeURIComponent(siteid)}`)
    .then(response => {
      if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
      return response.json();
    })
    .then(data => {
      loadedPOs = data; // Save globally
      if (!data || data.length === 0) {
        const tr = document.createElement('tr');
        tr.innerHTML = '<td colspan="6" class="text-center">No items found.</td>';
        tbody.appendChild(tr);
        return;
      }

      data.forEach((item, index) => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
          <td>${index + 1}</td>
          <td>${item.DATE_CREATED || ''}</td>
          <td>${item.PO_NUMBER || ''}</td>
          <td>${item.TOTAL_QTY || ''}</td>
          <td>${item.TOTAL_AMOUNT || ''}</td>
          <td>
            <button class="btn btn-sm btn-success select-btn" data-itemid="${item.PO_NUMBER || ''}">Select</button>
          </td>
        `;
        tbody.appendChild(tr);
      });
    })
    .catch(err => {
      console.error('Error loading items:', err);
    });
}

// Event delegation for Select buttons inside #loadtbl tbody
document.querySelector('#loadtbl tbody').addEventListener('click', function(e) {
  if (e.target && e.target.classList.contains('select-btn')) {
    const poNumber = e.target.getAttribute('data-itemid');
   ///console.log('Selected PO Number:', poNumber);

    // Find the full item object
    const item = loadedPOs.find(po => po.PO_NUMBER === poNumber);
    if (!item) {
      alert('Selected PO not found in loaded data');
      return;
    }

    document.getElementById('poNumber').value = item.PO_NUMBER || ''; 
    document.getElementById('po_date').value = item.DATE_CREATED || '';
    document.getElementById('expected_days').value = item.EXPECTED_DAYS || '';
    document.getElementById('address').value = item.ADDRESS || '';
    document.getElementById('status').value = item.STATUS || '';

    //alert(`You selected PO Number: ${poNumber}`);
    $('#loadTransModal').modal('hide');
    getpricing(); // Fetch pricing options  
    loadItemsByPONumber(poNumber);
  }
});

function getPricing() {
    const companyId = "<?php echo $_SESSION['COMPANY_ID'] ?? ''; ?>";
    const siteId = "<?php echo $_SESSION['SITE_ID'] ?? ''; ?>";
    const pricingInput = document.getElementById('pricing');

    // Show loading state
    pricingInput.value = "Loading pricing...";
    pricingInput.disabled = true;

    fetch(`/HomePage/getData.php?action=getpricing&company=${companyId}&siteid=${siteId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error(`Server returned ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.status === 'error') {
                throw new Error(data.message);
            }

            if (data.pricing) {
                pricingInput.value = data.pricing;
                showToast('success', 'Pricing data loaded successfully');
                
                // Optional: Trigger other actions that need pricing
                if (typeof onPricingLoaded === 'function') {
                    onPricingLoaded(data.pricing);
                }
            } else {
                pricingInput.value = '';
                showToast('warning', 'No pricing configuration found');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            pricingInput.value = '';
            showToast('error', `Failed to load pricing: ${error.message}`);
        })
        .finally(() => {
            pricingInput.disabled = false;
        });
}

// Helper function for toast notifications (using Bootstrap 5)
function showToast(type, message) {
    const toastEl = document.getElementById(`${type}Toast`);
    if (toastEl) {
        const toastBody = toastEl.querySelector('.toast-body');
        if (toastBody) toastBody.textContent = message;
        const toast = new bootstrap.Toast(toastEl);
        toast.show();
    }
}

// 1. Load pricing when page loads
document.addEventListener('DOMContentLoaded', getPricing);

// 2. Add refresh button
document.getElementById('refreshPricingBtn')?.addEventListener('click', getPricing);

    </script>
<script src="https://cdn.jsdelivr.net/npm/vanilla-datatables@latest/dist/vanilla-dataTables.min.js"></script>
  </body>
</html>