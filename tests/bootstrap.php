<?php
#error_reporting(0);
#ini_set('error_reporting','E_ERROR');


date_default_timezone_set("Asia/Hong_Kong");
define('ROOT_PATH', dirname(dirname(__FILE__)));
define('LOG_FOLDER', ROOT_PATH.'/logs');
define('DATA_FOLDER', ROOT_PATH . '/data');
// cityBasedConfig Moved To SMUtil
define('CITY_CONFIG_FOLDER', ROOT_PATH . '/config/cities');
define('TEST_FOLDER', ROOT_PATH . '/tests');
define('TEST_DATA_FOLDER', ROOT_PATH . '/tests/test_data');
define('TEST_OUTPUT_FOLDER', ROOT_PATH . '/tests/test_data/output');


// define('APP_MODE', 'test');
// define('ENV_REGION', 'HK');

// putenv('APP_REGION=HK');

//define('ENV_GEO_CODING_GOOGLE_API_KEY', '');

require_once dirname(dirname(__FILE__))."/vendor/autoload.php";



if (!\SMUtil\File::exists(TEST_DATA_FOLDER)) {
    \SMUtil\Folder::create(TEST_DATA_FOLDER);
}
if (!\SMUtil\File::exists(TEST_OUTPUT_FOLDER)) {
    \SMUtil\Folder::create(TEST_OUTPUT_FOLDER);
}


// # 核心測試DB，但不同 測試用例，可以註冊不同的 Db_Key
// $readonly_db_path = TEST_DATA_FOLDER . '/saas.sqlite3';
// $writable_db_path =  TEST_OUTPUT_FOLDER . '/saas.sqlite3';
// if (\SMUtil\File::Exists($readonly_db_path) && !\SMUtil\File::Exists($writable_db_path)) {
//     \SMUtil\File::copy($readonly_db_path, $writable_db_path);
// }


// $db_config = array(
//     'SAAS_SUB_read' => [
//         'dbms' => 'Sqlite',
//         'path' => TEST_OUTPUT_FOLDER . '/saas.sqlite3',
//     ],
//     'SAAS_SUB_write' => [
//         'dbms' => 'Sqlite',
//         'path' => TEST_OUTPUT_FOLDER . '/saas.sqlite3',
//     ],

//     'LOCALE_DB_read' => [
//         'dbms' => 'Sqlite',
//         'path' => TEST_DATA_FOLDER.'/zeekcms_locale.db'
//     ],
//     'LOCALE_DB_write' => [
//         'dbms' => 'Sqlite',
//         'path' => TEST_DATA_FOLDER.'/zeekcms_locale.db'
//     ],


// );

// // call static init
// \SMDb::initConfig($db_config);


