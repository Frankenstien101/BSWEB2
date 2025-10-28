<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login | PQR System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />

  <style>
    :root {
      --navy-blue: #0A1931;
      --navy-blue-light: #13274F;
      --deep-orange: #1605aaff;
      --deep-orange-dark: #08067aff;
      --text: #f8fafc;
      --text-light: #e2e8f0;
      --text-muted: #94a3b8;
      --card-bg: rgba(10, 25, 49, 0.9);
      --error: #ef4444;
    }

    body {
      font-family: 'Inter', sans-serif;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      background: url('/MainImg/pqrbg.jpg') center/cover no-repeat;
      position: relative;
      color: var(--text);
    }

    body::before {
      content: "";
      position: fixed;
      inset: 0;
      background: rgba(10, 25, 49, 0.85);
      z-index: 0;
    }

    /* Navbar */
    .nav {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1rem 2rem;
      background-color: rgba(10, 25, 49, 0.9);
      backdrop-filter: blur(12px);
      position: relative;
      z-index: 2;
      border-bottom: 1px solid rgba(37, 34, 235, 0.2);
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

    /* Login Card */
    .login-container {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
      z-index: 1;
      padding: 2rem;
    }

    .login-card {
      position: relative;
      background: var(--card-bg);
      backdrop-filter: blur(8px);
      padding: 2.5rem;
      border-radius: 12px;
      max-width: 420px;
      width: 100%;
      border: 1px solid rgba(255, 255, 255, 0.1);
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
    }

    .login-card img {
      display: block;
      margin: 0 auto 1rem;
      height: 100px;
    }

    .login-card h2 {
      text-align: center;
      font-size: 1.75rem;
      font-weight: 700;
      background: linear-gradient(45deg, var(--text-light), var(--deep-orange));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      margin-bottom: 1.75rem;
    }

    label {
      font-size: 0.875rem;
      color: var(--text-light);
      margin-bottom: 0.25rem;
    }

    input {
      background: rgba(19, 39, 79, 0.6);
      border: 1px solid rgba(255, 255, 255, 0.1);
      color: var(--text);
      border-radius: 8px;
      padding: 0.875rem;
    }

    input::placeholder {
      color: var(--text-muted);
    }

    input:focus {
      outline: none;
      border-color: var(--deep-orange);
      box-shadow: 0 0 0 2px rgba(255, 95, 0, 0.25);
      background: rgba(19, 39, 79, 0.8);
    }

    .btn-primary {
      background-color: var(--deep-orange);
      border: none;
      padding: 0.875rem;
      border-radius: 8px;
      font-weight: 600;
      transition: all 0.25s ease;
    }

    .btn-primary:hover {
      background-color: var(--deep-orange-dark);
      transform: translateY(-1px);
    }

    .btn-secondary {
      background: rgba(255, 255, 255, 0.1);
      color: var(--text-light);
      border: none;
      border-radius: 8px;
      font-weight: 500;
      transition: 0.3s;
    }

    .btn-secondary:hover {
      background: rgba(255, 255, 255, 0.2);
    }

    .alert {
      margin-top: 1rem;
      font-size: 0.875rem;
      border-radius: 8px;
      background: rgba(239, 68, 68, 0.15);
      color: var(--error);
      border: 1px solid rgba(239, 68, 68, 0.25);
    }

    .footer {
      text-align: center;
      padding: 1.25rem;
      color: var(--text-muted);
      font-size: 0.8rem;
      position: relative;
      z-index: 1;
    }

    @media (max-width: 640px) {
      .nav {
        flex-direction: column;
        gap: 0.75rem;
      }
      .nav-links {
        gap: 1rem;
      }
      .login-card {
        padding: 2rem 1.5rem;
      }
    }
  </style>
</head>

<body>
  <!-- Navbar -->
   <nav class="nav">
      <div class="nav-logo">
        <img src="/MainImg/download-compresskaru.com.png" alt="Logo">
        <span>BLUESYS APPLICATIONS</span>
      </div>
      <div class="nav-links">
        <a href="/Services/contact.php">Contact</a>
        <a href="/Services/abouts.php">About</a>
        <a href="/Services/apps.php">Services</a>
      </div>
    </nav>

  <!-- Login Card -->
  <div class="login-container">
    <div class="login-card">
      <img src="../images/pqr_icon.png" alt="PQR Logo">
      <h2>PQR</h2>
      <form id="form-data" method="POST">
        <div class="mb-3">
          <label for="USERID">User ID</label>
          <input type="text" id="USERID" name="userid" class="form-control" placeholder="Enter User ID" required>
        </div>
        <div class="mb-3">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" class="form-control" placeholder="Enter Password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100" id="btn_submit">
          <span class="spinner-border spinner-border-sm visually-hidden me-2" role="status"></span>Login
        </button>
        <a href="../../" class="btn btn-secondary w-100 mt-2">Back</a>
        <div class="alert text-center visually-hidden mt-3">Login Failed!</div>
      </form>
    </div>
  </div>

  <!-- Footer -->
  <div class="footer">
    © <script>document.write(new Date().getFullYear());</script> PQR System. All rights reserved.
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script>
    $("#form-data").submit(function(e) {
      e.preventDefault();
      $(".spinner-border").removeClass("visually-hidden");
      $("#btn_submit").attr("disabled", true);

      $.ajax({
        url: '../query/login.php',
        type: 'POST',
        data: $(this).serialize(),
        success: function(response) {
          if (response == "1") {
            location.href = "../index.php";
          } else {
            $(".alert").removeClass("visually-hidden");
            setTimeout(() => {
              $(".alert").addClass("visually-hidden");
              $(".spinner-border").addClass("visually-hidden");
              $("#btn_submit").attr("disabled", false);
            }, 3000);
          }
        },
        error: function() {
          alert("Error connecting to server.");
          $(".spinner-border").addClass("visually-hidden");
          $("#btn_submit").attr("disabled", false);
        }
      });
    });
  </script>
</body>
</html>
