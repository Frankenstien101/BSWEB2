<?php 
    include "../db_connection.php";
    session_start();
    $comp_id = isset($_SESSION['comp_id'])?$_SESSION['comp_id']:'';
    $site_id = isset($_SESSION['ses_site'])?$_SESSION['ses_site']:'';

    $selected_datefrom = isset($_SESSION['ses_datefrom']) ? $_SESSION['ses_datefrom'] : date('Y-m-d');
    $selected_dateto =isset($_SESSION['ses_dateto']) ? $_SESSION['ses_dateto'] : date('Y-m-d');
    $status = isset($_POST['status']) ? $_POST['status']:'PENDING';
    $cu_id = isset($_POST['cu_id']) ? $_POST['cu_id']:'0';

$query ="WITH CTE AS (select  (CS*IT_PER_CS)+IT AS QTY,od.TOTAL_AMOUNT,TRANSACTION_DATE, CUSTOMER_ID, ITEM_ID  from [dbo].[Aquila_Sales_Order_Transactions] ot join Aquila_Sales_Order_Details od 
on  ot.TRANSACTION_ID=od.TRANSACTION_ID WHERE ITEM_ID = '5-170' 
GROUP BY od.TOTAL_AMOUNT,TRANSACTION_DATE, CUSTOMER_ID, ITEM_ID,CS,IT,IT_PER_CS)

SELECT ISNULL(SUM(CTE.QTY),0) AS QTY, ISNULL(SUM(CTE.TOTAL_AMOUNT),0) AS TOTAL,B.PQR_ID,MAX(A.LINE_ID) AS ID, MIN(A.DISTANCE) AS CAP_DISTANCE, A.COMPANY_ID, MAX(A.ADDRESS) AS ADDRESS, A.SITE_ID, A.SELLER_SUB_ID, A.SELLER_ID, A.DATE_PROCESS, A.CU_ID, A.CU_NAME, ISNULL(A.PHOTO_STATUS, 'PENDING') AS STATUS, 
ISNULL(MAX(A.BEFORE_LINK), MAX(B.BEFORE_LINK)) AS SHELF, ISNULL(MAX(A.AFTER_LINK), MAX(B.AFTER_LINK))  AS DISPLAY,
 ISNULL(MAX(COT_LINK), MAX(COT_LINK))  AS COUNTER_TOP FROM dbo.Aquila_PQR AS A LEFT JOIN dbo.Aquila_PQR_Link AS B ON A.PQR_ID = B.PQR_ID
 left join CTE ON A.CU_ID=CTE.CUSTOMER_ID AND A.DATE_PROCESS=CTE.TRANSACTION_DATE
WHERE CU_ID = '$cu_id' AND A.BRAND = 'CLVB' AND A.COMPANY_ID = '$comp_id' AND A.SITE_ID = '$site_id' 
AND A.DATE_PROCESS BETWEEN '$selected_datefrom' AND '$selected_dateto' and ISNULL(A.PHOTO_STATUS, 'PENDING') = '$status'
GROUP BY A.CU_ID, A.DATE_PROCESS, A.SELLER_ID, A.SELLER_SUB_ID, A.PHOTO_STATUS, 
A.CU_NAME, A.COMPANY_ID, A.SITE_ID,B.PQR_ID ";

