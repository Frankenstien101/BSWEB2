<?php
try {
    $conn = new PDO(
        "sqlsrv:server=tcp:bspidbservernew.database.windows.net,1433;Database=BSPIDBNEW",
        "sqladmin",
        'b$p1.@dm1n' // use single quotes for passwords with special characters
    );
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   // echo "✅ Connected successfully via PDO.";
} catch (PDOException $e) {
    echo "❌ Error connecting to Server: " . $e->getMessage();
}
?>
