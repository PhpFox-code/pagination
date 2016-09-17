<?php
namespace Procivam\Pagination\System;

use InvalidArgumentException;
use OutOfRangeException;

class Pagination
{
    private static $instance;

    private $setting;

    private $page;

    private $limit;

    private $total;

    private $maxCountLinks;

    private $url;

    /**
     * @param int $page
     * @param int $limit
     * @param int $total
     * @param Setting $setting
     * @return Pagination
     */
    public static function init($page, $limit, $total, Setting $setting)
    {
        self::$instance = new self($page, $limit, $total, $setting);

        return self::instance();
    }

    /**
     * @return null|Pagination
     */
    public static function instance()
    {
        return self::$instance;
    }

    /**
     * Pagination constructor.
     * @param int $page
     * @param int $limit
     * @param int $total
     * @throws InvalidArgumentException
     * @throws OutOfRangeException
     * @param Setting $setting
     */
    private function __construct($page, $limit, $total, Setting $setting)
    {
        $this->limit = (int)$limit;
        if (!$this->limit) {
            throw new InvalidArgumentException('Limit property must be > 0!');
        }

        $this->total = (int)$total;

        $this->page = (int)$page ?: 1;
        if ($this->limit * $this->page > $this->total) {
            throw new OutOfRangeException('The page number is large than allowed!');
        }

        $this->maxCountLinks = ceil($this->total / $this->limit);

        $this->setting = $setting;

        $this->url = new URL($this->setting, $this->page);
    }

    /**
     * @return string
     */
    public function render()
    {
        $parameters['links'] = $this->generateLinks();
        $parameters['currentPage'] = $this->page;
        $parameters['firstLink'] = ($this->setting->getProperty('show-first-last-links')
            and $this->page > 1)
            ? $this->url->createLink(1)
            : '';
        $parameters['prevLink'] = ($this->setting->getProperty('show-prev-next-links')
            and $this->page > 1)
            ? $this->url->createLink($this->page - 1)
            : '';
        $parameters['nextLink'] = ($this->setting->getProperty('show-prev-next-links')
            and $this->page < $this->maxCountLinks)
            ? $this->url->createLink($this->page + 1)
            : '';
        $parameters['lastLink'] = ($this->setting->getProperty('show-first-last-links')
            and $this->page < $this->maxCountLinks)
            ? $this->url->createLink($this->maxCountLinks)
            : '';

        return View::render($this->setting, $parameters);
    }

    /**
     * @return array
     */
    protected function generateLinks()
    {
        $links = [];

        $countLinks = $this->setting->getProperty('count-links');
        $startNumber = max(1, $this->page - $countLinks);
        $endNumber = min($this->maxCountLinks, $this->page + $countLinks);

        for ($i = $startNumber; $i <= $endNumber; $i++) {
            $links[$i] = $this->url->createLink($i);
        }

        return $links;
    }
}
