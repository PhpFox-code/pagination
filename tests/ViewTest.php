<?php
namespace Procivam\Pagination\Tests;

use Procivam\Pagination\System\Setting;
use Procivam\Pagination\System\View;

class ViewTest extends \PHPUnit_Framework_TestCase
{
    public function testEmptyUrlList()
    {
        $setting = new Setting();

        $view = View::render($setting, ['links' => []]);

        $this->assertEquals('', $view);
    }

    public function testWrongViewFil()
    {
        $setting = new Setting();
        $setting->setViewFile('fooBar');

        $parameters = ['links' => ['page/1', 'page/2', 'page/3']];

        $this->expectException(\InvalidArgumentException::class);
        View::render($setting, $parameters);
    }

    public function testSuccessRender()
    {
        $setting = new Setting();

        $parameters = ['links' => ['page/1', 'page/2', 'page/3']];

        $view = View::render($setting, $parameters);

        $this->assertNotEquals('', $view);
    }
}
