<?php
header('Content-Type: text/html; charset=UTF-8');

// 调试模式开关
define( 'DEBUG_MODE', false );

if ( !function_exists('curl_init') ) {
    echo '您的服务器不支持 PHP 的 Curl 模块，请安装或与服务器管理员联系。';
    exit;
}
//测试用 y易肖鸿那个app
define( "WB_AKEY" , '3576524037' );
define( "WB_SKEY" , '9df2acc4666b8bef0e2d36ece2760540' );
define( "WB_CALLBACK_URL" , 'http://127.0.0.1/news/index.php/open/get_info/' );

if ( DEBUG_MODE ) {
    error_reporting(E_ALL);
    ini_set('display_errors', true);
}
