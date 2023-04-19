<?php

define('BASE_URL_PATH', '/');

require_once __DIR__ . '/src/library.php';

require_once __DIR__ . '/vendor/Psr4AutoloaderClass.php';
$loader = new Psr4AutoloaderClass;
$loader->register();

$loader->addNamespace('ct466\Nhakhoa', __DIR__ .'/src');

try {
$PDO = (new ct466\Nhakhoa\PDOFactory)->create([
'dbhost' => 'localhost',
'dbname' => 'ct466',
'dbuser' => 'root',
'dbpass' => ''
]);
} catch (Exception $ex) {
echo 'Không thể kết nối đến MySQL,
kiểm tra lại username/password đến MySQL.<br>';
exit("<pre>${ex}</pre>");
}