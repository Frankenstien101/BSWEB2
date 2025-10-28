<?php 
try {
	session_start();
include "../db_connection.php";
$comment = $_POST["STATUS"];
$STATUS = ($comment == "Proper Execution")?'COMPLIANT':'NON-COMPLIANT';

if($_POST['type'] == "BEFORE"){
$qq = $conn->query("UPDATE [dbo].[Aquila_PQR_Incentive] set USER_ID='{$_SESSION['id']}',STATUS='$STATUS',B_COMMENT='$comment'
 WHERE PQR_ID='".$_POST['PQR_ID']."'");
 echo $STATUS;
}
else{

$qq =  $conn->query("UPDATE [dbo].[Aquila_PQR_Incentive] set USER_ID='{$_SESSION['id']}',STATUS='$STATUS',A_COMMENT='$comment'
 WHERE PQR_ID='".$_POST['PQR_ID']."'");
  echo $STATUS;
}
}
catch (Exception $e) {
	echo $e;
}
 ?>