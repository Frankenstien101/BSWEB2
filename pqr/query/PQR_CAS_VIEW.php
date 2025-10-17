<?php 

    include "../db_connection.php";
    session_start();
    $comp_id = isset($_POST['comp_id'])?$_POST['comp_id']:'';
    $site_id = isset($_POST['site_id'])?$_POST['site_id']:'';

 ?>

<div class="container-body" style="height: 85vh; width: 100%; background-color: #F6F6F9;border-radius:   10px; overflow-y: scroll; padding:    10px; ">
    <div class="row">   
<?php 
$query = "WITH CTE  AS (select  a.SITE_ID,SITE_CODE,[STORE_CODE],[CUSTOMER_NAME], b.[SELLER_ID], GUIDELINES_ID,SD.LINEID,SD.BRAND, SD.DESCRIPTION,
SD.SHELVING_FACING_COUNT AS SHOULD_BE_FC
from Aquila_Customers a join Aquila_Coverage  b on a.STORE_CODE = b.CUSTOMER_ID 
AND a.COMPANY_ID=b.COMPANY_ID JOIN [dbo].[Aquila_Seller] AQS ON  b.SELLER_ID=AQS.SELLER_SUB_ID
JOIN [dbo].[Aquila_Sites] STS ON AQS.SITE_ID = STS.SITEID
CROSS JOIN [SNAP_GUIDELINE_SETUP_DETAILS] SD  WHERE b.[SELLER_ID] NOT LIKE '%PRE%'  AND SELLER_TYPE='PRE SELLER' AND b.COMPANY_ID ='{$comp_id}' AND SD.COMPANY_ID='{$comp_id}'
and a.STATUS='ACTIVE' AND b.STATUS='ACTIVE'
GROUP BY a.SITE_ID,SITE_CODE,[STORE_CODE],[CUSTOMER_NAME], b.[SELLER_ID],GUIDELINES_ID,SD.LINEID,SD.BRAND,SD.DESCRIPTION
,SD.SHELVING_FACING_COUNT)
SELECT SELLER_ID,SUM( CASE WHEN EL.STATUS IS NULL THEN 1 ELSE 0 END) AS NOPHOTO, SUM( CASE WHEN EL.STATUS = 'PENDING' THEN 1 ELSE 0 END) AS PENDING
, SUM( CASE WHEN EL.STATUS = 'COMPLIANT' THEN 1 ELSE 0 END) AS COMPLIANT, SUM( CASE WHEN EL.STATUS = 'NON COMPLIANT' THEN 1 ELSE 0 END) AS NON_COMPLIANT,
COUNT(SELLER_ID) AS TOTAL
FROM CTE  JOIN [dbo].[SNAP_GUIDELINE_SETUP_TRANSACTION] ST 
ON CTE.GUIDELINES_ID=ST.GUIDELINES_ID LEFT JOIN [dbo].[SNAP_EXECUTION_LINES] EL ON
CTE.LINEID=EL.GUIDELINE_QUESTION_LINEID AND CTE.STORE_CODE=EL.STORE_ID where CTE.site_id='{$site_id}' AND COMPANY_ID='{$comp_id}'
GROUP BY SELLER_ID
";

$result = $conn->query($query);
while($row=$result->fetch(PDO::FETCH_ASSOC)){
    ?>
    <div class="col-md-6 col-lg-4 mb-4 ">
            <a style="cursor: pointer;" data-id="<?php echo $row["SELLER_ID"]; ?>"  class="text-decoration-none card-a btn_view_str">
                <div class="card text-center" id="card_a" data-id="A">
                    <div class="card-body">   
                    <div class="row">
                        <div class="col"><h5 class="card-title">
                            <?php echo $row['SELLER_ID']; ?>
                        </h5></div>                       
                        
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item d-flex justify-content-between align-items-center text-muted"> Compliant
                            <span class="badge bg-success rounded-pill"><?php echo $row['COMPLIANT']; ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center text-muted"> Non Compliant
                            <span class="badge bg-danger rounded-pill"><?php echo $row['NON_COMPLIANT']; ?></span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center text-muted"> No Photo
                            <span class="badge bg-danger rounded-pill"><?php echo $row['NOPHOTO']; ?></span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center  text-muted"> Pending
                            <span class="badge bg-secondary   rounded-pill">
                                
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
<script>

    function view_cas_str(compid,siteid,sellerid){
      $.ajax({
        url:'query/PQR_CAS_VIEW_STORES.php',
        method:'POST',
        data:{comp_id:compid, site_id:siteid, seller_id:sellerid},
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
    view_cas_str(comp,site_id,sellerid);
    })
</script>