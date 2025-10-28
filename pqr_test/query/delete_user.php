<?php 
try {
	include "../db_connection.php";
$delete = $conn->query("delete  from Aquila_PQR_USer WHERE ID='".$_GET['LINE_ID']."'");
	echo "Deleted Succesfuly!";
} 
catch (Exception $e) {
	echo $e;
}
 ?>