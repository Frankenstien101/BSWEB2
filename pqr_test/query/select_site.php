<?php 
include '../db_connection.php';
session_start();
$_SESSION['ses_site'] = $_POST["site"];


if(isset($_SESSION['comp_id'])) {
    // Store the selected company ID in session

    $comp_id = $_SESSION['comp_id'] ;
    $selected_pqrid = isset($_SESSION['guideline_id'])? $_SESSION['guideline_id'] :'';
    // Fetch the site ID if it's set in the session
  
    // Fetch the sites related to the selected company
    $query = "select GUIDELINES_ID,DESCRIPTION from [dbo].[SNAP_GUIDELINE_SETUP_TRANSACTION] WHERE COMPANY_ID = :comp_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':comp_id', $comp_id, PDO::PARAM_STR);
    $stmt->execute();
  echo '<option value="" selected>Select Guiline</option>';
    // Output the options for the site select element
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $selected = (  $selected_pqrid == $row['SITEID']) ? 'selected' : '';
        echo '<option value="' . htmlspecialchars($row['GUIDELINES_ID']) . '" ' . $selected . '>' . htmlspecialchars($row['GUIDELINES_ID']."|".$row['DESCRIPTION']) . '</option>';
    }
}

 ?>