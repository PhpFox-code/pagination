<?php
namespace Procivam\Pagination\Tests;

use Procivam\Pagination\System\Pagination;
use Procivam\Pagination\System\Setting;

class PaginationTest extends \PHPUnit_Framework_TestCase
{
    public function testInstance()
    {
        $this->assertNull(Pagination::instance());

        Pagination::init(1, 10, 100, new Setting());
        $this->assertInstanceOf(Pagination::class, Pagination::instance());
    }

    public function testInit()
    {
        $this->assertInstanceOf(Pagination::class, Pagination::init(1, 10, 100, new Setting()));
    }
}
