<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login | KCC - Asset Visibility System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />



  <style>
    :root {
      --kcc-blue: #0A2C5E;
      --kcc-blue-light: #1A3C7E;
      --kcc-blue-dark: #081F4A;
      --accent-blue: #2D8CFF;
      --accent-teal: #00C9B7;
      --text: #FFFFFF;
      --text-light: #E6F0FF;
      --text-muted: #94A3B8;
      --card-bg: rgba(10, 44, 94, 0.85);
      --error: #FF6B6B;
      --success: #00C9B7;
    }

    body {
      font-family: 'Inter', sans-serif;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      background: #FFFFFF;
      position: relative;
      color: var(--text);
      overflow-x: hidden;
    }

    body::before {
      content: "";
      position: fixed;
      inset: 0;
      background: radial-gradient(circle at 20% 50%, rgba(45, 140, 255, 0.15) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(0, 201, 183, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 40% 80%, rgba(10, 44, 94, 0.2) 0%, transparent 50%);
      z-index: 0;
    }

    /* Navbar */
    .nav {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1rem 3rem;
      background: linear-gradient(90deg, var(--kcc-blue-dark) 0%, var(--kcc-blue) 100%);
      backdrop-filter: blur(12px);
      position: relative;
      z-index: 2;
      border-bottom: 1px solid rgba(45, 140, 255, 0.2);
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    }

    .nav-logo {
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }

    .nav-logo img {
      height: 40px;
      filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
    }

    .nav-logo .logo-text {
      display: flex;
      flex-direction: column;
    }

    .nav-logo .logo-text .main {
      font-weight: 700;
      color: var(--text);
      font-size: 1.2rem;
      letter-spacing: 0.5px;
    }

    .nav-logo .logo-text .sub {
      font-weight: 400;
      color: var(--accent-teal);
      font-size: 0.75rem;
      letter-spacing: 1px;
    }

    .nav-links {
      display: flex;
      gap: 1.5rem;
    }

    .nav-links a {
      text-decoration: none;
      color: var(--text-light);
      font-size: 0.9rem;
      font-weight: 500;
      transition: all 0.3s ease;
      padding: 0.5rem 1rem;
      border-radius: 6px;
      position: relative;
    }

    .nav-links a::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      width: 0;
      height: 2px;
      background: var(--accent-teal);
      transition: all 0.3s ease;
      transform: translateX(-50%);
    }

    .nav-links a:hover {
      color: var(--accent-teal);
      background: rgba(45, 140, 255, 0.1);
    }

    .nav-links a:hover::after {
      width: 80%;
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
      animation: fadeIn 0.8s ease-out;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .login-card {
      position: relative;
      background: #0B2D5F;
      backdrop-filter: blur(20px);
      padding: 3rem;
      border-radius: 16px;
      max-width: 440px;
      width: 100%;
      border: 1px solid rgba(45, 140, 255, 0.2);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
      overflow: hidden;
    }

    .login-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: linear-gradient(90deg, var(--accent-teal) 0%, var(--accent-blue) 100%);
    }

    .login-card img {
      display: block;
      margin: 0 auto 1.5rem;
      height: 80px;
      filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.3));
    }

    .login-header {
      text-align: center;
      margin-bottom: 2rem;
    }

    .login-header h2 {
      font-size: 2rem;
      font-weight: 700;
      background: linear-gradient(45deg, var(--accent-teal), var(--accent-blue));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      margin-bottom: 0.5rem;
      letter-spacing: -0.5px;
    }

    .login-header .system-name {
      font-size: 1.25rem;
      font-weight: 600;
      color: var(--text-light);
      margin-bottom: 0.25rem;
    }

    .login-header .system-subtitle {
      font-size: 0.875rem;
      color: var(--text-muted);
      font-weight: 400;
    }

    label {
      font-size: 0.9rem;
      color: var(--text-light);
      margin-bottom: 0.5rem;
      font-weight: 500;
      display: block;
    }

    .input-group {
      position: relative;
      margin-bottom: 1.5rem;
    }

    .input-group i {
      position: absolute;
      left: 1rem;
      top: 50%;
      transform: translateY(-50%);
      color: var(--accent-blue);
      font-size: 1rem;
    }

    input {
      background: rgba(26, 60, 126, 0.6);
      border: 1px solid rgba(45, 140, 255, 0.3);
      color: var(--text);
      border-radius: 10px;
      padding: 0.875rem 1rem 0.875rem 3rem;
      width: 100%;
      transition: all 0.3s ease;
      font-size: 0.95rem;
    }

    input::placeholder {
      color: var(--text-muted);
      font-size: 0.9rem;
    }

    input:focus {
      outline: none;
      border-color: var(--accent-teal);
      box-shadow: 0 0 0 3px rgba(0, 201, 183, 0.25);
      background: rgba(26, 60, 126, 0.8);
      transform: translateY(-1px);
    }

    .btn-primary {
      background: linear-gradient(90deg, var(--accent-teal) 0%, var(--accent-blue) 100%);
      border: none;
      padding: 1rem;
      border-radius: 10px;
      font-weight: 600;
      transition: all 0.3s ease;
      font-size: 1rem;
      letter-spacing: 0.5px;
      text-transform: uppercase;
      box-shadow: 0 4px 15px rgba(0, 201, 183, 0.3);
    }

    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(0, 201, 183, 0.4);
      background: linear-gradient(90deg, var(--accent-blue) 0%, var(--accent-teal) 100%);
    }

    .btn-primary:active {
      transform: translateY(0);
    }

    .btn-secondary {
      background: rgba(255, 255, 255, 0.1);
      color: var(--text-light);
      border: 1px solid rgba(45, 140, 255, 0.3);
      border-radius: 10px;
      font-weight: 500;
      transition: all 0.3s ease;
      padding: 0.875rem;
    }

    .btn-secondary:hover {
      background: rgba(255, 255, 255, 0.15);
      border-color: var(--accent-teal);
      transform: translateY(-1px);
    }

    .alert {
      margin-top: 1rem;
      font-size: 0.875rem;
      border-radius: 10px;
      background: rgba(255, 107, 107, 0.15);
      color: var(--error);
      border: 1px solid rgba(255, 107, 107, 0.25);
      padding: 0.875rem 1rem;
      text-align: center;
      animation: shake 0.5s ease-in-out;
    }

    @keyframes shake {

      0%,
      100% {
        transform: translateX(0);
      }

      25% {
        transform: translateX(-5px);
      }

      75% {
        transform: translateX(5px);
      }
    }

    .footer {
      text-align: center;
      padding: 1.5rem;
      color: var(--text-muted);
      font-size: 0.85rem;
      position: relative;
      z-index: 1;
      background: rgba(10, 44, 94, 0.9);
      border-top: 1px solid rgba(45, 140, 255, 0.2);
    }

    .footer a {
      color: var(--accent-teal);
      text-decoration: none;
      transition: color 0.3s ease;
    }

    .footer a:hover {
      color: var(--accent-blue);
    }

    @media (max-width: 768px) {
      .nav {
        padding: 1rem;
        flex-direction: column;
        gap: 1rem;
      }

      .nav-logo {
        width: 100%;
        justify-content: center;
      }

      .nav-links {
        width: 100%;
        justify-content: center;
        flex-wrap: wrap;
        gap: 0.5rem;
      }

      .login-card {
        padding: 2rem 1.5rem;
        margin: 1rem;
      }

      .login-header h2 {
        font-size: 1.75rem;
      }

      .login-header .system-name {
        font-size: 1.1rem;
      }
    }
  </style>
