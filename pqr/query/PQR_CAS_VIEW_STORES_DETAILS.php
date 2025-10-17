
<?php 
  include "../db_connection.php";

  $seller_id = $_POST['seller_id'];
   $site_id = $_POST['site_id'];
    $comp_id = $_POST['comp_id'];
     $filter = ($_POST['filter'] != "ALL")?" HAVING SUM( CASE WHEN EL.STATUS = 'PENDING' THEN 1 ELSE 0 END) > 0":"";

$query = "WITH CTE  AS (select  a.SITE_ID,SITE_CODE,[STORE_CODE],[CUSTOMER_NAME], b.[SELLER_ID], GUIDELINES_ID,SD.LINEID,SD.BRAND, SD.DESCRIPTION,
SD.SHELVING_FACING_COUNT AS SHOULD_BE_FC
from Aquila_Customers a join Aquila_Coverage  b on a.STORE_CODE = b.CUSTOMER_ID 
AND a.COMPANY_ID=b.COMPANY_ID JOIN [dbo].[Aquila_Seller] AQS ON  b.SELLER_ID=AQS.SELLER_SUB_ID
JOIN [dbo].[Aquila_Sites] STS ON AQS.SITE_ID = STS.SITEID
CROSS JOIN [SNAP_GUIDELINE_SETUP_DETAILS] SD  WHERE SELLER_TYPE='PRE SELLER' AND b.COMPANY_ID ='{$comp_id}' AND SD.COMPANY_ID='{$comp_id}'
and a.STATUS='ACTIVE' AND b.STATUS='ACTIVE'
GROUP BY a.SITE_ID,SITE_CODE,[STORE_CODE],[CUSTOMER_NAME], b.[SELLER_ID],GUIDELINES_ID,SD.LINEID,SD.BRAND,SD.DESCRIPTION
,SD.SHELVING_FACING_COUNT)
SELECT [STORE_CODE],[CUSTOMER_NAME],SUM( CASE WHEN EL.STATUS IS NULL THEN 1 ELSE 0 END) AS NOPHOTO, SUM( CASE WHEN EL.STATUS = 'PENDING' THEN 1 ELSE 0 END) AS PENDING
, SUM( CASE WHEN EL.STATUS = 'COMPLIANT' THEN 1 ELSE 0 END) AS COMPLIANT, SUM( CASE WHEN EL.STATUS = 'NON COMPLIANT' THEN 1 ELSE 0 END) AS NON_COMPLIANT,
COUNT(SELLER_ID) AS TOTAL
FROM CTE  JOIN [dbo].[SNAP_GUIDELINE_SETUP_TRANSACTION] ST 
ON CTE.GUIDELINES_ID=ST.GUIDELINES_ID LEFT JOIN [dbo].[SNAP_EXECUTION_LINES] EL ON
CTE.LINEID=EL.GUIDELINE_QUESTION_LINEID AND CTE.STORE_CODE=EL.STORE_ID where  SELLER_ID='{$seller_id}' AND CTE.site_id='{$site_id}' AND COMPANY_ID='{$comp_id}' 
GROUP BY [STORE_CODE],[CUSTOMER_NAME] {$filter}
";
$result = $conn->query($query);
while($row=$result->fetch(PDO::FETCH_ASSOC)){
    ?>
    <div class="col-md-6 col-lg-4 mb-4 ">
            <a  data-id="<?php echo $row["STORE_CODE"] ?>" class="text-decoration-none card-a btn_view_str">
                <div class="card text-center" id="card_a" data-id="A">
                    <div class="card-body">   
                    <div class="row">
                        <div class="col"><span class="card-title">
                            <?php echo $row["STORE_CODE"]." | ".$row["CUSTOMER_NAME"]  ?>
                        </span></div>                       
                        
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
                            <span class="badge bg-secondary rounded-pill">
                                
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
 <script>
     $(".btn_view_str").click(function(){
    show_indicator('block');
    var site_id='<?php echo  $site_id ; ?>';
    var comp= '<?php echo  $comp_id ; ?>';
    var sellerid= '<?php echo  $seller_id ; ?>';
    var storecode=$(this).attr('data-id');  
    view_cas_str(comp,site_id,storecode, sellerid);    
    })
 function view_cas_str(compid,siteid,storecode,sellerid){
      $.ajax({
        url:'query/PQR_CAS_VIEW_EXECUTION.php',
        method:'POST',
        data:{comp_id:compid, site_id:siteid, store_code:storecode, seller_id:sellerid},
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
 </script>