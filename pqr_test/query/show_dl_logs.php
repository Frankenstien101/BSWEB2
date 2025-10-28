<table class="table table-hover table-responsive">
    <thead>
        <TR>
            <TH>File Name</TH>
            <TH>Date</TH>
            <TH>Time</TH>
        </TR>
    </thead>
    <tbody >
<?php
include '../db_connection.php';
session_start();
$date =date('Y-m-d');
$query = "select FILE_NAME,DATE_DL,TIME_DL from Aquila_PQR_DL_Logs WHERE COMPANY_ID='{$_SESSION['comp_id']}' and
STATUS='1' and FILE_TYPE='{$_POST['TYPE']}' AND DATE_DL='{$date}' order by TIME_DL DESC";
$RES = $conn->query($query);
while($ROW = $RES->fetch(PDO::FETCH_ASSOC)){
?>
 <tr>
<td>            
    <?php 
    echo $ROW["FILE_NAME"] ; 
            ?></td>
            <td>
<a type="button" href="query/download_template.php?file=<?php echo $ROW["FILE_NAME"]  ?>"  class="btn btn-sm btn-secondary"><i class="bi bi-cloud-arrow-down"></i></a>
</td>
<td>
<button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
</td>
          </tr>
<?php
}
?>
</tbody>
</table> 