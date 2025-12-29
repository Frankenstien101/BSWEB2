<?php
session_start();

// ==================== DATABASE CONFIG ====================
define('DB_SERVER', 'bspidbservernew.database.windows.net');
define('DB_USERNAME', 'sqladmin');
define('DB_PASSWORD', 'b$p1.@dm1n');
define('DB_NAME', 'BSPIDBNEW');
define('DB_PORT', '1433');

// Try to connect and set status
$status = 'OFFLINE';
$statusColor = 'red';
$pdo = null;

try {
    $dsn = "sqlsrv:Server=" . DB_SERVER . "," . DB_PORT . ";Database=" . DB_NAME . ";Encrypt=true;TrustServerCertificate=false;";
    $pdo = new PDO($dsn, DB_USERNAME, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $status = 'ONLINE';
    $statusColor = 'limegreen';
} catch (PDOException $e) {
    $status = 'OFFLINE';
    $statusColor = 'red';
}

// ==================== LOGIN PROCESS ====================
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($status === 'OFFLINE') {
        $error = "Please Check Your Internet Connection";
    } else {
        $username = trim($_POST['username'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if (empty($username) || empty($password)) {
            $error = "Please enter username and password";
        } else {
            try {
                $sql = "SELECT ID, Role, Name, CompanyID FROM Aquila_Users WHERE Username = ? AND Password = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$username, $password]);
                $user = $stmt->fetch();

                if ($user) {
                    // Store user data in session
                    $_SESSION['UserID']     = $user['ID'];
                    $_SESSION['Role']       = $user['Role'];
                    $_SESSION['Name']       = $user['Name'];
                    $_SESSION['CompanyID']  = $user['CompanyID'];

                    // Fetch company name and acronym
                    $sql2 = "SELECT NAME, KEY_LETTER FROM Aquila_COMPANY WHERE ID = ?";
                    $stmt2 = $pdo->prepare($sql2);
                    $stmt2->execute([$user['CompanyID']]);
                    $company = $stmt2->fetch();

                    if ($company) {
                        $_SESSION['CompanyName']    = $company['NAME'];
                        $_SESSION['AcronymLetter']  = $company['KEY_LETTER'];
                    }

                    // Redirect to your main page (create home.php or change this)
                    header("Location: home.php");
                    exit();
                } else {
                    $error = "INCORRECT USERNAME OR PASSWORD";
                }
            } catch (Exception $e) {
                $error = "Login failed. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BLUESYS - Login</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(rgba(0, 20, 60, 0.85), rgba(0, 40, 120, 0.9)),
                        url('background.jpg') center/cover no-repeat;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }
        .login-box {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 100, 255, 0.4);
            width: 380px;
            text-align: center;
        }
        .logo { width: 220px; margin-bottom: 20px; }
        h2 { margin-bottom: 30px; font-weight: 300; letter-spacing: 1px; }
        input[type="text"], input[type="password"] {
            width: 100%; padding: 12px 15px; margin: 10px 0;
            background: transparent; border: none; border-bottom: 2px solid #fff;
            color: white; font-size: 16px; outline: none;
        }
        input::placeholder { color: rgba(255,255,255,0.7); }
        .password-wrapper { position: relative; }
        .toggle-pass {
            position: absolute; right: 10px; top: 50%;
            transform: translateY(-50%); cursor: pointer; font-size: 20px;
        }
        .btn-login {
            background: #007bff; color: white; padding: 12px 60px;
            border: none; border-radius: 30px; font-size: 16px;
            cursor: pointer; margin-top: 20px; transition: 0.3s;
        }
        .btn-login:hover { background: #0056b3; transform: scale(1.05); }
        .error { color: #ff6b6b; margin-top: 15px; font-weight: bold; }
        .status {
            position: absolute; bottom: 20px; right: 20px;
            background: rgba(0,0,0,0.6); padding: 10px 20px; border-radius: 30px;
            font-weight: bold; font-size: 14px;
        }
        .version { margin-top: 30px; font-size: 12px; opacity: 0.8; }
    </style>
</head>
<body>

<div class="login-box">
    <img src="bluesys-logo.png" alt="BLUESYS" class="logo">
    <h2>LOGIN YOUR ACCOUNT</h2>

    <form method="POST" action="">
        <input type="text" name="username" placeholder="Enter Username"
               value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" required autofocus>

        <div class="password-wrapper">
            <input type="<?= isset($_POST['show_password']) ? 'text' : 'password' ?>"
                   name="password" placeholder="Enter Password" required>
            <span class="toggle-pass" onclick="togglePassword()">👁️</span>
        </div>

        <label style="display:block; margin:15px 0; color:rgba(255,255,255,0.8);">
            <input type="checkbox" name="show_password"
                   <?= isset($_POST['show_password']) ? 'checked' : '' ?>
                   style="transform:scale(1.3); margin-right:8px;">
            Show Password
        </label>

        <button type="submit" class="btn-login">Login</button>

        <?php if ($error): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
    </form>

    <div class="version">
        BLUESYS VERSION: 12082025.544<br>
        OWNED BY BLUESUN PHIL INC.
    </div>
</div>

<div class="status" style="color: <?= $statusColor ?>;">
    <?= $status ?>
</div>

<script>
function togglePassword() {
    const pwd = document.querySelector('input[name="password"]');
    const checkbox = document.querySelector('input[name="show_password"]');
    if (pwd.type === "password") {
        pwd.type = "text";
        checkbox.checked = true;
    } else {
        pwd.type = "password";
        checkbox.checked = false;
    }
}
</script>

</body>
</html>