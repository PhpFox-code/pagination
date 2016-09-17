<?php

include_once('../vendor/autoload.php');

use \Procivam\Pagination\System\Pagination;

preg_match('#\/page\/([0-9]+)#', $_SERVER['REQUEST_URI'], $matches);
$page = $matches[1] ?: 1;
$total = 100;
$limit = 10;

$settings = new \Procivam\Pagination\System\Setting();
$settings->setUseHumanFriendlyUrl(true);

Pagination::init($page, $limit, $total, $settings);

echo Pagination::instance()->render();
