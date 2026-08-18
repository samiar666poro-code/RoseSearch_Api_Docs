<?php
// ============================================
// کد نمونه جستجوی وب با PHP
// ============================================

// کلید API وب خود را وارد کنید
$apiKey = 'YOUR_API_KEY_WEB';

// عبارت جستجو
$query = 'قیمت گوشی';

// تعداد نتایج (اختیاری)
$limit = 10;

// ساخت URL
$url = "https://RoseSearch.ir/search_web.php?action=search&api_key={$apiKey}&q=" . urlencode($query) . "&limit={$limit}";

// ارسال درخواست با cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// پردازش پاسخ
if ($httpCode == 200) {
    $data = json_decode($response, true);
    
    if ($data['success']) {
        echo "✅ جستجو با موفقیت انجام شد\n";
        echo "📊 تعداد نتایج: " . $data['count'] . "\n";
        echo "💎 اعتبار باقیمانده: " . $data['token_info']['remaining'] . "\n\n";
        
        foreach ($data['results'] as $index => $result) {
            echo ($index + 1) . ". " . $result['title'] . "\n";
            echo "   🔗 " . $result['url'] . "\n";
            echo "   📝 " . $result['description'] . "\n";
            echo "   🏷️ امتیاز: " . $result['score'] . "\n";
            echo "   📅 تاریخ: " . $result['saved_at'] . "\n\n";
        }
    } else {
        echo "❌ خطا: " . ($data['error'] ?? 'خطای ناشناخته') . "\n";
    }
} else {
    echo "❌ خطا در اتصال به سرور (HTTP Code: {$httpCode})\n";
    echo "📄 پاسخ: " . $response . "\n";
}
?>
