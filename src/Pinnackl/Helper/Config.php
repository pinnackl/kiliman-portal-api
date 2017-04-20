<?php

namespace Pinnackl\Helper;

/**
 * p
 */
class Config
{
    protected $config;

    function __construct($path = "")
    {
        if ($path != "") {
            $this->config = require_once($path);
        }
    }

    public function getConfig($key = null)
    {
        if (!is_null($key) && isset($this->config[$key])) {
            return $this->config[$key];
        }

        return $this->config[$key];
    }
}