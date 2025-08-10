<?php
session_start();

include 'DB/dbcon.php';

$error = "";

if (isset($_POST['login'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    try {
        // Fetch user with matching username
        $stmt = $conn->prepare("  SELECT 
                                 u.[UserID],
                                 u.[Username],
                                 u.[Password],
                                 u.[Role],
                                 u.[Name_of_user],
                                 u.[Company],
                                 u.[Site],
                                 u.[Status],

                                 c.[ID] AS Company_ID,
                                 c.[CODE],
                                 c.[NAME] AS Company_Name,
                                 c.[ADDRESS],
                                 c.[STATUS] AS Company_Status,
                                 c.[KEY_LETTER],
                                 c.[REPORT_HEADER],
                                 c.[REPORT_SUB_HEADER],
                                 c.[REPORT_SUB_HEADER2]
                              FROM 
                                 [dbo].[Aquila_Users] u
                              INNER JOIN 
                                 [dbo].[Aquila_COMPANY] c
                                 ON u.Company = c.ID WHERE Username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Compare password (plaintext match; use password_verify if you hash)
            if ($user['Password'] === $password) {
                $_SESSION['username'] = $username;
                $_SESSION['Name_of_user'] = $user['Name_of_user']; // assuming $user is your user data array
                $_SESSION['Company_Name'] = $user['Company_Name']; // assuming $user is your user data array
                $_SESSION['UserID'] = $user['UserID']; // assuming $user is your user data array
                $_SESSION['Company_ID'] = $user['Company_ID']; 
                $_SESSION['Role'] = $user['Role']; 

      

                header("Location: HomePage/home.php");
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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>

    <!-- Bootstrap & AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

    <style>
      html, body {
        height: 100%;
        margin: 0;
      }

      body {
        background-image: url('MainImg/vertudo_system-hintergrund_2880x1952-1024x694.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        
      }

      .container {
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
      }

      .card {
        padding: 30px;
        width: 100%;
        max-width: 400px;
        border-radius: 10px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        background-color: rgba(237, 236, 241, 0.9);
        backdrop-filter: blur(2px);

      }

      .nav-container-blur {
        background-color: rgba(255, 255, 255, 0.6);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(100px);
        border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        z-index: 10;
      }
    </style>
  </head>

  <body>

<!-- 🔷 Navigation Bar -->
<div class="nav-container-blur fixed-top px-4 py-2 bg-navy" >
  <div class="d-flex justify-content-between align-items-center">
    <div class="d-flex align-items-center">
      <img src="MainImg/download-compresskaru.com.png" alt="Logo" width="60" height="60" class="mr-2">
      <span class="h5 mb-0 font-weight-bold">BLUESYS DMS APPLICATION</span>
    </div>
    <ul class="nav justify-content-center mb-0">
      <li class="nav-item"><a class="nav-link active text-light" href="#">Contact Us</a></li>
      <li class="nav-item"><a class="nav-link text-light" href="#">About</a></li>
      <li class="nav-item"><a class="nav-link text-light" href="#">Login / Register</a></li>
      <li class="nav-item"><a class="nav-link text-light" href="#">Services</a></li>
    </ul>
  </div>
</div>

<!-- 🔷 Login Card -->
<div class="container">
  <div class="card">
    <div class="card-body">
      <h4 class="text-center mb-4">Login</h4>

      <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
      <?php endif; ?>

      <form method="post" action="index.php">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" class="form-control" id="username" name="username" required>
          <small class="form-text text-muted">We'll never share your access with anyone else.</small>
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div class="form-group form-check">
          <input type="checkbox" class="form-check-input" id="remember">
          <label class="form-check-label" for="remember">Remember me</label>
        </div>

        <button type="submit" class="btn btn-primary btn-block" name="login">Login</button>
      </form>
    </div>
  </div>
</div>
<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

  </body>
</html>