$item = $conn->query($query);
if($item->rowCount() ==0 ){
    ?>
    <div class="alert alert-warning text-center mt-4" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i>
        No photo taken at this moment.
    </div>
    <?php
    return;
}else{
while($row = $item->fetch(PDO::FETCH_ASSOC)){

        $total_sales = number_format($row['TOTAL'] ?? 0, 2);
        $total_qty = number_format($row['QTY'] ?? 0);
    ?>
     <div class="row g-3" id="photosContainer">
         <div class="col-6 col-md-6">
                        <div class="sales-metric-card bg-dark text-white text-center rounded-3 p-3">
                            <div class="metric-icon mb-2">
                                <i class="fas fa-money-bill-wave fa-2x"></i>
                            </div>
                            <div class="metric-value fw-bold fs-4">₱ <?php echo $total_sales ?></div>
                            <div class="metric-label small">Total Sales</div>
                        </div>
                    </div>
                    
                    <!-- Total Quantity -->
                    <div class="col-6 col-md-6">
                        <div class="sales-metric-card bg-dark text-white text-center rounded-3 p-3">
                            <div class="metric-icon mb-2">
                                <i class="fas fa-boxes fa-2x"></i>
                            </div>
                            <div class="metric-value fw-bold fs-4"><?php echo $total_qty ; ?> </div>
                            <div class="metric-label small">Total Quantity</div>
                        </div>
                    </div>
            <!-- Shelf Photo Card -->
            <div class="col-12 col-sm-6 col-lg-4">
              <div class="card photo-card h-100 shadow-sm">
                <div class="card-header bg-light text-center fw-bold py-2">
                  <i class="fas fa-shelves me-2"></i>Shelf
                </div>
                <div class="card-body text-center p-3">
                  <div class="photo-container mb-3">
                    <img src="<?php echo $row['SHELF'] ?>" 
                         class="img-fluid rounded photo-img photo-shelf" 
                         alt="Shelf Execution Photo"
                         loading="lazy">
                    <div class="photo-overlay">
                      <button class="btn btn-light btn-sm zoom-btn" data-type="shelf">
                        <i class="fas fa-search-plus"></i>
                      </button>
                    </div>
                  </div>
                  <div class="photo-info">
                    <div class="row g-1 small text-muted">
                      <div class="col-6">
                        <i class="fas fa-ruler me-1 text-white"></i>
                        <span class="photo-distance text-white"><?php echo $row['CAP_DISTANCE'] ?></span>
                      </div>
                      <div class="col-6">
                        <i class="fas fa-calendar me-1 text-white"></i>
                        <span class="photo-date text-white"><?php echo $row['DATE_PROCESS'] ?></span>
                      </div>
                    <!--   <div class="col-12 mt-1">
                        <span class="badge bg-success photo-status">
                          <i class="fas fa-check me-1"></i>Approved
                        </span>
                      </div> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Display Photo Card -->
            <div class="col-12 col-sm-6 col-lg-4">
              <div class="card photo-card h-100 shadow-sm">
                <div class="card-header bg-light text-center fw-bold py-2">
                  <i class="fas fa-tv me-2"></i>Display
                </div>
                <div class="card-body text-center p-3">
                  <div class="photo-container mb-3">
                    <img src="<?php echo $row['DISPLAY'];?>" 
                         class="img-fluid rounded photo-img photo-display" 
                         alt="Display Execution Photo"
                         loading="lazy">
                    <div class="photo-overlay">
                      <button class="btn btn-light btn-sm zoom-btn" data-type="display">
                        <i class="fas fa-search-plus"></i>
                      </button>
                    </div>
                  </div>
                  <div class="photo-info">
                    <div class="row g-1 small text-muted">
                      <div class="col-6">
                        <i class="fas fa-ruler me-1 text-white"></i>
                        <span class="photo-distance text-white"><?php echo $row['CAP_DISTANCE'] ?></span>
                      </div>
                      <div class="col-6">
                        <i class="fas fa-calendar me-1 text-white"></i>
                        <span class="photo-date text-white"><?php echo $row['DATE_PROCESS'] ?></span>
                      </div>
                     <!--  <div class="col-12 mt-1">
                        <span class="badge bg-warning text-dark photo-status">
                          <i class="fas fa-exclamation me-1"></i>Pending
                        </span>
                      </div> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Counter-Top Photo Card -->
            <div class="col-12 col-sm-6 col-lg-4">
              <div class="card photo-card h-100 shadow-sm">
                <div class="card-header bg-light text-center fw-bold py-2">
                  <i class="fas fa-utensils me-2"></i>Counter-Top
                </div>
                <div class="card-body text-center p-3">
                  <div class="photo-container mb-3">
                    <img src="<?php echo $row['COUNTER_TOP'] ?>" 
                         class="img-fluid rounded photo-img photo-counter" 
                         alt="Counter-Top Execution Photo"
                         loading="lazy">
                    <div class="photo-overlay">
                      <button class="btn btn-light btn-sm zoom-btn" data-type="counter" >
                        <i class="fas fa-search-plus"></i>
                      </button>
                    </div>
                  </div>
                  <div class="photo-info">
                    <div class="row g-1 small text-muted">
                      <div class="col-6">
                        <i class="fas fa-ruler me-1 text-white"></i>
                        <span class="photo-distance text-white"><?php echo $row['CAP_DISTANCE'] ?></span>
                      </div>
                      <div class="col-6">
                        <i class="fas fa-calendar me-1 text-white"></i>
                        <span class="photo-date text-white"><?php echo $row['DATE_PROCESS'] ?></span>
                      </div>
                     <!--  <div class="col-12 mt-1">
                        <span class="badge bg-warning text-dark photo-status">
                          <i class="fas fa-exclamation me-1"></i>Pending
                        </span>
                      </div> -->
                    </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-8"></div>
    <div class="col-md-4">
              <div class="d-flex gap-2 flex-wrap">
              <select class="form-control form-control-md action-status" data-id="<?php echo $row['PQR_ID']?>">
                <option disabled  <?php echo  ($status=="PENDING")?'selected':'' ?>>PENDING</option>
                  <option value="COMPLIANT" <?php echo  ($status=="COMPLIANT")?'selected':'' ?>>COMPLIANT</option>
                   <option value="NON-COMPLIANT" <?php echo  ($status=="NON-COMPLIANT")?'selected':'' ?>>NON-COMPLIANT</option>
              </select>               
              </div>
            </div>
    <?php
}
}
?>
<!-- Photo Preview Modal -->
<div class="modal fade" id="photoPreviewModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title">
          <i class="fas fa-image me-2"></i> Photo Preview - 
          <span id="previewPhotoType"></span>
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center" id="previewPhotoBody">
        <img id="previewPhotoImg" 
             src="" 
             class="img-fluid rounded shadow-lg border" 
             alt="Execution Photo Preview"
             style="max-height: 80vh; object-fit: contain;">
        <div class="mt-3 text-muted small">
          <span><i class="fas fa-ruler me-1"></i> <span id="previewPhotoDistance">-</span> m</span> |
          <span><i class="fas fa-calendar me-1"></i> <span id="previewPhotoDate">-</span></span>
        </div>
      </div>
    </div>
  </div>
