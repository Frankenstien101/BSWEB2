<?php
session_start();

include 'DB/dbcon.php';

$error = "";

if (isset($_POST['login'])) {
    // ... [keep your existing PHP code unchanged] ...

    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    try {
        // Fetch user with matching username
        $stmt = $conn->prepare("  
                          SELECT Dash_Users.LINEID, [USERNAME]
                    ,[PASSWORD]
                    ,[NAME_OF_USER]
                    ,[COMPANY]
                    ,[STATUS]
                    ,[ROLE]
              	  ,COMPANY_NAME
              	  ,ADDRESS
                FROM [dbo].[Dash_Users]

              LEFT JOIN Dash_Company

              ON Dash_Company.COMPANY_ID = Dash_Users.COMPANY
                 WHERE USERNAME = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if ($user['PASSWORD'] === $password) {
                $_SESSION['USERNAME'] = $username;
                $_SESSION['Name_of_user'] = $user['NAME_OF_USER'];
                $_SESSION['Company_Name'] = $user['COMPANY_NAME'];
                $_SESSION['UserID'] = $user['LINEID'];
                $_SESSION['Company_ID'] = $user['COMPANY']; 
                $_SESSION['Role'] = $user['ROLE']; 

                header("Location: Dash/Home/home.php");
                exit();
            } else {
                $error = "Invalid password.";
            }
        } else {
            $error = "User not found.";
        }
    } catch (PDOException $e) {
        $error = "Database error: " . $e->getMessage();
    }

}
?>

