<?php
namespace Procivam\Pagination\Tests;

use Procivam\Pagination\System\Setting;
use Procivam\Pagination\System\URL;

class URLTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructorWrongParameterPage()
    {
        $this->expectException(\InvalidArgumentException::class);

        $setting = new Setting();
        $url = new URL($setting, 0);
        $url = new URL($setting, -2);
    }

    public function testConstructor()
    {
        $currentPage = 1;

        $setting = new Setting();
        // Human friendly
        $setting->setUseHumanFriendlyUrl(true)
            ->setUserFriendlyPattern('/page/<page>')
            ->setAbsoluteLinks(false);

        $url = new URL($setting, $currentPage);
        $this->assertEquals('/page/' . $currentPage, $url->createLink($currentPage));

        // Get parameter
        $setting->setUseHumanFriendlyUrl(false)
            ->setAbsoluteLinks(false);

        $url = new URL($setting, $currentPage);
        $this->assertEquals('?page=' . $currentPage, $url->createLink($currentPage));
    }
}