</div>

<script>    
$(".action-status").change(function(){
        var pqr_id = $(this).data('id');
        var status = $(this).val();
        $.ajax({
            url:'query/update_pqr_status.php',
            method:'post',
            data:{PQR_ID:pqr_id, STATUS: status},
            success:function(data){             
                view($("#SELECT_FILTER_DSP").val());
                 $("#photoModal").modal('hide')
            }
        })
})

$(document).on("click", ".zoom-btn", function() {
  const type = $(this).data("type"); // shelf, display, or counter
  const card = $(this).closest(".photo-card");
  const imgSrc = card.find("img").attr("src");
  const distance = card.find(".photo-distance").text();
  const date = card.find(".photo-date").text();

  if (!imgSrc || imgSrc.trim() === "" || imgSrc.includes("no_photo")) {
    $("#previewPhotoBody").html(`<div class="text-muted py-5">No Photo Available</div>`);
  } else {
    $("#previewPhotoBody").html(`
      <img id="previewPhotoImg" src="${imgSrc}" class="img-fluid rounded shadow-lg border" 
           style="max-height: 80vh; object-fit: contain;">
      <div class="mt-3 text-muted small">
        <span><i class="fas fa-ruler me-1"></i> ${distance} m</span> |
        <span><i class="fas fa-calendar me-1"></i> ${date}</span>
      </div>
    `);
  }

  // Update modal title and show modal
  $("#previewPhotoType").text(type.charAt(0).toUpperCase() + type.slice(1));
  $("#photoPreviewModal").modal("show");
});
</script>

      
