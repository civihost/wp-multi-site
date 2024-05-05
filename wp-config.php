<?php

if (php_sapi_name() == "cli") {

    $directory = getcwd();
    while (dirname($directory) != '/') {
        if (file_exists($directory . '/wp-config.php')) {
            break;
        }

        $directory = dirname(dirname($directory . '/../'));
    }
    $environment = basename($directory);
    $folder = "sites/{$environment}/wp-content";
    $directory .= '/wp-content';

} else {

    $environment = isset($_SERVER['HTTP_HOST'])
        ? $_SERVER['HTTP_HOST']
        : (isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : 'localhost');
    $environment = mb_strpos($environment, ':', true) !== false ? mb_substr($environment, 0, mb_strpos($environment, ':', true)) : $environment;
    $folder = "sites/{$environment}/wp-content";
    $directory = __DIR__ . '/' . $folder;

}

$protocol = (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') ? 'https' : 'http';
$_SERVER['wp_content_url'] = "$protocol://{$environment}/$folder";
$_SERVER['wp_content_dir'] = $directory;


define('WP_CONTENT_DIR', $_SERVER['wp_content_dir']);
define('WP_CONTENT_URL', $_SERVER['wp_content_url']);

if (file_exists($_SERVER['wp_content_dir'] . '/../wp-config.php')) {
    require_once $_SERVER['wp_content_dir'] . '/../wp-config.php';
}

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
