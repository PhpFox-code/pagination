<?php
namespace Procivam\Pagination\Tests;

use Procivam\Pagination\System\Setting;

class SettingTest extends \PHPUnit_Framework_TestCase
{
    public $settingObj;

    public function setUp()
    {
        $properties = [
            'show-first-last-links' => 'foo'
        ];
        $this->settingObj = new Setting($properties);

        parent::setUp();
    }

    public function testGetMagicMethod()
    {
        $this->assertEquals('foo', $this->settingObj->showFirstLastLinks);
    }

    public function testGetMagicMethodException()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->settingObj->foBar;
    }

    public function testSetMagicMethod()
    {
        $this->settingObj->showFirstLastLinks = 'bar';
        $this->assertEquals('bar', $this->settingObj->showFirstLastLinks);
    }

    public function testSetMagicMethodException()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->settingObj->foBar = 'foo';
    }

    public function testCallMagicMethod()
    {
        $this->settingObj->setShowFirstLastLinks('foBar');
        $this->assertEquals('foBar', $this->settingObj->getShowFirstLastLinks());

        $this->expectException(\BadMethodCallException::class);
        $this->settingObj->foBar();
    }

    public function testExtractForView()
    {
        $this->settingObj->setShowFirstLastLinks('foBar');

        $extracted = $this->settingObj->extractForView();

        $this->assertArrayHasKey('showFirstLastLinks', $extracted);
        $this->assertEquals('foBar', $extracted['showFirstLastLinks']);
    }
}