</head>

<body>
  <!-- Navbar -->
  <nav class="nav">
    <div class="nav-logo">
      <img src="/MainImg/download-compresskaru.com.png" alt="KCC Logo">
      <div class="logo-text">
        <span class="main">KCC - ASSET VISIBILITY SYSTEM</span>
        <span class="sub">ASSET MANAGEMENT PLATFORM</span>
      </div>
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
      <img src="../images/pqr_icon.png" alt="KCC AVS Logo">
      <div class="login-header">
        <h2>KCC AVS</h2>
        <div class="system-name">Asset Visibility System</div>
        <div class="system-subtitle">Secure Access Portal</div>
      </div>
      <form id="form-data" method="POST">
        <div class="mb-4">
          <label for="USERID">User ID</label>
          <div class="input-group">
            <i>👤</i>
            <input type="text" id="LOGIN_USERNAME" name="login_username" class="form-control" placeholder="Enter your Username" required>
          </div>
        </div>
        <div class="mb-4">
          <label for="password">Password</label>
          <div class="input-group">
            <i>🔒</i>
            <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
          </div>
        </div>
        <button type="submit" class="btn btn-primary w-100 mb-3" id="btn_submit">
          <span class="spinner-border spinner-border-sm visually-hidden me-2" role="status"></span>
          <span class="btn-text">Sign In</span>
        </button>
        <a href="../../" class="btn btn-secondary w-100">Back to Home</a>
        <div class="alert text-center visually-hidden mt-3" id="error-message">
          <strong>Login Failed!</strong> Please check your credentials and try again.
        </div>
      </form>
    </div>
  </div>

  <!-- Footer -->
  <div class="footer">
    © <script>
      document.write(new Date().getFullYear());
    </script> <strong>KCC - Asset Visibility System</strong>. All rights reserved. |
    <a href="#" class="ms-1">Privacy Policy</a> •
    <a href="#" class="ms-1">Terms of Service</a>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      $("#form-data").submit(function(e) {
        e.preventDefault();

        const $submitBtn = $("#btn_submit");
        const $spinner = $submitBtn.find(".spinner-border");
        const $btnText = $submitBtn.find(".btn-text");
        const $errorMsg = $("#error-message");

        // Show loading state
        $spinner.removeClass("visually-hidden");
        $btnText.text("Authenticating...");
        $submitBtn.prop("disabled", true);
        $errorMsg.addClass("visually-hidden").html("");

        $.ajax({
          url: "../query/login.php",
          method: "POST",
          data: $(this).serialize(),
          success: function(response) {

            response = response.trim(); // important

            if (response === "2") {
              // Inactive account
              $errorMsg
                .html("<strong>Account Inactive!</strong> Please contact support.")
                .removeClass("visually-hidden");

              resetButton();
              return;
            }

            if (response === "1") {
              // Success
              $submitBtn
                .removeClass("btn-primary")
                .addClass("btn-success");

              $btnText.text("Success! Redirecting...");
              $spinner
                .removeClass("spinner-border")
                .addClass("spinner-border-sm");

              setTimeout(() => {
                window.location.href = "../index.php";
              }, 500);

              return;
            }

            // Invalid credentials / other error
            $errorMsg
              .html("<strong>Invalid login credentials.</strong>")
              .removeClass("visually-hidden");

            resetButton();
          },
          error: function(ex) {
            alert("An error occurred: " + ex.responseText);
            $errorMsg
              .html("<strong>Connection Error!</strong> Please check your network connection.")
              .removeClass("visually-hidden");

            resetButton();
          }
        });

        function resetButton() {
          setTimeout(() => {
            $spinner.addClass("visually-hidden");
            $btnText.text("Sign In");
            $submitBtn.prop("disabled", false);
          }, 1500);
        }
      });

      // Input focus effects
      $("input")
        .on("focus", function() {
          $(this).parent().find("i").css("color", "var(--accent-teal)");
        })
        .on("blur", function() {
          $(this).parent().find("i").css("color", "var(--accent-blue)");
        });
    });
  </script>

</body>

</html>