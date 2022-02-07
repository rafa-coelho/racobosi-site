<?php

$http_client_ip       = (isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : "");
$http_x_forwarded_for = (isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : "");
$remote_addr          = (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : "");

/* VERIFICO SE O IP REALMENTE EXISTE NA INTERNET */
if (!empty($http_client_ip)) {
    $ip = $http_client_ip;
    /* VERIFICO SE O ACESSO PARTIU DE UM SERVIDOR PROXY */
} elseif (!empty($http_x_forwarded_for)) {
    $ip = $http_x_forwarded_for;
} else {
    /* CASO EU NÃO ENCONTRE NAS DUAS OUTRAS MANEIRAS, RECUPERO DA FORMA TRADICIONAL */
    $ip = $remote_addr;
}

define("SITE_NAME", "Rafael Coelho");

$HOST = isset($_ENV["HOST"]) ? $_ENV["HOST"] : "racobosi.com.br";

define("PROD", isset($_ENV["ENV"]) && $_ENV["ENV"] == 'prod');
define('REQUEST_PROTOCOL', (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://");
define('HOST',  REQUEST_PROTOCOL . $_SERVER['HTTP_HOST'] . '/');
define('URI', preg_replace('~/~', '', $_SERVER['REQUEST_URI'], 1));

if (PROD && REQUEST_PROTOCOL == "http://") {
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: https://$HOST/" . URI);
}

echo "<pre>";
echo "PROD -> " . PROD;
echo "<br />";
echo "REQUEST_PROTOCOL -> " . REQUEST_PROTOCOL;
echo "<br />";
echo "HOST -> " . HOST;
echo "<br />";
echo "\$HOST -> " . $HOST;
echo "<br />";
echo "URI -> " . URI;
echo "</pre>";



$PREFIX = "st";
define("PREFIX", $PREFIX);

define('TIME_ZONE', 'America/Sao_Paulo');
define('CACHE_VERSION', date('ymd'));

define('PROJECT_DIR', '');
define('DEBUG', true);


# Configurações de Rede
define('USE_HTTP_PROXY', false);
define('HTTP_PROXY_HOST', '');
define('HTTP_PROXY_PORT', '');

define('SESSION_SALT', '');
define('REQUEST_IP', $ip);
define("REQUEST_TOKEN", md5($ip) . sha1(SESSION_SALT));
// define('REQUEST_PROTOCOL', 'https');

// define("API", "");
// define('HOST', REQUEST_PROTOCOL . '://' . $_SERVER['HTTP_HOST'] . "/");
// define('URI', preg_replace('~/~', '', $_SERVER['REQUEST_URI'], 1));

$MAIL = isset($_ENV["MAIL"]) ? $_ENV["MAIL"] : "rafael.coelho@racobosi.com.br";

define("MEDIA_DIR", HOST . "media/");
define("MAIL_ADDRESS",  $MAIL);


mb_internal_encoding('UTF-8');
