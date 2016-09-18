<?php

include_once('../vendor/autoload.php');

use \Procivam\Pagination;

preg_match('#\/page\/([0-9]+)#', $_SERVER['REQUEST_URI'], $matches);
$page = $matches[1] ?: 1;
$total = 100;
$limit = 10;

$settings = new \Procivam\Pagination\System\Setting();
$settings->setUseHumanFriendlyUrl(true);

Pagination\Facade::init($page, $limit, $total, $settings);

echo Pagination\Facade::render();
