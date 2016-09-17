<?php
namespace Procivam\Pagination\System;

class View
{
    /**
     * @param Setting $setting
     * @param array $parameters
     * @throws \InvalidArgumentException
     * @return string
     */
    public static function render(Setting $setting, array $parameters = [])
    {
        if (!count($parameters['links'])) {
            return '';
        }

        $viewFile = $setting->getProperty('view-file') . '.php';
        if (!is_file($viewFile) or !is_readable($viewFile)) {
            throw new \InvalidArgumentException('Can not load file: ' . $viewFile);
        }

        // Buffer init
        ob_start();
        extract($parameters, EXTR_SKIP);
        extract($setting->extractForView(), EXTR_SKIP);

        include_once($viewFile);

        return ob_get_clean();
    }
}
