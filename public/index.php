<?php

use Config\Config;

require_once dirname(__DIR__) . '/Config/constants.php';
require_once BASE_DIR . '/vendor/autoload.php';

$dotenv = \Dotenv\Dotenv::createUnsafeImmutable(BASE_DIR);
$dotenv->load();
try {
    dd(\Core\Db::connect());
} catch (PDOException $exception) {
    dd('Exception', $exception->getMessage());
}