<?php 
try {
include "../db_connection.php";
session_start();
$qq = $conn->query("UPDATE [dbo].[Aquila_PQR] set PHOTO_STATUS='".$_POST['STATUS']."' , USER_ID='".$_SESSION['id']."', VALIDATED_DATE='".date('Y-m-d H:i:s')."'
 WHERE PQR_ID='".$_POST['PQR_ID']."'");

echo $_POST['STATUS'];
}
catch (Exception $e) {
	echo $e;
}
 ?>