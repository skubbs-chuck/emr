<?php
define('ENVIRONMENT', 'development');
switch (ENVIRONMENT) {
    case 'development': error_reporting(-1); ini_set('display_errors', 1); break;
    case 'production':
        ini_set('display_errors', 0);
        if (version_compare(PHP_VERSION, '5.3', '>='))
            error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
        else
            error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
    break;
    default:
        header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
        echo 'The application environment is not set correctly.';
        exit(1); // EXIT_ERROR
}

define('DS',              DIRECTORY_SEPARATOR);
define('DIR_SYSTEM',      'system');
define('DIR_APPS',        'applications');

// switch ($_SERVER['HTTP_HOST']) {
//     case 'admin.medcurial.skubbs.com':
//         define('DIR_APP', 'admin');
//     break;
//     case 'cms.medcurial.skubbs.com':
//         define('DIR_APP', 'cms');
//     break;
//     default:
//         define('DIR_APP', 'www');
//     break;
// }
define('DIR_APP', 'cms');


define('DIR_CONTROLLERS', 'controllers');
define('DIR_MODELS',      'models');
define('DIR_VIEWS',       'views');
define('DIR_3P',          'third_party');

define('PATH_ROOT',        __DIR__ . DS);
define('PATH_SYSTEM',      PATH_ROOT . DIR_SYSTEM . DS);
define('PATH_APPS',        PATH_ROOT . DIR_APPS . DS);
define('PATH_APP',         PATH_APPS . DIR_APP . DS);
define('PATH_CONTROLLERS', PATH_APP . DIR_CONTROLLERS . DS);
define('PATH_MODELS',      PATH_APP . DIR_MODELS . DS);
define('PATH_VIEWS',       PATH_APP . DIR_VIEWS . DS);
define('PATH_3P',          PATH_APPS . DIR_3P . DS);

define('URL_THEMES', 'themes/');

define('SELF',     pathinfo(__FILE__, PATHINFO_BASENAME));
define('BASEPATH', PATH_SYSTEM);
define('FCPATH',   PATH_ROOT);
define('SYSDIR',   DIR_SYSTEM);
define('APPPATH',  PATH_APP);
define('VIEWPATH', PATH_VIEWS);


if (!file_exists(PATH_SYSTEM)) {
    header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
    echo 'The system path does not exist.';
    exit(1); // EXIT_ERROR
}
if (!file_exists(PATH_APP)) {
    header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
    echo 'The application path does not exist.';
    exit(1); // EXIT_ERROR
}

require_once BASEPATH.'core/CodeIgniter.php';