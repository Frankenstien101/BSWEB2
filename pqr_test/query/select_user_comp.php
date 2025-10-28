<?php
include '../db_connection.php';


if (isset($_POST['comp'])) {
    // Store the selected company ID in session
    // Fetch the site ID if it's set in the session
    // Fetch the sites related to the selected company
    $query = "SELECT SITEID, SITE_CODE FROM [dbo].[Aquila_Sites] WHERE COMPANY_ID = '{$_POST['comp']}'";
    $item = $conn->query($query);
  echo '<option value="" disabled>Select Site</option>';
    // Output the options for the site select element
    while ($row = $item->fetch(PDO::FETCH_ASSOC)) {
        echo '<option value="' . htmlspecialchars($row['SITEID']) . '">' . htmlspecialchars($row['SITE_CODE']) . '</option>';
    }
}
?>
