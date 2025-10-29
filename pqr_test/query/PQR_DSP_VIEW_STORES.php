<?php 
    include "../db_connection.php";
    session_start();
    $comp_id = isset($_POST['comp_id'])?$_POST['comp_id']:'';
    $site_id = isset($_POST['site_id'])?$_POST['site_id']:'';
    $seller_id = isset($_POST['seller_id'])?$_POST['seller_id']:'';

    $selected_datefrom = isset($_SESSION['ses_datefrom']) ? $_SESSION['ses_datefrom'] : date('Y-m-d'); ;
    $selected_dateto = isset($_SESSION['ses_dateto']) ? $_SESSION['ses_dateto'] : date('Y-m-d');
    $filter_selected = (isset($_POST['filter']) && $_POST['filter'] != 'All') ?"PENDING":"All";
    $filter = ($filter_selected != "All")?" HAVING SUM(CASE WHEN CTE.STATUS = 'PENDING' THEN 1 ELSE 0 END) > 0":"";


 ?>
 <style>
/* Custom Styles for Photo Modal */
.photo-card {
  border: 1px solid #e9ecef;
  transition: all 0.3s ease;
}

.photo-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
}

.photo-container {
  position: relative;
  overflow: hidden;
  border-radius: 8px;
}

.photo-img {
  transition: transform 0.3s ease;
  width: 100%;
  height: 200px;
  object-fit: cover;
}

.photo-container:hover .photo-img {
  transform: scale(1.05);
}

.photo-overlay {
  position: absolute;
  top: 8px;
  right: 8px;
  opacity: 0;
  transition: opacity 0.3s ease;
}

.photo-container:hover .photo-overlay {
  opacity: 1;
}

.zoom-btn {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
}

