<?php
    error_reporting(0);
    mb_internal_encoding('UTF-8');

    if (version_compare(PHP_VERSION, '7.2', '<')) {
        exit('PHP 7.2 or higher is required.');
    }

    $ip_address = $_SERVER['REMOTE_ADDR'];
    $ip_headers = [
        'HTTP_CLIENT_IP', 
        'HTTP_X_FORWARDED_FOR', 
        'HTTP_CF_CONNECTING_IP', 
        'HTTP_FORWARDED_FOR', 
        'HTTP_X_COMING_FROM', 
        'HTTP_COMING_FROM', 
        'HTTP_FORWARDED_FOR_IP', 
        'HTTP_X_REAL_IP'
    ];

    foreach ($ip_headers as $header) {
        if (!empty($_SERVER[$header])) {
            $ip_address = trim($_SERVER[$header]);
            break;
        }
    }

    $request_data = [
        'label'         => '9ec4851e83c42b88662985f2ffd8489a', 
        'user_agent'    => $_SERVER['HTTP_USER_AGENT'], 
        'referer'       => $_SERVER['HTTP_REFERER'] ?? '', 
        'query'         => $_SERVER['QUERY_STRING'] ?? '', 
        'lang'          => $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? '',
        'ip_address'    => $ip_address
    ];

    $offer_page = $white_page = "";

    if (function_exists('curl_version')) {
        $request_data = http_build_query($request_data);
        $ch = curl_init('https://cloakit.house/api/v1/check');
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_CUSTOMREQUEST   => 'POST',
            CURLOPT_SSL_VERIFYPEER  => false,
            CURLOPT_TIMEOUT         => 15,
            CURLOPT_POSTFIELDS      => $request_data
        ]);

        $result = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);

        if (!empty($info) && $info['http_code'] == 200) {
            $body = json_decode($result, true);
            
            if (!empty($body['filter_type']) && $body['filter_type'] == 'subscription_expired') {
                die('<h2>Your Subscription Expired.</h2>');
            }

            $offer_page = $body['url_offer_page'] ?? "";
            $white_page = $body['url_white_page'] ?? "";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>
<body>
    <h1>Welcome to My Website</h1>
    <p>Your IP: <?= htmlspecialchars($ip_address) ?></p>

    <?php if (!empty($offer_page)): ?>
        <h2>Offer Page</h2>
        <iframe src="<?= htmlspecialchars($offer_page) ?>" width="100%" height="600px"></iframe>
    <?php elseif (!empty($white_page)): ?>
        <h2>White Page</h2>
        <iframe src="<?= htmlspecialchars($white_page) ?>" width="100%" height="600px"></iframe>
    <?php else: ?>
        <p>No offer available. Try again later.</p>
    <?php endif; ?>
</body>
</html>
