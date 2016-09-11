<?php
namespace Procivam\Pagination\System\Interfaces;

interface FacadeInterface
{
    /**
     * Configure Pagination parameters
     * @param int $page
     * @param int $limit
     * @param int|callable $totalItems
     * @return mixed
     */
    public static function init($page, $limit, $totalItems);
}
