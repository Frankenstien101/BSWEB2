<?php 
try {
include "../db_connection.php";
$STATUS = strtoupper($_POST['STATUS']);
$qq = $conn->query("update  [dbo].[SNAP_EXECUTION_LINES] set STATUS='{$STATUS}' WHERE LINEID='{$_POST['LINEID']}'");
echo $_POST['STATUS'];
}
catch (Exception $e) {
	echo $e;
}
 ?>