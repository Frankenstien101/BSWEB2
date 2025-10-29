<?php
include '../db_connection.php';

if (isset($_POST['comp'])) {
    $comp = $_POST['comp'];

    // If multiple companies are selected, handle it as an array
    if (is_array($comp)) {
        // Convert all IDs to integers for safety
        $comp = array_map('intval', $comp);
        // Create a safe SQL IN clause
        $inClause = implode(',', $comp);
        $query = "SELECT SITEID, SITE_CODE FROM [dbo].[Aquila_Sites] WHERE COMPANY_ID IN ($inClause)";
    } else {
        // Single company
        $comp = intval($comp);
        $query = "SELECT SITEID, SITE_CODE FROM [dbo].[Aquila_Sites] WHERE COMPANY_ID = $comp";
    }

    // Execute query
    $item = $conn->query($query);

    // Output options
    echo '<option value="" disabled>Select Site</option>';
    while ($row = $item->fetch(PDO::FETCH_ASSOC)) {
        echo '<option value="' . htmlspecialchars($row['SITEID']) . '">' . htmlspecialchars($row['SITE_CODE']) . '</option>';
    }
}
?>
