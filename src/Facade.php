<?php
namespace Procivam\Pagination;

use Procivam\Pagination\System\Interfaces\FacadeInterface;

class Facade implements FacadeInterface
{
    /**
     * Configure Pagination parameters
     * @param int $page
     * @param int $limit
     * @param int|callable $totalItems
     * @return mixed
     */
    public static function init($page, $limit, $totalItems)
    {
    }
}
