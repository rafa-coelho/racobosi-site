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
    define('REQUEST_PROTOCOL', 'http');

    define('DATABASE_HOST', 'localhost');
    define('DATABASE_NAME', 'leadthis');
    define('DATABASE_USER', 'root');
    define('DATABASE_PASSWORD', '');

    # Configurações de email
    define('MAIL_USERNAME', "teste@luminetec.com.br");
    define('MAIL_PASSWORD', "9n5iq*wylt(h");
    define('MAIL_HOST', 'mail.luminetec.com.br');
    define('MAIL_PORT', 587);
    define('MAIL_FROM', MAIL_USERNAME);
    define('MAIL_ALIAS', 'LeadThis');
    define('SMTP_SERVER_REQUIRE_AUTH', true);

    define("API", "");
    define('HOST', REQUEST_PROTOCOL . '://' . $_SERVER['HTTP_HOST'] . "/");
    define('URI', preg_replace('~/~', '', $_SERVER['REQUEST_URI'], 1));

    define("MEDIA_DIR", HOST . "media/");


    mb_internal_encoding('UTF-8');
