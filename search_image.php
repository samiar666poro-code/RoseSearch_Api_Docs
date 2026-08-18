<?php
$apiKey = 'YOUR_API_KEY_IMAGE';
$query = 'طبیعت';
$limit = 10;

function searchImage($apiKey, $query, $limit = 10) {
    $url = "https://RoseSearch.ir/search_image.php?action=search&api_key={$apiKey}&q=" . urlencode($query) . "&limit={$limit}";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36');
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($httpCode == 200) {
        return json_decode($response, true);
    }
    
    return [
        'success' => false,
        'error' => 'خطا در ارتباط با سرور',
        'http_code' => $httpCode
    ];
}

$results = searchImage($apiKey, $query, $limit);

if ($results['success']) {
    echo "\n";
    echo "🖼️ نتایج جستجوی تصاویر برای: " . $results['query'] . "\n";
    echo str_repeat("═", 60) . "\n";
    echo "📊 تعداد تصاویر: " . $results['count'] . "\n";
    echo "💎 اعتبار تصویر: " . ($results['token_info']['remaining_image_credits'] ?? 0) . " | اعتبار وب: " . ($results['token_info']['remaining_web_credits'] ?? 0) . "\n";
    echo str_repeat("═", 60) . "\n\n";
    
    if ($results['count'] > 0) {
        $num = 1;
        foreach ($results['results'] as $img) {
            echo "🖼️ " . $num . ". " . ($img['alt'] ?? 'تصویر') . "\n";
            echo "   📁 منبع: " . $img['source_title'] . "\n";
            echo "   🔗 صفحه: " . $img['source_url'] . "\n";
            echo "   📎 لینک: " . $img['src'] . "\n";
            echo "\n";
            $num++;
        }
    } else {
        echo "❌ تصویری یافت نشد.\n";
    }
    
    echo str_repeat("═", 60) . "\n";
    echo "✅ جستجو با موفقیت انجام شد.\n";
    
} else {
    echo "\n❌ خطا: " . ($results['error'] ?? 'خطای ناشناخته') . "\n";
    if (isset($results['http_code'])) {
        echo "📡 کد وضعیت: " . $results['http_code'] . "\n";
    }
}

echo "\n";
?>
