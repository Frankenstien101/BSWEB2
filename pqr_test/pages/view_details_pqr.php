<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Profile Page</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS for styling -->
    <style>
        body {
            background-color: #F6F6F9; /* Primary color */
            font-family: 'Arial', sans-serif;
        }
        .profile-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            margin-top: 20px;
        }
        .profile-header {
            background: #202241; /* Tertiary color */
            color: white;
            text-align: center;
            padding: 30px 0;
        }
        .profile-header img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 5px solid white;
        }
        .profile-body {
            padding: 30px;
        }
        .profile-body h3 {
            font-size: 24px;
            font-weight: 700;
        }
        .profile-body p {
            font-size: 16px;
            color: #666;
        }
        .profile-footer {
            background: #EEEEEE; /* Secondary color */
            padding: 20px;
            text-align: center;
        }
        .profile-footer .btn-primary {
            background: #202241; /* Tertiary color */
            border-color: #202241; /* Tertiary color */
        }
        .profile-footer .btn-outline-secondary {
            color: #202241; /* Tertiary color */
            border-color: #202241; /* Tertiary color */
        }
        .profile-footer .btn-outline-secondary:hover {
            background: #202241; /* Tertiary color */
            color: white;
        }
        .social-links a {
            margin: 0 10px;
            color: #202241; /* Tertiary color */
            font-size: 24px;
            transition: color 0.3s;
        }
        .social-links a:hover {
            color: #6a11cb; /* Custom hover color */
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="profile-card">
                <div class="profile-header">
                    <img src="https://via.placeholder.com/150" alt="Profile Picture">
                    <h2>John Doe</h2>
                    <p>Web Developer</p>
                </div>
                <div class="profile-body">
                    <h3>About Me</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla et euismod nulla. Curabitur feugiat, tortor non consequat finibus, justo purus auctor massa, nec semper lorem quam in massa.</p>
                    
                    <h3>Contact Information</h3>
                    <ul class="list-unstyled">
                        <li><strong>Email:</strong> john.doe@example.com</li>
                        <li><strong>Phone:</strong> (123) 456-7890</li>
                        <li><strong>Location:</strong> New York, USA</li>
                    </ul>
                </div>
                <div class="profile-footer">
                    <h4>Follow Me</h4>
                    <div class="social-links">
                        <a href="#" class="bi bi-twitter"></a>
                        <a href="#" class="bi bi-linkedin"></a>
                        <a href="#" class="bi bi-github"></a>
                    </div>
                    <a href="#" class="btn btn-primary mt-3">Contact Me</a>
                    <a href="#" class="btn btn-outline-secondary mt-3">Download CV</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</body>
</html>
