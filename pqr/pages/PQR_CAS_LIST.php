<div class="container-body" style="height: 85vh; width: 100%; background-color: #F6F6F9;border-radius:   10px; overflow-y: scroll; padding:    10px; ">
    <div class="row">   
<?php 
$query = "WITH CTE  AS (select  a.SITE_ID,SITE_CODE,[STORE_CODE],[CUSTOMER_NAME], b.[SELLER_ID], GUIDELINES_ID,SD.LINEID,SD.BRAND, SD.DESCRIPTION,
SD.SHELVING_FACING_COUNT AS SHOULD_BE_FC
from Aquila_Customers a join Aquila_Coverage  b on a.STORE_CODE = b.CUSTOMER_ID 
AND a.COMPANY_ID=b.COMPANY_ID JOIN [dbo].[Aquila_Seller] AQS ON  b.SELLER_ID=AQS.SELLER_SUB_ID
JOIN [dbo].[Aquila_Sites] STS ON AQS.SITE_ID = STS.SITEID
CROSS JOIN [SNAP_GUIDELINE_SETUP_DETAILS] SD  WHERE b.[SELLER_ID] NOT LIKE '%PRE%' AND SELLER_TYPE='PRE SELLER' AND b.COMPANY_ID ='{$comp_id}' AND SD.COMPANY_ID='{$comp_id}'
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
            <a href="?page=PQR_DETAILED" class="text-decoration-none card-a">
                <div class="card text-center" id="card_a" data-id="A">
                    <div class="card-body">   
                    <div class="row">
                        <div class="col"><h5 class="card-title">
                            <?php echo $row['SELLER_ID']; ?>
                        </h5></div>
                        <div class="col"> 
                           <span>
                               
                           </span>
                        </div>   
                        
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
                            <span class="badge bg-warning rounded-pill">
                                
                                <?php echo $row['PENDING']; ?>
                            </span>
                        </li>  
                    </ul>
                </div>
            </div>   
        </a>
    </div>    
    </div>
<?php
}
 ?>
        



</div>
</div>