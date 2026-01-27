<?php
ob_start("ob_gzhandler");

header("Content-Type: application/json");

$API_KEY = "TMS_MOBILE_2026_SYNC_KEY";

$headers = getallheaders();
$clientKey = $headers['X-API-KEY'] ?? '';

if ($clientKey !== $API_KEY) {
    http_response_code(401);
    echo json_encode(["error" => "Unauthorized"]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

if (!is_array($data)) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid JSON"]);
    exit;
}

echo json_encode([
    "status" => "ok",
    "rows" => count($data)
]);
