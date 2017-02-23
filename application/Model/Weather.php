<?php

/**
 * Class Weather
 * This is a demo Model class.
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */

namespace Mini\Model;

use Mini\Core\Model;

class Weather extends Model
{
    /**
     * Get weather for the location
     */
    public function getWeather($location)
    {
        return "";
    }
}
