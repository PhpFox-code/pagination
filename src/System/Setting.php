<?php
namespace Procivam\Pagination\System;

use BadMethodCallException;
use InvalidArgumentException;

class Setting
{
    /**
     * @var array $settings
     */
    protected $settings = [
        'show-first-last-links'  => true,
        'show-prev-next-links'   => true,
        'use-whitespace'         => true,
        'whitespace'             => '...',
        'count-links'            => 4,
        'use-human-friendly-url' => true,
        'user-friendly-pattern'  => '/page/<page>',
        'absolute-links'         => true,
        'view-file'              => '',
    ];

    /**
     * Setting constructor.
     * @throws \InvalidArgumentException
     * @param array $settings
     */
    public function __construct(array $settings = [])
    {
        // Init view file
        $this->setProperty('view-file', dirname(__FILE__) . '/../Public/Views/BootstrapNavigationBar');

        // Set new parameters
        foreach ($settings as $name => $value) {
            $this->setProperty($name, $value);
        }
    }

    /**
     * @param string $name
     * @param mixed $value
     * @throws \InvalidArgumentException
     * @return Setting
     */
    public function __set($name, $value)
    {
        $this->setProperty($this->convertCallPropertyName($name), $value);

        return $this;
    }

    /**
     * @param string $name
     * @throws \InvalidArgumentException
     * @return mixed
     */
    public function __get($name)
    {
        return $this->getProperty($this->convertCallPropertyName($name));
    }

    /**
     * @param string $name
     * @param array $arguments
     * @throws \BadMethodCallException
     * @return $this|mixed
     */
    public function __call($name, $arguments = [])
    {
        $propertyName = $this->convertCallPropertyName(substr($name, 3));
        if (strpos($name, 'set') === 0) {
            // Start with: set
            $this->setProperty($propertyName, $arguments[0]);
            return $this;
        } elseif (strpos($name, 'get') === 0) {
            // Start with: get
            return $this->getProperty($propertyName);
        } else {
            throw new BadMethodCallException(sprintf('Attempt to call a nonexistent method: %s', $name));
        }
    }

    /**
     * @return array
     */
    public function extractForView()
    {
        $extracts = [];
        foreach ($this->settings as $name => $value) {
            $extracts[$this->convertArrayToVariables($name)] = $value;
        }

        return $extracts;
    }

    /**
     * @param string $name
     * @param mixed $value
     * @throws \InvalidArgumentException
     * @return bool
     */
    public function setProperty($name, $value)
    {
        if (array_key_exists($name, $this->settings)) {
            $this->settings[$name] = $value;
            return true;
        } else {
            throw new InvalidArgumentException(sprintf('Attempt to establish a non-existent property: %s', $name));
        }
    }

    /**
     * @param $name
     * @throws \InvalidArgumentException
     * @return mixed
     */
    public function getProperty($name)
    {
        if (array_key_exists($name, $this->settings)) {
            return $this->settings[$name];
        } else {
            throw new InvalidArgumentException(sprintf('Attempt to establish a non-existent property: %s', $name));
        }
    }

    /**
     * @param string $propertyName
     * @return mixed
     */
    protected function convertCallPropertyName($propertyName)
    {
        $convertedProperty = preg_replace_callback('#([[:upper:]]{1})#', function ($letters) {
            return '-' . strtolower($letters[1]);
        }, $propertyName);

        return ltrim($convertedProperty, '-');
    }

    /**
     * @param $propertyName
     * @return mixed
     */
    protected function convertArrayToVariables($propertyName)
    {
        $convertedProperty = preg_replace_callback('#\-(.)#', function ($letters) {
            return strtoupper($letters[1]);
        }, $propertyName);

        return $convertedProperty;
    }
}
