<?php
try {
    include "../db_connection.php";

    // ✅ Validate required fields
    if (!isset($_POST['FULLNAME'], $_POST['ROLE'], $_POST['USERNAME'], $_POST['PASSWORD'])) {
        throw new Exception("Missing required fields.");
    }

    // ✅ Sanitize and prepare variables
    $ID          = intval($_POST['ID'] ?? 0);
    $FULLNAME    = trim($_POST['FULLNAME']);
    $ROLE        = trim($_POST['ROLE']);
    $USERNAME    = trim($_POST['USERNAME']);
    $PASSWORD    = trim($_POST['PASSWORD']);

    // Company & site IDs can be multiple selections
    $COMPANY_ID  = $_POST['COMPANY_ID'] ?? [];
    $SITE_IDS    = $_POST['SITE_ID'] ?? [];

    if (!is_array($COMPANY_ID)) $COMPANY_ID = [$COMPANY_ID];
    if (!is_array($SITE_IDS))   $SITE_IDS = [$SITE_IDS];

    // Convert all IDs to integers (prevents nvarchar errors)
    $COMPANY_ID = array_map('intval', $COMPANY_ID);
    $SITE_IDS   = array_map('intval', $SITE_IDS);

    // ✅ Begin transaction
    $conn->beginTransaction();

    // ====================================
    // 🔹 UPDATE EXISTING USER
    // ====================================
    if ($ID > 0) {

        // 1️⃣ Update main user table
        $updateUser = $conn->prepare("
            UPDATE [dbo].[Aquila_PQR_User]
            SET [FULLNAME] = ?, [ROLE] = ?, [USERNAME] = ?, [PASSWORD] = ?
            WHERE [ID] = ?
        ");
        $updateUser->execute([$FULLNAME, $ROLE, $USERNAME, $PASSWORD, $ID]);

        // 2️⃣ Delete old mappings
        $deleteBranch = $conn->prepare("DELETE FROM [dbo].[Aquila_PQR_Users_Branch_Mapping] WHERE USER_ID = ?");
        $deleteBranch->execute([$ID]);

        $deleteCompany = $conn->prepare("DELETE FROM [dbo].[Aquila_PQR_Users_Company_Mapping] WHERE USER_ID = ?");
        $deleteCompany->execute([$ID]);

        // 3️⃣ Insert new site mappings
        if (!empty($SITE_IDS)) {
            $insertSite = $conn->prepare("
                INSERT INTO [dbo].[Aquila_PQR_Users_Branch_Mapping] ([USER_ID],[SITE_ID],[STATUS])
                VALUES (?, ?, 1)
            ");
            foreach ($SITE_IDS as $site) {
                if ($site > 0) $insertSite->execute([$ID, $site]);
            }
        }

        // 4️⃣ Insert new company mappings
        if (!empty($COMPANY_ID)) {
            $insertCompany = $conn->prepare("
                INSERT INTO [dbo].[Aquila_PQR_Users_Company_Mapping] ([USER_ID],[COMPANY_ID],[STATUS])
                VALUES (?, ?, 1)
            ");
            foreach ($COMPANY_ID as $comp) {
                if ($comp > 0) $insertCompany->execute([$ID, $comp]);
            }
        }

        $conn->commit();
        echo "✅ Successfully Updated!";

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
                if ($site > 0) $insertSite->execute([$inserted_id, $site]);
            }
        }

        // 3️⃣ Insert company mappings
        if (!empty($COMPANY_ID)) {
            $insertCompany = $conn->prepare("
                INSERT INTO [dbo].[Aquila_PQR_Users_Company_Mapping] ([USER_ID],[COMPANY_ID],[STATUS])
                VALUES (?, ?, 1)
            ");
            foreach ($COMPANY_ID as $comp) {
                if ($comp > 0) $insertCompany->execute([$inserted_id, $comp]);
            }
        }

        $conn->commit();
        echo "✅ Successfully Added!";
    }

} catch (Throwable $e) {
    // Rollback if something goes wrong
    if ($conn->inTransaction()) {
        $conn->rollBack();
    }
    echo "❌ Error: " . htmlspecialchars($e->getMessage());
}
?>
