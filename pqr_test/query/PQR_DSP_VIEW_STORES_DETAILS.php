
<?php 
  include "../db_connection.php";

$seller_id = $_POST['seller_id'];
$site_id = $_POST['site_id'];
$comp_id = $_POST['comp_id'];
$selected_datefrom = isset($_SESSION['ses_datefrom']) ? $_SESSION['ses_datefrom'] : date('Y-m-d'); ;
$selected_dateto = isset($_SESSION['ses_dateto']) ? $_SESSION['ses_dateto'] : date('Y-m-d');
    $filter = ($_POST['filter'] != "ALL")?" HAVING SUM(CASE WHEN CTE.STATUS = 'PENDING' THEN 1 ELSE 0 END) > 0":"";
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