<?php 
    include "../db_connection.php";
    session_start();
    $comp_id = isset($_POST['comp_id'])?$_POST['comp_id']:'';
    $site_id = isset($_POST['site_id'])?$_POST['site_id']:'';


    $selected_datefrom = isset($_POST['dt_from']) ? $_POST['dt_from'] : $_SESSION['ses_datefrom'];
    $selected_dateto = isset($_POST['dt_to']) ? $_POST['dt_to'] : $_SESSION['ses_dateto'];

    $selected_status =  (isset($_POST['status']) && $_POST['status'] != 'All')? " having SUM(CASE WHEN CTE.STATUS = 'PENDING' THEN 1 ELSE 0 END) > 0 " :"";
$DSP_SELECTION = ($_SESSION['role']=='DSS')?" AND DSS_CODE='{$_SESSION['user_id']}'":"";
    $_SESSION['ses_datefrom'] = $selected_datefrom;
    $_SESSION['ses_dateto'] = $selected_dateto;


 ?>

<div class="container-body" style="height: 85vh; width: 100%; background-color: #F6F6F9;border-radius:   10px; overflow-y: scroll; padding:    10px; ">
    <div class="row">   
<?php 

$query = "
WITH CTE AS (
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
        A.BRAND = 'CLVB'
        AND A.COMPANY_ID = '$comp_id'
        AND A.SITE_ID = '$site_id'
        AND A.DATE_PROCESS BETWEEN '$selected_datefrom' AND '$selected_dateto' 
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
SELECT 
    B.SELLER_SUB_ID,
    COUNT(CTE.ID) AS TOTAL,
    SUM(CASE WHEN CTE.STATUS = 'COMPLIANT' THEN 1 ELSE 0 END) AS COMPLIANT,
    SUM(CASE WHEN CTE.STATUS = 'NON-COMPLIANT' THEN 1 ELSE 0 END) AS NON_COMPLIANT,
    SUM(CASE WHEN CTE.STATUS = 'PENDING' THEN 1 ELSE 0 END) AS PENDING
FROM dbo.Aquila_Seller AS B LEFT JOIN [dbo].[Aquila_PQR_DSS_DSP_Tagging] D ON B.SELLER_SUB_ID=D.DSP_CODE
LEFT JOIN CTE 
    ON B.SELLER_SUB_ID = CTE.SELLER_ID
WHERE 
    B.SELLER_ID NOT LIKE '%CAS%'
    AND B.SELLER_ID NOT LIKE '%EDI%'
    AND B.SELLER_ID NOT LIKE '%MDT%'
    AND B.SELLER_TYPE = 'VAN SELLER'
    AND B.COMPANY_ID = '$comp_id'
    AND B.SITE_ID = '$site_id'
    AND B.STATUS = 'ACTIVE'  $DSP_SELECTION
GROUP BY 
    B.SELLER_SUB_ID   $selected_status
ORDER BY 
   TOTAL DESC;
";

$result = $conn->query($query);
while($row=$result->fetch(PDO::FETCH_ASSOC)){
    ?>
   <div class="col-12 col-sm-6 col-lg-4 mb-4">
    <div class="card seller-card h-100 btn_view_str" data-id="<?php echo $row["SELLER_SUB_ID"]; ?>">
        <div class="card-body">   
            <div class="card-header">
                <h5 class="card-title"><?php echo $row['SELLER_SUB_ID']; ?></h5>
            </div>
            
            <ul class="status-list">
                <li class="status-item">
                    <span class="status-label">Total</span>
                    <span class="badge total"><?php echo $row['TOTAL'] ?></span>
                </li>
                <li class="status-item">
                    <span class="status-label">Compliant</span>
                    <span class="badge compliant"><?php echo $row['COMPLIANT'] ?></span>
                </li>
                <li class="status-item">
                    <span class="status-label">Non Compliant</span>
                    <span class="badge non-compliant"><?php echo $row['NON_COMPLIANT'] ?></span>
                </li>
                <li class="status-item">
                    <span class="status-label">Pending</span>
                    <span class="badge pending"><?php echo $row['PENDING'] ?></span>
                </li>
            </ul>
        </div>   
    </div>
</div>
<?php
}
 ?>        
</div>
</div>
<style>
.seller-card {
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    transition: all 0.3s ease;
    cursor: pointer;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.seller-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}

.card-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid #e0e0e0;
    padding: 1rem;
    margin: -1rem -1rem 1rem -1rem;
    border-radius: 8px 8px 0 0;
}

.card-title {
    color: #2c3e50;
    font-weight: 600;
    margin: 0;
    font-size: 1.1rem;
}

.status-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.status-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem 0;
    border-bottom: 1px solid #f0f0f0;
}

.status-item:last-child {
    border-bottom: none;
}

.status-label {
    color: #6c757d;
    font-size: 0.9rem;
}

.badge {
    padding: 0.35rem 0.75rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
    min-width: 50px;
    text-align: center;
}

.badge.total {
    background-color: #3498db;
    color: white;
}

.badge.compliant {
    background-color: #27ae60;
    color: white;
}

.badge.non-compliant {
    background-color: #e74c3c;
    color: white;
}

.badge.pending {
    background-color: #FFC107;
    color: white;
}

/* Responsive adjustments */
@media (max-width: 576px) {
    .seller-card {
        margin: 0.5rem;
    }
    
    .status-item {
        padding: 1rem 0;
    }
    
    .card-title {
        font-size: 1rem;
    }
}

@media (max-width: 768px) {
    .col-sm-6 {
        padding: 0 0.5rem;
    }
}
</style>
<script>
    function view_cas_str(compid,siteid,sellerid,filter){
      $.ajax({
        url:'query/PQR_DSP_VIEW_STORES.php',
        method:'POST',
        data:{comp_id:compid, site_id:siteid, seller_id:sellerid,filter:filter},
        success:function(data){    
           $("#main_body").html(data);      
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
   function show_indicator(is_visible){
      $(".marquee-progress").css('display',is_visible)
      if(is_visible == 'none'){  $(".table").css('display','block')}
        else{ $(".table").css('display','none')}
    }
    $(".btn_view_str").click(function(){
    show_indicator('block');
    var site_id='<?php echo  $site_id ; ?>';
    var comp= '<?php echo  $comp_id ; ?>';
    var sellerid=$(this).attr('data-id');  
    view_cas_str(comp,site_id,sellerid,"All");
    })
  $("#filter-dsp").css('display','flex');
</script>