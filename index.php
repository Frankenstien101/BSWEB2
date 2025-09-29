<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BLUESYS Applications</title>
    <style>
        :root {
            --primary: #0d05a1ff;
            --primary-light: #050891ff;
            --primary-dark: #080066ff;
            --accent: #10b981;
            --text: #f8fafc;
            --text-light: #e2e8f0;
            --text-muted: #94a3b8;
            --bg-dark: #0f172a;
            --card-bg: rgba(15, 23, 42, 0.85);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            color: var(--text);
            min-height: 100vh;
            background-image: url('MainImg/44.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            position: relative;
        }

        body::before {
            content: "";
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(2, 6, 23, 0.85);
            z-index: 0;
        }

        .container {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        header {
            padding: 1.5rem 2rem;
            background-color: rgba(3, 35, 109, 0.8);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-weight: 600;
            font-size: 1.4rem;
            color: var(--text);
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
            transition: color 0.2s ease;
        }

        .nav-links a:hover {
            color: var(--accent);
        }

        main {
            flex: 1;
            padding: 3rem 1rem;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .cards-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 2rem;
            max-width: 1500px;
            margin-top: 2rem;
        }

        .app-card {
            width: 320px;
            background: var(--card-bg);
            border-radius: 12px;
            backdrop-filter: blur(8px);
            padding: 2rem;
            border: 1px solid rgba(13, 5, 161, 0.3);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .app-card::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            border-radius: 14px;
            background: linear-gradient(45deg, 
                var(--primary), 
                var(--primary-light), 
                var(--primary-dark), 
                var(--primary));
            background-size: 400% 400%;
            z-index: -1;
            animation: glowing-border 3s ease infinite;
            opacity: 0.7;
        }

        @keyframes glowing-border {
            0% { background-position: 0% 50%; opacity: 0.7; }
            50% { background-position: 100% 50%; opacity: 0.9; }
            100% { background-position: 0% 50%; opacity: 0.7; }
        }

        .app-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.4);
        }

        .app-logo {
            width: 80px;
            height: 80px;
            object-fit: contain;
            margin-bottom: 1.5rem;
        }

        .app-name {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--text);
        }

        .app-description {
            font-size: 0.95rem;
            line-height: 1.6;
            color: var(--text-light);
            margin-bottom: 1.5rem;
        }

        .app-button {
            padding: 0.7rem 1.5rem;
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.25s ease;
            text-decoration: none;
            margin-top: auto;
        }

        .app-button:hover {
            background-color: var(--primary-dark);
            transform: translateY(-5px);
        }

        footer {
            text-align: center;
            padding: 1.5rem;
            font-size: 0.8rem;
            color: var(--text-muted);
            background-color: rgba(3, 35, 109, 0.5);
            backdrop-filter: blur(12px);
        }

        @media (max-width: 768px) {
            header {
                flex-direction: column;
                gap: 1rem;
                padding: 1rem;
            }
            
            .nav-links {
                gap: 1rem;
            }
            
            .cards-container {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <div class="logo">BLUESYS APPLICATIONS</div>
            <div class="nav-links">
                <a href="\Services\contact.php">Contact</a>
                <a href="\Services\abouts.php">About</a>
                <a href="#">Services</a>
            </div>
        </header>

        <main>
            <h1 style="font-size: 2rem; margin-bottom: 0.5rem;">Our Solutions</h1>
            <p style="color: var(--text-muted); max-width: 600px; text-align: center; margin-bottom: 2rem;">
                Discover our suite of powerful applications designed to streamline your business operations
            </p>

            <div class="cards-container">
                <!-- Card 1 -->
                <div class="app-card">
                    <img src="\Services\img\bscr.png" alt="DMS Logo" class="app-logo">
                    <h2 class="app-name">Distributor Management</h2>
                    <p class="app-description">
                        Comprehensive solution for managing your distribution network, inventory,
                        and sales operations with real-time analytics and reporting capabilities.
                    </p>
                    <a href="\HomePage\verify.php" class="app-button">Visit Site</a>
                </div>

                <!-- Card 2 -->
                <div class="app-card">
                    <img src="\Services\img\dash.png" alt="CRM Logo" class="app-logo">
                    <h2 class="app-name">Delivery Dash</h2>
                    <p class="app-description">
                        Web-based delivery management platform that optimizes delivery routes
                        and tracks deliveries in real time. It ensures faster more efficient operations
                    </p>
                    <a href="\DeliveryDash.php" class="app-button">Visit Site</a>
                </div>

                <!-- Card 3 -->
                <div class="app-card">
                    <img src="\Services\img\credit.ico" alt="ERP Logo" class="app-logo">
                    <h2 class="app-name">Goods Credit</h2>
                    <p class="app-description">
                        Warehouse credit and replacement management system that helps businesses track, approve, and process product credits caused by damages, returns, or discrepancies. Instead of manual paperwork.
                    </p>
                    <a href="#" class="app-button">Visit Site</a>
                </div>

                 <!-- Card 4 -->
                <div class="app-card">
                    <img src="\Services\img\blubooknew.png" alt="ERP Logo" class="app-logo">
                    <h2 class="app-name">Blue Book</h2>
                    <p class="app-description">
                        a smart accounting and bookkeeping solution that helps businesses track income, expenses, invoices, and taxes — all in one secure, easy-to-use platform.
                    </p>
                    <a href="#" class="app-button">Visit Site</a>
                </div>
            </div>
        </main>

        <footer>
            © 2025 BLUESYS 2. All rights reserved.
        </footer>
    </div>
</body>
</html>