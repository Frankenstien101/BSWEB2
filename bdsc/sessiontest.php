<?php
session_start();

if (!isset($_SESSION['test_counter'])) {
    $_SESSION['test_counter'] = 1;
    echo "✅ Session started. Refresh this page to test.";
} else {
    $_SESSION['test_counter']++;
    echo "🔁 Session is working. Refresh count: " . $_SESSION['test_counter'];
}
?>