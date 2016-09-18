<?php
namespace Procivam\Pagination\System;

class URL
{
    private $urlPattern;

    /**
     * URL constructor.
     * @param Setting $setting
     * @param int $page Current page
     * @throws \InvalidArgumentException
     */
    public function __construct(Setting $setting, $page)
    {
        if (!is_int($page) or $page < 1) {
            throw new \InvalidArgumentException('Page parameter must be positive integer var!');
        }

        if ($setting->getProperty('use-human-friendly-url')
            and $pattern = $setting->getProperty('user-friendly-pattern')
        ) {
            $currentPattern = str_replace('<page>', $page, $pattern);
            if (strpos($_SERVER['REQUEST_URI'], $currentPattern) !== false) {
                $url = str_replace($currentPattern, $pattern, $_SERVER['REQUEST_URI']);
            } else {
                $url = rtrim($_SERVER['REQUEST_URI'], '/') . $pattern;
            }
        } else {
            $_GET['page'] = '<page>';
            $url = '?' . http_build_query($_GET);
            $url = str_replace('%3Cpage%3E', '<page>', $url);

            $requestUri = explode('?', $_SERVER['REQUEST_URI']);
            $url = $requestUri[0] . $url;
        }

        $this->urlPattern = $url;

        if ($setting->getProperty('absolute-links')) {
            $this->urlPattern = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $this->urlPattern;
        }
    }

    /**
     * @param $number
     * @return mixed
     */
    public function createLink($number)
    {
        return str_replace('<page>', $number, $this->urlPattern);
    }
}
