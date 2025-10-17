<?php
include '../db_connection.php';
session_start();
$page_per_load = 20;
$comp_id = ($_POST['comp1'] != null) ? $_POST['comp1'] : $_SESSION['comp_id'];
$site_id =($_POST['site1']!= null)  ? $_POST['site1'] : $_SESSION['ses_site'];
$dt_from = ($_POST['dt_from'] != null) ? $_POST['dt_from'] :date('Y-m-d');
$dt_to =($_POST['dt_to']!= null)  ? $_POST['dt_to'] :date('Y-m-d');
$pages_q = "select  count(*)/$page_per_load as Total_pages FROM [dbo].[Aquila_PQR_Incentive] where SITE_ID='{$site_id}' AND COMPANY_ID = '{$comp_id}'";
$res_page = $conn->query($pages_q)->fetch(PDO::FETCH_ASSOC);
$totalPages = $res_page["Total_pages"];
$page_now = isset($_POST['page_now']) ? $_POST['page_now']:1;
$offset = ($page_now-1)*$page_per_load;

$query = "SELECT  A.*,B.SELLER_ID,A_COMMENT,B_COMMENT,B.DATE_PROCESS AS CAP_DATE,ISNULL(B.BEFORE_LINK, C.BEFORE_LINK) AS BEFORE_LINK,ISNULL(B.AFTER_LINK, C.AFTER_LINK) AS AFTER_LINK 
,DISTANCE ,ADDRESS AS STORE_ADD FROM [dbo].[Aquila_PQR_Incentive] a
join  [dbo].[Aquila_PQR] B ON A.PQR_ID = B.LINE_ID left join Aquila_PQR_Link C ON B.PQR_ID=C.PQR_ID where A.SITE_ID='{$site_id}' AND A.COMPANY_ID = '{$comp_id}' and B.DATE_PROCESS BETWEEN '{$dt_from}' and  '{$dt_to}'
order by ID desc   OFFSET $offset ROWS FETCH NEXT $page_per_load ROWS ONLY";
$result = $conn->query($query);

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $i=0;
?>
<div class="card  border-danger col-12 mb-2">
             <div class="card mt-2  col-lg-12" style="height:100px; background:red;">
                <table class="table" style="background-color: white;">
                    <tr> 
                        <th><span style="color: #3289C8;font-size: 12PX; ">SELLER CODE</span></th>
                       <th><span style="color: #3289C8;font-size: 12PX;">CUSTOMER INFO(CU_ID | CU_NAME)</span></th>
                           <th><span style="color: #3289C8;font-size: 12PX;">DATE</span></th>
                               <th><span style="color: #3289C8;font-size: 12PX;">ADDRESS INFO:</span> <span style="color: #3289C8;float: right;font-size: 12PX;"> DISTANCE: <span style="color: black;"><?php echo $row["DISTANCE"] ?></span> </span></th>
                    </tr>
                                <tr>
                                  <td style="font-size:12px; font-weight: bold;"><?php echo $row["SELLER_ID"]?></td>
                                  <td style="font-size:12px; font-weight: bold;"><?php echo $row["CUSTOMER_ID"]." | ".$row["CUSTOMER_NAME"] ?></td>
                                  <td style="font-size:12px; font-weight: bold;"><?php echo $row["CAP_DATE"] ?></td>
                                  <td style="font-size:12px; font-weight: bold;"><?php echo ($row["STORE_ADD"]) ; ?></td>
                              </tr>
                </table>
                </div>
                  <table class="table">
                      <tr>
                        <th>BEFORE: <span style="font-weight: normal; font-size: 12px;"><?php echo strtoupper($row["A_COMMENT"]) ?></span></th>
                        <th>AFTER: <span style="font-weight: normal;font-size: 12px;"><?php echo strtoupper($row["B_COMMENT"]) ?></span></th>
                    </tr>
                    <tr>
                        <td>
                          <img  height="500px" width="100%"  src="<?php echo $row['AFTER_LINK']?>">
                      </td>
                        <td>      
                          <img  height="500px" width="100%"  src="<?php echo $row['BEFORE_LINK']  ?>">
                        </td> 
                        
                  </tr>
              </table>

          </div>
<?php
$i++;
 if (($i + 1) % 2 == 0) { ?>
            <div class="page-break"></div>
        <?php } 
}
 ?>