<!doctype html>
<html lang="en">
  <head>
     <link rel="icon" type="image/x-icon" href="\Services\img\dash.png">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login | DELIVERY DASH</title>
    <style>
      :root {
        --navy-blue: #0A1931;
        --navy-blue-light: #13274F;
        --navy-blue-dark: #07121F;
        --deep-orange: #FF5F00;
        --deep-orange-light: #FF7F33;
        --deep-orange-dark: #CC4C00;
        --text: #f8fafc;
        --text-light: #e2e8f0;
        --text-muted: #94a3b8;
        --bg-dark: #0f172a;
        --card-bg: rgba(10, 25, 49, 0.9);
        --error: #ef4444;
      }

      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        color: var(--text);
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        background-image: url('MainImg/DELIVERY.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        position: relative;
      }

      body::before {
        content: "";
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(10, 25, 49, 0.85);
        z-index: 0;
      }

      .container {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
        position: relative;
        z-index: 1;
      }

      .card {
        width: 100%;
        max-width: 420px;
        background: var(--card-bg);
        border-radius: 12px;
        backdrop-filter: blur(8px);
        padding: 2.5rem;
        border: 1px solid rgba(255, 255, 255, 0.08);
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.2);
      }

      .logo {
        text-align: center;
        margin-bottom: 2rem;
      }

      .logo img {
        height: 120px;
        margin-bottom: -1rem;
      }

      .logo h1 {
        font-size: 1.75rem;
        font-weight: 700;
        margin-top: 0.75rem;
        color: var(--text);
        letter-spacing: 0.5px;
        background: linear-gradient(45deg, var(--text-light), var(--deep-orange-light));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
      }

      h2 {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 1.75rem;
        text-align: center;
        color: var(--text);
      }

      .form-group {
        margin-bottom: 1.5rem;
      }

      label {
        display: block;
        font-size: 0.875rem;
        font-weight: 500;
        margin-bottom: 0.5rem;
        color: var(--text-light);
      }

      input {
        width: 100%;
        padding: 0.875rem;
        background: rgba(19, 39, 79, 0.6);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        font-size: 0.9375rem;
        color: var(--text);
        transition: all 0.25s ease;
      }

      input::placeholder {
        color: var(--text-muted);
      }

      input:focus {
        outline: none;
        border-color: var(--deep-orange);
        background: rgba(19, 39, 79, 0.8);
        box-shadow: 0 0 0 2px rgba(255, 95, 0, 0.25);
      }

      button {
        width: 100%;
        padding: 0.875rem;
        background-color: var(--deep-orange);
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 0.9375rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.25s ease;
        margin-top: 0.5rem;
      }

      button:hover {
        background-color: var(--deep-orange-dark);
        transform: translateY(-1px);
      }

      .error {
        color: var(--error);
        background: rgba(239, 68, 68, 0.15);
        font-size: 0.875rem;
        margin: 1.25rem 0;
        padding: 0.875rem;
        border-radius: 8px;
        text-align: center;
        display: none;
      }

      .error.show {
        display: block;
      }

      .footer {
        text-align: center;
        padding: 1.5rem;
        font-size: 0.75rem;
        color: var(--text-muted);
        position: relative;
        z-index: 1;
      }

      .checkbox-container {
        display: flex;
        align-items: center;
        margin: 1.5rem 0;
      }

      .checkbox-container input {
        width: auto;
        margin-right: 0.75rem;
        accent-color: var(--deep-orange);
      }

      .checkbox-container label {
        margin-bottom: 0;
        color: var(--text-light);
        font-size: 0.875rem;
      }

      .nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 2rem;
        background-color: rgba(10, 25, 49, 0.9);
        backdrop-filter: blur(12px);
        position: relative;
        z-index: 1;
        border-bottom: 1px solid rgba(255, 95, 0, 0.2);
      }

      .nav-logo {
        display: flex;
        align-items: center;
      }

      .nav-logo img {
        height: 36px;
        margin-right: 0.75rem;
      }

      .nav-logo span {
        font-weight: 600;
        color: var(--text);
        font-size: 1.05rem;
      }

      .nav-links {
        display: flex;
        gap: 1.5rem;
      }

      .nav-links a {
        text-decoration: none;
        color: var(--text-light);
        font-size: 0.875rem;
        font-weight: 500;
        transition: color 0.2s ease;
        padding: 0.5rem;
        border-radius: 4px;
      }

      .nav-links a:hover {
        color: var(--deep-orange);
        background: rgba(255, 95, 0, 0.1);
      }

      @media (max-width: 640px) {
        .nav {
          padding: 1rem;
          flex-direction: column;
          gap: 0.75rem;
        }
        
        .nav-links {
          gap: 1rem;
        }
        
        .card {
          padding: 2rem 1.5rem;
        }
      }
    </style>
  </head>

  <body>
    <nav class="nav">
      <div class="nav-logo">
        <img src="MainImg/download-compresskaru.com.png" alt="Delivery Dash Logo">
        <span>BLUESYS APPLICATIONS</span>
      </div>
      <div class="nav-links">
        <a href="/Services/contact.php">Contact</a>
        <a href="/Services/abouts.php">About</a>
        <a href="/Services/apps.php">Services</a>
      </div>
    </nav>

    <div class="container">
      <div class="card">
        <div class="logo">
          <img src="Services/img/dash.png" alt="DELIVERY DASH Logo">
          <h1>DELIVERY DASH</h1>
        </div>

        <?php if (!empty($error)): ?>
          <div class="error show"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="post" action="DeliveryDash.php">
          <div class="form-group">
            <label for="username">Username</label>
            <input 
              type="text" 
              id="username" 
              name="username" 
              placeholder="Enter your username" 
              required 
              autofocus
            >
          </div>

          <div class="form-group">
            <label for="password">Password</label>
            <input 
              type="password" 
              id="password" 
              name="password" 
              placeholder="Enter your password" 
              required
            >
          </div>

          <div class="checkbox-container">
            <input type="checkbox" id="remember">
            <label for="remember">Remember this device</label>
          </div>

          <button type="submit" name="login">Sign In</button>
        </form>
      </div>
    </div>

    <div class="footer">
      © <?= date('Y') ?> DELIVERY DASH. All rights reserved.
    </div>
  </body>
</html>