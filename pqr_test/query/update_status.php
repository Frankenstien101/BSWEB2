<?php 
try {
include "../db_connection.php";
$qq = $conn->query("UPDATE [dbo].[Aquila_PQR_Incentive] set STATUS='".$_POST['STATUS']."'
 WHERE PQR_ID='".$_POST['PQR_ID']."'");
echo $_POST['STATUS'];
}
catch (Exception $e) {
	echo $e;
}
 ?>