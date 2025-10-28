<?php 
   include "../db_connection.php";
$str_id = $_POST['store_code'];
$comp_id = $_POST['comp_id'];
$site_id = $_POST['site_id'];
$filter  =($_POST['filter'] == 'ALL')? "": " and ISNULL(EL.STATUS,'NO PHOTO') = '".$_POST['filter'] ."'";
$query = "WITH CTE  AS (select  a.SITE_ID,SITE_CODE,[STORE_CODE],[CUSTOMER_NAME], b.[SELLER_ID], GUIDELINES_ID,SD.LINEID,SD.BRAND, SD.DESCRIPTION as DESCRIP,
SD.SHELVING_FACING_COUNT AS SHOULD_BE_FC
from Aquila_Customers a join Aquila_Coverage  b on a.STORE_CODE = b.CUSTOMER_ID 
AND a.COMPANY_ID=b.COMPANY_ID JOIN [dbo].[Aquila_Seller] AQS ON  b.SELLER_ID=AQS.SELLER_SUB_ID
JOIN [dbo].[Aquila_Sites] STS ON AQS.SITE_ID = STS.SITEID
CROSS JOIN [SNAP_GUIDELINE_SETUP_DETAILS] SD  WHERE SELLER_TYPE='PRE SELLER' AND b.COMPANY_ID ='{$comp_id}' AND SD.COMPANY_ID='{$comp_id}'
and a.STATUS='ACTIVE' AND b.STATUS='ACTIVE'
GROUP BY a.SITE_ID,SITE_CODE,[STORE_CODE],[CUSTOMER_NAME], b.[SELLER_ID],GUIDELINES_ID,SD.LINEID,SD.BRAND,SD.DESCRIPTION
,SD.SHELVING_FACING_COUNT)


SELECT  EL.LINEID AS EX_ID,ISNULL(EL.STATUS,'NO PHOTO') AS EX_STATUS,*
FROM CTE  JOIN [dbo].[SNAP_GUIDELINE_SETUP_TRANSACTION] ST 
ON CTE.GUIDELINES_ID=ST.GUIDELINES_ID LEFT JOIN [dbo].[SNAP_EXECUTION_LINES] EL ON
CTE.LINEID=EL.GUIDELINE_QUESTION_LINEID AND CTE.STORE_CODE=EL.STORE_ID where  STORE_CODE='{$str_id}' AND CTE.site_id='{$site_id}' AND COMPANY_ID='{$comp_id}' {$filter} order BY BRAND
";

$result = $conn->query($query);
$i = 1;

while($row=$result->fetch(PDO::FETCH_ASSOC)){
    ?>
              <div class="col-3 mb-3">
               <div class="card" >
                <img class="img_click" style="height: 200px; width: 100%;" src="<?php echo $row['CAPTURED_IMG'] ?>" alt="...">
                  <div class="card-body">
                    <h5 class="card-title"><?php echo $row['BRAND']?></h5>
                    <p class="card-text"><?php echo $row['DESCRIP'] ?></p>
                      <div id="pending<?php echo $row['EX_ID']?>" class="<?php echo (($row['EX_STATUS'] == 'PENDING')) ? '': 'visually-hidden'?>">
                         <a href="#" class="btn btn-success btn-verified"  data-status="COMPLIANT"  data-id=<?php echo $row['EX_ID'] ?> >Compliant <span class="spinner-border spinner-border-sm visually-hidden" aria-hidden="true"></span></a>
                          <a href="#" class="btn btn-danger btn-verified"  data-status="NON COMPLIANT"  data-id=<?php echo $row['EX_ID'] ?>>Non Compliant <span class="spinner-border spinner-border-sm visually-hidden"  aria-hidden="true"></span></a>
                      </div>
                <div id="verified<?php echo $row['EX_ID']?>"  class="<?php echo (($row['EX_STATUS'] !== "NO PHOTO") && $row['EX_STATUS'] !== 'PENDING') ? '' : 'visually-hidden'; ?>">
                                    <div class="row" >
                                        <div class="col-8"> <span class="badge text-success fs-6" id="<?php echo $row["EX_ID"] ?>"><?php echo $row['EX_STATUS'] ?></span></div>
                                        <div class="col-4">
                                      <button class="btn btn-secondary btn-sm btn-verified" data-status="PENDING" data-id=<?php echo $row['EX_ID'] ?>>Pending<i class="bi bi-arrow-clockwise fs-6"></i><span class="spinner-border spinner-border-sm visually-hidden"  aria-hidden="true"></span></button></div>
                                    </div> 
                </div>
                  <span id="status_done<?php echo $row['EX_ID']?> " class="<?php echo (($row['EX_STATUS'] == "NO PHOTO")) ? '':'visually-hidden'?>">No photo</span>                    
                </div>
            </div>
        </div>  
<?php
$i++;
}
 ?>   
 <script>
     
$(".btn-verified").click(function(){
   verified($(this))
})
function verified(_btn){
var id= _btn.attr('data-id');
var status= _btn.attr('data-status');
_btn.find('span').removeClass('visually-hidden');
$.ajax({
  url:'query/update_status_cas.php',
  method:'POST',
  data:{STATUS:status, LINEID: id},
  success:function(data){
    if(data  != 'PENDING'){
$("#verified"+id).removeClass('visually-hidden');
$("#pending"+id).addClass('visually-hidden');
$("#"+id).html(data)
    }
    else{
$("#pending"+id).removeClass('visually-hidden');
$("#verified"+id).addClass('visually-hidden');
    }
_btn.find('span').addClass('visually-hidden');
  }
})
}
        $(".img_click").click(function() {
            var src = $(this).attr('src');
    $('#imd_prev').attr('src', src); // here assign the image to the modal when the user click the enlarge link
    $('#imagemodal').modal('show');
});
 </script>