.date-navigation {
  background: linear-gradient(135deg, #f8f9fa, #e9ecef);
}

.date-nav-btn {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
}

.photo-info {
  font-size: 0.8rem;
}

/* Responsive Adjustments */
@media (max-width: 576px) {
  .modal-dialog {
    margin: 10px;
  }
  
  .modal-body {
    padding: 15px 10px;
  }
  
  .photo-img {
    height: 150px;
  }
  
  .date-navigation .container-fluid {
    padding: 10px 15px;
  }
  
  .modal-footer .container-fluid {
    padding: 10px 15px;
  }
}

@media (max-width: 768px) {
  .modal-header h5 {
    font-size: 1.1rem;
  }
  
  .photo-card .card-body {
    padding: 15px;
  }
  
  .photo-info .col-6 {
    margin-bottom: 5px;
  }
}

@media (min-width: 1200px) {
  .photo-img {
    height: 220px;
  }
}

/* Dark mode support */
@media (prefers-color-scheme: dark) {
  .photo-card {
    background: #2d3748;
    border-color: #4a5568;
  }
  
  .card-header.bg-light {
    background: #4a5568 !important;
    color: #e2e8f0;
  }
}

/* Loading state */
.photo-img.loading {
  background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
  background-size: 200% 100%;
  animation: loading 1.5s infinite;
}

@keyframes loading {
  0% { background-position: 200% 0; }
  100% { background-position: -200% 0; }
}

/* Status badge colors */
.badge.bg-success { background: linear-gradient(135deg, #28a745, #20c997); }
.badge.bg-warning { background: linear-gradient(135deg, #ffc107, #fd7e14); }
.badge.bg-secondary { background: linear-gradient(135deg, #6c757d, #495057); }

    .badge{
        cursor: pointer;
    }
</style>
<div class="row">
    <div class="col-md-1 col-sm-4">
        <a type="button" class="btn btn-sm btn-outline-secondary back-button"><i class='bx bx-left-arrow-alt'></i></a>
    </div>
    <div class="col-md-4 col-sm-8">
        <h3 class="text-header"><?php echo  $seller_id ?></h3>
    </div>
    <div class="col-md-4 col-sm-12">
      <select name="" id="SELECT_FILTER_DSP" class="form-control form-control-md">
        <option value="All" <?php echo ( $filter_selected == 'All')?"selected":"" ?>>All</option>
           <option value="PENDING"  <?php echo ( $filter_selected == 'PENDING')?"selected":"" ?>>Has Pending</option>
      </select>
    </div>
</div>

<div class="container-body" style="height: 85vh; width: 100%; background-color: #F6F6F9;border-radius:   10px; overflow-y: scroll; padding:    10px; ">
<div class="row body">   
<?php 

$query = "WITH CTE AS (
    SELECT 
        MAX(A.LINE_ID) AS ID,
        MIN(A.DISTANCE) AS CAP_DISTANCE,
        A.COMPANY_ID,
        MAX(A.ADDRESS) AS ADDRESS,
        A.SITE_ID,
        A.SELLER_SUB_ID,
        A.SELLER_ID,
        A.DATE_PROCESS,
        A.CU_ID,
        A.CU_NAME,
        ISNULL(A.PHOTO_STATUS, 'PENDING') AS STATUS,
        ISNULL(MAX(A.BEFORE_LINK), MAX(B.BEFORE_LINK)) AS BEFORE_LINK,
        ISNULL(MAX(A.AFTER_LINK), MAX(B.AFTER_LINK)) AS AFTER_LINK
    FROM dbo.Aquila_PQR AS A
    LEFT JOIN dbo.Aquila_PQR_Link AS B 
        ON A.PQR_ID = B.PQR_ID
    WHERE 
     SELLER_ID = '$seller_id' AND
        A.BRAND = 'CLVB'
        AND A.COMPANY_ID = '$comp_id'
        AND A.SITE_ID = '$site_id'
        AND A.DATE_PROCESS BETWEEN ' $selected_datefrom' AND ' $selected_dateto'
    GROUP BY 
        A.CU_ID,
        A.DATE_PROCESS,
        A.SELLER_ID,
        A.SELLER_SUB_ID,
        A.PHOTO_STATUS,
        A.CU_NAME,
        A.COMPANY_ID,
        A.SITE_ID
)
SELECT CU_ID, CU_NAME, COUNT(CTE.ID) AS TOTAL,
    SUM(CASE WHEN CTE.STATUS = 'COMPLIANT' THEN 1 ELSE 0 END) AS COMPLIANT,
    SUM(CASE WHEN CTE.STATUS = 'NON-COMPLIANT' THEN 1 ELSE 0 END) AS NON_COMPLIANT,
    SUM(CASE WHEN CTE.STATUS = 'PENDING' THEN 1 ELSE 0 END) AS PENDING from CTE
    GROUP BY  CU_ID, CU_NAME $filter";

    $item = $conn->query($query);
    while($row = $item->fetch(PDO::FETCH_ASSOC)){
        ?>
              <div class="col-md-6 col-lg-4 mb-4 ">
            <a  data-id="<?php echo $row["CU_ID"] ?>" class="text-decoration-none card-a btn_view_execution">
                <div class="card text-center" id="card_a" data-id="A">
                    <div class="card-body">   
                    <div class="row">
                        <div class="col"><span class="card-title">
                            <?php echo $row["CU_ID"]." | ".$row["CU_NAME"]  ?>
                        </span></div>                       
                        
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item d-flex justify-content-between align-items-center text-muted"> Compliant
                            <span class="badge bg-success rounded-pill " data-name="<?php echo $row["CU_NAME"] ?>" data-id="<?php echo $row["CU_ID"] ?>" data-status="COMPLIANT"><?php echo $row['COMPLIANT']; ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center text-muted"> Non Compliant
                            <span class="badge bg-danger rounded-pill " data-name="<?php echo $row["CU_NAME"] ?>" data-id="<?php echo $row["CU_ID"] ?>" data-status="NON-COMPLIANT"><?php echo $row['NON_COMPLIANT']; ?></span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center  text-muted"> Pending
                            <span  data-id="<?php echo $row["CU_ID"] ?>" data-name="<?php echo $row["CU_NAME"] ?>" data-status="PENDING" class="badge bg-warning rounded-pill ">
                                 
                                <?php echo $row['PENDING']; ?>
                            </span>
                        </li>  
                    </ul>
                </div>
            </div>   
        </div>
        </a>
    </div>
        <?php
    }
     ?>
    
</div>

</div>
<div class="modal fade" id="photoModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="modal-title">
         
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body p-0">
        <!-- Date Navigation -->
        <div class="date-navigation bg-light border-bottom">
          <div class="container-fluid py-2">
            <div class="row align-items-center">
              <div class="col-md-6">
                <div class="d-flex align-items-center gap-2">
                  <button class="btn btn-sm btn-outline-primary date-nav-btn" data-direction="prev">
                    <i class="fas fa-chevron-left"></i>
                  </button>
                  <h6 class="mb-0 fw-bold text-primary date-display">2025-10-21 10:00 AM</h6>
                  <button class="btn btn-sm btn-outline-primary date-nav-btn" data-direction="next">
                    <i class="fas fa-chevron-right"></i>
                  </button>
                </div>
              </div>
              <div class="col-md-6 text-md-end">
                <span class="badge bg-warning text-dark status-badge">
        
                </span>
              </div>
            </div>
          </div>
        </div>

      <div class="container-fluid py-4" id="container">

       </div>
      <div class="modal-footer bg-light">
        <div class="container-fluid">
          <div class="row align-items-center">
            <div class="col-md-6">
              
            </div>
            <div class="col-md-6 text-md-end">
              <button class="btn btn-secondary" data-bs-dismiss="modal">
                <i class="fas fa-times me-1"></i>Close
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
$(".badge").click(function(){
    var cu_id = $(this).data('id'); 
     var name = $(this).data('name'); 
    var status = $(this).data('status');  

    $(".status-badge").html(status)  ;
    $("#modal-title").html(" <i class='fas fa-camera me-2'></i> Execution Photos - "+cu_id+"|"+name)                               
   show_execution(cu_id,status);
})
     function view_cas(compid,siteid){
    let dt_from = $("#dt_from").val();
    let dt_to = $("#dt_to").val();
     var status =  $("#SELECT_FILTER").val();
      $.ajax({
        url:'query/PQR_DSP_VIEW.php',
        method:'POST',
        data:{comp_id:compid, site_id:siteid,dt_from:dt_from, dt_to:dt_to,status:status},
        success:function(data){                
           $("#main_body").html(data);      
           show_indicator('none');
       }
   })
  }

  function show_execution(cu_id,status){
     $.ajax({
        url:'query/PQR_STORE_EXECUTION.php',
        method:'POST',
        data:{cu_id:cu_id,status:status},
        success:function(data){                        
           $("#container").html(data)
            $("#photoModal").modal('show')
           show_indicator('none');
       }
   })
  }
    function show_indicator(is_visible){
      $(".marquee-progress").css('display',is_visible)
      if(is_visible == 'none'){  $(".table").css('display','block')}
        else{ $(".table").css('display','none')}
    }
 
    $(".back-button").click(function(){
    show_indicator('block');
    var site_id=$("#SELECT_SITE").val();
    var comp= $("#sel_comp").val();
   
    view_cas(comp, site_id);
    })

 function view_cas_stres(_filter){

    show_indicator('block');
    var siteid='<?php echo  $site_id ; ?>';
    var comp= '<?php echo  $comp_id ; ?>';
    var sellerid= '<?php echo  $seller_id ; ?>';

      $.ajax({
        url:'query/PQR_DSP_VIEW_STORES_DETAILS.php',
        method:'POST',
        data:{comp_id:comp, site_id:siteid,seller_id:sellerid,filter:_filter},
        success:function(data){   
        //alert(data) 
        $(".body").html(data);      
           show_indicator('none');
       },
        error: function(jqXHR, textStatus, errorThrown) {
            // This block will catch and display any errors
            console.error("Error Details:", {
                status: jqXHR.status,           // HTTP status code
                statusText: textStatus,         // Status text like 'timeout', 'error'
                responseText: jqXHR.responseText,  // Full server response
                error: errorThrown              // Exception object or text
            });
            alert("An error occurred: " + textStatus + " - " + errorThrown);
        }      
   })
  }
    function view(filter){
    show_indicator("block");
  
    var site_id=$("#SELECT_SITE").val();
    var comp= $("#sel_comp").val();
    var sellerid= '<?php echo  $seller_id ; ?>';
   view_cas_str(comp,site_id,sellerid,filter)
  }
$("#SELECT_FILTER_DSP").change(function(){
   view( $(this).val());
})
  $("#filter-dsp").css('display','none');

</script>