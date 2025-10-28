<?php
include '../db_connection.php';
session_start();
if (isset($_POST['comp'])) {
    // Store the selected company ID in session
    $_SESSION['comp_id'] = $_POST['comp'];
    $comp_id = $_POST['comp'];

    // Fetch the site ID if it's set in the session
    $selected_site_id = isset($_SESSION['ses_site']) ? $_SESSION['ses_site']:'';

    if($_SESSION['role'] == 'Admin'){
        $query = "SELECT SITEID, SITE_CODE FROM [dbo].[Aquila_Sites]  WHERE COMPANY_ID = :comp_id ";
    }
    else{

     $query = "SELECT SITEID, SITE_CODE FROM [dbo].[Aquila_Sites]  s join [dbo].[Aquila_PQR_Users_Branch_Mapping] b on s.SITEID=b.SITE_ID WHERE COMPANY_ID = :comp_id and USER_ID={$_SESSION['id']}";
    }

 $stmt = $conn->prepare($query);
 $stmt->bindParam(':comp_id', $comp_id, PDO::PARAM_STR);
 $stmt->execute();
 echo '<option value="" >Select Site</option>';
    // Output the options for the site select element
 while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $selected = ($selected_site_id == $row['SITEID']) ? 'selected' : '';
    echo '<option value="' . htmlspecialchars($row['SITEID']) . '" ' . $selected . '>' . htmlspecialchars($row['SITE_CODE']) . '</option>';
}
}
?>
