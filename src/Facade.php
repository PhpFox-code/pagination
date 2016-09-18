<?php
namespace Procivam\Pagination;

use Procivam\Pagination\System\Pagination;
use Procivam\Pagination\System\Setting;

class Facade
{
    /**
     * Configure Pagination parameters
     * @param int $page
     * @param int $limit
     * @param int|callable $totalItems
     * @param Setting $setting
     * @return Pagination
     */
    public static function init($page, $limit, $totalItems, Setting $setting)
    {
        return Pagination::init($page, $limit, $totalItems, $setting);
    }

    /**
     * @return string
     */
    public static function render()
    {
        return Pagination::instance()->render();
    }
}
