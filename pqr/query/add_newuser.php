<?php 
try {
include "../db_connection.php";
extract($_POST);
if ($_POST['LINE_ID'] != "0") {

$query = $conn->query("UPDATE [dbo].[Aquila_SC3_users] SET
			[SITE_ID] = '".$_POST['SITEID']."'
           ,[USER_LOGIN_ID] = '".$_POST['USER_LOGIN_ID']."'
           ,[USER_PASS] = '".$_POST['USER_PASS']."'
           ,[User_Role]= '".$_POST['USER_ROLE']."' WHERE LINE_ID = '".$_POST['LINE_ID']."'  ");

echo "Successfuly Updated!";

}
else{
	$query = $conn->query("INSERT INTO [dbo].[Aquila_SC3_users]
           ([COMPANY_ID]
           ,[SITE_ID]
           ,[USER_LOGIN_ID]
           ,[USER_PASS]
           ,[STATUS]
           ,[User_Role])
     VALUES('".$USER["COMPANY_ID"]."','".$USER["SITE_ID"]."','".$_POST['USER_LOGIN_ID']."','".$_POST['USER_PASS']."','ACTIVE','".$_POST['USER_ROLE']."')");
echo "Successfuly Added!";
} }
catch (Exception $e) {
	echo $e;
}
 ?>