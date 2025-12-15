<?php
     
    session_start();
    include '../../DB/dbcon.php';

    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Signup with Phone OTP Verification</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --success: #10b981;
            --error: #ef4444;
            --warning: #f59e0b;
            --bg: #f8fafc;
            --card-bg: #ffffff;
            --text: #1e293b;
            --text-light: #64748b;
            --border: #e2e8f0;
        }

        body {
            font-family: 'Inter', Arial, sans-serif;
            background: var(--bg);
            color: var(--text);
            margin: 0;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            max-width: 500px;
            width: 100%;
        }

        .card {
            background: var(--card-bg);
            border-radius: 16px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary), #3b82f6);
            color: white;
            padding: 40px 32px;
            text-align: center;
        }

        .card-header h2 {
            margin: 0;
            font-size: 30px;
            font-weight: 700;
        }

        .card-header p {
            margin: 10px 0 0;
            opacity: 0.95;
            font-size: 16px;
        }

        .card-body {
            padding: 40px 32px;
        }

        .form-group {
            margin-bottom: 24px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--text);
        }

        input {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid var(--border);
            border-radius: 10px;
            font-size: 16px;
            transition: all 0.2s;
            box-sizing: border-box;
        }

        input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.15);
        }

        small {
            color: var(--text-light);
            font-size: 14px;
            margin-top: 6px;
            display: block;
        }

        button {
            width: 100%;
            margin-top: 32px;
            padding: 16px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 17px;
            font-weight: 600;
            transition: background 0.3s;
        }

        button:hover {
            background: var(--primary-hover);
        }

        button:disabled {
            background: #94a3b8;
            cursor: not-allowed;
        }

        .message {
            padding: 14px 18px;
            border-radius: 10px;
            margin-bottom: 24px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .error { background: #fee2e2; color: var(--error); border: 1px solid #fecaca; }
        .success { background: #d1fae5; color: var(--success); border: 1px solid #a7f3d0; }
        .warning { background: #fffbeb; color: var(--warning); border: 1px solid #fde68a; }

        #storeIdMessage, #storeInfo {
            margin-top: 12px;
        }

        .store-info {
            background: #ecfdf5;
            padding: 14px 18px;
            border-radius: 10px;
            border-left: 5px solid var(--success);
            font-size: 14px;
            color: var(--text-light);
        }

        #otpSection {
            margin-top: 40px;
            padding: 32px;
            background: #f1f5f9;
            border-radius: 12px;
            border: 1px solid var(--border);
            text-align: center;
        }

        #otpSection h3 {
            margin-top: 0;
            color: var(--primary);
            font-size: 22px;
        }

        #otpSection input {
            font-size: 32px;
            letter-spacing: 16px;
            text-align: center;
            max-width: 300px;
            margin: 20px auto;
            display: block;
        }

        @media (max-width: 480px) {
            .card-header, .card-body {
                padding: 32px 24px;
            }
            #otpSection input {
                font-size: 28px;
                letter-spacing: 10px;
            }
        }
    </style>
    <script>
        function validateStoreId() {
            const storeId = document.querySelector('input[name="store_id"]').value.trim();
            const submitBtn = document.querySelector('button[name="send_otp"]');
            const messageDiv = document.getElementById('storeIdMessage');
            const storeInfoDiv = document.getElementById('storeInfo');
            
            if (storeId.length === 0) {
                messageDiv.innerHTML = '';
                storeInfoDiv.innerHTML = '';
                submitBtn.disabled = false;
                return;
            }
            
            fetch('check_store_id.php?store_id=' + encodeURIComponent(storeId))
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'not_found') {
                        messageDiv.innerHTML = '<div class="message error"><i class="fas fa-times-circle"></i> Store ID not found in customer master. Please enter a valid Store ID.</div>';
                        storeInfoDiv.innerHTML = '';
                        submitBtn.disabled = true;
                    } else if (data.status === 'registered') {
                        messageDiv.innerHTML = '<div class="message error"><i class="fas fa-times-circle"></i> Store ID already registered. Please use a different Store ID.</div>';
                        storeInfoDiv.innerHTML = '';
                        submitBtn.disabled = true;
                    } else if (data.status === 'available') {
                        messageDiv.innerHTML = '<div class="message success"><i class="fas fa-check-circle"></i> Store ID is valid and available for registration.</div>';
                        storeInfoDiv.innerHTML = '<div class="store-info">' + data.message + '</div>';
                        submitBtn.disabled = false;
                    } else {
                        messageDiv.innerHTML = '<div class="message warning"><i class="fas fa-exclamation-triangle"></i> Could not validate Store ID. Please try again.</div>';
                        storeInfoDiv.innerHTML = '';
                        submitBtn.disabled = false;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    messageDiv.innerHTML = '<div class="message warning"><i class="fas fa-exclamation-triangle"></i> Could not validate Store ID. Please try again.</div>';
                    storeInfoDiv.innerHTML = '';
                    submitBtn.disabled = false;
                });
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Customer Signup</h2>
                <p>Secure registration with phone OTP verification</p>
            </div>
            <div class="card-body">
                <?php
     
                include '../../DB/dbcon.php';

                // API Credentials
                define('API_KEY', 'VVz45FRpmvp6Vnwa');
                define('SECRET_KEY', 'cbZEWk6vzHikoINySA2eN4HRfyR3rml5');
                define('SENDER_ADDRESS', 'BSPI');
                define('SMS_API_URL', 'https://api.m360.com.ph/v3/api/globelabs/mt/J4rbHnqS4X');

                // Initialize variables - prevents undefined warnings
                $message = '';
                $showOtpSection = false;

                // Helper: consistent message display
                function displayMessage($type, $text) {
                    $icons = [
                        'error'   => '<i class="fas fa-times-circle"></i>',
                        'success' => '<i class="fas fa-check-circle"></i>',
                        'warning' => '<i class="fas fa-exclamation-triangle"></i>'
                    ];
                    $icon = $icons[$type] ?? '';
                    return '<div class="message ' . $type . '">' . $icon . ' ' . $text . '</div>';
                }

                // Function to send OTP
                function sendOtp($phone, $otp) {
                    $otp_message = "Your BSPI signup OTP is: $otp. Valid for 5 minutes. Do not share this code.";
                    $message_text = str_replace(["\r\n", "\n", "\r"], "\n", $otp_message);

                    $payload = json_encode([
                        "outboundSMSMessageRequest" => [
                            "address" => "tel:" . $phone,
                            "senderAddress" => SENDER_ADDRESS,
                            "outboundSMSTextMessage" => ["message" => $message_text]
                        ]
                    ]);

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, SMS_API_URL);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, [
                        'Content-Type: application/json',
                        'Accept: application/json',
                        'Authorization: Bearer ' . API_KEY . ':' . SECRET_KEY
                    ]);
                    curl_setopt($ch, CURLOPT_CAINFO, __DIR__ . '/cacert.pem');
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
                    curl_setopt($ch, CURLOPT_TIMEOUT, 30);

                    $api_response = curl_exec($ch);
                    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                    $curl_error = curl_error($ch);
                    curl_close($ch);

                    if ($curl_error) {
                        return ['success' => false, 'message' => 'Connection Error: ' . htmlspecialchars($curl_error)];
                    }
                    return ['success' => ($http_code >= 200 && $http_code < 300), 'message' => 'OTP sent'];
                }

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if (isset($_POST['send_otp'])) {
                        $store_id   = trim($_POST['store_id'] ?? '');
                        $store_name = trim($_POST['store_name'] ?? '');
                        $address    = trim($_POST['address'] ?? '');
                        $phone      = trim($_POST['phone'] ?? '');
                        $password   = $_POST['password'] ?? '';

                        if (empty($store_id) || empty($store_name) || empty($address) || empty($phone) || empty($password)) {
                            $message = displayMessage('error', 'All fields are required.');
                        } elseif (!preg_match('/^\+63\d{10}$/', $phone)) {
                            $message = displayMessage('error', 'Invalid phone number. Please use format: +639123456789');
                        } else {
                            $stmt = $conn->prepare("SELECT [CODE], [NAME], [COMPANY_ID], [BRANCH] FROM [dbo].[Dash_Customer_Master] WHERE [CODE] = :store_id");
                            $stmt->execute([':store_id' => $store_id]);
                            $customerMasterData = $stmt->fetch(PDO::FETCH_ASSOC);

                            if (!$customerMasterData) {
                                $message = displayMessage('error', 'Store ID not found in customer master database. Please enter a valid Store ID.');
                            } else {
                                $stmt = $conn->prepare("SELECT [USERNAME] FROM [dbo].[OK_Users] WHERE [USERNAME] = :store_id");
                                $stmt->execute([':store_id' => $store_id]);
                                $existingStore = $stmt->fetch(PDO::FETCH_ASSOC);

                                $stmt = $conn->prepare("SELECT [PHONE_NUMBER] FROM [dbo].[OK_Users] WHERE [PHONE_NUMBER] = :phone");
                                $stmt->execute([':phone' => $phone]);
                                $existingPhone = $stmt->fetch(PDO::FETCH_ASSOC);

                                if ($existingStore) {
                                    $message = displayMessage('error', 'Store ID already registered. Please use a different Store ID.');
                                } elseif ($existingPhone) {
                                    $message = displayMessage('error', 'Phone number already registered. Please use a different phone number.');
                                } else {
                                    $otp = rand(100000, 999999);
                                    $result = sendOtp($phone, $otp);

                                    if ($result['success']) {
                                        $_SESSION['signup_data'] = [
                                            'store_id'               => $store_id,
                                            'store_name'             => $store_name,
                                            'customer_master_name'   => $customerMasterData['NAME'],
                                            'company'                => $customerMasterData['COMPANY_ID'],
                                            'branch'                 => $customerMasterData['BRANCH'],
                                            'address'                => $address,
                                            'phone'                  => $phone,
                                            'password'               => $password,
                                            'otp'                    => $otp,
                                            'otp_time'               => time()
                                        ];
                                        $message = displayMessage('success', 'OTP sent successfully to ' . htmlspecialchars($phone) . '!');
                                        $showOtpSection = true;
                                    } else {
                                        $message = displayMessage('error', 'Failed to send OTP: ' . $result['message']);
                                    }
                                }
                            }
                        }
                    }

                    if (isset($_POST['verify_otp'])) {
                        if (!isset($_SESSION['signup_data'])) {
                            $message = displayMessage('error', 'Session expired. Please start again.');
                        } else {
                            $entered_otp = trim($_POST['otp'] ?? '');
                            $data = $_SESSION['signup_data'];

                            if (time() - $data['otp_time'] > 300) {
                                $message = displayMessage('error', 'OTP has expired. Please request a new one.');
                                unset($_SESSION['signup_data']);
                            } elseif ($entered_otp !== (string)$data['otp']) {
                                $message = displayMessage('error', 'Invalid OTP. Please try again.');
                                $showOtpSection = true;
                            } else {
                                // Final validation before insert
                                $stmt = $conn->prepare("SELECT [CODE], [COMPANY_ID], [BRANCH] FROM [dbo].[Dash_Customer_Master] WHERE [CODE] = :store_id");
                                $stmt->execute([':store_id' => $data['store_id']]);
                                $customerMasterData = $stmt->fetch(PDO::FETCH_ASSOC);

                                if (!$customerMasterData) {
                                    $message = displayMessage('error', 'Store ID no longer valid. Registration cancelled.');
                                    unset($_SESSION['signup_data']);
                                } else {
                                    $stmt = $conn->prepare("SELECT 1 FROM [dbo].[OK_Users] WHERE [USERNAME] = :store_id OR [PHONE_NUMBER] = :phone");
                                    $stmt->execute([':store_id' => $data['store_id'], ':phone' => $data['phone']]);
                                    if ($stmt->fetch()) {
                                        $message = displayMessage('error', 'Store ID or Phone number taken by another user. Please start over.');
                                        unset($_SESSION['signup_data']);
                                    } else {
                                        $sql = "INSERT INTO [dbo].[OK_Users] 
                                                ([COMPANY], [PRINCIPAL], [SITE_ID], [USERNAME], [PASSWORD], [NAME], [ADDRESS], [ROLE], [STATUS], [PHONE_NUMBER], [OTP_SENT]) 
                                                VALUES 
                                                ('BSPI', :principal, :site_id, :username, :password, :name, :address, 'CUSTOMER', 'ACTIVE', :phone_number, :otp_sent)";

                                        $stmt = $conn->prepare($sql);
                                        $result = $stmt->execute([
                                            ':principal'    => $_SESSION['company'] ?? '',
                                            ':site_id'      => $_SESSION['branch'] ?? '',
                                            ':username'     => $data['store_id'],
                                            ':password'     => $data['password'],
                                            ':name'         => $data['store_name'],
                                            ':address'      => $data['address'],
                                            ':phone_number' => $data['phone'],
                                            ':otp_sent'     => $data['otp']
                                        ]);

                                        if ($result) {
                                               
                                            $lineid = $conn->lastInsertId();

                                                // Only this message with "LOGIN" as clickable link
                                                $loginText = 'Signup successful! You can now <a href="login.php" style="color: #1d4ed8; font-weight: 700; text-decoration: underline;">LOGIN</a> with your Store ID.';

                                                $message = displayMessage('success', $loginText);

                                                $showOtpSection = false;

                                            // Clean up session after everything
                                            unset($_SESSION['signup_data']);
                                        } else {    
                                            $message = displayMessage('error', 'Registration failed. Please try again.');
                                            $showOtpSection = true;
                                        }
                                    }
                                }

                                // Clean up session only AFTER everything is done and message is set
                                unset($_SESSION['signup_data']);
                            }
                        }
                    }
                }

                echo $message;
                ?>

                <form method="POST" id="signupForm">
                    <div class="form-group">
                        <label for="store_id">Store ID *</label>
                        <input type="text" id="store_id" name="store_id" 
                               value="<?php echo isset($_POST['store_id']) ? htmlspecialchars($_POST['store_id']) : ''; ?>" 
                               required oninput="validateStoreId()">
                        <small>Must exist in customer master system</small>
                        <div id="storeIdMessage"></div>
                        <div id="storeInfo"></div>
                    </div>

                    <div class="form-group">
                        <label for="store_name">Store Name *</label>
                        <input type="text" id="store_name" name="store_name" 
                               value="<?php echo isset($_POST['store_name']) ? htmlspecialchars($_POST['store_name']) : ''; ?>" 
                               required>
                    </div>

                    <div class="form-group">
                        <label for="address">Address *</label>
                        <input type="text" id="address" name="address" 
                               value="<?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address']) : ''; ?>" 
                               required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number *</label>
                        <input type="tel" id="phone" name="phone" placeholder="+639123456789" 
                               value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>" 
                               required>
                        <small>Format: +639xxxxxxxxxx</small>
                    </div>

                    <div class="form-group">
                        <label for="password">Password *</label>
                        <input type="password" id="password" name="password" required>
                    </div>

                    <button type="submit" name="send_otp" id="submitBtn">
                        <i class="fas fa-paper-plane"></i> Send OTP
                    </button>
                </form>

                <?php if ($showOtpSection && isset($_SESSION['signup_data'])): ?>
                    <div id="otpSection">
                        <h3><i class="fas fa-shield-alt"></i> Verify OTP</h3>
                        <p>A 6-digit code has been sent to<br><strong><?php echo htmlspecialchars($_SESSION['signup_data']['phone']); ?></strong></p>
                        <form method="POST">
                            <div class="form-group">
                                <label for="otp">Enter 6-digit OTP</label>
                                <input type="text" id="otp" name="otp" maxlength="6" pattern="\d{6}" placeholder="••••••" required inputmode="numeric">
                            </div>
                            <button type="submit" name="verify_otp">
                                <i class="fas fa-check-circle"></i> Complete Signup
                            </button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>