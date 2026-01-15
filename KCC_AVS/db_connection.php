<?php
date_default_timezone_set("Asia/Manila");

try {
    $conn = new PDO("sqlsrv:server = tcp:bspidbservernew.database.windows.net,1433; Database = BSPIDBNEW", "sqladmin", "{b\$p1.@dm1n}");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (!function_exists('insert_logs')) {
        function insert_logs($conn, $log_id, $status)
        {
            $sql = "INSERT INTO Dash_UserLogs (USERNAME, REMARKS, DATETIME)
                VALUES (:username, :remarks, :datetime)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':remarks', $status);
            $stmt->bindParam(':username', $log_id);
            $datetime = date("Y-m-d H:i:s");
            $stmt->bindParam(':datetime', $datetime);
            $stmt->execute();
        }
    }
} catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}
