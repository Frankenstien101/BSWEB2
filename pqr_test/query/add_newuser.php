<?php 
try {
    include "../db_connection.php";

    // Ensure all required fields exist
    if (!isset($_POST['FULLNAME'], $_POST['ROLE'], $_POST['USERNAME'], $_POST['PASSWORD'])) {
        throw new Exception("Missing required fields.");
    }

    $ID          = $_POST['ID'] ?? 0;
    $FULLNAME    = $_POST['FULLNAME'];
    $ROLE        = $_POST['ROLE'];
    $USERNAME    = $_POST['USERNAME'];
    $PASSWORD    = $_POST['PASSWORD'];
    $COMPANY_ID  = $_POST['COMPANY_ID'] ?? null;
    $SITE_IDS    = $_POST['SITE_ID'] ?? [];

    if (!is_array($SITE_IDS)) $SITE_IDS = [];

    // ✅ START TRANSACTION
    $conn->beginTransaction();

    // ====================================
    // 🔹 UPDATE EXISTING USER
    // ====================================
    if ($ID != "0") {

        // 1️⃣ Update main user table
        $updateUser = $conn->prepare("
            UPDATE [dbo].[Aquila_PQR_User]
            SET [FULLNAME] = ?, [ROLE] = ?, [USERNAME] = ?, [PASSWORD] = ?
            WHERE [ID] = ?
        ");
        $updateUser->execute([$FULLNAME, $ROLE, $USERNAME, $PASSWORD, $ID]);

        // 2️⃣ Delete old mappings
        $deleteMaps = $conn->prepare("
            DELETE FROM [dbo].[Aquila_PQR_Users_Branch_Mapping] WHERE USER_ID = ?;
            DELETE FROM [dbo].[Aquila_PQR_Users_Company_Mapping] WHERE USER_ID = ?;
        ");
        $deleteMaps->execute([$ID, $ID]);

        // 3️⃣ Insert new site mappings
        if (!empty($SITE_IDS)) {
            $insertSite = $conn->prepare("
                INSERT INTO [dbo].[Aquila_PQR_Users_Branch_Mapping] ([USER_ID],[SITE_ID],[STATUS])
                VALUES (?, ?, 1)
            ");
            foreach ($SITE_IDS as $site) {
                $insertSite->execute([$ID, $site]);
            }
        }

        // 4️⃣ Insert company mapping
        if (!empty($COMPANY_ID)) {
            $insertCompany = $conn->prepare("
                INSERT INTO [dbo].[Aquila_PQR_Users_Company_Mapping] ([USER_ID],[COMPANY_ID],[STATUS])
                VALUES (?, ?, 1)
            ");
            $insertCompany->execute([$ID, $COMPANY_ID]);
        }

        $conn->commit();
        echo "Successfully Updated!";
    }

    // ====================================
    // 🔹 INSERT NEW USER
    // ====================================
    else {

        // 1️⃣ Insert new user and get ID
        $stmt = $conn->prepare("
            INSERT INTO [dbo].[Aquila_PQR_User] ([FULLNAME], [ROLE], [USERNAME], [PASSWORD], [STATUS])
            OUTPUT INSERTED.ID
            VALUES (?, ?, ?, ?, 1)
        ");
        $stmt->execute([$FULLNAME, $ROLE, $USERNAME, $PASSWORD]);
        $inserted_id = $stmt->fetchColumn();

        if (!$inserted_id) {
            throw new Exception("Failed to insert new user.");
        }

        // 2️⃣ Insert site mappings
        if (!empty($SITE_IDS)) {
            $insertSite = $conn->prepare("
                INSERT INTO [dbo].[Aquila_PQR_Users_Branch_Mapping] ([USER_ID],[SITE_ID],[STATUS])
                VALUES (?, ?, 1)
            ");
            foreach ($SITE_IDS as $site) {
                $insertSite->execute([$inserted_id, $site]);
            }
        }

        // 3️⃣ Insert company mapping
        if (!empty($COMPANY_ID)) {
            $insertCompany = $conn->prepare("
                INSERT INTO [dbo].[Aquila_PQR_Users_Company_Mapping] ([USER_ID],[COMPANY_ID],[STATUS])
                VALUES (?, ?, 1)
            ");
            $insertCompany->execute([$inserted_id, $COMPANY_ID]);
        }

        $conn->commit();
        echo "Successfully Added!";
    }

} catch (Throwable $e) {
    // Rollback if something goes wrong
    if ($conn->inTransaction()) $conn->rollBack();
    echo "Error: " . htmlspecialchars($e->getMessage());
}
?>
